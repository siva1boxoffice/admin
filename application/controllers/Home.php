<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Home extends CI_Controller
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
		//print_r($this->data['app']);die;
	}

	public function private_notes()
	{
		$insert_data = array('private_note' => $_POST['notes'],'booking_id' => $_POST['order_id'],'seller_id' => $_POST['seller_id'],'user_id' => $_POST['user_id'],
		'created_date' =>date('Y-m-d h:i:s'));
		
		if ($this->General_Model->insert_data('seller_private_notes', $insert_data)) {
			$response = array('msg' => 'Private Notes Added Successfully.','status' => 1,);
		} else {
			$response = array('msg' => 'Failed to create Private Notes ', 'status' => 0);
		}

		echo json_encode($response);
		exit;
	}

	public function update_notes()
	{
		$updateData = array('private_note' => $_POST['notes'],'booking_id' => $_POST['order_id'],
		'created_date' =>date('Y-m-d h:i:s'));
		$cond = array('id' => $_POST['hidden_note_id'] );
		
		if ($this->General_Model->update('seller_private_notes', $cond, $updateData)) {
			$response = array('msg' => 'Private Notes Updated Successfully.','status' => 1,);
		} else {
			$response = array('msg' => 'Failed to Update Private Notes ', 'status' => 0);
		}

		echo json_encode($response);
		exit;

		//
		$newDob = date('Y-m-d', strtotime($_POST['dob']));

		$updateData = array('first_name' => $_POST['first_name'],'last_name' => $_POST['last_name'],'email' => $_POST['email'],'dob' => $newDob);
		
		$cond = array('id' => $_POST['cust_id'] );
	
		$this->General_Model->update('register', $cond, $updateData);
		$response = array('status' => 1, 'msg' => 'Personal Information Updated Successfully.');
		echo json_encode($response);
		exit;
		//
	}
	
	public function get_partner_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
		// if ($rowno != 0) {
        //     $rowno = ($rowno - 1) * $row_per_page;
        // }  
			if( !empty($_POST['customer_name']) || !empty($_POST['status_type'])  || !empty($_POST['country']) )
			{	

			

				if(isset($_POST['status_type']))
				{
					for ($i = 0; $i < count($_POST['status_type']); $i++) {
					if ($_POST['status_type'][$i] == 1) {
						$_POST['status_type'][$i] = "Active";
					} else {
						$_POST['status_type'][$i] = "Inactive";
					}
					}
				}

				// Check if the value is present in the $_POST array
				//$status_type = isset($_POST['status_type']) ?  implode("', '", $_POST['status_type']) : '';
				$country = isset($_POST['country']) ?  implode("', '", $_POST['country']) : '';


				$search['customer_name'] 	=		trim($_POST['customer_name']);				
				$search['status_type'] 		=		$_POST['status_type'];
				$search['country'] 			=		$country;
				

					// All records count
					$allcount =  $this->General_Model->get_user_details_by_limit('','',2,$search)->num_rows();
					// Get records
					$records = $this->General_Model->get_user_details_by_limit($rowno, $row_per_page,2,$search)->result();
					//echo $this->db->last_query();exit;
			}
			else
			{
						// All records count
						//get_user_details_by_limit
					$allcount =  $this->General_Model->get_user_details_by_limit('','',2,$search)->num_rows();
					// Get records
					$records = $this->General_Model->get_user_details_by_limit($rowno, $row_per_page,2,$search)->result();
			}



			$i=1;
			// echo '<pre/>';
			// print_r($records);
			// exit;
		foreach($records as $record ){		

			//$ip_status=($record->admin_status == '1') ? "Active" : "InActive";
				$badge=(trim(strtolower($record->admin_status)) == 'active') ? "success" : "danger";

				$formattedNumber = ($record->credit_limit !== '' && $record->credit_limit !== '0' && !empty($record->credit_limit)) ? number_format($record->credit_limit) : '';

				$credit=$formattedNumber." ".$record->credit_limit_currency;	

			$status						=		'<div class="bttns">
			<span class="badge badge-'.$badge.'">'.ucwords(strtolower($record->admin_status)).'</span>
			 </div>';

			 $edit_url= base_url()."home/users/add_user/1/".base64_encode(json_encode($record->admin_id));
			 $delete_data=base_url()."home/users/delete_user/".$record->admin_id;
			 $delete_url="javascript:void(0);";

			 $action='<div class="dropdown">
				<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
				<i class="mdi mdi-dots-vertical fs-sm"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
				<a href="'.base_url().'home/seller_info/'.$record->admin_id.'" class="dropdown-item">View</a>
				<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
				<a href="'.$delete_url.'" class="dropdown-item" id="branch_'.$record->admin_id.'" onclick="delete_data('.$record->admin_id.');" data-href="'.$delete_data.'">Delete </a>
				</div>
				</div>';

				$navigation='<a href='.base_url().'home/seller_info/'.$record->admin_id.'><i class="fas fa-angle-double-right"></i></a>';
				$city_name=$record->city_name;
				$country_name=$record->country_name;

				$location = !empty($city_name) ? (!empty($country_name) ? $city_name . ', ' . $country_name : $city_name) : (!empty($country_name) ? $country_name : '');

				if($record->admin_profile_pic!="")
				{
					$user_img=$record->admin_profile_pic;
				}
				else
				{
					$user_img="https://www.listmyticket.com/uploads/tournaments/4caf7af41262585edfd80fc74443df5f.png";
				}

				$seller_name='<a href="'.base_url()."home/seller_info/". $record->admin_id.'">'.$record->admin_name." ".$record->admin_last_name.'</a>';

			$data[] = array( 
                "i"							=> $i, 
				"user_image"=>'<div class="h-avatar is-small image-small">
				<img class="avatar" src="'.$user_img.'" alt="Lettstart Admin">
			</div>',
				"customer_name"				=> $seller_name, 		
				"email"						=> $record->admin_email, 	
				"location"					=> $location, 		
				"mobile"					=> "+".$record->phone_code." ".$record->admin_cell_phone, 	
				"role"						=> "Partner", 		
				"status"					=> $status, 	
				"credit"					=> $credit, 	
				"action"					=> $action,	
				
			);
			$i++;
			//"navigation"				=> $navigation,
	}

		$result = array(
            "draw" => $draw,
              "recordsTotal" => $allcount,
              "recordsFiltered" => $allcount,
              "data" => $data,
			  "customer_name_filterValue" =>$this->session->userdata('customer_name_filterValue'),
			  "status_type_filterValue"=>$this->session->userdata('status_type_filterValue'),
			  "country_filterValue"=>$this->session->userdata('country_filterValue')

         );


		echo json_encode($result);
		exit();
	}

	public function get_user_list()
	{

		
		$search=[];
		$url='add_user';
		if($_POST['role'] == "seller"){
			$role = 1;
			$search['role'] = 1;
			$url='create_user';
		}
		else if($_POST['role'] == "affiliate"){
			$search['role'] = 3;
			$role = 3;
		}
		else if($_POST['role'] == "partner"){
			$where_array['role'] = 2;
			$role = 2;
		}
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
		// if ($rowno != 0) {
        //     $rowno = ($rowno - 1) * $row_per_page;
        // }  
			if( !empty($_POST['customer_name']) || !empty($_POST['status_type'])  || !empty($_POST['country']) )
			{	

				if(isset($_POST['status_type']))
				{
					for ($i = 0; $i < count($_POST['status_type']); $i++) {
					if ($_POST['status_type'][$i] == 1) {
						$_POST['status_type'][$i] = "Active";
					} else {
						$_POST['status_type'][$i] = "Inactive";
					}
					}
				}

				// Check if the value is present in the $_POST array
				//$status_type = isset($_POST['status_type']) ?  implode("', '", $_POST['status_type']) : '';
				$country = isset($_POST['country']) ?  implode("', '", $_POST['country']) : '';


				$search['customer_name'] 	=		trim($_POST['customer_name']);				
				$search['status_type'] 		=		$_POST['status_type'];
				$search['country'] 			=		$country;

					// All records count
					$allcount =  $this->General_Model->get_user_details_by_limit('','',$role,$search)->num_rows();
					// Get records
					$records = $this->General_Model->get_user_details_by_limit($rowno, $row_per_page,$role,$search)->result();
			}
			else
			{
						// All records count
						//get_user_details_by_limit
					$allcount =  $this->General_Model->get_user_details_by_limit('','',$role,$search)->num_rows();
					// Get records
					$records = $this->General_Model->get_user_details_by_limit($rowno, $row_per_page,$role,$search)->result();
			}



			$i=1;
			// echo '<pre/>';
			// print_r($records);
			// exit;
		foreach($records as $record ){		

			//$ip_status=($record->admin_status == '1') ? "Active" : "InActive";
				$badge=(trim(strtolower($record->admin_status)) == 'active') ? "success" : "danger";

				$formattedNumber = ($record->credit_limit !== '' && $record->credit_limit !== '0' && !empty($record->credit_limit)) ? number_format($record->credit_limit) : '';

				$credit=$formattedNumber." ".$record->credit_limit_currency;	

			$status						=		'<div class="bttns">
			<span class="badge badge-'.$badge.'">'.ucwords(strtolower($record->admin_status)).'</span>
			 </div>';

			 $edit_url= base_url()."home/users/".$url."/1/".base64_encode(json_encode($record->admin_id));
			 $delete_data=base_url()."home/users/delete_user/".$record->admin_id;
			 $delete_url="javascript:void(0);";
			 if($_POST['role'] == 'seller'){
			 	$view_url = base_url().'home/seller_info/'.$record->admin_id;
			 }
			 else{
			 	$view_url = base_url()."home/users/".$url."/1/".base64_encode(json_encode($record->admin_id))	;
			 }

			 $action='<div class="dropdown">
				<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
				<i class="mdi mdi-dots-vertical fs-sm"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
				<a href="'.$view_url.'" class="dropdown-item">View</a>
				<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
				<a href="'.$delete_url.'" class="dropdown-item" id="branch_'.$record->admin_id.'" onclick="delete_data('.$record->admin_id.');" data-href="'.$delete_data.'">Delete </a>
				</div>
				</div>';

				$navigation='<a href='.base_url().'home/seller_info/'.$record->admin_id.'><i class="fas fa-angle-double-right"></i></a>';
				$city_name=$record->city_name;
				$country_name=$record->country_name;

				$location = !empty($city_name) ? (!empty($country_name) ? $city_name . ', ' . $country_name : $city_name) : (!empty($country_name) ? $country_name : '');

				if($record->admin_profile_pic!="")
				{
					$user_img=$record->admin_profile_pic;
				}
				else
				{
					$user_img="https://www.listmyticket.com/uploads/tournaments/4caf7af41262585edfd80fc74443df5f.png";
				}

				$role = 	$_POST['role'] ;
			if($role == "users"){
				$role =  '<div class="bttns">
					<span class="badge badge-success">'.ucfirst(strtolower($record->admin_role_name)).'</span>
			 </div> ';
			
			}
			else{
				$role =  '<div class="bttns">
					<span class="badge badge-success">'.ucfirst($_POST['role']).'</span>
			 </div> ';
			
			}
			$seller_url="add_user";
			if(ucfirst(strtolower($record->admin_role_name))=='Sellers')
			{
				$seller_url="create_user";
			}
			$users_img  ='<div class="h-avatar is-small image-small">
				<img class="avatar" src="'.$user_img.'" alt="">
			</div>';



			$seller_name='<a href="'.base_url()."home/users/".$seller_url."/1/".base64_encode(json_encode($record->admin_id)).'">'.$record->admin_name." ".$record->admin_last_name.'</a>';



			$data[] = array( 
                "i"							=> $i, 
				"user_image"				=> $users_img,
				"customer_name"				=> $seller_name, 		
				"email"						=> $record->admin_email, 	
				"location"					=> $location, 		
				"mobile"					=> "+".$record->phone_code." ".$record->admin_cell_phone, 	
				"role"						=> $role, 		
				"status"					=> $status, 	
				"credit"					=> $credit, 	
				"action"					=> $action,	
				
			);
			$i++;
			//"navigation"				=> $navigation,
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
		//echo "<pre>";print_r($this->session->userdata('storefront'));exit;
		//echo $this->session->userdata('storefront')->company_name;exit;
		if ($this->session->userdata('storefront')->company_name == '') {
				$branches = $this->General_Model->get_admin_details(13);
				//echo "<pre>";print_r($branches);exit;
				$sessionUserInfo = array('storefront' => $branches);
				$this->session->set_userdata($sessionUserInfo);
			/*$sessionUserInfo = array('storefront' => $this->data['branches'][count($this->data['branches']) - 1]);*/
		}
		return $this->data;
	}

	public function update_customer_data()
	{
			
		$newDob = date('Y-m-d', strtotime($_POST['dob']));

		$updateData = array('first_name' => $_POST['first_name'],'last_name' => $_POST['last_name'],'email' => $_POST['email'],'dob' => $newDob);
		
		$cond = array('id' => $_POST['cust_id'] );
	
		$this->General_Model->update('register', $cond, $updateData);
		$response = array('status' => 1, 'msg' => 'Personal Information Updated Successfully.');
		echo json_encode($response);
		exit;
	}
	public function update_customer_address_info()
	{

		$updateData = array('address' => $_POST['billing_address'],
							'mobile' => $_POST['billing_mobile'],
							'email' => $_POST['billing_email'],
							'code' => $_POST['billing_code'],
							'city' => $_POST['billing_city'],
							'country' => $_POST['billing_country'],
								);		
					// echo '<pre/>';
					// print_r($updateData);
					// exit;			
		$cond = array('id' => $_POST['cust_id'] );	
		$this->General_Model->update('register', $cond, $updateData);
		 
		$response = array('status' => 1, 'msg' => 'Address Information Updated Successfully.');
		echo json_encode($response);
		exit;
	}
	public function index()
	{
		// echo "<pre/>";
		// print_r($_SERVER);
		// exit;
		$this->db->select('
			match_info_lang.match_name,
			match_info_lang.meta_title, 
			match_info_lang.meta_description')
			->from('tournament')
			->join('match_info', 'match_info.tournament = tournament.t_id', 'left')
			->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')
			->where('tournament.t_id', 1);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			
		$this->data['getMySalesData'] = $this->General_Model->getOrderData_v1()->result();
		$this->data['orders'] = $this->General_Model->getOrders('','all')->num_rows();
		$this->data['confirmed_orders'] = $this->General_Model->getOrders('','confirmed_all')->num_rows();
		$this->data['confirmed_sales'] = $this->General_Model->confirmed_sales();
		$this->data['abondaned'] = $this->General_Model->abondaned()->num_rows();
		$this->data['listed_tickets'] = $this->General_Model->getListing_count();
		// echo '<pre/>';
		// print_r($this->data['getMySalesData']);
		// exit;
		$this->load->view(THEME.'/home', $this->data);
	}

	public function set_left_side_menu()
	{

		$menu_inpt = (strtolower($_POST['toggle_class']) === 'show') ? 'left-side-menu-condensed' : '';

		$setMenuInfo = array('set_menu' => $menu_inpt);
		$this->session->set_userdata($setMenuInfo);
		$response = array('status' => 1, 'msg' => 'Updated');
		echo json_encode($response);
		exit;

	}

	public function recent_orders()
	{
		$this->data['getMySalesData'] = $this->General_Model->getOrderData_v1()->result();
		$row_count = $this->uri->segment(3);
		$this->loadRecord($row_count, 'recent_orders', 'home/recent_orders', '', 'DESC', 'recent_orders', 'getMySalesData', 'recent_orders', $where_array);
		//$this->load->view('recent_orders', $this->data);
	}

	public function branch()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add_branch') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = json_decode(base64_decode($segment4));
				$this->data['branch'] = $this->General_Model->getAllItemTable('branches', 'branch_id', $edit_id, 'branch_id', 'DESC')->row();
			}
			$this->load->view('users/add_branch', $this->data);
		} else if ($segment == 'list_branch') {
			$this->data['branches'] = $this->General_Model->getAllItemTable('branches', '', '', 'branch_id', 'DESC')->result();
			$this->load->view('users/branch', $this->data);
		} else if ($segment == 'delete_branch') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('branches', 'branch_id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Branch data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting Branch data.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_branch') {
			$this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array('branch_name' => $_POST['branch_name'],);
				if ($_POST['status'] != '') {
					$insert_data['status'] = $_POST['status'];
				}
				$branch_id = $_POST['branch_id'];
				if ($branch_id == '') {
					if ($this->General_Model->insert_data('branches', $insert_data)) {
						$response = array('msg' => 'New Branch Created Successfully.', 'redirect_url' => base_url() . 'home/branch/list_branch', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to create new Branch.', 'redirect_url' => base_url() . 'home/branch/add_branch', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					if ($this->General_Model->update_table('branches', 'branch_id', $branch_id, $insert_data)) {
						$response = array('msg' => 'Branch details updated Successfully.', 'redirect_url' => base_url() . 'home/branch/list_branch', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Branch details.', 'redirect_url' => base_url() . 'home/branch/add_branch/' . $branch_id, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'home/branch/add_branch', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	public function profile()
	{


		$segment = $this->uri->segment(3);
		if ($segment == "bankaccounts") {
			$this->load->view('profile/bank_accounts', $this->data);
		}
		if ($segment == 'edit_profile') {
			$this->load->view('profile/edit_admin_profile', $this->data);
		}
		if ($segment == 'manage_profile') {
			$this->data['country_lists'] = $this->General_Model->fetch_country_list();
			$admin_id = $this->session->userdata('admin_id');
			$this->data['admin_profile_info'] = $this->General_Model->get_admin_details($admin_id);
			$this->data['flag'] = $this->uri->segment(4);
			$this->load->view('profile/manage_profile', $this->data);
		}
		if ($segment == 'update_profile') {
			$this->load->library('form_validation');
			if ($_POST['flag'] == 1) {
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('company_name', 'Company Name', 'required');
				$this->form_validation->set_rules('company_url', 'Company Website Url', 'required');
			}
			if ($_POST['flag'] == 2) {
				$this->form_validation->set_rules('address_details_id', 'Address Id', 'required');
				$this->form_validation->set_rules('country', 'Country', 'required');
				$this->form_validation->set_rules('state', 'State', 'required');
				$this->form_validation->set_rules('city', 'City', 'required');
				$this->form_validation->set_rules('zip_code', 'Postal Code', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
			}
			if ($_POST['flag'] == 3) {
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			}
			if ($_POST['flag'] == 4) {
				$this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'required');
				$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
				$this->form_validation->set_rules('iban_number', 'Iban Number', 'required');
				$this->form_validation->set_rules('beneficiary_address', 'Beneficiary Address', 'required');
				$this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
				$this->form_validation->set_rules('account_number', 'Account Number', 'required');
				$this->form_validation->set_rules('swift_code', 'Swift Code', 'required');
			}
			if ($this->form_validation->run() !== false) {
				if ($_POST['flag'] == 1) {
					if (isset($_FILES["profile_filepond"]["name"]) && $_FILES["profile_filepond"]["name"] != '') {
						$logo_image = explode(".", $_FILES["profile_filepond"]["name"]);
						$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
						$tmpnamert = $_FILES['profile_filepond']['tmp_name'];
						move_uploaded_file($tmpnamert, 'uploads/users/' . $newlogoname);
						$admin_profile_pic = base_url() . 'uploads/users/' . $newlogoname;
					} else {
						$admin_id = $this->session->userdata('admin_id');
						$admin_lists = $this->General_Model->get_admin_details($admin_id);
						$admin_profile_pic = $admin_lists->admin_profile_pic;
					}
					$update_information = array('admin_name' => $_POST['first_name'], 'admin_last_name' => $_POST['last_name'], 'company_name' => $_POST['company_name'], 'company_url' => $_POST['company_url']);
					$update_information['admin_profile_pic'] = $admin_profile_pic;
					if ($this->General_Model->update_admin_details($update_information, $this->session->userdata('admin_id'))) {
						$response = array('msg' => 'Admin details updated successfully.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update admin details.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
				if ($_POST['flag'] == 2) {
					$address_details_id = $_POST['address_details_id'];
					$address_information = array('country' => $_POST['country'], 'state' => $_POST['state'], 'city' => $_POST['city'], 'zip_code' => $_POST['zip_code'], 'address' => $_POST['address'],); // echo "<pre>";print_r($address_information);exit;
					if ($this->General_Model->update_admin_address($address_information, $address_details_id)) {
						$response = array('msg' => 'Address details updated successfully.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update admin address.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
				if ($_POST['flag'] == 3) {
					$new_password = $this->input->post('password');
					if ($this->General_Model->update_admin_password($new_password, $this->session->userdata('admin_id'))) {
						$response = array('msg' => 'Password updated successfully.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 1);
					} else {
						$response = array('msg' => 'Password updation Failed.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 0);
					}
				} else {
					$response = array('msg' => 'Invalid Old Password.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 0);
				}
				if ($_POST['flag'] == 4) {
					$bank_information = array('beneficiary_name' => $_POST['beneficiary_name'], 'bank_name' => $_POST['bank_name'], 'iban_number' => $_POST['iban_number'], 'beneficiary_address' => $_POST['beneficiary_address'], 'bank_address' => $_POST['bank_address'], 'account_number' => $_POST['account_number'], 'swift_code' => $_POST['swift_code'],);
					//  echo "<pre>";print_r($_POST);exit;
					if ($this->General_Model->update_table('admin_bank_details', 'admin_id', $this->session->userdata('admin_id'), $bank_information)) {
						$response = array('msg' => 'Bank details updated successfully.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Bank details.', 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 0);
					}
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'home/profile/manage_profile/' . $_POST['flag'], 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	public function myaccounts(){
		// echo '<pre>'; print_r();exit;
		// print_r($this->data['app'] ) ;die;
		$segment = $this->uri->segment(3);
		
			$admin_id = $this->session->userdata('admin_id');
			$this->data['user'] = $this->General_Model->get_admin_details($admin_id);
			$this->data['country_lists'] = $this->General_Model->fetch_country_list();
			$this->data['roles'] = $this->General_Model->getAllItemTable('admin_role', 'status', 'ACTIVE', 'admin_role_id', 'DESC')->result();
			$this->load->view('users/myaccount', $this->data);
		

	}

	public function save_my_accounts(){

				/*$new_password = $this->input->post('password');
							$cpassword = $this->input->post('cpassword');
				echo $new_password.'='.$cpassword;exit;	*/		
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
				$this->form_validation->set_rules('area_code', 'Area Code.', 'required');
				$this->form_validation->set_rules('company_name', 'Company Name', 'required');
				$this->form_validation->set_rules('company_url', 'Company Website Url', 'required');
		 		
		 		$this->form_validation->set_rules('country', 'Country', 'required');
				$this->form_validation->set_rules('state', 'State', 'required');
				$this->form_validation->set_rules('city', 'City', 'required');
				$this->form_validation->set_rules('zip_code', 'Zip Code', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_rules('currency', 'Currency', 'required');

				if($_POST['ignore_password_update'] != 1){
					$this->form_validation->set_rules('password', 'Password', 'required');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
				}
				

				$this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'required');
				$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
				$this->form_validation->set_rules('iban_number', 'Iban Number', 'required');
				$this->form_validation->set_rules('beneficiary_address', 'Beneficiary Address', 'required');
				$this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
				$this->form_validation->set_rules('account_number', 'Account Number', 'required');
				$this->form_validation->set_rules('swift_code', 'Swift Code', 'required');
			
			if ($this->form_validation->run() !== false) {

				$admin_id = $this->session->userdata('admin_id');

			$update_information = array('admin_name' => $_POST['first_name'], 'admin_last_name' => $_POST['last_name'], 'admin_email' => $_POST['email'],'phone_code' => $_POST['area_code'], 'admin_cell_phone' => $_POST['mobile_no'], 'company_name' => $_POST['company_name'], 'company_url' => $_POST['company_url'],'currency' => $_POST['currency']);
					$update_information['admin_profile_pic'] = '';
					
					if ($admin_id != '') {
						
						try{

							$this->General_Model->update_admin_details($update_information, $admin_id);
							$address_details_id = $_POST['address_details_id'];
							$address_information = array('country' => $_POST['country'], 'state' => $_POST['state'], 'city' => $_POST['city'], 'zip_code' => $_POST['zip_code'], 'address' => $_POST['address']);
							$this->General_Model->update_admin_address($address_information, $address_details_id);
							if($_POST['ignore_password_update'] != 1){
							$new_password = $this->input->post('password');
							$cpassword = $this->input->post('cpassword');
							if($new_password == $cpassword){

							$this->General_Model->update_admin_password($new_password, $admin_id);

							}
							}
							
							$bank_information = array('admin_id' => $admin_id, 'beneficiary_name' => $_POST['beneficiary_name'], 'bank_name' => $_POST['bank_name'], 'iban_number' => $_POST['iban_number'], 'beneficiary_address' => $_POST['beneficiary_address'], 'bank_address' => $_POST['bank_address'], 'account_number' => $_POST['account_number'], 'swift_code' => $_POST['swift_code'],);

							$this->General_Model->update_table('admin_bank_details', 'admin_id', $admin_id, $bank_information);

								$response = array('msg' => 'Success.Profile details updated Successfully.', 'redirect_url' => base_url() . 'home/myaccounts', 'status' => 1);


						} catch(Exception $e) {
							$response = array('msg' => 'Failed to update Profile details.', 'redirect_url' => base_url() . 'home/myaccounts', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					}

			}
			else { 
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'home/myaccounts', 'status' => 0);
			}
			echo json_encode($response);
			exit;
	}

	function alias_exist_check($value, $str)
{
$parts = explode('.', $str);
$this->db->from($parts[0]);
$this->db->where($parts[1], $value);
$result = $this->db->get();
if($parts[1] == 'admin_email'){
$error = "Email already in use.please choose different email id.";
}
else if($parts[1] == 'admin_cell_phone'){
$error = "Mobile number in use.please choose different Mobile No.";
}
//echo $this->db->last_query();

if($result->num_rows() > 0) {
$this->form_validation->set_message('alias_exist_check', $error);
return FALSE;
} else {
return TRUE;
}
}

	public function users()
	{

		$segment = $this->uri->segment(3);
		if($segment == 'create_user')
		{
			$this->data['flag'] = $this->uri->segment(4);
			$segment5 = $this->uri->segment(5);
			$admin_id = json_decode(base64_decode($segment5));
			$this->data['user'] = $this->General_Model->get_admin_details($admin_id);
			// echo '<pre/>';
			// print_r($this->data['user']);
			// exit;
		//	$this->data['country_lists'] = $this->General_Model->fetch_country_list();
			$this->data['countries']    = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['roles'] = $this->General_Model->getAllItemTable('admin_role', 'status', 'ACTIVE', 'admin_role_id', 'DESC')->result();
			$this->load->view(THEME.'users/create_user', $this->data);
		}
		if ($segment == 'add_user') {
			$this->data['flag'] = $this->uri->segment(4);
			$segment5 = $this->uri->segment(5);
			$admin_id = json_decode(base64_decode($segment5));
			$this->data['user'] = $this->General_Model->get_admin_details($admin_id);
		//	$this->data['country_lists'] = $this->General_Model->fetch_country_list();
			$this->data['country_lists'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['roles'] = $this->General_Model->getAllItemTable('admin_role', 'status', 'ACTIVE', 'admin_role_id', 'DESC')->result();
			$this->data['currencies'] =  $this->General_Model->getAllItemTable_Array('currency_types', array('status' => 1,'store_id' => $this->session->userdata('storefront')->admin_id))->result();
			$this->load->view(THEME.'users/add_user', $this->data);
		}
		
		else if ($segment == 'delete_user') {
			$segment4 = $this->uri->segment(4);
			$delete = $this->General_Model->delete_multiple_data($segment4);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'User data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting User data.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_user') {
			
			if ($_POST['flag'] == 1) {
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				if($_POST['admin_id'] == ""){
					$this->form_validation->set_rules('email', 'Email', 'required|callback_alias_exist_check[admin_details.admin_email]');
				//$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required|callback_alias_exist_check[admin_details.admin_cell_phone]');
					$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
				}
				else{
					$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
				}
				
				/*$this->form_validation->set_rules('company_name', 'Company Name', 'required');
				$this->form_validation->set_rules('company_url', 'Company Website Url', 'required');*/
				$this->form_validation->set_rules('role', 'Role', 'required');
			} else if ($_POST['flag'] == 2) {
				//echo "<pre>";print_r($_POST);exit;
				$this->form_validation->set_rules('country', 'Country', 'required');
				// $this->form_validation->set_rules('state', 'State', 'required');
				$this->form_validation->set_rules('city', 'City', 'required');
				$this->form_validation->set_rules('zip_code', 'Zip Code', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
			} else if ($_POST['flag'] == 3) {
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			} else if ($_POST['flag'] == 4) {
				$this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'required');
				$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
				$this->form_validation->set_rules('iban_number', 'Iban Number', 'required');
				$this->form_validation->set_rules('beneficiary_address', 'Beneficiary Address', 'required');
				$this->form_validation->set_rules('bank_address', 'Bank Address', 'required');
				$this->form_validation->set_rules('account_number', 'Account Number', 'required');
				$this->form_validation->set_rules('swift_code', 'Swift Code', 'required');
				$this->form_validation->set_rules('currency', 'Currency', 'required');
			}
			if ($this->form_validation->run() !== false) {
				if ($_POST['flag'] == 1) {
					if (isset($_FILES["profile_filepond"]["name"]) && $_FILES["profile_filepond"]["name"] != '') {
						$logo_image = explode(".", $_FILES["profile_filepond"]["name"]);
						$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
						$tmpnamert = $_FILES['profile_filepond']['tmp_name'];
						move_uploaded_file($tmpnamert, 'uploads/users/' . $newlogoname);
						$admin_profile_pic = base_url() . 'uploads/users/' . $newlogoname;
					} else {
						$admin_lists = $this->General_Model->get_admin_details($_POST['admin_id']);
						$admin_profile_pic = $admin_lists->admin_profile_pic;
					}
					$update_information = array('admin_name' => $_POST['first_name'], 'admin_last_name' => $_POST['last_name'], 'admin_email' => $_POST['email'], 'admin_cell_phone' => $_POST['mobile_no'], 'company_name' => $_POST['company_name'], 'company_url' => $_POST['company_url']);
					$update_information['admin_profile_pic'] = $admin_profile_pic;
					$other_event = '0';
					if($_POST['otherevent'] == 1){
					$other_event = '1';
					}
					$update_information['other_event'] = $other_event;
					$admin_id = $_POST['admin_id'];
					if ($admin_id != '') {
						//echo 'admin_id = '.$admin_id;echo "<pre>";print_r($update_information);exit;
						if ($_POST['role'] != '') {
							$update_role = array('admin_roles_id' => $_POST['role'],);
							if ($this->General_Model->update_table('admin_role_details', 'admin_id', $admin_id, $update_role)) {
								$role_flag = 1;
							}
						} 
						if ($this->General_Model->update_admin_details($update_information, $admin_id) || $role_flag == 1) {
							
							
							$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

							$response = array('msg' => 'user details updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($admin_id)), 'status' => 1);
						} else {
							$seg = $this->uri->segment(3);
							$create_user = ($seg == 'create_user') ? 'create_user' : 'add_user';

						$response = array('msg' => 'Failed to update user details.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($admin_id)), 'status' => 0);
						}
					} else {
						$admin_newid = $this->General_Model->insert_data('admin_details', $update_information);
						if ($admin_newid != '') {
							$role_information = array('admin_id' => $admin_newid, 'admin_roles_id' => $_POST['role'],);
							$role_id = $this->General_Model->insert_data('admin_role_details', $role_information);
							$address_information = array('country' => $_POST['country'], 'state' => $_POST['state'], 'city' => $_POST['city'], 'zip_code' => $_POST['zip_code'], 'address' => $_POST['address'],);
							$address_id = $this->General_Model->insert_data('address_details', $address_information);
							if ($address_id != '') {
								$update_information = array('address_details_id' => $address_id);
								if ($this->General_Model->update_admin_details($update_information, $admin_newid)) {
									$login_information = array('admin_id' => $admin_newid, 'admin_type_id' => $_POST['role'], 'admin_user_name' => $_POST['email'],);
									$login_id = $this->General_Model->insert_data('admin_login_details', $login_information);
									if ($login_id != '') {
										$bank_information = array('admin_id' => $admin_newid, 'beneficiary_name' => $_POST['beneficiary_name'], 'bank_name' => $_POST['bank_name'], 'iban_number' => $_POST['iban_number'], 'beneficiary_address' => $_POST['beneficiary_address'], 'bank_address' => $_POST['bank_address'], 'account_number' => $_POST['account_number'], 'swift_code' => $_POST['swift_code'],);
										$bank_id = $this->General_Model->insert_data('admin_bank_details', $bank_information);
										if ($bank_id != '') {

											$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

											$response = array('msg' => 'New user details created successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($admin_newid)), 'status' => 1);
										}
									} else {
										$response = array('msg' => 'Failed to Create User details.', 'redirect_url' => base_url() . 'home/users/add_user/1', 'status' => 1);
									}
								}
							} else {
								$response = array('msg' => 'Failed to Create User details.', 'redirect_url' => base_url() . 'home/users/add_user/1', 'status' => 1);
							}
						} else {
							$response = array('msg' => 'Failed to Create User details.', 'redirect_url' => base_url() . 'home/users/add_user/1', 'status' => 1);
						}
					}
					echo json_encode($response);
					exit;
				}
				if ($_POST['flag'] == 2) {
					$address_details_id = $_POST['address_details_id'];
					$address_information = array('country' => $_POST['country'], 'state' => $_POST['state'], 'city' => $_POST['city'], 'zip_code' => $_POST['zip_code'], 'address' => $_POST['address'],); // echo "<pre>";print_r($address_information);exit;
					$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

					if ($this->General_Model->update_admin_address($address_information, $address_details_id)) {
						$response = array('msg' => 'Address details updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update admin address.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
				if ($_POST['flag'] == 3) {
					
					$new_password = $this->input->post('password');
					if ($this->General_Model->update_admin_password($new_password, $_POST['admin_id'])) {
						$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

						$response = array('msg' => 'Password updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 1);
					} else {
						$response = array('msg' => 'Password updation Failed.', 'redirect_url' => base_url() . 'home/users/add_user/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
					}
				}
				if ($_POST['flag'] == 4) {
					$bank_information = array('beneficiary_name' => $_POST['beneficiary_name'], 'bank_name' => $_POST['bank_name'], 'iban_number' => $_POST['iban_number'], 'beneficiary_address' => $_POST['beneficiary_address'], 'bank_address' => $_POST['bank_address'], 'account_number' => $_POST['account_number'], 'swift_code' => $_POST['swift_code'],'currency' => $_POST['currency']);
					//  echo "<pre>";print_r($_POST);exit;

					$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

					if ($this->General_Model->update_table('admin_bank_details', 'admin_id', $_POST['admin_id'], $bank_information)) {
						$response = array('msg' => 'Bank details updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Bank details.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
					}
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'home/users/add_user/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
		else if($segment == 'save_seller_user')
		{
			if ($_POST['flag'] == 1) {
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				if($_POST['admin_id'] == ""){
					$this->form_validation->set_rules('email', 'Email', 'required|callback_alias_exist_check[admin_details.admin_email]');
				//$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required|callback_alias_exist_check[admin_details.admin_cell_phone]'); |regex_match[/^[0-9]{10}$/]s
				$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
					
				}
				else{
					$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
				}
				
				$this->form_validation->set_rules('company_name', 'Company Name', 'required');
				$this->form_validation->set_rules('company_url', 'Company Website Url', 'required');
				$this->form_validation->set_rules('dob', 'Date of Birth', 'required');

				//$this->form_validation->set_rules('role', 'Role', 'required');
			} else if ($_POST['flag'] == 2) {
				//echo "<pre>";print_r($_POST);exit;
				$this->form_validation->set_rules('country', 'Country', 'required');
				$this->form_validation->set_rules('city', 'City', 'required');
				$this->form_validation->set_rules('zip_code', 'Zip Code', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
			} else if ($_POST['flag'] == 3) {
			
				$this->form_validation->set_rules('user_name', 'Login User Name', 'trim|required|valid_email');
				if($_POST['admin_id'] == ""){
					$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_alias_exist_check[admin_login_details.email_id]');	
				}

				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
			} else if ($_POST['flag'] == 4) {
				$this->form_validation->set_rules('currency', 'Seller currency', 'required');
				$this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'required');
				$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
				$this->form_validation->set_rules('account_number', 'Account Number', 'required');
				$this->form_validation->set_rules('iban_number', 'Iban Number', 'required');
				$this->form_validation->set_rules('swift_code', 'Swift Code', 'required');
				$this->form_validation->set_rules('sort_code', 'Sort Code', 'required');
				

				// $this->form_validation->set_rules('beneficiary_address', 'Beneficiary Address', 'required');
				// $this->form_validation->set_rules('bank_address', 'Bank Address', 'required');				
				
			}
			if ($this->form_validation->run() !== false) {				

				if ($_POST['flag'] == 1) {
					if (isset($_FILES["profile_filepond"]["name"]) && $_FILES["profile_filepond"]["name"] != '') {
						$logo_image = explode(".", $_FILES["profile_filepond"]["name"]);
						$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
						$tmpnamert = $_FILES['profile_filepond']['tmp_name'];
						move_uploaded_file($tmpnamert, 'uploads/users/' . $newlogoname);
						$admin_profile_pic = base_url() . 'uploads/users/' . $newlogoname;
					} else {
						$admin_lists = $this->General_Model->get_admin_details($_POST['admin_id']);
						$admin_profile_pic = $admin_lists->admin_profile_pic;
					}

						$datetime = DateTime::createFromFormat('d-m-Y', $_POST['dob']);
						$_POST['dob'] = $datetime->format('Y-m-d');

					$update_information = array('admin_name' => $_POST['first_name'], 'admin_last_name' => $_POST['last_name'], 'admin_email' => $_POST['email'], 'admin_cell_phone' => $_POST['mobile_no'], 'company_name' => $_POST['company_name'], 'company_url' => $_POST['company_url'], 'dob' => $_POST['dob']);
					
					$update_information['admin_profile_pic'] = $admin_profile_pic;
					$other_event = '0';
					if($_POST['otherevent'] == 1){
					$other_event = '1';
					}
					$update_information['other_event'] = $other_event;
					$admin_id = $_POST['admin_id'];
					if ($admin_id != '') {
						//echo 'admin_id = '.$admin_id;echo "<pre>";print_r($update_information);exit;
						if ($_POST['role'] != '') {
							$update_role = array('admin_roles_id' => $_POST['role'],);
							if ($this->General_Model->update_table('admin_role_details', 'admin_id', $admin_id, $update_role)) {
								$role_flag = 1;
							}
						} 
						$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

						if ($this->General_Model->isEmailDuplicate($_POST['email'], $_POST['admin_id'])) {
							// Duplicate email found, show an error message
							$data['error_message'] = 'This email address is already in use by another user.';
							$response = array('msg' => 'This email address is already in use by another user.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($admin_id)), 'status' => 0);
							echo json_encode($response);
							exit;
						}
						if ($this->General_Model->update_admin_details($update_information, $admin_id) || $role_flag == 1) {
							
							
						

							$response = array('msg' => 'user details updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($admin_id)), 'status' => 1);
						} else {
							$seg = $this->uri->segment(3);
							$create_user = ($seg == 'create_user') ? 'create_user' : 'add_user';

						$response = array('msg' => 'Failed to update user details.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($admin_id)), 'status' => 0);
						}
					} else {
						$admin_newid = $this->General_Model->insert_data('admin_details', $update_information);
						if ($admin_newid != '') {
							$role_information = array('admin_id' => $admin_newid, 'admin_roles_id' => $_POST['role'],);
							$role_id = $this->General_Model->insert_data('admin_role_details', $role_information);
							$address_information = array('country' => $_POST['country'], 'state' => $_POST['state'], 'city' => $_POST['city'], 'zip_code' => $_POST['zip_code'], 'address' => $_POST['address'],);
							$address_id = $this->General_Model->insert_data('address_details', $address_information);
							if ($address_id != '') {
								$update_information = array('address_details_id' => $address_id);
								if ($this->General_Model->update_admin_details($update_information, $admin_newid)) {
									$login_information = array('admin_id' => $admin_newid, 'admin_type_id' => $_POST['role'], 'admin_user_name' => $_POST['email'],);					
									$login_id = $this->General_Model->insert_data('admin_login_details', $login_information);
									if ($login_id != '') {
										$bank_information = array('admin_id' => $admin_newid, 'beneficiary_name' => $_POST['beneficiary_name'], 'bank_name' => $_POST['bank_name'], 'iban_number' => $_POST['iban_number'], 'beneficiary_address' => $_POST['beneficiary_address'], 'bank_address' => $_POST['bank_address'], 'account_number' => $_POST['account_number'], 'swift_code' => $_POST['swift_code'],'currency' => $_POST['currency']);
										$bank_id = $this->General_Model->insert_data('admin_bank_details', $bank_information);
										if ($bank_id != '') {

											$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

											$response = array('msg' => 'New user details created successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($admin_newid)), 'status' => 1);
										}
									} else {
										$response = array('msg' => 'Failed to Create User details.', 'redirect_url' => base_url() . 'home/users/add_user/1', 'status' => 1);
									}
								}
							} else {
								$response = array('msg' => 'Failed to Create User details.', 'redirect_url' => base_url() . 'home/users/add_user/1', 'status' => 1);
							}
						} else {
							$response = array('msg' => 'Failed to Create User details.', 'redirect_url' => base_url() . 'home/users/add_user/1', 'status' => 1);
						}
					}
					echo json_encode($response);
					exit;
				}
				if ($_POST['flag'] == 2) {

					if (isset($_FILES["profile_filepond"]["name"]) && $_FILES["profile_filepond"]["name"] != '') {
						
						$logo_image = explode(".", $_FILES["profile_filepond"]["name"]);
						$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
						$tmpnamert = $_FILES['profile_filepond']['tmp_name'];
						move_uploaded_file($tmpnamert, 'uploads/users/' . $newlogoname);
						$admin_profile_pic = base_url() . 'uploads/users/' . $newlogoname;
						
						$update_information['admin_profile_pic'] = $admin_profile_pic;
						$this->General_Model->update_admin_details($update_information, $_POST['admin_id']);
						}
			
						
					$address_details_id = $_POST['address_details_id'];
					//'state' => $_POST['state'],
					$address_information = array('country' => $_POST['country'],  'city' => $_POST['city'], 'zip_code' => $_POST['zip_code'], 'address' => $_POST['address'],); // echo "<pre>";print_r($address_information);exit;
					$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';
		if ($this->General_Model->update_admin_address($address_information, $address_details_id)) {
						$response = array('msg' => 'Address details updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 1);
					} else {
						//print_r($this->db->last_query());exit;
						$response = array('msg' => 'Failed to update admin address.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
				if ($_POST['flag'] == 3) {

					if (isset($_FILES["profile_filepond"]["name"]) && $_FILES["profile_filepond"]["name"] != '') {
						
						$logo_image = explode(".", $_FILES["profile_filepond"]["name"]);
						$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
						$tmpnamert = $_FILES['profile_filepond']['tmp_name'];
						move_uploaded_file($tmpnamert, 'uploads/users/' . $newlogoname);
						$admin_profile_pic = base_url() . 'uploads/users/' . $newlogoname;
						
						$update_information['admin_profile_pic'] = $admin_profile_pic;
						$this->General_Model->update_admin_details($update_information, $_POST['admin_id']);
						}

					$new_password = $this->input->post('password');
					$update_password['password'] = $new_password;
					$update_password['email_id'] = $_POST['user_email'];
					$update_password['user_name'] = $_POST['user_name'];

					$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';
					if ($this->General_Model->isadminEmailDuplicate($_POST['user_email'], $_POST['admin_id'])) {
						// Duplicate email found, show an error message
						$data['error_message'] = 'This email address is already in use by another user.';
						$response = array('msg' => 'This email address is already in use by another user.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
						echo json_encode($response);
						exit;
					}

					if ($this->General_Model->update_seller_password($update_password, $_POST['admin_id'])) {
						$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

						$response = array('msg' => 'Password updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 1);
					} else {
						$response = array('msg' => 'Password updation Failed.', 'redirect_url' => base_url() . 'home/users/add_user/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
					}
				}
				if ($_POST['flag'] == 4) {

					if (isset($_FILES["profile_filepond"]["name"]) && $_FILES["profile_filepond"]["name"] != '') {
						
						$logo_image = explode(".", $_FILES["profile_filepond"]["name"]);
						$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
						$tmpnamert = $_FILES['profile_filepond']['tmp_name'];
						move_uploaded_file($tmpnamert, 'uploads/users/' . $newlogoname);
						$admin_profile_pic = base_url() . 'uploads/users/' . $newlogoname;
						
						$update_information['admin_profile_pic'] = $admin_profile_pic;
						$this->General_Model->update_admin_details($update_information, $_POST['admin_id']);
						}
					//'beneficiary_address' => $_POST['beneficiary_address'], 'bank_address' => $_POST['bank_address'], 
					$bank_information = array('beneficiary_name' => $_POST['beneficiary_name'], 'bank_name' => $_POST['bank_name'], 'iban_number' => $_POST['iban_number'], 'account_number' => $_POST['account_number'], 'swift_code' => $_POST['swift_code'], 'sort_code' => $_POST['sort_code'],'currency' => $_POST['currency']);					
					//  echo "<pre>";print_r($_POST);exit;

					$create_user = isset($_POST['create_seller']) && $_POST['create_seller'] == '1' ? 'create_user' : 'add_user';

					if ($this->General_Model->update_table('admin_bank_details', 'admin_id', $_POST['admin_id'], $bank_information)) {
						$response = array('msg' => 'Bank details updated successfully.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Bank details.', 'redirect_url' => base_url() . 'home/users/'.$create_user.'/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
					}
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'home/users/add_user/' . $_POST['flag'] . '/' . base64_encode(json_encode($_POST['admin_id'])), 'status' => 0);
			}
			echo json_encode($response);
			exit;

		} 
		else if ($segment == 'users') {

			$this->data['users'] = $this->General_Model->get_user_details()->result();
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, ' ', 'home/users/users', 'id', 'DESC', 'users/user_list', 'users', 'users', '');

			$this->load->view(THEME.'users/user_list', $this->data);
		}
		else if ($segment == 'seller') {

			$this->data['users'] = $this->General_Model->get_user_details(1)->result();
			$row_count = $this->uri->segment(4);
		//	$this->loadRecord($row_count, ' ', 'home/users/seller', 'id', 'DESC', 'users/seller', 'users', 'seller', '');

				$country = "";
			$records = $this->General_Model->get_country_name()->result();
			
			foreach($records as $record ){
				$country .=   ' <div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="country'.$record->id.'">
				<label class="custom-control-label" for="country'.$record->id.'">'.ucfirst($record->name).'</label>
			</div>';

			}


			$this->data['country'] = $country;
			$this->load->view(THEME.'users/user_list', $this->data);
		}

		else if ($segment == 'partner') {

		//	$this->data['users'] = $this->General_Model->get_user_details(2)->result();
			// $this->data['seller_name'] = $this->General_Model->get_user_details_name(2)->result();		
			// $this->load->view(THEME.'users/seller', $this->data);


			$this->data['users'] = $this->General_Model->get_user_details(2)->result();
			$row_count = $this->uri->segment(4);
			$country = "";
			$records = $this->General_Model->get_country_name()->result();
			
			foreach($records as $record ){
				$country .=   ' <div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="country'.$record->id.'">
				<label class="custom-control-label" for="country'.$record->id.'">'.ucfirst($record->name).'</label>
			</div>';

			}

			$customer_name_filterValue = $this->session->userdata('customer_name_filterValue');
			$status_type_filterValue = $this->session->userdata('status_type_filterValue');
			$country_filterValue = $this->session->userdata('country_filterValue');

			$this->data['customer_name_filterValue'] = $customer_name_filterValue;
			$this->data['status_type_filterValue'] = $status_type_filterValue;
			$this->data['country_filterValue'] = $country_filterValue;

			$this->data['country'] = $country;
			$this->load->view(THEME.'users/user_list', $this->data);
		}

		else if ($segment == 'affiliate') {

			$this->data['users'] = $this->General_Model->get_user_details(3)->result();
			//echo $this->db->last_query();
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, ' ', 'home/users/seller', 'id', 'DESC', 'users/seller', 'users', 'affiliate', '');
			$this->load->view(THEME.'users/user_list', $this->data);
		}

		 else if ($segment == 'user_permissions') {
			$this->data['roles'] = $this->General_Model->getAllItemTable('admin_role', 'status', 'ACTIVE', 'admin_role_id', 'ASC')->result();
			$this->data['privilege_functions'] = $this->General_Model->get_privilege_functions();
			$active_function_id = $this->General_Model->get_privilege_active_functions();
			$function_ids = array();
			foreach ($active_function_id as $value) {
				$function_ids[$value["privilege_id"]][] = $value["privilege_functions_id"];
			}
			$this->data['active_functions'] = $function_ids;
			$this->load->view(THEME.'users/user_permissions', $this->data);
			exit;
		} else if ($segment == 'save_permission') {
			$this->data = array();
			// for($i = 0;$i <= count($_POST['privilege']);$i++){
			$i = 0; //echo "<pre>";print_r($_POST['privilege']);exit;
			foreach ($_POST['privilege'] as $pkey => $pvalue) {
				$j = 0;
				foreach ($pvalue as $key => $value) {
					$this->data[$i]["privilege_id"] = $pkey;
					$this->data[$i]["privilege_functions_id"] = $value;
					$j++;
					$i++;
				}
			}
			$response = $this->General_Model->activate_functions($this->data);
			if ($response) {
				$messge = array('msg' => 'User Permissions Updated successfully.', 'redirect_url' => base_url() . 'home/users/user_permissions', 'status' => 1);
			} else {
				$messge = array('msg' => 'Failed to update User Permissions.', 'redirect_url' => base_url() . 'home/users/user_permissions',);
			}
			echo json_encode($messge);
			exit;
		} else if ($segment == 'user_roles') {

			$this->data['roles'] = $this->General_Model->get_user_roles();
			$this->load->view(THEME.'users/user_roles', $this->data);
		}
	}
	public function get_login_report_list()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( !empty($_POST['country'])  ) 
		{
			$search['id']=$_POST['country'];
			$records = $this->General_Model->get_limit_based_data('admin_login_tracking_details ', $rowno, $row_per_page, 'id', 'asc',$search)->result();
			$allcount = $this->General_Model->get_limit_based_data('admin_login_tracking_details ', '','', 'id', 'asc',$search)->num_rows();

		}
		else
		{

			$where_array = array('admin_id', $this->session->userdata('admin_id'));
			$allcount = $this->General_Model->get_table_row_count('admin_login_tracking_details', '');

			// Get records
			$records = $this->General_Model->get_limit_based_data('admin_login_tracking_details', $rowno, $row_per_page, '', '', $where_array)->result();

			// $records = $this->General_Model->get_limit_based_data('admin_login_tracking_details ', $rowno, $row_per_page, 'id', 'asc')->result();
			// $allcount = $this->General_Model->get_limit_based_data('admin_login_tracking_details ', '','', 'id', 'asc')->num_rows();
		}
	// echo $this->db->last_query();exit;
	
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
		
			$dateFormatted = date("d F Y", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->login_tracking_details_time_stamp)));

			$timeFormatted = date("H:i:s", strtotime(time_zone_calc(@$_COOKIE["client_time_zone"], $record->login_tracking_details_time_stamp)));

			$gmtFormatted = @$_COOKIE["time_zone"];

			$time= $dateFormatted . "<br>".$timeFormatted . " " . $gmtFormatted;


			$data[] = array( 
                "login_track_details_ip"					=> 		$record->login_track_details_ip, 
				"login_track_details_system_info"			=> 		$record->login_track_details_system_info, 
				"attempt"									=> 		$record->attempt, 
				"login_track_status_info"					=> 		$record->login_track_status_info, 
				"time"										=> 		$time, 
			
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
	public function get_seller_list()
	{
		$search=[];
		$order_column="";
		$order_by='';
		$row_per_page = 50;	
		$draw = intval($this->input->get("draw"));
		
		$rowno = $_POST['start'];
		if ($rowno != '' && $rowno != 0) {
		$rowno = ($rowno - 1) ;
		}
		else{
			$rowno = 0;			
		}
		
		if (!empty(trim($_POST['teams_ids'])) || isset($_POST['status']))
		{			

			$search['teams_ids']=$_POST['teams_ids'];
			$search['status']=$_POST['status'];
			$allcount = $this->General_Model->get_user_details_new(2)->num_rows();
			$records = $this->General_Model->get_user_details_new(2)->result();
		}
		else
		{
			//
			$allcount = $this->General_Model->get_user_details_new(2)->num_rows();
			$records = $this->General_Model->get_user_details_new(2)->result();

		}
		
		$data = [];
		foreach($records as $record ){

			$data[] = array( 
				"selle_id"					=> 	$record->admin_id,
				"seller_name"				=>	$record->admin_name." ".$record->admin_last_name."<br/><span class='chmp_league'>".$record->company_name."</span>",
				"email"						=> 	$record->admin_email,				
				"phone"						=>	$record->admin_cell_phone,
				"status"					=>	ucwords(strtolower($record->admin_status)),
				"bank"						=>	'<a href="#"  data-toggle="modal" data-target="#centermodal_add" class="dropdown-item view_bank_details" data-cust-id="'.$record->admin_id.'" >View Bank Details </a>',
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

//	echo $this->db->last_query();exit;
	}

	public function get_admin_bank_details()
	{
		$records = $this->General_Model->get_bank_details($_POST['sellerId'])->result();
		if(count($records)>0)
		{
			
		$response = [
			'beneficiary_name' 					=> ucwords(strtolower($records[0]->beneficiary_name)),		
			'bank_name' 						=> ucwords(strtolower($records[0]->bank_name)),
			'iban_number'						=>$records[0]->iban_number,
			'beneficiary_address'				=> $records[0]->beneficiary_address,
			'bank_address' 						=> $records[0]->bank_address,
			'account_number' 					=> $records[0]->account_number,
			'swift_code' 						=> $records[0]->swift_code
		];
		
		}

		// Send the JSON response back to the client
		//$this->output->set_content_type('application/json')->set_output(json_encode($response));
		 echo json_encode($response);
   exit();
	}
	public function seller_info()
	{
		$segment = $this->uri->segment(3);
		$this->data['documents'] = $this->General_Model->get_document_info($segment)->row();
		$this->data['seller_sales_data'] = $this->General_Model->get_confirmed_orders('', '','', '', $segment,'','seller_id')->result();
		$this->data['seller_sales_data_count'] = $this->General_Model->get_confirmed_orders('', '','', '', $segment,'no_limit','seller_id')->result();
		
		
		$this->load->model('Accounts_Model');
		$this->data['payout_histories']    = $this->Accounts_Model->admin_payout_histories('',$segment);		
		$this->data['seller_profile_info'] = $this->General_Model->get_seller_details($segment);
		$this->data['notify_orders_seller'] = $this->General_Model->getOrderData_v1('notify',$segment,'seller_id')->result();
		$this->data['seller_id'] = $segment;
		$this->data['seller_private_notes'] = $this->General_Model->seller_private_notes($segment,'seller_id');

		$this->data['all_orders'] = $this->General_Model->getOrderData_seller($segment)->result();

		$this->data['fulfilment_data'] = $this->General_Model->get_fulfilment($segment);
		
		// echo '<pre/>';
		// print_r($this->data['fulfilment'] );		
		// //print_r($this->data['notify_orders_seller']);
		// exit;

		
		
		$this->load->view(THEME.'users/seller_info',$this->data);
	}

	public function update_seller_documents()
	{	
		if($_POST['document_type'] == "contract"){
			$updateData = array('contract_status' => $_POST['status']);
			$cond = array('seller_id' => $_POST['seller_id'] );
		}
		else if($_POST['document_type'] == "photo"){
			$updateData = array('photo_status' => $_POST['status']);
			$cond = array('seller_id' => $_POST['seller_id'] );
		}
		else if($_POST['document_type'] == "address"){
			$updateData = array('address_status' => $_POST['status']);
			$cond = array('seller_id' => $_POST['seller_id'] );
		}
		else{
			exit;
		}
		
		
		if ($this->General_Model->update('seller_documents', $cond, $updateData)) {
			$response = array('msg' => 'Document Status Updated Successfully.','status' => 1,);
		} else {
			$response = array('msg' => 'Failed to Update Document Status ', 'status' => 0);
		}

		echo json_encode($response);
		exit;

		
	}

	public function update_seller_documents_single()
	{
			//echo "<pre>";print_r($_FILES);exit;
		if($_POST['seller_id'] != "" && $_POST['document_type'] != "" && $_FILES["file"]["name"] != ""){
		
		$seller_id = $_POST['seller_id'];

		$document_data = $this->General_Model->getAllItemTable('seller_documents', 'seller_id', $seller_id, 'seller_id', 'DESC')->row();
		if($document_data->seller_id == ""){
			$insert_data['seller_id'] = $seller_id;
			$this->General_Model->insert_data('seller_documents', $insert_data);

		}

		
		$image = time().'-'.$_FILES["file"]['name'];

		if (!empty($_FILES['file']['name'])) {
					$config['file_name']   = $image;
					$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/seller_documents';
					$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|pdf';
					//echo $config['upload_path'];exit;
					//$config['max_size'] = '10000';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('file')) {


						// handle the upload success

						$data=$this->upload->data();
						$instruction_file_name = $data["file_name"];

						if($_POST['document_type'] == "contract"){
						$updateData = array('contract_document' => $instruction_file_name,'contract_status' => 1);
						}
						else if($_POST['document_type'] == "photo"){
						$updateData = array('photo_document' => $instruction_file_name,'photo_status' => 1);
						}
						else if($_POST['document_type'] == "address"){
						$updateData = array('address_document' => $instruction_file_name,'address_status' => 1);

						}
						else{
						exit;
						}

						$admin_profile_pic = base_url() . 'uploads/seller_documents/' . $instruction_file_name;

						$done = $this->General_Model->update_table('seller_documents', 'seller_id', $seller_id, $updateData);

						$response = array(
						"status" => 1,
						"msg" => "Document updated Successfully."
						);




					} else { //echo $this->upload->display_errors();exit;
								$response = array(
		              		"status" => 0,
		              		"msg" => $this->upload->display_errors()
		         		);
					}
				}
		  }
		  else{
		  	$response = array(
              		"status" => 0,
              		"msg" => "Oops.Invalid Seller Information."
         		);
		  }

		  echo json_encode($response);
		  exit;
	}

	public function search_payouts()
    {
		$row_per_page = 100;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
		$segment = $_POST['seller_id'];
		$ticket_amount_cur_type="";$op_seller_ticket_amount="";
	
        if (!empty($_POST['fromDate']) || !empty($_POST['toDate']) || !empty($_POST['checkboxValues']) || !empty($_POST['event_name']) ) {
                        $search['fromDate'] 				=		trim($_POST['fromDate']);
						$search['toDate'] 		            = 		trim($_POST['toDate']);
						$search['checkboxValues'] 			= 		$_POST['checkboxValues'];
						$search['event_name']				= 		trim($_POST['event_name']);
                        $search['seller_id']				= 		trim($_POST['seller_id']);
						// echo '<pre/>';
						// print_r($search);
						// exit;
                        
                        $records           =       $this->General_Model->getOrderData_seller_search($search)->result();
						$allcount           =       $this->General_Model->getOrderData_seller_search($search)->num_rows();
                       
						
        }
					else
					{
						$records 			= $this->General_Model->getOrderData_seller($segment)->result();
						$allcount           = $this->General_Model->getOrderData_seller($segment)->num_rows();
					}

			// echo '<pre/>';
			// print_r($records);
			// exit;		
			foreach($records as $record ){
				$bg_id=' <div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes checkbox_input" data-id='.number_format($record->ticket_amount,2).' data-bg-id='.$record->bg_id.'><label class="form-check-label">&nbsp;</label></div>';
				//$booking_no="#".$record->booking_no;
				//$match_name=
				// $match_name_inpt=$record->match_name;
				// $match_name_array = explode(" Vs ", $match_name_inpt);
				// $match_name=$match_name_array[0]." vs <br/>".$match_name_array[1];
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

				$buyer=ucfirst($record->first_name).$record->last_name;

				if($record->ticket_type == 1) $ticket_type = "Season cards";
				else if($record->ticket_type == 2) $ticket_type = "E-Tickets";
				else if($record->ticket_type == 3) $ticket_type = "Paper";
				else if($record->ticket_type == 4) $ticket_type = "Mobile";
				else $ticket_type = "";
				
				$quantity=$record->quantity;


				if ($this->session->userdata('role') == 1) { 
				 if (strtoupper($record->currency_type) == "GBP") { 
						    $cur_type='£ '.number_format($record->ticket_amount,2);
						   $inpt_cur_type='£ ';
								 } 
					 if (strtoupper($record->currency_type) == "EUR") { 
						    $cur_type='€ '.number_format($record->ticket_amount,2);
						   $inpt_cur_type='€ ';
					 } 
				  
				 } 
				   if ($this->session->userdata('role') != 1) { 
					 if (strtoupper($record->currency_type) == "GBP") { 
					    $cur_type='£ '.number_format($record->ticket_amount,2);
					   $inpt_cur_type='£ ';
								} 
					 if (strtoupper($record->currency_type) == "EUR") { 
					    $cur_type='€ '.number_format($record->ticket_amount,2);
					   $inpt_cur_type='€ ';
					 } 
				 }

				 

				' <div class="bttns">'.	
				 $admin_status = "";
				 if ($record->seller_status == 0) {
				   $admin_status .= '
					 <div class="bttns">
					   <span class="badge badge-info">Processing</span>
					 </div>';
				 } else if ($record->seller_status == 1) {
				   $admin_status .= '
					 <div class="bttns">
					   <span class="badge badge-success">Completed</span>
					 </div>';
				 } else if ($record->seller_status == 2) {
				   $admin_status .= '
					 <div class="bttns">
					   <span class="badge badge-danger">Issue</span>
					 </div>';
				 } else if ($record->seller_status == 3) {
				   $admin_status .= '
					 <div class="bttns">
					   <span class="badge badge-success">Get Paid</span>
					 </div>';
				 } '</div>';


				    
				 $seller_ticket_amount []= $record->ticket_amount;
				 $ticket_amount_cur_type=$inpt_cur_type;


				 $booking_no='<a href="'.base_url()."game/orders/details/". md5($record->booking_no).'">#'.$record->booking_no.'</a>';
				$data[] = array( 					
					"bg_id"					=> $bg_id, 
					"booking_no"			=> $booking_no, 
					"match_name"			=> $match_name, 
					"buyer"					=> $buyer, 
					"ticket_type"			=> $ticket_type, 
					"quantity"				=> $quantity, 
					"cur_type"				=> $cur_type, 
					"admin_status"			=> $admin_status,   
					
				); 
			}

			if(!empty($seller_ticket_amount))
			{
				$op_seller_ticket_amount=rtrim(number_format(array_sum($seller_ticket_amount), 2), '.0');
			}
			$result = array(
				"draw" => $draw,
				"recordsTotal" => $allcount,
				"recordsFiltered" => $allcount,
				"data" => $data,
				"seller_ticket_amount" =>$op_seller_ticket_amount,
				"ticket_amount_cur_type" =>$ticket_amount_cur_type,
			);


			echo json_encode($result);
			exit();

    }

	public function customer_info()
	{
		//error_reporting(E_ALL);
		
		$segment = $this->uri->segment(3);
		$search['customer_id']=$segment;
		$this->data['customer_data'] = $this->General_Model->get_customer_data($search,'','','')->result();
		

		$this->data['notify_orders_seller'] = $this->General_Model->getOrderData_v1('notify',$segment,'user_id')->result();

		//print_r($this->data['pending_payout'] );
		
		$this->data['customer_data_orders'] =$this->General_Model->getOrders('','',$segment,'','','user_id')->result();
	
		$this->data['customer_data_count'] =$this->General_Model->getOrders('','',$segment,'','','user_id')->num_rows();

		$this->data['customer_sales_data_count'] = $this->General_Model->get_confirmed_orders('', '','', '', $segment,'no_limit','user_id')->result();

		$this->data['user_id'] = $segment;

		$this->data['customer_private_notes'] = $this->General_Model->seller_private_notes($segment,'user_id');

		//$this->db->where('booking_global.'.$seller_or_user, $seller_id);

		// $this->data['getsubscription'] = $this->General_Model->get_subscribed_users($this->data['customer_data'][0]->email )->num_rows();

		if( $this->General_Model->get_subscribed_users($this->data['customer_data'][0]->email )->num_rows()==0)
		{
			$this->data['getsubscription'] ="Not Subscribed";
		}
		else
		{	
			$this->data['getsubscription'] ="Newsletter";
		}
		
		$this->data['fulfilment_data'] = $this->General_Model->get_fulfilment($segment);

		// echo '<pre/>';
		// print_r($this->data['customer_data']);
		// exit;


		$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
		// echo '<pre/>';
		// print_r($this->data['customer_data']);
		// echo $segment;
		// exit;

		$this->load->view(THEME.'users/customer_info',$this->data);
	}
	public function master()
	{
		$segment = $this->uri->segment(3);
		if ($segment == 'get_state') {
			if ($_POST['country_id'] != '') {
				$this->mydata['states'] = $this->General_Model->getAllItemTable('states', 'country_id', $_POST['country_id'], 'id', 'DESC')->result();
				echo json_encode($this->mydata);
				exit;
			}
		} else if ($segment == 'get_city') {
			if ($_POST['state_id'] != '') {

				$this->mydata['cities'] = $this->General_Model->getAllItemTable('cities', 'state_id', $_POST['state_id'], 'id', 'DESC')->result();
				echo json_encode($this->mydata);
				exit;
			}
		} else if ($segment == 'set_language') {
			if ($_POST['language_code'] != '') {
				$sessionLanguageInfo = array('language_code' => $_POST['language_code']);
				$this->session->unset_userdata('language_code');
				$this->session->set_userdata($sessionLanguageInfo);
				$response = array('status' => 1, 'msg' => 'Language set Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 0, 'msg' => 'Language set failed.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'set_storefront') {

			if ($_POST['admin_id'] != '') {
				$branches = $this->General_Model->get_admin_details($_POST['admin_id']);

				
				$sessionUserInfo = array('storefront' => $branches);
				$this->session->unset_userdata('storefront');
				$this->session->set_userdata($sessionUserInfo);
				$response = array('status' => 1, 'msg' => 'Storefront Switched Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 0, 'msg' => 'Failed to Switch Storefront.');
				echo json_encode($response);
				exit;
			}
		}
	}

	// $this->loadRecord($row_count, ' ', 'home/users/users', 'id', 'DESC', 'users/user_list', 'users', $type);

	/**
	 * Fetch data and display based on the pagination request
	 */
	public function loadRecord($rowno = 0, $table, $url, $order_column, $order_by, $view, $variable_name, $type, $where_array)
	{

		// Load Pagination library
		$this->load->library('pagination');

		// Row per page
		$row_per_page = 10;

		// Row position
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}
		if ($type == 'users') {
			// All records count
			$allcount =  $this->General_Model->get_user_details()->num_rows();

			// Get records
			$record = $this->General_Model->get_user_details_by_limit($rowno, $row_per_page)->result();
		}
		else if ($type == 'seller') {
			// All records count
			$allcount =  $this->General_Model->get_user_details(1)->num_rows();

			// Get records
			$record = $this->General_Model->get_user_details_by_limit($rowno, $row_per_page,1)->result();
		}

		else if ($type == 'partner') {
			// All records count
			$allcount =  $this->General_Model->get_user_details(2)->num_rows();

			// Get records
			$record = $this->General_Model->get_user_details_by_limit($rowno, $row_per_page,2)->result();
		}
		else if ($type == 'recent_orders') {
			// All records count
			$allcount =  $this->General_Model->getOrderData_v2()->num_rows();

			// Get records
			$record = $this->General_Model->getOrderData_v2_limit($rowno, $row_per_page,1)->result();
		}
		else {
			// All records count
			$allcount = $this->General_Model->get_table_row_count($table, '');

			// Get records
			$record = $this->General_Model->get_limit_based_data($table, $rowno, $row_per_page, $order_column, $order_by, $where_array)->result();
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
		$this->data['row'] = $rowno;

		// Load view
		$this->load->view($view, $this->data);
	}

	/**
	 * @desc Function used to display admin user login reports
	 */
	public function login_report()
	{

		$where_array = array('admin_id', $this->session->userdata('admin_id'));
		//$this->loadRecord(0, 'admin_login_tracking_details', 'home/login_report', 'admin_login_tracking_details_id', 'DESC', 'profile/login_report', 'login_details', ' ', $where_array);
		$this->load->view(THEME.'profile/login_report', $this->data);

	}

	function geo_ip_settings()
	{
		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();

			$geoSettings = $this->General_Model->get_general_settings($this->session->userdata('storefront')->admin_id, '', 'GE')->result();
			if (isset($geoSettings)) {
				$mysettings = array();
				foreach ($geoSettings as $skey => $setting) {
					$mysettings[$setting->site_name] = $setting->site_value;
				}
			}
			$this->data['geoSettings'] = $mysettings;
			$this->load->view('settings/geo_ip_settings/geo_ip_settings', $this->data);
		} else if ($segment == 'save') {

			$this->form_validation->set_rules('ctype', 'Selection', 'required');
			if ($this->form_validation->run() !== false) {
				$admin_id  = $this->session->userdata('storefront')->admin_id;
				$country_ids = $this->input->post('gcountry');
				$county_ids = '';
				foreach ($country_ids as $val) {
					$county_ids .= $val;
					$county_ids .= ',';
				}
				$county_ids = rtrim($county_ids, ',');

				$insert_data = array(
					'COUNTRY_IDS' => $county_ids,
					'COUNTRY_SELECTION_TYPE' => $_POST['ctype'],
				);
				$datainset = array();
				foreach ($insert_data as $ikey => $idata) {
					$datainset[] = array('site_name' => $ikey, 'site_value' => $idata, 'store_id' => $admin_id, 'site_code' => 'GE', 'add_by' => $this->session->userdata('admin_id'));
				}

				if ($this->General_Model->update_site_settings($datainset, 'GE', $admin_id)) {
					$response = array('msg' => 'GEO IP Settings updated Successfully.', 'redirect_url' => base_url() . 'home/geo_ip_settings/add', 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update GEO IP Settings.', 'redirect_url' => base_url() . 'home/geo_ip_settings/add', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'home/geo_ip_settings/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	public function change_currency_type()
	{
		$msg = 'Currency updated successfully.';									
		$updateData['currency'] = $_POST['currency'];
		$updateData['admin_updation_date_time'] = date("Y-m-d h:i:s");
		if($this->General_Model->update_table('admin_details', 'admin_id', $_POST['user_id'], $updateData))
			$response = array('status' => 1, 'msg' => $msg);
		else
		$response = array('status' => 0, 'msg' => "Failed to update Currency");

		echo json_encode($response);
		exit;
	}
	public function save_signed_contract()
	{
			//echo "<pre>";print_r($_POST);exit;
		$config["upload_path"] = 'uploads/signed_contract';
		$config['allowed_types'] = 'pdf|jpeg|jpg|png';
		$config['max_size'] = 2048;
		$msg = 'Nothing Updated';
		$user_id=$_POST['user_id'];
		$response = array('status' => 1, 'msg' => $msg);
		$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		$_FILES["file"]["name"] = "Seller_signed_contract_".$user_id.'.'.$file_ext ; //."_".$_FILES["eticket"]["name"]

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
			
			$data=$this->upload->data();
			$instruction_file_name = $data["file_name"];

			$this->db->where(array('admin_id' => $user_id));
					$query = $this->db->get('admin_details');
					$resultTest = $query->row();
					// echo $this->db->last_query();
					// exit;
					if (!empty($resultTest)) {		
						$msg = 'Signed Contract file updated successfully.';									
						$updateData['signed_contract'] = $instruction_file_name;
						$updateData['admin_updation_date_time'] = date("Y-m-d h:i:s");
						$done = $this->General_Model->update_table('admin_details', 'admin_id', $resultTest->admin_id, $updateData);
					// 	echo $this->db->last_query();
					// exit;
						$response = array('status' => 1, 'msg' => $msg);
					}
		  }

		  echo json_encode($response);
		  exit;
	}

	public function save_user_profile_img()
	{
			//echo "<pre>";print_r($_FILES);exit;
		$config["upload_path"] = 'uploads/users';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size'] = 2048;
		$msg = 'Nothing Updated';
		$user_id=$_POST['user_id'];
		$response = array('status' => 1, 'msg' => $msg);
		$file_ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

		//////////////////////
		$logo_image = explode(".", $_FILES["file"]["name"]);
		$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
		$_FILES["file"]["name"] = $newlogoname;
		/////////////////////
		
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
			
			$data=$this->upload->data();
			$instruction_file_name = $data["file_name"];
			$admin_profile_pic = base_url() . 'uploads/users/' . $instruction_file_name;

			$this->db->where(array('admin_id' => $user_id));
					$query = $this->db->get('admin_details');
					$resultTest = $query->row();
					if (!empty($resultTest)) {		
						$msg = 'Profile Image Updated Successfully.';									
						$updateData['admin_profile_pic'] = $admin_profile_pic;
						$updateData['admin_updation_date_time'] = date("Y-m-d h:i:s");
						$done = $this->General_Model->update_table('admin_details', 'admin_id', $resultTest->admin_id, $updateData);
					// 	echo $this->db->last_query();
					// exit;
						$response = array('status' => 1, 'msg' => $msg);
					}
		  }

		  echo json_encode($response);
		  exit;
	}
	public function add_credit_limit()
	{
		////////////
		$updateData = array('credit_limit' => $_POST['credit_limit'],'credit_limit_currency' => $_POST['selectedValue']);
		$cond = array('admin_id' => $_POST['user_id'] );
		
		if ($this->General_Model->update('admin_details', $cond, $updateData)) {
			$response = array('msg' => 'Credit Limit Updated Successfully.','status' => 1,);
		} else {
			$response = array('msg' => 'Failed to Update Credit Limit ', 'status' => 0);
		}

		echo json_encode($response);
		exit;
		////////////

	}

	public function seller_request( )
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

		$this->load->view(THEME.'/users/seller_request', $this->data);
	}

	public function get_seller_request()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

		if( !empty($_POST['event']) || !empty($_POST['seller_name']) )
		{				
			$search['event_name'] = !empty($_POST['event']) ? $_POST['event'] : '';
			$search['seller_name'] = !empty($_POST['seller_name']) ? $_POST['seller_name'] : '';
			$allcount = $this->General_Model->get_seller_request($search,$row_per_page,$rowno,'sre.id','DESC')->num_rows();
			$records = $this->General_Model->get_seller_request($search,$row_per_page,$rowno,'sre.id','DESC')->result();
		}
		else
		{
			$allcount = $this->General_Model->get_seller_request($search,$row_per_page,$rowno,'sre.id','DESC')->num_rows();
			$records = $this->General_Model->get_seller_request($search,$row_per_page,$rowno,'sre.id','DESC')->result();
		}

		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){	
			$seller_name='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->admin_name." ".$record->admin_last_name.'</a>';	

			$input = $record->event_name;
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
					
			$input = $record->event_date;
			$event_date ="<center>---</center>";
			$dateTime = DateTime::createFromFormat('Y-m-d', $input);	
			if($record->date_time_creation!='0000-00-00')
			{
				$event_date = $dateTime ? date('d F Y', strtotime($input))  : "";
			}				

			$data[] = array( 
                "seller_name"					=> $seller_name	,
				"match_name"					=> $match_name,				
				"stadium"						=> $record->event_location,	
				"match_date"					=> $event_date
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

	public function get_currency()
	{
		$id = $_POST['id'];
		$currency = $_POST['currency'];
		$records = $this->General_Model->get_seller_bank_details($id, $currency)->result();

		$data = array(
			'beneficiaryName' => '',
			'bankName' => '',
			'accountNumber' => '',
			'swiftCode' => '',
			'iban' => '',
			'address' => '',
		);

		foreach ($records as $record) {
			$data = array(
				'beneficiaryName' => $record->beneficiary_name,
				'bankName' => $record->bank_name,
				'accountNumber' => $record->account_number,
				'swiftCode' => $record->swift_code,
				'iban' => $record->iban_number,
				'address' => $record->bank_address
			);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function save_user_currency_info()
	{
		// ini_set('display_errors', 1);
		// 	ini_set('display_startup_errors', 1);
		// 	error_reporting(E_ALL);
			$this->form_validation->set_rules('input_benef_name', 'Beneficiary Name', 'required');
			$this->form_validation->set_rules('input_bank_name', 'Bank Name', 'required');
			$this->form_validation->set_rules('input_iban', 'Iban Number', 'required');
			$this->form_validation->set_rules('input_address', 'Address', 'required');
			$this->form_validation->set_rules('input_acc_no', 'Account Number', 'required');
			$this->form_validation->set_rules('input_s_code', 'Swift Code', 'required');

			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'beneficiary_name' => $_POST['input_benef_name'],
					'bank_name' => $_POST['input_bank_name'],
					'iban_number' => $_POST['input_iban'],
					'bank_address' => $_POST['input_address'],
					'account_number' => $_POST['input_acc_no'],
					'swift_code' => $_POST['input_s_code'],
					'currency' => $_POST['inpt_currency']	,
					'admin_id' => $_POST['inpt_seller_id']										
				);

				$sellerId = $_POST['inpt_seller_id'];
				$currency = $_POST['inpt_currency'];

				$sellerBankDetails = $this->General_Model->get_seller_bank_details($sellerId, $currency);
				$allcount = $sellerBankDetails->num_rows();
				$record = $sellerBankDetails->result();

				
				if ($allcount == 0) {
					$inserted_id = $this->General_Model->insert_data('admin_bank_details', $insert_data);
					//$query = $this->db->last_query();
				
					if ($inserted_id) {
						$response = array('msg' => 'New Bank details successfully.', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to Create New Bank details.',  'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
			$id = $record[0]->bank_id;
					
					if ($this->General_Model->update_table('admin_bank_details', 'bank_id', $id, $insert_data)) {
						$response = array('msg' => 'Bank details updated Successfully.', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Bank details.',  'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'status' => 0);
			}
			echo json_encode($response);
			exit;
	}

}
