<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\ThemeAsset;
use app\assets\NotificationAsset;
use app\widgets\ContentHeaderWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

NotificationAsset::register($this);
ThemeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> &ndash; Evaluation Test</title>
    <link rel="icon" type="text/png" href="">
    <?php $this->head() ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="" type="image/png">
</head>
<body class="hold-transition sidebar-mini fixed skin-accessbank">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?= $this->render('../elements/header'); ?>
    <?= $this->render('../elements/sidebar', ['user' => Yii::$app->user->getIdentity()]); ?>

    <div class="content-wrapper <?= ArrayHelper::getValue($this->params, 'content-wrapper-class'); ?>">
        <?= (ArrayHelper::getValue($this->params, 'show-content-header', true)) ? ContentHeaderWidget::widget() : ''; ?>
        <section class="content">
            <?= $content ?>
        </section>
    </div>
    <?= $this->render('../elements/footer'); ?>
</div>

<?= $this->context->showFlashMessages(); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
