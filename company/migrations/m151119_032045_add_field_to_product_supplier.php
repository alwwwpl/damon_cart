<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_032045_add_field_to_product_supplier extends Migration
{
    public function up()
    {
        $this->addColumn('oc_product_supplier', 'agent_product_name', 'string');

        $this->addColumn('oc_product_supplier', 'agent_product_stock', 'string');

        $this->addColumn('oc_product_supplier', 'agent_product_model', 'string');

    }

    public function down()
    {
        $this->dropColumn('oc_product_supplier', 'agent_product_name');

        $this->dropColumn('oc_product_supplier', 'agent_product_stock');

        $this->dropColumn('oc_product_supplier', 'agent_product_model');


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
