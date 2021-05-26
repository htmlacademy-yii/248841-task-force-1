<?php

use frontend\models\Response;
use yii\db\Migration;

/**
 * Class m210520_184623_update_table_response
 */
class m210520_184623_update_table_response extends Migration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        $this->addColumn('response', 'ready', 'ENUM("' . Response::YES . '", "' . Response::NO . '") NOT NULL DEFAULT "' . Response::YES . '"');

    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->dropColumn('response', 'ready');
    }
}
