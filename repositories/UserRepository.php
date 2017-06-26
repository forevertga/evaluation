<?php

namespace app\repositories;

use Exception;
use yii\helpers\Json;
use yii\log\Logger;

class UserRepository extends BaseRepository
{
    const URL_USER_AUTHENTICATE = '/authentication/authenticate';
    const URL_USER_REGISTER = '/authentication/register';

    /**
     * Calls the USER Authentication API
     * @param $username
     * @param $password
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @return mixed
     */
    public static function login($username, $password)
    {
        return self::post(self::URL_USER_AUTHENTICATE, Json::encode(['username' => $username, 'password' => $password]));
    }

    /**
     * User registration
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @param $data
     * @return mixed
     */
    public function register($data)
    {
        try {
            $response = self::post(self::URL_USER_REGISTER, Json::encode($data));
            return $response;
        } catch (Exception $ex) {
            \Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return null;
    }
}
