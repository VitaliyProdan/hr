<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['site_name'].' | '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <div class="mainmenu-wrapper">
            <div class="container">
                <nav id="mainmenu" class="mainmenu">
                    <ul>

                        <li class="logo-wrapper"><a href="/"><img id="menu-logo" src="/images/logo.png" alt="Лабораторія кафедри КМДіП"></a></li>

                        <?php $menuItems = \common\models\Category::get_menu(); ?>
                        <?php echo Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-left menu-items'],
                            'items' => $menuItems,
                            'encodeLabels' => false,
                        ]); ?>
                    </ul>
                </nav>
                <div class="col-md-2 pull-right">
                    <form action="<?=  Url::toRoute(['/posts/search']);?>" method="post" name="Search">
                        <div class="input-group">
                            <input class="form-control input-md" name="query" type="text" id="top-search" value="<?= isset($search_query)? trim($search_query) : '' ?>">
								<span class="input-group-btn">
									<button class="btn btn-md glyphicon glyphicon-search" type="submit"></button>
								</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<!--        <div class="container">-->
         <!-- HERE was content-->
<!--        </div>-->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>



    <div class="footer">
        <div class="container">
            <div class="row footer-row">
                <div class="col-footer col-md-3 col-xs-6">
                    <h3>Посилання</h3>
                    <div class="portfolio-item">
                        <div class="portfolio-image">
                            <a href="http://pntu.edu.ua"><img src="/images/logos/pntu.png" alt="ПолтНТУ"></a>
                        </div>
                    </div>
                </div>
                <?php $active_menu = \common\models\Category::get_active(); ?>
                <div class="col-footer col-md-3 col-xs-6">
                    <h3>Навігація</h3>
                    <ul class="no-list-style footer-navigate-section">
                        <?php foreach($active_menu as $v): ?>
                            <li><a href="<?=  Url::toRoute(['/posts/category', 'id' => $v->id]); ?>"><?= $v->title ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>

                <div class="col-footer col-md-4 col-xs-6">
                    <h3>Контакти</h3>
                    <p class="contact-us-details">
                        <b>Адреса:</b> Першотравневий проспект, 24, Полтава, Полтавська область, 36000 <br/>
                        <b>Телефон:</b> +380 50 148 01 02 <br/>
                        <b>Email:</b> <a href="mailto:<?= Yii::$app->params['adminEmail'] ?>"><?= Yii::$app->params['adminEmail'] ?></a>
                    </p>
                </div>
                <div class="col-footer col-md-2 col-xs-6">
                    <h3>Ми в соц. мережах</h3>
                    <ul class="no-list-style footer-social">
                        <li> <a href="#" class="vk"></a></li>
                        <li> <a href="#" class="fb"></a></li>
                        <li> <a href="#" class="twitter-icon"></a></li>



                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-copyright">&copy; <?= date('Y') ?> ПолтНТУ. Всі права захищені</div>
                    <small class="pull-right developed-by">developed by <a href="#">Рак Богдан</a></small>
                    <small class="pull-right developed-by"><?= Yii::powered() ?></small>
                </div>
            </div>
        </div>
    </div>






    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
