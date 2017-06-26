<?php

use app\models\Permission;
use app\widgets\SidebarMenuWidget;
use app\widgets\SidebarUserPanelWidget;
use yii\helpers\Html;

/** @var \app\controllers\BaseController $context */
$context = $this->context;
?>
<?= Html::beginTag('aside', ['class' => 'main-sidebar']) ?>
<?= Html::beginTag('section', ['class' => 'sidebar']) ?>
<?= SidebarUserPanelWidget::widget([
    'user' => $user
]) ?>
<?= SidebarMenuWidget::widget([
    'items' => [
        [
            'name' => 'NAVIGATION',
            'options' => ['class' => 'header']
        ],
    ],
]); ?>

<?= Html::endTag('section') ?>
<?= Html::endTag('aside');

