<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Напрями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити напрям', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'parent_id' => [
                'attribute' => 'parent_id',
                'format' => 'text',
                'label' => 'Напрям верхнього рівня',
                'value' => function ($model) {
                    return $model->parent_id? $model->parent->title : '';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
