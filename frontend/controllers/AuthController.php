<?php


namespace frontend\controllers;

use DateTime;
use frontend\models\Users;
use Lobochkin\TaskForce\Task;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionIndex()
    {
        $user = new Users();
        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                $date = new DateTime();
                $user->date_create = $date->format('Y-m-d');
                $user->role = Task::ROLE_CUSTOMER;
                $user->password = Yii::$app->security->generatePasswordHash($user->password);
                $user->last_visit = $date->format('Y-m-d H:i:s');
                $user->save('false');
                $this->goHome();
            }
        }
        return $this->render('index',['model' => $user]);
    }

}