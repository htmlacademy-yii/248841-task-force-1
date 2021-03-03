<?php


namespace frontend\controllers;


use frontend\models\Users;
use frontend\models\UsersFilter;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $formFilter = new UsersFilter();
        $formFilter->load(Yii::$app->request->get());

        return $this->render('index', [
            'provider' => $formFilter->getDataProvider(),
            'formFilter' => $formFilter
        ]);
    }

    /**
     * @param $id string
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $user = Users::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("Пользователь с ID $id не найден");
        }

        return $this->render('view', ['user' => $user]);

    }
}