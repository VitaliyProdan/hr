<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Професії';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати сторінку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'category_id' => [
                'attribute' => 'category_id',
                'format' => 'text',
                'label' => 'Напрям',
                'value' => function ($model) {
                    return $model->category->title;
                },
            ],
            'created_at' =>[
                'format' => ['date', 'php:d.m.Y h:i:s'],
                'attribute' => 'created_at',

            ],
            'created_by' => [
                'attribute' => 'created_by',
                'format' => 'text',
                'label' => 'Створив',
                'value' => function ($model) {
                    return $model->user->username;
                },
            ],
            'active' => [
                'attribute' => 'active',
                'format' => 'html',
                'label' => 'Активна',
                'value' => function ($model) {
                    return $model->active? '<i class="glyphicon glyphicon-check"></i>' : '<i class="glyphicon glyphicon-unchecked"></i>';
                },
            ],

            'featured' => [
                'attribute' => 'featured',
                'format' => 'html',
                'label' => 'Свіжа',
                'value' => function ($model) {
                    return $model->featured? '<i class="glyphicon glyphicon-check"></i>' : '<i class="glyphicon glyphicon-unchecked"></i>';
                },
            ],


            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => \yii\grid\ActionColumn::className(),
                'buttons'=>[
                    'find_workers'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['post/find_workers','id'=>$model['id']]); //$model->id для AR
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-search"></span>', $customurl,
                            ['title' => 'Знайти працівників', 'data-pjax' => '0']);
                    }
                ],
                'template'=>'{find_workers}{view}{update}{delete}',
            ]

        ],
    ]); ?>

</div>
