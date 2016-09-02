<?php
// Xfers singleton
require(dirname(__FILE__) . '/lib/Xfers.php');
// Utilities
require(dirname(__FILE__) . '/lib/Util/AutoPagingIterator.php');
require(dirname(__FILE__) . '/lib/Util/RequestOptions.php');
require(dirname(__FILE__) . '/lib/Util/Set.php');
require(dirname(__FILE__) . '/lib/Util/Util.php');
// HttpClient
require(dirname(__FILE__) . '/lib/HttpClient/ClientInterface.php');
require(dirname(__FILE__) . '/lib/HttpClient/CurlClient.php');
// Errors
require(dirname(__FILE__) . '/lib/Error/Base.php');
require(dirname(__FILE__) . '/lib/Error/Api.php');
require(dirname(__FILE__) . '/lib/Error/ApiConnection.php');
require(dirname(__FILE__) . '/lib/Error/Authentication.php');
require(dirname(__FILE__) . '/lib/Error/InvalidRequest.php');
require(dirname(__FILE__) . '/lib/Error/RateLimit.php');
// Plumbing
require(dirname(__FILE__) . '/lib/ApiResponse.php');
require(dirname(__FILE__) . '/lib/JsonSerializable.php');
require(dirname(__FILE__) . '/lib/XfersObject.php');
require(dirname(__FILE__) . '/lib/ApiRequestor.php');
require(dirname(__FILE__) . '/lib/ApiResource.php');
require(dirname(__FILE__) . '/lib/SingletonApiResource.php');

// Xfers API Resources
require(dirname(__FILE__) . '/lib/Account.php');