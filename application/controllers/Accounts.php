<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
error_reporting(0);
class Accounts extends CI_Controller {
    public function __construct() {
        /*
         *  Developed by: Sivakumar G
         *  Date    : 22 January, 2022
         *  1BoxOffice Hub
         *  https://www.1boxoffice.com/
        */
        parent::__construct(); 
        $this->check_isvalidated();
        $this->load->model('Accounts_Model');
        $this->app_name = $this->General_Model->get_type_name_by_id('general_settings', '1', 'settings_value');
        $this->app_login_image = $this->General_Model->get_type_name_by_id('general_settings', '13', 'settings_value');
        $this->app_title = $this->General_Model->get_type_name_by_id('general_settings', '2', 'settings_value');
        $this->general_path = $this->General_Model->get_type_name_by_id('general_settings', '16', 'settings_value');
        $this->app_favicon = $this->General_Model->get_type_name_by_id('general_settings', '15', 'settings_value');
        $this->login_image = $this->General_Model->get_type_name_by_id('general_settings', '13', 'settings_value');
        $this->logo = $this->General_Model->get_type_name_by_id('general_settings', '17', 'settings_value');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->data = array();
        $this->data['app'] = $this->app_data();
    }

    private function check_isvalidated()
    {   
        if(!$this->session->userdata('admin_logged_in')){
            redirect(base_url(), 'refresh');
        }
        if ($this->session->userdata('role') != 1 &&  $this->session->userdata('role') != 2 && $this->session->userdata('role') != 3) {
            if ($this->session->userdata('admin_logged_in') && $this->session->userdata('role') != 6) {
                $controller_name = $this->router->fetch_class();
                $function_name = $this->router->fetch_method();
                $this->load->model('Privilege_Model');
                $sub_admin_id = $this->session->userdata('admin_id');
                //echo $sub_admin_id;exit;
                if (!$this->Privilege_Model->get_allowed_pages($sub_admin_id, $controller_name, $function_name) && !$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id, $controller_name, $function_name)) {
                    redirect(base_url() . 'access/error_denied', 'refresh');
                }
            } /*else {
                redirect(base_url(), 'refresh');
            }*/
        }
        else{
            redirect(base_url() . 'access/error_denied', 'refresh');
        }
    }
    
     public function app_data() {

        $this->data['app_name'] = $this->app_name;
        $this->data['app_login_image'] = $this->app_login_image;
        $this->data['app_title'] = $this->app_title;
        $this->data['general_path'] = $this->general_path;
        $this->data['app_favicon'] = $this->app_favicon;
        $this->data['login_image'] = $this->login_image;
        $this->data['logo'] = $this->logo;
        $this->data['languages'] = $this->General_Model->getAllItemTable('language')->result();
        $this->data['branches'] = $this->General_Model->get_admin_details_by_role(4,'ACTIVE');
        if ($this->session->userdata('storefront')->company_name == '') {
                $branches = $this->General_Model->get_admin_details(13);
                $sessionUserInfo = array('storefront' => $branches);
                $this->session->set_userdata($sessionUserInfo);
            /*$sessionUserInfo = array('storefront' => $this->data['branches'][count($this->data['branches']) - 1]);*/
        }
        return $this->data;

    }

      public function sales_summary_backup()
    { 
    //echo "<pre>";print_r($_POST);exit;
      $row_count = $this->uri->segment(4);
      $where_array = array();
        if($_GET['sale_start_date'] != "" && $_GET['sale_end_date'] != ""){
            $where_array['sale_start_date']  = $_GET['sale_start_date'];
            $where_array['sale_end_date']  = $_GET['sale_end_date'];
        }
        if($_GET['sellers'] != ""){
            $where_array['sellers'] = $_GET['sellers'];
        }
        if($_GET['users'] != ""){
            $where_array['users'] = $_GET['users'];
        }
        if($_GET['tournaments'] != ""){
            $where_array['tournaments'] = $_GET['tournaments'];
        }
        if($_GET['match_id'] != ""){
                $where_array['match_id'] = $_GET['match_id'];
            }
             if($_GET['nominee'] != ""){
            $where_array['nominee'] = $_GET['nominee'];
        }
         

    $getMySalesData = $this->General_Model->get_confirmed_orders('', $where_array)->result();
   // echo $this->db->last_query();exit;
    $getMySalesData_gbp = $this->General_Model->get_confirmed_orders('GBP', $where_array)->result();
    $getMySalesData_eur = $this->General_Model->get_confirmed_orders('EUR', $where_array)->result();
    $getMySalesData_usd = $this->General_Model->get_confirmed_orders('USD', $where_array)->result();
    $this->data['getMySalesData_gbp'] = $getMySalesData_gbp;
    $this->data['getMySalesData_eur'] = $getMySalesData_eur;
    $this->data['getMySalesData_usd'] = $getMySalesData_usd;
    $this->data['getMySalesData']     = $getMySalesData;
    $this->data['customers'] = $this->General_Model->get_customers();

    $this->data['sellers'] = $this->General_Model->get_sellers();
    $this->data['tournaments'] = $this->General_Model->get_tournaments();

    $this->load->view('accounts/sales_summary',$this->data);
    // $this->loadRecord($row_count, 'booking_global', 'accounts/sales_summary', '', 'DESC', 'accounts/sales_summary', 'getMySalesData', 'sales_summary', $where_array);
    }

    public function get_seller_name(){
            $searchText = $_POST['search_text'];
            // Perform a database query or some other operation to retrieve the checkbox data based on the search text
            $checkboxData = array('1'=>'abc','2'=>'def');
            ;
            $html = "";
            $records = $this->General_Model->get_seller_name($searchText)->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name."  ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

            echo $html;
    }

    public function get_ticket_category(){
        $searchText = $_POST['search_text'];
        // Perform a database query or some other operation to retrieve the checkbox data based on the search text
        
        $html = "";
        $records = $this->General_Model->get_ticket_category($searchText)->result();
        foreach($records as $record ){

           //$seller_name = $record->seller_first_name.$record->seller_last_name;

            $html .=   ' <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="seatCheck'.$record->stadium_seat_id.'">
            <label class="custom-control-label" for="seatCheck'.$record->stadium_seat_id.'">'.$record->seat_category.'</label>
          </div>';

        }

        echo $html;
}
    public function get_items()
    { 
        $this->General_Model->get_ticket_category()->result(); 
        $row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
         
        if (!empty($_POST['booking_no']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['seller_name']) || !empty($_POST['event']) || !empty($_POST['seat'])) {

            $booking_no 							= $_POST['booking_no'];
            $fromDate 							    = $_POST['event_start_date'];
            $toDate 							    = $_POST['event_end_date'];
            $seller_name 							= $_POST['seller_name'];
            $event_name 							= $_POST['event'];
            $seat 							        = $_POST['seat'];
    
            $records = $this->General_Model->get_confirmed_orders_search($rowno, $row_per_page,'', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat)->result();
            $allcount = $this->General_Model->get_confirmed_orders_search('', '','', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat)->num_rows();

        }
        else {

            $records = $this->General_Model->get_confirmed_orders($rowno, $row_per_page,'', $where_array)->result();
            $allcount = $this->General_Model->get_confirmed_orders('', '','', $where_array)->num_rows();
            
        }     
    // echo '<pre/>';
    // print_r($records);
    // exit;

   // $getMySalesData = $this->General_Model->get_confirmed_orders('', $where_array)->result();
        
        foreach($records as $record ){

            $seller_notes="";
				$listing_note=$this->General_Model->get_seller_notes($record->listing_note);
				if(!empty($listing_note))
				{				
					foreach ($listing_note as $notes)
					{
						$seller_notes.=$notes->ticket_name."<br/>";
					}
				}

               // $record->bg_id;
               $search_payout_details=$this->General_Model->search_json_values($record->bg_id);
                
            $match_time=" <br> <span class='tr_date'>".date('d F Y',strtotime($record->match_date))."</span><br>  <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";

            if($record->ticket_block != 0){
                $category= $record->seat_category;
            }
            else{
                $category= "Any";
            }

            // $transaction_date=date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->payment_date))).' '.@$_COOKIE["time_zone"];

             $transaction_date=date('D j F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date));

            


             $mark_as_completed_status = $record->seller_status == 1  ? "checked" : "";

             $mark_as_completed= '
                        <div class="">
                        <div class="content">
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input order_status" name="order_status"  data-id="'.$record->bg_id.'" id="customSwitch3'.$record->bg_id.'"   '.$mark_as_completed_status.' value="1">
                        <label class="custom-control-label" for="customSwitch3'.$record->bg_id.'"></label>
                        </div>
                        </div>
                        </div>
             ';

             /*
             <input type="checkbox" class="is-switch order_status" data-id="<?php echo $getMySales->bg_id;?>" name="order_status" value="1" <?php if (isset($getMySales->seller_status)) {
                    if ($getMySales->seller_status == 1) { ?> checked <?php }
                    } ?>>
             */

             $action='  <div class="dropdown">
             <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                <i class="mdi mdi-dots-vertical fs-sm"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-right">
                <a href="'.base_url().'game/orders/details/'.md5($record->booking_no).'" class="dropdown-item">View</a>
             </div>
          </div>';

                 $match_time="<br/><span class='tr_date'>".date('d/m/Y',strtotime($record->match_date))."</span> <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";
				
				// $match_name_inpt=$record->match_name;
				// $match_name_array = explode(" vs ", strtolower($match_name_inpt));
				// $match_name=$match_name_array[0]." Vs <br/>".$match_name_array[1];

                $input = $record->match_name;
                $vsPosition = stripos($input, "vs"); // Find the position of "vs" case-insensitive
                if ($vsPosition === false) {
                    $vsPosition = stripos($input, "Vs"); // Find the position of "Vs" case-insensitive
                }
                if ($vsPosition !== false) {
                    $team1 = trim(substr($input, 0, $vsPosition));
                    $team2 = trim(substr($input, $vsPosition + 2));
                    $match_name = $team1 . " Vs <br/>". $team2;
                } else {
                    $match_name = $input;
                }

                $str = $category;
				$words = explode(" ", $str); // split the string into an array of words
				$words[1] .= "<br/>"; // add the <br/> tag after the second word
				$seat_category = implode(" ", $words); // join the array of words back into a string
				//echo $newStr;

              
                $where               =      array('bg_id' => $record->bg_id);
                $payable_orders      =      $this->Accounts_Model->get_unpaid_orders_v2($where);
                $payable_amount      =      $payable_orders[0]->ticket_amount;   
                if($payable_orders[0]->currency_type == 'GBP'){
                    $currency = '£';
                }
                else if($payable_orders[0]->currency_type == 'USD'){
                    $currency = '$';
                }
                else if($payable_orders[0]->currency_type == 'EUR'){
                    $currency = '€';
                }

                
						$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

                        $seller_notes_op= !empty($seller_notes) ? '<a class="tooltip_texts" data-toggle="tooltip" data-placement="right" title="" data-original-title="' . $seller_notes . '" aria-describedby="tooltip173041" data-html="true"><i class="fas fa-comment-dots"></i></a>' : '';                      
                     
                      /*  $date1 = new DateTime(date('D j F Y',strtotime($record->payment_date)).date('H:i',strtotime($record->payment_date)));
                        $date2 = new DateTime(date('D j F Y', strtotime($record->match_date )) . date('H:i', strtotime($record->match_time)));

                        $diff = $date1->diff($date2);
                        $days = $diff->days;

                        $delivery_date = "";

                        if ($days <= 1) {
                            $delivery_date = "Delivery In Due";
                        } else {
                            $delivery_date = date('D j F Y', strtotime($record->match_date . ' -3 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
                        }*/

                        $delivery_date = date('D j F Y', strtotime($record->match_date . ' -3 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
                        

                        $seller_name='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->seller_first_name." ".$record->seller_last_name.'</a>';

                        //$encode_id = base64_encode(json_encode($match->m_id));
                        $encode_id="";

                        $event_name='<a href="'.base_url()."event/matches/add_match/". $encode_id.'">'.$match_name." ".$match_time.'</a>';

                     //$match_name." ".$match_time,
                     $encode_id = base64_encode(json_encode($record->match_id));
                 
               
            $data[] = array( 
                "booking_no"			=> $booking_no,   
                "seller_name"			=> $seller_name,      
                "evernt_name"			=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.$match_time.'</a>',
                "category"			    => $seat_category, 
                "seller_notes"		    => $seller_notes_op,
                "qty"					=> $record->quantity, 
                "transaction_date"		=> $transaction_date, 
                "delivery_date"		    => $delivery_date,
                "payout"		        => $currency." ".number_format($payable_amount,2),
                "mark_as_completed"		=> $mark_as_completed,
                "action"		        => $action,
                
                
                
            ); 
        }
        $result = array(
            "draw" => $draw,
              "recordsTotal" => $allcount,
              "recordsFiltered" => $allcount,
              "data" => $data
         );


   echo json_encode($result);
   exit();
       
    }

    public function get_partner_items()
    { 
        
        $row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
        $where_array['partner'] = 1;
         
        if (!empty($_POST['booking_no']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['seller_name']) || !empty($_POST['event']) || !empty($_POST['seat'])) {

            $booking_no 							= $_POST['booking_no'];
            $fromDate 							    = $_POST['event_start_date'];
            $toDate 							    = $_POST['event_end_date'];
            $seller_name 							= $_POST['seller_name'];
            $event_name 							= $_POST['event'];
            $seat 							        = $_POST['seat'];
    
            $records = $this->General_Model->get_confirmed_orders_search($rowno, $row_per_page,'', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat)->result();
            $allcount = $this->General_Model->get_confirmed_orders_search('', '','', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat)->num_rows();

        }
        else {

             $records = $this->General_Model->get_confirmed_orders($rowno, $row_per_page,'', $where_array)->result();
            $allcount = $this->General_Model->get_confirmed_orders('', '','', $where_array)->num_rows();
            
          //  $records = $this->General_Model->get_confirmed_orders('', $where_array)->result();
           // $allcount = $this->General_Model->get_confirmed_orders('', $where_array)->num_rows();
        }     
    // echo '<pre/>';
    // print_r($records);
    // exit;

    //   echo $this->db->last_query();
    //     exit;

   // $getMySalesData = $this->General_Model->get_confirmed_orders('', $where_array)->result();
        
        foreach($records as $record ){

            $seller_notes="";
				$listing_note=$this->General_Model->get_seller_notes($record->listing_note);
				if(!empty($listing_note))
				{				
					foreach ($listing_note as $notes)
					{
						$seller_notes.=$notes->ticket_name."<br/>";
					}
				}

               // $record->bg_id;
               $search_payout_details=$this->General_Model->search_json_values($record->bg_id);
                
            $match_time=" <br> <span class='tr_date'>".date('d F Y',strtotime($record->match_date))."</span><br>  <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";

            if($record->ticket_block != 0){
                $category= $record->seat_category;
            }
            else{
                $category= "Any";
            }

            // $transaction_date=date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->payment_date))).' '.@$_COOKIE["time_zone"];

             $transaction_date=date('D j F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date));

            


             $mark_as_completed_status = $record->seller_status == 1  ? "checked" : "";

             $mark_as_completed= '
                        <div class="">
                        <div class="content">
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input order_status" name="order_status"  data-id="'.$record->bg_id.'" id="customSwitch3'.$record->bg_id.'"   '.$mark_as_completed_status.' value="1">
                        <label class="custom-control-label" for="customSwitch3'.$record->bg_id.'"></label>
                        </div>
                        </div>
                        </div>
             ';

             /*
             <input type="checkbox" class="is-switch order_status" data-id="<?php echo $getMySales->bg_id;?>" name="order_status" value="1" <?php if (isset($getMySales->seller_status)) {
                    if ($getMySales->seller_status == 1) { ?> checked <?php }
                    } ?>>
             */

             $action='  <div class="dropdown">
             <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
                <i class="mdi mdi-dots-vertical fs-sm"></i>
             </a>
             <div class="dropdown-menu dropdown-menu-right">
                <a href="'.base_url().'game/orders/details/'.md5($record->booking_no).'" class="dropdown-item">View</a>
             </div>
          </div>';

                 $match_time="<br/><span class='tr_date'>".date('d/m/Y',strtotime($record->match_date))."</span> <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";
				
				// $match_name_inpt=$record->match_name;
				// $match_name_array = explode(" vs ", strtolower($match_name_inpt));
				// $match_name=$match_name_array[0]." Vs <br/>".$match_name_array[1];

                $input = $record->match_name;
                $vsPosition = stripos($input, "vs"); // Find the position of "vs" case-insensitive
                if ($vsPosition === false) {
                    $vsPosition = stripos($input, "Vs"); // Find the position of "Vs" case-insensitive
                }
                if ($vsPosition !== false) {
                    $team1 = trim(substr($input, 0, $vsPosition));
                    $team2 = trim(substr($input, $vsPosition + 2));
                    $match_name = $team1 . " Vs <br/>". $team2;
                } else {
                    $match_name = $input;
                }

                $str = $category;
				$words = explode(" ", $str); // split the string into an array of words
				$words[1] .= "<br/>"; // add the <br/> tag after the second word
				$seat_category = implode(" ", $words); // join the array of words back into a string
				//echo $newStr;

              
                $where               =      array('bg_id' => $record->bg_id);
                $payable_orders      =      $this->Accounts_Model->get_unpaid_orders_v2($where);
                $payable_amount      =      $payable_orders[0]->ticket_amount;   
                if($payable_orders[0]->currency_type == 'GBP'){
                    $currency = '£';
                }
                else if($payable_orders[0]->currency_type == 'USD'){
                    $currency = '$';
                }
                else if($payable_orders[0]->currency_type == 'EUR'){
                    $currency = '€';
                }

                
						$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

                        $seller_notes_op= !empty($seller_notes) ? '<a class="tooltip_texts" data-toggle="tooltip" data-placement="right" title="" data-original-title="' . $seller_notes . '" aria-describedby="tooltip173041" data-html="true"><i class="fas fa-comment-dots"></i></a>' : '';                      
                     
                      /*  $date1 = new DateTime(date('D j F Y',strtotime($record->payment_date)).date('H:i',strtotime($record->payment_date)));
                        $date2 = new DateTime(date('D j F Y', strtotime($record->match_date )) . date('H:i', strtotime($record->match_time)));

                        $diff = $date1->diff($date2);
                        $days = $diff->days;

                        $delivery_date = "";

                        if ($days <= 1) {
                            $delivery_date = "Delivery In Due";
                        } else {
                            $delivery_date = date('D j F Y', strtotime($record->match_date . ' -3 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
                        }*/

                        $delivery_date = date('D j F Y', strtotime($record->match_date . ' -3 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
                        

                        $seller_name='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->seller_first_name." ".$record->seller_last_name.'</a>';

                        //$encode_id = base64_encode(json_encode($match->m_id));
                        $encode_id="";

                        $event_name='<a href="'.base_url()."event/matches/add_match/". $encode_id.'">'.$match_name." ".$match_time.'</a>';

                     
               
            $data[] = array( 
                "booking_no"			=> $booking_no,   
                "seller_name"			=> $seller_name,      
                "evernt_name"			=> $match_name." ".$match_time,
                "category"			    => $seat_category, 
                "seller_notes"		    => $seller_notes_op,
                "qty"					=> $record->quantity, 
                "transaction_date"		=> $transaction_date, 
                "delivery_date"		    => $delivery_date,
                "payout"		        => $currency." ".number_format($payable_amount,2),
                "mark_as_completed"		=> $mark_as_completed,
                "action"		        => $action,
                
                
                
            ); 
        }
        $result = array(
            "draw" => $draw,
              "recordsTotal" => $allcount,
              "recordsFiltered" => $allcount,
              "data" => $data
         );


   echo json_encode($result);
   exit();
       
    }
     public function sales_summary()
    { 
      
    //echo "<pre>";print_r($_POST);exit;
      $rowno = $this->uri->segment(3);
      $where_array = array();
        if($_GET['sale_start_date'] != "" && $_GET['sale_end_date'] != ""){
            $where_array['sale_start_date']  = $_GET['sale_start_date'];
            $where_array['sale_end_date']  = $_GET['sale_end_date'];
        }
        if($_GET['sellers'] != ""){
            $where_array['sellers'] = $_GET['sellers'];
        }
        if($_GET['users'] != ""){
            $where_array['users'] = $_GET['users'];
        }
        if($_GET['tournaments'] != ""){
            $where_array['tournaments'] = $_GET['tournaments'];
        }
        if($_GET['match_id'] != ""){
                $where_array['match_id'] = $_GET['match_id'];
            }
             if($_GET['nominee'] != ""){
            $where_array['nominee'] = $_GET['nominee'];
        }
        $row_per_page = 10;
        if(!empty($_GET)){
         $row_per_page = 10000;
        }
        
        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $row_per_page;
        }    
        //echo $rowno.'='.$row_per_page;exit;
    $getMy_current_SalesData = $this->General_Model->get_confirmed_orders($rowno, $row_per_page,'', $where_array)->result();
    $getMySalesData = $this->General_Model->get_confirmed_orders('','','', $where_array)->result();
   //echo $this->db->last_query();exit;
    $getMySalesData_gbp = $this->General_Model->get_confirmed_orders('','','GBP', $where_array)->result();
    $getMySalesData_eur = $this->General_Model->get_confirmed_orders('','','EUR', $where_array)->result();
    $getMySalesData_usd = $this->General_Model->get_confirmed_orders('','','USD', $where_array)->result();
    $this->mydatas['getMySalesData_gbp'] = $getMySalesData_gbp;
    $this->mydatas['getMySalesData_eur'] = $getMySalesData_eur;
    $this->mydatas['getMySalesData_usd'] = $getMySalesData_usd;
    $this->mydatas['getMySalesData']     = $getMy_current_SalesData;
    $this->mydatas['getMySalesData_total']     = $getMySalesData;
    $this->mydatas['customers'] = $this->General_Model->get_customers();

    $this->mydatas['sellers'] = $this->General_Model->get_sellers();
    $this->mydatas['tournaments'] = $this->General_Model->get_tournaments();


    
     $this->load->library('pagination');

        // Row per page
        //echo $row_per_page;exit;
        //echo count($getMySalesData);exit;
          
        // Pagination Configuration
        $config['base_url'] = base_url() . 'accounts/sales_summary';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = count($getMySalesData);
        $config['per_page'] = $row_per_page;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = ' ';
        $config['next_tag_open'] = '<li><a data-page="next"><i class=" fas fa-angle-right"></a></i>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = ' ';
        $config['prev_tag_open'] = '<li><a data-page="prev"><i class="fas fa-angle-left"></a></i>';
        $config['prev_tag_close'] = '</li>';
        $config['last_link'] = '>>';
        $config['first_link'] = '<<';
        // Initialize
        $this->pagination->initialize($config);

        $this->mydatas['pagination'] = $this->pagination->create_links();
        $this->mydatas[$variable_name] = 'getMySalesData';
        $this->mydatas['current_month_record'] = $current_month_record;
        $this->mydatas['row'] = $rowno;
        $this->mydatas['search'] = $search;


        $records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name." ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

         $this->mydatas['html'] = $html;


        $seats= $this->mydatas['seat_category'] = $this->General_Model->get_ticket_category()->result();
         $seat_category="";
        
         foreach($seats as $seat ){

           // $seat_category = $record->seller_first_name.$record->seller_last_name;

             $seat_category .=   ' <div class="custom-control custom-checkbox">
             <input type="checkbox" class="custom-control-input" id="seatCheck'.$seat->stadium_seat_id.'">
             <label class="custom-control-label" for="seatCheck'.$seat->stadium_seat_id.'">'.$seat->seat_category.'</label>
           </div>';

         }

      $this->mydatas['seat_category'] = $seat_category;

        
        // Load view
       // $this->load->view('accounts/sales_summary', $this->mydatas);
        $this->load->view(THEME.'accounts/sales_summary', $this->mydatas);

    }

    public function get_tournament_seller()
    { 
       
        if(!empty($_POST['sellers'])){
             $tournaments = $this->General_Model->get_tournament_seller($_POST['sellers']);
             /*if(!empty($tournaments)){
                $response = array('seller' => $_POST['sellers'],'status' => 1,'tournaments' => $tournaments,'option' => "<option value='3'>3</option><option value='4'>4</option>");
             }
             else{
                 $response = array('seller' => $_POST['sellers'],'status' => 0,'tournaments' => '');
             }*/
             $data['tournaments'] = $tournaments;
             $data['seller'] = $_POST['sellers'];
              $data['default'] = $_POST['default'];
             

             $option = $this->load->view('accounts/get_seller_tournament',$data,true);
              $response = array('seller' => $_POST['sellers'],'tournaments' => $option);

             echo json_encode($response);exit;
        }
       
    }

    public function tournament_sales_summary()
    { 
        //echo "<pre>";print_r($_POST);exit;
          $row_count = $this->uri->segment(4);
          $where_array = array();
            if($_GET['sale_start_date'] != "" && $_GET['sale_end_date'] != ""){
                $where_array['sale_start_date']  = $_GET['sale_start_date'];
                $where_array['sale_end_date']  = $_GET['sale_end_date'];
            }
            if($_GET['sellers'] != ""){
                $where_array['sellers'] = $_GET['sellers'];
            }
            if($_GET['users'] != ""){
                $where_array['users'] = $_GET['users'];
            }
            if($_GET['tournaments'] != ""){
                $where_array['tournaments'] = $_GET['tournaments'];
            }
            if($_GET['match_id'] != ""){
                $where_array['match_id'] = $_GET['match_id'];
            }
              //print_r($where_array);die;
        $tournament_id = "19";
        $getMySalesData = $this->General_Model->get_tournaments_orders('', $where_array)->result();
        //echo "<pre>";print_r($getMySalesData);die;
        $getMySalesData_gbp = $this->General_Model->get_tournaments_orders('GBP', $where_array)->result();
        
        $getMySalesData_eur = $this->General_Model->get_tournaments_orders('EUR', $where_array)->result();
        $getMySalesData_usd = $this->General_Model->get_tournaments_orders('USD', $where_array)->result();
        $total_ticket =  $this->General_Model->get_total_ticket("",$tournament_id);
        // echo $this->db->last_query();
        
        // print_r(count($getMySalesData_usd));die;
        //  print_r(count($getMySalesData_gbp));die;
        $this->data['getMySalesData_gbp'] = $getMySalesData_gbp;
        $this->data['getMySalesData_eur'] = $getMySalesData_eur;
        $this->data['getMySalesData_usd'] = $getMySalesData_usd;
        $this->data['getMySalesData']     = $getMySalesData;
        $this->data['customers'] = $this->General_Model->get_customers();
        $this->data['sellers'] = $this->General_Model->get_sellers();
        $this->data['tournaments'] = $this->General_Model->get_tournaments();
        $this->data['all_total_ticket'] = $total_ticket->total;
        // echo '<pre/>';
        // print_r($getMySalesData_usd);
        // exit;

        $this->load->view(THEME.'accounts/tournament_sales_summary',$this->data);
        // $this->loadRecord($row_count, 'booking_global', 'accounts/sales_summary', '', 'DESC', 'accounts/sales_summary', 'getMySalesData', 'sales_summary', $where_array);
    }

    public function download_orders(){

            $where_array = array();
            if($_GET['sale_start_date'] != "" && $_GET['sale_end_date'] != ""){
                $where_array['sale_start_date']  = $_GET['sale_start_date'];
                $where_array['sale_end_date']  = $_GET['sale_end_date'];

                $fileName = "Sales_summary_" .$_GET['sale_start_date'] . "_To_".$_GET['sale_end_date'].".xls"; 
            }
            else{
                 $fileName = "Sales_summary_" . date('Y-m-d') . ".xls"; 
            }
            if($_GET['sellers'] != ""){
                $where_array['sellers'] = explode(",", $_GET['sellers']);
            }
            if($_GET['users'] != ""){
                $where_array['users'] =  explode(",",$_GET['users']);
            }
            if($_GET['tournaments'] != ""){
                $where_array['tournaments'] = $_GET['tournaments'];
            }
            
            if($_GET['match_id'] != ""){
                $where_array['match_id'] = $_GET['match_id'];
            }

            if(@$_GET['partner'] != ""){
                $where_array['partner'] = 1;
            }

            //echo "<pre>";print_r($where_array);exit;
            $download_orders = $this->General_Model->get_confirmed_orders('',$where_array)->result();
           
            // Column names 
            $fields = array('OrderNo','OrderDate','Tournament','Match','MatchDate','MatchTime','Stadium','SellerName','Customer Name','Customer Email','SeatCategory','Row','Qty','SoldAt','Currency'); 
            if(@$_GET['partner'] != ""){
                $fields[]= 'PartnerCommision';
                $fields[]= 'CommisionCurrency';
            } //echo "<pre>";print_r($fields);exit;
            // Display column names as first row 
            $excelData = implode("\t", array_values($fields)) . "\n"; 
            $total_amount = array();
            foreach($download_orders as $download_order){  
            $lineData = array($download_order->booking_no,$download_order->updated_at,$download_order->tournament_name,$download_order->match_name,date("d F Y",strtotime($download_order->match_date)),$download_order->match_time,$download_order->stadium_name.','.$download_order->stadium_city_name.','.$download_order->stadium_country_name,$download_order->seller_first_name.' '.$download_order->seller_last_name,

                $download_order->customer_first_name.' '.$download_order->customer_last_name,
                $download_order->customer_email,
                $download_order->seat_category,
                $download_order->row,$download_order->quantity,number_format($download_order->total_base_amount,2),$download_order->base_currency); 
            if(@$_GET['partner'] != ""){
                $lineData[]= $download_order->partner_commission;
                $lineData[]= $download_order->base_currency;
            }
            $total_amount[] = $download_order->total_base_amount;
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
            $lineData = array('','','','','','','','','','','',number_format(array_sum($total_amount),2),$download_orders[0]->base_currency); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            header("Content-Type: application/vnd.ms-excel"); 
            header("Content-Disposition: attachment; filename=\"$fileName\""); 

            // Render excel data 
            echo $excelData; 

            exit;
    }

    public function partner_sales_summary()
    { 
    //echo "<pre>";print_r($_POST);exit;
      $row_count = $this->uri->segment(4);
      $where_array = array();
        if($_GET['sale_start_date'] != "" && $_GET['sale_end_date'] != ""){
            $where_array['sale_start_date']  = $_GET['sale_start_date'];
            $where_array['sale_end_date']  = $_GET['sale_end_date'];
        }
        if($_GET['sellers'] != ""){
            $where_array['sellers'] = $_GET['sellers'];
        }
        if($_GET['users'] != ""){
            $where_array['users'] = $_GET['users'];
        }
        if($_GET['tournaments'] != ""){
            $where_array['tournaments'] = $_GET['tournaments'];
        }
        if($_GET['match_id'] != ""){
                $where_array['match_id'] = $_GET['match_id'];
        }
        if($_GET['partner_id'] != ""){
                $where_array['partner_id'] = $_GET['partner_id'];
        }
        $where_array['partner'] = 1;
          //print_r($where_array);die;

        //$getMySalesData = $this->General_Model->get_confirmed_orders('', $where_array)->result();
       
        $getMySalesData = $this->General_Model->get_confirmed_orders('','','', $where_array)->result();
        $getMySalesData_gbp = $this->General_Model->get_confirmed_orders('','','GBP', $where_array)->result();
        $getMySalesData_eur = $this->General_Model->get_confirmed_orders('','','EUR', $where_array)->result();
        $getMySalesData_usd = $this->General_Model->get_confirmed_orders('','','USD', $where_array)->result();
   
        $this->data['getMySalesData_gbp'] = $getMySalesData_gbp;
        $this->data['getMySalesData_eur'] = $getMySalesData_eur;
        $this->data['getMySalesData_usd']     = $getMySalesData_usd;
        $this->data['getMySalesData']     = $getMySalesData;
        $this->data['customers'] = $this->General_Model->get_customers();
        $this->data['sellers'] = $this->General_Model->get_sellers();
        $this->data['getMySalesData_total']     = $getMySalesData;
        $this->data['tournaments'] = $this->General_Model->get_tournaments();
        $this->data['users_list'] = $this->General_Model->get_user_details(2)->result();


        $records = $this->General_Model->get_seller_name()->result();
        foreach($records as $record ){

           $seller_name = $record->seller_first_name." ".$record->seller_last_name;

            $html .=   ' <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
            <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
          </div>';

        }

     $this->data['html'] = $html;


     $seats= $this->mydatas['seat_category'] = $this->General_Model->get_ticket_category()->result();
         $seat_category="";
        
         foreach($seats as $seat ){

           // $seat_category = $record->seller_first_name.$record->seller_last_name;

             $seat_category .=   ' <div class="custom-control custom-checkbox">
             <input type="checkbox" class="custom-control-input" id="seatCheck'.$seat->stadium_seat_id.'">
             <label class="custom-control-label" for="seatCheck'.$seat->stadium_seat_id.'">'.$seat->seat_category.'</label>
           </div>';

         }

      $this->data['seat_category'] = $seat_category;

        $this->load->view(THEME.'accounts/partner_sales_summary',$this->data);
        // $this->loadRecord($row_count, 'booking_global', 'accounts/sales_summary', '', 'DESC', 'accounts/sales_summary', 'getMySalesData', 'sales_summary', $where_array);
    }

    public function save_payout_proof($payout_id,$order_data){

        $spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// Set document properties
$spreadsheet->getProperties()->setCreator('miraimedia.co.th')
->setLastModifiedBy('Cholcool')
->setTitle('Listmyticket Payout')
->setSubject('Listmyticket Payout')
->setDescription('Listmyticket Payout');
// add style to the header
$styleArray = array(
'font' => array(
'bold' => true,
),
'alignment' => array(
'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
),
'borders' => array(
'bottom' => array(
'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
'color' => array('rgb' => '333333'),
),
),
'fill' => array(
'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
'rotation'   => 90,
'startcolor' => array('rgb' => '0d0d0d'),
'endColor'   => array('rgb' => 'f2f2f2'),
),
);
$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
// auto fit column to content
foreach(range('A', 'H') as $columnID) {
$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}
// set the names of header cells
$sheet->setCellValue('A1', 'Sl.No');
$sheet->setCellValue('B1', 'Order ID');
$sheet->setCellValue('C1', 'Event Name');
$sheet->setCellValue('D1', 'Buyer');
$sheet->setCellValue('E1', 'Ticket Type');
$sheet->setCellValue('F1', 'Tickets');
$sheet->setCellValue('G1', 'Total Ticket(S) Price');
$sheet->setCellValue('H1', 'Order Status');

// Add some data
 $x = 2;
 $i = 1;
 $fcolumn = count($order_data);
 $total_payable = array();
 foreach($order_data as $order_in){
$total_payable[] = $order_in->ticket_amount;
$booking_status = "";
if($order_in->booking_status == "1"){
 $booking_status = "CONFIRMED";
}
else if($order_in->booking_status == "2"){
 $booking_status = "PENDING";
}
else if($order_in->booking_status == "3"){
 $booking_status = "CANCELLED";
}
else if($order_in->booking_status == "4"){
 $booking_status = "SHIPPED";
}
else if($order_in->booking_status == "5"){
 $booking_status = "DELIVERED";
}
else if($order_in->booking_status == "6"){
 $booking_status = "DOWNLOADED";
}

$sheet->setCellValue('A'.$x, $i);
$sheet->setCellValue('B'.$x, $order_in->booking_no);
$sheet->setCellValue('C'.$x, $order_in->match_name);
$sheet->setCellValue('D'.$x, $order_in->first_name.' '.$order_in->last_name);
$sheet->setCellValue('E'.$x, $order_in->ticket_type_name);
$sheet->setCellValue('F'.$x, $order_in->quantity);
$sheet->setCellValue('G'.$x, $order_in->currency_type.' '.number_format($order_in->ticket_amount,2));
$sheet->setCellValue('H'.$x, $booking_status);
$x++;
$i++;
}

$sheet->setCellValue('F'.($fcolumn+3), 'Total Paid');
$sheet->setCellValue('G'.($fcolumn+3), $order_data[0]->currency_type.' '.number_format(array_sum($total_payable),2));



//Create file excel.xlsx
$writer = new Xlsx($spreadsheet);
$writer->save(UPLOAD_PATH_PREFIX.'uploads/payout_receipt/payout_'.$payout_id.'.xlsx');
return true;

    }


     public function save_payout_v1(){

      //  echo "<pre>";print_r($_POST);exit;
        $this->form_validation->set_rules('payable_seller', 'Seller', 'required');
        $this->form_validation->set_rules('payment_reference', 'Payment Reference', 'required');
        $this->form_validation->set_rules('payable_order[]', 'Orders', 'required');
        /*if (empty($_FILES['payout_receipt']['name']))
        {
        $this->form_validation->set_rules('payout_receipt', 'payout receipt', 'required');
        }*/

        if ($this->form_validation->run() !== false) { 
           // echo UPLOAD_PATH_PREFIX.'uploads/payout_receipt';exit;
                $pay_out_info = array();
                if (!empty($_FILES['payout_receipt']['name'])) { 

                $config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/payout_receipt';
                $config['allowed_types'] = 'gif|jpg|png|pdf';
                $config['max_size'] = '1000000';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('payout_receipt')) {
               
                $data = $this->upload->data();
                $pay_out_info['receipt'] = $data['file_name'];

                } else {
                $pay_out_info['receipt'] = '';
                }
                }  

            $order_info = array();
            $order_data = array();
            $total_amount = array();
            foreach($_POST['payable_order'] as $orders){

            $where = array('bg_id' => $orders);
            $payable_orders = $this->Accounts_Model->get_unpaid_orders_v2($where);
            if($payable_orders[0]->bg_id != ""){
                $order_info[] = array('bg_id' => $payable_orders[0]->bg_id);
                $order_data[] = $payable_orders[0];
                $total_amount[] = $payable_orders[0]->ticket_amount;
            }
            
            /* if($payable_orders[0]->currency_type == "GBP"){
                    $conversion = 1;
                }
                else if($payable_orders[0]->currency_type == "USD"){
                    $conversion = 1.17;
                }
                else if($payable_orders[0]->currency_type == "EUR"){
                    $conversion = 1.21;
                }
            $total_amount[] = $payable_orders[0]->ticket_amount*$conversion;*/
            }

            
            if(isset($order_info)){
                //$pay_out_info['payout_no'] = rand(10000,10000000);
                $pay_out_info['payout_no'] = $_POST['payment_reference'];
                $pay_out_info['seller_id'] = $_POST['payable_seller'];
               /* $pay_out_info['payout_date_from'] = date('Y-m-d',strtotime($_POST['order_from']));
                $pay_out_info['payout_date_to'] = date('Y-m-d',strtotime($_POST['order_to']));*/
                $pay_out_info['payout_date_from'] = date('Y-m-d');
                $pay_out_info['payout_date_to'] = date('Y-m-d');
                $pay_out_info['payout_orders'] = json_encode($order_info);
                $pay_out_info['total_payable'] = array_sum($total_amount);
                $pay_out_info['currency'] = $payable_orders[0]->currency_type;
                $pay_out_info['total_orders'] = count($order_info);
                $pay_out_info['paid_date_time'] = date('Y-m-d h:i:s');
                $Insert = $this->General_Model->insert_data('payouts', $pay_out_info);
            }
            if($Insert != ''){
                 $saved_proof = $this->save_payout_proof($_POST['payment_reference'],$order_data);
                 foreach($order_info as $order_in){
                    $update_data = array('payout_status' => '1','seller_status' => '1','payout_id' => $Insert);
                    $this->General_Model->update('booking_global', array('bg_id' => $order_in['bg_id']), $update_data);
                 }

                 if($saved_proof == true){
                    $this->send_payout_proof($Insert);
                 }
                 

            }
            $response = array('status' => 1, 'msg' => "Payout Created Successfully.", 'redirect_url' => base_url() . 'accounts/payouts');
              echo json_encode($response);
                exit;

            
        }
        else { 
                $response = array('status' => 0, 'msg' => validation_errors());
                echo json_encode($response);
                exit;
            }

      
    }

    public function send_payout_proof($payout_id){

            $handle = curl_init();
            $url = API_CRON_URL.'send_payout_proof/'.$payout_id;
            curl_setopt($handle, CURLOPT_HTTPHEADER, array(
            'domainkey: https://www.1boxoffice.com/en/'
            ));
            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle, CURLOPT_POST, 1);
            curl_setopt($handle, CURLOPT_POSTFIELDS,
            "email_notify=notify");
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($handle);
            curl_close($handle);
    }
    public function save_payout(){

       // echo "<pre>";print_r($_POST);exit;
        $this->form_validation->set_rules('seller', 'Seller', 'required');
        $this->form_validation->set_rules('order_from', 'Ordered Date From', 'required');
        $this->form_validation->set_rules('order_to', 'Ordered Date To', 'required');
        $this->form_validation->set_rules('orders[]', 'Orders', 'required');
        if (empty($_FILES['payout_receipt']['name']))
        {
        $this->form_validation->set_rules('payout_receipt', 'payout receipt', 'required');
        }

        if ($this->form_validation->run() !== false) { 
                $pay_out_info = array();
                if (!empty($_FILES['payout_receipt']['name'])) { 

                $config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/payout_receipt';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '1000000';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('payout_receipt')) {
               
                $data = $this->upload->data();
                $pay_out_info['receipt'] = $data['file_name'];

                } else {
                $pay_out_info['receipt'] = '';
                }
                }  

            $order_info = array();
            $total_amount = array();
            foreach($_POST['orders'] as $orders){

            $where = array('bg_id' => $orders);
            $payable_orders = $this->Accounts_Model->get_unpaid_orders($where);
            $order_info[] = $payable_orders[0];
            if($payable_orders[0]->currency_type == "GBP"){
                    $conversion = 1;
                }
                else if($payable_orders[0]->currency_type == "USD"){
                    $conversion = 1.17;
                }
                else if($payable_orders[0]->currency_type == "EUR"){
                    $conversion = 1.21;
                }
            $total_amount[] = $payable_orders[0]->ticket_amount*$conversion;
            }

            
            if(isset($order_info)){
                $pay_out_info['payout_no'] = rand(10000,10000000);
                $pay_out_info['seller_id'] = $_POST['seller'];
                $pay_out_info['payout_date_from'] = date('Y-m-d',strtotime($_POST['order_from']));
                $pay_out_info['payout_date_to'] = date('Y-m-d',strtotime($_POST['order_to']));
                $pay_out_info['payout_orders'] = json_encode($order_info);
                $pay_out_info['total_payable'] = array_sum($total_amount);
                $pay_out_info['currency'] = $order_info[0]->base_currency;
                $pay_out_info['total_orders'] = count($order_info);
                $pay_out_info['paid_date_time'] = date('Y-m-d h:i:s');
                $Insert = $this->General_Model->insert_data('payouts', $pay_out_info);
            }
            if($Insert != ''){
                 foreach($order_info as $order_in){
                    $update_data = array('payout_status' => '1');
                    $this->General_Model->update('booking_global', array('bg_id' => $order_in->bg_id), $update_data);
                 }

            }
            $response = array('status' => 1, 'msg' => "Payout Created Successfully.", 'redirect_url' => base_url() . 'accounts/payouts');
              echo json_encode($response);
                exit;

            
        }
        else { 
                $response = array('status' => 0, 'msg' => validation_errors());
                echo json_encode($response);
                exit;
            }

      
    }

    
    public function re_arrange_fee()
    {
        if($_POST['orders'][0] != ''){
            $payable_orders = $this->Accounts_Model->get_unpaid_orders_v1($_POST['orders']);
            $payable_amount = array();
            foreach ($payable_orders as $payable_order) {
               if($payable_order->currency_type == "GBP"){
                    $conversion = 1;
                }
                else if($payable_order->currency_type == "USD"){
                    $conversion = 1.17;
                }
                else if($payable_order->currency_type == "EUR"){
                    $conversion = 1.21;
                }
               $payable_amount[] = $payable_order->ticket_amount*$conversion;
            }
          //  echo "<pre>";print_r($payable_orders);exit;
            
             $this->mydata['payable_orders'] = $payable_orders;
          //  $list_orders = $this->load->view('accounts/make_payouts_ajax', $this->mydata, TRUE);
            $this->mydata['base_currency'] = $payable_orders[0]->base_currency;
            $this->mydata['list_orders'] = $list_orders;
            $this->mydata['payable_amount'] = number_format(array_sum($payable_amount),2);
            echo json_encode(array('status' => 1, 'response' => $this->mydata));
            exit;
        }
      
    }

    public function get_unpayable_orders()
    {
        if($_POST['seller_id'] != ''){

            $where = array('seller_id' => $_POST['seller_id'],'order_from' => $_POST['order_from'],'order_to' => $_POST['order_to']);
            $payable_orders = $this->Accounts_Model->get_unpaid_orders($where);
            $payable_amount = array();
            foreach ($payable_orders as $payable_order) {
                if($payable_order->currency_type == "GBP"){
                    $conversion = 1;
                }
                else if($payable_order->currency_type == "USD"){
                    $conversion = 1.17;
                }
                else if($payable_order->currency_type == "EUR"){
                    $conversion = 1.21;
                }
               // echo "<pre>";print_r($payable_order);exit;;
               $payable_amount[] = $payable_order->ticket_amount * $conversion;
            }
          //  echo "<pre>";print_r($payable_orders);exit;
            
             $this->mydata['payable_orders'] = $payable_orders;
            $list_orders = $this->load->view('accounts/make_payouts_ajax', $this->mydata, TRUE);
            $this->mydata['base_currency'] = $payable_orders[0]->base_currency;
            $this->mydata['list_orders'] = $list_orders;
            $this->mydata['payable_amount'] = number_format(array_sum($payable_amount),2);
            echo json_encode(array('status' => 1, 'response' => $this->mydata));
            exit;
        }
      
    }

    
    public function payable_orders()
    {

    
        if($_POST['payable_orders'][0] != ''){
            $payable_amount = array();

            
		$config["upload_path"] = 'uploads/payout_receipt/';
		$config["allowed_types"] = 'pdf|jpg|jpeg|png';
		$this->load->library('upload',$config);
		$this->upload->initialize($config);

        if ($_FILES["file"]["name"] != '') { 
          //  unlink('uploads/payout_receipt/'.$resultTest->receipt);
			$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $trimmedString = str_replace(' ', '', $_POST['payment_reference']);
			 $_FILES["file"]["name"] = $trimmedString."_".$_FILES["file"]["name"]; //."_".$_FILES["eticket"]["name"]
						
			if (is_file($config["upload_path"].'/'.$_FILES["file"]["name"]) ) {
				$msg= 'Error: File already exists.';
				unlink($config["upload_path"].'/'.$_FILES["file"]["name"]);				
			  } 

				if ($this->upload->do_upload('file')) {
					$data = $this->upload->data();
                    $payout_file_name = $data["file_name"];
					$msg = 'Receipt added successfully.';
				
				} else {
					$error = ['error' => $this->upload->display_errors()];
                    $payout_file_name ="";
                    
					print_r($error);
					exit;
					$msg = $error;
				}
		}

        if (is_string($_POST['payable_orders'])) {
            // The value is a string
            $payable_orders_arr = explode(",", $_POST['payable_orders']);
            $_POST['payable_orders']= $payable_orders_arr;
        }         

        $order_info=[];
           

            foreach ($_POST['payable_orders'] as $payable_order) {
                
                $where = array('bg_id' => $payable_order);
                $payable_orders = $this->Accounts_Model->get_unpaid_orders_v2($where);
                $payable_amount[] = $payable_orders[0]->ticket_amount;

                if($payable_orders[0]->bg_id != ""){
                    $order_info[] = array('bg_id' => $payable_orders[0]->bg_id);
                    $order_data[] = $payable_orders[0];
                    $total_amount[] = $payable_orders[0]->ticket_amount;
                }
            }
           //     $order_info[] = array('bg_id' => $payable_orders[0]->bg_id);
           
            if($payable_orders[0]->currency_type == 'GBP'){
                $currency = '£';
            }
            else if($payable_orders[0]->currency_type == 'USD'){
                $currency = '$';
            }
            else if($payable_orders[0]->currency_type == 'EUR'){
                $currency = '€';
            }
            $this->mydata['base_currency'] = $currency;
        //    $number=number_format(array_sum($payable_amount),2);
            $this->mydata['payable_amount'] =rtrim(number_format(array_sum($payable_amount), 2), '.0'); 

            

            $pay_out_info['payout_no'] = $_POST['payment_reference'];
            $pay_out_info['seller_id'] = $_POST['seller_id'];
            $pay_out_info['payout_date_from'] = date('Y-m-d');
            $pay_out_info['payout_date_to'] = date('Y-m-d');
            $pay_out_info['payout_orders'] = json_encode($order_info);
            $pay_out_info['total_payable'] = $this->mydata['payable_amount'];
            $pay_out_info['currency'] = $payable_orders[0]->currency_type;
            $pay_out_info['total_orders'] = count($order_info);
            $pay_out_info['paid_date_time'] = date('Y-m-d h:i:s');
            $pay_out_info['receipt'] = $payout_file_name;
            $Insert="";
            if(count($order_info)>0)
            {
                $Insert = $this->General_Model->insert_data('payouts', $pay_out_info);

                    $response = array('status' => 1, 'msg' => "Payout Created Successfully.");
                    echo json_encode($response);
            }
            
            if($Insert != ''){
               // $saved_proof = $this->save_payout_proof("",$order_data);
                foreach($order_info as $order_in){
                   $update_data = array('payout_status' => '1','seller_status' => '1');
                   $this->General_Model->update('booking_global', array('bg_id' => $order_in['bg_id']), $update_data);
                }
              

                // if($saved_proof == true){
                //    $this->send_payout_proof($Insert);
                // }
                

             }
             else
             {
                 $response = array('status' => 0, 'msg' => "Payout Failed.");
                 echo json_encode($response);
             }
                //////////////////////////
             
		
                /////////////////////////
           // }
        }
       
         
               exit;
       

            // echo json_encode(array('status' => 1, 'response' => $this->mydata));
            // exit;
        
    } 

    public function total_payable()
    {   
        foreach ($_POST['selectedValues'] as $payable_order) {
          
           
            $where = array('bg_id' => $payable_order);
            $payable_orders = $this->Accounts_Model->get_unpaid_orders_v2($where);
            $payable_amount[]= $payable_orders[0]->ticket_amount;     
            
             if($payable_orders[0]->currency_type == 'GBP'){
                 $currency = '£';
             }
             else if($payable_orders[0]->currency_type == 'USD'){
                 $currency = '$';
             }
             else if($payable_orders[0]->currency_type == 'EUR'){
                 $currency = '€';
             }
        } 
       
             $total_payable_amount= number_format(array_sum($payable_amount),2);
             echo json_encode(array('status' => 1, 'msg' =>  $currency." ".$total_payable_amount));
             exit;
    }
    public function calculate_payable_orders()
    {
       
     
        if($_POST['payable_orders'][0] != ''){

           
             $payable_amount = array();
            foreach ($_POST['payable_orders'] as $payable_order) {
                $where = array('bg_id' => $payable_order);
                $payable_orders = $this->Accounts_Model->get_unpaid_orders_v2($where);
                $payable_amount[] = $payable_orders[0]->ticket_amount;
            } 
            if($payable_orders[0]->currency_type == 'GBP'){
                $currency = '£';
            }
            else if($payable_orders[0]->currency_type == 'USD'){
                $currency = '$';
            }
            else if($payable_orders[0]->currency_type == 'EUR'){
                $currency = '€';
            }
            $this->mydata['base_currency'] = $currency;
            $this->mydata['payable_amount'] = number_format(array_sum($payable_amount),2);
            echo json_encode(array('status' => 1, 'response' => $this->mydata));
            exit;
        }
        else{
            echo json_encode(array('status' => 0, 'response' => "Please Choose any Orders."));
            exit;
        }
      
    }


    public function get_payout_data()
    {
       
        if($_POST['seller'] != ''){

            $where = array('seller_id' => $_POST['seller'],'event_from' => $_POST['event_from'],'event_to' => $_POST['event_to'],'currency' => $_POST['currency']);
            $payable_orders = $this->Accounts_Model->get_unpaid_orders_v2($where);
             $payable_amount = array();
            foreach ($payable_orders as $payable_order) {
               $payable_amount[] = $payable_order->ticket_amount;
            }
            if($payable_orders[0]->currency_type == 'GBP'){
                $currency = '£';
            }
            else if($payable_orders[0]->currency_type == 'USD'){
                $currency = '$';
            }
            else if($payable_orders[0]->currency_type == 'EUR'){
                $currency = '€';
            }
             $this->mydatas['payable_orders'] = $payable_orders;
            $list_orders = $this->load->view(THEME.'accounts/make_payouts_ajax_v1', $this->mydatas, TRUE);
            $this->mydata['base_currency'] = $currency;
            $this->mydata['list_orders'] = $list_orders;
            $this->mydata['payable_amount'] = number_format(array_sum($payable_amount),2);
            echo json_encode(array('status' => 1, 'response' => $this->mydata));
            exit;
        }
        else{
            echo json_encode(array('status' => 0, 'response' => "Please Choose the Mandatory Search Fields."));
            exit;
        }
      
    }
    
    public function make_payouts()
    {
        if ($this->session->userdata('role') == 6) {
            $this->data['sellers']    = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
             $this->load->view('accounts/make_payouts',$this->data);
        }
      
    }

    public function make_payouts_new()
    { 
             
             $this->data['sellers']       = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
             $this->load->view(THEME.'accounts/make_payouts_new',$this->data);
      
    }
    public function payouts()
    {
      //  if ($this->session->userdata('role') == 6) {
             $pending_payout    = $this->Accounts_Model->admin_payout_pending();
             $pending_amount = array();
             foreach($pending_payout as $pending_payouts){
                $pending_amount[] = $pending_payouts->ticket_amount;
             }
             $this->data['pending_amount']    = array_sum($pending_amount);
             $this->data['pending_total_orders']    = count($pending_amount);
             $this->data['payout_histories']    = $this->Accounts_Model->admin_payout_histories();
             $this->load->view(THEME.'accounts/payouts',$this->data);

      /*  }
        else{
             $this->load->view('accounts/payouts');
        }*/
      
    }

    


     public function payout_details($payment_id)
    {

             $this->data['payout_histories']    = $this->Accounts_Model->admin_payout_histories($payment_id);
            $this->load->view(THEME.'accounts/payout_details',$this->data);

            

     
      
    }

    public function delete_uploaded_instructions()
	{
		$payout_id=$_POST['payout_id'];
		$this->db->where(array('payout_id' => $payout_id));
		$query = $this->db->get('payouts');
		$resultTest = $query->row();
		
		if(!empty($resultTest))
		{
			$updateData['receipt'] = "";
			//$updateData['updated_at'] = date("Y-m-d h:i:s");			
			unlink('uploads/payout_receipt/'.$resultTest->receipt);
			$done = $this->General_Model->update_table('payouts', 'payout_id', $resultTest->payout_id, $updateData);
			$msg = 'Payout or Bank Deposit Receipt deleted successfully.';
			$response = array('status' => 1, 'msg' => $msg);				
			echo json_encode($response);
			exit;
		}
	}
    

    public function payout_file()
    {
        $config["upload_path"] = 'uploads/payout_receipt';
		$config['allowed_types'] = 'pdf|jpeg|jpg|png';
		$config['max_size'] = 2048;
		$msg = 'Nothing Updated';
		$payout_id=$_POST['payout_id'];
		$response = array('status' => 1, 'msg' => $msg);
		$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$_FILES["file"]["name"] = "Payout_".$payout_id.'.'.$file_ext ; //."_".$_FILES["eticket"]["name"]

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if ( is_file($config["upload_path"].'/'.$_FILES["file"]["name"])) 
				unlink($config["upload_path"].'/'.$_FILES["file"]["name"]);

		  if (!$this->upload->do_upload('file')) {
			// handle the upload error
			$response = array('error' => $this->upload->display_errors());
			echo json_encode($response);
		  } else {
			// handle the upload success
			//$data = array('upload_data' => $this->upload->data());
			$data=$this->upload->data();
			//echo json_encode($data);
			$payout_file_name = $data["file_name"];

			$this->db->where(array('payout_id' => $payout_id));
					$query = $this->db->get('payouts');
					$resultTest = $query->row();
					//echo $this->db->last_query();
					//exit;
					if (!empty($resultTest)) {		
						$msg = 'Payouts file updated successfully.';									
						$updateData['receipt'] = $payout_file_name;
					//	$updateData['admin_updation_date_time'] = date("Y-m-d h:i:s");
						$done = $this->General_Model->update_table('payouts', 'payout_id', $resultTest->payout_id, $updateData);
						$response = array('status' => 1, 'msg' => $msg);
					}
		  }

		  echo json_encode($response);
		  exit;
    }

     /**
     * Fetch data and display based on the pagination request
     */
    public function loadRecord($rowno = 0, $table, $url, $order_column, $order_by, $view, $variable_name, $type, $search = '')
    { 

        // Load Pagination library
        $this->load->library('pagination');

        // Row per page
        $row_per_page = 10;

        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $row_per_page;
        }

            if($type == "sales_summary"){
            $row_per_page = 10;
            $allcount = $this->General_Model->get_confirmed_orders('', '', '', '', '', $search)->num_rows();
            $record = $this->General_Model->get_confirmed_orders($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
            $current_month_record = $this->General_Model->get_confirmed_orders($rowno, $row_per_page, $order_column, $order_by, array('month_year' => date('Y-m')), $search)->result();
        
            //echo "<pre>";print_r($payment);exit;
        }
        // Pagination Configuration
        $config['base_url'] = base_url() . $url;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $row_per_page;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = ' ';
        $config['next_tag_open'] = '<li><a data-page="next"><i class=" fas fa-angle-right"></a></i>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = ' ';
        $config['prev_tag_open'] = '<li><a data-page="prev"><i class="fas fa-angle-left"></a></i>';
        $config['prev_tag_close'] = '</li>';
        $config['last_link'] = '>>';
        $config['first_link'] = '<<';
        // Initialize
        $this->pagination->initialize($config);

        $this->data['pagination'] = $this->pagination->create_links();
        $this->data[$variable_name] = $record;
        $this->data['current_month_record'] = $current_month_record;
        $this->data['row'] = $rowno;
        $this->data['search'] = $search;//echo "<pre>";print_r($this->data);exit;
        // Load view
        $this->load->view($view, $this->data);
    }


     public function get_matches(){ 
        // POST data 
        $tournament = $this->input->post('tournament');
        $seller = $this->input->post('seller');
        $data = $this->General_Model->get_matches_seller($tournament,$seller);
        echo json_encode($data); 
    }

     public function update_currecny(){ 
        // POST data 
        $tournament = 19;
        $matches = $this->General_Model->get_matches_ajax($tournament);
         //echo "<pre>";print_r($matches);exit;
        foreach($matches as $match){ 
          $match_id = $match->id;//echo $match_id;exit;
           $s_no = $sell_ticket->s_no;
            $insert_data = array('price_type' => 'USD');
            $this->General_Model->update_table('match_info', 'm_id', $match_id, $insert_data);

          /*$sell_tickets = $this->General_Model->getAllItemTable('sell_tickets','match_id',$match_id)->result();
           foreach($sell_tickets as $sell_ticket){
            $s_no = $sell_ticket->s_no;
            $insert_data = array('price_type' => 'USD');
            $this->General_Model->update_table('sell_tickets', 's_no', $s_no, $insert_data);
           }*/
          
               
        }
        echo "Updated";exit;
        echo "<pre>";print_r($data);exit;
        //echo json_encode($data); 
    }


    public function update_match_settings(){ 
        // POST data 
        $tournament = 9;
        $matches = $this->General_Model->get_matches_ajax($tournament);
        //echo "<pre>";print_r($matches);exit;
        foreach($matches as $match){ //echo "<pre>";print_r($match);exit;
            $match_num_rows = $this->General_Model->getid('match_settings',array('matches' => $match->id))->num_rows();
            if($match_num_rows == 0){
            $update_data = array('matches' => $match->id,'sellers' => '36,91,38,201,194,198,199,39,40,193,179,180,35,202,37,207,21,192,108,22,11,25,203,191,32,195,185,200,196,197','partners' => '206,209,12,205','afiliates' => '14','storefronts' => '16,13,1,31,208,26','status' => '1');

            $this->General_Model->insert_data('match_settings', $update_data);//echo "<pre>";print_r($update_data);exit;
            }
            //echo $this->db->last_query();
           // echo 'match_num_rows = '.$match_num_rows;
        /* echo "<pre>";print_r($matches);exit;
          $match_id = $match->id;
           $s_no = $sell_ticket->s_no;
            $insert_data = array('price_type' => 'USD');
            $this->General_Model->update_table('match_info', 'm_id', $match_id, $insert_data);
          */
               
        }
        echo "Updated";exit;
        echo "<pre>";print_r($data);exit;
        //echo json_encode($data); 
    }
  

public function get_all_sales(){

     $getMySalesData = $this->General_Model->get_confirmed_orders_dec('', $where_array,'2022-12-30')->num_rows();echo $getMySalesData;exit;
    $getMySalesData = $this->General_Model->get_confirmed_orders_dec('', $where_array,'2022-12-30')->result();
     if(!empty($getMySalesData)){
        foreach($getMySalesData as $SalesData){
            $bg_id = $SalesData->bg_id;
            if($bg_id != ""){

             $insert_data = array('seller_status' => 1);
             $this->General_Model->update_table('booking_global', 'bg_id', $bg_id, $insert_data);
            }
            
           // echo "<pre>";print_r($SalesData);exit;
        }
        echo "COMPLETED";exit;
     }
}

public function affiliate_sales_summary()
    { 
    //echo "<pre>";print_r($_POST);exit;
      $row_count = $this->uri->segment(4);
      $where_array = array();
        if($_GET['sale_start_date'] != "" && $_GET['sale_end_date'] != ""){
            $where_array['sale_start_date']  = $_GET['sale_start_date'];
            $where_array['sale_end_date']  = $_GET['sale_end_date'];
        }
        if($_GET['sellers'] != ""){
            $where_array['sellers'] = $_GET['sellers'];
        }
        if($_GET['users'] != ""){
            $where_array['users'] = $_GET['users'];
        }
        if($_GET['tournaments'] != ""){
            $where_array['tournaments'] = $_GET['tournaments'];
        }
        if($_GET['match_id'] != ""){
                $where_array['match_id'] = $_GET['match_id'];
        }
        if($_GET['affiliate_id'] != ""){
                $where_array['affiliate_id'] = $_GET['affiliate_id'];
        }
        $where_array['affiliate'] = 1;
          //print_r($where_array);die;

        $getMySalesData = $this->General_Model->get_confirmed_orders('','','', $where_array)->result();
        $getMySalesData_gbp = $this->General_Model->get_confirmed_orders('','','GBP', $where_array)->result();
        $getMySalesData_eur = $this->General_Model->get_confirmed_orders('','','EUR', $where_array)->result();
        $getMySalesData_usd = $this->General_Model->get_confirmed_orders('','','USD', $where_array)->result();
   
        $this->data['getMySalesData_gbp'] = $getMySalesData_gbp;
        $this->data['getMySalesData_eur'] = $getMySalesData_eur;
        $this->data['getMySalesData_usd']     = $getMySalesData_usd;
        $this->data['getMySalesData']     = $getMySalesData;
        $this->data['customers'] = $this->General_Model->get_customers();
        $this->data['sellers'] = $this->General_Model->get_sellers();
        $this->data['tournaments'] = $this->General_Model->get_tournaments();
        $this->data['users_list'] = $this->General_Model->get_user_details(3)->result();


        $this->load->view(THEME.'accounts/affiliate_sales_summary',$this->data);
        // $this->loadRecord($row_count, 'booking_global', 'accounts/sales_summary', '', 'DESC', 'accounts/sales_summary', 'getMySalesData', 'sales_summary', $where_array);
    }

    public function get_tournament_sales_summary()
    { 
      
        $row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
         
        if (!empty($_POST['tournament_ids']) || !empty($_POST['event_start_date']) || !empty($_POST['tournament_ids']) ) {

            $where_array['sale_start_date'] 			= $_POST['event_start_date'];
            $where_array['sale_end_date'] 				= $_POST['event_end_date'];
            $where_array['tournaments'] 				= $_POST['tournament_ids'];
               
            $records =  $this->General_Model->get_tournaments_orders('', $where_array,$rowno, $row_per_page,)->result();;
            $allcount = $this->General_Model->get_tournaments_orders('', $where_array,"", "")->num_rows();

        }
        else {

            $records =  $this->General_Model->get_tournaments_orders('', $where_array,$rowno, $row_per_page,)->result();;
            $allcount = $this->General_Model->get_tournaments_orders('', $where_array,"", "")->num_rows();
            
        }     
        // echo '<pre/>';
        // print_r($records);
        // exit;
        foreach($records as $record ){

            $ticket_total_quality = $this->General_Model->get_total_ticket($record->match_id)->total;

            $total_ticket += $ticket_total_quality + $record->total_quantity ;
            $total_sell_ticket +=  $record->total_quantity;
            $total_reaming_ticket +=  $ticket_total_quality ;

           $tickets_listed= $ticket_total_quality  + $record->total_quantity;

          if($record->currency_type == 'GBP'){
            $currency = '£';
           } 
           if($record->currency_type == 'EUR'){
            $currency = '€';
           } 
            if($record->currency_type == 'USD'){
                $currency = '$';
           } 


           
 $match_time=" <br> <span class='tr_date'>".date('d F Y',strtotime($record->match_date))."</span><br>  <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";
 
 $input = $record->match_name;
               $vsPosition = stripos($input, "vs"); // Find the position of "vs" case-insensitive
               if ($vsPosition === false) {
                   $vsPosition = stripos($input, "Vs"); // Find the position of "Vs" case-insensitive
               }
               if ($vsPosition !== false) {
                   $team1 = trim(substr($input, 0, $vsPosition));
                   $team2 = trim(substr($input, $vsPosition + 2));
                   $match_name = $team1 . " Vs <br/>". $team2;
               } else {
                   $match_name = $input;
               }
$encode_id = base64_encode(json_encode($record->match_id));

            $data[] = array( 
                "tournament_name"			            =>     '<a href="'.base_url().'settings/tournaments/edit/'.$record->tournament_id.'" >'.$record->tournament_name.'</a>',
                "match_name"			                =>      '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.$match_time.'</a>',
                "tickets_listed"			            =>      $tickets_listed,
                "total_quantity"			            =>      $record->total_quantity,
                "ticket_total_quality"			        =>      $ticket_total_quality,
                "amount"		                       	=>      $currency." ".number_format($record->summary_amount,2)
            ); 
        }
        $result = array(
            "draw" => $draw,
              "recordsTotal" => $allcount,
              "recordsFiltered" => $allcount,
              "data" => $data
         );


   echo json_encode($result);
   exit();
       
    }

    public function get_partner_sales_summary()
    { 
        $row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
         $where_array['partner'] = 1;
        if (!empty($_POST['booking_no']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['seller_name']) || !empty($_POST['event']) || !empty($_POST['seat'])) {

            $booking_no 							= $_POST['booking_no'];
            $fromDate 							    = $_POST['event_start_date'];
            $toDate 							    = $_POST['event_end_date'];
            $seller_name 							= $_POST['seller_name'];
            $event_name 							= $_POST['event'];
            $seat 							        = $_POST['seat'];
            $page                                   = 'partner';
    
            $records = $this->General_Model->get_confirmed_orders_search($rowno, $row_per_page,'', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat,$page)->result();
            //$getMySalesData = $this->General_Model->get_confirmed_orders('', $where_array)->result();
            $allcount = $this->General_Model->get_confirmed_orders_search('', '','', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat,$page)->num_rows();

        }
        else {

            $records = $this->General_Model->get_confirmed_orders($rowno, $row_per_page,'', $where_array)->result();
            //$getMySalesData = $this->General_Model->get_confirmed_orders('', $where_array)->result();
            $allcount = $this->General_Model->get_confirmed_orders('', '','', $where_array)->num_rows();
            
        }     
        
        foreach($records as $record ){  
            $match_time=" <br> <span class='tr_date'>".date('d F Y',strtotime($record->match_date))."</span><br>  <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>"; 
            
            $booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';
            $input = $record->match_name;
            $vsPosition = stripos($input, "vs"); // Find the position of "vs" case-insensitive
            if ($vsPosition === false) {
                $vsPosition = stripos($input, "Vs"); // Find the position of "Vs" case-insensitive
            }
            if ($vsPosition !== false) {
                $team1 = trim(substr($input, 0, $vsPosition));
                $team2 = trim(substr($input, $vsPosition + 2));
                $match_name = $team1 . " Vs <br/>". $team2;
            } else {
                $match_name = $input;
            }
            $encode_id = base64_encode(json_encode($record->match_id));

            $transaction_date=date('D j F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date));

            if($record->currency_type == 'GBP'){
                $currency = '£';
            }
            else if($record->currency_type == 'USD'){
                $currency = '$';
            }
            else if($record->currency_type == 'EUR'){
                $currency = '€';
            }
               
            $seller_name='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->seller_first_name." ".$record->seller_last_name.'</a>';

            $customer_name='<a href="'.base_url()."home/customer_info/". $record->user_id.'">'.$record->customer_first_name." ".$record->customer_last_name.'</a>';

            $data[] = array( 
                "booking_no"			=>  $booking_no,  
                "evernt_name"			=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.$match_time.'</a>',
                "seller_name"			=> $seller_name,    
                "customer_name"			=> $customer_name,      
                "transaction_date"      => $transaction_date,
                "partner_name"          => $record->partner_first_name." ".$record->partner_last_name,
                "quantity"              => $record->quantity,
                "partner_fee"           => $currency." ".number_format($record->partner_commission,2),
                "total"                 => $currency." ".number_format($record->total_amount,2)
                                
            ); 
        }
        $result = array(
            "draw" => $draw,
              "recordsTotal" => $allcount,
              "recordsFiltered" => $allcount,
              "data" => $data
         );


   echo json_encode($result);
   exit();
       
    }
    public function get_affiliate_sales_summary()
    { 
        $row_per_page = 5;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
         $where_array['affiliate'] = 1;
        if (!empty($_POST['booking_no']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['seller_name']) || !empty($_POST['event']) || !empty($_POST['seat'])) {

            $booking_no 							= $_POST['booking_no'];
            $fromDate 							    = $_POST['event_start_date'];
            $toDate 							    = $_POST['event_end_date'];
            $seller_name 							= $_POST['seller_name'];
            $event_name 							= $_POST['event'];
            $seat 							        = $_POST['seat'];
            $page                                   = 'affiliate';
    
            $records = $this->General_Model->get_confirmed_orders_search($rowno, $row_per_page,'', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat,$page)->result();
            //echo $this->db->last_query();exit;
            $allcount = $this->General_Model->get_confirmed_orders_search('', '','', $booking_no,$fromDate,$toDate,$seller_name,$event_name,$seat,$page)->num_rows();

        }
        else {

            $records = $this->General_Model->get_confirmed_orders($rowno, $row_per_page,'', $where_array)->result();
         //   $getMySalesData = $this->General_Model->get_confirmed_orders('','','', $where_array)->result();
            $allcount = $this->General_Model->get_confirmed_orders('', '','', $where_array)->num_rows();
            
        }     
        
        foreach($records as $record ){  
            $match_time=" <br> <span class='tr_date'>".date('d F Y',strtotime($record->match_date))."</span><br>  <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>"; 
            
            $booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';
            $input = $record->match_name;
            $vsPosition = stripos($input, "vs"); // Find the position of "vs" case-insensitive
            if ($vsPosition === false) {
                $vsPosition = stripos($input, "Vs"); // Find the position of "Vs" case-insensitive
            }
            if ($vsPosition !== false) {
                $team1 = trim(substr($input, 0, $vsPosition));
                $team2 = trim(substr($input, $vsPosition + 2));
                $match_name = $team1 . " Vs <br/>". $team2;
            } else {
                $match_name = $input;
            }
            $encode_id = base64_encode(json_encode($record->match_id));

            $transaction_date=date('D j F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date));

            if($record->currency_type == 'GBP'){
                $currency = '£';
            }
            else if($record->currency_type == 'USD'){
                $currency = '$';
            }
            else if($record->currency_type == 'EUR'){
                $currency = '€';
            }
               
            $seller_name='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->seller_first_name." ".$record->seller_last_name.'</a>';

            $customer_name='<a href="'.base_url()."home/customer_info/". $record->user_id.'">'.$record->customer_first_name." ".$record->customer_last_name.'</a>';

            $data[] = array( 
                "booking_no"			=>  $booking_no,  
                "evernt_name"			=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.$match_time.'</a>',
                "seller_name"			=> $seller_name,    
                "customer_name"			=> $customer_name,      
                "transaction_date"      => $transaction_date,
                "partner_name"          => $record->affiliate_first_name." ".$record->affiliate_last_name,
                "quantity"              => $record->quantity,
                "partner_fee"           => $currency." ".number_format($record->partner_commission,2),
                "total"                 => $currency." ".number_format($record->total_amount,2)
                                
            ); 
        }
        $result = array(
            "draw" => $draw,
              "recordsTotal" => $allcount,
              "recordsFiltered" => $allcount,
              "data" => $data
         );


   echo json_encode($result);
   exit();
       
    }

   
}
