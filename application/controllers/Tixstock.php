<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Tixstock extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Tixstock_Model');
        $this->load->model('Tssa_Model');
        $this->load->model('General_Model');
        
        $this->language_array = array('en','ar');
        $this->ticket_type = array('eTicket' => 2,'Paper' => 3,'mobile' => 4,'Members / Season Card' => 1);
        $this->split_type = array('Avoid Leaving One Ticket' => 4,'No Preferences' => 5,'All Together' => 2,'Sell In Multiples' => 3);

        }

    public function updateVenues($data)
    {  
        if(!empty(($data['venue']))){

        $check_statdium_exists =  $this->Tixstock_Model->get_venues($data['venue']['name'])->row();
        $stadium_id            =  $check_statdium_exists->s_id;
        $stadium_name          =  $check_statdium_exists->stadium_name;

        if($stadium_id == ""){

            $stadium_name               = $data['venue']['name'];
            $insertData['stadium_name'] = $data['venue']['name'];
            $insertData['tixstock_id']  = $data['venue']['id'];
            $insertData['source_type']  = 'tixstock';
            $insertData['status']       = 1;
             $stadium_id                =  $this->Tixstock_Model->insert_data('stadium',$insertData);

                if($stadium_id != ""){

                    $stadiumData['stadium_id'] = $stadium_id;
                    $stadium_details_id        =  $this->Tixstock_Model->insert_data('stadium_details',$stadiumData);

                }
           

        }
        else{
            $table                     = "stadium";
            $wheres                    = array('s_id' => $stadium_id);
            $uvalue                    = array('tixstock_id' => $data['venue']['id']);
            $stadium_up                =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);
            
        }
        $city                 = $data['venue']['city'];
        $state                = $data['venue']['state'];
        $country_code         = $data['venue']['country_code'];
        $check_country_exists =  $this->Tixstock_Model->get_country($country_code)->row();
        $country_id           = $check_country_exists->id;

        if($check_country_exists->id == ''){

            $countriesData['sortname']  = $country_code;
            $countriesData['name']      = $country_code;
            $country_id                 =  $this->Tixstock_Model->insert_data('countries',$countriesData);

        } 

        $check_city_exists =  $this->Tixstock_Model->get_city($country_id,$city)->row();
        $city_id           = $check_city_exists->id;

        if($check_city_exists->id == ''){

            $statesData['country_id'] = $country_id;
            $statesData['name']       = $city;
            $city_id                  =  $this->Tixstock_Model->insert_data('states',$statesData);

        }

        return array("country" => $country_id,"city" => $city_id,"stadium" => $stadium_id);
    }
    return "";
    }
     public function updatePerformers($data)
    { 
        $language_array = $this->language_array;
        $performers = $data['performers'];
        if(!empty($performers)){
            foreach($performers as $pkey => $performer){

                $check_performer_fc = substr($performer['name'], -3);

                 $performer_name = $performer['name'];
                 $tixstock_id    = $performer['id'];
                if($check_performer_fc == " FC"){
                  $performer_name = str_replace(" FC","",$performer['name']);
                } 
                $check_team_exists =  $this->Tixstock_Model->get_teams_like($performer_name)->row();
                $count_exists =  $this->Tixstock_Model->get_teams_like($performer_name)->num_rows();
                $team_id = "";
                if($count_exists == 1){
                    $team_id            =  $check_team_exists->team_id;
                }
                

                if($pkey == 0 && $team_id != ""){
                    $team_1_id      = $team_id;
                }
                if($pkey == 1 && $team_id != ""){
                    $team_2_id      = $team_id;
                } 
                $create_date = time();
                $team_url    = explode(' ',$performer_name);
                $team_url    = strtolower(implode('-',$team_url));
                if($team_id == ""){ 
                     $team_data = array(
                        'team_name'     => $performer_name,
                        'tixstock_id'   => $tixstock_id,
                        'category'      => 1,
                        'status'        => 1,
                        'seo_status'    => 0,
                        'create_date'   => $create_date,
                        'team_url'      => $team_url,
                        'source_type'   => 'tixstock',
                    );
                $team_id            =  $this->Tixstock_Model->insert_data('teams',$team_data);
                if($pkey == 0 && $team_id != ""){
                    $team_1_id      = $team_id;
                }
                if($pkey == 1 && $team_id != ""){
                    $team_2_id      = $team_id;
                }
                if($team_id != ""){

                foreach($language_array as $language){

                    $language_data = array(
                        'team_id'       => $team_id,
                        'language'      => $language,
                        'team_name'     => $performer_name

                    );
                    $team_lang_id   =  $this->Tixstock_Model->insert_data('teams_lang',$language_data);
                                                    }
                                    }
                }
                else{
                $table                     = "teams";
                $wheres                    = array('id' => $team_id);
                $uvalue                    = array('tixstock_id' => $tixstock_id);
                $team_up                =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);
               // echo $this->db->last_query();exit;
            
                }
            }
            return array('team_1_id' => $team_1_id,'team_2_id' => $team_2_id);
                            }
                        return true;
    }

    public function updateTournaments($data)
    {  
        $language_array = $this->language_array;
        $category_name  = $data['name'];
        $tixstock_id    = $data['id'];
        if($category_name != ""){

            $category_name = str_replace(" Football","",$category_name);

            $check_match_exists =  $this->Tixstock_Model->get_tournament($category_name)->row();
            $tournament_id      =  $check_match_exists->tournament_id;
            $tournament_name    = $check_match_exists->tournament_name;
            if($tournament_id == ""){
              $page_title       = "Buy ".$category_name." tickets For 2022 - 2023 Securely Online";
              $meta_description = "";
              $url_key          = explode(' ',$category_name);
              $url_key          = strtolower(implode('-',$url_key).'-tickets');
              $create_date      = time();
              $tournament_name  = $category_name;
            $tournament_data    = array(
                'tournament_name' => $category_name,
                'tixstock_id'     => $tixstock_id,
                'status'          => 1,
                'seo_status'      => 0,
                'create_date'     => $create_date,
                'page_title'      => $page_title,
                'meta_description'=> $meta_description,
                'page_content'    => '',
                'source_type'     => 'tixstock',
                'url_key'         => $url_key
            );
            $tournament_id      =  $this->Tixstock_Model->insert_data('tournament',$tournament_data);

            if($tournament_id != ""){
                            
                foreach($language_array as $language){
                    
                    $language_data = array(
                        'tournament_id'     => $tournament_id,
                        'language'          => $language,
                        'tournament_name'   => $category_name,
                        'page_title'        => $page_title,
                        'meta_description'  => $meta_description

                    );

                    $tournament_lang_id =  $this->Tixstock_Model->insert_data('tournament_lang',$language_data);
                                                    }
                                }
                        }
                    else{
                    $table                     = "tournament";
                    $wheres                    = array('t_id' => $tournament_id);
                    $uvalue                    = array('tixstock_id' => $tixstock_id);
                    $tourn_up                  =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

                    }

            return $tournament_id;
        }
    }

    public function updateMatches($data,$tournament_id,$team_1_id,$team_2_id,$stadium_id,$country_id,$city_id)
    {  

         $language_array = $this->language_array;
          $match_name           = $data['name'];
          $tixstock_id          = $data['id'];
          $listings             = $data['listings'][0];
          $currency             = $listings['proceed_price']['currency'];
          if($currency == ""){
          $currency             = "GBP";
          }
          $match_date_string    = explode('T',$data['datetime']); 
          $match_date           =  $match_date_string[0];

          $check_match_exists   =  $this->Tixstock_Model->check_match_exists($match_date,$tournament_id,$team_1_id,$team_2_id,'match')->row();
          $old_currency         = $check_match_exists->price_type;
          $source_type          = $check_match_exists->source_type;
          if($source_type == '1boxoffice'){
            $currency             = $old_currency;
          }
          $match_id             = $check_match_exists->m_id;
            if($match_id == ''){

               $match_full_date = str_replace('T', " ", $data['datetime']);
               $url_key         = explode(' ',$match_name);
               $slug            = strtolower(implode('-',$url_key).'-tickets');
               $create_date     = time();
               $availability     = 0;
               $status           = 0;
              if($data['status'] == 'Active'){
                 $availability = 1;
                 $status = 1;
              }
              
              $match_data = array(

                'match_name'    => $match_name,
                'tixstock_id'   => $tixstock_id,
                'team_1'        => $team_1_id,
                'team_2'        => $team_2_id,
                'tournament'    => $tournament_id,
                'status'        => $status,
                'seo_status'    => 0,
                'availability'  => $availability,
                'match_date'    => $match_full_date,
                'match_time'    => $match_date_string[1],
                'venue'         => $stadium_id,
                'country'       => $country_id,
                'city'          => $city_id,
                'create_date'   => $create_date,
                'event_type'    => 'match',
                'price_type'    => $currency,
                'add_by'        => 1,
                'source_type'   => 'tixstock',
                'slug'          => $slug
            );
            //echo "<pre>";print_r($tournament_data);exit;
            $match_id           =  $this->Tixstock_Model->insert_data('match_info',$match_data);
            if($match_id != ""){
                
                foreach($language_array as $language){

                    $description = "<p>Buy ".$match_name." tickets for the ".$tournament_name." game being played on ".$match_full_date."&nbsp;at ".$stadium_name.". 1BoxOffice offers a wide range of ".$match_name." tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy tickets!</p>";
                    
                    $meta_title  = $match_name." Tickets | ".$match_full_date." | 1BoxOffice.com";
                    $meta_description = $description;

                    $language_data = array(
                        'match_id'          => $match_id,
                        'language'          => $language,
                        'match_name'        => $match_name,
                        'description'       => $description,
                        'meta_title'        => $meta_title,
                        'meta_description'  => $meta_description

                    );
                    $match_lang_id =  $this->Tixstock_Model->insert_data('match_info_lang',$language_data);
                                                    }
            }
            return $match_id;
            }
            else{
            $table                     = "match_info";
            $wheres                    = array('m_id' => $match_id);
            $uvalue                    = array('tixstock_id' => $tixstock_id,'price_type' => $currency);
            $match_up                  =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);
             return $match_id;
            }
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

    public function updateFeeds($proceed = false)
    { // echo "updateFeeds";exit;
        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

       if ($proceed == false) {
            $response['status'] = 0;
            $response['error_code'] = 403;
            $response['error']  = "Invalid request data.";
       }
       else{  
            

            $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?category_name=Premier League Football';
            $feed_response = $this->process_curl_request("feeds","GET",$end_point_url);
           
            if(!empty($feed_response['data'])){
                        foreach ($feed_response['data'] as $datakey => $data) {
                           
                            //echo "<pre>";print_r($data);exit;
                            
                            /*$match_name_full     = $data['name'];
                            $data['performers']  = explode("vs",$match_name_full);*/
                            $venues     = $data['venue'];
                            $venue_data = $this->updateVenues($data);
                            $stadium_id = $venue_data['stadium'];
                            $country_id = $venue_data['country'];
                            $city_id    = $venue_data['city'];
                              
                            
                            //$performers     = $data['performers'];

                            if(count($data['performers']) > 1){

                        $performer_data = $this->updatePerformers($data);
                        $team_1_id      = $performer_data['team_1_id'];
                        $team_2_id      = $performer_data['team_2_id'];

                        $category_name  = $data['category']['name'];
                        $tournament_id  = $this->updateTournaments($data['category']);

                        $match_id        = $this->updateMatches($data,$tournament_id,$team_1_id,$team_2_id,$stadium_id,$country_id,$city_id);
                         echo 'Record #'.$match_id;echo "<br>";
                        if($match_id != ""){/*
                            $listings  = $data['listings'];
                            if(!empty($listings)){
                                 $seller_tickets = [];
                                 foreach($listings as $leky => $listing){

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
                                        $listing_notes_data = implode(',',$notes);
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

                                    $ticket_category_id = $this->stadiumCategory_update($ticket_category);
                                    $ticket_block_id    = $this->stadiumBlock_update($match_id,$stadium_id,$ticket_category_id,$ticket_section);
                                    $row                = $listing['seat_details']['row'];
S
                                    $seller_tickets['tixstock_id']     = $listing['id'];
                                    $seller_tickets['ticket_type']     = $ticket_type[$ticket_type_data];
                                    $seller_tickets['ticketid']        = $ticketid;
                                    $seller_tickets['ticket_group_id'] = $ticket_group_id;
                                    $seller_tickets['user_id']           = 216;
                                    $seller_tickets['match_id']          = $match_id;
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
                                    $seller_tickets['status']             = 1;
                                    $seller_tickets['add_by']             = 216;
                                    $seller_tickets['store_id']           = 1;
                                    $seller_tickets['source_type']        = 'tixstock';
                                    $seller_tickets['general_admission']  = $general_admission;
                                    $seller_tickets['seat']               = $seat;
                                     $sell_ticket                                 = $this->sellerTickets_update($listing['id'],$seller_tickets);

                                 }
                                 //echo "<pre>";print_r($seller_tickets);exit;

                            }
                         */}

                            }
                            
                            
                          
                        
                       
                           
                        }  
                        $response['status'] = 1;
            $response['error_code'] = 200;
            //$response['data'] = $feed_response;
             echo json_encode($response);exit;
            }  
           
            
         }
        
    }


