<?php

namespace app\assets;

/**
 * Class FontAwesomeAsset
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\assets
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/font-awesome.min.css'
    ];

    public $productionCss = [
      'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'
    ];
}
