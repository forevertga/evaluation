<?php

namespace app\widgets;

use yii\base\Widget;

/**
 * Class ActionButtons
 * @package app\widgets
 * @author Olawale Lawal <wale@cottacush.com>
 */
class ActionButtons extends Widget
{
    public $actions = [];
    public $asButtons = false;
    public $overridePermissions = true;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('action-buttons', get_object_vars($this));
    }
}
