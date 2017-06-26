<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

?>
<?= Html::beginTag('section', ['class' => 'content-header']); ?>
<?= Html::tag('h1', $title, ['class' => 'content-header-title']); ?>
<?= $button; ?>
<?= Breadcrumbs::widget([
    'tag' => 'ol',
    'homeLink' => [
        'label' => 'Home',
        'url' => Url::toRoute('/admin/')
    ],
    'links' => $breadcrumbs
]) ?>
<?= Html::endTag('section');