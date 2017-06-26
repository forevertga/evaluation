<?php

namespace app\assets;

/**
 * Class ThemeAsset
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\assets
 */
class ThemeAsset extends BaseAppAsset
{
    public $js = [
        'js/theme-options.js',
        'js/theme.min.js'
    ];
    public $depends = [
        'app\assets\FontAwesomeAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'app\assets\FastClickAsset',
        'app\assets\JquerySlimScrollAsset',
        'app\assets\AppAsset',
    ];
}
