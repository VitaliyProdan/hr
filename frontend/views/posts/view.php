<?php
/* @var $this yii\web\View */
/* @var $post */
/* @var $search_query */
?>

<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php
$this->title = $post->title;
$this->registerMetaTag(['name' => 'og:title', 'content' => $post->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => strip_tags($post->content)]);
?>


<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $post->title  ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <!-- Blog Post -->
            <div class="col-sm-8">
                <div class="blog-post blog-single-post">
                    <div class="single-post-title">
                        <h3><?= $post->title  ?></h3>
                    </div>
                    <div class="single-post-info">
                        <i class="glyphicon glyphicon-time"></i><?= date('d.m.Y', $post->created_at)  ?>
                    </div>

                    <div class="single-post-content">
                        <?= $post->content ?>
                    </div>

                    <div class="post-coments">
                        <?=
                        \ijackua\sharelinks\ShareLinks::widget(
                            [
                                'viewName' => '@app/views/layouts/shareLinks.php'   //custom view file for you links appearance
                            ]
                        );
                        ?>
                    </div>

                </div>
            </div>
            <!-- End Blog Post -->
            <!-- Sidebar -->
            <div class="col-sm-4 blog-sidebar">
                <h4>Пошук статті</h4>
                <form action="<?=  Url::toRoute(['/posts/search']);?>" method="post" name="Search">
                    <div class="input-group">
                        <input  name="query" class="form-control input-md" id="appendedInputButtons" type="text" value="">
                        <span class="input-group-btn">
                            <button class="btn btn-md" type="submit">Пошук</button>
                        </span>
                    </div>
                </form>
                <h4>Останні статті</h4>
                <ul class="recent-posts">
                    <?php foreach (\common\models\Post::recent_post() as $v): ?>
                        <li><?= Html::a($v->title, ['view', 'id' => $v->id]) ?></li>
                    <?php endforeach ?>
                </ul>
                <h4>Теги</h4>
                <ul class="tag-list">
                    <?php foreach ($post->tags as $tag): ?>
                        <li>
                            <span class="label label-primary tags"><?= Html::a($tag->title, ['tag', 'ids' => $tag->id],['class' => 'tag-link']) ?></span>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>

            <!-- End Sidebar -->
        </div>

    </div>
</div>
