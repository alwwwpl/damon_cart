<?php

use yii\db\Schema;
use yii\db\Migration;

class m151024_150358_add_adress_to_agent extends Migration
{
    public function up()
    {
        $this->addColumn('oc_agent', 'address', 'string');
    }

    public function down()
    {
        $this->dropColumn('oc_agent', 'address');

        return true;
    }
}
