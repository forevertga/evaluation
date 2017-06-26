<?php

return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'nbE9xlqM1W1J40BgWzu_4ol3im9FyLme',
    ],
    'cache' => [
        'class' => 'yii\redis\Cache',
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => getenv('REDIS_HOST'),
            'port' => getenv('REDIS_PORT'),
            'database' => getenv('REDIS_DATABASE')
        ]
    ],
    'user' => [
        'identityClass' => 'app\models\User',
        'enableAutoLogin' => true,
        'enableSession' => true
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => getenv('SMTP_HOST'),
            'username' => getenv('SMTP_USERNAME'),
            'password' => getenv('SMTP_USERNAME'),
            'port' => getenv('SMTP_PORT'),
            'encryption' => 'tls',
        ],
        'useFileTransport' => true,
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
    'db' => require('db.php'),
    'urlManager' => [
        'enablePrettyUrl' => true,
        'enableStrictParsing' => false,
        'showScriptName' => false,
        'rules' => [
            '<action:(login|logout|sign-in|index|register|sign-up)>' => 'site/<action>',
        ]
    ],
    'assetManager' => [
        'appendTimestamp' => true
    ],
    'view' => [
        'class' => '\smilemd\htmlcompress\View',
        'compress' => YII_ENV_DEV ? false : true,
    ],
    'formatter' => [
        'timeZone' => 'Africa/Lagos',
        'dateFormat' => 'php:' . \CottaCush\Yii2\Date\DateFormat::FORMAT_DATE_TIME_12H,
        'datetimeFormat' => 'php:' . \CottaCush\Yii2\Date\DateFormat::FORMAT_DATE_TIME_12H,
        'decimalSeparator' => '.',
        'thousandSeparator' => '',
    ],
];