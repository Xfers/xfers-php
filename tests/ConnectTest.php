<?php

require_once('../init.php');

\Xfers\Xfers::setApiKey('G-zsfAEScrqdU8GhWTEdjfdnb3XRdU8q1fH-nuWfSzo');
\Xfers\Xfers::setSGSandbox();

$xfers_app_api_key = 'HeqxaZLJy62a4yV58vkmqhCqfYR21tnxCnqz_amtF2M';

try {
    $resp = \Xfers\Connect::authorize(array(
        'phone_no' => '+6597288608',
        'signature' => 'c5535aa2c4d25aa1e18a6a7e421a34e51bda5565'
    ), $xfers_app_api_key);
    print_r($resp);
} catch (\Xfers\Error\Api $e) {
    echo 'Caught Api exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\Connect::getToken(array(
        'otp' => '541231',
        'phone_no' => '+6597288608',
        'signature' => 'c5535aa2c4d25aa1e18a6a7e421a34e51bda5565',
        'return_url' => 'https://mywebsite.com/api/v3/account_registration/completed'
    ), $xfers_app_api_key);
    print_r($resp);
} catch (\Xfers\Error\Api $e) {
    echo 'Caught Api exception: ', $e->getMessage(), "\n";
}