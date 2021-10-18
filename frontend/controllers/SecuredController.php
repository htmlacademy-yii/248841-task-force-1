<?php


namespace frontend\controllers;

use frontend\models\Users;
use yii\base\Event;
use yii\filters\AccessControl;
use yii\web\Controller;

class SecuredController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
                'denyCallback' => function($rule, $action) {
                    if (\Yii::$app->user->isGuest) {

                        return $this->redirect('/');
                    }
                },
            ]
        ];
    }

}