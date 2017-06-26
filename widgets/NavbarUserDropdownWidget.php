<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class NavbarUserDropdownWidget
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\modules\admin\widgets
 */
class NavbarUserDropdownWidget extends Widget
{
    public $user;
    private $name;
    private $userType;

    public function init()
    {
        parent::init();
        $this->name = ArrayHelper::getValue($this->user, 'fullName');
        $this->userType = ArrayHelper::getValue($this->user, 'role.label');
    }

    public function run()
    {
        return $this->render('navbar-user-dropdown', get_object_vars($this));
    }
}
