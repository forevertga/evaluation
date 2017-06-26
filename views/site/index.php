<?php

use app\models\BusinessType;
use app\widgets\TypeWidget;
use app\widgets\ActionButtons;
use app\widgets\AGSGridView;
use app\widgets\EmptyStateWidget;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Image Gallery';

$this->params['content-header-button'] = [
    'tag' => 'button',
    'label' => 'New Image',
    'options' => ['data-toggle' => 'modal', 'data-target' => '#newImage']
    ];

\app\assets\ModalAsset::register($this);

?>
<?php if ($dataProvider->getTotalCount() == 0) : ?>
    <?= EmptyStateWidget::widget([
        'icon' => 'navicon',
        'title' => 'You have no image added yet',
        'description' => 'To add new image, click the button below'
    ]) ?>
<?php else : ?>


    <?php Modal::begin([
        'header' => '<h4 class="modal-title">Add New Image</h4>',
        'options' => ['id' => 'newImage', 'data-backdrop' => 'static'],
        'footer' => Html::button('Cancel', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) .
            Html::button('Add', ['class' => 'btn btn-primary', 'data-submit-modal-form' => '']),
    ]); ?>

    <?= TypeWidget::widget([
        'model' => $model,
        'action' => '/media/add-image'
    ]); ?>

    <?php Modal::end(); ?>

<?php endif; ?>



