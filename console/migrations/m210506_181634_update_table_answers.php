<?php

use yii\db\Migration;

/**
 * Class m210506_181634_update_table_answers
 */
class m210506_181634_update_table_answers extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn('answers', 'status', $this->string());
        $this->addColumn('answers', 'date_create', $this->dateTime()->defaultExpression('NOW()'));
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn('answers', 'status');
        $this->dropColumn('answers', 'date_create');

    }
}
