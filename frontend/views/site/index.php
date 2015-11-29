<?php
/* @var $this yii\web\View */
/* @var $slides */
/* @var $featured */

use yii\helpers\Html;

$this->title = 'Головна';
?>
<div class="homepage-slider">
    <div id="sequence">

        <ul class="sequence-canvas">
            <?php foreach($slides as $v):?>
            <!-- Slide -->
            <li class="bg<?=$v->id ?>">
                <!-- Slide Title -->
                <h2 class="title"><?= $v->title ?></h2>
                <!-- Slide Text -->
                <h3 class="subtitle">
                    <?= $v->text ?>
                </h3>
                <!-- Slide Image -->
               <?=  Html::img($v->image, ['class'=>'slide-img']);  ?>
            </li>
            <?php endforeach ?>
        </ul>
        <div class="sequence-pagination-wrapper">
            <ul class="sequence-pagination">
                <?php foreach($slides as $v):?>
                    <li><?=$v->id ?></li>
                <?php endforeach ?>
            </ul>
        </div>

    </div>
</div>
    <!--<div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="in-press press-wired">
                        <a href="#">Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="in-press press-mashable">
                        <a href="#">Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="in-press press-techcrunch">
                        <a href="#">Morbi eleifend congue elit nec sagittis. Praesent aliquam lobortis tellus, nec consequat vitae</a>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Press Coverage -->

    <!-- Services -->
    <div class="section">
        <div class="container">


            <div class="row">
                <?php foreach ($featured as $post): ?>
                <?php $div_class = (count($featured) % 3 == 1 && $post === end($featured)) ? 'col-md-offset-4' : ''; ?>
                <div class="col-md-4 col-sm-6 <?=$div_class?>">
                    <div class="service-wrapper">
                        <?= $post->get_image() ?>
                        <h3><?= $post->title ?></h3>
                        <p>
                            <?= mb_substr(strip_tags($post->content), 0, 50, "UTF-8"); ?>
                            <?php if(strlen(strip_tags($post->content))>50) echo '...'; ?>
                        </p>
                        <?= Html::a('Читати', ['/posts/view', 'id' => $post->id],['class' => 'btn']) ?>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
