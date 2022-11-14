<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'language' => 'vi',
    // set source language to be English
    'sourceLanguage' => 'vi-VN',
    'bootstrap' => ['log'],
    'defaultRoute' => 'blog',
	  'on beforeAction' => function ($event) {
    if (!(
          (!empty($_SERVER['HTTPS']) AND $_SERVER['HTTPS'] != 'off') || 
          $_SERVER['SERVER_PORT'] == 443
        )) {
            return Yii::$app->controller->redirect("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    }
},
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
    ],
    'components' => [
      /*   'formatter' => [
        'dateFormat' => 'dd-MM-yyyy',
        'decimalSeparator' => ',',
        'thousandSeparator' => '.',
        'currencyCode' => 'đ',
   ], */
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'class' => 'yii\i18n\GettextMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
	
    'params' => $params,
];
