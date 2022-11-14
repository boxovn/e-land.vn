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
class HomeAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
	public $baseUrl = '@web';
	

    public $css = [
    	
		'e-land/css/bootstrap.min.css',
		'e-land/css/bootstrap-grid.min.css',
		'e-land/slick/slick.css',
		'e-land/slick/slick-theme.css',
		'e-land/cover.css',
		'e-land/index.css',
		'e-land/sidebar-home.css',
		'e-land/navbar.css',
		'e-land/slider.css',
		'e-land/svg-icons-home.css',
		'e-land/svg-icons-eland.css',
		'e-land/svg-icons.css',
		'css/fontawesome/css/font-awesome.min.css',
		'css/fontawesome-free-5.15.3/css/all.css',
		'https://chat.e-land.vn/css/user.css',
		'e-land/detail.css',
		
	];
	
	public $js = [
		//	['js/script.js','position' => View::POS_END],
			['e-land/js/modal_article_detail.js','position' => View::POS_END],
			['e-land/js/bootstrap.bundle.min.js','position' => View::POS_END],
			['e-land/sidebars.js','position' => View::POS_END],
			['e-land/js/modal_login.js','position' => View::POS_END],
			['e-land/js/modal_register.js','position' => View::POS_END],
			['e-land/js/modal_register_email.js','position' => View::POS_END],
		//	['https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js','position' => View::POS_END],
		//	['https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js','position' => View::POS_END],
		//	[e-land/js/modal_login.js','position' => View::POS_END],
		//	['e-land/js/bootstrap.min.js','position' => View::POS_END],
			['css/fontawesome-free-5.15.3/js/all.js','position' => View::POS_END],
		//	['e-land/jquery-2.2.0.min.js','position' => View::POS_END],
			['e-land/slick/slick.js','position' => View::POS_END],
			['e-land/js/bootstrap.bundle.min.js','position' => View::POS_END],
			//['https://sp.zalo.me/plugins/sdk.js','position' => View::POS_END],
			//['js/ajax-modal-popup.js','position' => View::POS_END],
			//['js/noel_snow.js','position' => View::POS_END],
			//['https://chat.batdongsaneland.com/socket.io/socket.io.js','position' => View::POS_END],
			//['https://chat.batdongsaneland.com/user.js','position' => View::POS_END],
		//	['plugins/slick/slick.js','position' => View::POS_END],
	];
      public $depends = [
		'yii\bootstrap\BootstrapPluginAsset',
	//	'yii\bootstrap\BootstrapPluginAsset',
	//	'Yiisoft\Yii\Bootstrap5\BootstrapAsset',
		//'yii\web\JqueryAsset', // − Includes the jquery.js file.
		//yii\web\YiiAsset − Includes the yii.js file, which implements a mechanism of organizing JS code in modules.
	//	'yii\bootstrap\BootstrapAsset',// − Includes the CSS file from the Twitter Bootstrap framework.
		//yii\bootstrap\BootstrapPluginAsset − Includes the JS file from the Twitter Bootstrap framework.
		//yii\jui\JuiAsset − Includes the CSS and JS files from the jQuery UI library.
    ];
    public $jsOptions = array(
        'position' => View::POS_END
    );
	//$this->registerJsFile('@web/js/script.js',['position' => View::POS_END]); 
}
