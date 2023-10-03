<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Webhooksres extends CI_Controller {
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

$$token = 'Authorization: Bearer 30911337928580013';
$client_secret = get_option("client_secret"); 
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'X-Signature: signature='.$client_secret.',algorithm=HMAC-SHA256',
'Content-Type: application/x-www-form-urlencoded', $token ));
}

}
?>