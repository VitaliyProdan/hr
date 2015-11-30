<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Профіль '. $model->fullName;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
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
                <p>
                    <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary pull-right']) ?>
                </p>
                <div class="row">
                    <div class="col-sm-3 col-md-3">
                        <div class="thumbnail">
<!--                            <div class="caption">-->
<!--                                <h4 class="text-by-center">--><?//= $model->username ?><!--</h4>-->
<!--                            </div>-->
                            <img src="<?= $model->photoUrl ?>" title="<?= $model->username ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="user-info">
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="user-field-name">Ім'я:</span>
                            <?= $model->first_name ?>
                        </p>
                        <p class="user-info">
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="user-field-name">Прізвище:</span>
                            <?= $model->last_name ?>
                        </p>
                        <p class="user-info">
                            <span class="glyphicon glyphicon-phone"></span>
                            <span class="user-field-name">Телефон:</span>
                            <?= $model->phone?>
                        </p>
                        <p class="user-info">
                            <span class=" glyphicon glyphicon-envelope"></span>
                            <span class="user-field-name">email:</span>
                            <?= $model->email ?>
                        </p>
                        <p class="user-info">
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <span class="user-field-name">Місто:</span>
                            <?= $model->city ?>
                        </p>
                        <p class="user-info">
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <span class="user-field-name">Адреса:</span>
                            <?= $model->address ?>
                        </p>
                        <p class="user-info">
                            <span class="glyphicon glyphicon-calendar"></span>
                            <span class="user-field-name">Дата народження:</span>
                            <?= $model->date_of_birth ?>
                        </p>
                        <p class="user-info">
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="user-field-name">Стать:</span>
                            <?= $model->genderDropDown()[$model->gender]?>
                        </p>
                        <p class="user-info">
                            <span class="glyphicon glyphicon-time"></span>
                            <span class="user-field-name">Учасник з:</span>
                            <?= date('d.m.Y',$model->created_at) ?>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h3 class="inline">Спеціалінсть: </h3>
                        <p class="user-info inline"><?= $model->category->title ?></p>
                        <h3 class="skills">Навички</h3>
                        <?php foreach ($model->tags as $tag): ?>
                          <p class="user-info"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <?= $tag->title ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-7 about-section">
                    <p class="user-info">
                        <span class=" glyphicon glyphicon-pencil"></span>
                        <span class="user-field-name">Про себе:</span>
                        <?= $model->about ?>
                    </p>
                </div>
                <div class="col-md-12 find-job">
                    <?=  Html::a('Знайти вакансію', ['user/find_job', 'id' => $model->id], ['class' => 'find-job-link btn btn-primary btn-lg'])  ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
//            'email:email',
//            'status',
//            'created_at',
//            'updated_at',
//            'first_name',
//            'last_name',
//            'date_of_birth',
//            'photo',
//            'role',
//            'about',
//            'gender',
//            'city',
//            'phone',
//            'address',
//        ],
//    ]) ?>
