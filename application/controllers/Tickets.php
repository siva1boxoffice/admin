<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
error_reporting(0);
class Tickets extends CI_Controller
{
	public function __construct()
	{
		/*
         *  Developed by: Sivakumar G
         *  Date    : 22 January, 2022
         *  1BoxOffice Hub
         *  https://www.1boxoffice.com/
        */
		parent::__construct();
		$this->load->model('Tickets_Model');
		$this->check_isvalidated();
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

	public function app_data()
	{

		$this->data['app_name'] = $this->app_name;
		$this->data['app_login_image'] = $this->app_login_image;
		$this->data['app_title'] = $this->app_title;
		$this->data['general_path'] = $this->general_path;
		$this->data['app_favicon'] = $this->app_favicon;
		$this->data['login_image'] = $this->login_image;
		$this->data['logo'] = $this->logo;
		$this->data['languages'] = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
		$this->data['branches'] = $this->General_Model->get_admin_details_by_role(4,'ACTIVE');
		if ($this->session->userdata('storefront')->company_name == '') {
				$branches = $this->General_Model->get_admin_details(13);
				$sessionUserInfo = array('storefront' => $branches);
				$this->session->set_userdata($sessionUserInfo);
			/*$sessionUserInfo = array('storefront' => $this->data['branches'][count($this->data['branches']) - 1]);*/
		}
		return $this->data;
	}

	public function cmp($a, $b){ 
    $ad = strtotime($a->updated_at);
    $bd = strtotime($b->updated_at);
    return ($ad-$bd);
}

/**
 * get_items
 *
 * @return void
 */
public function get_items()
{	

	$row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		$search 	=	[];
		$rowno = $_POST['start'];
		//$rowno =$this->uri->segment(3);
		
		if ($rowno != '' && $rowno != 0) {
		$rowno = ($rowno - 1) ;
		}
		else{
			$rowno = 0;			
		}
			$segment = $this->uri->segment(3);				
			if ($segment == "approve_reject") {
				$segment3 = $this->uri->segment(3);
				$segment4 = $this->uri->segment(4);		
				$this->data['status_flag'] = $segment4;
				if($_POST['ticket_status'] == 1){
					$segment4 = "pending";
				}
				else if($_POST['ticket_status'] == 2){
					$segment4 = "approved";
				}
				else if($_POST['ticket_status'] == 3){
					$segment4 = "rejected";
				}
				else if($_POST['ticket_status'] == 4){
					$segment4 = "downloaded";
				}
				else{
					$segment4 = "pending";
				}
			//echo $segment4;exit;
				if($segment4 != ""){

					if (!empty($_POST['booking_no']) || !empty($_POST['start_date']) || !empty($_POST['end_date']) || !empty($_POST['event_name']) || !empty($_POST['seller_name']) || !empty($_POST['seat']) )
					{

						//$rowno=""; $row_per_page="";

						$search['order_id'] 				=		trim($_POST['booking_no']);
						$search['event_start_date'] 		= 		trim($_POST['start_date']);
						$search['event_end_date'] 			= 		trim($_POST['end_date']);
						$search['event_name']				= 		trim($_POST['event_name']);
						$search['seller_name']				= 		$_POST['seller_name'];
						$search['seat']					    = 		$_POST['seat'];

						$approve_request = $this->General_Model->ticket_approve_request_v1($segment4,$search,$rowno, $row_per_page)->result();
						//echo $this->db->last_query();exit;
						$approve_request_count=[];
						$this->data['approve_request'] = $approve_request;
						
					}
					else
					{
							/*$approve_request_etciket = $this->General_Model->ticket_approve_request('pending','',$rowno, $row_per_page)->result();
							$approve_request_pod = $this->General_Model->ticket_approve_request_pod('pending','',$rowno, $row_per_page)->result();

							$approve_request = array_merge($approve_request_etciket, $approve_request_pod);
							
							usort($approve_request, array($this,'cmp'));*/

							$approve_request = $this->General_Model->ticket_approve_request_v1($segment4,'',$rowno, $row_per_page)->result();
							//echo $this->db->last_query();exit;
						$approve_request_count = $this->General_Model->ticket_approve_request_v1($segment4)->result();



							$this->data['approve_request'] = $approve_request;
					}
					
			$data = [];
			foreach($approve_request as $record ){

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
				
				$match_time=" <br> <span class='tr_date'>".date('d/m/Y',strtotime($record->match_date))." "."</span><span class='tr_date'>".date('H:i A',strtotime($record->match_time))."</span>";

				if($record->ticket_type == 1) $ticket_type = "Season cards";
				else if($record->ticket_type == 2) $ticket_type = "E-Tickets";
				else if($record->ticket_type == 3) $ticket_type = "Paper";
				else if($record->ticket_type == 4) $ticket_type = "Mobile";
				else $ticket_type = "";

				$total= "";
				$ticket_file="";
				$qr_links="";
				$pod_data="";
				//echo $record->booking_id;exit;
				$etickets = $this->General_Model->etickets($segment4,$record->booking_id)->result();
				//echo "<pre>";print_r($record);exit;
				//echo $this->db->last_query();exit;

				foreach ($etickets as $eticket) {

					if($eticket->ticket_file!="")
						{
							$ticket_file .='<a class="tooltip_texts" data-toggle="tooltip" data-placement="right" data-html="true" target="_blank" href="'.UPLOAD_PATH.'uploads/e_tickets/'.$eticket->ticket_file.'" data-original-title="E Ticket file for ticket #'. $eticket->serial.'"><i class="mdi mdi-ticket" aria-hidden="true"></i></a><br>';
						}

				}

				foreach ($etickets as $eticket) {

					if($eticket->qr_link != "")
						{
							$qr_links .='<a class="tooltip_texts" data-toggle="tooltip" data-placement="right" data-html="true" target="_blank" href="'.$eticket->qr_link.'" data-original-title="Ticket #'.$eticket->serial.' ANDROID QR"><i class="bx bxl-android" aria-hidden="true"></i></a>&nbsp';
							if($eticket->qr_link_ios != ""){
								$qr_links .='<a class="tooltip_texts" data-toggle="tooltip" data-placement="right" data-html="true" target="_blank" href="'.$eticket->qr_link_ios.'" data-original-title="Ticket #'.$eticket->serial.' IOS QR"><i class="mdi mdi-apple" aria-hidden="true" ></i></a><br>';
							}
							
						}
						
				} //echo "<pre>";print_r($etickets);exit;

				if($record->delivery_provider != "")
				{
					$pod_data .= "Delivery Provider :".$record->delivery_provider;
				}
				if($record->tracking_number != "")
				{
					$pod_data .= "Tracking Number :".$record->tracking_number;
				}

				$pod_tickets = explode(',',$record->pod);
				if(!empty($pod_tickets)){
					$t = 1;

					foreach($pod_tickets as $pod_ticket){
						$pod_file = $pod_ticket;	

						if($record->booking_ticket_source_type == "1boxoffice" && $pod_ticket != ""){

							$pod_file= UPLOAD_PATH.'uploads/pod/'.$pod_ticket;
						}	
						if($pod_file!= "" && $pod_ticket != "")
						{
						$pod_data .='<a class="tooltip_texts" data-toggle="tooltip" data-placement="right" data-html="true" target="_blank" href="javascript:void(0);" onclick="return popitup(\''.$pod_file.'\')" data-original-title="Proof Of Document '.$t.'"><i class="mdi mdi-file-document" aria-hidden="true"></i></a><br>';
						}
					}
				}

				$ticket_display_data = $ticket_file.$qr_links.$pod_data;;
				

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

						$str = $record->seat_category;
						$words = explode(" ", $str); // split the string into an array of words
						$words[1] .= "<br/>"; // add the <br/> tag after the second word
						$seat_category = implode(" ", $words); // join the array of words back into a string
						//echo $newStr;

						//$booking_no=base_url()."game/orders/details/". md5($record->booking_no);

						$booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';

				if($segment4 == "pending"){
					$approve_or_reject = ' <div class="reject_btn">
														<button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave" onclick="update_ticket_status(\''.md5($record->booking_id).'\',6,'. $record->ticket_type.')">
														<a class="button is-danger" href="javascript:void(0);" >
														Reject
														</a>
														</button>
													</div>
													<div class="approve_btn">
														<button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave" onclick="update_ticket_status(\''.md5($record->booking_id).'\',2,'. $record->ticket_type.')"><a class="button is-success" href="javascript:void(0);" >
														Approve
														</a>
														</button>
													</div>';
				}
				else if($segment4 == "approved"){

					$approve_or_reject = '<div class="approve_btn">
														<button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave"><a class="button is-success" href="javascript:void(0);" >
														Approved
														</a>
														</button>
													</div>';
				}
				else if($segment4 == "rejected"){

					$approve_or_reject = '<div class="reject_btn">
														<button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave">
														<a class="button is-danger" href="javascript:void(0);" >
														Rejected
														</a>
														</button>
													</div>';
				}
				else if($segment4 == "downloaded"){

					$approve_or_reject = '<div class="approve_btn">
														<button type="button" class="btn btn-info waves-effect waves-light" data-effect="wave"><a class="button is-success" href="javascript:void(0);" >
														Downloaded
														</a>
														</button>
													</div>';
				}

				$data[] = array( 					
					"total"				    => '<div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" data-order-id="'.md5($record->booking_id).'" data-org-order-id="'.$record->booking_id.'"><label class="form-check-label">&nbsp;</label></div>',
					"booking_no"			=> $booking_no,
					"seller"			    =>  $record->admin_name." ".$record->admin_last_name,
					"match_name"			=> $match_name.$match_time,
					"seat_category"			=> $seat_category,
					"quantity"				=> $record->quantity,
					"notes"					=> $seller_notes,
					"ticket_type"			=> $ticket_type,
					"ticket_instruction"	=> $ticket_display_data,
					"approve_or_reject"		=> $approve_or_reject,
					"action"			    => '<div class="dropdown">
													<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
														<i class="mdi mdi-dots-vertical fs-sm"></i>
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="'.base_url().'game/orders/details/'.md5($record->booking_no).'">View</a>
														<a href="#" class="dropdown-item download_e_ticket" data-booking-id="'.$record->bg_id.'">Download </a>
														<a href="#" class="dropdown-item">Upload </a>
														<a href="#" class="dropdown-item">Replace </a>
													</div>
												</div>',


					
				); 
			}
			$result = array(
					"draw" => $draw,
						"recordsTotal" => count($approve_request_count),
						"recordsFiltered" => count($approve_request_count),
						"data" => $data
				);

			 echo json_encode($result);
			 exit();
					////////////////////////////////////////////////////////

				}
				
		}	
}

	public function index()
	{


		$segment = $this->uri->segment(3);
		
			if ($segment == "approve_reject") {

		  $segment3 = $this->uri->segment(3);
		  $segment4 = $this->uri->segment(4);
		  
		  $this->data['status_flag'] = $segment4;
		  if($segment4 == "pending"){


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

		 $this->data['ticket_status'] = '<div class="custom-control radio radio-primary ">
				<input type="radio" name="ticket_status" class="custom-control-input" id="tstatusCheck1" value="1">
				<label class="custom-control-label" for="tstatusCheck1">Pending Approval</label>
			  </div>
			  <div class="custom-control radio radio-primary ">
				<input type="radio" name="ticket_status" class="custom-control-input" id="tstatusCheck2" value="2">
				<label class="custom-control-label" for="tstatusCheck2">Approved Tickets</label>
			  </div>
			  <div class="custom-control radio radio-primary ">
				<input type="radio" name="ticket_status" class="custom-control-input" id="tstatusCheck3" value="3">
				<label class="custom-control-label" for="tstatusCheck3">Rejected Tickets</label>
			  </div>
			  <div class="custom-control radio radio-primary ">
				<input type="radio" name="ticket_status" class="custom-control-input" id="tstatusCheck4" value="4">
				<label class="custom-control-label" for="tstatusCheck4">Downloaded Tickets</label>
			  </div>';

		  	$approve_request_etciket = $this->General_Model->ticket_approve_request('pending')->result();
		  	$approve_request_pod = $this->General_Model->ticket_approve_request_pod('pending')->result();//echo "<pre>";print_r($approve_request_etciket);exit;
		  	$approve_request = array_merge($approve_request_etciket, $approve_request_pod);
		  	usort($approve_request, array($this,'cmp'));

			$records = $this->General_Model->get_seller_name()->result();
			foreach($records as $record ){

				$seller_name = $record->seller_first_name." ".$record->seller_last_name;

				$html .=   ' <div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
				<label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
			</div>';

			}
  
		   $this->mydatas['html'] = $html;

		  	$this->data['approve_request'] = $approve_request;

		  }
		  else if($segment4 == "approved"){ 
		  	$approve_request_etciket = $this->General_Model->ticket_approve_request('approved')->result();
		  	$approve_request_pod = $this->General_Model->ticket_approve_request_pod('approved')->result();
		  	//echo "<pre>";print_r($approve_request_pod);exit;
		  	$approve_request = array_merge($approve_request_etciket, $approve_request_pod);
		  	usort($approve_request, array($this,'cmp'));
		  		//echo "<pre>";print_r($approve_request);exit;
		  	$this->data['approve_request'] = $approve_request;
		   }
		   else if($segment4 == "rejected"){ //echo $segment3.'==='.$segment4;exit;
		  	$approve_request_etciket = $this->General_Model->ticket_approve_request('rejected')->result();
		  	$approve_request_pod = $this->General_Model->ticket_approve_request_pod('rejected')->result();//echo "<pre>";print_r($approve_request_pod);exit;
		  	$approve_request = array_merge($approve_request_etciket, $approve_request_pod);
		  	usort($approve_request, array($this,'cmp'));
		  	$this->data['approve_request'] = $approve_request;
		   }
		   else if($segment4 == "downloaded"){
		  	$approve_request_etciket = $this->General_Model->ticket_approve_request('downloaded')->result();
		  	$approve_request_pod = $this->General_Model->ticket_approve_request_pod('downloaded')->result();
		  	$approve_request = array_merge($approve_request_etciket, $approve_request_pod);
		  	usort($approve_request, array($this,'cmp'));
		  	$this->data['approve_request'] = $approve_request;
		   }
		  /*if($segment4 == "approve_reject"){
		  	$this->data['approve_request'] = $this->General_Model->ticket_approve_request('approve_reject')->result();
		  }
		  else{
		  	$this->data['approve_request'] = $this->General_Model->ticket_approve_request('pending')->result();
		  }*/
		  
		  //echo "<pre>";print_r($this->data['approve_request']);exit;
		//  $this->load->view('tickets/approve_orders', $this->data);
		  $this->load->view(THEME.'/tickets/approve_orders', $this->data);
			}

		else if ($segment == "create_oe_ticket") {
			$categories = $this->General_Model->get_ticket_type_category()->result();
			$this->data['ticket_deliveries'] = $categories;

			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			//echo "<pre>";print_r($this->data['ticket_types']);die;
			$this->data['ticket_max'] = 10;
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			//$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$this->data['matches'] = $this->Tickets_Model->getOtherEvents()->result();

			$this->data['restriction_left'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',1,1)->result();//echo "<pre>";print_r($this->data['restriction_left']);exit;
			$this->data['restriction_right'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',1,2)->result();
			$this->data['notes_left'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',2,1)->result();
			$this->data['notes_right'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',2,2)->result();
			$this->data['split_details_left'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',3,1)->result();//echo "<pre>";print_r($this->data['restriction_left']);exit;
			$this->data['split_details_right'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',3,2)->result();

			// echo '<pre/>';
			// print_r($this->data);
			// exit;
			$this->data['event_flag'] = "OE";
			$this->load->view(THEME.'tickets/create_ticket', $this->data);
		}
		else if ($segment == "create_ticket") {

			$categories = $this->General_Model->get_ticket_type_category()->result();
			$this->data['ticket_deliveries'] = $categories;

			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			//echo "<pre>";print_r($this->data['ticket_types']);die;
			$this->data['ticket_max'] = 10;
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			//$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$this->data['matches'] = $this->Tickets_Model->getallMatch();


			$this->data['restriction_left'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',1,1)->result();//echo "<pre>";print_r($this->data['restriction_left']);exit;
			$this->data['restriction_right'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',1,2)->result();
			$this->data['notes_left'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',2,1)->result();
			$this->data['notes_right'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',2,2)->result();
			$this->data['split_details_left'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',3,1)->result();//echo "<pre>";print_r($this->data['restriction_left']);exit;
			$this->data['split_details_right'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',3,2)->result();

			// echo '<pre/>';
			// print_r($this->data);
			// exit;
			$this->load->view(THEME.'tickets/create_ticket', $this->data);
		} 
		else if ($segment == "get_ticket") {
			$ticket_id = $_POST['ticket_id'];
			$ticket_data = $this->Tickets_Model->getListing_v4($ticket_id);
			//print_r($ticket_data);die;
			$team1 = $this->General_Model->getAllItemTable_array('teams_lang', array('team_id' => $ticket_data->team_1,"language" => $this->session->userdata('language_code')))->row();
			$team2 = $this->General_Model->getAllItemTable_array('teams_lang', array('team_id' => $ticket_data->team_2,"language" => $this->session->userdata('language_code')))->row();
			$ticket_data->team1_name = @$team1->team_name;
			$ticket_data->team2_name = @$team2->team_name;

			$condition['stadium_id'] = $ticket_data->venue;
			$condition['category'] = $ticket_data->ticket_category;
			$this->data['blocks_data'] = $this->General_Model->getAllItemTable('stadium_details', $condition)->result();

			$tkt_category = $this->Tickets_Model->tkt_category($ticket_data->venue);
			foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
			$this->data['tkt_categories'] = $category_data;		
			$this->data['list_ticket'] = $ticket_data;
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			/*$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();*/
			$this->data['restrictions'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',1)->result();
			$this->data['notes'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',2)->result();
			$this->data['split_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',3)->result();
			if($_POST['type'] == 'clone'){
				$html = $this->load->view(THEME.'/tickets/ticket_clone_ajax', $this->data, TRUE);
			}
			else if($_POST['type'] == 'edit'){
				$html = $this->load->view(THEME.'/tickets/ticket_edit_ajax', $this->data, TRUE);
			}
			else{
				$html = "Invaid Request data.";
			}
			
			$response = array('status' => '1', 'html' => $html);
			echo json_encode($response);
			exit;
		 	echo "<pre>";print_r($_POST);exit;
		}
		else if ($segment == "get_ticket_details_ajax") {
			$ticket_id = $_POST['ticket_id'];
			$ticket_data = $this->Tickets_Model->getListing_v4($ticket_id);

			$team1 = $this->General_Model->getAllItemTable_array('teams_lang', array('team_id' => $ticket_data->team_1,"language" => $this->session->userdata('language_code')))->row();
			$team2 = $this->General_Model->getAllItemTable_array('teams_lang', array('team_id' => $ticket_data->team_2,"language" => $this->session->userdata('language_code')))->row();
			$ticket_data->team1_name = $team1->team_name;
			$ticket_data->team2_name = $team2->team_name;

			$condition['stadium_id'] = $ticket_data->venue;
			$condition['category'] = $ticket_data->ticket_category;
			$this->data['blocks_data'] = $this->General_Model->getAllItemTable('stadium_details', $condition)->result();

			$tkt_category = $this->Tickets_Model->tkt_category($ticket_data->venue);
			foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
			$this->data['tkt_categories'] = $category_data;		
			$this->data['list_ticket'] = $ticket_data;
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			/*$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();*/
			$this->data['restrictions'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',1)->result();
			$this->data['notes'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',2)->result();
			$this->data['split_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE',3)->result();
			if($_POST['type'] == 'clone'){
				$html = $this->load->view(THEME.'/tickets/ticket_clone_details_ajax', $this->data, TRUE);
			}
			else if($_POST['type'] == 'edit'){
				$html = $this->load->view(THEME.'/tickets/ticket_edit_ajax', $this->data, TRUE);
			}
			else{
				$html = "Invaid Request data.";
			}
			
			$response = array('status' => '1', 'html' => $html);
			echo json_encode($response);
			exit;
		 	echo "<pre>";print_r($_POST);exit;
		}
		else if ($segment == "ticket_request") {

			//$this->data['tickets'] = $this->Tickets_Model->ticket_request()->result();
			$type = $this->uri->segment(4);
			$row_count = $this->uri->segment(5);
			//$this->loadRecord($row_count, 'request_tickets', 'tickets/index/ticket_request/'.$type, 'request_tickets.id', 'DESC', 'tickets/ticket_request','tickets', 'categories', $type);

			$this->load->view(THEME.'tickets/ticket_request', $this->data);
		} 
		else if ($segment == "contact_enquiry") {

			//$this->data['tickets'] = $this->Tickets_Model->ticket_request()->result();

			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'contact_enquiries', 'tickets/index/contact_enquiry', 'contact_details.id', 'DESC', 'tickets/contact_enquiry','contacts','','');

			$this->load->view(THEME.'tickets/contact_enquiry', $this->data);
		} 
		else if ($segment == "partnership_enquiry") {

			//$this->data['tickets'] = $this->Tickets_Model->ticket_request()->result();

			$row_count = $this->uri->segment(4);
			//	$this->loadRecord($row_count, 'partner_enquiry', 'tickets/index/partnership_enquiry', 'partner_enquiry.id', 'DESC', 'tickets/partnership_enquiry','partners', '', '');

			$this->load->view(THEME.'tickets/partnership_enquiry', $this->data);
		} 
		else if ($segment == "ticket_details") {
			$segment4 = $this->uri->segment(4);
			$this->data['tickets'] = $this->Tickets_Model->ticket_request($segment4)->row();
			//echo "<pre>";print_r($this->data['tickets']);exit;
			$this->load->view('tickets/ticket_details', $this->data);
		} 
		else if ($segment == "update_enquiry_status") {

				$update_data = array(
					'status' => $_POST['status']
				);
				if($_POST['flag'] == 'partner'){
					$table = 'partner_enquiry';
					$column='id';
					$columnid=$_POST['id'];
				}
				else if($_POST['flag'] == 'ticket'){
					$table = 'request_tickets';
					$column='id';
					$columnid=$_POST['id'];
				}
				else if($_POST['flag'] == 'contact'){
					$table = 'contact_details';
					$column='id';
					$columnid=$_POST['id'];
				}
				$update = $this->General_Model->update_table($table, $column, $columnid, $update_data);

				if ($update == true) {
					$response = array('status' => 1, 'msg' => 'Enquiry updated Successfully.');
					echo json_encode($response);
					exit;
				} else {
					$response = array('status' => 0, 'msg' => 'Error while updating Enquiry Status.');
					echo json_encode($response);
					exit;
				}
		}
		else if ($segment == "listing_details") {

			$match_id = $this->uri->segment(4);
			
			$this->data['match_id'] = $match_id;

			$this->load->view(THEME.'tickets/list_tickets_details', $this->data);			
		}
		else if ($segment == "oe_listing_details") {

			$match_id = $this->uri->segment(4);
			
			$this->data['match_id'] = $match_id;

			$this->load->view('tickets/oe_list_tickets_details', $this->data);
		}
		else if ($segment == "listing") {
			$_SESSION['match_id']	= '';
			$_SESSION['event'] =  '';
			$_SESSION['ticket_category'] = '';
			$_SESSION['stadium'] =  '';
			$_SESSION['event_start_date']	= '';
			$_SESSION['event_end_date'] = '';
			$_SESSION['ignore_end_date'] = '';
			$this->data['sellers'] = $this->General_Model->get_sellers();
			//echo "<pre>";print_r($this->data['sellers']);exit;
			$records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name." ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

         $this->data['html'] = $html;
			$this->load->view(THEME.'tickets/list_tickets', $this->data);
		} 
		else if ($segment == "oe_listing") {
			$_SESSION['match_id']	= '';
			$_SESSION['event'] =  '';
			$_SESSION['ticket_category'] = '';
			$_SESSION['stadium'] =  '';
			$_SESSION['event_start_date']	= '';
			$_SESSION['event_end_date'] = '';
			$_SESSION['ignore_end_date'] = '';
			$this->data['sellers'] = $this->General_Model->get_sellers();
			//echo "<pre>";print_r($this->data['sellers']);exit;
			$records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name." ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

         $this->data['html'] = $html;
			$this->load->view(THEME.'tickets/oe_list_tickets', $this->data);
		}
		else if ($segment == "upload_management") {
			$this->load->view('tickets/upload_management', $this->data);
		} else if ($segment == "save_ticket_details") {




			if ($_POST['s_no'] != '') {

				$ticketid = $_POST['s_no'];
				$ticket_data = $this->Tickets_Model->get_sell_tickets($ticketid);
				$match_id    = $ticket_data->match_id;
				//echo "<pre>";print_r($ticket_data);exit;
				$update_data = array(
					'ticket_updated_date' => date('Y-m-d H:i:s'),
					'listing_note' => implode(',', $_POST['ticket_details'])
				);
				$update = $this->General_Model->update_table('sell_tickets', 's_no', $_POST['s_no'], $update_data);

				if ($update == true) {
					$response = array('status' => 1,'match_id' => $match_id, 'msg' => 'Seller Notes updated Successfully.');
					echo json_encode($response);
					exit;
				} else {
					$response = array('status' => 1, 'msg' => 'Error while updating Seller Notes.');
					echo json_encode($response);
					exit;
				}
			}
		}
		else if ($segment == "load_oe_tickets") {

			if ($this->uri->segment(4)) {
				$rowno = ($this->uri->segment(4));
			} else {
				$rowno = 0;
			}
			$rowperpage = 1000;

			// Row position
			if ($rowno != 0) {
				$rowno = ($rowno - 1) * $rowperpage;
			}

			$match_id = $_POST['match_id'];
			$seller_id = $_POST['seller_id'];
			$last_ticket_id = $_POST['last_ticket_id'];
			
			//echo "<pre>";print_r($_POST);exit;
			if($seller_id != '' && $seller_id != 'all'){
			$this->session->set_userdata('seller_id', $seller_id);
			}
			else if($seller_id == 'all'){
				$this->session->unset_userdata('seller_id');
			}
			else{
				//$this->session->unset_userdata('seller_id');
			}
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$allcount = $this->Tickets_Model->oe_getListing_count("", "", "", "upcoming");
			$listings = $this->Tickets_Model->oe_getListing("", "", "", "upcoming", "", "", $rowno, $rowperpage);
			//echo "<pre>";print_r($listings);exit;
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
			$this->data['search_type'] = "listing";
			$this->data['listings'] = $listings;
			$this->data['match_id'] = $match_id;
			$this->load->library('pagination');
			// Pagination Configuration
			$config['base_url'] = base_url() . 'tickets/index/load_oe_tickets/';
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
			$this->data['seller_id'] = $_POST['seller_id'];
			$this->data['last_ticket_id'] = $_POST['last_ticket_id'];
			
			// Initialize $data Array
			$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="pagination">' . $this->pagination->create_links() . '</div>';

			$list_tickets = $this->load->view('tickets/oe_list_tickets_ajax', $this->data, TRUE);
			if (empty($listings)) {
				$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
			}
			$response = array('search_type' => 'listing', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		
		}
		 else if ($segment == "load_tickets") {

			if ($this->uri->segment(4)) {
				$rowno = ($this->uri->segment(4));
			} else {
				$rowno = 0;
			}
			$rowperpage = 1000;

			// Row position
			if ($rowno != 0) {
				$rowno = ($rowno - 1) * $rowperpage;
			}

			$match_id = $_POST['match_id'];
			$seller_id = $_POST['seller_id'];
			$last_ticket_id = $_POST['last_ticket_id'];
			
			//echo "<pre>";print_r($_POST);exit;
			if($seller_id != '' && $seller_id != 'all'){
			$this->session->set_userdata('seller_id', $seller_id);
			}
			else if($seller_id == 'all'){
				$this->session->unset_userdata('seller_id');
			}
			else{
				//$this->session->unset_userdata('seller_id');
			}
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$allcount = $this->Tickets_Model->getListing_count("", "", "", "upcoming");

			$listings = $this->Tickets_Model->getListing("", "", "", "upcoming", "", "", $rowno, $rowperpage);//echo "<pre>";print_r($listings);exit;
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
			$this->data['search_type'] = "listing";
			$this->data['listings'] = $listings;
			$this->data['match_id'] = $match_id;
			$this->load->library('pagination');
			// Pagination Configuration
			$config['base_url'] = base_url() . 'tickets/index/load_tickets/';
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
			$this->data['seller_id'] = $_POST['seller_id'];
			$this->data['last_ticket_id'] = $_POST['last_ticket_id'];
			
			// Initialize $data Array
			$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="pagination">' . $this->pagination->create_links() . '</div>';

			$list_tickets = $this->load->view('tickets/list_tickets_ajax', $this->data, TRUE);
			if (empty($listings)) {
				$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
			}
			$response = array('search_type' => 'listing', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		}
		 else if ($segment == "load_tickets_details") {

			
			$match_id = $_POST['match_id'];
			if ($match_id != '') {
				$this->data['matches'] = $this->General_Model->get_matches($match_id)->row();
				$this->load->model('Tickets_Model');

				$this->data['match_details'] = $this->Tickets_Model->getListing_details($match_id);
				
				//$this->data['booking_tickets'] = $this->Tickets_Model->getbooking_tickets($match_id)->result();
				
				$listings=$this->data['match_details'] ;
				$getBannedCountries = $this->db->query("SELECT * FROM `banned_countries_match` WHERE `match_id` = " . $match_id)->result();
				$ban_arr = [];
				foreach ($getBannedCountries as $bc) {
					$ban_arr[] = $bc->country_id;
				}
				$this->data['ban_arr'] = $ban_arr;

				///////////////////////
				foreach ($listings as $tkey => $listing) {
					$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
					$category_data = array();
					$block_data = array();
	
					if ($get_std) {
						foreach ($get_std as $std) {
							$block_id = explode("-", $std->block_id);
	
							$block_data[$std->block_id] = end($block_id);
						}
					}
	
					if ($tkt_category) {
	
						foreach ($tkt_category as $key => $std) {
							$category_data[$std->category] = $std->seat_category;
						}
						$listings[$tkey]->block_data = $block_data;
						$listings[$tkey]->tkt_category = $category_data;
						
						//$listings[$tkey]->tickets = $this->Tickets_Model->getbooking_tickets($listing->m_id);
						//$listings[$tkey]->tkt_category = $category_data;
					}
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				} 
				$total_listing = $listings;
				///////////////////////
			}
			$this->data['listings'] = $total_listing[0]->tickets;

			$list_tickets = $this->load->view(THEME.'/tickets/list_ajax', $this->data, TRUE);
			
			/*if (empty($listings)) {
				$list_tickets = $this->load->view(THEME_NAME.'/errors/nofound', $this->data, TRUE);
			}*/
			$response = array('search_type' => 'listing', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		}
		else if ($segment == "oe_load_tickets_details") {

			
			$match_id = $_POST['match_id'];
			$last_ticket_id = $_POST['last_ticket_id'];
			
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();

			$listings = $this->Tickets_Model->oe_getListing_details($match_id);
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
			$this->data['listings'] = $listings;
			$this->data['match_id'] = $match_id;
			$this->data['last_ticket_id'] = $last_ticket_id;
			
			$list_tickets = $this->load->view('tickets/oe_list_ajax', $this->data, TRUE);
			if (empty($listings)) {
				$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
			}
			$response = array('search_type' => 'listing', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		}  else if ($segment == "filter_tickets") {

			if ($this->uri->segment(4)) {
				$rowno = ($this->uri->segment(4));
			} else {
				$rowno = 0;
			}
			$rowperpage = 1000;

			// Row position
			if ($rowno != 0) {
				$rowno = ($rowno - 1) * $rowperpage;
			}

			$match_id 		= $_POST['match_id'];
			$event 					= $_POST['event'];
			$ticket_category 		 = $_POST['ticket_category'];
			$stadium 				 = $_POST['stadium'];
			$event_start_date = $_POST['event_start_date'];
			$event_end_date 		= $_POST['event_end_date'];
			$ignore_end_date 		 = $_POST['ignore_end_date'];
			
			if ($ignore_end_date == 1) {
				$event_end_date = '';
			}
			$this->data['search_type'] = "filter";
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$allcount = $this->Tickets_Model->getListing_count($event, $ticket_category, $stadium, 'upcoming', $event_start_date, $event_end_date);

			$listings = $this->Tickets_Model->getListing($event, $ticket_category, $stadium, 'upcoming', $event_start_date, $event_end_date, $rowno, $rowperpage);
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
			$this->data['listings'] = $listings;
			$this->data['match_id'] = $match_id;
			$this->load->library('pagination');
			// Pagination Configuration
			$config['base_url'] = base_url() . 'tickets/index/filter_tickets/';
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
			$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="paginationfilter">' . $this->pagination->create_links() . '</div>';
			$list_tickets = $this->load->view('tickets/list_tickets_ajax', $this->data, TRUE);
			if (empty($listings)) {
				$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
			}
			$response = array('search_type' => 'filter', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		}else if ($segment == "oe_filter_tickets") {

			if ($this->uri->segment(4)) {
				$rowno = ($this->uri->segment(4));
			} else {
				$rowno = 0;
			}
			$rowperpage = 1000;

			// Row position
			if ($rowno != 0) {
				$rowno = ($rowno - 1) * $rowperpage;
			}

			$match_id 		= $_POST['match_id'];
			$event 					= $_POST['event'];
			$ticket_category 		 = $_POST['ticket_category'];
			$stadium 				 = $_POST['stadium'];
			$event_start_date = $_POST['event_start_date'];
			$event_end_date 		= $_POST['event_end_date'];
			$ignore_end_date 		 = $_POST['ignore_end_date'];
			
			if ($ignore_end_date == 1) {
				$event_end_date = '';
			}
			$this->data['search_type'] = "filter";
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$allcount = $this->Tickets_Model->oe_getListing_count($event, $ticket_category, $stadium, 'upcoming', $event_start_date, $event_end_date);

			$listings = $this->Tickets_Model->oe_getListing($event, $ticket_category, $stadium, 'upcoming', $event_start_date, $event_end_date, $rowno, $rowperpage);
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
			$this->data['listings'] = $listings;
			$this->data['match_id'] = $match_id;
			$this->load->library('pagination');
			// Pagination Configuration
			$config['base_url'] = base_url() . 'tickets/index/oe_filter_tickets/';
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
			$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="paginationfilter">' . $this->pagination->create_links() . '</div>';
			$list_tickets = $this->load->view('tickets/oe_list_tickets_ajax', $this->data, TRUE);
			if (empty($listings)) {
				$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
			}
			$response = array('search_type' => 'filter', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		}  else if ($segment == "filter_search") {
			if ($this->uri->segment(4)) {
				$rowno = ($this->uri->segment(4));
			} else {
				$rowno = 0;
			}
			$rowperpage = 1000;

			// Row position
			if ($rowno != 0) {
				$rowno = ($rowno - 1) * $rowperpage;
			}
			$match_id 			= $_POST['match_id'];
			$filter 			= $_POST['filter'];

			$this->data['search_type'] = "filter";
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$allcount = $this->Tickets_Model->getListing_count('', '', '', $filter, '', '');

			$listings = $this->Tickets_Model->getListing('', '', '', $filter, '', '', $rowno, $rowperpage);
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
			$this->data['listings'] = $listings;
			$this->data['match_id'] = $match_id;
			$this->load->library('pagination');
			// Pagination Configuration
			$config['base_url'] = base_url() . 'tickets/index/filter_search/';
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
			$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="paginationsearch">' . $this->pagination->create_links() . '</div>';
			$list_tickets = $this->load->view('tickets/list_tickets_ajax', $this->data, TRUE);
			if (empty($listings)) {
				$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
			}
			$response = array('search_type' => 'filter', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		}
		 else if ($segment == "oe_filter_search") {
			if ($this->uri->segment(4)) {
				$rowno = ($this->uri->segment(4));
			} else {
				$rowno = 0;
			}
			$rowperpage = 1000;

			// Row position
			if ($rowno != 0) {
				$rowno = ($rowno - 1) * $rowperpage;
			}
			$match_id 			= $_POST['match_id'];
			$filter 			= $_POST['filter'];

			$this->data['search_type'] = "filter";
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();
			$allcount = $this->Tickets_Model->oe_getListing_count('', '', '', $filter, '', '');

			$listings = $this->Tickets_Model->oe_getListing('', '', '', $filter, '', '', $rowno, $rowperpage);
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
			$this->data['listings'] = $listings;
			$this->data['match_id'] = $match_id;
			$this->load->library('pagination');
			// Pagination Configuration
			$config['base_url'] = base_url() . 'tickets/index/oe_filter_search/';
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
			$this->data['pagination'] = '<div class="pagination datatable-pagination pagination-datatables flex-column" id="paginationsearch">' . $this->pagination->create_links() . '</div>';
			$list_tickets = $this->load->view('tickets/oe_list_tickets_ajax', $this->data, TRUE);
			if (empty($listings)) {
				$list_tickets = $this->load->view('errors/nofound', $this->data, TRUE);
			}
			$response = array('search_type' => 'filter', 'tickets' => $list_tickets);
			echo json_encode($response);
			exit;
		} else if ($segment == 'ticket_delete') {

			$segment4 = $this->uri->segment(4);
			$delete_id = $_POST['ticketid'];
			$ticketid = $_POST['ticketid'];
			$ticket_data = $this->Tickets_Model->get_sell_tickets($ticketid);			
			$match_id = $ticket_data->match_id;
			$update_data = array('status' => 2,'ticket_deleted_date' => date('Y-m-d H:i:s'));
			//$delete = $this->General_Model->delete_data('sell_tickets', 's_no', $delete_id);
			$update = $this->General_Model->update_table('sell_tickets', 's_no', $delete_id, $update_data);
			
			if ($update == 1) {
				$response = array('status' => 1,'match_id' => $match_id, 'msg' => 'Ticket Deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Ticket.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'ticket_update_v1') {

			$ticket_status = 1;
			if ($_POST['ticket_status'] == 'false') {
				$ticket_status = 0;
			}
			//$ticket_status = $_POST['ticket_status'];
			$ticket_track = '0';
			if ($_POST['ticket_track'] == 1) {
				$ticket_track = '1';
			} //echo "<pre>";print_r($_POST);exit;
			$update_data = array(
				'ticket_type' => $_POST['ticket_type'],
				'ticket_category' => $_POST['ticket_category'],
				'ticket_block' => $_POST['ticket_block'],
				'home_town' => $_POST['home_down'],
				'row' => $_POST['ticket_row'],
				'quantity' => $_POST['ticket_quantity'],
				//'seat' => $_POST['ticket_seat'],
				'price' => $_POST['ticket_price'],
				//'listing_note' => implode(',', $_POST['ticket_details']),
				'ticket_updated_date' => date('Y-m-d H:i:s'),
				'split' => $_POST['ticket_split'],
				/*'sell_type' => $_POST['sell_type'],
				'track' => $ticket_track,*/
				'status' => $ticket_status
			);
			//echo "<pre>";print_r($update_data);exit;
			$ticketid = $_POST['ticketid'];
			$ticket_data = $this->Tickets_Model->get_sell_tickets($ticketid);
			$match_id = $ticket_data->match_id;
			$update = $this->General_Model->update_table('sell_tickets', 's_no', $_POST['ticketid'], $update_data);
			//echo 'update = '.$update;exit;
			//echo "<pre>";print_r($update_data);exit;
			if ($update == true) {
				$response = array('status' => 1,'match_id' => $match_id, 'msg' => 'Ticket updated Successfully.','redirect_url' => base_url() . 'tickets/index/listing_details/'.$match_id);
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while updating Ticket.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'ticket_update') {

			$ticket_status = 1;
			if ($_POST['ticket_status'] == '') {
				$ticket_status = 0;
			}
			//$ticket_status = $_POST['ticket_status'];
			$ticket_track = '0';
			if ($_POST['ticket_track'] == 1) {
				$ticket_track = '1';
			} 
			$ticket_details = '';
			if ($_POST['ticket_details'] != '') {
				$ticket_details = implode(',', $_POST['ticket_details']);
			}

			

			$update_data = array(
				'ticket_type' => $_POST['ticket_type'],
				'ticket_category' => $_POST['ticket_category'],
				'ticket_block' => $_POST['ticket_block'],
				'home_town' => $_POST['home_down'],
				'row' => $_POST['ticket_row'],
				'quantity' => $_POST['ticket_quantity'],
				'seat' => @$_POST['ticket_seat'],
				'price' => $_POST['ticket_price'],
				'listing_note' => $ticket_details,
				'ticket_updated_date' => date('Y-m-d H:i:s'),
				'split' => $_POST['ticket_split'],
				/*'sell_type' => $_POST['sell_type'],
				'track' => $ticket_track,*/
				'status' => $ticket_status
			);

			$ticketid = $_POST['ticketid'];
			$ticket_data = $this->Tickets_Model->get_sell_tickets($ticketid);
			$match_id = $ticket_data->match_id;
			//echo "<pre>";print_r($update_data);exit;
			$update = $this->General_Model->update_table('sell_tickets', 's_no', $_POST['ticketid'], $update_data);
			//echo "<pre>";print_r($update);exit;
			if ($update == true) {
				$response = array('status' => 1,'match_id' => $match_id, 'msg' => 'Ticket updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while updating Ticket.');
				echo json_encode($response);
				exit;
			}
		} 
		else if ($segment == 'update_ticket_status_v1') { 
			//echo "<pre>";print_r($_POST);exit;
			$ticket_status = 0;
			if ($_POST['ticket_status'] == 'true') {
				$ticket_status = 1;
			}
			//$flag = $_POST['flag'];
			$update_data = array(
				'status' => $ticket_status
				);
			//$update = $this->General_Model->update_table('sell_tickets', 's_no', $_POST['ticket_id'], $update_data);
			//echo $this->db->last_query();exit;
			if ($this->General_Model->update_table('sell_tickets', 's_no', $_POST['ticket_id'], $update_data)){
				$response = array('status' => 1, 'msg' => 'Ticket Status updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 0, 'msg' => 'Error while updating Ticket Status.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($segment == 'ticket_update_status') {

			//$ticket_status = 0;
			// if ($_POST['ticket_status'] == 'true') {
			// 	$ticket_status = 0;
			// }
			// if ($_POST['ticket_status'] == 'false') {
			// 	$ticket_status = 1;
			// }

			$ticket_status = ($_POST['ticket_status'] == true) ? 0 : 1;


			$flag = $_POST['flag'];
			
			$ticket_data = $this->Tickets_Model->get_sell_tickets_by_match($_POST['match_id']);
			//echo "<pre>";print_r($ticket_data);
			//echo $_POST['ticket_status'];
			//1exit;
			foreach($ticket_data as $ticketdata){
				
				if($ticketdata->status != $ticket_status){
				$update_data = array(
				'status' => $ticket_status
				);
				$update = $this->General_Model->update_table('sell_tickets', 's_no', $ticketdata->s_no, $update_data);
				//echo $this->db->last_query();
				}
			}
			
		//	exit;
			
		//echo "<pre>";print_r($update);exit;
			if ($update == true) {
				$response = array('status' => 1,'flag' => $flag,'match_id' => $_POST['match_id'], 'msg' => 'Ticket Status updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 0, 'msg' => 'Error while updating Ticket Status.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($segment == 'event_ticket_update_status') {
			$ticket_status = trim($_POST['ticket_status']) ;			
			$ticket_data = $this->Tickets_Model->get_sell_tickets_by_id($_POST['ticket_id']);	
			if (!empty($ticket_data)) {
				$update_data = array(
					'status' => $ticket_status
				);
			
				$update = $this->General_Model->update_table('sell_tickets', 's_no', $ticket_data[0]->s_no, $update_data);
			}
			if ($update == true) {
				$response = array('status' => 1,'flag' => $flag,'match_id' => $_POST['match_id'], 'msg' => 'Ticket Status updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 0, 'msg' => 'Error while updating Ticket Status.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($segment == 'mass_duplicate') {

			$ticketid = $_POST['ticketid'];
			$match_id = $_POST['match_id'];
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();	
			$listings = $this->Tickets_Model->getListing_details_v1($match_id,$ticketid);
			$mylisting = array();
			//echo "<pre>";print_r($listings);exit;
			foreach ($listings as $tkey => $listing) {
			$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
			$category_data = array();
			$block_data = array();

			if ($get_std) {
			foreach ($get_std as $std) {
			$block_id = explode("-", $std->block_id);

			$block_data[$std->block_id] = end($block_id);
			}
			}

			if ($tkt_category) {

			foreach ($tkt_category as $key => $std) {
			$category_data[$std->category] = $std->seat_category;
			}
			$listings[$tkey]->block_data = $block_data;
			$listings[$tkey]->tkt_category = $category_data;
			$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v3($listing->m_id,$ticketid);
			}
			}
			$this->data['listings'] = $listings;

			$list_tickets = $this->load->view('tickets/bulk_duplicate', $this->data, TRUE);
			$response = array('tickets' => $list_tickets);
			echo json_encode($response);
			exit;

		}
		else if ($segment == 'oe_mass_duplicate') {

			$ticketid = $_POST['ticketid'];
			$match_id = $_POST['match_id'];
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();	
			$listings = $this->Tickets_Model->oe_getListing_details_v1($match_id,$ticketid);
			$mylisting = array();
			//echo "<pre>";print_r($listings);exit;
			foreach ($listings as $tkey => $listing) {
			$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
			$category_data = array();
			$block_data = array();

			if ($get_std) {
			foreach ($get_std as $std) {
			$block_id = explode("-", $std->block_id);

			$block_data[$std->block_id] = end($block_id);
			}
			}

			if ($tkt_category) {

			foreach ($tkt_category as $key => $std) {
			$category_data[$std->category] = $std->seat_category;
			}
			$listings[$tkey]->block_data = $block_data;
			$listings[$tkey]->tkt_category = $category_data;
			$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v3($listing->m_id,$ticketid);
			}
			}
			$this->data['listings'] = $listings;

			$list_tickets = $this->load->view('tickets/bulk_duplicate', $this->data, TRUE);
			$response = array('tickets' => $list_tickets);
			echo json_encode($response);
			exit;

		}
		else if ($segment == 'save_mass_duplicate') {

			
			$s_no 	  = $_POST['s_no'];
			$match_id = $_POST['match_id'];

			$old_ticket = $this->Tickets_Model->getListing_v3($match_id,$s_no);
			//echo "<pre>";print_r($_POST);exit;
			//echo 'event_flag = '.$old_ticket[0]->event_flag;exit;
			if($match_id != "" && $s_no != ""){

				$ticket_data = array();
				for($i = 0;$i < count($_POST['ticket_type']);$i++){
					$ticketid = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
					$ticket_group_id = mt_rand(100000, 999999);

					$ticket_data[] = array(
					'ticketid' => $ticketid,
					'ticket_group_id' => $ticket_group_id,
					'user_id' => $old_ticket[0]->user_id,
					'match_id' => $old_ticket[0]->match_id,
					'ticket_type' => $_POST['ticket_type'][$i],
					'ticket_category' => $_POST['ticket_category'][$i],
					'ticket_block' => $_POST['ticket_block'][$i],
					'home_town' => $_POST['home_town'][$i],//$_POST['home_town'][$i],
					'row' => $_POST['row'][$i],
					'event_flag' => $old_ticket[0]->event_flag,
					'quantity' => $_POST['quantity'][$i],
					'seat' => $old_ticket[0]->seat,
					'sold' => 0,
					'price_type' => $old_ticket[0]->price_type,
					'price' => $_POST['price'][$i],
					'listing_note' => $old_ticket[0]->listing_note,
					'split' => $_POST['split'][$i],
					'sell_date' => date('Y-m-d H:i:s'),
					'auto_disable' => $old_ticket[0]->auto_disable,
					'status' => $old_ticket[0]->status,//$_POST['status'][$i],
					'add_by' => $this->session->userdata('admin_id'),
					'store_id' => $this->session->userdata('storefront')->admin_id
					);
				}
				
				$ticket_data = $this->General_Model->insert_batch_data('sell_tickets',$ticket_data);
				$sellInsert  = $this->db->insert_id();
			}

			if ($sellInsert != "") {
				$response = array('status' => 1, 'msg' => 'Ticket Duplicated Successfully.','seller_id' => $ticket_data->add_by,'match_id' => $match_id,'ticket_last_id' => $sellInsert,'event_flag' => 'E');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 0, 'msg' => 'Error while duplicating Tickets.');
				echo json_encode($response);
				exit;
			}

			
		}
		else if ($segment == 'ticket_duplicate') {


			$ticketid = $_POST['ticketid'];
			$ticket_data = $this->Tickets_Model->get_sell_tickets($ticketid);

			if ($ticket_data->s_no) {
				//echo "<pre>";print_r($ticket_data);exit;
				$ticketid = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
				$insertData['ticketid'] = $ticketid;
				$insertData['user_id'] = $ticket_data->s_no;
				$insertData['match_id'] = $ticket_data->match_id;
				$insertData['ticket_type'] = $ticket_data->ticket_type;
				$insertData['ticket_category'] = $ticket_data->ticket_category;
				$insertData['ticket_block'] = $ticket_data->ticket_block;
				$insertData['home_town'] = $ticket_data->home_town;
				$insertData['row'] = $ticket_data->row;
				$insertData['quantity'] = $ticket_data->quantity;
				$insertData['seat'] = $ticket_data->seat;
				$insertData['sold'] = $ticket_data->sold;
				$insertData['price_type'] = $ticket_data->price_type;
				$insertData['price'] = $ticket_data->price;
				$insertData['listing_note'] = $ticket_data->listing_note;
				$insertData['delivery_courier'] = $ticket_data->delivery_courier;
				$insertData['split'] = $ticket_data->split;
				$insertData['collection'] = $ticket_data->collection;
				$insertData['pickup_address'] = $ticket_data->pickup_address;
				$insertData['ready_to_ship'] = $ticket_data->ready_to_ship;
				$insertData['eticket_file'] = $ticket_data->eticket_file;
				$insertData['status'] = $ticket_data->status;
				$insertData['team_support'] = $ticket_data->team_support;
				$insertData['track'] = $ticket_data->track;
				$insertData['sell_type'] = $ticket_data->sell_type;
				$insertData['event_flag'] = $ticket_data->event_flag;
				$insertData['sell_date'] = date('Y-m-d H:i:s');
				//$insertData['add_by'] = $this->session->userdata('admin_id');
				$insertData['add_by'] = $ticket_data->add_by;
				$insertData['store_id'] = $this->session->userdata('storefront')->admin_id;

				$sellInsert = $this->General_Model->insert_data('sell_tickets', $insertData);
			}

			if ($sellInsert != "") {
				$response = array('status' => 1, 'msg' => 'Ticket Duplicated Successfully.','seller_id' => $ticket_data->add_by,'ticket_last_id' => $sellInsert);
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 0, 'msg' => 'Error while duplicating Ticket.');
				echo json_encode($response);
				exit;
			}
		}
	}


	function get_tktcat_by_stadium_id()
	{

		$block_data = array();
		$block_data = array();
		if ($this->input->post('match_id')) {

			$match_id = $this->input->post('match_id');

			$get_mtch					= $this->Tickets_Model->getallMatch_ById($match_id);
			//echo $get_mtch[0]->venue;exit;
			$this->data['tkt_category'] = $this->Tickets_Model->tkt_category($get_mtch[0]->venue);
			
			if ($this->data['tkt_category']) {

				foreach ($this->data['tkt_category'] as $key => $std) {
					$block_data[$std->category] = $std->seat_category;
				}
			}
		}
		$response = array('block_data' => $block_data, 'match_data' => $get_mtch[0]);
		echo json_encode($response);
		exit;
	}


	function getMatchDetails()
	{
		if ($this->input->post('match_id')) {
			$get_mtch = $this->Tickets_Model->getMatchAdditionalInfo($this->input->post('match_id'));
			$team_1 = $this->General_Model->get_team_data($get_mtch->team_1)->row();
			$team_2 = $this->General_Model->get_team_data($get_mtch->team_2)->row();
			$get_mtch->team1_image = UPLOAD_PATH .'uploads/teams/'. $team_1->team_image;
			$get_mtch->team2_image = UPLOAD_PATH .'uploads/teams/'. $team_2->team_image;
			$get_mtch->stadium_image = UPLOAD_PATH . $get_mtch->stadium_image;

			$get_mtch->team1_name = $team_1->team;
			$get_mtch->team2_name = $team_2->team;
			$get_mtch->event_image = UPLOAD_PATH .'uploads/event_image/'.$get_mtch->event_image;
		}
		echo json_encode($get_mtch);
		exit;
	}

	function getOEMatchDetails()
	{
		if ($this->input->post('match_id')) {
			$get_mtch = $this->Tickets_Model->getMatchAdditionalInfo($this->input->post('match_id'));
			$get_mtch->event_image = UPLOAD_PATH .'uploads/event_image/'.$get_mtch->event_image;
			$get_mtch->stadium_image = $get_mtch->stadium_image;
		}
		echo json_encode($get_mtch);
		exit;
	}

	function get_block_by_stadium_id()
	{

		$block_data = array();
		if ($this->input->post('match_id')) {


			$match_id = $this->input->post('match_id');
			$category_id = $this->input->post('category_id');
			$ticket = $this->input->post('ticket');
			$get_mtch = $this->General_Model->getAllItemTable('match_info', 'm_id', $match_id)->result();

			$condition = array();
			$condition['stadium_id'] = $get_mtch[0]->venue;
			if ($category_id) {

				$get_categ = $this->General_Model->getAllItemTable('stadium_seats', 'id', $category_id)->result();
				$condition['category'] = $get_categ[0]->id;
			}

			$get_std = $this->General_Model->getAllItemTable('stadium_details', $condition)->result();


			if ($get_std) {
				foreach ($get_std as $std) {
					$block_id = explode("-", $std->block_id);
					//$block_data[$block_id[1]] = $std->id;
					$block_data[end($block_id)] = $std->id;

					//$block_data[$std->block_id] = $std->id;
				}
			}
		}
		echo json_encode($block_data);
	}


	function getCurrency_event()
	{

		$match_info = $this->General_Model->getAllItemTable('match_info', 'm_id', $this->input->post('match_id'))->result();
		$get_mtch 	= $this->General_Model->get_currency_types('currency_code', $match_info[0]->price_type)->result();
		echo json_encode($get_mtch);
		exit;
	}


	public function create_ticket()
	{

		if ($this->input->post()) {

			//echo "<pre>";print_r($_POST);exit;

			$data = $this->input->post();

			$this->form_validation->set_rules('add_eventname_addlist[]', 'Event Name', 'required');
			$this->form_validation->set_rules('ticket_types[]', 'Ticket Types', 'required');
			$this->form_validation->set_rules('ticket_category[]', 'Ticket Category', 'required');
			/*$this->form_validation->set_rules('ticket_block', 'Ticket Block', 'required');
			$this->form_validation->set_rules('row', 'Ticket row', 'required');*/
			$this->form_validation->set_rules('add_qty_addlist[]', 'Ticket Quantity', 'required');
			$this->form_validation->set_rules('add_pricetype_addlist[]', 'Ticket Currecny', 'required');
			$this->form_validation->set_rules('add_price_addlist[]', 'Ticket Price', 'required');
			$this->form_validation->set_rules('split_type[]', 'Split Type', 'required');

			if ($this->form_validation->run() !== false) {

				foreach ($data['add_eventname_addlist'] as $key => $event_selected) {
					$listing_note = array();
					if($data['ticket_details']){
						$listing_note[] = implode(',', $data['ticket_details']);
					}
					if($data['ticket_details_others']){
						$listing_note[] = implode(',', $data['ticket_details_others']);
					}

					$ticketid = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);
					$ticket_group_id = mt_rand(100000, 999999);
					
					$match_id = $data['add_eventname_addlist'][$key];
					$insertData = array();
					$insertData['user_id'] = $this->session->userdata('admin_id');
					$insertData['match_id'] = $match_id;
					$insertData['ticket_type'] = $data['ticket_types'][$key];
					$insertData['ticket_category'] = $data['ticket_category'][$key];
					$insertData['ticket_type_category'] = $data['ticket_type_category'][$data['ticket_types'][$key]];
					$insertData['ticket_block'] = $data['ticket_block'];
					$insertData['row'] = $data['row'];
					$insertData['quantity'] =  $data['add_qty_addlist'][$key];
					$insertData['price_type'] = $data['add_pricetype_addlist'][$key];
					$insertData['price'] = $data['add_price_addlist'][$key];
					$insertData['web_price'] = $data['add_web_price_addlist'][$key];
					$insertData['listing_note'] = $listing_note ? implode(",",  $listing_note) : "";
					$insertData['split'] = $data['split_type'][$key];
					$insertData['sell_date'] = date('Y-m-d H:i:s');
					$insertData['pickup_address'] = $data['add_pickup_address_addlist'][$key];
					$insertData['team_support'] = $data['add_team_support'][$key];
					$insertData['home_town'] = $data['home_town'];
					$insertData['ticketid'] = $ticketid;
					$insertData['ticket_group_id'] = $ticket_group_id;
					$insertData['sell_type'] = 'buy';
					$insertData['track'] = '0';
					if($data['event_flag'] == 'OE'){
						$insertData['event_flag'] = 'OE';
					}
					else{
						$insertData['event_flag'] = 'E';
					}
					
					$insertData['ready_to_ship'] = 0;
					$insertData['add_by'] = $this->session->userdata('admin_id');
					$insertData['store_id'] = $this->session->userdata('storefront')->admin_id;
					//echo "<pre>"; print_r($insertData);die;
					$sellInsert = $this->General_Model->insert_data('sell_tickets', $insertData);
				}
				if($data['event_flag'] == 'OE'){
					$redirect_url = base_url() . 'event/other_events/add_event/'.base64_encode(json_encode($match_id)).'?tab=tickets';
				}
				else{
					$redirect_url = base_url() . 'event/matches/add_match/'.base64_encode(json_encode($match_id)).'?tab=tickets';
				}

				$response = array('status' => 1, 'msg' => "New Ticket Created Successfully.", 'redirect_url' => $redirect_url);
			} else {
				$response = array('status' => 0, 'msg' => validation_errors(), 'redirect_url' => base_url() . 'tickets/index/create_ticket');
			}
			echo json_encode($response);
			exit;
		}
	}

	public function loadRecord($rowno = 0, $table, $url, $order_column, $order_by, $view, $variable_name, $type, $search = '')
	{

		// Load Pagination library
		$this->load->library('pagination');

		// Row per page
		$row_per_page = 10;
		// Row position
		if ($table != 'request_tickets') { 
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}
		}
		// All records count
		/*	echo $table;exit;*/
		 //echo $table;exit;
		if ($table == 'request_tickets') { 
			$row_per_page = 20;
		// Row position
		if ($rowno != 0) { 
			$rowno = ($rowno - 1) * $row_per_page;
		} 
		//echo "request_tickets";exit;
			$allcount = $this->Tickets_Model->ticket_request_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->Tickets_Model->ticket_request_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		}
		else if ($table == 'contact_enquiries') { 
			$allcount = $this->Tickets_Model->contact_details('', '', '', '', '', $search)->num_rows();
			$record = $this->Tickets_Model->contact_details($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		}
		else if ($table == 'partner_enquiry') { 
			$allcount = $this->Tickets_Model->partner_enquiry_details('', '', '', '', '', $search)->num_rows();
			$record = $this->Tickets_Model->partner_enquiry_details($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
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
		$this->data['row'] = $rowno;//echo "<pre>";print_r($this->data['pagination']);exit;
		$this->data['search'] = $search;
		// Load view
		$this->load->view($view, $this->data);
	}


	public function update_ticket_data(){

		$ticket_data = $this->Tickets_Model->get_sell_tickets_pending();
		foreach($ticket_data as $ticket){

				$ticketid = mt_rand(1000, 9999) . '_' . mt_rand(100000, 999999);

				$update_data = array(
					'ticketid' => $ticketid
				);
				$update = $this->General_Model->update_table('sell_tickets', 's_no', $ticket->s_no, $update_data);
		} echo "done";exit;
		//echo "<pre>";print_r($ticket_data);exit;
	}

	public function get_expired_tickets(){

		$ticket_data = $this->Tickets_Model->get_expired_tickets()->result();
		//echo "<pre>";print_r($ticket_data);exit;
		foreach($ticket_data as $ticket){
				$update_data = array(
					'status' => 0
				);
				$update = $this->General_Model->update_table('sell_tickets', 's_no', $ticket->s_no, $update_data);
		} echo "Status Updation done";exit;
		//echo "<pre>";print_r($ticket_data);exit;
	}

	public function get_stadium(){

		$stadium_data = $this->General_Model->get_stadium()->result();
		//echo "<pre>";print_r($ticket_data);exit;
		$catgegory = array();
		$catgegory[0] = array('id' => 13,'color' => 'rgba(127,127,127,1)','block' => 1);
		$catgegory[1] = array('id' => 14,'color' => 'rgba(8,59,245,1)','block' => 1);
		$catgegory[2] = array('id' => 15,'color' => 'rgba(72,140,192,1)','block' => 1);
		$catgegory[3] = array('id' => 16,'color' => 'rgba(57,24,250,1)','block' => 1);

		foreach($stadium_data as $stadium){
			foreach($catgegory as $cat){
			//	echo "<pre>";print_r($cat);exit;
			$is_present = $this->General_Model->get_stadium_details($stadium->s_id,$cat['id'])->num_rows();//echo $is_present;exit;
			if($is_present == 0){

				$update_data = array(
					'stadium_id' => $stadium->s_id,
					'category' => $cat['id'],
					'block_color' => $cat['color'],
					'block_id' => $cat['block']
				);//echo "<pre>";print_r($update_data);exit;
				$update = $this->General_Model->insert_data('stadium_details', $update_data);

			}
				
			}
		} echo "Stadium Updation done";exit;
		//echo "<pre>";print_r($ticket_data);exit;
	}


	public function update_auto_disable(){

		$ticket_data = $this->Tickets_Model->getListing_v1($_POST['match_id']);
		if($ticket_data[0]->match_id == $_POST['match_id']){
		
		foreach($ticket_data as $ticket){
				$update_data = array(
					'auto_disable' => $_POST['auto_disable']
				);
				$update = $this->General_Model->update_table_v1('sell_tickets', array('match_id' => $ticket->match_id), $update_data);
		} 

		$response = array('status' => 1, 'msg' => 'Display Hours Updated Successfully.');
					echo json_encode($response);
					exit;
		}
		else{

			$response = array('status' => 0, 'msg' => 'No Tickets available in this match.');
					echo json_encode($response);
					exit;
			
		}

	}

	public function update_auto_listingid(){

		$ticket_data = $this->Tickets_Model->get_empty_tickets()->result();
		
		
		foreach($ticket_data as $ticket){
			$ticket_group_id = mt_rand(100000, 999999);
				$update_data = array(
					'ticket_group_id' => $ticket_group_id
				);
				$update = $this->General_Model->update_table_v1('sell_tickets', array('s_no' => $ticket->s_no), $update_data);
		} 

		$response = array('status' => 1, 'msg' => 'Sell Tickets Updated Successfully.');
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
			$paths = FCPATH . 'uploads/e_tickets/' . $file->ticket_file; // Assuming FCPATH is the correct base path
			//$paths = UPLOAD_PATH . 'uploads/e_tickets/' . $file->ticket_file;
			// add data own data into the folder created
			//$this->zip->add_data($file->ticket_file, $paths);
			if (file_exists($paths)) {
				$this->zip->add_data($file->ticket_file, file_get_contents($paths));
			} else {
				// Handle the case when the file doesn't exist or is not accessible
				echo "File not found: " . $file->ticket_file . "<br>";
			}
		}
		$this->zip->download($createdzipname . '.zip');
	}

	public function get_ticket_request_list()
	{
		
		$row_per_page = 50;
		$search=[];
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( !empty($_POST['event_name']) || !empty($_POST['tournament_ids']) || isset($_POST['statuss']) || !empty($_POST['ticket_statuss']) ) 
		{
			$search['event_name']=$_POST['event_name'];
			if (!empty($_POST['tournament_ids'])) {
			$search['tournament_ids'] = explode(",", $_POST['tournament_ids']);
			}

			if ($_POST['statuss'] === '0' || $_POST['statuss'] === '1') {
				$search['status'] = explode(",", $_POST['statuss']);
			}

			$search['ticket_statuss']=strtolower(trim($_POST['ticket_statuss']));

			$allcount = $this->Tickets_Model->ticket_request_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->Tickets_Model->ticket_request_by_limit($rowno, $row_per_page, 'id', 'desc', '', $search)->result();
			
		}
		else
		{
			$allcount = $this->Tickets_Model->ticket_request_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->Tickets_Model->ticket_request_by_limit($rowno, $row_per_page, 'id', 'desc', '', $search)->result();
		}	
		// echo '<pre/>';
		// print_r($records);
	// exit;

// 	 echo $this->db->last_query();

//  exit;

		foreach($records as $record ){
			//$cname="<p>$record->country_name , $record->city_name</p>";
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

			$request_on="";
			if($record->request_date!="")
			{
				$date =  date("d-F-Y h:i:s",($record->request_date));
				$dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $date)));

				$timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $date)));

				$gmtFormatted = @$_COOKIE["time_zone"];

				$request_on= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;
			}
			$edit_url=base_url()."tickets/index/ticket_details/".$record->request_id;
			$action					=	'<div class="dropdown">
			<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
				<i class="mdi mdi-dots-vertical fs-sm"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="'.$edit_url.'" class="dropdown-item">View</a>
			</div>
		</div>';
		
		$status = '<div class="form-group"><select name="status" id="status" class="custom-select" onchange="update_enquiry_status_new(\'' . $record->request_id . '\', this.value, \'ticket\');">';
		$status .= '<option value="0"' . ((trim($record->request_status) == 0) ? ' selected' : '') . '>Open</option>';
		$status .= '<option value="1"' . ((trim($record->request_status) == 1) ? ' selected' : '') . '>Closed</option>';
		$status .= '</select> </div>';
		$request_id='<a href="'.$edit_url.'" class="dropdown-item">'.$record->request_id.'</a>';

		$parts = explode(" ", $record->full_name);
		$name=$record->full_name;
		$get_user_name = $this->General_Model->get_ticket_requested_user_name($parts[0], $parts[1])->result();
		if (count($get_user_name)>0) {
		
			$name='<a href="'.base_url()."home/users/add_user/1/". base64_encode(json_encode($get_user_name[0]->admin_id)).'">'.$name.'</a>';
		} else {
			$name=$record->full_name;
						
		}
//$match_name.$match_time,
		$encode_id = base64_encode(json_encode($record->m_id));
		
		
			$data[] = array( 
                "request_id"						=> 		$request_id, 
				"event_name"						=> 		'<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.$match_time.'</a>',
				"tournament_name"					=> 		$record->tournament_name, 
				"quantity"							=> 		$record->quantity, 
				"full_name"							=> 		$name, 
				"request_on"						=> 		$request_on, 
				"status"							=> 		$status, 
				"action"							=> 		$action, 
			
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


	public function get_enquiry_list()
	{
		
		$row_per_page = 50;
		$search=[];
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
			$allcount = $this->Tickets_Model->contact_details('', '', '', '', '', $search)->num_rows();
			$records = $this->Tickets_Model->contact_details($rowno, $row_per_page,'id', 'desc', '', $search)->result();
			
		// echo '<pre/>';
		// print_r($records);
	// exit;

	// echo $this->db->last_query();

	// exit;
	$i=1;
		foreach($records as $record ){	
			
			$request_on="";
			if($record->created_at!="")
			{
				//$date =  date("d-F-Y h:i:s",($record->created_at));
				$dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->created_at)));

				$timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->created_at)));

				$gmtFormatted = @$_COOKIE["time_zone"];

				$request_on= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;
			}

			$status = '<div class="form-group"><select name="status" id="status" class="custom-select" onchange="update_enquiry_status_new(\'' . $record->contact_id . '\', this.value, \'contact\');">';
		$status .= '<option value="0"' . ((trim($record->contact_status) == 0) ? ' selected' : '') . '>Open</option>';
		$status .= '<option value="1"' . ((trim($record->contact_status) == 1) ? ' selected' : '') . '>Closed</option>';
		$status .= '</select> </div>';

		$get_user_name = $this->General_Model->get_user_name($record->first_name, $record->last_name)->result();
		
		if (empty($get_user_name)) {
			$name= $record->first_name . " " . $record->last_name;
		} else {	
				
				$name='<a href="'.base_url()."home/users/add_user/1/". base64_encode(json_encode($get_user_name[0]->admin_id)).'">'.$get_user_name[0]->full_name.'</a>';
		}
		

			$data[] = array( 
                "s_no"						=> 		$i, 
				"name"						=> 		$name, 
				"email"						=> 		$record->email, 
				"mobile"					=> 		$record->dialing_code." ".$record->mobile_no, 
				"country_name"				=> 		$record->country_name, 
				"message"					=> 		$record->message, 
				"enq_date"					=> 		$request_on, 
				"action"					=> 		$status, 			
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

	public function get_partner_enquiry_list()
	{
		
		$row_per_page = 50;
		$search=[];
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		$allcount = $this->Tickets_Model->partner_enquiry_details('', '', '', '', '', $search)->num_rows();
		$records = $this->Tickets_Model->partner_enquiry_details($rowno, $row_per_page,'id','desc', '', $search)->result();
			
		// echo '<pre/>';
		// print_r($records);
	// exit;

	// echo $this->db->last_query();

	// exit;
	$i=1;
		foreach($records as $record ){	
			
			$request_on="";
			if($record->created_at!="")
			{
				//$date =  date("d-F-Y h:i:s",($record->created_at));
				$dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->created_at)));

				$timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->created_at)));

				$gmtFormatted = @$_COOKIE["time_zone"];

				$request_on= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;
			}

			$status = '<div class="form-group"><select name="status" id="status" class="form-control" onchange="update_enquiry_status_new(\'' . $record->id . '\', this.value, \'partner\');">';
		$status .= '<option value="0"' . ((trim($record->status) == 0) ? ' selected' : '') . '>Open</option>';
		$status .= '<option value="1"' . ((trim($record->status) == 1) ? ' selected' : '') . '>Closed</option>';
		$status .= '</select> </div>';

			$data[] = array( 
                "s_no"						=> 		$i, 
				"name"						=> 		$record->first_name." ".$record->last_name, 
				"email"						=> 		$record->email, 
				"mobile"					=> 		$record->mobile_no, 
				"organization_name"			=> 		trim($record->organization_name), 
				"enq_date"					=> 		$request_on, 
				"action"					=> 		$status, 			
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

	public function get_ticket_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();

			if ( !empty($_POST['event_start_date']) || !empty($_POST['event_end_date'])  || !empty($_POST['seller_name']) || !empty($_POST['event'])   || !empty($_POST['tournament_name'])  || !empty($_POST['stadium_name'])  || !empty($_POST['seller_name'])  ) 
			{				
				
				$start_date 	  	 	= $_POST['event_start_date'];
				$end_date 				= $_POST['event_end_date'];
				$event_search 			= $_POST['event'];
				$tournament_name 		= $_POST['tournament_name'];
				$stadium_search 		= $_POST['stadium_name'];
				$seller_name 			= $_POST['seller_name'];
				
				$allcount = $this->Tickets_Model->getListing_count($event_search, "", $stadium_search, "upcoming",$start_date,$end_date, "", "", "", "","",$tournament_name,$seller_name);				
				$listings = $this->Tickets_Model->getListing($event_search, "", $stadium_search, "upcoming", $start_date,$end_date, $rowno, $row_per_page,"", "","",$tournament_name,$seller_name);
				// echo $this->db->last_query();
				// exit;

			}
			else
			{
				$allcount = $this->Tickets_Model->getListing_count("", "", "", "upcoming");
				$listings = $this->Tickets_Model->getListing("", "", "", "upcoming", "", "", $rowno, $row_per_page);
			}
			// echo $this->db->last_query();
			// 	exit;

		//	echo "<pre>";print_r($listings);exit;
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
		
		foreach($listings as $list_ticket ){

			$tickets = $list_ticket->tickets;
            //echo "<pre>";print_r($tickets);
            if($tickets){
             $min_price = min(array_column($tickets, 'price'));
             $max_price = max(array_column($tickets, 'price'));
             $total_qty = array_sum(array_column($tickets,'quantity'));
             $total_sold = array_sum(array_column($tickets,'sold'));
          }
             $teams = explode('vs',$list_ticket->match_name);
             if($teams[1] == ''){
               $teams = explode('Vs',$list_ticket->match_name);
             }

            // $final_status = array_sum(array_column($tickets,'status'));

			$final_status = 0; // Initialize the variable to store the sum

			if (is_array($tickets)) {
				$statuses = array_column($tickets, 'status');
				$final_status = array_sum($statuses);
			}

			$mark_as_completed_status = $final_status >=1  ? "checked" : "";

			$mark_as_completed= '
					   <div class="">
					   <div class="content">
					   <div class="custom-control custom-switch">
					   <input type="checkbox" class="custom-control-input all_ticket_status_new" name="order_status"  data-match_id="'.$list_ticket->m_id.'"  id="customSwitch3'.$list_ticket->m_id.'"   '.$mark_as_completed_status.' value="1">
					   <label class="custom-control-label" for="customSwitch3'.$list_ticket->m_id.'"></label>
					   </div>
					   </div>
					   </div>
			';
			
			$event_date=date('D j F Y',strtotime($list_ticket->match_date))."<br/>".date('H:i',strtotime($list_ticket->match_time));

			$encode_id = base64_encode(json_encode($list_ticket->match_id));
			$input = $list_ticket->match_name;
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

			$stadium_url = "game/stadium/get_stadium/".$list_ticket->s_id; 


			if (strtoupper($list_ticket->price_type) == "GBP") {
				$price_type="£";
			}
			if (strtoupper($list_ticket->price_type) == "EUR") { 
				$price_type="€";
			}
			if (strtoupper($list_ticket->price_type) != "GBP" && strtoupper($list_ticket->price_type) != "EUR"){
				$price_type= strtoupper($list_ticket->price_type); 
				}

				$edit_url= base_url()."tickets/index/listing_details/".$list_ticket->match_id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">View</a>												
											</div>
										</div>';

			$data[] = array( 
                "mark_as_completed"				=> $mark_as_completed, 
				"event_date"					=> $event_date,
				"event"							=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.'</a>',
				"tournament_name"				=> '<a href="'.base_url().'settings/tournaments/edit/'.$list_ticket->tournament_id.'" >'.$list_ticket->tournament_name.'</a>',
				"stadium_name"					=> '<a href="'.base_url($stadium_url).'" >'.$list_ticket->stadium_name.'</a>',
				"city_name"						=> $list_ticket->city_name,
				"country_name"					=> $list_ticket->country_name,
				"qty"							=> $total_qty,
				"total_sold"					=> $total_sold,
				"price_range"					=> $price_type." ".$min_price." - ".$max_price,
				"action"						=> $action
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
	//
	// public function get_ticket_details_list()
	// {
	// 	$match_id = $_POST['match_id'];
	// 	$row_per_page = 50;
	// 	$rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
	// 		if ($match_id != '') {
	// 			$this->data['matches'] = $this->General_Model->get_matches($match_id)->row();
	// 			$this->load->model('Tickets_Model');

	// 			$this->data['match_details'] = $this->Tickets_Model->getListing_details($match_id);
				
	// 			//$this->data['booking_tickets'] = $this->Tickets_Model->getbooking_tickets($match_id)->result();
				
	// 			$listings=$this->data['match_details'] ;
	// 			$getBannedCountries = $this->db->query("SELECT * FROM `banned_countries_match` WHERE `match_id` = " . $match_id)->result();
	// 			$ban_arr = [];
	// 			foreach ($getBannedCountries as $bc) {
	// 				$ban_arr[] = $bc->country_id;
	// 			}
	// 			$this->data['ban_arr'] = $ban_arr;

	// 			///////////////////////
	// 			foreach ($listings as $tkey => $listing) {
	// 				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
	// 				$category_data = array();
	// 				$block_data = array();
	
	// 				if ($get_std) {
	// 					foreach ($get_std as $std) {
	// 						$block_id = explode("-", $std->block_id);
	
	// 						$block_data[$std->block_id] = end($block_id);
	// 					}
	// 				}
	
	// 				if ($tkt_category) {
	
	// 					foreach ($tkt_category as $key => $std) {
	// 						$category_data[$std->category] = $std->seat_category;
	// 					}
	// 					$listings[$tkey]->block_data = $block_data;
	// 					$listings[$tkey]->tkt_category = $category_data;
	// 					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
	// 				}
	// 			} 
	// 			$total_listing = $listings;
	// 			//echo "<pre>";print_r($listings);exit;
	// 			///////////////////////
	// 		}
	// 		//this->data['listings'] = $total_listing[0]->tickets;
	// 		$allcount=0;
	// 		$listings=$total_listing[0]->tickets;

	// 		if($listings){
	// 			$allcount=count($total_listing[0]->tickets);
	// 			foreach ($listings as $ticket) { 

	// 				$mark_as_completed_status = $ticket->status >=1  ? "checked" : "";

	// 		$mark_as_completed= '
	// 				   <div class="">
	// 				   <div class="content">
	// 				   <div class="custom-control custom-switch">
	// 				   <input type="checkbox" class="custom-control-input all_ticket_status_new" name="order_status"  data-match_id="'.$ticket->ticketid.'"  id="customSwitch3'.$ticket->ticketid.'"   '.$mark_as_completed_status.' value="1">
	// 				   <label class="custom-control-label" for="customSwitch3'.$ticket->ticketid.'"></label>
	// 				   </div>
	// 				   </div>
	// 				   </div>
	// 		';
	// 			if($ticket->ticket_block_name){
	// 			  $ticket_block = end(explode("-", $ticket->ticket_block_name) );				
	// 		   }

	// 		   $data[] = array( 
	// 			"mark_as_completed"				=> 	$mark_as_completed, 
	// 			"seller_name"					=>	$ticket->admin_name." ".$ticket->admin_last_name,
	// 			"ticketid"						=>	$ticket->ticketid,
	// 			"ticket_types_name"				=> 	$ticket->ticket_types_name,
	// 			"quantity"						=>	$ticket->quantity,
	// 			"sold"							=> 	$ticket->sold,
	// 			"stadium_seat_category"			=>	$ticket->stadium_seat_category,
	// 			"ticket_block"					=>  $ticket_block,
	// 			"row"							=> 	$ticket->row,
	// 			"split_name"					=> 	$ticket->split_name,
	// 			"notes"							=> 	"",
	// 			"price_type"					=> 	$ticket->price_type." ".$ticket->price,
	// 		);

	// 			}				
	// 		}

	// 		$result = array(
	// 			"draw" => $draw,
	// 			  "recordsTotal" => $allcount,
	// 			  "recordsFiltered" => $allcount,
	// 			  "data" => $data
	// 		 );
	
	// 		echo json_encode($result);
	// 		exit();
			

	// }

	public function get_ajax_ticket_details ()
	{
		//$_POST['match_id']='2121';
		$match_id = $_POST['match_id'];
		
			if ($match_id != '') {
				$this->data['matches'] = $this->General_Model->get_matches($match_id)->row();
				
				$this->load->model('Tickets_Model');

				$this->data['match_details'] = $this->Tickets_Model->getListing_details($match_id);
				
				
				//$this->data['booking_tickets'] = $this->Tickets_Model->getbooking_tickets($match_id)->result();
				
				$listings=$this->data['match_details'] ;
				$getBannedCountries = $this->db->query("SELECT * FROM `banned_countries_match` WHERE `match_id` = " . $match_id)->result();
				$ban_arr = [];
				foreach ($getBannedCountries as $bc) {
					$ban_arr[] = $bc->country_id;
				}
				$this->data['ban_arr'] = $ban_arr;

		

				///////////////////////
				foreach ($listings as $tkey => $listing) {
					$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				
					$category_data = array();
					$block_data = array();
	
					if ($get_std) {
						foreach ($get_std as $std) {
							$block_id = explode("-", $std->block_id);
	
							$block_data[$std->block_id] = end($block_id);
						}
					}
	
					if ($tkt_category) {	
						foreach ($tkt_category as $key => $std) {
							$category_data[$std->category] = $std->seat_category;
						}
						$listings[$tkey]->block_data = $block_data;
						$listings[$tkey]->tkt_category = $category_data;
						$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
					
						
						//$listings[$tkey]->tickets = $this->Tickets_Model->getbooking_tickets($listing->m_id);
						//$listings[$tkey]->tkt_category = $category_data;
					}
				} 
				
				$total_listing = $listings;
				
			}
		$this->data['listings'] = $listings;
		$this->data['tickets']	= $total_listing[0]->tickets;
		$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();		
		$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
		$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();	
		echo  $list_tickets = $this->load->view(THEME.'/tickets/list_detail_ajax', $this->data, TRUE);
	}


	public function get_oe_ticket_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();
			$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data('', 'ACTIVE')->result();

			if ( !empty($_POST['event_start_date']) || !empty($_POST['event_end_date'])  || !empty($_POST['seller_name']) || !empty($_POST['event'])   || !empty($_POST['tournament_name'])  || !empty($_POST['stadium_name'])  || !empty($_POST['seller_name'])  ) 
			{				
				
				$start_date 	  	 	= $_POST['event_start_date'];
				$end_date 				= $_POST['event_end_date'];
				$event_search 			= $_POST['event'];
				$tournament_name 		= $_POST['tournament_name'];
				$stadium_search 		= $_POST['stadium_name'];
				$seller_name 			= $_POST['seller_name'];
				
				$allcount = $this->Tickets_Model->oe_getListing_count($event_search, "", $stadium_search, "upcoming",$start_date,$end_date, "", "", "", "","",$tournament_name,$seller_name);				
				$listings = $this->Tickets_Model->oe_getListing($event_search, "", $stadium_search, "upcoming", $start_date,$end_date, $rowno, $row_per_page,"", "","",$tournament_name,$seller_name);
				// echo $this->db->last_query();
				// exit;
				

			}
			else
			{
				$allcount = $this->Tickets_Model->oe_getListing_count("", "", "", "upcoming");
				$listings = $this->Tickets_Model->oe_getListing("", "", "", "upcoming", "", "", $rowno, $row_per_page);				
			}
			//   echo $this->db->last_query();
			//  	 exit;

		//	echo "<pre>";print_r($listings);exit;
			$mylisting = array();
			foreach ($listings as $tkey => $listing) {
				$tkt_category = $this->Tickets_Model->tkt_category($listing->venue);
				$category_data = array();
				$block_data = array();

				if ($get_std) {
					foreach ($get_std as $std) {
						$block_id = explode("-", $std->block_id);

						$block_data[$std->block_id] = end($block_id);
					}
				}

				if ($tkt_category) {

					foreach ($tkt_category as $key => $std) {
						$category_data[$std->category] = $std->seat_category;
					}
					$listings[$tkey]->block_data = $block_data;
					$listings[$tkey]->tkt_category = $category_data;
					$listings[$tkey]->tickets = $this->Tickets_Model->getListing_v1($listing->m_id);
				}
			}
		
		foreach($listings as $list_ticket ){

			$tickets = $list_ticket->tickets;
            //echo "<pre>";print_r($tickets);
            if($tickets){
             $min_price = min(array_column($tickets, 'price'));
             $max_price = max(array_column($tickets, 'price'));
             $total_qty = array_sum(array_column($tickets,'quantity'));
             $total_sold = array_sum(array_column($tickets,'sold'));
          }
             $teams = explode('vs',$list_ticket->match_name);
             if($teams[1] == ''){
               $teams = explode('Vs',$list_ticket->match_name);
             }

            // $final_status = array_sum(array_column($tickets,'status'));

			$final_status = 0; // Initialize the variable to store the sum

			if (is_array($tickets)) {
				$statuses = array_column($tickets, 'status');
				$final_status = array_sum($statuses);
			}

			$mark_as_completed_status = $final_status >=1  ? "checked" : "";

			$mark_as_completed= '
					   <div class="">
					   <div class="content">
					   <div class="custom-control custom-switch">
					   <input type="checkbox" class="custom-control-input all_ticket_status_new" name="order_status"  data-match_id="'.$list_ticket->m_id.'"  id="customSwitch3'.$list_ticket->m_id.'"   '.$mark_as_completed_status.' value="1">
					   <label class="custom-control-label" for="customSwitch3'.$list_ticket->m_id.'"></label>
					   </div>
					   </div>
					   </div>
			';
			
			$event_date=date('D j F Y',strtotime($list_ticket->match_date))."<br/>".date('H:i',strtotime($list_ticket->match_time));

			$encode_id = base64_encode(json_encode($list_ticket->match_id));
			$input = $list_ticket->match_name;
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

			$stadium_url = "game/stadium/get_stadium/".$list_ticket->s_id; 


			if (strtoupper($list_ticket->price_type) == "GBP") {
				$price_type="£";
			}
			if (strtoupper($list_ticket->price_type) == "EUR") { 
				$price_type="€";
			}
			if (strtoupper($list_ticket->price_type) != "GBP" && strtoupper($list_ticket->price_type) != "EUR"){
				$price_type= strtoupper($list_ticket->price_type); 
				}

				$edit_url= base_url()."tickets/index/listing_oe_details/".$list_ticket->match_id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">View</a>												
											</div>
										</div>';

			$data[] = array( 
                "mark_as_completed"				=> $mark_as_completed, 
				"event_date"					=> $event_date,
				"event"							=> '<a href="'.base_url().'event/other_events/add_event/'.$encode_id.'" >'.$match_name.'</a>',
				"tournament_name"				=> '<a href="'.base_url().'settings/tournaments/edit/'.$list_ticket->tournament_id.'" >'.$list_ticket->tournament_name.'</a>',
				"stadium_name"					=> '<a href="'.base_url($stadium_url).'" >'.$list_ticket->stadium_name.'</a>',
				"city_name"						=> $list_ticket->city_name,
				"country_name"					=> $list_ticket->country_name,
				"qty"							=> $total_qty,
				"total_sold"					=> $total_sold,
				"price_range"					=> $price_type." ".$min_price." - ".$max_price,
				"action"						=> $action
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
	public function report_issue( )
	{	
		$records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name." ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

         $this->data['html'] = $html;

		$this->load->view(THEME.'/tickets/report_issue', $this->data);
	}

	public function get_report_issue()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

		if( !empty($_POST['event']) || !empty($_POST['seller_name']) )
		{				
			$search['event_name'] = !empty($_POST['event']) ? $_POST['event'] : '';
			$search['seller_name'] = !empty($_POST['seller_name']) ? $_POST['seller_name'] : '';
			$allcount = $this->General_Model->get_report_issue($search,$row_per_page,$rowno,'ri.id','DESC')->num_rows();
			$records = $this->General_Model->get_report_issue($search,$row_per_page,$rowno,'ri.id','DESC')->result();
		}
		else
		{
			$allcount = $this->General_Model->get_report_issue($search,$row_per_page,$rowno,'ri.id','DESC')->num_rows();
			$records = $this->General_Model->get_report_issue($search,$row_per_page,$rowno,'ri.id','DESC')->result();
		}

		foreach($records as $record ){	
			$seller_name='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->admin_name." ".$record->admin_last_name.'</a>';	

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

			$encode_id = base64_encode(json_encode($record->event_id));

			$event_name='<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.'</a>';
			$event_date=date('d F Y',strtotime($record->match_date))."<br/> <center>".date('H:i',strtotime($record->match_date)).'</center>';
			//$report_date=date('d F Y',strtotime($record->date_time_creation))."<br/> <center>".date('H:i',strtotime($record->date_time_creation)).'</center>';;		
			$input = $record->date_time_creation;
			$report_date ="<center>---</center>";
			$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $input);	
			if($record->date_time_creation!='0000-00-00 00:00:00')
			{
				$report_date = $dateTime ? date('d F Y', strtotime($input)) . "<br/><center>" . date('H:i', strtotime($input)) . '</center>' : "";
			}				

			$data[] = array( 
                "seller_name"					=> $seller_name	,
				"match_name"					=> $event_name,
				"match_date"					=> $event_date,
				"report_text"					=> $record->report_text,
				"report_date"					=> $report_date	
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
