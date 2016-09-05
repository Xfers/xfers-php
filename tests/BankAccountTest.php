<?php

require_once('../init.php');

\Xfers\Xfers::setApiKey('G-zsfAEScrqdU8GhWTEdjfdnb3XRdU8q1fH-nuWfSzo');
\Xfers\Xfers::setSGSandbox();

try {
    $resp = \Xfers\BankAccount::add(array(
        'account_no' => '12988012511',
        'bank' => 'OCBC'
    ));
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}


try {
    $resp = \Xfers\BankAccount::add(array(
        'account_no' => '03931234321',
        'bank' => 'DBS'
    ));
    print_r($resp);

} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}


try {
    $resp = \Xfers\BankAccount::retrieve();
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\BankAccount::delete('1');
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\BankAccount::update('6', array(
        'account_no' => '209367866',
        'bank' => 'POSB'
    ));
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\BankAccount::withdraw('8', array(
        'amount' => '20',
        'express' => false
    ));
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}

try {
    $resp = \Xfers\BankAccount::withdrawalRequests(array(
        'filter' => 'pending'
    ));
    print_r($resp);
} catch (\Xfers\Error\InvalidRequest $e) {
    echo 'Caught invalid request exception: ', $e->getMessage(), "\n";
}