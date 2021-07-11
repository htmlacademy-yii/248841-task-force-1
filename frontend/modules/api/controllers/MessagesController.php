<?php


namespace frontend\modules\api\controllers;

use frontend\modules\api\actions\CreateAction;
use frontend\modules\api\models\ChatApi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;

class MessagesController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        dd('actionIndex');
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionGetTaskMessages()
    {

        if (!Yii::$app->request->get('task_id') && !((int)Yii::$app->request->get('task_id') > 0)) {
            throw new BadRequestHttpException();
        }

        $provider = new ActiveDataProvider([
            'query' => ChatApi::find()->where(['task_id' => Yii::$app->request->get('task_id')])
        ]);

        \Yii::$app->response->format = Response::FORMAT_JSON;
        /**
         * @var array $response
         */
        $response = [];
        foreach ($provider->getModels() as $model) {
            $response[] = $model;
        }
        Yii::$app->response->statusCode = 200;
        return $response;
    }

    /**
     * @return ChatApi|null
     * @throws BadRequestHttpException
     */
    public function actionAddTaskMessages()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException();
        }
        /**
         * @var $request Request
         */
        $request = json_decode(Yii::$app->request->getRawBody());
        if (!$request->task_id > 0) {
            throw new BadRequestHttpException();
        }
        /**
         * @var $chat ChatApi
         */
        $chat = new ChatApi();
        $chat->task_id = $request->task_id;
        $chat->text = $request->message;
        $chat->user_id = \Yii::$app->user->getId();
        if (!$chat->save()) {
            throw new BadRequestHttpException();
        }

        Yii::$app->response->statusCode = 201;
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return ChatApi::findOne($chat->id);

    }
}