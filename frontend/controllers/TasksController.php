<?php


namespace frontend\controllers;
use frontend\models\{Task};
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {

        $provider = new ActiveDataProvider([
            'query' => Task::find()
                ->where(['status' => 'new'])
                ->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', ['provider' => $provider]);
    }

}