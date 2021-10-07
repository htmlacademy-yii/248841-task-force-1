<?php

use yii\db\Migration;

/**
 * Class m210802_143919_update_table_selected_notification
 */
class m210802_143919_update_table_selected_notification extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn('selected_notification', 'active',  $this->string()->defaultValue('N'));
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn('selected_notification', 'active');

    }
}
