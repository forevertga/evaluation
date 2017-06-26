<?php

namespace app\assets;

class FormAsset extends BaseAppAsset
{
    public $js = [
        'js/components/form.js',
    ];

    public $depends = [
        'app\assets\AppAsset'
    ];
}
