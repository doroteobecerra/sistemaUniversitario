<?php

require 'paypal/autoload.php';

define('URL_SITIO', 'http://localhost:3000/sistema/pago_finalizado.php');
    
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'ASSW7Njb-RJY-nzdrnfAnyJLEfutFC95LxKYl4HUdXUHiQNABILhmFT2gYIRjzV1SdKZM-e3z-8X4h8a',//ClienteID
        'EM6Rhvsx6a_UrBlyviJ07T8a6wvYcrDd4efgK12otvg_DgHe7zsLAG1Cn0KySu8LDQxMm_qjH2Wvfoe5'//secret
    )
);