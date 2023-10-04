<?php 
ini_set('max_execution_time', '0');
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Cronjob extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Tixstock_Model');
        $this->load->model('Tssa_Model');
        $this->load->model('General_Model');
        
        $this->language_array = array('en','ar');
        $this->ticket_type = array('eTicket' => 2,'Paper' => 3,'mobile' => 4,'Members / Season Card' => 1);
        $this->split_type = array('Avoid Leaving One Ticket' => 4,'No Preferences' => 5,'All Together' => 2,'Sell In Multiples' => 3);

        }

public function seller_webhooks(){

  
    $bookings = $this->General_Model->getAllItemTable_Array('booking_global', array('booking_status' => 1,'seller_id' => 232))->result();
    foreach($bookings as $booking){

        $booking_no = md5($booking->booking_no);
        $orderData =  $this->General_Model->getOrderData($booking_no);
        if(!empty($orderData)){
            

            $service_url         = "https://api2.listmyticket.com/storefront/webhooks";
            $post_data = array('bg_id' => $orderData->bg_id);
                    
                    //echo "<pre>";print_r($post_data);exit;
                    $handle = curl_init();
                    curl_setopt($handle, CURLOPT_HTTPHEADER, array(
                    'domainkey: https://www.1boxoffice.com/en/'
                    ));
                    curl_setopt($handle, CURLOPT_URL, $service_url);
                    curl_setopt($handle, CURLOPT_POST, 1);
                    curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    $output = curl_exec($handle);
                    curl_close($handle);

        }

    }
    
}

public function sellerTickets_delete($match_id,$listing_ids=""){

        if($match_id != "" && !empty($listing_ids)){
         

                $disabledtickets = $this->Tixstock_Model->sellerTickets_notin($match_id,$listing_ids);
               
                foreach ($disabledtickets as $disabledticket) {
                        $table                     = "sell_tickets";
                        $wheres                    = array('s_no' => $disabledticket->s_no);
                        $uvalue                    = array('status'=> 2,'quantity' => 0);
                        $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

                }

    
        }
        else{ 
            if($match_id != "" && empty($listing_ids)){
                $disabledtickets = $this->Tixstock_Model->sellerTickets_notin($match_id);

                foreach ($disabledtickets as $disabledticket) {
                     
                        $table                     = "sell_tickets";
                        $wheres                    = array('s_no' => $disabledticket->s_no);
                        $uvalue                    = array('status'=> 2,'quantity' => 0);
                        $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

                }
            }
        }
        return true;
    }


public function stadiumCategory_update_v1($stadium_id,$category){

    $language_array = $this->language_array;
    $api_stadiums_category = $this->General_Model->getAllItemTable_Array('tixstock_stadium_category', array('stadium_id' => $stadium_id,'category' => $category))->row();
    if($api_stadiums_category->id == ""){
        $category_data = array('stadium_id' => $stadium_id,'category' => $category,'merge_status' => 0);
        $api_stadiums_category_id = $this->Tixstock_Model->insert_data('tixstock_stadium_category',$category_data);
    }
    else{
        $api_stadiums_category = $this->General_Model->getAllItemTable_Array('merge_api_stadium_category', array('stadium_id' => $stadium_id,'api_category' => $api_stadiums_category->id))->row();
        if($api_stadiums_category->category != ""){
            return $api_stadiums_category->category;
        }
    }
    return "";
}


function rndRGBColorCode()
{
return 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ',1)'; #using the inbuilt random function
}

public function stadiumBlock_update($match_id,$stadium_id,$category_id,$section){

    $language_array = $this->language_array;
     $block_color   = $this->rndRGBColorCode();

    $stadium_details_result  = $this->Tssa_Model->get_stadium_details($stadium_id,$match_id,$section);
    $block_id                = $stadium_details_result->id;
       
       if(empty($stadium_details_result)){

           $stadium_details_data = array(
                 'stadium_id'   => $stadium_id,
                 'block_id'     => $section,
                 'category'     => $category_id,
                 'block_color'  => $block_color,
                 'match_id'     => $match_id,                    
                 'source_type'  => 'tixstock'                       
           );

         $block_id = $this->Tssa_Model->save_stadium_details($stadium_details_data);   

       }   
       return $block_id;
        


}

