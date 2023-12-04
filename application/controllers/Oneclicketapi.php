<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Oneclicketapi extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Oneclicket_Model');
        $this->load->model('Tssa_Model');
        $this->load->model('General_Model');
        $this->load->model('Tixstock_Model');
        $this->language_array = array('en','ar');
        $this->ticket_type = array('eTicket' => 2,'Paper' => 3,'mobile' => 4,'Members / Season Card' => 1);
        $this->split_type = array('Avoid Leaving One Ticket' => 4,'No Preferences' => 5,'All Together' => 2,'Pairs' => 3);

        }
    
    public function get_rgb($color){

    $split = str_split($color, 2);
    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);
    return "rgb(" . $r . ", " . $g . ", " . $b . ")";

    }

public function updateCategories()
    {
           $request_data = array(
            "limit" => 100,
            "page" => 1
            );
            
          $getCategories = $this->process_curl_request("getCategories",$request_data);
          $filename = "uploads/category/category_oneclicket.json";
          file_put_contents($filename, json_encode($getCategories)); 
          echo "Category Updated";exit;

    }

    public function updateStadiums($stadium_id)
    {
           $request_data = array(
            "filters" => array("stadium" => array('id' => $stadium_id)),  
            "limit" => 10,
            "page" => 1
            );
            
            $stadium_init_response = $this->process_curl_request("getStadiums",$request_data);
           // echo "<pre>";print_r($stadium_init_response);exit;
            if($stadium_init_response['meta']['status'] == "success"){

                $total_pages  = $stadium_init_response['pagination']['total_pages'];
                $current_page = $stadium_init_response['pagination']['current_page'];
                for($current_page = 1;$current_page <=$total_pages;$current_page++){

                    $request_data = array(
                    "filters" => array("stadium" => array('id' => $stadium_id)),
                    //"filters" => array("category" => array('parent_id' => 794,'published' => 1)),
                    "limit" => 10,
                    "page" => $current_page
                    );
                    $stadium_response = $this->process_curl_request("getStadiums",$request_data);
                    if($stadium_response['meta']['status'] == "success"){

                    $stadium_data  = $stadium_response['data'];
                    if(!empty($stadium_data)){
                      
                        foreach($stadium_data as $stadium){
                            $stadium_name = $stadium['name'];

                            if($stadium_name != ""){
                            $stadium_name       = explode('-',$stadium_name);
                            $stadium_name       = explode('(',$stadium_name[0]);
                            $stadium_name       = $stadium_name[0];
                            } 
                            $stadium_name = trim($stadium_name);
                            $stadiums_data = array();

                            $stadium_info = $this->General_Model->getAllItemTable_Array('stadium', array('stadium_name' => $stadium_name,'status' => '1'),'','s_id','DESC')->row();
                            if($stadium_info->s_id == ""){
                            $stadiums_data['stadium_name']    = $stadium_name;
                            $stadiums_data['stadium_name_ar'] = $stadium_name;
                            $stadiums_data['oneclicket_id']   = $stadium['id'];
                            $stadiums_data['stadium_image']   = $stadium['image_src'];
                            $stadiums_data['status']          = 0;
                            $stadiums_data['attendee_status'] = 1;
                            $stadiums_data['source_type']     = 'oneclicket';
                            
                            //$versions                   = $stadium['versions'];

                            $stadium_id = $this->Oneclicket_Model->insert_data('stadium',$stadiums_data);
                             //$this->update_stadium_versions($stadium_id,$versions);
                            
                            }
                            else{ //echo "<pre>";print_r($stadium_info);exit;
                             $table = "stadium";
                             $wheres= array("s_id" => $stadium_info->s_id);
                            if($stadium_info->source_type == "oneclicket"){
                                $stadiums_data['stadium_image']   = $stadium['image_src'];
                            }   
                            $stadiums_data['status']          = 1;
                            $stadiums_data['attendee_status'] = 1;
                            $stadiums_data['oneclicket_id'] = $stadium['id'];
                             $this->Oneclicket_Model->update_table($table, $wheres, $stadiums_data);
                            // $versions                   = $stadium['versions'];
                            // $this->update_stadium_versions($stadium['id'],$versions);

                            }

                            //$tournament_id = $this->update_stadiums($tournament);
                        }
                    }


                    }

            }
            return true;
            /*$rsp['status'] = 1; 
            $rsp['msg'] = 'Stadium and Category Updated Successfully.';
            echo json_encode($rsp);exit;*/
        }
           

    }

    public function disable_oneclicket_events($category_id="")
    { 
         $matches_info       = $this->General_Model->getAllItemTable_Array('match_info', array('oneclicket_id != ' => ""))->result();
        foreach($matches_info as $match_info){
            $match_date         = $match_info->match_date;
            $today_date         = date("Y-m-d H:i:s");
            $hourdiff           = round((strtotime($match_date) - strtotime($today_date))/3600, 1);
            if($hourdiff <= 40){
                $table = "match_info";
                $stadiums_data= array("oneclicket_status" => '0');
                $wheres = array("m_id" => $match_info->m_id);
                $this->Oneclicket_Model->update_table($table, $wheres, $stadiums_data);
                 $tickets_info       = $this->General_Model->getAllItemTable_Array('sell_tickets', array('match_id' => $match_info->m_id,'source_type' => 'oneclicket'))->result();
                  foreach($tickets_info as $ticket_info){
                    
                    $table = "sell_tickets";
                $stadiums_data= array("status" => 2);
                $wheres = array("s_no" => $ticket_info->s_no);
                $this->Oneclicket_Model->update_table($table, $wheres, $stadiums_data);

                  }

            }
        }
        return true;
    }

    public function update_oneclicket_stadiums($stadium_data = array(),$main_category){

                            $stadium_name = $stadium_data['stadium_name'];

                            if($stadium_name != ""){
                            $stadium_name       = explode('-',$stadium_name);
                            $stadium_name       = explode('(',$stadium_name[0]);
                            $stadium_name       = $stadium_name[0];
                            } 
                            $stadium_name = trim($stadium_name);
                            $stadiums_data = array();

                            $stadium_info = $this->General_Model->getAllItemTable_Array('api_stadium', array('stadium_name' => $stadium_name,'source_type' => 'oneclicket','category' => $main_category),'','stadium_id','DESC')->row();
                            if($stadium_info->stadium_id == ""){
                            $stadiums_data['category']        = $main_category;
                            $stadiums_data['stadium_name']    = $stadium_name;
                            $stadiums_data['api_unique_id']   = trim($stadium_data['stadium_id']);
                            $stadiums_data['merge_status']          = 0;
                            $stadiums_data['source_type']     = 'oneclicket';

                            $stadium_id = $this->Oneclicket_Model->insert_data('api_stadium',$stadiums_data);

                            
            
                            
                            }

                            $stadium_category_exists = $this->General_Model->getAllItemTable_Array('api_stadium', array('api_unique_id' => trim($stadium_data['stadium_id']),'category' => $main_category))->row();
                            $stadium_id = $stadium_category_exists->stadium_id;
                            if($stadium_category_exists->stadium_id != ""){

                                $stadium_request_data = array(
                                "filters" => array("stadium" => array('id' => $stadium_category_exists->api_unique_id)),  
                                "limit" => 100,
                                "page" => 1
                                );

                                $stadium_init_response = $this->process_curl_request("getStadiums",$stadium_request_data);
                                // echo "<pre>";print_r($stadium_init_response);exit;
                                if($stadium_init_response['meta']['status'] == "success"){

                                      $stadium_datas  = $stadium_init_response['data'];
                                        if(!empty($stadium_datas)){
                                            $stadium_cat_data = array();
                                            foreach($stadium_datas as $stadium){
                                                $versions = $stadium['versions'];
                                                foreach($versions as $version){
                                            $api_stadiums_category = $this->General_Model->getAllItemTable_Array('oneclicket_stadium_category', array('stadium_id' => $stadium_category_exists->stadium_id,'category' => $version['name']))->row();

                                                    if($version != "" && $api_stadiums_category->id == ""){

                                                $stadium_cat_data['stadium_id']                = $stadium_category_exists->stadium_id;
                                                $stadium_cat_data['category']                   = $version['name'];
                                                $stadium_cat_data['merge_status']               = 0;
                                               
                                                $this->Oneclicket_Model->insert_data('oneclicket_stadium_category',$stadium_cat_data);

                                                    }
                                                }
                                            }
                                        }
                                }
                            }

                            return $stadium_id;
                        
}

