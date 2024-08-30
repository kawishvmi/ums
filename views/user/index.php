<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'User Management';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',
        'email',
        'created_at:datetime',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

