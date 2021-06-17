<?php

use yii\db\Migration;

/**
 * Class m210609_184008_update_table_task
 */
class m210609_184008_update_table_task extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn('task', 'address', $this->string());
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn('task', 'address');

    }
}
