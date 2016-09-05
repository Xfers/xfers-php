<?php

require_once('../init.php');

\Xfers\Xfers::setApiKey('G-zsfAEScrqdU8GhWTEdjfdnb3XRdU8q1fH-nuWfSzo');
\Xfers\Xfers::setSGSandbox();

try {
    $resp = \Xfers\Payout::create(array(
        'amount' => '150',
        'invoice_id' => 'GYM-MEMBERSHIP',
        'recipient' => 'demo@xfers.io'
    ));
    print_r($resp);
    echo $resp["id"] . "\n";
    echo $resp["recipient"] . "\n";
    echo $resp["invoice_id"] . "\n";
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\Payout::retrieve("1");
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}

$resp = \Xfers\Payout::listAll(array(
    'recipient' => '+6597288608'
));
print_r($resp);