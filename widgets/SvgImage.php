<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class SvgImage
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\widgets
 */
class SvgImage extends Widget
{
    public $src = '';
    public $fallback = true;
    public $fallbackExt = 'png';
    public $options = [];

    public function init()
    {
        parent::init();

        if ($this->fallback) {
            if (is_bool($this->fallback)) {
                $this->fallback = rtrim($this->src, 'svg') . $this->fallbackExt;
            }
            $this->options['onerror'] = "this.src='$this->fallback'; this.onerror='';";
        }
    }

    public function run()
    {
        echo Html::img($this->src, $this->options);
    }
}
