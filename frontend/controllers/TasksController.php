<?php

namespace frontend\controllers;

use frontend\models\{CreateTask, Task, TaskFilter, Users};
use Yii;
use yii\bootstrap\ActiveForm;
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
            throw new NotFoundHttpException("Задание с ID $id не найден");
        }

        return $this->render('view', ['task' => $task]);

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
                if (boolval($_FILES)){

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


}