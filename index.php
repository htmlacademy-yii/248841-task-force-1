<?php
require_once 'vendor/autoload.php';
use Lobochkin\TaskForce\Task;


$obTask = new Task(1,2);
$NextStatus = $obTask->getNextStatus(Task::ACTION_CANCEL);

$NextAction = $obTask->getNextAction(Task::STATUS_IN_WORK, Task::ROLE_IMPLEMENT);
?>
<div><?=$NextStatus?></div>
<div><?=$NextAction?></div>
