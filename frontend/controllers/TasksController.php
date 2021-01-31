<?php


namespace frontend\controllers;
use Lobochkin\TaskForce\LastTime;
use frontend\models\{Task};
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {

        $taskData = [];
        $tasks = Task::find()
            ->where(['status' => 'new'])
            ->orderBy('id DESC')
            ->all();


        foreach ($tasks as $task) {

            $taskData[$task->id] = [
                'title' => $task->title,
                'description' => $task->description,
                'category' => [
                    'name' => $task->category->name,
                    'icon' => $task->category->icon
                    ],
                'location' => $task->location,
                'dateCreate' => LastTime::getLastTime(strtotime($task->date_create)),
                'price' => $task->price
            ];
        }

        return $this->render('index',['taskData' => $taskData]);
    }

}