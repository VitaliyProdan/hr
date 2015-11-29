<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Вхід</h1>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-md-5 center-block without-float">

                <div class="site-login">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <h4>Будьласка введіть наступні дані для входу:</h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->field($model, 'username') ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div style="color:#999;margin:1em 0">
                                Якщо ви забули пароль ви можете <?= Html::a('відновити його', ['site/request-password-reset']) ?>.
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('Вхід', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

