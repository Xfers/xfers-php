<?php

namespace Xfers;

class BankAccount extends ApiResource
{
    public static $baseUrl = '/user/bank_account';

    public static function retrieve($connectKey = null)
    {
        return self::_get(self::$baseUrl, $connectKey);
    }

    public static function add($params, $connectKey = null)
    {
        return self::_post($params, self::$baseUrl, $connectKey);
    }


    public static function update($id, $params, $connectKey = null)
    {
        $url = self::$baseUrl . "/" . $id;
        return self::_put($params, $url, $connectKey);
    }

    public static function delete($id, $connectKey = null)
    {
        $url = self::$baseUrl . "/" . $id;
        return self::_delete($url, $connectKey);
    }

    public static function withdraw($id, $params, $connectKey = null)
    {
        $url = self::$baseUrl . "/" . $id . "/withdraw";
        return self::_post($params, $url, $connectKey);
    }

    public static function withdrawalRequests($params = null, $connectKey = null)
    {
        $url = self::$baseUrl . "/withdrawal_requests";
        if (!empty($params)) {
            $url = self::$baseUrl . "/withdrawal_requests?" . http_build_query($params);
        }
        return self::_get($url, $connectKey);
    }
}