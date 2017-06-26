<?php

namespace app\assets;

class AppPoiAsset extends BaseAppAsset
{
    public $js = [
        'js/pages/poi.js'
    ];

    public $depends = [
        'app\assets\ModalAsset',
        'app\assets\AppAsset'
    ];
}
