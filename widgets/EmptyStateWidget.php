<?php

namespace app\widgets;

use yii\helpers\ArrayHelper;

/**
 * Class EmptyStateWidget
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\modules\admin\widgets
 */
class EmptyStateWidget extends BaseContentHeaderButton
{
    public $icon;
    public $title;
    public $description;
    public $buttonClass = 'btn btn-primary';
    public $showContentHeader = true;
    public $showButton = true;

    public function init()
    {
        parent::init();
        $view = $this->view;

        $view->params['show-content-header'] = $this->showContentHeader;

        if (is_null($this->button)) {
            $this->button = ArrayHelper::getValue($view->params, 'content-header-button', '');
        }

        if ($this->showButton) {
            $this->setButton();
        }
    }

    public function run()
    {
        return $this->render('empty-state', get_object_vars($this));
    }
}
