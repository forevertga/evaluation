<?php

namespace app\models;

use Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\log\Logger;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $display_name;
    public $first_name;
    public $last_name;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        if (!Yii::$app->session->has('user')) {
            (new self())->refreshLogin($id);
        }
        $user = unserialize(Yii::$app->session->get('user'));
        return $user ?: null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * Converts login API response to User
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $data
     * @param null $user
     * @return User
     */
    public static function convertToUser($data, $user = null)
    {
        if (is_null($user)) {
            $user = new User();
            $vars = get_object_vars(new self);
        } else {
            $vars = get_object_vars((object)(array_flip(array_keys($data))));
        }

        foreach ($vars as $property => $value) {
            if ($user->hasProperty($property)) {
                $user->$property = ArrayHelper::getValue($data, $property);
            }
        }
        return $user;
    }

    /**
     * @param null $id
     * @return bool
     */
    public function refreshLogin($id = null)
    {
        $id = $id ?: $this->id;
        try {
            $data = AGSUser::find()->where(['id' => $id])
                ->asArray()->one();
            if ($data) {
                $user = $this->convertToUser($data, $this);
                \Yii::$app->session->set('user', serialize($user));
                return true;
            }
        } catch (Exception $ex) {
            Yii::$app->getLog()->getLogger()
                ->log('Could not refresh user login: ' . $ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return false;
    }
}
