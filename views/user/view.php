<?php
use yii\helpers\Html;
?>

<h1>User Details</h1>

<p>ID: <?= Html::encode($user['id']) ?></p>
<p>Username: <?= Html::encode($user['username']) ?></p>
<p>Email: <?= Html::encode($user['email']) ?></p>
<p>Created At: <?= Html::encode(date('Y-m-d H:i:s', $user['created_at'])) ?></p>

<p>
    <?= Html::a('Update', ['update', 'id' => $user['id']], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $user['id']], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('Back to List', ['index'], ['class' => 'btn btn-default']) ?>
</p>
