<?php

use yii\db\Migration;

/**
 * Class m210419_204506_update_table_files_task
 */
class m210419_204506_update_table_files_task extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn('files_task', 'name_file', $this->string());
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn('files_task', 'name_file');

    }
}
