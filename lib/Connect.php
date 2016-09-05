<?php

namespace Xfers;

class Connect extends ApiResource
{
    public static $baseUrl = '/authorize';

    public static function authorize($params, $connectKey)
    {
        $url = self::$baseUrl . "/signup_login";
        return self::_post($params, $url, $connectKey);
    }

    public static function getToken($params, $connectKey)
    {
        $url = self::$baseUrl . "/get_token?" . http_build_query($params);
        return self::_get($url, $connectKey);
    }
}