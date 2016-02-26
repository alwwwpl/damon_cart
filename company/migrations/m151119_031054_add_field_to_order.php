<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_031054_add_field_to_order extends Migration
{
    public function up()
    {
        $this->addColumn('oc_order', 'express', 'string');

    }

    public function down()
    {
        $this->dropColumn('oc_order', 'express');

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
