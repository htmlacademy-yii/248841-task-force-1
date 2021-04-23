<?php

use yii\db\Migration;

/**
 * Class m210407_171610_update_table_user
 */
class m210407_171610_update_table_user extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->dropColumn('users', 'role');

    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->addColumn('users', 'role', 'ENUM("' . Task::ROLE_CUSTOMER . '", "' . Task::ROLE_IMPLEMENT . '") NOT NULL DEFAULT "' . Task::ROLE_CUSTOMER . '"');
    }
}
