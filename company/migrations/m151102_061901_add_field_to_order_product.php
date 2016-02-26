<?php

use yii\db\Schema;
use yii\db\Migration;

class m151102_061901_add_field_to_order_product extends Migration
{
    public function up()
    {
        $this->addColumn('oc_customer', 'customer_id', 'integer');

        $this->addColumn('oc_customer', 'supplier_id', 'integer');

    }

    public function down()
    {
        $this->dropColumn('oc_customer', 'customer_id');

        $this->dropColumn('oc_customer', 'supplier_id');

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
