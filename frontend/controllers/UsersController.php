<?php


namespace frontend\controllers;


use frontend\models\Users;
use frontend\models\UsersFilter;
use Lobochkin\TaskForce\Task;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends SecuredController
{
    public function behaviors()
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['index','view'],
            'matchCallback' => function ($rule, $action) {
                $id = \Yii::$app->user->getId();
                $user = Users::findOne($id);

                return Task::ROLE_IMPLEMENT === $user->role;
            }
        ];

        array_unshift($rules['access']['rules'], $rule);

        return $rules;
    }

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