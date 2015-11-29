<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $post common\models\Post */
/* @var $users common\models\User */

$this->title = $post->title;
$this->params['breadcrumbs'][] = ['label' => 'Пошук працівника', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-find-worker">

    <h3><?= Html::encode($this->title) ?></h3>
    <h4><i>Напрям: <?= Html::encode($post->category->title) ?></i></h4>

    <?= Html::a('Переглянути на клієнтській частині' , ['./../posts/view', 'id' => $post->id], ['target'=>'_blank'])?>
    <p><?= $post->content ?></p>
    <hr />
    <h3>Кандидати</h3>
    <hr />

    <?php if (count($users) == 0): ?>
        <div class="alert alert-warning" role="alert">
            Для даної професії не знайдено жодного працівника.
        </div>
    <?php else: ?>
        <?php foreach($users as $k => $user): ?>
<!--            <div class="well --><?//= $k %2 == 0?: 'white-bg' ?><!--">-->
            <div class="panel panel-default find-worker-panel" data-href="<?= Url::toRoute(['./../user/view', 'id' => $user->id]) ?>">
                <div class="panel-heading">
                    <h3 class="panel-title"> <?= $user->first_name .' '. $user->last_name ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="<?=$user->backendPhotoUrl ?>" class="thumbnail" target="_blank">
                                <img src="<?=$user->backendPhotoUrl ?>" alt="<?= $user->username ?>" class="photo">
                            </a>
                            <p class="text-by-center"><?=$user->phone ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><?=$user->city ?></p>
                            <p><?=$user->address ?></p>
                            <p><?=$user->yearOfBirth ?> р. народження</p>
                            <p><?=$user->email ?></p>
                            <p>На сайті з <?= date('d.m.Y',$user->created_at) ?></p>
                        </div>
                        <div class="col-md-5 user-progress">
                            <div class="progress">
                                <div class="progress-bar progress-bar-<?= $user->progressColor ?> progress-bar-striped" role="progressbar"
                                     aria-valuenow="<?= $user->percents ?>" aria-valuemin="0" aria-valuemax="100"
                                     style="width: <?= $user->percents ?>%" >
                                    <?= $user->percents ?>%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--            </div>-->
        <?php endforeach; ?>
    <?php endif ?>
</div>
<?php
$this->registerJs(
    '$(".find-worker-panel").click(function(){
        window.location.href = $(this).attr("data-href");
    });'
);
?>
