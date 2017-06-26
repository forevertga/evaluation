<?php

namespace app\widgets;

use app\widgets\FontAwesomeIcon as Icon;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class BaseContentHeaderButton
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\widgets
 */
class BaseContentHeaderButton extends Widget
{
    public $button;
    public $buttonClass;

    protected function setButton()
    {
        if (is_string($this->button)) {
            return;
        }
        if (is_array($this->button)) {
            $this->buildButton($this->button);
            return;
        }

        $buttonDetails = ArrayHelper::getValue($this->view->params, 'content-header-button', '');
        if (is_string($buttonDetails)) {
            $this->button = $buttonDetails;
            return;
        }
        $this->buildButton($buttonDetails);
    }

    private function buildButton($buttonArray)
    {
        if (!is_array($buttonArray)) {
            return;
        }

        $text = ArrayHelper::getValue($buttonArray, 'label', 'Add New');
        $tag = ArrayHelper::getValue($buttonArray, 'tag', 'a');
        $icon = Icon::widget(['name' => 'plus']);
        $options = ArrayHelper::getValue($buttonArray, 'options', []);

        Html::addCssClass($options, $this->buttonClass);

        $this->button = Html::tag($tag, "$icon $text", $options);

    }
}