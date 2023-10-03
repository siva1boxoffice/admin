<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Webhooks extends CI_Controller {
    public function __construct() {
        /*
         *  Developed by: Sivakumar G
         *  Date    : 22 January, 2022
         *  1BoxOffice Hub
         *  https://www.1boxoffice.com/
        */
        parent::__construct();
    }


   public function index() {

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


$token          = 'Authorization: Bearer 30911337928580013';
$client_secret  = '65303366666431346433343738333464386530343036333736396439663735666264663063326530333463646331346466343735366634313063373462353661'; 
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'X-Signature: signature='.$client_secret.',algorithm=HMAC-SHA256',
'Content-Type: application/x-www-form-urlencoded', $token ));

//65303366666431346433343738333464386530343036333736396439663735666264663063326530333463646331346466343735366634313063373462353661
}

}
?>