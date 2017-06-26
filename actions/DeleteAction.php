<?php

namespace app\actions;

use app\controllers\BaseController;
use app\libs\Constants;
use app\models\BaseModel;
use yii\base\Action;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DeleteAction extends Action
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
        $deleteModel = $this->model;

        if (!$deleteModel) {
            $controller->flashError('Record not found');
        } else {
            $deleteModel->is_active = Constants::STATUS_IS_NOT_ACTIVE;
            if (!$deleteModel->update()) {
                $controller->flashError($deleteModel->getErrors());
            } else {
                $controller->flashSuccess($this->successMessage);
            }
        }

        return $controller->redirect($this->returnUrl);
    }
}
