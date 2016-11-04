<?php

namespace Xfers;

class Charge extends ApiResource
{
    public static $baseUrl = '/charges';

    public static function retrieve($id, $connectKey = null)
    {
        $url = self::$baseUrl . "/" . $id;
        return self::_get($url, $connectKey);
    }

    public static function listAll($params = null, $connectKey = null)
    {
        $url = self::$baseUrl;
        if (!empty($params)) {
            $url = self::$baseUrl . "?" . http_build_query($params);
        }
        return self::_get($url, $connectKey);
    }

    public static function create($params, $connectKey = null)
    {
        return self::_post($params, self::$baseUrl, $connectKey);
    }

    public static function refund($id, $connectKey = null)
    {
        $url = self::$baseUrl . "/" . $id . "/refunds";
        return self::_post(null, $url, $connectKey);
    }

    public static function validate($transactionId, $params, $connectKey = null)
    {
        $url = self::$baseUrl . "/" . $transactionId . "/validate";
        return self::_post($params, $url, $connectKey);
    }

    public static function cancel($chargeId, $connectKey = null)
    {
        if (empty($chargeId)) {
            throw new Error\InvalidRequest("Charge id cannot be empty", 400);
        }
        $url = self::$baseUrl . "/" . $chargeId . "/cancel";
        return self::_post(null, $url, $connectKey);
    }

    public static function authorize($chargeId, $authCode)
    {
        if (empty($chargeId)) {
            throw new Error\InvalidRequest("Charge id cannot be empty", 400);
        }

        if (empty($authCode)) {
            throw new Error\InvalidRequest("Auth code cannot be empty", 400);
        }

        $params = array(
            'auth_code' => $authCode
        );

        $url = self::$baseUrl . "/" . $chargeId . "/authorize";
        return self::_post($params, $url, null);
    }
}