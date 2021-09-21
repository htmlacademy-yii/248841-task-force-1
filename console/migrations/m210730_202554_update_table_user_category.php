<?php

use yii\db\Migration;

/**
 * Class m210730_202554_update_table_user_category
 */
class m210730_202554_update_table_user_category extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn('user_category', 'active',  $this->string()->defaultValue('N'));
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn('user_category', 'active');

    }
}