public function updateFeedsTickets($proceed = false)
    {
         
        $page               = $_POST['page'];
        $per_page           = 50;
        $category_name      = $_POST['tournament'];
        $tixstock_ids       = $_POST['tixstock_id'];
        $event_ids          = array();
       

        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

       if ($proceed == false) {
            $response['status'] = 0;
            $response['error_code'] = 403;
            $response['error']  = "Invalid request data.";
       }
       else{  
            

             if(!empty($tixstock_ids)){

            foreach($tixstock_ids as $key => $tixstock_id){
           

            $end_point_url = TIXSTOCK_ENDPOINT_URL.'tickets/feed?event_id='.$tixstock_id.'&per_page='.$per_page.'&page='.$page;
            $feed_response = $this->process_curl_request("tickets","GET",$end_point_url);
            
            if(!empty($feed_response['data'])){ 
                        $seller_tickets = [];
                        foreach ($feed_response['data'] as $datakey => $listing) {
                                

                                $match_info = $this->General_Model->getAllItemTable_Array('match_info', array('tixstock_id' => $listing['event']['id']))->row();
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
                                        $listing_notes_data = implode(',',$notes);
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

                                    $ticket_category_id = $this->stadiumCategory_update($ticket_category);
                                    $ticket_block_id    = $this->stadiumBlock_update($match_info->m_id,$match_info->venue,$ticket_category_id,$ticket_section);
                                    $row                = $listing['seat_details']['row'];

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
                                     $sell_ticket                                 = $this->sellerTickets_update($listing['id'],$seller_tickets);

                                 }
            $msg = "Tickets Updated successfully.";
                           
            } 


             }

        } 
           
            $response['status'] = 1;
            $response['msg'] = $msg;
            echo json_encode($response);exit;

            
         }
        

           

    
    } 

