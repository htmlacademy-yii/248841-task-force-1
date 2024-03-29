<?php


namespace frontend\controllers;


use frontend\models\Users;
use frontend\models\UsersFilter;
use Yii;
use yii\web\NotFoundHttpException;

class UsersController extends SecuredController
{
    /**
     * @return array
     */
    public function behaviors()
    {

        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['index','view'],
            'matchCallback' => function ($rule, $action) {
                if (\Yii::$app->user->isGuest) {
                    return $this->redirect('/');
                }
            }
        ];

        array_unshift($rules['access']['rules'], $rule);
        return $rules;
    }

    /**
     * @return string
     */
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
     * @return \yii\web\Response
     */
    public function actionLogout() {
        \Yii::$app->user->logout();

        return $this->goHome();
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

}