<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Profile';

?>

<div class="container mt-5">
    <div class="profile-card card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-user-circle"></i> <?= Html::encode($this->title) ?></h2>
        </div>
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <p class="mt-2"><i class="fas fa-envelope"></i> <?= Html::encode($model->email) ?></p>
            </div>

            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate' => true],
                'fieldConfig' => [
                    'template' => "<div class=\"form-group mb-3\">\n{label}\n{input}\n{error}</div>",
                    'labelOptions' => ['class' => 'form-label fw-bold'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Enter your username']) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Enter your email']) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Enter a new password if you want to change it']) ?>


            <div class="form-group mt-4 d-flex justify-content-between">
                <?= Html::submitButton('<i class="fas fa-save"></i> Update Profile', ['class' => 'btn btn-success shadow-sm']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- CSS for Styling -->
<style>
    .profile-card .card {
        border-radius: 10px;
        border: none;
    }
    .profile-card .card-header {
        font-size: 1.5rem;
        font-weight: 700;
        padding: 1rem;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .form-label {
        font-size: 1rem;
        color: #333;
    }
    .form-control {
        border-radius: 0.25rem;
        box-shadow: none;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
    .btn {
        font-size: 0.9rem;
        border-radius: 0.25rem;
        transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    .text-center p {
        color: #555;
        font-size: 1rem;
    }
</style>

<!-- Inline JavaScript for Form Validation -->
<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
