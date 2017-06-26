<?php

$config = [
    'id' => 'yii2_basic_template',
    'name' => 'Yii2 Basic Template',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => require('components.php'),
    'params' => require('params.php'),
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'vendorPath' => dirname(__DIR__) . "/../vendor"
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
