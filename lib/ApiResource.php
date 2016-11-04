<?php

namespace Xfers;

/**
 * Class ApiResource
 *
 * @package Xfers
 */
abstract class ApiResource
{
    public static function baseUrl()
    {
        return Xfers::$apiBase;
    }

    protected static function _staticRequest($method, $url, $params = null, $connectKey = null)
    {
        $requestor = new ApiRequestor(Xfers::getApiKey(), static::baseUrl());
        return $requestor->request($method, $url, $params, $connectKey);
    }

    protected static function _get($url, $connectKey = null)
    {
        $response = static::_staticRequest('get', $url, null, $connectKey);
        return json_decode($response->body, true);
    }

    protected static function _post($params = null, $url = null, $connectKey = null)
    {
        $response = static::_staticRequest('post', $url, $params, $connectKey);
        return json_decode($response->body, true);
    }

    protected static function _put($params = null, $url = null, $connectKey = null)
    {
        $response = static::_staticRequest('put', $url, $params, $connectKey);
        return json_decode($response->body, true);
    }

    protected static function _delete($url = null, $connectKey = null, $params = null)
    {
        $response = static::_staticRequest('delete', $url, $params, $connectKey);
        return json_decode($response->body, true);
    }
}