public function updateFeedsEvents($proceed = false)
    { //echo "updateFeedsEvents Disabled";exit;// echo "updateFeeds";exit;
   //echo "<pre>";print_r($_POST);exit;
        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

       if ($proceed == false) {
            $response['status'] = 0;
            $response['error_code'] = 403;
            $response['error']  = "Invalid request data.";
       }
       else{  
            $page       = ($_POST['page'] != "") ? ($_POST['page']) : 1;
            $tournament = $_POST['tournament'];
             $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?category_name=Premier League Football&per_page=50&page='.$page;
             //$end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?per_page=50&page='.$page.'&category_name='.$tournament;
            $feed_response = $this->process_curl_request("feeds","GET",$end_point_url);
            $match_data = array();//echo "feed_response <pre>";print_r($feed_response);exit;
            if(!empty($feed_response['data'])){
                        foreach ($feed_response['data'] as $datakey => $data) {
                           
                            //echo "<pre>";print_r($data);exit;
                            
                            /*$match_name_full     = $data['name'];
                            $data['performers']  = explode("vs",$match_name_full);*/
                            $venues     = $data['venue'];
                            $venue_data = $this->updateVenues($data);
                            $stadium_id = $venue_data['stadium'];
                            $country_id = $venue_data['country'];
                            $city_id    = $venue_data['city'];
                              
                            
                            //$performers     = $data['performers'];

                            if(count($data['performers']) > 1){

                        $performer_data = $this->updatePerformers($data);
                        $team_1_id      = $performer_data['team_1_id'];
                        $team_2_id      = $performer_data['team_2_id'];

                        $category_name  = $data['category']['name'];
                        $tournament_id  = $this->updateTournaments($data['category']);

                        $match_id        = $this->updateMatches($data,$tournament_id,$team_1_id,$team_2_id,$stadium_id,$country_id,$city_id);
                         //echo 'Record #'.$match_id;echo "<br>";
                        
                        if($match_id != ""){

                            $match   =  $this->Tixstock_Model->get_match_tournments($match_id);
                            $match_data[] =  $match;
                       }

                            }
                            
                            
                          
                        
                       
                           
                        }  

                        if(!empty($match_data)){
                           $this->mydatas['match_data'] = $match_data;

                           $list_matches = $this->load->view('game/get_tixstock_matches', $this->mydatas, TRUE); 
                        } 
                        $response['status'] = 1;
                        $response['matches'] = $list_matches;
            //$response['data'] = $feed_response;
             echo json_encode($response);exit;
            }  
            else{
                        $list_matches = $this->load->view('game/get_tixstock_matches', $this->mydatas, TRUE); 
                        $response['status'] = 1;
                        $response['matches'] = $list_matches;
                         echo json_encode($response);exit;
            }
           
            
         }
        
    }


