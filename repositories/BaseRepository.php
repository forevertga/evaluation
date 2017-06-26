<?php

namespace app\repositories;

use app\libs\Utils;
use CottaCush\Yii2\HttpClient\TerraHttpClient;
use CottaCush\Yii2\HttpResponse\JSendResponse;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\log\Logger;

/**
 * Class BaseRepository
 * @package app\adapters
 * @author Olawale Lawal <wale@cottacush.com>
 */
class BaseRepository
{
    public static $lastErrorMessage;

    /**
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @return TerraHttpClient
     */
    public static function getClient()
    {
        $baseUrl = ArrayHelper::getValue(Yii::$app->params, 'api_url');
        /** @var TerraHttpClient $client */
        $client = new TerraHttpClient($baseUrl);
        if (ArrayHelper::getValue(Yii::$app->params, 'oauth.enabled', true)) {
            $accessToken = Utils::getAccessToken();
            $client->setAccessToken($accessToken);
        }
        return $client;
    }

    /**
     * Set last error message
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @param $message
     */
    public static function setLastErrorMessage($message)
    {
        self::$lastErrorMessage = $message;
    }

    /**
     * Get last error message
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @return mixed
     */
    public static function getLastErrorMessage()
    {
        return self::$lastErrorMessage;
    }

    /**
     * Handles all the PUT actions to the specified URL
     * @author Olawale Lawal <wale@cottacush.com>
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function put($url, $data)
    {
        $client = self::getClient();
        $response = $client->put($url, $data);
        return $response;
    }

    /**
     * Handles all the GET actions to the specified URL
     * @author Olawale Lawal <wale@cottacush.com>
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function get($url, $data = [])
    {
        $client = self::getClient();
        $response = $client->get($url, $data);
        return $response;
    }

    /**
     * Handles all the POST actions to the specified URL
     * @author Olawale Lawal <wale@cottacush.com>
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function post($url, $data)
    {
        $client = self::getClient();
        $response = $client->post($url, $data);
        return $response;
    }

    /**
     * Handles all the DELETE actions to the specified URL
     * @author Olawale Lawal <wale@cottacush.com>
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function delete($url, $data)
    {
        $client = self::getClient();
        $response = $client->delete($url, $data);
        return $response;
    }

    /**
     * @author Olawale Lawal <wale@cottacush.com>
     * @param $url
     * @param array $data
     * @param array $defaultValue
     * @return array|mixed|null
     */
    public static function getData($url, $data = [], $defaultValue = [])
    {
        try {
            $response = self::get($url, $data);
            $responseHandler = new JSendResponse($response);

            return $responseHandler->isSuccess() ? $responseHandler->getData() : $defaultValue;
        } catch (Exception $ex) {
            \Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return null;
    }
}
