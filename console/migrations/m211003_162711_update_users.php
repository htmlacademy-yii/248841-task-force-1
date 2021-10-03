<?php

use yii\db\Migration;

/**
 * Class m211003_162711_update_users
 */
class m211003_162711_update_users extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {

        $this->alterColumn('users', 'phone', $this->string(12));

    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->alterColumn('users', 'phone', $this->integer(12));
    }
}
