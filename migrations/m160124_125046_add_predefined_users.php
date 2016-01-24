<?php

use yii\db\Schema;
use yii\db\Migration;

class m160124_125046_add_predefined_users extends Migration
{
    public function up()
    {
        $user = new \app\models\user\UserRecord();
        $user->username = 'user';
        $user->password = '12345';
        $user->save();

        $manager = new \app\models\user\UserRecord();
        $manager->username = 'manager';
        $manager->password = '12345';
        $manager->save();

        $admin = new \app\models\user\UserRecord();
        $admin->username = 'admin';
        $admin->password = '12345';
        $admin->save();
    }

    public function down()
    {
        $this->delete('user',['username' => ['user','manager','admin']]);
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
