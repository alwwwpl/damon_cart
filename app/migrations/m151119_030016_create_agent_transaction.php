<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_030016_create_agent_transaction extends Migration
{
    public function up()
    {
        $this->createTable('oc_agent_transaction', [
            'agent_transaction_id' => 'pk',
            'agent_id' => 'integer',
            'order_id' => 'integer',
            'description' => 'varchar(255) NOT NULL DEFAULT 0',
            'amount' => 'decimal(15,4) NOT NULL DEFAULT 0.0000',
            'cash' => 'decimal(15,4) NOT NULL DEFAULT 0.0000',
            'date_added' => 'datetime',
        ]);
    }

    public function down()
    {
        $this->dropTable('oc_agent_transaction');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
