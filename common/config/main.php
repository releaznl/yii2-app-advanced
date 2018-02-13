<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'linkAssets' => false,
            'class' => \yii\web\AssetManager::class,
            'bundles' => [
                \yii\bootstrap\BootstrapAsset::class => [
                    'sourcePath' => dirname(dirname(__DIR__)) . '/common/assets/bootstrap4/dist',
                ],
                \yii\bootstrap\BootstrapPluginAsset::class => [
                    'sourcePath' => dirname(dirname(__DIR__)) . '/common/assets/bootstrap4/dist',
                ],
                \yii\bootstrap\BootstrapThemeAsset::class => [
                    'sourcePath' => dirname(dirname(__DIR__)) . '/common/assets/bootstrap4/dist',
                ],
            ],
        ],
        'urlManager' => [
            'class' => \yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
