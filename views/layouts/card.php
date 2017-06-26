<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\assets\NotificationAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

AppAsset::register($this);
NotificationAsset::register($this);
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
<body class="hold-transition card-page">
<?php $this->beginBody() ?>
<?= $this->context->showFlashMessages(); ?>
<div class="card-box">
    <div class="card-header">
        <?= Html::tag('div', 'Evaluation Test', ['class' => 'card-logo-caption']); ?>
    </div>
    <div class="card-box-body">
        <?= $content ?>
    </div>
    <div class="card-box-footer">
        <?= ArrayHelper::getValue($this->params, 'card-footer', ''); ?>
    </div>
</div>


<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage();
