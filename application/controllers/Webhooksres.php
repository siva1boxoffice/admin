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


    $secret_hmacKey           = "YOUR_API_KEY";
    $payload                  = file_get_contents("php://input");
    $signature                = $_SERVER['HTTP_X_SIGNATURE'];
   

    $yourHash                 = hash_hmac('sha256', $payload, $secret_hmacKey);
   
    if($yourHash == @$signature_value){

        // Your stuf here

        echo json_encode(array('status' => 'accepted','status_code' => 200));exit;
    }
    else{
        echo json_encode(array('status' => 'refused','status_code' => 401));exit;
    }




}

}
?>