public function update_oneclicket_tournaments($category_data = array(),$main_category){

                            $tournament_name = $category_data['category_name'];
                            $tournament_name = trim($tournament_name);
                            $categorys_data = array();

                            $category_info = $this->General_Model->getAllItemTable_Array('api_tournaments', array('tournament_name' => $tournament_name,'source_type' => 'oneclicket','category' => $main_category),'','tournament_id','DESC')->row();
                            if($category_info->tournament_id == ""){
                             $categorys_data['category']                = $main_category;
                            $categorys_data['tournament_name']          = $tournament_name;
                            $categorys_data['api_unique_id']            = $category_data['category_id'];
                            $categorys_data['merge_status']             = 0;
                            $categorys_data['source_type']              = 'oneclicket';

                            $tournament_id = $this->Oneclicket_Model->insert_data('api_tournaments',$categorys_data);
                            
                            $category_info = $this->General_Model->getAllItemTable_Array('api_tournaments', array('api_unique_id' => $category_data['category_id'],'source_type' => 'oneclicket','category' => $main_category),'','tournament_id','DESC')->row();

                            }

                            return $category_info->tournament_id;
                        
}

public function update_oneclicket_teams($team_data = array(),$main_category){

                            $team_name = $team_data['team_name'];
                            $team_name = trim($team_name);
                            $teams_data = array();

                            $team_info = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_name,'source_type' => 'oneclicket','category' => $main_category),'','team_id','DESC')->row();
                            if($team_info->team_id == ""){
                            $teams_data['category']                 = $main_category;
                            $teams_data['team_name']                = $team_name;
                            $teams_data['api_unique_id']            = $team_data['team_id'];
                            $teams_data['merge_status']             = 0;
                            $teams_data['source_type']              = 'oneclicket';

                            $team_id = $this->Oneclicket_Model->insert_data('api_teams',$teams_data);
                            
                            }

                            return true;
                        
}

