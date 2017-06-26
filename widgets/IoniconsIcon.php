<?php

namespace app\widgets;

/**
 * Class IoniconsIcon
 * For Ionicons icons
 * @author Olajide Oye <jide@cottacush.com>
 */
class IoniconsIcon extends BaseIcon
{
    public $prefix = 'icon ion-';
    public $tag = 'span';

    public function run()
    {
        \app\assets\IoniconsAsset::register($this->view);
        return parent::run();
    }
}
