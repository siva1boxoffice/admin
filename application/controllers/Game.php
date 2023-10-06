<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
// 		ini_set('display_errors', 0);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class Game extends CI_Controller
{
	public function __construct()
	{
		/*
         *  Developed by: Shalini S
         *  Date    : 16 Feb, 2022
         *  1BoxOffice Hub
         *  https://www.1boxoffice.com/
        */
		parent::__construct();
		$this->check_isvalidated();
		$this->load->model('Tixstock_Model');
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

	public function get_status_type(){
		$searchText = strtolower($_POST['search_text']);
		// Perform a database query or some other operation to retrieve the checkbox data based on the search text
		$checkboxData = array('1'=>'abondanned');
		
		$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
		$matches = preg_grep($pattern, $checkboxData);
		
		$html = "";
		
		foreach($matches as $key=>$value ){

			$html .=   ' <div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="status'.$key.'">
			<label class="custom-control-label" for="status'.$key.'">'.strtoupper($value).'</label>
		  </div>';

		}

		echo $html;
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

public function update_tracking_data(){
		
		//echo "<pre>";print_r($_POST);exit;

			if ($_POST['tracking_number'] != "" || $_POST['pod'] != "" || $_FILES["pod_file"]["name"] != '') {

				$tracking_id 		= $_POST['tracking_id'];
				$bg_id 		        = $_POST['bg_id'];

				if($_POST['delivery_provider'] != ""){
					$tracking_data['delivery_provider'] = $_POST['delivery_provider'];
				}
				if($_POST['tracking_number'] != ""){
					$tracking_data['tracking_number'] = $_POST['tracking_number'];
				}
				if($_POST['tracking_link'] != ""){
					$tracking_data['tracking_link'] = $_POST['tracking_link'];
				}
				if($_POST['pod'] != ""){
					$tracking_data['pod'] = $_POST['pod'];
				}

				if($_FILES["pod_file"]["name"] != ""){
					
				$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/pod/';
				$config["allowed_types"] = 'pdf|jpg|jpeg|png';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$ticketId = time();
				$file_ext = pathinfo($_FILES["pod_file"]["name"], PATHINFO_EXTENSION);
				$_FILES["file"]["name"] =  $ticketId .'.'. $file_ext;
				$_FILES["file"]["type"] = $_FILES["pod_file"]["type"];
				$_FILES["file"]["tmp_name"] = $_FILES["pod_file"]["tmp_name"];
				$_FILES["file"]["error"] = $_FILES["pod_file"]["error"];
				$_FILES["file"]["size"] = $_FILES["pod_file"]["size"];
				if ($this->upload->do_upload('file')) {
				$data = $this->upload->data();
				$tracking_data['pod'] = $data["file_name"];
				$tracking_data['pod_status'] = 1;
				}

				}

				$booking_ticket_tracking = $this->General_Model->getAllItemTable('booking_ticket_tracking', 'booking_id', $bg_id)->row();

				if($booking_ticket_tracking->tracking_id == ""){
					
					$tracking_data['booking_id'] = $bg_id;
					$tracking_data['pod_status'] = 1;
					$tracking_id = $this->General_Model->insert_data('booking_ticket_tracking', $tracking_data);
				}

				
				if ($this->General_Model->update_table('booking_ticket_tracking', 'tracking_id', $tracking_id, $tracking_data)) {

						$response = array('msg' => 'Ticket Tracking Details updated Successfully.','status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Ticket Tracking Details.','status' => 0);
					}
					echo json_encode($response);
					exit;
				}
				else{
					$response = array('msg' => 'Failed to update Ticket Tracking Details.','status' => 0);
					echo json_encode($response);
					exit;
				}

	}


	public function update_qr_link(){
		//echo "<pre>";print_r($_POST);exit;

			$this->form_validation->set_rules('qr_link', 'QR Link', 'required');
			$this->form_validation->set_rules('ticket_id', 'Ticket', 'required');

			if ($this->form_validation->run() !== false) {

				$ticketid 		= $_POST['ticket_id'];
				$os 		    = $_POST['os'];
				if($os == "ANDROID"){
					$ticket_data 	= array('qr_link' => $_POST['qr_link'],'ticket_status' => 1);
				}
				else if($os == "IOS"){
					$ticket_data 	= array('qr_link_ios' => $_POST['qr_link'],'ticket_status' => 1);
				}
				
				if ($this->General_Model->update_table('booking_etickets', 'id', $ticketid, $ticket_data)) {

						$response = array('msg' => 'Ticket QR Link updated Successfully.','status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Ticket QR Link.','status' => 0);
					}
					echo json_encode($response);
					exit;
				}
				else{
					$response = array('msg' => 'Failed to update Ticket QR Link.','status' => 0);
					echo json_encode($response);
					exit;
				}

	}
	
	public function get_review_request_status(){

		$searchText = strtolower($_POST['search_text']);
		// Perform a database query or some other operation to retrieve the checkbox data based on the search text
		$checkboxData = array('4'=>'downloaded','2'=>'confirmed','5'=>'shipped','6'=>'delivered');
		
		$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
		$matches = preg_grep($pattern, $checkboxData);
		
		$html = "";
		
		foreach($matches as $key=>$value ){
	
			$html .=  '<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="customCheck'.$key.'">
			<label class="custom-control-label" for="customCheck'.$key.'">'.ucfirst($value).'</label>
		  </div>';
	
		}
	
		echo $html;
	}

	public function get_review_request()
  {
		$row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		
		$rowno = $_POST['start'];
		//$rowno =$this->uri->segment(3);
		
		// if ($rowno != '' && $rowno != 0) {
		// $rowno = ($rowno - 1) ;
		// }
		// else{
		// 	$rowno = 0;			
		// }
		$search=[];
			if(!empty($_POST['booking_no']) || !empty($_POST['event_name']) || !empty($_POST['status_type']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) )
			{
				$search['booking_no']=$_POST['booking_no'];
				$search['event_name']=$_POST['event_name'];

				$search['status_type'] =$_POST['status_type'];
				$search['event_start_date'] =$_POST['event_start_date'];
				$search['event_end_date'] =$_POST['event_end_date'];

				// isset($_POST['status_type']) ?  implode(",", $_POST['status_type']) : '';


				$records = $this->General_Model->getReviewOrders('',$this->uri->segment(4),'',$rowno, $row_per_page,$search)->result();
				$allcount = $this->General_Model->getReviewOrders('',$this->uri->segment(4),'','','',$search)->num_rows();	
			}
			else {
			$records = $this->General_Model->getReviewOrders('',$this->uri->segment(4),'',$rowno, $row_per_page)->result();
			$allcount = $this->General_Model->getReviewOrders('',$this->uri->segment(4))->num_rows();		
			}		
		
		
		$data = [];
// echo '<pre/>';
// print_r($records);
// exit;
		foreach($records as $record ){

			 $delivery_status = "";
			 if($record->payment_date =="")
			 	$payment_date='<div class="not_sent">Not Sent</div>';
			 else
			 	$payment_date=date('D j F Y',strtotime($record->payment_date))."<br/>".date('H:i A',strtotime($record->payment_date));

			$request='<div class="bttns">
			<span class="badge badge-success">Send Request </span>
			</div>';

			$view_url=base_url()."game/orders/details/". md5($record->booking_no);

			$action='<div class="dropdown">
			<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
			   <i class="mdi mdi-dots-vertical fs-sm"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
			   <a href="'.$view_url.'" class="dropdown-item">View</a>
			   <a href="#" class="dropdown-item">Edit Email </a>
			</div>
		 </div>';
	

				
					 if ($record->delivery_status == 1) { 
						$delivery_status ='<div class="bttns">
						<span class="badge badge-success">Confirmed</span>
					  </div>
					  ';
					 } 

					 if ($record->delivery_status == 0) { 
						$delivery_status ='<div class="bttns">
						<span class="badge bg-info">Failed</span>
					  </div>';
					 } 
					 if ($record->delivery_status == 3) { 
						$delivery_status ='<div class="bttns">
						<span class="badge-danger">Cancelled</span>
					  </div>';
					 } 
					
					 if ($record->delivery_status == 4) { 
						$delivery_status ='<div class="bttns">
						<span class="badge bg-info">Shipped</span>
					  </div>';
					 } 
					 if ($record->delivery_status == 5) { 
						$delivery_status ='<div class="bttns">
						<span class="badge bg-warning">Delivered</span>
					  </div>';
					 } 
					 if ($record->delivery_status == 6) { 
						$delivery_status ='<div class="bttns">
						<span class="badge bg-info">Downloaded</span>
					  </div>';
					 } 

					


			if($record->ticket_type == 1) $ticket_type = "Season cards";
				else if($record->ticket_type == 2) $ticket_type = "E-Tickets";
				else if($record->ticket_type == 3) $ticket_type = "Paper";
				else if($record->ticket_type == 4) $ticket_type = "Mobile";
				else $ticket_type = "";

				
				if($record->ticket_block != 0){
					$category= $record->seat_category;
				}
				else{
					$category= "Any";
				}
			
				$match_time="<br/><span class='tr_date'>".date('D j F Y',strtotime($record->match_date))."</span> <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";
				
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

			
				$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

			$data[] = array( 
				"total"				    => '<div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>',	
				"booking_no"			=> $booking_no	,
				"ticket_type"			=> $record->ticket_type	,
				"category"				=> $seat_category	,
				"quantity"				=> $record->quantity	,			
				"ticket_type"			=> $ticket_type	,		
				"event"					=> $match_name.$match_time,
				"order_status"			=> $delivery_status,
				"review_status"			=> '<div class="content">
				<div class="custom-control custom-switch">
				   <input type="checkbox" class="custom-control-input" id="customSwitch3'.$record->bg_id.'">
				   <label class="custom-control-label" for="customSwitch3'.$record->bg_id.'"></label>
				</div>
			 </div>',
				"request_sent_date"		=> $payment_date,
				"request" => $request,
				"action" => $action
				
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
	/**
    * Create from display on this method.
    *
    * @return Response
   */

   public function get_payment_history()
   {
	    $row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		
		$rowno = $_POST['start'];

		if(!empty($_POST['status']) || !empty($_POST['booking_no']) )
		{
			$search['booking_no']=trim($_POST['booking_no']);
			$search['status']=$_POST['status'];
			$records = $this->General_Model->new_payment_history($rowno, $row_per_page,$search)->result();
			$allcount = $this->General_Model->new_payment_history('','',$search)->num_rows();
		} else { 
				
			$records = $this->General_Model->new_payment_history($rowno, $row_per_page,"")->result();
			$allcount = $this->General_Model->new_payment_history()->num_rows();	
					
		}
		// echo '<pre/>';
		// print_r($records);
		// exit;
	$data = [];

			foreach($records as $record ){
				$payment_type="";$currency="";$transaction_date="";$payment_status="";
				if ($record->payment_type == 1) {
					$payment_type= 'Credit/Debit Card';
				} else if ($record->payment_type == 2) {
					$payment_type= "Offline";
				}
				if (strtoupper($record->currency_type) == "GBP") {
					$currency="£";
				}
				if (strtoupper($record->currency_type) == "EUR") { 
					$currency="€";
				}
				if (strtoupper($record->currency_type) != "GBP" && strtoupper($record->currency_type) != "EUR"){
					$currency= strtoupper($record->currency_type); 
				   }

				   //$transaction_date= date("d F Y H:i:s",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->payment_date))).' '.@$_COOKIE["time_zone"];

				   $dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->payment_date)));

				   $timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->payment_date)));

				   $gmtFormatted = @$_COOKIE["time_zone"];

				   $transaction_date= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;

				if ($record->payment_status == 0) {
					$payment_status= '<div class="bttns"><span class="badge badge-danger">Failed</span></div>';
				}
				if ($record->payment_status == 1) {
					$payment_status= '<div class="bttns"><span class="badge badge-success">Success</span></div>';
				}
				if ($record->payment_status == 2) {
					$payment_status= '<div class="bttns"><span class="badge badge-warning">Pending</span></div>';
				}

				

				/*'<a href="echo base_url(); game/orders/payment_details/md5($getMySalesDa->booking_no); "><i class="fas fa-angle-double-right"></i></a> */

				$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

				$action='<div class="dropdown">
			<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
			   <i class="mdi mdi-dots-vertical fs-sm"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
			   <a href="'.base_url()."game/orders/payment_details/". md5($record->booking_no).'" class="dropdown-item">View</a>
			</div>
		 </div>';

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

		 $match_time="<br/><span class='tr_date'>".date('d/m/Y',strtotime($record->match_date))."</span> <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";

		 $encode_id = base64_encode(json_encode($record->match_id));

		 $event_name='<a href="'.base_url()."event/matches/add_match/". $encode_id.'">'.$match_name." ".$match_time.'</a>';

		 $customer_name='<a href="'.base_url()."home/customer_info/". $record->user_id.'">'.$record->first_name." ".$record->last_name.'</a>';

				$data[] = array( 
					"booking_no"			=> $booking_no,	
					"payment_type"			=> $payment_type,
					"email"                 => $record->email,
					"transcation_id"        => $record->transcation_id,
					"total_payment"         => $record->total_payment > 0 ? "$currency " . number_format($record->total_payment, 2) : "" ,
					"transaction_date"      => $transaction_date,
					"payment_status"        => $payment_status,
					"action"                => $action,
					"name"					=> $customer_name,	
					"event"					=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.$match_time.'</a>',

				); 
			}
	 $result = array(
			  "draw" => $draw,
				"recordsTotal" => $allcount,
				"recordsFiltered" => $allcount,
				"data" => $data,
				"limit"=>$rowno.$row_per_page
		   );


	 echo json_encode($result);
	 exit();
   }
  public function get_items()
  {

	
		$row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		
		$rowno = $_POST['start'];
		//$rowno =$this->uri->segment(3);
		
		if ($rowno != '' && $rowno != 0) {
		$rowno = ($rowno - 1) ;
		}
		else{
			$rowno = 0;			
		}

		// echo '<pre/>';
		// print_r($_POST);
		// exit;

			if (!empty($_POST['event']) || !empty($_POST['ticket_category']) || !empty($_POST['stadium']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['ignore_end_date']) || !empty($_POST['seller']) || !empty($_POST['seller_name']) || !empty($_POST['booking_no']) || !empty($_POST['customer_id']) || !empty($_POST['customer_id']) || !empty($_POST['protect']) || !empty($_POST['order_status']) || !empty($_POST['shipping_status']) || !empty($_POST['order_status']) ) {

			//	array_map()
				$event 							= $_POST['event'];
				$ticket_category 		 		= $_POST['ticket_category'];
				$stadium 						= $_POST['stadium'];
				$event_start_date 				= $_POST['event_start_date'];
				$event_end_date 				= $_POST['event_end_date'];
				$ignore_end_date 		 		= $_POST['ignore_end_date'];
				$seller 						= $_POST['seller'];
				//$seller_name 					= $_POST['seller_name'];
				$seller_name					=  isset($_POST['seller_name']) ?  implode(",", $_POST['seller_name']) : '';

				$order_id 						= $_POST['booking_no'];
				$order_status 					= $_POST['order_status'];
				$shipping_status 				= $_POST['shipping_status'];
			//	$order_status 					= $_POST['order_status'];				
				$customer_id 					= $_POST['customer_id'];
				$page 							= $_POST['page'];

				// if(@$customer_id){
				// 		$row_per_page = 500;
				// }
				
				$records = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$order_id,$customer_id,$page,$seller_name,$order_status,$shipping_status,$rowno, $row_per_page)->result();

				$allcount = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$order_id,$customer_id,$page,$seller_name,$order_status,$shipping_status)->num_rows();
//exit;
			} else {  
				if($_POST['page'] == "protect"){
					$flag = "protect";
				}
				else if($_POST['page'] == "api"){
					$flag = "api";
				}
				else if($_POST['page'] == "affiliate"){
					$flag = "affiliate";
				}
				else{
					$flag = "all";
				}
				
				$records = $this->General_Model->getOrders('',$flag,'',$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrders('',$flag)->num_rows();				
			}

				/*echo '<pre/>';
				print_r($records);
				exit;*/
				//$record->stadium_name;
				//$record->country_name;
			$data = [];
			$this->data['sellers'] = $this->General_Model->get_sellers();
			foreach($records as $record ){

				$payment_status="";
				 if ($record->payment_status == 1) {
					$payment_status='<div class="bttns">
										<span class="badge badge-success">Completed</span>
									</div>';
				 } 
				 else if ($record->payment_status == 2) { 
					$payment_status='<div class="bttns">
										<span class="badge badge-warning">Pending</span>
									</div>';
				 } 
				 else if ($record->payment_status == 0) { 
					$payment_status='<div class="bttns">
										<span class="badge badge-danger">Failed</span>
									</div>';
				 } 	
				 else if ($record->payment_status != 0 && $record->payment_status != 1 && $record->payment_status != 2) { 
					$payment_status="Not Initiated";
				 } 	

				 //Shipping Status

				 $delivery_status="";
				 if ($record->delivery_status == 0) {
					$delivery_status='<div class="bttns">
										<span class="badge badge-warning">Tickets Not Uploaded</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 1) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-warning">Tickets In-Review</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 2) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Approved</span>
									</div>';
				 } 	
				 else if ($record->delivery_status == 3) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-danger">Tickets Rejected</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 4) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Downloaded</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 5) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Shipped</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 6) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Delivered</span>
									</div>';
				 } 

				 // End of Shipping Status
				

				 $admin_status="";				
				  if ($record->booking_status == 0) {
					$admin_status='<div class="bttns">
									<span class="badge badge-danger">Failed</span>
								  </div>';
				 }
				 else if ($record->booking_status == 1) {
					$admin_status='<div class="bttns">
									<span class="badge badge-success">Confirmed</span>
								  </div>';
				 }
				 else if ($record->booking_status == 2) {
					$admin_status='<div class="bttns">
									<span class="badge badge-primary">Pending</span>
								  </div>';
				 }
				else if ($record->booking_status == 3) {
					$admin_status='<div class="bttns">
									<span class="badge badge-danger">Cancelled</span>
								  </div>';
				 }
				 else if ($record->booking_status == 4) {
					$admin_status='<div class="bttns">
									<span class="badge badge-warning">Shipped</span>
								  </div>';
				 }
				 else if ($record->booking_status == 5) {
					$admin_status='<div class="bttns">
									<span class="badge badge-warning ">Delivered</span>
								  </div>';
				 }
				 else if ($record->booking_status == 6) {
					$admin_status='<div class="bttns">
									<span class="badge badge-warning ">Downloaded</span>
								  </div>';
				 }

				if($record->ticket_block != 0){
					$category= $record->seat_category;
				}
				else{
					$category= "Any";
				}

				if($record->ticket_type == 1) $ticket_type = "Season cards";
				else if($record->ticket_type == 2) $ticket_type = "E-Tickets";
				else if($record->ticket_type == 3) $ticket_type = "Paper";
				else if($record->ticket_type == 4) $ticket_type = "Mobile";
				else $ticket_type = "";
					
				$price= number_format($record->price,2)." ".strtoupper($record->currency_type); 
				$total= number_format($record->total_amount,2)." ".strtoupper($record->currency_type); 

				$match_time=" <br> <span class='tr_date'>".date('D j F Y',strtotime($record->match_date))."</span><br>  <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";

				// $match_name_inpt=$record->match_name;
				// $match_name_array = explode(" Vs ", $match_name_inpt);
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

				$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

				$delivery_date="";
				// $delivery_date=date('D j F Y',strtotime($record->match_date . ' -3 days'))."<br/>".date('H:i',strtotime($record->match_time));


							/*	$date1 = new DateTime(date('d F Y',strtotime($record->payment_date)).date('H:i',strtotime($record->payment_date)));

								$date2 = new DateTime(date('D j F Y', strtotime($record->match_date )) . date('H:i', strtotime($record->match_time)));

								$diff = $date1->diff($date2);
								$days = $diff->days;

								$delivery_date = "";

								if ($days <= 1) {
									$delivery_date = "Delivery In Due";
								} else {
									$delivery_date = date('D j F Y', strtotime($record->match_date . ' -3 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
								}*/
								$delivery_date = date('D j F Y', strtotime($record->match_date . ' -2 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
								$download_id="";
								//echo "<pre>";print_r($record);exit;
								$encode_id = base64_encode(json_encode($record->match_id));							
if($record->delivery_status != 0)
{
	$download_id=$record->bg_id;
}					
				if($getMySalesDa->ticket_block != 0){
						$block =  $getMySalesDa->block_id;
					}
				else{
						$block = "Any";
				}

				$premium_price= number_format($record->premium_price,2)." ".strtoupper($record->currency_type);
				
				if($_POST['page'] == "protect" || $_POST['page'] == "api" || $_POST['page'] == "affiliate"){


					$data[] = array( 
					"booking_no"			=> $booking_no,
					"event_name"			=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.'</a>'.$match_time,
					"purchase_date"			=> date('d F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date)),
					"qty"					=> $record->quantity,
					"category"				=> $seat_category,
					"block"                 => $block,
					"buyer"					=> $record->customer_first_name." ".$record->customer_last_name,
					"partner"					=> $record->partner_first_name." ".$record->partner_last_name,
					"affiliate"					=> $record->affiliate_first_name." ".$record->affiliate_last_name,
					"payment_status"		=> $payment_status,
					"shipping_status"		=> $delivery_status,
					"premium_price"			=> $premium_price,
					"price"					=> $price,
					"total"					=> $total,
					"view"					=> '<div class="dropdown">
					<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
					<i class="mdi mdi-dots-vertical fs-sm"></i>
				 </a>
				 <div class="dropdown-menu dropdown-menu-right">
					<a href="'.base_url().'game/orders/details/'.md5($record->booking_no).'" class="dropdown-item">View</a>
				 </div>
			  </div>'
					
				);

				}
				else{


				$data[] = array( 
					"booking_no"			=> $booking_no,
					"payment_status"		=> $payment_status,
					"event_name"			=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.'</a>'.$match_time,
					"buyer"					=> $record->customer_first_name." ".$record->customer_last_name,
					"ticket_type"			=> $ticket_type,
					"qty"					=> $record->quantity,
					"category"				=> $seat_category,
					"total"					=> $total,
					"purchase_date"			=> date('d F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date)),
					"seller"				=> $record->seller_first_name." ".$record->seller_last_name,
					"delivery_date"			=> $delivery_date,
					"shipping_status"		=> $delivery_status,
					"admin_status"			=> $admin_status,
					"view"					=> '<div class="dropdown">
					<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
					<i class="mdi mdi-dots-vertical fs-sm"></i>
				 </a>
				 <div class="dropdown-menu dropdown-menu-right">
					<a href="'.base_url().'game/orders/details/'.md5($record->booking_no).'" class="dropdown-item">View</a>
					<a href="#" class="dropdown-item download_e_ticket" data-booking-id="'.$download_id.'">Download </a>
					<a href="'.base_url().'game/orders/upload_e_ticket/'.md5($record->booking_no).'" class="dropdown-item">Upload </a>
					<a href="#" class="dropdown-item">Replace </a>
				 </div>
			  </div>'
					
				); 
				}
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

  public function get_abondanned_items()
  {	
		$row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		
		$rowno = $_POST['start'];
		//$rowno =$this->uri->segment(3);
		
		if ($rowno != '' && $rowno != 0) {
		$rowno = ($rowno - 1) ;
		}
		else{
			$rowno = 0;			
		}
		$data = [];
		if (!empty($_POST['start_date']) || !empty($_POST['end_date']) || !empty($_POST['event_name']) || !empty($_POST['seller_name'])|| !empty($_POST['country']) ) {
			
			$start_date 		= $_POST['start_date'];
			$end_date 			= $_POST['end_date'];
			$event_name			= $_POST['event_name'];
			$seller_name		= $_POST['seller_name'];
			$country			=  isset($_POST['country']) ?  implode("', '", $_POST['country']) : '';
			
			$records = $this->General_Model->abondanedSearch('',$rowno, $row_per_page,'upcoming',$start_date,$end_date,$event_name,$seller_name,$country)->result();
			$allcount = $this->General_Model->abondanedSearch('','', '','upcoming',$start_date,$end_date,$event_name,$seller_name,$country)->num_rows();

		}
		else {
			$allcount = $this->General_Model->abondaned('','', '','upcoming')->num_rows();
			$records = $this->General_Model->abondaned('',$rowno, $row_per_page,'upcoming')->result();
		}

		// echo '<pre/>';
		// print_r($records);
		// exit;
		foreach($records as $record ){

		//	$match_time=" <br> <span class='tr_date'>".date('d F Y',strtotime($record->match_date))."</span><br>  <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";


				$match_time="<br/><span class='tr_date'>".date('d/m/Y',strtotime($record->match_date))."</span> <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";
				
				$match_details=$record->country_name.", ".$record->city_name;
				
			$total= strtoupper($record->currency_type)." ".number_format($record->total_amount,2);
			//." ".strtoupper($record->currency_type); 

			
			// $date = new DateTime($record->updated_at, new DateTimeZone('GMT+05:30'));
			// $dateFormatted = $date->format('d F Y');
			// $timeFormatted = $date->format('H:i:s');
			// $gmtFormatted = $date->format('\G\M\TP');

			$dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->updated_at)));

			$timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->updated_at)));

			$gmtFormatted = @$_COOKIE["time_zone"];

			$abnd_date= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;

			$view_url=base_url()."game/orders/abondaned_details/".md5($record->booking_no);

			$action='<div class="dropdown">
			<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
			   <i class="mdi mdi-dots-vertical fs-sm"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
			   <a href="'.$view_url.'" class="dropdown-item">View</a>
			</div>
		 </div>';

		
			
		 $booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

			$data[] = array( 
				"booking_no"			=> $booking_no,
				"event_name"			=> $record->match_name."<br/>".$match_details.$match_time,
				"buyer"					=> $record->customer_first_name." ".$record->customer_last_name,
				"country"				=> $record->customer_country_name,
				"qty"					=> $record->quantity,
				"total"					=>  $total,
				"abnd_date"				=>  $abnd_date,
				"status"				=> '<div class="bttns">
												<span class="badge badge-danger">Abondanned</span>
											</div>',
				"action"				=>  $action,
				
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
	public function app_data()
	{
		$this->data['app_name'] = $this->app_name;
		$this->data['app_login_image'] = $this->app_login_image;
		$this->data['app_title'] = $this->app_title;
		$this->data['general_path'] = $this->general_path;
		$this->data['app_favicon'] = $this->app_favicon;
		$this->data['login_image'] = $this->login_image;
		$this->data['logo'] = $this->logo;
		$this->data['languages'] = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
		$this->data['branches'] = $this->General_Model->get_admin_details_by_role(4,'ACTIVE');
		if ($this->session->userdata('storefront')->company_name == '') {
				$branches = $this->General_Model->get_admin_details(13);
				$sessionUserInfo = array('storefront' => $branches);
				$this->session->set_userdata($sessionUserInfo);
			/*$sessionUserInfo = array('storefront' => $this->data['branches'][count($this->data['branches']) - 1]);*/
		}
		return $this->data;
	}


	/**
	 * @desc Gane category related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function category()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add_category') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_cat_id = $segment4;
				$this->data['category_details'] = $this->General_Model->get_game_category_data($edit_cat_id)->row();
			}
			$this->load->view(THEME.'game/add_category', $this->data);
		} else if ($segment == 'list_category') {
			$row_count = $this->uri->segment(4);
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchc" => $search_text));
			} else {
				if ($this->session->userdata('searchc') != NULL) {
					$search_text = $this->session->userdata('searchc');
				}
			}
			//$this->loadRecord($row_count, 'game_category', 'game/category/list_category', 'id', 'DESC', 'game/category_list', 'categories', 'gamecategory', $search_text);
			$this->load->view(THEME.'game/category_list', $this->data);

		} else if ($segment == 'delete_category') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('game_category', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('game_category_lang', 'game_cat_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Game category deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting game category.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_category') {
			$this->form_validation->set_rules('category_name', 'Category Name', 'required');
			$this->form_validation->set_rules('status', 'Category Status', 'required');

			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'category_name' => $_POST['category_name'],
					'status' => $_POST['status'],
					'add_by' => $this->session->userdata('admin_id'),
					'create_date' => date("Y-m-d H:i:s")
				);
				if ($_POST['category_id'] == '') {
					$inserted_id = $this->General_Model->insert_data('game_category', $insert_data);
					if ($inserted_id) {
						$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
						foreach ($lang as $key => $l_code) {
							$language_data = array(
								'language' =>  $l_code->language_code,
								'game_cat_id' => $inserted_id,
								'category_name' => $_POST['category_name']
							);
							$this->General_Model->insert_data('game_category_lang', $language_data);
						}
						$response = array('msg' => 'New Game Category Created Successfully.', 'redirect_url' => base_url() . 'game/category/list_category', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to create new game category.', 'redirect_url' => base_url() . 'game/category/add_category', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$category_id = $_POST['category_id'];

					if ($this->General_Model->update_table('game_category', 'id', $category_id, $insert_data)) {
						$language_data = array(
							'category_name' => $_POST['category_name']
						);
						$this->General_Model->update('game_category_lang', array('game_cat_id' => $category_id, 'language' => $this->session->userdata('language_code')), $language_data);

						$response = array('msg' => 'Game category details updated Successfully.', 'redirect_url' => base_url() . 'game/category/list_category', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update game category details.', 'redirect_url' => base_url() . 'game/category/add_category/' . $category_id, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'game/category/add_category', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	/**
	 * Получение IP пользователя
	 * 
	 * @return string
	 */
	public function getUserIP()
	{
		$client = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote = $_SERVER['REMOTE_ADDR'];

		if (filter_var($client, FILTER_VALIDATE_IP)) {
			$ip = $client;
		} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
			$ip = $forward;
		} else {
			$ip = $remote;
		}

		return $ip;
	}

	public function saveNominee()
	{		
		
		$msg = '';
		$ticketId = $this->input->post('ticket_id');
		$bookingId = $this->input->post('booking_id');
		$bookingNo = $this->input->post('booking_no');
		$count=0;
		if ($_POST["first_name"][0] != '') {
			//for ($count = 0; $count < count($_POST["first_name"]); $count++) {
				$this->db->where(array('ticket_id' => $ticketId, 'booking_id' => $bookingId));
			//	$this->db->where('first_name IS NULL', null, false);
			$this->db->where("(first_name IS NULL OR first_name = '')", NULL, FALSE);
				$this->db->limit(1);
				$query = $this->db->get('booking_etickets');
		//	echo $this->db->last_query();exit;
				
				$resultTest = $query->row();
				
				if (!empty($resultTest)) {
					$updateData['first_name'] 				= $_POST["first_name"][$count];
					$updateData['last_name'] 				= $_POST["last_name"][$count];
					$updateData['nationality'] 				= $_POST["nationality"][$count];
					$updateData['email']					= @$_POST["email"][$count];
					$updateData['dob'] 						= $_POST["dob"][$count];
					//$updateData['attendee_updated_date']    = $_POST["attendee_updated_date"][$count];			

					$this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);

					$updateData['id']						=$resultTest->id;
					$updateData['dob'] 						= $_POST["dob"][$count];

					if($_POST["dob"][$count]!="")
					{
						$dateStr = $_POST["dob"][$count]; 
						$timestamp = strtotime($dateStr);
						$updateData['dob'] 	 = date('d F Y', $timestamp);
					}
					$response = array('status' => 1, 'msg' => 'Nominee added successfully.' . $msg, 'redirect_url' => base_url() . 'game/orders/details/' . md5($bookingNo),"nominee_details"=>$updateData);
				}
				else
				{
					$response = array('status' => 0, 'msg' => 'Nominee not added.');
				}
			//}			
		}
		
		echo json_encode($response);
		exit;
	}
	
	public function updateNominee()
	{
		$eticketId = $this->input->post('eticket_id');
		$count=0;
		if ($_POST["first_name"][0] != '') {
				$this->db->where(array('id' => $eticketId));
				$this->db->limit(1);
				$query = $this->db->get('booking_etickets');
			//	echo $this->db->last_query();exit;				
				$resultTest = $query->row();
				
				if (!empty($resultTest)) {

					$updateData['first_name'] 				= $_POST["first_name"][$count];
					$updateData['last_name'] 				= $_POST["last_name"][$count];
					$updateData['nationality'] 				= $_POST["nationality"][$count];
					$updateData['email']					= @$_POST["email"][$count];
					$updateData['dob'] 						= $_POST["dob"][$count];
					//$updateData['attendee_updated_date']    = $_POST["attendee_updated_date"][$count];
					
					$this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);
					
					$updateData['id']=$resultTest->id;
					if($_POST["dob"][$count]!="")
					{
						$dateStr = $_POST["dob"][$count]; 
						$timestamp = strtotime($dateStr);
						$updateData['dob'] 	 = date('d F Y', $timestamp);
					}

					$response = array('status' => 1, 'msg' => 'Nominee updated successfully.', "nominee_details"=>$updateData);
				}
				else{
					$response = array('status' => 0, 'msg' => 'Nominee not Updated.');
				}
		}
	
		
	
		echo json_encode($response);
		exit;
	}


	public function upload_single_ticket()
	{ //echo "<pre>";print_r($_POST);exit;
		$msg = '';
		$ticketId = $_POST['ticketid'];
		$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/e_tickets/';
		$config["allowed_types"] = 'pdf';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($_FILES["eticket"]["name"] != '') { 
			$file_ext = pathinfo($_FILES["eticket"]["name"], PATHINFO_EXTENSION);
			$_FILES["file"]["name"] =  $ticketId .'.'. $file_ext;
			$_FILES["file"]["type"] = $_FILES["eticket"]["type"];
			$_FILES["file"]["tmp_name"] = $_FILES["eticket"]["tmp_name"];
			$_FILES["file"]["error"] = $_FILES["eticket"]["error"];
			$_FILES["file"]["size"] = $_FILES["eticket"]["size"];

			
				if ($this->upload->do_upload('file')) {
					$data = $this->upload->data();
					//$insertData['ticket_file'] = $data["file_name"];
					$this->db->where(array('ticketid' => $ticketId));
					$query = $this->db->get('booking_etickets');
					$resultTest = $query->row();
					$bookingId  = $resultTest->booking_id;
					//echo "<pre>";print_r($resultTest);exit;
					if (!empty($resultTest)) {
						unlink(UPLOAD_PATH.'uploads/e_tickets/' . $resultTest->ticket_file);
						$updateData['ticket_file'] = $data["file_name"];
						$updateData['ticket_upload_date'] = date("Y-m-d h:i:s");
						$updateData['ticket_status'] = 1;
						$done = $this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);
					}

					if($done == true){

					$status = '1';
					$updateData = array('delivery_status' => $status);
					$cond = array('bg_id' => $bookingId);
					$this->General_Model->update('booking_global', $cond, $updateData);
					$msg = 'E-tickets added successfully.';
					}
				} else {
					$msg = 'Failed to add e-ticket';
				}

		}

		$response = array('status' => 1, 'msg' => $msg);
		echo json_encode($response);
		exit;
	}

	public function delete_upload_single_ticket()
	{
		$ticketid=$_POST['ticket_id'];
		$this->db->where(array('ticketid' => $ticketid));
		$query = $this->db->get('booking_etickets');
		$resultTest = $query->row();
		
		if(!empty($resultTest))
		{
			$updateData['ticket_file'] = "";
			$updateData['ticket_upload_date'] = date("Y-m-d h:i:s");
			$updateData['ticket_status'] = 0;
			unlink('uploads/e_tickets/'.$resultTest->ticket_file);
			$done = $this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);
			$msg = 'E-tickets deleted successfully.';
			$response = array('status' => 1, 'msg' => $msg);				
			echo json_encode($response);
			exit;
		}
	}

	public function delete_uploaded_instructions()
	{
		$ticketid=$_POST['ticket_id'];
		$this->db->where(array('booking_no' => $ticketid));
		$query = $this->db->get('booking_global');
		$resultTest = $query->row();
		
		if(!empty($resultTest))
		{
			$updateData['instruction_file'] = "";
			$updateData['updated_at'] = date("Y-m-d h:i:s");			
			unlink('uploads/ticket_instruction/'.$resultTest->ticket_instruction);
			$done = $this->General_Model->update_table('booking_global', 'booking_no', $resultTest->booking_no, $updateData);
			$msg = 'Uploaded Instructions deleted successfully.';
			$response = array('status' => 1, 'msg' => $msg);				
			echo json_encode($response);
			exit;
		}
	}

	

	public function save_upload_single_ticket()
	{
		//echo "<pre>";print_r($_POST);exit;
		$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/e_tickets';
		$config["destination_dir"] = UPLOAD_PATH_PREFIX.'uploads/e_tickets/temp';
		$config["allowed_types"] = 'pdf|jpg|jpeg|png';
		$ticketId="";
		$msg = 'Nothing Updated';
		$response = array('status' => 1, 'msg' => $msg);

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		foreach($_POST as $file_name){
			// echo $file_name;
			// exit;

			if (file_exists($config["destination_dir"]."/".$file_name)) {
			
			if (file_exists($config["upload_path"]."/".$file_name)) {
				unlink($config["upload_path"]."/".$file_name);
			}
			//$ticketId=explode("_",$file_name);
			$ticketId=$file_name;
			//echo "<pre>";print_r($ticketId[0]);exit;
			// Attempt to move the file
			if (rename($config["destination_dir"]."/".$file_name, $config["upload_path"]."/".$file_name)) {
				$filename_without_extension = pathinfo($ticketId, PATHINFO_FILENAME);
					$this->db->where(array('ticketid' => $filename_without_extension));
					$query = $this->db->get('booking_etickets');
					$resultTest = $query->row();
					$bookingId  = $resultTest->booking_id;
					//echo $this->db->last_query();exit;
					if (!empty($resultTest)) {
						
						$updateData['ticket_file'] = $file_name;
						$updateData['ticket_upload_date'] = date("Y-m-d h:i:s");
						$updateData['ticket_status'] = 1;
						$done = $this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);
						$msg = 'E-tickets added successfully.';
						$response = array('status' => 1, 'msg' => $msg);						
					}	
									
				} 
			}

		  }

		  echo json_encode($response);
		  exit;
		
	}

	public function save_ticket_instruction()
	{
		//echo "<pre>";print_r($_POST);exit;
		//$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/ticket_instruction';
		$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/e_tickets';
		//$config["destination_dir"] = 'uploads/e_tickets/temp';
		$config['allowed_types'] = 'pdf|jpeg|jpg|png';
		$config['max_size'] = 2048;
		$msg = 'Nothing Updated';
		$booking_no=$_POST['booking_id'];
		$response = array('status' => 1, 'msg' => $msg);
		$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$_FILES["file"]["name"] = $booking_no.'.'.$file_ext ; //."_".$_FILES["eticket"]["name"]

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
			$instruction_file_name = $data["file_name"];

			$this->db->where(array('booking_no' => $booking_no));
					$query = $this->db->get('booking_global');
					$resultTest = $query->row();
					//echo $this->db->last_query();
					//exit;
					if (!empty($resultTest)) {		
						$msg = 'Ticket instruction file updated successfully.';									
						$updateData['instruction_file'] = $instruction_file_name;
						$updateData['updated_at'] = date("Y-m-d h:i:s");
						$done = $this->General_Model->update_table('booking_global', 'booking_no', $resultTest->booking_no, $updateData);
						$response = array('status' => 1, 'msg' => $msg);
					}
		  }

		  echo json_encode($response);
		  exit;
	}	

	public function upload_single_ticket_temp()
	{ 
	//	echo "<pre>";print_r($_POST);exit;
		$msg = '';
		$temp_file_name="";
		$show_file_name="";
		$delete_ticket_id="";
		$ticketId = $_POST['data_ticket_id'];
		$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/e_tickets/temp';
		$config["allowed_types"] = 'pdf|jpg|jpeg|png';
		$config["data_ticket_id"] = $_POST['data_ticket_id'];
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		//echo $config["upload_path"];exit;
		// echo '<pre/>';
		// print_r($_FILES);
		// exit;
		if ($_FILES["eticket"]["name"] != '') { 
			$file_ext = pathinfo($_FILES["eticket"]["name"], PATHINFO_EXTENSION);
			$_FILES["file"]["name"] = $config["data_ticket_id"].'.'.$file_ext ; //."_".$_FILES["eticket"]["name"]
			$_FILES["file"]["type"] = $_FILES["eticket"]["type"];
			$_FILES["file"]["tmp_name"] = $_FILES["eticket"]["tmp_name"];
			$_FILES["file"]["error"] = $_FILES["eticket"]["error"];
			$_FILES["file"]["size"] = $_FILES["eticket"]["size"];
			//UPLOAD_PATH.'uploads/e_tickets/' . $resultTest->ticket_file
			// echo '<pre/>';
			// print_r($_FILES["file"]);
			// exit;
			// Get the file name from the uploaded file


			if (is_file($config["upload_path"].'/'.$_FILES["eticket"]["name"]) || is_file($config["upload_path"].'/'.$_FILES["file"]["name"])) {
				$msg= 'Error: File already exists.';
			//  echo base_url().$config["upload_path"].'/'.$_FILES["eticket"]["name"];
			//  echo "<br/>";
			//  echo $config["upload_path"].'/'.$_FILES["file"]["name"];
				unlink($config["upload_path"].'/'.$_FILES["eticket"]["name"]);
				unlink($config["upload_path"].'/'.$_FILES["file"]["name"]);
				
			  } 
			//   echo $config["upload_path"].'/'.$_FILES["file"]["name"];
			//   exit;
				if ($this->upload->do_upload('file')) {
					$data = $this->upload->data();
					$msg = 'E-tickets added successfully.';
					// echo '<pre/>';
					// print_r($data['file_name']);
					// exit;
					$temp_file_name= TICKET_UPLOAD_PATH."uploads/e_tickets/temp/".$data['file_name'];
					$show_file_name=$data['file_name'];
					//$insertData['ticket_file'] = $data['file_name'];
					// $this->db->where(array('ticketid' => $ticketId));
					// $query = $this->db->get('booking_etickets');
					// $resultTest = $query->row();
					// $bookingId  = $resultTest->booking_id;
					// $delete_ticket_id=$resultTest->ticketid;
					//echo "<pre>";print_r($resultTest);exit;
					/*if (!empty($resultTest)) {
					//	unlink(UPLOAD_PATH.'uploads/e_tickets/' . $resultTest->ticket_file);
						$updateData['ticket_file'] = $data['file_name'];
						$updateData['ticket_upload_date'] = date("Y-m-d h:i:s");
						$updateData['ticket_status'] = 1;
						$done = $this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);
					}

					if($done == true){

					// $status = '1';
					// $updateData = array('delivery_status' => $status);
					// $cond = array('bg_id' => $bookingId);
				//	$this->General_Model->update('booking_global', $cond, $updateData);
					$msg = 'E-tickets added successfully.';
					}*/
				} else {
					$error = ['error' => $this->upload->display_errors()];
					echo '<pre/>';
					print_r($error);
					exit;
					$msg = $error;
				}
			

		}

		$response = array('status' => 1, 'msg' => $msg,'temp_file_name'=>$temp_file_name,'show_file_name'=>$show_file_name,'delete_ticket_id'=>$delete_ticket_id);
		echo json_encode($response);
		exit;
	}
