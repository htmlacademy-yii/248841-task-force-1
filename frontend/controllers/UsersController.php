<?php


namespace frontend\controllers;


use frontend\models\UsersFilter;
use Yii;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $formFilter = new UsersFilter();
        if (Yii::$app->request->isPost) {
            $formFilter->load(Yii::$app->request->post());
        }
        return $this->render('index', [
            'provider' => $formFilter->getDataProvider(),
            'formFilter' => $formFilter
        ]);
    }

}