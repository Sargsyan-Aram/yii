<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'image'=>[
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'sargsyan.a.1997@gmail.com',
                'password' => 'as.aram.123',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

    ],
];
