<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?=
Html::beginTag('header', ['class' => 'main-header']) .
Html::a(
    '',
    Url::toRoute('/'),
    ['class' => 'logo']
) .
Html::beginTag('nav', ['class' => 'navbar navbar-static-top', 'role' => 'navigation']) .
Html::tag(
    'a',
    Html::tag('span', 'Toggle navigation', ['class' => 'sr-only']),
    ['class' => 'sidebar-toggle', 'data-toggle' => 'offcanvas', 'role' => 'button']
) .
Html::beginTag('div', ['class' => 'navbar-custom-menu pull-left']) .
Html::ul([
], ['class' => ['nav', 'navbar-nav'], 'encode' => false]) .
Html::endTag('div') .
Html::endTag('nav') .
Html::endTag('header');