public function multiple_upload_tickets()
{	

   // Retrieve the ticket ID array as a JSON string
   $ticketIdJson = $_POST['data_ticket_id'];

   // Convert the JSON string back to a PHP array
   $ticketIdArray = json_decode($ticketIdJson);


		$uploadDir = "uploads/e_tickets/temp";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

   // $config['upload_path']   = $uploadDir;
    $config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/e_tickets/temp';
    $config["allowed_types"] = 'pdf|jpg|jpeg|png'; 
    $config['max_size']      = 10240; 
    $config['overwrite']     = FALSE; // Set to TRUE if you want to overwrite existing files

    $this->load->library('upload', $config);

    $files = $_FILES['files'];

    $uploaded_files = array();

    foreach ($files['name'] as $key => $filename) {

		  $file_ext = pathinfo($files['name'][$key], PATHINFO_EXTENSION);
		$_FILES["files"]["name"] = $ticketIdArray[$key].'.'.$file_ext ; //."_".$_FILES["eticket"]["name"]
        //$_FILES['files']['name'] = $files['name'][$key];
        $_FILES['files']['type'] = $files['type'][$key];
        $_FILES['files']['tmp_name'] = $files['tmp_name'][$key];
        $_FILES['files']['error'] = $files['error'][$key];
        $_FILES['files']['size'] = $files['size'][$key];


		if (is_file($config["upload_path"].'/'.$_FILES["files"]["name"])) {
			unlink($config["upload_path"].'/'.$_FILES["files"]["name"]);
		  } 

        if ($this->upload->do_upload('files')) { echo "if";exit;
           $response_file_ame = $this->upload->data('file_name');
		   $uploaded_files[]=$response_file_ame;
		   $temp_file_name[]= TICKET_UPLOAD_PATH."uploads/e_tickets/temp/".$response_file_ame;
		   $delete_ticket_id[]= $ticketIdArray[$key];
        } else { echo "else";exit;
            $error = array('error' => $this->upload->display_errors());
            return; // Stop processing if any file upload fails
        }
    }

    if (!empty($uploaded_files)) {
        // Process uploaded files or save their names to a database, for example
	   $response = array('status' => 1, 'msg' => 'Files uploaded successfully','show_file_name'=>$uploaded_files,'temp_file_name'=>$temp_file_name,'delete_ticket_id'=>$delete_ticket_id);
		echo json_encode($response);
		exit;
    }
}
	public function saveEticket()
	{
		$msg = '';
		$ticketId = $this->input->post('ticket_id');
		$bookingId = $this->input->post('booking_id');
		$bookingNo = $this->input->post('booking_no');
		$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/e_tickets/';
		$config["allowed_types"] = 'pdf';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($_FILES["eticket"]["name"] != '') {
			for ($count = 0; $count < count($_FILES["eticket"]["name"]); $count++) {
				$insertData = array();
				$_FILES["file"]["name"] =  time() . $_FILES["eticket"]["name"][$count];
				$_FILES["file"]["type"] = $_FILES["eticket"]["type"][$count];
				$_FILES["file"]["tmp_name"] = $_FILES["eticket"]["tmp_name"][$count];
				$_FILES["file"]["error"] = $_FILES["eticket"]["error"][$count];
				$_FILES["file"]["size"] = $_FILES["eticket"]["size"][$count];
				$insertData['booking_id'] = $bookingId;
				$insertData['ticket_id'] = $ticketId;
				$insertData['serial'] = $count + 1;

				if ($this->upload->do_upload('file')) {
					$data = $this->upload->data();
					$insertData['ticket_file'] = $data["file_name"];
					$this->db->where(array('ticket_id' => $ticketId, 'booking_id' => $bookingId, 'serial' => $count + 1));
					$query = $this->db->get('booking_etickets');
					$resultTest = $query->row();
					if (!empty($resultTest)) {
						unlink(UPLOAD_PATH.'uploads/e_tickets/' . $resultTest->ticket_file);
						$updateData['ticket_file'] = $data["file_name"];
						$updateData['ticket_upload_date'] = date("Y-m-d h:i:s");
						$updateData['ticket_status'] = 1;
						$done = $this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);
					} else {

						$done =  $this->General_Model->insert_data('booking_etickets', $insertData);
						if($done != ''){
							$done = true;
						}
					}

					if($done == true){

					$status = '1';
					$updateData = array('delivery_status' => $status);
					$cond = array('bg_id' => $bookingId);
					$this->General_Model->update('booking_global', $cond, $updateData);

					}
				} else {
					$msg .= 'Failed to add e-ticket #' . intval(intval($count) + 1);
				}
			}
		}

		$response = array('status' => 1, 'msg' => 'E-tickets added successfully.' . $msg, 'redirect_url' => base_url() . '/game/orders/details/' . md5($bookingNo));
		echo json_encode($response);
		exit;
	}





function get_update_data_oneclicket($category) {
	
	if($category['id'] != ""){

		$exists = 		$this->General_Model->getAllItemTable_Array('oneclicket_categories', array('category_id' => $category['id']))->num_rows();
		if($exists == 0){
			$oneclicket_categories['parent_category_id'] = $category['parent_id'];
			$oneclicket_categories['category']       	   = $category['name'];
			$oneclicket_categories['category_id']        = $category['id'];
			$oneclicket_categories['status']        = 1;
			$oneclicket_insert_id                        =  $this->General_Model->insert_data('oneclicket_categories',$oneclicket_categories);
		}

	}
	return true;
}	
function get_update_data($a,$b=1) {
  if (!is_array($a['children'][0])) {
  	//echo "$b <pre>";print_r($a);exit;
$exists = 		$this->General_Model->getAllItemTable_Array('tixstock_categories', array('category_id' => $a['id']))->num_rows();
if($exists == 0){
$tixstock_categories['parent_category_id'] = $a['parent']['id'];
$tixstock_categories['category']       	   = $a['name'];
$tixstock_categories['category_id']        = $a['id'];
$category_insert_id                        =  $this->General_Model->insert_data('tixstock_categories',$tixstock_categories);
}

    return $a;
  }
  else{
//echo $a['name'];echo "<br>";
  	$exists = 		$this->General_Model->getAllItemTable_Array('tixstock_categories', array('category_id' => $a['id']))->num_rows();
if($exists == 0){
$tixstock_categories['parent_category_id'] = $a['parent']['id'];
$tixstock_categories['category']       	   = $a['name'];
$tixstock_categories['category_id']        = $a['id'];
$category_insert_id                        =  $this->General_Model->insert_data('tixstock_categories',$tixstock_categories);
}

  }
  
  foreach($a['children'] as $v) {  
  	$v['parent']['id'] = $a['id'];
  //	echo "<pre>";print_r($v);exit;
    $d = $this->get_update_data($v,2);
  }
}

public function update_events_old()
	{
		
		$category_josn  = fopen("uploads/category/category.json",'r');
		$categories 	= fread ($category_josn,filesize("uploads/category/category.json"));
		$category_data  = json_decode($categories,1);
		$formated_data  = array();
		$category_array = array();
		if(!empty($category_data['data'])){
			$i = 0;
			foreach($category_data['data'] as $category){

				$this->get_update_data($category);
				
			}
			
		}
		
		fclose ($category_josn);

		$oneclicket_category_josn  = fopen("uploads/category/category_oneclicket.json",'r');
		$oneclicket_categories 	= fread ($oneclicket_category_josn,filesize("uploads/category/category_oneclicket.json"));
		$oneclicket_category_data  = json_decode($oneclicket_categories,1);
		$oneclicket_formated_data  = array();
		$oneclicket_category_array = array();
		if(!empty($oneclicket_category_data['data'])){
			$i = 0;
			foreach($oneclicket_category_data['data'] as $category){

				$this->get_update_data_oneclicket($category);
				
			}
			
		}
		
		fclose ($oneclicket_category_josn);

		$this->data['categories'] = 		$this->General_Model->getAllItemTable_Array('tixstock_categories', array('parent_category_id' => NULL))->result();
		$this->data['teams'] = 		$this->General_Model->getAllItemTable_Array('api_teams')->result();
		$this->data['oneclicket_categories'] = 		$this->General_Model->getAllItemTable_Array('oneclicket_categories', array('parent_category_id' => NULL))->result();

	$api_parent_categories = array_merge($this->data['categories'],$this->data['oneclicket_categories']);
	//echo "<pre>";print_r($api_parent_categories);exit;
   foreach($api_parent_categories as $categories ){

       $html .=   ' <div class="custom-control custom-checkbox">
       <input type="checkbox" class="custom-control-input parent_category " name="parent_category[]" id="customCheck'.$categories->category_id.'">
       <label class="custom-control-label" for="customCheck'.$categories->category_id.'">'.$categories->category.'</label>
     </div>';

   }

$this->data['parent_categories'] = $html;

foreach($this->data['teams'] as $teams ){

       $teamshtml .=   ' <div class="custom-control custom-checkbox">
       <input type="checkbox" class="custom-control-input teams" id="customCheck'.$teams->team_name.'" name="teams[]">
       <label class="custom-control-label" for="customCheck'.$teams->team_name.'">'.$teams->team_name.'</label>
     </div>';

   }

$this->data['teams'] = $teamshtml;

		//echo $this->db->last_query();exit;
		//$this->db->where(array('archived' => NULL));
		$this->data['apis'] = 		$this->General_Model->getAllItemTable_Array('api', array('status' => 1))->result();
		$this->load->view(THEME.'game/update_events', $this->data);
	}

public function update_oneclicket_categories(){
$request_data = array();
$stadium_init_response = $this->process_curl_request_oneclicket("getCategories",$request_data);
echo json_encode(array('status' => 1,'msg' => "Oneclicket Category Updated Successfully."));exit;
}

public function update_tixstock_categories(){
	
	$end_point_url 		= TIXSTOCK_ENDPOINT_URL.'categories/feed?name=&parent=&order_by=&sort_order=&per_page=50&page=1';
    $this->process_curl_request_tixstock("category","GET",$end_point_url);
    echo json_encode(array('status' => 1,'msg' => "Tixstock Category Updated Successfully."));exit;
}

public function update_events()
	{
		


		$category_josn  = fopen("uploads/category/category.json",'r');
		$categories 	= fread ($category_josn,filesize("uploads/category/category.json"));
		$category_data  = json_decode($categories,1);
		$formated_data  = array();
		$category_array = array();
		
		if(!empty($category_data['data'])){
			$i = 0;
			foreach($category_data['data'] as $category){

				$this->get_update_data($category);
				
			}
			
		}
		
		fclose ($category_josn);

		$oneclicket_category_josn  = fopen("uploads/category/category_oneclicket.json",'r');
		$oneclicket_categories 	= fread ($oneclicket_category_josn,filesize("uploads/category/category_oneclicket.json"));
		$oneclicket_category_data  = json_decode($oneclicket_categories,1);
		$oneclicket_formated_data  = array();
		$oneclicket_category_array = array();
		if(!empty($oneclicket_category_data['data'])){
			$i = 0;
			foreach($oneclicket_category_data['data'] as $category){

				$this->get_update_data_oneclicket($category);
				
			}
			
		}
		
		fclose ($oneclicket_category_josn);

		$this->data['apis'] = 		$this->General_Model->getAllItemTable_Array('api', array('status' => 1))->result();

		$oneclicket_categories = 		$this->General_Model->getAllItemTable_Array('oneclicket_categories', array('parent_category_id' => NULL))->result();
		$oneclicket_parent_category = array();
		$i = 0;
		$oneclicket_categories = json_decode(json_encode($oneclicket_categories), true);
		foreach($oneclicket_categories as $oneclicket_category){
			$oneclicket_category = json_decode(json_encode($oneclicket_category), true);
			$oneclicket_parent_category['data'][$i] = $oneclicket_category;
			//echo "<pre>";print_r($oneclicket_category);exit;
			$child = $this->General_Model->getAllItemTable_Array('oneclicket_categories', array('parent_category_id' => $oneclicket_category['category_id']))->result();

			if(!empty($child)){
				$child = json_decode(json_encode($child), true);
				$oneclicket_parent_category['data'][$i]['children'] = 		$child;
			}
			

		$i++;}

		//echo "<pre>";print_r($oneclicket_parent_category);exit;
		$this->data['dropdownlist_oneclicket'] = $oneclicket_parent_category['data'];
		$this->data['dropdownlist'] = $category_data['data'];
		$this->load->view(THEME.'game/update_events_v1', $this->data);
	}
