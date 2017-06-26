<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class PanelWidget
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\modules\admin\widgets
 */
class PanelWidget extends Widget
{
    const TYPE_DEFAULT = 'panel-default';
    const TYPE_PRIMARY = 'panel-primary';
    const TYPE_SUCCESS = 'panel-success';
    const TYPE_INFO = 'panel-info';
    const TYPE_WARNING = 'panel-warning';
    const TYPE_DANGER = 'panel-danger';

    public $type = self::TYPE_DEFAULT;
    public $header = '';
    public $title = '';
    public $footer = '';
    public $options = [];

    /**
     * @var bool $panelCollapsible set to true when you want the panel to be collapsible
     */
    public $panelCollapsible = false;
    private $panelCollapseId;
    public $panelCollapseParent;
    public $panelCollapseOpen = false;

    /**
     * @var int a counter used to generate collapseIds for the widget.
     */
    public static $counter = 0;
    /**
     * @var string the prefix to the automatically generated collapse ids.
     * @see getCollapseId()
     */
    public static $autoIdPrefix = 'panelCollapse';


    public function init()
    {
        parent::init();
        $this->initOptions();

        echo Html::beginTag('div', $this->options) . "\n";
        $this->renderHeader();
        $this->startCollapse();
        $this->startBody();
    }

    public function run()
    {
        $this->endBody();
        $this->renderFooter();
        $this->endCollapse();
        echo "\n" . Html::endTag('div');
    }

    /**
     * Add default options for the widget
     */
    protected function initOptions()
    {
        Html::addCssClass($this->options, ['panel', $this->type]);
        $this->generateCollapseId();
    }

    /**
     * Render the panel widget header
     */
    protected function renderHeader()
    {
        $options = ['class' => 'panel-heading clearfix'];

        if ($this->panelCollapsible) {
            $options['data-toggle'] = 'collapse';
            $options['data-target'] = '#' . $this->panelCollapseId;

            if ($this->panelCollapseParent) {
                $options['data-parent'] = $this->panelCollapseParent;
            }
        }

        echo Html::beginTag('div', $options) . "\n";
        if (!empty($this->header)) {
            echo $this->header;
        } else {
            echo Html::tag('h3', $this->title, ['class' => 'panel-title']) . "\n";
        }
        echo Html::endTag('div') . "\n";
    }

    protected function startCollapse()
    {
        if ($this->panelCollapsible) {
            $options = ['class' => ['panel-collapse', 'collapse'], 'id' => $this->panelCollapseId];
            if ($this->panelCollapseOpen) {
                Html::addCssClass($options, 'in');
            }
            echo Html::beginTag('div', $options) . "\n";
        }
    }

    protected function startBody()
    {
        echo Html::beginTag('div', ['class' => 'panel-body']) . "\n";
    }

    protected function endBody()
    {
        echo "\n" . Html::endTag('div') . "\n";
    }

    protected function endCollapse()
    {
        if ($this->panelCollapsible) {
            echo "\n" . Html::endTag('div') . "\n";
        }
    }

    /**
     * Render the panel widget footer if it's content exists
     */
    protected function renderFooter()
    {
        if (!empty($this->footer)) {
            echo Html::beginTag('div', ['class' => 'panel-footer clearfix']) . "\n";
            echo $this->footer;
            echo Html::endTag('div') . "\n";
        }
    }

    /**
     * Returns the collapse id of the widget.
     * @return string the collapse id.
     */
    protected function generateCollapseId()
    {
        if ($this->panelCollapsible && $this->panelCollapseId === null) {
            $this->panelCollapseId = static::$autoIdPrefix . static::$counter++;
        }
    }
}
