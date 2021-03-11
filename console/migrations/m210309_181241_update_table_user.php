<?php

use Lobochkin\TaskForce\Task;
use yii\db\Migration;

/**
 * Class m210309_181241_update_table_user
 */
class m210309_181241_update_table_user extends Migration
{

    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->alterColumn('users', 'date_create', $this->dateTime()->defaultExpression('NOW()'));
        $this->alterColumn('users', 'role', 'ENUM("' . Task::ROLE_CUSTOMER . '", "' . Task::ROLE_IMPLEMENT . '") NOT NULL DEFAULT "' . Task::ROLE_CUSTOMER . '"');

    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->alterColumn('users', 'date_create', $this->dateTime()->null());
        $this->alterColumn('users', 'role', 'ENUM("' . Task::ROLE_CUSTOMER . '", "' . Task::ROLE_IMPLEMENT . '")');
    }


}