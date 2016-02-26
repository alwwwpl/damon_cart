<?php

use yii\db\Schema;
use yii\db\Migration;

class m151102_060300_add_field_to_customer extends Migration
{
    public function up()
    {
        $this->addColumn('oc_customer', 'id_number', 'string');

        $this->addColumn('oc_customer', 'id_files', 'string');

        $this->addColumn('oc_customer', 'company_number', 'string');

        $this->addColumn('oc_customer', 'company_files', 'string');

        $this->addColumn('oc_customer', 'company_short', 'string');

        $this->addColumn('oc_customer', 'company_name', 'string');

        $this->addColumn('oc_customer', 'province', 'string');

        $this->addColumn('oc_customer', 'city', 'string');

        $this->addColumn('oc_customer', 'address', 'string');

        $this->addColumn('oc_customer', 'address', 'string');

    }

    public function down()
    {
        $this->dropColumn('oc_customer', 'id_number');

        $this->dropColumn('oc_customer', 'id_files');

        $this->dropColumn('oc_customer', 'company_number');

        $this->dropColumn('oc_customer', 'company_files');

        $this->dropColumn('oc_customer', 'company_short');

        $this->dropColumn('oc_customer', 'company_name');

        $this->dropColumn('oc_customer', 'province');

        $this->dropColumn('oc_customer', 'city');

        $this->dropColumn('oc_customer', 'address');

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
