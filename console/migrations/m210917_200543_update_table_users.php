<?php

use yii\db\Migration;

/**
 * Class m210917_200543_update_table_users
 */
class m210917_200543_update_table_users extends Migration
{
    public function up()
    {
        $this->addColumn('users', 'show_contacts',  $this->string()->defaultValue('N'));
        $this->addColumn('users', 'not_show_profile',  $this->string()->defaultValue('N'));
    }

    public function down()
    {
        $this->dropColumn('users', 'show_contacts');
        $this->dropColumn('users', 'not_show_profile');
    }

}
