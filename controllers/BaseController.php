<?php

namespace app\controllers;

use Lukasoppermann\Httpstatus\Httpstatus;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class BaseController
 * @package app\controllers
 * @author Adegoke Obasa <goke@cottacush.com>
 * @author Akinwunmi Taiwo <taiwo@cottacush.com>
 */
class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $excludedPaths = ArrayHelper::getValue(\Yii::$app->params, 'excludedPaths', []);

        $currentRoute = $this->getRoute();

        /**
         * Check if route is in the excluded path
         */
        if ($this->getUser()->isGuest) {
            if (!in_array($currentRoute, $excludedPaths)) {
                $this->getUser()->loginRequired();
                return false;
            }
        }

        return true;
    }

    /**
     * @var Httpstatus $httpStatuses
     */
    protected $httpStatuses;

    public function init()
    {
        parent::init();
        $this->httpStatuses = new Httpstatus();
    }

    /**
     * Executed after action
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        $this->setSecurityHeaders();

        /**
         * Set Current Transaction in New Relic
         * @author Adegoke Obasa <goke@cottacush.com>
         */
        if (extension_loaded('newrelic')) {
            newrelic_name_transaction($action->controller->id . '/' . $action->id);
        }
        return $result;
    }

    /**
     * Set Headers to prevent Click-jacking and XSS
     * @author Adegoke Obasa <goke@cottacush.com>
     */
    private function setSecurityHeaders()
    {
        $headers = Yii::$app->response->headers;
        $headers->add('X-Frame-Options', 'DENY');
        $headers->add('X-XSS-Protection', '1');
    }

    /**
     * Allow sending success response
     * @author Oluwarotimi Akintewe <akintewe.rotimi@gmail.com>
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $data
     * @return array
     */
    public function sendSuccessResponse($data)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->response->setStatusCode(200, $this->httpStatuses->getReasonPhrase(200));

        return [
            'status' => 'success',
            'data' => $data
        ];
    }

    /**
     * Allows sending error response
     * @author Oluwarotimi Akintewe <akintewe.rotimi@gmail.com>
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $message
     * @param $code
     * @param $httpStatusCode
     * @param null $data
     * @return array
     */
    public function sendErrorResponse($message, $code, $httpStatusCode, $data = null)
    {

        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->response->setStatusCode($httpStatusCode, $this->httpStatuses->getReasonPhrase($httpStatusCode));

        $response = [
            'status' => 'error',
            'message' => $message,
            'code' => $code
        ];

        if (!is_null($data)) {
            $response["data"] = $data;
        }

        return $response;
    }

    /**
     * Sends fail response
     * @param $data
     * @author Oluwarotimi Akintewe <akintewe.rotimi@gmail.com>
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param int $httpStatusCode
     * @return array
     */
    public function sendFailResponse($data, $httpStatusCode = 500)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->response->setStatusCode($httpStatusCode, $this->httpStatuses->getReasonPhrase($httpStatusCode));

        return [
            'status' => 'fail',
            'data' => $data
        ];
    }

    /**
     * This flashes error message and sends to the view
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $message
     */
    public function flashError($message)
    {
        if (is_array($message)) {
            /** @var  $error */
            foreach ($message as $error) {
                Yii::$app->session->addFlash('error', $error);
            }
        } else {
            \Yii::$app->session->setFlash('error', $message);
        }
    }

    /**
     * This flashes success message and sends to the view
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $message
     */
    public function flashSuccess($message)
    {
        if (is_array($message)) {
            /** @var  $error */
            foreach ($message as $error) {
                Yii::$app->session->addFlash('success', $error);
            }
        } else {
            \Yii::$app->session->setFlash('success', $message);
        }
    }

    /**
     * Get Yii2 request object
     * @author Adegoke Obasa <goke@cottacush.com>
     * @return \yii\console\Request|\yii\web\Request
     */
    public function getRequest()
    {
        return Yii::$app->request;
    }

    /**
     * Get Yii2 response object
     * @author Adegoke Obasa <goke@cottacush.com>
     * @return \yii\console\Request|\yii\web\Response
     */
    public function getResponse()
    {
        return Yii::$app->response;
    }

    /**
     * Get Yii2 session object
     * @author Adegoke Obasa <goke@cottacush.com>
     * @return mixed|\yii\web\Session
     */
    public function getSession()
    {
        return Yii::$app->session;
    }

    /**
     * Get Yii2 security object
     * @author Adegoke Obasa <goke@cottacush.com>
     * @return \yii\base\Security
     */
    public function getSecurity()
    {
        return Yii::$app->security;
    }

    /**
     * Get web user
     * @author Adegoke Obasa <goke@cottacush.com>
     */
    public function getUser()
    {
        return Yii::$app->user;
    }

    /**
     * show flash messages
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @return string
     */
    public function showFlashMessages($sticky = false)
    {
        $timeout = $sticky ? 0 : 5000;
        $flashMessages = [];
        $allMessages = $this->getSession()->getAllFlashes();
        foreach ($allMessages as $key => $message) {
            if (is_array($message)) {
                $message = $this->mergeFlashMessages($message);
            }
            $flashMessages[] = [
                'message' => $message,
                'type' => $key,
                'timeout' => $timeout
            ];
        }
        $this->getSession()->removeAllFlashes();
        return Html::script('Notifications =' . json_encode($flashMessages));
    }

    /**
     * merge flash messages
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @param $messageArray
     * @return string
     */
    private function mergeFlashMessages($messageArray)
    {
        $messages = array_values($messageArray);
        $flashMessage = '';
        $flashMessageArr = [];
        foreach ($messages as $message) {
            if (is_array($message)) {
                if (strlen($flashMessage) > 0) {
                    $flashMessage .= '<br/>';
                }
                $flashMessage .= $this->mergeFlashMessages($message);
            } else {
                $flashMessageArr[] = $message;
            }
        }



        return $flashMessage . implode('<br/>', $flashMessageArr);
    }

    /**
     * Returns the user for the current module
     * @author Adegoke Obasa <goke@cottacush.com>
     * @return \yii\web\User null|object
     * @throws \yii\base\InvalidConfigException
     */
    public function getModuleUser()
    {
        return $this->module->get('user');
    }

    /**
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @param null $redirectUrl
     * @return bool
     */
    public function isPostCheck($redirectUrl = null)
    {
        if ($this->getRequest()->isPost) {
            return true;
        }
        if (is_null($redirectUrl)) {
            return false;
        }
        $this->sendTerminalResponse($redirectUrl);
    }

    /**
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @param $url
     */
    public function sendTerminalResponse($url)
    {
        $this->redirect($url)->send();
        Yii::$app->end();
    }

    /**
     * @param $key
     * @param $value
     * @param $redirectUrl
     * @return Response
     */
    public function setSessionAndRedirect($key, $value, $redirectUrl)
    {
        $this->getSession()->set($key, $value);
        return $this->redirect($redirectUrl);
    }
}