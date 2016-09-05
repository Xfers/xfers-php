<?php

namespace Xfers;

/**
 * Class ApiRequestor
 *
 * @package Xfers
 */
class ApiRequestor
{
    private $_apiKey;

    private $_apiBase;

    private static $_httpClient;

    public function __construct($apiKey = null, $apiBase = null)
    {
        $this->_apiKey = $apiKey;
        if (!$apiBase) {
            $apiBase = Xfers::$apiBase;
        }
        $this->_apiBase = $apiBase;
    }

    public function request($method, $url, $params = null, $connectKey = null)
    {
        if (!$params) {
            $params = array();
        }

        $headers = array();

        list($rbody, $rcode, $rheaders) =
            $this->_requestRaw($method, $url, $params, $headers, $connectKey);
        $json = $this->_interpretResponse($rbody, $rcode, $rheaders);
        return new ApiResponse($rbody, $rcode, $rheaders, $json);
    }

    public function handleApiError($rbody, $rcode, $rheaders, $resp)
    {
        if (!is_array($resp) || !isset($resp['error'])) {
            $msg = "Invalid response object from API: $rbody "
              . "(HTTP response code was $rcode)";
            throw new Error\Api($msg, $rcode, $rbody, $resp, $rheaders);
        }

        $msg = $resp['error'];

        switch ($rcode) {
            case 400:
                throw new Error\InvalidRequest($msg, $rcode, $rbody, $resp, $rheaders);
            default:
                throw new Error\Api($msg, $rcode, $rbody, $resp, $rheaders);
        }
    }

    private function _requestRaw($method, $url, $params, $headers, $connectKey = null)
    {
        $myApiKey = $this->_apiKey;
        if (!$myApiKey) {
            $myApiKey = Xfers::$apiKey;
        }

        if (!$myApiKey) {
            $msg = 'No API key provided.  (HINT: set your API key using '
              . '"Xfers::setApiKey(<API-KEY>)".  You can generate API keys from '
              . 'the Xfers web interface.  See http://docs.xfers.io/#authentication for '
              . 'details, or email support@xfers.io if you have any questions.';
            throw new Error\Authentication($msg);
        }

        $absUrl = $this->_apiBase.$url;

        $langVersion = phpversion();
        $uname = php_uname();
        $ua = array(
            'bindings_version' => Xfers::VERSION,
            'lang' => 'php',
            'lang_version' => $langVersion,
            'publisher' => 'xfers',
            'uname' => $uname,
        );
        $defaultHeaders = array(
            'X-Xfers-Client-User-Agent' => json_encode($ua),
            'User-Agent' => 'Xfers/v3 PhpBindings/' . Xfers::VERSION
        );

        $hasFile = false;
        $hasCurlFile = class_exists('\CURLFile', false);
        foreach ($params as $k => $v) {
            if (is_resource($v)) {
                $hasFile = true;
                $params[$k] = self::_processResourceParam($v, $hasCurlFile);
            } elseif ($hasCurlFile && $v instanceof \CURLFile) {
                $hasFile = true;
            }
        }

        if ($hasFile) {
            $defaultHeaders['Content-Type'] = 'multipart/form-data';
        } else {
            $defaultHeaders['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        if (!empty($connectKey)) {
            $defaultHeaders['X-XFERS-APP-API-KEY'] = $connectKey;
        } else {
            $defaultHeaders['X-XFERS-USER-API-KEY'] = $myApiKey;
        }

        $combinedHeaders = array_merge($defaultHeaders, $headers);
        $rawHeaders = array();

        foreach ($combinedHeaders as $header => $value) {
            $rawHeaders[] = $header . ': ' . $value;
        }

        list($rbody, $rcode, $rheaders) = $this->httpClient()->request(
            $method,
            $absUrl,
            $rawHeaders,
            $params,
            $hasFile
        );
        return array($rbody, $rcode, $rheaders);
    }

    private function _processResourceParam($resource, $hasCurlFile)
    {
        if (get_resource_type($resource) !== 'stream') {
            throw new Error\Api(
                'Attempted to upload a resource that is not a stream'
            );
        }

        $metaData = stream_get_meta_data($resource);
        if ($metaData['wrapper_type'] !== 'plainfile') {
            throw new Error\Api(
                'Only plainfile resource streams are supported'
            );
        }

        if ($hasCurlFile) {
            // We don't have the filename or mimetype, but the API doesn't care
            return new \CURLFile($metaData['uri']);
        } else {
            return '@'.$metaData['uri'];
        }
    }

    private function _interpretResponse($rbody, $rcode, $rheaders)
    {
        try {
            $resp = json_decode($rbody, true);
        } catch (Exception $e) {
            $msg = "Invalid response body from API: $rbody "
              . "(HTTP response code was $rcode)";
            throw new Error\Api($msg, $rcode, $rbody);
        }

        if ($rcode < 200 || $rcode >= 300) {
            $this->handleApiError($rbody, $rcode, $rheaders, $resp);
        }
        return $resp;
    }

    public static function setHttpClient($client)
    {
        self::$_httpClient = $client;
    }

    private function httpClient()
    {
        if (!self::$_httpClient) {
            self::$_httpClient = HttpClient\CurlClient::instance();
        }
        return self::$_httpClient;
    }
}
