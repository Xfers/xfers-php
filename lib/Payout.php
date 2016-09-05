<?php

namespace Xfers;

class Payout extends ApiResource
{
    public static $baseUrl = '/payouts';

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
}