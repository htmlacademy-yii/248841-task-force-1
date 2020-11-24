<?php

use TaskForce\Task;

require 'Task.php';
$obTask = new Task(1,2);
$strNextStatus = $obTask->getNextStatus(Task::ACTION_CANCEL);
$obTask->strUser = 'implementer';
$strNextAction = $obTask->getNextAction(Task::STATUS_IN_WORK);
?>
<div><?=$strNextStatus?></div>
<div><?=$strNextAction?></div>
