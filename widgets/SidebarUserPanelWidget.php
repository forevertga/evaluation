<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class SidebarUserPanelWidget
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\widgets
 */
class SidebarUserPanelWidget extends Widget
{
    public $user;
    private $name;
    private $username;

    public function init()
    {
        parent::init();
        $this->name = ArrayHelper::getValue($this->user, 'display_name');
        $this->username = ArrayHelper::getValue($this->user, 'username');
        $this->user = ['fullName' => ArrayHelper::getValue($this->user, 'display_name')];
    }

    public function run()
    {
        return $this->render('sidebar-user-panel', get_object_vars($this));
    }
}