<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create User';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="mb-0"><?= Html::encode($this->title) ?></h2>
                </div>
                <div class="card-body p-4">
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'needs-validation', 'novalidate' => true],
                        'fieldConfig' => [
                            'template' => "<div class=\"mb-3\">\n{label}\n{input}\n{error}</div>",
                            'labelOptions' => ['class' => 'form-label fw-bold'],
                        ],
                    ]); ?>

                    <!-- Username Field -->
                    <?= $form->field($model, 'username')->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter username',
                        'class' => 'form-control shadow-sm'
                    ]) ?>

                    <!-- Email Field -->
                    <?= $form->field($model, 'email')->textInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter email',
                        'class' => 'form-control shadow-sm'
                    ]) ?>

                    <!-- Password Field -->
                    <?= $form->field($model, 'password')->passwordInput([
                        'maxlength' => true, 
                        'placeholder' => 'Enter password',
                        'class' => 'form-control shadow-sm'
                    ]) ?>

                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <?= Html::submitButton('<i class="fas fa-user-plus"></i> Create', [
                            'class' => 'btn btn-primary btn-lg w-100 shadow-sm'
                        ]) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inline CSS for Styling -->
<style>
    .card {
        border-radius: 12px;
        border: none;
    }
    .card-header {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .form-label {
        font-size: 0.9rem;
    }
    .form-control {
        border-radius: 5px;
        padding: 10px;
        box-shadow: none;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>

<!-- JavaScript for Form Validation -->
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
