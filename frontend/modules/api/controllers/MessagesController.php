<?php


namespace frontend\modules\api\controllers;

use frontend\modules\api\actions\CreateAction;
use frontend\modules\api\models\ChatApi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

class MessagesController extends Controller
{

    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function behaviors()
    {
        $rules = parent::behaviors();

        $rules['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'getTaskMessages' => ['get', 'ajax'],
                'addTaskMessages' => ['post', 'ajax'],

            ],
        ];

        return $rules;
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionGetTaskMessages()
    {

        if (!Yii::$app->request->get('task_id')) {
            throw new BadRequestHttpException('Не передан id задачи');
        }

        $provider = new ActiveDataProvider([
            'query' => ChatApi::find()->where(['task_id' => Yii::$app->request->get('task_id')])
        ]);

        \Yii::$app->response->format = Response::FORMAT_JSON;
        /**
         * @var array $response
         */

        Yii::$app->response->statusCode = 200;

        return $provider->getModels() ?: [];
    }

    /**
     * @return ChatApi|null
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */

    public function actionAddTaskMessages()
    {
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
            throw new ServerErrorHttpException();
        }

        Yii::$app->response->statusCode = 201;
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return ChatApi::findOne($chat->id);

    }
}