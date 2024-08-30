<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'User Details';
?>

<div class="container mt-5">
    <div class="user-details card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="fas fa-user"></i> <?= Html::encode($this->title) ?></h2>
        </div>
        <div class="card-body p-4">
            <dl class="row">
                <dt class="col-sm-4 text-end fw-bold">User ID:</dt>
                <dd class="col-sm-8"><?= Html::encode($user['id']) ?></dd>
                
                <dt class="col-sm-4 text-end fw-bold">Username:</dt>
                <dd class="col-sm-8"><?= Html::encode($user['username']) ?></dd>
                
                <dt class="col-sm-4 text-end fw-bold">Email Address:</dt>
                <dd class="col-sm-8"><?= Html::encode($user['email']) ?></dd>
                
                <dt class="col-sm-4 text-end fw-bold">Account Created:</dt>
                <dd class="col-sm-8"><?= Html::encode(date('F j, Y, g:i a', $user['created_at'])) ?></dd>
            </dl>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <?= Html::a('<i class="fas fa-edit"></i> Update Details', ['update', 'id' => $user['id']], ['class' => 'btn btn-outline-warning me-2 shadow-sm']) ?>
            <?= Html::a('<i class="fas fa-trash-alt"></i> Delete Account', ['delete', 'id' => $user['id']], [
                'class' => 'btn btn-outline-danger me-2 shadow-sm',
                'data' => [
                    'confirm' => 'Are you sure you want to permanently delete this user?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<i class="fas fa-list"></i> Back to User List', ['index'], ['class' => 'btn btn-outline-secondary shadow-sm']) ?>
        </div>
    </div>
</div>

<!-- CSS for Styling -->
<style>
    .user-details .card {
        border-radius: 10px;
        border: none;
    }
    .user-details .card-header {
        font-size: 1.5rem;
        font-weight: 700;
        padding: 1rem;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .user-details .card-body {
        background-color: #f8f9fa;
    }
    .user-details .row {
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .user-details dl dt {
        font-size: 0.95rem;
        color: #333;
    }
    .user-details dl dd {
        font-size: 1rem;
        color: #555;
    }
    .user-details .btn {
        font-size: 0.9rem;
        border-radius: 0.25rem;
        transition: all 0.3s;
    }
    .user-details .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }
    .user-details .btn-outline-warning:hover {
        background-color: #ffc107;
        color: white;
    }
    .user-details .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    .user-details .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
    .user-details .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    .user-details .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>
