<?php
namespace app\libs;

use Hashids\Hashids;
use CottaCush\Yii2\OauthClient\Oauth2Client;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;

/**
 * Class Utils
 * @author Olajide Oye <jide@cottacush.com>
 * @package app\libs
 */
class Utils
{
    const MSME = 'MSME_1234567890';
    const MIN_HASH_LENGTH = 8;

    /**
     * Returns the styled label for the status
     * @author Olajide Oye <jide@cottacush.com>
     * @param $status
     * @param string $extraClasses
     * @return string
     */
    public static function getStatusHtml($status, $extraClasses = '')
    {
        $status = strtolower($status);
        $statusHypenated = implode('-', explode(' ', $status));
        $class = trim("status status--$statusHypenated $extraClasses");
        return Html::tag('span', $status, ['class' => $class]);
    }

    /**
     * Returns the access token
     * @author Adegoke Obasa <goke@cottacush.com>
     * @return mixed
     */
    public static function getAccessToken()
    {
        $oauthClientParams = ArrayHelper::getValue(\Yii::$app->params, 'oauth');
        $oauthClient = new Oauth2Client($oauthClientParams);
        $token = $oauthClient->fetchAccessTokenWithClientCredentials();
        $accessToken = ArrayHelper::getValue($token, 'access_token');
        return $accessToken;
    }

    /**
     * Function to generate a random password
     * @param int $length
     * @return string
     */
    public static function generateRandomPassword($length = 8)
    {
        return strtoupper(Yii::$app->getSecurity()->generateRandomString($length));
    }

    /**
     * @param $message
     * @param $params
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @return mixed
     */
    public static function replaceTemplate($message, $params)
    {
        foreach ($params as $param => $value) {
            $message = str_replace('{{' . $param . '}}', $value, $message);
        }
        return $message;
    }

    /**
     * Generates a unique string of the given length
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param int $length
     * @return string
     */
    public static function generateUniqueId($length = 25)
    {
        return bin2hex(openssl_random_pseudo_bytes($length, $strong));
    }

    /**
     * @author Adeyemi Olaoye <yemi@cottacush.com>
     * @param $array
     * @param $key
     * @return array
     */
    public static function index($array, $key)
    {
        $result = [];
        foreach ($array as $element) {
            $value = ArrayHelper::getValue($element, $key);
            $result[$value][] = $element;
        }

        return $result;
    }

    /**
     * Get's a value if it's non empty
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $array
     * @param $key
     * @param null $default
     * @return null
     */
    public static function getDisplayValue($array, $key, $default = null)
    {
        $value = ArrayHelper::getValue($array, $key, null);
        if ((is_string($value) || is_null($value)) && empty(trim($value))) {
            return $default;
        }
        return $value;
    }

    /**
     * Get the percentage of the numerator & denominator up to a maximum no of decimal places
     * @author Olajide Oye <jide@cottacush.com>
     * @param float|int $numerator
     * @param float|int $denominator
     * @param int $maxDp
     * @return float
     */
    public static function getPercentage($numerator, $denominator, $maxDp = 2)
    {
        $percent = ($numerator * 100) / $denominator;
        return round($percent, $maxDp);
    }

    /**
     * Returns singular form of word if the value $number is 1, plural for every other number
     * @author Olajide Oye <jide@cottacush.com>
     * @param string $word
     * @param int|float $number
     * @return string
     */
    public static function inflectWord($word, $number)
    {
        return ($number == 1) ? Inflector::singularize($word) : Inflector::pluralize($word);
    }

    /**
     * @author Adegoke Obasa <goke@cottacush.com>
     * @return mixed
     */
    public static function getDefaultCookieTimeout()
    {
        return ArrayHelper::getValue(Yii::$app->params, 'defaultCookieLifetime', 0);
    }

    /**
     * Removes all items except the specified keys
     * @author Olawale Lawal <wale@cottacush.com>
     * @param array $array
     * @param string|array $key
     * @return mixed
     */
    public static function keep($array, $key)
    {
        if (!is_array($array)) {
            return $array;
        }

        if (is_array($key)) {
            return array_intersect_key($array, array_flip($key));
        } elseif (isset($array[$key]) || array_key_exists($key, $array)) {
            return $array[$key];
        }
        return null;
    }


    /**
     * Encodes an id into an hash
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $id
     * @param int $hashLength
     * @return string
     */
    public static function encodeId($id, $hashLength = self::MIN_HASH_LENGTH)
    {
        $hashids = new Hashids(self::MSME, $hashLength);
        return $hashids->encode($id);
    }

    /**
     * Decodes a hash into an id
     * @author Adegoke Obasa <goke@cottacush.com>
     * @param $hash
     * @param int $hashLength
     * @return int
     */
    public static function decodeId($hash, $hashLength = self::MIN_HASH_LENGTH)
    {
        $hashids = new Hashids(self::MSME, $hashLength);
        return ArrayHelper::getValue($hashids->decode($hash), '0');
    }

    /**
     * Limit a string to a number of words
     * @author Olajide Oye <jide@cottacush.com>
     * @author Olawale Lawal <wale@cottacush.com>
     *
     * @param $words
     * @param $limit
     * @param string $append
     * @param bool $stripHtml
     * @return array|string
     * @credits https://css-tricks.com/snippets/php/truncate-string-by-words/
     */
    public static function limitWords($words, $limit, $append = '&hellip;', $stripHtml = true)
    {
        if ($stripHtml) {
            $words = strip_tags($words);
            $words = trim(preg_replace('/\s\s+/', ' ', $words));
        }

        $string = preg_split('/(\s+)/u', trim($words), null, PREG_SPLIT_DELIM_CAPTURE);
        if (count($string) / 2 > $limit) {
            return implode('', array_slice($string, 0, ($limit * 2) - 1)) . $append;
        } else {
            return $words;
        }
    }

    /**
     * Collapse an array of arrays into a single array.
     * @author Olawale Lawal <wale@cottacush.com>
     * @param array $array
     * @return array
     */
    public static function collapseArray(array $array)
    {
        $results = [];
        foreach ($array as $values) {
            if (!is_array($values)) {
                continue;
            }
            $results = array_merge($results, $values);
        }
        return $results;
    }
}
