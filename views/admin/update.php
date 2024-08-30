<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update User';
?>

<div class="container mt-5">
    <div class="update-user card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-edit"></i> <?= Html::encode($this->title) ?></h2>
        </div>
        <div class="card-body p-4">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'needs-validation', 'novalidate' => true],
                'fieldConfig' => [
                    'template' => "<div class=\"form-group mb-3\">\n{label}\n{input}\n{error}</div>",
                    'labelOptions' => ['class' => 'form-label fw-bold'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Enter username']) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Enter email']) ?>

            <!-- Hidden Field for Timestamp -->
            <?= $form->field($model, 'created_at')->hiddenInput(['value' => time()])->label(false) ?>

            <div class="form-group mt-4 d-flex justify-content-between">
                <?= Html::submitButton('<i class="fas fa-save"></i> Save Changes', ['class' => 'btn btn-success shadow-sm']) ?>
                <?= Html::a('<i class="fas fa-times-circle"></i> Cancel', ['view', 'id' => $model['id']], ['class' => 'btn btn-secondary shadow-sm']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- CSS for Styling -->
<style>
    .update-user .card {
        border-radius: 10px;
        border: none;
    }
    .update-user .card-header {
        font-size: 1.5rem;
        font-weight: 700;
        padding: 1rem;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .update-user .card-body {
        background-color: #f8f9fa;
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
