<?php

use yii\db\Schema;
use yii\db\Migration;

class m151019_165921_add_reset_password_token_and_reset_password_send_date extends Migration
{
    public function up()
    {
        $this->addColumn('oc_agent', 'reset_password_token', 'string');
        $this->addColumn('oc_agent', 'reset_password_send_date', 'datetime');
    }

    public function down()
    {
        $this->dropColumn('oc_agent', 'reset_password_token');
        $this->dropColumn('oc_agent', 'reset_password_send_date');
        return true;
    }
}
