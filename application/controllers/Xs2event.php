<?php 
ini_set('memory_limit','2048M');
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Xs2event extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Tixstock_Model');
        $this->load->model('Tssa_Model');
        $this->load->model('General_Model');
        $this->language_array = array('en','ar');
        $this->ticket_type = array('eticket' => 2,'paper' => 3,'appticket' => 4,'paper-ticket' => 3,'collection-stadium' => 1,'other' => 1);
        $this->split_type = array('no_max_minus_1' => 4,'No Preferences' => 5,'All Together' => 2,'pairs_only' => 3);

    }

      public function get_countries($page=1){

        $method   = "GET";
        $post_url = XS2EVENT_APIURL.'countries?page_size=10&page='.$page;

        $country_responses = $this->process_curl_request('countries',$method,$post_url);

        $next            = explode('page=',$country_responses['pagination']['next_page']);
        $next_page       = ($next[1] != "") ? ($next[1]) : 1;
      
        if(!empty($country_responses['countries'])){
            
            foreach($country_responses['countries'] as $country_response){

                $country_exists = $this->General_Model->getAllItemTable_Array('xs2event_countries', array('country_code' => trim($country_response['country'])))->row();
                $country_id = $country_exists->country_id;
                if(@$country_id == ''){

                    $insertsData['country_code']    = trim($country_response['country']);
                    $country_id                     = $this->Tixstock_Model->insert_data('xs2event_countries',$insertsData);

                }
            }

        
    }
        if($next_page > $page){
            $this->get_countries($next_page);
            
        }
    echo "COUNTRY DATA UPDATED SUCCESSFULLY.";exit; 
    }


          public function get_cities($country="GBR",$page=1){

        $method   = "GET";
        $post_url = XS2EVENT_APIURL.'cities?country='.$country.'&page_size=100&page='.$page;

        $city_responses = $this->process_curl_request('cities',$method,$post_url);

        $next            = explode('page=',$city_responses['pagination']['next_page']);
        $next_page       = ($next[1] != "") ? ($next[1]) : 1;
      
        if(!empty($city_responses['cities'])){
            
            foreach($city_responses['cities'] as $city_response){

                $city_exists = $this->General_Model->getAllItemTable_Array('xs2event_cities', array('country' => trim($city_response['country']),'city' => trim($city_response['city'])))->row();

                $city_id = $city_exists->city_id;
                if(@$city_id == ''){

                    $insertsData['country']     = trim($city_response['country']);
                    $insertsData['city']        = trim($city_response['city']);
                    $country_id                     = $this->Tixstock_Model->insert_data('xs2event_cities',$insertsData);

                }
            }

        
    }
        if($next_page > $page){
            $this->get_cities($next_page);
            
        }
    echo "CITY DATA UPDATED SUCCESSFULLY.";exit;    
    }


    public function get_sports(){

        $method   = "GET";
        $post_url = XS2EVENT_APIURL.'sports';
        $sports_responses = $this->process_curl_request('sports',$method,$post_url);
        if(!empty($sports_responses['sports'])){
            foreach($sports_responses['sports'] as $sports_response){
                $xs2events_count = $this->General_Model->getAllItemTable_Array('xs2event_categories', array('category' => trim($sports_response['sport_id'])))->num_rows();
                if($xs2events_count == 0){
                    $category_data = array('category' => trim($sports_response['sport_id']));
                    $this->General_Model->insert_data('xs2event_categories', $category_data);
                }
                
            }

        
    }
        echo "SPORTS DATA UPDATED SUCCESSFULLY.";exit;  
    }


     public function get_teams($tournament_id = "21d6af0ac4414efeabef87addce963e5_trn",$page = 1){

        $method   = "GET";
        $post_url = XS2EVENT_APIURL.'teams?tournament_id='.$tournament_id.'&page_size=10&page='.$page;

        $team_responses = $this->process_curl_request('teams',$method,$post_url);

        $next            = explode('page=',$team_responses['pagination']['next_page']);
        $next_page       = ($next[1] != "") ? ($next[1]) : 1;
      
        if(!empty($team_responses['teams'])){
            
            foreach($team_responses['teams'] as $team_response){
                if($team_response['official_name'] == "soccer"){
                    $category = 1;
                }
            
            $data['team_name']          = trim($team_response['official_name']);
            $data['api_unique_id']      = trim($team_response['team_id']);

                $this->updatePerformers($data,$category);
            }

        
    }
        if($next_page > $page){
            $this->get_teams($tournament_id,$next_page);
            
        }
        return true;
    //echo "VENUE DATA UPDATED SUCCESSFULLY.";exit; 
    }

    public function get_tournament_by_category($page=1){

        $xs2events = $this->General_Model->getAllItemTable_Array('xs2event_categories', array('parent_category' => null))->result();
        
        $method         = "GET";
        $current_year   = date('Y');
        foreach($xs2events as $xs2event){ 
            //$post_url .= '&sport_type=motorsport';
            $post_url = XS2EVENT_APIURL.'tournaments?page_size=10&page='.$page.'&date_start=ge%3A'.$current_year.'-01-01&sport_type='.$xs2event->category;
            $tournaments = $this->process_curl_request('tournaments',$method,$post_url);
            $next            = explode('page=',$tournaments['pagination']['next_page']);
            $next_page       = ($next[1] != "") ? ($next[1]) : 1;
            
            if(!empty($tournaments['tournaments'])){
                foreach($tournaments['tournaments'] as $tournament){
                    $xs2events_count = $this->General_Model->getAllItemTable_Array('xs2event_categories', array('category' =>$tournament['official_name'],'unique_id' => $tournament['tournament_id']))->num_rows();
                    if($xs2events_count == 0){
                        $category_data = array('category' => $tournament['official_name'],'unique_id' => $tournament['tournament_id'],'parent_category' => $xs2event->id);
                        $this->General_Model->insert_data('xs2event_categories', $category_data);
                    }
                    
                }

            }
        }
        if($next_page > $page){
            $this->get_tournament_by_category($next_page);
            
        }
        echo "CATEGORY UPDATED SUCCESSFULLY.";exit; 
    }



    public function update_all_venues(){

        $xs2countries = $this->General_Model->getAllItemTable('xs2event_countries')->result();

        if(!empty($xs2countries)){
            foreach($xs2countries as $xs2country){
                if($xs2country->country_code != ""){
                    $this->get_venues($xs2country->country_code);
                }
            }

        }
        echo "VENUE DATA UPDATED SUCCESSFULLY.";exit;   
    }



    public function get_venues($country_code = "GBR",$page = 1){

        $method   = "GET";
        $post_url = XS2EVENT_APIURL.'venues?country='.$country_code.'&page_size=10&page='.$page;

        $venues_response = $this->process_curl_request('venues',$method,$post_url);

        $next            = explode('page=',$venues_response['pagination']['next_page']);
        $next_page       = ($next[1] != "") ? ($next[1]) : 1;
      
        if(!empty($venues_response['venues'])){
            
            foreach($venues_response['venues'] as $venues_response){

                $category = 1;

                $stadium_exists = $this->General_Model->getAllItemTable_Array('api_stadium', array('stadium_name' => trim($venues_response['official_name']),'source_type' => 'xs2event','category' => $category))->row();
                $tmp_stadium_id = $stadium_exists->stadium_id;
                $venue_id       = $stadium_exists->api_unique_id;;
                if(@$tmp_stadium_id == ''){

                    $insertsData['stadium_name']    = trim($venues_response['official_name']);
                    $insertsData['map_url']         = '';
                    $insertsData['api_unique_id']   = trim($venues_response['venue_id']);
                    $insertsData['merge_status']    = 0;
                    $insertsData['source_type']     = 'xs2event';
                    if($category != ""){
                    $insertsData['category']        = $category;
                    }
                    $tmp_stadium_id                = $this->Tixstock_Model->insert_data('api_stadium',$insertsData);
                    $venue_id = trim($venues_response['venue_id']);

                }

               // $this->update_stadium_categories($tmp_stadium_id,$venue_id);
            }

        
    }
        if($next_page > $page){
            $this->get_venues($country_code,$next_page);
            
        }
        return true;
    //echo "VENUE DATA UPDATED SUCCESSFULLY.";exit; 
    }

     public function update_stadium_categories($stadium_id,$venue_id,$page = 1){

        $post_url = XS2EVENT_APIURL.'categories?page_size=100&page='.$page.'&venue_id='.$venue_id;

        $venue_response = $this->process_curl_request("categories","GET",$post_url);
        $venue_details = @$venue_response['categories'];

        $next            = explode('page=',$venue_response['pagination']['next_page']);
        $next_page       = ($next[1] != "") ? ($next[1]) : 1;

            foreach($venue_details as $venue_detail){
                $category_name = trim($venue_detail['category_name']);
                $category_id = trim($venue_detail['category_id']);

                $stadium_category_exists = $this->General_Model->getAllItemTable_Array('xs2event_stadium_category', array('category' => $category_name,'stadium_id' => $stadium_id))->row();
                    if(@$stadium_category_exists->id == ''){

                        $insertsvData['stadium_id'] = $stadium_id;
                        $insertsvData['category']   = $category_name;
                        //$insertsvData['category_id']   = $category_id;
                        $this->Tixstock_Model->insert_data('xs2event_stadium_category',$insertsvData);

                    }
           
            
        }

        if($next_page > $page){
            $this->update_stadium_categories($stadium_id,$venue_id,$next_page);
            
        }
        return true;

     }
    

    public function updateApiEvents($data,$tournament_id,$team_1_id,$team_2_id,$stadium_id,$matchtype='',$flag="")
    {  

          $match_date_string    = explode('T',$data['datetime']); 
          $match_date           =  $match_date_string[0];
          if($matchtype == ""){
            $matchtype = "match";
          }
          $check_match_exists   =  $this->Tixstock_Model->check_match_exists($match_date,$tournament_id,$team_1_id,$team_2_id,$matchtype,$flag)->row();
          $old_currency         = $check_match_exists->price_type;
          $source_type          = $check_match_exists->source_type;
          
          $match_id             = $check_match_exists->m_id;
           return $match_id;
    }


    public function updateVenues($venue,$venue_id,$category='')
    {  
        if($venue != ""){

        $stadium_exists = $this->General_Model->getAllItemTable_Array('api_stadium', array('stadium_name' => trim($venue),'source_type' => 'xs2event','category' => $category))->row();
        $tmp_stadium_id = $stadium_exists->stadium_id;
        if(@$tmp_stadium_id == ''){

            $insertsData['stadium_name']    = $venue;
            $insertsData['map_url']         = '';
            $insertsData['api_unique_id']   = $venue_id;
            $insertsData['merge_status']    = 0;
            $insertsData['source_type']     = 'xs2event';
            if($category != ""){
            $insertsData['category']        = $category;
            }
            $tmp_stadium_id                = $this->Tixstock_Model->insert_data('api_stadium',$insertsData);

        }

        $check_statdium_exists =  $this->Tixstock_Model->get_venues($venue)->row();
        $stadium_id            =  $check_statdium_exists->s_id;
        $stadium_name          =  $check_statdium_exists->stadium_name;

        $post_url = XS2EVENT_APIURL.'categories?page_size=100&page=1&venue_id='.$venue_id;

        $venue_response = $this->process_curl_request("categories","GET",$post_url);
        $venue_details = @$venue_response['categories'];
       
            foreach($venue_details as $venue_detail){
                $category_name = trim($venue_detail['category_name']);
                $category_id = trim($venue_detail['category_id']);
                $stadium_category_exists = $this->General_Model->getAllItemTable_Array('xs2event_stadium_category', array('category' => $category_name,'stadium_id' => $tmp_stadium_id))->row();
                    if(@$stadium_category_exists->id == ''){

                        $insertsvData['stadium_id'] = $tmp_stadium_id;
                        $insertsvData['category']   = $category_name;
                       // $insertsvData['category_id']   = $category_id;
                        $this->Tixstock_Model->insert_data('xs2event_stadium_category',$insertsvData);

                    }
           
            
        }
        return $tmp_stadium_id;    
    }
    return "";
    }

     public function updatePerformers($data,$category='')
    { 
        
        $team_name      = $data['team_name'];
        $api_unique_id  = $data['api_unique_id'];
        if($team_name != ""){
                
                    $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_name,'source_type' => 'xs2event','category' => $category))->row();
                    $team_id = @$teams_exists->team_id;

                    if(@$team_id == ''){

                    $insertsData['team_name']       = $team_name;
                    $insertsData['api_unique_id']   = $api_unique_id;
                    $insertsData['merge_status']    = 0;
                    $insertsData['source_type']     = 'xs2event';
                        if($category != ""){
                        $insertsData['category'] = $category;
                        }
                        $team_id = $this->Tixstock_Model->insert_data('api_teams',$insertsData);
                        
                    }
                    return $team_id;
           
                }
                
    }


     public function updateTournaments($data,$category='')
    {  
        $language_array   = $this->language_array;
        $tournament_name  = $data['tournament_name'];
        $tournaments_id    = $data['tournament_id'];

        $tournament_exists = $this->General_Model->getAllItemTable_Array('api_tournaments', array('tournament_name' => $tournament_name,'source_type' => 'xs2event','category' => $category))->row();
                $tournament_id = @$tournament_exists->tournament_id;
                if(@$tournament_id == ''){

                $insertsData['tournament_name']   = $tournament_name;
                $insertsData['api_unique_id']     = $tournaments_id;
                $insertsData['merge_status']      = 0;
                $insertsData['source_type']       = 'xs2event';
                    if($category != ""){
                        $insertsData['category']  = $category;
                    }
                $tournament_id = $this->Tixstock_Model->insert_data('api_tournaments',$insertsData);

                }
                return $tournament_id;
    }

    public function updateFeedsEvents($proceed = false)
    {
        
        
        $category_name               = $_POST['category_name'];

        $tournaments = $this->General_Model->getAllItemTable_Array('xs2event_categories', array('unique_id' => $category_name))->row();
        $xs2event_tournaments = $tournaments->unique_id;

        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

       if ($proceed == false) {
            $response['status'] = 0;
            $response['error_code'] = 403;
            $response['error']  = "Invalid request data.";
       }
       else{  
            $page           = ($_POST['page'] != "") ? ($_POST['page']) : 1;
            $category_name  = $_POST['category_name'];
            $date_start     = date('Y-m-d');
            $method         = "GET";
            $post_url = XS2EVENT_APIURL.'events?page_size=10&page='.$page.'&date_start=ge%3A'.$date_start.'&tournament_id='.$category_name;

            try
            { 

            $feed_response = $this->process_curl_request("events",$method,$post_url);
            $match_data = array();
            $next            = explode('page=',$feed_response['pagination']['next_page']);
            $next_page       = ($next[1] != "") ? ($next[1]) : 1;
            

            if(!empty($feed_response['events'])){ 
                        foreach ($feed_response['events'] as $datakey => $data) {
                         
                           $tournament_category  = $this->General_Model->tournaments_1bx($data['tournament_name']);
                             
                            if($tournament_category[0]->category == "" && $data['category']['name'] == "Rugby World Cup"){
                                $response['status'] = 0;
                                $response['flag'] = 'team';
                                $response['msg'] = "Tournament ".$data['category']['name'].' not matched with 1boxoffice Tournament.Please add with same name and try again.';
                                $response['next'] = 1;
                                echo json_encode($response);exit;
                            }
                             else if($tournament_category[0]->category == "" && $data['tournament_name'] != "Rugby World Cup"){
                                 $parent_tournament_name = $tournament_category[0]->tournament_name;
                                 $main_category = 1;
                             }
                            else{
                                $parent_tournament_name = $tournament_category[0]->tournament_name;
                                $main_category = $tournament_category[0]->category;
                            }
                            
                           
                            $no_of_tickets = $data['number_of_tickets'] ? $data['number_of_tickets'] : 0;
                            if($data['venue_name'] != "" && $data['venue_id'] != ""){
                                $venues     = $data['venue_name'];
                                $venue_id   = $data['venue_id'];
                                $stadium_id = $this->updateVenues($venues,$venue_id,$main_category);
                            }
                            
                            if($data['hometeam_name'] != "" && $data['hometeam_id'] != ""){
                                $team_data      = array('team_name' => $data['hometeam_name'],'api_unique_id' => $data['hometeam_id']);
                                $team_1_id = $this->updatePerformers($team_data,$main_category);
                            }

                            if($data['visiting_name'] != "" && $data['visiting_id'] != ""){
                                $team_data      = array('team_name' => $data['visiting_name'],'api_unique_id' => $data['visiting_id']);
                                $team_2_id = $this->updatePerformers($team_data,$main_category);
                            }

                            if($data['tournament_name'] != "" && $data['tournament_id'] != ""){

                            
                                $tournament_data    = array('tournament_name' => $data['tournament_name'],'tournament_id' => $data['tournament_id']);
                                $tournament_id  = $this->updateTournaments($tournament_data,$main_category);

                            }  
                           
                            // $this->get_team_row($data['hometeam_name'], $main_category);
                            // $this->get_team_row($data['visiting_name'], $main_category);
                            // $this->get_stadium_row($data['venue_name'],1);
               
                            if($team_1_id != "" && $team_2_id != ""){
                        
                                if($stadium_id != "" && $team_1_id != "" && $team_2_id != "" && $tournament_id != ""){
                            $tournament_name = $data['tournament_name'];
                            $stadium_name    = $data['venue_name'];

                            $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_id' => $team_1_id,'source_type' => 'xs2event','category' => $main_category))->row();
                            $team_1_name = $teams_exists->team_name;

                            $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_id' => $team_2_id,'source_type' => 'xs2event','category' => $main_category))->row();
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

                                $boxoffice_tournament_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $tournament_id,'source_type' => 'xs2event','content_type' => 'tournament'))->row();
                             $boxoffice_tournament_id = $boxoffice_tournament_exists->content_id;
                             if($boxoffice_tournament_id != ""){
                                $merge_found = 1;
                             }

                             } 
                             
                             if($boxoffice_team_a == ""){

                                $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_1_id,'source_type' => 'xs2event','content_type' => 'team'))->row();
                                $boxoffice_team_a = $boxoffice_team_exists->content_id;
                                if($boxoffice_team_a != ""){
                                $merge_found = 1;
                                }

                             } 
                             if($boxoffice_team_b == ""){

                                $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_2_id,'source_type' => 'xs2event','content_type' => 'team'))->row();
                                $boxoffice_team_b = $boxoffice_team_exists->content_id;
                                if($boxoffice_team_b != ""){
                                $merge_found = 1;
                                }

                             }
                             
                             if($boxoffice_stadium_id == ""){

                                $boxoffice_stadium_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $stadium_id,'source_type' => 'xs2event','content_type' => 'stadium'))->row();
                                $boxoffice_stadium_id = $boxoffice_stadium_exists->content_id;
                                if($boxoffice_stadium_id != ""){
                                $merge_found = 1;
                                }

                             }

                        } 
                     
                        $event_type = "other";
                        if($main_category == 1){
                            $event_type = "match";
                        }
                        $datatime['datetime']      = $data['date_start'];
                        $boxoffice_match_id        = $this->updateApiEvents($datatime,$boxoffice_tournament_id,$boxoffice_team_a,$boxoffice_team_b,$boxoffice_stadium_id,$event_type);
                        if($boxoffice_match_id == ""){
                            $boxoffice_match_id        = $this->updateApiEvents($datatime,$boxoffice_tournament_id,$boxoffice_team_b,$boxoffice_team_a,$boxoffice_stadium_id,$event_type,1);
                            if($boxoffice_match_id != ""){
                                $t1 = $team_1_name;
                                $t2 = $team_2_name;
                                $team_1_name = $t2;
                                $team_2_name = $t1;
                            }
                        }
                        
                        if($merge_found == 1 && $boxoffice_match_id != ""){
                            $merge_found = 1;
                        }
                        else{
                            $merge_found = 0;
                            if($boxoffice_match_id != ""){
                                $merge_found = 1;
                            }
                            
                        }
                        

                        $match_name           = $data['event_name'];
                        $match_date_string    = explode('T',$data['date_start']); 
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
                                'source_type' => 'xs2event',
                                'api_unique_id' => $data['event_id'],
                                'tixstock_parent_category' => $parent_tournament_name,
                                'tixstock_category' => '',
                                'tixstock_tournament' => '',
                                'tixstock_tournaments' => '',
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
                                'source_type' => 'xs2event',
                                'api_unique_id' => $data['event_id'],
                                'tixstock_parent_category' => $parent_tournament_name,
                                'tixstock_category' => '',
                                'tixstock_tournament' => '',
                                'tixstock_tournaments' => '',
                                'match_found' => 1,
                            );
                        }
                       
                        $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('api_unique_id' => $data['event_id'],'category' => $main_category))->row();
                        if(@$api_events_tickets->id != ""){
                            
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
                            $uvalue1                    = array('xs2event_id' => $data['event_id']);
                            $this->Tixstock_Model->update_table($table1, $wheres1, $uvalue1);
                             }


                        }
                        else{
                            
                            $event_id = $this->Tixstock_Model->insert_data('api_events',$event_data);
                            
                            if($boxoffice_match_id != ""){
                            $table1                     = "match_info";
                            $wheres1                    = array('m_id' => $boxoffice_match_id);
                            $uvalue1                    = array('xs2event_id' => $data['event_id']);
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
            catch(BP\InsureHubApiNotFoundException $validationException){
            $error = $validationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiValidationException $validationException){
            $error = $validationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiAuthorisationException $authorisationException){
            $error = $authorisationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiAuthenticationException $authenticationException){
            $error = $authenticationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubException $insureHubException){
            $error =  $insureHubException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(Exception $exception){
            $error = $exception->getMessage();
            $this->custom_error_log($error);
            }
            
         }

    }

     public function updateEventsData($proceed = false)
    {
        ini_set('memory_limit','2048M');
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
        $date_start = date('Y-m-d');
        $method     = "GET";
        if($tournament != ""){

            $post_url = XS2EVENT_APIURL.'events?page_size=12&page='.$page.'&date_start=ge%3A'.$date_start.'&tournament_id='.$tournament;
            try
            { 
            $feed_response   = $this->process_curl_request('events',$method,$post_url);
             $match_data = array(); 
            $next = explode('page=',$feed_response['pagination']['next_page']);
            $next_page       = ($next[1] != "") ? ($next[1]) : 1;
          // echo "feed_response <pre>";print_r($feed_response['links']['next']);exit;
            if(!empty($feed_response['events'])){
                        foreach ($feed_response['events'] as $datakey => $data) {
                           
                             $tournament_category  = $this->General_Model->tournaments_1bx($data['tournament_name']);
                             
                            if($tournament_category[0]->category == "" && $data['category']['name'] == "Rugby World Cup"){
                                $response['status'] = 0;
                                $response['flag'] = 'team';
                                $response['msg'] = "Tournament ".$data['category']['name'].' not matched with 1boxoffice Tournament.Please add with same name and try again.';
                                $response['next'] = 1;
                                echo json_encode($response);exit;
                            }
                             else if($tournament_category[0]->category == "" && $data['tournament_name'] != "Rugby World Cup"){
                                 $main_category = 1;
                             }
                            else{
                                $main_category = $tournament_category[0]->category;
                            }

                            
                 /*           */
                            
                            /*$match_name_full     = $data['name'];
                            $data['performers']  = explode("vs",$match_name_full);*/
                            if($data['venue_name'] != "" && $data['venue_id'] != ""){
                                $venues     = $data['venue_name'];
                                $venue_id   = $data['venue_id'];
                                $venue_data = $this->updateVenues($venues,$venue_id,$main_category);
                            }
                            
                            if($data['hometeam_name'] != "" && $data['hometeam_id'] != ""){
                                $team_data      = array('team_name' => $data['hometeam_name'],'api_unique_id' => $data['hometeam_id']);
                                $this->updatePerformers($team_data,$main_category);
                            }

                            if($data['visiting_name'] != "" && $data['visiting_id'] != ""){
                                $team_data      = array('team_name' => $data['visiting_name'],'api_unique_id' => $data['visiting_id']);
                                $this->updatePerformers($team_data,$main_category);
                            }
                              
                            
                            //$performers     = $data['performers'];

                          if($data['tournament_name'] != "" && $data['tournament_id'] != ""){

                            
                                $tournament_data    = array('tournament_name' => $data['tournament_name'],'tournament_id' => $data['tournament_id']);
                                $tournament_id  = $this->updateTournaments($tournament_data,$main_category);

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
            catch(BP\InsureHubApiNotFoundException $validationException){
            $error = $validationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiValidationException $validationException){
            $error = $validationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiAuthorisationException $authorisationException){
            $error = $authorisationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiAuthenticationException $authenticationException){
            $error = $authenticationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubException $insureHubException){
            $error =  $insureHubException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(Exception $exception){
            $error = $exception->getMessage();
            $this->custom_error_log($error);
            }
            
        }
    }
        
        echo "updateEventsData";exit;
    }

    public function stadiumCategory_update($category,$stadium_id=''){

    $language_array = $this->language_array;
    $category_data  =   $this->Tssa_Model->get_seat_category($category);

    if($category_data == ""){

        $seat_category_data =  array(
        'seat_category'         => $category,
        'status'                => 1,
        'create_date'           => time(),
        'event_type'            => 'match',
        'source_type'           => 'xs2event'

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

          $seat_category_colorcode_data =  array(
                    'stadium_id'         => $stadium_id,
                    'category_id'        => $category_id,
                    'color_code'         => 'rgb(0, 0, 0)'
                );
          $this->Tixstock_Model->insert_data('stadium_color_category',$seat_category_colorcode_data);


                            }    
        return $category_id;                           
    }
    else{

        $category_id =  $category_data->stadium_seat_id;
        return $category_id;

    }

        


}

    public function stadiumCategory_update_v1($stadium_id,$category,$category_id,$onebox_stadium_id){

    $language_array = $this->language_array;
    $api_stadiums_category = $this->General_Model->getAllItemTable_Array('xs2event_stadium_category', array('stadium_id' => $stadium_id,'category' => $category))->row();
    
    if($api_stadiums_category->id == ""){
      //  $category_data = array('stadium_id' => $stadium_id,'category' => $category,'category_id' => $category_id,'merge_status' => 0);
    	  $category_data = array('stadium_id' => $stadium_id,'category' => $category,'merge_status' => 0);
        $api_stadiums_category_id = $this->Tixstock_Model->insert_data('xs2event_stadium_category',$category_data);
    }
    else{
        $api_stadiums_category = $this->General_Model->getAllItemTable_Array('merge_api_stadium_category', array('stadium_id' => $stadium_id,'api_category' => $api_stadiums_category->id,'onebox_stadium_id' => $onebox_stadium_id,'source_type' => 'xs2event'))->row();
        if($api_stadiums_category->category != ""){
            return $api_stadiums_category->category;
        }
    }
    return "";

}

     public function migrateevents()
    { 

        $ticket_type = $this->ticket_type;
        $split_type  = $this->split_type;

        $action = $_POST['action'];
        

        if($action == "pull"){

            if($_POST['api_id'] == "xs2event"){

                $event_ids      = $_POST['event_id'];
                $ticket_count   = 0;
            foreach($event_ids as $event_id){

                 $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('id' => $event_id))->row();
                 $stadium            = $api_events_tickets->stadium;
            
            if($api_events_tickets->api_unique_id != ""){
            
            $event_id = $api_events_tickets->api_unique_id;
            $per_page = 50;
            $page = 1;

            $end_point_url = XS2EVENT_APIURL.'tickets?event_id='.$event_id.'&page_size='.$per_page.'&page='.$page;
            try
            { 

            $feed_response = $this->process_curl_request("tickets","GET",$end_point_url);
            
            if(!empty($feed_response['tickets'])){ 
                        
                        $seller_tickets = [];
                        foreach ($feed_response['tickets'] as $datakey => $listing) {
                              
                                    //echo "<pre>";print_r($listing);exit;
                                $match_info = $this->General_Model->getAllItemTable_Array('match_info', array('xs2event_id' => $listing['event_id']))->row();
                                if(!empty($match_info)){ 

                                    $ticket_type_xs2event              = $listing['type_ticket'];
                                    $flags                             = $listing['flags'];
                                    if(empty($flags)){
                                        $split_type_data               = "No Preferences";
                                    }
                                    else{
                                        $split_type_data               = $flags[0];
                                    }
                                    $ticketid               = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
                                    $ticket_group_id        = mt_rand(100000, 999999);
                                    $ticket_category        = $listing['category_name'];
                                    $category_id            = $listing['category_id'];
                                    $quantity               = $listing['stock'];
                                    $price_type             = $listing['currency_code'];
                                    $price                  = ($listing['face_value']/100);
                                    $description_supplier   = $listing['description_supplier'];
                                    $listing_notes = array();
                                    if($description_supplier != ""){
                                        $description_supplier = explode('- ',$description_supplier);

                                         foreach($description_supplier as $restrictions_benefits_option){
                                            if(trim($restrictions_benefits_option) != ""){
                                              $listing_notes[] = trim($restrictions_benefits_option);   
                                            }
                                           
                                        }

                                    } 

                                    $listing_notes_data = '';
                                    if(!empty($listing_notes)){ 
                                        $notes = $this->updateListingNotes($listing_notes);
                                        if(is_array(@$notes)){
                                            $listing_notes_data = implode(',',$notes);
                                        }
                                        else{
                                            $listing_notes_data = $notes;
                                        }
                                        
                                    }
                                    $ticket_category_id = $this->stadiumCategory_update_v1($stadium,$ticket_category,$category_id,$match_info->venue);
                                    if($ticket_category_id == ""){
                                    $ticket_category_id = $this->stadiumCategory_update($stadium,$ticket_category,$category_id,$match_info->venue);
                                    }
                                    /*echo 'ticket_type_data = '.$ticket_type_data;
                                    echo "<pre>";print_r($ticket_type);exit;*/
                                    if($split_type[$split_type_data] != "" && $ticket_type[$ticket_type_xs2event] != ""){

                                    $seller_tickets['xs2event_id']     = $listing['ticket_id'];
                                    $seller_tickets['ticket_type']     = $ticket_type[$ticket_type_xs2event];
                                    $seller_tickets['ticketid']        = $ticketid;
                                    $seller_tickets['ticket_group_id'] = $ticket_group_id;
                                    $seller_tickets['user_id']           = 260;
                                    $seller_tickets['match_id']          = $match_info->m_id;
                                    $seller_tickets['event_flag']        = 'E';
                                    $seller_tickets['ticket_category']   = $ticket_category_id;
                                    $seller_tickets['ticket_block']      = '';
                                    $seller_tickets['home_town']         = 0;
                                    $seller_tickets['row']               = '';
                                    $seller_tickets['quantity']          = $quantity;
                                    $seller_tickets['price_type']        = $price_type;
                                    $seller_tickets['price']             = $price;
                                    $seller_tickets['listing_note']      = $listing_notes_data;
                                    $seller_tickets['split']             = $split_type[$split_type_data];
                                    $seller_tickets['sell_date']         = date("Y-m-d h:i:s");
                                   // $seller_tickets['status']             = 1;
                                    $seller_tickets['add_by']             = 260;
                                    $seller_tickets['store_id']           = 1;
                                    $seller_tickets['source_type']        = 'xs2event';
                                    $seller_tickets['customer_details_required']        = $listing['options']['customer_details_required'];
                                    $seller_tickets['general_admission']  = $listing['category_type'];
                                    $seller_tickets['seat']               = '';
                                     $sell_ticket                                 = $this->sellerTickets_update($listing['ticket_id'],$seller_tickets);

                                     $ticket_count = $ticket_count + $quantity;
                                    }

                                 }
                                 }
            
            } 
            }
            catch(BP\InsureHubApiNotFoundException $validationException){
            $error = $validationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiValidationException $validationException){
            $error = $validationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiAuthorisationException $authorisationException){
            $error = $authorisationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubApiAuthenticationException $authenticationException){
            $error = $authenticationException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(BP\InsureHubException $insureHubException){
            $error =  $insureHubException->errorMessage();
            $this->custom_error_log($error);
            }
            catch(Exception $exception){
            $error = $exception->getMessage();
            $this->custom_error_log($error);
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
            
            if(!empty($_POST['add_event_id'])){

              $eventsids     =   $_POST['add_event_id'];
              $updated_count = 0;

              foreach ($eventsids as $eventsid) {
                  
                  $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('id' => $eventsid))->row();

                  $tournament_id     = $api_events_tickets->tournament;
                  $team_a            = $api_events_tickets->team_a;
                  $team_b            = $api_events_tickets->team_b;
                  $stadium_id        = $api_events_tickets->stadium;
                  $match_date        = $api_events_tickets->match_date;
                  $match_date_time   = $api_events_tickets->match_date_time;
                  $api_unique_id     = $api_events_tickets->api_unique_id;
                  $main_category     = $api_events_tickets->category;

                  $match_date_time   = date("Y-m-d H:i:s",strtotime($match_date_time));
                  $match_time        = date("H:i:s",strtotime($match_date_time));

                  $stadium_exists = $this->General_Model->getAllItemTable_Array('api_stadium', array('stadium_id' => $stadium_id,'category' => $main_category))->row();

                  $tournament_exists = $this->General_Model->getAllItemTable_Array('api_tournaments', array('tournament_id' => $tournament_id,'category' => $main_category))->row();

                  $team_exists_a = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_a,'category' => $main_category))->row();
                  $team_exists_b = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_b,'category' => $main_category))->row();

                  //echo "<pre>";print_r($tournament_exists);exit;

                  $this->get_team_row($team_a, $main_category);
                  $this->get_team_row($team_a, $main_category);
                  $this->get_stadium_row($stadium_exists->stadium_name,1);

                  if($stadium_exists->stadium_id != "" && $team_exists_a->team_id != "" && $team_exists_b->team_id != "" && $tournament_exists->tournament_id != ""){


                        $boxoffice_team_exists = $this->General_Model->get_team_exist($team_a,$main_category)->row();
                        $boxoffice_team_a = $boxoffice_team_exists->team_id;

                        $boxoffice_team_exists = $this->General_Model->get_team_exist($team_b,$main_category)->row();
                        $boxoffice_team_b = $boxoffice_team_exists->team_id;
                         $boxoffice_stadium_exists = $this->General_Model->getAllItemTable_Array('stadium', array('stadium_name' => $stadium_exists->stadium_name,'category' => $main_category))->row();
                         $boxoffice_stadium_id = $boxoffice_stadium_exists->s_id;

                         $boxoffice_tournament_exists = $this->General_Model->get_tournaments_exist($tournament_exists->tournament_name,$main_category)->row();
                         $boxoffice_tournament_id = $boxoffice_tournament_exists->tournament_id;
                        
                        
                        
                         if($boxoffice_tournament_id == ""){

                            $boxoffice_tournament_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $tournament_exists->tournament_id,'source_type' => 'xs2event','content_type' => 'tournament'))->row();
                         $boxoffice_tournament_id = $boxoffice_tournament_exists->content_id;

                         } 
                         
                         
                         if($boxoffice_team_a == ""){

                            $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_exists_a->team_id,'source_type' => 'xs2event','content_type' => 'team'))->row();
                            $boxoffice_team_a = $boxoffice_team_exists->content_id;

                         } 
                          
                         if($boxoffice_team_b == ""){

                            $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_exists_b->team_id,'source_type' => 'xs2event','content_type' => 'team'))->row();
                            $boxoffice_team_b = $boxoffice_team_exists->content_id;

                         } 
                         
                         
                         if($boxoffice_stadium_id == ""){

                            $boxoffice_stadium_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $stadium_exists->stadium_id,'source_type' => 'xs2event','content_type' => 'stadium'))->row();
                            $boxoffice_stadium_id = $boxoffice_stadium_exists->content_id;

                         }

                     
                          $match_exists = $this->General_Model->check_match_exists($boxoffice_tournament_id,$boxoffice_team_a,$boxoffice_team_b,$boxoffice_stadium_id)->row();


                         if($boxoffice_tournament_id != "" && $boxoffice_team_a != "" && $boxoffice_team_b != "" && $boxoffice_stadium_id != ""){ 
    
                            if(empty($match_exists)){

                            $stadium_details = $this->General_Model->getAllItemTable_Array('stadium', array('s_id' => $boxoffice_stadium_id))->row();

                             $boxoffice_tournament = $this->General_Model->getAllItemTable_Array('tournament_lang', array('tournament_id' => $boxoffice_tournament_id,'language' => 'en'))->row();
                            $boxoffice_tournament_name = $boxoffice_tournament->tournament_name;

                            $boxoffice_team = $this->General_Model->getAllItemTable_Array('teams_lang', array('team_id' => $boxoffice_team_a,'language' => 'en'))->row();
                            $boxoffice_team_a_name = $boxoffice_team->team_name;

                            $boxoffice_team = $this->General_Model->getAllItemTable_Array('teams_lang', array('team_id' => $boxoffice_team_b,'language' => 'en'))->row();
                            $boxoffice_team_b_name = $boxoffice_team->team_name;

                            $boxoffice_tournament_name = str_replace(' ','-', $boxoffice_tournament_name);
                            $boxoffice_team_a_name = str_replace(' ','-', $boxoffice_team_a_name);
                            $boxoffice_team_b_name = str_replace(' ','-', $boxoffice_team_b_name);
                            if($main_category == 3){
                                $team_slug =  strtolower($boxoffice_tournament_name).'-'.strtolower($boxoffice_team_a_name.'-vs-'.$boxoffice_team_b_name.'-tickets');
                            }
                            else{
                                $team_slug =  strtolower($boxoffice_team_a_name.'-vs-'.$boxoffice_team_b_name.'-tickets');
                            }
                            
                            $match_name_full = $boxoffice_team_a_name.' vs '.$boxoffice_team_b_name;
                            //echo 'team_slug='.$team_slug;exit;
                            $other_event_category = "";
                            if($api_events_tickets->tixstock_parent_category == "Rugby World Cup"){
                                $other_event_category = 18;
                            }
                         
                           
                            $eventtype = ($main_category == 1) ? "match" : "other";
                            $match_data = array();
                            $match_data['category']                 = $main_category;
                            $match_data['match_name']               = $match_name_full;
                            $match_data['team_1']                   = $boxoffice_team_a;
                            $match_data['team_2']                   = $boxoffice_team_b;
                            $match_data['hometown']                 = $boxoffice_team_a;
                            $match_data['tournament']               = $boxoffice_tournament_id;
                            $match_data['slug']                     = $team_slug;
                            $match_data['status']                   = 1;
                            $match_data['availability']             = 1;
                            $match_data['matchticket']              = 500;
                            $match_data['match_date']               = $match_date_time;
                            $match_data['match_time']               = $match_time;
                            $match_data['venue']                    = $boxoffice_stadium_id;
                            $match_data['city']                     = @$stadium_details->city;
                            $match_data['state']                    = @$stadium_details->city;
                            $match_data['country']                  = @$stadium_details->country;
                            $match_data['create_date']              = @strtotime(date("Y-m-d H:i:s"));
                            $match_data['event_type']               = $eventtype;
                            $match_data['daysremaining']            = 1;
                            $match_data['tixstock_status']          = 1;
                            $match_data['oneclicket_status']        = 1;
                            $match_data['xs2event_status']          = 1;
                            $match_data['other_event_category']     = $other_event_category;
                            $match_data['price_type']               = "EUR";
                            $match_data['store_id']                 = $this->session->userdata('storefront')->admin_id;
                            $match_data['tixstock_id']              = "";
                            $match_data['oneclicket_id']            = "";
                            $match_data['xs2event_id']              = $api_unique_id;
                            $match_data['tixstock_update_date']     =  date('Y-m-d', strtotime('-1 day', strtotime(date("Y-m-d H:i:s"))));
                            $match_data['source_type']              = "xs2event";
                            $match_data['oneboxoffice_status']      = 1;
                            $match_data['add_by']                   = 1;
                            $match_id = $this->General_Model->insert_data('match_info', $match_data);
                            
                        if($match_id != ""){
                             $this->update_match_settings($match_id,$boxoffice_tournament_id);
                             $updated_count = $updated_count + 1;
                        $lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();

                        foreach ($lang as $key => $l_code) {
                            $insertData_lang = array();
                            $insertData_lang['match_id'] = $match_id;
                            $insertData_lang['language'] = $l_code->language_code;
                            $insertData_lang['match_name'] = trim($match_name_full);
                            $insertData_lang['match_label'] = '';
                            $insertData_lang['store_id'] =   $this->session->userdata('storefront')->admin_id;
                          


                            $team1 = $this->General_Model->getid('teams', array('teams.id' => $boxoffice_team_a, 'teams_lang.language' => $l_code->language_code))->row();

                            $team2 = $this->General_Model->getid('teams', array('teams.id' => $boxoffice_team_b, 'teams_lang.language' => $l_code->language_code))->row();

                            $tournament = $this->General_Model->getid('tournament', array('tournament.t_id' => $boxoffice_tournament_id, 'tournament_lang.language' => $l_code->language_code))->row();

                            $stadium = $this->General_Model->getid('stadium', array('stadium.s_id' => $boxoffice_stadium_id))->row();

                            if ($l_code->language_code == "en") {
                                $insertData_lang['meta_title'] = $team1->team_name . " vs " . $team2->team_name . " Tickets | " . date('d/m/Y', strtotime($match_date_time)) . " | 1BoxOffice.com";

                                $description = 'Buy ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets for the ' . $tournament->tournament_name . ' game being played on ' . date('d/m/Y', strtotime($match_date_time)) . ' at ' . $stadium->stadium_name . '. 1BoxOffice offers a wide range of ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy ' . $team1->team_name . ' tickets!';

                            } else {
                                $insertData_lang['meta_title'] = "تذاكر   " . $team1->team_name . " - " . $team2->team_name . " | " . date('d/m/Y', strtotime($match_date_time)) . " | ";


                                $description = ' اشتر تذاكر مباراة   ' . $team1->team_name . ' - ' . $team2->team_name . '  لمباراة   ' . $tournament->tournament_name . '  التي ستُلعب في   ' . date('d/m/Y', strtotime($match_date_time)) . ' على    ' . $stadium->stadium_name_ar . '. نقدم مجموعة واسعة من تذاكر   ' . $team1->team_name . ' - ' . $team2->team_name . ' بأسعار مدروسة مناسبة  لعشاق كرة القدم. قم بزيارة موقعنا  www.1boxoffice.com لمزيد من المعلومات حول كيفية شراء تذاكر   ' . $team1->team_name . '!';
                            }

                            $insertData_lang['description'] = $description;
                            $insertData_lang['meta_description'] = $description;

                            $this->General_Model->insert_data('match_info_lang', $insertData_lang);
                        }
                    }
                        }
                            

                         }
                         else{ 
                            $array_msg[] = 'Please Merge Tournament,Teams,Stadium for '.$api_events_tickets->event_name;
                         }
                         
                        

                            } 

                  
              }
              $first_array_msg = "Total ".$updated_count." events saved to 1boxoffice.";
              
              if(!empty($array_msg)){
                array_unshift( $array_msg, $first_array_msg );
              }
              else{
                $array_msg[0] = $first_array_msg;
              }
              //
                
                $msg = implode("<br>", $array_msg);
                $response['msg'] = $msg;
                $response['status'] = 1;
                echo json_encode($response);exit;
            }
            else{
                $msg = "Invalid information selected.";
                $response['status'] = 0;
                echo json_encode($response);exit;
            }
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

            $create_date                    = time();
            $insertData['ticket_name']      = $data;
            $insertData['source_type']      = 'xs2event';
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
        $new_ids[] = $ticket_details_id;
        }

         return $new_ids;    
    }
    }


    public function sellerTickets_update($listing_id,$seller_tickets){
    /*echo 'listing_id = '.$listing_id;
    echo "<pre>";print_r($seller_tickets);exit;*/
    if($listing_id != "" && !empty($seller_tickets)){

        $ticket  = $this->Tixstock_Model->check_sellerTickets_xs2event($listing_id)->row();
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

    public function update_match_settings($match_id,$tournament){

        if($match_id != "" && $tournament != ""){

        $afiliates = $this->General_Model->get_admin_details_by_role_v1(3, 'status');
        $partners = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
        $storefronts = $this->General_Model->get_admin_details_by_site_setting();
        
        $afiliate_ids = array();
        foreach ($afiliates as $key => $afiliate) {
            $afiliate_ids[] = $afiliate->admin_id;
        }

        $storefronts_ids = array();
        foreach ($storefronts as $key => $storefront) {
            $storefronts_ids[] = $storefront->store_id;
        }

        $partner_ids = array();
        foreach ($partners as $key => $partner) {
            $partner_ids[] = $partner->admin_id;
        }

        $match_settings_data = array();
        $match_settings_data['matches'] = $match_id;
        $match_settings_data['storefronts'] = $storefronts_ids ? implode(",", $storefronts_ids)  : ""  ;
        $match_settings_data['partners'] =  $partner_ids ? implode(",", $partner_ids)  : "";
        $match_settings_data['afiliates'] = $afiliate_ids ? implode(",", $afiliate_ids)  : "" ;
        $match_settings_data['status'] = "1";
        $this->db->insert('match_settings', $match_settings_data);
    
        foreach ($partners as $key => $value) {
            // API PARTNER
            $api_partner_events_insertData = array(
                'API_id' => date('dyhis'),
                'partner_id' => $value->admin_id,
                'from_date' => date("Y-m-d"),
                'to_date' => date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d")))),
                'tournament_id' => $tournament ,
                'event_id' => $match_id,
                'category_id' => 1,
                'tickets_per_events' => 1000,
                'fullfillment_type' => 1,
                'api_status' => 1
            );
            $this->db->insert('api_partner_events', $api_partner_events_insertData);
        }
        }

    }
   
    function process_curl_request($service,$method,$service_url,$post_data=""){
          
            $authorization = "x-api-key: ".XS2EVENT_APIKEY; 
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
            if (!file_exists("xs2event_logs/".$service)) { 
            mkdir("xs2event_logs/".$service, 0777, true);
            } 
            $time = strtotime(date("Ymdhis"));
            $fp = fopen("xs2event_logs/".$service."/".$time.'_request.json', 'a+');
            fwrite($fp, $post_data);
            fclose($fp);
            $fp = fopen("xs2event_logs/".$service."/".$time.'_response.json', 'a+');
            fwrite($fp, $response);
            fclose($fp);
            $formatted_response = json_decode($response,1);
            return $formatted_response;

    }

    public function custom_error_log($error){
            $response['status'] = 0;
            $response['msg'] = $error;
            echo json_encode($response);exit;
    } 

private function get_team_row($team_name, $main_category)
{
     $team_row= $this->General_Model->get_team_exist($team_name, $main_category)->row();
    if (!$team_row) {
        $insertData['team_name'] = $team_name;
        $insertData['category'] = $main_category;
        $insertData['create_date'] = strtotime(date('Y-m-d H:i:s'));
        $insertData['status'] = 1;     
        $insertData['url_key'] = str_replace(" ", "-", trim($team_name));
        $insertData['team_url'] = str_replace(" ", "-", trim($team_name));
        $insertData['source_type'] = "Xs2event";
        $insertData['store_id'] = $this->session->userdata('storefront')->admin_id;
        $team_id = $this->General_Model->insert_data('teams', $insertData);

        $lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();

        foreach ($lang as $key => $l_code) {
            $insertData_lang = array();
            $insertData_lang['team_id'] = $team_id;
            $insertData_lang['language'] = $l_code->language_code;
            $insertData_lang['team_name'] = $team_name;
            $this->General_Model->insert_data('teams_lang', $insertData_lang);
        }
    }

}

private function get_stadium_row($stadium_name,$stadium_type)
{    
     $check_stadium =  $this->Tixstock_Model->get_venues($stadium_name)->row();
    
    if (!$check_stadium) {
        $insertData['stadium_name'] = $stadium_name;
        $insertData['stadium_type'] = $stadium_type;
        $insertData['create_date'] = date('Y-m-d H:i:s');
        $insertData['status'] = 1;     
        $insertData['source_type'] = "xs2event";
        $insertData['store_id'] = $this->session->userdata('storefront')->admin_id;
        $this->General_Model->insert_data('stadium', $insertData);    
       
    }

}

//

   

    
}
?>
