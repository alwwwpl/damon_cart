<?php

use yii\db\Schema;
use yii\db\Migration;

class m150908_160935_create_agent extends Migration
{
    public function up()
    {
        $this->createTable('oc_agent', [
            'agent_id' => 'pk',
            'username' => 'string',
            'password' => 'string',
            'province_id' => 'integer',
            'city_id' => 'integer',
            'area_id' => 'integer',
            'phone' => 'string',
            'email' => 'string',
            'contact' => 'string',
            'id_code' => 'string',
            'id_file' => 'string',
            'agent_province_id' => 'integer',
            'agent_city_id' => 'integer',
            'agent_area_id' => 'integer',
            'company_short_name' => 'string',
            'company_name' => 'string',
            'business_license' => 'string',
            'business_license_file' => 'string',
            'status' => 'integer DEFAULT 0',
            'parent_id' => 'integer',
            'type' => 'integer',
            'date_added' => 'datetime',
            'date_modified' => 'datetime',
        ]);
    }

    public function down()
    {
        $this->dropTable('oc_agent');

        return true;
    }
}
