<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_031803_create_coupons_code extends Migration
{
    public function up()
    {
        $this->createTable('oc_coupons_code', [
            'coupons_code_id' => 'pk',
            'coupons_id' => 'integer',
            'code' => 'string',
            'status' => 'integer',
        ]);
    }

    public function down()
    {
        $this->dropTable('oc_coupons_code');

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
