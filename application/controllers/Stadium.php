<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
// 		ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class Stadium extends CI_Controller
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
		$this->load->model('Stadium_Model');
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


	public function index(){
		$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
		$this->data['stadiums']   = $this->Stadium_Model->get_stadium_by_limit('', '', '', '', $where_array, $search_data)->result();
		$this->load->view(THEME.'stadium/stadium_list', $this->data);
	}

	public function get_stadium($id) {
		$segment4 = $id; 
		$getStadiumDetails = $this->General_Model->getAllItemTable('stadium', 's_id', $segment4)->row();
		$svg_filename = UPLOAD_PATH . 'uploads/stadium/maps/user-uploads/' . basename($getStadiumDetails->stadium_image)."?v=".time();
		header('location: ' . base_url('stadium/edit_stadium') . '/' . $segment4 . '?map=' . $svg_filename);
	}

	public function add_stadium() {
		if($_GET['map']){
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$segment4 = $this->uri->segment(4);
			$this->data['allCountries'] = $this->General_Model->getAllItemTable('countries', NULL, NULL, 'name', 'asc')->result();
			$this->data['allTeams'] = $this->General_Model->getAllItemTable('teams')->result();
			//$this->data['getSeatCategory'] = $this->General_Model->getAllItemTable('stadium_seats', 'status', 1)->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['getSeatCategory'] = $this->Stadium_Model->get_seat_category_main()->result();
			$this->load->view(THEME.'stadium/add_stadium', $this->data);
		}
		else{
			$this->load->view(THEME.'stadium/upload_map', $this->data);	
		}
	} 

		public function edit_stadium($id) {

			$this->data['edit_stadium_id'] =  $segment4 = $id;
			$this->data['getStadium'] = $this->General_Model->getAllItemTable('stadium', 's_id', $segment4)->row();
			$this->data['stadium_category'] = $this->Stadium_Model->get_seat_stadium_category($segment4)->result();

			$this->data['getStadium'] = $this->General_Model->getAllItemTable('stadium', 's_id', $segment4)->row();
			$this->data['colorGroup'] = $this->Stadium_Model->get_stadium_color_list($segment4)->result();
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$this->data['getSeatCategory'] = $this->Stadium_Model->get_seat_category_main()->result();

			$this->data['stadium_details'] = $this->General_Model->getAllItemTable('stadium_details', 'stadium_id', $segment4)->result();

			// echo "<pre>";
			// print_r($this->data['stadium_details']);die;
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['cities'] = $this->General_Model->get_state_cities($this->data['getStadium']->country);

			//print_r($this->data['colorGroup']);

			$this->load->view(THEME.'stadium/edit_stadium', $this->data);
	
		} 


		public function update_stadium_attendee_status() {
	
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
		public function update_stadium_status() {
			
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
	} 

	public function delete_stadium($id) {
			$delete_id = $id;
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
	}

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

						$this->data['stadium_category'] = $this->Stadium_Model->get_seat_stadium_category($stadium_id)->result();
						$this->data['getSeatCategory'] = $this->Stadium_Model->get_seat_category_main()->result();
						$html = $this->load->view(THEME.'game/stadium_color_category', $this->data,true);

						$stadium_category = $this->Stadium_Model->get_seat_stadium_category($stadium_id)->result();

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
					$stadium_category = $this->Stadium_Model->get_seat_stadium_category($stadium_id)->result();

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

					$this->data['stadium_category'] = $this->Stadium_Model->get_seat_stadium_category($stadium_id)->result();
					$this->data['getSeatCategory'] = $this->Stadium_Model->get_seat_category_main()->result();
					$html = $this->load->view(THEME.'stadium/stadium_color_category', $this->data,true);

					$stadium_category = $this->Stadium_Model->get_seat_stadium_category($stadium_id)->result();


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

				$this->data['stadium_category'] = $this->Stadium_Model->get_seat_stadium_category($stadium_id)->result();
				$this->data['getSeatCategory'] = $this->Stadium_Model->get_seat_category_main()->result();
				$html = $this->load->view(THEME.'stadium/stadium_color_category', $this->data,true);

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
				$this->data['stadium_category'] = $this->Stadium_Model->get_seat_stadium_category($stadium_id)->result();
				$this->data['getSeatCategory'] = $this->Stadium_Model->get_seat_category_main()->result();


				$html = $this->load->view(THEME.'stadium/stadium_color_category', $this->data,true);
				$response = array('msg' => 'Load Successfully', 'redirect_url' => '','html' => $html, 'status' => 1);
				echo json_encode($response);;
		}
		else{
			echo "invalid segment";
		}
	}



	public function save_stadium() {
		// echo "<pre>";
		// print_r($this->input->post());die;

		if ($this->input->post()) {
			if($this->input->post('satdiumId') == ""){

				$insertData =  array(
						'category'				=> $this->input->post('category'),
						'stadium_type'			=> 2,
						'stadium_name'			=> $this->input->post('stadium_name'),
						'stadium_name_ar'		=> $this->input->post('stadium_name_ar'),
						'search_keywords'		=> $this->input->post('search_keywords'),
						'stadium_variant'		=> $this->input->post('stadium_variant'),
						'country'				=> $this->input->post('stadium_country'),
						'city'					=> $this->input->post('stadium_city'),
						'status'				=> 1,
						'stadium_image'			=> 'uploads/stadium/maps/user-uploads/'.$this->input->post('stadium_image'),
						'create_date'			=> date("Y-m-d H:i:s"),

				);
	
				//print_r($_FILES["photo"]["name"]);

				// if($_FILES["photo"]["name"] != ""){
					

				// 	//C:\xampp\htdocs\liveadmin\uploads\stadium\maps\user-uploads

					
				// 	 $file_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
				// 	$file_name = $this->slugify($this->input->post('stadium_name')."-".time()).'.'. $file_ext;
					
				// 	$_FILES["file"]["name"] = $file_name ;
				// 	$_FILES["file"]["type"] = $_FILES["photo"]["type"];
				// 	$_FILES["file"]["tmp_name"] = $_FILES["pod_file"]["tmp_name"];
				// 	$_FILES["file"]["error"] = $_FILES["photo"]["error"];
				// 	$_FILES["file"]["size"] = $_FILES["photo"]["size"];
				// 	$config['file_name'] = $file_name;
				// 	$config["upload_path"] = 'uploads/stadium/maps/user-uploads/';
				// 	$config["allowed_types"] = '*';
				// 	$this->load->library('upload', $config);
				// 	$this->upload->initialize($config);


				// 	if ($this->upload->do_upload('photo')) {
				// 		$data = $this->upload->data();
				// 		$insertData['stadium_image'] = "uploads/stadium/maps/user-uploads/".$file_name;
				// 	}
				// 	else{
				// 		$error = ['error' => $this->upload->display_errors()];
				// 		//print_r($error);
				// 	}

				// }



				$id = $this->General_Model->insert_data('stadium', $insertData);

				$this->reset($id,$this->input->post('block_ids'));

				$response = array(
							'status' => 1,
							'msg' => "Inserted Successfully",
							'redirect_url' => base_url('stadium')
				);
				echo json_encode($response);die;	

			}
			else{
				$stadiumId = $this->input->post('satdiumId');
				$updateData =  array(
						'category'				=> $this->input->post('category'),
						'stadium_name'			=> $this->input->post('stadium_name'),
						'stadium_name_ar'		=> $this->input->post('stadium_name_ar'),
						'search_keywords'		=> $this->input->post('search_keywords'),
						'stadium_variant'		=> $this->input->post('stadium_variant'),
						'country'				=> $this->input->post('stadium_country'),
						'city'					=> $this->input->post('stadium_city'),

				);


				if($_FILES["photo"]["name"] != ""){
					//C:\xampp\htdocs\liveadmin\uploads\stadium\maps\user-uploads
					 $file_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
					$file_name = $this->slugify($_FILES["photo"]["name"]."-".time()).'.'. $file_ext;
					$_FILES["file"]["name"] = $file_name ;
					$_FILES["file"]["type"] = $_FILES["photo"]["type"];
					$_FILES["file"]["tmp_name"] = $_FILES["pod_file"]["tmp_name"];
					$_FILES["file"]["error"] = $_FILES["photo"]["error"];
					$_FILES["file"]["size"] = $_FILES["photo"]["size"];
					$config['file_name'] = $file_name;
					$config["upload_path"] = UPLOAD_PATH_PREFIX .'uploads/stadium/maps/user-uploads/';
					$config["allowed_types"] = '*';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('photo')) {
						$data = $this->upload->data();
						$updateData['stadium_image'] = "uploads/stadium/maps/user-uploads/".$file_name;
						$message = "(Note : Please Refresh)";
					}
					else{
						$error = ['error' => $this->upload->display_errors()];
						//print_r($error);
					}

				}


				$this->General_Model->update_table('stadium', 's_id', $stadiumId, $updateData);
				$response = array(
					'status' => 1,
					'msg' => "Updated Successfully   ".$message,
					'redirect_url' => base_url('stadium')
				);
				echo json_encode($response);die;	
			}

		}
		else{
			echo "no data";
		}

	} 



	public function reset_stadium() {

		if($this->input->post('stadiumId') && $this->input->post('block_ids' )){

			$this->reset($this->input->post('stadiumId'),$this->input->post('block_ids'));
		}
		

	}

	public function reset($stadiumId,$block_ids) {

		if ($stadiumId && $block_ids) {

			$delete = $this->General_Model->delete_data('stadium_color_category', 'stadium_id',$stadiumId );
			$delete = $this->General_Model->delete_data('stadium_details', 'stadium_id',$stadiumId );

			foreach ($block_ids as $key => $block_id) {
				$category = explode("_", $block_id);
				$category = str_replace("-", " ", $category[0]);
				$category = ucwords($category);
			
				//$row = $this->General_Model->getAllItemTable_array('stadium_seats_lang', array('seat_category' => $category,'language' =>'en'))->row();

				// if($row){
				// 		$catergory_row  = $this->General_Model->getAllItemTable_array('stadium_seats', array('id' => $row->stadium_seat_id))->row();
				// 		$category_id = $catergory_row->id;


				// }else{
				// 	$insertData  = array(
				// 				'seat_category'		=> $category,
				// 				'status'			=> 1,
				// 				'event_type'		=> 'match',
				// 				'source_type'		=> 'tixstock',
				// 	);
				// 	$category_id  = $this->General_Model->insert_data('stadium_seats', $insertData);

				// 	$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
				// 	foreach ($lang as $key => $l_code) {
				// 		$language_data = array(
				// 			'language' 			=> $l_code->language_code,
				// 			'stadium_seat_id' 	=> $category_id,
				// 			'seat_category'		=> $category
				// 		);
				// 		$this->General_Model->insert_data('stadium_seats_lang', $language_data);
				// 	}

				// }



				$insertStatdiumData = array();
				$insertStatdiumData['stadium_id'] = $stadiumId;
				$insertStatdiumData['full_block_name'] = $block_id;
				$insertStatdiumData['block_id'] =  $block_id ? end(explode("_", $block_id)) : "";
				$insertStatdiumData['block_color'] = 'rgba(0,0,0,1)';
				$this->General_Model->insert_data('stadium_details', $insertStatdiumData);


				// $row = $this->General_Model->getAllItemTable_array('stadium_color_category', array('category_id' => $category_id,'stadium_id' => $stadiumId))->row();

				// if(!$row){
				// 	$insertColorData = array(
				// 			'stadium_id' 	=> $stadiumId,
				// 			'category_id' 	=> $category_id,
				// 			'color_code' 	=> 'rgba(0,0,0,1)',
				// 	);
				// 	$this->General_Model->insert_data('stadium_color_category', $insertColorData);
				// }

			}
		}
		else{
			//echo "Stadium or block not found";
		}
			
	} 

		public function check_stadium() {
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

						header('location: ' . base_url() . 'stadium/add_stadium');
					} else {
						// print_r('uploads/stadium/maps/' . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"]))))); exit;
						if (@move_uploaded_file($_FILES["svg_file"]["tmp_name"], UPLOAD_PATH_PREFIX.'uploads/stadium/maps/user-uploads/' . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"])))))) {

							$mapsvg_notice = "The file " . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"])))) . " has been uploaded.";
							$svg_filename = UPLOAD_PATH . 'uploads/stadium/maps/user-uploads/' . basename(urldecode(strtolower(str_replace(' ', '-', $_FILES["svg_file"]["name"]))));
							header('location: ' . base_url() . 'stadium/add_stadium?map=' . $svg_filename);
						} else {

							$mapsvg_error = "An error occured during upload of your file. Please check that " . MAPSVG_MAPS_UPLOADS_DIR . " folder exists and it has full permissions (777).";
							header('location: ' . MAPSVG_ADMIN_URL . '?uploadError=1');
						}
					}
				} else {
					// $this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success', 'Stadium Name already Extist...!'));
					header('location: ' . admin_url() . 'add_stadium');
				}
			}
			//        }

			if (isset($_GET['action'])) {
				if (is_callable($_GET['action'])) {
					$data = isset($_GET['data']) ? $_GET['data'] : null;
					call_user_func($_GET['action'], $data);
				}
			}

		}
	


	function update_statdium_block()
	{
		$stadiumId = $this->input->post('stadiumid');
		$color = $this->input->post('color');
		$href = $this->input->post('href');
		$block_id = $this->input->post('block_id');
		$getStadiumDetailsByid = $this->General_Model->getAllItemTable_array('stadium_details', array('stadium_id' => $stadiumId, 'full_block_name' => $block_id))->row();

		if ($getStadiumDetailsByid) {

			$updateData_stddetail = array();
			$updateData_stddetail['category'] = $href;
			$updateData_stddetail['block_color'] = $color;
			$this->General_Model->update('stadium_details', array('stadium_id' => $stadiumId, 'full_block_name' => $block_id), $updateData_stddetail);
		} else {

			$insertStatdiumData = array();
			$insertStatdiumData['stadium_id'] = $stadiumId;
			$insertStatdiumData['full_block_name'] = $block_id;
			$insertStatdiumData['block_id'] =  $block_id ? end(explode("_", $block_id)) : "";
			$insertStatdiumData['block_color'] = $color;
			$insertStatdiumData['category'] = $href;
			$this->General_Model->insert_data('stadium_details', $insertStatdiumData);
		}
		 echo $this->db->last_query();
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


	public function upload_stadium() {
		
		if($_FILES["photo"]["name"] != ""){
			//C:\xampp\htdocs\liveadmin\uploads\stadium\maps\user-uploads
			 $file_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
			$file_name = $this->slugify($_FILES["photo"]["name"]."-".time()).'.'. $file_ext;
			$_FILES["file"]["name"] = $file_name ;
			$_FILES["file"]["type"] = $_FILES["photo"]["type"];
			$_FILES["file"]["tmp_name"] = $_FILES["pod_file"]["tmp_name"];
			$_FILES["file"]["error"] = $_FILES["photo"]["error"];
			$_FILES["file"]["size"] = $_FILES["photo"]["size"];
			$config['file_name'] = $file_name;
			$config["upload_path"] = UPLOAD_PATH_PREFIX.'uploads/stadium/maps/user-uploads/';
			$config["allowed_types"] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('photo')) {
				$data = $this->upload->data();
				$insertData['stadium_image'] = "uploads/stadium/maps/user-uploads/".$file_name;
			}
			else{
				$error = ['error' => $this->upload->display_errors()];
				//print_r($error);
			}

			redirect('stadium/add_stadium?map='.UPLOAD_PATH.'uploads/stadium/maps/user-uploads/'.$file_name);

		}


	}


	public function update_multiple_category()
	{
		$staduim_id = $this->input->post('staduim_id');
		$color_name = $this->input->post('color_name');
		$category = $this->input->post('category');
		$block_id = $this->input->post('block_id');
	
		if($category !=""  && $staduim_id !=""){	
			if($block_id){
				foreach ($block_id as $key => $value) {
					

					$updateData_stddetail = array(
						'full_block_name'	=> $value,
						'stadium_id' 		=> $staduim_id
					);
					$getStadiumDetailsByid = $this->General_Model->getAllItemTable_array('stadium_details', $updateData_stddetail)->row();

					if($getStadiumDetailsByid){
						$update_data = array(
							'category'			=> $category,
							'block_color' 		=> $color_name,
							);	

						$this->General_Model->update(
							'stadium_details', 
							array('stadium_id' => $staduim_id,'full_block_name' => $value), $update_data);
					}
					else{
						$updateData_stddetail = array(
							'category'			=> $category,
							'full_block_name'	=> $value,
							'block_id'			=> $value ? end(explode("_", $value)) : "" ,
							'block_color' 		=> $color_name,
							'stadium_id' 		=> $staduim_id
							);	
						$this->General_Model->insert_data(
							'stadium_details', $updateData_stddetail
						);

						
					}
					
					echo $this->db->last_query();
				}
			}
		}
		
	}
	public function ajax(){


		$postData  = $_POST;
		## Read value
		$draw = $postData['draw'];
		$rowno = $postData['start'];
		$row_per_page = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column'] ; // Column index
		//$order_column = $postData['columns'][$columnIndex]['data'] ; // Column name
		$order_column = "";
		$order_by = $postData['order'][0]['dir']; // asc or desc
		$search = $postData['search']['value']; // Search value
		$flag = $postData['flag'];
		$search_data[] = array();
		

		if($postData['stadium_ids'] !="") 
			$search_data['stadium_ids'] = explode(",", $postData['stadium_ids']) ;
	
		if(($postData['status'] !="")) 
			$search_data['status'] = explode(",", $postData['status']) ;

		if($postData['category']!="") 
		$search_data['category'] = explode(",", $postData['category']) ;
		

		$allcount = $this->Stadium_Model->get_stadium_by_limit('', '', '', '', $where_array, $search_data)->num_rows();
		$results = $this->Stadium_Model->get_stadium_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search_data)->result();


		//echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($results as $row ){

	        $match_count = $this->General_Model->getAllItemTable_Array('match_info', 
	             	array(
		             	'venue' => $row->s_id,
		             	'event_type' => 'match' ,
		             	'match_date >=' => date('Y-m-d H:i:s'),
		             	'status' => 1
		             )
         		 )
	             ->num_rows();
	        $match_text = $match_count > 0 ?  "<a href='javascript:void(0)' class='bttns' ><span class='badge badge-danger'>Matches (".$match_count.")</span></a>"  :"";

	        $checked = $row->status == 1 ? 'checked'  : "";

	        $status = '<div class="custom-control custom-switch">
               <input type="checkbox" class="custom-control-input stadium_status"   data-id="'.$row->s_id.'" id="customSwitch'.$row->s_id.'"  value="1"  name="is_active" '.$checked.' >
               <label class="custom-control-label" for="customSwitch'.$row->s_id.'"></label>
             </div>' ;

            $checked2 = $row->attendee_status == 1 ? 'checked'  : "";

	        $attendee_status = '<div class="custom-control custom-switch">
               <input type="checkbox" class="custom-control-input attendee_status" data-id="'.$row->s_id.'"  id="acustomSwitch'.$row->s_id.'"  value="1"  name="is_active" '.$checked2.' >
               <label class="custom-control-label" for="acustomSwitch'.$row->s_id.'"></label>
             </div>' ;


             $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';


            $stadium_url = base_url("stadium/edit_stadium/".$row->s_id); 


            $edit_content  .= '<a href="'.$stadium_url.'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Stadium Details</a>';

 	  		$edit_content  .= '<a id="branch_'.$row->s_id.'" href="javascript:void(0);" data-href="'.base_url().'stadium/delete_stadium/'.$row->s_id.'" class="dropdown-item delete_action"  onClick="delete_data('.$row->s_id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Remove from list</a>';

 	  		$edit_content .= "</div></div>";
 	  		$clone ="<span  data-id='".$row->s_id."' class='badge badge-warning clone_stadium' type='button'>Clone</span>";

	        $data[] = array( 
			    "id"						=> $row->s_id,
	            "staduim_name"				=> "<a href='".$stadium_url."'>".$row->stadium_name."</a>",
				"category_name"				=> $row->category_name,
	            "stadium_name_ar"			=> $row->stadium_name_ar,
	            "stadium_variant"			=> $row->stadium_variant,
	            "match_count"		      	=> $match_text,
	            "status"					=> $status,
	            "attendee_status"			=> $attendee_status,
	            "clone"						=> $clone,
	            "action"			    	=> $edit_content,

	        ); 
	     }

	     ## Response
	     $response = array(
	        "draw" => intval($draw),
	        "iTotalRecords" => $allcount,
	        "iTotalDisplayRecords" => $allcount,
	        "aaData" => $data
	     );

	     echo json_encode($response); 
	     die;
	
	}


	public static function slugify($text, string $divider = '-')
	{
	  // replace non letter or digits by divider
	  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, $divider);

	  // remove duplicate divider
	  $text = preg_replace('~-+~', $divider, $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  }

	  return $text;
	}
}