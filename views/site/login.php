<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Sign In';

?>

<?php $form = ActiveForm::begin(['action' => Url::to('sign-in')]) ?>
<?= Html::beginTag('div', ['class' => 'form-group']); ?>
<?= $form->field($model, 'username')
    ->textInput(['class' => 'form-control'])->label('Username'); ?>
<?= Html::endTag('div'); ?>
<?= Html::beginTag('div', ['class' => 'form-group']); ?>
<?= $form->field($model, 'password')
    ->passwordInput(['class' => 'form-control'])->label('Password'); ?>
<?= Html::endTag('div'); ?>
<?= Html::tag('button', 'Sign In', ['class' => 'btn btn-primary btn-block']); ?>
<?php $form::end(); ?>
<?php $this->params['card-footer'] = 'Not a registered user yet? <a href="register">Sign Up</a>';
