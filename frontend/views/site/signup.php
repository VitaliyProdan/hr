<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Реєстрація</h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-5 center-block without-float">
                <div class="site-signup">

                    <h4>Введіть дані для реєстрації:</h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field($model, 'username') ?>

                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <div class="form-group">
                                <?= Html::submitButton('Готово', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




