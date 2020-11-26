<?php

use TaskForce\Task;

require 'Task.php';
$obTask = new Task(1,2);
$NextStatus = $obTask->getNextStatus(Task::ACTION_CANCEL);
$obTask->user = Task::ROLE_IMPLEMENT;
$NextAction = $obTask->getNextAction(Task::STATUS_IN_WORK);
?>
<div><?=$NextStatus?></div>
<div><?=$NextAction?></div>
