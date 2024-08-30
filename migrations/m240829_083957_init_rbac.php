<?php

use yii\db\Migration;

/**
 * Class m240829_083957_init_rbac
 */
class m240829_083957_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Create roles
        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        $userRole = $auth->createRole('user');
        $auth->add($userRole);

        // Create permissions
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Manage users';
        $auth->add($manageUsers);

        // Assign permissions to roles
        $auth->addChild($adminRole, $manageUsers);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); // Remove all roles and permissions
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240829_083957_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
