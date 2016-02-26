<?php

use yii\db\Schema;
use yii\db\Migration;

class m151030_074220_add_fields_to_customer extends Migration
{
    public function up()
    {
        $this->addColumn('oc_customer', 'username', 'string');
        $this->addColumn('oc_customer', 'contact', 'string');


        $this->addColumn('oc_customer', 'id_code', 'string');
        $this->addColumn('oc_customer', 'id_file', 'string');

        $this->addColumn('oc_customer', 'company_short_name', 'string');
        $this->addColumn('oc_customer', 'company_name', 'string');
        $this->addColumn('oc_customer', 'business_license', 'string');
        $this->addColumn('oc_customer', 'business_license_file', 'string');

        $this->addColumn('oc_customer', 'province_id', 'integer');
        $this->addColumn('oc_customer', 'city_id', 'integer');
        $this->addColumn('oc_customer', 'area_id', 'integer');
        $this->addColumn('oc_customer', 'address', 'string');
    }

    public function down()
    {
        $this->dropColumn('oc_customer', 'username');
        $this->dropColumn('oc_customer', 'contact');


        $this->dropColumn('oc_customer', 'id_code');
        $this->dropColumn('oc_customer', 'id_file');

        $this->dropColumn('oc_customer', 'company_short_name');
        $this->dropColumn('oc_customer', 'company_name');
        $this->dropColumn('oc_customer', 'business_license');
        $this->dropColumn('oc_customer', 'business_license_file');

        $this->dropColumn('oc_customer', 'province_id');
        $this->dropColumn('oc_customer', 'city_id');
        $this->dropColumn('oc_customer', 'area_id');
        $this->dropColumn('oc_customer', 'address');

        return true;
    }
}
