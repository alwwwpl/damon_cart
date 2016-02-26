<?php

use yii\db\Schema;
use yii\db\Migration;

class m151119_025705_add_field_to_address extends Migration
{
    public function up()
    {
        $this->addColumn('oc_address', 'phone', 'string');

    }

    public function down()
    {
        $this->dropColumn('oc_address', 'phone');

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
