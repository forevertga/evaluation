<?php

namespace app\assets;

/**
 * Class IoniconsAsset
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\assets
 */
class IoniconsAsset extends AssetBundle
{
    public $sourcePath = '@bower/ionicons';

    public $css = [
        'css/ionicons.css'
    ];
    public $productionCss = [
        'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'
    ];
}
