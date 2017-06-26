<?php

use app\widgets\IoniconsIcon;
use yii\helpers\Html;

?>

<?= Html::beginTag('section', ['class' => 'empty-state']); ?>
<?= IoniconsIcon::widget([
    'name' => $icon,
    'options' => [
        'class' => 'empty-state__icon'
    ]
]) ?>
<?= Html::tag('h2', $title, ['class' => 'empty-state__title']); ?>
<?php if ($showButton) : ?>
    <?= Html::tag('p', $description, ['class' => 'empty-state__description']); ?>
    <?= Html::tag('div', $button, ['class' => 'empty-state__btn']) ?>
<?php endif; ?>

<?= Html::endTag('section');
