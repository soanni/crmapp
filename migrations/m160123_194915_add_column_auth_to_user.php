<?php

use yii\db\Schema;
use yii\db\Migration;

class m160123_194915_add_column_auth_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user','auth_key','string UNIQUE');
    }

    public function down()
    {
        $this->dropColumn('user','auth_key');
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
