<?php


namespace frontend\modules\api\controllers;


use frontend\models\Task;
use yii\rest\ActiveController;

class ApiTasksController extends ActiveController
{
    public $modelClass = Task::class;
}