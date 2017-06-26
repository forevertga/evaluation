<?php

namespace app\assets;

/**
 * Class AppAsset
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\assets
 */
class AppAsset extends BaseAppAsset
{
    public $css = [
        'css/styles.css'
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppModuleAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
