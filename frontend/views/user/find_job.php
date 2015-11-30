<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\helpers\Utils;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $posts common\models\Post */

$this->title = 'Знайти вакансію';
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
<div class="post-find-job">
    <div class="section">
        <div class="container">
            <h3>Пошук: <?= Html::encode($user->category->title) ?></h3>
            <h4><i>Користувач: <?= Html::encode($user->fullName) ?></i></h4>
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="thumbnail">
                        <img src="<?= $user->photoUrl ?>" title="<?= $model->username ?>" />
                    </div>
                </div>
                <div class="col-md-12 vertical-border">
                    <h3>Варіанти працевлаштування</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (count($posts) == 0): ?>
                        <div class="alert alert-warning" role="alert">
                            Для Вас не знайдено підходящих професій. Спробуйте пізніше
                        </div>
                    <?php else: ?>
                        <?php foreach($posts as $k => $post): ?>
                            <div class="panel panel-default find-job-panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <?= Html::a($post->title, ['/posts/view', 'id' => $post->id]) ?>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="<?= Url::toRoute(['/posts/view', 'id' => $post->id]) ?>" class="thumbnail" target="_blank">
                                                <?php echo $post->get_image(); ?>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <p><?=$post->truncateContent(300) ?></p>
                                        </div>
                                        <div class="col-md-5 job-progress">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-<?= Utils::progressColor($post->percents) ?>" role="progressbar"
                                                     aria-valuenow="<?= $post->percents ?>" aria-valuemin="0" aria-valuemax="100"
                                                     style="width: <?= $post->percents ?>%" >
                                                    <?= $post->percents ?>%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="post-tags">
                                                <?php foreach ($post->tags as $tag): ?>
                                                    <span class="label label-primary tags"><?= Html::a($tag->title, ['tag', 'ids' => $tag->id],['class' => 'tag-link']) ?></span>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
</div>