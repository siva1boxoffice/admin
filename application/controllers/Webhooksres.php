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


    $secret_hmacKey           = "05b82d846749cf7f6b24c576b9";
    $payload                  = file_get_contents("php://input");
    $signature                = $_SERVER['HTTP_X_SIGNATURE'];
    $signature_data           = explode(',',$signature);
    $signature_value          = explode('=',$signature_data[0]);
   

    $yourHash                 = hash_hmac('sha256', $payload, $secret_hmacKey);
   
    if($yourHash == @$signature_value[1]){


      /*  echo "<pre>";print_r($payload);
        echo "<pre>";print_r($_SERVER);*/

        echo json_encode(array('status' => 'accepted','status_code' => 200));exit;
    }
    else{
        echo json_encode(array('status' => 'refused','status_code' => 401));exit;
    }




}

}
?>