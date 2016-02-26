<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_031347_create_coupons extends Migration
{
    public function up()
    {
        $this->createTable('oc_coupons', [
            'coupons_id' => 'pk',
            'coupons_name' => 'string',
            'code' => 'string',
            'agent_id' => 'integer',
            'product_category' => 'varchar(255) NOT NULL DEFAULT 0',
            'condition' => 'decimal(15,4) NOT NULL DEFAULT 0.0000',
            'discount' => 'decimal(15,4) NOT NULL DEFAULT 0.0000',
            'agent_percent' => 'varchar(20) NOT NULL DEFAULT 80%',
            'system_percent' => 'varchar(20) NOT NULL DEFAULT 20%',
            'start_time' => 'datetime NOT NULL',
            'over_time' => 'datetime NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('oc_coupons');

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
