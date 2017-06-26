<?php

namespace app\widgets;

/**
 * Class FontAwesomeIcon
 * For Font Awesome icons
 * @author Olajide Oye <jide@cottacush.com>
 */
class FontAwesomeIcon extends BaseIcon
{
    public $prefix = 'fa fa-';
    public $tag = 'i';

    public function run()
    {
        \app\assets\FontAwesomeAsset::register($this->view);
        return parent::run();
    }
}
