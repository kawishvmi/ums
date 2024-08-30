<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';

?>

<div class="site-login d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f4f5f7;">
    <div class="card shadow-lg animate__animated animate__fadeInUp" style="width: 400px; border-radius: 12px;">
        <div class="card-body">
            <?php if (Yii::$app->user->isGuest): ?>
                <!-- Welcoming Header -->
                <div class="text-center mb-4">
                    <h1 class="welcome-header">Welcome to UMS by Kawish</h1>
                </div>

                <h2 class="card-title text-center mb-3"><?= Html::encode($this->title) ?></h2>
                <p class="text-center text-muted mb-4">Sign in to your account</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'action' => ['site/login'],
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "<div class=\"input-group mb-3\">\n{input}\n<div class=\"input-group-append\"><div class=\"input-group-text\"><i class=\"fas fa-user\"></i></div></div>\n</div>{error}",
                    ],
                ]); ?>

                <?= $form->field($model, 'username', [
                    'inputOptions' => [
                        'class' => 'form-control',
                        'placeholder' => 'Username',
                    ],
                ])->label(false) ?>

                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'class' => 'form-control',
                        'placeholder' => 'Password',
                    ],
                    'template' => "<div class=\"input-group mb-3\">\n{input}\n<div class=\"input-group-append\"><div class=\"input-group-text\"><i class=\"fas fa-lock\"></i></div></div>\n</div>{error}",
                ])->passwordInput()->label(false) ?>

                <div class="form-group mb-3">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-lg shadow-sm', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            <?php else: ?>
                <?php
                $auth = Yii::$app->authManager;
                $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
                $role = key($roles); // Get the first role

                // Define role-based icons and URLs
                $roleIcons = [
                    'admin' => 'fas fa-user-shield',
                    'user' => 'fas fa-user',
                ];

                $dashboardUrls = [
                    'admin' => Url::to(['admin/profile']),
                    'user' => Url::to(['user/profile']),
                ];

                $iconClass = $roleIcons[$role] ?? 'fas fa-user';
                $dashboardUrl = $dashboardUrls[$role] ?? Url::to(['user/profile']);
                ?>
                <div class="text-center animate__animated animate__fadeIn">
                    <i class="<?= $iconClass ?> fa-3x text-primary mb-3"></i>
                    <h2 class="card-title text-center">You are logged in as a <?= Html::encode(ucfirst($role)) ?></h2>
                    <p class="text-center text-muted">What would you like to do next?</p>
                    <div class="form-group mb-2">
                        <?= Html::a('Go to Dashboard', $dashboardUrl, ['class' => 'btn btn-primary btn-block btn-lg shadow-sm']) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::a('Logout', Url::to(['site/logout']), [
                            'class' => 'btn btn-danger btn-block btn-lg shadow-sm',
                            'data-method' => 'post'
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* Card Styling */
    .site-login .card {
        background: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .site-login .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Header Styling */
    .site-login .welcome-header {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 2.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .site-login .card-title {
        font-size: 1.7rem;
        font-weight: bold;
    }

    /* Input and Button Styling */
    .site-login .form-control {
        border-radius: 0;
        transition: box-shadow 0.3s, transform 0.3s;
    }

    .site-login .form-control:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        border-color: #007bff;
    }

    .site-login .input-group-text {
        background-color: #e9ecef;
        border-left: 0;
    }

    .site-login .btn-primary, .site-login .btn-danger {
        border-radius: 8px;
        font-size: 1rem;
        transition: background-color 0.3s, transform 0.3s;
    }

    .site-login .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .site-login .btn-danger:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    /* Animations */
    .site-login .animate__animated.animate__fadeIn {
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    .site-login .animate__animated.animate__fadeInUp {
        animation-duration: 0.8s;
        animation-fill-mode: both;
    }
</style>
