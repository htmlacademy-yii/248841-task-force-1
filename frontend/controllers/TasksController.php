<?php

namespace frontend\controllers;
use frontend\models\{Task, TaskFilter};
use Yii;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {

        $formFilter = new TaskFilter();
        if (Yii::$app->request->isPost) {
            $formFilter->load(Yii::$app->request->post());
        }
        return $this->render('index', [
            'provider' => $formFilter->getDataProvider(),
            'formFilter' => $formFilter
            ]);
    }

}