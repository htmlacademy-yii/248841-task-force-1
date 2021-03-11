<?php


namespace frontend\controllers;

use frontend\models\Users;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{

    public function actionIndex()
    {
        $this->layout ='authUser';
        $user = new Users();
        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                $user->password = Yii::$app->security->generatePasswordHash($user->password);
                $user->save();
                $this->goHome();
            }
        }
        return $this->render('index',['model' => $user]);
    }

}