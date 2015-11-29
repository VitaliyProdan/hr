<?php
/* @var $this yii\web\View */
/* @var $category */
/* @var $pagination */
/* @var $posts */
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Пошук статтей: ';
Url::remember();
?>

<div id="content">

    <div class="section section-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($tags)):?>
                        <h1>Пошук за тегами</h1>

                        <div class="row">
                            <div class="col-md-12 tag-line">
                                <?php foreach ($tags as $tag): ?>
                                    <span class="label <?= in_array($tag->id, $ids)? 'label-primary' : 'label-default'?>
                        tag-item"> <?= Html::a($tag->title , ['add_tag', 'id' => $tag->id], ['class'=>'main-tags'])?></span>
                                <?php endforeach ?>

                            </div>
                        </div>
                    <?php else :?>
                        <h1><?= $category ?></h1>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>



    <div class="section">
        <div class="container">
            <?php if (!count($posts)):?>
                <div class="alert alert-warning" role="alert">
                    <strong>Нічого не знайдено!</strong>
                    По даній категорії ще не створено статтей. Повернутись до
                    <?= Html::a(' головної сторінки', ['/']) ?>

                </div>
            <?php endif ?>


            <?php foreach ($posts as $post): ?>

                <div class="row service-wrapper-row">
                    <div class="col-sm-4">
                        <div class="service-image">
                            <div class="background-img">
                                <?php echo $post->get_image(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><?= Html::a($post->title, ['view', 'id' => $post->id]) ?></h3>
                        <div class="post-content">
                            <?= mb_substr(strip_tags($post->content), 0, 601, "UTF-8"); ?>
                            <?php if(strlen(strip_tags($post->content))>601) echo '...'; ?>
                        </div>
                        <div class="post-tags">
                            <?php foreach ($post->tags as $tag): ?>
                                <span class="label label-primary tags"><?= Html::a($tag->title, ['tag', 'ids' => $tag->id],['class' => 'tag-link']) ?></span>
                            <?php endforeach ?>
                        </div>

                    </div>
                </div>
            <?php endforeach ?>

        </div>
        <div class="row pagination-row">
            <div class="col-md-12">
                <?=  \yii\widgets\LinkPager::widget([
                    'pagination' => $pagination,
                ]); ?>
            </div>
        </div>
    </div>

</div>
<div class="hidden" id="hidden-search-query">
    <?= isset($search_query)? trim($search_query) : '' ?>
</div>
<?php $this->registerJsFile('/js/custom.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>