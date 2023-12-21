<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com',
        'https://fonts.gstatic.com',
        'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap',
        'https://use.fontawesome.com/releases/v5.15.4/css/all.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
        'lib/lightbox/css/lightbox.min.css',
        'lib/owlcarousel/assets/owl.carousel.min.css',
        'css/bootstrap.min.css',
        'css/style.css',
        'css/site.css',
    ];
    public $js = [
        /* 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js',*/
        'https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js',
        'lib/easing/easing.min.js',
        'lib/waypoints/waypoints.min.js',
        'lib/lightbox/js/lightbox.min.js',
        'lib/owlcarousel/owl.carousel.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
