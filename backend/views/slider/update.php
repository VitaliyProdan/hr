<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = 'Редагування слайду: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Слайди', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагувати';
?>
<div class="slider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