public function updateListingNotes($datas)
    {  
        $language_array = $this->language_array;

        if(!empty($datas)){

        foreach($datas as $data){

        $check_notes_exists          =  $this->Tixstock_Model->get_listing_notes($data)->row();
        $ticket_details_id           =  $check_notes_exists->ticket_details_id;

        if($ticket_details_id == ""){

            $create_date = time();
            $insertData['ticket_name']   = $data;
            $insertData['source_type']      = 'tixstock';
            $insertData['ticket_type']      = '1';
            $insertData['display_view']     = '1';
            $insertData['status']           = 1;
            $insertData['create_date']      = $create_date;

             $ticket_details_id                    =  $this->Tixstock_Model->insert_data('ticket_details',$insertData);

                if($ticket_details_id != ""){

                      foreach($language_array as $language){
                    
                    $language_data = array(
                        'ticket_details_id'     => $ticket_details_id,
                        'language'              => $language,
                        'ticket_name'           => $data

                    );

                    $ticket_lang_id =  $this->Tixstock_Model->insert_data('ticket_details_lang',$language_data);
                                                    }

                }
           

        }

        }
        return true;
    }
    }

public function feed_team_events($limit = 5,$page = 0)
    { 
        

       /* ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);*/

        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

        $Allteams = $this->General_Model->getAllItemTable_Array('api_teams', array('source_type' => 'tixstock','merge_status' => 1),'','','',array('limit' => $limit ,'page' => $page))->result();

        //echo "<pre>";print_r($Allteams);exit;

             $team_cnt = 0;
             $team_tickets = 0;
             foreach ($Allteams as $Allteam) {
           // echo "<pre>";print_r($Allteam);exit;
            if($Allteam->team_name != ""){
            $team_name = trim($Allteam->team_name);
            $per_page = 50;
            $page = 1;
            $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?performer_name='.$team_name.'&per_page='.$per_page.'&page='.$page;
            $feed_response = $this->process_curl_request("tickets","GET",$end_point_url);
         //  echo "<pre>";print_r($feed_response);exit;
           $meta  = $feed_response['meta'];
            if(!empty($feed_response['data'])){ 
                        
 
                        foreach ($feed_response['data'] as $dataskey => $feed_response) {

                              $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('api_unique_id' => $feed_response['id']))->row();

                               $stadium = $api_events_tickets->stadium;
                              
                               $match_info = $this->General_Model->getAllItemTable_Array('match_info', array('tixstock_id' => $feed_response['id']))->row();
                               
                               if($match_info->m_id != "" && !empty($feed_response['listings']) && $stadium != ""){
                                $listings = $feed_response['listings'];
                                $seller_tickets = [];
                                $seller_tickets_ids = [];
                                
                               foreach ($listings as $datakey => $listing) {
                                    
                                //echo "<pre>";print_r($match_info);exit;
                                    $restrictions_benefits_options  = $listing['restrictions_benefits']['options'];
                                    $restrictions_benefits_others   = $listing['restrictions_benefits']['other'];
                                    $listing_notes = array();

                                    if(!empty($restrictions_benefits_options)){
                                        foreach($restrictions_benefits_options as $restrictions_benefits_option){
                                            $listing_notes[] = $restrictions_benefits_option;
                                        }
                                    }
                                    if(!empty($restrictions_benefits_others)){
                                        foreach($restrictions_benefits_other as $restrictions_benefits_other){
                                            $listing_notes[] = $restrictions_benefits_other;
                                        }
                                    }
                                    $listing_notes_data = '';
                                    if(!empty($listing_notes)){ 
                                        $notes = $this->updateListingNotes($listing_notes);
                                        if(is_array($notes)){
                                            $listing_notes_data = implode(',',$notes);
                                        }
                                        
                                    }
                                    $ticketid           = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
                                    $ticket_group_id    = mt_rand(100000, 999999);


                                    
                                    $general_admission  = $listing['ticket']['general_admission'];
                                    $seat               = $listing['seat_details']['first_seat'];
                                    $ticket_type_data   = $listing['ticket']['type'];
                                    $split_type_data    = $listing['ticket']['split_type'];
                                    $ticket_category    = $listing['seat_details']['category'];
                                    $ticket_section     = $listing['seat_details']['section'];
                                    $quantity           = $listing['number_of_tickets_for_sale']['quantity_available'];
                                    $price_type         = $listing['proceed_price']['currency'];
                                    $price              = $listing['proceed_price']['amount'];

                                    $ticket_category_id = $this->stadiumCategory_update_v1($stadium,$ticket_category);
                                     $team_tickets       = $team_tickets+$quantity;

                                    $ticket_block_id    = $this->stadiumBlock_update($match_info->m_id,$match_info->venue,$ticket_category_id,$ticket_section);
                                    $row                = $listing['seat_details']['row'];
                                    $seller_tickets_ids[]              = $listing['id'];
                                    $seller_tickets['tixstock_id']     = $listing['id'];
                                    $seller_tickets['ticket_type']     = $ticket_type[$ticket_type_data];
                                    $seller_tickets['ticketid']        = $ticketid;
                                    $seller_tickets['ticket_group_id'] = $ticket_group_id;
                                    $seller_tickets['user_id']           = 223;
                                    $seller_tickets['match_id']          = $match_info->m_id;
                                    $seller_tickets['event_flag']        = 'E';
                                    $seller_tickets['ticket_category']   = $ticket_category_id;
                                    $seller_tickets['ticket_block']      = $ticket_block_id;
                                    $seller_tickets['home_town']         = 0;
                                    $seller_tickets['row']               = $row;
                                    $seller_tickets['quantity']          = $quantity;
                                    $seller_tickets['price_type']        = $price_type;
                                    $seller_tickets['price']             = $price;
                                    $seller_tickets['listing_note']      = $listing_notes_data;
                                    $seller_tickets['split']             = $split_type[$split_type_data];
                                    $seller_tickets['sell_date']         = date("Y-m-d h:i:s");
                                   // $seller_tickets['status']             = 1;
                                    $seller_tickets['add_by']             = 223;
                                    $seller_tickets['store_id']           = 1;
                                    $seller_tickets['source_type']        = 'tixstock';
                                    $seller_tickets['general_admission']  = $general_admission;
                                    $seller_tickets['seat']               = $seat;
                                     //echo "<pre>";print_r($seller_tickets);exit;
                                     
                                     $sell_ticket                                 = $this->sellerTickets_update($listing['id'],$seller_tickets);

                                     $ticket_count = $ticket_count + $quantity;

                                 
                                    }
                                    if(!empty($seller_tickets_ids)){
                                    $sell_ticket                                 = $this->sellerTickets_delete($match_info->m_id,$seller_tickets_ids);
                                    }

                                    }
                                    else if($match_info->m_id != "" && empty($feed_response['listings'])){
                                    $sell_ticket                                 = $this->sellerTickets_delete($match_info->m_id);
                                    }
                                 }
            
            } 
            }
        $team_cnt = $team_cnt + 1;
        }
           echo json_encode(array('status' => 1,'msg' => $team_tickets.' Ticket Feeded successfully from '.$team_cnt.' teams'));exit;
      
       
    }


