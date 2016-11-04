<?php

namespace Xfers;

class Card extends ApiResource
{
    public static $baseUrl = '/cards';

    public static function listAll($userApiToken)
    {
        $url = self::$baseUrl . "?user_api_token=" . $userApiToken;
        return self::_get($url, null);
    }

    public static function add($params)
    {
        return self::_post($params, self::$baseUrl, null);
    }

    public static function delete($id, $userApiToken)
    {
        $url = self::$baseUrl . "/" . $id;
        $params = array(
            'user_api_token' => $userApiToken
        );
        return self::_delete($url, null, $params);
    }

    public static function setDefault($id, $userApiToken)
    {
        $params = array(
            'user_api_token' => $userApiToken
        );
        $url = self::$baseUrl . "/" . $id . "/set_default";
        return self::_post($params, $url, null);
    }

    public static function chargeGuest($params)
    {
        $url = "/credit_card_charges/charge_card_guest";
        return self::_post($params, $url, null);
    }

    public static function chargeExisting($chargeId)
    {
        $url = "/credit_card_charges/charge_card";
        $params = array(
            'txn_id' => $chargeId
        );
        return self::_post($params, $url, null);
    }

}