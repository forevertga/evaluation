<?php

use app\widgets\UserAvatar;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= Html::beginTag('div', ['class' => 'user-panel']); ?>
<?php echo
    Html::beginTag('div', ['class' => ['image', 'pull-left']]) .
    UserAvatar::widget(['user' => $user, 'size' => 45]) .
    Html::endTag('div') .

    Html::beginTag('div', ['class' => ['info', 'pull-left', 'dropdown']]) .
    Html::beginTag('div', ['class' => ['dropdown-toggle'], 'data-toggle' => 'dropdown']) .
    Html::tag('div', $name . Html::tag('span', '', ['class'=>'caret']), ['class' => ['user-name']]) .
    Html::tag('div', $username, ['class' => 'user-role']) .
    Html::endTag('div') .
    Html::ul([
        Html::a('Sign Out', Url::toRoute('/logout'))
    ], [
        'class' => 'dropdown-menu',
        'encode' => false
    ]) .
    Html::endTag('div'); /* .info */

?>
<?= Html::endTag('div');
