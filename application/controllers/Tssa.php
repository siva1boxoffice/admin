<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Tssa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tssa_Model');
        //$this->load->library('tixstock');
       
    }

    public function index($value='')
   {
       // code...
   }

   public function venues($id,$proceed = false)
    {  
        

        $match_results = $this->Tssa_Model->get_match_info_list();

        if($match_results){
            foreach ($match_results as $key => $match) {

                $stadium_id = $match->venue ;
                $match_id = $match->m_id;


                $path = "venues";
                $method = "get";
                 $end_point_url = TIXSTOCK_ENDPOINT_URL."venues/feed?id=".$match->tixstock_id."&name=&address_line_one=&city=&country_code=&postcode=&location=&coordinates=&radius=&order_by=&sort_order=&per_page=&page=";


                 //$feed_response = $this->process_curl_request($path,"GET",$end_point_url);
                $venue = file_get_contents("logs/tixstock/venue.json");
                $feed_response = json_decode($venue,1);

                 if(!empty($feed_response['data'])){
                    foreach ($feed_response['data'] as $datakey => $data) {

                       if(!empty($data['events'])){
                           foreach ( $data['events'] as $key => $event) {
                                if(!empty($event['venue_details'])){
                                    foreach ($event['venue_details'] as $key => $venue) {
                                        
                                        if($venue['name']){
                                            $category_data  =$this->Tssa_Model->get_seat_category($venue['name']);
                                            if($category_data == ""){
                                                $seat_category_data =  array(
                                                    'seat_category'         => $venue['name'],
                                                    'status'                => 1,
                                                    'create_date'           => time(),
                                                    'event_type'            => 'match',
                                                    'source_type'           => 'tixstock'

                                                );
                                                $category_id = $this->Tssa_Model->save_seat_category($seat_category_data);                               
                                            }
                                            else{
                                                $category_id =  $category_data->stadium_seat_id;
                                            }

                                            if($category_id){

                                                $stadium_seats_lang  =$this->Tssa_Model->get_stadium_seats_lang($category_id,$venue['name']);
                                                // echo $this->db->last_query();
                                                // print_r($stadium_seats_lang);
                                                // die;


                                                if(empty($stadium_seats_lang)){
                                                    $stadium_seats_en =  array(
                                                        'seat_category'         => $venue['name'],
                                                
                                                        'stadium_seat_id'       => $category_id,
                                                        'language'              => 'en'

                                                    ); 
                                                    $category_id = $this->Tssa_Model->save_stadium_seats_lang($stadium_seats_en); 
                                                     $stadium_seats_ar =  array(
                                                        'seat_category'         => $venue['name'],
                                                        
                                                        'stadium_seat_id'       => $category_id,
                                                        'language'              => 'ar'

                                                    );  
                                                    $category_id = $this->Tssa_Model->save_stadium_seats_lang($stadium_seats_ar);   
                                                   
                                                }
                                                $block_color = $this->rndRGBColorCode();
                                            if(!empty($venue['sections'])){
                                                foreach ($venue['sections'] as $key => $section) {

                                                     $stadium_details_result  =$this->Tssa_Model->get_stadium_details($stadium_id,$match_id,$section);
                                                       
                                                       if(empty($stadium_details_result)){

                                                           $stadium_details_data = array(
                                                                 'stadium_id'   => $stadium_id,
                                                                 'block_id'     => $section,
                                                                 'category'     => $category_id,
                                                                 'block_color'  => $block_color,
                                                                 'match_id'     => $match_id,                    
                                                                 'source_type'  => 'tixstock'                       
                                                           );

                                                         $this->Tssa_Model->save_stadium_details($stadium_details_data);   

                                                       }                                         
                                                    }                              
                                            }
                                            }
                                        }
                                        
                                    } 
                                }
                           
                           }
                        }

                    }
                }
            }
        }

         echo "<pre>";
         print_r($feed_response);
         die;
            
        
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

            $response = curl_exec($curl);//echo $response;exit;
           /* if (!file_exists("logs/tixstock/".$service)) { 
            mkdir("logs/tixstock/".$service, 0777, true);
            } 
            $time = strtotime(date("Ymdhis"));
            $fp = fopen("xml_logs/tixstock/".$service."/".$time.'_request.json', 'a+');
            fwrite($fp, $service_url);
            fclose($fp);
            $fp = fopen("xml_logs/tixstock/".$service."/".$time.'_response.json', 'a+');
            fwrite($fp, $response);
            fclose($fp);*/
            $formatted_response = json_decode($response,1);
            return $formatted_response;

    }

    function rndRGBColorCode()
    {
        return 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ',1)'; #using the inbuilt random function
    }

}
?>
