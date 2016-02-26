<?php

use yii\db\Schema;
use yii\db\Migration;

class m150909_180420_create_area extends Migration
{
    public function up()
    {
        $this->createTable('oc_area', [
            'area_id' => 'pk',
            'area_name' => 'string',
            'parent_id' => 'integer',
            'level' => 'integer',
            'lft' => 'integer',
            'rgt' => 'integer',
            'root' => 'integer',
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