public function sellerTickets_update($listing_id,$seller_tickets){
    /*echo 'listing_id = '.$listing_id;
    echo "<pre>";print_r($seller_tickets);exit;*/
    if($listing_id != "" && !empty($seller_tickets)){

        $ticket  = $this->Tixstock_Model->check_sellerTickets($listing_id)->row();
        $s_no    = $ticket->s_no;
        if($s_no == ""){
            
            $seller_tickets['ticket_updated_date']         = date("Y-m-d h:i:s");
            $seller_tickets['status']         = 1;
            $this->Tixstock_Model->insert_data('sell_tickets',$seller_tickets);
            
        }
        else{

        $table                     = "sell_tickets";
        $wheres                    = array('s_no' => $s_no);
        $uvalue                    = $seller_tickets;
        $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

        }

    }
    return true;
}

public function update_oneclicket_categories(){
$request_data = array();
$stadium_init_response = $this->process_curl_request_oneclicket("getCategories",$request_data);
echo json_encode(array('status' => 1,'msg' => "Oneclicket Category Updated Successfully."));exit;
}

public function update_tixstock_categories(){
    
    $end_point_url      = TIXSTOCK_ENDPOINT_URL.'categories/feed?name=&parent=&order_by=&sort_order=&per_page=50&page=1';
    $this->process_curl_request_tixstock("category","GET",$end_point_url);
    echo json_encode(array('status' => 1,'msg' => "Tixstock Category Updated Successfully."));exit;
}


