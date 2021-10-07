<?php


namespace frontend\controllers;


use common\models\User;
use frontend\models\Account;
use frontend\models\PhotoWork;
use frontend\models\Users;
use phpDocumentor\Reflection\Types\False_;
use yii\bootstrap\ActiveForm;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
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
                    return new ServerErrorHttpException('Ошибка сохранения файлов!');
                }

                \Yii::$app->response->format = Response::FORMAT_JSON;
                return $model->saveAccount();
            }

            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if (\Yii::$app->request->getIsGet() && \Yii::$app->request->get('imgDel') > 0) {
            $idPhoto = \Yii::$app->request->get('imgDel');
            foreach ($model->photoWorks as $key => $photoWork) {
                if ($photoWork['id'] == $idPhoto){
                    unlink(\Yii::getAlias('@webroot/uploads/') . $photoWork['url_photo']);
                    unset($model->photoWorks[$key]);
                }
            }
            PhotoWork::deleteAll(['id' => $idPhoto]);
            return $this->redirect('/account');
        }

        return $this->render('index', ['model' => $model]);
    }
}