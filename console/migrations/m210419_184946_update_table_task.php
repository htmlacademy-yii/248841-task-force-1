<?php

use Lobochkin\TaskForce\Task;
use yii\db\Migration;

/**
 * Class m210419_184946_update_table_task
 */
class m210419_184946_update_table_task extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {

        $this->alterColumn('task', 'status', 'ENUM("' . Task::STATUS_NEW . '", "' . Task::STATUS_IN_WORK . '", "' . Task::STATUS_DONE . '", "' . Task::STATUS_FAILED . '", "' . Task::STATUS_CANCEL . '") NOT NULL DEFAULT "' . Task::STATUS_NEW . '"');

    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->alterColumn('task', 'status', 'ENUM("' . Task::STATUS_NEW . '", "' . Task::STATUS_IN_WORK . '", "' . Task::STATUS_DONE . '", "' . Task::STATUS_FAILED . '", "' . Task::STATUS_CANCEL . '")');
    }
}
