<?php

require_once('../init.php');

\Xfers\Xfers::setApiKey('WuTp3zM7UEpmUkeAyGPxRHmnXAx-hXJ7jzdqmxY6S1o');
\Xfers\Xfers::setSGSandbox();

$resp = \Xfers\Charge::listAll(array(
    'limit' => '1'
));

print_r($resp);

try {
    $resp = \Xfers\Charge::create(array(
        'amount' => '19.99',
        'currency' => 'SGD',
        'order_id' => 'your-custom-order-id',
        'description' => 'Carousell user - Konsolidate',
        'redirect' => 'false'
    ));
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\Charge::retrieve("da454bce431a4f368667aa1db59427ad");
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\Charge::cancel("da454bce431a4f368667aa1db59427ad");
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\Charge::refund("19_A012312");
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    $chargeId = '782f2a6e1b5642edb10c8b6b215c4814';
    $authCode = '213779';
    $resp = \Xfers\Charge::authorize($chargeId, $authCode);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\Charge::validate("20",array(
        'order_id' => 'A012312',
        'total_amount' => '12.49',
        'status' => 'paid',
        'currency' => 'SGD'
    ));
    print_r($resp);
} catch (\Xfers\Error\Api $e) {
    echo 'Caught Api exception: ', $e->getMessage(), "\n";
}
