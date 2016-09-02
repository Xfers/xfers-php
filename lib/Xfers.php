<?php

namespace Xfers;

/**
 * Class Xfers
 *
 * @package Xfers
 */
class Xfers
{
    // @var string The Xfers API key to be used for requests.
    public static $apiKey;

    // @var string The base URL for the Xfers API.
    public static $apiBase = 'https://sandbox.xfers.io/api';

    const VERSION = '0.0.1';

    /**
     * @return string The API key used for requests.
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param string $apiKey
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @return string The API version used for requests. null if we're using the
     *    latest version.
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param string $apiVersion The API version to use for requests.
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }
}