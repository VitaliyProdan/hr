<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tag */

$this->title = 'Створити навичку';
$this->params['breadcrumbs'][] = ['label' => 'Навички', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
