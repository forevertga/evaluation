<?php

namespace app\widgets;

/**
 * Class ContentHeaderWidget
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\widgets
 */
class ContentHeaderWidget extends BaseContentHeaderButton
{
    public $title;
    public $breadcrumbs;
    public $buttonClass = 'btn btn-sm content-header-btn';

    public function init()
    {
        parent::init();

        $view = $this->view;

        if (is_null($this->title)) {
            $this->title = isset($view->params['pageTitle']) ? $view->params['pageTitle'] : $view->title;
        }
        if (is_null($this->breadcrumbs)) {
            $this->breadcrumbs = isset($view->params['breadcrumbs']) ? $view->params['breadcrumbs'] : [$this->title];
        }

        $this->setButton();
    }

    public function run()
    {
        return $this->render('content-header', get_object_vars($this));
    }
}