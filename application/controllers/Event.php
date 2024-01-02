<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
//error_reporting(0);
class Event extends CI_Controller
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

	public function event_reports(){

		$where_array = array();
		if($_GET['eventStartDate'] != "" && $_GET['eventEndDate'] != ""){
			$where_array['event_start_date']  = $_GET['eventStartDate'];
			$where_array['event_end_date']  = $_GET['eventEndDate'];

			$fileName = "Event_summary_" .$_GET['eventStartDate'] . "_To_".$_GET['eventEndDate'].".xls"; 
		}
		else{
			 $fileName = "Event_summary_" . date('Y-m-d') . ".xls"; 
		}
		if($_GET['event_name'] != ""){
			$where_array['event_name'] = $_GET['event_name'];
		}
		if($_GET['stadium_ids'] != ""){
			$where_array['stadium_ids'] =  explode(",",$_GET['stadium_ids']);
		}
		if($_GET['tournament_ids'] != ""){
			$where_array['tournament_ids'] =  explode(",",$_GET['tournament_ids']);
		}

		if($_GET['statuss'] != ""){
			$where_array['status'] =  explode(",",$_GET['status']);
		}
		
		$all_records = $this->General_Model->get_matches('','upcoming','','','','','',$where_array,'')->result();
	
		$fields = array('EventName','Venue','Tournament','EventDate','NumberOfTicketsListed','NumberOfAPITickets','TicketsSold'); 
		
		// Display column names as first row 
		$excelData = implode("\t", array_values($fields)) . "\n"; 
		$total_amount = array();
		foreach($all_records as $download_order){  
		$lineData = array($download_order->match_name,$download_order->stadium_name,$download_order->tournament_name,date("d F Y",strtotime($download_order->match_date)),$download_order->matchticket,$download_order->tournament_name,$download_order->sold); 
		
		$total_amount[] = $download_order->total_base_amount;
		$excelData .= implode("\t", array_values($lineData)) . "\n"; 
		} 
		
		header("Content-Type: application/vnd.ms-excel"); 
		header("Content-Disposition: attachment; filename=\"$fileName\""); 

		// Render excel data 
		echo $excelData; 

		exit;
	}

	public function other_event_reports(){

			$where_array = array();
			if($_GET['eventStartDate'] != "" && $_GET['eventEndDate'] != ""){
				$where_array['event_start_date']  = $_GET['eventStartDate'];
				$where_array['event_end_date']  = $_GET['eventEndDate'];

				$fileName = "Other-Event_summary_" .$_GET['eventStartDate'] . "_To_".$_GET['eventEndDate'].".xls"; 
			}
			else{
				 $fileName = "Event_summary_" . date('Y-m-d') . ".xls"; 
			}
			if($_GET['event_name'] != ""){
				$where_array['event_name'] = $_GET['event_name'];
			}
			if($_GET['stadium_ids'] != ""){
				$where_array['stadium_ids'] =  explode(",",$_GET['stadium_ids']);
			}
			if($_GET['tournament_ids'] != ""){
				$where_array['tournament_ids'] =  explode(",",$_GET['tournament_ids']);
			}

	
				$all_records = $this->General_Model->getOtherEvents('','upcoming','','','','','',$where_array,'')->result();

		
			
		
			$fields = array('EventName','Venue','Tournament','Category','EventDate','NumberOfTicketsListed','TicketsSold'); 
			
			// Display column names as first row 
			$excelData = implode("\t", array_values($fields)) . "\n"; 
			$total_amount = array();
			foreach($all_records as $download_order){  
			$lineData = array(
				$download_order->match_name,
				$download_order->stadium_name,
				$download_order->tournament_name,
				$download_order->category_name,
				date("d F Y",strtotime($download_order->match_date)),
				$download_order->box_quantity,
				$download_order->sold
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

	private function check_isvalidated()
	{	
		if(!$this->session->userdata('admin_logged_in')){
			redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2 && $this->session->userdata('role') != 3) {
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
		} else {
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
		$this->data['languages'] = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
		$this->data['branches'] = $this->General_Model->get_admin_details_by_role(4, 'ACTIVE');
		if ($this->session->userdata('storefront')->company_name == '') {
			$branches = $this->General_Model->get_admin_details(13);
			$sessionUserInfo = array('storefront' => $branches);
			$this->session->set_userdata($sessionUserInfo);
			/*$sessionUserInfo = array('storefront' => $this->data['branches'][count($this->data['branches']) - 1]);*/
		}
		return $this->data;
	}


	public function stadiums()
	{

		echo "stadiums";
		exit;
	}

	public function team_categories()
	{

		echo "team_categories";
		exit;
	}

	public function ticket_categories()
	{

		echo "ticket_categories";
		exit;
	}

	public function match_categories()
	{

		echo "match_categories";
		exit;
	}

	public function tournaments()
	{

		echo 'tournaments';
		exit;
	}

	public function tournament_details()
	{

		echo "tournament_details";
		exit;
	}



	public function tournament_categories()
	{

		echo "tournament_categories";
		exit;
	}

	public function add_tournaments()
	{

		echo "add_tournaments";
		exit;
	}

	
	public function upload_files()
	{
		//echo "<pre>";print_r($_FILES);exit;
		
		if (!empty($_FILES['file']['name'])) {
						$config['upload_path'] = UPLOAD_PATH_PREFIX . 'uploads/temp';
						
						$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
						$config['max_size'] = '10000';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file')) {
							$outputData['file'] = $this->upload->data();
							$uploaded_file = $outputData['file']['file_name'];
						} else {
							$uploaded_file = "";
						}

						$response = array('status' => 1,'uploaded_file' => $uploaded_file);
				echo json_encode($response);exit;
					}
	}
	public function get_team_basic()
	{

		
		if($_POST['team_id'] != ""){

			$teams = $this->General_Model->get_teams($_POST['team_id'])->row();
			if($teams->id != ""){
				$response = array('status' => 1,'data' => $teams);
				echo json_encode($response);exit;
			}
			
		}
		else{
			$response = array('status' => 0,'msg' => 'invalid team id');
			echo json_encode($response);exit;
		}
	}

	public function get_venue_basic()
	{

		
		if($_POST['venue'] != ""){

			
			$venues = $this->General_Model->getid('stadium', array('stadium.s_id' => $_POST['venue']))->row();
			
			if($venues->s_id != ""){
				$response = array('status' => 1,'data' => $venues);
				echo json_encode($response);exit;
			}
			
		}
		else{
			$response = array('status' => 0,'msg' => 'invalid venue');
			echo json_encode($response);exit;
		}
	}


	public function stadium_matches($stadium_id)
	{
		if ($stadium_id != "") {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchmatch" => $search_text));
			} else {
				if ($this->session->userdata('searchmatch') != NULL) {
					$search_text = $this->session->userdata('searchmatch');
				}
			}
			$this->loadRecord('stadium_matches', 0, 'm_id', 'DESC', 'event/stadium_matches', 'matches', $search_text, $stadium_id);
		} else {
			echo "Invalid Stadium";
			exit;
		}

	}


	public function merge_stadium($stadium_id1, $stadium_id2)
	{

		$this->data['stadiums_1'] = $this->General_Model->get_stadium_id($stadium_id1)->row();
		$this->data['stadiums_2'] = $this->General_Model->get_stadium_id($stadium_id2)->row();


		$this->data['blocks_1'] = $this->General_Model->get_block_stadium($stadium_id1)->result();
		$this->data['blocks_2'] = $this->General_Model->get_block_stadium($stadium_id2)->result();
		$this->load->view('event/stadium_block', $this->data);
	}

	public function update_blocks($stadium_id1, $stadium_id2)
	{

		if ($this->input->post('old_block_id')) {

			//echo "<pre>";
			$old_stadium_id = $this->input->post('old_stadium_id');
			$new_stadium_id = $this->input->post('new_stadium_id');
			// print_r($this->input->post('category'));
			// print_r($this->input->post('old_category_id'));
			// print_r($this->input->post('old_block_id'));
			foreach ($this->input->post('old_block_id') as $key => $value) {
				//sell_tickets

				if ($this->input->post('category')[$key]) {

					$query = $this->db->select('sell_tickets.*')
						->from('sell_tickets')
						->join('match_info', 'match_info.m_id = sell_tickets.match_id', 'left')
						->where('match_info.venue', $new_stadium_id)
						->where('sell_tickets.ticket_category', $this->input->post('old_category_id')[$key])
						->where('sell_tickets.ticket_block', $this->input->post('old_block_id')[$key])
						->where('sell_tickets.match_id !=', '1181')
						->get();

					//echo $this->db->last_query();
					$sresults = $query->result();
					echo "<pre>";
					print_r($sresults);
					if ($sresults) {
						foreach ($sresults as $results) {

							if ($results->s_no) {
								$updated_data = array(
									'ticket_category' => $this->input->post('category')[$key],
									'ticket_block' => $this->input->post('block')[$key],


								);
								//print_r($updated_data);
								//die;
								$this->General_Model->update('sell_tickets', array('s_no' => $results->s_no), $updated_data);


							}

							$data = array(
								'old_stadium_id' => $old_stadium_id,
								'new_stadium_id' => $new_stadium_id,
								'sell_ticket_id' => $results->s_no,
								'old_category' => $this->input->post('old_category_id')[$key],
								'old_block' => $this->input->post('old_block_id')[$key],
								'new_category' => $this->input->post('category')[$key],
								'new_block' => $this->input->post('block')[$key],
								'updated_by' => $this->session->userdata('admin_id'),
								'created_at' => date("Y-m-d H:i:s"),
								'update_at' => date("Y-m-d H:i:s"),
							);
							//print_r($data);
							$this->General_Model->insert_data('block_temp', $data);
						}
					}
				}


			}
			// 	print_r($this->input->post('old_block_id'));
			// die;
			die;
			//redir
		}


		$this->data['stadiums_1'] = $this->General_Model->get_stadium_id($stadium_id1)->row();
		$this->data['stadiums_2'] = $this->General_Model->get_stadium_id($stadium_id2)->row();


		$this->data['category_1'] = $this->General_Model->get_category_stadium($stadium_id1)->result();
		$this->data['category_2'] = $this->General_Model->get_category_stadium($stadium_id2)->result();
		// $this->data['full_block_2'] = $this->General_Model->get_category_stadium($stadium_id2,1,1)->result();

		///echo "<pre>";print_r($this->data['category_1']);die;
		$this->load->view('event/update_blocks', $this->data);
	}

	public function category_block($stadium_id, $category_id)
	{



		$options = "";
		if ($category_id) {
			$blocks = $this->General_Model->get_category_stadium($stadium_id, $category_id)->result();
			foreach ($blocks as $value) {
				$options .= "<option value='" . $value->id . "' >" . $value->block_id2 . "</option>";
			}

		}
		echo $options;
	}


	public function update_category($stadium_id1, $stadium_id2)
	{

		if ($this->input->post('old_category')) {

			$old_stadium_id = $this->input->post('old_stadium_id');
			$new_stadium_id = $this->input->post('new_stadium_id');
			//   echo  "<prE>";
			// print_r($this->input->post('category'));
			//   print_r($this->input->post('old_category'));
			//  print_r($this->input->post('old_block_id'));


			foreach ($this->input->post('old_category') as $key => $value) {
				//sell_tickets

				if ($this->input->post('category')[$key]) {

					$query = $this->db->select('sell_tickets.*')
						->from('sell_tickets')
						->join('match_info', 'match_info.m_id = sell_tickets.match_id', 'left')
						->where('match_info.venue', $new_stadium_id)
						->where('sell_tickets.ticket_category', $this->input->post('old_category')[$key])
						->where('sell_tickets.match_id !=', '1181')
						->get();

					//echo $this->db->last_query();
					$sresults = $query->result();
					echo "<pre>";
					print_r($sresults);

					if ($sresults) {
						foreach ($sresults as $results) {
							//print_r($sresults);


							if ($results->s_no) {
								$updated_data = array(
									'ticket_category' => $this->input->post('category')[$key],

								);

								$this->General_Model->update('sell_tickets', array('s_no' => $results->s_no), $updated_data);

								print_r($updated_data);
								//die;

								$data = array(
									'old_stadium_id' => $old_stadium_id,
									'new_stadium_id' => $new_stadium_id,
									'sell_ticket_id' => $results->s_no,
									'old_category' => $this->input->post('old_category')[$key],
									'new_category' => $this->input->post('category')[$key],
									'updated_by' => $this->session->userdata('admin_id'),
									'created_at' => date("Y-m-d H:i:s"),
									'update_at' => date("Y-m-d H:i:s"),
								);
								//print_r($data);
								$this->General_Model->insert_data('block_temp', $data);


							}

						}
					}
				}


			}

			die;
			// 	print_r($this->input->post('old_block_id'));
			// die;
			//die;
			//redir
		}


		$this->data['stadiums_1'] = $this->General_Model->get_stadium_id($stadium_id1)->row();
		$this->data['stadiums_2'] = $this->General_Model->get_stadium_id($stadium_id2)->row();


		$this->data['category_1'] = $this->General_Model->get_category_stadium($stadium_id1)->result();
		$this->data['category_2'] = $this->General_Model->get_category_stadium($stadium_id2)->result();
		// $this->data['full_block_2'] = $this->General_Model->get_category_stadium($stadium_id2,1,1)->result();

		///echo "<pre>";print_r($this->data['category_1']);die;
		$this->load->view('event/update_category', $this->data);
	}

	public function matches()
	{

		// $this->data['app'] = $this->app_data();

		$match_segment = $segment = $this->uri->segment(3);
		$match_id = json_decode(base64_decode($this->uri->segment(4)));
		if ($match_segment == "status") {
			$matchId = trim($this->input->post('id'));
			$status = trim($this->input->post('status'));
			$updateData = array();
			$updateData['tixstock_status'] = $status;
			$this->General_Model->update('match_info', array('m_id' => $matchId), $updateData);
			//echo $this->db->last_query();
			echo "true";
			die;
		} else if ($match_segment == "update_meta_tags") {

			$flag = "upcoming";
			$allmatches = $this->General_Model->get_matches('', $flag, '', '', '', '', '', $search_data, $tournment_id)->result();

			if ($allmatches) {
				foreach ($allmatches as $key => $value) {
					$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
					foreach ($lang as $key => $l_code) {

						$match_info_lang = $this->General_Model->getAllItemTable_array('match_info_lang', array('match_id' => $value->m_id, 'language' => $l_code->language_code))->result_array();

						foreach ($match_info_lang as $row) {

							$team1 = $this->General_Model->getid('teams', array('teams.id' => $value->team_1, 'teams_lang.language' => $l_code->language_code))->row();

							$team2 = $this->General_Model->getid('teams', array('teams.id' => $value->team_2, 'teams_lang.language' => $l_code->language_code))->row();


							$tournament = $this->General_Model->getid('tournament', array('tournament.t_id' => $value->tournament, 'tournament_lang.language' => $l_code->language_code))->row();

							$stadium = $this->General_Model->getid('stadium', array('stadium.s_id' => $value->venue))->row();

							$updateData_lang = array();

							if ($l_code->language_code == "en") {
								$meta_title = $team1->team_name . " vs " . $team2->team_name . " Tickets | " . date('d-m-Y', strtotime($value->match_date)) . " | 1BoxOffice.com";

								$description = 'Buy ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets for the ' . $tournament->tournament_name . ' game being played on ' . date('d M Y', strtotime($value->match_date)) . ' at ' . $stadium->stadium_name . '. 1BoxOffice offers a wide range of ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy ' . $team1->team_name . ' tickets!';
							} else {

								$meta_title = "تذاكر   " . $team1->team_name . " - " . $team2->team_name . " | " . date('d-m-Y', strtotime($value->match_date)) . " | ";


								$description = ' اشتر تذاكر مباراة   ' . $team1->team_name . ' - ' . $team2->team_name . '  لمباراة   ' . $tournament->tournament_name . '  التي ستُلعب في   ' . date('d-m-Y', strtotime($value->match_date)) . ' على    ' . $stadium->stadium_name_ar . '. نقدم مجموعة واسعة من تذاكر   ' . $team1->team_name . ' - ' . $team2->team_name . ' بأسعار مدروسة مناسبة  لعشاق كرة القدم. قم بزيارة موقعنا  www.1boxoffice.com لمزيد من المعلومات حول كيفية شراء تذاكر   ' . $team1->team_name . '!';
							}

							$updateData_lang['meta_title'] = trim($meta_title);
							$updateData_lang['meta_description'] = trim($description);
							$updateData_lang['description'] = trim($description);

							$this->General_Model->update('match_info_lang', array('match_id' => $value->match_id, 'language' => $l_code->language_code), $updateData_lang);
							//echo $this->db->last_query();
						}
					}
					//die;
				}

			}
			echo "Updated";

		} else if ($match_segment == "add_match") {
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
			$this->data['teams'] = $this->General_Model->get_teams()->result();
			$this->data['tournments'] = $this->General_Model->get_tournments()->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['currencies'] = $this->General_Model->getAllItemTable('currency_types', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
			$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
			$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();

			$this->data['sellers'] = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['partners'] = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
			$this->data['partners_api'] = $this->General_Model->get_api_deails();
			$this->data['afiliates'] = $this->General_Model->get_admin_details_by_role_v1(3, 'status');
			//$this->data['storefronts']  = $this->General_Model->get_admin_details_by_role_v1(4, 'status');
			$this->data['storefronts'] = $this->General_Model->get_admin_details_by_site_setting();


			if ($match_id != '') {

				$cheking_event = $this->General_Model->get_event_id($match_id)->row();

			

				$selected_category = $cheking_event->category;
				$choosencategory = "";
				if($selected_category ==  2 || $selected_category == 3){
					$choosencategory = 1;
				}
				
				$this->data['matches'] = $this->General_Model->get_matches_edit($match_id,"","","","","","","","",$choosencategory)->row();
				$this->data['matches_lang'] = $this->General_Model->get_matches_stores($match_id);
				// echo '<pre/>';
				// print_r($this->data['matches_lang']);
				// exit;
			//	$this->data['matches'] = $this->General_Model->get_matches_lang($match_id,"","","","","","","","",$choosencategory)->row();
				// echo '<pre/>';
				// print_r($this->data['matches']);
				// exit;
				$this->load->model('Tickets_Model');
				$this->data['match_details'] = $this->Tickets_Model->getListing_details($match_id);

				//$this->data['booking_tickets'] = $this->Tickets_Model->getbooking_tickets($match_id)->result();

				$listings = $this->data['match_details'];
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
				$this->data['listings'] = $listings;
				//echo "<pre>";print_r($listings);exit;
				///////////////////////


				$apiPartner = $this->db->query("SELECT * FROM `api_partner_events` WHERE api_status = 1 AND `event_id` = " . $match_id)->result();
				$ap_arr = [];
				foreach ($apiPartner as $bc) {
					$ap_arr[] = $bc->partner_id;
				}
				$this->data['ap_arr'] = $ap_arr;
			}

			// echo '<pre/>';
			// print_r($this->data['listings'] );
			// exit;

			//echo "<pre>";print_r($this->data['currencies']);exit;
			$this->load->view(THEME . 'event/add_match', $this->data);
		} else if ($match_segment == "add_content") {

			$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
			$this->data['teams'] = $this->General_Model->get_teams()->result();
			$this->data['tournments'] = $this->General_Model->get_tournments()->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['currencies'] = $this->General_Model->getAllItemTable('currency_types')->result();
			if ($match_id != '') {

				$this->data['matches'] = $this->General_Model->get_matches($match_id)->row();
				$getBannedCountries = $this->db->query("SELECT * FROM `banned_countries_match` WHERE `match_id` = " . $match_id)->result();
				$ban_arr = [];
				foreach ($getBannedCountries as $bc) {
					$ban_arr[] = $bc->country_id;
				}
				$this->data['ban_arr'] = $ban_arr;
			}

			//echo "<pre>";print_r($this->data['currencies']);exit;
			$this->load->view('event/add_content', $this->data);
		}
		else if ($match_segment == "set_venue") {
				$id = $_POST['team1'];
				$stadium_id = $this->General_Model->get_venue_id($id);
				echo json_encode(
					array(
						'selected_venue' =>$stadium_id->stadium,
						'selected_country' =>$stadium_id->country,
						'selected_city' =>$stadium_id->city
						)
				);
				exit;
		} 
		else if ($match_segment == "get_sortname") {
			$id = $_POST['country_id'];
			$sort_name_id = $this->General_Model->get_sortname($id);			
			switch ($sort_name_id->sortname) {
				case 'GB':
					$currency = 'GBP';
					break;
				case 'IT':
				case 'FR':
				case 'ES':
				case 'DE':
					$currency = 'EUR';
					break;
				default:
					$currency = '';
			}
			echo json_encode(array('currency' =>$currency));
			exit;
		} 
		
		else if ($match_segment == "get_venue") {
			$id = $_POST['venue'];
				$stadium_id = $this->General_Model->get_venue_based_country_v1($id);
				echo json_encode(
					array(
						'selected_country' =>$stadium_id->country,
						'selected_city' =>$stadium_id->city
						)
				);
				exit;
		}
		
		else if ($match_segment == "get_city") {

			$country_id = $_POST['country_id'];
			$states = $this->General_Model->get_state_cities($country_id);
			$statesCount = COUNT($states);
			$keys = array_column($states, 'name');
			array_multisort($keys, SORT_ASC|SORT_NATURAL|SORT_FLAG_CASE, $states);
			// echo "<pre>";print_r($states);exit;
			$city = '';
			if ($statesCount > 0) {
				$city .= '<option value="">-Select City-</option>';
				foreach ($states as $state) {
					$city .= '<option value="' . $state->id . '">' . $state->name . '</option>';
				}
			} else {
				$city .= '<option value="">City not available</option>';
			}

			echo json_encode(array('city' => $city, 'state' => $states[0]->state_id));
			exit;
		} else if ($match_segment == "get_new_city_list") {

			$country_id = $_POST['country_id'];
			$city_id = $_POST['city_id'];
			$states = $this->General_Model->get_state_cities($country_id);
			$statesCount = COUNT($states);
			$keys = array_column($states, 'name');
			array_multisort($keys, SORT_ASC, $states);
			$city = '';
			if ($statesCount > 0) {
				$city .= '<option value="">-Select City-</option>';
				foreach ($states as $state) {
					if ($state->id == $city_id)
						$selected = "selected";
					else
						$selected = "";

					$city .= '<option ' . $selected . ' value="' . $state->id . '">' . $state->name . '</option>';
				}
			} else {
				$city .= '<option value="">City not available</option>';
			}

			echo json_encode(array('city' => $city, 'state' => $states[0]->state_id));
			exit;
		} else if ($match_segment == "duplicateCheck") {

			$matchId = $this->input->post('matchId');

			$tournamentArray = $this->General_Model->getid('tournament', array('tournament.t_id' => trim($this->input->post('tournament')), 'tournament_lang.language' => 'en'))->result();
			$team1Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team1'), 'teams_lang.language' => 'en'))->result();
			$team2Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team2'), 'teams_lang.language' => 'en'))->result();
			$title = strip_tags($tournamentArray[0]->tournament_name . ' ' . $team1Array[0]->team_name . '-vs-' . $team2Array[0]->team_name . '-tickets');

			if ($this->input->post('event_url')) {
				$title = strip_tags($this->input->post('event_url'));
			}
			$titleURL = strtolower(url_title($title));
			//echo $titleURL;exit;
			if ($matchId != "") {

				$duplicateCheck = $this->General_Model->getid('match_info', array('slug' => $titleURL, 'matchid_not' => $matchId, 'status' => 1))->result();

			} else {

				$duplicateCheck = $this->General_Model->getid('match_info', array('slug' => $titleURL, 'status' => 1))->result();

			}


			if (count($duplicateCheck) > 0) {
				//$titleURL = $titleURL . '-' . time();
				$response = array('status' => 0, 'msg' => 'URL was used. Do you want Apply it to the new Match ?', 'redirect_url' => base_url() . 'event/matches/upcoming');

			} else {
				$response = array('status' => 1, 'msg' => 'ok', 'redirect_url' => base_url() . 'event/matches/upcoming');
			}
			echo json_encode($response);
			exit;


		} else if ($match_segment == "save_matches_content") {
			$matchId = $this->input->post('matchId');
			if ($matchId != '') {
				if ($this->input->post()) {



					$updateData = array();
					$updateData_lang = array();

					$this->form_validation->set_rules('metatitle', 'Meta Title', 'required');

					$msg = '';
					if ($this->form_validation->run() !== false) {
						$updateData['seo_keywords'] = trim($this->input->post('seo_keywords'));
						$this->General_Model->update('match_info', array('m_id' => $matchId), $updateData);
						//echo "<pre>";print_r($updateData);

						$updateData_lang['meta_title'] = strip_tags($this->input->post('metatitle'));
						$updateData_lang['match_name'] = strip_tags($this->input->post('matchname'));
						$updateData_lang['meta_description'] = $this->input->post('metadescription');
						$updateData_lang['description'] = trim($this->input->post('description'));
						$updateData_lang['long_description'] = trim($this->input->post('long_description'));
						$updateData_lang['seo_keywords'] = trim($this->input->post('seo_keywords'));
						//$updateData_lang['short_description'] = trim($this->input->post('short_description'));
						//echo "<pre>";print_r($updateData_lang);exit;	


						//$updateData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;

							$this->db->select('*');
							$this->db->from('match_info_lang');
							$this->db->where('match_id', $matchId);
							$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
							$this->db->where('language', $this->session->userdata('language_code'));
							
							$query = $this->db->get();
						// echo $this->db->last_query();exit;
							if ($query->num_rows() == 0) {							
								$updateData_lang['match_id'] = $matchId;
								$updateData_lang['language'] = $this->session->userdata('language_code');						
								$updateData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;	
											
								$this->db->insert('match_info_lang', $updateData_lang);
							
							} else {
								$this->General_Model->update('match_info_lang', array('match_id' => $matchId, 'language' => $this->session->userdata('language_code'),'store_id'=>$this->session->userdata('storefront')->admin_id), $updateData_lang);

							}

						
						if (@$this->input->post('event_type') == "other") {
							$event_url = base_url() . 'event/other_events/add_event/' . base64_encode(json_encode($matchId)) . '?tab=content';
						} else {
							$event_url = base_url() . 'event/matches/add_match/' . base64_encode(json_encode($matchId));
						}
						$response = array('status' => 1, 'msg' => 'Match data updated Successfully.' . $msg, 'redirect_url' => $event_url);
						echo json_encode($response);
						exit;


					} else {
						$response = array('status' => 0, 'msg' => 'Oops.Match Content Updation failed.' . $msg, 'redirect_url' => base_url() . 'event/matches/upcoming');
						echo json_encode($response);
						exit;
					}


				}
			} else {
				$response = array('status' => 0, 'msg' => 'Oops.Invalid Match' . $msg, 'redirect_url' => base_url() . 'event/matches/upcoming');
				echo json_encode($response);
				exit;
			}

		} else if ($match_segment == "save_matches") {
			/*echo '<pre/>';
					 print_r($_POST);
					 exit;*/
			$duplicate = $this->input->post('duplicate');
			$update_url = $this->input->post('update_url');
			$matchId = $this->input->post('matchId');
			if ($matchId == '') {
				if ($this->input->post()) {

					$insertData = array();
					$insertData['team_1'] = trim($this->input->post('team1'));
					$insertData['category'] = trim($this->input->post('gamecategory'));
		
					$insertData['team_2'] = trim($this->input->post('team2'));
					$insertData['match_name'] = trim($this->input->post('matchname'));
					$insertData['hometown'] = trim($this->input->post('hometown'));
					$insertData['status'] = $this->input->post('is_active') ? 1 : 0;
					$insertData['oneboxoffice_status'] = 1;
					// $insertData['oneclicket_status'] = $this->input->post('oneclicket_status') ? 1 : 0;
					// $insertData['tixstock_status'] = $this->input->post('tixstock_status') ? 1 : 0;
					$insertData['availability'] = $this->input->post('availability') ? 1 : 0;
					$insertData['upcoming_events'] = $this->input->post('upcomingevents') ? 1 : 0;
					$insertData['affiliate_status'] = $this->input->post('affiliate_status') ? 1 : 0;
					$insertData['confirm_status'] = $this->input->post('confirm_status') ? 1 : 0;
					$insertData['epl_status'] = $this->input->post('epl_status') ? 1 : 0;
					$insertData['match_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime')));
					$insertData['match_time'] = $this->input->post('matchtime');
					$insertData['tournament'] = trim($this->input->post('tournament'));
					$insertData['venue'] = $this->input->post('venue');
					$insertData['price_type'] = $this->input->post('price_type');
					$insertData['matchticket'] = $this->input->post('matchticket');
					$insertData['daysremaining'] = 1; //$this->input->post('daysremaining');
					$insertData['state'] = $this->input->post('state');
					$insertData['city'] = $this->input->post('city');
					$insertData['event_type'] = $this->input->post('event_type') ?$this->input->post('event_type') : "match";
					$insertData['country'] = $this->input->post('country');
					$insertData['create_date'] = strtotime(date('Y-m-d h:i:s'));
					$insertData['ignoreautoswitch'] = $this->input->post('ignoreautoswitch') ? 1 : 0;
					$insertData['final_match'] = $this->input->post('final_match') ? 1 : 0;
					$insertData['top_games'] = $this->input->post('top_games') ? 1 : 0;
					$insertData['high_demand'] = $this->input->post('high_demand') ? '1' : '0';
					$insertData['almost_sold'] = $this->input->post('almost_sold') ? '1' : '0';
					$insertData['add_by'] = $this->session->userdata('admin_id');
					$insertData['search_keywords'] = $this->input->post('search_keywords');
					//	$insertData['feature_games'] = $this->input->post('feature_games') ? 1 : 0;
					$insertData['tbc_status'] = $this->input->post('tbc_status') ? 1 : 0;
					//	$insertData['tixstock_status'] = $this->input->post('tixstock_status') ? 1 : 0;
					//	$insertData['new_match_status'] = $this->input->post('new_match_status') ? 1 : 0;
					if (!empty($_FILES['blog_image']['name'])) {
						$config['upload_path'] = UPLOAD_PATH_PREFIX . 'uploads/blog_image';
						$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
						$config['max_size'] = '10000';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('blog_image')) {
							$outputData['blog_image'] = $this->upload->data();
							$insertData['blog_image'] = $outputData['blog_image']['file_name'];
						} else {
							$msg .= 'Failed to add event image';
						}
					}

					$tournamentArray = $this->General_Model->getid('tournament', array('tournament.t_id' => trim($this->input->post('tournament')), 'tournament_lang.language' => 'en'))->result();
					$team1Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team1'), 'teams_lang.language' => 'en'))->result();
					$team2Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team2'), 'teams_lang.language' => 'en'))->result();
					$title = strip_tags($tournamentArray[0]->tournament_name . ' ' . $team1Array[0]->team_name . '-vs-' . $team2Array[0]->team_name . '-tickets');

					if ($this->input->post('event_url')) {
						$title = strip_tags($this->input->post('event_url'));
					}
					$titleURL = strtolower(url_title($title));
					$duplicateCheck = $this->General_Model->getid('match_info', array('slug' => $titleURL, 'status' => 1))->result();
					// if (count($duplicateCheck) > 0) {
					// 	$response = array('status' => 2, 'msg' => 'URL Exists.Please use different one.', 'redirect_url' => base_url() . 'event/matches/upcoming');
					// 	echo json_encode($response);
						//exit;
						/*if ($update_url == 1) {
											  $oldtitleURL = $duplicateCheck[0]->slug . '-' . time();
											  $mupdateData = array('slug' => $oldtitleURL);
											  $this->General_Model->update('match_info', array('m_id' => $duplicateCheck[0]->m_id), $mupdateData);
										  } else {
											  $response = array('status' => 0, 'msg' => 'URL Exists.Please use different one.', 'redirect_url' => base_url() . 'event/matches/upcoming');
											  echo json_encode($response);
											  exit;
										  }*/
					//}
					$insertData['slug'] = $titleURL;
					/*foreach ($_POST['partner_api'] as $api) {
						$insertData[$api == 1 ? 'tixstock_status' : 'oneclicket_status'] = 1;
					}*/

					foreach ($this->input->post('partner_api') as $api) {
							if($api == 1){								
								$insertData['tixstock_status'] = 1;							
							}else if($api == 2){							
								$insertData['oneclicket_status'] = 1;	
								}else if($api == 3){							
								$insertData['xs2event_status'] = 1;								
							}

						}
					$match_id = $this->General_Model->insert_data('match_info', $insertData);

					// 
					$matchId = $this->db->insert_id();
					$this->db->delete('banned_countries_match', array('match_id' => $matchId));

					$bancountry_ids = $this->input->post('bcountry');
					foreach ($bancountry_ids as $val) {
						$ban_country= $this->General_Model->getSingle('countries', array('id' => $val));

						$this->data = array(
							'match_id' => $matchId,
							'country_id' => trim($val),
							'country_code' => trim($ban_country->sortname)
						);
						$this->db->insert('banned_countries_match', $this->data);
					}
					// 
					$insertData['store_id'] =$this->session->userdata('storefront')->admin_id;

					$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();

					foreach ($lang as $key => $l_code) {
						$insertData_lang = array();
						$insertData_lang['match_id'] = $match_id;
						$insertData_lang['language'] = $l_code->language_code;
						$insertData_lang['match_name'] = trim($this->input->post('matchname'));
						$insertData_lang['match_label'] = trim($this->input->post('match_label'));


						$team1 = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team1'), 'teams_lang.language' => $l_code->language_code))->row();

						$team2 = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team2'), 'teams_lang.language' => $l_code->language_code))->row();

						$tournament = $this->General_Model->getid('tournament', array('tournament.t_id' => trim($this->input->post('tournament')), 'tournament_lang.language' => $l_code->language_code))->row();

						$stadium = $this->General_Model->getid('stadium', array('stadium.s_id' => $this->input->post('venue')))->row();

						if ($l_code->language_code == "en") {
							$insertData_lang['meta_title'] = $team1->team_name . " vs " . $team2->team_name . " Tickets | " . date('d/m/Y', strtotime($this->input->post('matchdate'))) . " | 1BoxOffice.com";

							$description = 'Buy ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets for the ' . $tournament->tournament_name . ' game being played on ' . date('d/m/Y', strtotime($this->input->post('matchdate'))) . ' at ' . $stadium->stadium_name . '. 1BoxOffice offers a wide range of ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy ' . $team1->team_name . ' tickets!';

						} else {
							$insertData_lang['meta_title'] = "تذاكر   " . $team1->team_name . " - " . $team2->team_name . " | " . date('d/m/Y', strtotime($this->input->post('matchdate'))) . " | ";


							$description = ' اشتر تذاكر مباراة   ' . $team1->team_name . ' - ' . $team2->team_name . '  لمباراة   ' . $tournament->tournament_name . '  التي ستُلعب في   ' . date('d/m/Y', strtotime($this->input->post('matchdate'))) . ' على    ' . $stadium->stadium_name_ar . '. نقدم مجموعة واسعة من تذاكر   ' . $team1->team_name . ' - ' . $team2->team_name . ' بأسعار مدروسة مناسبة  لعشاق كرة القدم. قم بزيارة موقعنا  www.1boxoffice.com لمزيد من المعلومات حول كيفية شراء تذاكر   ' . $team1->team_name . '!';
						}

						$insertData_lang['description'] = $description;
						$insertData_lang['meta_description'] = $description;
						$insertData_lang['store_id'] =$this->session->userdata('storefront')->admin_id;
						$insertData_lang['seo_keywords'] = trim($this->input->post('seo_keywords'));

						$this->General_Model->insert_data('match_info_lang', $insertData_lang);
					}
					// $partner_ids = implode(',', $this->input->post('partner'));
					// $afiliate_ids = implode(',', $this->input->post('afiliate'));
					// $store_ids = implode(',', $this->input->post('store'));
					// $seller_ids = implode(',', $this->input->post('seller'));

					//MATCH SETTINGS
					$partnerIds = $this->input->post('partner');

					$partner_ids = !empty($partnerIds) ? implode(',', $partnerIds) : '';

					$afiliateIds = $this->input->post('afiliate');
					$afiliate_ids = !empty($afiliateIds) ? implode(',', $afiliateIds) : '';

					$storeIds = $this->input->post('store');
					$store_ids = !empty($storeIds) ? implode(',', $storeIds) : '';

					$sellerIds = $this->input->post('seller');
					$seller_ids = !empty($sellerIds) ? implode(',', $sellerIds) : '';

					$match_settings_data = array();
					$match_settings_data['matches'] = $match_id;
					$match_settings_data['storefronts'] = $store_ids;
					$match_settings_data['partners'] = $partner_ids;
					$match_settings_data['afiliates'] = $afiliate_ids;
					$match_settings_data['sellers'] = $seller_ids;
					$match_settings_data['status'] = "1";
					$this->db->insert('match_settings', $match_settings_data);
					
					if($partnerIds){
						 foreach ($partnerIds as $p_id) {		
							// API PARTNER
							$api_partner_events_insertData = array(
								'API_id' => date('dyhis'),
								'partner_id' => $p_id,
								'from_date' => date("Y-m-d"),
								'to_date' => date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d")))),
								'tournament_id' => $this->input->post('tournament'),
								'event_id' => $match_id,
								'category_id' => 1,
								'tickets_per_events' => 1000,
								'fullfillment_type' => 1,
								'api_status' => 1
							);
							$this->db->insert('api_partner_events', $api_partner_events_insertData);
						}
					}

					$url = base_url() . 'event/matches/add_match/' . base64_encode(json_encode("$match_id")) . '?tab=content';
					$response = array('status' => 1, 'msg' => 'Match Created Successfully.', 'redirect_url' => $url);
					echo json_encode($response);
					exit;
				}
			} else {

				if ($this->input->post()) {

					$matchId = $this->input->post('matchId');
					$match_info = $this->General_Model->getAllItemTable('match_info', 'm_id', $matchId)->result_array();

					$old_match_date = $match_info[0]['match_date'];
					$old_match_time = $match_info[0]['match_time'];

					// echo '<pre/>';
					// print_r($_POST);
					// exit;
					$updateData = array();
					if (!empty($_FILES['blog_image']['name'])) {
						$config['upload_path'] = UPLOAD_PATH_PREFIX . 'uploads/blog_image';
						$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
						$config['max_size'] = '10000';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('blog_image')) {
							$outputData['blog_image'] = $this->upload->data();
							$updateData['blog_image'] = $outputData['blog_image']['file_name'];
						} else {
							$msg .= 'Failed to add event image';
						}
					}

					$match_detail = $this->General_Model->getid('match_info', array('m_id' => trim($this->input->post('matchId'))))->row();
					$old_match_date = trim($match_detail->match_date);


					$updateData['team_1'] = trim($this->input->post('team1'));
					$updateData['team_2'] = trim($this->input->post('team2'));
					$updateData['category'] = trim($this->input->post('gamecategory'));
					$updateData['match_name'] = trim($this->input->post('matchname'));

					$updateData['hometown'] = trim($this->input->post('hometown'));
					$updateData['tournament'] = trim($this->input->post('tournament'));
					$updateData['status'] = $this->input->post('is_active') ? 1 : 0;
					// $updateData['oneboxoffice_status'] = $this->input->post('oneboxoffice_status') ? 1 : 0;
					// $updateData['oneclicket_status'] = $this->input->post('oneclicket_status') ? 1 : 0;
					// $updateData['tixstock_status'] = $this->input->post('tixstock_status') ? 1 : 0;
					$updateData['availability'] = $this->input->post('availability') ? 1 : 0;
					$updateData['upcoming_events'] = $this->input->post('upcomingevents') ? 1 : 0;
					$updateData['affiliate_status'] = $this->input->post('affiliate_status') ? 1 : 0;
					$updateData['confirm_status'] = $this->input->post('confirm_status') ? 1 : 0;
					$updateData['epl_status'] = $this->input->post('epl_status') ? 1 : 0;
					$updateData['match_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime')));
					$updateData['match_time'] = $this->input->post('matchtime');
					$updateData['venue'] = $this->input->post('venue');
					$updateData['state'] = $this->input->post('state');
					$updateData['city'] = $this->input->post('city');
					$updateData['country'] = $this->input->post('country');
					$updateData['create_date'] = strtotime(date('Y-m-d h:i:s'));
					$updateData['matchticket'] = $this->input->post('matchticket');
					$updateData['daysremaining'] = 1; //$this->input->post('daysremaining');
					$updateData['ignoreautoswitch'] = $this->input->post('ignoreautoswitch') ? 1 : 0;
					$updateData['final_match'] = $this->input->post('final_match') ? 1 : 0;
					$updateData['top_games'] = $this->input->post('top_games') ? 1 : 0;
					$updateData['high_demand'] = $this->input->post('high_demand') ? '1' : '0';
					$updateData['almost_sold'] = $this->input->post('almost_sold') ? '1' : '0';
					$updateData['event_type'] = $this->input->post('event_type') ?$this->input->post('event_type') : "match";
					$updateData['add_by'] = $this->session->userdata('admin_id');
					$updateData['price_type'] = $this->input->post('price_type');
					$updateData['search_keywords'] = $this->input->post('search_keywords');
					$updateData['feature_games'] = $this->input->post('feature_games') ? 1 : 0;
					$updateData['tbc_status'] = $this->input->post('tbc_status') ? 1 : 0;
					$updateData['tixstock_status'] = $this->input->post('tixstock_status') ? "1" : "0";
					$updateData['store_id'] =$this->session->userdata('storefront')->admin_id;
					//echo "<pre>";print_r($updateData);exit;


					$tournamentArray = $this->General_Model->getid('tournament', array('tournament.t_id' => trim($this->input->post('tournament')), 'tournament_lang.language' => 'en'))->result();
					$team1Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team1'), 'teams_lang.language' => 'en'))->result();
					$team2Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team2'), 'teams_lang.language' => 'en'))->result();
					$title = strip_tags($tournamentArray[0]->tournament_name . ' ' . $team1Array[0]->team_name . '-vs-' . $team2Array[0]->team_name . '-tickets');
					
					if ($this->input->post('event_url')) {	
						$title = strip_tags($this->input->post('event_url'));
					}
				
					$titleURL = strtolower(url_title($title));
					$updateData['slug'] = $titleURL;

					$duplicateCheck = $this->General_Model->getid('match_info', array('slug' => $titleURL, 'matchid_not' => $matchId, 'status' => 1))->result();
					//echo 'duplicateCheck = '.count($duplicateCheck).'='.$update_url;exit;
					if (count($duplicateCheck) > 0) {
						/*if ($update_url == 1) {
												 $oldtitleURL = $duplicateCheck[0]->slug . '-' . time();
												 $mupdateData = array('slug' => $oldtitleURL);
												 $this->General_Model->update('match_info', array('m_id' => $duplicateCheck[0]->m_id), $mupdateData);
											 } else {
												 $response = array('status' => 0, 'msg' => 'URL Exists.Please use different one.', 'redirect_url' => base_url() . 'event/matches/upcoming');
												 echo json_encode($response);
												 exit;
											 }*/
						// $response = array('status' => 2, 'msg' => 'URL Key Exists.Please use different one.', 'redirect_url' => base_url() . 'event/matches/upcoming');
						// echo json_encode($response);
						// exit;
					}
					//$updateData['slug'] = $titleURL;

					$updateData['tixstock_status']=0;
					$updateData['oneclicket_status']=0;
					$updateData['xs2event_status']=0;

					foreach ($this->input->post('partner_api') as $api) {
							if($api == 1){								
								$updateData['tixstock_status'] = 1;							
							}else if($api == 2){							
								$updateData['oneclicket_status'] = 1;	
								}else if($api == 3){							
								$updateData['xs2event_status'] = 1;								
							}

						}
						
					
					$this->General_Model->update('match_info', array('m_id' => $matchId), $updateData);
				/*	echo $this->db->last_query();exit;
					echo "<pre>";print_r($updateData);exit;*/
					$updateData_lang = array();
					$updateData_lang['match_name'] = trim($this->input->post('matchname'));
					$updateData_lang['match_label'] = trim($this->input->post('match_label'));
					$updateData_lang['store_id'] =$this->session->userdata('storefront')->admin_id;
					$updateData_lang['seo_keywords'] = trim($this->input->post('seo_keywords'));
					$this->General_Model->update('match_info_lang', array('match_id' => $matchId, 'language' => $this->session->userdata('language_code'),'store_id'=>$this->session->userdata('storefront')->admin_id), $updateData_lang);

					$this->db->delete('banned_countries_match', array('match_id' => $matchId));

					$bancountry_ids = $this->input->post('bcountry');
					foreach ($bancountry_ids as $val) {
						$ban_country= $this->General_Model->getSingle('countries', array('id' => $val));

						$this->data = array(
							'match_id' => $matchId,
							'country_id' => trim($val),
							'country_code' => trim($ban_country->sortname)
						);
						$this->db->insert('banned_countries_match', $this->data);
					}

					$new_match_date = date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime')));

					// $partner_ids = implode(',', $this->input->post('partner'));
					// $afiliate_ids = implode(',', $this->input->post('afiliate'));
					// $store_ids = implode(',', $this->input->post('store'));
					// $seller_ids = implode(',', $this->input->post('seller'));
					
					if($old_match_date !=  $new_match_date){

							$existing_matches = $this->General_Model->getid('booking_tickets', array('booking_tickets.match_id' => $this->input->post('matchId')))->result();
							foreach($existing_matches as $existing_match){
								
							$updatedData = array('old_match_date' => $existing_match->match_date,'old_match_time' => $existing_match->match_time,'match_date' => date("Y-m-d",strtotime($this->input->post('matchdate'))),'match_time' => $this->input->post('matchtime'));
							$this->General_Model->update('booking_tickets', array('bt_id' => $existing_match->bt_id), $updatedData);

							}
						}


					$partnerIds = $this->input->post('partner');
					$partner_ids = !empty($partnerIds) ? implode(',', $partnerIds) : '';

					$afiliateIds = $this->input->post('afiliate');
					$afiliate_ids = !empty($afiliateIds) ? implode(',', $afiliateIds) : '';

					$storeIds = $this->input->post('store');
					$store_ids = !empty($storeIds) ? implode(',', $storeIds) : '';

					$sellerIds = $this->input->post('seller');
					$seller_ids = !empty($sellerIds) ? implode(',', $sellerIds) : '';

					$match_settings_data = array();
					$match_settings_data['matches'] = $matchId;
					$match_settings_data['storefronts'] = $store_ids;
					$match_settings_data['partners'] = $partner_ids;
					$match_settings_data['afiliates'] = $afiliate_ids;
					$match_settings_data['sellers'] = $seller_ids;
					$match_settings_data['status'] = "1";
					//	$this->General_Model->update('match_settings', array('matches' => $matchId), $match_settings_data);

					// Check if the matchId exists in the database
					$existingMatch = $this->General_Model->getSingle('match_settings', array('matches' => $matchId));

					if ($existingMatch) {
						// MatchId exists, perform an update
						$this->General_Model->update('match_settings', array('matches' => $matchId), $match_settings_data);
					} else {
						// MatchId does not exist, perform an insert
						$match_settings_data['matches'] = $matchId; // Add matchId to the data array
						$this->db->insert('match_settings', $match_settings_data);
					}


					$api_partnerstatus = array(
						'api_status'	=> 0,
					);
					$this->General_Model->update('api_partner_events', array('event_id' => $matchId), $api_partnerstatus);

					//print_r($partnerIds);
					if($partnerIds){
						foreach ($partnerIds as  $p_id) {
							$api_partner_events_insertData = array(
								'API_id' => date('dyhis'),
								'partner_id' => $p_id,
								'from_date' => date("Y-m-d"),
								'to_date' => date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d")))),
								'tournament_id' => $this->input->post('tournament'),
								'event_id' => $matchId,
								'category_id' => 1,
								'tickets_per_events' => 1000,
								'fullfillment_type' => 1,
								'api_status' => 1
							);

							//print_r($api_partner_events_insertData);
						

							$existingMatch = $this->General_Model->getSingle('api_partner_events', array('event_id' => $matchId,'partner_id' => $p_id));

							if ($existingMatch) {
							// MatchId exists, perform an update
							//$this->General_Model->update('match_settings', array('matches' => $matchId), $match_settings_data);
							$this->General_Model->update('api_partner_events', array('event_id' => $matchId , 'partner_id' => $p_id), $api_partner_events_insertData);

								} else {
								// MatchId does not exist, perform an insert
								$match_settings_data['matches'] = $matchId; // Add matchId to the data array
								//$this->db->insert('match_settings', $match_settings_data);
								$this->db->insert('api_partner_events', $api_partner_events_insertData);
							}

						
						}
					}

					if ($duplicate == 1) {

						$match_id = $matchId;
						$match_info = $this->General_Model->getAllItemTable('match_info', 'm_id', $match_id)->result_array();
						unset($match_info[0]['m_id']);
						$match_info[0]['cloned'] = 1;

						$match_info_id = $this->General_Model->insert_data('match_info', $match_info[0]);
						if ($match_info_id != "") {

							$updateData = array('status' => 0, 'match_date' => $old_match_date, 'match_time' => $old_match_time);
							$this->General_Model->update('match_info', array('m_id' => $match_id), $updateData);

							$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
							foreach ($lang as $key => $l_code) {
								$match_info_lang = $this->General_Model->getAllItemTable_array('match_info_lang', array('match_id' => $match_id, 'language' => $l_code->language_code))->result_array();
								unset($match_info_lang[0]['id']);
								$match_info_lang[0]['match_id'] = $match_info_id;


								//echo "copy_content = ".$this->input->post('copy_content');exit;

								if ($this->input->post('copy_content') != 1) {

									$tournamentArray = $this->General_Model->getid('tournament', array('tournament.t_id' => trim($this->input->post('tournament')), 'tournament_lang.language' => 'en'))->result();
									$team1Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team1'), 'teams_lang.language' => 'en'))->result();
									$team2Array = $this->General_Model->getid('teams', array('teams.id' => $this->input->post('team2'), 'teams_lang.language' => 'en'))->result();
									$stadium = $this->General_Model->getid('stadium', array('stadium.s_id' => $this->input->post('venue')))->result();

									//$meta_title = $team1Array[0]->team_name." vs ".$team2Array[0]->team_name." Tickets | ".date('Y-m-d', strtotime($this->input->post('matchdate')))." ".date('H:i:s', strtotime($this->input->post('matchtime')))." | 1BoxOffice.com";

									$meta_title = "Buy " . $team1Array[0]->team_name . " vs " . $team2Array[0]->team_name . " Tickets | " . date('d/m/Y', strtotime($this->input->post('matchdate'))) . " | Buy Sell " . $team1Array[0]->team_name . " Tickets";

									$description = 'Buy ' . $team1Array[0]->team_name . ' vs ' . $team2Array[0]->team_name . ' tickets for the ' . $tournamentArray[0]->tournament_name . ' game being played on ' . date('d M Y', strtotime($this->input->post('matchdate'))) . ' at ' . $stadium[0]->stadium_name . '. 1BoxOffice offers a wide range of ' . $team1Array[0]->team_name . ' vs ' . $team2Array[0]->team_name . ' tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy ' . $team1Array[0]->team_name . ' tickets!';
									$match_info_lang[0]['description'] = $description;
									$match_info_lang[0]['meta_title'] = $meta_title;
									$match_info_lang[0]['meta_description'] = $description;

								} else {
									/*	echo $old_match_date;
															 echo date('Y-m-d H:i:s', strtotime($old_match_date));
															 echo date('Y-m-d H:i:s', strtotime($this->input->post('matchdate').' '.$this->input->post('matchtime')));exit;*/
									$meta_title = str_replace("Tickets 2022/23", "Tickets 2023/24", $match_info_lang[0]['meta_title']);
									$meta_title = str_replace("Tickets 2022/2023", "Tickets 2023/2024", $meta_title);
									$meta_title = str_replace(date('Y-m-d H:i:s', strtotime($old_match_date)), date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime'))), $meta_title);

									$meta_title = str_replace(date('Y-m-d H:i:s+0000', strtotime($old_match_date)), date('Y-m-d H:i:s+0000', strtotime($this->input->post('matchdate'))), $meta_title);

									$meta_title = str_replace(date('Y-m-d', strtotime($old_match_date)) . ' at ' . date('H:i', strtotime($old_match_date)), date('Y-m-d', strtotime($old_match_date)) . ' at ' . date('H:i', strtotime($this->input->post('matchdate'))), $meta_title);

									$meta_title = str_replace(date('d M Y', strtotime($old_match_date)), date('d M Y', strtotime($this->input->post('matchdate'))), $meta_title);

									$meta_title = str_replace(date('l, M jS, Y', strtotime($old_match_date)), date('l, M jS, Y', strtotime($this->input->post('matchdate'))), $meta_title);

									$meta_title = str_replace(date('l d M Y', strtotime($old_match_date)), date('l d M Y', strtotime($this->input->post('matchdate'))), $meta_title);


									$description = str_replace(date('Y-m-d H:i:s', strtotime($old_match_date)), date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime'))), $match_info_lang[0]['description']);

									$description = str_replace(date('Y-m-d H:i:s+0000', strtotime($old_match_date)), date('Y-m-d H:i:s+0000', strtotime($this->input->post('matchdate'))), $description);

									$description = str_replace(date('Y-m-d', strtotime($old_match_date)) . ' at ' . date('H:i', strtotime($old_match_date)), date('Y-m-d', strtotime($old_match_date)) . ' at ' . date('H:i', strtotime($this->input->post('matchdate'))), $description);

									$description = str_replace(date('d M Y', strtotime($old_match_date)), date('d M Y', strtotime($this->input->post('matchdate'))), $description);

									$description = str_replace(date('l, M jS, Y', strtotime($old_match_date)), date('l, M jS, Y', strtotime($this->input->post('matchdate'))), $description);

									$description = str_replace(date('l d M Y', strtotime($old_match_date)), date('l d M Y', strtotime($this->input->post('matchdate'))), $description);



									$meta_description = str_replace(date('Y-m-d H:i:s', strtotime($old_match_date)), date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime'))), $match_info_lang[0]['meta_description']);
									$meta_description = str_replace(date('Y-m-d H:i:s+0000', strtotime($old_match_date)), date('Y-m-d H:i:s+0000', strtotime($this->input->post('matchdate'))), $meta_description);
									$meta_description = str_replace(date('Y-m-d', strtotime($old_match_date)) . ' at ' . date('H:i', strtotime($old_match_date)), date('Y-m-d', strtotime($old_match_date)) . ' at ' . date('H:i', strtotime($this->input->post('matchdate'))), $meta_description);
									$meta_description = str_replace(date('d M Y', strtotime($old_match_date)), date('d M Y', strtotime($this->input->post('matchdate'))), $meta_description);
									$meta_description = str_replace(date('l, M jS, Y', strtotime($old_match_date)), date('l, M jS, Y', strtotime($this->input->post('matchdate'))), $meta_description);
									$meta_description = str_replace(date('l d M Y', strtotime($old_match_date)), date('l d M Y', strtotime($this->input->post('matchdate'))), $meta_description);

									$match_info_lang[0]['description'] = $description;
									$match_info_lang[0]['meta_title'] = $meta_title;
									$match_info_lang[0]['meta_description'] = $meta_description;
								}
								//echo "<pre>";print_r($match_info_lang);exit;
								$this->General_Model->insert_data('match_info_lang', $match_info_lang[0]);
							}
							$updateData = array('status' => 0, 'match_date' => $old_match_date, 'match_time' => $old_match_time);
							$this->General_Model->update('match_info', array('m_id' => $match_id), $updateData);

							// $match_settings_data = array();
							// $match_settings_data['matches'] = $match_info_id;
							// $match_settings_data['storefronts'] = 13;
							// $match_settings_data['partners']  = 209;
							// $match_settings_data['status']  = "1";
							// $this->db->insert('match_settings', $match_settings_data);

							$response = array('status' => 1, 'flag' => 1, 'redirect_url' => base_url() . 'event/matches/upcoming', 'msg' => 'Match Cloned Successfully.');
							echo json_encode($response);
							exit;

						} else {
							$response = array('status' => 0, 'msg' => 'Failed to Clone Match Details.');
							echo json_encode($response);
							exit;

						}


					} else {

						$match_url = base_url() . 'event/matches/add_match/' . base64_encode(json_encode($matchId)) . '';
						$this->General_Model->update('match_info_lang', array('match_id' => $matchId, 'language' => $this->session->userdata('language_code')), $updateData_lang);
						$response = array('status' => 1, 'msg' => 'Match data updated Successfully.', 'redirect_url' => $match_url);
						echo json_encode($response);
						exit;
					}
				}
			}
		} else if ($match_segment == "delete_match") {
			$match_id = $segment = $this->uri->segment(4);
			$updateData_data['status'] = 2;
			/*$match_id   = $segment = $this->uri->segment(4);
							  $delete     = $this->General_Model->delete_match_data($match_id);*/
			$delete = $this->General_Model->update('match_info', array('m_id' => $match_id), $updateData_data);


			if ($delete == 1) {

				$response = array('status' => 1, 'msg' => 'Match Moved to trash Successfully.');
				echo json_encode($response);
				exit;
			} else {

				$response = array('status' => 1, 'msg' => 'Error While Moving Match to trash.');
				echo json_encode($response);
				exit;
			}
		} else if ($match_segment == "undo_match") {
			$match_id = $segment = $this->uri->segment(4);
			$updateData_data['status'] = 1;
			/*$match_id   = $segment = $this->uri->segment(4);
							  $delete     = $this->General_Model->delete_match_data($match_id);*/
			$delete = $this->General_Model->update('match_info', array('m_id' => $match_id), $updateData_data);


			if ($delete == 1) {

				$response = array('status' => 1, 'msg' => 'Match Moved from trash Successfully.');
				echo json_encode($response);
				exit;
			} else {

				$response = array('status' => 1, 'msg' => 'Error While Undoing Match data.');
				echo json_encode($response);
				exit;
			}
		} else if ($match_segment == "seo_status") {
			$id = $this->uri->segment(4);
			$updateData_data['seo_status'] = $_POST['seo_status'];

			$update = $this->General_Model->update('match_info', array('m_id' => $id), $updateData_data);
			if ($update == 1) {
				$response = array('status' => 1, 'msg' => 'Match SEO status updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While updating Match SEO status tournament data.');
				echo json_encode($response);
				exit;
			}
		} else if ($match_segment == "seo") {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchmatch" => $search_text));
			} else {
				if ($this->session->userdata('searchmatch') != NULL) {
					$search_text = $this->session->userdata('searchmatch');
				}
			}
			$row_count = $this->uri->segment(4);
			$status_flag = $this->uri->segment(3);

			if (isset($_POST['tournment_id']) && $_POST['tournement_defualt_id'] == 1) {
				$this->session->set_userdata(array("tournament_search" => $_POST['tournment_id']));
				$tournment_id = $this->session->userdata('tournament_search');
			} else if (isset($_POST['tournment_id']) && $_POST['tournement_defualt_id'] != 1) {
				$this->session->unset_userdata('tournament_search');
				$tournment_id = $_POST['tournment_id'];
			} else {
				$tournment_id = $this->session->userdata('tournament_search');
			}

			$this->data['status_flag'] = $status_flag;
			//echo "<pre>";print_r($_POST);exit;
			$this->loadRecord($status_flag, $row_count, 'm_id', 'DESC', 'event/seo', 'matches', $search_text, $tournment_id);
			//$this->load->view('event/matches',$this->data);
		} else {
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$view = 'event/matches';
			$this->load->view(THEME . $view, $this->data);
		}

	}


	public function download_orders()
	{

		$where_array = array();

		$fileName = "Match-" . date('Y-m-d') . "-" . time() . ".xls";

		$tournaments = "";
		if ($_GET['tournaments'] != "") {
			$tournaments = $_GET['tournaments'];
		}

		$download = $this->General_Model->get_match_by_tournments();

		// Column names 
		$fields = array('Match Id', 'Match Name', 'Tournament Id', 'Tournament Name');
		// Display column names as first row 
		$excelData = implode("\t", array_values($fields)) . "\n";
		$total_amount = array();
		foreach ($download as $download_order) {
			$lineData = array(
				$download_order->m_id,
				$download_order->match_name,
				$download_order->tournament,
				$download_order->tournament_name
			);

			$excelData .= implode("\t", array_values($lineData)) . "\n";
		}

		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$fileName\"");

		// Render excel data 
		echo $excelData;

		exit;
	}
	/**
	 * Fetch data and display based on the pagination request
	 */
	public function loadRecord($status_flag, $rowno = 0, $order_column, $order_by, $view, $variable_name, $search = '', $tournment_id = "")
	{
		// Load Pagination library
		$this->load->library('pagination');

		// Row per page
		$row_per_page = 20;

		// Row position
		if ($rowno == '') {
			$rowno = 0;
		}
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}

		$variable_name = "matches";
		$this->data['status_flag'] = $status_flag;
		if ($status_flag == "upcoming") {
			$url = "event/matches/upcoming";
			// All records count
			$allcount = $this->General_Model->get_matches('', 'upcoming', '', '', '', '', '', $search, $tournment_id)->num_rows();

			// Get records
			$record = $this->General_Model->get_matches('', 'upcoming', $rowno, $row_per_page, $order_column, $order_by, '', $search, $tournment_id)->result();
		}
		if ($status_flag == "stadium_matches") {
			$url = "event/stadium_matches/all";
			$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
			$this->data['stadium_id'] = $tournment_id;
			// All records count
			$allcount = $this->General_Model->get_stadium_matches('', 'all', '', '', '', '', '', $search, $tournment_id)->num_rows();

			// Get records
			$record = $this->General_Model->get_stadium_matches('', 'all', '', '', $order_column, $order_by, '', $search, $tournment_id)->result();
		} else if ($status_flag == "seo") {
			$rowno = 0;
			$row_per_page = 1;
			$url = "event/matches/seo";
			// All records count
			$allcount = $this->General_Model->get_matches('', 'upcoming', '', '', '', '', '', $search, $tournment_id)->num_rows();

			// Get records
			$record = $this->General_Model->get_matches('', 'upcoming', $rowno, $row_per_page, $order_column, $order_by, '', $search, $tournment_id)->result();
			//echo $this->db->last_query();
			//exit;

		} else if ($status_flag == "expired") {
			$url = "event/matches/expired";

			//	$this->data['expired_matches'] = $this->General_Model->get_matches('', 'expired')->result();
			// All records count
			$allcount = $this->General_Model->get_matches('', 'expired', '', '', '', '', '', $search, $tournment_id)->num_rows();


			// Get records
			$record = $this->General_Model->get_matches('', 'expired', $rowno, $row_per_page, $order_column, $order_by, '', $search, $tournment_id)->result();
		} else if ($status_flag == "trashed") {
			$url = "event/matches/trashed";

			//	$this->data['expired_matches'] = $this->General_Model->get_matches('', 'expired')->result();
			// All records count
			$allcount = $this->General_Model->get_matches('', 'trashed', '', '', '', '', '', $search, $tournment_id)->num_rows();


			// Get records
			$record = $this->General_Model->get_matches('', 'trashed', $rowno, $row_per_page, $order_column, $order_by, '', $search, $tournment_id)->result();
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
		$this->data['tournment_id'] = $tournment_id;
		// Load view
		if($view='event/seo')
		{
			unset($view);
			$view=THEME.'event/seo';
		}
		$this->load->view($view, $this->data);
	}


	public function other_events_category()
	{
		$event_segment = $segment = $this->uri->segment(3);
		//$category_id = json_decode(base64_decode($this->uri->segment(4)));
		$category_id = $this->uri->segment(4);

		if ($event_segment == "add_category") {
			$this->data['categories'] = $this->General_Model->get_other_events_categories()->result();
			if ($category_id != '') {
				$this->data['category'] = $this->General_Model->get_other_events_categories($row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', array('A.id' => $category_id))->row();
			}
			
			$this->load->view(THEME.'event/add_other_event_category', $this->data);
		} else if ($event_segment == "save_category") {
			$categoryId = $this->input->post('categoryId');

			if ($categoryId == '') {

				if ($this->input->post()) {
					$insertData = array();
					$insertData['parent_id'] = trim($this->input->post('parent'));
					$insertData['category_name'] = trim($this->input->post('categoryname'));
					$insertData['status'] = $this->input->post('is_active') ? 1 : 0;
					$insertData['sort'] = $this->input->post('sortno');
					$insertData['category_desc'] = $this->input->post('category_description');
					$insertData['create_date'] = strtotime(date('Y-m-d h:i:s'));
					$insertData['add_by'] = $this->session->userdata('admin_id');

					$category_id = $this->General_Model->insert_data('otherevent_category', $insertData);

					$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
					foreach ($lang as $key => $l_code) {
						$insertData_lang = array();
						$insertData_lang['other_event_cat_id'] = $category_id;
						$insertData_lang['language'] = $l_code->language_code;
						$insertData_lang['category_name'] = trim($this->input->post('categoryname'));
						$insertData_lang['category_desc'] = $this->input->post('category_description');

						$this->General_Model->insert_data('otherevent_category_lang', $insertData_lang);
					}

					$response = array('status' => 1, 'msg' => 'Category Created Successfully.', 'redirect_url' => base_url() . 'event/other_events_category');
					echo json_encode($response);
					exit;
				}
			} else {

				if ($this->input->post()) {
					$categoryId = $this->input->post('categoryId');
					$updateData = array();
					$updateData['parent_id'] = trim($this->input->post('parent'));
					$updateData['category_name'] = trim($this->input->post('categoryname'));
					$updateData['status'] = $this->input->post('is_active') ? 1 : 0;
					$updateData['sort'] = $this->input->post('sortno');
					$updateData['category_desc'] = $this->input->post('category_description');
					$updateData['create_date'] = strtotime(date('Y-m-d h:i:s'));
					$updateData['add_by'] = $this->session->userdata('admin_id');

					$this->General_Model->update('otherevent_category', array('id' => $categoryId), $updateData);

					$updateData_lang = array();
					$updateData_lang['category_name'] = trim($this->input->post('categoryname'));
					$updateData_lang['category_desc'] = $this->input->post('category_description');
					$this->General_Model->update('otherevent_category_lang', array('other_event_cat_id' => $category_id, 'language' => $this->session->userdata('language_code')), $updateData_lang);

					$response = array('status' => 1, 'msg' => 'Category updated Successfully.', 'redirect_url' => base_url() . 'event/other_events_category');
					echo json_encode($response);
				}
			}
		} else if ($event_segment == "delete_category") {

			$category_id = $segment = $this->uri->segment(4);
			$delete = $this->General_Model->delete_other_events_category($category_id);

			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Category deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting Category.');
				echo json_encode($response);
				exit;
			}
		} else {
			$row_count = $this->uri->segment(3);
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchotherevecat" => $search_text));
			} else {
				if ($this->session->userdata('searchotherevecat') != NULL) {
					$search_text = $this->session->userdata('searchotherevecat');
				}
			}
			//$this->loadOtherEventsCategoriesRecord($row_count, 'id', 'DESC', 'event/other_events_categories', 'other_events_categories', $search_text);
			
			$this->load->view(THEME.'event/other_events_categories', $this->data);
		}
	}

	public function loadOtherEventsCategoriesRecord($rowno = 0, $order_column, $order_by, $view, $variable_name, $search)
	{
		// Load Pagination library
		$this->load->library('pagination');

		// Row per page
		$row_per_page = 10;

		// Row position
		if ($rowno == '') {
			$rowno = 0;
		}
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}

		$variable_name = "other_events_categories";

		$url = "event/other_events_category";
		// All records count
		$allcount = $this->General_Model->get_other_events_categories('', '', '', '', '', $search)->num_rows();

		// Get records
		$record = $this->General_Model->get_other_events_categories($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();

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
		// Load view
		$this->load->view($view, $this->data);
	}

	public function other_events()
	{
		$event_segment = $segment = $this->uri->segment(3);
		$match_id = json_decode(base64_decode($this->uri->segment(4)));
		if ($event_segment == "get_sub_category") {
			$category_id = $_POST['category_id'];
			$select_id = @$_POST['select_id'];
			$categories = $this->General_Model->get_other_events_main_categories($category_id)->result();
			$categories_Count = COUNT($categories);
			$category = '';
			if ($categories_Count > 0) {
				$category .= '<option value="">-Select Sub Category-</option>';
				foreach ($categories as $row) {
					$selected = $select_id == $row->id ? "selected" : "";
					$category .= '<option value="' . $row->id . '" ' . $selected . ' > ' . $row->category_name . '</option>';
				}
			} else {
				$category .= '<option value="">Sub Category not available</option>';
			}
			echo json_encode(array('category' => $category));
			exit;
		}
		if ($event_segment == "get_tournament_group") {
			$tournament_id = $_POST['tournament'];
			$select_id = @$_POST['select_id'];
			$tournament_data = $this->General_Model->get_tournament_group($tournament_id)->result();
			$categories_Count = COUNT($tournament_data);
			$tournament = '';
			if ($categories_Count > 0) {
				$tournament .= '<option value="">-Select Tournament Group -</option>';
				foreach ($tournament_data as $row) {
					$selected = $select_id == $row->id ? "selected" : "";
					$tournament .= '<option value="' . $row->id . '" ' . $selected . ' >' . $row->tournament_group_name . '</option>';
				}
			} else {
				$tournament .= '<option value="">Sub Tournament Group available</option>';
			}
			echo json_encode(array('tournament' => $tournament));
			exit;
		} else if ($event_segment == "add_event") {
			//$this->data['categories'] = $this->General_Model->get_other_events_main_categories()->result();
			$this->data['categories'] = $this->General_Model->get_other_events_categories('', '', '', '')->result();
			$this->data['stadiums'] = $this->General_Model->get_stadium()->result();

			$this->data['tournments'] = $this->General_Model->get_tournments()->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['currencies'] = $this->General_Model->getAllItemTable('currency_types', 'store_id', $this->session->userdata('storefront')->admin_id)->result();

			$this->data['sellers'] = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['partners'] = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
			$this->data['partners_api'] = $this->General_Model->get_api_deails();	
			$this->data['afiliates'] = $this->General_Model->get_admin_details_by_role_v1(3, 'status');
			//$this->data['storefronts']  = $this->General_Model->get_admin_details_by_role_v1(4, 'status');
			$this->data['storefronts'] = $this->General_Model->get_admin_details_by_site_setting();


			if ($match_id != '') {

				// echo "MATCHID:".$match_id;exit;
				$this->data['event'] = $this->General_Model->getOtherEvents('', '', $row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', array('match_info.m_id' => $match_id))->row();

				$this->data['matches'] = $this->General_Model->get_matches($match_id)->row();
				$this->data['matches_lang'] = $this->General_Model->get_matches_stores($match_id);

				$this->load->model('Tickets_Model');
				$this->data['match_details'] = $this->Tickets_Model->getListing_details($match_id);

				//$this->data['booking_tickets'] = $this->Tickets_Model->getbooking_tickets($match_id)->result();

				$listings = $this->data['match_details'];
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
				$this->data['listings'] = $listings;
				//echo "<pre>";print_r($listings);exit;
				//////////////////////

				// echo "<pre>"; print_r($this->data['event']);exit;
			}
			$this->load->view(THEME . 'event/add_other_event', $this->data);
		} else if ($event_segment == "add_event_content") {

			$this->data['categories'] = $this->General_Model->get_other_events_categories()->result();
			$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			if ($match_id != '') {
				// echo "MATCHID:".$match_id;exit;
				$this->data['event'] = $this->General_Model->getOtherEvents('', '', $row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', array('match_info.m_id' => $match_id))->row();




				// echo "<pre>"; print_r($this->data['event']);exit;
			}
			$this->load->view('event/add_event_content', $this->data);
		} else if ($event_segment == "save_events") {

			$matchId = $this->input->post('matchId');

			if ($matchId == '') {
				$msg = '';
				if ($this->input->post()) {

					if (!empty($_FILES['event_image']['name'])) {
						$this->form_validation->set_rules('event_image', 'Image file', 'callback_image_file_check');
					}
					if ($this->form_validation->run() !== false) {
						$insertData = array();

						if (!empty($_FILES['event_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX . 'uploads/event_image';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ($this->upload->do_upload('event_image')) {
								$outputData['event_image'] = $this->upload->data();
								$insertData['event_image'] = $outputData['event_image']['file_name'];
							} else {
								$msg .= 'Failed to add event image';
							}
						}




						if (!empty($_FILES['seat_mapping']['name'])) {

							$config['upload_path'] = UPLOAD_PATH_PREFIX . 'uploads/seat_mapping';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config['max_size'] = '1000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if (!$this->upload->do_upload('seat_mapping')) {
								$msg .= 'Failed to add event image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];

								$insertData['seat_mapping'] = $imagename;
							}
						}
						$insertData['oneboxoffice_status'] = 1;
						$insertData['category'] = 1;
						$insertData['other_event_category'] = $this->input->post('category');
						$insertData['match_name'] = trim($this->input->post('eventname'));
						$insertData['extra_title'] = trim($this->input->post('extra_title'));
						$insertData['status'] = $this->input->post('is_active') ? 1 : 0;
						$insertData['availability'] = $this->input->post('availability') ? 1 : 0;
						$insertData['privatelink'] = $this->input->post('privatelink') ? '1' : '0';
						$insertData['apishare'] = $this->input->post('apishare') ? '1' : '0';
						$insertData['meta_title'] = trim($this->input->post('metatitle'));
						$insertData['meta_description'] = trim($this->input->post('metadescription'));
						$insertData['description'] = trim($this->input->post('description'));

						$insertData['match_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime')));
						$insertData['match_time'] = $this->input->post('matchtime');
						$insertData['country'] = $this->input->post('country');
						$insertData['city'] = $this->input->post('city');
						$insertData['venue'] = $this->input->post('venue');
						$insertData['price_type'] = $this->input->post('price_type');
						$insertData['tournament'] = $this->input->post('tournament');
						$insertData['tournament_group'] = $this->input->post('tournament_group');
						$insertData['search_keywords'] = $this->input->post('search_keywords');
						$insertData['slug'] = trim($this->input->post('categoryname'));
						$insertData['event_type'] = 'other';
						$insertData['create_date'] = strtotime(date('Y-m-d h:i:s'));
						$insertData['add_by'] = $this->session->userdata('admin_id');

						$insertData['matchticket'] = $this->input->post('matchticket');
						$insertData['top_games'] = $this->input->post('top_games') ? 1 : 0;
						$insertData['upcoming_events'] = $this->input->post('upcomingevents') ? 1 : 0;
						$insertData['tbc_status'] = $this->input->post('tbc_status') ? 1 : 0;
						//$insertData['oneboxoffice_status'] = $this->input->post('oneboxoffice_status') ? 1 : 0;
						$insertData['ignoreautoswitch'] = $this->input->post('ignoreautoswitch') ? 1 : 0;
						$insertData['final_match'] = $this->input->post('final_match') ? 1 : 0;
						$insertData['high_demand'] = $this->input->post('high_demand') ? '1' : '0';
						$insertData['almost_sold'] = $this->input->post('almost_sold') ? '1' : '0';
						$insertData['affiliate_status'] = $this->input->post('affiliate_status') ? 1 : 0;
						$insertData['confirm_status'] = $this->input->post('confirm_status') ? 1 : 0;
						$insertData['epl_status'] = $this->input->post('epl_status') ? 1 : 0;
						$insertData['store_id'] = $this->session->userdata('storefront')->admin_id;

						if ($this->input->post('event_url')) {
							$title = strip_tags($this->input->post('event_url'));
						}
						$titleURL = strtolower(url_title($title));
						$duplicateCheck = $this->General_Model->getid('match_info', array('slug' => $titleURL, 'status' => 1))->result();
						if (count($duplicateCheck) > 0) {
							if ($update_url == 1) {

							} else {
								$response = array('status' => 0, 'msg' => 'URL Exists.Please use different one.', 'redirect_url' => base_url() . 'event/other_events/add_event?tab=home');
								echo json_encode($response);
								exit;
							}
						}
						$insertData['slug'] = $titleURL;

						foreach ($_POST['partner_api'] as $api) {
							$insertData[$api == 1 ? 'tixstock_status' : 'oneclicket_status'] = 1;
							}
						$match_id = $this->General_Model->insert_data('match_info', $insertData);


						$bancountry_ids = $this->input->post('bcountry');
						foreach ($bancountry_ids as $val) {
							$ban_country= $this->General_Model->getSingle('countries', array('id' => $val));

							$this->data = array(
								'match_id' => $matchId,
								'country_id' => trim($val),
								'country_code' => trim($ban_country->sortname)
							);
							$this->db->insert('banned_countries_match', $this->data);
						}

						$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['match_id'] = $match_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['match_name'] = trim($this->input->post('eventname'));
							$insertData_lang['meta_title'] = $this->input->post('metatitle');
							$insertData_lang['meta_description'] = $this->input->post('metadescription');
							$insertData_lang['event_image'] = $insertData['event_image'];
							$insertData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;
							$this->General_Model->insert_data('match_info_lang', $insertData_lang);
						}
						$encode_id = base64_encode(json_encode("$match_id"));


						//$partner_ids = implode(',', $this->input->post('partner'));
						//$afiliate_ids = implode(',', $this->input->post('afiliate'));
						// $store_ids = implode(',', $this->input->post('store'));
						// $seller_ids = implode(',', $this->input->post('seller'));

						$partnerIds = $this->input->post('partner');
						$partner_ids = !empty($partnerIds) ? implode(',', $partnerIds) : '';

						$afiliateIds = $this->input->post('afiliate');
						$afiliate_ids = !empty($afiliateIds) ? implode(',', $afiliateIds) : '';

						$storeIds = $this->input->post('store');
						$store_ids = !empty($storeIds) ? implode(',', $storeIds) : '';

						$sellerIds = $this->input->post('seller');
						$seller_ids = !empty($sellerIds) ? implode(',', $sellerIds) : '';


						$match_settings_data = array();
						$match_settings_data['matches'] = $match_id;
						$match_settings_data['storefronts'] = $store_ids;
						$match_settings_data['partners'] = $partner_ids;
						$match_settings_data['afiliates'] = $afiliate_ids;
						$match_settings_data['sellers'] = $seller_ids;
						$match_settings_data['status'] = "1";

						$this->db->insert('match_settings', $match_settings_data);


						$api_partner_events_insertData = array(
							'API_id' => date('dyhis'),
							'partner_id' => $partner_ids,
							'from_date' => date("Y-m-d"),
							'to_date' => date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d")))),
							'tournament_id' => $this->input->post('tournament'),
							'event_id' => $match_id,
							'category_id' => 1,
							'tickets_per_events' => 1000,
							'fullfillment_type' => 1,
							'api_status' => 1
						);

						$this->db->insert('api_partner_events', $api_partner_events_insertData);

						$response = array('status' => 1, 'msg' => 'Other Event Created Successfully.', 'redirect_url' => base_url() . 'event/other_events/add_event/' . $encode_id . '?tab=content');
						echo json_encode($response);
						exit;
					}
				}
			} else {

				if ($this->input->post()) {
					$this->form_validation->set_rules('eventname', 'Event name', 'required');
					/*if($_POST['flag'] != "content"){
												  if (!empty($_FILES['event_image']['name'])) {
													  $this->form_validation->set_rules('event_image', 'Image file', 'callback_image_file_check');
												  }
												  }
												  if($_POST['flag'] == "content"){
													  $this->form_validation->set_rules('eventname', 'Event name', 'required');
												  }*/
					//echo "<pre>";print_r($_POST);exit;
					if ($this->form_validation->run() !== false) {
						$msg = '';
						$matchId = $this->input->post('matchId');
						$updateData = array();

						if ($_POST['flag'] != "content") {
							$updateData_lang = array();
							if (!empty($_FILES['event_image']['name'])) {
								$mdata = $this->General_Model->getAllItemTable_array('match_info', array('m_id' => $matchId))->row();

								if (@getimagesize(base_url() . './uploads/event_image/' . $mdata->event_image)) {
									unlink('./uploads/event_image/' . $mdata->event_image);
								}
								$config['upload_path'] = UPLOAD_PATH_PREFIX . 'uploads/event_image';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '1000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if (!$this->upload->do_upload('event_image')) {
									$msg .= 'Failed to add event image';
								} else {
									$data = $this->upload->data();
									$imagename = $data['file_name'];
									$updateData_lang['event_image'] = $imagename;
									$updateData['event_image'] = $imagename;
								}
							} else {
								$updateData_lang['event_image'] = $this->input->post('exs_file');
								$updateData['event_image'] = $this->input->post('exs_file');
							}

							if (!empty($_FILES['seat_mapping']['name'])) {
								$mdata = $this->General_Model->getAllItemTable_array('match_info', array('m_id' => $matchId))->row();

								if (@getimagesize(base_url() . './uploads/seat_mapping/' . $mdata->seat_mapping)) {
									unlink('./uploads/seat_mapping/' . $mdata->seat_mapping);
								}
								$config['upload_path'] = UPLOAD_PATH_PREFIX . 'uploads/seat_mapping';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '1000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if (!$this->upload->do_upload('seat_mapping')) {
									$msg .= 'Failed to add event image';
								} else {
									$data = $this->upload->data();
									$imagename = $data['file_name'];

									$updateData['seat_mapping'] = $imagename;
								}
							} else {
								$updateData['seat_mapping'] = $this->input->post('exs_file2');
							}

							$updateData['other_event_category'] = $this->input->post('category');
							$updateData['match_name'] = trim($this->input->post('eventname'));
							$updateData['extra_title'] = trim($this->input->post('extra_title'));
							$updateData['status'] = $this->input->post('is_active') ? 1 : 0;
							$updateData['availability'] = $this->input->post('availability') ? 1 : 0;
							$updateData['privatelink'] = $this->input->post('privatelink') ? '1' : '0';
							$updateData['apishare'] = $this->input->post('apishare') ? '1' : '0';
							//$updateData['oneboxoffice_status'] = $this->input->post('oneboxoffice_status') ? '1' : '0';

							$updateData['tournament'] = $this->input->post('tournament');
							$updateData['search_keywords'] = $this->input->post('search_keywords');
							$updateData['tournament_group'] = $this->input->post('tournament_group');
							$updateData['match_date'] = date('Y-m-d H:i:s', strtotime($this->input->post('matchdate') . ' ' . $this->input->post('matchtime')));
							$updateData['match_time'] = $this->input->post('matchtime');
							$updateData['country'] = $this->input->post('country');
							$updateData['city'] = $this->input->post('city');
							$updateData['venue'] = $this->input->post('venue');
							$updateData['price_type'] = $this->input->post('price_type');
							$updateData['slug'] = trim($this->input->post('categoryname'));
							$updateData['event_type'] = 'other';
							$updateData['create_date'] = strtotime(date('Y-m-d h:i:s'));
							$updateData['add_by'] = $this->session->userdata('admin_id');
							$updateData['matchticket'] = $this->input->post('matchticket');
							$updateData['top_games'] = $this->input->post('top_games') ? 1 : 0;
							$updateData['upcoming_events'] = $this->input->post('upcomingevents') ? 1 : 0;
							$updateData['tbc_status'] = $this->input->post('tbc_status') ? 1 : 0;
							$updateData['ignoreautoswitch'] = $this->input->post('ignoreautoswitch') ? 1 : 0;
							$updateData['final_match'] = $this->input->post('final_match') ? 1 : 0;
							$updateData['high_demand'] = $this->input->post('high_demand') ? '1' : '0';
							$updateData['almost_sold'] = $this->input->post('almost_sold') ? '1' : '0';
							$updateData['affiliate_status'] = $this->input->post('affiliate_status') ? 1 : 0;
							$updateData['confirm_status'] = $this->input->post('confirm_status') ? 1 : 0;
							$updateData['epl_status'] = $this->input->post('epl_status') ? 1 : 0;
							if ($this->input->post('event_url')) {
								$title = strip_tags($this->input->post('event_url'));
							}
							$titleURL = strtolower(url_title($title));
							$duplicateCheck = $this->General_Model->getid('match_info', array('slug' => $titleURL, 'matchid_not' => $matchId, 'status' => 1))->result();
							// if (count($duplicateCheck) > 0) {
							// 	if ($update_url == 1) {

							// 	} else {
							// 		$response = array('status' => 0, 'msg' => 'URL Exists.Please use different one.', 'redirect_url' => base_url() . 'event/matches/upcoming');
							// 		echo json_encode($response);
							// 		exit;
							// 	}
							// }
							$updateData['slug'] = $titleURL;
							$updateData['tixstock_status']=0;
							$updateData['oneclicket_status']=0;
							foreach ($this->input->post('partner_api') as $api) {
								if($api == 1)								
									$updateData['tixstock_status'] = 1;							
								else if($api == 2)							
									$updateData['oneclicket_status'] = 1;								
								}
							$this->General_Model->update('match_info', array('m_id' => $matchId), $updateData);



							$updateData_lang['match_name'] = trim($this->input->post('eventname'));
							$this->General_Model->update('match_info_lang', array('match_id' => $matchId, 'language' => $this->session->userdata('language_code')), $updateData_lang);

							$this->db->delete('banned_countries_match', array('match_id' => $matchId));
							$bancountry_ids = $this->input->post('bcountry');
							foreach ($bancountry_ids as $val) {
								$ban_country= $this->General_Model->getSingle('countries', array('id' => $val));

								$this->data = array(
									'match_id' => $matchId,
									'country_id' => trim($val),
									'country_code' => trim($ban_country->sortname)
								);
								$this->db->insert('banned_countries_match', $this->data);
							}


							// $partner_ids = implode(',', $this->input->post('partner'));
							// $afiliate_ids = implode(',', $this->input->post('afiliate'));
							// $store_ids = implode(',', $this->input->post('store'));
							// $seller_ids = implode(',', $this->input->post('seller'));

							$partnerIds = $this->input->post('partner');
							$partner_ids = !empty($partnerIds) ? implode(',', $partnerIds) : '';

							$afiliateIds = $this->input->post('afiliate');
							$afiliate_ids = !empty($afiliateIds) ? implode(',', $afiliateIds) : '';

							$storeIds = $this->input->post('store');
							$store_ids = !empty($storeIds) ? implode(',', $storeIds) : '';

							$sellerIds = $this->input->post('seller');
							$seller_ids = !empty($sellerIds) ? implode(',', $sellerIds) : '';

							$match_settings_data = array();
							$match_settings_data['matches'] = $matchId;
							$match_settings_data['storefronts'] = $store_ids;
							$match_settings_data['partners'] = $partner_ids;
							$match_settings_data['afiliates'] = $afiliate_ids;
							$match_settings_data['sellers'] = $seller_ids;
							$match_settings_data['status'] = "1";
							//	$this->General_Model->update('match_settings', array('matches' => $matchId), $match_settings_data);


							// Check if the matchId exists in the database
							$existingMatch = $this->General_Model->getSingle('match_settings', array('matches' => $matchId));

							if ($existingMatch) {
								// MatchId exists, perform an update
								$this->General_Model->update('match_settings', array('matches' => $matchId), $match_settings_data);
							} else {
								// MatchId does not exist, perform an insert
								$match_settings_data['matches'] = $matchId; // Add matchId to the data array
								$this->db->insert('match_settings', $match_settings_data);
							}


							$api_partner_events_insertData = array(
								'API_id' => date('dyhis'),
								'partner_id' => $partner_ids,
								'from_date' => date("Y-m-d"),
								'to_date' => date('Y-m-d', strtotime("+3 months", strtotime(date("Y-m-d")))),
								'tournament_id' => $this->input->post('tournament'),
								'event_id' => $matchId,
								'category_id' => 1,
								'tickets_per_events' => 1000,
								'fullfillment_type' => 1,
								'api_status' => 1
							);

							unset($existingMatch);


							$existingMatch = $this->General_Model->getSingle('api_partner_events', array('event_id' => $matchId));

							if ($existingMatch) {
								// MatchId exists, perform an update
								$this->General_Model->update('match_settings', array('matches' => $matchId), $match_settings_data);
								$this->General_Model->update('api_partner_events', array('event_id' => $matchId), $api_partner_events_insertData);

							} else {
								// MatchId does not exist, perform an insert
								$match_settings_data['matches'] = $matchId; // Add matchId to the data array
								$this->db->insert('match_settings', $match_settings_data);
								$this->db->insert('api_partner_events', $api_partner_events_insertData);
							}

							//$this->db->insert('api_partner_events', $api_partner_events_insertData);




						} else {
							/*$updateData['meta_title'] = trim($this->input->post('metatitle'));
																   $updateData['meta_description'] = trim($this->input->post('metadescription'));
																   $updateData['description'] = trim($this->input->post('description'));*/
							$updateData['seo_keywords'] = trim($this->input->post('seo_keywords'));
							$this->General_Model->update('match_info', array('m_id' => $matchId), $updateData);

							$updateData_lang = array();

							$updateData_lang['match_id'] = $matchId;
							$updateData_lang['match_name'] = trim($this->input->post('eventname'));
							$updateData_lang['meta_title'] = trim($this->input->post('metatitle'));
							$updateData_lang['meta_description'] = trim($this->input->post('metadescription'));
							$updateData_lang['description'] = trim($this->input->post('description'));
							//echo $matchId;
							//echo "<pre>";print_r($updateData_lang);exit;
							$this->General_Model->update('match_info_lang', array('match_id' => $matchId, 'language' => $this->session->userdata('language_code')), $updateData_lang);

						}
						$event_url = base_url() . 'event/other_events/add_event/' . base64_encode(json_encode($matchId));
						$response = array('status' => 1, 'msg' => 'Other Event updated Successfully.' . $msg, 'redirect_url' => $event_url);
						echo json_encode($response);
						exit;
					}
				}
			}
		} else if ($event_segment == "delete_event") {

			$event_id = $segment = $this->uri->segment(4);
			$delete = $this->General_Model->delete_other_events($event_id);

			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Other Event deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting Other Event.');
				echo json_encode($response);
				exit;
			}
		} else if ($event_segment == "seo_status") {
			$id = $this->uri->segment(4);
			$updateData_data['seo_status'] = $_POST['seo_status'];

			$update = $this->General_Model->update('match_info', array('m_id' => $id), $updateData_data);
			if ($update == 1) {
				$response = array('status' => 1, 'msg' => 'Match SEO status updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While updating Match SEO status tournament data.');
				echo json_encode($response);
				exit;
			}
		} else {
			$this->load->view(THEME . 'event/other_events', $this->data);
			// $row_count = $this->uri->segment(4);
			// if ($this->input->post('submit') != NULL) {
			// 	$search_text = $this->input->post('search');
			// 	$this->session->set_userdata(array("searchotherevents" => $search_text));
			// } else {
			// 	if ($this->session->userdata('searchotherevents') != NULL) {
			// 		$search_text = $this->session->userdata('searchotherevents');
			// 	}
			// }
			// $status_flag = $this->uri->segment(3);
			// $this->data['status_flag'] = $status_flag;
			// $this->loadOtherEventsRecord($status_flag, $row_count, 'm_id', 'DESC', 'event/other_events', 'other_events', $search_text);
		}
	}


	public function update_stadium_data($match_id)
	{

		if ($match_id != "") {

			$updateData['venue'] = trim($this->input->post('stadium'));
			if ($this->General_Model->update('match_info', array('m_id' => $match_id), $updateData)) {
				$response = array('status' => 1, 'msg' => "Match's Stadium updated Successfully.", 'redirect_url' => base_url() . 'event/stadium_matches/' . $_POST['stadium']);
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => "Failed to update match's stadium.", 'redirect_url' => base_url() . 'event/stadium_matches/' . $_POST['venu']);
				echo json_encode($response);
				exit;
			}



		} else {
			$response = array('status' => 1, 'msg' => 'Invalid match details.', 'redirect_url' => base_url() . 'event/stadium_matches/' . $_POST['venu']);
			echo json_encode($response);
			exit;
		}

	}

	public function loadOtherEventsRecord($status_flag, $rowno = 0, $order_column, $order_by, $view, $variable_name, $search = '')
	{

		// Load Pagination library
		$this->load->library('pagination');

		// Row per page
		$row_per_page = 10;

		// Row position
		if ($rowno == '') {
			$rowno = 0;
		}
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}

		$variable_name = "other_events";

		if ($status_flag == "upcoming") {
			$url = "event/other_events/upcoming";
			// All records count
			//$allcount = $this->General_Model->get_matches('','upcoming')->num_rows();
			$allcount = $this->General_Model->getOtherEvents('', 'upcoming', '', '', '', '', '', $search)->num_rows();
			// Get records
			$record = $this->General_Model->getOtherEvents('', 'upcoming', $rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} else if ($status_flag == "expired") {
			$url = "event/other_events/expired";

			$this->data['expired_other_events'] = $this->General_Model->getOtherEvents('', 'expired', '', '', '', '', '', $search)->result();
			// All records count
			$allcount = $this->General_Model->getOtherEvents('', 'expired', '', '', '', '', '', $search)->num_rows();


			// Get records
			$record = $this->General_Model->getOtherEvents('', 'expired', $rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
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
		// Load view
		$this->load->view($view, $this->data);
	}
	public function image_file_check()
	{
		$allowed_mime_types = array('image/jpeg', 'image/svg+xml', 'image/png', 'image/gif');
		if (isset($_FILES['event_image']['name']) && $_FILES['event_image']['name'] != "") {
			$mime = get_mime_by_extension($_FILES['event_image']['name']);
			$fileAr = explode('.', $_FILES['event_image']['name']);
			$ext = end($fileAr);
			if (in_array($mime, $allowed_mime_types)) {
				return true;
			} else {
				$this->form_validation->set_message('file_check', 'Please select only image file to upload.');
				return false;
			}
		} else {
			$this->form_validation->set_message('file_check', 'Please select a image file to upload.');
			return false;
		}
	}


	public function change_match_info_status()
	{
		if (strtolower($_POST['status']) == "active") {
			$mupdateData = array('status' => 1);
		} else if (strtolower($_POST['status']) == "inactive") {
			$mupdateData = array('status' => 0);
		} else if (strtolower($_POST['status']) == "top game") {
			$mupdateData = array('top_games' => 1);
		}
		
			

		for ($x = 0; $x < count($_POST['orderIds']); $x++) {

			// $this->db->where('m_id',$_POST['orderIds'][$x]);
			// $this->db->update_batch('match_info', $mupdateData,'m_id');
			

			if ($_POST['orderIds'][$x] != "") {
				$this->General_Model->update('match_info', array('m_id' => $_POST['orderIds'][$x]), $mupdateData);
				$a[]= $this->db->last_query();
			}
		}
	
		$response = array("a"=>$a,'status' => 0, 'msg' => 'Event Status Updated Successfully.');
		echo json_encode($response);
		exit;
	}
	//
	public function get_seo_list()
	{
		
		$row_per_page = 50;
		$search=[];
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		// $allcount = $this->Tickets_Model->partner_enquiry_details('', '', '', '', '', $search)->num_rows();
		// $records = $this->Tickets_Model->partner_enquiry_details($rowno, $row_per_page,'id','desc', '', $search)->result();

		$allcount = $this->General_Model->get_matches('', 'upcoming', '', '', '', '', '', $search, $tournment_id)->num_rows();
			// Get records
		$records = $this->General_Model->get_matches('', 'upcoming', $rowno, $row_per_page, "m_id", 'DESC', '', $search, $tournment_id)->result();
	$i=1;
		foreach($records as $record ){	
			
			$request_on="";
			if($record->create_date!="")
			{
				$create_date =   date("d M Y",$record->create_date) ;
				$dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $create_date)));

				$timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $create_date)));

				$gmtFormatted = @$_COOKIE["time_zone"];

				$request_on= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;
			}
		
		$language_code = $this->session->userdata('language_code');
		$link =   FRONT_END_URL."/".$language_code."/".$record->slug;
		$seo_preview = '<a target="_blank" href="'.$link.'" > <span class="badge"><i aria-hidden="true" class="far fa-eye"></i></span></a>';
		
		$seo_status="";
		if ($record->seo_status == 1) { 
			$seo_status = '<span class="badge badge-success"><i class="fas fa-check"></i></span>';
		}
		else if ($record->seo_status != 1) { 
			$seo_status = '<span class="badge badge-warning"><i class="fas fa-times "></i></span>';
		}

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


			$data[] = array( 
                "match_name"						=> 		$match_name, 
				"meta_title"						=> 		$record->meta_title, 
				"meta_description"					=> 		$record->meta_description, 
				"status"							=> 		$seo_status, 
				"view"								=> 		$seo_preview, 
				"enq_date"							=> 		$request_on, 
							
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

		public function get_other_category_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['ticket_type'])  ) 
		{
			$search['status']=$_POST['status'];
			$search['name']=$_POST['ticket_type'];

			$allcount = $this->General_Model->get_other_events_categories('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_other_events_categories($rowno, $row_per_page, "category_name", 'asc', '', $search)->result();		

		}
		else
		{	

			$allcount = $this->General_Model->get_other_events_categories('', '', '', '', '', "")->num_rows();
			$records = $this->General_Model->get_other_events_categories($rowno, $row_per_page, "category_name", 'asc', '', "")->result();
		}

		// echo $this->db->last_query();
		// // exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."event/other_events_category/add_category/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'event/other_events_category/delete_category/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
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
				"parent"					=> $record->PARENT,
				"sort"						=> $record->sort,
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

	/*public function update_match_setting()
	{
		$allcount = $this->General_Model->get_upcoming_list()->num_rows();
		$records = $this->General_Model->get_upcoming_list()->result();
		if ($allcount > 0) {
			echo $allcount;
			echo "<br>";
			foreach ($records as $record) {
				// echo "----".$record->m_id."--".$record->match_name."--".$record->match_date."-----";
				// echo "<br>";
				if ($record->m_id) {
					$query = $this->db->where('matches', $record->m_id)
									  ->get('match_settings');
			
					if ($query->num_rows() > 0) {
						$rec = $query->row();
						
						if ($rec->storefronts == "13") {
							$data = array('storefronts' => '13,208,211,213,214,220','afiliates' => '230,231');
							$this->db->where('matches', $rec->matches)
									 ->update('match_settings', $data);
							echo "---------1<br>";
						}
						else{
								echo "---------2<br>";
						}
						
					}
					else{
						echo "---------3<br>";
						$data = array(							
							// Update your column names and values accordingly
							'matches' => $record->m_id,
							'sellers' => '',
							'partners' => '209',
							'afiliates' => '230,231',
							'storefronts' => '13,208,211,213,214,220',
							'status' => '1'
							// Add more columns as needed
						);
						$this->db->insert('match_settings', $data);
						echo "Match ID : " . $record->m_id . " <br/>";
					}
				}
			}
		}
	} */

	public function update_match_setting()
	{
		$allcount = $this->General_Model->get_upcoming_list()->num_rows();
		$records = $this->General_Model->get_upcoming_list()->result();

		if ($allcount > 0) {
			foreach ($records as $record) {
				if ($record->m_id) {
					$query = $this->db->where('matches', $record->m_id)
									  ->where('storefronts', 13)
									  ->get('match_settings');
		
					if ($query->num_rows() > 0) {
						$rec = $query->result();
		
						if ($rec[0]->storefronts == 13) {
							$data = array('storefronts' => '13,208,211,213,214,220');
							$this->db->where('matches', $record->m_id)
									 ->update('match_settings', $data);
							echo "Match ID: " . $record->m_id . "<br/>";
						}
					}
				}
			}
		}

	}

	public function get_selected_teams()
	{
		$category=$_POST['gamecategory'];
		$records = $this->General_Model->get_selected_teams($category)->result();
		$stadium_records = $this->General_Model->get_selected_stadium($category)->result();
		$tournament_records = $this->General_Model->get_selected_tournament($category)->result();

		$teams .= '<option value="">Select Team 1</option>';
		foreach($records as $record ){
		  $teams .= '<option value="'.$record->id.'">'.$record->team_name." ( ".$record->source_type." )".'</option>';
		}

		$stadiums .= '<option value="">Select Venue</option>';
		foreach($stadium_records as $stadium ){
		  $stadiums .= '<option value="'.$stadium->s_id.'">'.$stadium->stadium_name.' - '.$stadium->s_id." ( ".$stadium->source_type." )".'</option>';
		  
		}

		$tournaments .= '<option value="">Select Tournament</option>';
		foreach($tournament_records as $tournament ){
			$slug = $tournament->url_key;
		  	$tournaments .= '<option value="'.$tournament->t_id.'" data-slug="'.$slug.'"  >'.$tournament->tournament_name.'</option>';
		}

		$result['teams']=$teams;
		$result['stadium']=$stadiums;
		$result['tournament']=$tournaments;	
		$result['hometown']=$teams;		

		$response = array('status' => 1, 'result' => $result);
			echo json_encode($response);
			exit;
	
	}
	public function get_selected_teams_edit()
	{
		$category=$_POST['gamecategory'];
		$selected_team=$_POST['selected_team1'];	
		$selected_team2=$_POST['selected_team2'];	
		$selected_stadium=$_POST['selected_venue'];
		$selected_tournament=$_POST['selected_tournament'];

		$records = $this->General_Model->get_selected_teams($category)->result();
		$stadium_records = $this->General_Model->get_selected_stadium($category)->result();
		$tournament_records = $this->General_Model->get_selected_tournament($category)->result();

		$teams .= '<option value="">Select Team 1</option>';
		foreach($records as $record ){
			$selected='';
			if($record->id == $selected_team){ 
				$selected='selected ';
			} 
		  $teams .= '<option value="'.$record->id.'" '.$selected.'>'.$record->team_name." ( ".$record->source_type." )".'</option>';
		}

		$teams2 .= '<option value="">Select Team 2</option>';
		foreach($records as $record ){
			$selected='';
			if($record->id == $selected_team2){ 
				$selected='selected ';
			} 
		  $teams2 .= '<option value="'.$record->id.'" '.$selected.'>'.$record->team_name." ( ".$record->source_type." )".'</option>';
		}

		$stadiums .= '<option value="">Select Venue</option>';
		foreach($stadium_records as $stadium ){
			$selected='';
			if($stadium->s_id == $selected_stadium){ 
				$selected='selected ';
			} 
			$stadiums .= '<option value="'.$stadium->s_id.'" '.$selected.'>'.$stadium->stadium_name.' - '.$stadium->s_id." ( ".$stadium->source_type." )".'</option>';
		}

		$tournaments .= '<option value="">Select Tournament</option>';
		foreach($tournament_records as $tournament ){
			$selected='';
			if($tournament->t_id == $selected_tournament){ 
				$selected='selected ';
			} 
		  $tournaments .= '<option value="'.$tournament->t_id.'" '.$selected.'>'.$tournament->tournament_name.'</option>';
		}

		$result['teams']=$teams;
		$result['teams2']=$teams2;
		$result['stadium']=$stadiums;
		$result['tournament']=$tournaments;	
		$result['hometown']=$teams;		

		$response = array('status' => 1, 'result' => $result);
			echo json_encode($response);
			exit;
	
	}

	public function udpate_event_setting(){
		die;
		$all_records = $this->General_Model->get_matches('','upcoming','','','','','','','')->result();

		foreach ($all_records as $key => $value) {
			$array = array(

				'afiliates'		=> '230,231,238',
				'storefronts'	=> '13,208,211,213,214,220',
				'partners'		=> '209,240',
			);
			$this->General_Model->update('match_settings', array('matches' => $value->m_id), $array);
			echo $this->db->last_query();
		}
	}


	public function update_match_info()
	{

		$result_set=$this->General_Model->update_match_info()->result();
		$data = "";
		if(count($result_set)>0)
		{
			$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
			foreach ($result_set as $key => $value) {
				foreach ($lang as $key => $l_code) {
					$match_info_lang = $this->General_Model->getAllItemTable_array('match_info_lang', array('match_id' => $value->m_id, 'language' => $l_code->language_code, 'store_id' => 13))->result_array();
					if (empty($match_info_lang)) {

						$team1 = $this->General_Model->getid('teams', array('teams.id' => $value->team_1, 'teams_lang.language' => $l_code->language_code))->row();

						$team2 = $this->General_Model->getid('teams', array('teams.id' => $value->team_2, 'teams_lang.language' => $l_code->language_code))->row();


						$tournament = $this->General_Model->getid('tournament', array('tournament.t_id' => $value->tournament, 'tournament_lang.language' => $l_code->language_code))->row();

						$stadium = $this->General_Model->getid('stadium', array('stadium.s_id' => $value->venue))->row();

						$updateData_lang = array();

						if ($l_code->language_code == "en") {
							$meta_title = $team1->team_name . " vs " . $team2->team_name . " Tickets | " . date('d-m-Y', strtotime($value->match_date)) . " | 1BoxOffice.com";

							$description = 'Buy ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets for the ' . $tournament->tournament_name . ' game being played on ' . date('d M Y', strtotime($value->match_date)) . ' at ' . $stadium->stadium_name . '. 1BoxOffice offers a wide range of ' . $team1->team_name . ' vs ' . $team2->team_name . ' tickets that suits most football fans budget. Contact 1BoxOffice today for more information on how to buy ' . $team1->team_name . ' tickets!';
						} else {

							$meta_title = "تذاكر   " . $team1->team_name . " - " . $team2->team_name . " | " . date('d-m-Y', strtotime($value->match_date)) . " | ";


							$description = ' اشتر تذاكر مباراة   ' . $team1->team_name . ' - ' . $team2->team_name . '  لمباراة   ' . $tournament->tournament_name . '  التي ستُلعب في   ' . date('d-m-Y', strtotime($value->match_date)) . ' على    ' . $stadium->stadium_name_ar . '. نقدم مجموعة واسعة من تذاكر   ' . $team1->team_name . ' - ' . $team2->team_name . ' بأسعار مدروسة مناسبة  لعشاق كرة القدم. قم بزيارة موقعنا  www.1boxoffice.com لمزيد من المعلومات حول كيفية شراء تذاكر   ' . $team1->team_name . '!';
						}


						$insertData_lang['match_name'] = $team1->team_name . " vs " . $team2->team_name;
						$insertData_lang['match_id'] = $value->m_id;
						$insertData_lang['language'] = $l_code->language_code;
						$insertData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;
						$insertData_lang['meta_title'] = trim($meta_title);
						$insertData_lang['meta_description'] = trim($description);
						$insertData_lang['description'] = trim($description);
						$this->db->insert('match_info_lang', $insertData_lang);

						$data .= $value->m_id . " \t\t" . $meta_title . "\t\t " . $description;
						$data .= "\n";
					}
				}
			}
			if($data!=""){
			header('Content-Type: application/csv');
			$filename = 'match_info_' . date('Y_m_d') . '.csv';
			header('Content-Disposition: attachment; filename="' . $filename . '"');
			echo $data; exit();
			}
			else{
				echo "No Records Found.";
			}
		}
		else
		{
			echo "No Records Found.";
		}
	}


	public function meta_match_info_update()
	{
		$result_set=$this->General_Model->update_match_info()->result();
		$data = "";
		if(count($result_set)>0)
		{
			$store_id = 13;
			$lang = $this->General_Model->getAllItemTable('language', 'store_id', $store_id)->result();
			foreach ($result_set as $key => $value) {
				foreach ($lang as $key => $l_code) {
					$match_info_lang = $this->db->select('COUNT(match_info_lang.id) as total_count,match_id')
										->where('match_id' , $value->m_id)
										->where('store_id' , $store_id)
										//->where('store_id IS NOT NULL')
										->from('match_info_lang')
										->get();
					$res =  $match_info_lang->row();
					if ($res->total_count == 0 ) {
					 	$updated_data = array('store_id' => $store_id);
					 	// pr($updated_data);
					 	// pr($value->m_id);
					 	$this->General_Model->update('match_info_lang', array('match_id' => $value->m_id), $updated_data);
						 $data .= $value->m_id;
						$data .= "\n";
					 }
				}

			
			}
		ob_clean();
			if($data!=""){
			header('Content-Type: application/csv');
			$filename = 'match_info_' . date('Y_m_d') . '.csv';
			header('Content-Disposition: attachment; filename="' . $filename . '"');
			echo $data; exit();
			}
			else{
				echo "No Records Found.";
			}
		}
		else
		{
			echo "No Records Found.";
		}
	}

}
