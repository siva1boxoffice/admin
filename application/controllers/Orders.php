<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Orders extends CI_Controller
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
		$this->load->model("Order_Model");
		$this->app_name = $this->Order_Model->get_type_name_by_id('general_settings', '1', 'settings_value');
		$this->app_login_image = $this->Order_Model->get_type_name_by_id('general_settings', '13', 'settings_value');
		$this->app_title = $this->Order_Model->get_type_name_by_id('general_settings', '2', 'settings_value');
		$this->general_path = $this->Order_Model->get_type_name_by_id('general_settings', '16', 'settings_value');
		$this->app_favicon = $this->Order_Model->get_type_name_by_id('general_settings', '15', 'settings_value');
		$this->login_image = $this->Order_Model->get_type_name_by_id('general_settings', '13', 'settings_value');
		$this->logo = $this->Order_Model->get_type_name_by_id('general_settings', '17', 'settings_value');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->data = array();
		$this->data['app'] = $this->app_data();
		//print_r($this->data['app']);die;
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

		$this->data['languages'] = $this->Order_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
		$this->data['branches'] = $this->Order_Model->get_admin_details_by_role(4,'ACTIVE');
		//echo "<pre>";print_r($this->session->userdata('storefront'));exit;
		//echo $this->session->userdata('storefront')->company_name;exit;
		if ($this->session->userdata('storefront')->company_name == '') {
				$branches = $this->Order_Model->get_admin_details(13);
				//echo "<pre>";print_r($branches);exit;
				$sessionUserInfo = array('storefront' => $branches);
				$this->session->set_userdata($sessionUserInfo);
			/*$sessionUserInfo = array('storefront' => $this->data['branches'][count($this->data['branches']) - 1]);*/
		}
		return $this->data;
	}

	public function index(){ 

		$ticket_types 				= $this->Order_Model->get_ticket_type_data('', 'ACTIVE')->result();
		$this->data['ticket_notes'] = $this->Order_Model->get_ticket_details_data('', 'ACTIVE')->result();
		$this->data['matches'] 		= $this->Order_Model->getallMatch();
		$this->data['ticket_types'] = $ticket_types;
		$this->data['sellers'] 		= $this->Order_Model->get_sellers();
		$this->data['branches'] = $this->Order_Model->get_admin_details_by_role(4);
		$this->data['customers'] = $this->Order_Model->get_customer_data()->result();
		$this->data['split_types'] = $this->Order_Model->get_split_type_data('', 'ACTIVE')->result();
		$this->data['restriction_left'] = $this->Order_Model->get_ticket_details_data('', 'ACTIVE',1,1)->result();
		//echo "<pre>";print_r($this->data['restriction_left']);exit;
		$this->data['restriction_right'] = $this->Order_Model->get_ticket_details_data('', 'ACTIVE',1,2)->result();
		$this->data['notes_left'] = $this->Order_Model->get_ticket_details_data('', 'ACTIVE',2,1)->result();
		$this->data['notes_right'] = $this->Order_Model->get_ticket_details_data('', 'ACTIVE',2,2)->result();
		$this->data['split_details_left'] = $this->Order_Model->get_ticket_details_data('', 'ACTIVE',3,1)->result();//echo "<pre>";print_r($this->data['restriction_left']);exit;
		$this->data['split_details_right'] = $this->Order_Model->get_ticket_details_data('', 'ACTIVE',3,2)->result();
		$this->load->view(THEME_NAME.'/orders/create_order', $this->data);
	}

	public function list_order(){  
		$html="";
		$records = $this->General_Model->get_seller_name()->result();
            foreach($records as $record ){

               $seller_name = $record->seller_first_name." ".$record->seller_last_name;

                $html .=   ' <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck'.$record->seller_id.'">
                <label class="custom-control-label" for="customCheck'.$record->seller_id.'">'.$seller_name.'</label>
              </div>';

            }

         $this->data['seller_html'] = $html;


		 $searchText = "";

	$checkboxData = array('0'=>'Tickets	Not Uploaded','1'=>'Tickets	In-Review','2'=>'Tickets Approved','3'=>'Tickets Rejected','4'=>'Tickets Downloaded','5'=>'Tickets Shipped','6'=>'Tickets Delivered');
	
	$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
	$matches = preg_grep($pattern, $checkboxData);
	
	$shipping_status = "";
	
	foreach($matches as $key=>$value ){

		$shipping_status .=   '<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" id="shipping_status'.$key.'">
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
		<input type="checkbox" class="custom-control-input" id="order_status'.$key.'">
		<label class="custom-control-label" for="order_status'.$key.'">'.ucwords($value).'</label>
	  </div>'.'';

	}

	$this->data['order_status'] = $order_status; 

	$seller_status_checkboxData = array('processing'=>'Processing','completed'=>'Completed','getpaid'=>'Get Paid','issue'=>'Issue');
	$seller_status = '';
	foreach($seller_status_checkboxData as $key=>$value ){

		$seller_status .=   '<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" id="seller_status'.$key.'">
		<label class="custom-control-label" for="seller_status'.$key.'">'.ucwords($value).'</label>
	  </div>'.'';

	}

	$this->data['seller_status'] = $seller_status; 
	
		$this->load->view(THEME.'/orders/list_order', $this->data);
	}
	public function list_order_v1(){ 
		$this->load->view(THEME.'/orders/list_order_v1', $this->data);
	}

}
