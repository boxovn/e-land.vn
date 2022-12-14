<?php
$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);
$domain_name = '';

if (strpos($_SERVER['SERVER_NAME'], 'sachmoigioi.com') !== false) {  
   $domain_name = 'business-book/index';

} else {
   $domain_name = 'home/index';
}

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
   // 'bootstrap' => ['log','assetsAutoCompress'],
   'bootstrap' => ['log'],
    'defaultRoute' =>  'home/index',
    'controllerNamespace' => 'frontend\controllers',
    // set target language to be Russian
    'language' => 'vi',
    // set source language to be English
    'sourceLanguage' => 'vi-VN',
	// 'bootstrap'  => ['assetsAutoCompress'],
    'components' => [
       /* 'session' => [
            'autoStart' => true,

        'class' => 'yii\web\Session',
        'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 4],
        'timeout' => 3600*4, //session expire
        'useCookies' => true,
    ],
*/
			   'formatter' => [
        'currencyCode' => 'VND',
        'locale' => 'vi-VN',
        'numberFormatterSymbols'=>[\NumberFormatter::CURRENCY_SYMBOL => 'đ'],
      ],
			'assetsAutoCompress' => [
            'class'   => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true,

            'readFileTimeout' => 3,           //Time in seconds for reading each asset file

            'jsCompress'                => true,        //Enable minification js in html code
            'jsCompressFlaggedComments' => true,        //Cut comments during processing js

            'cssCompress' => true,        //Enable minification css in html code

            'cssFileCompile'        => true,        //Turning association css files
            'cssFileRemouteCompile' => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
            'cssFileCompress'       => true,        //Enable compression and processing before being stored in the css file
            'cssFileBottom'         => false,       //Moving down the page css files
            'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js

            'jsFileCompile'                 => true,        //Turning association js files
            'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js
			'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests
			'htmlFormatter' => [
                //Enable compression html
                'class'         => '\skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
                'extra'         => true,       //use more compact algorithm
                'noComments'    => false,        //cut all the html comments
                'maxNumberRows' => 50000,       //The maximum number of rows that the formatter runs on

                //or

           //     'class' => '\skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',

                //or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface

                //or false
            ],
        ],
		
    'assetManager' => [
		# 'linkAssets' => false,
        'appendTimestamp' => true,
		'class' => 'yii\web\AssetManager',
             // 'forceCopy' => true,   
        
             'bundles' => [
		                'yii\web\JqueryAsset' => [
		                    'js' => [
                                YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js',
                              
                            ],
                           'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],   
                            
                        ],
                        'yii\bootstrap\BootstrapAsset' =>  false,
                        'yii\bootstrap\BootstrapPluginAsset' => false,
		            /*    'yii\bootstrap\BootstrapAsset' => [
                            
		                    'css' => [
		                        YII_ENV_DEV ? '../../e-land/css/bootstrap.css' : '../../e-land/css/bootstrap.min.css',
		                    ]
                        ],
		                'yii\bootstrap\BootstrapPluginAsset' => false,
                    */
            ],
            
		
    ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['index/login'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'maxSourceLines' => 20,
        ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => __DIR__ . '/../tmp',
        ],
        'request' => [
            'baseUrl' => '',
            'enableCsrfValidation' => true,
        ],
         'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/',
             'rules' => [
                
             
              
                'tin-tuc/<slug:[a-zA-Z0-9_-]{1,100}+>/<id:\d+>' => 'blog/default/view',
                'tin-tuc/<slug:[a-zA-Z0-9_-]{1,100}+>' => 'blog/default/index',
                'tin-tuc' => 'blog/default/index',

          

                'imagemanager/manager' => 'imagemanager/manager',
                'imagemanager/manager/upload' => 'imagemanager/manager/upload',
                'imagemanager/manager/view' => 'imagemanager/manager/view',
                'imagemanager/manager/save-user-image' => 'imagemanager/manager/save-user-image',
                'imagemanager/manager/delete' => 'imagemanager/manager/delete',
                'imagemanager/manager/index' => 'imagemanager/manager/index',
                'user/save-user-image' => 'user/save-user-image',
                'imagemanager' => 'imagemanager',
               
                'dich-vu' => 'service/index',
                'cai-dat' => 'setting/index',
                'gioi-thieu' => 'about/index',
                'cong-cu-ho-tro' => 'tool/index',
                'tuyen-dung' => 'recruitment/index',
                'chinh-sach-bao-mat' => 'privacy-policy/index',
                'chinh-sach-khieu-nai' => 'complain/index',
                'dieu-khoan' => 'rule/index',
                'lien-he' => 'contact/index',
            
                'hoi-dap' => 'question/index',
                'hoi-dap/<slug>' => 'question/view',
				'province' => 'index/change',
				'result' => 'index/result',
				'tim-kiem' => 'index/search',
				'filter' => 'index/filter',
				'remove' => 'index/remove',
                'ky-gui-nha-dat' => 'landing/index',
                'email-doanh-nghiep' => 'card/email-company',
                'langding-bat-dong-san' => 'card/langding-page',
                'quang-cao-facebook-ads' => 'card/facebook-ads',
                'quang-cao-google-ads' => 'card/google-ads',
				
                'xac-nhan' => 'index/confirm',
                'dang-nhap' => 'index/login',
                'article/article-login' => 'article/article-login',
                'chung-cu' => 'index/apartment',
                'nha-rieng' => 'index/home',
                'dat-nen' => 'index/land',
                'van-phong' => 'index/office',
                'api-dang-nhap' => 'index-api/login',
				'article/rating' => 'article/rating',
                'dang-nhap-nhanh' => 'social/auth',
                'lay-lai-mat-khau' => 'index/forget-password',
				'reset' => 'index/reset-password',
                'dang-xuat' => 'user/logout',
                'dang-ky-tai-khoan' => 'index/register',
                'thanh-cong' => 'index/success',
				
                'project-loading' => 'project/auto-loading',
				'article-loading' => 'article/auto-loading',
				
                'kenh/danh-sach-bai-viet' => 'user/article',
				'kenh/gioi-thieu' => 'user/about',
                'kenh/dang-bai' => 'user/post',
				'kenh/sua/<article_id>' => 'user/edit',
                'kenh/dat-lich' => 'user/booking',
                'kenh/cai-dat' => 'user/setting-email',
				'kenh' => 'user/index',


                'kenh/<id>/danh-sach-bai-viet' => 'poster/article',
				'kenh/<id>/gioi-thieu' => 'poster/about',
				'kenh/<id>/dang-bai' => 'poster/post',
                'kenh/<id>/dat-lich' => 'poster/booking',
                'kenh/<id>/cai-dat' => 'poster/setting-email',
				'kenh/<id>' => 'poster/index',

				
				'user/districts' => 'user/districts',
                'user/wards' => 'user/wards',
				
				'chi-tiet/<id>' => 'article/article-detail',
                'hinh-chi-tiet/<id>' => 'article/image-detail',
              
                'article/map' => 'article/map',
                'ban-do/tim-kiem' => 'map/search',
				'cho-thue' => 'index/rent',
				'rao-ban' => 'index/sale',
				'can-mua' => 'index/buy',
				//'tin-tuc' => 'index/news',
                'user/article-delete' => 'user/article-delete',
				'page-cache' => 'page-cache/index',
				'multiple-upload' => 'user/multiple-upload',
                'upload-article-image' => 'user/upload-article-image',
                'user/remove-image' => 'user/remove-image',
				
                'sach-doanh-nhan/<province>/<district>/<district_id>/<province_id>' => 'business-book/district',
				'sach-doanh-nhan/<province>/<province_id>/<product_id>' => 'business-book/province',
				'sach-doanh-nhan/<slug>/<product_id>' => 'business-book/detail',
                'sach-doanh-nhan/<slug>' => 'business-book/index',
                'sach-doanh-nhan' => 'business-book/index',
                'product-loading' => 'product/auto-loading',

                'shopping-cart/add-cart' => 'shopping-cart/add-cart',
                'shopping-cart/cart' => 'shopping-cart/cart',
                'shopping-cart/update-cart' => 'shopping-cart/update-cart',
                'shopping-cart/checkout' => 'shopping-cart/checkout',
                'shopping-cart/confirm' => 'shopping-cart/confirm',
                'shopping-cart/get-address' => 'shopping-cart/get-address',
                'shopping-cart/update' => 'shopping-cart/update',
                'shopping-cart/success' => 'shopping-cart/success',
                'shopping-cart/order' => 'shopping-cart/order',
                'user/remove-image' => 'user/remove-image',
                //'<province>/<district>/<category>/<slug>' => 'article/detail',
				//'<province>/<district>' => 'article/district',
                //'<category>' => 'article/category',
                'comment-like' => 'article/like',
				'comment-feedback' => 'article/comment-feedback',
				'comment-show-more' => 'article/view-more',
				'comment-rating' => 'article/rating',
                'article/article-booking' => 'article/article-booking',
                'article/article-register' => 'article/article-register',
                
               //'<province>/<district>/<type>/<slug>-<id>' => 'article/detail',
             
            //    '<province>/<district>/<slug>' => 'article/province-district-slug_category-or_slug_type',
             //   '<province>/<slug>' => 'article/province-slug_category-or_slug_type-or_slug_district',
            //    '<slug>' => 'article/slug_province-or_slug_category-or_slug_type',// category, province,type,
              //   'mua-ban/tinh-thanh/<province>' => 'article/detail',
            //    'mua-ban/tinh-thanh/<district>/<province>' => 'article/district', 
            'mua-ban/danh-muc/<category>' => 'article/category',
            'mua-ban/<province>/<district>/<slug>' => 'article/detail',
         //   'mua-ban/<category>/<province>/<district>' => 'article/category',
            'mua-ban/<province>/<district>' => 'article/district',
            'mua-ban/<province>' => 'article/province',
            'mua-ban' => 'article/index',
          
            'cho-thue/danh-muc/<category>' => 'rent/category',
            'cho-thue/<province>/<district>/<slug>' => 'rent/detail',
            'cho-thue/<province>/<district>' => 'rent/district',
            'cho-thue/<province>' => 'rent/province',
            'cho-thue' => 'rent/index',
        

            'du-an/danh-muc/<category>' => 'project/category',
            'du-an/<province>/<district>/<slug>' => 'project/detail',
            'du-an/<province>/<district>' => 'project/district',
            'du-an/<province>' => 'project/province',
            'du-an' => 'project/index',
            
            'tinh-thanh' => 'province/index',
            'home/modal-article-detail/<slug>' => 'home/modal-article-detail',
            'home/modal-register-email' => 'home/modal-register-email',
            'home/modal-article-register' => 'home/modal-article-register',
            'home/modal-article-login' => 'home/modal-article-login',

            'home-api/districts' => 'home-api/districts',
			
            'chon-tinh-thanh' => 'home/session-set-province',
			
            '<province>/<district>' => 'home/district',
            '<province>' => 'home/province',
            '/' => $domain_name,
		//'/' => 'home/index',
                
			/*	'/<category>-<district>-<province>/<slug>-<district_id>-<province_id>' => 'article/detail',
				'/<district>/<province>/<district_id>/<province_id>' => 'article/district',
				'/<province>-pr<province_id>' => 'article/province',
				'/<category>' => 'article/category',
				'/' => 'article/index',
                */
                

                '<controller:\w+>/<id:\w+>' => '<controller>',
                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				
				
			],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'class' => 'yii\i18n\GettextMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'vi-VN',
                ],
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '491032028504-6dbfu9cfivpusn6qsr3r517on1bq7soh.apps.googleusercontent.com',
                    'clientSecret' => 'PBwB7_2Zx5YraegOBLeh7xk3',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '873639549356055',
                    'clientSecret' => 'dceb0107e2b929dbbb697990d02ffb20',
                ],
            // etc.
            ],
        ],
        'imagemanager' => [
                'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
                //set media path (outside the web folder is possible)
                'mediaPath' => '/var/www/e-land.vn/frontend/web/channels/avatar',
                //path relative web folder. In case of multiple environments (frontend, backend) add more paths 
                'cachePath' =>  ['assets/images', '../../frontend/web/assets/images'],
                //use filename (seo friendly) for resized images else use a hash
                'useFilename' => true,
                //show full url (for example in case of a API)
                'absoluteUrl' => false,
                'databaseComponent' => 'db' // The used database component by the image manager, this defaults to the Yii::$app->db component
            ],
    ],
    
	 'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/uploads',
            'uploadUrl' => '@web/path/to/uploadfolder',
            'imageAllowExtensions'=>['jpg','png','gif'],
			
        ],
    ],
     'modules' => [
        'blog' => [
            'class' => 'akiraz2\blog\Module',
            'controllerNamespace' => 'akiraz2\blog\controllers\frontend',
            'blogPostPageCount' => 6,
            'blogCommentPageCount' => 10, //20 by default
            'enableComments' => true, //false by default
            'schemaOrg' => [ // empty array [] by default! 
                'publisher' => [
                    'logo' => '/img/logo.png',
                    'logoWidth' => 191,
                    'logoHeight' => 74,
                    'name' => 'Eland',
                    'phone' => '035-9696234',
                    'address' => '67/34 Bờ Bao Tân Thắng, P.Sơn Kỳ, Quận Tân Phú, TP.HCM'
                ]
            ]
        ],
        'imagemanager' => [
        'class' => 'noam148\imagemanager\Module',
        //set accces rules ()
        'canUploadImage' => true,
        'canRemoveImage' => function(){
            return true;
        },
        //add css files (to use in media manage selector iframe)
        'cssFiles' => [
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
        ],
    ],
    ],
    'params' => $params,
];
