<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_031912_create_order_address extends Migration
{
    public function up()
    {
        $this->createTable('oc_order_address', [
            'order_address_id' => 'pk',
            'order_id' => 'integer',
            'customer_id' => 'integer',
            'username' => 'string',
            'phone' => 'string',
            'country' => 'string',
            'province' => 'string',
            'city' => 'string',
            'remarks' => 'string',
        ]);
    }

    public function down()
    {
        $this->dropTable('oc_order_address');

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
