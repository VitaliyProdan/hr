<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$header = "Зворотний зв'язок";
//$this->title = Yii::$app->params['site_name'].$header ;
//$this->params['breadcrumbs'][] = $header;

?>
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $header ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="site-contact">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <!-- Map -->
                    <div id="contact-us-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2587.084373519192!2d34.566823816671764!3d49.577297382619065!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x383ec59c65673f02!2z0J_QndCi0KMg0LjQvC4g0K4u0JrQvtC90LTRgNCw0YLRjtC60LA!5e0!3m2!1sru!2sua!4v1428874861190" width="653" height="300" frameborder="0" style="border:0"></iframe>
                    </div>
                    <!-- End Map -->
                    <!-- Contact Info -->
                    <p class="contact-us-details">
                        <b>Адреса:</b> Першотравневий проспект, 24, Полтава, Полтавська область, 36000 <br/>
                        <b>Телефон:</b> +380 50 148 01 02 <br/>
                        <b>Email:</b> <a href="mailto:<?= Yii::$app->params['adminEmail'] ?>"><?= Yii::$app->params['adminEmail'] ?></a>
                    </p>
                    <!-- End Contact Info -->
                </div>
                <div class="col-sm-5">
                    <!-- Contact Form -->
                    <h3>Напишіть нам листа</h3>
                    <div class="contact-form-wrapper">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                        <?= $form->field($model, 'name') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'subject') ?>
                        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3 captcha">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>
                        <div class="form-group">
                            <?= Html::submitButton('Відіслати', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <!-- End Contact Info -->
                </div>
            </div>
        </div>
    </div>

</div>
