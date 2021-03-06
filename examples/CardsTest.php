<?php

require_once('../init.php');
// INDO
\Xfers\Xfers::setIDSandbox();

try {
    echo "Charge guest card\n";
    $chargeId = '670ee7406c424968ac5587852743ebd1'; // you must create a charge first
    $params = array(
        'txn_id' => $chargeId,
        'card_name' => 'Visnu',
        'card_type' => 'V',
        'card_no' => '4137180300023783',
        'card_cvc' => '666',
        'expiry_month' => '01',
        'expiry_year' => '2021',
        'save_card' => true
    );
    $resp = \Xfers\Card::chargeGuest($params);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    \Xfers\Xfers::setApiKey('LXcbEXxAZ894yVsSC1-iLpUWFx_RKTgeASsdL5TZhbc');
    echo "Listing all cards\n";
    $customer = "hello@xfers.io";
    $resp = \Xfers\Card::listAll($customer);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    echo "Charge existing card\n";
    $chargeId = '5d8c605550114d3fbfdeffbf85ba3d69';
    $token = '2D23113F-307F-41CA-8921-7A977668E3EC';
    $resp = \Xfers\Card::chargeExisting($chargeId, $token);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    echo "Deleting card\n";
    $token = '2D23113F-307F-41CA-8921-7A977668E3EC';
    $resp = \Xfers\Card::delete($token);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}


// SINGAPORE
\Xfers\Xfers::setApiKey('WuTp3zM7UEpmUkeAyGPxRHmnXAx-hXJ7jzdqmxY6S1o');
\Xfers\Xfers::setSGSandbox();

// Get the following user_api_token from http://docs.xfers.io/#xfers-connect
// you should have one user_api_token for every user you wish to add a credit card to.
$user_api_token = 'osEdbc8uzxY5vaXA-oe-7E86sVWCYTCVPuHQyFQ-uPQ';

try {
    echo "Listing all cards\n";
    $resp = \Xfers\Card::listAll($user_api_token);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    echo "Adding card\n";
    $params = array(
        'user_api_token' => $user_api_token,
        'credit_card_token' => 'tok_19BhBuB8MXWbQJDjkspwaL4n', // gotten from http://docs.xfers.io/#xfers-tokenize
        'first6' => '424242',
        'last4' => '4242'
    );
    $resp = \Xfers\Card::add($params);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    echo "Deleting card\n";
    $card_id = 'card_196hygI7jGeCrIKDAwXhGcHm';
    $resp = \Xfers\Card::delete($card_id, $user_api_token);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    echo "Setting default card\n";
    $card_id = 'card_196iRQI7jGeCrIKDl5hrCmxE';
    $resp = \Xfers\Card::setDefault($card_id, $user_api_token);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    echo "Charge guest card\n";
    $chargeId = '051ac2fe464d45b19ec736cf04d66653'; // you must create a charge first
    $params = array(
        'txn_id' => $chargeId,
        'credit_card_token' => 'tok_19BhUlB8MXWbQJDjOrDecHN6', // gotten from http://docs.xfers.io/#xfers-tokenize
        'first6' => '424242',
        'last4' => '4242'
    );
    $resp = \Xfers\Card::chargeGuest($params);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}

try {
    echo "Charge existing card\n";
    // You must add a credit card with Xfers\Card::add before this
    $chargeId = 'ae9647515a234b95919ce5dbd6e073e8'; // you must create a charge with user_api_token of your user passed in
    $resp = \Xfers\Card::chargeExisting($chargeId);
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught InvalidRequest exception: ', $e->getMessage(), "\n";
}
