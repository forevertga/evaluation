<?php

use app\widgets\UserAvatar;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?= Html::beginTag('li', ['class' => ['dropdown', 'user', 'user-menu']]) ?>

<?= Html::beginTag('a', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#']) ?>
<?= UserAvatar::widget(['user' => $user, 'size' => 30, 'options' => ['class' => 'user-image']]) ?>
<?= Html::tag('span', $name, ['class' => 'hidden-xs']) ?>
<?= Html::endTag('a') ?>

<?= Html::beginTag('ul', ['class' => 'dropdown-menu']) ?>

<?= Html::beginTag('li', ['class' => 'user-header']) ?>
<?= UserAvatar::widget(['user' => $user, 'size' => 84]) ?>
<?= Html::tag('p', $name . Html::tag('small', $userType)); ?>
<?= Html::endTag('li'); ?>

<?= Html::beginTag('li', ['class' => 'user-footer']) ?>

<?= Html::tag(
    'div',
    Html::a('Profile', Url::toRoute('/admin/profile/'), ['class' => ['btn', 'btn-default', 'btn-flat']]),
    ['class' => 'pull-left']
) ?>
<?= Html::tag(
    'div',
    Html::a('Sign out', Url::toRoute('/admin/logout'), ['class' => ['btn', 'btn-default', 'btn-flat']]),
    ['class' => 'pull-right']
) ?>
<?= Html::endTag('li'); ?>

<?= Html::endTag('ul'); ?>

<?= Html::endTag('li');
