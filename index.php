<?php
require_once 'vendor/autoload.php';

use Lobochkin\TaskForce\Task;


$obTask = new Task(1, 2);
$NextStatus = $obTask->getNextStatus(Task::ACTION_CANCEL);

$NextAction = $obTask->getNextAction(Task::STATUS_IN_WORK, 1, 2, 2);
$NextAction1 = $obTask->getNextAction(Task::STATUS_IN_WORK, 1, 2, 1);
$NextAction2 = $obTask->getNextAction(Task::STATUS_FAILED, 1, 2, 2);
$NextAction3 = $obTask->getNextAction(Task::STATUS_NEW, 1, 2, 1);
$NextAction4 = $obTask->getNextAction(Task::STATUS_NEW, 1, 2, 2);

$dirName = __DIR__ . '/data/';
$outDirName = __DIR__ . '/data/bd/';
$bdName = 'taskforce';
foreach (glob($dirName . "*.csv") as $pathFile) {
    $nameTable = str_replace($dirName, '', $pathFile);
    $csv = new \Lobochkin\TaskForce\ReadCsvAndCreateSql($nameTable, $dirName, $outDirName, $bdName);
    dump($csv->csvToSqlConvert());
}

/*$tables = ['city', 'category', 'value_notification', 'users', 'task', 'response', 'chat', 'favourites', 'user_category', 'task_category', 'selected_notification', 'events', 'notification'];
foreach ($tables as $table) {
    $csv = new \Lobochkin\TaskForce\ReadCsvAndCreateSql($table, $dirName, $outDirName);
    dump($csv->csvToSqlConvert());
}*/

?>
<?= $NextStatus ?>
<div>Статус: в работе , исполнитель: 1, заказчик: 2, юзер: 2 <?= implode($NextAction, ', ') ?></div>
<hr>
<div>Статус: в работе , исполнитель: 1, заказчик: 2, юзер: 1 <?= implode($NextAction1, ', ') ?></div>
<hr>
<div>Статус: провалено , исполнитель: 1, заказчик: 2, юзер: 2 <?= implode($NextAction2, ', ') ?></div>
<hr>
<div>Статус: Новый , исполнитель: 1, заказчик: 2, юзер: 1 <?= implode($NextAction3, ', ') ?></div>
<hr>
<div>Статус: Новый , исполнитель: 1, заказчик: 2, юзер: 2 <?= implode($NextAction4, ', ') ?></div>
