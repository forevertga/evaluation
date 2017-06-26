<?php

namespace app\assets;

/**
 * @author Akinwunmi Taiwo <taiwo@cottacush.com>
 * Class AppPurposeAsset
 * @package app\assets
 */
class AppPurposeAsset extends BaseAppAsset
{
    public $js = [
        'js/pages/purpose.js'
    ];

    public $depends = [
        'app\assets\ModalAsset',
        'app\assets\AppAsset'
    ];
}
