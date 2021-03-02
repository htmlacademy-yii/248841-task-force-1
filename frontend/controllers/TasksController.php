<?php

namespace frontend\controllers;
use frontend\models\{Task, TaskFilter};
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TasksController extends Controller
{
    public function actionIndex()
    {

        $formFilter = new TaskFilter();
        if (Yii::$app->request->isPost) {
            $formFilter->load(Yii::$app->request->post());

        } elseif (Yii::$app->request->isGet){
            $formFilter->category = Yii::$app->request->get();
        }
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
    public function actionView($id = '')
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задание с ID $id не найден");
        }
        return $this->render('view',['task' =>$task]);

    }

    /**
     * @param $filename
     * @return \yii\console\Response|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionFile($filename)
    {
        $storagePath = Yii::getAlias('@webroot/uploads');

        if (!preg_match('/^[a-z0-9]+\.[a-z0-9]+$/i', $filename) || !is_file("$storagePath/$filename")) {
            throw new NotFoundHttpException('Файл не найден.');
        }
        return Yii::$app->response->sendFile("$storagePath/$filename", $filename);
    }

}