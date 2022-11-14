<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetLanding extends AssetBundle
{
     

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    'page/landing/css/bootstrap.min.css',
    'page/landing/css/animate.css',
    'page/landing/css/magnific-popup.css',
    'page/landing/css/slick.css',
    'page/landing/css/LineIcons.css',
    'page/landing/css/default.css',
    'page/landing/css/style.css',
    'page/landing/css/responsive.css',
    'css/fontawesome/css/font-awesome.min.css'
      
  ];
  public $js = [
      ['page/landing/js/vendor/modernizr-3.6.0.min.js','position' => View::POS_END],
      ['page/landing/js/vendor/jquery-1.12.4.min.js','position' => View::POS_HEAD],
      ['page/landing/js/bootstrap.min.js','position' => View::POS_END],
      ['page/landing/js/slick.min.js','position' => View::POS_END],
      ['page/landing/js/jquery.magnific-popup.min.js','position' => View::POS_END],
      ['page/landing/js/jquery.nice-number.min.js','position' => View::POS_END],
      ['page/landing/js/main.js','position' => View::POS_END],
       ['https://unpkg.com/aos@2.3.0/dist/aos.js','position' => View::POS_HEAD],
     
      
    ];
      public $depends = [
        //'yii\web\YiiAsset',
      //  'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $jsOptions = array(
        'position' => View::POS_HEAD
    );
}
