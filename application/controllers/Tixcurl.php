<?php 
ini_set('memory_limit','2048M');
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Tixcurl extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Tixstock_Model');
        $this->load->model('Tssa_Model');
        $this->load->model('General_Model');
        
        $this->language_array = array('en','ar');
        $this->ticket_type = array('eTicket' => 2,'Paper' => 3,'mobile' => 4,'Members / Season Card' => 1);
        $this->split_type = array('Avoid Leaving One Ticket' => 4,'No Preferences' => 5,'All Together' => 2,'Sell In Multiples' => 3);

        }

    public function updateVenues($data,$category='')
    {  
        if(!empty(($data['venue']))){

        $stadium_exists = $this->General_Model->getAllItemTable_Array('api_stadium', array('stadium_name' => $data['venue']['name'],'source_type' => 'tixstock','category' => $category))->row();
        $tmp_stadium_id = $stadium_exists->stadium_id;
        if($stadium_exists == 0){

            $insertsData['stadium_name'] = $data['venue']['name'];
            $insertsData['map_url'] = $data['map_url'];
            $insertsData['api_unique_id']  = $data['venue']['id'];
            $insertsData['merge_status'] = 0;
            $insertsData['source_type'] = 'tixstock';
            if($category != ""){
            $insertsData['category'] = $category;
            }
            $tmp_stadium_id                = $this->Tixstock_Model->insert_data('api_stadium',$insertsData);

        }

        $check_statdium_exists =  $this->Tixstock_Model->get_venues($data['venue']['name'])->row();
        $stadium_id            =  $check_statdium_exists->s_id;
        $stadium_name          =  $check_statdium_exists->stadium_name;


        $end_point_url = TIXSTOCK_ENDPOINT_URL.'venues/feed?id='.$data['venue']['id'];
        $venue_response = $this->process_curl_request("venues","GET",$end_point_url);
        $events = @$venue_response['data'][0]['events'];
        foreach($events as $event){
            $venue_details = $event['venue_details'];
            foreach($venue_details as $venue_detail){
                $category_name = $venue_detail['name'];

                $stadium_category_exists = $this->General_Model->getAllItemTable_Array('tixstock_stadium_category', array('category' => $category_name,'stadium_id' => $tmp_stadium_id))->row();
                    if($stadium_category_exists == 0){

                        $insertsvData['stadium_id'] = $tmp_stadium_id;
                        $insertsvData['category'] = $category_name;
                        $this->Tixstock_Model->insert_data('tixstock_stadium_category',$insertsvData);

                    }
            }
            
        }
        return $tmp_stadium_id;    
    }
    return "";
    }
     public function updatePerformers($data,$category='')
    { 
        $language_array = $this->language_array;
        $performers = $data['performers'];
        if(!empty($performers)){
            foreach($performers as $pkey => $performer){

                $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $performer['name'],'source_type' => 'tixstock','category' => $category))->row();
                $team_id = $teams_exists->team_id;
                if($teams_exists == 0){

                $insertsData['team_name'] = $performer['name'];
                $insertsData['api_unique_id']  = $data['venue']['id'];
                $insertsData['merge_status'] = 0;
                $insertsData['source_type'] = 'tixstock';
                if($category != ""){
                $insertsData['category'] = $category;
                }
                $team_id = $this->Tixstock_Model->insert_data('api_teams',$insertsData);
                }

                if($pkey == 0 && $team_id != ""){
                    $team_1_id      = $team_id;
                }
                if($pkey == 1 && $team_id != ""){
                    $team_2_id      = $team_id;
                }
                
               
            }
            
                }
                return array('team_1_id' => $team_1_id,'team_2_id' => $team_2_id);
                        return true;
    }

    public function updateTournaments($data,$category='')
    {  
        $language_array = $this->language_array;
        $category_name  = $data['name'];
        $tixstock_id    = $data['id'];

        $tournament_exists = $this->General_Model->getAllItemTable_Array('api_tournaments', array('tournament_name' => $category_name,'source_type' => 'tixstock','category' => $category))->row();
                $tournament_id = $tournament_exists->tournament_id;
                if($tournament_exists == 0){

                $insertsData['tournament_name'] = $category_name;
                $insertsData['api_unique_id']     = $tixstock_id;
                $insertsData['merge_status'] = 0;
                $insertsData['source_type'] = 'tixstock';
                if($category != ""){
                $insertsData['category'] = $category;
                }
                $tournament_id = $this->Tixstock_Model->insert_data('api_tournaments',$insertsData);

                }
                return $tournament_id;
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
                'tixstock_status' => 1,
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

            $match_settings_data = array();
            $match_settings_data['matches'] = $match_id;
            $match_settings_data['storefronts'] = 13;
            $match_settings_data['partners']  = 209;
            $match_settings_data['status']  = "1";
            $this->db->insert('match_settings', $match_settings_data);
                
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
            $uvalue                    = array('tixstock_id' => $tixstock_id,'price_type' => $currency,'tixstock_status' => 1);
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
            

           // $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?category_name=Premier League Football';
             $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?category_name=UEFA Champions League';
            $feed_response = $this->process_curl_request("feeds","GET",$end_point_url);
            //echo "<pre>";print_r($feed_response);exit;
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
                        if($data['category'] == "English Premier League"){
                            $tournament_id = 1;
                        }
                        else{
                           $tournament_id  = $this->updateTournaments($data['category']); 
                        }
                        

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
         
        //$page               = $_POST['page'];
        $page               = 1;
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
            //echo "<pre>";print_r($feed_response);exit;
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
                                        if(is_array(@$notes)){
                                            $listing_notes_data = implode(',',$notes);
                                        }
                                    }
                                    $ticketid           = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
                                    $ticket_group_id    = mt_rand(100000, 999999);
                                    
                                    $general_admission  = $listing['ticket']['general_admission'];
                                    $seat               = $listing['seat_details']['first_seat'];
                                    $ticket_type_data   = $listing['ticket']['type'];
                                    $split_type_data    = $listing['ticket']['split_type'];
                                    $ticket_category    = trim($listing['seat_details']['category']);
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
            $tournament = $_POST['category_name'];
             //$end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?category_name=Premier League Football&per_page=50&page='.$page;
            $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?per_page=10&page='.$page.'&category_name='.$tournament;echo $end_point_url;
            $feed_response = $this->process_curl_request("feeds","GET",$end_point_url);
            echo "feed_response <pre>";print_r($feed_response);exit;
            $match_data = array();
            $next = explode('=',$feed_response['links']['next']);
            $next_page       = ($next[1] != "") ? ($next[1]) : 1;
           // echo "feed_response <pre>";print_r($feed_response['links']['next']);exit;
            if(!empty($feed_response['data'])){
                        foreach ($feed_response['data'] as $datakey => $data) {
                           //echo "<pre>";print_r($data['listings']);exit;
                            //if($data['id'] == "01h2z77qpk6wtqqgfjf2ytbq2m"){

                           $tournament_category  = $this->General_Model->tournaments_1bx($data['category']['name']);
                            if($tournament_category[0]->category == "" && $tournament_data->category == "Rugby World Cup"){
                                $response['status'] = 0;
                                $response['flag'] = 'team';
                                $response['msg'] = "Tournament ".$data['category']['name'].' not matched with 1boxoffice Tournament.Please add with same name and try again.';
                                $response['next'] = 1;
                                echo json_encode($response);exit;
                            }
                             else if($tournament_category[0]->category == "" && $tournament_data->category != "Rugby World Cup"){
                                 $main_category = 1;
                             }
                            else{
                                $main_category = $tournament_category[0]->category;
                            }
                            
                            $listings     = $data['listings'];
                            $total_tickets = array();
                            foreach($listings as $listing){
                                $total_tickets[] = $listing['number_of_tickets_for_sale']['quantity_available'];
                            }
                            $no_of_tickets = array_sum($total_tickets);

                            $venues     = $data['venue'];
                            $stadium_id = $this->updateVenues($data,$main_category);

                            if(count($data['performers']) > 1){

                        $performer_data = $this->updatePerformers($data,$main_category);
                        $team_1_id      = $performer_data['team_1_id'];
                        $team_2_id      = $performer_data['team_2_id'];

                        $category_name  = $data['category']['name'];

                        $tournament_id  = $this->updateTournaments($data['category'],$main_category);

                        if($stadium_id != "" && $team_1_id != "" && $team_2_id != "" && $tournament_id != ""){
                            $tournament_name = $category_name;
                            $stadium_name = $data['venue']['name'];
                            $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_id' => $team_1_id,'source_type' => 'tixstock','category' => $main_category))->row();
                            $team_1_name = $teams_exists->team_name;
                            $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_id' => $team_2_id,'source_type' => 'tixstock','category' => $main_category))->row();
                            $team_2_name = $teams_exists->team_name;

                            $boxoffice_team_exists = $this->General_Model->get_team_exist($team_1_name,$main_category)->row();
                            $boxoffice_team_a = $boxoffice_team_exists->team_id;

                            $boxoffice_team_exists = $this->General_Model->get_team_exist($team_2_name,$main_category)->row();
                            $boxoffice_team_b = $boxoffice_team_exists->team_id;
                             $boxoffice_stadium_exists = $this->General_Model->getAllItemTable_Array('stadium', array('stadium_name' => $stadium_name,'category' => $main_category))->row();
                             $boxoffice_stadium_id = $boxoffice_stadium_exists->s_id;

                             $boxoffice_tournament_exists = $this->General_Model->get_tournaments_exist($tournament_name,$main_category)->row();
                             $boxoffice_tournament_id = $boxoffice_tournament_exists->tournament_id;
                              
                             $merge_found = 0;
                             if($boxoffice_tournament_id == ""){

                                $boxoffice_tournament_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $tournament_id,'source_type' => 'tixstock','content_type' => 'tournament'))->row();
                             $boxoffice_tournament_id = $boxoffice_tournament_exists->content_id;
                             if($boxoffice_tournament_id != ""){
                                $merge_found = 1;
                             }

                             } 
                             
                             if($boxoffice_team_a == ""){

                                $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_1_id,'source_type' => 'tixstock','content_type' => 'team'))->row();
                                $boxoffice_team_a = $boxoffice_team_exists->content_id;
                                if($boxoffice_team_a != ""){
                                $merge_found = 1;
                                }

                             } 
                             if($boxoffice_team_b == ""){

                                $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_2_id,'source_type' => 'tixstock','content_type' => 'team'))->row();
                                $boxoffice_team_b = $boxoffice_team_exists->content_id;
                                if($boxoffice_team_b != ""){
                                $merge_found = 1;
                                }

                             }
                             
                             if($boxoffice_stadium_id == ""){

                                $boxoffice_stadium_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $stadium_id,'source_type' => 'tixstock','content_type' => 'stadium'))->row();
                                $boxoffice_stadium_id = $boxoffice_stadium_exists->content_id;
                                if($boxoffice_stadium_id != ""){
                                $merge_found = 1;
                                }

                             }

                        } 
                       // echo $boxoffice_tournament_id.'-'.$boxoffice_team_a.'-'.$boxoffice_team_b.'-'.$boxoffice_stadium_id;exit;
                        //echo $boxoffice_tournament_id.'-'.$boxoffice_team_a.'-'.$boxoffice_team_b.'-'.$boxoffice_stadium_id;exit;
                        /*if($data['id'] == '01h2tjveg0wfnh9yf4envmg742'){

                            
                            echo $boxoffice_tournament_id.'-'.$boxoffice_team_a.'-'.$boxoffice_team_b.'-'.$boxoffice_stadium_id;exit;
                        }*/
                        $event_type = "other";
                        if($main_category == 1){
                            $event_type = "match";
                        }
                        $boxoffice_match_id        = $this->updateApiEvents($data,$boxoffice_tournament_id,$boxoffice_team_a,$boxoffice_team_b,$boxoffice_stadium_id,$event_type);
                        //echo $boxoffice_match_id;exit;
                        if($merge_found == 1 && $boxoffice_match_id != ""){
                            $merge_found = 1;
                        }
                        else{
                            $merge_found = 0;
                            if($boxoffice_match_id != ""){
                                $merge_found = 1;
                            }
                            
                        }
                        //echo $merge_found;exit;
                        $match_name           = $data['name'];
                        $match_date_string    = explode('T',$data['datetime']); 
                        $match_date           =  date("d M Y",strtotime($match_date_string[0]));
                        $match_time           =  date("H:i",strtotime($match_date_string[1]));
                        $match_date_time      = $match_date.'-'.$match_time;

                        if($boxoffice_match_id == ""){

                            $event_data = array(
                                'event_name' => $match_name,
                                'tournament' => $tournament_id,
                                'category' => $main_category,
                                'stadium'    => $stadium_id,
                                'team_a' => $team_1_name,
                                'team_b' => $team_2_name,
                                'match_date' => date("Y-m-d",strtotime($match_date_string[0])),
                                'match_date_time' => $match_date_time,
                                'tickets' => $no_of_tickets,
                                'merge_status' => 0,
                                'source_type' => 'tixstock',
                                'api_unique_id' => $data['id'],
                                'tixstock_parent_category' => $tixstock_parent_category,
                                'tixstock_category' => $tixstock_category,
                                'tixstock_tournament' => $tixstock_tournament,
                                'tixstock_tournaments' => $tixstock_tournaments,
                                'match_found' => 0,
                            );
                        }
                        else{
                            $event_data = array(
                                'match_id'  => $boxoffice_match_id,
                                'event_name' => $match_name,
                                'tournament' => $tournament_id,
                                'category' => $main_category,
                                'stadium' => $stadium_id,
                                'team_a' => $team_1_name,
                                'team_b' => $team_2_name,
                                'match_date' => date("Y-m-d",strtotime($match_date_string[0])),
                                'match_date_time' => $match_date_time,
                                'tickets' => $no_of_tickets,
                                'merge_status' => $merge_found,
                                'source_type' => 'tixstock',
                                'api_unique_id' => $data['id'],
                                'tixstock_parent_category' => $tixstock_parent_category,
                                'tixstock_category' => $tixstock_category,
                                'tixstock_tournament' => $tixstock_tournament,
                                'tixstock_tournaments' => $tixstock_tournaments,
                                'match_found' => 1,
                            );
                        }
                        //echo "<pre>";print_r($event_data);exit;
                        $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('api_unique_id' => $data['id'],'category' => $main_category))->row();
                        if($api_events_tickets->id != ""){
                            $event_id                  = $api_events_tickets->id;
                            $table                     = "api_events";
                            $wheres                    = array('id' => $api_events_tickets->id);
                            $uvalue                    = array('tickets' => $no_of_tickets,'merge_status' => $merge_found,'match_id'  => $boxoffice_match_id);
                            if($boxoffice_match_id > 0){
                                $uvalue['match_found'] = 1;
                            }
                            else{
                                $uvalue['match_found'] = 0;
                            }
                            $this->Tixstock_Model->update_table($table, $wheres, $uvalue);
                            if($boxoffice_match_id != ""){
                            $table1                     = "match_info";
                            $wheres1                    = array('m_id' => $boxoffice_match_id);
                            $uvalue1                    = array('tixstock_id' => $data['id']);
                            $this->Tixstock_Model->update_table($table1, $wheres1, $uvalue1);
                             }


                        }
                        else{

                            $event_id = $this->Tixstock_Model->insert_data('api_events',$event_data);
                            if($boxoffice_match_id != ""){
                            $table1                     = "match_info";
                            $wheres1                    = array('m_id' => $boxoffice_match_id);
                            $uvalue1                    = array('tixstock_id' => $data['id']);
                            $this->Tixstock_Model->update_table($table1, $wheres1, $uvalue1);
                             }
                        }
                        
                        
                        if($event_id != ""){
                            $match   =  $this->Tixstock_Model->get_event_pulling_api($event_id);
                            
                            $match_data[] =  $match;
                       }

                            }
                            //}
                           
                        }  
                        //echo "<pre>";print_r($match_data);exit;
                        if(!empty($match_data)){
                           $this->mydatas['match_data'] = $match_data;

                           $list_matches = $this->load->view(THEME.'game/get_tixstock_matches_v1', $this->mydatas, TRUE); 
                        } 
                        $response['status'] = 1;
                        $response['flag'] = "event";
                        $response['next'] = $next_page;
                        $response['matches'] = $list_matches;
            //$response['data'] = $feed_response;
             echo json_encode($response);exit;
            }  
            else{
                        $list_matches = $this->load->view(THEME.'game/get_tixstock_matches_v1', $this->mydatas, TRUE); 
                        $response['status'] = 1;
                        $response['flag'] = "event";
                        $response['next'] = $next_page;
                        $response['matches'] = $list_matches;
                         echo json_encode($response);exit;
            }
           
            
         }
        
    }

    public function updateApiEvents($data,$tournament_id,$team_1_id,$team_2_id,$stadium_id,$matchtype='')
    {  

          $match_date_string    = explode('T',$data['datetime']); 
          $match_date           =  $match_date_string[0];
          if($matchtype == ""){
            $matchtype = "match";
          }
          $check_match_exists   =  $this->Tixstock_Model->check_match_exists($match_date,$tournament_id,$team_1_id,$team_2_id,$matchtype)->row();
          $old_currency         = $check_match_exists->price_type;
          $source_type          = $check_match_exists->source_type;
          
          $match_id             = $check_match_exists->m_id;
           return $match_id;
    }
    
    public function migrateevents()
    { 
   /*     ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

         $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

        if($_POST['api_id'] == "tixstock"){
            $event_ids = $_POST['event_id'];
            

            $ticket_count = 0;
            foreach($event_ids as $event_id){

                 $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('id' => $event_id))->row();
                
                 $stadium = $api_events_tickets->stadium;
            if($api_events_tickets->api_unique_id != ""){
            $tixstock_id = $api_events_tickets->api_unique_id;
            $per_page = 50;
            $page = 1;
           // $tixstock_id = "01h2z77qpk6wtqqgfjf2ytbq2m";
            $end_point_url = TIXSTOCK_ENDPOINT_URL.'tickets/feed?event_id='.$tixstock_id.'&per_page='.$per_page.'&page='.$page;
            $feed_response = $this->process_curl_request("tickets","GET",$end_point_url);
            
            if(!empty($feed_response['data'])){ 
                        $seller_tickets = [];

                        foreach ($feed_response['data'] as $datakey => $listing) {
                              

                                $match_info = $this->General_Model->getAllItemTable_Array('match_info', array('tixstock_id' => $listing['event']['id']))->row();
                                if(!empty($match_info)){
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
                                        if(is_array(@$notes)){
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
                                     //echo "<pre>";print_r($seller_tickets);exit;
                                     
                                     $sell_ticket                                 = $this->sellerTickets_update($listing['id'],$seller_tickets);

                                     $ticket_count = $ticket_count + $quantity;

                                 }
                                 }
            
            } 
            }
            }

                    if($ticket_count == 0){
                    $msg = "No Tickets Updated.";
                    $response['next'] = $next_page;
                    $response['status'] = 0;
                    $response['msg'] = $msg;
                    echo json_encode($response);exit;
                    }else{
                    $msg = $ticket_count." Tickets Updated successfully.";
                    $response['next'] = $next_page;
                    $response['status'] = 1;
                    $response['msg'] = $msg;
                    echo json_encode($response);exit;  
                    }
            
        }
        else{
            $msg = "Invalid information selected.";
            $response['status'] = 0;
            $response['next'] = $next_page;
            $response['msg'] = $msg;
            echo json_encode($response);exit;
        }
       
    }
    public function updateEventsData($proceed = false)
    { 
    ini_set('memory_limit','2048M');
    //echo "updateFeedsEvents Disabled";exit;// echo "updateFeeds";exit;
    
        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

       if ($proceed == false) {
            $response['status'] = 0;
            $response['error_code'] = 403;
            $response['error']  = "Invalid request data.";
       }
       else{  
            $page       = ($_POST['page'] != "") ? ($_POST['page']) : 1;
            $tournament = $_POST['tournaments'];
            $tournament       = ($tournament != "") ? ($tournament) : $_POST['tournament'];
            if($_POST['tournament'] != "" && $_POST['tournaments'] == ""){
                 $tournament_data = $this->General_Model->getAllItemTable_Array('tixstock_categories', array('category_id' => $_POST['tournament']))->row();
                 $tournament = $tournament_data->category;
            } //echo "<pre>";print_r($tournament_data);exit;
          /*  $homepage = file_get_contents('tix_logs/rugby.json');
            $feed_response = json_decode($homepage,1);*/
             //$end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?category_name=Premier League Football&per_page=50&page='.$page;
            $end_point_url = TIXSTOCK_ENDPOINT_URL.'feed?per_page=10&page='.$page.'&category_name='.$tournament;
            $feed_response = $this->process_curl_request("feeds","GET",$end_point_url);
        
            $match_data = array();
            $next = explode('=',$feed_response['links']['next']);
            $next_page       = ($next[1] != "") ? ($next[1]) : 1;
           // echo "feed_response <pre>";print_r($feed_response['links']['next']);exit;
            if(!empty($feed_response['data'])){
                        foreach ($feed_response['data'] as $datakey => $data) {
                           // echo "tournament_category <pre>";print_r($data);exit;
                             $tournament_category  = $this->General_Model->tournaments_1bx($data['category']['name']);
                            if($tournament_category[0]->category == "" && $tournament_data->category == "Rugby World Cup"){
                                $response['status'] = 0;
                                $response['flag'] = 'team';
                                $response['msg'] = "Tournament ".$data['category']['name'].' not matched with 1boxoffice Tournament.Please add with same name and try again.';
                                $response['next'] = 1;
                                echo json_encode($response);exit;
                            }
                             else if($tournament_category[0]->category == "" && $tournament_data->category != "Rugby World Cup"){
                                 $main_category = 1;
                             }
                            else{
                                $main_category = $tournament_category[0]->category;
                            }
                            
                 /*           */
                            
                            /*$match_name_full     = $data['name'];
                            $data['performers']  = explode("vs",$match_name_full);*/
                            $venues     = $data['venue'];
                            $venue_data = $this->updateVenues($data,$main_category);
                            
                              
                            
                            //$performers     = $data['performers'];

                            if(count($data['performers']) > 1){

                        $performer_data = $this->updatePerformers($data,$main_category);

                        $category_name  = $data['category']['name'];

                        $tournament_id  = $this->updateTournaments($data['category'],$main_category);

                            }
                       
                           
                        }  

                        $response['status'] = 1;
                        $response['flag'] = 'team';
                        $response['msg'] = "Tournaments,Teams,Stadiums Updated successfully.";
                        $response['next'] = $next_page;
                        echo json_encode($response);exit;
            }  
            else{
                      
                        $response['status'] = 0;
                        $response['flag'] = 'team';
                        $response['msg'] = "Empty response from API.";
                        $response['next'] = $next_page;
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
                        if($category_name == "English Premier League"){
                            $tournament_id = 1;
                        }
                        else{
                            $tournament_id  = $this->updateTournaments($data['category']);
                        }
                        

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

            $pods                      = $tixstock_response['data']['proof_file_url'];

            if(!empty($pods)){
                $pods_data = implode(',',$pods);
            
                
          $table                     = "booking_ticket_tracking";
            $wheres                    = array('booking_id' => $booking->bg_id);
            $uvalue                    = array('pod' => $pods_data,"pod_status" => 1,"source_type" => "tixstock");
            $ticket_update             =  $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

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

function get_default_selection(){
    if($_POST["api"] != "" && $_POST["val"] != "" && $_POST["content_type"] != "" && $_POST["flag"] != ""){

        if($_POST["flag"] == 0){
            $wheresv1 = "api_content_id";
        }
        else{
            $wheresv1 = "content_id";
        }

         $fetch_data = $this->General_Model->getAllItemTable_Array('merge_api_content', array($wheresv1 => $_POST["val"],"content_type" => $_POST["content_type"],'source_type' => $_POST["api"]))->row();

         echo json_encode(array("data" => $fetch_data,'flag' => $_POST["flag"],'content_type' => $_POST["content_type"]));exit;

    }
}
function mergecontent(){

    $this->form_validation->set_rules('api', 'Api', 'required');
    if($_POST['api_tournament'] != "" || $_POST['tournament'] != ""){
        $this->form_validation->set_rules('api_tournament', 'Api Tournament', 'required');
        $this->form_validation->set_rules('tournament', '1Boxoffice Tournament', 'required');
    }
    if($_POST['api_team'] != "" || $_POST['team'] != ""){
        $this->form_validation->set_rules('api_team', 'Api Team', 'required');
        $this->form_validation->set_rules('team', '1Boxoffice team', 'required');
    }
    if($_POST['api_stadium'] != "" || $_POST['stadium'] != ""){
        $this->form_validation->set_rules('api_stadium', 'Api Stadium', 'required');
        $this->form_validation->set_rules('stadium', '1Boxoffice stadium', 'required');
    }
   // echo "<pre>";print_r($_POST);exit;
    if ($this->form_validation->run() !== false) {

        if($_POST['api_team'] != "" && $_POST['team'] != ""){

        $team_count = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $_POST['api_team'],'content_type' => 'team','source_type' => $_POST['api']))->num_rows();
        if($team_count >= 1){

        $this->db->where('api_content_id',$_POST['api_team']);
        $this->db->where('source_type',$_POST['api']);
        $this->db->where('content_type','team');
        $this->db->delete('merge_api_content');

        }
        $post_data_team = array(
                        'api_content_id'        => $_POST['api_team'],
                        'content_id'            => $_POST['team'],
                        'source_type'           => $_POST['api'],
                        'content_type'          => 'team',
                        'merged_on'             => date("Y-m-d h:i:s"),
                    );
        $this->General_Model->insert_data('merge_api_content', $post_data_team);

            $table                     = "api_teams";
            $wheres                    = array('team_id' => $_POST['api_team']);
            $uvalue                    = array('merge_status' => 1);
            $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

        }

        if($_POST['api_tournament'] != "" && $_POST['tournament'] != ""){

        $tournament_count = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $_POST['api_tournament'],'content_type' => 'tournament','source_type' => $_POST['api']))->num_rows();
        if($tournament_count >= 1){

        $this->db->where('api_content_id',$_POST['api_tournament']);
        $this->db->where('source_type',$_POST['api']);
        $this->db->where('content_type','tournament');
        $this->db->delete('merge_api_content');

        }

        $post_data_tournament = array(
                        'api_content_id'        => $_POST['api_tournament'],
                        'content_id'            => $_POST['tournament'],
                        'source_type'           => $_POST['api'],
                        'content_type'          => 'tournament',
                        'merged_on'             => date("Y-m-d h:i:s")
                    );
        $this->General_Model->insert_data('merge_api_content', $post_data_tournament);

            $table                     = "api_tournaments";
            $wheres                    = array('tournament_id' => $_POST['api_tournament']);
            $uvalue                    = array('merge_status' => 1);
            $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

        }

        if($_POST['api_stadium'] != "" && $_POST['stadium'] != ""){

        $stadium_count = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $_POST['api_stadium'],'content_type' => 'stadium','source_type' => $_POST['api']))->num_rows();
        //echo "stadium_count = ".$stadium_count;exit;
        if($stadium_count >= 1){

        $this->db->where('api_content_id',$_POST['api_stadium']);
        $this->db->where('source_type',$_POST['api']);
        $this->db->where('content_type','stadium');
        $this->db->delete('merge_api_content');

        }

        $post_data_stadium = array(
                        'api_content_id'        => $_POST['api_stadium'],
                        'content_id'            => $_POST['stadium'],
                        'source_type'           => $_POST['api'],
                        'content_type'          => 'stadium',
                        'merged_on'             => date("Y-m-d h:i:s")
                    );
        $this->General_Model->insert_data('merge_api_content', $post_data_stadium);

            $table                     = "api_stadium";
            $wheres                    = array('stadium_id' => $_POST['api_stadium']);
            $uvalue                    = array('merge_status' => 1);
            $this->Tixstock_Model->update_table($table, $wheres, $uvalue);

        }

        $response = array(
                    'status' => 1,
                    'msg' => "Data Merged Successfully",
                    'redirect_url' => base_url() . 'game/merge_cms'
                );

                echo json_encode($response);
                exit;

    }
    else {

    $response = array(
    'status' => 0,
    'msg' => validation_errors(),
    'redirect_url' => base_url() . 'game/merge_cms'
    );

    echo json_encode($response);
    exit;
    }
    echo "<pre>";print_r();exit;
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
