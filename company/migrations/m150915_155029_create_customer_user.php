<?php

use yii\db\Schema;
use yii\db\Migration;

class m150915_155029_create_customer_user extends Migration
{
    public function up()
    {
        $this->createTable('oc_customer_user', [
            'customer_user_id' => 'pk',
            'username' => 'string',
            'password' => 'string',
            'email' => 'string',
            'telephone' => 'string',
            'date_added' => 'datetime',
            'date_modified' => 'datetime',
        ]);
    }

    public function down()
    {
        $this->dropTable('oc_customer_user');

        return true;
    }
}
