<?php

require_once('../init.php');

\Xfers\Xfers::setApiKey('G-zsfAEScrqdU8GhWTEdjfdnb3XRdU8q1fH-nuWfSzo');
\Xfers\Xfers::setSGSandbox();

$resp = \Xfers\Intent::listAll();
print_r($resp);

$intentId = "";

try {
    $resp = \Xfers\Intent::create(array(
        'amount' => '19.99',
        'currency' => 'SGD',
        'bank' => 'DBS',
        'request_id' => 'A012312',
        'notify_url' => 'https://mysite.com/topup_notification'
    ));
    $intentId = $resp["id"];
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\Intent::cancel($intentId);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}