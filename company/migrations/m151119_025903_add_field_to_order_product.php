<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_025903_add_field_to_order_product extends Migration
{
    public function up()
    {
        $this->addColumn('oc_order_product', 'express', 'string');

    }

    public function down()
    {
        $this->dropColumn('oc_order_product', 'express');

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