public function updateSellerEvents($proceed = false)
    {

        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

       if ($proceed == false) {
            $response['status'] = 0;
            $response['error_code'] = 403;
            $response['error']  = "Invalid request data.";
       }
       else{  
            $page       = ($_POST['page'] != "") ? ($_POST['page']) : 1;
            $tournament = $_POST['tournament'];
            //$end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?category_name=Premier League Football';
             $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?per_page=50&page='.$page.'&category_name='.$tournament;
            
            $feed_response = $this->process_curl_request("feeds","GET",$end_point_url);
            $match_data = array();
            if(!empty($feed_response['data'])){
                        foreach ($feed_response['data'] as $datakey => $data) {
                           
                            //echo "<pre>";print_r($data);exit;
                            
                            /*$match_name_full     = $data['name'];
                            $data['performers']  = explode("vs",$match_name_full);*/
                            $venues     = $data['venue'];
                            $venue_data = $this->updateVenues($data);
                            $stadium_id = $venue_data['stadium'];
                            $country_id = $venue_data['country'];
                            $city_id    = $venue_data['city'];
                              
                            
                            //$performers     = $data['performers'];

                            if(count($data['performers']) > 1){

                        $performer_data = $this->updatePerformers($data);
                        $team_1_id      = $performer_data['team_1_id'];
                        $team_2_id      = $performer_data['team_2_id'];

                        $category_name  = $data['category']['name'];
                        $tournament_id  = $this->updateTournaments($data['category']);

                        $match_id        = $this->updateMatches($data,$tournament_id,$team_1_id,$team_2_id,$stadium_id,$country_id,$city_id);
                         //echo 'Record #'.$match_id;echo "<br>";
                        
                        if($match_id != ""){

                            $match   =  $this->Tixstock_Model->get_match_tournments($match_id);
                            $match_data[] =  $match;
                       }

                            }
                            
                            
                          
                        
                       
                           
                        }  

                        if(!empty($match_data)){
                           $this->mydatas['match_data'] = $match_data;

                           $list_matches = $this->load->view('game/get_tixstock_matches', $this->mydatas, TRUE); 
                        } 
                        $response['status'] = 1;
                        $response['matches'] = $list_matches;
            //$response['data'] = $feed_response;
             echo json_encode($response);exit;
            }  
           
            
         }
        
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

public function stadiumCategory_update($category){

    $language_array = $this->language_array;
    $category_data  =   $this->Tssa_Model->get_seat_category($category);

    if($category_data == ""){

        $seat_category_data =  array(
        'seat_category'         => $category,
        'status'                => 1,
        'create_date'           => time(),
        'event_type'            => 'match',
        'source_type'           => 'tixstock'

        );

        $category_id = $this->Tssa_Model->save_seat_category($seat_category_data);
        if($category_id != ""){

        foreach($language_array as $language){
        
        $stadium_seats =  array(
        'seat_category'         => $category,
        'stadium_seat_id'       => $category_id,
        'language'              => $language

        ); 
        $lang_category_id = $this->Tssa_Model->save_stadium_seats_lang($stadium_seats); 

        }


                            }    
        return $category_id;                           
    }
    else{

        $category_id =  $category_data->stadium_seat_id;
        return $category_id;

    }

        


}


    public function createTickets($proceed = false)
    {  
        
            $ticket_type         = $this->ticket_type;
            $split_type          = $this->split_type;
            $tournament          = 1;
            $available_matches   =  $this->Tixstock_Model->get_available_matches($tournament)->result();
            if(!empty($available_matches)){
                $end_point_url = TIXSTOCK_ENDPOINT_URL.'/feed?category_name=Premier League Football';
                foreach($available_matches as $available_match){
                    $tixstock_id = $available_match->tixstock_id;
                    if($tixstock_id != ""){

                    $feed_response = $this->process_curl_request("categories","GET",$end_point_url);

                    }
                    echo "<pre>";print_r($available_match);exit;
                }

            }
            echo "<pre>";print_r($available_matches);exit;
            
            if($feed_response['meta']['last_page'] > 0){
                $category_data = array();
                for($i = 1;$i <= $feed_response['meta']['last_page'];$i++){
                    $end_point_url = TIXSTOCK_ENDPOINT_URL.'categories/feed?page='.$i;
                    $feed_response = $this->process_curl_request("categories","GET",$end_point_url);

                    if(!empty($feed_response['data'])){
                        foreach ($feed_response['data'] as $datakey => $data) {
                            
                            $category_data[$data['parent']['id']]['name'] = $data['parent']['name'];
                            $category_data[$data['parent']['id']]['categories'][] = array('id' => $data['id'],'name' => $data['name']);

                            //$category_data[$data['parent']['id']][] = array('name' => $data['parent']['name'],'category' => array('id' => $data['id'],'name' => $data['name']));
                           
                        }
                    }  
                } echo "<pre>";print_r($category_data);exit;
            }
           
            return true;
    }

public function orderConfirm(){

     $bg_id  = $_POST['bg_id'];
     if($bg_id != ""){

        $booking =  $this->Tixstock_Model->get_confirmed_orders($bg_id)->row();
        
        if(!empty($booking)){

                $post_data['order_status']                          = $_POST['tixstock_status'];
                
                //$post_data['order_status']                        = 'Approved';
                /*$post_data['shipping_address']['address_line_1']  = $booking->buyer_address;
                $post_data['shipping_address']['address_line_2']  = '';
                $post_data['shipping_address']['town']            = $booking->state_name;
                $post_data['shipping_address']['postcode']        = $booking->postal_code;
                $post_data['shipping_address']['country_code']    = $booking->country_code;
                $post_data['shipping_label']                      = 'https://phplaravel-871000-3013213.cloudwaysapps.com/en/orders/'.md5($booking->booking_no);*/

                $end_point_url = TIXSTOCK_ENDPOINT_URL.'orders/update/'.$booking->booking_no;

                $post_data_json = json_encode($post_data);

                 $order_response = $this->process_curl_request("update","POST",$end_point_url,$post_data_json);

                $table                     = "booking_tixstock";
                $wheres                    = array('booking_id' => $bg_id);

                $uvalue                    = array(
                    'update_order_url'      => $end_point_url,
                    'update_order_request' => $post_data_json,
                    'update_order_response' => json_encode($order_response));

                if($order_response['data']['status'] != ""){
                    $uvalue['tixstock_status'] = $order_response['data']['status'];
                }

                $stadium_up                =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

                    if(!empty($order_response['data'])){
                        $tixstock_status = $order_response['data']['status'];
                        $tix_response['tixstock_status'] = $tixstock_status;
                    } 
                    else{
                         $tixstock_status = 'FAILED';
                         $tix_response['tixstock_status'] = 'FAILED';
                    } 

                    $response = array("status" => 1,"tixstock_status" => $tixstock_status);
                    echo json_encode($response);exit;
        }
        else{
            $response = array("status" => 0,"tixstock_status" => 'FAILED');
        }

     }
       $response = array("status" => 0,"tixstock_status" => 'FAILED');
     echo json_encode($response);exit;
}

function webhooks()
{
    $webhooks_type = $this->uri->segment(3);
    $payload        = "";
    $payload        = file_get_contents("php://input");
    $yourWebhookKey = "05b82d846749cf7f6b24c576b9";
    //$yourHash = base64_encode(hash_hmac('sha256', $payload, $yourWebhookKey));
    $yourHash = hash_hmac('sha256', $payload, $yourWebhookKey);

    if($yourHash == $_SERVER['HTTP_X_TIXSTOCK_SIGNATURE']){

        $fp = fopen("tix_logs/webhooks/signature/verified_request.json", 'a+');
        fwrite($fp, 'siva');
        fclose($fp);

    }

    $tixstock_response = json_decode($payload, true);

    /*$time = time();
    $fp = fopen("tix_logs/webhooks/".$webhooks_type."/".$time.'_request.json', 'a+');
    fwrite($fp, $payload);
    fclose($fp);
    $fp = fopen("tix_logs/webhooks/signature/".$time.'_request.txt', 'a+');
    fwrite($fp, $yourHash .'=='. $_SERVER['HTTP_X_TIXSTOCK_SIGNATURE']);
    fclose($fp);*/

    if($webhooks_type == "hold"){

        if(!empty($tixstock_response['data'])){

            $tixstock_id                 = $tixstock_response['data']['id'];
            $hold_quantity               = $tixstock_response['data']['hold_quantity'];

            $tickets = $this->General_Model->getAllItemTable_Array('sell_tickets', array('tixstock_id' => $tixstock_id))->row();

            if($tickets->s_no != ""){

            $table                     = "sell_tickets";
            $wheres                    = array('tixstock_id' => $tixstock_id);
            $uvalue                    = array('quantity' => ($tickets->quantity - $quantity));
            $ticket_update                =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

            }

            $response = array('status' => 1,"success" => true,"message" => "Hold.Ticket Quantity Updated successfully.");
            echo json_encode($response);exit;
            

        }

    }
    else if($webhooks_type == "release"){

        if(!empty($tixstock_response['data'])){

            $tixstock_id                    = $tixstock_response['data']['id'];
            $release_quantity               = $tixstock_response['data']['release_quantity'];
            

            $tickets = $this->General_Model->getAllItemTable_Array('sell_tickets', array('tixstock_id' => $tixstock_id))->row();

            if($tickets->s_no != ""){

            $table                     = "sell_tickets";
            $wheres                    = array('tixstock_id' => $tixstock_id);
            $uvalue                    = array('quantity' => ($tickets->quantity + $release_quantity));
            $ticket_update             =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

            }

            $response = array('status' => 1,"success" => true,"message" => "Release.Ticket Quantity Updated successfully.");
            echo json_encode($response);exit;
            

        }

    }   
    else if($webhooks_type == "orderUpdate"){

        if(!empty($tixstock_response['data'])){

            $booking_no                  = $tixstock_response['data']['order_id'];
            $tixstock_id                 = $tixstock_response['data']['id'];
            $file                        = $tixstock_response['data']['file'];
            $ticket_type                 = $tixstock_response['meta']['type'];

            $booking = $this->General_Model->getAllItemTable_Array('booking_global', array('booking_no' => $booking_no))->row();

            if($booking->bg_id != ""){

            $tablev                     = "booking_tixstock";
            $wheresv                    = array('booking_id' => $booking->bg_id);
            $uvaluev                    = array(
                'tixstock_status'      => $tixstock_response['data']['status']
            );

            $this->Tixstock_Model->update_table($tablev, $wheresv, $uvaluev);

            

            if($ticket_type == "order.mobile_ticket_fulfilment"){

            $pods                      = $tixstock_response['data']['proof_file_url'];
            $additional_file           = @$tixstock_response['data']['additional_file'];

            if($additional_file != ""){

            $table_bg                  = "booking_global";
            $wheres_bg                 = array('bg_id' => $booking->bg_id);
            $uvalue_bg                 = array('instruction_file' => $additional_file);
            $ticket_update             =  $this->Tixstock_Model->update_table($table_bg, $wheres_bg, $uvalue_bg);

            }
            if(!empty($pods)){
                $pods_data = implode(',',$pods);
            
                
            $table                     = "booking_tickets";
            $wheres                    = array('booking_id' => $booking->bg_id);
            $uvalue                    = array('proof_file_url' => $pods_data);
            $ticket_update             =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

             $response = array('external_id' => $booking_no,"order_status" => "Commissionable","message" => "Listing has been fulfilled for the order.","success" => true);
           
             echo json_encode($response);exit;

            }

                 
            $response = array('external_id' => $booking_no,"order_status" => "Approved","message" => " mobile tickets need to be fullfilled.","success" => false );
             echo json_encode($response);exit;


            


            }
            else if($ticket_type == "order.eticket_fulfilment"){

            $additional_file           = @$tixstock_response['data']['additional_file'];

            if($additional_file != ""){

            $table_bg                  = "booking_global";
            $wheres_bg                 = array('bg_id' => $booking->bg_id);
            $uvalue_bg                 = array('instruction_file' => $additional_file);
            $ticket_update             =  $this->Tixstock_Model->update_table($table_bg, $wheres_bg, $uvalue_bg);

            }

            $table                     = "booking_etickets";
            $wheres                    = array('booking_id' => $booking->bg_id,'ticket_file' => '');
            $uvalue                    = array('ticket_file' => $file,'ticket_status' => 1);
            $ticket_update             =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

            $etickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $booking->bg_id,'ticket_file' => ''))->num_rows();

            if($etickets > 0){

                 
                 $response = array('external_id' => $booking_no,"order_status" => "Approved","message" => count($etickets)." more tickets need to be fullfilled.","success" => false );

            }
            else{

                $response = array('external_id' => $booking_no,"order_status" => "Commissionable","message" => "Listing has been fulfilled for the order.","success" => true);

            }
             echo json_encode($response);exit;

            }
            else{

            }

            
            }

           
           
            

        }

    }
    else if($webhooks_type == "ticket_fulfilment"){

        

        if($yourHash == $_SERVER['HTTP_X_TIXSTOCK_SIGNATURE']){

        if(!empty($tixstock_response['data'])){

            $booking_no                  = $tixstock_response['data']['order_id'];
            $tixstock_id                 = $tixstock_response['data']['id'];
            $file                        = $tixstock_response['data']['file'];
            $ticket_type                 = $tixstock_response['meta']['type'];
            $seat                        = $tixstock_response['data']['seat'];

           
            $booking = $this->General_Model->getAllItemTable_Array('booking_global', array('booking_no' => $booking_no))->row();

            if($booking->bg_id != ""){

        /*    $tablev                     = "booking_tixstock";
            $wheresv                    = array('booking_id' => $booking->bg_id);
            $uvaluev                    = array(
                'tixstock_status'      => $tixstock_response['data']['status']
            );

            $this->Tixstock_Model->update_table($tablev, $wheresv, $uvaluev);*/

            

            if($ticket_type == "order.mobile_ticket_fulfilment"){

             $file_name = $booking->booking_no.'_'.time();
        $fp = fopen("tix_logs/webhooks/".$webhooks_type."/".$file_name.'_request.json', 'a+');
        ftruncate($fp, 0);
        fwrite($fp, $payload);
        fclose($fp);

            $additional_file           = @$tixstock_response['data']['additional_file'];

            if($additional_file != ""){

            $table_bg                  = "booking_global";
            $wheres_bg                 = array('bg_id' => $booking->bg_id);
            $uvalue_bg                 = array('instruction_file' => $additional_file);
            $ticket_update             =  $this->Tixstock_Model->update_table($table_bg, $wheres_bg, $uvalue_bg);

            }

            $pods                      = $tixstock_response['data']['proof_file_url'];

            if(!empty($pods)){
                $pods_data = implode(',',$pods);
            
                
            $table                     = "booking_ticket_tracking";
            $wheres                    = array('booking_id' => $booking->bg_id);
            $uvalue                    = array('pod' => $pods_data,"pod_status" => 1,"source_type" => "tixstock");
            $ticket_update             =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

            $t_table                     = "booking_etickets";
            $t_wheresv1                  = array('booking_id' => $booking->bg_id);
            $t_uvalue                    = array('ticket_status' => 1);
            $ticket_update               =  $this->Tixstock_Model->update_table($t_table, $t_wheresv1, $t_uvalue);


             $response = array('external_id' => $booking_no,"order_status" => "Commissionable","message" => "Listing has been fulfilled for the order.","success" => true);
           
             echo json_encode($response);exit;

            }

                 
            $response = array('external_id' => $booking_no,"order_status" => "Commissionable","message" => "Listing has been fulfilled for the order.","success" => false );
             echo json_encode($response);exit;


            


            }
            else if($ticket_type == "order.eticket_fulfilment"){

        $serial = $this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $booking->bg_id,'ticket_file' => ''))->num_rows();

        $file_name = $booking->booking_no.'_'.$serial;
        $fp = fopen("tix_logs/webhooks/".$webhooks_type."/".$file_name.'_request.json', 'a+');
        ftruncate($fp, 0);
        fwrite($fp, $payload);
        fclose($fp);

        $fp = fopen("tix_logs/webhooks/".$webhooks_type."/".$file_name.'.txt', 'a+');
        ftruncate($fp, 0);
        fwrite($fp, $file);
        fclose($fp);

        $pdf_ticekt_file = $this->read_pdf($webhooks_type,$file_name);

         $total_tickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $booking->bg_id))->num_rows();

       /* $serial = $this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $booking->bg_id,'ticket_file' => ''))->num_rows();*/
            $additional_file           = @$tixstock_response['data']['additional_file'];

            if($additional_file != ""){

            $table_bg                  = "booking_global";
            $wheres_bg                 = array('bg_id' => $booking->bg_id);
            $uvalue_bg                 = array('instruction_file' => $additional_file);
            $ticket_update             =  $this->Tixstock_Model->update_table($table_bg, $wheres_bg, $uvalue_bg);

            }

            $table                     = "booking_etickets";
            $wheresv1                  = array('booking_id' => $booking->bg_id,'ticket_file' => '','serial' => $serial);
            $uvalue                    = array('ticket_file' => $pdf_ticekt_file,'ticket_status' => 1,'seat' => $seat);
            $ticket_update             =  $this->Tixstock_Model->update_table($table, $wheresv1, $uvalue);

             $updated_tickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $booking->bg_id,'ticket_status' => 1))->num_rows();

            $pending_tickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $booking->bg_id,'ticket_file' => ''))->num_rows();

             if($updated_tickets == $total_tickets){

                 
                $response = array('external_id' => $booking_no,"order_status" => "Commissionable","message" => "Listing has been fulfilled for the order.","success" => true);

            }
            else{
                $response = array('external_id' => $booking_no,"order_status" => "Approved","message" => $pending_tickets." more tickets need to be fullfilled.","success" => false );
            }

             echo json_encode($response);exit;

            }
            else{

            }

            
            }

           
           
            

        }

    }

    

       /* if(!empty($tixstock_response['data'])){

            $booking_no                  = $tixstock_response['data']['order_id'];
            $etickets                    = $tixstock_response['data']['ticket']['etickets'];
            $ticket_type                 = $tixstock_response['meta']['type'];

            $booking = $this->General_Model->getAllItemTable_Array('booking_global', array('booking_no' => $booking_no))->row();

            if($booking->bg_id != ""){

            if(!empty($etickets)){
                foreach($etickets as $eticket){

                $table                     = "booking_etickets";
                $wheres                    = array('booking_id' => $booking->bg_id);
                $uvalue                    = array('ticket_file' => $eticket['file'],'ticket_status' => 1);
                $ticket_update             =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

                }
            }


            $etickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $booking->bg_id,'ticket_file' => ''))->num_rows();
            
            if($etickets > 0){

                 $response = array('external_id' => $booking_no,"order_status" => "Delivered","message" => "Listing has been fulfilled for the order.","success" => true);

            }
            else{
                 $response = array('external_id' => $booking_no,"order_status" => "Approved","message" => "Listing failed to be fulfilled for the order.","success" => false );
            }
             echo json_encode($response);exit;
            }

           
           
            

        }*/
    }
    else{

    }

    $response = array('status' => 1,"success" => true,"message" => "webhooks called successfully.");
    echo json_encode($response);exit;
    
}

