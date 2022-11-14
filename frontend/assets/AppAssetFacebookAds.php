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
class AppAssetFacebookAds extends AssetBundle
{
     

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    'e-land/css/bootstrap.min.css',
    'facebook-ads/css/style.css'
      
  ];
  public $js = [
      ['e-land/js/bootstrap.bundle.min.js','position' => View::POS_END],
    
     
      
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
