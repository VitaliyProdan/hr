<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?//= $form->field($model, 'status')->textInput() ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview'=> $model->photo ? [
                        Html::img($model->photoUrl, ['class'=>'file-preview-image', 'alt' => $model->username, 'title' => $model->username]),
                    ]  : false,
                    'showUpload' => false,
                    'allowedFileExtensions'=> ['jpg', 'gif', 'png', 'bmp'],
                ]
            ]);?>
            <?= $form->field($model, 'category_id')->dropDownList($model->categoryList()) ?>
            <?= $form->field($model, 'tagIds')->checkboxList(ArrayHelper::map(\common\models\Tag::find()->all(), 'id', 'title')) ?>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'first_name')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'last_name')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'date_of_birth')->textInput(['maxlength' => 10]) ?>
                    <small class="input-help-text">У форматі дд.мм.рррр</small>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'gender')->dropDownList($model->genderDropDown()); ?>
                </div>
            </div>
            <?= $form->field($model, 'city')->textInput() ?>
            <?= $form->field($model, 'address')->textInput() ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => 10]) ?>
            <small class="input-help-text">*Без +38</small>
            <?= $form->field($model, 'about')->textarea(['rows' => 10]) ?>
        </div>
    </div>
    <?= $form->field($model, 'image_is_removed')->hiddenInput(['value'=> $model->image_is_removed])->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
