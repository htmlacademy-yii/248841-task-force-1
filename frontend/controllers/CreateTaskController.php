<?php


namespace frontend\controllers;


use frontend\models\CreateTask;
use frontend\models\Users;
use Lobochkin\TaskForce\Task;
use yii\web\Controller;

class CreateTaskController extends SecuredController
{
    public function behaviors()
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['index'],
            'matchCallback' => function ($rule, $action) {
                $id = \Yii::$app->user->getId();
                $user = Users::findOne($id);

                return Task::ROLE_IMPLEMENT !== $user->role;
            }
        ];

        array_unshift($rules['access']['rules'], $rule);

        return $rules;
    }
    public function actionIndex()
    {
        $model = new CreateTask();

        return $this->render('index',['model' => $model]);
    }

}