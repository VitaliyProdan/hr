<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Редагування профілю: ' . ' ' . $model->username;
//$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
//$this->params['breadcrumbs'][] = 'Редагування';
?>
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $this->title ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="site-contact">
    <div class="section">
        <div class="container">
            <div class="row">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>


<h1><?//= Html::encode($this->title) ?></h1>
