<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tag */

$this->title = 'Редагування навички: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Навички', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
