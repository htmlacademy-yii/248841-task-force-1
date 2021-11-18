<?php


namespace frontend\controllers;


use frontend\models\Account;
use frontend\models\PhotoWork;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

class AccountController extends SecuredController
{
    /**
     * @return array|string|Response|ServerErrorHttpException
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        $model = new Account();
        if (\Yii::$app->request->getIsPost() && \Yii::$app->request->isAjax) {
            $model->load(\Yii::$app->request->post());
            if ($model->validate()) {
                /*if (boolval($_FILES) && !$model->saveFiles()) {
                    throw new ServerErrorHttpException('Ошибка сохранения файлов!');
                }*/

                \Yii::$app->response->format = Response::FORMAT_JSON;
                $model->saveAccount();

                return null;
            }

            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if (\Yii::$app->request->getIsGet() && \Yii::$app->request->get('imgDel') > 0) {
            $idPhoto = \Yii::$app->request->get('imgDel');
            foreach ($model->photoWorks as $key => $photoWork) {
                if ((int)$photoWork['id'] === (int)$idPhoto) {
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