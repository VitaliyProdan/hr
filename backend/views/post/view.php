<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Вакансії', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('Переглянути на клієнтській частині' , ['./../posts/view', 'id' => $model->id], ['target'=>'_blank'])?>
    <p class="post-view-buttons">
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити цей елемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            [
                'label' => 'Напрям',
                'value' => $model->category->title,
            ],
            [
                'label' => 'Дата створення',
                'value' => date('d.m.Y h:i:s',$model->created_at)
            ],
            [
                'label' => 'Активна',
                'value' => $model->active? 'Так' : 'Ні'
            ],
            [
                'label' => 'Свіжа',
                'value' => $model->featured? 'Так' : 'Ні'
            ],
            [
                'label' => 'Створив',
                'value' => $model->user->username
            ],
        ],
    ]) ?>

</div>
