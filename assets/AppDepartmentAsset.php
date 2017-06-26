<?php

namespace app\assets;

class AppDepartmentAsset extends BaseAppAsset
{
    public $js = [
        'js/widgets/department.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