function read_pdf($webhooks_type,$file_name){

$pdf_base64 = $file_name.".txt";
//Get File content from txt file
$pdf_base64_handler = fopen("tix_logs/webhooks/".$webhooks_type."/".$pdf_base64,'r');
$pdf_encoded_content = fread ($pdf_base64_handler,filesize("tix_logs/webhooks/".$webhooks_type."/".$pdf_base64));
fclose ($pdf_base64_handler);



//Decode pdf content
$pdf_decoded = base64_decode ($pdf_encoded_content);
$pdf_file    = time().'_'.$file_name.'.pdf';
//Write data back to pdf file

$pdf = fopen (UPLOAD_PATH_PREFIX.'uploads/e_tickets'."/".$pdf_file,'w');
fwrite ($pdf,$pdf_decoded);
//close output file
fclose ($pdf);

return $pdf_file;

}

function rndRGBColorCode()
    {
        return 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ',1)'; #using the inbuilt random function
    }


function clear_tixstock_data($table=""){

    if($table == "sell_tickets"){

        $tickets = $this->General_Model->getAllItemTable_Array('sell_tickets', array('source_type' => 'tixstock'))->result();
        echo 'tickets = '.count($tickets);
    if(!empty($tickets)){

        foreach($tickets as $ticket){
            $delete = $this->General_Model->delete_data('sell_tickets', 's_no', $ticket->s_no);
        }

    }

    }
    else if($table == "match_info"){

        $matches = $this->General_Model->getAllItemTable_Array('match_info', array('source_type' => 'tixstock'))->result();
        echo 'matches = '.count($matches);
    if(!empty($matches)){

        foreach($matches as $match){ 

                $delete = $this->General_Model->delete_data('match_info_lang', 'match_id', $match->m_id);

                    $this->General_Model->delete_data('match_info', 'm_id', $match->m_id);

            
        }

    }

    }
    else if($table == "match_info_tixtock"){

        $matches = $this->General_Model->getAllItemTable_Array('match_info')->result();
        echo 'matches = '.count($matches);
    if(!empty($matches)){

        foreach($matches as $match){ 

                if($match->tixstock_id != ""){

                       $table                     = "match_info";
            $wheres                    = array('m_id' => $match->m_id);
            $uvalue                    = array('tixstock_id' => NULL);
            $stadium_up                =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);


                }
             

            
        }

    }

    }
     else if($table == "teams"){

        $teams = $this->General_Model->getAllItemTable_Array('teams', array('source_type' => 'tixstock'))->result();
         echo 'teams = '.count($teams);
    if(!empty($teams)){

        foreach($teams as $team){ 

                $delete = $this->General_Model->delete_data('teams_lang', 'team_id', $team->id);

                    $this->General_Model->delete_data('teams', 'id', $team->id);
                    
             

            
        }

    }

    }

    
    echo "DONE";exit;
    echo "<pre>";print_r($tickets);exit;

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
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_CUSTOMREQUEST => $method
            ));

            $response = curl_exec($curl);

                if (!file_exists("tix_logs/".$service)) { 
                mkdir("tix_logs/".$service, 0777, true);
                } 
                $time = strtotime(date("Ymdhis"));
                $fp = fopen("tix_logs/".$service."/".$time.'_request.json', 'a+');
                fwrite($fp, $post_data);
                fclose($fp);
                $fp = fopen("tix_logs/".$service."/".$time.'_response.json', 'a+');
                fwrite($fp, $response);
                fclose($fp);
            $formatted_response = json_decode($response,1);
            return $formatted_response;

    }
   
}
?>