public function get_teams_name(){
            $searchText = $_POST['search_text'];
            // Perform a database query or some other operation to retrieve the checkbox data based on the search text
           
            $html = "";
           $team_id= $_POST['team_id'];

            $records = $this->General_Model->get_teams_name($searchText,$team_id)->result();
            foreach($records as $record ){
                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input teams" id="customCheck'.$record->team_name.'" name="teams[]">
                <label class="custom-control-label" for="customCheck'.$record->team_name.'">'.$record->team_name.'</label>
              </div>';

            }

            echo $html;
    }



 public function get_category_name(){
            $searchText = $_POST['search_text'];
           
            $html = "";
            $parent_category_id= $_POST['parent_category_id'];
            $flag= $_POST['flag'];
            if($flag == "parent_category"){
            	$name = "child_category[]";
            	$class = "child_category";
            }
            else if($flag == "child_category"){	
            	$name = "parent_tournament[]";
            	$class = "parent_tournament";
            	
            }
            else if($flag == "parent_tournament"){
            	$name = "child_tournament[]";
            	$class = "child_tournament";
            	
            }
            else if($flag == "child_tournament"){
            	
            }
           // $parent_category_id					=  isset($_POST['parent_category_id']) ?  implode(",", $_POST['parent_category_id']) : '';

            $records = $this->General_Model->get_category_name($parent_category_id,$searchText,$flag)->result();
            foreach($records as $record ){
                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input '.$class.'" id="customCheck'.$record->category_id.'" name="'.$name.'">
                <label class="custom-control-label" for="customCheck'.$record->category_id.'">'.$record->category.'</label>
              </div>';

            }

            echo $html;
    }

    public function get_category_search(){
            $searchText = $_POST['search_text'];
           
            $html = "";
            $parent_category_id= $_POST['parent_category_id'];
            $flag              = $_POST['flag'];
           
           if($flag == "parent_category"){
            	$name = "parent_category[]";
            	$class = "parent_category";
            }
            else if($flag == "child_category"){	
            	$name = "child_category[]";
            	$class = "child_category";
            	
            }
            else if($flag == "parent_tournament"){
            	$name = "parent_tournament[]";
            	$class = "parent_tournament";
            	
            }
            else if($flag == "child_tournament"){
            	$name = "child_tournament[]";
            	$class = "child_tournament";
            }
            $records = $this->General_Model->get_category_name($parent_category_id,$searchText,$flag)->result();
            foreach($records as $record ){
                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input '.$class.'" id="customCheck'.$record->category_id.'" name="'.$name.'">
                <label class="custom-control-label" for="customCheck'.$record->category_id.'">'.$record->category.'</label>
              </div>';

            }

            echo $html;
    }
	 
     public function get_event_pulling_api()
	{	
		$row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		
		$rowno = $_POST['start'];
		
		if ($rowno != '' && $rowno != 0) {
		$rowno = ($rowno - 1) ;
		}
		else{
			$rowno = 0;			
		}

			if (!empty($_POST['parent_category'][0]) || !empty($_POST['child_category'][0]) || !empty($_POST['parent_tournament'][0]) || !empty($_POST['child_tournament'][0]) || !empty($_POST['teams'][0]) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date'])) {

				$records = $this->Tixstock_Model->get_event_pulling_api_items($rowno, $row_per_page,$_POST)->result();

				$allcount = $this->Tixstock_Model->get_event_pulling_api_items('','',$_POST)->num_rows();

//exit;
			} else {  
				
				
				$records = $this->Tixstock_Model->get_event_pulling_api_items($rowno, $row_per_page)->result();
				$allcount = $this->Tixstock_Model->get_event_pulling_api_items()->num_rows();				
			}

			
			$data = [];
			$this->data['sellers'] = $this->General_Model->get_sellers();
			$i = 1;
			foreach($records as $record ){

				$match_status="";
				 if ($record->match_found == 1) {
					$match_status='<div class="bttns">
										<span class="badge badge-success">Found</span>
									</div>';
				 } 
				 else if ($record->match_found == 0) { 
					$match_status='<div class="bttns">
										<span class="badge badge-danger">Not Found</span>
									</div>';
				 } 

				 $merge_status="";
				 if ($record->merge_status == 1) {
					$merge_status='<div class="bttns">
										<span class="badge badge-success">Sync</span>
									</div>';
				 } 
				 else if ($record->merge_status == 0) { 
					$merge_status='<div class="bttns">
										<span class="badge badge-danger">Not Sync</span>
									</div>';
				 } 
				 //echo "<pre>";print_r($record);exit;
					$data[] = array( 
					"sl"			=> $i,
					"event_name"			=> $record->event_name,
					"match_date_time"      => $record->match_date_time,
					"tournament"			=> $record->tournament_name,
					"stadium"			=> $record->stadium_name,
					"tickets"			=> $record->tickets,
					"match_found"			=> $match_status,
					"merge_status"			=> $merge_status,
				);
					$i++;
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

	public function getapidata()
	{	
		$category 	 			= 		$_POST['category'];
		$tournaments 			= 		$this->General_Model->tournaments_api($_POST['api'],$category);
		$teams    				= 		$this->General_Model->teams_api($_POST['api'],$category);
		$stadiums 				= 		$this->General_Model->stadiums_api($_POST['api'],$category);

		$bx_tournaments 		= 		$this->General_Model->tournaments_1bx('',$category);
		$bx_teams    			= 		$this->General_Model->teams_1bx($category);
		$bx_stadiums		    = 		$this->General_Model->stadiums_1bx($category);


		$response = array("tournaments" => $tournaments,"teams" => $teams,"stadiums" => $stadiums,"bx_tournaments" => $bx_tournaments,"bx_teams" => $bx_teams,"bx_stadiums" => $bx_stadiums);
		echo json_encode($response);exit;
	}



	public function merge_cms()
	{	
		$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
		$this->data['apis'] = 		$this->General_Model->getAllItemTable_Array('api', array('status' => 1))->result();
		/*$this->data['tournaments'] = 		$this->General_Model->tournaments_1bx();
		
		$this->data['teams']    = 		$this->General_Model->teams_1bx();
		$this->data['stadiums'] = 		$this->General_Model->stadiums_1bx();*/
		
		$this->load->view(THEME.'game/merge_cms', $this->data);
	}
	
	public function get_tixstock_category()
	{
		if($_POST['parent_category_id'] != ""){

			$categories = 		$this->General_Model->getAllItemTable_Array('tixstock_categories', array('parent_category_id' => $_POST['parent_category_id']))->result();
			echo json_encode(array('status' => 1,'categories' => $categories));exit;

		}
		else{
			echo json_encode(array('status' => 0,'categories' => ""));exit;
		}
	}

	public function get_oneclicket_category()
	{
		if($_POST['parent_category_id'] != ""){

			$categories = 		$this->General_Model->getAllItemTable_Array('oneclicket_categories', array('parent_category_id' => $_POST['parent_category_id']))->result();
			echo json_encode(array('status' => 1,'categories' => $categories));exit;

		}
		else{
			echo json_encode(array('status' => 0,'categories' => ""));exit;
		}
	}

	
	public function get_tixstock_matches()
	{
		echo "<pre>";print_r($_POST['matches']);exit;
		if($_POST['matches'] != ""){

			$list_orders = $this->load->view('game/get_tixstock_matches', $this->mydatas, TRUE);

		}
		else{
			echo json_encode(array('status' => 0,'categories' => ""));exit;
		}
	}

	public function uploadNominee($orderId)
	{
		$this->data['orderData'] =  $this->General_Model->getOrderData($orderId);
		$this->data['eticketData'] = 		$this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();
		//	print_r($this->data['eticketData']);
		$this->load->view('game/upload_nominee', $this->data);
	}

	public function uploadEticket($orderId)
	{
		$this->data['orderData'] =  $this->General_Model->getOrderData($orderId);
		$this->data['orderData']->team1_image = UPLOAD_PATH .'uploads/teams/'. $this->data['orderData']->team_image_a;
		$this->data['orderData']->team2_image = UPLOAD_PATH .'uploads/teams/'. $this->data['orderData']->team_image_b;
		$this->data['eticketData'] = 		$this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();
		if($this->data['orderData']->listing_note != ''){
				$this->data['seller_notes'] = 		$this->General_Model->get_seller_notes($this->data['orderData']->listing_note);

			}
			//echo "<pre>";print_r($this->data['eticketData']);exit;
		$this->load->view('game/upload_eticket', $this->data);
	}

	public function deleteEticket()
	{

		$segment4 = $this->uri->segment(3);


		$order = $this->General_Model->getAllItemTable_Array('booking_etickets', array('id' => $segment4))->row();

		if ($segment4 != '')
			$insertData = array('ticket_file' => '', 'ticket_status' => 0,'ticket_upload_date' => '');
		$delete = $this->General_Model->update('booking_etickets', array('id' => $segment4), $insertData);
		if ($delete == 1) {
			$status = '0';
			$updateData = array('delivery_status' => $status);
			$cond = array('bg_id' => $order->booking_id);
			$this->General_Model->update('booking_global', $cond, $updateData);
			$response = array('status' => 1, 'msg' => 'Ticket Deleted Successfully.');
			echo json_encode($response);
			exit;
		} else {
			$response = array('status' => 1, 'msg' => 'Error while deleting Ticket.');
			echo json_encode($response);
			exit;
		}
	}



	function currencyConverterMap2($convert_amount, $currency_from, $currency_to)
	{

		$CI = &get_instance();
		$exchange_price = $CI->General_Model->getAllItemTable_Array('exchange_rates', array('currencyto' => strtoupper($currency_from) . '_' . strtoupper($currency_to)))->result();

		if ($exchange_price) {
			$exchange_price = $exchange_price[0]->price;
		} else {
			$exchange_price = 1.00;
		}
		$conversion_rate = (float) $exchange_price;


		$currency = $CI->General_Model->getAllItemTable_Array('currency_types', array('currency_code' => strtoupper($currency_to)))->result();
		if ($currency) {
			$currency_symbol = $currency[0]->symbol;
		}


		return str_replace(',', '', number_format($convert_amount * $conversion_rate, 2));
	}

	public function download_tickets($booking_no){
		//echo $booking_no;exit;
		$this->data['orderData'] =  $this->General_Model->getOrderData($booking_no);
		$eticketData             = 	$this->General_Model->get_download_tickets(array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();

        $createdzipname = $this->data['orderData']->booking_no.'_Tickets';

        $this->load->library('zip');
        $this->load->helper('download');

        // create new folder 
        //$this->zip->add_dir('uploads/tickets_zip');

        foreach ($eticketData as $file) {

            $paths = UPLOAD_PATH .'uploads/e_tickets/'.$file->ticket_file;
            // add data own data into the folder created
            $this->zip->add_data($file->ticket_file,file_get_contents($paths));    
        }
        $this->zip->download($createdzipname.'.zip');
    }

	public function orders_review_request()
	{
		$searchText = strtolower($_POST['search_text']);
		// Perform a database query or some other operation to retrieve the checkbox data based on the search text
		$checkboxData = array('6'=>'downloaded','1'=>'confirmed','4'=>'shipped','5'=>'delivered');
		
		$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
		$matches = preg_grep($pattern, $checkboxData);
		
		$html = "";
		
		foreach($matches as $key=>$value ){

		  $html .=  '<div class="custom-control custom-checkbox">
		  <input type="checkbox" class="custom-control-input" id="customCheck'.$key.'">
		  <label class="custom-control-label" for="customCheck'.$key.'">'.ucfirst($value).'</label>
		</div>';
	
		}


		$request_searchText = strtolower($_POST['search_text']);
		// Perform a database query or some other operation to retrieve the checkbox data based on the search text
		$request_checkboxData = array('1'=>'Yes','0'=>'No');
		
		$request_pattern = '/' . preg_quote($request_searchText, '/') . '/'; // Dynamically create the pattern
		$request_matches = preg_grep($request_pattern, $request_checkboxData);
		
		$request_html = "";
		
		foreach($request_matches as $request_key=>$request_value ){

		  $request_html .=  '<div class="custom-control custom-checkbox">
		  <input type="checkbox" class="custom-control-input" id="customCheck_request'.$request_key.'">
		  <label class="custom-control-label" for="customCheck_request'.$request_key.'">'.ucfirst($request_value).'</label>
		</div>';
	
		}
	
		 $this->data['delivery_status']=$html;
		 $this->data['request_status']=$request_html;
		$this->load->view(THEME.'/game/review_request' ,$this->data);
	}


	public function get_shipping_status(){
		$searchText = $_POST['search_text'];
		// Perform a database query or some other operation to retrieve the checkbox data based on the search text
		$checkboxData = array('0'=>'Tickets	Not Uploaded','1'=>'Tickets	In-Review','2'=>'Tickets Approved','3'=>'Tickets Rejected','4'=>'Tickets Downloaded','5'=>'Tickets Shipped','6'=>'Tickets Delivered');
		;
		$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
	$shipping_status_inpt = preg_grep($pattern, $checkboxData);
	
	$shipping_status = "";
	
	foreach($shipping_status_inpt as $key=>$value ){

		$shipping_status .=   '<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" id="shipping_status'.$key.'">
		<label class="custom-control-label" for="shipping_status'.$key.'">'.ucwords($value).'</label>
	  </div>'.'';

	}

	echo $shipping_status; 
}	

public function get_order_status(){
				$searchText = strtolower($_POST['search_text']);
				// Perform a database query or some other operation to retrieve the checkbox data based on the search text
				$checkboxData = array('2'=>'pending','1'=>'confirmed','0'=>'failed','3'=>'cancelled','4'=>'shipped','5'=>'delivered','6'=>'downloaded');
				

				;
				$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
			$shipping_status_inpt = preg_grep($pattern, $checkboxData);

			$order_status = "";

			foreach($shipping_status_inpt as $key=>$value ){

				$order_status .=   '<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="order_status'.$key.'">
					<label class="custom-control-label" for="order_status'.$key.'">'.ucwords($value).'</label>
				</div>'.'';

			}

			echo $order_status; 

	}

	public function get_seller_status(){ 
				$searchText = strtolower($_POST['search_text']);
				$searchText = ucfirst($_POST['search_text']);
				// Perform a database query or some other operation to retrieve the checkbox data based on the search text

				$checkboxData = array('processing'=>'Processing','completed'=>'Completed','getpaid'=>'Get Paid','issue'=>'Issue');
				

				;
				$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
			$seller_status_inpt = preg_grep($pattern, $checkboxData);
			$seller_status = "";

			foreach($seller_status_inpt as $key=>$value ){

				$seller_status .=   '<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="seller_status'.$key.'">
					<label class="custom-control-label" for="seller_status'.$key.'">'.ucwords($value).'</label>
				</div>'.'';

			}

			echo $seller_status; 

	}

	public function save_delivery_information()
	{
				$ticket_type = $_POST['ticket_id'];
				@$contact_number = $_POST['contact_number'];

				if(!empty($ticket_type)){

					$tickets = $this->General_Model->getAllItemTable_Array('booking_global', array('md5(bg_id)' => $_POST['ticket_id']))->row();

					// echo '<pre/>';
					// print_r($tickets );
					// exit;
					$updateData = array('delivery_contact_number' => $contact_number);
					$cond = array('booking_id' =>  $tickets->bg_id);
					$done = $this->General_Model->update('booking_billing_address', $cond, $updateData);
		
					$response = array('status' => 1, 'msg' => "Contact Number Added Successfully.");
					echo json_encode($response);
					exit;
			}
			else {
				$response = array('status' => 0, 'msg' => "Contact Number Failed to Add.");
				echo json_encode($response);
				exit;
			}
	}
	public function send_email()
	{
				$ticket_type = $_POST['ticket_id'];
				@$email = $_POST['email'];
				
				if(/*$ticket_type >  1 && */filter_var($email, FILTER_VALIDATE_EMAIL)  ){

					$tickets = $this->General_Model->getAllItemTable_Array('booking_global', array('md5(bg_id)' => $_POST['ticket_id']))->row();
					// echo '<pre/>';
					
					
					$updateData = array('ticket_email_status' => 1);
					$cond = array('booking_id' =>  $tickets->bg_id);
					$done = $this->General_Model->update('booking_etickets', $cond, $updateData);
		

					$post_data = array("bg_id" => $tickets->bg_id,'email_address' => $email);
					
					//echo "<pre>";print_r($post_data);exit;
					$handle = curl_init();
					$url = API_CRON_URL.'admin-approve-notfication';
					curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					'domainkey: https://www.1boxoffice.com/en/'
					));
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					//echo "<pre>";print_r($output);exit;
					curl_close($handle);			

						//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Email Sent Successfully.");

			echo json_encode($response);
			exit;
			}
			else {
				$response = array('status' => 0, 'msg' => "Failed to sent Email.");
				echo json_encode($response);
				exit;
			}
	}

	/**
	 * Orders related operations
	 * Add
	 * List
	 * Edit
	 * Delete
	 */
	public function orders()
	{
		error_reporting(0);
		$idiom = $this->session->get_userdata('language');
		//echo "<pre>";print_r($this->session->all_userdata());exit; print_r($idiom); exit;
		$this->lang->load('message', 'english');
		$segment = $this->uri->segment(3);
		//$this->data['customers_list'] = $this->General_Model->getAllItemTable('register','status',1)->result();
		$this->data['customers_list'] = $this->General_Model->getAllItemTable_Array('register', array('status' => 1,'allow_offline' => 1))->result();
		$this->data['events_list'] = $this->General_Model->get_match_list();

		if ($segment == 'partner_order') {

			$row_count = $this->uri->segment(5);
			$flag = $this->uri->segment(4);
			$this->loadRecord($row_count, 'booking_global', 'game/orders/partner_order/'.$flag, 'id', 'DESC', 'game/partner_order', 'getMySalesData', 'partner_order',$_POST);

		}
		else if ($segment == 'update_seller_status') {

		if($_POST['bg_id'] != "" && $_POST['seller_status'] != ""){

			$updateData = array('seller_status' => $_POST['seller_status']);
			$cond = array('bg_id' => $_POST['bg_id']);
			$done = $this->General_Model->update('booking_global', $cond, $updateData);

			if($done == true){

				$response = array('status' => 1, 'msg' => "Success.Order Status Updated Successfully.");

			}
			else{

				$response = array('status' => 0, 'msg' => "Oops.Failed to update Order Status.");

			}
			echo json_encode($response);exit;
		}
		

		}
		else if ($segment == 'list_order') {
			
			/*if (!empty($_POST)) {
				$event 					= $_POST['event'];
				$ticket_category 		 = $_POST['ticket_category'];
				$stadium 				 = $_POST['stadium'];
				$event_start_date = $_POST['event_start_date'];
				$event_end_date 		= $_POST['event_end_date'];
				$ignore_end_date 		 = $_POST['ignore_end_date'];
				$seller 		 = $_POST['seller'];
				$ticket_id 		 = $_POST['ticket_id'];
				$this->data['getMySalesData'] = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$ticket_id);
			} else {
				$this->data['getMySalesData'] = $this->General_Model->getOrders('',$this->uri->segment(4),$this->uri->segment(5));
			}

			$this->data['sellers'] = $this->General_Model->get_sellers();
			$this->load->view('game/list_order', $this->data);*/
			$row_count = $this->uri->segment(5);
			$flag = $this->uri->segment(4);
			 $_POST['customer_id'] =  json_decode(base64_decode($_GET['customer_id']));
			 
			//$this->loadRecord($row_count, 'booking_global', 'game/orders/list_order/'.$flag, 'id', 'DESC', 'game/list_order', 'getMySalesData', 'orders',$_POST);

			$records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name." ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input seller_select_box" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

         $this->data['html'] = $html;


		 $searchText = "";
	// Perform a database query or some other operation to retrieve the checkbox data based on the search text
	$checkboxData = array('0'=>'Tickets	Not Uploaded','1'=>'Tickets	In-Review','2'=>'Tickets Approved','3'=>'Tickets Rejected','4'=>'Tickets Downloaded','5'=>'Tickets Shipped','6'=>'Tickets Delivered');
	
	$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
	$matches = preg_grep($pattern, $checkboxData);
	
	$shipping_status = "";
	
	foreach($matches as $key=>$value ){

		$shipping_status .=   '<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input shipping_select_status" id="shipping_status'.$key.'">
		<label class="custom-control-label" for="shipping_status'.$key.'">'.ucwords($value).'</label>
	  </div>'.'';

	}

	$this->data['shipping_status'] = $shipping_status; 



	$order_status_searchText = "";
	// Perform a database query or some other operation to retrieve the checkbox data based on the search text
	$order_status_checkboxData = array('2'=>'Pending','1'=>'Confirmed','0'=>'Failed','3'=>'Cancelled','4'=>'Shipped','5'=>'Delivered','6'=>'Downloaded');
	
	$pattern = '/' . preg_quote($order_status_searchText, '/') . '/'; // Dynamically create the pattern
	$order = preg_grep($pattern, $order_status_checkboxData);
	
	$order_status = "";
	
	foreach($order as $key=>$value ){

		$order_status .=   '<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input order_select_status" id="order_status'.$key.'">
		<label class="custom-control-label" for="order_status'.$key.'">'.ucwords($value).'</label>
	  </div>'.'';

	}

	$this->data['order_status'] = $order_status; 




			if($_GET['page'] == "protect"){
					$this->load->view(THEME.'/game/booking_protect_order', $_POST,$this->data);
			}
			else if($_GET['page'] == "api"){
					$this->load->view(THEME.'/game/booking_api_order', $_POST,$this->data);
			}
			else if($_GET['page'] == "affiliate"){
					$this->load->view(THEME.'/game/booking_affiliate_order', $_POST,$this->data);
			}
			else{
					$this->load->view(THEME.'/game/list_order', $_POST,$this->data);
			}

		}
		else if ($segment == 'booking_protect_order') {
			$this->data['sellers'] = $this->General_Model->get_sellers();
			
			$row_count = $this->uri->segment(5);
			$flag = $this->uri->segment(4);		
			$_POST['protect'] = "1";
			$this->loadRecord($row_count, 'booking_global', 'game/orders/booking_protect_order/'.$flag, 'id', 'DESC', 'game/booking_protect', 'getMySalesData', 'orders',$_POST);

		}
		// else if ($segment == 'booking_protect_order') {
		// 	$row_count = $this->uri->segment(5);
		// 	$flag = $this->uri->segment(4);
		// 	$this->loadRecord($row_count, 'booking_global', 'game/orders/booking_protect_order/'.$flag, 'id', 'DESC', 'game/booking_protect_order', 'getMySalesData', 'booking_protect_order',$_POST);

		// }
		 else if ($segment == 'ticket_delivery') {
			/*$segment4 = $this->uri->segment(4);
			$getMySalesData = $this->General_Model->ticket_delivery($segment4);
			foreach($getMySalesData as $getMySales){
				$getMySales->tickets_data['pending'] 		= $this->General_Model->get_ticket_status($getMySales->bg_id,'pending')->num_rows();
				$getMySales->tickets_data['uploaded'] 		= $this->General_Model->get_ticket_status($getMySales->bg_id,'uploaded')->num_rows();
				$getMySales->tickets_data['downloaded'] 		= $this->General_Model->get_ticket_status($getMySales->bg_id,'pending')->num_rows();
				$this->data['getMySalesData'][] = $getMySales;
			}
			
			$this->load->view('game/ticket_delivery', $this->data);*/
			$row_count = $this->uri->segment(5);
			$flag = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'booking_etickets', 'game/orders/ticket_delivery/'.$flag, 'id', 'DESC', 'game/ticket_delivery', 'getMySalesData', 'ticket_delivery',$_POST);

			$records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){
               $seller_name = $record->seller_first_name." ".$record->seller_last_name;
                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

         $this->mydatas['html'] = $html;

			$this->load->view(THEME.'game/ticket_delivery', $this->data);

		} else if ($segment == 'ticket_delivery_export') {
			

			$segment4 = $this->uri->segment(4);
			$ticket_lists = $this->General_Model->ticket_delivery($segment4)->result();


			// Column names 
            $fields = array('OrderNo','CUSTOMER','Tournament','Match','MatchDate','MatchTime','Stadium','Qty','pending','Upload','Downloaded'); 
            // Display column names as first row 
            $excelData = implode("\t", array_values($fields)) . "\n"; 
            $total_amount = array();
            foreach($ticket_lists as $download_order){  
          
            	$pending	= $this->General_Model->get_ticket_status($download_order->bg_id,'pending')->num_rows();
				$uploaded	= $this->General_Model->get_ticket_status($download_order->bg_id,'uploaded')->num_rows();
				$downloaded		= $this->General_Model->get_ticket_status($download_order->bg_id,'pending')->num_rows();
				
            	$lineData = array(
            			$download_order->booking_no,
            			$download_order->title." ".$download_order->first_name." ".$download_order->last_name,
            			$download_order->tournament_name,
            			$download_order->match_name,
            			$download_order->match_date,
            			$download_order->match_time,
            			$download_order->stadium_name.','.$download_order->stadium_city_name.','.$download_order->stadium_country_name,
            			$download_order->quantity,
            			$pending,
            			$uploaded,
            			$download_order->delivery_status == 4 ? $downloaded : 0

            		); 
            	 $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            }
           	$fileName = "Ticket_Delivery_export" . date('Y-m-d') . ".xls"; 
           
            header("Content-Type: application/vnd.ms-excel"); 
            header("Content-Disposition: attachment; filename=\"$fileName\""); 

            // Render excel data 
            echo $excelData; 


		}else if ($segment == 'payment_history') {
			//$this->data['getMySalesData'] = $this->General_Model->payment_history();
			$this->load->view(THEME.'game/payment_history', $this->data);
		} else if ($segment == 'my_sales') { 
			$segment4 = $this->uri->segment(4);
			if ($segment4 == '') {
				$segment4 = "upcoming";
			}
			$segment5 = $this->uri->segment(5);
			$this->data['sellers'] = $this->General_Model->get_sellers();
			if ($segment5 == "load_sales") {
				if ($this->uri->segment(6)) {
					$rowno = ($this->uri->segment(6));
				} else {
					$rowno = 0;
				}
				$rowperpage = 10;
				$where = array();
				if($_POST['seller_id'] != ''){
					$where['seller_id']=$_POST['seller_id'];
				}
				

				// Row position
				if ($rowno != 0) {
					$rowno = ($rowno - 1) * $rowperpage;
				}
				$allcount =   $this->General_Model->my_sales_V1_filter($segment4, '', '', '', '', '',$where)->num_rows();
				$mysales =  $this->General_Model->my_sales_V1_filter($segment4, '', '', '', '', '',$where)->result();
				$sales_data = array();
				foreach ($mysales as $mysale) {
					$total_quantity = 0;
					$available_tickets = 0;
					$download_tickets = 0;
					$match_id = $mysale->match_id;
					$mysales_tickets  =  $this->General_Model->my_ticket_quantity($match_id)->row();
					$myorders_tickets =  $this->General_Model->my_orders_quantity($match_id)->row();
					$pending_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id, 'notuploaded')->num_rows();
					//$uploaded_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id,'uploaded')->num_rows();
					//$available_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id,'available')->num_rows();
					$available_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id, 'available')->num_rows(); //echo $this->db->last_query();
					$download_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id, 'download')->num_rows();

					//echo "pending_tickets <pre>";print_r($pending_tickets);exit;

					if ($mysales_tickets->total_quantity) {
						$total_quantity = $mysales_tickets->total_quantity;
					}
					$mysale->ticket_quantity = $total_quantity;

					$sold_quantity = 0;
					if ($myorders_tickets->sold_quantity) {
						$sold_quantity = $myorders_tickets->sold_quantity;
					}
					$mysale->sold_quantity = $sold_quantity;

					$mysale->pending_quantity  = $pending_tickets;
					//$mysale->uploaded_quantity = $uploaded_tickets;
					$mysale->available_tickets = $available_tickets;
					$mysale->download_tickets = $download_tickets;


					$sales_data[] = $mysale;
				} 
				$this->data['segment'] = $segment4;
				$this->data['getMySalesData'] = $sales_data;
				$this->load->library('pagination');
				// Pagination Configuration
				$config['base_url'] = base_url() . 'orders/my_sales/expired/load_sales/';
				$config['use_page_numbers'] = TRUE;
				$config['reuse_query_string'] = TRUE;
				$config['total_rows'] = $allcount;
				$config['per_page'] = $rowperpage;
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				// Initialize
				$this->pagination->initialize($config);

				// Initialize $data Array
				$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="pagination">' . $this->pagination->create_links() . '</div>';

				$list_tickets = $this->load->view('game/my_sales_ajax', $this->data, TRUE);
				if (empty($sales_data)) {
					$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
				}
				$response = array('segment' => $segment4, 'sales' => $list_tickets);
				echo json_encode($response);
				exit;
			} else if ($segment5 == "filter_sales") {
				if ($this->uri->segment(6)) {
					$rowno = ($this->uri->segment(6));
				} else {
					$rowno = 0;
				}
				$rowperpage = 10;

				// Row position
				if ($rowno != 0) {
					$rowno = ($rowno - 1) * $rowperpage;
				}
				$event 					= $_POST['event'];
				$ticket_category 		 = $_POST['ticket_category'];
				$stadium 				 = $_POST['stadium'];
				$event_start_date = $_POST['event_start_date'];
				$event_end_date 		= $_POST['event_end_date'];
				$ignore_end_date 		 = $_POST['ignore_end_date'];

				if ($ignore_end_date == 1) {
					$event_end_date = '';
				}
				$where['event_search']=$event;
				$where['ticket_category_search']=$ticket_category;
				$where['stadium_search']=$stadium;
				$where['start_date']=$event_start_date;
				$where['end_date']=$event_end_date;

				$allcount =   $this->General_Model->my_sales_V1_filter($segment4, '', '', '', '', '',$where)->num_rows();


				$mysales =  $this->General_Model->my_sales_V1_filter($segment4, '', '', '', '', '',$where)->result();
				$sales_data = array();
				foreach ($mysales as $mysale) {
					$total_quantity = 0;
					$available_tickets = 0;
					$download_tickets = 0;
					$match_id = $mysale->match_id;
					$mysales_tickets  =  $this->General_Model->my_ticket_quantity($match_id)->row();
					$myorders_tickets =  $this->General_Model->my_orders_quantity($match_id)->row();
					$pending_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id, 'notuploaded')->num_rows();
					//$uploaded_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id,'uploaded')->num_rows();
					//$available_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id,'available')->num_rows();
					$available_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id, 'available')->num_rows(); //echo $this->db->last_query();
					$download_tickets  =  $this->General_Model->my_orders_pending_tickets($match_id, 'download')->num_rows();

					//echo "pending_tickets <pre>";print_r($pending_tickets);exit;

					if ($mysales_tickets->total_quantity) {
						$total_quantity = $mysales_tickets->total_quantity;
					}
					$mysale->ticket_quantity = $total_quantity;

					$sold_quantity = 0;
					if ($myorders_tickets->sold_quantity) {
						$sold_quantity = $myorders_tickets->sold_quantity;
					}
					$mysale->sold_quantity = $sold_quantity;

					$mysale->pending_quantity  = $pending_tickets;
					//$mysale->uploaded_quantity = $uploaded_tickets;
					$mysale->available_tickets = $available_tickets;
					$mysale->download_tickets = $download_tickets;


					$sales_data[] = $mysale;
				}
				$this->data['segment'] = $segment4;
				$this->data['getMySalesData'] = $sales_data;
				$this->load->library('pagination');
				// Pagination Configuration
				$config['base_url'] = base_url() . 'orders/my_sales/expired/load_sales/';
				$config['use_page_numbers'] = TRUE;
				$config['reuse_query_string'] = TRUE;
				$config['total_rows'] = $allcount;
				$config['per_page'] = $rowperpage;
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				// Initialize
				$this->pagination->initialize($config);

				// Initialize $data Array
				$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="pagination">' . $this->pagination->create_links() . '</div>';

				$list_tickets = $this->load->view('game/my_sales_ajax', $this->data, TRUE);
				if (empty($sales_data)) {
					$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
				}
				$response = array('segment' => $segment4, 'sales' => $list_tickets);
				echo json_encode($response);
				exit;
			} else {
				$_SESSION['event'] =  '';
				$_SESSION['ticket_category'] = '';
				$_SESSION['stadium'] =  '';
				$_SESSION['event_start_date']	= '';
				$_SESSION['event_end_date'] = '';
				$_SESSION['ignore_end_date'] = '';
				$this->load->view('game/my_sales', $this->data);
			}
		} else if ($segment == 'my_sales_details') {
			$segment4 = $this->uri->segment(4);
			$this->data['event'] = $this->General_Model->my_sales_details($segment4);
			$myorders_tickets =  $this->General_Model->my_orders_quantity($segment4)->row();
			$mysales_tickets  =  $this->General_Model->my_ticket_quantity($segment4)->row();
			$ticket_categories  =  $this->General_Model->my_orders_details($segment4)->result();
			$all_ticket = array();
			foreach ($ticket_categories as $ticket_category) {
				//	echo $ticket_category->ticket_category;
				$available_tickets = 0;
				$download_tickets = 0;
				$pending_tickets = 0;
				$available_tickets  =  $this->General_Model->my_orders_pending_tickets_v1($ticket_category->match_id, 'available', $ticket_category->ticket_category)->num_rows();
				$download_tickets  =  $this->General_Model->my_orders_pending_tickets_v1($ticket_category->match_id, 'download', $ticket_category->ticket_category)->num_rows();
				$pending_tickets  =  $this->General_Model->my_orders_pending_tickets_v1($ticket_category->match_id, 'notuploaded', $ticket_category->ticket_category)->num_rows();
				$ticket_category->available_tickets = $available_tickets;
				$ticket_category->download_tickets = $download_tickets;
				$ticket_category->pending_tickets = $pending_tickets;
				$all_ticket[] = $ticket_category;
				//echo $this->db->last_query();
				//echo $available_tickets;
				//echo "<br>";

			}  //echo "<pre>";print_r($myorders_tickets);exit;
			$this->data['ticket_categories'] = $all_ticket;

			$this->data['event']->ticket_quantity = $mysales_tickets->total_quantity;
			$this->data['event']->sold_quantity = $myorders_tickets->sold_quantity;
			$this->data['getMySalesData'] = $this->General_Model->getOrders($segment4);
			//echo "<pre>";print_r($this->data['event']);exit; 
			$this->load->view('game/my_sales_details', $this->data);
		} else if ($segment == 'update_booking_status') {


			$order = $this->General_Model->getAllItemTable_Array('booking_global', array('md5(bg_id)' => $_POST['bg_id']))->row();
			if ($_POST['bg_id'] != "" && $_POST['status'] != "" && $order->bg_id != "") {

				$status = $_POST['status'];
				$cancel_reason = @$_POST['reason'];
				if($order->source_type == "tixstock"){
				if ($status == 3) {


					if($order->source_type == "tixstock"){
					$url = base_url().'tixstock/orderConfirm';
					$post_data = array("bg_id" => $order->bg_id,"tixstock_status" => 'Cancelled');
					$handle = curl_init();
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					curl_close($handle);
					$tixresponse = json_decode($output,1);
					//echo "<pre>";print_r($tixresponse);exit;
					if($tixresponse['tixstock_status'] != "FAILED"){

					if($tixresponse['tixstock_status'] == "Cancelled"){

						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					$response = array('status' => 1, 'msg' => "Success.Your Booking Cancelled Successfully.");
					echo json_encode($response);
					exit;
				}
				else{
					$response = array('status' => 1, 'msg' => "Booking Status : ".$tixresponse['tixstock_status']);
					echo json_encode($response);
					exit;
				}
				

					}
					
					
					//echo $url;exit;
				}

				}
			}
				 if ($status == 1) {

					
					if($order->source_type == "tixstock"){
					$url = base_url().'tixstock/orderConfirm';
					$post_data = array("bg_id" => $order->bg_id,"tixstock_status" => 'Approved');
					$handle = curl_init();
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					curl_close($handle);
					$tixresponse = json_decode($output,1);
					//echo "<pre>";print_r($tixresponse);exit;
					if($tixresponse['tixstock_status'] != "FAILED"){

					if($tixresponse['tixstock_status'] == "Approved"){

						if($order->booking_status == 2){
						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold + $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					}
					else{

					$response = array('status' => 1, 'msg' => "Oops.Unable to change the booking status.");
					echo json_encode($response);
					exit;

					}
				}
				else{

						$response = array('status' => 1, 'msg' => "Oops.Unable to change the booking status.Your Tixstock order status is ".$tixresponse['tixstock_status']);
					echo json_encode($response);
					exit;

					}

					}
					else{

						$response = array('status' => 1, 'msg' => "Oops.Unable to change the booking status.Your order response is ".$tixresponse['tixstock_status']);
					echo json_encode($response);
					exit;

					}
					
					//echo $url;exit;
				}

					if($order->booking_status == 2){
						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold + $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					}
					else{

					$response = array('status' => 1, 'msg' => "Oops.Unable to change the booking status.");
					echo json_encode($response);
					exit;

					}
					

					$booking_confirmation_no = "TK" . str_pad($order->bg_id, 7, '0', STR_PAD_LEFT);
					$updateData = array('booking_status' => $status, 'booking_confirmation_no' => $booking_confirmation_no, 'updated_at' => date("Y-m-d h:i:s"));
				}
		else if ($segment == 'update_payment_seller_status') {

			$order = $this->General_Model->getAllItemTable_Array('booking_global', array('md5(bg_id)' => $_POST['bg_id']))->row();
			if ($_POST['bg_id'] != ""  && $order->bg_id != "") {
				
				$cond = array('md5(bg_id)' => $_POST['bg_id']);
				$updatesellerData = array('seller_payout_status' => $_POST['status']);
				$this->General_Model->update('booking_global', $cond, $updatesellerData);
				//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.Booking Status Updated Successfully.");
			} else {
				$response = array('status' => 0, 'msg' => "Failed to update booking status.Invalid order id.");
			}
			echo json_encode($response);
			exit;
		} else {

					if($order->booking_status == 1 && $status == 2){
						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					}
					else if((($order->booking_status == 1) && ($status == 0 || $status == 3))){

						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('quantity', "quantity + $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);

					}
					else if((($order->booking_status == 2) && ($status == 0 || $status == 3))){

						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('quantity', "quantity + $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);

					}
					else if($order->booking_status != 1 && $status == 2){
						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					}
					else{
							if((($order->booking_status == 2) && ($status == 4 || $status == 5 || $status == 6))){

							$response = array('status' => 1, 'msg' => "Oops.Unable to change the booking status.");
							echo json_encode($response);
							exit;
							}
					}

					$updateData = array('cancel_reason'		=> $cancel_reason ,'booking_status' => $status, 'booking_confirmation_no' => '', 'updated_at' => date("Y-m-d h:i:s"));
				}
				$cond = array('md5(bg_id)' => $_POST['bg_id']);

				$this->General_Model->update('booking_global', $cond, $updateData);

				if($_POST['status'] == 4 || $_POST['status'] == 5 || $_POST['status'] == 6){
				$cond = array('md5(bg_id)' => $_POST['bg_id']);
				$updatesellerData = array('seller_status' => 3);
				$this->General_Model->update('booking_global', $cond, $updatesellerData);
				}

				if($_POST['status'] == 3){
				$cond = array('md5(bg_id)' => $_POST['bg_id']);
				$updatesellerData = array('seller_status' => 7);
				$this->General_Model->update('booking_global', $cond, $updatesellerData);
				}

				if($_POST['mail_enable'] == 1){

					$handle = curl_init();
					$url = API_MAIL_URL.$order->bg_id;
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
					/*echo "<pre>";print_r($output);exit;
					echo $url;exit;*/
				}
				//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.Booking Status Updated Successfully.");
			} else {
				$response = array('status' => 0, 'msg' => "Failed to update booking status.Invalid order id.");
			}
			echo json_encode($response);
			exit;
			
		
		
		/*


			$order = $this->General_Model->getAllItemTable_Array('booking_global', array('md5(bg_id)' => $_POST['bg_id']))->row();
			if ($_POST['bg_id'] != "" && $_POST['status'] != "" && $order->bg_id != "") {

				$status = $_POST['status'];
				$cancel_reason = @$_POST['reason'];
				if ($status == 1) {

					if($order->booking_status == 2){
						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold + $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					}
					else{

					$response = array('status' => 1, 'msg' => "Oops.Unable to change the booking status.");
					echo json_encode($response);
					exit;

					}
					

					$booking_confirmation_no = "TK" . str_pad($order->bg_id, 7, '0', STR_PAD_LEFT);
					$updateData = array('booking_status' => $status, 'booking_confirmation_no' => $booking_confirmation_no, 'updated_at' => date("Y-m-d h:i:s"));
				}
		else if ($segment == 'update_payment_seller_status') {

			$order = $this->General_Model->getAllItemTable_Array('booking_global', array('md5(bg_id)' => $_POST['bg_id']))->row();
			if ($_POST['bg_id'] != ""  && $order->bg_id != "") {
				
				$cond = array('md5(bg_id)' => $_POST['bg_id']);
				$updatesellerData = array('seller_payout_status' => $_POST['status']);
				$this->General_Model->update('booking_global', $cond, $updatesellerData);
				//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.Booking Status Updated Successfully.");
			} else {
				$response = array('status' => 0, 'msg' => "Failed to update booking status.Invalid order id.");
			}
			echo json_encode($response);
			exit;
		} else {

					if($order->booking_status == 1 && $status == 2){
						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					}
					else if((($order->booking_status == 1) && ($status == 0 || $status == 3))){

						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('quantity', "quantity + $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);

					}
					else if((($order->booking_status == 2) && ($status == 0 || $status == 3))){

						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('quantity', "quantity + $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);

					}
					else if($order->booking_status != 1 && $status == 2){
						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('md5(booking_id)' => $_POST['bg_id']))->row();

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);
					}
					else{
							if((($order->booking_status == 2) && ($status == 4 || $status == 5 || $status == 6))){

							$response = array('status' => 1, 'msg' => "Oops.Unable to change the booking status.");
							echo json_encode($response);
							exit;
							}
					}

					$updateData = array('cancel_reason'		=> $cancel_reason ,'booking_status' => $status, 'booking_confirmation_no' => '', 'updated_at' => date("Y-m-d h:i:s"));
				}
				$cond = array('md5(bg_id)' => $_POST['bg_id']);

				$this->General_Model->update('booking_global', $cond, $updateData);

				if($_POST['status'] == 3){
				$cond = array('md5(bg_id)' => $_POST['bg_id']);
				$updatesellerData = array('seller_status' => 7);
				$this->General_Model->update('booking_global', $cond, $updatesellerData);
				}

				if($_POST['mail_enable'] == 1){

					$handle = curl_init();
					$url = API_MAIL_URL.$order->bg_id;
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
					//echo "<pre>";print_r($output);exit;
					//echo $url;exit;
				}
				//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.Booking Status Updated Successfully.");
			} else {
				$response = array('status' => 0, 'msg' => "Failed to update booking status.Invalid order id.");
			}
			echo json_encode($response);
			exit;
		*/} else if ($segment == 'update_ticket_status') 
		{
			

					$ticket_type = $_POST['ticket_type'];
					if($ticket_type == 2 || $ticket_type == 3 || $ticket_type == 4 || $ticket_type == 1){


					$tickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('md5(booking_id)' => $_POST['ticket_id']))->result();
				
					foreach($tickets as $upticket){

					$order = $this->General_Model->getAllItemTable_Array('booking_etickets', array('md5(id)' => md5($upticket->id)))->row();
					$booking_id = $order->booking_id;
					//echo 'booking_id = '.$order->booking_id;exit;
					if ($_POST['status'] != "" && $order->id != "") {

						$status = $_POST['status'];
						$updateData = array('ticket_status' => $status, 'reject_reason' => $_POST['reason'],'ticket_approve_date' => date("Y-m-d H:i:s") ,'ticket_email_status' => 1);
						$cond = array('id' => $order->id);
						
						$done = $this->General_Model->update('booking_etickets', $cond, $updateData);
						if($done == true){

							if($status == 2){
							$ticket_status = '2';
							}
							else if($status == 6){
							$ticket_status = '3';
							}
							
							
						}
					
					} else {
						$response = array('status' => 0, 'msg' => "Failed to update E-Ticket status.Invalid Ticket id.");
						echo json_encode($response);
						exit;
					}
				}

				$updateData = array('delivery_status' => $ticket_status);
				if($ticket_status == '2'){
					$updateData['seller_status'] = 3;
					$updateData['booking_status'] = 5;
				}
				$cond = array('bg_id' => $booking_id);
				//echo "<pre>";print_r($updateData);exit;
				$this->General_Model->update('booking_global', $cond, $updateData);

				if($ticket_status == '2'){

					$post_data = array("bg_id" => $booking_id);
					$handle = curl_init();
					$url = API_CRON_URL.'admin-approve-notfication';
					curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					'domainkey: https://www.1boxoffice.com/en/'
					));
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					curl_close($handle);
				}
				//if($status == 2  ||  $status == 6 ){
				if($status == 6 ){
					$post_data = array("bg_id" => $booking_id);
					$handle = curl_init();
					$url = API_CRON_URL.'seller-reject-notfication';
					curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					'domainkey: https://www.1boxoffice.com/en/'
					));
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					curl_close($handle);
				}

						//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.Ticket Status Updated Successfully.");

			echo json_encode($response);
			exit;
			}
			else{ 
				//echo "else <pre>";print_r($_POST);exit;
				$tickets = $this->General_Model->getAllItemTable_Array('booking_ticket_tracking', array('md5(booking_id)' => $_POST['ticket_id']))->row();

					if ($_POST['status'] != "" && $tickets->tracking_id != "") {
				$booking_id = $tickets->booking_id;
				$status = $_POST['status'];
				$updateData = array('pod_status' => $status, 'reject_reason' => $_POST['reason']);
				$cond = array('tracking_id' => $tickets->tracking_id);
				$done = $this->General_Model->update('booking_ticket_tracking', $cond, $updateData);
				
				if($done == true){
					if($status == 2){
					$ticket_status = '2';
					}
					else if($status == 6){
					$ticket_status = '3';
					}
					
					$updateData = array('delivery_status' => $ticket_status);
					$cond = array('bg_id' => $booking_id);
					if($ticket_status == '2'){
					$updateData['seller_status'] = 3;
					$updateData['booking_status'] = 5;
					}
					$this->General_Model->update('booking_global', $cond, $updateData);

					if($ticket_status == '2'){

						/*$post_data = array("bg_id" => $booking_id);
						$handle = curl_init();
					$url = API_CRON_URL.'admin-pod-approve-notfication';
					curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					'domainkey: https://www.1boxoffice.com/en/'
					));
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					curl_close($handle);*/

					}

						//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.Ticket POD Status Updated Successfully.");

			echo json_encode($response);
			exit;
				}
			
			} else {
				$response = array('status' => 0, 'msg' => "Failed to update Ticket POD status.Invalid Ticket id.");
				echo json_encode($response);
				exit;
			}
			}
		
		} 

		else if ($segment == 'ajax_update_ticket_status') {
			$update_cnt=0;
			$failed_update_cnt=0;
			foreach($_POST['ticket_id'] as $key=>$value)
			{
					$ticket_type="";
			
					 $ip_ticket_type = $_POST['org_order_id'][$key];
					$query_ticket_type = $this->General_Model->get_ticket_type($ip_ticket_type)->result();	
					$ticket_type=$query_ticket_type[0]->ticket_type;

					if($ticket_type == 2 || $ticket_type == 4){

					$tickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('md5(booking_id)' => $_POST['ticket_id'][$key]))->result();
				
					foreach($tickets as $upticket){

					$order = $this->General_Model->getAllItemTable_Array('booking_etickets', array('md5(id)' => md5($upticket->id)))->row();
					$booking_id = $order->booking_id;
					//echo 'booking_id = '.$order->booking_id;exit;
					if ($_POST['status'] != "" && $order->id != "") {

						$status = $_POST['status'];
						$updateData = array('ticket_status' => $status, 'reject_reason' => $_POST['reason'],'ticket_approve_date' => date("Y-m-d H:i:s") ,'ticket_email_status' => 1);
						$cond = array('id' => $order->id);
						$done = $this->General_Model->update('booking_etickets', $cond, $updateData);
						if($done == true){

							if($status == 2){
							$ticket_status = '2';
							}
							else if($status == 6){
							$ticket_status = '3';
							}
							
							
						}
					
					} else {
						$response = array('status' => 0, 'msg' => "Failed to update E-Ticket status.Invalid Ticket id.");
						$update_cnt++;
						// echo json_encode($response);
						// exit;
					}
				}

				$updateData = array('delivery_status' => $ticket_status);
				if($ticket_status == '2'){
					$updateData['seller_status'] = 3;
					$updateData['booking_status'] = 5;
				}
				$cond = array('bg_id' => $booking_id);
				//echo "<pre>";print_r($updateData);exit;
				$this->General_Model->update('booking_global', $cond, $updateData);

				if($ticket_status == '2'){

					$post_data = array("bg_id" => $booking_id);
					$handle = curl_init();
					$url = API_CRON_URL.'admin-approve-notfication';
					curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					'domainkey: https://www.1boxoffice.com/en/'
					));
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					curl_close($handle);
				}
				if($status == 2  ||  $status == 6 ){
					$post_data = array("bg_id" => $booking_id);
					$handle = curl_init();
					$url = API_CRON_URL.'seller-ticket-approve-reject';
					curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					'domainkey: https://www.1boxoffice.com/en/'
					));
					curl_setopt($handle, CURLOPT_URL, $url);
					curl_setopt($handle, CURLOPT_POST, 1);
					curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($handle);
					curl_close($handle);
				}

						//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.E-Ticket Status Updated Successfully.");
				$update_cnt++;
			// echo json_encode($response);
			// exit;
			}
				else{ //echo "else <pre>";print_r($_POST);exit;
					$tickets = $this->General_Model->getAllItemTable_Array('booking_ticket_tracking', array('md5(booking_id)' => $_POST['ticket_id'][$key]))->row();

						if ($_POST['status'] != "" && $tickets->tracking_id != "") {
					$booking_id = $tickets->booking_id;
					$status = $_POST['status'];
					$updateData = array('pod_status' => $status, 'reject_reason' => $_POST['reason']);
					$cond = array('tracking_id' => $tickets->tracking_id);
					$done = $this->General_Model->update('booking_ticket_tracking', $cond, $updateData);
					if($done == true){
						if($status == 2){
						$ticket_status = '2';
						}
						else if($status == 6){
						$ticket_status = '3';
						}
						
						$updateData = array('delivery_status' => $ticket_status);
						$cond = array('bg_id' => $booking_id);
						if($ticket_status == '2'){
						$updateData['seller_status'] = 3;
						$updateData['booking_status'] = 5;
						}
						$this->General_Model->update('booking_global', $cond, $updateData);

						if($ticket_status == '2'){

							/*$post_data = array("bg_id" => $booking_id);
							$handle = curl_init();
						$url = API_CRON_URL.'admin-pod-approve-notfication';
						curl_setopt($handle, CURLOPT_HTTPHEADER, array(
						'domainkey: https://www.1boxoffice.com/en/'
						));
						curl_setopt($handle, CURLOPT_URL, $url);
						curl_setopt($handle, CURLOPT_POST, 1);
						curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
						curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
						$output = curl_exec($handle);
						curl_close($handle);*/

						}

							//echo $this->db->last_query();exit;
					$response = array('status' => 1, 'msg' => "Success.Ticket POD Status Updated Successfully.");
					$update_cnt++;
				// echo json_encode($response);
				// exit;
					}
			
			} else {
				$response = array('status' => 0, 'msg' => "Failed to update Ticket POD status.Invalid Ticket id.");
				// echo json_encode($response);
				// exit;
				++$failed_update_cnt;
			}
			}

			//echo $key.'<br/>';
		}
		$response['update_cnt']=$update_cnt." Tickets Approved.";
		$response['failed_update_cnt']=$failed_update_cnt." Ticket Rejected.";
		echo json_encode($response);
				exit;
		}
		else if($segment =='ajax_update_pending_orders')
		{	
			$status=$_POST['status'];
			$cancel_reason=@$_POST['reason'];
			$update_cnt=0;
			$failed_update_cnt=0;

			foreach ($_POST['org_order_id'] as $key => $value) {
				$order = $this->General_Model->getAllItemTable_Array('booking_global', array('bg_id' => $value))->row();
				
				// Confirmed 
				if ($status == 1) {
					if (strtolower(trim($order->source_type)) == 'tixstock') {
						$url = base_url() . 'tixstock/orderConfirm';
						$post_data = array("bg_id" => $order->bg_id, "tixstock_status" => 'Approved');

					$tixresponse = $this->sendCurlRequest($url, $post_data);
					//$tixresponse['tixstock_status'] = "Approved" ;
						if ($tixresponse['tixstock_status'] == "Approved" && $order->booking_status == 2) {
							$this->updateSellTickets($order->bg_id);

							$booking_confirmation_no = "TK" . str_pad($order->bg_id, 7, '0', STR_PAD_LEFT);
							$updateData = array('booking_status' => $status, 'booking_confirmation_no' => $booking_confirmation_no, 'updated_at' => date("Y-m-d h:i:s"));

							$cond = array('bg_id' => $order->bg_id);
							$this->General_Model->update('booking_global', $cond, $updateData);

							$sendMail = $this->sendCurlMail($order->bg_id);

							$response = array('status' => 0, 'msg' => "Booking status successfully changed.");
							++$update_cnt;
						//	echo json_encode($response);
							// exit;

						} else {
							$response = array('status' => 1, 'msg' => "Oops. Unable to change the booking status.");
							++$failed_update_cnt;
							//echo json_encode($response);
							//exit;
						}
					} else if (strtolower(trim($order->source_type)) == '1boxoffice' && $order->booking_status == 2) {
						$this->updateSellTickets($order->bg_id);

						$booking_confirmation_no = "TK" . str_pad($order->bg_id, 7, '0', STR_PAD_LEFT);
						$updateData = array('booking_status' => $status, 'booking_confirmation_no' => $booking_confirmation_no, 'updated_at' => date("Y-m-d h:i:s"));
						
						$cond = array('bg_id' => $order->bg_id);
						$this->General_Model->update('booking_global', $cond, $updateData);
						$sendMail = $this->sendCurlMail($order->bg_id);

						$response = array('status' => 0, 'msg' => "Booking status successfully changed.");
						++$update_cnt;
						//echo json_encode($response);
						// exit;
					} else {

						$response = array('status' => 1, 'msg' => "Oops. Unable to change the booking status.");
						++$failed_update_cnt;
						// echo json_encode($response);
						// exit;
					}
				}
				// Cancelled 
				else if ($status == 3) {
					if (strtolower(trim($order->source_type)) == 'tixstock') {
						$url = base_url() . 'tixstock/orderConfirm';
						$post_data = array("bg_id" => $order->bg_id, "tixstock_status" => 'Approved');

						$tixresponse = $this->sendCurlRequest($url, $post_data);
						//$tixresponse['tixstock_status']="Cancelled";
						if ($tixresponse['tixstock_status'] == "Cancelled" ) {
							//$this->updateSellTickets($order->bg_id);

							$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('booking_id' => $order->bg_id))->row();

								$this->db->set('sold', "sold - $booking_tickets->quantity", false);
								$this->db->where('s_no', $booking_tickets->ticket_id);
								$this->db->update('sell_tickets', $data);


							$booking_confirmation_no = "TK" . str_pad($order->bg_id, 7, '0', STR_PAD_LEFT);
							$updateData = array('cancel_reason'		=> $cancel_reason,'booking_status' => $status, 'booking_confirmation_no' => $booking_confirmation_no, 'updated_at' => date("Y-m-d h:i:s"));

														
							$cond = array('bg_id' => $order->bg_id);
							$this->General_Model->update('booking_global', $cond, $updateData);

							 $response = array('status' => 0, 'msg' => "Success.Your Booking Cancelled Successfully.");
							 ++$update_cnt;
							// echo json_encode($response);
							// exit;

						} else {
							$response = array('status' => 1, 'msg' => "Oops. Unable to change the booking status.");
							++$update_cnt;
						//	echo json_encode($response);
						//	exit;
						}
					} else if (strtolower(trim($order->source_type)) == '1boxoffice') {

						$booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('booking_id' => $order->bg_id))->row();

						$this->db->set('sold', "sold - $booking_tickets->quantity", false);
						$this->db->where('s_no', $booking_tickets->ticket_id);
						$this->db->update('sell_tickets', $data);


						$booking_confirmation_no = "TK" . str_pad($order->bg_id, 7, '0', STR_PAD_LEFT);
						$updateData = array('cancel_reason'		=> $cancel_reason,'booking_status' => $status, 'booking_confirmation_no' => $booking_confirmation_no, 'updated_at' => date("Y-m-d h:i:s"));

						
						$cond = array('bg_id' => $order->bg_id);
						$this->General_Model->update('booking_global', $cond, $updateData);

						 $response = array('status' => 1, 'msg' => "Success.Your Booking Cancelled Successfully.");
						 ++$update_cnt;
						// echo json_encode($response);
						// exit;
					} else {

						$response = array('status' => 1, 'msg' => "Oops. Unable to change the booking status.");
						//echo json_encode($response);
						//exit;
						++$failed_update_cnt;
					}
				} else {
					$response = array('status' => 1, 'msg' => "Oops. Unable to change the booking status.");
					++$failed_update_cnt;
					// echo json_encode($response);
					// exit;
				}
			}
			$response['update_cnt']=$update_cnt." Tickets Approved.";
			$response['failed_update_cnt']=$failed_update_cnt." Ticket Rejected.";
			echo json_encode($response);
						exit;
		}
		else if ($segment == 'send_mail_ticket_status') {

				$ticket_type = $_POST['ticket_type'];
				@$email = $_POST['email'];
				//@$email = "gpandiyan.tech@gmail.com";
				//  echo API_CRON_URL;
				// print_r($_POST);
				//die;
				if($ticket_type >  1){

					$tickets = $this->General_Model->getAllItemTable_Array('booking_etickets', array('md5(booking_id)' => $_POST['ticket_id']))->row();


					$updateData = array('ticket_email_status' => 1);
					$cond = array('booking_id' =>  $tickets->booking_id);
					$done = $this->General_Model->update('booking_etickets', $cond, $updateData);
		

					$post_data = array("bg_id" => $tickets->booking_id,'email_address' => $email);
					
					//$handle = curl_init();
					// $url = API_CRON_URL.'admin-approve-notfication';
					// curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					// 'domainkey: https://www.1boxoffice.com/en/'
					// ));
					// curl_setopt($handle, CURLOPT_URL, $url);
					// curl_setopt($handle, CURLOPT_POST, 1);
					// curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
					// curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					// $output = curl_exec($handle);
					// curl_close($handle);
				

						//echo $this->db->last_query();exit;
				$response = array('status' => 1, 'msg' => "Success.E-Ticket Status Updated Successfully.");

			echo json_encode($response);
			exit;
			}
			else {
				$response = array('status' => 0, 'msg' => "Email Failed");
				echo json_encode($response);
				exit;
			}
	
			
		
		}
		else if ($segment == 'abandoned') { 
			$row_count = $this->uri->segment(5);
			$flag = $this->uri->segment(4);
			// $this->data['getMySalesData'] = $this->General_Model->abondaned()->result();
			// $this->load->view('game/abandoned', $this->data);

		//	$this->loadRecord($row_count, 'booking_global', 'game/orders/abandoned/'.$flag, 'bg_id', 'DESC', 'game/abandoned', 'getMySalesData', 'abandoned', $flag);

		$country = "";
	$records = $this->General_Model->get_country_name()->result();
	
	foreach($records as $record ){
		$country .=   ' <div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" id="country'.$record->id.'">
		<label class="custom-control-label" for="country'.$record->id.'">'.ucfirst($record->name).'</label>
	  </div>';

	}


		$this->data['country'] = $country;
		// echo '<pre/>';
		// print_r($this->data);
		// exit;

			$this->load->view(THEME.'/game/abandoned', $_POST,$this->data);

		} else if ($segment == 'abondaned_details') {
			$segment4 = $this->uri->segment(4);
			$this->data['orderData'] = $this->General_Model->abondaned($segment4)->row();
			if($this->data['orderData']->listing_note != ''){
				$this->data['seller_notes'] = 		$this->General_Model->get_seller_notes($this->data['orderData']->listing_note);

			} //echo "<pre>";print_r($this->data['seller_notes']);
			//exit;
			$this->load->view('game/abondaned_details', $this->data);
		} else if ($segment == 'payment_details') {
			$segment4 = $this->uri->segment(4);
			$this->data['orderData'] =  $this->General_Model->getOrderData($segment4);
			$this->load->view(THEME.'game/payment_details', $this->data);
		} else if ($segment == 'details') {
			$segment4 = $this->uri->segment(4);

			$this->data['orderData'] =  $this->General_Model->getOrderData($segment4);			
			
			//if($_SERVER['REMOTE_ADDR'] == "2.16.198.36"){
				
				//echo $this->data['orderData']->bg_id.'='.$this->data['orderData']->bt_id;exit;
				$this->data['eticketDatas'] = 		$this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();
				//echo $this->db->last_query();exit;
				//arp
			//}

				if($_SERVER['REMOTE_ADDR'] == "2.17.106.5"){

					//echo "<pre>";print_r($this->data['eticketDatas']);exit;
				}
				//echo $_SERVER['REMOTE_ADDR'];exit;
			
			$this->data['eticketData'] = 		$this->General_Model->get_download_tickets(array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();
			$this->data['order_tickets'] = 		$this->General_Model->get_order_tickets(array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();
			$this->data['nominees'] = 		$this->General_Model->get_nominees(array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();
			if($this->data['orderData']->listing_note != ''){
				$this->data['seller_notes'] = 		$this->General_Model->get_seller_notes($this->data['orderData']->listing_note);
			}

			// echo '<pre/>';
			// print_r($this->data['eticketDatas']);
			// exit;	
			
			$this->data['flag'] = 0; // Initialize flag as 0
// echo '<pre/>';
// print_r($this->data['eticketDatas']);
// exit;
			foreach ($this->data['eticketDatas'] as $op_object) {
				if ($op_object->ticket_file !== "") {
					$this->data['flag'] = 1;
				}
			}
			
			$this->load->view(THEME.'/game/order_info', $this->data);
		}
		else if ($segment == 'upload_e_ticket') {
			$segment4 = $this->uri->segment(4);

			$this->data['orderData'] =  $this->General_Model->getOrderData($segment4);
			$this->data['eticketData'] = 		$this->General_Model->getAllItemTable_Array('booking_etickets', array('booking_id' => $this->data['orderData']->bg_id, 'ticket_id' => $this->data['orderData']->bt_id))->result();
			//echo $this->db->last_query();exit;
			// echo '<pre/>';
			// print_r($this->data['eticketData']);
			// exit;
		
			$this->load->view(THEME.'/game/upload_e_ticket', $this->data);

		} else if ($segment == 'add_order_old') {
			if ($this->input->get('match_id')) {
				$this->data['matchInfo'] = $this->data['getMatchInfo'] = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $this->input->get('match_id')))->result();
				$this->data['event_popup_message'] = $this->General_Model->getAllItemTable_Array('event_popup_message')->result();

				if ($this->data['matchInfo'] && $this->data['matchInfo'][0]->event_type == 'match') {

					$this->data['matchId'] = $this->data['matchInfo'][0]->m_id;
					$stadiumid = $this->data['matchInfo'][0]->venue;
					$team1 = $this->data['matchInfo'][0]->team_1;
					$team2 = $this->data['matchInfo'][0]->team_2;
					$tournamentId = $this->data['matchInfo'][0]->tournament;

					if (!empty($value) && !empty($this->session->userdata('id'))) {
						$matchlivesearchdata = $this->General_Model->getAllItemTable_Array('live_search', array('match_id' => $this->data['matchId'], 'user_id' => $this->session->userdata('id')))->result();
						$duplicateCheck = sizeof($matchlivesearchdata);
						if ($duplicateCheck == 0) {
							$insertData = array();
							$insertData['match_id'] = $this->data['matchId'];
							$insertData['user_id'] = $this->session->userdata('id');
							$insertData['count'] = 1;
							$insertData['create_date'] = date('Y-m-d H:i:s');
							$insert = $this->Settings_model->insert('live_search', $insertData);
						}
					}

					$this->data['tournamentName'] = $this->General_Model->getAllItemTable_Array('tournament', array('t_id' => $tournamentId))->result();
					$this->data['team1Image'] = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $team1))->result();
					$this->data['team2Image'] = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $team2))->result();
					$this->data['stadiumImage'] = $this->General_Model->getAllItemTable_Array('stadium', array('s_id' => $stadiumid))->result();

					// $ticket_extra_fee = $this->General_Model->getAllItemTable_Array('seller_percentage')->result();
					// $extra_fee_percent = (float) $ticket_extra_fee[0]->site_fee;
					$extra_fee_percent = 0;
					$stad_dtl = $this->General_Model->getAllItemTable_Array('stadium_details', array('stadium_id' => $stadiumid))->result();

					$tot_cats = [];
					$stadium_category = $this->General_Model->getAllItemTable_Array('stadium_seats')->result();
					if ($stadium_category) {
						foreach ($stadium_category as $std_cat) {
							// $tot_cats[$std_cat->seat_category]=$std_cat->id;
							$tot_cats[$std_cat->id] = $std_cat->id;
						}
					}
					$set_stadium_blocks = [];
					$set_stadium_blocks_with_cat = [];
					$set_stadium_cat_name = [];
					if ($stad_dtl) {
						foreach ($stad_dtl as $stdm) {
							$set_stadium_blocks[$stdm->block_id] = $stdm->block_color;
							$set_stadium_blocks_with_cat[$tot_cats[$stdm->category]][] = $stdm->block_id;
							$set_stadium_cat_name[$stdm->category][] = $tot_cats[$stdm->category];
						}
					}

					$sell_ticket_data = $this->General_Model->getAllItemTable_Array('sell_tickets', array('match_id' => $this->data['matchInfo'][0]->m_id), NULL, NULL, NULL, array('s_no', 'desc'))->result();
					$this->data['checkSellTicketData'] = $sell_ticket_data;

					$ticket_price_info = [];
					$ticket_price_info_with_cat = [];
					if ($sell_ticket_data && $this->data['matchInfo'][0]->availability == 1) {

						foreach ($sell_ticket_data as $sl_tckt) {

							$lowest_price = (($extra_fee_percent / 100) * (float) $sl_tckt->price) + (float) $sl_tckt->price;
							// $ticket_price_info[$sl_tckt->ticket_category][$sl_tckt->ticket_block]['price'][] = $this->currencyConverterMap2($lowest_price, $sl_tckt->price_type, $this->session->userdata('currency'));
							$ticket_price_info[$sl_tckt->ticket_category][$sl_tckt->ticket_block]['price'][] = $lowest_price;
							$ticket_price_info[$sl_tckt->ticket_category][$sl_tckt->ticket_block]['no_of_ticket'][] = (int) $sl_tckt->quantity;
						}
					}

					if ($ticket_price_info) {
						foreach ($ticket_price_info as $cat_key => $tckt_prc) {
							$tckt_price = [];
							$tckt_ticket = 0;
							foreach ($tckt_prc as $sub_tckt_prc) {
								$tckt_price = array_merge($sub_tckt_prc['price'], $tckt_price);
								$tckt_ticket = (float) $tckt_ticket + array_sum($sub_tckt_prc['no_of_ticket']);
							}
							$ticket_price_info_with_cat[$cat_key]['name'] = array_search($cat_key, $tot_cats);
							$ticket_price_info_with_cat[$cat_key]['price'] = min($tckt_price);
							$ticket_price_info_with_cat[$cat_key]['no_of_ticket'] = $tckt_ticket;
						}
					}

					$this->data['selected_customer'] = $this->General_Model->getAllItemTable_Array('register', array('id' => $this->input->get('customer_id')))->row();
					$this->data['ticket_price_info'] = json_encode($ticket_price_info);
					$this->data['ticket_price_info_with_cat'] = json_encode($ticket_price_info_with_cat);
					$this->data['set_stadium_blocks'] = json_encode($set_stadium_blocks);
					$this->data['set_stadium_blocks_with_cat'] = json_encode($set_stadium_blocks_with_cat);
					$this->data['set_stadium_cat_name'] = json_encode($set_stadium_cat_name);
					$this->data['get_std'] = $this->General_Model->getAllItemTable_Array('stadium', array('s_id' => $this->data['matchInfo'][0]->venue))->result();
					$this->data['get_city'] = $this->General_Model->getAllItemTable_Array('states', array('id' => $this->data['matchInfo'][0]->state))->result();
					$this->data['get_tournament'] = $this->General_Model->getAllItemTable_Array('tournament', array('t_id' => $this->data['matchInfo'][0]->tournament, 'language'))->result();
				}
			}

			$this->data['cid'] = $this->input->get('cid');

			if ($this->data['cid'] != '') {

				$this->data['sessionArray'] = $sessionArray = $this->session->userdata('sessionValue');
				$this->data['matcheventdetails'] = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $sessionArray['matcheventid']))->result();

				$this->data['stadiumdetails'] = $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $sessionArray['sellticketid']))->result();

				$this->data['selected_customer'] = $this->General_Model->getAllItemTable_Array('register', array('id' => $this->input->get('customer_id')))->row();

				$sellerPercentageData = $this->General_Model->getAllItemTable('seller_percentage')->result();

				$defaultPrice = $this->data['stadiumdetails'][0]->price;
				$this->data['totalCartPrice'] = $defaultPrice;
				if (empty($this->data['totalCartPrice'])) {
					$this->data['totalCartPrice'] = '10.00';
				}
				$this->data['priceType'] = $this->data['stadiumdetails'][0]->price_type;
				$this->data['settings'] = $this->General_Model->getSiteSettings();

				$this->data['myaddresses'] = $this->General_Model->getAllItemTable_Array('addresses', array('user_id' => $this->input->get('customerid'), 'set_default' => 1))->result();
				$this->data['addresses'][0] = $this->data['myaddresses'][0];

				if (count($this->data['addresses']) > 0) {
					$this->data['getRegisterDataByid'] = $this->db->query("SELECT s.name as first_name , s.surname as last_name ,s.address,s.country,s.province as state,s.phone as mobile,s.postal_code as code,s.dialing_code as phonecode ,s.phone as phone,s.city as city,c.email as email FROM addresses as s left join register as c on c.id=s.user_id WHERE s.user_id like '" . $this->input->get('customer_id') . "' and s.set_default = '1'")->result();
				}

				$this->data['allCountries'] = $this->db->query("SELECT * FROM countries ORDER BY name ASC ")->result();
			}


			$this->load->view('game/add_order', $this->data);
		}
		else if($segment == 'get_stadium_api'){
			$stadiumId = $this->input->post('stadiumid');

			$this->load->library('curl');

			$url = 'get_stadium_id?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
			$post_data = array("stadium_id" => $stadiumId);

			$response =  $this->curl->post($url,$post_data);
			$result = $response['result'];
			$inputValidation = "OK";
			$set['Status'] = $inputValidation;
			$set['Json'] = $result;


			echo $val = json_encode($set);
		}
		else if ($segment == 'add_order') {
		//	ini_set('display_errors', 1);
		//	ini_set('display_startup_errors', 1);
		//	error_reporting(E_ALL);
			$this->data['events_list'] = $this->General_Model->get_match_tournments();

			$this->data['selected_customer'] = $this->General_Model->getAllItemTable_Array('register', array('id' => $this->input->get('customer_id')))->row();

			if ($this->input->get('match_id')) {
				$this->load->library('curl');


				$matchs= $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $this->input->get('match_id')))->row();
				//echo "<pre>";print_r($matchs); die;
				$slug = $matchs->slug;
				//$slug = "world-cup-2022-germany-vs-japan-tickets";
				$url = 'match_details?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
				// echo $this->session->userdata('currency');
				// die;
				//echo $url;die;
				$post_data = array("slug" => $slug);

				$response =  $this->curl->post($url,$post_data);
				//echo print_r($post_data);die;
				 // echo "<pre>";print_r($response);
				 // die;
		        $results  = $response['result'];
		        $prices   = $response['price'];
		        $category = $response['category_list'];
		        $ticketQuantity = $response['quantity'];
		        $seatList = $response['seat_list'];
		        $this->data['results'] = $results;
		        $this->data['category'] = $category;
		        $this->data['ticketQuantity'] = $ticketQuantity;

		        $this->data['set_stadium_blocks'] = $response['set_stadium_blocks'];
		        $this->data['full_block_data'] = $response['full_block_data'];
		        $this->data['set_stadium_blocks_with_cat'] = $response['set_stadium_blocks_with_cat'];
		        $this->data['set_stadium_cat_name'] = $response['set_stadium_cat_name'];
		        $this->data['ticket_price_info'] = $response['ticket_price_info'];
		        $this->data['ticket_price_info_with_cat'] = $response['ticket_price_info_with_cat'];


		        $this->data['matchId'] = $matchs->m_id;
				$stadiumid = $matchs->venue;
				$team1 = $matchs->team_1;
				$team2 = $matchs->team_2;
				$tournamentId = $matchs->tournament;

				$this->data['tournamentName'] = $this->General_Model->getAllItemTable_Array('tournament', array('t_id' => $tournamentId))->result();
				$this->data['team1Image'] = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $team1))->result();
				$this->data['team2Image'] = $this->General_Model->getAllItemTable_Array('teams', array('teams.id' => $team2))->result();
				$this->data['stadiumImage'] = $this->General_Model->getAllItemTable_Array('stadium', array('s_id' => $stadiumid))->result();

				$this->data['seller_list'] = $this->General_Model->seller_list($matchs->m_id);

				//print_r($this->data['seller_list']);die;

				$this->data['checkSellTicketData'] = $matchs;

		  

			}
			

			$this->data['cid'] = $this->input->get('cid');

			if ($this->data['cid'] != '') {

				$this->data['sessionArray'] = $sessionArray = $this->session->userdata('sessionValue');


				$url = 'cart?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
				$post_data = array(
					"cart_id" => $this->data['cid'],
					"default_currency" => 1
				);

				$response =  $this->curl->post($url,$post_data);
				if(	empty($response['result'])){
					redirect('game/orders/add_order?match_id='.$this->input->get('match_id').'&customer_id='.$this->input->get('customer_id'));
				}
				

				//echo "<pre>";print_r($response);die;

				$this->data['category_details'] = $response['result'];

				$this->data['matcheventdetails'] = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $sessionArray['matcheventid']))->result();

				$this->data['stadiumdetails'] = $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $sessionArray['sellticketid']))->result();

				$this->data['selected_customer'] = $this->General_Model->getAllItemTable_Array('register', array('id' => $this->input->get('customer_id')))->row();

				
				$sellerPercentageData = $this->General_Model->getAllItemTable('seller_percentage')->result();

				$defaultPrice = $this->data['stadiumdetails'][0]->price;
				$this->data['totalCartPrice'] = $defaultPrice;
				if (empty($this->data['totalCartPrice'])) {
					$this->data['totalCartPrice'] = '10.00';
				}
				$this->data['priceType'] = $this->data['stadiumdetails'][0]->price_type;
				$this->data['settings'] = $this->General_Model->getSiteSettings();

				$this->data['myaddresses'] = $this->General_Model->getAllItemTable_Array('addresses', array('user_id' => $this->input->get('customerid'), 'set_default' => 1))->result();
				$this->data['addresses'][0] = @$this->data['myaddresses'][0];

				if (count($this->data['addresses']) > 0) {
					$this->data['getRegisterDataByid'] = $this->db->query("SELECT s.name as first_name , s.surname as last_name ,s.address,s.country,s.province as state,s.phone as mobile,s.postal_code as code,s.dialing_code as phonecode ,s.phone as phone,s.city as city,c.email as email FROM addresses as s left join register as c on c.id=s.user_id WHERE s.user_id like '" . $this->input->get('customer_id') . "' and s.set_default = '1'")->result();
				}

				$this->data['allCountries'] = $this->db->query("SELECT * FROM countries ORDER BY name ASC ")->result();
			}


			//$this->load->view('game/add_order_new', $this->data);
			$this->load->view(THEME.'game/add_order_new', $this->data);

		}

		else if ($segment == 'update_cart') {

			ini_set('display_errors', '1');
			ini_set('display_startup_errors', '1');
			error_reporting(E_ALL);
			$this->load->library('curl');
			$cid = $this->input->get('cid');
			$url = 'update_cart?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
			$post_data = array("cart_id" => $cid,'ip' => $_SERVER['REMOTE_ADDR']);

			$delete_response =  $this->curl->post($url,$post_data);
       

	        $results = $delete_response;
	        if($results['status'] == 1)
	        {   

	            $itemid = array();
	            $old = strtotime(date("m/d/Y h:i:s ", strtotime($results['result']['current_time'])));
	            $new = strtotime(date('m/d/Y, h:i:s',strtotime($results['result']['expriy_datetime'])));
	            $time = ($new - $old);
	            $response = ["message" =>$results['message'],'time' => $time ,'status' => 1];
	            echo json_encode($response);
	        }else 
	        {
	            $response = ["message" => $results['message'] ,'status' => 0];
	           echo json_encode($response);
	        }
		}

		else if ($segment == 'delete_cart') {
			ini_set('display_errors', '1');
			ini_set('display_startup_errors', '1');
			error_reporting(E_ALL);
			$this->load->library('curl');
			$cid = $this->input->get('cid');
			$url = 'delete_cart?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
			$post_data = array("cart_id" => $cid,'ip' => $_SERVER['REMOTE_ADDR']);

			$delete_response =  $this->curl->post($url,$post_data);

			$results = $delete_response;
	        if($results['status'] == 1)
	        {   
	            $response = ["message" =>$results['message'],'status' => 1];
	            echo json_encode($response);
	        }else 
	        {
	            $response = ["message" => $results['message'] ,'status' => 0];
	           echo json_encode($response);
	        }
		}

		else if ($segment == 'get_ticket') {
			// ini_set('display_errors', '1');
			// ini_set('display_startup_errors', '1');
			// error_reporting(E_ALL);
	        $match_id = @$this->input->post('match_id');    
			if($match_id){

			 	$quantity = $this->input->post('quantity');
			  	$category = $this->input->post('category');
			  	$seller_id = $this->input->post('seller_id');
	        	//$results  = $response['result'];

	        	 $url = 'sell_ticket_fliter?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
				$post_data = array("match_id" => $match_id,
								"quantity"		=>$quantity,
								"category"		=>$category,
								"seller_id"		=> $seller_id,
								"default_currency" => 1
								);
				$this->load->library('curl');
				$response =  $this->curl->post($url,$post_data);
				//print_r($response);
				$this->data['sellTicketList'] = @$response['result'] ? $response['result'] : array();
				$html = $this->load->view(THEME.'game/get_ticket',$this->data,true);
				$data =array('html' => $html , 'success' => true);
				echo json_encode($data);
			}
	       
		}
		else if ($segment == 'checkout') {
			// ini_set('display_errors', '1');
			// ini_set('display_startup_errors', '1');
			// error_reporting(E_ALL);
			$data = $this->input->post();

			if (@$this->input->post('request_ticket')) {
				$insertArray = array(
					'event_id' => $this->input->post('matcheventid'),
					'user_id' => $this->input->post('userid'),
					'country' => $this->input->post('country'),
					'block_category' => $this->input->post('category'),
					'quantity' => $this->input->post('nooftick'),
					'special_request' => $this->input->post('message'),
					'status' => 0,
					'request_date' => get_est_time()
				);
				$this->Settings_model->insert('request_tickets', $insertArray);

				$sessionArray = array(
					'matcheventid' => $this->input->post('matcheventid'),
					'stadiumid' => $this->input->post('stadiumid'),
					'noTickets' => $this->input->post('nooftick'),
					'sellticketid' => $this->input->post('sellticketid'),
					'sellerid' => $this->input->post('sellerId')
				);
				$this->session->set_userdata('sessionValue', $sessionArray);

				//Notification message
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success', $this->lang->line('added_success')));
				redirect('game/checkout');
			}

			if ($this->input->post('sessionset')) {
				
				$this->load->library('curl');


				// $matchs= $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $this->input->get('matcheventid')))->row();
				// //echo "<pre>";print_r($matchs); die;
				// $slug = $matchs->slug;
				//$slug = "world-cup-2022-germany-vs-japan-tickets";
				$url = 'add_to_cart?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');


				$post_data = array(
			            'match_id'      => $this->input->post('matcheventid'),
			            'quantity'      => $this->input->post('nooftick'),
			            'sell_ticket_id'=> $this->input->post('sellticketid'),
			            'oneclicket_id'=> $this->input->post('oneclicket_id'),
			            'tixstock_id'=> $this->input->post('tixstock_id'),
			            'stadium_id'    => $this->input->post('stadiumid'),
			            'ip'            => $_SERVER['REMOTE_ADDR'],
			        );
				//echo "<pre>";print_r($post_data); die;
				$response =  $this->curl->post($url,$post_data);
				//echo "<pre>";print_r($response); die;
		        //Session::put('cart_id', trim($results['cart_id']));
        		//Session::put('cart_quantity', trim($request->quantity));
				$cid = $response['result']['cart_id'];
				$sessionArray = array(
					'matcheventid' => $this->input->post('matcheventid'),
					'stadiumid' => $this->input->post('stadiumid'),
					'noTickets' => $this->input->post('nooftick'),
					'sellticketid' => $this->input->post('sellticketid'),
					'sellerid' => $this->input->post('sellerId'),
					'cid' => $cid

				);
				//echo "<pre>";print_r($sessionArray); die;
				$this->session->set_userdata('sessionValue', $sessionArray);
			}
			$this->data['sessionArray'] = $sessionArray = $this->session->userdata('sessionValue');
			$this->data['matcheventdetails'] = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $sessionArray['matcheventid']))->result();
			if ($this->data['matcheventdetails']) {
				$response = array('status' => 1, 'match_id' => $sessionArray['matcheventid'], 'customer_id' => $this->input->post('customerid'), 'cid' => $cid);
			} else {
				$response = array('status' => 1, 'msg' => "Invalid match event details");
			}
			echo json_encode($response);
			exit;

			/*

			if (!$this->session->userdata('sessionValue')) {
				redirect('home');
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success', "No select any match...!"));
			}

			$this->data['sessionArray'] = $sessionArray = $this->session->userdata('sessionValue');
			$this->data['matcheventdetails'] = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $sessionArray['matcheventid']))->result();

			$this->data['stadiumdetails'] = $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $sessionArray['sellticketid']))->result();

			$this->data['selected_customer'] = $this->General_Model->getAllItemTable_Array('register', array('id' => $this->input->post('customerid')))->row();

			$sellerPercentageData = $this->General_Model->getAllItemTable('seller_percentage')->result();

			$defaultPrice = $this->data['stadiumdetails'][0]->price;
			$percentage = ($sellerPercentageData[0]->site_fee / 100) * $defaultPrice;

			$this->data['totalPrice'] = $defaultPrice + $percentage;
			if (empty($this->data['totalPrice'])) {
				$this->data['totalPrice'] = '10.00';
			}
			$this->data['priceType'] = $this->data['stadiumdetails'][0]->price_type;


			$this->data['settings'] = $this->General_Model->getSiteSettings();

			$this->data['myaddresses'] = $this->General_Model->getAllItemTable_Array('addresses', array('user_id' => $this->input->post('customerid'), 'set_default' => 1))->result();
			$this->data['addresses'][0] = $this->data['myaddresses'][0];

			if (count($this->data['addresses']) > 0) {
				$this->data['getRegisterDataByid'] = $this->db->query("SELECT s.name as first_name , s.surname as last_name ,s.address,s.country,s.province as state,s.phone as mobile,s.postal_code as code,s.dialing_code as phonecode ,s.phone as phone,s.city as city,c.email as email FROM addresses as s left join register as c on c.id=s.user_id WHERE s.user_id like '" . $this->session->userdata('id') . "' and s.set_default = '1'")->result();
			}

			$this->data['allCountries'] = $this->db->query("SELECT * FROM countries ORDER BY name ASC ")->result();
			if ($this->data['matcheventdetails']) {
				return $this->load->view('game/order_checkout', $this->data);
			} else {
				redirect();

			}*/

		}
		if ($segment == 'save_order_new') {
			/*die;
			ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);*/
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('phoneCode', 'Phone Code', 'required');
			$this->form_validation->set_rules('billingphonenumber', 'Phone Number', 'required');
			$this->form_validation->set_rules('user_id', 'User Id', 'required');
			$this->form_validation->set_rules('billingphonenumber', 'Phone Number', 'required');
			
			if ($this->form_validation->run() !== false) {


				$post_data = array(
						'cart_id'        =>  base64_decode($_POST['cart_id']),
						'title'          => $_POST['title'],
						'first_name'     => $_POST['first_name'],
						'last_name'      => $_POST['last_name'],
						'email'          => $_POST['email'],
						'dialing_code'   => $_POST['phoneCode'],
						'mobile_no'      => $_POST['billingphonenumber'],
						'address'        => $_POST['address'],
						'postal_code'    => $_POST['postcode'],
						'country_id'     => $_POST['country'],
						'state_id'       => $_POST['city'],
						'user_id'		 => $_POST['user_id'],
						'ip_address'     =>  $_SERVER['REMOTE_ADDR'],
					);
				$this->load->library('curl');
				$url = 'checkout?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
				$response =  $this->curl->post($url,$post_data);

				//print_r($response);die;
				$booking_id = @$response['booking_id'];

				$currency_code = $_POST['currency_code'];
				$total_payment = $_POST['price'];
				$txn = 'txn_' . time();
				$payment_data = array(
                        'booking_id'            => $booking_id,
                        'payment_status'        => 1,
                        'transcation_id'        => $txn,
                        'payment_type'          => 2,
                        'payment_response'      => $txn,
                        'total_payment'         => $total_payment,
                        'currency_code'         => $currency_code,
                        'premium_subscription'	=> 0
           	   );

				$url = 'payment_update?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
				$response =  $this->curl->post($url,$payment_data);

            	//echo "<pre>";print_r($response);die;
				$booking_info = $this->General_Model->getAllItemTable_Array('booking_global', array('bg_id' => $booking_id))->row();
            	
				$fresponse = array(
					'status' => 1,
					'msg' => "New Order Created Successfully",
					'redirect_url' => base_url() . 'game/orders/details/'.md5($booking_info->booking_no)
				);

				echo json_encode($fresponse);
				die;
				die;
			}
			else {

				$response = array(
					'status' => 0,
					'msg' => validation_errors(),
					'redirect_url' => base_url() . 'game/orders/list_order'
				);

				echo json_encode($response);
				exit;
			}

			die;
		}
		if ($segment == 'get_postal')
		{
			$getMatchByid = $this->General_Model->getAllItemTable_array('countries', array('id' => $this->input->post('country_id')), NULL, NULL, NULL, array('name', 'asc'))->result();
		$codeCount = COUNT($getMatchByid);
		//State option list
		if ($codeCount > 0) {
			foreach ($getMatchByid as $getMatch) {
				echo '+' . $getMatch->phonecode . '||' . strtolower($getMatch->sortname);
			}
		} else {
			echo '';
		}
		}
		if ($segment == 'get_cities')
		{
		if (!empty($this->input->post('country_id'))) {
			$getMatchByid = $this->General_Model->getAllItemTable_array('states', array('country_id' => $this->input->post('country_id')), NULL, NULL, NULL, array('name', 'asc'))->result();
			$statesCount = COUNT($getMatchByid);
			if ($statesCount > 0) {
				$state = $this->input->post('state');
				echo '<option value="">Select State</option>';
				foreach ($getMatchByid as $getMatch) {
					$selected = '';
					if ($state == $getMatch->id) {
						$selected = 'selected="selected"';
					}
					echo '<option value="' . $getMatch->id . '" ' . $selected . '>' . $getMatch->name . '</option>';
				}
			} else {
				echo '<option value="">State not available</option>';
			}
		}
	}

		//  else if ($segment == 'checkout') {
		// 	$data = $this->input->post();

		// 	if (@$this->input->post('request_ticket')) {
		// 		$insertArray = array(
		// 			'event_id' => $this->input->post('matcheventid'),
		// 			'user_id' => $this->input->post('userid'),
		// 			'country' => $this->input->post('country'),
		// 			'block_category' => $this->input->post('category'),
		// 			'quantity' => $this->input->post('nooftick'),
		// 			'special_request' => $this->input->post('message'),
		// 			'status' => 0,
		// 			'request_date' => get_est_time()
		// 		);
		// 		$this->Settings_model->insert('request_tickets', $insertArray);

		// 		$sessionArray = array(
		// 			'matcheventid' => $this->input->post('matcheventid'),
		// 			'stadiumid' => $this->input->post('stadiumid'),
		// 			'noTickets' => $this->input->post('nooftick'),
		// 			'sellticketid' => $this->input->post('sellticketid'),
		// 			'sellerid' => $this->input->post('sellerId')
		// 		);
		// 		$this->session->set_userdata('sessionValue', $sessionArray);

		// 		//Notification message
		// 		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success', $this->lang->line('added_success')));
		// 		redirect('game/checkout');
		// 	}

		// 	if ($this->input->post('sessionset')) {
		// 		$sell_tickets_info = $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $this->input->post('sellticketid')))->result();
		// 		if ($this->input->post('nooftick')) {
		// 			$no_tickets = $this->input->post('nooftick');
		// 		} elseif ($sell_tickets_info[0]->split == '2') {

		// 			$no_tickets = $sell_tickets_info[0]->quantity;
		// 		} elseif ($sell_tickets_info[0]->split == '4') {

		// 			$no_tickets = 2;
		// 		} else {
		// 			$no_tickets = 1;
		// 		}

		// 		$this->General_Model->delete('cart_session', array('ip' => $_SERVER['REMOTE_ADDR']));

		// 		$added_datetime = date("Y-m-d H:i");
		// 		$expiry = date("Y-m-d H:i", strtotime('+10 minutes', strtotime($added_datetime)));
		// 		$insert_cart_session = array(
		// 			'match_id' => $this->input->post('matcheventid'),
		// 			'sell_id' => $this->input->post('sellticketid'),
		// 			'no_ticket' => $no_tickets,
		// 			'ip' => $_SERVER['REMOTE_ADDR'],
		// 			'added_datetime' => $added_datetime,
		// 			'expriy_datetime' => $expiry,
		// 		);
		// 		$cid = $this->General_Model->insert_data('cart_session', $insert_cart_session);


		// 		$sessionArray = array(
		// 			'matcheventid' => $this->input->post('matcheventid'),
		// 			'stadiumid' => $this->input->post('stadiumid'),
		// 			'noTickets' => $no_tickets,
		// 			'sellticketid' => $this->input->post('sellticketid'),
		// 			'sellerid' => $this->input->post('sellerId'),
		// 			'cid' => $cid

		// 		);

		// 		$this->session->set_userdata('sessionValue', $sessionArray);
		// 	}
		// 	$this->data['sessionArray'] = $sessionArray = $this->session->userdata('sessionValue');
		// 	$this->data['matcheventdetails'] = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $sessionArray['matcheventid']))->result();
		// 	if ($this->data['matcheventdetails']) {
		// 		$response = array('status' => 1, 'match_id' => $sessionArray['matcheventid'], 'customer_id' => $this->input->post('customerid'), 'cid' => $cid);
		// 	} else {
		// 		$response = array('status' => 1, 'msg' => "Invalid match event details");
		// 	}
		// 	echo json_encode($response);
		// 	exit;

		// 	/*

		// 	if (!$this->session->userdata('sessionValue')) {
		// 		redirect('home');
		// 		$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success', "No select any match...!"));
		// 	}

		// 	$this->data['sessionArray'] = $sessionArray = $this->session->userdata('sessionValue');
		// 	$this->data['matcheventdetails'] = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $sessionArray['matcheventid']))->result();

		// 	$this->data['stadiumdetails'] = $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $sessionArray['sellticketid']))->result();

		// 	$this->data['selected_customer'] = $this->General_Model->getAllItemTable_Array('register', array('id' => $this->input->post('customerid')))->row();

		// 	$sellerPercentageData = $this->General_Model->getAllItemTable('seller_percentage')->result();

		// 	$defaultPrice = $this->data['stadiumdetails'][0]->price;
		// 	$percentage = ($sellerPercentageData[0]->site_fee / 100) * $defaultPrice;

		// 	$this->data['totalPrice'] = $defaultPrice + $percentage;
		// 	if (empty($this->data['totalPrice'])) {
		// 		$this->data['totalPrice'] = '10.00';
		// 	}
		// 	$this->data['priceType'] = $this->data['stadiumdetails'][0]->price_type;


		// 	$this->data['settings'] = $this->General_Model->getSiteSettings();

		// 	$this->data['myaddresses'] = $this->General_Model->getAllItemTable_Array('addresses', array('user_id' => $this->input->post('customerid'), 'set_default' => 1))->result();
		// 	$this->data['addresses'][0] = $this->data['myaddresses'][0];

		// 	if (count($this->data['addresses']) > 0) {
		// 		$this->data['getRegisterDataByid'] = $this->db->query("SELECT s.name as first_name , s.surname as last_name ,s.address,s.country,s.province as state,s.phone as mobile,s.postal_code as code,s.dialing_code as phonecode ,s.phone as phone,s.city as city,c.email as email FROM addresses as s left join register as c on c.id=s.user_id WHERE s.user_id like '" . $this->session->userdata('id') . "' and s.set_default = '1'")->result();
		// 	}

		// 	$this->data['allCountries'] = $this->db->query("SELECT * FROM countries ORDER BY name ASC ")->result();
		// 	if ($this->data['matcheventdetails']) {
		// 		return $this->load->view('game/order_checkout', $this->data);
		// 	} else {
		// 		redirect();

		// 	}*/
		// }
		else if ($segment == 'save_order') {

			$matchId = $this->input->post('matchid');
			$userId = $this->input->post('userId');

			$matchInfoArray = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $matchId))->result();
			$noTickets = $this->input->post('notickets');
			$sellId = $this->input->post('sellid');

			$this->data['sellTicketsData'] = $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $sellId))->result();
			$sessionArray = $this->session->userdata('sessionValue');
			$cart_id = $sessionArray['cid'];
			$cart = $this->General_Model->get_cart_data($cart_id)->row();

			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('phoneCode', 'Phone Code', 'required');
			$this->form_validation->set_rules('billingphonenumber', 'Phone Number', 'required');
			$this->form_validation->set_rules('userId', 'user id', 'required');
			$this->form_validation->set_rules('billingphonenumber', 'Phone Number', 'required');
			$this->form_validation->set_rules('notickets', 'Ticket Quantity', 'required');

			if ($this->form_validation->run() !== false) {

				//echo "<pre>";print_r($this->data['sellTicketsData'][0]);exit;
				$qty = $_POST['notickets'];
				$price_type = $this->data['sellTicketsData'][0]->price_type;
				$price 		= $this->data['sellTicketsData'][0]->price;
				$sub_total  = $qty * $price;
				$tax_fees 	= 0;
				$discount 	= 0;
				$total_amount = $sub_total + $tax_fees + $discount;
				$ip_address = $_SERVER['REMOTE_ADDR'];
				//echo "AAAAA";exit;
				$booking_no = '1BO' . time();
				$booking_confirmation_no = 'TK' . time();;
				$booking_global = array(
					'user_id'        => $_POST['userId'],
					'sub_total'      => $sub_total,
					'booking_status' => 1,
					'booking_no' 	 => $booking_no,
					'booking_confirmation_no' 	 => $booking_confirmation_no,
					'tax_fees'       => $tax_fees,
					'discount_amount' => $discount,
					'total_amount'   => $total_amount,
					'currency_type'  => $price_type,
					'ip_address'     => $ip_address
				);
				//echo "<pre>";print_r($booking_global);exit;
				$booking_id = $this->General_Model->insert_data('booking_global', $booking_global);
				if ($booking_id != '') {

					$data_billing = array(
						'booking_id'     => $booking_id,
						'title'          => 'Mr',
						'first_name'     => $_POST['first_name'],
						'last_name'      => $_POST['last_name'],
						'email'          => $_POST['email'],
						'dialing_code'   => $_POST['phoneCode'],
						'mobile_no'      => $_POST['billingphonenumber'],
						'address'        => $_POST['address'],
						'postal_code'    => $_POST['postcode'],
						'country_id'     => $_POST['country'],
						'state_id'       => $_POST['city'],
					);
					$data_billing_id = $this->General_Model->insert_data('booking_billing_address', $data_billing);

					$data_ticket = array(
						'booking_id'     => $booking_id,
						'match_id'       => $cart->match_id,
						'match_name'     => $cart->match_name,
						'match_date'     => $cart->match_date,
						'match_time'     => $cart->match_time,
						'team_image_a'   => $cart->team_image_a,
						'team_image_b'   => $cart->team_image_b,
						'tournament_name' => $cart->tournament_name,
						'tournament_id'  => $cart->tournament,
						'ticket_type'    => $cart->ticket_type,
						'seat_category'  => $cart->seat_category,
						'ticket_category' => $cart->ticket_category,
						'split'          => $cart->split,
						'ticket_block'   => $cart->ticket_block,
						'row'            => $cart->row,
						'listing_note'   => $cart->listing_note,
						'stadium_name'   => $cart->stadium_name,
						'stadium_map'    => $cart->stadium_image,
						'stadium_id'     => $cart->venue,
						'country_name'   => $cart->country_name,
						'country_id'     => $cart->country,
						'city_name'      => $cart->state_name,
						'city_id'        => $cart->city,
						'ticket_id'      => $cart->s_no,
						'quantity'       => $cart->no_ticket,
						'price'          => $cart->price,
						'currency_type'  => $cart->price_type,
					);
					$booking_tickets_id = $this->General_Model->insert_data('booking_tickets', $data_ticket);


					if ($cart->ticket_type == 2) {

						$tickets_data = array();
						for ($i = 1; $i <= $cart->no_ticket; $i++) {

							$tickets_data[] = array(

								'booking_id' => $booking_id,
								'ticket_id' => $booking_tickets_id,
								'serial' => $i,
								'ticket_file' => '',


							);
						}
						$booking_tickets_id = $this->General_Model->insert_batch_data('booking_etickets', $tickets_data);
					}
					$txn = 'txn_' . time();
					$payment_data = array(
						'booking_id'            => $booking_id,
						'payment_status'        => 1,
						'transcation_id'        => $txn,
						'payment_type'          => 2,
						'payment_response'      => "$txn",
						'total_payment'         => $total_amount,
						'currency_code'         => $price_type,
						'message'               => "success",
						'payment_date'          => date("Y-m-d H:i:s")
					);

					$payment_id = $this->General_Model->insert_data('booking_payments', $payment_data);
				}

				$response = array(
					'status' => 1,
					'msg' => "New Order Created Successfully",
					'redirect_url' => base_url() . 'game/orders/list_order'
				);

				echo json_encode($response);
				exit;
			} else {

				$response = array(
					'status' => 0,
					'msg' => validation_errors(),
					'redirect_url' => base_url() . 'game/orders/list_order'
				);

				echo json_encode($response);
				exit;
			}
			/*$sellerPercentageData = $this->General_Model->getAllItemTable_Array('seller_percentage')->result();
=======
			}
		} else if ($segment == 'save_order') {
			$matchId = $this->input->post('matchid');
			$userId = $this->input->post('userId');
			$matchInfoArray = $this->General_Model->getAllItemTable_Array('match_info', array('m_id' => $matchId))->result();
			$noTickets = $this->input->post('notickets');
			$sellId = $this->input->post('sellid');
			$this->data['sellTicketsData'] = $this->General_Model->getAllItemTable_Array('sell_tickets', array('s_no' => $sellId))->result();
			$sellerPercentageData = $this->General_Model->getAllItemTable_Array('seller_percentage')->result();

			$selling_price = $this->General_Model->currencyConverterMap2($this->data['sellTicketsData'][0]->price + ($this->data['sellTicketsData'][0]->price * $sellerPercentageData[0]->site_fee / 100), $this->data['sellTicketsData'][0]->price_type, $this->session->userdata('currency'));
			$arrangement_fee = ($selling_price * $sellerPercentageData[0]->arrangement_fee / 100) * $noTickets;
			$total_final_price = ($selling_price * $noTickets) + $arrangement_fee + $site_fee;
			$seller_total_price = $this->General_Model->currencyConverterMap2($total_final_price, $this->session->userdata('currency'), $this->data['sellTicketsData'][0]->price_type);
			$currency = strtoupper($this->data['sellTicketsData'][0]->price_type);
			$order_amount = round($seller_total_price * 100);
			$date = date("Y-m-d H:i:s");
			$dataDB = array(
				'user_id' => $userId,
				'match_id' => $matchId,
				'block_id' => $_POST['stadiumblockid'],
				'sell_id' => $sellId,
				'no_tickets' => $noTickets,
				'amount' => $order_amount / 100,
				'discount' => $_POST['discountvalue'],
				'discount_type' => $_POST['coupontype'],
				'currency_type' => $currency,
				'txn_id' => time(),
				'payment_reference_number' => "TEST",
				'status' => 0,
				'type' => 'manual',
				// 'payment_status' => $status,
				'payment_date' => $date,
				'ip_address' => $_SERVER['REMOTE_ADDR']
			);
			$purchase = $this->General_Model->insert_data('purchase', $dataDB);

			redirect('game/orders/list_order');*/
		}
	}

	/**
	 * Stadium related operations
	 * Add
	 * List
	 * Edit
	 * Delete
	 */
	public function stadium()
	{
		$segment = $this->uri->segment(3);
		if ($segment == 'get_stadium') {
			$segment4 = $this->uri->segment(4);
			$getStadiumDetails = $this->General_Model->getAllItemTable('stadium', 's_id', $segment4)->row();
			$svg_filename = UPLOAD_PATH . 'uploads/stadium/maps/user-uploads/' . basename($getStadiumDetails->stadium_image)."?v=".time();
			header('location: ' . base_url('game/stadium/add_stadium') . '/' . $segment4 . '?map=' . $svg_filename);
		} else if ($segment == 'add_stadium') {
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$segment4 = $this->uri->segment(4);
			$this->data['allCountries'] = $this->General_Model->getAllItemTable('countries', NULL, NULL, 'name', 'asc')->result();
			$this->data['allTeams'] = $this->General_Model->getAllItemTable('teams')->result();
			//$this->data['getSeatCategory'] = $this->General_Model->getAllItemTable('stadium_seats', 'status', 1)->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['getSeatCategory'] = $this->General_Model->get_seat_category_main()->result();
			if ($segment4 != "") {

				$this->data['edit_stadium_id'] = $segment4;
				$this->data['getStadium'] = $this->General_Model->getAllItemTable('stadium', 's_id', $segment4)->row();
				$this->data['stadium_category'] = $this->General_Model->get_seat_stadium_category($segment4)->result();

				//print_r($this->data['stadium_category']);die;
// 				ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

				$this->data['getStadium'] = $this->General_Model->getAllItemTable('stadium', 's_id', $segment4)->row();
				$this->data['colorGroup'] = $this->General_Model->get_stadium_color_list($segment4)->result();
				$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
				$this->data['cities'] = $this->General_Model->get_state_cities($this->data['getStadium']->country);
				//print_r($this->data['colorGroup']);
				
				$this->load->view(THEME.'game/edit_stadium', $this->data);
				exit;
			}
			$this->load->view(THEME.'game/add_stadium', $this->data);
		} else if ($segment == 'list_stadium') {
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$this->load->view(THEME.'game/stadium_list', $this->data);
			// $search_text = '';
			// if ($this->input->post('submit') != NULL) {
			// 	$search_text = $this->input->post('search');
			// 	$this->session->set_userdata(array("searchstadium" => $search_text));
			// } else {
			// 	if ($this->session->userdata('searchstadium') != NULL) {
			// 		$search_text = $this->session->userdata('searchstadium');
			// 	}
			// }
			// $row_count = $this->uri->segment(4);
			// $this->loadRecord($row_count, 'stadium', 'game/stadium/list_stadium', 's_id', 'DESC', 'game/stadium_list', 'stadiums', 'stadiums', $search_text);
		}else if ($segment == 'update_stadium_attendee_status') {
			
			
			$stadiumId 			= $_POST["stadium_id"];
			$attendee_status 	= $_POST["attendee_status"];
			if($stadiumId != "" && $attendee_status != ""){
			$updateData = array(
								'attendee_status'		=> $_POST['attendee_status'], 
						);
		
			if ($this->General_Model->update_table('stadium', 's_id', $stadiumId, $updateData)) {
				$response = array('status' => 1, 'msg' => 'Attendee Status Updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while Updating Attendee Status.');
				echo json_encode($response);
				exit;
			}


			}
			else{
				$response = array('status' => 0, 'msg' => 'Invalid Stadium details.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($segment == 'update_stadium_status') {
			
			
			$stadiumId 			= $_POST["stadium_id"];
			$status 	= $_POST["status"];
			if($stadiumId != "" && $status != ""){
			$updateData = array(
								'status'		=> $_POST['status'], 
						);
		
			if ($this->General_Model->update_table('stadium', 's_id', $stadiumId, $updateData)) {
				$response = array('status' => 1, 'msg' => 'Stadium Status Updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while Updating Stadium Status.');
				echo json_encode($response);
				exit;
			}


			}
			else{
				$response = array('status' => 0, 'msg' => 'Invalid Stadium details.');
				echo json_encode($response);
				exit;
			}
		}  else if ($segment == 'delete_stadium') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('stadium', 's_id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Stadium deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting stadium.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_stadium') {
		
			if ($this->input->post()) {
				
				$insertData = array();
				$stadiumcode = json_decode($this->input->post('stadiumcode'),1);
				$insertData['stadium_name'] = $this->input->post('stadiumname');
				$insertData['category'] = $this->input->post('inpt_gamecategory') ? $this->input->post('inpt_gamecategory') : 1;

				if($this->input->post('inpt_country') != "")
				$insertData['country'] = $this->input->post('inpt_country');

				if($this->input->post('inpt_city') != "")
				$insertData['city'] = $this->input->post('inpt_city');

			

				if($stadiumcode['search_keywords']!="")
				$insertData['search_keywords'] = $stadiumcode['search_keywords'];

				if($stadiumcode['stadium_variant']!="")
					$insertData['stadium_variant'] = $stadiumcode['stadium_variant'];


				$insertData['stadium_image'] = $this->input->post('stadiumimage');
				$insertData['width'] = $this->input->post('stadiumwidth');
				$insertData['height'] = $this->input->post('stadiumheight');
				$insertData['status'] = 1;
				//echo "<pre>"; var_dump(json_decode($this->input->post('stadiumcode'))); echo "</pre>"; exit;

				//echo "<pre>";print_r($insertData);exit;				
				$insertData['stadium_name'] = $this->input->post('stadiumViewName');
				$insertData['stadium_name_ar'] = $this->input->post('stadiumViewName_ar');
				// echo '<pre/>';
				
				$segment4 = $this->uri->segment(4);
				if ($segment4) {
					$insertData['stadium_name'] = $this->input->post('stadiumViewName');
					$insertData['stadium_name_ar'] = $this->input->post('stadiumViewName_ar');
					$this->General_Model->update('stadium', array('s_id' => $segment4), $insertData);
					$insertTable = true;
				} else {
					$insertTable = $this->General_Model->insert_data('stadium', $insertData);
				}
				if ($insertTable) {
					if ($segment4) {
						$stadiumId = $segment4;
					} else {
						$stadiumId = $insertTable;
						$insertStatdiumData = array();
						$assignBlockId = explode(',', $this->input->post('blockid'));
						$fillColor = explode('-', $this->input->post('fillcolor'));
						$categoryName = explode(',', $this->input->post('categoryname'));
						$getStadiumByid = $this->General_Model->getAllItemTable_array('stadium', array('s_id' => $stadiumId))->result();
						foreach ($assignBlockId as $key => $value) {
							$insertStatdiumData['stadium_id'] = $stadiumId;
							$insertStatdiumData['block_id'] = $assignBlockId[$key];
							$insertStatdiumData['block_color'] = $fillColor[$key];
							$insertStatdiumData['category'] = $categoryName[$key];
							$this->General_Model->insert_data('stadium_details', $insertStatdiumData);

							$regions = array();
							$regions['id'] = $assignBlockId[$key];
							$regions['id_no_spaces'] = $assignBlockId[$key];
							$regions['fill'] = $fillColor[$key];
							$regions['href'] = $categoryName[$key];
							$regions['tooltip'] = $categoryName[$key];

							$regions['data'] = array();
							$someArray['regions'][$assignBlockId[$key]] = $regions;
						}

						$updateData = array();
						$updateData['map_code'] = json_encode($someArray);
						$this->General_Model->update_table('stadium', 's_id', $stadiumId, $updateData);
					}
				}

				redirect('/game/stadium/list_stadium');
			}
		} else if ($segment == 'check_stadium') {
			define('MAPSVG_PLUGIN_URL', "http" . (!empty($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/');
			define('MAPSVG_ADMIN_URL', "");
			define('DIRECTORY_SEPARATOR', "/");

			define('MAPSVG_SITE_URL', base_url());
			define('MAPSVG_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_SEPARATOR);
			define('MAPSVG_BUILDER_DIR', MAPSVG_PLUGIN_DIR);
			define('MAPSVG_MAPS_DIR', MAPSVG_PLUGIN_DIR . 'maps');
			 define('MAPSVG_MAPS_UPLOADS_DIR', MAPSVG_MAPS_DIR . DIRECTORY_SEPARATOR . 'user-uploads');
			define('MAPSVG_MAPS_URL', MAPSVG_PLUGIN_URL . 'maps/');
			define('MAPSVG_PINS_DIR', MAPSVG_PLUGIN_DIR . 'markers' . DIRECTORY_SEPARATOR);
			define('MAPSVG_PINS_URL', MAPSVG_PLUGIN_URL . 'markers/');
			define('MAPSVG_VERSION', '2.2.1');
			define('MAPSVG_JQUERY_VERSION', '6.2.0');

			if (isset($_POST['upload_svg']) && $_FILES['svg_file']['tmp_name']) {

				$target_dir = MAPSVG_MAPS_UPLOADS_DIR;
				$target_file = $target_dir . DIRECTORY_SEPARATOR . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"]))));
				$file_parts = pathinfo(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"]))));
				// $getStadiumData = $this->General_Model->getAllItemTable_Array('stadium', array('stadium_name' => $file_parts['filename']))->result();
				// $duplicateCheck = sizeof($getStadiumData);
				$duplicateCheck = 0;

				if ($duplicateCheck == 0) {
					//            $a = str_replace("\n", " \\n", str_replace("e\\", "e \\", $js_mapsvg_options));

					if (strtolower($file_parts['extension']) != 'svg') {
						$mapsvg_error = 'Wrong file format (' . $file_parts['extension'] . '). Only SVG files are compatible with the plugin.';

						// $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error', $mapsvg_error));

						header('location: ' . base_url() . 'game/stadium/add_stadium');
					} else {
						// print_r('uploads/stadium/maps/' . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"]))))); exit;
						if (@move_uploaded_file($_FILES["svg_file"]["tmp_name"], UPLOAD_PATH_PREFIX.'uploads/stadium/maps/user-uploads/' . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"])))))) {

							$mapsvg_notice = "The file " . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"])))) . " has been uploaded.";
							$svg_filename = UPLOAD_PATH . 'uploads/stadium/maps/user-uploads/' . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"]))));
							header('location: ' . base_url() . 'game/stadium/add_stadium?map=' . $svg_filename);
						} else {

							$mapsvg_error = "An error occured during upload of your file. Please check that " . MAPSVG_MAPS_UPLOADS_DIR . " folder exists and it has full permissions (777).";
							header('location: ' . MAPSVG_ADMIN_URL . '?uploadError=1');
						}
					}
				} else {
					// $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success', 'Stadium Name already Extist...!'));
					header('location: ' . admin_url() . 'game/add_stadium');
				}
			}
			//        }

			if (isset($_GET['action'])) {
				if (is_callable($_GET['action'])) {
					$data = isset($_GET['data']) ? $_GET['data'] : null;
					call_user_func($_GET['action'], $data);
				}
			}

			function check_php()
			{
				echo "1";
			}
		}
	}

	/**
	 * Fetch data and display based on the pagination request
	 */
	public function loadRecord($rowno = 0, $table, $url, $order_column, $order_by, $view, $variable_name, $type, $search = '')
	{ 
		// Load Pagination library
		$this->load->library('pagination');
		//echo $type;exit;
		 if ($type == 'stadiums') {
		// Row per page
		$row_per_page = 50;

		}
		else if ($type == 'seatcategory') {
		// Row per page
		$row_per_page = 5000;

		}
		else{
			$row_per_page = 10;
		}

		// Row position
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}
		// All records count
		$allcount = $this->General_Model->get_table_row_count($table, '');

		if ($type == 'gamecategory') {
			$allcount = $this->General_Model->get_game_category_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_game_category_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} else if ($type == 'seatcategory') {
			$record = $this->General_Model->get_seat_category_by_limit($rowno, $row_per_page, $order_column, $order_by, '')->result();
		} else if ($type == 'stadiums') {
			// $where_array = array();
			// if(@$_POST['active']){
			// 	$where_array = array('status' => $_POST['active'] );
			// }
			$allcount = $this->General_Model->get_stadium_by_limit('', '', '', '', $where_array, $search)->num_rows();
			$record = $this->General_Model->get_stadium_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();

			$stadium_list = $this->General_Model->get_stadium_by_limit(0,10000, $order_column, $order_by, '',"")->result();

		}
		else if ($type == 'abandoned') {
			$allcount = $this->General_Model->abondaned('','', '',$search)->num_rows();
			$record = $this->General_Model->abondaned('',$rowno, $row_per_page,$search)->result();
		}
		else if ($type == 'ticket_delivery') { 

		$segment4 = $this->uri->segment(4);

		if($rowno == ""){
			$rowno = 0;
		}

		$allcount = $this->General_Model->ticket_delivery($segment4)->num_rows();
		$getMySalesData = $this->General_Model->ticket_delivery($segment4,$rowno, $row_per_page)->result();
		$ticket_delivery_data = array();
		foreach($getMySalesData as $getMySales){
		$getMySales->tickets_data['pending'] 		= $this->General_Model->get_ticket_status($getMySales->bg_id,'pending')->num_rows();
		$getMySales->tickets_data['uploaded'] 		= $this->General_Model->get_ticket_status($getMySales->bg_id,'uploaded')->num_rows();
		$getMySales->tickets_data['downloaded'] 		= $this->General_Model->get_ticket_status($getMySales->bg_id,'pending')->num_rows();
		$ticket_delivery_data[] = $getMySales;
		}
		$record = $ticket_delivery_data;
		}
		else if ($type == 'orders') { 
				$rowno = $this->uri->segment(5);
				if ($rowno != '' && $rowno != 0) {
				$rowno = ($rowno - 1) * $row_per_page;
				}
				else{
					$rowno = 0;
				}

			if (!empty($search['event']) || !empty($search['ticket_category']) || !empty($search['stadium']) || !empty($search['event_start_date']) || !empty($search['event_end_date']) || !empty($search['ignore_end_date']) || !empty($search['seller']) || !empty($search['order_id']) || !empty($search['customer_id']) || !empty($search['customer_id']) || !empty($search['protect'])) {
				
				$event 					= $search['event'];
				$ticket_category 		 = $search['ticket_category'];
				$stadium 				 = $search['stadium'];
				$event_start_date = $search['event_start_date'];
				$event_end_date 		= $search['event_end_date'];
				$ignore_end_date 		 = $search['ignore_end_date'];
				$seller 		 = $search['seller'];
				$order_id 		 = $search['order_id'];
				$customer_id 		 = $search['customer_id'];
				$protect = $search['protect'];

				if(@$customer_id){
						$row_per_page = 500;
				}
				//$ticket_id 		 = $search['ticket_id'];
				//echo "<pre>";print_r($search);exit;
				$record = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$order_id,$customer_id,$protect,$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$order_id,$customer_id,$protect)->num_rows();//echo $allcount;exit;
				//echo "<pre>";print_r($record);exit;

			} else { //echo "dsds".$this->uri->segment(4);exit;
				//echo $rowno;exit;
				$record = $this->General_Model->getOrders('',$this->uri->segment(4),'',$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrders('',$this->uri->segment(4))->num_rows();

				//echo $allcount;exit;
			}

			$this->data['sellers'] = $this->General_Model->get_sellers();

		}
		else if ($type == 'booking_protect_order') { 
				$rowno = $this->uri->segment(5);
				if ($rowno != '' && $rowno != 0) {
				$rowno = ($rowno - 1) * $row_per_page;
				}
				else{
					$rowno = 0;
				}

			if (!empty($search)) {
				$event 					= $search['event'];
				$ticket_category 		 = $search['ticket_category'];
				$stadium 				 = $search['stadium'];
				$event_start_date = $search['event_start_date'];
				$event_end_date 		= $search['event_end_date'];
				$ignore_end_date 		 = $search['ignore_end_date'];
				$seller 		 = $search['seller'];
				$order_id 		 = $search['order_id'];
				//$ticket_id 		 = $search['ticket_id'];
				//echo "<pre>";print_r($search);exit;
				$record = $this->General_Model->getOrdersSearch_protect("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$order_id,$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrdersSearch_protect("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$order_id)->num_rows();//echo $allcount;exit;
				//echo "<pre>";print_r($record);exit;

			} else { //echo "dsds".$this->uri->segment(4);exit;
				//echo $rowno;exit;
				$record = $this->General_Model->getOrders_protect('',$this->uri->segment(4),'',$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrders_protect('',$this->uri->segment(4))->num_rows();

				//echo $allcount;exit;
			}

			$this->data['sellers'] = $this->General_Model->get_sellers();

		} 
		else if ($type == 'partner_order') {
				$partner = @$_GET['partner']  = "all"  ;
				$rowno = $this->uri->segment(5);

				if ($rowno != '' && $rowno != 0) {
				$rowno = ($rowno - 1) * $row_per_page;
				}
				else{
					$rowno = 0;
				}

			if (!empty($search)) {
				$event 					= $search['event'];
				$ticket_category 		 = $search['ticket_category'];
				$stadium 				 = $search['stadium'];
				$event_start_date = $search['event_start_date'];
				$event_end_date 		= $search['event_end_date'];
				$ignore_end_date 		 = $search['ignore_end_date'];
				$seller 		 = $search['seller'];
				$ticket_id 		 = $search['ticket_id'];

				$customer_id 		 = $search['customer_id'];
				$protect = $search['protect'];

				//echo "<pre>";print_r($search);exit;
				$record = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$ticket_id,$customer_id,$protect,$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$ticket_id,$customer_id,$protect)->num_rows();//echo $allcount;exit;
				//echo "<pre>";print_r($record);exit;

			} else { //echo "dsds".$this->uri->segment(4);exit;
				//echo $rowno;exit;
				$record = $this->General_Model->getOrders('',$this->uri->segment(4),'',$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrders('',$this->uri->segment(4))->num_rows();

				//echo $allcount;exit;
			}

			$this->data['sellers'] = $this->General_Model->get_sellers();

		}
		else {

			// Get records
			$record = $this->General_Model->get_limit_based_data($table, $rowno, $row_per_page, $order_column, $order_by, '')->result();
		}
		// Pagination Configuration
		$config['base_url'] = base_url() . $url;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
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
		$this->data['row'] = $rowno;
		$this->data['search'] = $search;
		$this->data['stadium_list'] = @$stadium_list;
		//echo "<pre>";print_r($this->data);exit;
		// Load view
		$this->load->view($view, $this->data);
	}

	/**
	 * Add,edit,update,delete and list seat position
	 */


	public function stadium_color_category()
	{

		$segment = $this->uri->segment(3);
		
		if ($segment == 'merge_Category') {
			$this->db->select('stadium_details.*');
			$this->db->group_by('stadium_id');
			$this->db->group_by('category');
			$this->db->where('stadium_details.source_type','1boxoffice');
			$query =  $this->db->get('stadium_details');
			$results = $query->result();
			foreach ($results as $key => $value) {
				if($value->category){
					$data = array(
								'stadium_id'		=> $value->stadium_id,
								'category_id'		=> $value->category,
								'color_code'		=> $value->block_color ? $value->block_color : "rgba(0, 0, 0, 1)",

						);
					$this->db->insert('stadium_color_category',$data);
					
				}
			}
		}
		else if ($segment == 'add') {
				$this->form_validation->set_rules('stadium_id', 'Stadium', 'required');
				$this->form_validation->set_rules('category_id', 'Category', 'required');
				if ($this->form_validation->run() !== false) {
					$category_id = $this->input->post('category_id');
					$result = $this->General_Model->getAllItemTable('stadium_seats', 'id', $category_id)->row();

					//pr($result);die;
					$stadium_id = $this->input->post('stadium_id');
					$status = $this->input->post('is_active') ? 1 : 0;
					$insert_data = array(
						'stadium_id'    => $stadium_id,
						'category_id' 	=> $category_id,
						'color_code'	=> @$result->category_color ? $result->category_color : "rgba(0, 0, 0, 1)",
						
					);
					$inserted_id = $this->General_Model->insert_data('stadium_color_category', $insert_data);

					$this->data['stadium_category'] = $this->General_Model->get_seat_stadium_category($stadium_id)->result();
					$this->data['getSeatCategory'] = $this->General_Model->get_seat_category_main()->result();
					$html = $this->load->view(THEME.'game/stadium_color_category', $this->data,true);

					$stadium_category = $this->General_Model->get_seat_stadium_category($stadium_id)->result();

					$response = array('msg' => 'Added Successfully', 'redirect_url' => '','html' => $html,'stadium_category' => $stadium_category , 'status' => 1);
					echo json_encode($response);exit;
				}
				else{
					$response = array('msg' => validation_errors(), 'redirect_url' => '', 'status' => 0);
					exit;
				}
	
		}
		else if ($segment == 'update') {
			$this->form_validation->set_rules('stadium_id', 'Stadium', 'required');
			$this->form_validation->set_rules('category_id', 'Category', 'required');
			$this->form_validation->set_rules('id', 'Category', 'required');
			if ($this->form_validation->run() !== false) {
				$category_id = $this->input->post('category_id');
				$stadium_id = $this->input->post('stadium_id');
				$color_code = $this->input->post('color_code');
				$old_category_id = $this->input->post('old_category');
				$id = $this->input->post('id');
			
					$status = $this->input->post('is_active') ? 1 : 0;
					$update_data = array(
						'stadium_id'    => $stadium_id,
						'category_id' 	=> $category_id,
						'color_code'	=> $color_code,
						
					);
					$this->General_Model->update('stadium_color_category', array('id' => $id), $update_data);

					if($old_category_id != $category_id){
						$updateData_stddetail = array(
									'category'		=> $category_id,
									'block_color'	=> $color_code,
									);

						$this->General_Model->update('stadium_details', array('stadium_id' => $stadium_id,'category' => $old_category_id), $updateData_stddetail);
					}
					else{

						$updateData_stddetail = array(
									'block_color'	=> $color_code,
									);

						$this->General_Model->update('stadium_details', array('stadium_id' => $stadium_id,'category' => $category_id), $updateData_stddetail);


					}
					$stadium_category = $this->General_Model->get_seat_stadium_category($stadium_id)->result();

					$response = array('msg' => 'Updated Successfully', 'redirect_url' => '','stadium_category' => $stadium_category , 'status' => 1);
					echo json_encode($response);exit;
				}
				else{
					$response = array('msg' => validation_errors(), 'redirect_url' => '', 'status' => 0);
					echo json_encode($response);
					exit;


				}
				
	
		}
		else if ($segment == 'delete') {
			
			if ($this->input->post()) {
				$this->form_validation->set_rules('stadium_id', 'Stadium', 'required');
				$this->form_validation->set_rules('id', 'Category', 'required');
				if ($this->form_validation->run() !== false) {

					$id = $this->input->post('id');
					$stadium_id = $this->input->post('stadium_id');
					$category_id = $this->input->post('category_id');

					$delete = $this->General_Model->delete_data('stadium_color_category', 'id', $id);

					$this->data['stadium_category'] = $this->General_Model->get_seat_stadium_category($stadium_id)->result();
					$this->data['getSeatCategory'] = $this->General_Model->get_seat_category_main()->result();
					$html = $this->load->view(THEME.'game/stadium_color_category', $this->data,true);

					$stadium_category = $this->General_Model->get_seat_stadium_category($stadium_id)->result();


					$updateData_stddetail = array(
									'category'		=> "",
									'block_color'	=> "",
									);

					$this->General_Model->update('stadium_details', array('stadium_id' => $stadium_id,'category' => $category_id), $updateData_stddetail);

					$response = array('msg' => 'Deleted Successfully', 'redirect_url' => '','stadium_category' => $stadium_category ,'html' => $html, 'status' => 1);
					echo json_encode($response);
					exit;
				}
				else{
					$response = array('msg' => validation_errors(), 'redirect_url' => '', 'status' => 0);
					echo json_encode($response);
					exit;
				}
			}
	
		}
		else if ($segment == 'clone') {
			$this->form_validation->set_rules('stadium_id', 'Stadium', 'required');
			$this->form_validation->set_rules('id', 'Category', 'required');
			if ($this->form_validation->run() !== false) {
				$id = $this->input->post('id');
				$stadium_id = $this->input->post('stadium_id');
				$result = $this->General_Model->getAllItemTable('stadium_color_category', 'id', $id)->row();
				
				$insert_data = array(
							'stadium_id'    => $result->stadium_id,
							'category_id' 	=> $result->category_id,
							'color_code'	=> $result->color_code,
							
						);
				$inserted_id = $this->General_Model->insert_data('stadium_color_category', $insert_data);

				$this->data['stadium_category'] = $this->General_Model->get_seat_stadium_category($stadium_id)->result();
				$this->data['getSeatCategory'] = $this->General_Model->get_seat_category_main()->result();
				$html = $this->load->view(THEME.'game/stadium_color_category', $this->data,true);

				$response = array('msg' => 'Clone Successfully', 'redirect_url' => '','html' => $html, 'status' => 1);
				echo json_encode($response);
				exit;
			}
			else{
				$response = array('msg' => validation_errors(), 'redirect_url' => '', 'status' => 0);
					echo json_encode($response);
					exit;
			}

		}
		else if ($segment == 'view') {
			$stadium_id = $this->input->post('stadium_id');
			$this->data['stadium_category'] = $this->General_Model->get_seat_stadium_category($stadium_id)->result();
				$this->data['getSeatCategory'] = $this->General_Model->get_seat_category_main()->result();
				$html = $this->load->view(THEME.'game/stadium_color_category', $this->data,true);
				$response = array('msg' => 'Load Successfully', 'redirect_url' => '','html' => $html, 'status' => 1);
				echo json_encode($response);;
		}
		else{
			echo "invalid segment";
		}
	}

	public function seat_category()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->load->view('game/add_seat_category', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_cat_id = $segment4;
				$this->data['category_details'] = $this->General_Model->get_seat_category_data($edit_cat_id)->row();
			}
			$this->load->view('game/add_seat_category', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('stadium_seats', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('stadium_seats_lang', 'stadium_seat_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Seat position deleted Successfully.');
				// echo json_encode($response);
				// exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting seat position.');
				// echo json_encode($response);
				// exit;
			}
			redirect('/game/seat_category');
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('seat_position', 'Seat Position', 'required');
				$this->form_validation->set_rules('event', 'For event', 'required');
				$this->form_validation->set_rules('is_active', 'Status', 'required');

				if ($this->form_validation->run() !== false) {
					$editcatId = $this->input->post('category_id');
					if ($editcatId == '') {
						$status = $this->input->post('is_active') ? 1 : 0;
						$insert_data = array(
							'seat_category' => $this->input->post('seat_position'),
							'status' => $status,
							'event_type' => $this->input->post('event'),
							// 'add_by' => $this->session->userdata('admin_id'),
							'create_date' => strtotime(date('Y-m-d H:i:s'))
						);
						$inserted_id = $this->General_Model->insert_data('stadium_seats', $insert_data);
						if ($inserted_id) {
							$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
							foreach ($lang as $key => $l_code) {
								$language_data = array(
									'language' =>  $l_code->language_code,
									'stadium_seat_id' => $inserted_id,
									'seat_category' => $this->input->post('seat_position')
								);
								$this->General_Model->insert_data('stadium_seats_lang', $language_data);
							}
							$response = array('msg' => 'New Seat Position Created Successfully.', 'redirect_url' => base_url() . 'game/category', 'status' => 1);
						} else {
							$response = array('msg' => 'Failed to create new seat position.', 'redirect_url' => base_url() . 'game/seat_category/add', 'status' => 0);
						}
						redirect('/game/seat_category');
						// echo json_encode($response);
						exit;
					} else {
						$updateData = array();
						$updateData_lang = array();
						$updateData['seat_category'] = trim($this->input->post('seat_position'));
						$updateData['event_type'] = trim($this->input->post('event'));
						$updateData['status'] = $this->input->post('is_active') ? 1 : 0;
						$this->General_Model->update('stadium_seats', array('id' => $editcatId), $updateData);

						//Update language table			
						$updateData_lang['seat_category'] = trim($this->input->post('seat_position'));
						$this->General_Model->update('stadium_seats_lang', array('stadium_seat_id' => $editcatId, 'language' => $this->session->userdata('language_code')), $updateData_lang);

						redirect('/game/seat_category');
						// $response = array('status' => 1, 'msg' => 'Seat position data updated Successfully.', 'redirect_url' => base_url() . 'game/seat_category');
						// echo json_encode($response);
						exit;
					}
				} else {
					redirect('/game/seat_category');
					// $response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'game/seat_category/add', 'status' => 0);
					exit;
				}
				echo json_encode($response);
				exit;
			}
		} else {
			$row_count = $this->uri->segment(3);
			$this->loadRecord($row_count, 'stadium_seats', 'game/seat_category', 'id', 'DESC', 'game/seat_category_list', 'categories', 'seatcategory');
		}
	}


	function getStadiumByApi()
	{
		$stadiumId = $this->input->post('stadiumid');

		$this->load->library('curl');

		$url = 'get_stadium_id?lang='.$this->session->userdata('language_code').'&currency='.$this->session->userdata('currency');
		$post_data = array("stadium_id" => $stadiumId);

		$response =  $this->curl->post($url,$post_data);
		$result = $response['result'];
		$inputValidation = "OK";
		$set['Status'] = $inputValidation;
		$set['Json'] = $result;


		echo $val = json_encode($set);
	}

	function getStadiumByid()
	{
		$stadiumId = $this->input->post('stadiumid');
		$getStadiumByid = $this->General_Model->getAllItemTable('stadium', 's_id', $stadiumId)->result();
		$inputValidation = "OK";
		$set['Status'] = $inputValidation;
		$set['Json'] = $getStadiumByid;

	
		$getStadiumDetailsByid = $this->General_Model->get_categoryby($stadiumId)->result();
		//print_r($getStadiumDetailsByid);die;
		$arrays = array();
		foreach($getStadiumDetailsByid as $row)

		{

			$arrays[$row->block_id] = array(
				'id'				=> $row->block_id,
				'id_no_spaces'		=> $row->block_id,
				'fill'				=> str_replace(",1)",")",$row->block_color),
				'href'				=> $row->category,
				'tooltip'			=> $row->category,
				'seat_category'		=> $row->seat_category,
				'data'				=> $data
			);
			
		}

		$set['directData'] = $arrays;

		echo $val = str_replace('\\/', '/', json_encode($set));
		die;
	}

	function getSellTicketsById()
	{
		if ($this->input->post()) {
			$matchId = $this->input->post('matchid');
			$noTickets = $this->input->post('notickets');
			$ticketCategory = $this->input->post('ticketcategory');

			if (!empty($ticketCategory)) {
				$getSellTicketsByid = $this->db->query("SELECT *, `quantity` AS `difference` FROM `sell_tickets` WHERE ticket_category=$ticketCategory AND match_id=$matchId HAVING `difference` >= $noTickets")->result();
			} else {
				$getSellTicketsByid = $this->db->query("SELECT *, `quantity`  AS `difference` FROM `sell_tickets` WHERE match_id=$matchId HAVING `difference` >= $noTickets")->result();
			}


			if ($getSellTicketsByid) {

				foreach ($getSellTicketsByid as $key => $filter_ticket) {

					if (($filter_ticket->split == 3) && ($filter_ticket->difference - $noTickets == 1) && ($noTickets != 0)) {
						unset($getSellTicketsByid[$key]);
					} else if ($filter_ticket->split == 2 && $filter_ticket->difference != $noTickets && ($noTickets != 0)) {

						unset($getSellTicketsByid[$key]);
					} else if (($filter_ticket->split == 4) && ($noTickets % 2 != 0) && ($noTickets != 0)) {

						unset($getSellTicketsByid[$key]);
					} else {
					}
				}
			}


			$inputValidation = "OK";
			$set['Status'] = $inputValidation;
			$set['Json'] = $getSellTicketsByid;

			echo $val = str_replace('\\/', '/', json_encode($set));
		} else {

			redirect(base_url());
		}
	}

	function getStadiumDetailsByid()
	{
		$stadiumId = $this->input->post('stadiumid');
		$getStadiumDetailsByid = $this->General_Model->getAllItemTable_Array('stadium_details', array('stadium_id' => $stadiumId))->result()->result();
		$inputValidation = "OK";
		$set['Status'] = $inputValidation;
		$set['Json'] = $getStadiumDetailsByid;
		echo $val = str_replace('\\/', '/', json_encode($set));
	}

	function getStadiumDetailsByBlockid()
	{
		$blockid = $this->input->post('blockid');
		$stadiumid = $this->input->post('stadiumid');

		$getStadiumDetailsByid = $this->General_Model->getAllItemTable_array('stadium_details', array('block_id' => $blockid, 'stadium_id' => $stadiumid))->result();
		$inputValidation = "OK";
		$set['Status'] = $inputValidation;
		$set['Json'] = $getStadiumDetailsByid;
		echo $val = str_replace('\\/', '/', json_encode($set));
	}

	function update_statdium_block()
	{
		$stadiumId = $this->input->post('stadiumid');
		$color = $this->input->post('color');
		$href = $this->input->post('href');
		$block_id = $this->input->post('block_id');

		$getStadiumByid = $this->General_Model->getAllItemTable_array('stadium', array('s_id' => $stadiumId))->result();

		$someArray = json_decode($getStadiumByid[0]->map_code, true);

		

		if (array_key_exists($block_id, $someArray['regions'])) {

			foreach ($someArray['regions'] as $key => $sr) {

				if ($block_id == $key) {
					$someArray['regions'][$key]['fill'] = $color;
					$someArray['regions'][$key]['href'] = $href;
					$someArray['regions'][$key]['tooltip'] = $href;
				}
			}
		} else {

			$regions = array();
			$regions['id'] = $block_id;
			$regions['id_no_spaces'] = $block_id;
			$regions['fill'] = $color;
			$regions['href'] = $href;
			$regions['tooltip'] = $href;

			$regions['data'] = array();

			$someArray['regions'][$block_id] = $regions;
		}

		$updateData = array();
		$updateData['map_code'] = json_encode($someArray);
		$this->General_Model->update_table('stadium', 's_id', $stadiumId, $updateData);

		$getStadiumDetailsByid = $this->General_Model->getAllItemTable_array('stadium_details', array('stadium_id' => $stadiumId, 'block_id' => $block_id))->row();

		if ($getStadiumDetailsByid) {

			$updateData_stddetail = array();
			$updateData_stddetail['category'] = $href;
			$updateData_stddetail['block_color'] = $color;
			$this->General_Model->update('stadium_details', array('stadium_id' => $stadiumId, 'block_id' => $block_id), $updateData_stddetail);
		} else {

			$insertStatdiumData = array();
			$insertStatdiumData['stadium_id'] = $stadiumId;
			$insertStatdiumData['block_id'] = $block_id;
			$insertStatdiumData['block_color'] = $color;
			$insertStatdiumData['category'] = $href;
			$this->General_Model->insert_data('stadium_details', $insertStatdiumData);
		}

		echo 'true';
	}

	function update_category_by_color()
	{
		$staduim_id = $this->input->post('staduim_id');
		$color_name = $this->input->post('color_name');
		$category = $this->input->post('category');


		if($category !="" && $color_name !="" && $staduim_id !=""){
			$updateData_stddetail = array(
					'category'	=> $category,
					);


		$this->General_Model->update('stadium_details', array('stadium_id' => $staduim_id,'block_color' => $color_name), $updateData_stddetail);
		
		$select =  $this->General_Model->getAllItemTable_Array('stadium_details', array('stadium_id' => $staduim_id,'block_color' => $color_name))->result();



		$getStadiumByid = $this->General_Model->getAllItemTable_array('stadium', array('s_id' => $staduim_id))->result();

		$someArray = json_decode($getStadiumByid[0]->map_code, true);

		foreach($select as $values){

			$block_id = $values->block_id;
			if (array_key_exists($block_id, $someArray['regions'])) {

				foreach ($someArray['regions'] as $key => $sr) {

					if ($block_id == $key) {
						$someArray['regions'][$key]['fill'] = $color_name;
						$someArray['regions'][$key]['href'] = $category;
						$someArray['regions'][$key]['tooltip'] = $category;
					}
				}
			} else {

				$regions = array();
				$regions['id'] = $block_id;
				$regions['id_no_spaces'] = $block_id;
				$regions['fill'] = $color_name;
				$regions['href'] = $category;
				$regions['tooltip'] = $category;

				$regions['data'] = array();

				$someArray['regions'][$block_id] = $regions;
			}
		}

		//print_r($someArray);
		if($someArray){
			 $updateData = array();
			 $updateData['map_code'] = json_encode($someArray);
			 $this->General_Model->update_table('stadium', 's_id', $staduim_id, $updateData);
			 echo $this->db->last_query();
			}

		}
		echo 'true';
	}


	function update_multiple_category()
	{
		$staduim_id = $this->input->post('staduim_id');
		$color_name = $this->input->post('color_name');
		$category = $this->input->post('category');
		
		$block_id = $this->input->post('block_id');
	
		if($category !=""  && $staduim_id !=""){
			
				
		if($block_id){
			foreach ($block_id as $key => $value) {
				$updateData_stddetail = array(
						'category'	=> $category,
						'block_color' => $color_name
						);	
				$this->General_Model->update(
					'stadium_details', 
					array('stadium_id' => $staduim_id,'block_id' => $value), $updateData_stddetail
				);
				echo $this->db->last_query();
			}
		}
	
		
		$select =  $this->General_Model->getAllItemTable_Array('stadium_details', array('stadium_id' => $staduim_id))->result();
		//print_r($select);die;
		$getStadiumByid = $this->General_Model->getAllItemTable_array('stadium', array('s_id' => $staduim_id))->result();

		$someArray = json_decode($getStadiumByid[0]->map_code, true);

		foreach($select as $values){

				$block_id = $values->block_id;
				$regions = array();
				$regions['id'] = $block_id;
				$regions['id_no_spaces'] = $block_id;
				$regions['fill'] = $values->block_color;
				$regions['href'] = $values->category;
				$regions['tooltip'] = $values->category;

				$regions['data'] = array();

				$someArray['regions'][$block_id] = $regions;
		}

		//print_r($someArray);die;
		if($someArray){
			 $updateData = array();
			 $updateData['map_code'] = json_encode($someArray);
			 $this->General_Model->update_table('stadium', 's_id', $staduim_id, $updateData);
			 //echo $this->db->last_query();
			}

		}
		echo 'true';
	}

	function getPostalCode()
	{
		$getMatchByid = $this->General_Model->getAllItemTable_array('countries', array('id' => $this->input->post('country_id')), NULL, NULL, NULL, array('name', 'asc'))->result();
		$codeCount = COUNT($getMatchByid);
		//State option list
		if ($codeCount > 0) {
			foreach ($getMatchByid as $getMatch) {
				echo '+' . $getMatch->phonecode . '||' . strtolower($getMatch->sortname);
			}
		} else {
			echo '';
		}
	}

	function getCouponCode()
	{

		if ($this->input->post()) {

			$couponCode = $this->input->post('couponcode');
			$getCouponCode = $this->General_Model->getAllItemTable_array('coupon_code', array('coupon_code' => $couponCode, 'status' => 1))->result();
			if (count($getCouponCode) == 1) {
				$currentDate = date('m-d-Y');
				$expiryDate = $getCouponCode[0]->expiry_date;
				//$expiryDate = $getCouponCode[0]->expiry_date;
				if ($currentDate > $expiryDate) {
					$getCouponCodeData = '';
					$message = '<span class="failed-code">Promocode expired.</span>';
					$inputValidation = 'Not ok';
				} else {
					$getCouponCodeData = $this->General_Model->getAllItemTable_array('coupon_code', array('coupon_code' => $couponCode, 'status' => 1))->result();
					$message = '<span class="success-code">Promocode applied successfully.</span>';
					$inputValidation = 'OK';
				}
				// $message = '<span class="success-code">Promocode applied successfully.</span>';
			} else {
				$message = '<span class="failed-code">Invailed code entered.</span>';
				$inputValidation = 'Not ok';
			}
			$inputValidation = $inputValidation;
			$set['Status'] = $inputValidation;
			$set['Message'] = $message;
			$set['Json'] = $getCouponCodeData;
			echo $val = str_replace('\\/', '/', json_encode($set));
		} else {
			redirect(base_url());
		}
	}

	function base_currency_totalamount($total_price = NULL, $to_currency = NULL)
	{
		echo $this->General_Model->currencyConverterMap2($this->input->post('total_price'), $this->session->userdata('currency'), $this->input->post('to_currency'));
	}

	function getAddressDropdown()
	{
		if (!empty($this->input->post('country_id'))) {
			$getMatchByid = $this->General_Model->getAllItemTable_array('states', array('country_id' => $this->input->post('country_id')), NULL, NULL, NULL, array('name', 'asc'))->result();
			$statesCount = COUNT($getMatchByid);
			if ($statesCount > 0) {
				$state = $this->input->post('state');
				echo '<option value="">Select State</option>';
				foreach ($getMatchByid as $getMatch) {
					$selected = '';
					if ($state == $getMatch->id) {
						$selected = 'selected="selected"';
					}
					echo '<option value="' . $getMatch->id . '" ' . $selected . '>' . $getMatch->name . '</option>';
				}
			} else {
				echo '<option value="">State not available</option>';
			}
		}
	}


	public function stadium_category()
	{
		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->load->view(THEME.'game/add_stadium_category', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_cat_id = $segment4;
				$this->data['category_details'] = $this->General_Model->get_seat_category_data($edit_cat_id)->row();
			}
			$this->load->view(THEME.'game/add_stadium_category', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('stadium_seats', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('stadium_seats_lang', 'stadium_seat_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Stadium Category deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting stadium category.');
				echo json_encode($response);
				exit;
			}
			redirect('/game/stadium_category');
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('seat_position', 'Seat Position', 'required');
				$this->form_validation->set_rules('event', 'For event', 'required');
				//$this->form_validation->set_rules('is_status', 'Status', 'required');

				if ($this->form_validation->run() !== false) {
					$editcatId = $this->input->post('category_id'); 
					if ($editcatId == '') {
						$status = $this->input->post('is_status') ? 1 : 0;
						$insert_data = array(
							'seat_category' => $this->input->post('seat_position'),
							'category_color' => $this->input->post('category_color'),
							'status' => $status,
							'event_type' => $this->input->post('event'),
							// 'add_by' => $this->session->userdata('admin_id'),
							'create_date' => strtotime(date('Y-m-d H:i:s'))
						);
						$inserted_id = $this->General_Model->insert_data('stadium_seats', $insert_data);
						if ($inserted_id) {
							$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
							foreach ($lang as $key => $l_code) {
								$language_data = array(
									'language' =>  $l_code->language_code,
									'stadium_seat_id' => $inserted_id,
									'seat_category' => $this->input->post('seat_position')
								);
								$this->General_Model->insert_data('stadium_seats_lang', $language_data);
							}
							$response = array('status' => 1, 'msg' => 'New Stadium Category Created Successfully.','redirect_url' => base_url() . 'game/stadium_category', 'status' => 1);
							echo json_encode($response);
							exit;
						} else {
							$response = array('msg' => 'Failed to create new seat position.', 'redirect_url' => base_url() . 'game/stadium_category/add', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					} else { 
						$updateData = array();
						$updateData_lang = array();
						$updateData['seat_category'] = trim($this->input->post('seat_position'));
						$updateData['category_color'] = trim($this->input->post('category_color'));
						$updateData['event_type'] = trim($this->input->post('event'));
						$updateData['status'] = $this->input->post('is_status') ? 1 : 0;
						
						$this->General_Model->update('stadium_seats', array('id' => $editcatId), $updateData);
						
						//Update language table			
						$updateData_lang['seat_category'] = trim($this->input->post('seat_position'));
						$this->General_Model->update('stadium_seats_lang', array('stadium_seat_id' => $editcatId, 'language' => $this->session->userdata('language_code')), $updateData_lang);
						$response = array('status' => 1, 'msg' => 'Stadium Category data updated Successfully.','redirect_url' => base_url() . 'game/stadium_category');
						echo json_encode($response);
						exit;
					}
				} else {
					//redirect('/game/stadium_category');
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'game/stadium_category', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			}
		} else {
			$this->load->view(THEME.'game/stadium_category_list', $this->data);
			// $row_count = $this->uri->segment(3);
			// $this->loadRecord($row_count, 'stadium_seats', 'game/stadium_category', 'id', 'DESC', 'game/stadium_category_list', 'categories', 'seatcategory');
		}
		
	}

	public function reset_satdium(){
		
		$stadiumId =  $_POST['staduim_id'];
		$regins  = $_POST['colors'];
		$someArray = array();
		$regions = array();
		if($regins){
			$datas = json_decode($_POST['colors'],true);
			foreach ($datas as $key => $value) {
					$regions[] = array ( 'stadium_id'  	=> $stadiumId,
										'block_id' 		=> $key,
										'block_color' 	=> $value
									);
			}
		}
		if($regions){

			$this->db->where("stadium_id", $stadiumId);
    		$this->db->delete("stadium_details");
    		
			$this->db->insert_batch('stadium_details',$regions);
			$regions = array();
			$regions['id'] = "";
			$regions['id_no_spaces'] = "";
			$regions['fill'] = "";
			$regions['href'] = "";
			$regions['tooltip'] = "";
			$regions['data'] = array();

			$someArray['regions'][] = $regions;

			$updateData['map_code'] = json_encode($someArray);
			$this->General_Model->update_table('stadium', 's_id', $stadiumId, $updateData);
			echo $this->db->last_query();
			
		}
		echo "ok";
		die;

		// print_r(json_decode($_POST['colors']));



		// $getStadiumByid = $this->General_Model->getAllItemTable_array('stadium', array('s_id' => $stadiumId))->result();
		// if($getStadiumByid[0]->map_code){
		// 	$someArray = json_decode($getStadiumByid[0]->map_code, true);

		// 	if (array_key_exists($block_id, $someArray['regions'])) {

		// 		foreach ($someArray['regions'] as $key => $sr) {

		// 			if ($block_id == $key) {
		// 				$someArray['regions'][$key]['fill'] = $color;
		// 				$someArray['regions'][$key]['href'] = $href;
		// 				$someArray['regions'][$key]['tooltip'] = $href;
		// 			}
		// 		}
		// 	} else {

		// 		$regions = array();
		// 		$regions['id'] = $block_id;
		// 		$regions['id_no_spaces'] = $block_id;
		// 		$regions['fill'] = $color;
		// 		$regions['href'] = $href;
		// 		$regions['tooltip'] = $href;

		// 		$regions['data'] = array();

		// 		$someArray['regions'][$block_id] = $regions;
		// 	}
		// }

		die;

	}
	public function order_reports()
	{
		$event="";$ticket_category="";$stadium="";$event_start_date="";$event_end_date="";
		$seller="";$order_id="";$customer_id="";$protect="";$seller_name="";$order_status="";$shipping_status="";$rowno=""; $row_per_page="";$ignore_end_date='';
		$where_array = array();
		if($_GET['event_start_date'] != "" && $_GET['event_end_date'] != ""){
			
			$where_array['event_start_date']  = $_GET['event_start_date'];
			$where_array['event_end_date']  = $_GET['event_end_date'];
			$event_start_date= $_GET['event_start_date'];
			$event_end_date  = $_GET['event_end_date'];

			$fileName = "Order_summary_" .$_GET['event_start_date'] . "_To_".$_GET['event_end_date'].".xls"; 
		}
		else{
		
			 $fileName = "Order_summary_" . date('Y-m-d') . ".xls"; 
		}
		if($_GET['event_name'] != ""){
			//$where_array['event_name'] = $_GET['event_name'];
			$event= $_GET['event_name'];
		}
		
		// $ticket_category 		 		= $_GET['ticket_category'];
		// $stadium 						= $_GET['stadium'];
		// $event_start_date 				= $_GET['event_start_date'];
		// $event_end_date 				= $_GET['event_end_date'];
		// $ignore_end_date 		 		= $_GET['ignore_end_date'];
		// $seller 						= $_GET['seller'];	
		 $seller_name					= $_GET['sellerIds'];// isset($_GET['sellerIds']) ?  implode(",", $_GET['sellerIds']) : '';

		$order_id 						= $_GET['booking_no'];
	// 	$order_status 					= $_GET['order_status'];
		$shipping_status 				= $_GET['shippingIds'];
	// //	$order_status 					= $_GET['order_status'];				
	// 	$customer_id 					= $_GET['customer_id'];
	// 	$protect 						= $_GET['protect'];

		$all_records = $this->General_Model->getOrdersSearch("",$event,$ticket_category,$stadium,$event_start_date,$event_end_date,$ignore_end_date,'',$seller,$order_id,$customer_id,$protect,$seller_name,$order_status,$shipping_status,$rowno, $row_per_page)->result();


		$fields = array('OrderID','PaymentStatus','EventName','Buyer','TicketType','Qty','Category','SellersNotes','Total','PurchaseDate','Seller','DeliveryDate','ShippingStatus','AdminStatus'); 
		
		// Display column names as first row 
		$excelData = implode("\t", array_values($fields)) . "\n"; 
		$total_amount = array();
		foreach($all_records as $download_order){  

			$payment_status = "";

				switch ($download_order->payment_status) {
					case 1:
						$payment_status = 'Paid';
						break;
					case 2:
						$payment_status = 'Pending';
						break;
					case 0:
						$payment_status = 'Failed';
						break;
					default:
						$payment_status = 'Not Initiated';
						break;
				}


				if($download_order->ticket_type == 1) $ticket_type = "Season cards";
				else if($download_order->ticket_type == 2) $ticket_type = "E-Tickets";
				else if($download_order->ticket_type == 3) $ticket_type = "Paper";
				else if($download_order->ticket_type == 4) $ticket_type = "Mobile";
				else $ticket_type = "";

				if($download_order->ticket_block != 0){
					$category= $download_order->seat_category;
				}
				else{
					$category= "Any";
				}

				$total= number_format($download_order->total_amount,2)." ".strtoupper($download_order->currency_type); 

				$delivery_status = "";

				switch ($download_order->delivery_status) {
					case 0:
						$delivery_status = 'Tickets Not Uploaded';
						break;
					case 1:
						$delivery_status = 'Tickets In-Review';
						break;
					case 2:
						$delivery_status = 'Tickets Approved';
						break;
					case 3:
						$delivery_status = 'ickets Rejected';
						break;
					case 4:
						$delivery_status = 'Tickets Downloaded';
						break;
					case 5:
						$delivery_status = 'Tickets Shipped';
						break;
					case 6:
						$delivery_status = 'Tickets Delivered';
						break;
					default:
						$delivery_status = "";
						break;
				}

				$admin_status="";
				if ($download_order->seller_status == 0) {
				   $admin_status='Processing';
				}
				else if ($download_order->seller_status == 1) {
				   $admin_status='Completed';
				}
				else if ($download_order->seller_status == 2) {
				   $admin_status='Issue';
				}
				else if ($download_order->seller_status == 3) {
				   $admin_status='Get Paid';
				}

		$lineData = array($download_order->booking_no,
						  $payment_status,
						  $download_order->match_name,
						  $download_order->customer_first_name." ".$download_order->customer_last_name,
						  $ticket_type,
						  $download_order->quantity,
						  $category,
						  "",
						  $total,						  
						  date('d F Y',strtotime($download_order->payment_date))." ".date('H:i',strtotime($download_order->payment_date)),
						  $download_order->seller_first_name." ".$download_order->seller_last_name,
						  "",
						  $delivery_status,
						  $admin_status,
						  ); 
		
		$total_amount[] = $download_order->total_base_amount;
		$excelData .= implode("\t", array_values($lineData)) . "\n"; 
		} 
		
		header("Content-Type: application/vnd.ms-excel"); 
		header("Content-Disposition: attachment; filename=\"$fileName\""); 

		// Render excel data 
		echo $excelData; 

		exit;
	}

	public function get_encrpty_id()
	{
		$enc_id = md5($_POST['booking_id']);
		$response = array('status' => 1, 'msg' => $enc_id);
		echo json_encode($response);
		exit;
	}

	public function get_download_record()
	{
		$eticketData = $this->General_Model->get_ticket_file_list($this->uri->segment(3))->result();

		$createdzipname = "1BX" . $this->uri->segment(3) . '_Tickets';

		$this->load->library('zip');
		$this->load->helper('download');

		// create new folder 
		//$this->zip->add_dir('uploads/tickets_zip');

		foreach ($eticketData as $file) {
			$paths = TICKET_UPLOAD_PATH . 'uploads/e_tickets/' . $file->ticket_file; // Assuming FCPATH is the correct base path
			//$paths = UPLOAD_PATH . 'uploads/e_tickets/' . $file->ticket_file;
			// add data own data into the folder created
			//$this->zip->add_data($file->ticket_file, $paths);

			if ($file->ticket_file != "") { 
				$this->zip->add_data($file->ticket_file, file_get_contents($paths));
			} else {
				// Handle the case when the file doesn't exist or is not accessible
				echo "File not found: " . $file->ticket_file . "<br>";
			}
		}
		$this->zip->download($createdzipname . '.zip');
	}

	public function booking_get_items()
	{
		/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
		$row_per_page = 50;
		$draw = intval($this->input->post("draw"));

		$rowno = $_POST['start'];
		if ($rowno != '' && $rowno != 0) {
			//$rowno = ($rowno - 1) ;
		} else {
			$rowno = 0;
		}

		// echo $rowno;
		// exit;	

		if (!empty($_POST['booking_no']) || !empty($_POST['event']) || !empty($_POST['seller_name']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['shipping_status']) || @$_POST['order_status'] != "" || @$_POST['seller_status'] != "") {
			$seller_name = isset($_POST['seller_name']) ? implode(",", $_POST['seller_name']) : '';

			$filter_data = array("booking_no" => $_POST['booking_no'], "event" => $_POST['event'], "seller" => $seller_name, "event_start_date" => $_POST['event_start_date'], "event_end_date" => $_POST['event_end_date'], "shipping_status" => $_POST['shipping_status'], "order_status" => $_POST['order_status'], "seller_status" => $_POST['seller_status'],'row_no' => $rowno, 'row_per_page' => $row_per_page);

			$records = $this->General_Model->getOrders_filter($filter_data)->result();

			$filter_data = array("booking_no" => $_POST['booking_no'], "event" => $_POST['event'], "seller" => $seller_name, "event_start_date" => $_POST['event_start_date'], "event_end_date" => $_POST['event_end_date'], "shipping_status" => $_POST['shipping_status'], "order_status" => $_POST['order_status'], "seller_status" => $_POST['seller_status']);

			$allcount = $this->General_Model->getOrders_filter($filter_data)->num_rows();

		} else {
			$records = $this->General_Model->getOrders('', $this->uri->segment(4), '', $rowno, $row_per_page)->result();
			
			$allcount = $this->General_Model->getOrders('', $this->uri->segment(4))->num_rows();
			// echo $this->db->last_query();
			// exit;
		}
	
		$data = [];
		$order_ids = [];
		$this->data['sellers'] = $this->General_Model->get_sellers();
		$this->data['events'] = $this->General_Model->get_events();
		$this->data['order_ids'] = $this->General_Model->get_orders();

		// echo '<pre/>';
		// print_r($records);
		// exit;
		foreach ($records as $record) {
			$payment_status = "";
			$booking_no="";
			if ($record->payment_status == 1) {
				$payment_status = '<div class="bttns">
										<span class="badge badge-success">Paid</span>
									</div>';
			} else if ($record->payment_status == 2) {
				$payment_status = '<div class="bttns">
										<span class="badge badge-warning">Pending</span>
									</div>';
			} else if ($record->payment_status == 0) {
				$payment_status = '<div class="bttns">
										<span class="badge badge-danger">Failed</span>
									</div>';
			} else if ($record->payment_status != 0 && $record->payment_status != 1 && $record->payment_status != 2) {
				$payment_status = "Not Initiated";
			}

			//Shipping Status

			$delivery_status = "";
			if ($record->delivery_status == 0) {
				$delivery_status = '<span class="text-warning">Tickets Not Uploaded</span>';
			} else if ($record->delivery_status == 1) {
				$delivery_status = '<span class="text-warning">Tickets In-Review</span>';
			} else if ($record->delivery_status == 2) {
				$delivery_status = '<span class="text-success">Tickets Approved</span>';
			} else if ($record->delivery_status == 3) {
				$delivery_status = '<span class="text-danger">Tickets Rejected</span>';
			} else if ($record->delivery_status == 4) {
				$delivery_status = '<span class="text-success">Tickets Downloaded</span>';
			} else if ($record->delivery_status == 5) {
				$delivery_status = '<span class="text-success">Tickets Shipped</span>';
			} else if ($record->delivery_status == 6) {
				$delivery_status = '<span class="text-success">Tickets Delivered</span>';
			}

			if ($record->ticket_block != 0) {
				$category = $record->seat_category;
			} else {
				$category = "Any";
			}


			switch (trim($record->ticket_type)) {
				case 1:
					$ticket_type = "Season cards";
					$record->ticket_type = "Season cards";
					break;
				case 2:
					$ticket_type = "E-Tickets";
					$record->ticket_type = "E-Tickets";
					break;
				case 3:
					$ticket_type = "Paper";
					$record->ticket_type = "Paper";
					break;
				case 4:
					$ticket_type = "Mobile";
					$record->ticket_type = "Mobile";
					break;
				default:
					$ticket_type = "";
					break;
			}
// echo '<pre/>';
// print_r($ticket_type);
// exit;

			if ($record->booking_status == 1)
				$order_status = '<span class="text-success">Confirmed</span>';
			else if ($record->booking_status == 2)
				$order_status = '<span class="text-warning>Pending</span>';
			else if ($record->booking_status == 3)
				$order_status = '<span class="text-danger">Cancelled</span>';
			else if ($record->booking_status == 4)
				$order_status = '<span class="text-shipped">Shipped</span>';
			else if ($record->booking_status == 5)
				$order_status = '<span class="text-success">Delivered</span>';
			else if ($record->booking_status == 6)
				$order_status = '<span class="text-success">Downloaded</span>';
			else if ($record->booking_status == 7)
				$order_status = '<span class="text-grey">Initiated</span>';
			else if ($record->booking_status == 0)
				$order_status = '<span class="text-danger">Failed</span>';
			else
				$order_status = "";


			$total = number_format($record->total_amount, 2) . " " . strtoupper($record->currency_type);

			$match_time = " <br> <span class='tr_date'>" . date('d/m/Y', strtotime($record->match_date)) . "</span><br>  <span class='tr_date'>" . date('H:i A', strtotime($record->match_time)) . "</span>";

			$formated_match_time = date('D d F Y', strtotime($record->match_date)) . "," . date('H:i A', strtotime($record->match_time));
			$record->formated_match_time = $formated_match_time;

			if ($record->listing_note != '') {
				$seller_notes = $this->General_Model->get_seller_notes($record->listing_note);
				//$record->seller_notes = array_slice($seller_notes, 0, 3);


			}

			$record->eticketData = $this->General_Model->get_download_tickets(array('booking_id' => $record->bg_id, 'ticket_id' => $record->bt_id))->result();
			$record->nominees = $this->General_Model->get_nominees(array('booking_id' => $record->bg_id, 'ticket_id' => $record->bt_id))->result();
			$record->ticket_upload_date = "";
			if ($record->eticketData[0]->ticket_upload_date) {
				$record->ticket_upload_date = date("d F Y H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->eticketData[0]->ticket_upload_date))) . ' ' . @$_COOKIE["time_zone"];
			}
			$record->ticket_approve_date = "";
			if ($record->eticketData[0]->ticket_approve_date) {
				$record->ticket_approve_date = date("d F Y H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $eticketData[0]->ticket_approve_date))) . ' ' . @$_COOKIE["time_zone"];
			}

			$encrpty_id[$record->booking_no] = md5($record->booking_no);
			$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

			//$booking_no = htmlspecialchars($booking_no, ENT_QUOTES, 'UTF-8');
			

			/*$date1 = new DateTime(date('D j F Y', strtotime($record->payment_date)));
			$date2 = new DateTime(date('D j F Y', strtotime($record->match_date)) . date('H:i', strtotime($record->match_time)));

			$diff = $date1->diff($date2);
			$days = $diff->days;

			$delivery_date = "";

			if ($days <= 1) {
				$delivery_date = "Delivery In Due";
			} else {
				$delivery_date = date('D j F Y', strtotime($record->match_date . ' -3 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
			}
				*/
			$delivery_date = date('D j F Y', strtotime($record->match_date . ' -2 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
			$record->delivery_date = $delivery_date;

			$data[] = array(
				"toggle" => '<i class="fas fa-angle-right"></i>',
				"booking_no" => $booking_no,
				"match_name" => $record->match_name,
				"match_date" => $match_time,
				"buyer" => $record->customer_first_name . " " . $record->customer_last_name,
				"ticket_type" => $ticket_type,
				"tickets" => '(' . $record->quantity . ')',
				"category" => $category,
				"total_ticket_price" => $total,
				"buyer_value" => $total,
				//"purchase_date"			=> date('d F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date)),
				"purchase_date" => date('d/m/Y', strtotime($record->payment_date)),
				"seller" => $record->seller_first_name . " " . $record->seller_last_name,
				"delivery_date" =>  $delivery_date,
				"shipping_status" => $delivery_status,
				"order_status" => $order_status,
				'order_data' => $record,


			);
			// echo '<pre/>';
			// print_r($data);
			// exit;
		}

		$result = array(
			"order_ids" => $this->data['order_ids'],
			"sellers" => $this->data['sellers'],
			"events" => $this->data['events'],
			"draw" => $draw,
			"recordsTotal" => $allcount,
			"recordsFiltered" => $allcount,
			"data" => $data
		);


		echo json_encode($result,true);
		exit();
	}	




public function merge_stadium_category_v1()
	{
		//echo "<pre>";print_r($_POST);exit;
		if (!empty($this->input->post())) {
			
			$stadium_id 		  =	$_POST['stadium_id'];
			$stadium 		  =	$_POST['stadium'];
			$api 				  =	$_POST['api'];
			$api_categories 	  =	$_POST['api_category'];
			$boxoffice_categories =	$_POST['boxoffice_category'];
			$all_values  = array();
			foreach($api_categories as $key => $api_category){
				/*echo "<pre>";print_r($boxoffice_categories[$key]);exit;
				echo 'key = '.$key;exit;*/
				if($api_category){ 
							
					/*echo "<pre>";print_r($api_category);
					echo "<pre>";print_r($boxoffice_categories[$key]);exit;*/

					$stadium_api_category = $this->General_Model->getAllItemTable_array('merge_api_stadium_category', array(
							"stadium_id" 	=> $stadium_id,
							"onebox_stadium_id" 	=> $stadium,
						//	"category" 		=> $boxoffice_categories[$key],
							"source_type"   => $api,
							"api_category" 	=> $api_category
						))->row();
					$all_values[] = $api_category;
					//echo "<pre>";print_r($boxoffice_categories);exit;
						if(empty($stadium_api_category)){
							$data = array(
									'stadium_id'	=> $stadium_id,
									"onebox_stadium_id" 	=> $stadium,
									'category'		=> $boxoffice_categories[$key],
									"source_type"   => $api,
									'api_category'	=> $api_category,
									'created_at' 	=> date("Y-m-d H:i:s")
							);//echo "<pre>";print_r($data);exit;
							$inserted_id = $this->General_Model->insert_data('merge_api_stadium_category', $data);

							$table                     = "tixstock_stadium_category";
							$wheres                    = array('id' => $api_category);
							$uvalue                    = array('merge_status' => 1);
							$this->Tixstock_Model->update_table($table, $wheres, $uvalue);

						}
						else{
							$updateData = array(
									'category'			=> $boxoffice_categories[$key],
									'api_category'		=> $api_category,
							);

							$this->General_Model->update_table('merge_api_stadium_category', 'id', $stadium_api_category->id, $updateData);

							$table                     = "tixstock_stadium_category";
							$wheres                    = array('id' => $api_category);
							$uvalue                    = array('merge_status' => 1);
							$this->Tixstock_Model->update_table($table, $wheres, $uvalue);

						}

				

				
				
				}
				else{
					$this->db->where('stadium_id',$stadium_id);
					$this->db->where('onebox_stadium_id',$stadium);
					$this->db->where('category',$api_category);
					$this->db->delete('merge_api_stadium_category');
				}

				if($all_values){
					
						$this->db->where('stadium_id',$stadium_id);
						$this->db->where('onebox_stadium_id',$stadium);
						$this->db->where('category',$api_category);
						$this->db->where_not_in('api_category ',$all_values);
						$this->db->delete('merge_api_stadium_category');
					}

			}
			
			echo json_encode(array('status' => 1,'msg' => "Category updated successfully."));exit;

			
		}
		$this->data['apis']     = 		$this->General_Model->getAllItemTable_Array('api', array('status' => 1))->result();
		$this->data['stadiums'] = $this->General_Model->getAllItemTable_Array('stadium', array('status' => '1'),"",'stadium_name','ASC')->result();
		$this->load->view(THEME.'game/merge_stadium_category', $this->data);
	}

public function get_stadium_details()
	{
		//echo "<pre>";print_r($_POST);exit;
		
		if($_POST['stadium'] != ""){

			$stadium = $this->General_Model->getAllItemTable('stadium','s_id',$_POST['stadium'])->row();//echo "<pre>";print_r($stadium);exit;
			$map_img = explode('/',$stadium->stadium_image);
			$map_img_ext = explode('.',end($map_img));
			//echo $this->db->last_query();
			if(end($map_img_ext) == "svg"){
			$stadium->stadium_image = "https://www.listmyticket.com".$stadium->stadium_image;
			}
			$category = $this->General_Model->get_stadium_details_category($_POST['stadium'])->result();

		}
		
		echo json_encode(array('status' => 1,'stadium' => $stadium,'category' => $category));exit;
	}

	public function get_category_or_block_v1()
	{
		
		
		if($_POST['api'] != "" && $_POST['stadium'] != "" && $_POST['section_type'] != ""){
		$data['boxoffice_categories'] = $this->General_Model->get_stadium_category_1boxoffice($_POST['stadium'],'1boxoffice')->result();
		
		$category_count = 0;

		if($_POST['section_type'] == "category"){ 

			if($_POST['api'] == "tixstock"){

				$data['api_categories'] = $this->General_Model->get_stadium_category_tixstock($_POST['stadium'],'tixstock')->result();
				$data['api_source'] =$_POST['api'];
				$category_count = count($data['api_categories']);
				//echo "<pre>";print_r($data['api_categories']);exit;
			 $category_block_data = $this->load->view(THEME.'game/stadium_category_v1', $data,true);

			}
			else if($_POST['api'] == "oneclicket"){
				$data['api_source'] =$_POST['api'];
				$data['api_categories'] = $this->General_Model->get_stadium_category_oneclicket($_POST['stadium'],'oneclicket')->result();
				$category_count = count($data['api_categories']);
				//echo "<pre>";print_r($data['api_categories']);exit;
			 $category_block_data = $this->load->view(THEME.'game/stadium_category_v1', $data,true);

			}
			
		}
		else if($_POST['section_type'] == "block"){ 
			$data['tixstock_blocks'] = $this->General_Model->get_stadium_block($_POST['stadium'],'tixstock')->result();
			$category_block_data = $this->load->view(THEME.'game/stadium_blocks_v1', $data,true);
		}
		 $stadium_category = $this->load->view(THEME.'game/stadium_category', $data,true);

		}
		
		echo json_encode(array('status' => 1,'stadium_category' => $stadium_category,'section_type' => $_POST['section_type'],'section' => $category_block_data,'category_count' => $category_count));exit;
	}
	

public function send_review_request()
  {
  	if(!empty($_POST['requestIds'])){

				// $url = API_CRON_URL.'send_review_request';
				// $post_data = array("bg_ids" => $_POST['requestIds']);
				// $handle = curl_init();
				// curl_setopt($handle, CURLOPT_URL, $url);
				// curl_setopt($handle, CURLOPT_POST, 1);
				// curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
				// curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
				// $output = curl_exec($handle);
				// curl_close($handle);
				 $response['status'] = 1;
				$response['msg'] = "Review request mail sent successfully to the selected orders.";
				echo json_encode($response);exit;

  	}
  	else{
  		$response['status'] = 0;
  		$response['msg'] = "Invalid booking order id.";
  	}
  	echo json_encode($response);exit;
  }

  
  public function update_tixstock_nominee()
  {
  	if(!empty($_POST['bg_id'])){

				$url = API_URL.'update_tixstock_nominee';
				$post_data = array("bg_id" => $_POST['bg_id']);
				$handle = curl_init();
				curl_setopt($handle, CURLOPT_URL, $url);
				curl_setopt($handle, CURLOPT_HTTPHEADER, array(
					'domainkey: https://www.1boxoffice.com/en/'
					));
				curl_setopt($handle, CURLOPT_POST, 1);
				curl_setopt($handle, CURLOPT_POSTFIELDS,$post_data);
				curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($handle);
				$res = json_decode($output,1);
				curl_close($handle);
				if($res['meta']['errors'] != ""){ 
					$response['status'] = 0;
					$response['msg'] = $res['meta']['errors'];
					echo json_encode($response);exit;
				}
				else{ 
					$response['status'] = 1;
					echo json_encode($response);exit;
				}
				
				/*$response['status'] = 1;
				$response['msg'] = "Review request mail sent successfully to the selected orders.";
				echo json_encode($response);exit;*/

  	}
  	else{ 
  		$response['status'] = 0;
  		$response['msg'] = "Invalid booking order id.";
  		echo json_encode($response);exit;
  	}
  	
  }
  
	public function get_match_category_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['ticket_type'])  ) 
		{
			$search['status']=$_POST['status'];
			$search['category_name']=$_POST['ticket_type'];

			$allcount = $this->General_Model->get_game_category_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_game_category_by_limit($rowno, $row_per_page, "game_category.category_name", 'asc', '', $search)->result();	

		}
		else
		{	

			$allcount = $this->General_Model->get_game_category_by_limit('', '', '', '', '', "")->num_rows();
			$records = $this->General_Model->get_game_category_by_limit($rowno, $row_per_page, "game_category.category_name", 'asc', '', "")->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."game/category/add_category/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'game/category/delete_category/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}

				

			$data[] = array( 
                "category_name"				=> $record->category_name, 
				"status"					=> $status,				
				"action"					=> $action
			
			);
			$i++;
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

	public function get_ticket_delivery_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

             
		if (!empty($_POST['booking_no']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['seller_name']) || !empty($_POST['event']) || !empty($_POST['seat']) || !empty($_POST['customer_name']) ) {
    
			$search['booking_no']=$_POST['booking_no'];
			$search['event_start_date']=$_POST['event_start_date'];
			$search['event_end_date']=$_POST['event_end_date'];
			$search['seller_name']=$_POST['seller_name'];
			$search['customer_name']=$_POST['customer_name'];
			$search['event_name']=$_POST['event'];
			$search['seat']=$_POST['seat'];

			$allcount = $this->General_Model->ticket_delivery(1,$rowno, $row_per_page,$search)->num_rows();
			$records = $this->General_Model->ticket_delivery(1,$rowno, $row_per_page,$search)->result();

		}
		else
		{	
			$allcount = $this->General_Model->ticket_delivery(1)->num_rows();
			$records = $this->General_Model->ticket_delivery(1,$rowno, $row_per_page)->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$pending		= $this->General_Model->get_ticket_status($record->bg_id,'pending')->num_rows();
			$uploaded	= $this->General_Model->get_ticket_status($record->bg_id,'uploaded')->num_rows();
			$downloaded		= $this->General_Model->get_ticket_status($record->bg_id,'pending')->num_rows();			
			
			$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';		
			
			$match_time="<br/><span class='tr_date'>".date('D j F Y',strtotime($record->match_date))."</span> <span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";		

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

				$seller='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->admin_name." ".$record->admin_last_name.'</a>';

				$customer='<a href="'.base_url()."home/customer_info/". $record->user_id.'">'.$record->first_name." ".$record->last_name.'</a>';
				$event='<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.$match_time.'</a>';
				
			$data[] = array( 
                "booking_no"				=> $booking_no, 
				"customer"					=> $customer,
				"seller"					=> $seller,					
				"event"						=> $event,
				"quantity"					=> '<div class="tick_quan">'.$record->quantity.'</div>',
				"pending"					=> '<div class="tick_pending">'.$pending.'</div>',
				"uploaded"					=> '<div class="tick_upload">'.$uploaded.'</div>',
				"downloaded"				=> '<div class="tick_down">'.$downloaded.'</div>',
			
			);
			
	}

	// echo '<pre/>';
	// print_r($data);
	// exit;
		$result = array(
            "draw" => $draw,
              "recordsTotal" => $allcount,
              "recordsFiltered" => $allcount,
              "data" => $data
         );

		echo json_encode($result);
		exit();

	}


	public function update_tixstock_order(){

		$orders = $this->General_Model->getAllItemTable_Array('booking_tixstock', array('tixstock_status' => 'Approved'))->result();
		if(!empty($orders)){

			foreach($orders as $order){
				$create_order_response = json_decode($order->create_order_response);
				if($create_order_response->data->id != ""){
					$tix_id            = $order->tix_id;
					$tixstock_order_id = trim($create_order_response->data->id);
					if($tixstock_order_id != ""){

							$table                     = "booking_tixstock";
							$wheres                    = array('tix_id' => $tix_id);
							$uvalue                    = array('tixstock_order_id' => $tixstock_order_id);
							$this->Tixstock_Model->update_table($table, $wheres, $uvalue);

					}
					//echo $tixstock_order_id;exit;
				}
				//echo "<pre>";print_r($create_order_response);exit;
			}
			echo "COMPLTETED";exit;

		}

	}
public function delete_attendee()
{
		$msg = '';
		$id=$_POST["id"];
		
		if ($id != '') {
				$this->db->where(array('id' => $id));
				$query = $this->db->get('booking_etickets');
				$resultTest = $query->row();
				if (!empty($resultTest)) {

					$updateData['first_name'] 				= "";
					$updateData['last_name'] 				= "";
					$updateData['nationality'] 				= "";
					$updateData['email']					= "";
					$updateData['dob'] 						= "";

					$this->General_Model->update_table('booking_etickets', 'id', $resultTest->id, $updateData);
					$response = array('status' => 1, 'msg' => 'Attendee deleted successfully.' );
				}
		}
		else
		{
			$response = array('status' => 0, 'msg' => 'Some Issue Attendee not deleted.' );
		}

		

		echo json_encode($response);
		exit;
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
	
	public function pending_orders()
	{
		$this->data['pending_orders'] = $this->General_Model->getOrders('','pending')->result();

		$records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name." ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input seller_select_box" id="customCheck'.$record->seller_id.'">
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

		$this->load->view(THEME.'game/pending_orders_list',$this->data);
	}

	public function get_pending_items()
  {
		$row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		
		$rowno = $_POST['start'];
		//$rowno =$this->uri->segment(3);
		
		if ($rowno != '' && $rowno != 0) {
		$rowno = ($rowno - 1) ;
		}
		else{
			$rowno = 0;			
		}


		if(!empty($_POST['booking_no']) || !empty($_POST['event_name']) || !empty($_POST['status_type']) || !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['seat']) || !empty($_POST['seller_name']))
		{
			$search['booking_no'] = $_POST['booking_no'];
			$search['event_name'] = $_POST['event_name'];

			$search['status_type'] = $_POST['status_type'];
			$search['event_start_date'] = $_POST['event_start_date'];
			$search['event_end_date'] = $_POST['event_end_date'];
			$search['seller_name'] = $_POST['seller_name'];
			$search['seat'] = $_POST['seat'];

			$records = $this->General_Model->getPendingOrdersFilter('','pending','',$rowno, $row_per_page,'',$search)->result();
			$allcount = $this->General_Model->getPendingOrdersFilter('','pending','','', '','',$search)->num_rows();
		} else {  
								
				$records = $this->General_Model->getOrders('','pending','',$rowno, $row_per_page)->result();
				$allcount = $this->General_Model->getOrders('','pending')->num_rows();				
			}

			$data = [];
			$this->data['sellers'] = $this->General_Model->get_sellers();
			// echo '<pre/>';
			// print_r($records);
			// exit;
			foreach($records as $record ){

				$seller_notes_input="";
				$seller_notes="";
				$listing_note=$this->General_Model->get_seller_notes($record->listing_note);
			
				if(!empty($listing_note))
				{				
					foreach ($listing_note as $notes)
					{
						$seller_notes_input.=$notes->ticket_name."<br/>";
						
					}

					$seller_notes='<a class="tooltip_texts" data-toggle="tooltip" data-placement="right" title="" data-original-title="'.$seller_notes_input.'" aria-describedby="tooltip173041" data-html="true"><i class="fas fa-comment-dots"></i></a>';
				}

				$payment_status="";
				 if ($record->payment_status == 1) {
					$payment_status='<div class="bttns">
										<span class="badge badge-success">Completed</span>
									</div>';
				 } 
				 else if ($record->payment_status == 2) { 
					$payment_status='<div class="bttns">
										<span class="badge badge-warning">Pending</span>
									</div>';
				 } 
				 else if ($record->payment_status == 0) { 
					$payment_status='<div class="bttns">
										<span class="badge badge-danger">Failed</span>
									</div>';
				 } 	
				 else if ($record->payment_status != 0 && $record->payment_status != 1 && $record->payment_status != 2) { 
					$payment_status="Not Initiated";
				 } 	

				 //Shipping Status

				 $delivery_status="";
				 if ($record->delivery_status == 0) {
					$delivery_status='<div class="bttns">
										<span class="badge badge-warning">Tickets Not Uploaded</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 1) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-warning">Tickets In-Review</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 2) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Approved</span>
									</div>';
				 } 	
				 else if ($record->delivery_status == 3) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-danger">Tickets Rejected</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 4) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Downloaded</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 5) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Shipped</span>
									</div>';
				 } 
				 else if ($record->delivery_status == 6) { 
					$delivery_status='<div class="bttns">
										<span class="badge badge-success">Tickets Delivered</span>
									</div>';
				 } 

				 // End of Shipping Status
				

				 $admin_status="";				
				  if ($record->booking_status == 0) {
					$admin_status='<div class="bttns">
									<span class="badge badge-danger">Failed</span>
								  </div>';
				 }
				 else if ($record->booking_status == 1) {
					$admin_status='<div class="bttns">
									<span class="badge badge-success">Confirmed</span>
								  </div>';
				 }
				 else if ($record->booking_status == 2) {
					$admin_status='<div class="bttns">
									<span class="badge badge-primary">Pending</span>
								  </div>';
				 }
				else if ($record->booking_status == 3) {
					$admin_status='<div class="bttns">
									<span class="badge badge-danger">Cancelled</span>
								  </div>';
				 }
				 else if ($record->booking_status == 4) {
					$admin_status='<div class="bttns">
									<span class="badge badge-warning">Shipped</span>
								  </div>';
				 }
				 else if ($record->booking_status == 5) {
					$admin_status='<div class="bttns">
									<span class="badge badge-warning ">Delivered</span>
								  </div>';
				 }
				 else if ($record->booking_status == 6) {
					$admin_status='<div class="bttns">
									<span class="badge badge-warning ">Downloaded</span>
								  </div>';
				 }

				if($record->ticket_block != 0){
					$category= $record->seat_category;
				}
				else{
					$category= "Any";
				}

				if($record->ticket_type == 1) $ticket_type = "Season cards";
				else if($record->ticket_type == 2) $ticket_type = "E-Tickets";
				else if($record->ticket_type == 3) $ticket_type = "Paper";
				else if($record->ticket_type == 4) $ticket_type = "Mobile";
				else $ticket_type = "";
					
				$price= number_format($record->price,2)." ".strtoupper($record->currency_type); 
				$total= number_format($record->total_amount,2)." ".strtoupper($record->currency_type); 
				
				$date = new DateTime($record->match_date);
				$time = new DateTime($record->match_time);

				$formattedDate = $date->format('d M Y');
				$formattedTime = $time->format('H:i');

				$match_time = " <br> <span class='tr_date'>".$formattedDate.' - '.$formattedTime."</span>";

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
				
				$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a> <br><span class="tr_src_type">'.$record->source_type.'</span>';

				$delivery_date="";
							
								$delivery_date = date('D j F Y', strtotime($record->match_date . ' -2 days')) . "<br/>" . date('H:i', strtotime($record->match_time));
								$download_id="";
								//echo "<pre>";print_r($record);exit;
								$encode_id = base64_encode(json_encode($record->match_id));							
if($record->delivery_status != 0)
{
	$download_id=$record->bg_id;
}					
				$premium_price= number_format($record->premium_price,2)." ".strtoupper($record->currency_type);

$approve_or_reject = ' <div class="reject_btn">
										<button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave" onclick="ajax_update_pending_orders(\''.$record->booking_id.'\',3)">
										<a class="button is-danger" href="javascript:void(0);" >
										Reject
										</a>
										</button>
									</div>
									<div class="approve_btn">
										<button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave" onclick="ajax_update_pending_orders(\''.$record->booking_id.'\',1)"><a class="button is-success" href="javascript:void(0);" >
										Approve
										</a>
										</button>
									</div>';

												
				
				$data[] = array( 
					"checkbox_inpt"				    => '<div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" data-order-id="'.md5($record->booking_no).'" data-org-order-id="'.$record->booking_id.'"><label class="form-check-label">&nbsp;</label></div>',
					"booking_no"			=> $booking_no,
					"payment_status"		=> $payment_status,
					"event_name"			=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.'</a>'.$match_time,
					"buyer"					=> $record->customer_first_name." ".$record->customer_last_name,
					"ticket_type"			=> $ticket_type,
					"qty"					=> $record->quantity,
					"category"				=> $seat_category,
					"total"					=> $total,
					"purchase_date"			=> date('d F Y',strtotime($record->payment_date))."<br/>".date('H:i',strtotime($record->payment_date)),
					"seller"				=> $record->seller_first_name."<br/>".$record->seller_last_name,
					"delivery_date"			=> $delivery_date,
					"shipping_status"		=> $delivery_status,
					"admin_status"			=> $admin_status,
					"approve_or_reject"		=> $approve_or_reject,
					"notes"					=> $seller_notes,
					"source_type"			=> $record->source_type,
					"customer_country_name"	=> $record->customer_country_name,
					
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

  function sendCurlRequest($url, $post_data) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($handle);
    curl_close($handle);
    return json_decode($output, 1);
}
  function sendCurlMail($order_id) {

		$handle = curl_init();
		$url = API_MAIL_URL . $order_id;
		curl_setopt($handle, CURLOPT_HTTPHEADER, array(
			'domainkey: https://www.1boxoffice.com/en/'
		)
		);
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_POST, 1);
		curl_setopt(
			$handle,
			CURLOPT_POSTFIELDS,
			"email_notify=notify"
		);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($handle);
		curl_close($handle);

}

function updateSellTickets($bg_id) {
    $booking_tickets = $this->General_Model->getAllItemTable_Array('booking_tickets', array('booking_id' => $bg_id))->row();
    $data = array(); // Define your data here
    $this->db->set('sold', "sold + $booking_tickets->quantity", false);
    $this->db->where('s_no', $booking_tickets->ticket_id);
    $this->db->update('sell_tickets', $data);
}

}
