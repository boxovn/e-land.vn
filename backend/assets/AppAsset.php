<?php
namespace backend\assets;
use yii\web\AssetBundle;
use yii\web\View;
/**
* Main backend application asset bundle.
*/

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'css/site.css',
		'css/style.css',
    'plugins/dropzone/dropzone.css',
    'css/fontawesome/css/font-awesome.min.css',
    'theme/dist/css/AdminLTE.css',
    'theme/dist/css/skins/_all-skins.min.css',
    //'theme/plugins/iCheck/all.css',
   // 'theme/plugins/datepicker/datepicker3.css'
    ];
    public $js = [
     // 'theme/bootstrap/js/bootstrap.min.js',
		    //'plugins/dropzone/dropzone.js',
      //'plugins/dropzone/script.js',
    //  'theme/dist/js/app.min.js'
    ];
    public $depends = [
       // 'yii\web\YiiAsset',
      //  'yii\bootstrap\BootstrapAsset',
     //     'opw\react\JSXTransformerAsset', 
     //  'opw\react\ReactAsset',
      	'yii\bootstrap\BootstrapPluginAsset',
    ];

   /*   public $js = [
			['js/script.js','position' => View::POS_END],
			['js/nav_bar.js','position' => View::POS_END],
			['js/up.js','position' => View::POS_END],
		//	['http://chat.e-land.vn/socket.io/socket.io.js','position' => View::POS_END],
		//	['http://chat.e-land.vn/user.js','position' => View::POS_END],
			['plugins/slick/slick.js','position' => View::POS_END],
	];
      public $depends = [
		
		'yii\bootstrap\BootstrapPluginAsset',
		//'yii\web\JqueryAsset' // − Includes the jquery.js file.
		//yii\web\YiiAsset − Includes the yii.js file, which implements a mechanism of organizing JS code in modules.
		//yii\bootstrap\BootstrapAsset − Includes the CSS file from the Twitter Bootstrap framework.
		//yii\bootstrap\BootstrapPluginAsset − Includes the JS file from the Twitter Bootstrap framework.
		//yii\jui\JuiAsset − Includes the CSS and JS files from the jQuery UI library.
    ];*/
     public $jsOptions = array(
        'position' => View::POS_HEAD
    );
}