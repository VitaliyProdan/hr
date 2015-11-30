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
                <div class="col-md-12">
                    <h1 class="text-by-center">Відділ кадрів</h1>
                    <p class="index-text">
                        Відділ кадрів є самостійним структурним підрозділом, підпорядкованим ректору Університету.
                        Відділ кадрів у своїй діяльності керується чинним законодавством, статутом Університету,
                        правилами внутрішнього розпорядку, правилами і стандартами документаційного забезпечення,
                        іншими нормативними і локальними документами Університету, розпорядженнями ректора та
                        Положенням про відділ кадрів ПНТУ ім. Юрія Кондратюка.
                        Відділ кадрів очолює начальник відділу, який призначається і звільняється ректором.
                        Відділ кадрів має свою круглу печатку із зазначенням своєї назви та назви установи і штампи,
                        необхідні для роботи. </p>
                    <p  class="index-text">Основними завданнями відділу кадрів є:</p>
                        <ul  class="index-text">
                            <li>
                                забезпечення Університету згідно із штатним розписом необхідною кількістю працівників
                                відповідної кваліфікації;
                            </li>
                            <li>
                                оформлення прийняття, прийому, переведення, переміщення і звільнення працівників
                                університету, облік відпусток працівників університету і здійснення контролю за їх наданням;
                            </li>
                            <li>
                                організація обліку і звітності з особового складу, робота з особовими справами студентів;
                            </li>
                            <li>
                                організація і забезпечення діяльності працівників, які виконують кадрову роботу у
                                відокремлених структурних підрозділах Університету, надання їм методичної допомоги;
                            </li>
                            <li>
                                забезпечення прав, пільг і соціальних гарантій працівників університету.
                            </li>
                        </ul>
                </div>
            </div>
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
