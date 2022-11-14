<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    //'defaultRoute' => 'user/index',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
   
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
				 [
            'class' => 'yii\log\FileTarget',
            'levels' => ['info'],
            'categories' => ['pushCrontab'],
            'logFile' => dirname(__DIR__). '/logs/cronjob_'.date('Y-m-d H:i:s').'.log',
            'maxFileSize' => 1024 * 2,
            'maxLogFiles' => 50,
        ],
            ],
        ],
      
       
          'urlManager' => [
            'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,  // Disable r= routes
                'showScriptName' => false,   // Disable index.php
                 'enableStrictParsing' => true,
              // 'baseUrl' => $baseUrl,
                //'enableStrictParsing' => false,
          
                'rules' => [
                    [ 'class' => 'yii\rest\UrlRule', 
                        'controller' => 'article',
                      /*  'tokens' => [
                            '{id}' => '<id:\\w+>',
                            '{slug}'=>'<slug:\\w+>'
                        ],*/
                        'extraPatterns' => [
                              'GET search' => 'search',
                              'POST,OPTIONS create' => 'create',
                              'POST,OPTIONS,PUT update' => 'update',
                        ],
                      
                        
                    ],
					  [ 'class' => 'yii\rest\UrlRule', 'controller' => 'project',
                
                    'extraPatterns' => [
                        'GET search' => 'search',
                       
                    ],
                ],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'mail',
                            'extraPatterns' => [
                                'GET remind-post' => 'remind-post',  // Nhắc nhở đăng tin
                            ],
                    ],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'customer-contact'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'get-user'],
					[ 'class' => 'yii\rest\UrlRule', 'controller' => 'get-product'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'policies','pluralize'=>false],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'info'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'blog-post'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'slider'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'district'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'province'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'price'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'category'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'type'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'area'],
                    [ 'class' => 'yii\rest\UrlRule', 'controller' => 'customer',
                    'extraPatterns' => [
                          'GET search' => 'search',
                    ],
                ],
                [ 'class' => 'yii\rest\UrlRule', 'controller' => 'customer-info',
                    'extraPatterns' => [
                          'POST,OPTIONS upload-logo' => 'upload-logo',
                    ]
                ],
                [ 'class' => 'yii\rest\UrlRule', 'controller' => 'user',
                    'extraPatterns' => [
                         'POST login' => 'login',
                         'POST,OPTIONS image-multiple-upload' => 'image-multiple-upload',
                         'POST,OPTIONS upload' => 'upload',
                         'POST,OPTIONS upload-avatar' => 'upload-avatar',
                         'GET,POST,OPTIONS test' => 'test',
                         'POST,OPTIONS create' => 'create',
                         'GET,POST,OPTIONS add' => 'add',
                         'GET,POST,OPTIONS register' => 'register',
                         'POST,OPTIONS update-article/{id}' => 'update-article',
                     //    'GET list' => 'list'
                    ],
                       'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{slug}'=>'<slug:\\w+>'
                    ],
                  
                ],
                ],
              
             
            
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
             ]
        ],
       'response' => [
              'format' => yii\web\Response::FORMAT_JSON,
              'charset' => 'UTF-8',
           /*     'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                
                if ($response->data !== null) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
            */
        ],
        /*
		'apns' => [
		'class' => 'bryglen\apnsgcm\Apns',
		 'environment' => \bryglen\apnsgcm\Apns::ENVIRONMENT_PRODUCTION,
		'pemFile' => dirname(__FILE__).'/apnssert/Espace_Certificates_Push.pem',
		// 'retryTimes' => 3,
		'options' => [
			'sendRetryTimes' => 5
		]
	],
		
		'gcm' => [
            'class' => 'bryglen\apnsgcm\Gcm',
            'apiKey' => 'AIzaSyAOvpGU1O9nfxVCZKNtudFw0rc6SlTqWNk',
        ],
        // using both gcm and apns, make sure you have 'gcm' and 'apns' in your component
        'apnsGcm' => [
            'class' => 'bryglen\apnsgcm\ApnsGcm',
        // custom name for the component, by default we will use 'gcm' and 'apns'
        //'gcm' => 'gcm',
        //'apns' => 'apns',
        ]
        */
    ],
    'params' => $params,
];