public function updateFeedsEvents($category_id="")
    { 
        if($_POST['category_name'] != ""){

        $current_page = $_POST['oneclicket_page'];

         $tixstock_parent_category = $_POST['parent_category'];
        
        $oneclicket_parent_category               = $_POST['oneclicket_parent_category'];
        $tournaments                              = $_POST['oneclicket_tournaments'];

        $tournament_category_data = array($_POST['category_name']);
        foreach($tournament_category_data as $category_id){ 
            $language_array = $this->language_array;
            $this->disable_oneclicket_events();
            if($category_id != ""){

               

                    $request_data = array(
                    "iso" => "en",
                    "filters" => array("category" => array('id' => $category_id)),
                    "sort" => array(
                    "field" => "id",
                    "type" => "desc"
                    ),
                    "limit" => 10,
                    "page" => $current_page
                    );
                    $product_response = $this->process_curl_request("getProducts",$request_data);
                    if($product_response['meta']['status'] == "success"){
                        
                    $product_data  = $product_response['data'];
                    $pagination    = $product_response['pagination'];
                    $next_page     = 1;
                    if($current_page < $pagination['total_pages']){
                        $next_page = $current_page + 1;
                    }
                    if(!empty($product_data)){
                        $productdata = array();
                                
                        foreach($product_data as $key => $product){

                           // if($product['id'] == "35369"){


                            $category_id        = $product['category_id'];
                            $category_name      = trim($product['category_name']);

                             $tournament_category  = $this->General_Model->tournaments_1bx($category_name);
                            
                            if($tournament_category[0]->category == "" && $category_name == "Rugby World Cup 2023"){
                               if($category_name == "Rugby World Cup 2023"){
                                     $main_category = 3;
                                     $parent_tournament_name = 'Rugby World Cup';
                                }
                            }
                             else if($tournament_category[0]->category == "" && $category_name != "Rugby World Cup 2023"){
                                 $main_category = 1;
                                 $parent_tournament_name = $tournament_category[0]->tournament_name;
                             }
                            else{
                                $main_category = $tournament_category[0]->category;
                                $parent_tournament_name = $tournament_category[0]->tournament_name;
                            }

                            $match_date         = $product['date'];
                            $today_date         = date("Y-m-d H:i:s");
                            $hourdiff = round((strtotime($match_date) - strtotime($today_date))/3600, 1);
                            $eventVersions =   $product['versions']; 
                             if($hourdiff >= 40 && !empty($eventVersions)){
                            
                            $listings     = $product['versions'];
                            $total_tickets = array();
                            foreach($listings as $listing){
                                $total_tickets[] = $listing['stock'];
                            }
                            $no_of_tickets = array_sum($total_tickets);

                            $oncecliket_teams   = $product['teams'];
                            $stadium_ids         = $product['stadium_id'];
                            $stadium_name       = trim($product['stadium_name']);
                            $stadium_data       = array('stadium_id' => $stadium_ids,'stadium_name' => $stadium_name);
                            $stadium_id = $this->update_oneclicket_stadiums($stadium_data,$main_category);
                          // echo "AAAA";exit;
                            
                           
                             //FETCH OR CREATE TOURNAMENT CATEGORY
                            if($category_id != "" && $category_name != ""){

                                $category_data = array('category_id' => $category_id,'category_name' => $category_name);
                                 $tournament_id = $this->update_oneclicket_tournaments($category_data,$main_category);
                            }

                            $oncecliket_teams = array_unique($oncecliket_teams, SORT_REGULAR);
                            
                            $team_1id = "";
                            $team_2id = "";
                            $version_name      = $product['versions'][0]['version_name'];
                            $match_name_str    = explode(".' -",$version_name);
                            if(count($match_name_str) == 1){

                            $match_name_str    = explode("' -",$version_name);
                            }
                            
                            $match_name_str    = str_replace("'","",$match_name_str[0]);
                            $match_name_data   = explode(' - ',$match_name_str);
                          // echo "<pre>";print_r($match_name_data);exit;
                            if(!empty($match_name_data[0])){
                                $formated_team = array();
                                foreach($oncecliket_teams as $oncecliket_team){
                                    $formated_team[$oncecliket_team['team_name']] = $oncecliket_team['team_id'];
                                    
                                } 
                                 
                            if(count($match_name_data) == 2){
                                
                                foreach($match_name_data as $team_name){
                                    $team_name = trim($team_name);
                                    $team_info = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_name,'source_type' => 'oneclicket','category' => $main_category))->row();

                                    if(@$team_info->team_id != ""){
                                        if($team_1id == ""){
                                            $team_1id   = $team_info->team_id;
                                            $team_1name = $team_info->team_name;
                                        }
                                        else{
                                            $team_2id   = $team_info->team_id;
                                            $team_2name = $team_info->team_name;
                                        }
                                    

                                    }
                                    else{
                                        $oncecliket_team = array('team_name' => $team_name,'api_unique_id' => $formated_team[$team_name]);
                                        $this->update_oneclicket_teams($oncecliket_team,$main_category);
                                        $team_info = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_name,'source_type' => 'oneclicket','category' => $main_category))->row();

                                    if(@$team_info->team_id != ""){
                                        if($team_1id == ""){
                                            $team_1id   = $team_info->team_id;
                                            $team_1name = $team_info->team_name;
                                        }
                                        else{
                                            $team_2id   = $team_info->team_id;
                                            $team_2name = $team_info->team_name;
                                        }
                                    

                                    }     
                                    }
                                }
                            }
                            else{

                                 foreach($formated_team as $team_name => $team_id){
                                     
                                    $team_name = trim($team_name);
                                    $team_info = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_name,'source_type' => 'oneclicket','category' => $main_category))->row();

                                    if(@$team_info->team_id != ""){
                                        if($team_1id == ""){
                                            $team_1id   = $team_info->team_id;
                                            $team_1name = $team_info->team_name;
                                        }
                                        else{
                                            $team_2id   = $team_info->team_id;
                                            $team_2name = $team_info->team_name;
                                        }
                                    

                                    }
                                    else{
                                        $oncecliket_team = array('team_name' => $team_name,'api_unique_id' => $formated_team[$team_name]);
                                        $this->update_oneclicket_teams($oncecliket_team,$main_category);
                                        $team_info = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_name,'source_type' => 'oneclicket','category' => $main_category))->row();

                                    if(@$team_info->team_id != ""){
                                        if($team_1id == ""){
                                            $team_1id   = $team_info->team_id;
                                            $team_1name = $team_info->team_name;
                                        }
                                        else{
                                            $team_2id   = $team_info->team_id;
                                            $team_2name = $team_info->team_name;
                                        }
                                    

                                    }     
                                    }
                                }

                               
                            }
                            //echo "<pre>";print_r($match_name_data);
                            //echo "<pre>";print_r($team_2id);
                            //exit;
                           /* if($team_1_id == 78){
                            echo 'boxoffice_match_id'.$boxoffice_match_id;exit;
                        }*/
                     // echo $stadium_id.'='.$team_1id.'='.$team_2id.'='.$tournament_id;exit;
 
                    
                        if($stadium_id != "" && $team_1id != "" && $team_2id != "" && $tournament_id != ""){
                            $tournament_name = $category_name;
                           // $stadium_name = $data['venue']['name'];
                            $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_id' => $team_1id,'source_type' => 'oneclicket','category' => $main_category))->row();
                            $team_1_name = $teams_exists->team_name;
                            $teams_exists = $this->General_Model->getAllItemTable_Array('api_teams', array('team_id' => $team_2id,'source_type' => 'oneclicket','category' => $main_category))->row();
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

                                $boxoffice_tournament_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $tournament_id,'source_type' => 'oneclicket','content_type' => 'tournament'))->row();
                             $boxoffice_tournament_id = $boxoffice_tournament_exists->content_id;
                             if($boxoffice_tournament_id != ""){
                                $merge_found = 1;
                             }

                             } 
                             
                             if($boxoffice_team_a == ""){

                                $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_1id,'source_type' => 'oneclicket','content_type' => 'team'))->row();
                                $boxoffice_team_a = $boxoffice_team_exists->content_id;
                                if($boxoffice_team_a != ""){
                                $merge_found = 1;
                                }

                             } 
                             if($boxoffice_team_b == ""){

                                $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_2id,'source_type' => 'oneclicket','content_type' => 'team'))->row();
                                $boxoffice_team_b = $boxoffice_team_exists->content_id;
                                if($boxoffice_team_b != ""){
                                $merge_found = 1;
                                }

                             }
                             
                             if($boxoffice_stadium_id == ""){

                                $boxoffice_stadium_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $stadium_id,'source_type' => 'oneclicket','content_type' => 'stadium'))->row();
                                $boxoffice_stadium_id = $boxoffice_stadium_exists->content_id;
                                if($boxoffice_stadium_id != ""){
                                $merge_found = 1;
                                }

                             }

                        
                        //echo $boxoffice_tournament_id.'-'.$boxoffice_team_a.'-'.$boxoffice_team_b.'-'.$boxoffice_stadium_id;exit;
                        $event_type = "other";
                        if($main_category == 1){
                            $event_type = "match";
                        }
                        $datetime_data['datetime'] = $product['date'];
                        $boxoffice_match_id        = $this->updateApiEvents($datetime_data,$boxoffice_tournament_id,$boxoffice_team_a,$boxoffice_team_b,$boxoffice_stadium_id,$event_type);
                        if($boxoffice_match_id == ""){
                            $boxoffice_match_id        = $this->updateApiEvents($datetime_data,$boxoffice_tournament_id,$boxoffice_team_b,$boxoffice_team_a,$boxoffice_stadium_id,$event_type,1);
                            if($boxoffice_match_id != ""){
                                $t1 = $team_1_name;
                                $t2 = $team_2_name;
                                $team_1_name = $t2;
                                $team_2_name = $t1;
                            }
                        }

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
                        
                        $match_name           = $product['name'];
                        $match_date_string    = explode(' ',$product['date']); 
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
                                'source_type' => 'oneclicket',
                                'api_unique_id' => $product['id'],
                                'tixstock_parent_category' => $parent_tournament_name,
                                //'tixstock_parent_category' => $oneclicket_parent_category,
                                'tixstock_category' => $tournaments,
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
                                'source_type' => 'oneclicket',
                                'api_unique_id' => $product['id'],
                                'tixstock_parent_category' => $parent_tournament_name,
                               // 'tixstock_parent_category' => $oneclicket_parent_category,
                                'tixstock_category' => $tournaments,
                                'tixstock_tournament' => '',
                                'tixstock_tournaments' => '',
                                'match_found' => 1,
                            );
                        }

                        $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('api_unique_id' => $product['id']))->row();
                       // echo "<pre>";print_r($product);exit;
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
                            $this->Oneclicket_Model->update_table($table, $wheres, $uvalue);
                            if($boxoffice_match_id != ""){
                                 $table1                     = "match_info";
                            $wheres1                    = array('m_id' => $boxoffice_match_id);
                            $uvalue1                    = array('oneclicket_id' => $product['id']);//print_r($uvalue1);exit;
                            $this->Oneclicket_Model->update_table($table1, $wheres1, $uvalue1);
                           // echo "sss";exit;
                            }
                           

                        }
                        else{

                            

                            $event_id = $this->Oneclicket_Model->insert_data('api_events',$event_data);
                            if($boxoffice_match_id != ""){
                                 $table1                     = "match_info";
                            $wheres1                    = array('m_id' => $boxoffice_match_id);
                            $uvalue1                    = array('oneclicket_id' => $product['id']);//print_r($uvalue1);exit;
                            $this->Oneclicket_Model->update_table($table1, $wheres1, $uvalue1);
                           // echo "sss";exit;
                            }
                        }
                        
                        
                        if($event_id != ""){
                            $match   =  $this->Oneclicket_Model->get_event_pulling_api($event_id);
                            
                            $match_data[] =  $match;
                       }

                       }

                           
                        
                    }
                }
            //}
                    }

                    if(!empty($match_data)){
                           $this->mydatas['match_data'] = $match_data;

                           $list_matches = $this->load->view(THEME.'game/get_tixstock_matches_v1', $this->mydatas, TRUE); 
                        } 
                        $response['status'] = 1;
                        $response['flag'] = "event";
                        $response['next'] = $next_page;
                        $response['matches'] = $list_matches;
                        echo json_encode($response);exit;
                    }
                    else{
                        $response = array('status' => 0,'flag' => 'team','msg' => 'Empty Team,Tournament,Stadium data.','next' => $current_page);
                    echo json_encode($response);exit;
                    }

            
        }
         else{
                        $list_matches = $this->load->view(THEME.'game/get_tixstock_matches_v1', $this->mydatas, TRUE); 
                        $response['status'] = 1;
                        $response['flag'] = "event";
                        $response['next'] = $current_page;
                        $response['matches'] = $list_matches;
                         echo json_encode($response);exit;
            }

        }
    }
}
}

        public function migrateevents()
    { 

       

         $action = $_POST['action'];

         if($action == "pull"){

        if($_POST['api_id'] == "oneclicket"){
            $event_ids = $_POST['event_id'];


            $ticket_count = 0;
            foreach($event_ids as $event_id){

                 $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('id' => $event_id))->row();
                
                 $stadium = $api_events_tickets->stadium;
            if($api_events_tickets->api_unique_id != ""){
            $oneclicketid = $api_events_tickets->api_unique_id;
            $per_page = 50;
            $page = 1;
           // $tixstock_id = "01h2z77qpk6wtqqgfjf2ytbq2m";
            $request_data = array(
            "iso" => "en",
           // "filters" => array("product" => array('id' => 29701)),
            "filters" => array("product" => array('id' => $oneclicketid)),
            "sort" => array(
            "field" => "id",
            "type" => "desc"
            ),
            "limit" => 20,
            "page" => 1
            );

            $feed_response = $this->process_curl_request("getProducts",$request_data);
          //echo "<pre>";print_r($feed_response);exit;
            if(!empty($feed_response['data'])){ 
                        $seller_tickets = [];  
                        foreach ($feed_response['data'] as $datakey => $listings) {

                              foreach ($listings['versions'] as $listkey => $listing) {
                                
                                $match_info = $this->General_Model->getAllItemTable_Array('match_info', array('oneclicket_id' => $listings['id']))->row();//echo "<pre>";print_r($match_info);exit;
                                    if(!empty($match_info) && !empty($listing)){


                                    $stadium_category = $listing['version_name'];
                                    $stadium_category = explode(".' -",$stadium_category);
                                    $stadium_category = $stadium_category[1];
                                    $stadium_category = trim($stadium_category);
                                    if($stadium_category == ""){
                                            $stadium_category = $listing['version_name'];
                                            $stadium_category = explode("' - ",$stadium_category);
                                            $stadium_category = $stadium_category[1];
                                    }
                                    $ticket_category_id = "";
                                    if($stadium_category != ""){
                                        $ticket_category_id = $this->stadiumCategory_update_v1($stadium,$stadium_category);
                                    }
                                    if($ticket_category_id == ""){
                                        $ticket_category_id = $this->stadiumCategory_update($stadium,$stadium_category);
                                    }
                                    
                                    $ticketid           = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
                                    $ticket_group_id    = mt_rand(100000, 999999);
                                    $split_type = 5;
                                    if($listing['buy_multipler'] == 1){
                                        $split_type = 5;
                                    }
                                    if($listing['buy_multipler'] == 2){
                                        $split_type = 3;
                                    }
                                    if($listing['buy_multipler'] == $listing['stock']){
                                        $split_type = 2;
                                    }
                                    $price = $listing['price']; 

                                    $seller_tickets['oneclicket_id']     = $listing['id'];
                                    $seller_tickets['ticket_type']       = 2;
                                    $seller_tickets['ticketid']          = $ticketid;
                                    $seller_tickets['ticket_group_id']   = $ticket_group_id;
                                    $seller_tickets['user_id']           = 229;
                                    $seller_tickets['match_id']          = $match_info->m_id;
                                    $seller_tickets['event_flag']        = 'E';
                                    $seller_tickets['ticket_category']   = $ticket_category_id;
                                    $seller_tickets['ticket_block']      = '';
                                    $seller_tickets['home_town']         = 'Any';
                                    $seller_tickets['row']               = 'N/A';
                                    $seller_tickets['ticket_block']      = 0;
                                    $seller_tickets['quantity']          = $listing['stock'];
                                    $seller_tickets['price_type']        = 'EUR';
                                    $seller_tickets['price']             = $price;
                                    $seller_tickets['listing_note']      = '';
                                    $seller_tickets['split']             = $split_type;
                                    $seller_tickets['sell_date']         = date("Y-m-d h:i:s");
                                    $seller_tickets['status']            = $listing['published'];
                                    $seller_tickets['add_by']            = 229;
                                    $seller_tickets['store_id']          = 13;
                                    $seller_tickets['sell_type']         = 'buy';
                                        
                                    $seller_tickets['source_type']        = 'oneclicket';
                                    $seller_tickets['general_admission']  = '';
                                    $seller_tickets['seat']               = '';
                                    $seller_tickets['shippings']          = json_encode($eventVersion['shippings']);

                                    $ticket_info = $this->General_Model->getAllItemTable_Array('sell_tickets', array('oneclicket_id' => $listing['id']))->row();

                                    if($ticket_info->s_no != ""){
                                    
                                   
                                    $ticket_data['quantity']             = $listing['stock'];
                                    $ticket_data['price']                = $listing['price'];
                                    $ticket_data['status']               = $listing['published'];
                                    $ticket_data['shippings']            = json_encode($listing['shippings']);

                                    $ticket_data['ticket_updated_date']  = date("Y-m-d h:i:s");
                                   // echo "<pre>";print_r($ticket_data);exit;
                                    $table = "sell_tickets";
                                    $wheres= array("oneclicket_id" => $listing['id']);
                                    $this->Oneclicket_Model->update_table($table, $wheres, $ticket_data);
                                    $ticket_id = $listing['id'];

                                }
                                else{ //echo "<pre>";print_r($seller_tickets);exit;

                                    $ticket_insert_id = $this->Oneclicket_Model->insert_data('sell_tickets',$seller_tickets);
                                    $ticket_id = $listing['id'];
                                }
                                    
                                $available_tickets[] = $ticket_id;


                                     $ticket_count = $ticket_count + $listing['stock'];
                                    }

                                 }
                                 $this->update_oneclicket_ticket_status($match_info->m_id,$available_tickets);
                             }

            
            } 
            }
            }

                    if($ticket_count == 0){
                    $msg = "No Tickets Updated.";
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
            $response['next'] = $next_page;
            $response['status'] = 0;
            $response['msg'] = $msg;
            echo json_encode($response);exit;
        }
    }
     else{
        
        if(!empty($_POST['add_event_id'])){
          $eventsids =   $_POST['add_event_id'];
          $updated_count = 0;
          foreach ($eventsids as $eventsid) {
              
              $api_events_tickets = $this->General_Model->getAllItemTable_Array('api_events', array('id' => $eventsid))->row();
            //  echo "<pre>";print_r($api_events_tickets->tixstock_parent_category);exit;
              $tournament_id     = $api_events_tickets->tournament;
              $team_a            = $api_events_tickets->team_a;
              $team_b            = $api_events_tickets->team_b;
              $stadium_id        = $api_events_tickets->stadium;
              $match_date        = $api_events_tickets->match_date;
              $match_date_time   = $api_events_tickets->match_date_time;
              $api_unique_id     = $api_events_tickets->api_unique_id;
              $main_category     = $api_events_tickets->category;
              //echo 'main_category = '.$main_category;exit;
              $match_date_time   = date("Y-m-d H:i:s",strtotime($match_date_time));
              $match_time        = date("H:i:s",strtotime($match_date_time));

              $stadium_exists = $this->General_Model->getAllItemTable_Array('api_stadium', array('stadium_id' => $stadium_id,'category' => $main_category))->row();

              $tournament_exists = $this->General_Model->getAllItemTable_Array('api_tournaments', array('tournament_id' => $tournament_id,'category' => $main_category))->row();

              $team_exists_a = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_a,'category' => $main_category))->row();
              $team_exists_b = $this->General_Model->getAllItemTable_Array('api_teams', array('team_name' => $team_b,'category' => $main_category))->row();

              $this->get_team_row($team_a, $main_category);
              $this->get_team_row($team_b, $main_category);
              $this->get_stadium_row($stadium_exists->stadium_name,1);

              //echo "<pre>";print_r($tournament_exists);exit;
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

                        $boxoffice_tournament_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $tournament_exists->tournament_id,'source_type' => 'oneclicket','content_type' => 'tournament'))->row();
                     $boxoffice_tournament_id = $boxoffice_tournament_exists->content_id;

                     } 
                     
                     
                     if($boxoffice_team_a == ""){

                        $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_exists_a->team_id,'source_type' => 'oneclicket','content_type' => 'team'))->row();
                        $boxoffice_team_a = $boxoffice_team_exists->content_id;

                     } 
                      
                     if($boxoffice_team_b == ""){

                        $boxoffice_team_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $team_exists_b->team_id,'source_type' => 'oneclicket','content_type' => 'team'))->row();
                        $boxoffice_team_b = $boxoffice_team_exists->content_id;

                     } 
                     
                     
                     if($boxoffice_stadium_id == ""){

                        $boxoffice_stadium_exists = $this->General_Model->getAllItemTable_Array('merge_api_content', array('api_content_id' => $stadium_exists->stadium_id,'source_type' => 'oneclicket','content_type' => 'stadium'))->row();
                        $boxoffice_stadium_id = $boxoffice_stadium_exists->content_id;

                     }

                     $match_exists = $this->General_Model->getAllItemTable_Array('match_info', array('tournament' => $boxoffice_tournament_id,'team_1' => $boxoffice_team_a,'team_2' => $boxoffice_team_b,'venue' => $boxoffice_stadium_id))->row();
                       //echo $boxoffice_tournament_id.'='.$boxoffice_team_a.'='.$boxoffice_team_b.'='.$boxoffice_stadium_id;exit;
                     if($boxoffice_tournament_id != "" && $boxoffice_team_a != "" && $boxoffice_team_b != "" && $boxoffice_stadium_id != ""){ 
                      ///  echo "<pre>";print_r($match_exists);exit;
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
                        $match_data['match_name']               = str_replace('[','-',$match_name_full);
                        $match_data['team_1']                   = $boxoffice_team_a;
                        $match_data['team_2']                   = $boxoffice_team_b;
                        $match_data['hometown']                 = $boxoffice_team_a;
                        $match_data['tournament']               = $boxoffice_tournament_id;
                        $match_data['slug']                     = str_replace('[','-',$team_slug);
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
                        $match_data['other_event_category']     = $other_event_category;
                        $match_data['price_type']               = "EUR";
                        $match_data['store_id']                 = $this->session->userdata('storefront')->admin_id;
                        $match_data['tixstock_id']              = "";
                        $match_data['oneclicket_id']            = $api_unique_id;
                        $match_data['tixstock_update_date']     =  date('Y-m-d', strtotime('-1 day', strtotime(date("Y-m-d H:i:s"))));
                        $match_data['source_type']              = "oneclicket";
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

public function stadiumCategory_update($stadium_id,$category){

    $language_array = $this->language_array;
    $category_data  =   $this->Tssa_Model->get_seat_category($category);

    if($category_data == ""){

        $seat_category_data =  array(
        'seat_category'         => $category,
        'status'                => 1,
        'create_date'           => time(),
        'event_type'            => 'match',
        'source_type'           => 'oneclicket'

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

public function stadiumCategory_update_v1($stadium_id,$category){

    $language_array = $this->language_array;
    $api_stadiums_category = $this->General_Model->getAllItemTable_Array('oneclicket_stadium_category', array('stadium_id' => $stadium_id,'category' => $category))->row();
    if($api_stadiums_category->id == ""){
        $category_data = array('stadium_id' => $stadium_id,'category' => $category,'merge_status' => 0);
        $api_stadiums_category_id = $this->Oneclicket_Model->insert_data('oneclicket_stadium_category',$category_data);
    }
    else{
        $api_stadiums_category = $this->General_Model->getAllItemTable_Array('merge_api_stadium_category', array('stadium_id' => $stadium_id,'api_category' => $api_stadiums_category->id))->row();
        if($api_stadiums_category->category != ""){
            return $api_stadiums_category->category;
        }
    }
    return "";


        


}

public function updateApiEvents($data,$tournament_id,$team_1_id,$team_2_id,$stadium_id,$matchtype='',$flag="")
    {  

          $match_date_string    = explode(' ',$data['datetime']); 
          $match_date           =  $match_date_string[0];
          if($matchtype == ""){
            $matchtype = "match";
          }
          $check_match_exists   =  $this->Oneclicket_Model->check_match_exists($match_date,$tournament_id,$team_1_id,$team_2_id,$matchtype,$flag)->row();
          $old_currency         = $check_match_exists->price_type;
          $source_type          = $check_match_exists->source_type;
          
          $match_id             = $check_match_exists->m_id;
           return $match_id;
    }


    public function updateEventsData($category_id="")
    { 
         if($_POST['category_name'] != ""){
            
        $current_page = $_POST['oneclicket_page'];

        $tournament_category_data = array($_POST['category_name']);
        
        foreach($tournament_category_data as $category_id){ 
            $language_array = $this->language_array;
            $this->disable_oneclicket_events();
            if($category_id != ""){

                    $request_data = array(
                    "iso" => "en",
                    "filters" => array("category" => array('id' => $category_id)),
                    "sort" => array(
                    "field" => "id",
                    "type" => "desc"
                    ),
                    "limit" => 10,
                    "page" => $current_page
                    );
                    $product_response = $this->process_curl_request("getProducts",$request_data);
                   	//echo "<pre>";print_r($product_response);exit;
                    if($product_response['meta']['status'] == "success"){
                      //  echo "<pre>";print_r($product_response);exit;
                    $product_data  = $product_response['data'];
                    $pagination    = $product_response['pagination'];
                    $next_page     = 1;
                    if($current_page < $pagination['total_pages']){
                        $next_page = $current_page + 1;
                    }
                    if(!empty($product_data)){
                        $productdata = array();
                                //echo "<pre>";print_r($product_data);exit;
                        foreach($product_data as $key => $product){
                            $match_date         = $product['date'];

                            $category_id        = $product['category_id'];
                            $category_name      = trim($product['category_name']);

                            $tournament_category  = $this->General_Model->tournaments_1bx($category_name);
                            
                            if($tournament_category[0]->category == "" && $category_name == "Rugby World Cup 2023"){
                               if($category_name == "Rugby World Cup 2023"){
                                     $main_category = 3;
                                }
                            }
                             else if($tournament_category[0]->category == "" && $category_name != "Rugby World Cup 2023"){
                                 $main_category = 1;
                             }
                            else{
                                $main_category = $tournament_category[0]->category;
                            }
                            
                            $today_date         = date("Y-m-d H:i:s");
                            $hourdiff = round((strtotime($match_date) - strtotime($today_date))/3600, 1);
                            $eventVersions =   $product['versions']; 
                             if($hourdiff >= 40 && !empty($eventVersions)){
                           
                            $oncecliket_teams   = $product['teams'];
                            $stadium_id         = $product['stadium_id'];
                            $stadium_name       = trim($product['stadium_name']);
                            $stadium_data       = array('stadium_id' => $stadium_id,'stadium_name' => $stadium_name);
                            $stadium_update = $this->update_oneclicket_stadiums($stadium_data,$main_category);
                          // echo "AAAA";exit;
                            
                           
                             //FETCH OR CREATE TOURNAMENT CATEGORY
                            if($category_id != "" && $category_name != ""){

                                $category_data = array('category_id' => $category_id,'category_name' => $category_name);
                                 $tournament_update = $this->update_oneclicket_tournaments($category_data,$main_category);
                            }

                            //FETCH OR CREATE TEAMS
                            $oncecliket_teams = array_unique($oncecliket_teams, SORT_REGULAR);
                            
                           if(!empty($oncecliket_teams)){

                                foreach($oncecliket_teams as $oncecliket_team){
                                    $tournament_update = $this->update_oneclicket_teams($oncecliket_team,$main_category);
                                }
                           }
                           
                        
                    }
                }
                    }
                    
                    $response = array('status' => 1,'flag' => 'team','msg' => 'Team,Tournament,Stadium data updated Successfully.','next' => $next_page);
                    echo json_encode($response);exit;
                    }
                    else{
                        $response = array('status' => 0,'flag' => 'team','msg' => 'Empty Team,Tournament,Stadium data.','next' => $next_page);
                    echo json_encode($response);exit;
                    }

            
        }
        }
    }
}
    public function updateProducts($category_id="")
    {   echo "disabled";exit;
        $tournament_category_data = array(795);
        foreach($tournament_category_data as $category_id){ 
        $language_array = $this->language_array;

        $matches_info       = $this->General_Model->getAllItemTable_Array('match_info', array('oneclicket_id != ' => ""))->result();
        foreach($matches_info as $match_info){
            $match_date         = $match_info->match_date;
            $today_date         = date("Y-m-d H:i:s");
            $hourdiff           = round((strtotime($match_date) - strtotime($today_date))/3600, 1);
            if($hourdiff <= 40){
                $table = "match_info";
                $stadiums_data= array("oneclicket_status" => '0');
                $wheres = array("m_id" => $match_info->m_id);
                $this->Oneclicket_Model->update_table($table, $wheres, $stadiums_data);
                 $tickets_info       = $this->General_Model->getAllItemTable_Array('sell_tickets', array('match_id' => $match_info->m_id,'source_type' => 'oneclicket'))->result();
                  foreach($tickets_info as $ticket_info){
                    
                    $table = "sell_tickets";
                $stadiums_data= array("status" => 2);
                $wheres = array("s_no" => $ticket_info->s_no);
                $this->Oneclicket_Model->update_table($table, $wheres, $stadiums_data);

                  }

            }
        } 
        
       
        if($category_id != ""){

           $request_data = array(
            "iso" => "en",
           // "filters" => array("product" => array('id' => 29701)),
            "filters" => array("category" => array('id' => $category_id)),
            "sort" => array(
            "field" => "id",
            "type" => "desc"
            ),
            "limit" => 20,
            "page" => 1
            );
            $product_init_response = $this->process_curl_request("getProducts",$request_data);
          //  Tottenham Hotspur Vs Brentford FC
        // echo "<pre>";print_r($product_init_response);exit;
            if($product_init_response['meta']['status'] == "success"){

                $total_pages  = $product_init_response['pagination']['total_pages'];
                $current_page = $product_init_response['pagination']['current_page'];
                for($current_page = 1;$current_page <=$total_pages;$current_page++){

                    $request_data = array(
                    "iso" => "en",
                  //"filters" => array("product" => array('id' => 29701)),
                     "filters" => array("category" => array('id' => $category_id)),
                    "sort" => array(
                    "field" => "id",
                    "type" => "desc"
                    ),
                    "limit" => 20,
                    "page" => $current_page
                    );
                    $product_response = $this->process_curl_request("getProducts",$request_data);
                    if($product_response['meta']['status'] == "success"){

                    $product_data  = $product_response['data'];
                    if(!empty($product_data)){
                        $productdata = array();
                                //echo "<pre>";print_r($product_data);exit;
                        foreach($product_data as $key => $product){
                            $match_date         = $product['date'];
                            $today_date         = date("Y-m-d H:i:s");
                            $hourdiff = round((strtotime($match_date) - strtotime($today_date))/3600, 1);
                             if($hourdiff >= 40){
                          
                            $oncecliket_teams   = $product['teams'];
                            $stadium_id         = $product['stadium_id'];
                            $stadium_name       = trim($product['stadium_name']);
                            $this->updateStadiums($stadium_id);
                            if($stadium_name != ""){
                            $stadium_name       = explode('-',$stadium_name);
                            $stadium_name       = explode('(',$stadium_name[0]);
                            $stadium_name       = $stadium_name[0];
                            } 
                            $stadium_name       = trim($stadium_name);
                            $category_id        = $product['category_id'];
                            $category_name      = $product['category_name'];
                            $event_stadim_id    =  "";
                            $event_stadim_name  =  "";

                            //FETCH OR CREATE STADIUM
                            if($stadium_id != "" && $stadium_name != ""){
                                $stadium_name = trim($stadium_name);
                                $stadium_info = $this->General_Model->getAllItemTable_Array('stadium', array('stadium_name' => $stadium_name,'status' => '1'),'','s_id','DESC')->row();

                                if($stadium_info->s_id != ""){
                                    $event_stadim_id    = $stadium_info->s_id;
                                    $stadium_name       = $stadium_info->stadium_name;
                                    $table = "stadium";
                                    $stadiums_data= array("oneclicket_id" => $stadium_id,"status" => 1,"attendee_status" => 1);
                                    $wheres = array("s_id" => $event_stadim_id);
                                    $this->Oneclicket_Model->update_table($table, $wheres, $stadiums_data);
                                }
                                else{

                                $stadium_data['oneclicket_id']    = $stadium_id;
                                $stadium_data['source_type']      = 'oneclicket';
                                $stadium_data['stadium_name']     = $stadium_name;
                                $stadium_data['status']           = 0;
                                $stadium_data['attendee_status'] = 1;


                                $stadium_insert_id = $this->Oneclicket_Model->insert_data('stadium',$stadium_data);
                                $stadium_info = $this->General_Model->getAllItemTable_Array('stadium', array('s_id' => $stadium_insert_id))->row();

                                if($stadium_info->s_id != ""){
                                    $event_stadim_id    = $stadium_info->s_id;
                                    $stadium_name       = $stadium_info->stadium_name;
                                }

                                }

                            } 
                           
                             //FETCH OR CREATE TOURNAMENT CATEGORY
                            if($category_id != "" && $category_name != ""){

                                $category_name = trim($category_name);
                                if($category_name == "English Premier League"){
                                    $category_name = str_replace("English Premier League","Premier League","English Premier League");
                                }
                                
                                $tournament_category_info = $this->General_Model->getAllItemTable_Array('tournament', array('tournament_name' => $category_name))->row();
                               
                                if($tournament_category_info->t_id != ""){

                                    $tournament_category_id        = $tournament_category_info->t_id;
                                     $tournament_category_name      = $tournament_category_info->category;
                                    $table = "tournament";
                                    $tournment_data= array("oneclicket_id" => $category_id);
                                    $wheres = array("t_id" => $tournament_category_id);
                                    $this->Oneclicket_Model->update_table($table, $wheres, $tournment_data);
                                }
                                else{
                                $page_title       = "Buy ".$category_name." tickets For 2023 - 2024 Securely Online";
                                $meta_description = "";
                                $url_key          = explode(' ',$category_name);
                                $tournament_url   = strtolower(implode('-',$url_key));
                                $url_key          = strtolower(implode('-',$url_key).'-tickets');

                                $create_date      = time();

                                $tournament_category_data['oneclicket_id']    = $category_id;
                                $tournament_category_data['tournament_name']  = $category_name;
                                $tournament_category_data['status']           = 1;
                                $tournament_category_data['seo_status']       = 0;
                                $tournament_category_data['oneclicket_status']= 1;
                                $tournament_category_data['create_date']      = $create_date;
                                $tournament_category_data['page_title']       = $page_title;
                                $tournament_category_data['tournament_url']   = $tournament_url;
                                $tournament_category_data['url_key']          = $url_key;
                                $tournament_category_data['source_type']      = 'oneclicket';
                                
                                $tournament_insert_id = $this->Oneclicket_Model->insert_data('tournament',$tournament_category_data);
                                $tournament_category_id = $tournament_insert_id;
                                if($tournament_insert_id != ""){
                                    
                                   

                                    foreach($language_array as $language){
                    
                                    $language_data = array(
                                        'tournament_id'     => $tournament_category_id,
                                        'language'          => $language,
                                        'tournament_name'   => $category_name,
                                        'page_title'        => $page_title,
                                        'meta_description'  => $meta_description

                                    );
                                    $tournament_lang_id =  $this->Oneclicket_Model->insert_data('tournament_lang',$language_data);

                                    }
                                }
                                $tournament_category_info = $this->General_Model->getAllItemTable_Array('oneclicket_categories', array('id' => $insert_id))->row();

                                if($tournament_category_info->category_id != ""){
                                    $tournament_category_id        = $tournament_category_info->category_id;
                                    $tournament_category_name      = $tournament_category_info->category;
                                }

                                }

                            }

                            //FETCH OR CREATE TEAMS
                            $oncecliket_teams = array_unique($oncecliket_teams, SORT_REGULAR);
                            
                            $team_1id = "";
                            $team_2id = "";
                            $version_name      = $product['versions'][0]['version_name'];
                            $match_name_str    = explode(".' -",$version_name);
                            $match_name_str    = str_replace("'","",$match_name_str[0]);
                            $match_name_data   = explode(' - ',$match_name_str);
                           
                            if(!empty($match_name_data[0])){
                                $formated_team = array();
                                foreach($oncecliket_teams as $oncecliket_team){
                                    $formated_team[$oncecliket_team['team_name']] = $oncecliket_team['team_id'];
                                    
                                }
                                 
                            if(count($match_name_data) == 2){
                                
                                foreach($match_name_data as $team_name){
                                    $team_name = trim($team_name);
                                    $team_info = $this->General_Model->getAllItemTable_Array('teams_lang', array('team_name' => $team_name,'language' => 'en'))->row();

                                     if(@$team_info->team_id == ""){
                                        $team_info = $this->General_Model->getAllItemTable_Array('teams_lang', array('team_name' => $team_name.' FC','language' => 'en'))->row();
                                     }
                                     if(@$team_info->team_id == ""){
                                        $team_info = $this->General_Model->getAllItemTable_Array('teams_lang', array('team_name' => $team_name.' CF','language' => 'en'))->row();
                                     }
                                    if(@$team_info->team_id != ""){
                                        if($team_1id == ""){
                                            $team_1id   = $team_info->team_id;
                                            $team_1name = $team_info->team_name;
                                        }
                                        else{
                                            $team_2id   = $team_info->team_id;
                                            $team_2name = $team_info->team_name;
                                        }
                                    $table                     = "teams";
                                    $wheres                    = array('id' => $team_info->team_id);
                                    $uvalue                    = array('oneclicket_id' => $formated_team[$team_name]);
                                    $team_up                  =  $this->Oneclicket_Model->update_table($table, $wheres, $uvalue);

                                    }
                                    else{ 
                                    $create_date = time();
                                    $team_url    = explode(' ',$team_name);
                                    $team_url    = strtolower(implode('-',$team_url));
                                    $url_key     = $team_url.'-tickets';
                                    $teams_data['team_name']     = $team_name;
                                    $teams_data['oneclicket_id'] = $formated_team[$team_name];
                                    $teams_data['status']        = 1;
                                    $teams_data['category']      = 1;
                                    $teams_data['oneclicket_status']      = 1;
                                    $teams_data['source_type']   = 'oneclicket';
                                    $teams_data['create_date']   = $create_date;
                                    $teams_data['team_url']      = $team_url;
                                    $teams_data['url_key']       = $url_key;
                                    $teams_data['create_date']   = $create_date;
                                    $team_insert_id = '';
                                    $team_insert_id = $this->Oneclicket_Model->insert_data('teams',$teams_data);

                                    if($team_insert_id != ""){

                                        foreach($language_array as $language){

                                        $language_data = array(
                                        'team_id'       => $team_insert_id,
                                        'language'      => $language,
                                        'team_name'     => $team_name

                                        );
                                        $team_lang_id   =  $this->Oneclicket_Model->insert_data('teams_lang',$language_data);
                                        }

                                   // $team_info = $this->General_Model->getAllItemTable_Array('teams', array('id' => $insert_id))->row();

                                    $team_info = $this->General_Model->getAllItemTable_Array('teams_lang', array('team_id' => $team_insert_id,'language' => 'en'))->row();

                                    if($team_info->id != ""){
                                        if($team_1id == ""){
                                            $team_1id   = $team_info->team_id;
                                            $team_1name = $team_info->team_name;
                                        }
                                        else{
                                            $team_2id   = $team_info->team_id;
                                            $team_2name = $team_info->team_name;
                                        }
                                    }

                                    }
                                    

                                    }
                                }
                            } 
                          /*echo $team_1id.'_'.$team_2id;echo "<br>";
                          echo $event_stadim_id.'_'.$event_stadim_name;echo "<br>";
                          echo $tournament_category_id.'_'.$tournament_category_name;echo "<br>";*/

                            if($team_1id != "" && $team_2id != "" && $event_stadim_id != "" && $tournament_category_id != ""){

                                
                               // echo "<pre>";print_r($product);exit;
                                $match_name         = $team_1name.' vs '.$team_2name;
                                $team_1             = $team_1id;
                                $team_2             = $team_2id;
                                $hometown           = $team_1id;
                                $tournament         = $tournament_category_id;
                                $match_dates        = explode(' ',$product['date']);
                                $match_date         = $match_dates[0];
                                $match_time         = $match_dates[1];
                                $currency           = "EUR";
                                $oneclicketid       = $product['id'];

                                $check_match_exists   =  $this->Oneclicket_Model->check_match_exists($match_date,$tournament,$team_1,$team_2,'match')->row();
                                
                              $old_currency         = $check_match_exists->price_type;
                              $source_type          = $check_match_exists->source_type;
                              if($source_type != 'oneclicket' && $source_type != ""){
                                $currency             = $old_currency;
                              } 
                              $match_id             = $check_match_exists->m_id;

                              if($match_id == ''){

                               $url_key         = explode(' ',$match_name);
                               $slug            = strtolower(implode('-',$url_key).'-tickets');
                               $create_date     = time();
                               $availability     = 0;
                               $status           = 0;
                              if($check_match_exists->status == 1){
                                 $availability = 1;
                                 $status = 1;
                              }
              
                          $match_data = array(

                            'match_name'    => $match_name,
                            'oneclicket_id' => $oneclicketid,
                            'team_1'        => $team_1,
                            'team_2'        => $team_2,
                            'tournament'    => $tournament,
                            'status'        => $status,
                            'seo_status'    => 0,
                            'availability'  => $availability,
                            'match_date'    => $product['date'],
                            'match_time'    => $match_time,
                            'venue'         => $event_stadim_id,
                            'country'       => '',
                            'city'          => '',
                            'create_date'   => $create_date,
                            'event_type'    => 'match',
                            'price_type'    => $currency,
                            'add_by'        => 1,
                            'source_type'   => 'oneclicket',
                            'slug'          => $slug
                        );
            //echo "<pre>";print_r($tournament_data);exit;
                        $match_id           =  $this->Oneclicket_Model->insert_data('match_info',$match_data);
                        
                        if($match_id != ""){

                        $match_settings_data = array();
                        $match_settings_data['matches'] = $match_id;
                        $match_settings_data['storefronts'] = 13;
                        $match_settings_data['partners']  = 209;
                        $match_settings_data['status']  = "1";
                        $this->db->insert('match_settings', $match_settings_data);
                    
                    foreach($language_array as $language){

                        $description = "<p>Buy ".$match_name." tickets for the ".$tournament_category_name." game being played on ".$product['date']."&nbsp;at ".$stadium_name.". 1BoxOffice offers a wide range of ".$match_name." tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy tickets!</p>";
                        
                        $meta_title  = $match_name." Tickets | ".$product['date']." | 1BoxOffice.com";
                        $meta_description = $description;

                        $language_data = array(
                            'match_id'          => $match_id,
                            'language'          => $language,
                            'match_name'        => $match_name,
                            'description'       => $description,
                            'meta_title'        => $meta_title,
                            'meta_description'  => $meta_description

                        );
                        $match_lang_id =  $this->Oneclicket_Model->insert_data('match_info_lang',$language_data);
                                                        }
                }
                }
                else{

                $stadium_info = $this->General_Model->getAllItemTable_Array('stadium', array('s_id' => $check_match_exists->venue))->row();

                $table                     = "match_info";
                $wheres                    = array('m_id' => $match_id);
                $uvalue                    = array('oneclicket_id' => $oneclicketid,'price_type' => $currency);
                if($stadium_info->s_id == ""){
                    $uvalue['venue'] = $event_stadim_id;
                }
                $match_up                  =  $this->Oneclicket_Model->update_table($table, $wheres, $uvalue);
                }    

                               
                                $eventVersions =   $product['versions'];     
                                

                               
                                if(!empty($eventVersions) && $match_id != ""){
                                    
                                    $available_tickets = array();
                                    foreach($eventVersions as $eventVersion){
                                    $stadium_category = $eventVersion['version_name'];
                                    $stadium_category = explode(".' -",$stadium_category);
                                    $stadium_category = $stadium_category[1];
                                    if($stadium_category == ""){
                                            $stadium_category = $eventVersion['version_name'];
                                            $stadium_category = explode("' - ",$stadium_category);
                                            $stadium_category = $stadium_category[1];
                                    }
                                    $stadium_cat_info = $this->General_Model->getAllItemTable_Array('stadium_seats_lang', array('seat_category' => $stadium_category,'language' => 'en'))->row();
                                
                                    if($stadium_cat_info->id == ""){

                                    $create_date     = time();
                                    $stadiums_category['seat_category']   = $stadium_category;
                                    $stadiums_category['status']          = 1;
                                    $stadiums_category['create_date']         = $create_date;
                                    $stadiums_category['event_type']         = 'match';
                                    $stadiums_category['source_type']         = 'oneclicket';


                                    $stadium_cat_id = $this->Oneclicket_Model->insert_data('stadium_seats',$stadiums_category); 
                                    if($stadium_cat_id != ""){

                                    $stadium_details_data['stadium_id']      = $event_stadim_id;
                                    $stadium_details_data['block_id']      = 'NA';
                                    $stadium_details_data['category']      = $stadium_cat_id;
                                    $stadium_details_data['block_color']     = $this->get_rgb($eventVersion['version_color']);
                                    $stadium_details_data['source_type']      = 'oneclicket';

                                    $this->Oneclicket_Model->insert_data('stadium_details',$stadium_details_data);

                                        foreach($language_array as $language){

                                        $language_data = array(
                                        'stadium_seat_id'       => $stadium_cat_id,
                                        'language'      => $language,
                                        'seat_category'     => $stadium_category

                                        );
                                        $this->Oneclicket_Model->insert_data('stadium_seats_lang',$language_data);
                                        }
                                    }
                                    

                                    }
                                    else{

                                        $stadium_cat_id = $stadium_cat_info->stadium_seat_id;
                                        $stadium_details_info = $this->General_Model->getAllItemTable_Array('stadium_details', array('category' => $stadium_cat_id,'stadium_id' => $event_stadim_id))->row();
                                       
                                        if($stadium_details_info->id == ""){

                                          
                                            $stadium_details_data['stadium_id']      = $event_stadim_id;
                                            $stadium_details_data['block_id']      = 'NA';
                                            $stadium_details_data['category']      = $stadium_cat_id;
                                            $stadium_details_data['block_color']     = $this->get_rgb($eventVersion['version_color']);
                                            $stadium_details_data['source_type']      = 'oneclicket';

                                            $this->Oneclicket_Model->insert_data('stadium_details',$stadium_details_data);
                                        }
                                        else{

                                        $table = "stadium_details";
                                        $ticket_cat_data['block_color'] = $this->get_rgb($eventVersion['version_color']);
                                        $wheres= array("id" => $stadium_details_info->id);
                                        $this->Oneclicket_Model->update_table($table, $wheres, $ticket_cat_data);

                                        }
                                    }
                                  
                                    $ticketid           = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
                                    $ticket_group_id    = mt_rand(100000, 999999);
                                    $split_type = 5;
                                    if($eventVersion['buy_multipler'] == 1){
                                        $split_type = 5;
                                    }
                                    if($eventVersion['buy_multipler'] == 2){
                                        $split_type = 3;
                                    }
                                    if($eventVersion['buy_multipler'] == $eventVersion['stock']){
                                        $split_type = 2;
                                    }

                                    $price = $eventVersion['price']; 
                               /* if($currency == 'GBP'){
                                    $price = $eventVersion['price'] * 0.87  ;
                                }
                                else if($currency == 'USD'){
                                    $price = $eventVersion['price'] * 1.10  ;
                                }
                                else{
                                   $price = $eventVersion['price']; 
                                }*/

                                    $seller_tickets['oneclicket_id']     = $eventVersion['id'];
                                    $seller_tickets['ticket_type']       = 2;
                                    $seller_tickets['ticketid']          = $ticketid;
                                    $seller_tickets['ticket_group_id']   = $ticket_group_id;
                                    $seller_tickets['user_id']           = 229;
                                    $seller_tickets['match_id']          = $match_id;
                                    $seller_tickets['event_flag']        = 'E';
                                    $seller_tickets['ticket_category']   = $stadium_cat_id;
                                    $seller_tickets['ticket_block']      = '';
                                    $seller_tickets['home_town']         = 'Any';
                                    $seller_tickets['row']               = 'N/A';
                                    $seller_tickets['ticket_block']      = 0;
                                    $seller_tickets['quantity']          = $eventVersion['stock'];
                                    $seller_tickets['price_type']        = 'EUR';
                                    $seller_tickets['price']             = $price;
                                    $seller_tickets['listing_note']      = '';
                                    $seller_tickets['split']             = $split_type;
                                    $seller_tickets['sell_date']         = date("Y-m-d h:i:s");
                                    $seller_tickets['status']             = $eventVersion['published'];
                                    $seller_tickets['add_by']             = 229;
                                    $seller_tickets['store_id']           = 13;
                                    $seller_tickets['sell_type']           = 'buy';
                                        
                                    $seller_tickets['source_type']        = 'oneclicket';
                                    $seller_tickets['general_admission']  = '';
                                    $seller_tickets['seat']               = '';
                                    $seller_tickets['shippings']          = json_encode($eventVersion['shippings']);
                                    


                                    $ticket_info = $this->General_Model->getAllItemTable_Array('sell_tickets', array('oneclicket_id' => $eventVersion['id']))->row();
                                    //echo $ticket_info->s_no;echo "<br>";
                                if($ticket_info->s_no != ""){
                                    
                                    if($ticket_info->s_no == 9704){
                                       // echo $eventVersion['stock'];exit;
                                    }
                                    $ticket_data['quantity']             = $eventVersion['stock'];
                                    $ticket_data['price']                = $eventVersion['price'];
                                    $ticket_data['status']               = $eventVersion['published'];
                                    $ticket_data['shippings']            = json_encode($eventVersion['shippings']);

                                    $ticket_data['ticket_updated_date']  = date("Y-m-d h:i:s");
                                    
                                    $table = "sell_tickets";
                                    $wheres= array("oneclicket_id" => $eventVersion['id']);
                                    $this->Oneclicket_Model->update_table($table, $wheres, $ticket_data);
                                    $ticket_id = $eventVersion['id'];

                                }
                                else{

                                    $ticket_insert_id = $this->Oneclicket_Model->insert_data('sell_tickets',$seller_tickets);
                                    $ticket_id = $eventVersion['id'];
                                }
                                    $available_tickets[] = $ticket_id;

                                    } 
                                    $this->update_oneclicket_ticket_status($match_id,$available_tickets);
                                }

                            }
                        }
                            // seller id 222
                            
                            //$team_id = $this->update_teams($team);
                        
                    }
                }
                    }


                    }

            }
            $rsp['status'] = 1; 
            $rsp['msg'] = 'Events and Tickets Updated Successfully.';
            echo json_encode($rsp);exit;
        }
    }
    else{
            $rsp['status'] = 0; 
            $rsp['msg'] = 'Please Choose Tournament Category.';
            echo json_encode($rsp);exit;
    }
           
    }
    }

    public function update_oneclicket_ticket_status($event_id,$available_tickets){

        if($event_id != "" && !empty($available_tickets)){
            $ticket_infos = $this->General_Model->getAllItemTable_Array('sell_tickets', array('match_id' => $event_id,'user_id' => 229))->result();
            foreach($ticket_infos as $ticket_info){
                if (!in_array($ticket_info->oneclicket_id, $available_tickets))
                {
                $table = "sell_tickets";
                $wheres= array("oneclicket_id" => $ticket_info->oneclicket_id);
                $ticket_data = array('status' => 2,' ticket_deleted_date' => date("Y-m-d h:i:s"));
                $this->Oneclicket_Model->update_table($table, $wheres, $ticket_data);
                }
            }
        }
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


    function process_curl_request($service,$post_data=array()){
          
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
        $RESULT = json_decode($response, 1);
        /*if (!file_exists("oneclicket_logs/".$service)) { 
        mkdir("oneclicket_logs/".$service, 0777, true);
        } 
        $time = strtotime(date("Ymdhis"));
        $fp = fopen("oneclicket_logs/".$service."/".$time.'_request.json', 'a+');
        fwrite($fp, $post_data);
        fclose($fp);
        $fp = fopen("oneclicket_logs/".$service."/".$time.'_response.json', 'a+');
        fwrite($fp, $response);
        fclose($fp);*/
        curl_close($CH);
        return $RESULT;

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
        $insertData['source_type'] = "oneclicket";
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
        $insertData['source_type'] = "oneclicket";
        $insertData['store_id'] = $this->session->userdata('storefront')->admin_id;
        $this->General_Model->insert_data('stadium', $insertData);    
       
    }

}

   
   
}
?>
