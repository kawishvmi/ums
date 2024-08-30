<?php

use yii\db\Migration;

/**
 * Class m240829_091605_assign_roles
 */
class m240829_091605_assign_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Assign "admin" role to user with ID 1
        $auth->assign($auth->getRole('admin'), 1);

        // Assign "user" role to user with ID 2
        $auth->assign($auth->getRole('user'), 2);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        // Revoke roles during rollback
        $auth->revoke($auth->getRole('admin'), 1);
        $auth->revoke($auth->getRole('user'), 2);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240829_091605_assign_roles cannot be reverted.\n";

        return false;
    }
    */
}
