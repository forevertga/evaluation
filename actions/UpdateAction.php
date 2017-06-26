<?php

namespace app\actions;

use app\controllers\BaseController;
use app\models\BaseModel;
use yii\base\Action;
use yii\base\Model;
use yii\db\IntegrityException;
use yii\helpers\ArrayHelper;

class UpdateAction extends Action
{
    public $returnUrl = '';
    public $successMessage = '';
    public $model;
    public $postData;
    public $integrityExceptionMessage = 'Record cannot be updated as it is in use elsewhere';

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
        $postData = $this->postData;
        $updateModel = $this->model;

        try {
            if (!$updateModel) {
                $controller->flashError('Record not found');
                return $controller->redirect($referrerUrl);
            }
            $updateModel->load($postData);

            if (!$updateModel->update()) {
                $controller->flashError($updateModel->getErrors());
                return $controller->redirect($referrerUrl);
            }

        } catch (IntegrityException $ex) {
            $controller->flashError($this->integrityExceptionMessage);
            return $controller->redirect($referrerUrl);
        }

        $controller->flashSuccess($this->successMessage);
        return $controller->redirect($this->returnUrl);
    }
}
