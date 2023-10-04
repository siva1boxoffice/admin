<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Webhooks extends CI_Controller {
    public function __construct() {
      
        parent::__construct();
        $this->load->model('General_Model');
    }


   public function index($booking_no = "") {

    $booking_no = md5($booking_no);
    $orderData =  $this->General_Model->getOrderData($booking_no);
    if($orderData->booking_status == 2 && $orderData->hook_status == 1){
    
    $sell_tickets =       $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $orderData->ticket_id))->row();
    $status = "ACTIVE";
    if($sell_tickets->status == 1){
        $status = "ACTIVE";
    }
    else if($sell_tickets->status == 2){
        $status = "DELETED";
    }
    else if($sell_tickets->status == 0){
        $status = "INACTIVE";
    }

    if(!empty($orderData)){

  $secret_hmacKey           = "05b82d846749cf7f6b24c576b9";

  $post_data = array(
 
     "listingId"            =>  $orderData->ticket_id,
     "saleId"               =>  $orderData->booking_no,
     "dateTime"             =>  $orderData->created_at,
     "status"               =>  $status,
     "soldQuantity"         =>  $orderData->quantity,
     "remainingQuantity"    =>  $sell_tickets->quantity,
     "currencyCode"         =>  $sell_tickets->price_type,
     "unitPrice"            =>  $orderData->price,
     "totalPrice"           =>  $orderData->ticket_amount,
     "section"              =>  $orderData->seat_category,
     "row"                  =>  $orderData->row,
     "seats"                =>  "",
     "deliveryMethod"       =>  "EMAIL",

  );

$post_data["customer"] = array(

    "firstName"               =>  $orderData->first_name,
    "lastName"                =>  $orderData->last_name,
    "shippingAddress"         =>  array(
        "firstLine"     => "",
        "secondLine"    => "",
        "city"          => "",
        "postCode"      => "",
        "country"       => ""
    ),
    "email"             =>  "",
   "phoneNumber"        => ""
);
$post_str                = json_encode($post_data);
$client_secret       = hash_hmac('sha256', $post_str, $secret_hmacKey); 
$token               = 'Authorization: Bearer '.$secret_hmacKey;
$service_url         = "http://localhost/admin_main/admin_siva/Webhooksres";

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $service_url,
            CURLOPT_HTTPHEADER => array(
            'X-Signature: signature='.$client_secret.',
             algorithm=HMAC-SHA256',
            'Content-Type: application/json', $token ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => $post_str,
            CURLOPT_CUSTOMREQUEST => 'POST'
            ));

            $response = curl_exec($curl);
            $response_data = json_decode($response,1);
            $service = $orderData->booking_no.'_'.time();
            
            if (!file_exists("Orderwebhooks/".$service)) { 
                mkdir("Orderwebhooks/".$service, 0777, true);
            } 
            $time = strtotime(date("Ymdhis"));
            $fp = fopen("Orderwebhooks/".$service.'/request.json', 'a+');
            fwrite($fp, $post_str);
            fclose($fp);
            $fp = fopen("Orderwebhooks/".$service."/response.json", 'a+');
            fwrite($fp, $response);
            fclose($fp);

            //echo "<pre>";print_r($response_data);exit;
            if($response_data['status'] == "accepted"){
                $tracking_data['hook_status'] = 1;
                if($this->General_Model->update_table('booking_global', 'bg_id', $orderData->bg_id, $tracking_data)){
                    $res['status'] = 1;
                    $res['msg'] = "Webhooks accepted successfully from customer.";
                    echo json_encode($res);exit;
                }
            }
            else{
                    $res['status'] = 0;
                    $res['msg'] = "Webhooks not accepted.";
                    echo json_encode($res);exit;
            }

//echo "<pre>";print_r($response);exit;
}

//1e6ebc80dd4e57ed4860d32fb09f7b5837a2ffca6c5cc37ea4179c3eea65cd2d
}
}

}
?>