<?php

$hmacKey    = 30911337928580013;

$merchantId = 1100004624;
$amount     = $total * 100;
$currency   = 'EUR';
$refno      = $orderId;

// HMAC Hex to byte
$secret     = hex2bin("$hmacKey");

// Concat infos
$string     = $merchantId . $amount. $currency . $refno;

// generate SIGN
$sign       = bin2hex(hash_hmac('sha256', $string, $secret)); 

echo $sign;exit;
?>