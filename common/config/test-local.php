<?php
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(__DIR__ . '/test.php'),
    [
        /*'components' => [
            'db' => [
                'dsn' => 'mysql:host=localhost;dbname=yii2advanced_test',
            ]
        ],
        */
        'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=e-land.vn',
            'username' => 'root',
            'password' => 'Hadt@1812',
            'charset' => 'utf8',
           
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
           'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'batdongsaneland@gmail.com',
                'password' => 'ezbmdoevfybghpwh',
                'port' => '587',
                'encryption' => 'tls',
            ],
            
            /*  
                'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'email-smtp.eu-west-1.amazonaws.com',
                'username' => 'AKIA33Y2PV3MNDINCIJ6',
                'password' => 'BEFIHSZv/XJcnM0MTgKuvIX1s1nSiLN/Z7o/pm1cMPrm',
                'port' => '587',
                'encryption' => 'tls',
            ],
            */
            ],
        ],
    ]
);



