<?php

use yii\db\Schema;
use yii\db\Migration;

class m150909_154513_add_agent_id_to_customer extends Migration
{
    public function up()
    {
        $this->addColumn('oc_customer', 'agent_id', 'integer');
    }

    public function down()
    {
        $this->dropColumn('oc_customer', 'agent_id');

        return true;
    }
}
