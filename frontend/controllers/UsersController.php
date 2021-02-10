<?php


namespace frontend\controllers;


use frontend\models\Users;
use Lobochkin\TaskForce\LastTime;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Users::find()
                ->where(['role' => 'implementer'])
                ->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', ['provider' => $provider]);
    }

}