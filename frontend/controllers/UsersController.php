<?php


namespace frontend\controllers;

use frontend\models\Users;
use Lobochkin\TaskForce\LastTime;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionIndex()
    {

        $userData = [];
        $users = Users::find()
            ->where(['role' => 'implementer'])
            ->orderBy('id DESC')
            ->all();

        foreach ($users as $user) {

            $responses = $user->responses;
            $responseRate = array_map(function ($i) {
                return $i->rate;
            }, $responses);
            $responseRateAverage = false;
            if (count($responseRate) > 0 ) {
                $responseRateAverage = round(array_sum($responseRate) / count($responseRate), 2);
            }
            $tasks = [];

            foreach ($user->tasks0 as $task) {
                if ($task->status == 'cancel'){
                    $tasks[] = $task;
                }
            }
            $categorys = array_map(function ($v) {
                return [
                    'id_category' => $v->id,
                    'name_category' => $v->name
                    ];
            }, $user->category);

            $userData[$user->id] = [
                'name' => $user->name,
                'avatarUrl' => $user->avatar_url,
                'lastVisit' => LastTime::getLastTime(strtotime($user->last_visit)),
                'description' => $user->description,
                'responseRate' => $responseRateAverage,
                'responseCount' => count($responses),
                'taskCount' => count($tasks),
                'categorys' => $categorys
            ];
        }


        return $this->render('index', ['userData' => $userData]);
    }

}