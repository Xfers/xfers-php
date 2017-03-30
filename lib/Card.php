<?php

namespace Xfers;

class Card extends ApiResource
{
    public static $baseUrl = '/cards';

    public static function listAll($param)
    {
        if (strpos(Xfers::$apiBase, 'id') !== false) {
            $url = self::$baseUrl . "?customer=" . $param;
            return self::_get($url, null);
        } else {
            $url = self::$baseUrl . "?user_api_token=" . $param;
            return self::_get($url, null);
        }
    }

    public static function add($params)
    {
        return self::_post($params, self::$baseUrl, null);
    }

    public static function delete($id, $userApiToken=null)
    {
        $url = self::$baseUrl . "/" . $id;
        $params = null;
        if ($userApiToken != null) {
            $params = array(
                'user_api_token' => $userApiToken
            );
        }
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

    public static function chargeExisting($chargeId, $token=null)
    {
        $url = "/credit_card_charges/charge_card";
        if ($token != null) {
            $params = array(
                'txn_id' => $chargeId,
                'token' => $token
            );
        } else {
            $params = array(
                'txn_id' => $chargeId
            );
        }
        return self::_post($params, $url, null);
    }

}