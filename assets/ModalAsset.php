<?php

namespace app\assets;

class ModalAsset extends BaseAppAsset
{
    public $js = [
        'js/components/modal.js',
    ];

    public $depends = [
        'app\assets\FormAsset',
        'app\assets\AppAsset'
    ];
}
