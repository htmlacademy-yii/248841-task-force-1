<?php

use yii\db\Migration;

/**
 * Class m210924_214323_update_table_photo_work
 */
class m210924_214323_update_table_photo_work extends Migration
{
    /**
     * @return bool|void
     */
    public function up()
    {
        $this->addColumn('photo_work', 'photo_name',  $this->string()->defaultValue('photo work'));

    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropColumn('photo_work', 'photo_name');

    }
}
