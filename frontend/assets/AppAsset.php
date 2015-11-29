<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap-theme.min.css',
        'css/coming-soon-social.css',
        'css/icomoon-social.css',
        'css/leaflet.css',
        'css/leaflet.ie.css',
        'css/main-green.css',
        'font-awesome/css/font-awesome.min.css'

    ];
    public $js = [
        'js/jquery.bxslider.js',
        'js/jquery.fitvids.js',
        'js/jquery.sequence.js',
        'js/jquery.sequence-min.js',
        'js/main-menu.js',
        'js/modernizr-2.6.2-respond-1.1.0.min.js',
        'js/template.js',
        'js/fileinput.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
