<?php

use yii\db\Migration;

/**
 * Class m210313_103538_update_table_user
 */
class m210313_103538_update_table_user extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('users', 'password', $this->string()->notNull());
    }

    public function down()
    {
        $this->alterColumn('users', 'password', $this->string(45)->notNull());

    }

}
