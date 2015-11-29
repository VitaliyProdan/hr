<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= \vova07\imperavi\Widget::widget([
        //'selector' => '#my-textarea-id',
        'model' => $model,
        'attribute' => 'content',
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/post/image-upload']),
            'imageManagerJson' => Url::to(['/post/images-get']),
            'fileUpload' => Url::to(['/post/file-upload']),
            'fileManagerJson' => Url::to(['/post/files-get']),
            'plugins' => [
                'fullscreen',
                'filemanager',
                'imagemanager',
                'video'
            ]
        ]
    ]);;?>

    <?= $form->field($model, 'category_id')->dropDownList($model->categoryList()) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'featured')->checkbox() ?>

    <?= $form->field($model, 'tagIds')->checkboxList(ArrayHelper::map(\common\models\Tag::find()->all(), 'id', 'title')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
