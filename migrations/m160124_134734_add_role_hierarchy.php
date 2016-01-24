<?php

use yii\db\Schema;
use yii\db\Migration;

class m160124_134734_add_role_hierarchy extends Migration
{
    public function up()
    {
        $rbac = Yii::$app->authManager;

        $guest = $rbac->createRole('guest');
        $guest->description = 'Nobody';
        $rbac->add($guest);

        $user = $rbac->createRole('user');
        $user->description = 'Can use the query UI and nothing else';
        $rbac->add($user);

        $manager = $rbac->createRole('manager');
        $manager->description = 'Can manage entities in database but not users';
        $rbac->add($manager);

        $admin = $rbac->createRole('admin');
        $admin->description = 'Can do anything including manging users';
        $rbac->add($admin);

        $rbac->addChild($admin,$manager);
        $rbac->addChild($manager,$user);
        $rbac->addChild($user,$guest);

        $rbac->assign($user, \app\models\user\UserRecord::findOne(['username' => 'user'])->id);
        $rbac->assign($manager, \app\models\user\UserRecord::findOne(['username' => 'manager'])->id);
        $rbac->assign($admin, \app\models\user\UserRecord::findOne(['username' => 'admin'])->id);
    }

    public function down()
    {
        $manager = Yii::$app->authManager;
        $manager->removeAll();
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
