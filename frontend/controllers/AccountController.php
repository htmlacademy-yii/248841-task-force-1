<?php


namespace frontend\controllers;


use common\models\User;
use frontend\models\Account;
use frontend\models\Users;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class AccountController extends SecuredController
{
    public function actionIndex()
    {

        $model = new Account();
        if (\Yii::$app->request->getIsPost() && \Yii::$app->request->isAjax) {

//            $model->load(\Yii::$app->request->post());
//
//            if ($model->validate() && $task = $model->create()) {
//                if (boolval($_FILES)) {
//
//                    return "/tasks/view/{$task->id}";
//                } else {
//
//                    return $this->redirect("/tasks/view/{$task->id}");
//                }
//
//            } else {
//                \Yii::$app->response->format = Response::FORMAT_JSON;
//
//                return ActiveForm::validate($model);
            dd(\Yii::$app->request->post());
            dd(\Yii::$app->request->post('file'));
//            }
        } else {
//            dd(\Yii::$app->request->post());
//
        }

        return $this->render('index', ['model' => $model]);
    }
}