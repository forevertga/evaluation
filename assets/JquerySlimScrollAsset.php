<?php

namespace app\assets;

/**
 * Class JquerySlimScrollAsset
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\assets
 */
class JquerySlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-slimscroll';
    public $js = [
        'jquery.slimscroll.min.js'
    ];

    public $productionJs = [
        'https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
