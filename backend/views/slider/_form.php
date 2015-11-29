<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => $model->image ? [
            'initialPreview'=>[
                Html::img($model->image, ['class' => 'file-preview-image'])
            ],
            'overwriteInitial'=>true
        ]: []
    ]); ?>

    <?= $form->field($model, 'upload_background')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => $model->background ?  [
            'initialPreview'=>[
                Html::img($model->background, ['class' => 'file-preview-image'])
            ],
            'overwriteInitial'=>true
        ]: []
    ]); ?>
    <p class="input-description">Для фонового зображення необхідний .jpg формат</p>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
