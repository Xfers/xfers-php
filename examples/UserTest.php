<?php

require_once('../init.php');

\Xfers\Xfers::setApiKey('G-zsfAEScrqdU8GhWTEdjfdnb3XRdU8q1fH-nuWfSzo');
\Xfers\Xfers::setSGSandbox();

$resp = \Xfers\User::retrieve();
print_r($resp);
echo $resp["available_balance"] . "\n";
echo $resp["address_line_1"] . "\n";
echo $resp["bank_accounts"] . "\n";

$resp = \Xfers\User::update(array(
    'first_name' => 'Tommy',
    'last_name' => 'Tan',
    'email' => 'jelly@xfers.io',
    'date_of_birth' => '1986-02-27',
    'address_line_1' => 'Blk 608 Jurong East',
    'address_line_2' => '#08-41',
    'nationality' => 'Singaporean',
    'postal_code' => '510608',
    'identity_no' => 'S8692038G',
    'id_front_url' => 'http://angelsgateadvisory.sg/wp-content/uploads/2015/10/Logo.jpg',
    'id_back_url' => 'http://angelsgateadvisory.sg/wp-content/uploads/2015/10/Logo.jpg',
    'selfie_2id_url' => 'http://angelsgateadvisory.sg/wp-content/uploads/2015/10/Logo.jpg',
    'proof_of_address_url' => 'http://angelsgateadvisory.sg/wp-content/uploads/2015/10/Logo.jpg',
    'meta_data' => 'foobar'
));
print_r($resp);

$resp = \Xfers\User::transferInfo();
print_r($resp);

$resp = \Xfers\User::activities();
print_r($resp);