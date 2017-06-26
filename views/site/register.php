<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Sign Up';

?>

<?php $form = ActiveForm::begin(['action' => Url::to('sign-up')]) ?>
<?= Html::beginTag('div', ['class' => 'form-group']); ?>
<?= $form->field($model, 'username')
    ->textInput(['class' => 'form-control'])->label('Username'); ?>
<?= Html::endTag('div'); ?>
<?= Html::beginTag('div', ['class' => 'form-group']); ?>
<?= $form->field($model, 'first_name')
    ->textInput(['class' => 'form-control'])->label('FirstName'); ?>
<?= Html::endTag('div'); ?>
<?= Html::beginTag('div', ['class' => 'form-group']); ?>
<?= $form->field($model, 'last_name')
    ->textInput(['class' => 'form-control'])->label('LastName'); ?>
<?= Html::endTag('div'); ?>
<?= Html::beginTag('div', ['class' => 'form-group']); ?>
<?= $form->field($model, 'password')
    ->passwordInput(['class' => 'form-control'])->label('Password'); ?>
<?= Html::endTag('div'); ?>
<?= Html::tag('button', 'Sign Up', ['class' => 'btn btn-primary btn-block']); ?>
<?php $form::end(); ?>
<?php $this->params['card-footer'] = 'Already a registered user? <a href="login">Sign In</a>';
