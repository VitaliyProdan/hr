<?php
/* @var $this yii\web\View */
/* @var $lastPosts */
/* @var $featured */
/* @var $drafts */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Головна';
?>
<div class="site-index">

    <h1 class="by-center">Адмін панель</h1>
    <hr />
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row row-panel">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-list-alt dashboard-glyp"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $postsCount ?></div>
                                <div>Всього вакансій</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= Url::toRoute('post/index') ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Переглянути</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-green panel-heading">
                        <div class="row row-panel">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-bookmark dashboard-glyp"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $categoryCount ?></div>
                                <div>Всього напрямків</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= Url::toRoute('category/index') ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Переглянути</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-yellow panel-heading">
                        <div class="row row-panel">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-circle-arrow-up dashboard-glyp"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $mostPopularCategory->qty ?></div>
                                <div> Топ напрямок: <b><?= $mostPopularCategory->title ?></b></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= Url::toRoute(['./../posts/category', 'id' => $mostPopularCategory->id]) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Переглянути</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-red panel-heading">
                        <div class="row row-panel">
                            <div class="col-xs-3">
                                <i class="glyphicon glyphicon-tags dashboard-glyp"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $mostPopularTag->qty ?></div>
                                <div> Навички: <b><?= $mostPopularTag->title ?></b></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= Url::toRoute(['./../posts/tag', 'ids' => $mostPopularTag->id]) ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Переглянути</span>
                            <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Html::a('<h4><i class="glyphicon glyphicon-list-alt"></i> Останні вакансії</h4>', ['/post/index'])?>
                    </div>
                    <ul class="list-group">
                        <?php foreach($lastPosts as $post): ?>
                            <li class="list-group-item">
                                <?= Html::a($post->title , ['./../posts/view', 'id' => $post->id], ['target'=>'_blank'])?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Html::a('<h4><i class="glyphicon glyphicon-thumbs-up"></i> Термінові вакансії</h4>', ['/post/index'])?>
                    </div>
                    <ul class="list-group">
                        <?php foreach($featured as $post): ?>
                            <li class="list-group-item">
                                <?= Html::a($post->title , ['./../posts/view', 'id' => $post->id], ['target'=>'_blank'])?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Html::a('<h4><i class="glyphicon glyphicon-file"></i> Чернетки</h4>', ['/post/index'])?>
                    </div>
                    <ul class="list-group">
                        <?php foreach($drafts as $post): ?>
                            <li class="list-group-item">
                                <?= Html::a($post->title , ['./../posts/view', 'id' => $post->id], ['target'=>'_blank'])?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
