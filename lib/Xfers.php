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
    const SGsandboxBase = 'https://sandbox.xfers.io/api/v3';
    const SGproductionBase = 'https://www.xfers.io/api/v3';
    const IDsandboxBase = 'https://sandbox-id.xfers.com/api/v3';
    const IDproductionBase = 'https://id.xfers.com/api/v3';

    public static $apiBase = "";
    const VERSION = '1.0.0';

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

    public static function setSGProduction()
    {
        self::$apiBase = self::SGproductionBase;
    }

    public static function setSGSandbox()
    {
        self::$apiBase = self::SGsandboxBase;
    }

    public static function setIDProduction()
    {
        self::$apiBase = self::IDproductionBase;
    }

    public static function setIDSandbox()
    {
        self::$apiBase = self::IDsandboxBase;
    }
}