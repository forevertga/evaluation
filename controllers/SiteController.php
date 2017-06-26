<?php

namespace app\controllers;

use app\libs\Utils;
use app\models\BaseModel;
use app\models\Media;
use app\models\SignUpForm;
use app\models\User;
use app\repositories\UserRepository;
use CottaCush\Yii2\HttpResponse\JSendResponse;
use Yii;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\ArrayHelper;

/**
 * @author Akinwunmi Taiwo <taiwo@cottacush.com>
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends BaseController
{
    const DEFAULT_URL = '/';
    const SUPPORT_GROUP_NAME = 'Radius GO Support Group';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @return string
     */
    public function actionIndex()
    {
        $query = Media::find()->asArray();
        $dataProvider = BaseModel::convertToProvider($query, [
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ],
            'attributes' => ['url', 'created_at', 'updated_at',],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionLogin()
    {
        if (!$this->getUser()->isGuest) {
            return $this->redirect('index');
        }

        $this->layout = 'card';
        return $this->render('login', ['model' => new LoginForm()]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        if ($this->getUser()->isGuest)
            return $this->getUser()->loginRequired();
        return $this->render('about');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionSignIn()
    {
        $referrerUrl = $this->getRequest()->referrer;
        if (!$this->isPostCheck()) {
            return $this->redirect($referrerUrl);
        }

        $postData = $this->getRequest()->post();

        $loginForm = new LoginForm();
        $loginForm->load($postData);

        if (!$loginForm->validate()) {
            $this->flashError($loginForm->getErrors());
            return $this->redirect($referrerUrl);
        }

        $username = $loginForm->username;
        $password = $loginForm->password;

        $response = UserRepository::login($username, $password);
        $responseHandler = new JSendResponse($response);

        if (!$responseHandler->isSuccess()) {
            $this->flashError($responseHandler->getErrorMessage());
            return $this->redirect($referrerUrl);
        }

        $user = User::convertToUser($responseHandler->getData());

        if ($this->getUser()->login($user, Utils::getDefaultCookieTimeout())) {
            Yii::$app->session->set('user', serialize($user));
        }

        return $this->redirect(self::DEFAULT_URL);
    }

    public function actionRegister()
    {
        $this->layout = 'card';
        return $this->render('register', ['model' => new SignUpForm()]);
    }

    public function actionSignUp()
    {
        $referrerUrl = $this->getRequest()->referrer;
//
//        if (!$this->isPostCheck() || !$this->getRequest()->isAjax) {
//            return $this->redirect($referrerUrl);
//        }

        $postData = Yii::$app->request->post();
        $data['username'] = ArrayHelper::getValue($postData, 'SignUpForm.username');
        $data['first_name'] = ArrayHelper::getValue($postData, 'SignUpForm.first_name');
        $data['last_name'] = ArrayHelper::getValue($postData, 'SignUpForm.last_name');
        $data['password'] = ArrayHelper::getValue($postData, 'SignUpForm.password');
        $data['display_name'] = ArrayHelper::getValue($postData, 'SignUpForm.username');

        $user = new UserRepository();
        $response = $user->register($data);
        $responseHandler = new JSendResponse($response);

        if (!$responseHandler->isSuccess()) {
            return $this->sendErrorResponse($responseHandler->getErrorMessage(), 500, 500);
        }

        $this->flashSuccess('Account created successfully');
        return $this->redirect('login');
    }
}
