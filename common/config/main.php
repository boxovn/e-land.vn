<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
		
    ],
    'aliases' => [
        '@Custom' => '@vendor/hung/Custom',
		'@Firebase' => '@vendor/firebase/php-jwt/src',
		'@PseudoCrypt' => '@common/libraries/PseudoCrypt',
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
    ],
     
 
   'modules' => [
          'redactor' => 'yii\redactor\RedactorModule',
          'class' => 'yii\redactor\RedactorModule',
          'uploadDir' => '@frontend/web/uploads',
          'uploadUrl' => '@frontend/web/uploads',
          'blog' => [
            'class' => akiraz2\blog\Module::class,
            'urlManager' => 'urlManager',// 'urlManager' by default, or maybe you can use own component urlManagerFrontend
            'imgFilePath' => '@frontend/web/img/blog/',
            'imgFileUrl' => '/img/blog/',
            'userModel' => \common\models\User::class,
            'userPK' => 'id', //default primary key for {{%user}} table
            'userName' => 'username', //uses in view (may be field `username` or `email` or `login`)
        ],
         
      ],
       
   /*
      'modules' => [
          'redactor' => 'yii\redactor\RedactorModule',
         'class' => 'yii\redactor\RedactorModule',
          'uploadDir' => '@webroot/uploads',
          'uploadUrl' => '/hello/uploads',
      ],*/
'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            //'plugin' => ['\mihaildev\elfinder\plugin\Sluggable'],
            'plugin' => [
                [
                    'class'=>'\mihaildev\elfinder\plugin\Sluggable',
                    'lowercase' => true,
                    'replacement' => '-'
                ]
             ],
             'roots' => [
                             [
                                 'baseUrl'=>'@web',
                                 'basePath'=>'@webroot',
                                 'path' => 'files/global',
                                 'name' => 'Global',
                                 'plugin' => [
                                        'Sluggable' => [
                                            'lowercase' => false,
                                        ]
                                 ]
                             ],
                         ]
                       ]
                     ]
   
];
