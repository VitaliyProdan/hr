<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

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
        <?php
            NavBar::begin([
                'brandLabel' => '<i class="glyphicon glyphicon-briefcase"></i> ' . Yii::$app->params['site_name'],
                'brandUrl' => '/',
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '<i class="glyphicon glyphicon-log-in"></i> Логін', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => '<i class="glyphicon glyphicon-log-out"></i> Вихід (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
                array_unshift($menuItems,
                    ['label' => '<i class="glyphicon glyphicon-home"></i> Головна', 'url' => ['/site/index']],
                    ['label' => '<i class="glyphicon glyphicon-user"></i> Користувачі', 'url' => ['/user/index']],
                    ['label' => '<i class="glyphicon glyphicon-bookmark"></i> Напрями', 'url' => ['/category/index']],
                    ['label' => '<i class="glyphicon glyphicon-list-alt"></i> Вакансії', 'url' => ['/post/index']],
                    ['label' => '<i class="glyphicon glyphicon-education"></i> Навички', 'url' => ['/tag/index']],
                    ['label' => '<i class="glyphicon glyphicon-film"></i> Слайдер', 'url' => ['/slider/index']]
                );
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; ПолтНТУ <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
