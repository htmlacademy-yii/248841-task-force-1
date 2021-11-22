<?php


namespace frontend\controllers;

use frontend\models\City;
use frontend\models\Users;
use rmrevin\yii\ulogin\AuthAction;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function beforeAction($action)
    {
        if (in_array($action->id, ['ulogin-auth'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->layout = 'authUser';
        $user = new Users();
        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());

            if ($user->validate()) {
                $user->password = Yii::$app->security->generatePasswordHash($user->password);
                $user->save();
                $this->goHome();
            }
        }
        return $this->render('index', ['model' => $user]);
    }

    public function actions()
    {
        return [
            'ulogin-auth' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'uloginSuccessCallback'],
                'errorCallback' => function ($data) {
                    \Yii::error($data['error']);
                },
            ]
        ];
    }

    public function uloginSuccessCallback($attributes = false)
    {
        if (!$attributes) {
            return $this->goHome();
        }
        $user = Users::findOne(['email' => $attributes['email']]);
        if ($user) {
            \Yii::$app->user->login($user);
        } else {
            $user = new Users();
            $user->email = $attributes['email'];
            $user->name = $attributes['first_name'] . $attributes['last_name'];
            $user->password = Yii::$app->security->generateRandomString(8);

            if (strlen(trim($attributes['city'])) > 0) {
                $city = City::findOne(['name' => $attributes['city']]);

                if (!$city) {
                    $newCity = new City();
                    $newCity->name = $attributes['city'];
                    $newCity->save();
                    $user->city_id = $newCity->id;
                } else {
                    $user->city_id = $city->id;
                }
            }
            $user->save(true);
        }

        return $this->goHome();
    }
}