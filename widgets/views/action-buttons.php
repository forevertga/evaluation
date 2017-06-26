<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$context = $this->context;

$links = [];
foreach ($actions as $action) {
    if (ArrayHelper::getValue($action, 'visible', true)) {
        $links[] = $action;
    }
};

$noOfLinks = count($links);
?>
<?php if ($noOfLinks == 1) :
    $action = $links[0];
    $options = ArrayHelper::merge(['class' => 'btn btn-sm btn-default'], ArrayHelper::getValue($action, 'attrs', []));
    ?>
    <?= Html::a(ArrayHelper::getValue($action, 'text'), ArrayHelper::getValue($action, 'url'), $options); ?>
<?php elseif ($noOfLinks > 1) : ?>
    <?= Html::beginTag('div', ['class' => 'btn-group']); ?>

    <?= Html::button('Actions &nbsp;<span class="caret"></span>', [
        'type' => 'button', 'class' => 'btn btn-sm btn-default dropdown-toggle', 'data-toggle' => 'dropdown',
        'aria-haspopup' => 'true', 'aria-expanded' => 'false'
    ]); ?>

    <?= Html::beginTag('ul', ['class' => 'dropdown-menu dropdown-menu-right']); ?>
    <?php foreach ($links as $action) { ?>
        <?php if (ArrayHelper::getValue($action, 'visible', true)) : ?>
            <?= Html::beginTag('li'); ?>
            <?= Html::a(
                ArrayHelper::getValue($action, 'text'),
                ArrayHelper::getValue($action, 'url'),
                ArrayHelper::getValue($action, 'attrs', [])
            ); ?>
            <?= Html::endTag('li'); ?>
        <?php endif; ?>
    <?php } ?>
    <?= Html::endTag('ul'); ?>

    <?= Html::endTag('div'); ?>
<?php endif;
