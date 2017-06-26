<?php

namespace app\widgets;

use yii\base\Widget;

/**
 * @author Akinwunmi Taiwo <taiwo@cottacush.com>
 * Class TypeWidget
 * @package app\widgets
 */
class TypeWidget extends Widget
{
    public $model;
    public $method = 'post';
    public $action = '';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('new-type', get_object_vars($this));
    }
}
