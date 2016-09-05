<?php

namespace Xfers;

class User extends ApiResource
{
    public static $baseUrl = '/user';

    public static function retrieve($connectKey = null)
    {
        return self::_get(self::$baseUrl, $connectKey);
    }

    public static function update($params, $connectKey = null)
    {
        return self::_put($params, self::$baseUrl, $connectKey);
    }

    public static function transferInfo($connectKey = null)
    {
        $url = self::$baseUrl . "/transfer_info";
        return self::_get($url, $connectKey);
    }

    public static function activities($connectKey = null)
    {
        $url = self::$baseUrl . "/activities";
        return self::_get($url, $connectKey);
    }
}