<?php

namespace tests\unit\models;

use app\models\LoginForm;

use Codeception\Test\Unit;
use Yii;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $model;

    protected function _after()
    {
        \Yii::$app->user->logout();
    }

    public function testLoginNoUser()
    {
        $this->model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        verify($this->model->login())->false();
        verify(\Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $this->model = new LoginForm([
            'username' => 'demo',
            'password' => 'wrong_password',
        ]);

        verify($this->model->login())->false();
        verify(\Yii::$app->user->isGuest)->true();
        verify($this->model->errors)->arrayHasKey('password');
    }

    public function testLoginCorrect()
    {
        $this->model = new LoginForm([
            'username' => 'demo',
            'password' => 'demo',
        ]);

        verify($this->model->login())->true();
        verify(\Yii::$app->user->isGuest)->false();
        verify($this->model->errors)->arrayHasNotKey('password');
    }

    public function testLoginWithValidCredentials()
    {
        $model = new LoginForm();
        $model->username = 'validUser';
        $model->password = 'validPassword';

        $this->assertTrue($model->login());
    }

    public function testLoginWithInvalidCredentials()
    {
        $model = new LoginForm();
        $model->username = 'invalidUser';
        $model->password = 'invalidPassword';

        $this->assertFalse($model->login());
    }

}
