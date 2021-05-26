<?php


namespace frontend\helpers;


use frontend\models\Task;

class TaskPermission
{
    /**
     * @param int $identityId
     * @param int $taskId
     * @return bool
     */
    public static function canShowAnswer(int $identityId,int $taskId)
    {
        return Task::find()->innerJoin('answers', 'answers.task_id = task.id AND answers.user_id = :identityId',[':identityId' => $identityId])->where(['task.id' => $taskId])->exists();
    }

}