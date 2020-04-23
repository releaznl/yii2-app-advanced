<?php
return [
    'language' => 'nl',
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
        'user'        => [
            'identityClass'   => 'common\models\User',
            'class'           => 'common\components\web\User',
            'enableAutoLogin' => true,
        ],
    ],
];
