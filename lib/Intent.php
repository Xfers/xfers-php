<?php

namespace Xfers;

class Intent extends ApiResource
{
    public static $baseUrl = '/intents';

    public static function retrieve($connectKey = null)
    {
        return self::_get(self::$baseUrl, $connectKey);
    }

    public static function create($params, $connectKey = null)
    {
        return self::_post($params, self::$baseUrl, $connectKey);
    }

    public static function cancel($intentId, $connectKey = null)
    {
        if (empty($intentId)) {
            throw new Error\InvalidRequest("Intent id cannot be empty", 400);
        }
        $url = self::$baseUrl . "/" . $intentId . "/cancel";
        return self::_post(null, $url, $connectKey);
    }
}