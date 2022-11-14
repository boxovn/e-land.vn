<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
    'modules' => [
	  'blog' => [
            'class' => 'akiraz2\blog\Module',
            'controllerNamespace' => 'akiraz2\blog\controllers\backend',
            //'adminAccessControl' => 'common\components\AdminAccessControl', // null - by default 
        ],
		 'redactor' => [
                'class' => 'yii\redactor\RedactorModule',
                'uploadDir' => '@frontend/web/uploads',
                'uploadUrl' => $actual_link .'uploads',
                'imageAllowExtensions'=>['jpg','png','gif'],
                
            ],
    'gridview' => [
        'class' => 'kartik\grid\Module',
        // other module settings
    ]
    ],
	
    'on beforeAction' => function ($event) {
    if (!(
          (!empty($_SERVER['HTTPS']) AND $_SERVER['HTTPS'] != 'off') || 
          $_SERVER['SERVER_PORT'] == 443
        )) {
            return Yii::$app->controller->redirect("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    }
},
    'as beforeRequest' => [
    'class' => 'yii\filters\AccessControl',
    'rules' => [
        [
            'allow' => true,
            'actions' => ['login'],
        ],
        [
            'allow' => true,
            'roles' => ['@'],
        ],
    ],
    'denyCallback' => function () {
        return Yii::$app->response->redirect(['site/login']);
    },
],
    'components' => [

        'formatter' => [
       'defaultTimeZone' => 'UTC',
       'timeZone' => 'Asia/Ho_Chi_Minh',
       'dateFormat' => 'php:d/m/Y',
       'datetimeFormat'=>'php:d/m/Y H:i:s'
	   ],
        'request' => [
            'csrfParam' => '_csrf-admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-admin', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the admin
            'name' => 'advanced-admin',
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
        ],
       
		
		 'urlManagerFrontend' => [
            'class'               => 'yii\web\UrlManager',
            'baseUrl'             => 'https://e-land.vn',
           // 'hostInfo'            => $params['frontend.protocol'] . '://' . $params['frontend.host'],
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => false,
			  'rules' => [
				'xac-nhan-doi-tac' => 'index/partner-confirm',
				'quyen-loi-tro-thanh-doi-tac' => 'partner/benefit',
			  ]
			  
			
           // 'rules'               => $params['frontend.urlrules'],
        ],
        
         
    ],
    
    'params' => $params,
];
