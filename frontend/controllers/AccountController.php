<?php


namespace frontend\controllers;


use common\models\User;
use frontend\models\Account;
use frontend\models\Users;
use phpDocumentor\Reflection\Types\False_;
use yii\bootstrap\ActiveForm;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

class AccountController extends SecuredController
{
    public function beforeAction($action)
    {
        if (in_array($action->id, ['load-photo'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $rules = parent::behaviors();
        $rules['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'loadPhoto' => ['post', 'ajax'],
            ],
        ];

        return $rules;
    }

    public function actionIndex()
    {

        $model = new Account();

        if (\Yii::$app->request->getIsPost() && \Yii::$app->request->isAjax) {
            $model->load(\Yii::$app->request->post());
            if ($model->validate()) {
                if (boolval($_FILES) && !$model->saveFiles()) {
                    return 'Ошибка сохранения файлов!';
                }

                \Yii::$app->response->format = Response::FORMAT_JSON;
                return $model->saveAccount();
            }

            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        return $this->render('index', ['model' => $model]);
    }
}