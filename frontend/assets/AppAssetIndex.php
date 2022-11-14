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
class AppAssetIndex extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fontawesome/css/font-awesome.min.css',
		'css/w3.css',
		'css/index.css',
		'css/up.css',
		'https://e-land.vn:90/css/user.css',
		'css/progress.css'
      
	];
    public $js = [
			['js/script.js','position' => View::POS_END],
			['js/nav_bar.js','position' => View::POS_END],
			['js/up.js','position' => View::POS_END],
			['https://e-land.vn:90/socket.io/socket.io.js','position' => View::POS_END],
			['https://e-land.vn:90/user.js','position' => View::POS_END],
		//	['js/auto_load_article.js','position' => View::POS_END],
			
			
    ];
    public $depends = [
		
	//	'yii\bootstrap\BootstrapPluginAsset',
		//yii\web\JqueryAsset − Includes the jquery.js file.
		//'yii\web\YiiAsset' // − Includes the yii.js file, which implements a mechanism of organizing JS code in modules.
		//yii\bootstrap\BootstrapAsset − Includes the CSS file from the Twitter Bootstrap framework.
		//yii\bootstrap\BootstrapPluginAsset − Includes the JS file from the Twitter Bootstrap framework.
		//yii\jui\JuiAsset − Includes the CSS and JS files from the jQuery UI library.
    ];
    public $jsOptions = array(
        'position' => View::POS_HEAD
    );
}
