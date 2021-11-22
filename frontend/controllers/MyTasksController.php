<?php


namespace frontend\controllers;


use frontend\models\Task;
use frontend\models\TaskFilter;
use frontend\modules\api\models\ChatApi;
use Lobochkin\TaskForce\Task as TaskForceTask;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class MyTasksController extends SecuredController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $get = \Yii::$app->request->get('status');

        /** @var Task $query */

        switch ($get) {
            case \Lobochkin\TaskForce\Task::STATUS_IN_WORK:
                $query = Task::find()
                    ->where(['status' => \Lobochkin\TaskForce\Task::STATUS_IN_WORK])
                    ->orderBy('id DESC')
                    ->orWhere([
                        'implementer_id' => \Yii::$app->user->getId(),
                        'employer_id' => \Yii::$app->user->getId(),
                    ]);
                break;
            case \Lobochkin\TaskForce\Task::STATUS_DONE:
                $query = Task::find()
                    ->where(['status' => \Lobochkin\TaskForce\Task::STATUS_DONE])
                    ->orderBy('id DESC')
                    ->orWhere([
                        'implementer_id' => \Yii::$app->user->getId(),
                        'employer_id' => \Yii::$app->user->getId(),
                    ]);
                break;
            case \Lobochkin\TaskForce\Task::STATUS_CANCEL:
                $query = Task::find()
                    ->orWhere([
                        'status' => \Lobochkin\TaskForce\Task::STATUS_CANCEL,
                        'status' => \Lobochkin\TaskForce\Task::STATUS_FAILED,
                    ])
                    ->orderBy('id DESC')
                    ->orWhere([
                        'implementer_id' => \Yii::$app->user->getId(),
                        'employer_id' => \Yii::$app->user->getId(),
                    ]);
                break;
            case \Lobochkin\TaskForce\Task::EXPIRED:
                $query = Task::find()
                    ->where(['status' => \Lobochkin\TaskForce\Task::STATUS_IN_WORK])
                    ->andWhere('deadline < NOW()')
                    ->orderBy('id DESC')
                    ->orWhere([
                        'implementer_id' => \Yii::$app->user->getId(),
                        'employer_id' => \Yii::$app->user->getId(),
                    ]);
                break;
            default:
                $query = Task::find()
                    ->where(['status' => \Lobochkin\TaskForce\Task::STATUS_NEW])
                    ->orderBy('id DESC')
                    ->andWhere([
                        'employer_id' => \Yii::$app->user->getId(),
                    ]);
        }

        return $this->render('index', [
            'provider' => new ActiveDataProvider(['query' => $query])
        ]);
    }

}