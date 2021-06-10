<?php

namespace frontend\controllers;

use frontend\models\{Answers, CreateTask, Task, TaskFilter, Users};
use Yii;
use yii\bootstrap\ActiveForm;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TasksController extends SecuredController
{
    public function behaviors()
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['create'],
            'matchCallback' => function ($rule, $action) {

                if (\Yii::$app->user->isGuest) {
                    return $this->redirect('/');
                }
                return !\Yii::$app->user->identity->isCustomer();
            }
        ];

        array_unshift($rules['access']['rules'], $rule);
        $rules['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'answer' => ['post', 'ajax'],
                'addAnswer' => ['post', 'ajax'],
                'complete' => ['post', 'ajax'],
            ],
        ];

        return $rules;
    }

    public function actionIndex()
    {
        /** @var TaskFilter $formFilter */
        $formFilter = new TaskFilter();
        $formFilter->load(Yii::$app->request->get());

        return $this->render('index', [
            'provider' => $formFilter->getDataProvider(),
            'formFilter' => $formFilter
        ]);
    }

    /**
     * @param $id string
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задание с ID $id не найдено");
        }

        $answer = new Answers();
        $response = new \frontend\models\Response();

        return $this->render('view', [
            'task' => $task,
            'answer' => $answer,
            'response' => $response
        ]);

    }

    /**
     * @return array|Response
     */
    public function actionAddAnswer()
    {
        $model = new Answers();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            \Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }
        $model->save();

        return $this->redirect("/tasks/view/{$model->task_id}");
    }

    /**
     * @return array|Response|null
     * @throws \yii\db\Exception
     */
    public function actionComplete()
    {
        $model = new \frontend\models\Response();
        $transaction = \Yii::$app->db->beginTransaction();
        $model->load(\Yii::$app->request->post());
        if (!$model->validate()) {
            \Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }
        if (!$model->save()) {

            return null;
        }

        $task = Task::findOne($model->task_id);
        $task->status = $model->ready === \frontend\models\Response::YES ? \Lobochkin\TaskForce\Task::STATUS_DONE : \Lobochkin\TaskForce\Task::STATUS_FAILED;
        if (!$task->save()) {
            $transaction->rollBack();

            return null;
        }
        $transaction->commit();


        return $this->redirect("/tasks/view/{$model->task_id}");
    }

    /**
     * @param $filename
     * @return \yii\console\Response|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionFile($filename)
    {
        $storagePath = Yii::getAlias('@webroot/uploads');
        if (!preg_match('/^[a-z0-9_]+\.[a-z0-9]+$/i', $filename) || !is_file("$storagePath/$filename")) {
            throw new NotFoundHttpException('Файл не найден.');
        }

        return Yii::$app->response->sendFile("$storagePath/$filename", $filename);
    }

    public function actionCreate()
    {
        $model = new CreateTask();

        if (\Yii::$app->request->getIsPost() && \Yii::$app->request->isAjax) {

            $model->load(\Yii::$app->request->post());

            if ($model->validate() && $task = $model->create()) {
                if (boolval($_FILES)) {

                    return "/tasks/view/{$task->id}";
                } else {

                    return $this->redirect("/tasks/view/{$task->id}");
                }

            } else {
                \Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($model);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * @throws BadRequestHttpException
     */
    public function actionAnswer()
    {
        /**
         * @var integer
         */
        $idAnswer = \Yii::$app->request->post('id');
        /**
         * @var string
         */
        $action = \Yii::$app->request->post('action');
        /**
         * @var Answers
         */
        $answer = Answers::findOne($idAnswer);
        if (!$answer) {
            throw new BadRequestHttpException('Не верный id отклика');
        }
        if ($answer->status) {
            throw new BadRequestHttpException('Действие с откликом уже было совершено ранее');
        }
        switch ($action) {
            case Answers::CANCEL:
                $answer->status = $action;

                break;
            case Answers::ACCEPT:
                $answer->status = $action;
                /**
                 * @var Task
                 */
                $task = Task::findOne($answer->task_id);
                $task->implementer_id = $answer->user_id;
                $task->status = \Lobochkin\TaskForce\Task::STATUS_IN_WORK;
                $task->save();
                break;
            default :
                throw new BadRequestHttpException('Передано не верное действие');
        }
        $answer->save();
    }

}