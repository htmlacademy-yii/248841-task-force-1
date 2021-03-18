<?php


namespace frontend\controllers;


use frontend\models\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

class LandingController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        return \Yii::$app->user->isGuest?: $this->redirect('/tasks/');
    }

    public function actionIndex()
    {
        $this->layout = 'landing';

        $loginForm = new LoginForm();
        if (\Yii::$app->request->getIsPost()) {

            if (\Yii::$app->request->isAjax && $loginForm->load(\Yii::$app->request->post())) {
                if ($loginForm->validate()) {
                    $user = $loginForm->getUser();
                    \Yii::$app->user->login($user);

                    return $this->redirect('/tasks/');
                } else {
                    \Yii::$app->response->format = Response::FORMAT_JSON;

                    return ActiveForm::validate($loginForm);
                }

            }
        }

        return $this->render('index', ['loginForm' => $loginForm]);
    }
}