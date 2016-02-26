<?php

use yii\db\Schema;
use yii\db\Migration;

class m150916_162825_add_customer_id_to_customer_user extends Migration
{
    public function up()
    {
        $this->addColumn('oc_customer_user', 'customer_id', 'integer');
    }

    public function down()
    {
        $this->dropColumn('oc_customer_user', 'customer_id');

        return true;
    }
}
