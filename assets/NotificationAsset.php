<?php

namespace app\assets;

/**
 * Class NotificationAsset
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\assets
 */
class NotificationAsset extends BaseAppAsset
{
    public $js = [
        'js/polyfills/array.js',
        'js/components/notification.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppModuleAsset'
    ];
}