function process_curl_request_tixstock($service,$method,$service_url,$post_data=""){
          
            $authorization = "Authorization: Bearer ".TIXSTOCK_BEARER_TOKEN; 
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $service_url,
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            $authorization
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_CUSTOMREQUEST => $method
            ));

            $response = curl_exec($curl);
            $formatted_response = json_decode($response,1);

            if(!empty($formatted_response['data'])){
                if (!file_exists("uploads/category")) { 
                mkdir("uploads/category", 0777, true);
                } 
                 $fp = fopen("uploads/category/category.json", 'a+');
                ftruncate($fp, 0);
                fclose($fp);


                $fp = fopen("uploads/category/category.json", 'a+');
                fwrite($fp, $response);
                fclose($fp);
                return true;
            }
            curl_close($curl);
    }


    function process_curl_request_oneclicket($service,$post_data=array()){
          
        $API_KEY            = ONECLICKET_API_KEY;
        $REQUEST_BASE_URL   = ONECLICKET_ENDPOINT_URL;
        $REQUEST_NAME       = $service;
        $REQUEST_PARAMS     = $post_data;
        // init curl request
        $CH = curl_init("{$REQUEST_BASE_URL}{$REQUEST_NAME}" . (count($REQUEST_PARAMS) ? '?' .
        http_build_query($REQUEST_PARAMS) : ''));
        curl_setopt($CH, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($CH, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "API-KEY: {$API_KEY}"
        ));
        $response = curl_exec($CH);
        $formatted_response = json_decode($response, 1);
        if(!empty($formatted_response['data'])){
            if (!file_exists("uploads/category")) { 
            mkdir("uploads/category", 0777, true);
            } 

             $fp = fopen("uploads/category/category_oneclicket.json", 'a+');
                ftruncate($fp, 0);
                fclose($fp);
                
            $fp = fopen("uploads/category/category_oneclicket.json", 'a+');
            fwrite($fp, $response);
            fclose($fp);
            return true;
        }
        curl_close($CH);

    }
    
    
function process_curl_request($service,$method,$service_url,$post_data=""){
          
            $authorization = "Authorization: Bearer ".TIXSTOCK_BEARER_TOKEN; 
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $service_url,
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            $authorization
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           // CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_CUSTOMREQUEST => $method
            ));

            $response = curl_exec($curl);

            if (!file_exists("tix_logs/".$service)) { 
            mkdir("tix_logs/".$service, 0777, true);
            } 
            $time = strtotime(date("Ymdhis"));
            $fp = fopen("tix_logs/".$service."/".$time.'_request.json', 'a+');
            fwrite($fp, $service_url);
            fclose($fp);
            $fp = fopen("tix_logs/".$service."/".$time.'_response.json', 'a+');
            fwrite($fp, $response);
            fclose($fp);
            $formatted_response = json_decode($response,1);
            return $formatted_response;

    }


}