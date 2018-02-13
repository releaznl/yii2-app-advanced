<?php

namespace frontend\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public function init()
    {
        $this->basePath = '@webroot';
        $this->baseUrl = '@web';
        $this->css = [
            'css/site.css',
        ];

        $this->depends = [
            YiiAsset::class,
            BootstrapAsset::class,
        ];

        parent::init();
    }
}
