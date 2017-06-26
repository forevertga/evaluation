<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([ 'action' => $action, 'method' => $method]);?>
<?= Html::beginTag('div', ['class' => 'form-group form-title-group']); ?>
<?= $form->field($model, 'name')->textInput(['class' => 'form-control']); ?>
<?= $form->field($model, 'id')->hiddenInput()->label(null, ['class' => 'hide']); ?>
<?= Html::endTag('div'); ?>
<?php $form::end();?>
