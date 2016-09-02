<?php

require_once('/Users/seowyanyi/xfers-php/init.php');

\Xfers\Xfers::setApiKey('ENfbme3sus9EjgzXDHoV8W9-MXPj25e4udYst2CGync');
$resp = \Xfers\Account::retrieve();
echo $resp;