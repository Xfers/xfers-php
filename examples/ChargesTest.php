<?php

require_once('../init.php');

\Xfers\Xfers::setApiKey('G-zsfAEScrqdU8GhWTEdjfdnb3XRdU8q1fH-nuWfSzo');
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
    $resp = \Xfers\Charge::settle("qz454bce431a4f387567aa1db59427py");
    print_r($resp);
} catch (\Xfers\Error\Api $e) {
    echo 'Caught Api exception: ', $e->getMessage(), "\n";
}


try {
    $resp = \Xfers\Charge::refund("19_A012312");
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
