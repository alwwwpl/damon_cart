<?php

use yii\db\Schema;
use yii\db\Migration;

class m151020_155414_create_invite_code extends Migration
{
    public function up()
    {
        $this->createTable('oc_invite_code', [
            'invite_code_id' => 'pk',
            'agent_id' => 'integer',
            'status' => 'tinyint DEFAULT 0',
            'code' => 'string',
            'date_added' => 'datetime'
        ]);
    }

    public function down()
    {
        $this->dropTable('oc_invite_code');

        return true;
    }
}
