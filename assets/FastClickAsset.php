<?php

namespace app\assets;

/**
 * Class FastClickAsset
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\assets
 */
class FastClickAsset extends AssetBundle
{
    public $sourcePath = '@bower/fastclick/lib';
    public $js = [
        'fastclick.js'
    ];

    public $productionJs = [
        'https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js'
    ];
}
