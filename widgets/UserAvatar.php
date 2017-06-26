<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class UserAvatar
 * @author Olajide Oye <jide@cottacush.com>
 */
class UserAvatar extends Widget
{

    public $user = [];
    public $size;
    public $options = [];
    private $name;
    private $image;
    protected $fallbackImage = '/images/avatars/default.png';
    protected $baseClass = 'img-circle'; // for border-radius

    public function init()
    {
        parent::init();

        $this->name = ArrayHelper::getValue($this->user, 'fullName', '');
        $this->image = ArrayHelper::getValue($this->user, 'avatar', '');

        if (empty($this->image)) {
            $this->view->registerJsFile('/js/letter-avatar.js');
            $this->options['data-avatar'] = $this->name;
        }

        $this->options['data-avatar-' . ArrayHelper::getValue($this->user, 'id', 0)] = true;

        // Add the base class
        Html::addCssClass($this->options, $this->baseClass);

        // Set fallback image as onerror attribute
        if (!empty($this->fallbackImage)) {
            $this->options['onerror'] = "this.src='$this->fallbackImage'";
        }

        // Add size attributes to the image
        if (!empty($this->size)) {
            $this->options['width'] = $this->size;
            $this->options['height'] = $this->size;
        }
    }

    public function run()
    {
        return Html::img($this->image, $this->options);
    }
}
