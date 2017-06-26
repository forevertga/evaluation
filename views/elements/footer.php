<?php

use yii\helpers\Html;

?>

<?= Html::beginTag('footer', ['class' => 'main-footer']); ?>
<?= Html::tag('div', 'Evaluation Test', ['class' => 'pull-right hidden-xs text-muted']) ?>
<strong>Copyright &copy; <?= date('Y'); ?> <a target="_blank" href="">Evaluation Test</a>.</strong>
All rights reserved.
<?= Html::endTag('footer');
