<?php


namespace frontend\modules\api\controllers;

use frontend\models\Chat;
use frontend\models\Task;
use frontend\models\TaskFilter;
use frontend\modules\api\actions\CreateAction;
use frontend\modules\api\models\ChatApi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\Controller;

class MessagesController extends Controller
{
    public $enableCsrfValidation = false;

    public $modelClass = ChatApi::class;

    public function actionIndex()
    {
        dd('actionIndex');
    }

    public function actionGetTaskMessages()
    {
//Yii::$app->request->rawBody;
//$varBody = file_get_contents('php://input');
        dd(Yii::$app->request->get(),'actionGetTaskMessages');

    }
//    public function actions()
//    {
//        $actions = parent::actions();
////        unset($actions['create']);
//        $actions['index']['prepareDataProvider'] = [$this, 'getTaskMessages'];
//        $actions['create']['class'] = CreateAction::class;
//        return $actions;
//    }
    public function getTaskMessages()
    {
        dd('dfdsfsdfssfsd');
        return new ActiveDataProvider([
            'query' => ChatApi::find()->where(['task_id' => Yii::$app->request->get('task_id')])
        ]);
    }
}