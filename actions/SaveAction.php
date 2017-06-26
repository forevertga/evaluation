<?php

namespace app\actions;

use app\controllers\BaseController;
use app\models\BaseModel;
use yii\base\Action;
use yii\base\Model;

/**
 * @author Akinwunmi Taiwo <taiwo@cottacush.com>
 * Class SaveAction
 * @package app\actions
 */
class SaveAction extends Action
{
    public $returnUrl = '';
    public $successMessage = '';
    public $model;

    /**
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @return \yii\web\Response
     */
    public function run()
    {
        /** @var BaseController $controller */
        $controller = $this->controller;

        $referrerUrl = $controller->getRequest()->referrer;
        $controller->isPostCheck($referrerUrl);

        $postData = $controller->getRequest()->post();

        $model = new  $this->model;
        $model->load($postData);

        if(!$model->save()) {
            $controller->flashError($model->getErrors());
            return $controller->redirect($referrerUrl);
        }

        $controller->flashSuccess($this->successMessage);
        return $controller->redirect($this->returnUrl);
    }
}
