
<?php
error_reporting(0);
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Settings extends CI_Controller
{
	public function __construct()
	{
		/*
         *  Developed by: Shalini S
         *  Date    : 18 Feb, 2022
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


	
// Custom callback function for currency name uniqueness
public function unique_currency_name($name)
{
    // Get the ID of the record being edited (e.g., from the form input or URL parameter)
    $record_id = $this->input->post('currency_id');
    
    // Query the database to check if the currency name already exists for any other record
    $this->db->where('name', $name);
    $this->db->where_not_in('id', $record_id);
    $query = $this->db->get('currency_types');
    
    // If a row is found, the name is not unique
    if ($query->num_rows() > 0) {
        $this->form_validation->set_message('unique_currency_name', 'The Currency Name field must contain a unique value.');
        return false;
    }
    
    return true;
}

// Custom callback function for currency code uniqueness
public function unique_currency_code($code)
{
    // Get the ID of the record being edited (e.g., from the form input or URL parameter)
    $record_id = $this->input->post('currency_id');
    
    // Query the database to check if the currency code already exists for any other record
    $this->db->where('currency_code', $code);
    $this->db->where_not_in('id', $record_id);
    $query = $this->db->get('currency_types');
    
    // If a row is found, the code is not unique
    if ($query->num_rows() > 0) {
        $this->form_validation->set_message('unique_currency_code', 'The Currency Code field must contain a unique value.');
        return false;
    }
    
    return true;
}

// Custom callback function for currency symbol uniqueness
public function unique_currency_symbol($symbol)
{
    // Get the ID of the record being edited (e.g., from the form input or URL parameter)
    $record_id = $this->input->post('currency_id');
    
    // Query the database to check if the currency symbol already exists for any other record
    $this->db->where('symbol', $symbol);
    $this->db->where_not_in('id', $record_id);
    $query = $this->db->get('currency_types');
    
    // If a row is found, the symbol is not unique
    if ($query->num_rows() > 0) {
        $this->form_validation->set_message('unique_currency_symbol', 'The Currency Symbol field must contain a unique value.');
        return false;
    }
    
    return true;
}

	public function get_ajax_email_template(){

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

		  // $row_per_page = 10;
  // $rowno = $_POST['start'];
  // $where_array=[];
  // $draw = $_POST['draw'];
  // $data = [];
  // if(!empty($_GET)){
  //  	$row_per_page = 10000;
  // }

  // Row position
  // if ($rowno != 0) {
  //     $rowno = ($rowno - 1) * $row_per_page;
  // }  

  
		  $records = $this->General_Model->get_limit_based_data('email_template ', $rowno, $row_per_page, 'id', 'DESC')->result();
		  $allcount = $this->General_Model->get_limit_based_data('email_template ', '','', 'id', 'DESC')->num_rows();
		  //echo $allcount;die;

	  //print_r($records);die;
			  // Get records
			  $i=1;
			  foreach($records as $record ){

				   $action	=	'<div class="dropdown">
											  <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												  <i class="mdi mdi-dots-vertical fs-sm"></i>
											  </a>
											  <div class="dropdown-menu dropdown-menu-right">
											  
												  <a href="javascript:void(0)" class="dropdown-item edit_id" data-id="'.base64_encode(json_encode($record->id)).'"  >Edit </a>
												  <a href="javascript:void(0)" class="dropdown-item" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											  </div>
										  </div>';
			  $id							=		$record->id;
			  $i							=		$i;

			  $data[] = array( 
				  "s_no"									=> ($rowno) +  $i, 
				  "template_key"					=> $record->template_key, 
								  "subject_english"				=> $record->subject_english,
								  "cc_email"						  => $record->cc_email,
								  "action"								=> $action,				
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

	public function get_status_type(){
		$searchText = strtolower($_POST['search_text']);
		// Perform a database query or some other operation to retrieve the checkbox data based on the search text
		$checkboxData = array('1'=>'active','0'=>'inactive',);
		
		$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
		$matches = preg_grep($pattern, $checkboxData);
		
		$html = "";
		
		foreach($matches as $key=>$value ){

			$html .=   ' <div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="status'.$key.'">
			<label class="custom-control-label" for="status'.$key.'">'.ucwords($value).'</label>
		  </div>';

		}

		echo $html;
}

public function get_coupon_type(){
	$searchText = strtolower($_POST['search_text']);
	// Perform a database query or some other operation to retrieve the checkbox data based on the search text
	$checkboxData = array('1'=>'amount','2'=>'percentage',);
	
	$pattern = '/' . preg_quote($searchText, '/') . '/'; // Dynamically create the pattern
	$matches = preg_grep($pattern, $checkboxData);
	
	$html = "";
	
	foreach($matches as $key=>$value ){

		$html .=   ' <div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" id="customCheck'.$key.'">
		<label class="custom-control-label" for="customCheck'.$key.'">'.ucfirst($value).'</label>
	  </div>';

	}

	echo $html;
}


public function get_country_name(){
	$searchText = strtolower($_POST['search_text']);
	// Perform a database query or some other operation to retrieve the checkbox data based on the search text
	
	$html = "";
	$records = $this->General_Model->get_country_name($searchText)->result();
	
	foreach($records as $record ){
		$html .=   ' <div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input" id="country'.$record->id.'">
		<label class="custom-control-label" for="country'.$record->id.'">'.ucfirst($record->name).'</label>
	  </div>';

	}

	echo $html;
}
	public function get_customer_list()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
		// if ($rowno != 0) {
        //     $rowno = ($rowno - 1) * $row_per_page;
        // }  
			if( !empty($_POST['customer_name']) || !empty($_POST['status_type'])  || !empty($_POST['country']) )
			{
				// Check if the value is present in the $_POST array
				$status_type = isset($_POST['status_type']) ?  implode("', '", $_POST['status_type']) : '';
				$country = isset($_POST['country']) ?  implode("', '", $_POST['country']) : '';


				$search['customer_name'] 	=		$_POST['customer_name'];		
			
				$search['status_type'] =$status_type;
				$search['country'] =$country;

				// All records count
				$allcount = $this->General_Model->get_customer_data($search,array(),'','')->num_rows();
			// Get records
				$records = $this->General_Model->get_customer_data($search,array(),$row_per_page, $rowno)->result();
			}
			else
			{
			// All records count
				$allcount = $this->General_Model->get_customer_data('',array(),'','')->num_rows();
			// Get records
				$records = $this->General_Model->get_customer_data('',array(),$row_per_page, $rowno)->result();
			}

			$i=1;
			// echo '<pre/>';
			// print_r($records);
			// exit;


			


		foreach($records as $record ){		

			$city_name = $this->General_Model->get_city_name($record->city); 
			$city = !empty($city_name[0]->name) ? $city_name[0]->name.", " : "";
			$city_name_op = $city.$record->country_name;

			$ip_status=($record->status == '1') ? "Active" : "InActive";
				$badge=($record->status == '1') ? "success" : "danger";	

			$status						=		'<div class="bttns">
			<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
			 </div>';

			 $edit_url=  base_url()."settings/customers/add_customer/".base64_encode(json_encode($record->id));
			
//'.$edit_url.'
			 $action='<div class="dropdown">
				<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
				<i class="mdi mdi-dots-vertical fs-sm"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
				<a href="'.base_url().'home/customer_info/'.$record->id.'" class="dropdown-item">View</a>
				<a href="#"  data-toggle="modal" data-target="#centermodal_add" class="dropdown-item edit_customer" data-cust-id="'.$record->id.'" >Edit </a>
				<a href="javascript:void(0);" class="dropdown-item" onclick="delete_data(\''.$record->id.'\');">Delete </a>
				</div>
				</div>';

				
				$navigation='<a href='.base_url().'home/customer_info/'.$record->id.'><i class="fas fa-angle-double-right"></i></a>';

			$data[] = array( 
                "i"							=> $i, 
				"user_image"=>'<div class="h-avatar is-small image-small">
				<img class="avatar" src="https://www.listmyticket.com/uploads/users/202204261458276850931.png" alt="Lettstart Admin">
			</div>',
				"customer_name"				=> $record->first_name." ".$record->last_name, 		
				"email"						=> $record->email, 	
				"location"					=> $city_name_op, 		
				"mobile"					=> $record->dialing_code." ".$record->mobile, 	
				"role"						=> "Customer", 		
				"status"					=> $status, 		
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
	
	public function get_split_type_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( isset($_POST['status']) || !empty($_POST['split_type'])  ) 
		{
			$search['status']=$_POST['status'];
			$search['name']=$_POST['split_type'];

			$records = $this->General_Model->get_split_type_by_limit($rowno, $row_per_page, "name", 'asc','',$search)->result();
			$allcount = $this->General_Model->get_split_type_by_limit('', '', '', '','',$search)->num_rows();

		}
		else
		{			
			$records = $this->General_Model->get_split_type_by_limit($rowno, $row_per_page, "name", 'asc', '', "")->result();
			$allcount = $this->General_Model->get_split_type_by_limit('', '', '', '', '', "")->num_rows();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/split_types/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/split_types/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}

					if (UPLOAD_PATH. '/uploads/spilit_image/' . $record->spilit_image) {
						$image = UPLOAD_PATH. '/uploads/spilit_image/' . $record->spilit_image;
					} else {
						$image = base_url('assets/img/placeholders/placeholder.png');
					}

			$data[] = array( 
                "splittype"				=> $record->splittype, 
				"status"				=> $status,
				"spilit_image"			=> '<div class="h-avatar is-small image-small">
				<img class="avatar" src="'.$image.'" alt="'.$record->splittype.'">
			</div>',
				"action"				=> $action
			
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
	public function get_country_list()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( !empty($_POST['country'])  ) 
		{
			$search['id']=$_POST['country'];
			$records = $this->General_Model->get_limit_based_data('countries ', $rowno, $row_per_page, 'name', 'asc',$search)->result();
			$allcount = $this->General_Model->get_limit_based_data('countries ', '','', 'name', 'asc',$search)->num_rows();

		}
		else
		{
			$records = $this->General_Model->get_limit_based_data('countries ', $rowno, $row_per_page, 'name', 'asc')->result();
			$allcount = $this->General_Model->get_limit_based_data('countries ', '','', 'name', 'asc')->num_rows();
		}

	
		// echo '<pre/>';
		// print_r($records);
	//	exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/countries/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/countries/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
			

			$data[] = array( 
                "country_name"				=> ucwords(strtolower($record->name)), 
				"sortname"					=> $record->sortname,
				"phonecode"					=> $record->phonecode,
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
	public function get_delivery_list()
	{		
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( (isset($_POST['status']) && $_POST['status']!="")   || !empty($_POST['delivery_name']) ) 
		{
			
			$search['status']=$_POST['status'];
			$search['category']=$_POST['delivery_name'];			
			$allcount = $this->General_Model->get_ticket_type_category("",$search)->num_rows();
			$records = $this->General_Model->get_ticket_type_category("",$search)->result();

		}

		/*
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['user']) || (isset($_POST['markup_type']) && $_POST['markup_type']!="") ) 
		{
			$search['status']=$_POST['status'];
			$search['markup_type']=$_POST['markup_type'];
			$search['name']=$_POST['user'];

			$allcount = $this->General_Model->get_table_row_count_markup($role,$search)->num_rows();
			$records = $this->General_Model->get_limit_based_data_markup('tickets_markup', $rowno, $row_per_page, 'tickets_markup.id', 'DESC', $role,$search)->result();

		}
		*/
		else
		{
			$allcount = $this->General_Model->get_ticket_type_category()->num_rows();
			$records = $this->General_Model->get_ticket_type_category()->result();
		}

	
		// echo '<pre/>';
		// //print_r($records);
		// 	echo $this->db->last_query();
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/delivery_settings/add/".$record->ticket_cat_id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->ticket_cat_id.'" data-href="'.base_url().'settings/delivery_settings/delete/'.$record->ticket_cat_id.'" onclick="delete_data(\''.$record->ticket_cat_id.'\');">Delete </a>
											</div>
										</div>';

				if (strtoupper($record->currency) == "GBP") {
					$currency="£";
				}
				if (strtoupper($record->currency) == "EUR") { 
					$currency="€";
				}
				if (strtoupper($record->currency) != "GBP" && strtoupper($record->currency) != "EUR"){
					$currency= strtoupper($record->currency); 
					}

					if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}
					
			$data[] = array( 
                "company"				=> $record->company, 
				"category"				=> $record->category,
				"delivery_cost"			=> $record->delivery_cost > 0 ? "$currency " . number_format($record->delivery_cost, 2) : "" ,
				"status"				=> $status,
				"action"				=> $action
			
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
	public function get_currency_list()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
		
		if ( (isset($_POST['status_type']) && count($_POST['status_type']) > 0) || !empty($_POST['currency_code'])) {
		

			$search['status']=$_POST['status_type'];
			$search['currency_code']=$_POST['currency_code'];
			$records = $this->General_Model->get_limit_based_data('currency_types ', $rowno, $row_per_page, 'name', 'asc',$search)->result();
			$allcount = $this->General_Model->get_limit_based_data('currency_types ', '','', 'name', 'asc',$search)->num_rows();

		}
		else
		{
			$records = $this->General_Model->get_limit_based_data('currency_types ', $rowno, $row_per_page, 'name', 'asc')->result();
			$allcount = $this->General_Model->get_limit_based_data('currency_types ', '','', 'name', 'asc')->num_rows();
		}

	
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){

			if ($record->status == 0) {
				$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
			}
			if ($record->status == 1) {
				$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
			}
			
			$edit_url= base_url()."settings/currency/add_currency/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/currency/delete_currency/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
			

			$data[] = array( 
                "name"						=> $record->name, 
				"currency_code"				=> $record->currency_code,
				"symbol"					=> $record->symbol,
				"price_difference"			=> $record->price_difference,
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

	public function get_seller_markup_list()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( !empty($_POST['country'])  ) 
		{
			$search['id']=$_POST['country'];
			$records = $this->General_Model->get_limit_based_data('tickets_markup ', $rowno, $row_per_page, 'id', 'asc',$search)->result();
			$allcount = $this->General_Model->get_limit_based_data('tickets_markup ', '','', 'id', 'asc',$search)->num_rows();

		}
		else
		{
			$records = $this->General_Model->get_limit_based_data('tickets_markup ', $rowno, $row_per_page, 'id', 'asc')->result();
			$allcount = $this->General_Model->get_limit_based_data('tickets_markup ', '','', 'id', 'asc')->num_rows();
		}

	
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){

			// if ($record->status == 0 ||  $record->status == "") {
			// 	$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
			// }
			// if ($record->status == 1) {
			// 	$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
			// }
			
			$status = ($record->status == 1) ? '<div class="bttns"><span class="badge badge-success">Active</span></div>' : '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';


			$edit_url= base_url()."settings/seller_settings/add_seller_settings/".base64_encode(json_encode($record->id));

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/seller_settings/delete_seller_markup/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
			$markup_type= '<div class="bttns"><span class="badge badge-warning">'.$record->markup_type.'</span></div>';

			$data[] = array( 
                "markup"					=> 		$record->markup, 
				"markup_type"				=> 		$markup_type,
				"user_id"					=> 		$this->General_Model->get_admin_name($record->user_id),
				"status"					=> 		$status,
				"action"					=> 		$action
			
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
	public function get_state_list()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( !empty($_POST['country'])  ) 
		{
			
			$search['country_id']=$_POST['country'];
			//country_id
			$allcount = $this->General_Model->get_states_by_limit($rowno, $row_per_page, '', '',$search)->num_rows();
			$records = $this->General_Model->get_states_by_limit($rowno, $row_per_page, '', '',$search)->result();

		}
		else
		{
			$allcount = $this->General_Model->get_table_row_count('states', '');
			$records = $this->General_Model->get_states_by_limit($rowno, $row_per_page, '', '', '')->result();
		}

	
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/states/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/states/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
			

			$data[] = array( 
                "country_name"				=> ucwords(strtolower($record->country)), 
				"state_name"				=> ucwords(strtolower($record->name)),
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

	public function get_item()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
        if(!empty($_GET)){
         $row_per_page = 10000;
        }
        
        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $row_per_page;
        }  
		if ( !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['coupon_type']) || !empty($_POST['status_type'])  ) 
		{
			$fromDate 							    = $_POST['event_start_date'];
            $toDate 							    = $_POST['event_end_date'];
			$ip_coupon_type 							= $_POST['coupon_type'];
			$status_type 							= $_POST['status_type'];
			$credit_note							= 0;

			$records = $this->General_Model->get_limit_based_data_search('coupon_code ', $rowno, $row_per_page, 'c_id', 'DESC',$fromDate,$toDate,$ip_coupon_type,$status_type,$credit_note)->result();
			//echo $this->db->last_query();exit;
			$allcount = $this->General_Model->get_limit_based_data_search('coupon_code ', '','', 'c_id', 'DESC',$fromDate,$toDate,$ip_coupon_type,$status_type,$credit_note)->num_rows();
		}
		else
		{
			$search['credit_note']=0;
			$records = $this->General_Model->get_limit_based_data('coupon_code ', $rowno, $row_per_page, 'c_id', 'DESC',$search)->result();
			$allcount = $this->General_Model->get_limit_based_data('coupon_code ', '','', 'c_id', 'DESC',$search)->num_rows();
		}
		// Get records
		$i=1;
		foreach($records as $record ){

			$expiry_date				= date("d M Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->create_date)))." to ".date("d M Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->expiry_date)));
			
			$used_count = !empty($record->used_count) ? $record->used_count : 0;
			$remaing_count=$record->usage_limit-$record->usage_used_count;
			
			$currency_type='---';
			if($record->coupon_type == 1)
			{
				$get_currency=$this->General_Model->get_coupon_currency($record->currency_type);
				$currency_type= $get_currency->currency_code;				
			}

			$c_type 					= 		($record->coupon_type == '1') ? "Amount" : "Percentage";
			$coupon_code				=		$record->coupon_code;
			$coupon_value				=		$record->coupon_value;

			$ip_status=($record->status == '1') ? "Active" : "InActive";
			$badge=($record->status == '1') ? "success" : "danger";	

			$status						=		'<div class="bttns">
			<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
			 </div>';

			 $edit_url= base_url()."settings/discount_coupons/add_discount_coupon/".base64_encode(json_encode($record->c_id));
			 $delete_url= base_url()."settings/discount_coupons/delete_coupon/".$record->c_id;

			$action	 =	'<div class="dropdown">
					<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
						<i class="mdi mdi-dots-vertical fs-sm"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="javascript:void(0)" class="dropdown-item">View</a> -->
						<a href="javascript:void(0)" class="dropdown-item load_coupon_edit" data-id="'.$record->c_id.'">Edit </a>
						<a href="javascript:void(0)" class="dropdown-item"   id="branch_'.$record->c_id.'" data-id 
						="'.$record->c_id.'"  data-href="'.$delete_url.'"onclick="delete_data(\''.$record->c_id.'\');">Delete </a>
					</div>
				</div>';
			$c_id						=		$record->c_id;
			$i							=		$i;

			$data[] = array( 
                "c_type"				=> $c_type, 
				"coupon_value"			=> $coupon_value,
				"expiry_date"			=> $expiry_date,
				"status"				=> $status,
				"c_id"					=> $c_id,
				"used_count"			=> $used_count,
				"remaining_count"		=> $remaing_count,
				"coupon_code"			=> $coupon_code,			
				"action"				=> $action,
				"currency"				=> $currency_type,
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
	public function get_credit_note_item()
	{

			
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
        if(!empty($_GET)){
         $row_per_page = 10000;
        }
        
        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $row_per_page;
        }  
		if ( !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['coupon_type']) || !empty($_POST['status_type']) || !empty($_POST['credit_note'])  ) 
		{
			
			$fromDate 							    = $_POST['event_start_date'];
            $toDate 							    = $_POST['event_end_date'];
			$ip_coupon_type 							= $_POST['coupon_type'];
			$status_type 							= $_POST['status_type'];
			$credit_note							= 1;	
			$credit_note_code						= $_POST['credit_note'];	

			$records = $this->General_Model->get_limit_based_data_search('coupon_code ', $rowno, $row_per_page, 'c_id', 'DESC',$fromDate,$toDate,$ip_coupon_type,$status_type,$credit_note,$credit_note_code)->result();
			// echo $this->db->last_query();
			// exit;
			$allcount = $this->General_Model->get_limit_based_data_search('coupon_code ', '','', 'c_id', 'DESC',$fromDate,$toDate,$ip_coupon_type,$status_type,$credit_note,$credit_note_code)->num_rows();
		}
		else
		{
			$search['credit_note']=1;
			$records = $this->General_Model->get_limit_based_data('coupon_code ', $rowno, $row_per_page, 'c_id', 'DESC',$search)->result();		

			$allcount = $this->General_Model->get_limit_based_data('coupon_code ', '','', 'c_id', 'DESC',$search)->num_rows();
		}
		// Get records
		$i=1;
		foreach($records as $record ){

			$expiry_date				= date("d M Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->create_date)))." to ".date("d M Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->expiry_date)));
			
			$used_count = !empty($record->used_count) ? $record->used_count : 0;
			$remaing_count=$record->usage_limit-$record->usage_used_count;
			
			$currency_type='---';
			if($record->coupon_type == 1)
			{
				$get_currency=$this->General_Model->get_coupon_currency($record->currency_type);
				$currency_type= $get_currency->currency_code;				
			}

			$c_type 					= 		($record->coupon_type == '1') ? "Amount" : "Percentage";
			$coupon_code				=		$record->coupon_code;
			$coupon_value				=		$record->coupon_value;

			$ip_status=($record->status == '1') ? "Active" : "InActive";
			$badge=($record->status == '1') ? "success" : "danger";	

			$status						=		'<div class="bttns">
			<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
			 </div>';

			 $edit_url= base_url()."settings/credit_note_coupons/add_discount_coupon/".base64_encode(json_encode($record->c_id));
			 $delete_url= base_url()."settings/credit_note_coupons/delete_coupon/".$record->c_id;

			$action	 =	'<div class="dropdown">
					<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
						<i class="mdi mdi-dots-vertical fs-sm"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="javascript:void(0)" class="dropdown-item">View</a> -->
						<a href="javascript:void(0)" class="dropdown-item load_coupon_edit" data-id="'.$record->c_id.'">Edit </a>
						<a href="javascript:void(0)" class="dropdown-item"   id="branch_'.$record->c_id.'" data-id 
						="'.$record->c_id.'"  data-href="'.$delete_url.'"onclick="delete_data(\''.$record->c_id.'\');">Delete </a>
					</div>
				</div>';
			$c_id						=		$record->c_id;
			$i							=		$i;


			$total_coupon_prices = @$record->coupon_value;
			$applied_coupons = $this->General_Model->getAllItemTable('coupon_logs', 'coupon_code', $record->coupon_code, 'cl_id', 'DESC')->result();
			$applied_prices = array();
			foreach($applied_coupons as $applied_coupon){
				$coupon_applied_currency = $applied_coupon->currency;
				$coupon_currency 	  = $record->currency_type;
				$coupon_currency_data = $this->General_Model->getAllItemTable('currency_types', 'id', $coupon_currency, 'id', 'DESC')->row();
				$coupon_cuurency = trim($coupon_currency_data->currency_code);
				$coupon_price_v1        =  $this->get_currency($coupon_applied_currency,trim($coupon_currency_data->currency_code),$applied_coupon->applied_discount_amount,0);
				$applied_prices[] = $coupon_price_v1;
			} 
			$applied_total_prices = number_format(array_sum($applied_prices),2);
			$remaining_coupon_value = (int)$total_coupon_prices - (int)$applied_total_prices;
			$inpt_remaining_coupon_value = number_format($remaining_coupon_value,2);

			$data[] = array( 
                "c_type"				=> $c_type, 
				"coupon_value"			=> $coupon_value,
				"expiry_date"			=> $expiry_date,
				"status"				=> $status,
				"c_id"					=> $c_id,
				"used_count"			=> $used_count,
				"remaining_count"		=> $remaing_count,
				"coupon_code"			=> $coupon_code,			
				"action"				=> $action,
				"currency"				=> $currency_type,
				"remaining_coupon_value"				=> $inpt_remaining_coupon_value,
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
	public function get_item_sep22()
	{

		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
        if(!empty($_GET)){
         $row_per_page = 10000;
        }
        
        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $row_per_page;
        }  
		if ( !empty($_POST['event_start_date']) || !empty($_POST['event_end_date']) || !empty($_POST['coupon_type']) || !empty($_POST['status_type'])  ) 
		{
			
			
			$fromDate 							    = $_POST['event_start_date'];
            $toDate 							    = $_POST['event_end_date'];
			$ip_coupon_type 							= $_POST['coupon_type'];
			$status_type 							= $_POST['status_type'];

			$records = $this->General_Model->get_limit_based_data_search('coupon_code ', $rowno, $row_per_page, 'c_id', 'DESC',$fromDate,$toDate,$ip_coupon_type,$status_type)->result();
			$allcount = $this->General_Model->get_limit_based_data_search('coupon_code ', '','', 'c_id', 'DESC',$fromDate,$toDate,$ip_coupon_type,$status_type)->num_rows();
		}
		else
		{
			$records = $this->General_Model->get_limit_based_data('coupon_code ', $rowno, $row_per_page, 'c_id', 'DESC')->result();
			$allcount = $this->General_Model->get_limit_based_data('coupon_code ', '','', 'c_id', 'DESC')->num_rows();
		}
		// Get records
		$i=1;
		foreach($records as $record ){

			$expiry_date				= date("d M Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->create_date)))." to ".date("d M Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$record->expiry_date)));

			$c_type 					= 		($record->coupon_type == '1') ? "Amount" : "Percentage";
			$coupon_code				=		$record->coupon_code;
			$coupon_value				=		$record->coupon_value;
			//$create_date				=		$record->create_date;
		//	$expiry_date				=		$record->expiry_date;

				$ip_status=($record->status == '1') ? "Active" : "InActive";
				$badge=($record->status == '1') ? "success" : "danger";	

			$status						=		'<div class="bttns">
			<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
			 </div>';

			 $edit_url= base_url()."settings/discount_coupons/add_discount_coupon/".base64_encode(json_encode($record->c_id));
			 $delete_url= base_url()."settings/discount_coupons/delete_coupon/".$record->c_id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<!-- <a href="javascript:void(0)" class="dropdown-item">View</a> -->
												<a href="javascript:void(0)" class="dropdown-item load_coupon_edit" data-id="'.$record->c_id.'">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item"   id="branch_'.$record->c_id.'" data-id 
												="'.$record->c_id.'"  data-href="'.$delete_url.'"onclick="delete_data(\''.$record->c_id.'\');">Delete </a>
											</div>
										</div>';
			$c_id						=		$record->c_id;
			$i							=		$i;

			$data[] = array( 
                "c_type"				=> $c_type, 
				"coupon_value"			=> $coupon_value,
				"expiry_date"			=> $expiry_date,
				"status"				=> $status,
				"c_id"					=> $c_id,
				"coupon_code"			=> $coupon_code,
			
				"action"				=> $action,
				"currency"				=> "USD",
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




	/**
	 * @desc currency settings related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function currency()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add_currency') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['currency_details'] = $this->General_Model->getAllItemTable('currency_types', 'id', $edit_id, 'id', 'DESC')->row();
			}
			$this->load->view(THEME.'settings/add_currency', $this->data);
		} else if ($segment == 'list_currency') {
			$row_count = $this->uri->segment(4);
		//	$this->loadRecord($row_count, 'currency_types', 'settings/currency/list_currency', 'id', 'DESC', 'settings/currency_list', 'currencies');
		$this->load->view(THEME.'settings/currency_list', $this->data);
		
		} else if ($segment == 'delete_currency') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('currency_types', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Currency type deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting currency type.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_currency') {
			$this->form_validation->set_rules('currency_name', 'Currency Name', 'required|callback_unique_currency_name');
			$this->form_validation->set_rules('currency_code', 'Currency Code', 'required|callback_unique_currency_code');
			$this->form_validation->set_rules('currency_symbol', 'Currency Symbol', 'required|callback_unique_currency_symbol');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('difference', 'Price Difference', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'name' => $_POST['currency_name'],
					'currency_code' => $_POST['currency_code'],
					'symbol' => $_POST['currency_symbol'],
					'status' => $_POST['status'],
					'price_difference' => $_POST['difference'],
				);
				if ($_POST['currency_id'] == '') {
					$insert_data['add_by'] = $this->session->userdata('admin_id');
					$insert_data['store_id'] = $this->session->userdata('storefront')->admin_id;
					$inserted_id = $this->General_Model->insert_data('currency_types', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'Currency type details added successfully.', 'redirect_url' => base_url() . 'settings/currency/list_currency', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new currency type.', 'redirect_url' => base_url() . 'settings/currency/add_currency', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$currency_id = $_POST['currency_id'];
					$result =$this->General_Model->update_currency($currency_id, $insert_data);

					// if (!$result) {
					// 	$error = $this->db->error();
					// 	echo '<pre/>';
					// 	print_r($error);
					// 	exit;
					// 	echo 'Database Error: ' . $error['message'];
					// }

					//exit;
					if ($result) {
						$response = array('msg' => 'Currency type details updated Successfully.', 'redirect_url' => base_url() . 'settings/currency/list_currency', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update new currency type.', 'redirect_url' => base_url() . 'settings/currency/add_currency/' . $currency_id, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {

				//$currency_id = $_POST['currency_id'];
				
			//	$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/currency/add_currency', 'status' => 0);
			
				$errors = array(
					'currency_name'  => form_error('currency_name', '<p>', '</p>'),
					'currency_code' => form_error('currency_code', '<p>', '</p>'),
					'currency_symbol' => form_error('currency_symbol', '<p>', '</p>')
				);
				
				$response = array(
					'status' => 0,
					'msg' => 'Validation failed',
					'errors' => $errors
				);

			}
			echo json_encode($response);
			exit;
		}
	}




	public function tournament_settings()
	{
		$segment = $this->uri->segment(3);
		if ($segment == 'set_tournament_settings') {
			$segment4 = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $segment4;
			$this->data['sellers']    = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['partners']   = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
			$this->data['afiliates']  = $this->General_Model->get_admin_details_by_role_v1(3, 'status');
			$this->data['storefronts']  = $this->General_Model->get_admin_details_by_role_v1(4, 'status');
			$this->data['match_settings']  = $this->General_Model->getAllItemTable('match_settings', 'matches', $segment4, 'matches', 'DESC')->row();
			$this->load->view('settings/match_settings/set_match_settings', $this->data);
		} else if ($segment == 'tournament_settings') {

			$row_count = $this->uri->segment(4);
			$this->loadRecord($row_count, 'tournament_settings', 'settings/tournament_settings/tournament_settings', 't_id', 'DESC', 'settings/tournament_settings/tournament_settings', 'tournament_settings');
		} else if ($segment == 'save_tournament_settings') {

			// echo "<pre>";print_r($_POST);exit;

			$this->form_validation->set_rules('matchId', 'Match', 'required');
			if ($this->form_validation->run() !== false) {

				$match_count = $this->General_Model->getid('match_settings', array('matches' => $_POST['matchId']))->num_rows();
				if ($match_count == 0) {

					$match_settings_data['matches'] = $_POST['matchId'];
					$this->db->insert('match_settings', $match_settings_data);
				}
				$sellers_data = "";
				if ($_POST['sellers']) {
					$sellers_data = implode(',', $_POST['sellers']);
				}
				$partners_data = "";
				if ($_POST['partners']) {
					$partners_data = implode(',', $_POST['partners']);
				}
				$afiliates_data = "";
				if ($_POST['afiliates']) {
					$afiliates_data = implode(',', $_POST['afiliates']);
				}
				$storefronts_data = "";
				if ($_POST['storefronts']) {
					$storefronts_data = implode(',', $_POST['storefronts']);
				}
				$match_settings_data = array(
					'sellers' => $sellers_data,
					'partners' => $partners_data,
					'afiliates' => $afiliates_data,
					'storefronts' => $storefronts_data,
					'status' => $_POST['status']
				); //echo "<pre>";print_r($match_settings_data);exit;

				$matchId = $_POST['matchId'];
				if ($this->General_Model->update_table('match_settings', 'matches', $matchId, $match_settings_data)) {
					$response = array('msg' => 'Match Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/match_settings/match_settings', 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update Match Settings.', 'redirect_url' => base_url() . 'settings/match_settings/match_settings', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/match_settings/match_settings', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}



	public function match_settings()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'edit_email_access') {
			$segment4 = json_decode(base64_decode($this->uri->segment(4)));
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['email_access'] = $this->General_Model->getAllItemTable('email_access', 'id', $edit_id, 'id', 'DESC')->row();
			}
			$this->load->view('settings/email_settings/edit_email_access', $this->data);
		}  else if ($segment == 'affiliate_mathes_settings') {
			$segment4 = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $segment4;
			
			$this->data['afiliates']  = $this->General_Model->get_admin_details_by_role_v1(3, 'status');
			//$this->data['affiliate_mathes']  = $this->General_Model->get_affiliate_list()->result();

			$this->load->view(THEME.'settings/match_settings/affiliate_mathes_settings', $this->data);
		} else if ($segment == 'save_affiliate_settings') {
			$this->form_validation->set_rules('match_id', 'Match', 'required');
			$this->form_validation->set_rules('afiliates_id', 'Affiliates', 'required');
			$this->form_validation->set_rules('token', 'Token', 'required');
			if ($this->form_validation->run() !== false) {

				// $match_count = $this->General_Model->getid('affiliate_matches_setting', array('matches' => $_POST['match_id','afiliates_id' => $_POST['afiliates_id']]))->num_rows();
				// if ($match_count == 0) {


				$match_settings_data = array(
					'affiliate_id' 	=> $_POST['afiliates_id'],
					'match_id' 		=> $_POST['match_id'],
					'token' 		=> $_POST['token'],
					'links_status' 	=> $_POST['links_status'],
					'affiliate_language'=> $_POST['affiliate_language'] ?  $_POST['affiliate_language'] : "en" ,
					'added_by' 		=> $this->session->userdata('admin_id'),
				
				); 


				
				$link_id = $_POST['link_id'];
				if($link_id == ""){

					$id = $this->General_Model->insert_data('affiliate_matches_setting', $match_settings_data);

					if($id){
						$udpate_id = array('reference_no' =>  "AFF".str_pad($id, 4, '0', STR_PAD_LEFT) );
						
						$this->General_Model->update_table('affiliate_matches_setting', 'id', $id, $udpate_id);
						
					}
					$response = array('msg' => 'Match Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/match_settings/affiliate_mathes_settings', 'status' => 1);
				}
				else  { 

					if ($this->General_Model->update_table('affiliate_matches_setting', 'id', $link_id, $match_settings_data)) {
						$response = array('msg' => 'Match Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/match_settings/affiliate_mathes_settings', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Match Settings.', 'redirect_url' => base_url() . 'settings/match_settings/set_affiliate_settings', 'status' => 0);
					}
				}
				echo json_encode($response);
				exit;
			}
			else{
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 0);
				echo json_encode($response);
			}
		 } 
		 else if ($segment == 'set_affiliate_settings') {
			$segment4 = json_decode(base64_decode($this->uri->segment(4)));
			 $segment; 
			 $edit_id = $segment4;
			 if($edit_id){

					$this->data['affiliate_mathes_edit']  = $this->General_Model->get_affiliate_list("","","","",array('affiliate_matches_setting.id' => $edit_id))->row();
			 }
			
			
			$this->data['afiliates']  = $this->General_Model->get_admin_details_by_role_v1(3, 'status');

			$this->data['matches'] = $this->General_Model->get_matches('','upcoming','','','','','','','')->result();

			$this->load->view(THEME.'settings/match_settings/set_affiliate_settings', $this->data);
		}
		 else if($segment == 'delete_affiliate_settings'){

		 $segment4 = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $segment4;

			$match_settings_data = array(
					'links_status' 	=> 2);
			if ($this->General_Model->update_table('affiliate_matches_setting', 'id', $edit_id, $match_settings_data)) {
				//echo $this->db->last_query();
				$response = array('msg' => 'Match Settings Deleted Successfully.', 'redirect_url' => base_url() . 'settings/match_settings/affiliate_mathes_settings', 'status' => 1);
			} else {
				$response = array('msg' => 'Failed to Deleted Match Settings.', 'redirect_url' => base_url() . 'settings/match_settings/set_affiliate_settings', 'status' => 0);
			}
			die;
			
		}else if ($segment == 'set_match_settings') {
			$segment4 = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $segment4;
			$this->data['sellers']    = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['partners']   = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
			$this->data['afiliates']  = $this->General_Model->get_admin_details_by_role_v1(3, 'status');
			$this->data['storefronts']  = $this->General_Model->get_admin_details_by_role_v1(4, 'status');
			$this->data['match_settings']  = $this->General_Model->getAllItemTable('match_settings', 'matches', $segment4, 'matches', 'DESC')->row();
			$this->load->view(THEME.'settings/match_settings/set_match_settings', $this->data);
		} else if ($segment == 'match_settings') {

			$row_count = $this->uri->segment(4);
			$this->loadRecord($row_count, 'matches', 'settings/match_settings/match_settings', 'm_id', 'DESC', 'settings/match_settings/match_settings', 'matches');
		} else if ($segment == 'save_match_settings') {

			// echo "<pre>";print_r($_POST);exit;

			$this->form_validation->set_rules('matchId', 'Match', 'required');
			if ($this->form_validation->run() !== false) {

				$match_count = $this->General_Model->getid('match_settings', array('matches' => $_POST['matchId']))->num_rows();
				if ($match_count == 0) {

					$match_settings_data['matches'] = $_POST['matchId'];
					$this->db->insert('match_settings', $match_settings_data);
				}
				$sellers_data = "";
				if ($_POST['sellers']) {
					$sellers_data = implode(',', $_POST['sellers']);
				}
				$partners_data = "";
				if ($_POST['partners']) {
					$partners_data = implode(',', $_POST['partners']);
				}
				$afiliates_data = "";
				if ($_POST['afiliates']) {
					$afiliates_data = implode(',', $_POST['afiliates']);
				}
				$storefronts_data = "";
				if ($_POST['storefronts']) {
					$storefronts_data = implode(',', $_POST['storefronts']);
				}
				$match_settings_data = array(
					'sellers' => $sellers_data,
					'partners' => $partners_data,
					'afiliates' => $afiliates_data,
					'storefronts' => $storefronts_data,
					'status' => $_POST['status']
				); //echo "<pre>";print_r($match_settings_data);exit;

				$matchId = $_POST['matchId'];

				if(@$this->input->post('event_type') == "other"){
					$url = base_url() . 'event/other_events/upcoming';
				}
				else{
					$url = base_url() . 'event/matches/upcoming';
				}
				if ($this->General_Model->update_table('match_settings', 'matches', $matchId, $match_settings_data)) {
					$response = array('msg' => 'Match Settings updated Successfully.', 'redirect_url' => $url, 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update Match Settings.', 'redirect_url' => base_url() . 'event/matches/upcoming', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/match_settings/match_settings', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} else if ($segment == 'save_email_settings') {

			$this->form_validation->set_rules('smtp', 'SMTP', 'required');
			$this->form_validation->set_rules('host', 'Host', 'required');
			$this->form_validation->set_rules('port', 'Port', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'smtp' => $_POST['smtp'],
					'host' => $_POST['host'],
					'port' => $_POST['port'],
					'username' => $_POST['username'],
					'status' => $_POST['status'],
					'password' => $_POST['password'],
				);
				if ($_POST['id'] == '') {
					$response = array('msg' => 'You Cant able to new email access settings.', 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 0);
					echo json_encode($response);
					exit;
				} else {
					$access_id = $_POST['id'];
					if ($this->General_Model->update_table('email_access', 'id', $access_id, $insert_data)) {
						$response = array('msg' => 'Email Access Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Email Access details.', 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	public function tournaments()
	{
		
		$url_segment  = $segment = $this->uri->segment(3);
		$tournament_id       = $this->uri->segment(4);
		$this->data['sellers'] = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
		$this->data['partners'] = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
		$this->data['partners_api'] = $this->General_Model->get_api_deails();
		$this->data['afiliates'] = $this->General_Model->get_admin_details_by_role_v1(3, 'status');			
		$this->data['storefronts'] = $this->General_Model->get_admin_details_by_site_setting();

		if ($url_segment == "status") {
			$id =  trim($this->input->post('id')); 
			$status =  trim($this->input->post('status')); 
			$updateData = array();
			$updateData['tixstock_status'] = $status;
			$this->General_Model->update('tournament', array('t_id' => $id), $updateData);
			//echo $this->db->last_query();
			echo "true";
			die;
					
		}
		else if ($url_segment == "add") {
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();

			$this->data['sellers'] = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['partners'] = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
			$this->data['partners_api'] = $this->General_Model->get_api_deails();
			$this->data['afiliates'] = $this->General_Model->get_admin_details_by_role_v1(3, 'status');			
			$this->data['storefronts'] = $this->General_Model->get_admin_details_by_site_setting();

			$this->data['apiLeague'] =  $this->getApiLeague();			
			$this->load->view(THEME.'event/add_tournament', $this->data);
		}
		else if ($url_segment == "add_content_tournment") {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['apiLeague'] =  $this->getApiLeague();
			if ($tournament_id != '') {
				$this->data['tournaments']      = $this->General_Model->get_tournament_data($tournament_id)->row();
				$getBannedCountries = $this->db->query("SELECT * FROM `banned_countries_tournament` WHERE `tournament_id` = " . $tournament_id)->result();
				$ban_arr = [];
				foreach ($getBannedCountries as $bc) {
					$ban_arr[] = $bc->country_id;
				}
				$this->data['ban_arr'] = $ban_arr;
			}
			$this->load->view('event/add_content_tournment', $this->data);
		}
		else if ($segment == 'save_tournaments_settings') {



			$this->form_validation->set_rules('tid', 'Tournament', 'required');
			$this->form_validation->set_rules('storefronts[]', 'store fronts', 'required');

			if ($this->form_validation->run() !== false) {

				$match_count = $this->General_Model->getid('tournament_settings', array('tournaments' => $_POST['tid']))->num_rows();
				if ($match_count == 0) {

					$match_settings_data['tournaments'] = $_POST['tid'];
					$this->db->insert('tournament_settings', $match_settings_data);
				}
				$sellers_data = "";
				if ($_POST['sellers']) {
					$sellers_data = implode(',', $_POST['sellers']);
				}
				$partners_data = "";
				if ($_POST['partners']) {
					$partners_data = implode(',', $_POST['partners']);
				}
				$afiliates_data = "";
				if ($_POST['afiliates']) {
					$afiliates_data = implode(',', $_POST['afiliates']);
				}
				$storefronts_data = "";
				if ($_POST['storefronts']) {
					$storefronts_data = implode(',', $_POST['storefronts']);
				}
				$match_settings_data = array(
					'sellers' => $sellers_data,
					'partners' => $partners_data,
					'afiliates' => $afiliates_data,
					'storefronts' => $storefronts_data,
					'status' => $_POST['status']
				); //echo "<pre>";print_r($match_settings_data);exit;

				$tid = $_POST['tid'];
				if ($this->General_Model->update_table('tournament_settings', 'tournaments', $tid, $match_settings_data)) {
					$response = array('msg' => 'Tournament Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/tournaments', 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update Tournament Settings.', 'redirect_url' => base_url() . 'settings/tournaments', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/tournaments', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
		else if ($url_segment == "edit_settings") {

			$segment4 = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $segment4;
			$this->data['sellers']    = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['partners']   = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
			$this->data['afiliates']  = $this->General_Model->get_admin_details_by_role_v1(3, 'status');
			$this->data['storefronts']  = $this->General_Model->get_admin_details_by_role_v1(4, 'status');
			//echo 'segment4 = '.$segment4;exit;
			$this->data['tournament_settings']  = $this->General_Model->getAllItemTable('tournament_settings', 'tournaments', $segment4, 'tournaments', 'DESC')->row();
			//echo "<pre>";print_r($this->data['tournament_settings']);exit;
			$this->load->view('event/edit_tournament_settings', $this->data);

		}
		else if ($segment == 'save_event_settings') {

			// echo "<pre>";print_r($_POST);exit;

			$this->form_validation->set_rules('matchId', 'Match', 'required');
			if ($this->form_validation->run() !== false) {

				$match_count = $this->General_Model->getid('match_settings', array('matches' => $_POST['matchId']))->num_rows();
				if ($match_count == 0) {

					$match_settings_data['matches'] = $_POST['matchId'];
					$this->db->insert('match_settings', $match_settings_data);
				}
				$sellers_data = "";
				if ($_POST['sellers']) {
					$sellers_data = implode(',', $_POST['sellers']);
				}
				$partners_data = "";
				if ($_POST['partners']) {
					$partners_data = implode(',', $_POST['partners']);
				}
				$afiliates_data = "";
				if ($_POST['afiliates']) {
					$afiliates_data = implode(',', $_POST['afiliates']);
				}
				$storefronts_data = "";
				if ($_POST['storefronts']) {
					$storefronts_data = implode(',', $_POST['storefronts']);
				}
				$match_settings_data = array(
					'sellers' => $sellers_data,
					'partners' => $partners_data,
					'afiliates' => $afiliates_data,
					'storefronts' => $storefronts_data,
					'status' => $_POST['status']
				); //echo "<pre>";print_r($match_settings_data);exit;

				$matchId = $_POST['matchId'];
				if ($this->General_Model->update_table('match_settings', 'matches', $matchId, $match_settings_data)) {
					$response = array('msg' => 'Match Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/match_settings/match_settings', 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update Match Settings.', 'redirect_url' => base_url() . 'settings/match_settings/match_settings', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/match_settings/match_settings', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
		 else if ($url_segment == "edit") {
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['apiLeague'] =  $this->getApiLeague();
			if ($tournament_id != '') {
				$this->data['tournaments']      = $this->General_Model->get_tournament_data($tournament_id)->row();
				$this->data['tournaments_lang']      = $this->General_Model->get_tournament_data_lang($tournament_id)->row();
				// echo '<pre/>';
				// print_r($this->data['tournaments_lang'] );
				// exit;
				$getBannedCountries = $this->db->query("SELECT * FROM `banned_countries_tournament` WHERE `tournament_id` = " . $tournament_id)->result();
				$ban_arr = [];
				foreach ($getBannedCountries as $bc) {
					$ban_arr[] = $bc->country_id;
				}
				$this->data['ban_arr'] = $ban_arr;
			}

			$this->data['sellers'] = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
				$this->data['partners'] = $this->General_Model->get_admin_details_by_role_v1(2, 'status');
				$this->data['partners_api'] = $this->General_Model->get_api_deails();
				$this->data['afiliates'] = $this->General_Model->get_admin_details_by_role_v1(3, 'status');			
				$this->data['storefronts'] = $this->General_Model->get_admin_details_by_site_setting();

			$this->load->view(THEME.'event/add_tournament', $this->data);
		} else if ($url_segment == "save") {
			//echo "save";exit;
			$tournamentId = $this->input->post('tournamentId');
			//Insert into table
			if ($tournamentId == '') {
			
				if ($this->input->post()) {
					$msg = '';
					$this->form_validation->set_rules('name', 'Tournament Name', 'required');
					$this->form_validation->set_rules('gamecategory', 'Game Category', 'required');
					if (!empty($_FILES['tournament_image']['name'])) {
						$this->form_validation->set_rules('tournament_image', 'Image file', 'callback_timage_file_check');
					}
					$insertData = array();
					if ($this->form_validation->run() !== false) {

						if (!empty($_FILES['tournament_image']['name'])) {
							
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/tournaments';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if ($this->upload->do_upload('tournament_image')) {
								$outputData['tournament_image'] = $this->upload->data();
								$insertData['tournament_image'] = $outputData['tournament_image']['file_name'];
							} else {
								
								$msg .= 'Failed to add tournament image';
							}
						}

						$insertData['tournament_name'] = trim($this->input->post('name'));
						$insertData['category'] = trim($this->input->post('gamecategory'));
						$insertData['status'] = $this->input->post('is_active') ? 1 : 0;
						$insertData['create_date'] = strtotime(date('Y-m-d H:i:s'));
						$insertData['popular_tournament'] = $this->input->post('is_popular') ? 1 : 0;
						$insertData['sort_by'] = trim($this->input->post('sortby'));
						$insertData['page_title'] = strip_tags($this->input->post('title'));
						$insertData['meta_description'] = $this->input->post('metadescription');
						$insertData['page_content'] = $this->input->post('tournament_content');
						$insertData['api_tournament_id'] = trim($this->input->post('apileague'));
						$insertData['tournament_url'] = str_replace(" ", "-", trim($this->input->post('name')));
						$insertData['toggle_pc'] = $this->input->post('toggle_pc') ? 1 : 0;
						$insertData['toggle_cl'] = $this->input->post('toggle_cl') ? 1 : 0;
						$insertData['toggle_cr'] = $this->input->post('toggle_cr') ? 1 : 0;
						$insertData['show_in_list'] = $this->input->post('show_tournament') ? 1 : 0;
						$insertData['url_key']=$this->input->post('url_key');
						$insertData['store_id']=$this->session->userdata('storefront')->admin_id;						
						$insertData['search_keywords']=$this->input->post('search_keywords');

						foreach ($_POST['partner_api'] as $api) {
							$insertData[$api == 1 ? 'tixstock_status' : 'oneclicket_status'] = 1;
						}
						
						$t_id = $this->General_Model->insert_data('tournament', $insertData);

						$this->db->delete('banned_countries_tournament', array('tournament_id' => $t_id));
						$bancountry_ids = $this->input->post('bcountry');
						foreach ($bancountry_ids as $val) {
							$this->data = array(
								'tournament_id' => $t_id,
								'country_id' => trim($val)
							);
							$this->db->insert('banned_countries_tournament', $this->data);
						}

						//Add to language table
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['tournament_id'] = $t_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['tournament_name'] = trim($this->input->post('name'));
							$insertData_lang['tournament_image'] = $insertData['tournament_image'];
							//$insertData_lang['page_title'] = strip_tags($this->input->post('title'));
							$insertData_lang['page_title'] = strip_tags($this->input->post('name'));
							$insertData_lang['meta_description'] = $this->input->post('metadescription');
							$insertData_lang['page_content'] = $this->input->post('tournament_content');
							$insertData_lang['tournament_content_left'] = $this->input->post('t_content_left');
							$insertData_lang['tournament_content_right'] = $this->input->post('t_content_right');
							$insertData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;
							$this->General_Model->insert_data('tournament_lang', $insertData_lang);
						}

						$partnerIds = $this->input->post('partner');
						$partner_ids = !empty($partnerIds) ? implode(',', $partnerIds) : '';
	
						$afiliateIds = $this->input->post('afiliate');
						$afiliate_ids = !empty($afiliateIds) ? implode(',', $afiliateIds) : '';
	
						$storeIds = $this->input->post('store');
						$store_ids = !empty($storeIds) ? implode(',', $storeIds) : '';
	
						$sellerIds = $this->input->post('seller');
						$seller_ids = !empty($sellerIds) ? implode(',', $sellerIds) : '';
						
						$tournament_settings_data = array();
						$tournament_settings_data['tournaments'] = $t_id;
						$tournament_settings_data['storefronts'] = $store_ids;
						$tournament_settings_data['partners'] = $partner_ids;
						$tournament_settings_data['afiliates'] = $afiliate_ids;
						$tournament_settings_data['sellers'] = $seller_ids;
						$tournament_settings_data['status'] = "1";
						$this->db->insert('tournament_settings', $tournament_settings_data);

						$response = array('status' => 1, 'msg' => 'Tournament Created Successfully. ' . $msg, 'redirect_url' => base_url() . 'settings/tournaments/edit/'.$t_id.'?tab=content');
						echo json_encode($response);
						exit;
					} else {
						$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/tournaments/add', 'status' => 0);
						echo json_encode($response);
						exit;
					}
				}
			} else {
				$tournament_id =    $tournamentId;
				//echo "<pre>";print_r($_POST);exit;
				//if its an update request
				if ($this->input->post()) {

					if($_POST['flag'] != 'content'){
					$this->form_validation->set_rules('name', 'Tournament Name', 'required');
					$this->form_validation->set_rules('gamecategory', 'Game Category', 'required');
					if (!empty($_FILES['tournament_image']['name'])) {
						$this->form_validation->set_rules('tournament_image', 'Image file', 'callback_timage_file_check');
					}
					}
					else{
					$this->form_validation->set_rules('title', 'Tournament Title', 'required');
					}
					$updateData = array();
					$updateData_lang = array();
					
					$msg = '';
					if ($this->form_validation->run() !== false) {
						$teamdata = $this->General_Model->getAllItemTable_array('tournament', array('t_id' => $tournament_id))->row();
						if($_POST['flag'] == 'content'){
						
							$updateData['page_title'] = strip_tags($this->input->post('title'));
							$updateData['meta_description'] = $this->input->post('metadescription');
							$updateData['page_content'] = $this->input->post('tournament_content');
							$updateData['url_key']=$this->input->post('url_key');
							$updateData_lang['page_title'] = strip_tags($this->input->post('title'));
							$updateData_lang['meta_description'] = $this->input->post('metadescription');
							$updateData_lang['page_content'] = $this->input->post('tournament_content');
							$updateData_lang['seo_keywords'] = $this->input->post('seo_keywords');
							$updateData_lang['tournament_content_left'] = $this->input->post('t_content_left');
							$updateData_lang['tournament_content_right'] = $this->input->post('t_content_right');
							$updateData['seo_keywords'] = $this->input->post('seo_keywords');
						
							

							$this->db->select('*');
							$this->db->from('tournament_lang');
							$this->db->where('tournament_id', $tournament_id);
							$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
							$this->db->where('language', $this->session->userdata('language_code'));
							$query = $this->db->get();

							if ($query->num_rows() == 0) {							
								$updateData_lang['tournament_id'] = $tournament_id;
								$updateData_lang['language'] = $this->session->userdata('language_code');	
								$updateData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;
								$updateData_lang['tournament_name'] = $teamdata->tournament_name;								
								$updateData_lang['tournament_image'] = $teamdata->tournament_image;														
								$this->db->insert('tournament_lang', $updateData_lang);
							
							} else {
								$this->General_Model->update('tournament_lang', array('tournament_id' => $tournament_id, 'language' => $this->session->userdata('language_code'),'store_id' => $this->session->userdata('storefront')->admin_id), $updateData_lang);
							}
							//$this->General_Model->update('tournament_lang', array('tournament_id' => $tournament_id, 'language' => $this->session->userdata('language_code')), $updateData_lang);
						
							$response = array('status' => 1, 'msg' => 'Tournament data updated Successfully.', 'redirect_url' => base_url() . 'settings/tournaments');

							echo json_encode($response);
							exit;
								
						}
					else{

						if (!empty($_FILES['tournament_image']['name'])) {
							
							if (@UPLOAD_PATH_PREFIX .'uploads/tournaments/' . $teamdata->tournament_image) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/tournaments/' . $teamdata->tournament_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/tournaments';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '1000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('tournament_image')) {
								$msg .= 'Failed to add tournament image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['tournament_image'] = $imagename;
								$updateData['tournament_image'] = $imagename;
							}
						} else {
							$updateData_lang['tournament_image'] = $this->input->post('exs_file');
						}

						$updateData['tournament_name'] = trim($this->input->post('name'));
						$updateData['category'] = trim($this->input->post('gamecategory'));
						$updateData['sort_by'] = trim($this->input->post('sortby'));
						$updateData['api_tournament_id'] = trim($this->input->post('apileague'));
						$updateData['status'] = $this->input->post('is_active') ? 1 : 0;
						$updateData['popular_tournament'] = $this->input->post('is_popular') ? 1 : 0;
						$updateData['show_in_list'] = $this->input->post('show_tournament') ? 1 : 0;
						$updateData['toggle_pc'] = $this->input->post('toggle_pc') ? 1 : 0;
						$updateData['toggle_cl'] = $this->input->post('toggle_cl') ? 1 : 0;
						$updateData['toggle_cr'] = $this->input->post('toggle_cr') ? 1 : 0;
						$updateData['url_key']=$this->input->post('url_key');
						$updateData['search_keywords']=$this->input->post('search_keywords');
						
						
						if ($this->session->userdata('language_code') == 'en') {
							$updateData['tournament_url'] = str_replace(" ", "-", trim($this->input->post('name')));
						}
						
						$updateData['tixstock_status']=0;
						$updateData['oneclicket_status']=0;
						foreach ($this->input->post('partner_api') as $api) {
							if($api == 1)								
								$updateData['tixstock_status'] = 1;							
							else if($api == 2)							
								$updateData['oneclicket_status'] = 1;								
							}

						$this->General_Model->update('tournament', array('t_id' => $tournament_id), $updateData);

						if($_POST['flag'] != 'content'){

						$this->db->delete('banned_countries_tournament', array('tournament_id' => $tournament_id));
						$bancountry_ids = $this->input->post('bcountry');
						foreach ($bancountry_ids as $val) {
							$this->data = array(
								'tournament_id' => $tournament_id,
								'country_id' => trim($val)
							);
							$this->db->insert('banned_countries_tournament', $this->data);
						}

						$updateData_lang['tournament_name'] = trim($this->input->post('name'));
						
						}
						//Update language table

						$this->General_Model->update('tournament_lang', array('tournament_id' => $tournament_id, 'language' => $this->session->userdata('language_code')), $updateData_lang);

						$partnerIds = $this->input->post('partner');
						$partner_ids = !empty($partnerIds) ? implode(',', $partnerIds) : '';
						
	
						$afiliateIds = $this->input->post('afiliate');
						$afiliate_ids = !empty($afiliateIds) ? implode(',', $afiliateIds) : '';
	
						$storeIds = $this->input->post('store');
						$store_ids = !empty($storeIds) ? implode(',', $storeIds) : '';
	
						$sellerIds = $this->input->post('seller');
						$seller_ids = !empty($sellerIds) ? implode(',', $sellerIds) : '';
	
						$tournament_settings_data = array();
						$tournament_settings_data['tournaments'] = $tournament_id;
						$tournament_settings_data['storefronts'] = $store_ids;
						$tournament_settings_data['partners'] = $partner_ids;
						$tournament_settings_data['afiliates'] = $afiliate_ids;
						$tournament_settings_data['sellers'] = $seller_ids;
						$tournament_settings_data['status'] = "1";
	
						// Check if the matchId exists in the database
						$existingMatch = $this->General_Model->getSingle('tournament_settings', array('tournaments' => $tournament_id));
	
						if ($existingMatch) {
							// MatchId exists, perform an update
							$this->General_Model->update('tournament_settings', array('tournaments' => $tournament_id), $tournament_settings_data);
						}						
						else {						
							$tournament_settings_data['tournaments'] = $tournament_id; 
							$this->db->insert('tournament_settings', $tournament_settings_data);
						}
						
						$response = array('status' => 1, 'msg' => 'Tournament data updated Successfully.', 'redirect_url' => base_url() . 'settings/tournaments');
						echo json_encode($response);
						exit;
					}
				}
					
					else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/tournaments/add', 'status' => 0);
					echo json_encode($response);
					exit;
				}
				}
			}
		}else if ($url_segment == "delete") {
			$t_id   = $this->uri->segment(4);
			$updateData_data['status'] = 2;
			//$delete = $this->General_Model->delete_data('tournament', 't_id', $t_id);
			$delete = $this->General_Model->update('tournament', array('t_id' => $t_id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('tournament_lang', 'tournament_id', $t_id);
				$response = array('status' => 1, 'msg' => 'Tournament data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting tournament data.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($url_segment == "delete_trash") {
			$t_id   = $this->uri->segment(4);
			$updateData_data['status'] = 1;
			//$delete = $this->General_Model->delete_data('tournament', 't_id', $t_id);
			$delete = $this->General_Model->update('tournament', array('t_id' => $t_id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('tournament_lang', 'tournament_id', $t_id);
				$response = array('status' => 1, 'msg' => 'Tournament moved from trash Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Undoing tournament data.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($url_segment == "seo_status") {
					$id   = $this->uri->segment(4);
					$updateData_data['seo_status'] = $_POST['seo_status'];

					$update = $this->General_Model->update('tournament', array('t_id' => $id), $updateData_data);
					if ($update == 1) {
						$response = array('status' => 1, 'msg' => 'Tournment SEO status updated Successfully.');
						echo json_encode($response);
						exit;
					} else {
						$response = array('status' => 1, 'msg' => 'Error While updating Tournment SEO status tournament data.');
						echo json_encode($response);
						exit;
					}
		}
		else {
			
			$row_count = $this->uri->segment(4);
			//echo $row_count;exit;
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searcht" => $search_text));
			} else {
				if ($this->session->userdata('searcht') != NULL) {
					$search_text = $this->session->userdata('searcht');
				}
			}
			$third_seg = $this->uri->segment(3);
			if($this->uri->segment(3) == ""){
				$third_seg = "untrashed";
			}

			//$this->loadRecord_v1($row_count, 'tournament', 'settings/tournaments/'.$third_seg, 't_id', 'DESC', 'event/tournaments', 'tournaments', 'tournament',$search_text);

			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
			$this->data['tournments'] = $this->General_Model->get_tournments()->result();
			$this->load->view(THEME.'/event/tournaments.php', $this->data);


		}
	}

	public function get_teams()
	{
		$search=[];
		$order_column="";
		$order_by='';
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

		$seg = $this->uri->segment(3);//echo $seg;exit;
		if($this->uri->segment(3) == ''){
		$seg = 'untrashed';
		}
		
		if (!empty(trim($_POST['teams_ids'])) || isset($_POST['status']))
		{			

			$search['teams_ids']=$_POST['teams_ids'];
			if($_POST['status']==3)
			{
				$seg = 'top';
				$search['status']="";
			}
			else
			{

				$array = explode(',', $_POST['status']);

				// Find the index of '3' in the array
				$index = array_search('3', $array);

				// If '3' is found, remove it from the array
				if ($index !== false) {
					unset($array[$index]);
					$seg = 'top';
				}

				// Convert the array back to a string using comma as the delimiter
				$newString = implode(',', $array);

				$search['status']=$newString;
			}
		
			$allcount = $this->General_Model->get_teams_by_limit('', '', '', '', '', $search,$seg)->num_rows();
			$records = $this->General_Model->get_teams_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search,$seg)->result();
		}
		else
		{
		$allcount = $this->General_Model->get_teams_by_limit('', '', '', '', '', $search,$seg)->num_rows();
		$records = $this->General_Model->get_teams_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search,$seg)->result();

		}
	
		//	echo $this->db->last_query();exit;
		$data = [];

		
		foreach($records as $record ){
			$only ='tixstock'; 

			if (UPLOAD_PATH . 'uploads/teams/' . $record->team_image) {
				$image = UPLOAD_PATH . 'uploads/teams/' . $record->team_image;
			  } else {
				$image = base_url('assets/img/placeholders/placeholder.png');
			  }
			  	$img='<img class="imgTbl" src="'.$image.'">';
			  //	$ticket_listed = $record->s_no != '' ? '<div class="bttns"><span class="badge badge-success">Yes</span></div>' : '<div class="bttns"><span class="badge badge-danger">No</span></div>';

			  $s_no=$this->General_Model->get_sell_ticket_no($record->m_id)->result();
				$record->s_no = ($s_no[0]->s_no == 0) ? "" : $s_no[0]->s_no;

			  	$ticket_listed = $record->s_no != '' ? '<div class="bttns"><span class="badge badge-success">Yes</span></div>' : '<div class="bttns"><span class="badge badge-danger">No</span></div>';
			  
			  
				  $status="";
				$status=  '<div class="bttns"> <div class="flex-table-cell" data-th="Status">';
		
				  switch ($record->status) {
					case '1':
						$status.= '<span class="badge badge-success">Active</span>';
					  break;
					case '0':
						$status.= '<span class="badge badge-danger">Inactive</span>';
					  break;
					case '2':
						$status.= '<span class="badge badge-danger">Trashed</span>';
					  break;
				  }
				
				  $status.='</div> </div>';
				  
				  $seo_status="";
				 $seo_status= '<div class="flex-table-cell" data-th="SEO Status">';
					if ($record->seo_status == 1){
						$seo_status.='<span class="badge badge-success"><i aria-hidden="true" class="fas fa-check"></i></span>';
					} else{
						$seo_status.='<span class="badge badge-warning"><i aria-hidden="true" class="fas fa-times"></i></span>';
					 }
					 $seo_status.='</div>';

					 $seo_preview="";
					 $seo_preview= '<a target="_blank" href="'.FRONT_END_URL.'/'.$this->session->userdata('language_code').'/'.$record->url_key.'" ><span class="badge"><i aria-hidden="true" class="far fa-eye"></i></span></a>';

					 $clone="";
					 $clone='<div class="bttns"><a class="badge badge-success" href="javascript:void(0);" onclick="clone_tournament('.$record->t_id.');"> Clone</a></div>';

					 //$only   =="tixstock" && $record->source_type  =="1boxoffice" ? "1boxoffice, tixstock " : "tixstock"  ;
			
					 if ($only == "tixstock") {
						 $html = '<div class="flex-table-cell" data-th="Tixsstock Status">';
						 $html .= '<div class="switch-block no-padding-all">';
						 $html .= '<label class="form-switch is-primary">';
						 $html .= '<input type="checkbox" data-id="' . $record->t_id . '" class="is-switch" data-status="' . $record->tixstock_status . '" name="tixstock_status" value="1"';
						 if ($record->tixstock_status == '1') {
							 $html .= ' checked';
						 }
						 $html .= '>';
						 $html .= '<i></i>';
						 $html .= '</label>';
						 $html .= '</div>';
						 $html .= '</div>';
					 }
					

								$edit_content  = '<div class="dropdown">
								<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
									data-toggle="dropdown">
									<i class="mdi mdi-dots-vertical fs-sm"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">';
							$edit_url = "";
					
							if ($this->session->userdata('role') != 9) {

								$edit_url = base_url().'settings/teams/add_team/'.$record->id;
								$edit_content .= '
											<a href="'.$edit_url.'" class="dropdown-item is-media">
												
													<i class="fas fa-pencil-alt mr-1"></i>
													&nbsp;Edit Team Details
											</a>';
							}
							$edit_content .= '
											<a href="'.base_url().'settings/teams/add_team/'.$record->id.'/tab-2" class="dropdown-item is-media">
												
													<i class="fas fa-pencil-alt mr-1"></i>
													&nbsp;Edit Content Details
											</a>';
							if ($this->session->userdata('role') != 9) {
								if ($record->s_no == '') {
									$edit_content .= '
											<hr class="dropdown-divider">';
									if ($record->status != 2) {
										$edit_content .= '
											<a id="branch_'.$record->id.'" href="javascript:void(0);" data-href="'.base_url().'settings/teams/delete_team/'.$record->id.'" class="dropdown-item is-media delete_action" onClick="delete_data('.$record->id.');">
												
													<i class=" fas fa-trash mr-1"></i>	
													&nbsp;Remove from list
											</a>';
									}
								}
								if ($record->status == 2) {
									$edit_content .= '
											<a id="branch_'.$record->id.'" href="javascript:void(0);" data-href="'.base_url().'settings/teams/delete_trash_team/'.$record->id.'" class="dropdown-item is-media delete_action" onClick="delete_data('.$record->id.');">
												
													<i class=" fas fa-trash mr-1"></i>
													&nbsp;Undo from trash
											</a>';
								}
							}
							
								$edit_content  .= '</div> </div>';
					 


			$data[] = array( 
				"team_name"					=> 	"<a href='".$edit_url."'>".$record->team."</a>",
				"image"						=>	$img,
				"category_name"				=> 	$record->category_name,				
				"ticket_listed"				=>	$ticket_listed,
				"status"					=>	$status,
				"seo_status"				=>	$seo_status,
				"seo_preview"				=>	$seo_preview,
				"edit_content"				=> 	$edit_content,
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
	
	 public function get_tournaments()
	 {
		$search=[];
		$order_column="";
		$order_by='';
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

		$seg = $this->uri->segment(3);//echo $seg;exit;
		if($this->uri->segment(3) == ''){
		$seg = 'untrashed';
		}
		
		if (!empty(trim($_POST['tournament_ids'])) || isset($_POST['status']) || isset($_POST['category']) )
		{			

			$search['tournament_ids']=$_POST['tournament_ids'];
			$search['status']=$_POST['status'];
			$search['category']=$_POST['category'];
		
			$allcount = $this->General_Model->get_tournament_by_limit_new('', '', '', '', '', $search,$seg)->num_rows();
			$records = $this->General_Model->get_tournament_by_limit_new($rowno, $row_per_page, $order_column, $order_by, '', $search,$seg)->result();
		}
		else
		{
		$allcount = $this->General_Model->get_tournament_by_limit_new('', '', '', '', '', $search,$seg)->num_rows();
		$records = $this->General_Model->get_tournament_by_limit_new($rowno, $row_per_page, $order_column, $order_by, '', $search,$seg)->result();
		}
	//echo $this->db->last_query();exit;
		$data = [];

		// echo '<pre/>';
		// print_r($records);
		// exit;
		foreach($records as $record ){
			$only ='tixstock'; 

			if (UPLOAD_PATH . 'uploads/tournaments/' . $record->tournament_image) {
				$image = UPLOAD_PATH . 'uploads/tournaments/' . $record->tournament_image;
			  } else {
				$image = base_url('assets/img/placeholders/placeholder.png');
			  }
			  	$img='<img class="imgTbl" src="'.$image.'">';

				$matches=$this->General_Model->get_tournmanet_sell_ticket_no($record->t_id)->row();
				$tickets ="";
				if($matches->match_ids){
					$tickets=$this->General_Model->get_match_ids_sell_ticket_no(explode(",",$matches->match_ids))->row();
				}

		
				$record->s_no = $tickets->count ?  $tickets->count :  "";

			  	$ticket_listed = $record->s_no != '' ? '<div class="bttns"><span class="badge badge-success">Yes</span></div>'  : '<div class="bttns"><span class="badge badge-danger">No</span></div>' ;
			  
				  $status="";
				$status=  '<div class="bttns"> <div class="flex-table-cell" data-th="Status">';
		
				  switch ($record->status) {
					case '1':
						$status.= '<span class="badge badge-success">Active</span>';
					  break;
					case '0':
						$status.= '<span class="badge badge-danger">Inactive</span>';
					  break;
					case '2':
						$status.= '<span class="badge badge-danger">Trashed</span>';
					  break;
				  }
				
				  $status.='</div> </div>';
				  
				  $seo_status="";
				 $seo_status= '<div class="flex-table-cell" data-th="SEO Status">';
					if ($record->seo_status == 1){
						$seo_status.='<span class="badge badge-success"><i aria-hidden="true" class="fas fa-check"></i></span>';
					} else{
						$seo_status.='<span class="badge badge-warning"><i aria-hidden="true" class="fas fa-times"></i></span>';
					 }
					 $seo_status.='</div>';

					 $seo_preview="";
					 $seo_preview= '<a target="_blank" href="'.FRONT_END_URL.'/'.$this->session->userdata('language_code').'/'.$record->url_key.'" ><span class="badge"><i aria-hidden="true" class="far fa-eye"></i></span></a>';

					 $clone="";
					 $clone='<div class="bttns"><a class="badge badge-success" href="javascript:void(0);" onclick="clone_tournament('.$record->t_id.');"> Clone</a></div>';

					 //$only   =="tixstock" && $record->source_type  =="1boxoffice" ? "1boxoffice, tixstock " : "tixstock"  ;
			
					 if ($only == "tixstock") {
						 $html = '<div class="flex-table-cell" data-th="Tixsstock Status">';
						 $html .= '<div class="switch-block no-padding-all">';
						 $html .= '<label class="form-switch is-primary">';
						 $html .= '<input type="checkbox" data-id="' . $record->t_id . '" class="is-switch" data-status="' . $record->tixstock_status . '" name="tixstock_status" value="1"';
						 if ($record->tixstock_status == '1') {
							 $html .= ' checked';
						 }
						 $html .= '>';
						 $html .= '<i></i>';
						 $html .= '</label>';
						 $html .= '</div>';
						 $html .= '</div>';
					 }
					

								$edit_content  = '<div class="dropdown">
								<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
									data-toggle="dropdown">
									<i class="mdi mdi-dots-vertical fs-sm"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">';

					$edit_url = "";
							if ($this->session->userdata('role') != 9) {

								$edit_url = base_url().'settings/tournaments/edit/'.$record->t_id;
								$edit_content .= '
											<a href="'.$edit_url.'" class="dropdown-item ">
												
												<i class="fas fa-pencil-alt mr-1"></i>													
												&nbsp;Edit Tournament Details
											</a>';
							}
							// if ($this->session->userdata('role') != 9) {
							// 	$edit_content .= '
							// 				<a href="'.base_url().'settings/tournaments/edit_settings/'.base64_encode(json_encode($record->t_id)).'" class="dropdown-item ">
												
							// 						<i class="fas fa-pencil-alt mr-1"></i>
							// 						&nbsp;Tournament Settings
							// 				</a>';
							// }
							$edit_content .= '
											<a href="'.base_url().'settings/tournaments/edit/'.$record->t_id.'?tab=content" class="dropdown-item ">
												
													<i class="fas fa-pencil-alt mr-1"></i>
													&nbsp;Edit Content Details
												
											</a>';
							if ($this->session->userdata('role') != 9) {
								if ($record->s_no == '') {
									$edit_content .= '
											<hr class="dropdown-divider">';
									if ($record->status != 2) {
										$edit_content .= '
											<a id="branch_'.$record->t_id.'" href="javascript:void(0);" data-href="'.base_url().'settings/tournaments/delete/'.$record->t_id.'" class="dropdown-item  delete_action" onClick="delete_data('.$record->t_id.');">
											
													<i class=" fas fa-trash mr-1"></i>
													&nbsp;Remove from list
											
											</a>';
									}
								}
								if ($record->status == 2) {
									$edit_content .= '
											<a id="branch_'.$record->t_id.'" href="javascript:void(0);" data-href="'.base_url().'settings/tournaments/delete_trash/'.$record->t_id.'" class="dropdown-item  delete_action" onClick="delete_data('.$record->t_id.');">
												
													<i class=" fas fa-trash mr-1"></i>
													&nbsp;Undo from trash
												
											</a>';
								}
							}
							
								$edit_content  .= '</div> </div>';
					 


			$data[] = array( 
				"s_no"						=> 	$record->t_id,
				"tournament"				=> 	"<a href='".$edit_url."' > ".$record->tournament."</a>",
				"event_category"			=>  $record->category_name,
				"image"						=>	$img,
				"ticket_listed"				=>	$ticket_listed,
				"sort_by"					=> 	$record->sort_by,
				"status"					=>	$status,
				"seo_status"				=>	$seo_status,
				"seo_preview"				=>	$seo_preview,
				"clone"						=> 	$clone,
				"source_type"				=>	$record->source_type ,
				"edit_content"				=> 	$edit_content,
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

	public function getApiLeague()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api-football-v1.p.rapidapi.com/v2/leagues",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"x-rapidapi-host: api-football-v1.p.rapidapi.com",
				"x-rapidapi-key: f84f64646cmsh2de81a07982e478p100b35jsn7e6f01dcec8d"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			//echo "cURL Error #:" . $err;
		} else {

			return json_decode($response);
		}
	}


	public function delivery_settings()
	{
		$url_segment  = $segment = $this->uri->segment(3);
		$id       = $this->uri->segment(4);
		if ($url_segment == "add") {
		$this->data['id'] = $id;
		if($id != ""){
			$this->data['delivery_types'] = $this->General_Model->get_ticket_type_category($id)->row();
		}
		
		//echo "<pre>";print_r($this->data['delivery_types']);exit;
		 $this->load->view(THEME.'settings/delivery_settings/add_delivery_settings', $this->data);
		}
		else if ($segment == 'save') {

			if($_POST['ticket_cat_id'] == ""){
				if($_POST['status'] == ""){
					$_POST['status'] = 0;
				}
				$insert_data = array(
				'category' => $_POST['category'],
				'company' => $_POST['company'],
				'currency' => $_POST['currency'],
				'delivery_cost' => $_POST['delivery_cost'],
				'status' => $_POST['status'],
				);

				$inserted_id = $this->General_Model->insert_data('ticket_type_categories', $insert_data);
				if ($inserted_id) {
				$response = array('msg' => 'New Delivery Created successfully.', 'redirect_url' => base_url() . 'settings/delivery_settings', 'status' => 1);
				} else {
				$response = array('msg' => 'Failed to Create New Delivery.', 'redirect_url' => base_url() . 'settings/delivery_settings', 'status' => 0);
				}
				echo json_encode($response);
				exit;

			}
			else{
				if($_POST['status'] == ""){
					$_POST['status'] = 0;
				}
				$insert_data = array(
				'category' => $_POST['category'],
				'company' => $_POST['company'],
				'currency' => $_POST['currency'],
				'delivery_cost' => $_POST['delivery_cost'],
				'status' => $_POST['status'],
				);

				if ($this->General_Model->update_table('ticket_type_categories', 'ticket_cat_id', $_POST['ticket_cat_id'], $insert_data)) {
						$response = array('msg' => 'Delivery Details Updated successfully.', 'redirect_url' => base_url() . 'settings/delivery_settings', 'status' => 1);
				} else {
				$response = array('msg' => 'Failed to Create New Delivery Details.', 'redirect_url' => base_url() . 'settings/delivery_settings', 'status' => 0);
				}
					echo json_encode($response);
					exit;
			}
			

		}
		 else if ($url_segment == "delete") {
			$id   = $this->uri->segment(4);
			$updateData_data['status'] = 2;
			$delete = $this->General_Model->update('ticket_type_categories', array('ticket_cat_id' => $id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('teams_lang', 'team_id', $team_id);
				$response = array('status' => 1, 'msg' => 'Delivery data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting Delivery data.');
				echo json_encode($response);
				exit;
			}
		}
		else{
		$this->data['delivery_types'] = $this->General_Model->get_ticket_type_category()->result();
		$this->load->view(THEME.'settings/delivery_settings/delivery_settings', $this->data);
		}
	}
	public function teams()
	{
		$url_segment  = $segment = $this->uri->segment(3);
		$team_id       = $this->uri->segment(4);
		if ($url_segment == "status") {
			$id =  trim($this->input->post('id')); 
			$status =  trim($this->input->post('status')); 
			$updateData = array();
			$updateData['tixstock_status'] = $status;
			$this->General_Model->update('teams', array('id' => $id), $updateData);
			//echo $this->db->last_query();
			echo "true";
			die;
					
		}
		else  if ($url_segment == "add_team") { 
				$this->data['gcategory'] = $this->General_Model->get_game_category()->result();
				$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
				$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
				if ($team_id != '') {
					$this->data['teams']      = $this->General_Model->get_team_data($team_id)->row();
					$this->data['teams_lang']      = $this->General_Model->get_team_data_lang($team_id)->row();

					// echo '<pre/>';
					// print_r($this->data['teams_lang']);
					// print_r($this->data['teams']);
					// exit;
					
				}

				$this->load->view(THEME.'event/add_team', $this->data);
			}
		else if ($url_segment == "add_team_content") {
			$this->data['gcategory'] = $this->General_Model->get_game_category()->result();

			if ($team_id != '') {
				$this->data['teams']      = $this->General_Model->get_team_data($team_id)->row();
			}

			$this->load->view(THEME.'event/add_team_content', $this->data);
		}
		
		else if ($url_segment == "save_team_content") { 

				$teamId = $this->input->post('teamId');
				
				if ($teamId != '') {
					 	if ($this->input->post()) {

					$updateData = array();
					$updateData_lang = array();

					$this->form_validation->set_rules('pagetitle', 'Page Title', 'required');
					$this->form_validation->set_rules('url_key', 'Team URL Key', 'required');

					$msg = '';
					if ($this->form_validation->run() !== false) {
							$updateData['seo_keywords'] = trim($this->input->post('seo_keywords'));
							$updateData['search_keywords'] = trim($this->input->post('search_keywords'));
							$updateData['url_key'] = trim(strtolower($this->input->post('url_key')));
							//echo "<pre>";print_r($updateData);die;

							$this->General_Model->update('teams', array('id' => $teamId), $updateData);
							//echo "<pre>";print_r($updateData);
						
						$updateData_lang['page_title'] = strip_tags($this->input->post('pagetitle'));
						$updateData_lang['meta_description'] = $this->input->post('metadescription');
						//$updateData_lang['page_content'] = trim($this->input->post('page_content'));//echo "<pre>";print_r($updateData_lang);
						//echo "<pre>";print_r(array('team_id' => $teamId, 'language' => $this->session->userdata('language_code')));exit;						

							$this->db->select('*');
							$this->db->from('teams_lang');
							$this->db->where('team_id', $teamId);
							$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
							$this->db->where('language', $this->session->userdata('language_code'));

							$query = $this->db->get();
							if ($query->num_rows() == 0) {							
								$updateData_lang['team_id'] = $teamId;
								$updateData_lang['language'] = $this->session->userdata('language_code');	
								$updateData_lang['team_name'] = trim($this->input->post('seo_team_name'));	
								$updateData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;						
								$this->db->insert('teams_lang', $updateData_lang);
							
							} else {
								$this->General_Model->update('teams_lang', array('team_id' => $teamId, 'language' => $this->session->userdata('language_code'),"store_id"=>$this->session->userdata('storefront')->admin_id), $updateData_lang);
							}

							$response = array('status' => 1, 'msg' => 'SEO data updated Successfully.' . $msg, 'redirect_url' => base_url() . 'settings/teams/add_team/'.$teamId);
						echo json_encode($response);
						exit;
					
						
					}
					else{
						$response = array('status' => 0, 'msg' => 'Oops.SEO Content Updation failed.' . $msg, 'redirect_url' => base_url() . 'settings/teams');
						echo json_encode($response);
						exit;
					}
				

					 	}
				}
				else{
					$response = array('status' => 0, 'msg' => 'Oops.Invalid Team' . $msg, 'redirect_url' => base_url() . 'settings/teams');
						echo json_encode($response);
						exit;
				}
		}
		else if ($url_segment == "save_team_onpage_content") { 
				$teamId = $this->input->post('teamId');
				//echo "<pre>";print_r($_POST);exit;
				if ($teamId != '') {
					 	if ($this->input->post()) {



					$updateData = array();
					$updateData_lang = array();

					$this->form_validation->set_rules('page_content_1', 'Page Content 1', 'required');
					$this->form_validation->set_rules('page_content_2', 'Page Content 2', 'required');
					$this->form_validation->set_rules('page_content_3', 'Page Content 3', 'required');
					$this->form_validation->set_rules('page_content_4', 'Page Content 4', 'required');

					$msg = '';
					if ($this->form_validation->run() !== false) {
							
						$updateData_lang['page_content_1'] = trim($this->input->post('page_content_1'));
						$updateData_lang['page_content_2'] = trim($this->input->post('page_content_2'));
						$updateData_lang['page_content_3'] = trim($this->input->post('page_content_3'));
						$updateData_lang['page_content_4'] = trim($this->input->post('page_content_4'));

						
						

						$this->db->select('*');
						$this->db->from('teams_lang');
						$this->db->where('team_id', $teamId);
						$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
						$this->db->where('language', $this->session->userdata('language_code'));

						$query = $this->db->get();
						if ($query->num_rows() == 0) {							
							$updateData_lang['team_id'] = $teamId;
							$updateData_lang['language'] = $this->session->userdata('language_code');		
							$updateData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;					
							$this->db->insert('teams_lang', $updateData_lang);
						
						} else {
							$this->General_Model->update('teams_lang', array('team_id' => $teamId, 'language' => $this->session->userdata('language_code')), $updateData_lang);
						}

						
						//echo "<pre>";print_r($updateData_lang);exit;
						$response = array('status' => 1, 'msg' => 'Team On Page Content updated Successfully.' . $msg, 'redirect_url' => base_url() . 'settings/teams/add_team/'.$teamId);
						echo json_encode($response);
						exit;
					
						
					}
					else{
						$response = array('status' => 0, 'msg' => 'Oops.Team Content Updation failed.' . $msg, 'redirect_url' => base_url() . 'settings/teams');
						echo json_encode($response);
						exit;
					}
				

					 	}
				}
				else{
					$response = array('status' => 0, 'msg' => 'Oops.Invalid Team' . $msg, 'redirect_url' => base_url() . 'settings/teams');
						echo json_encode($response);
						exit;
				}
		}
		else if ($url_segment == "save_team") {
			$teamId = $this->input->post('teamId');
			//Insert into table
			if ($teamId == '') {
				if ($this->input->post()) {
					$msg = '';
					$this->form_validation->set_rules('teamname', 'Team Name', 'required');
					$this->form_validation->set_rules('gamecategory', 'Game Category', 'required');
					/*$this->form_validation->set_rules('country', 'Country', 'required');
					$this->form_validation->set_rules('city', 'City', 'required');
					$this->form_validation->set_rules('stadium', 'stadium', 'required');*/

					if (!empty($_FILES['team_image']['name'])) {
						$this->form_validation->set_rules('team_image', 'Image file', 'callback_image_file_check');
					}
					if (!empty($_FILES['team_bg']['name'])) {
						$this->form_validation->set_rules('team_bg', 'Image file', 'callback_bg_image_file_check');
					}
					$insertData = array();
					$insertData['team_image']='';
					$insertData['team_bg']='';
				
					if ($this->form_validation->run() !== false) {
						if (!empty($_FILES['team_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/teams';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ($this->upload->do_upload('team_image')) {
								$outputData['team_image'] = $this->upload->data();
								//	$insertData_lang_team_image = $outputData['team_image']['file_name'];
								$insertData['team_image'] = $outputData['team_image']['file_name'];
							} else {
								$msg .= 'Failed to add team image';
							}
						}

						if (!empty($_FILES['team_bg']['name'])) {
							$config2['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/background';
							$config2['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config2['max_size'] = '10000';
							$config2['encrypt_name'] = TRUE;
							$this->load->library('upload', $config2);
							$this->upload->initialize($config2);
							if ($this->upload->do_upload('team_bg')) {
								$outputData['team_bg'] = $this->upload->data();
							//	$insertData_lang_team_bg = $outputData['team_bg']['file_name'];
								$insertData['team_bg'] = $outputData['team_bg']['file_name'];
							} else {
								$error = array('error' => $this->upload->display_errors());
								print_r($error);die;
								$msg .= 'Failed to add team background image';
							}
						}

						

						$insertData['team_name'] = trim($this->input->post('teamname'));
						$insertData['category'] = trim($this->input->post('gamecategory'));
						$insertData['country'] = trim($this->input->post('country'));
						$insertData['city'] = trim($this->input->post('city'));
						$insertData['stadium'] = trim($this->input->post('stadium'));
						$insertData['team_color'] = trim($this->input->post('teamcolor'));
						$insertData['popular_team'] = trim($this->input->post('topteam'));
						$insertData['show_status'] = trim($this->input->post('show_status')) ? trim($this->input->post('show_status')) : 2 ; 
						$insertData['create_date'] = strtotime(date('Y-m-d H:i:s'));
						$insertData['status'] = $this->input->post('is_active') ? 1 : 0;
						$insertData['page_title'] = strip_tags($this->input->post('pagetitle'));
						$insertData['meta_description'] = $this->input->post('metadescription');
						$insertData['page_content'] = trim($this->input->post('page_content'));
						$insertData['url_key'] = trim($this->input->post('url_key'));
						$insertData['team_url'] = trim($this->input->post('url_key'));

						$insertData['store_id'] = $this->session->userdata('storefront')->admin_id;
						$team_id = $this->General_Model->insert_data('teams', $insertData);

						//Add to language table
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();

						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['team_id'] = $team_id;
							$insertData_lang['team_image'] = $insertData['team_image'] ;
							$insertData_lang['team_bg'] = $insertData['team_bg'] ;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['team_name'] = trim($this->input->post('teamname'));
							$insertData_lang['team_color'] = $this->input->post('teamcolor');
							$insertData_lang['page_title'] = strip_tags($this->input->post('pagetitle'));

							$insertData_lang['meta_description'] = $this->input->post('metadescription');
							$insertData_lang['page_content'] = $insertData['page_content'];

							$this->General_Model->insert_data('teams_lang', $insertData_lang);
						}

						$response = array('status' => 1, 'msg' => 'Team Created Successfully. ' . $msg, 'redirect_url' => base_url() . 'settings/teams/add_team/'.$team_id);
						echo json_encode($response);
						exit;
					} else {
						$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/teams/add_team', 'status' => 0);
						echo json_encode($response);
						exit;
					}
				}
			} else {

				//if its an update request
				if ($this->input->post()) {

					$updateData = array();
					$updateData_lang = array();

					$this->form_validation->set_rules('teamname', 'Team Name', 'required');
					$this->form_validation->set_rules('gamecategory', 'Game Category', 'required');
					/*$this->form_validation->set_rules('country', 'Country', 'required');
					$this->form_validation->set_rules('city', 'City', 'required');
					$this->form_validation->set_rules('stadium', 'stadium', 'required');*/

					$msg = '';
					if ($this->form_validation->run() !== false) {


						if (!empty($_FILES['team_image']['name'])) {

							$teamdata = $this->General_Model->getAllItemTable_array('teams', array('id' => $teamId))->row();
							if (UPLOAD_PATH .'uploads/teams/' . $teamdata->team_image) {
								unlink(UPLOAD_PATH .'uploads/teams/' . $teamdata->team_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/teams';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '1000';
							
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if (!$this->upload->do_upload('team_image')) {
								$msg .= 'Failed to add team image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['team_image'] = $imagename;
								$updateData['team_image'] = $imagename;
							}
						} else {
							$updateData_lang['team_image'] = $this->input->post('exs_file');
						}



						if (!empty($_FILES['team_bg']['name'])) {
							$teamdata = $this->General_Model->getAllItemTable_array('teams', array('id' => $teamId))->row();
							if (@getimagesize(base_url() . './uploads/background/' . $teamdata->team_bg)) {
								unlink('./uploads/background/' . $teamdata->team_bg);
							}
							$config2['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/background';
							$config2['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config2['max_size'] = '1000';
							$config2['encrypt_name'] = TRUE;
							$this->load->library('upload', $config2);
							$this->upload->initialize($config2);
							if (!$this->upload->do_upload('team_bg')) {
								
								$msg .= 'Failed to add team background image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['team_bg'] = $imagename;
								$updateData['team_bg'] = $imagename;
							}
						} else {
							$updateData_lang['team_bg'] = $this->input->post('exs_filebg');
						}
						$updateData_lang['team_name'] = $this->input->post('teamname');
						$updateData['team_name'] = trim($this->input->post('teamname'));
						$updateData['category'] = trim($this->input->post('gamecategory'));
						$updateData['country'] = trim($this->input->post('country'));
						$updateData['city'] = trim($this->input->post('city'));
						$updateData['stadium'] = trim($this->input->post('stadium'));
						$updateData['team_color'] = trim($this->input->post('teamcolor'));
						$updateData['url_key'] = trim($this->input->post('url_key'));
						$updateData['popular_team'] = trim($this->input->post('topteam'));
						$updateData['header_top_teams'] = trim($this->input->post('header_footer'));
						$updateData['show_status'] = trim($this->input->post('show_status')) ? trim($this->input->post('show_status'))  : 2 ;
						$updateData['create_date'] = strtotime(date('Y-m-d H:i:s'));
						$updateData['status'] = $this->input->post('is_active') ? 1 : 0;
						
						$this->General_Model->update('teams', array('id' => $teamId), $updateData);

					
						$this->db->select('*');
							$this->db->from('teams_lang');
							$this->db->where('team_id', $teamId);
							$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
							$this->db->where('language', $this->session->userdata('language_code'));
							$query = $this->db->get();
							// echo $this->db->last_query();exit;
							if ($query->num_rows() == 0) {							
								$updateData_lang['team_id'] = $teamId;
								$updateData_lang['language'] = $this->session->userdata('language_code');						
								$updateData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;	
											
								$this->db->insert('teams_lang', $updateData_lang);
							
							} else {
								$this->General_Model->update('teams_lang', array('team_id' => $teamId, 'language' => $this->session->userdata('language_code')), $updateData_lang);

							}

											
						//$this->General_Model->update('teams_lang', array('team_id' => $teamId, 'language' => $this->session->userdata('language_code')), $updateData_lang);

						$response = array('status' => 1, 'msg' => 'Team data updated Successfully.' . $msg, 'redirect_url' => base_url() . 'settings/teams/add_team/'.$teamId);
						echo json_encode($response);
						exit;
					}
				}

				else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/teams/add_team', 'status' => 0);
					echo json_encode($response);
					exit;
				}
			}

		}
		else if ($url_segment == "seo_status") {
					$id   = $this->uri->segment(4);
					$updateData_data['seo_status'] = $_POST['seo_status'];

					$update = $this->General_Model->update('teams', array('id' => $id), $updateData_data);
					if ($update == 1) {
						$response = array('status' => 1, 'msg' => 'Team SEO status updated Successfully.');
						echo json_encode($response);
						exit;
					} else {
						$response = array('status' => 1, 'msg' => 'Error While updating team SEO status tournament data.');
						echo json_encode($response);
						exit;
					}
		}
		else if ($url_segment == "delete_team") {
			$team_id   = $this->uri->segment(4);
			//$delete = $this->General_Model->delete_data('teams', 'id', $team_id);
			$updateData_data['status'] = 2;
			$delete = $this->General_Model->update('teams', array('id' => $team_id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('teams_lang', 'team_id', $team_id);
				$response = array('status' => 1, 'msg' => 'Team data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting team data.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($url_segment == "delete_trash_team") {
			$team_id   = $this->uri->segment(4);
			$updateData_data['status'] = 1;
			$delete = $this->General_Model->update('teams', array('id' => $team_id), $updateData_data);
			if ($delete == 1) {
			//	$this->General_Model->delete_data('teams_lang', 'team_id', $team_id);
				$response = array('status' => 1, 'msg' => 'Team Moved from trash Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Undoing team data.');
				echo json_encode($response);
				exit;
			}
		} else {
			//$row_count = $this->uri->segment(3);
			$row_count = $this->uri->segment(4);
			$seg = $this->uri->segment(3);
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchteam" => $search_text));
			} else {
				if ($this->session->userdata('searchteam') != NULL) {
					$search_text = $this->session->userdata('searchteam');
				}
			}
			//$this->loadRecord_v1($row_count, 'teams', 'settings/teams/'.$seg, 'id', 'DESC', 'event/teams', 'teams', 'teams',$search_text);
			$this->data['teams_name']=$this->General_Model->get_teams()->result();
			$this->load->view(THEME.'event/teams', $this->data);


		}
	}
	/**
	 * Fetch data and display based on the pagination request
	 */
	public function loadRecord_v1($rowno = 0, $table, $url, $order_column, $order_by, $view, $variable_name, $type, $search = '')
	{

		// Load Pagination library
		$this->load->library('pagination');

		// Row per page
		//$row_per_page = 10;
		$row_per_page = 10;

		// Row position
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}
		// All records count
		$allcount = $this->General_Model->get_table_row_count($table, '');
		//echo $type;exit;
		if ($type == 'teams') {
			$seg = $this->uri->segment(3);
			if($this->uri->segment(3) == ''){
				$seg = 'untrashed';
			}
			$allcount = $this->General_Model->get_teams_by_limit('', '', '','', '',$search,$seg)->num_rows();
			$record = $this->General_Model->get_teams_by_limit($rowno, $row_per_page, $order_column, $order_by, '',$search,$seg)->result();
		} else if ($type == 'tournament') {
			$seg = $this->uri->segment(3);//echo $seg;exit;
			if($this->uri->segment(3) == ''){
				$seg = 'untrashed';
			}
			$allcount = $this->General_Model->get_tournament_by_limit('', '', '', '', '', $search,$seg)->num_rows();
			$record = $this->General_Model->get_tournament_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search,$seg)->result();

		} else {

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
		// Load view
		$this->load->view($view, $this->data);
	}

	public function email_logs()
	{
			$type = $this->uri->segment(3);
			$row_count = $this->uri->segment(4);
			$this->loadRecord($row_count, 'email_logs', 'settings/email_logs/'.$type, 'id', 'DESC', 'settings/email_logs','email_logs', 'id',$type);
	}

	public function abandoned_cart()
	{
		$segment = $this->uri->segment(3);
		if($segment == "send"){
			$this->data['tournaments'] =  $this->General_Model->get_tournments()->result();
				
			$this->load->view('settings/email_settings/abandoned_cart', $this->data);

		}
		if($segment == "ajax_checkout"){
			$tournment_id = $_GET['tournament'];
			$start_date = $_GET['start_date'];
			$end_date = $_GET['end_date'];

			$this->db->select("booking_global.*, booking_billing_address.first_name,booking_billing_address.last_name,booking_billing_address.email,booking_tickets.match_name,booking_tickets.*,register.first_name as buyer_first_name, register.last_name as buyer_last_name, register.email as buyer_email,booking_global.created_at as cart_date");
			$this->db->join('booking_billing_address','booking_billing_address.booking_id = booking_global.bg_id');
		
			$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
			$this->db->join('register','register.id = booking_global.user_id');
                          
			$this->db->join('match_info','match_info.m_id = booking_tickets.match_id','left');
			$this->db->where('DATE(match_info.match_date) >=', date("Y-m-d"));
			$this->db->where('booking_status','7');
			if($tournment_id){
				$this->db->where('booking_tickets.tournament_id',$tournment_id);
			}
			
			if ($start_date) {
				$this->db->where('booking_global.created_at >= ', date("Y-m-d 00:00", strtotime($start_date)));
			}
			if ($end_date) {
				$this->db->where('booking_global.created_at <= ', date("Y-m-d 23:59", strtotime($end_date)));
			}
			//$this->db->group_by('')
			$this->db->group_by("booking_global.bg_id");
			$query = $this->db->get('booking_global');
			$data = $query->result();
			//echo $query->num_rows();
			//echo $this->db->last_query();
			$output = array();
			foreach($data as $row){
			
				$this->db->select("booking_global.bg_id");
				$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
				$this->db->join('match_info','match_info.m_id = booking_tickets.match_id','left')
						
		                 ->where('booking_tickets.match_id',$row->match_id)
		                 ->where('booking_tickets.ticket_id',$row->ticket_id)
		                 ->where('booking_global.user_id',$row->user_id);
		             

		    			// if ($start_date) {
						// 	$this->db->where('booking_global.created_at >= ', date("Y-m-d 00:00:00", strtotime($start_date)));
						// }
						// if ($end_date) {
						// 	$this->db->where('booking_global.created_at <= ', date("Y-m-d 23:59:59", strtotime($end_date)));
						// }

		                $this->db->group_start();
						$this->db->where('booking_global.booking_status',1)
						->or_where('booking_global.booking_status',2)
						->or_where('booking_global.booking_status',4)
						->or_where('booking_global.booking_status',5)
						->or_where('booking_global.booking_status',6);
						$this->db->group_end();
						$this->db->group_by("booking_global.bg_id");
				$query = $this->db->get('booking_global') ; 
				$count = $query->num_rows();
				
				
				if($count == 0 ){
					
					if(@$email_data[$row->buyer_email] == ""){

						$email_data[$row->buyer_email] =  $row->buyer_email;
			      
						$output[]  = array(
										'bg_id'  => $row->bg_id,
										'customer_name'  => $row->buyer_first_name."".$row->buyer_last_name,
										'customer_email' => $row->buyer_email,
										'match_name'	 => $row->match_name,
										'tournament'	 => $row->tournament_name,
										'cart_date'	 => $row->cart_date,
						);
					}
				}
              	

			}
			//echo "<pre>";print_r($output);
			echo json_encode(
					array(
						'status' => 1 , 
						'html' => $output, 
						'count' => count($output) 
					)
				);
			 die;
		}
		if($segment == "send_email"){
			die;
			if( $_POST['from_date'] &&  $_POST['to_date']){

				$tournament = $_POST['tournament'];
				$from_date = $_POST['from_date'];
				$to_date = $_POST['to_date'];
				
				$handle = curl_init();
				 $url = API_CRON_URL.'cart?tournament='.$tournament.'&from_date='.$from_date.'&to_date='.$to_date;

				curl_setopt($handle, CURLOPT_HTTPHEADER, array(
				'domainkey: https://www.1boxoffice.com/en/'
				));
				curl_setopt($handle, CURLOPT_URL, $url);
				curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($handle);
				curl_close($handle);
				echo $output;
				$response = array('status' => 1, 'msg' => 'Successfully Send');
				echo json_encode($response);
				exit;
			}
			else{

				$response = array('msg' => 'From and To date required.', 'redirect_url' => base_url() . 'settings/sendemail/send', 'status' => 0);
				echo json_encode($response);
				exit;
			}
			
			echo "<pre>";
			print_r($insert_data);
			die;
		}
		
		
	}

	public function email_export($type="",$export_table="")
	{

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$delimiter = ",";
    	$filename = $type."-". date('Y-m-d h:i:s')."-".time().".csv";
		$f = fopen('php://memory', 'w');

		if($export_table == 1 ){
			if ($type == 'abondaned') {
				$this->db->where('email_logs.email_type', 'Cart Abandoned');
			}
			if ($type == 'tickets') {
				$this->db->where('email_logs.email_type', 'Ticket Available');
			}
			if ($type == 'orders') {
				$this->db->like('email_logs.email_type', 'order');
			}
			$this->db->group_by('email_logs.customer_email');
			//$this->db->limit(10);
			$query = $this->db->get('email_logs');
			//echo $this->db->last_query();die;
			if($query->num_rows()){
				$results = $query->result();
				foreach($results as $row){
					$lineData = array(
						$row->email_type,
						$row->customer_name,
						$row->customer_email,
					);
					// fputs($f, $lineData =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
					 fputcsv($f, $lineData, $delimiter);

					//echo "<pre>";print_r($lineData);
	        		//fputcsv($f, $lineData, $delimiter);
				}
			}
		}

		else if($export_table == 2 ){
			$this->db->select("request_tickets.full_name,request_tickets.email_id");
			
	
		
			$query = $this->db->get('request_tickets');

			//echo $this->db->last_query(); die;


			if($query->num_rows()){
				$results = $query->result();
				foreach($results as $row){
					$lineData = array(
						
						$row->full_name, 
						$row->email_id, 
					); 
					//print_r($lineData);
					fputcsv($f, $lineData, $delimiter);
				}
			}
		}

		else if($export_table == 3 ){
			$this->db->select("register.first_name,register.last_name,register.email");
			$query = $this->db->get('register');

			//echo $this->db->last_query(); die;


			if($query->num_rows()){
				$results = $query->result();
				foreach($results as $row){
					$lineData = array(
						
						$row->first_name." ".$row->last_name, 
						$row->email, 
					); 
					//print_r($lineData);
					fputcsv($f, $lineData, $delimiter);
				}
			}
		}

		else if($export_table == 4 ){
			$this->db->select("booking_billing_address.first_name,booking_billing_address.last_name,booking_billing_address.email");
			$this->db->where('booking_status','1');
			$this->db->join('booking_billing_address','booking_billing_address.booking_id = booking_global.bg_id ');
			$query = $this->db->get('booking_global');

			//echo $this->db->last_query(); die;


			if($query->num_rows()){
				$results = $query->result();
				foreach($results as $row){
					$lineData = array(
						
						$row->first_name." ".$row->last_name, 
						$row->email, 
					); 
					//print_r($lineData);
					fputcsv($f, $lineData, $delimiter);
				}
			}
		}
		
					 // Move back to beginning of file 
		    fseek($f, 0); 
		     
		    // Set headers to download file rather than displayed 
		    header('Content-Type: application/vnd.ms-excel');
		    header('Content-Disposition: attachment; filename="' . $filename . '";');

		    //output all remaining data on a file pointer
		    fpassthru($f);

		
	}

	public function email_settings()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'edit_email_access') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['email_access'] = $this->General_Model->getAllItemTable('email_access', 'id', $edit_id, 'id', 'DESC')->row();
			}
			$this->load->view(THEME.'settings/email_settings/edit_email_access', $this->data);
		} else if ($segment == 'email_list') {
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'email_access', 'settings/email_settings/email_list', 'id', 'DESC', 'settings/email_settings/email_access', 'email_access');
			$this->load->view(THEME.'settings/email_settings/email_access', $this->data);
		} else if ($segment == 'save_email_settings') {

			$this->form_validation->set_rules('smtp', 'SMTP', 'required');
			$this->form_validation->set_rules('host', 'Host', 'required');
			$this->form_validation->set_rules('port', 'Port', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($_POST['status']=="")
					$_POST['status']=0;
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'smtp' => $_POST['smtp'],
					'host' => $_POST['host'],
					'port' => $_POST['port'],
					'username' => $_POST['username'],
					'status' => $_POST['status'],
					'password' => $_POST['password'],
				);
				if ($_POST['id'] == '') {
					$response = array('msg' => 'You Cant able to new email access settings.', 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 0);
					echo json_encode($response);
					exit;
				} else {
					$access_id = $_POST['id'];
					if ($this->General_Model->update_table('email_access', 'id', $access_id, $insert_data)) {
						$response = array('msg' => 'Email Access Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Email Access details.', 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/email_settings/email_list', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}


	public function seller_settings()
	{

		//echo "<pre>";print_r($this->session->userdata('role'));

		$segment = $this->uri->segment(3);

		if ($segment == 'add_seller_settings') {

			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {

				$edit_id = $edit_id = $this->uri->segment(4);
				$this->data['markup'] = $this->General_Model->getAllItemTable('tickets_markup', 'id', $edit_id, 'id', 'DESC')->row();
				// echo '<pre/>';
				// print_r($this->data['markup']);
				// exit;
			}
			$this->data['role']    = 1;
			$this->data['heading']    = "Seller";
			$this->data['sellers'] = $this->General_Model->get_admin_details_by_role($this->data['role'], 'ACTIVE');
			//echo "<pre>";print_r($this->data['sellers']);exit;
			$this->load->view(THEME.'settings/seller_settings/add_seller_settings', $this->data);

		} else if ($segment == 'add_partner_settings') {

			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {

				$edit_id = $edit_id = $this->uri->segment(4);
				$this->data['markup'] = $this->General_Model->getAllItemTable('tickets_markup', 'id', $edit_id, 'id', 'DESC')->row();
			}
			$this->data['role']    = 2;
			$this->data['heading']    = "Partner";
			$this->data['sellers'] = $this->General_Model->get_admin_details_by_role($this->data['role'], 'ACTIVE');
			//echo "<pre>";print_r($this->data['sellers']);exit;
			$this->load->view(THEME.'settings/seller_settings/add_seller_settings', $this->data);
		} else if ($segment == 'add_afliliate_settings') {

			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {

				$edit_id = $this->uri->segment(4);
				$this->data['markup'] = $this->General_Model->getAllItemTable('tickets_markup', 'id', $edit_id, 'id', 'DESC')->row();
			}
			$this->data['role']    = 3;		
			$this->data['heading']    = "Afliliate";	
			$this->data['sellers'] = $this->General_Model->get_admin_details_by_role($this->data['role'], 'ACTIVE');
			//echo "<pre>";print_r($this->data['sellers']);exit;
			$this->load->view(THEME.'settings/seller_settings/add_seller_settings', $this->data);
		} else if ($segment == 'seller_settings_list') {
			
			$this->data['role']    = 1;
			$this->data['heading']    = "Seller";
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'tickets_markup', 'settings/seller_settings/seller_settings_list', 'tickets_markup.id', 'DESC', 'settings/seller_settings/seller_settings_list', 'markups', 1);
			$this->load->view(THEME.'settings/seller_settings/seller_settings_list', $this->data);

		} else if ($segment == 'partner_settings_list') {
			$this->data['role']    = 2;
			$this->data['heading']    = "Partner ";
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'tickets_markup', 'settings/seller_settings/seller_settings_list', 'tickets_markup.id', 'DESC', 'settings/seller_settings/seller_settings_list', 'markups', 2);
			$this->load->view(THEME.'settings/seller_settings/seller_settings_list', $this->data);
		} else if ($segment == 'afliliate_settings_list') {
			$this->data['role']    = 3;
			$this->data['heading']    = "Afliliate ";
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'tickets_markup', 'settings/seller_settings/seller_settings_list', 'tickets_markup.id', 'DESC', THEME.'settings/seller_settings/seller_settings_list', 'markups', 3);
		
			$this->load->view(THEME.'settings/seller_settings/seller_settings_list', $this->data);
		} else if ($segment == 'delete_seller_markup') {

			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('tickets_markup', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Markup details deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Markup details.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_markup') {



			$this->form_validation->set_rules('user_id', 'Seller', 'required');
			$this->form_validation->set_rules('markup', 'Markup Value', 'required');

			if ($_POST['role'] == 1) {
				$user_type = 'seller';
			} else if ($_POST['role'] == 2) {
				$user_type = 'partner';
			} else if ($_POST['role'] == 3) {
				$user_type = 'afliliate';
			}
			$user_role = $this->session->userdata('role');

			if ($user_role == 6) {

				$markup_type = "TO_SELLER";
				if ($_POST['role'] == 2) {
				$markup_type = 'TO_PARTNER';
				}
			} else {

				$markup_type = "TO_CUSTOMER";
			}



			if ($this->form_validation->run() !== false) {
				if($_POST['status']=="")
					$_POST['status']='0';

				$insert_data = array(
					'user_id' => $_POST['user_id'],
					'user_role' => $_POST['role'],
					'markup' => $_POST['markup'],
					'markup_type' => $markup_type,
					'status' => $_POST['status'],
					'store_id' => $this->session->userdata('storefront')->admin_id,
					'add_by' => $this->session->userdata('admin_id')
				);
			
				if ($_POST['id'] == '') {

					$inserted_id = $this->General_Model->insert_data('tickets_markup', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'New Markup Created successfully.', 'redirect_url' => base_url() . 'settings/seller_settings/'.$user_type.'_settings_list', 'status' => 1);

						//settings/seller_settings/afliliate_settings_list
					} else {
						$response = array('msg' => 'Failed to Create New Markup.', 'redirect_url' => base_url() . 'settings/seller_settings/'.$user_type.'_settings_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$id = $_POST['id'];


					if ($this->General_Model->update_table('tickets_markup', 'id', $id, $insert_data)) {
						$response = array('msg' => ucfirst($user_type).' Markup details updated Successfully.', 'redirect_url' => base_url() . 'settings/seller_settings/'.$user_type.'_settings_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update '.ucfirst($user_type).' Markup details.', 'redirect_url' => base_url() . 'settings/seller_settings/'.$user_type.'_settings_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seller_settings/' . $user_type . '_settings_list', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	public function sitefee_settings()
	{

		//echo "<pre>";print_r($this->session->userdata('role'));

		$segment = $this->uri->segment(3);

		if ($segment == 'add_sitefee_settings') {
		
			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {
				$edit_id =  $this->uri->segment(4);
				$this->data['markup'] = $this->General_Model->getAllItemTable('sitefee_markup', 'id', $edit_id, 'id', 'DESC')->row();
			}
			$this->data['tournments']   = $this->General_Model->get_tournments()->result();
			$this->data['storefronts']  = $this->General_Model->get_admin_details_by_role_v1(4, 'status');
			$this->load->view(THEME.'settings/sitefee_settings/add_sitefee_settings', $this->data);
		} else if ($segment == 'sitefee_settings_list') {
			$this->data['role']    = 1;
			$row_count = $this->uri->segment(4); 
			//$this->loadRecord($row_count, 'sitefee_markup', 'settings/sitefee_settings/sitefee_settings_list', 'sitefee_markup.id', 'DESC', 'settings/sitefee_settings/sitefee_settings_list', 'markups', 1);
			$this->load->view(THEME.'settings/sitefee_settings/sitefee_settings_list', $this->data);

		} else if ($segment == 'delete_sitefee_markup') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('sitefee_markup', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Markup details deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Markup details.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_markup') {
			$this->form_validation->set_rules('t_id', 'Tournament', 'required');
			$this->form_validation->set_rules('markup', 'Markup Value', 'required');
			if ($this->form_validation->run() !== false) {
				$user_role = $this->session->userdata('role');
				if ($user_role == 6) {
					$markup_type = "TO_SELLER";
				} else {
					$markup_type = "TO_CUSTOMER";
				}
				if($_POST['status']=="")
				 	$_POST['status']='0';

				$insert_data = array(
					't_id' => $_POST['t_id'],
					'match_id' => $_POST['m_id'],
					'markup' => $_POST['markup'],
					'markup_type' => $markup_type,
					'status' => $_POST['status'],
					'store_id' => $this->session->userdata('storefront')->admin_id,
					'add_by' => $this->session->userdata('admin_id')
				);
				
				if ($_POST['id'] == '') {
					$inserted_id = $this->General_Model->insert_data('sitefee_markup', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'New Markup Created successfully.', 'redirect_url' => base_url() . 'settings/sitefee_settings/sitefee_settings_list','status' => 1);
					} else {
						$response = array('msg' => 'Failed to Create New Markup.', 'redirect_url' => base_url() . 'settings/sitefee_settings/sitefee_settings_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$id = $_POST['id'];
					if ($this->General_Model->update_table('sitefee_markup', 'id', $id, $insert_data)) {
						$response = array('msg' => 'Markup details updated Successfully.', 'redirect_url' => base_url() . 'settings/sitefee_settings/sitefee_settings_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Markup details.', 'redirect_url' => base_url() . 'settings/sitefee_settings/sitefee_settings_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/sitefee_settings/sitefee_settings_list', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

 function get_currency($from_currency,$to_currency,$amount,$symbol="")
    {
     
        $currency_sym = "";
        if($symbol){
             $currency_type = $this->General_Model->getAllItemTable('currency_types', 'currency_code', $to_currency, 'id', 'DESC')->row();

            //pr($currency_type);
            $currency_sym =  $currency_type->symbol." ";
        }
        //echo $from_currency."--".$to_currency;
        if($amount == 0)  $total_amount =  $amount;
        $total_amount = $amount;
        if($from_currency  !=  $to_currency){

            $currency = $this->General_Model->getAllItemTable_array('currency_converter',array('from_code' => $from_currency,'to_code' => $to_currency))->row();

            $total_amount =  @$currency->rates * @$amount;
        }
        return $currency_sym.($total_amount);
        //return $currency_sym.number_format((float)$total_amount, 2, '.', ''); 

        //return $currency_sym.round($total_amount,2);  
    }


	public function discount_coupons()
	{

		// ini_set('display_errors', 1);
		// 	ini_set('display_startup_errors', 1);
		// 	error_reporting(E_ALL);

		$this->data['currency'] = $this->General_Model->get_all_currency_types()->result();
		if($_POST['coupon_type']==2)
		{
			$_POST['coupon_currency']="";
			$_POST['coupon_value']=$_POST['coupon_value_percent'];
		}

		$segment = $this->uri->segment(3);
		if($segment == 'change_tournment'){

				
				$tournment_id= $_POST['t_id'];
				$record = $this->General_Model->get_matches('','upcoming','','','','','','',$tournment_id)->result();
				$v1[]="<option value=''>Choose Match</option>";
				if(isset($record[0])){
					foreach($record as $v){
						if($_POST['m_id']==$v->m_id)
							$v1[]="<option value=".$v->m_id." selected>".$v->match_name."</option>";
						else
							$v1[]="<option value=".$v->m_id.">".$v->match_name."</option>";
					}
					echo json_encode(array("status"=>1,"val"=>$v1));exit;
				} else {
					echo json_encode(array("status"=>0,"val"=>''));exit;
				}
		}
		else if ($segment == 'update_coupon_status') {
			$segment4 = $this->uri->segment(4);
			$status = $segment4;
			$status_data = array(
							'site_value'		=> $status
			);
			$store_id = 13;
			$site_name = 'SITE_COUPON';
			$update = $this->General_Model->update_coupon_status($status_data, $site_name,$store_id);
			//echo $this->db->last_query();
			if ($update == 1) {
				$response = array('status' => 1, 'msg' => 'Coupon Status Updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Coupon details.');
				echo json_encode($response);
				exit;
			}
		}else if ($segment == 'add_discount_coupon') {
			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {

				$edit_id = $edit_id = json_decode(base64_decode($this->uri->segment(4)));
				$this->data['coupons'] = $this->General_Model->getAllItemTable('coupon_code', 'c_id', $edit_id, 'c_id', 'DESC')->row();
			}


			$this->load->view('settings/coupons/add_coupon', $this->data);
		} 

		else if ($segment == 'coupon_by_id') {
			//$edit_id = $edit_id = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $this->uri->segment(4);
			$this->data['coupons'] = $this->General_Model->getAllItemTable('coupon_code', 'c_id', $edit_id, 'c_id', 'DESC')->row();
			$total_coupon_prices = @$this->data['coupons']->coupon_value;
			if(@$this->data['coupons']->coupon_code != ""){
				$applied_coupons = $this->General_Model->getAllItemTable('coupon_logs', 'coupon_code', $this->data['coupons']->coupon_code, 'cl_id', 'DESC')->result();
				$applied_prices = array();
				foreach($applied_coupons as $applied_coupon){

					$coupon_applied_currency = $applied_coupon->currency;
					$coupon_currency 	  = $this->data['coupons']->currency_type;
					$coupon_currency_data = $this->General_Model->getAllItemTable('currency_types', 'id', $coupon_currency, 'id', 'DESC')->row();
					$coupon_cuurency = trim($coupon_currency_data->currency_code);
					//echo $coupon_applied_currency.'='.trim($coupon_currency_data->currency_code);exit;
					$coupon_price_v1        =  $this->get_currency($coupon_applied_currency,trim($coupon_currency_data->currency_code),$applied_coupon->applied_discount_amount,0);
					$applied_prices[] = $coupon_price_v1;

					 


				} 
				$applied_total_prices = number_format(array_sum($applied_prices),2);
				$remaining_coupon_value = $total_coupon_prices - $applied_total_prices;

			}
			
			$this->data['coupons']->remaining_coupon_value = number_format($remaining_coupon_value,2);
			echo json_encode($this->data['coupons']);
		}
		else if ($segment == 'discount_coupon_list') {
			$row_count = $this->uri->segment(4);
			$this->loadRecord($row_count, 'coupon_code', 'settings/discount_coupons/discount_coupon_list', 'c_id', 'DESC', THEME.'settings/coupons/coupon_list', 'coupons');
		} else if ($segment == 'delete_coupon') {

			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('coupon_code', 'c_id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Coupon details deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Coupon details.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_coupon') {
 
			$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
			$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required');
			$this->form_validation->set_rules('coupon_value', 'Coupon Value', 'required');
			// $this->form_validation->set_rules('min_price', 'Min Price Range', 'required');
			// $this->form_validation->set_rules('max_price', 'Max Price Range', 'required');
			$this->form_validation->set_rules('create_date', 'Start Date', 'required');
			$this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'coupon_code' => $_POST['coupon_code'],
					'coupon_type' => $_POST['coupon_type'],
					'coupon_value' => $_POST['coupon_value'],
					'currency_type' => $_POST['coupon_currency'],
					'min_price' => $_POST['min_price'],
					'max_price' => $_POST['max_price'],
					'usage_limit' => $_POST['usage_limit'],
					'm_id' => 0,
					't_id' => $_POST['t_id'],
					'status' => 1,
					'expiry_date' => date('Y-m-d', strtotime($_POST['expiry_date'])),
					'create_date' => date('Y-m-d', strtotime($_POST['create_date'])),
				);
				$insert_data['credit_note'] = 0;
				if($_POST['credit_note'] == 1){
					$insert_data['credit_note'] = 1;
				}
				if ($_POST['id'] == '') {

					$inserted_id = $this->General_Model->insert_data('coupon_code', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'New Coupon Created successfully.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to Create New Coupon.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$id = $_POST['id'];


					if ($this->General_Model->update_table('coupon_code', 'c_id', $id, $insert_data)) {
						$response = array('msg' => 'Coupon details updated Successfully.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Coupon details.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	public function credit_note_coupons()
	{

		$this->data['currency'] = $this->General_Model->get_all_currency_types()->result();
		if($_POST['coupon_type']==2)
		{
			$_POST['coupon_currency']="";
			$_POST['coupon_value']=$_POST['coupon_value_percent'];
		}

		$segment = $this->uri->segment(3);
		
		if ($segment == 'add_discount_coupon') {
			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {

				$edit_id = $edit_id = json_decode(base64_decode($this->uri->segment(4)));
				$this->data['coupons'] = $this->General_Model->getAllItemTable('coupon_code', 'c_id', $edit_id, 'c_id', 'DESC')->row();
			}


			$this->load->view('settings/coupons/add_coupon', $this->data);
		} 

		else if ($segment == 'coupon_by_id') {
			//$edit_id = $edit_id = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $this->uri->segment(4);
			$this->data['coupons'] = $this->General_Model->getAllItemTable('coupon_code', 'c_id', $edit_id, 'c_id', 'DESC')->row();
			$total_coupon_prices = @$this->data['coupons']->coupon_value;
			if(@$this->data['coupons']->coupon_code != ""){
				$applied_coupons = $this->General_Model->getAllItemTable('coupon_logs', 'coupon_code', $this->data['coupons']->coupon_code, 'cl_id', 'DESC')->result();
				$applied_prices = array();
				foreach($applied_coupons as $applied_coupon){

					$coupon_applied_currency = $applied_coupon->currency;
					$coupon_currency 	  = $this->data['coupons']->currency_type;
					$coupon_currency_data = $this->General_Model->getAllItemTable('currency_types', 'id', $coupon_currency, 'id', 'DESC')->row();
					$coupon_cuurency = trim($coupon_currency_data->currency_code);
					//echo $coupon_applied_currency.'='.trim($coupon_currency_data->currency_code);exit;
					$coupon_price_v1        =  $this->get_currency($coupon_applied_currency,trim($coupon_currency_data->currency_code),$applied_coupon->applied_discount_amount,0);
					$applied_prices[] = $coupon_price_v1;

					 


				} 
				$applied_total_prices = number_format(array_sum($applied_prices),2);
				$remaining_coupon_value = $total_coupon_prices - $applied_total_prices;

			}
			
			$this->data['coupons']->remaining_coupon_value = number_format($remaining_coupon_value,2);
			echo json_encode($this->data['coupons']);
		}
		else if ($segment == 'discount_coupon_list') {
			$row_count = $this->uri->segment(4);
			$this->loadRecord($row_count, 'coupon_code', 'settings/credit_note_coupons/discount_coupon_list', 'c_id', 'DESC', THEME.'settings/coupons/credit_note_list', 'coupons');
		} else if ($segment == 'delete_coupon') {

			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('coupon_code', 'c_id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Credit Note Coupon details deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Credit Note Coupon details.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_coupon') {
 
			$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
			$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required');
			$this->form_validation->set_rules('coupon_value', 'Coupon Value', 'required');
			// $this->form_validation->set_rules('min_price', 'Min Price Range', 'required');
			// $this->form_validation->set_rules('max_price', 'Max Price Range', 'required');
			$this->form_validation->set_rules('create_date', 'Start Date', 'required');
			$this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'coupon_code' => $_POST['coupon_code'],
					'coupon_type' => $_POST['coupon_type'],
					'coupon_value' => $_POST['coupon_value'],
					'currency_type' => $_POST['coupon_currency'],
					'min_price' => $_POST['min_price'],
					'max_price' => $_POST['max_price'],
					'usage_limit' => $_POST['usage_limit'],
					'm_id' => 0,
					't_id' => $_POST['t_id'],
					'status' => 1,
					'expiry_date' => date('Y-m-d', strtotime($_POST['expiry_date'])),
					'create_date' => date('Y-m-d', strtotime($_POST['create_date'])),
				);
				$insert_data['credit_note'] = 0;
				if($_POST['credit_note'] == 1){
					$insert_data['credit_note'] = 1;
				}
				if ($_POST['id'] == '') {

					$inserted_id = $this->General_Model->insert_data('coupon_code', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'New Credit Note Coupon Created successfully.', 'redirect_url' => base_url() . 'settings/credit_note_coupons/discount_coupon_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to Create New Credit Note Coupon.', 'redirect_url' => base_url() . 'settings/credit_note_coupons/discount_coupon_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$id = $_POST['id'];


					if ($this->General_Model->update_table('coupon_code', 'c_id', $id, $insert_data)) {
						$response = array('msg' => 'Credit Note Coupon details updated Successfully.', 'redirect_url' => base_url() . 'settings/credit_note_coupons/discount_coupon_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Credit Note Coupon details.', 'redirect_url' => base_url() . 'settings/credit_note_coupons/discount_coupon_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/credit_note_coupons/discount_coupon_list', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}
	public function discount_coupons_sep22()
	{

		// ini_set('display_errors', 1);
		// 	ini_set('display_startup_errors', 1);
		// 	error_reporting(E_ALL);

		$segment = $this->uri->segment(3);
		if($segment == 'change_tournment'){

				
				$tournment_id= $_POST['t_id'];
				$record = $this->General_Model->get_matches('','upcoming','','','','','','',$tournment_id)->result();
				$v1[]="<option value=''>Choose Match</option>";
				if(isset($record[0])){
					foreach($record as $v){
						if($_POST['m_id']==$v->m_id)
							$v1[]="<option value=".$v->m_id." selected>".$v->match_name."</option>";
						else
							$v1[]="<option value=".$v->m_id.">".$v->match_name."</option>";
					}
					echo json_encode(array("status"=>1,"val"=>$v1));exit;
				} else {
					echo json_encode(array("status"=>0,"val"=>''));exit;
				}
		}
		else if ($segment == 'update_coupon_status') {
			$segment4 = $this->uri->segment(4);
			$status = $segment4;
			$status_data = array(
							'site_value'		=> $status
			);
			$store_id = 13;
			$site_name = 'SITE_COUPON';
			$update = $this->General_Model->update_coupon_status($status_data, $site_name,$store_id);
			//echo $this->db->last_query();
			if ($update == 1) {
				$response = array('status' => 1, 'msg' => 'Coupon Status Updated Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Coupon details.');
				echo json_encode($response);
				exit;
			}
		}else if ($segment == 'add_discount_coupon') {
			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {

				$edit_id = $edit_id = json_decode(base64_decode($this->uri->segment(4)));
				$this->data['coupons'] = $this->General_Model->getAllItemTable('coupon_code', 'c_id', $edit_id, 'c_id', 'DESC')->row();
			}


			$this->load->view('settings/coupons/add_coupon', $this->data);
		} 

		else if ($segment == 'coupon_by_id') {
			//$edit_id = $edit_id = json_decode(base64_decode($this->uri->segment(4)));
			$edit_id = $this->uri->segment(4);
			$this->data['coupons'] = $this->General_Model->getAllItemTable('coupon_code', 'c_id', $edit_id, 'c_id', 'DESC')->row();

			echo json_encode($this->data['coupons']);
		}
		else if ($segment == 'discount_coupon_list') {
			$row_count = $this->uri->segment(4);
			$this->loadRecord($row_count, 'coupon_code', 'settings/discount_coupons/discount_coupon_list', 'c_id', 'DESC', THEME.'settings/coupons/coupon_list', 'coupons');
		} else if ($segment == 'delete_coupon') {

			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('coupon_code', 'c_id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Coupon details deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Coupon details.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_coupon') {
 
			$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
			$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required');
			$this->form_validation->set_rules('coupon_value', 'Coupon Value', 'required');
			$this->form_validation->set_rules('min_price', 'Min Price Range', 'required');
			$this->form_validation->set_rules('max_price', 'Max Price Range', 'required');
			$this->form_validation->set_rules('create_date', 'Start Date', 'required');
			$this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required');
			$this->form_validation->set_rules('credit_note', 'Credit Note', 'required');

			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'coupon_code' => $_POST['coupon_code'],
					'coupon_type' => $_POST['coupon_type'],
					'coupon_value' => $_POST['coupon_value'],
					'min_price' => $_POST['min_price'],
					'max_price' => $_POST['max_price'],
					//'m_id' => $_POST['m_id'],
					'm_id' => 0,
					't_id' => $_POST['t_id'],
					'status' => 1,
					'expiry_date' => date('Y-m-d', strtotime($_POST['expiry_date'])),
					'create_date' => date('Y-m-d', strtotime($_POST['create_date'])),
				);
				if($_POST['credit_note'] == 1){
					$insert_data['credit_note'] = 1;
				}
				if ($_POST['id'] == '') {

					$inserted_id = $this->General_Model->insert_data('coupon_code', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'New Coupon Created successfully.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to Create New Coupon.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$id = $_POST['id'];


					if ($this->General_Model->update_table('coupon_code', 'c_id', $id, $insert_data)) {
						$response = array('msg' => 'Coupon details updated Successfully.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Coupon details.', 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/discount_coupons/discount_coupon_list', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	public function edit_customer_details()
	{
		$customerId = $_POST['customerId'];

		//$edit_id = json_decode(base64_decode($customerId));
		$edit_id=$customerId;
		$customer = $this->General_Model->getAllItemTable('register', 'id', $edit_id, 'id', 'DESC')->row();
		
		$response = [
			'firstName' => $customer->first_name,
			'lastName' => $customer->last_name,
			'email' => $customer->email,
			'phoneNumber' => $customer->mobile,
			'address' => $customer->address,
			'zipCode' => $customer->code,
			'country' => $customer->country,
			'city' => $customer->city,
			'status' => $customer->status,
			'allow_offline' => $customer->allow_offline,
			'id'=>$edit_id
		];
	
		// Send the JSON response back to the client
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
			
	}

	public function update_customer_details()
	{
		//$id = $_POST['id'];
		$id = $_POST['customerId'];
		$edit_id =$id;
		//$edit_id = json_decode(base64_decode($id));

		if($_POST['password']!="")
		{
			$insert_data['password']         = md5($_POST['password']);
			$insert_data['confirm_password'] = md5($_POST['password']);
		}
		else if(empty($_POST['password']))
		{					
			$customer = $this->General_Model->getAllItemTable('register', 'id', $edit_id, 'id', 'DESC')->row();
			$_POST['password']				=	$customer->password;
			$insert_data['password']         = $_POST['password'];
			$insert_data['confirm_password'] = $_POST['password'];
		}
		
			$insert_data['first_name']       =  $_POST['firstName'];
			$insert_data['last_name']        = 	$_POST['lastNames'];
			$insert_data['email']        	 =	$_POST['emailId'];
			$insert_data['mobile']           = 	$_POST['PhoneNumber'];
			$insert_data['address']          = 	$_POST['address'];
			$insert_data['code']             = 	$_POST['zipCode'];
			$insert_data['country']          = 	$_POST['country'];
			$insert_data['city']             = 	$_POST['city'];
			$insert_data['status']           = 	$_POST['status'];
			$insert_data['allow_offline']    = 	$_POST['allow_offline'];

		if ($this->General_Model->update_table('register', 'id', $edit_id, $insert_data)) {
			$response = array("edit_id"=>$edit_id,'msg' => 'Customer details updated Successfully.', 'status' => 1);
		} else {
			$response = array("edit_id"=>$edit_id,'msg' => 'Failed to update Customer details.',  'status' => 0);
		}
		echo json_encode($response);
		exit;
	}

	public function customers()
	{
		$segment = $this->uri->segment(3);

		if ($segment == 'add_customer') {

			$segment4 = $this->uri->segment(4);

			if ($segment4 != "") {

				$edit_id = json_decode(base64_decode($this->uri->segment(4)));
				$this->data['customers'] = $this->General_Model->getAllItemTable('register', 'id', $edit_id, 'id', 'DESC')->row();
			}

			$this->data['countries'] = $this->General_Model->getAllItemTable('countries', '', '', 'id', 'DESC')->result();


			$this->load->view('settings/customers/add_customer', $this->data);
		} else if ($segment == 'customer_list') {

			$row_count = $this->uri->segment(4);
			$this->loadRecord($row_count, 'register', 'settings/customers/customer_list', 'id', 'DESC', THEME.'settings/customers/customer_list', 'customers');


		} else if ($segment == 'download') {
            $search = array();
            if($_GET['from_date'] != "" && $_GET['to_date'] != ""){
                $search['from_date']  = $_GET['from_date'];
                $search['to_date']  = $_GET['to_date'];
                $filename = "CustomerData-" .$_GET['from_date'] . "_To_".$_GET['to_date'].".csv"; 
            }
            else{
                 $filename = "CustomerData-" . date('Y-m-d H:i:s') . ".csv"; 
            }
             //$fp = fopen('file.csv', 'w'); 


             //echo "<pre>";print_r($where_array);exit;
            $downloads = $this->General_Model->get_customer_data($search)->result();
            //echo $this->db->last_query();die;
           // echo "<pre>"; print_r($downloads);die;
            // Column names 
            $fields = array(
            	'Email',
            	'First Name',
            	'Last Name',
            	'Country',
            	'Zip',
            	'Email',
            	'Zip',
            	'Phone',
            	'Phone',
            	
            ); 
            $delimiter = ","; 
             $f = fopen('php://memory', 'w'); 
            fputcsv($f, $fields, $delimiter); 
            // Display column names as first row 
            //$excelData = implode("\t", array_values($fields)) . "\n"; 
           
            foreach($downloads as $row){  
            	$mobile = str_replace(" ","",$row->mobile);
            	$lineData = array(
            		strtolower($row->email),
            		strtolower($row->first_name),
            		strtolower($row->last_name),
            		strtolower($row->sortname),
            		$row->code,
            		strtolower($row->email),
            		$row->code,
            		str_replace("+", "", $row->dialing_code).$mobile,
            		str_replace("+", "", $row->dialing_code).$mobile,
            		
            ); 
            	fputcsv($f, $lineData, $delimiter); 
           // $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
            
        	
		    	// Move back to beginning of file 
		    fseek($f, 0); 
		     
		    // Set headers to download file rather than displayed 
		    header('Content-Type: text/csv'); 
		    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
		     
		    //output all remaining data on a file pointer 
		    fpassthru($f); 


            exit;


		}else if ($segment == 'delete_customer') {

			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('register', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Customer details deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Customer details.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_customer') {

			// $this->form_validation->set_rules('firstname', 'First Name', 'required');
			// $this->form_validation->set_rules('lastname', 'Last Code', 'required');
			// $this->form_validation->set_rules('email', 'Email', 'required');
			// $this->form_validation->set_rules('phonecode', 'Phone code', 'required');
			// $this->form_validation->set_rules('phone', 'Phone', 'required');
			// $this->form_validation->set_rules('address', 'Address', 'required');
			// $this->form_validation->set_rules('postal_code', 'Postal Code', 'required');
			// $this->form_validation->set_rules('country', 'Country', 'required');
			// $this->form_validation->set_rules('city', 'City', 'required');
			// if ($_POST['id'] == '') {
			// 	$this->form_validation->set_rules('password', 'Password', 'required');
			// 	$this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');
			// }
			//if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'first_name' => $_POST['firstName'],
					'last_name' => $_POST['lastNames'],
					'email' => $_POST['emailId'],
					'address' => $_POST['address'],
					'city' => $_POST['city'],
					'dialing_code' => $_POST['phonecode'],
					'mobile' => $_POST['PhoneNumber'],
					//'state' => $_POST['state'],
					'code' => $_POST['zipCode'],
					'country' => $_POST['country'],
					'active' => 1,
					'allow_offline' => $_POST['allow_offline'] ? "1":"0",
					'status' =>   $_POST['status'],
					'user_type' => 'buyer',
					'created_date' => date('Y-m-d H:i:s'),
				);
			
				if ($_POST['id'] == '') {

					$insert_data['add_by'] = $this->session->userdata('admin_id');
					$insert_data['password']         = md5($_POST['password']);
					$insert_data['confirm_password'] = md5($_POST['password']);

					$insert_data['add_by'] = $this->session->userdata('admin_id');
					$inserted_id = $this->General_Model->insert_data('register', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'New Customer Created successfully.', 'redirect_url' => base_url() . 'settings/customers/customer_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to Create New Customer.', 'redirect_url' => base_url() . 'settings/customers/customer_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$id = $_POST['id'];

					if ($_POST['password'] != '') {
						$this->form_validation->set_rules('password', 'password', 'required');
						$this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');
					}
					if ($this->form_validation->run() !== false) {

						$insert_data['password']         = md5($_POST['password']);
						$insert_data['confirm_password'] = md5($_POST['password']);
					} else {
						$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/customers/customer_list', 'status' => 0);
						echo json_encode($response);
						exit;
					}

					if ($this->General_Model->update_table('register', 'id', $id, $insert_data)) {
						$response = array('msg' => 'Customer details updated Successfully.', 'redirect_url' => base_url() . 'settings/customers/customer_list', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update Customer details.', 'redirect_url' => base_url() . 'settings/customers/customer_list', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			// } else {
			// 	$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/customers/customer_list', 'status' => 0);
			// }
			echo json_encode($response);
			exit;
		}
	}


	function api_settings()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add_api_settings') {

			$settings = $this->General_Model->get_general_settings($this->session->userdata('storefront')->admin_id, '', 'SL')->result();
			if (isset($settings)) {
				$mysettings = array();
				foreach ($settings as $skey => $setting) {
					$mysettings[$setting->site_name] = $setting->site_value;
				}
			}
			$this->data['apis'] = $mysettings;

			$this->load->view('settings/api_settings/api_settings', $this->data);
		} else if ($segment == 'save_api_settings') {

			$store_id = $this->session->userdata('storefront')->admin_id;

			$this->form_validation->set_rules('FACEBOOK_ID', 'Facebook App Id', 'required');
			$this->form_validation->set_rules('FACEBOOK_KEY', 'Facebook App Secret', 'required');
			$this->form_validation->set_rules('GOOGLE_ID', 'Google Client ID', 'required');
			$this->form_validation->set_rules('GOOGLE_KEY', 'Google Client Secret', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'FACEBOOK_ID' => $_POST['FACEBOOK_ID'],
					'FACEBOOK_KEY' => $_POST['FACEBOOK_KEY'],
					'GOOGLE_ID' => $_POST['GOOGLE_ID'],
					'GOOGLE_KEY' => $_POST['GOOGLE_KEY'],
				);

				$datainset = array();
				foreach ($insert_data as $ikey => $idata) {
					$datainset[] = array('site_name' => $ikey, 'site_value' => $idata, 'store_id' => $store_id, 'site_code' => 'SL', 'add_by' => $this->session->userdata('admin_id'));
				}

				if ($this->General_Model->update_site_settings($datainset, 'SL', $store_id)) {
					$response = array('msg' => 'API Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/api_settings/add_api_settings', 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update API Settings.', 'redirect_url' => base_url() . 'settings/api_settings/add_api_settings', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/api_settings/add_api_settings', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}

	function store_settings()
	{
		$this->load->view('settings/store_settings/store_settings', $this->data);
	}

	function add_store_settings()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add_store_settings') {
			$this->data['currency_details'] = $this->General_Model->getAllItemTable('currency_types', '', '', 'id', 'DESC')->result();
			$settings = $this->General_Model->get_general_settings($this->session->userdata('storefront')->admin_id, '', 'BA')->result();
			if (isset($settings)) {
				$mysettings = array();
				foreach ($settings as $skey => $setting) {
					$mysettings[$setting->site_name] = $setting->site_value;
				}
			}
			$this->data['settings'] = $mysettings;
			$this->load->view('settings/store_settings/add_store_settings', $this->data);
		} else if ($segment == 'save_store_settings') {

			//echo "<pre>";print_r($_POST);exit;

			$this->form_validation->set_rules('SITE_TITLE', 'Site Name', 'required');
			$this->form_validation->set_rules('SITE_CURRENCY', 'Site Currency', 'required');
			$this->form_validation->set_rules('SITE_DESCRIPTION', 'Store Description', 'required');
			$this->form_validation->set_rules('CONTACT_NAME', 'Contact Name', 'required');
			$this->form_validation->set_rules('CONTACT_EMAIL', 'Contact Email', 'required');
			$this->form_validation->set_rules('CONTACT_PHONE', 'Contact Phone', 'required');
			$this->form_validation->set_rules('STORE_MARKUP', 'Store Markup', 'required');

			if ($this->form_validation->run() !== false) {



				$admin_id  = $this->session->userdata('storefront')->admin_id;

				if (isset($_FILES["profile_filepond"]["name"]) && $_FILES["profile_filepond"]["name"] != '') {
					$logo_image = explode(".", $_FILES["profile_filepond"]["name"]);
					$newlogoname = date('YmdHis') . rand(1, 9999999) . '.' . end($logo_image);
					$tmpnamert = $_FILES['profile_filepond']['tmp_name'];
					move_uploaded_file($tmpnamert, 'uploads/site/' . $newlogoname);
					$logo = 'uploads/site/' . $newlogoname;
				} else {

					$site_data = $this->General_Model->get_general_settings($admin_id, 'SITE_LOGO')->row();
					$logo = $site_data->site_value;
				}
				//echo "ADMIN ID = ".$admin_id;exit;
				$insert_data = array(
					'SITE_LOGO'  => $logo,
					'SITE_TITLE' => $_POST['SITE_TITLE'],
					'SITE_DOMAIN' => $_POST['SITE_DOMAIN'],
					'SITE_CURRENCY' => $_POST['SITE_CURRENCY'],
					'SITE_DESCRIPTION' => $_POST['SITE_DESCRIPTION'],
					'CONTACT_NAME' => $_POST['CONTACT_NAME'],
					'CONTACT_EMAIL' => $_POST['CONTACT_EMAIL'],
					'CONTACT_PHONE' => $_POST['CONTACT_PHONE'],
					'CONTACT_COUNTRY' => $_POST['CONTACT_COUNTRY'],
					'CONTACT_STATE' => $_POST['CONTACT_STATE'],
					'CONTACT_CITY' => $_POST['CONTACT_CITY'],
					'CONTACT_ADDRESS' => $_POST['CONTACT_ADDRESS'],
					'STORE_MARKUP' => $_POST['STORE_MARKUP']
				);
				$datainset = array();
				foreach ($insert_data as $ikey => $idata) {
					$datainset[] = array('site_name' => $ikey, 'site_value' => $idata, 'store_id' => $admin_id, 'site_code' => 'BA', 'add_by' => $this->session->userdata('admin_id'));
				}
				
				if ($this->General_Model->update_site_settings($datainset, 'BA', $admin_id)) {
					$response = array('msg' => 'Site Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/store_settings/add_store_settings', 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update Payment Gateway Settings.', 'redirect_url' => base_url() . 'settings/store_settings/add_store_settings', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/store_settings/add_store_settings', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}


	function gateway_settings()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add_gateway_settings') {

			$gateways = $this->General_Model->get_general_settings($this->session->userdata('storefront')->admin_id, '', 'GA')->result();
			if (isset($gateways)) {
				$mysettings = array();
				foreach ($gateways as $skey => $setting) {
					$mysettings[$setting->site_name] = $setting->site_value;
				}
			}
			$this->data['gateways'] = $mysettings;

			$this->load->view('settings/gateway_settings/gateway_settings', $this->data);
		} else if ($segment == 'save_gateway_settings') {

			$this->form_validation->set_rules('PAYPAL_ID', 'Paypal Id', 'required');
			$this->form_validation->set_rules('PAYPAL_KEY', 'Paypal Key', 'required');
			$this->form_validation->set_rules('NETWORK_ID', 'Network Id', 'required');
			$this->form_validation->set_rules('NETWORK_KEY', 'Network Key', 'required');
			if ($this->form_validation->run() !== false) {
				$admin_id  = $this->session->userdata('storefront')->admin_id;
				$insert_data = array(
					'PAYPAL_ID' => $_POST['PAYPAL_ID'],
					'PAYPAL_KEY' => $_POST['PAYPAL_KEY'],
					'NETWORK_ID' => $_POST['NETWORK_ID'],
					'NETWORK_KEY' => $_POST['NETWORK_KEY'],
				);
				$datainset = array();
				foreach ($insert_data as $ikey => $idata) {
					$datainset[] = array('site_name' => $ikey, 'site_value' => $idata, 'store_id' => $admin_id, 'site_code' => 'GA', 'add_by' => $this->session->userdata('admin_id'));
				}

				if ($this->General_Model->update_site_settings($datainset, 'BA', $admin_id)) {
					$response = array('msg' => 'Payment Gateway Settings updated Successfully.', 'redirect_url' => base_url() . 'settings/gateway_settings/add_gateway_settings', 'status' => 1);
				} else {
					$response = array('msg' => 'Failed to update Payment Gateway Settings.', 'redirect_url' => base_url() . 'settings/gateway_settings/add_gateway_settings', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/gateway_settings/add_gateway_settings', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}


	function email_templates()
	{


		$segment = $this->uri->segment(3);
		if ($segment == 'add_email_template') {
			$this->data['email_types']    = $this->General_Model->getAllItemTable('email_types')->result();

			$segment4 = $edit_id = json_decode(base64_decode($this->uri->segment(4)));
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['emails'] = $this->General_Model->getAllItemTable('email', 'id', $edit_id, 'id', 'DESC')->row();
			}
			$this->load->view(THEME.'settings/email_templates/add_email_templates', $this->data);
		 } 
		 else if ($segment == 'get_email_template_id') {
			  $edit_id = json_decode(base64_decode($this->uri->segment(4)));
				$this->data['data'] = $this->General_Model->getAllItemTable('email_template', 'id', $edit_id, 'id', 'DESC')->row();
				echo json_encode($this->data['data']); die;

		 }
		 else if ($segment == 'list_email_templates') {
			$row_count = $this->uri->segment(4);
			$this->load->view(THEME.'settings/email_templates/list_email_templates');
			//$this->loadRecord($row_count, 'email', 'settings/email_templates/list_email_templates', 'id', 'DESC', 'settings/email_templates/list_email_templates', 'emails');
		} else if ($segment == 'delete_email_templates') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('email_template', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Email Template deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Email Template.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save_email_templates') {
			$this->form_validation->set_rules('template_key', 'Template Key', 'required');
			$this->form_validation->set_rules('cc_email', 'From Email Id', 'required');
			$this->form_validation->set_rules('subject_english', 'English Subject', 'required');
			$this->form_validation->set_rules('subject_arabic', 'Status', 'required');
			$this->form_validation->set_rules('message_english', 'Template English', 'required');
			$this->form_validation->set_rules('message_arabic', 'Template Arabic', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					
					'template_key' 			=> $_POST['template_key'],
					'cc_email' 			    => $_POST['cc_email'],
					'subject_english' 	=> $_POST['subject_english'],
					'subject_arabic' 	  => $_POST['subject_arabic'],
					'message_english' 	=> $_POST['message_english'],
					'message_arabic' 	   => $_POST['message_arabic'],
				);
				
				if ($_POST['id'] == '') {
					$insert_data['add_by'] = $this->session->userdata('admin_id');
					$inserted_id = $this->General_Model->insert_data('email_template', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'Email template added successfully.', 'redirect_url' => base_url() . 'settings/email_templates/list_email_templates', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new Email template.', 'redirect_url' => base_url() . 'settings/email_templates/add_email_template', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$template_id = $_POST['id'];
					if ($this->General_Model->update_table('email_template', 'id', $template_id, $insert_data)) {
						$response = array('msg' => 'Email template updated Successfully.', 'redirect_url' => base_url() . 'settings/email_templates/list_email_templates', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update game category details.', 'redirect_url' => base_url() . 'settings/email_templates/add_email_template' . $template_id, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/email_templates/add_email_template', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		}
	}
	public function banner_image_file_check()
	{
		$allowed_mime_types = array('image/jpeg', 'image/svg+xml', 'image/png', 'image/gif');
		if (isset($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] != "") {
			$mime = get_mime_by_extension($_FILES['banner_image']['name']);
			$fileAr = explode('.', $_FILES['banner_image']['name']);
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
	public function timage_file_check()
	{
		$allowed_mime_types = array('image/jpeg', 'image/svg+xml', 'image/png', 'image/gif');
		if (isset($_FILES['tournament_image']['name']) && $_FILES['tournament_image']['name'] != "") {
			$mime = get_mime_by_extension($_FILES['tournament_image']['name']);
			$fileAr = explode('.', $_FILES['tournament_image']['name']);
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
	public function bg_image_file_check()
	{
		$allowed_mime_types = array('image/jpeg', 'image/svg+xml', 'image/png', 'image/gif');
		if (isset($_FILES['team_bg']['name']) && $_FILES['team_bg']['name'] != "") {
			$mime = get_mime_by_extension($_FILES['team_bg']['name']);
			$fileAr = explode('.', $_FILES['team_bg']['name']);
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
	public function image_file_check()
	{
		$allowed_mime_types = array('image/jpeg', 'image/svg+xml', 'image/png', 'image/gif');
		if (isset($_FILES['team_image']['name']) && $_FILES['team_image']['name'] != "") {
			$mime = get_mime_by_extension($_FILES['team_image']['name']);
			$fileAr = explode('.', $_FILES['team_image']['name']);
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

	/**
	 * Fetch data and display based on the pagination request
	 */
	public function loadRecord($rowno = 0, $table, $url, $order_column, $order_by, $view, $variable_name, $role = '', $search = '')
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

		//if ($table != "tickets_markup" && $table != "matches" && $table != 'states' && $table != 'cities' && $table != 'ticket_types' && $table != 'split_types' && $table != 'ticket_details' && $table != 'email' && $table != 'static_page' && $table != 'top_league_cups' && $table != 'upcoming_event' && $table !='banners' && $table !='email_logs' && $table !='register' && $table !='sitefee_markup') {
		if ($table != "tickets_markup" && $table != "matches" && $table != 'states' && $table != 'cities' && $table != 'ticket_types' && $table != 'split_types' && $table != 'ticket_details' && $table != 'email' && $table != 'static_page' && $table != 'top_league_cups' && $table != 'upcoming_event' && $table !='banners' && $table !='email_logs'&& $table !='caurosel'&& $table !='sitefee_markup' && $table !='register' && $table !='favorite_team_subscription') {

			

			// All records count
			$allcount = $this->General_Model->get_table_row_count($table, '');

			// Get records
			$record = $this->General_Model->get_limit_based_data($table, $rowno, $row_per_page, $order_column, $order_by)->result();
		} else if ($table != "tickets_markup" && $table == "register") {

			
		 	// All records count
			$allcount = $this->General_Model->get_customer_data($search)->num_rows();

			// Get records
			$record = $this->General_Model->get_customer_data($search,array(),$row_per_page, $rowno)->result();

			//echo $this->db->last_query();exit;
		} else if ($table != "tickets_markup" && $table == "matches") {
			
			$url = "settings/match_settings/match_settings";
			// All records count
			$allcount = $this->General_Model->get_matches('', 'upcoming')->num_rows();

			// Get records
			$record = $this->General_Model->get_matches('', 'upcoming', $rowno, $row_per_page, $order_column, $order_by)->result();
		} else if ($table == "states") {
			echo '<pre/>';
			print_r('4');
			exit;
			$allcount = $this->General_Model->get_table_row_count($table, '');
			$record = $this->General_Model->get_states_by_limit($rowno, $row_per_page, $order_column, $order_by, '')->result();
		} else if ($table == "cities") {
			// echo '<pre/>';
			// print_r('5');
			// exit;
			$allcount = $this->General_Model->get_city_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_city_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} else if ($table == "ticket_types") {
			echo '<pre/>';
			print_r('6');
			exit;
			$allcount = $this->General_Model->get_ticket_type_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_ticket_type_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} else if ($table == "split_types") {
			$allcount = $this->General_Model->get_split_type_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_split_type_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} else if ($table == "ticket_details") {
			// echo '<pre/>';
			// print_r('8');
			// exit;
			$allcount = $this->General_Model->get_ticket_details_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_ticket_details_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} else if ($table == "email") {
			echo '<pre/>';
			print_r('9');
			exit;
			$allcount = $this->General_Model->get_email_template_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_email_template_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} else if ($table == "static_page") {
			
			$allcount = $this->General_Model->get_static_page_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_static_page_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
			// echo '<pre/>';
			// print_r($view);
			// exit;
		}
		else if ($table == "banners") {
			$allcount = $this->General_Model->get_banners_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_banners_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		}
		else if ($table == "email_logs") {
			echo '<pre/>';
			print_r('12');
			exit;
			$allcount = $this->General_Model->email_logs('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->email_logs($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		}
		else if ($table == "top_league_cups") {
		
			if ($role == "topteams") {
				// All records count
				$allcount = $this->General_Model->top_teams_by_limit('', '', '', '', array('match_type=' => 'team'), $search)->num_rows();
				// Get records
				$record = $this->General_Model->top_teams_by_limit($rowno, $row_per_page, $order_column, $order_by, array('match_type=' => 'team'), $search)->result();
			}
			else if ($role == "topleagues") {
				// All records count
				$allcount = $this->General_Model->top_leagues_by_limit('', '', '', '', array('match_type=' => 'league'), $search)->num_rows();
				// Get records
				$record = $this->General_Model->top_leagues_by_limit($rowno, $row_per_page, $order_column, $order_by, array('match_type=' => 'league'), $search)->result();
			} else {
				// All records count
				$allcount = $this->General_Model->top_leagues_by_limit('', '', '', '', array('match_type=' => 'cups'), $search)->num_rows();
				// Get records
				$record = $this->General_Model->top_leagues_by_limit($rowno, $row_per_page, $order_column, $order_by, array('match_type=' => 'cups'), $search)->result();
			}
		} else if ($table == "upcoming_event") {
			// echo '<pre/>';
			// print_r('14');
			// exit;
			$allcount = $this->General_Model->get_upcoming_event_by_limit('', '', '', '', '', $search)->num_rows();
			$record = $this->General_Model->get_upcoming_event_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
		} 
		elseif($table == "sitefee_markup"){
			// echo '<pre/>';
			// print_r('15');
			// exit;
			
			$allcount = $this->General_Model->get_sitefee_by_limit('', '', '', '', '', $search,$row_type)->num_rows();
			$record = $this->General_Model->get_sitefee_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
			
		}
		elseif($table == "favorite_team_subscription"){
			// echo '<pre/>';
			// print_r('16');
			// exit;
			
			$allcount = $this->General_Model->get_team_settings_by_limit('', '', '', '', '', $search,$row_type)->num_rows();
			$record = $this->General_Model->get_team_settings_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();
			if(!empty($record)){
				foreach($record as $rkey => $rec){
					$team_data = array();
					$teams = explode(',',$rec->teams);
					foreach($teams as $team){
						$team_name = $this->General_Model->getAllItemTable_array('teams_lang',array('team_id' => $team,'language' => 'en'))->row();
						$team_data[] = $team_name->team_name;
						
					}
					$record[$rkey]->teams = implode(',',$team_data);
				}

			} //echo "<pre>";print_r($record);exit;
			//echo "<pre>";print_r($record);exit;
			
		} 
		else {

			// All records count
			$allcount = $this->General_Model->get_table_row_count_markup($role)->num_rows();
			// Get records
			$record = $this->General_Model->get_limit_based_data_markup($table, $rowno, $row_per_page, $order_column, $order_by, $role)->result();
			
		}
		

		if ($table == "coupon_code") {
		 	
		 	$store_id = 13;
			$this->data['coupon_status'] =  $this->General_Model->get_general_settings($store_id, 'SITE_COUPON')->row();
		
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

		$this->data['countries']    = $this->General_Model->getAllItemTable('countries')->result();
		$this->data['pagination'] = $this->pagination->create_links();

		// Initialize
		$this->pagination->initialize($config);

		$this->data['pagination'] = $this->pagination->create_links();
		$this->data[$variable_name] = $record;
		$this->data['row'] = $rowno;
		$this->data['search'] = $search;

	// 	$country = "";

	// foreach($records as $record ){
	// 	$country .=   ' <div class="custom-control custom-checkbox">
	// 	<input type="checkbox" class="custom-control-input" id="country'.$record->id.'">
	// 	<label class="custom-control-label" for="country'.$record->id.'">'.ucfirst($record->name).'</label>
	//   </div>';

	// }
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
		// print_r($view);
		// exit;
		$this->load->view($view, $this->data);
	}

	/**
	 * Add,edit,update,delete and list countries position
	 */

	public function countries()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->load->view(THEME.'settings/add_country', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['country_details'] = $this->General_Model->getAllItemTable('countries', 'id', $edit_id, '', '')->row();
				$this->load->view(THEME.'settings/add_country', $this->data);
			}
		
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('countries', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Country deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting country.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('cname', 'Country Name', 'required');
				$this->form_validation->set_rules('sname', 'Sort Name', 'required');
				$this->form_validation->set_rules('pcode', 'Phone Code', 'required');

				if ($this->form_validation->run() !== false) {
					$editId = $this->input->post('country_id');
					if ($editId == '') {
						$insert_data = array(
							'name' => $this->input->post('cname'),
							'phonecode' => $this->input->post('pcode'),
							'sortname' => $this->input->post('sname'),
							'add_by' => $this->session->userdata('admin_id'),
							'create_date' => strtotime(date('Y-m-d H:i:s'))
						);
						$inserted_id = $this->General_Model->insert_data('countries', $insert_data);
						if ($inserted_id) {
							$response = array('msg' => 'New country added Successfully.', 'redirect_url' => base_url() . 'settings/countries', 'status' => 1);
						} else {
							$response = array('msg' => 'Failed to add new country.', 'redirect_url' => base_url() . 'settings/countries/add', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					} else {
						$updateData = array();
						$updateData['name'] = trim($this->input->post('cname'));
						$updateData['phonecode'] = trim($this->input->post('pcode'));
						$updateData['sortname'] = $this->input->post('sname');
						$this->General_Model->update('countries', array('id' => $editId), $updateData);

						$response = array('status' => 1, 'msg' => 'Country data updated Successfully.', 'redirect_url' => base_url() . 'settings/countries');
						echo json_encode($response);
						exit;
					}
				} else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/countries/add', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			}
		} else {
			$row_count = $this->uri->segment(3);
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->load->view(THEME.'settings/countries', $this->data);
			//$this->loadRecord($row_count, 'countries', 'settings/countries', 'id', 'DESC', 'settings/countries', 'countries', 'countries');
		}
	}


	/**
	 * Add,edit,update,delete and list states
	 */

	public function states()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->load->view(THEME.'settings/add_state', $this->data);
		} else if ($segment == 'edit') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['state_details'] = $this->General_Model->get_state_data($edit_id)->row();
				$this->load->view(THEME.'settings/add_state', $this->data);
			}
			
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('states', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'State deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting state.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('cname', 'Country', 'required');
				$this->form_validation->set_rules('sname', 'State Name', 'required');

				if ($this->form_validation->run() !== false) {
					$editId = $this->input->post('state_id');
					if ($editId == '') {
						$insert_data = array(
							'name' => $this->input->post('sname'),
							'country_id' => $this->input->post('cname'),
							'add_by' => $this->session->userdata('admin_id'),
							'create_date' => strtotime(date('Y-m-d H:i:s'))
						);
						$inserted_id = $this->General_Model->insert_data('states', $insert_data);
						if ($inserted_id) {
							$response = array('msg' => 'New state added Successfully.', 'redirect_url' => base_url() . 'settings/states', 'status' => 1);
						} else {
							$response = array('msg' => 'Failed to add new state.', 'redirect_url' => base_url() . 'settings/states/add', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					} else {
						$updateData = array();
						$updateData['name'] = trim($this->input->post('sname'));
						$updateData['country_id'] = trim($this->input->post('cname'));
						$this->General_Model->update('states', array('id' => $editId), $updateData);

						$response = array('status' => 1, 'msg' => 'State data updated Successfully.', 'redirect_url' => base_url() . 'settings/states');
						echo json_encode($response);
						exit;
					}
				} else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/states/add', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			}
		} else {
			$row_count = $this->uri->segment(3);
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->load->view(THEME.'settings/states', $this->data);
			//$this->loadRecord($row_count, 'states', 'settings/states', 'id', 'DESC', 'settings/states', 'states', 'states');
		}
	}


	/**
	 * Add,edit,update,delete and list cities
	 */

	public function cities()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->load->view(THEME.'settings/city/add_city', $this->data);
		} else if ($segment == 'edit') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['city_details'] = $this->General_Model->get_city_data($edit_id)->row();
				$stateId = $this->data['city_details']->state_id;
				$stateData = $this->General_Model->get_state_data($stateId)->row();
				$countryId = $stateData->country_id;
				$this->data['selected_country'] = $countryId;
				$this->data['states'] = $this->General_Model->get_states($countryId)->result();
			}
			$this->load->view(THEME.'settings/city/add_city', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('cities', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'City deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting city.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('cname', 'Country', 'required');
				$this->form_validation->set_rules('sname', 'State Name', 'required');
				$this->form_validation->set_rules('cityname', 'City Name', 'required');

				if ($this->form_validation->run() !== false) {
					$editId = $this->input->post('city_id');
					if ($editId == '') {
						$insert_data = array(
							'name' => $this->input->post('cityname'),
							'state_id' => $this->input->post('sname'),
							'add_by' => $this->session->userdata('admin_id'),
							'create_date' => strtotime(date('Y-m-d H:i:s'))
						);
						$inserted_id = $this->General_Model->insert_data('cities', $insert_data);
						if ($inserted_id) {
							$response = array('msg' => 'New city added Successfully.', 'redirect_url' => base_url() . 'settings/cities', 'status' => 1);
						} else {
							$response = array('msg' => 'Failed to add new city.', 'redirect_url' => base_url() . 'settings/states/cities', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					} else {
						$updateData = array();
						$updateData['name'] = trim($this->input->post('cityname'));
						$updateData['state_id'] = trim($this->input->post('sname'));
						$this->General_Model->update('cities', array('id' => $editId), $updateData);

						$response = array('status' => 1, 'msg' => 'City data updated Successfully.', 'redirect_url' => base_url() . 'settings/cities');
						echo json_encode($response);
						exit;
					}
				} else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/cities/add', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			}
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchcity" => $search_text));
			} else {
				if ($this->session->userdata('searchcity') != NULL) {
					$search_text = $this->session->userdata('searchcity');
				}
			}
			$row_count = $this->uri->segment(3);
			// $this->loadRecord($row_count, 'cities', 'settings/cities', 'id', 'DESC', 'settings/city/cities', 'cities', 'cities', $search_text);
			$this->load->view(THEME.'settings/city/cities', $this->data);
		}
	}

	public function getStates()
	{
		$country_id = $this->input->post('country_id');
		if (!empty($country_id)) {
			$states = $this->db->select('id,name')->get_where('states', array('country_id' => $country_id))->result();
		} else {
			$states = $this->db->select('id,name')->get_where('states')->result();
		}

		echo json_encode($states);
		exit;
	}


	/**
	 * Add,edit,update,delete and list ticket types
	 */

	public function ticket_types()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->load->view(THEME.'settings/ticket_types/add_ticket_type', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['ticket_details'] = $this->General_Model->get_ticket_type_data($edit_id)->row();
			}
			$this->load->view(THEME.'settings/ticket_types/add_ticket_type', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('ticket_types', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('ticket_types_lang', 'ticket_type_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Ticket type deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting ticket type.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('name', 'Ticket Type', 'required');
				if ($this->form_validation->run() !== false) {
					$editId = $this->input->post('ticket_type_id');
					if ($editId == '') {
						$status = $this->input->post('status') ? 1 : 0;
						if (!empty($_FILES['ticket_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/ticket_image';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if ($this->upload->do_upload('ticket_image')) {
								$outputData['ticket_image'] = $this->upload->data();
								$ticket_image = $outputData['ticket_image']['file_name'];
							}
						}
						$ticket_image = isset($ticket_image)?$ticket_image:"";
						$insert_data = array(
							'name' => $this->input->post('name'),
							'status' =>  $status,
							'add_by' => $this->session->userdata('admin_id'),
							'ticket_description' => $this->input->post('t_description'),
							'ticket_image' => $ticket_image,
							'create_date' => strtotime(date('Y-m-d H:i:s'))
						);
						$inserted_id = $this->General_Model->insert_data('ticket_types', $insert_data);
						if ($inserted_id) {
							$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
							foreach ($lang as $key => $l_code) {
								$language_data = array(
									'language' =>  $l_code->language_code,
									'ticket_type_id' => $inserted_id,
									'ticket_description' => $this->input->post('t_description'),
									'ticket_image' => $ticket_image,
									'name' => $this->input->post('name')
								);
								$this->General_Model->insert_data('ticket_types_lang', $language_data);
							}
							$response = array('msg' => 'New ticket type added successfully.', 'redirect_url' => base_url() . 'settings/ticket_types', 'status' => 1);
						} else {
							$response = array('msg' => 'Failed to add new ticket type.', 'redirect_url' => base_url() . 'settings/ticket_types/add', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					} else {
						$updateData = array();
						$updateData['name'] = trim($this->input->post('name'));
						$updateData['status'] = $this->input->post('status') ? 1 : 0;
						$updateData['ticket_description'] = $this->input->post('t_description');
						if (!empty($_FILES['ticket_image']['name'])) {
							$ticketdata = $this->General_Model->get_ticket_type_data($edit_id)->row();
							if (UPLOAD_PATH . 'uploads/ticket_image/' . $ticketdata->ticket_image) {
								unlink(UPLOAD_PATH . 'uploads/ticket_image/' . $ticketdata->ticket_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/ticket_image';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|webp|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if ($this->upload->do_upload('ticket_image')) {
								$outputData['ticket_image'] = $this->upload->data();
								$updateData['ticket_image'] = $outputData['ticket_image']['file_name'];
								$updateData_lang['ticket_image'] = $outputData['ticket_image']['file_name'];
							}
						}
						$this->General_Model->update('ticket_types', array('id' => $editId), $updateData);
						
						//Update language table			
						$updateData_lang['name'] = trim($this->input->post('name'));
						$updateData_lang['ticket_description'] = trim($this->input->post('t_description'));
						$this->General_Model->update('ticket_types_lang', array('ticket_type_id' => $editId, 'language' => $this->session->userdata('language_code')), $updateData_lang);

						$response = array('status' => 1, 'msg' => 'Ticket type data updated Successfully.', 'redirect_url' => base_url() . 'settings/ticket_types');
						echo json_encode($response);
						exit;
					}
				} else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/ticket_types/add', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			}
		} else {
			$this->load->view(THEME.'settings/ticket_types/ticket_types', $this->data);
			// if ($this->input->post('submit') != NULL) {
			// 	$search_text = $this->input->post('search');
			// 	$this->session->set_userdata(array("searchttype" => $search_text));
			// } else {
			// 	if ($this->session->userdata('searchttype') != NULL) {
			// 		$search_text = $this->session->userdata('searchttype');
			// 	}
			// }
			// $row_count = $this->uri->segment(4);
			// $this->loadRecord($row_count, 'ticket_types', 'settings/ticket_types/ticket_types', 'id', 'DESC', 'settings/ticket_types/ticket_types', 'ticket_types', 'ticket_types', $search_text);
		}
	}


	/**
	 * Add,edit,update,delete and list split types
	 */

	public function split_types()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->load->view(THEME.'settings/split_types/add_split_type', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['split_details'] = $this->General_Model->get_split_type_data($edit_id)->row();
			}
			$this->load->view(THEME.'settings/split_types/add_split_type', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('split_types', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('split_types_lang', 'split_type_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Split type deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting split type.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('name', 'Split Type', 'required');
				if ($this->form_validation->run() !== false) {
					$editId = $this->input->post('split_type_id');
					if ($editId == '') {
						$status = $this->input->post('status') ? 1 : 0;
						if (!empty($_FILES['spilit_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/spilit_image';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if ($this->upload->do_upload('spilit_image')) {
								$outputData['spilit_image'] = $this->upload->data();
								$spilit_image = $outputData['spilit_image']['file_name'];
							}
						}
						$spilit_image = isset($spilit_image)?$spilit_image:"";
						$insert_data = array(
							'name' => $this->input->post('name'),
							'status' =>  $status,
							'add_by' => $this->session->userdata('admin_id'),
							'split_description' => $this->input->post('s_description'),
							//'spilit_image' => $spilit_image,
							'create_date' => strtotime(date('Y-m-d H:i:s'))
						);
						$inserted_id = $this->General_Model->insert_data('split_types', $insert_data);
						if ($inserted_id) {
							$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
							foreach ($lang as $key => $l_code) {
								$language_data = array(
									'language' =>  $l_code->language_code,
									'split_type_id' => $inserted_id,
									'split_description' => $this->input->post('s_description'),
									'spilit_image' => $spilit_image,
									'name' => $this->input->post('name')
								);
								$this->General_Model->insert_data('split_types_lang', $language_data);
							}
							$response = array('msg' => 'New split type added successfully.', 'redirect_url' => base_url() . 'settings/split_types', 'status' => 1);
						} else {
							$response = array('msg' => 'Failed to add new split type.', 'redirect_url' => base_url() . 'settings/split_types/add', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					} else {
						$updateData = array();
						$updateData['name'] = trim($this->input->post('name'));
						$updateData['status'] = $this->input->post('status') ? 1 : 0;
						if (!empty($_FILES['spilit_image']['name'])) {
							$spilitdata = $this->General_Model->get_split_type_data($editId)->row();
							if (UPLOAD_PATH . 'uploads/spilit_image/' . $spilitdata->spilit_image) {
								unlink(UPLOAD_PATH . 'uploads/spilit_image/' . $spilitdata->spilit_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/spilit_image';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if ($this->upload->do_upload('spilit_image')) {
								$outputData['spilit_image'] = $this->upload->data();
								$updateData['spilit_image'] = $outputData['spilit_image']['file_name'];
								$updateData_lang['spilit_image'] = $outputData['spilit_image']['file_name'];
							}
						}
						$this->General_Model->update('split_types', array('id' => $editId), $updateData);

						//Update language table
						$updateData_lang['name'] = trim($this->input->post('name'));
						$updateData_lang['split_description'] = $this->input->post('s_description');
						$this->General_Model->update('split_types_lang', array('split_type_id' => $editId, 'language' => $this->session->userdata('language_code')), $updateData_lang);

						$response = array('status' => 1, 'msg' => 'Split type data updated Successfully.', 'redirect_url' => base_url() . 'settings/split_types');
						echo json_encode($response);
						exit;
					}
				} else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/split_types/add', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			}
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchsptype" => $search_text));
			} else {
				if ($this->session->userdata('searchsptype') != NULL) {
					$search_text = $this->session->userdata('searchsptype');
				}
			}
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'split_types', 'settings/split_types/split_types', 'id', 'DESC', 'settings/split_types/split_types', 'split_types', 'split_types', $search_text);
			
			$this->load->view(THEME.'settings/split_types/split_types', $this->data);

		}
	}


	/**
	 * Add,edit,update,delete and list split types
	 */

	public function ticket_details()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->load->view(THEME.'settings/ticket_details/add_ticket_details', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['ticket_details'] = $this->General_Model->get_ticket_details_data($edit_id)->row();
			}
			$this->load->view(THEME.'settings/ticket_details/add_ticket_details', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('ticket_details', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('ticket_details_lang', 'ticket_details_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Ticket details deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting ticket details.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('name', 'Ticket Name', 'required');
				$msg = '';
				if ($this->form_validation->run() !== false) {
					$editId = $this->input->post('ticket_details_id');
					if ($editId == '') {
						$filename = '';
						if (!empty($_FILES['tdetails_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/ticket_details';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if ($this->upload->do_upload('tdetails_image')) {
								$outputData['tdetails_image'] = $this->upload->data();
								$insert_data['ticket_image'] = $outputData['tdetails_image']['file_name'];
								$filename = $outputData['tdetails_image']['file_name'];
							} else {
								$msg .= 'Failed to add ticket image';
							}
						}

						$insert_data['ticket_name'] = $this->input->post('name');
						$insert_data['status'] =   $this->input->post('status') ? 1 : 0;
						$insert_data['add_by'] = $this->session->userdata('admin_id');
						$insert_data['create_date'] = strtotime(date('Y-m-d H:i:s'));
						$inserted_id = $this->General_Model->insert_data('ticket_details', $insert_data);
						if ($inserted_id) {
							$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
							foreach ($lang as $key => $l_code) {
								$language_data = array(
									'language' =>  $l_code->language_code,
									'ticket_details_id' => $inserted_id,
									'ticket_name' => $this->input->post('name'),
									'ticket_image' =>	$filename
								);
								$this->General_Model->insert_data('ticket_details_lang', $language_data);
							}
							$response = array('msg' => 'New ticket details added successfully.', 'redirect_url' => base_url() . 'settings/ticket_details', 'status' => 1);
						} else {
							$response = array('msg' => 'Failed to add new ticket details.', 'redirect_url' => base_url() . 'settings/ticket_details/add', 'status' => 0);
						}
						echo json_encode($response);
						exit;
					} else {
						$updateData = array();


						if (!empty($_FILES['tdetails_image']['name'])) {
							$tdata = $this->General_Model->getAllItemTable_array('ticket_details', array('id' => $editId))->row();
							if (UPLOAD_PATH. 'uploads/ticket_details/' . $tdata->ticket_image) {
								unlink(UPLOAD_PATH. 'uploads/ticket_details/' . $tdata->ticket_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/ticket_details';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '1000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('tdetails_image')) {
								$msg .= 'Failed to add ticket details image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['ticket_image'] = $imagename;
								$updateData['ticket_image'] = $imagename;
							}
						} else {
							$updateData_lang['ticket_image'] = $this->input->post('exs_file');
						}


						$updateData['ticket_name'] = trim($this->input->post('name'));
						$updateData['status'] = $this->input->post('status') ? 1 : 0;

						$this->General_Model->update('ticket_details', array('id' => $editId), $updateData);


						//Update language table
						$updateData_lang['ticket_name'] = trim($this->input->post('name'));
						$this->General_Model->update('ticket_details_lang', array('ticket_details_id' => $editId, 'language' => $this->session->userdata('language_code')), $updateData_lang);
						if($updateData_lang['ticket_image'] != ''){

							$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
							foreach ($lang as $key => $l_code) {
								$language_data = array(
									'ticket_image' =>	$updateData_lang['ticket_image']
								);
								$this->General_Model->update('ticket_details_lang', array('ticket_details_id' => $editId), $language_data);
							}
							
						}
						

						$response = array('status' => 1, 'msg' => 'Ticket details data updated Successfully.', 'redirect_url' => base_url() . 'settings/ticket_details');
						echo json_encode($response);
						exit;
					}
				} else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/ticket_details/add', 'status' => 0);
				}
				echo json_encode($response);
				exit;
			}
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchtdetail" => $search_text));
			} else {
				if ($this->session->userdata('searchtdetail') != NULL) {
					$search_text = $this->session->userdata('searchtdetail');
				
}			}
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'ticket_details', 'settings/ticket_details/ticket_details', 'id', 'DESC', 'settings/ticket_details/ticket_details', 'ticket_details', 'ticket_details', $search_text);
			$this->load->view(THEME.'settings/ticket_details/ticket_details', $this->data);
		}
	}

	public function email_management()
	{
		$this->data['roles'] = $this->General_Model->getAllItemTable('admin_role', 'status', 'ACTIVE', 'admin_role_id', 'ASC')->result();
		$active_function_id = $this->General_Model->get_email_permissions();
		$function_ids = array();
		foreach ($active_function_id as $value) {
			$function_ids[$value["privilege_id"]][] = $value["email_type_id"];
		}
		$this->data['active_functions'] = $function_ids;
		$this->load->view('settings\api_settings\email_management\email_permissions', $this->data);
	}
	public function save_email_permission()
	{
		$this->data = array();
		$i = 0;
		foreach ($_POST['privilege'] as $pkey => $pvalue) {
			$j = 0;
			foreach ($pvalue as $key => $value) {
				$this->data[$i]["privilege_id"] = $pkey;
				$this->data[$i]["email_type_id"] = $value;
				$j++;
				$i++;
			}
		}
		$response = $this->General_Model->update_email_permission($this->data);
		if ($response) {
			$messge = array('msg' => 'Email Permissions Updated successfully.', 'redirect_url' => base_url() . 'settings/email_management', 'status' => 1);
		} else {
			$messge = array('msg' => 'Failed to update Email Permissions.', 'redirect_url' => base_url() . 'settings/email_management',);
		}
		echo json_encode($messge);
		exit;
	}



	/**
	 * @desc static page related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function static_pages()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['page_types'] = $this->General_Model->getAllItemTable('page_types')->result();
			$this->load->view(THEME.'settings/static_pages/add_page', $this->data);
		} else if ($segment == 'edit') {
			$this->data['page_types'] = $this->General_Model->getAllItemTable('page_types')->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['page_details'] = $this->General_Model->get_static_page_data($edit_id)->row();
			}
			$this->load->view(THEME.'settings/static_pages/add_page', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('static_page', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('static_page_lang', 'static_page_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Page deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting page.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			$this->form_validation->set_rules('ptype', 'Page Type', 'required');
			$this->form_validation->set_rules('title', 'Page Title', 'required');
			$this->form_validation->set_rules('page_content', 'Page Content', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'page_type' => $_POST['ptype'],
					'page_title' => $_POST['title'],
					'page_description' => $_POST['page_content'],
				);
				$insert_data['status'] = $this->input->post('status') ? 1 : 0;

				if ($_POST['page_id'] == '') {
					$insertData['create_date'] = strtotime(date('Y-m-d H:i:s'));
					$insert_data['add_by'] = $this->session->userdata('admin_id');
					$inserted_id = $this->General_Model->insert_data('static_page', $insert_data);
					if ($inserted_id) {
						//Add to language table
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['static_page_id'] = $inserted_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['title'] = trim($this->input->post('title'));
							$insertData_lang['description'] = trim($this->input->post('page_content'));
							$this->General_Model->insert_data('static_page_lang', $insertData_lang);
						}
						$response = array('msg' => 'Page details added successfully.', 'redirect_url' => base_url() . 'settings/static_pages', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new page.', 'redirect_url' => base_url() . 'settings/static_pages/add', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$editId = $_POST['page_id'];
					if ($this->General_Model->update_table('static_page', 'id', $editId, $insert_data)) {
						//Update language table
						$updateData_lang['title'] = trim($this->input->post('title'));
						$updateData_lang['description'] = strip_tags($this->input->post('page_content'));
						$this->General_Model->update('static_page_lang', array('static_page_id' => $editId, 'language' => $this->session->userdata('language_code')), $updateData_lang);
						$response = array('msg' => 'Page details updated Successfully.', 'redirect_url' => base_url() . 'settings/static_pages', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update page details.', 'redirect_url' => base_url() . 'settings/static_pages/edit/' . $editId, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/static_pages/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchstpage" => $search_text));
			} else {
				if ($this->session->userdata('searchstpage') != NULL) {
					$search_text = $this->session->userdata('searchstpage');
				}
			}
			$row_count = $this->uri->segment(4);
			// $this->loadRecord($row_count, 'static_page', 'settings/static_pages/static_pages', 'id', 'DESC', 'settings/static_pages/static_pages', 'pages', 'static_pages', $search_text);
			
			// echo '<pre/>';
			// print_r($this->data['page_types']);
			// exit;
			$this->load->view(THEME.'settings/static_pages/static_pages', $this->data);
		}
	}
	/**
	 * @desc top Team related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function home_top_teams()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['teams']   = $this->General_Model->get_teams()->result();
			$this->load->view(THEME.'settings/teams/add_teams', $this->data);
		} else if ($segment == 'edit') {
			$this->data['teams']   = $this->General_Model->get_teams()->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['top_league'] = $this->General_Model->getAllItemTable_array('top_league_cups', array('id' => $edit_id))->row();
			}
			$this->load->view(THEME.'settings/teams/add_teams', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('top_league_cups', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Top Team deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting top Team.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {

			$this->form_validation->set_rules('team', 'Team', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'tournament_id' => $_POST['team'],
					'match_type' => $_POST['match_type'],
					'sorting_order' => $_POST['sorting_order']
				);
				if ($_POST['top_league_id'] == '') {
					$insertData['create_date'] = strtotime(date('Y-m-d H:i:s'));
					$insert_data['add_by'] = $this->session->userdata('storefront')->admin_id;
					//echo "<pre>";print_r($insert_data);exit;
					$inserted_id = $this->General_Model->insert_data('top_league_cups', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'Top Team details added successfully.', 'redirect_url' => base_url() . 'settings/home_top_teams', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new top team.', 'redirect_url' => base_url() . 'settings/home_top_teams/add', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$editId = $_POST['top_league_id'];
					if ($this->General_Model->update_table('top_league_cups', 'id', $editId, $insert_data)) {
						$response = array('msg' => 'Top Team details updated Successfully.', 'redirect_url' => base_url() . 'settings/home_top_teams', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update top Team details.', 'redirect_url' => base_url() . 'settings/home_top_teams/edit/' . $editId, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/league/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchtolcup" => $search_text));
			} else {
				if ($this->session->userdata('searchtolcup') != NULL) {
					$search_text = $this->session->userdata('searchtolcup');
				}
			}
			$row_count = $this->uri->segment(3);
			//$this->loadRecord($row_count, 'top_league_cups', 'settings/home_top_teams', 'id', 'DESC', 'settings/teams/teams', 'topleagues', 'topteams', $search_text);
			$this->load->view(THEME.'settings/teams/teams', $this->data);
		}
	}
	/**
	 * @desc top league related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function league()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['tournments']   = $this->General_Model->get_tournments()->result();
			$this->load->view(THEME.'settings/league/add_league', $this->data);
		} else if ($segment == 'edit') {
			$this->data['tournments']   = $this->General_Model->get_tournments()->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['top_league'] = $this->General_Model->getAllItemTable_array('top_league_cups', array('id' => $edit_id))->row();
			}
			$this->load->view(THEME.'settings/league/add_league', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('top_league_cups', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Top league deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting top league.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			$this->form_validation->set_rules('tournament', 'Tournament', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'tournament_id' => $_POST['tournament'],
					'match_type' => $_POST['match_type']
				);
				if ($_POST['top_league_id'] == '') {
					$insertData['create_date'] = strtotime(date('Y-m-d H:i:s'));
					$insert_data['add_by'] = $this->session->userdata('storefront')->admin_id;
					$inserted_id = $this->General_Model->insert_data('top_league_cups', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'Top league details added successfully.', 'redirect_url' => base_url() . 'settings/league', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new top league.', 'redirect_url' => base_url() . 'settings/league/add', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$editId = $_POST['top_league_id'];
					if ($this->General_Model->update_table('top_league_cups', 'id', $editId, $insert_data)) {
						$response = array('msg' => 'Top league details updated Successfully.', 'redirect_url' => base_url() . 'settings/league', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update top league details.', 'redirect_url' => base_url() . 'settings/league/edit/' . $editId, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/league/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchtolcup" => $search_text));
			} else {
				if ($this->session->userdata('searchtolcup') != NULL) {
					$search_text = $this->session->userdata('searchtolcup');
				}
			}
			$row_count = $this->uri->segment(3);
			//$this->loadRecord($row_count, 'top_league_cups', 'settings/league', 'id', 'DESC', 'settings/league/leagues', 'topleagues', 'topleagues', $search_text);

			$this->load->view(THEME.'settings/league/leagues', $this->data);
		}
	}
	/**
	 * @desc top cups related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function cups()
	{
		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['tournments']   = $this->General_Model->get_tournments()->result();
			$this->load->view(THEME.'settings/cups/add_cups', $this->data);
		} else if ($segment == 'edit') {
			$this->data['tournments']   = $this->General_Model->get_tournments()->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['top_cup'] = $this->General_Model->getAllItemTable_array('top_league_cups', array('id' => $edit_id))->row();
			}
			$this->load->view(THEME.'settings/cups/add_cups', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('top_league_cups', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Top cup deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting top cup.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			$this->form_validation->set_rules('tournament', 'Tournament', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'tournament_id' => $_POST['tournament'],
					'match_type' => $_POST['match_type']
				);
				if ($_POST['top_cup_id'] == '') {
					$insertData['create_date'] = strtotime(date('Y-m-d H:i:s'));
					$insert_data['add_by'] = $this->session->userdata('storefront')->admin_id;
					$inserted_id = $this->General_Model->insert_data('top_league_cups', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'Top cup details added successfully.', 'redirect_url' => base_url() . 'settings/cups', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new top cup.', 'redirect_url' => base_url() . 'settings/cups/add', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$editId = $_POST['top_cup_id'];
					if ($this->General_Model->update_table('top_league_cups', 'id', $editId, $insert_data)) {
						$response = array('msg' => 'Top cup details updated Successfully.', 'redirect_url' => base_url() . 'settings/cups', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update top cup details.', 'redirect_url' => base_url() . 'settings/cups/edit/' . $editId, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/cups/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchcups" => $search_text));
			} else {
				if ($this->session->userdata('searchcups') != NULL) {
					$search_text = $this->session->userdata('searchcups');
				}
			}
			$row_count = $this->uri->segment(3);
		//	$this->loadRecord($row_count, 'top_league_cups', 'settings/cups', 'id', 'DESC', 'settings/cups/cups', 'topcups', 'topcups', $search_text);
			$this->load->view(THEME.'settings/cups/cups', $this->data);
		}
	}
	/**
	 * @desc top cups related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function upcoming_events()
	{
		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['matches']   = $this->General_Model->get_matches('', 'upcoming', '', '', '', '', '')->result();
			$this->load->view(THEME.'settings/upcoming_events/add_upcoming_event', $this->data);
		} else if ($segment == 'edit') {
			$this->data['matches']   = $this->General_Model->get_matches('', 'upcoming', '', '', '', '', '')->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['upcoming_events'] = $this->General_Model->getAllItemTable_array('upcoming_event', array('id' => $edit_id))->row();
			}
			$this->load->view(THEME.'settings/upcoming_events/add_upcoming_event', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('upcoming_event', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Upcoming event deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting upcoming event.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			$this->form_validation->set_rules('match', 'Match', 'required');
			if ($this->form_validation->run() !== false) {
				$insert_data = array(
					'match_id' => $_POST['match']
				);
				if ($_POST['upcoming_event_id'] == '') {
					$insert_data['add_by'] = $this->session->userdata('storefront')->admin_id;
					$inserted_id = $this->General_Model->insert_data('upcoming_event', $insert_data);
					if ($inserted_id) {
						$response = array('msg' => 'Upcoming event details added successfully.', 'redirect_url' => base_url() . 'settings/upcoming_events', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new upcoming event.', 'redirect_url' => base_url() . 'settings/upcoming_events/add', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$editId = $_POST['upcoming_event_id'];
					if ($this->General_Model->update_table('upcoming_event', 'id', $editId, $insert_data)) {
						$response = array('msg' => 'Upcoming event details updated Successfully.', 'redirect_url' => base_url() . 'settings/upcoming_events', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update upcoming event details.', 'redirect_url' => base_url() . 'settings/upcoming_events/edit/' . $editId, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/upcoming_events/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchupeve" => $search_text));
			} else {
				if ($this->session->userdata('searchupeve') != NULL) {
					$search_text = $this->session->userdata('searchupeve');
				}
			}
			$row_count = $this->uri->segment(3);
			//$this->loadRecord($row_count, 'upcoming_event', 'settings/upcoming_events', 'id', 'DESC', 'settings/upcoming_events/upcoming_events', 'upcoming_events', 'upcoming_events', $search_text);

			$this->load->view(THEME.'settings/upcoming_events/upcoming_events', $this->data);


		}
	}

		/**
	 * @desc static page related operations
	 * Add
	 * Edit
	 * List
	 * Delete
	 * Save
	 */
	public function banners()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->load->view(THEME.'settings/banners/add_banners', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				$edit_id = $segment4;
				$this->data['banner_details'] = $this->General_Model->get_banner_data($edit_id)->row();
			}
			$this->load->view(THEME.'settings/banners/add_banners', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('banners', 'id', $delete_id);
			if ($delete == 1) {
				$this->General_Model->delete_data('banners_lang', 'banner_id', $delete_id);
				$response = array('status' => 1, 'msg' => 'Banner deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting banner.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			$this->form_validation->set_rules('title', 'Banner Title', 'required');
			$this->form_validation->set_rules('banner_description', 'Banner Description', 'required');
			$this->form_validation->set_rules('banner_image', 'Banner Image', 'required');
			if (!empty($_FILES['banner_image']['name'])) {
				$this->form_validation->set_rules('banner_image', 'Banner file', 'callback_banner_image_file_check');
			}
			if ($this->form_validation->run() !== false) {
				$msg='';
				
				$insert_data ['title'] = $_POST['title'];
				$insert_data ['description'] = $_POST['banner_description'];
				$insert_data['status'] = $this->input->post('status') ? 1 : 0;

				if ($_POST['banner_id'] == '') {

					if (!empty($_FILES['banner_image']['name'])) {
						
						$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/banners';
						$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
						//$config['max_size'] = '1000';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('banner_image')) {
							$msg .= 'Failed to add banner image';
						} else {
							$data = $this->upload->data();
							$imagename = $data['file_name'];
							$insert_data['image'] = $imagename;
						}
					}

					$insert_data['add_by'] = $this->session->userdata('storefront')->admin_id;
					$inserted_id = $this->General_Model->insert_data('banners', $insert_data);
					if ($inserted_id) {
						//Add to language table
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['banner_id'] = $inserted_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['title'] = trim($this->input->post('title'));
							$insertData_lang['description'] = trim($this->input->post('banner_description'));
							$this->General_Model->insert_data('banners_lang', $insertData_lang);
						}
						$response = array('msg' => 'Banner details added successfully.', 'redirect_url' => base_url() . 'settings/banners', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new banner.', 'redirect_url' => base_url() . 'settings/banners/add', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$editId = $_POST['banner_id'];

					if (!empty($_FILES['banner_image']['name'])) {
						$bannerdata = $this->General_Model->getAllItemTable_array('banners', array('id' => $editId))->row();
						if (UPLOAD_PATH. 'uploads/banners/' . $bannerdata->banner_image) {
							unlink(UPLOAD_PATH. 'uploads/banners/' . $bannerdata->banner_image);
						}
						$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/banners';
						$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
						//$config['max_size'] = '1000';
						$config['encrypt_name'] = TRUE;//echo $config['upload_path'];exit;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('banner_image')) {
							$msg .= 'Failed to add banner image '.$this->upload->display_errors();
						} else {
							$data = $this->upload->data();
							$imagename = $data['file_name'];
							$insert_data['image'] = $imagename;
						}
					}

					if ($this->General_Model->update_table('banners', 'id', $editId, $insert_data)) {
						//Update language table
						$updateData_lang['title'] = trim($this->input->post('title'));
						$updateData_lang['description'] = strip_tags($this->input->post('banner_description'));
						$this->General_Model->update('banners_lang', array('banner_id' => $editId, 'language' => $this->session->userdata('language_code')), $updateData_lang);
						$response = array('msg' => 'Banner details updated Successfully.', 'redirect_url' => base_url() . 'settings/banners', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update banner details.', 'redirect_url' => base_url() . 'settings/banners/edit/' . $editId, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/banners/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} else {
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchbanner" => $search_text));
			} else {
				if ($this->session->userdata('searchbanner') != NULL) {
					$search_text = $this->session->userdata('searchbanner');
				}
			}
			$row_count = $this->uri->segment(4);
		//	$this->loadRecord($row_count, 'banners', 'settings/banners/banners', 'id', 'DESC', 'settings/banners/banners', 'banners', 'banners', $search_text);
		$this->load->view(THEME.'settings/banners/banners', $this->data);

		}
	}


	public function favorite_team_settings()
	{

		$segment = $this->uri->segment(3);
		if ($segment == 'add') {
			$this->data['sellers']    = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['fav_teams'] =  $this->General_Model->get_teams()->result();
			$this->load->view(THEME.'settings/favorite_team_settings/add', $this->data);
		} else if ($segment == 'edit') {
			$segment4 = $this->uri->segment(4);
			$this->data['sellers']    = $this->General_Model->get_admin_details_by_role_v1(1, 'status');
			$this->data['fav_teams'] =  $this->General_Model->get_teams()->result();
			
			if ($segment4 != "") {

				$this->data['setting'] = $this->General_Model->get_team_settings_by_limit('','','', '',array('id' => $segment4))->row();

			}
			$this->load->view(THEME.'settings/favorite_team_settings/add', $this->data);
		} else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = $segment4;
			$delete = $this->General_Model->delete_data('favorite_team_subscription', 'id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Favorite Teams deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error while deleting Favorite Teams.');
				echo json_encode($response);
				exit;
			}
		} else if ($segment == 'save') {
			//echo "<pre>";print_r($_POST);exit;
			$this->form_validation->set_rules('seller', 'Seller', 'required');
			$this->form_validation->set_rules('teams[]', 'Teams', 'required');
			if ($this->form_validation->run() !== false) {
				$msg='';
				
				$insert_data ['seller_id'] = $_POST['seller'];
				if($_POST['teams'][0] != ""){
					$insert_data ['teams'] = implode(',',$_POST['teams']);
				}
				
				$insert_data['status'] = $this->input->post('status') ? '1' : '0';

				if ($_POST['id'] == '') {

					$this->General_Model->delete_data('favorite_team_subscription', 'seller_id', $insert_data ['seller_id']);

					$insert_data['add_by'] = $this->session->userdata('storefront')->admin_id;
					//echo "<pre>";print_r($insert_data);exit;
					$inserted_id = $this->General_Model->insert_data('favorite_team_subscription', $insert_data);
					if ($inserted_id != "") {
					
						$response = array('msg' => 'Favorite Teams added successfully.', 'redirect_url' => base_url() . 'settings/favorite_team_settings', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to add new Favorite Team.', 'redirect_url' => base_url() . 'settings/favorite_team_settings/add', 'status' => 0);
					}
					echo json_encode($response);
					exit;
				} else {
					$editId = $_POST['id'];

					if ($this->General_Model->update_table('favorite_team_subscription', 'id', $editId, $insert_data)) {
						
						$response = array('msg' => 'Favorite Teams updated Successfully.', 'redirect_url' => base_url() . 'settings/favorite_team_settings', 'status' => 1);
					} else {
						$response = array('msg' => 'Failed to update banner details.', 'redirect_url' => base_url() . 'settings/favorite_team_settings/edit/' . $editId, 'status' => 0);
					}
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/favorite_team_settings/add', 'status' => 0);
			}
			echo json_encode($response);
			exit;
		} 
		else if($segment == "get_teams"){
			$this->datas['teams'] = explode(',',$_POST['teams']);
			$this->datas['fav_teams'] =  $this->General_Model->get_teams()->result();
            $list_orders = $this->load->view('settings/favorite_team_settings/fav_teams', $this->datas, TRUE);
            echo json_encode(array('status' => 1, 'response' => $list_orders));
            exit;
		}
		else { 
			if ($this->input->post('submit') != NULL) {
				$search_text = $this->input->post('search');
				$this->session->set_userdata(array("searchbanner" => $search_text));
			} else {
				if ($this->session->userdata('searchbanner') != NULL) {
					$search_text = $this->session->userdata('searchbanner');
				}
			}
			$row_count = $this->uri->segment(4);
			//$this->loadRecord($row_count, 'favorite_team_subscription', 'settings/favorite_team_settings', 'id', 'DESC', 'settings/favorite_team_settings/list', 'team_settings', 'team_settings', $search_text);
			$this->load->view(THEME.'settings/favorite_team_settings/list', $this->data);
		}
	}
	
	public function export(){
		$segment = $this->uri->segment(3);

		if($segment == "exports_data"){
			$this->data['tournaments'] =  $this->General_Model->get_tournments()->result();
			$this->load->view('settings/export', $this->data);
		}

		if($segment == "request_tickets"){
			$search = array();
            if($_GET['from_date'] != "" && $_GET['to_date'] != ""){
                $search['from_date']  = $_GET['from_date'];
                $search['to_date']  = $_GET['to_date'];
                $filename = "RequestTicketData-" .$_GET['from_date'] . "_To_".$_GET['to_date'].".csv"; 
                 $tournment_id = $_GET['tournament'];
            }
            else{
                 $filename = "RequestTicketData-" . date('Y-m-d H:i:s') . ".csv"; 
            }
             //$fp = fopen('file.csv', 'w'); 


             //echo "<pre>";print_r($where_array);exit;
            $this->db->select("*,countries.sortname")
		        ->join('countries', 'countries.id = request_tickets.country');
		       if( $search['from_date']  &&  $search['to_date'] ){
		       		$this->db->where('request_tickets.request_date >= ', strtotime($search['from_date']));

					$this->db->where('request_tickets.request_date <= ',strtotime($search['to_date']));
		       }
	        $this->db->join('match_info','match_info.m_id = request_tickets.event_id','left');
	        if($tournment_id){
	        	$this->db->where('match_info.tournament',$tournment_id);
	        }
		    $this->db->group_by('email_id');
           	$downloads = $this->db->get('request_tickets')->result();
            			
       
            //echo $this->db->last_query();die;
           // echo "<pre>"; print_r($downloads);die;
            // Column names 
            $fields = array(
            	'Email',
            	'First Name',
            	'Last Name',
            	'Country',
            	'Zip',
            	'Email',
            	'Zip',
            	'Phone',
            	'Phone',
            	
            ); 
            $delimiter = ","; 
             $f = fopen('php://memory', 'w'); 
            fputcsv($f, $fields, $delimiter); 
            // Display column names as first row 
            //$excelData = implode("\t", array_values($fields)) . "\n"; 
           
            foreach($downloads as $row){  
            	$mobile = str_replace(" ","",$row->mobilenumber);
            	$full_name = explode(" ",strtolower($row->full_name));
            	$lineData = array(
            		strtolower($row->email_id),
            		strtolower(@$full_name[0]),
            		strtolower(@$full_name[1]),
            		strtolower($row->sortname),
            		"",
            		strtolower($row->email_id),
            		"",
            		str_replace("+", "", $row->diallingcode).$mobile,
            		str_replace("+", "", $row->diallingcode).$mobile,
            		
            ); 
            	fputcsv($f, $lineData, $delimiter); 
           // $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
            
        	
		    	// Move back to beginning of file 
		    fseek($f, 0); 
		     
		    // Set headers to download file rather than displayed 
		    header('Content-Type: text/csv'); 
		    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
		     
		    //output all remaining data on a file pointer 
		    fpassthru($f); 
            exit;
		}
		if($segment == "abondaned_cart"){
			$tournment_id = $_GET['tournament'];
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];

			$this->db->select("booking_global.*, booking_billing_address.first_name,booking_billing_address.last_name,booking_billing_address.email,booking_tickets.match_name,booking_tickets.*,register.first_name as buyer_first_name, register.last_name as buyer_last_name, register.email as buyer_email, 
				register.code as buyer_code, 
				register.dialing_code as buyer_dialing_code,
				register.mobile as buyer_mobile,
				countries.sortname,
				booking_global.created_at as cart_date");
			$this->db->join('booking_billing_address','booking_billing_address.booking_id = booking_global.bg_id');
			
			$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
			$this->db->join('register','register.id = booking_global.user_id');
            $this->db->join('countries', 'countries.id = register.country');
			$this->db->join('match_info','match_info.m_id = booking_tickets.match_id','left');
			///$this->db->where('DATE(match_info.match_date) >=', date("Y-m-d"));
			$this->db->where('booking_status','7');
			if($tournment_id){
				$this->db->where('booking_tickets.tournament_id',$tournment_id);
			}
			
			if ($start_date) {
				$this->db->where('booking_global.created_at >= ', date("Y-m-d 00:00", strtotime($start_date)));
			}
			if ($end_date) {
				$this->db->where('booking_global.created_at <= ', date("Y-m-d 23:59", strtotime($end_date)));
			}
			//$this->db->group_by('')
			$this->db->group_by("booking_global.bg_id");
			$query = $this->db->get('booking_global');
			$data = $query->result();
	
			//echo $query->num_rows();
			//echo $this->db->last_query();
			$output = array();
			//echo "<pre>";pr($data);die;


				 $search = array();
            if($_GET['from_date'] != "" && $_GET['to_date'] != ""){
                $search['from_date']  = $_GET['from_date'];
                $search['to_date']  = $_GET['to_date'];
                $filename = "AbandonedCart-" .$_GET['from_date'] . "_To_".$_GET['to_date'].".csv"; 
            }
            else{
                 $filename = "AbandonedCart-" . date('Y-m-d H:i:s') . ".csv"; 
            }
             //$fp = fopen('file.csv', 'w'); 

	            $fields = array(
	            	'Email',
	            	'First Name',
	            	'Last Name',
	            	'Country',
	            	'Zip',
	            	'Email',
	            	'Zip',
	            	'Phone',
	            	'Phone',
	            	
	            ); 
	            $delimiter = ","; 
	             $f = fopen('php://memory', 'w'); 
	            fputcsv($f, $fields, $delimiter); 
	            // Display column names as first row 
	            //$excelData = implode("\t", array_values($fields)) . "\n"; 
	           

	   
	            $email_data = array("dummy");
			foreach($data as $row){
			
				$this->db->select("booking_global.bg_id");
				$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
				$this->db->join('match_info','match_info.m_id = booking_tickets.match_id','left')
						
		                 ->where('booking_tickets.match_id',$row->match_id)
		                 ->where('booking_tickets.ticket_id',$row->ticket_id)
		                 ->where('booking_global.user_id',$row->user_id);
		             

		    //              if ($start_date) {
						// 	$this->db->where('booking_global.created_at >= ', date("Y-m-d 00:00:00", strtotime($start_date)));
						// }
						// if ($end_date) {
						// 	$this->db->where('booking_global.created_at <= ', date("Y-m-d 23:59:59", strtotime($end_date)));
						// }

		                $this->db->group_start();
						$this->db->where('booking_global.booking_status',1)
						->or_where('booking_global.booking_status',2)
						->or_where('booking_global.booking_status',4)
						->or_where('booking_global.booking_status',5)
						->or_where('booking_global.booking_status',6);
						$this->db->group_end();
						$this->db->group_by("booking_global.bg_id");
				$query = $this->db->get('booking_global') ; 
				$count = $query->num_rows();
				
				
				if($count == 0 ){
					
				if(@$email_data[$row->buyer_email] == ""){

					$email_data[$row->buyer_email] =  $row->buyer_email;
					

			            $mobile = str_replace(" ","",$row->buyer_mobile);
		            	$lineData = array(
		            		strtolower($row->buyer_email),
		            		strtolower($row->buyer_first_name),
		            		strtolower($row->buyer_last_name),
		            		strtolower($row->sortname),
		            		$row->buyer_code,
		            		strtolower($row->buyer_email),
		            		$row->buyer_code,
		            		str_replace("+", "", $row->buyer_dialing_code).$mobile,
		            		str_replace("+", "", $row->buyer_dialing_code).$mobile,
		            		$row->match_id."--".$row->ticket_id."-".$row->user_id  ); 
		            
		            
		            	fputcsv($f, $lineData, $delimiter); 
		          	$email_data[$row->buyer_email] =  $row->buyer_email;
		            }
		               		
				}      
			}
		    fseek($f, 0); 
		    header('Content-Type: text/csv'); 
		    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
		    fpassthru($f); 
			
		}
		else if ($segment == 'customer') {
            $search = array();
            if($_GET['from_date'] != "" && $_GET['to_date'] != ""){
                $search['from_date']  = $_GET['from_date'];
                $search['to_date']  = $_GET['to_date'];
                $filename = "CustomerData-" .$_GET['from_date'] . "_To_".$_GET['to_date'].".csv"; 
            }
            else{
                 $filename = "CustomerData-" . date('Y-m-d H:i:s') . ".csv"; 
            }
             //$fp = fopen('file.csv', 'w'); 


             //echo "<pre>";print_r($where_array);exit;
            $downloads = $this->General_Model->get_customer_data($search)->result();
            //echo $this->db->last_query();die;
           // echo "<pre>"; print_r($downloads);die;
            // Column names 
            $fields = array(
            	'Email',
            	'First Name',
            	'Last Name',
            	'Country',
            	'Zip',
            	'Email',
            	'Zip',
            	'Phone',
            	'Phone',
            	
            ); 
            $delimiter = ","; 
             $f = fopen('php://memory', 'w'); 
            fputcsv($f, $fields, $delimiter); 
            // Display column names as first row 
            //$excelData = implode("\t", array_values($fields)) . "\n"; 
           
            foreach($downloads as $row){  
            	$mobile = str_replace(" ","",$row->mobile);
            	$lineData = array(
            		strtolower($row->email),
            		strtolower($row->first_name),
            		strtolower($row->last_name),
            		strtolower($row->sortname),
            		$row->code,
            		strtolower($row->email),
            		$row->code,
            		str_replace("+", "", $row->dialing_code).$mobile,
            		str_replace("+", "", $row->dialing_code).$mobile,
            		
            ); 
            	fputcsv($f, $lineData, $delimiter); 
           // $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
            
        	
		    	// Move back to beginning of file 
		    fseek($f, 0); 
		     
		    // Set headers to download file rather than displayed 
		    header('Content-Type: text/csv'); 
		    header('Content-Disposition: attachment; filename="' . $filename . '";');  
		    //output all remaining data on a file pointer 
		    fpassthru($f); 
            exit;
		}
	}

	public function get_ticket_type_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['ticket_type'])  ) 
		{
			$search['status']=$_POST['status'];
			$search['name']=$_POST['ticket_type'];

			$allcount = $this->General_Model->get_ticket_type_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_ticket_type_by_limit($rowno, $row_per_page, "name", 'asc', '', $search)->result();		

		}
		else
		{	
			$allcount = $this->General_Model->get_ticket_type_by_limit('', '', '', '', '', "")->num_rows();
			$records = $this->General_Model->get_ticket_type_by_limit($rowno, $row_per_page, "name", 'asc', '', "")->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/ticket_types/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/ticket_types/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}

					if (UPLOAD_PATH. '/uploads/ticket_image/' . $record->ticket_image) {
						$image = UPLOAD_PATH. '/uploads/ticket_image/' . $record->ticket_image;
					} else {
						$image = base_url('assets/img/placeholders/placeholder.png');
					}

			$data[] = array( 
                "tickettype"				=> $record->tickettype, 
				"status"				=> $status,
				"ticket_image"			=> '<div class="h-avatar is-small image-small">
				<img class="avatar" src="'.$image.'" alt="'.$record->tickettype.'">
			</div>',
				"action"				=> $action
			
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
             
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['ticket_type'])  ) 
		{
			$search['status']=$_POST['status'];
			$search['name']=$_POST['ticket_type'];

			$allcount = $this->General_Model->get_ticket_details_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_ticket_details_by_limit($rowno, $row_per_page, "ticket_name", 'asc', '', $search)->result();		

		}
		else
		{			
			$records = $this->General_Model->get_ticket_details_by_limit($rowno, $row_per_page, "ticket_name", 'asc', '', "")->result();
			$allcount = $this->General_Model->get_ticket_details_by_limit('', '', '', '', '', "")->num_rows();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/ticket_details/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/ticket_details/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}

					if (UPLOAD_PATH. '/uploads/ticket_details/' . $record->ticket_image) {
						$image = UPLOAD_PATH. '/uploads/ticket_details/' . $record->ticket_image;
					} else {
						$image = base_url('assets/img/placeholders/placeholder.png');
					}

			$data[] = array( 
                "ticket_det_name"				=> $record->ticket_det_name, 
				"status"				=> $status,
				"ticket_image"			=> '<div class="h-avatar is-small image-small">
				<img class="avatar" src="'.$image.'" alt="'.$record->ticket_det_name.'">
			</div>',
				"action"				=> $action
			
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
	//
	public function get_afliliate_markup_list()
	{
		$search=[];
		$role=$_POST['role'];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

             
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['user']) || (isset($_POST['markup_type']) && $_POST['markup_type']!="") ) 
		{
			$search['status']=$_POST['status'];
			$search['markup_type']=$_POST['markup_type'];
			$search['name']=$_POST['user'];

			$allcount = $this->General_Model->get_table_row_count_markup($role,$search)->num_rows();
			$records = $this->General_Model->get_limit_based_data_markup('tickets_markup', $rowno, $row_per_page, 'tickets_markup.id', 'DESC', $role,$search)->result();

		}
		else
		{			
			$allcount = $this->General_Model->get_table_row_count_markup($role,"")->num_rows();
			// Get records
			$records = $this->General_Model->get_limit_based_data_markup('tickets_markup', $rowno, $row_per_page, 'tickets_markup.id', 'DESC', $role,"")->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
									if($role==1)
						{
							$url='seller';
						}
						else if($role==2)
						{
							$url='partner';
						}
						else if($role==3)
						{
							$url='afliliate';
						}
			$edit_url= base_url()."settings/seller_settings/add_".$url."_settings/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/seller_settings/delete_'.$url.'_markup/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}
			$markup_type="";
			$markup_type = ucwords(strtolower(str_replace('_', ' ', $record->markup_type)));					

			$data[] = array( 
                "user"								=> $record->admin_name." ".$record->admin_last_name, 
				"markup_type"						=> $markup_type,				
				"markup"							=> $record->markup." %",
				"status"							=> $status,
				"action"							=> $action,
			
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

	public function get_top_team_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

             
		if ( !empty($_POST['team'])  ) 
		{
			$search['team']=$_POST['team'];
			$allcount = $this->General_Model->top_teams_by_limit('', '', '', '', array('match_type=' => 'team'), $search)->num_rows();
				// Get records
			$records = $this->General_Model->top_teams_by_limit($rowno, $row_per_page, 'id','DESC', array('match_type=' => 'team'), $search)->result();

		}
		else
		{			
			$allcount = $this->General_Model->top_teams_by_limit('', '', '', '', array('match_type=' => 'team'), "")->num_rows();
				// Get records
			$records = $this->General_Model->top_teams_by_limit($rowno, $row_per_page, 'id','DESC', array('match_type=' => 'team'), "")->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
									
			$edit_url= base_url()."settings/home_top_teams/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/home_top_teams/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
							

			$data[] = array( 
                "team_name"								=> $record->team_name, 				
				"sorting_order"							=> $record->sorting_order,		
				"action"								=> $action
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

	public function get_top_league_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

             
		if ( !empty($_POST['league'])  ) 
		{
			$search['league']=$_POST['league'];
			$allcount = $this->General_Model->top_leagues_by_limit('', '', '', '', array('match_type=' => 'league'), $search)->num_rows();
				// Get records
			$records = $this->General_Model->top_leagues_by_limit($rowno, $row_per_page, 'id','DESC', array('match_type=' => 'league'), $search)->result();

		}
		else
		{			
			$allcount = $this->General_Model->top_leagues_by_limit('', '', '', '', array('match_type=' => 'league'), "")->num_rows();
				// Get records
			$records = $this->General_Model->top_leagues_by_limit($rowno, $row_per_page, 'id','DESC', array('match_type=' => 'league'), "")->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
									
			$edit_url= base_url()."settings/league/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/league/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
							

			$data[] = array( 
                "tournament_name"						=> $record->tournament_name, 		
				"action"								=> $action
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

	public function get_top_cups_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

             
		if ( !empty($_POST['cups'])  ) 
		{
			$search['cups']=$_POST['cups'];
			$allcount = $this->General_Model->top_leagues_by_limit('', '', '', '', array('match_type=' => 'cups'), $search)->num_rows();
				// Get records
			$records = $this->General_Model->top_leagues_by_limit($rowno, $row_per_page, 'id','DESC', array('match_type=' => 'cups'), $search)->result();

		}
		else
		{			
			$allcount = $this->General_Model->top_leagues_by_limit('', '', '', '', array('match_type=' => 'cups'), "")->num_rows();
				// Get records
			$records = $this->General_Model->top_leagues_by_limit($rowno, $row_per_page, 'id','DESC', array('match_type=' => 'cups'), "")->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
									
			$edit_url= base_url()."settings/cups/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/cups/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
							

			$data[] = array( 
                "tournament_name"						=> $record->tournament_name, 		
				"action"								=> $action
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

	public function get_page_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];

             //if () {
			 
		if (  $_POST['page_title']!="" ||(isset($_POST['status']) )   ) 
		{
			$search['page_title']=$_POST['page_title'];
			$search['status']=$_POST['status'];
			// echo '<pre/>';
			// print_r($search);
			// exit;
			$allcount = $this->General_Model->get_table_row_count('static_page', '','', 'id','DESC',$search);
			// Get records
			$records = $this->General_Model->get_limit_based_data('static_page', $rowno, $row_per_page, 'id','DESC',$search)->result();

		}
		else
		{	
			$allcount = $this->General_Model->get_table_row_count('static_page', '','', 'id','DESC','');
			// Get records
			$records = $this->General_Model->get_limit_based_data('static_page', $rowno, $row_per_page, 'id','DESC','')->result();
		}

		// echo $this->db->last_query();
		// // exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;
		$this->data['page_types'] = $this->General_Model->getAllItemTable('page_types')->result();
		
		foreach($records as $record ){
									
			$edit_url= base_url()."settings/static_pages/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/static_pages/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
			if ($record->status == 0) {
				$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
			}
			if ($record->status == 1) {
				$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
			}

			$pageTypeId = $record->page_type;
			$pageTypeName = $this->getPageTypeName($this->data['page_types'], $pageTypeId);
			if ($pageTypeName) 
				$pageTypeName=$pageTypeName;				
			else
				$pageTypeName="";

			$data[] = array( 
                "title"						=> $record->page_title, 		
				"page_type_name"			=> $pageTypeName,
				"status"					=> $status, 
				"action"					=> $action
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

	function getPageTypeName($array, $pageTypeId) {
		foreach ($array as $item) {
			if ($item->page_type_id == $pageTypeId) {
				return $item->page_type_name;
			}
		}
		return null; // Return null if page_type_id is not found
	}

	public function get_banner_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if (  $_POST['page_title']!="" ||(isset($_POST['status']) )   ) 
		{
			$search['page_title']=$_POST['page_title'];
			$search['status']=$_POST['status'];
			$allcount = $this->General_Model->get_table_row_count('banners', '','', 'id','DESC',$search);
			// Get records
			$records = $this->General_Model->get_limit_based_data('banners', $rowno, $row_per_page, 'id','DESC',$search)->result();

		}
		else
		{	
			$allcount = $this->General_Model->get_table_row_count('banners', '','', 'id','DESC','');
			// Get records
			$records = $this->General_Model->get_limit_based_data('banners', $rowno, $row_per_page, 'id','DESC','')->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/banners/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/banners/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}

					if (UPLOAD_PATH. '/uploads/banners/' . $record->image) {
						$image = UPLOAD_PATH. '/uploads/banners/' . $record->image;
					} else {
						$image = base_url('assets/img/placeholders/placeholder.png');
					}

			$data[] = array( 
                "title"				=> $record->title, 
				"status"				=> $status,
				"image"			=> '<div class="h-avatar is-small image-small">
				<img class="avatar" src="'.$image.'" alt="'.$record->title.'">
			</div>',
				"action"				=> $action
			
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

	public function get_city_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( !empty($_POST['city']) || !empty($_POST['state']) || !empty($_POST['country'])  ) 
		{
			
			$search['city']=trim($_POST['city']);
			$search['state']=trim($_POST['state']);
			$search['country']=trim($_POST['country']);
			//country_id
			$allcount = $this->General_Model->get_city_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_city_by_limit($rowno, $row_per_page,'state_id','ASC', '', $search)->result();
		// 	echo $this->db->last_query();
		// exit;

		}
		else
		{
			$allcount = $this->General_Model->get_city_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_city_by_limit($rowno, $row_per_page,'state_id','ASC', '', $search)->result();

		}

	
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/cities/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/cities/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
			

			$data[] = array(
				"city_name"				=> ucwords(strtolower($record->name)), 
                "country_name"				=> ucwords(strtolower($record->country)), 
				"state_name"				=> ucwords(strtolower($record->state)),
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

	//

	public function get_upcoming_events_list()
	{
		
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( !empty($_POST['upcoming_event'])  ) 
		{
			 $search['name']=$_POST['upcoming_event'];
			
			$allcount = $this->General_Model->get_upcoming_event_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_upcoming_event_by_limit($rowno, $row_per_page, 'id','DESC', '', $search)->result();	

		}
		else
		{	
			$allcount = $this->General_Model->get_upcoming_event_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_upcoming_event_by_limit($rowno, $row_per_page, 'id','DESC', '', $search)->result();
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/upcoming_events/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/upcoming_events/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
			
			$encode_id = base64_encode(json_encode($record->match_id));			
			$data[] = array( 
                "tickettype"				=>  '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$record->match_name.'</a>',
				"action"					=>  $action
				
			
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

	public function get_favorite_team_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['name'])  ) 
		{
			$search['status']=$_POST['status'];
			$search['name']=$_POST['name'];

			$allcount = $this->General_Model->get_team_settings_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_team_settings_by_limit($rowno, $row_per_page, 'id','desc', '', $search)->result();	

		}
		else
		{							
			$allcount = $this->General_Model->get_team_settings_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_team_settings_by_limit($rowno, $row_per_page, 'id','desc', '', $search)->result();


		}

				
		if(!empty($records)){
			foreach($records as $rkey => $rec){
				$team_data = array();
				$teams = explode(',',$rec->teams);
				foreach($teams as $team){
					$team_name = $this->General_Model->getAllItemTable_array('teams_lang',array('team_id' => $team,'language' => 'en'))->row();
					$team_data[] = $team_name->team_name;
					
				}
				$records[$rkey]->teams = implode(',',$team_data);
			}
		}

		// echo $this->db->last_query();
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/favorite_team_settings/edit/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/favorite_team_settings/delete/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}
					
					$seller='<a href="'.base_url()."home/seller_info/". $record->seller_id.'">'.$record->seller_first_name." ".$record->seller_last_name.'</a>';

			$data[] = array( 
                "seller"				=> $seller, 
				"teams"					=> $record->teams,
				"status"				=> $status,
				"action"				=> $action
			
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

	public function get_sitefee_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if ( (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['ticket_type'])  ) 
		{
			$search['status']=$_POST['status'];
			$search['match']=$_POST['ticket_type'];

			$allcount = $this->General_Model->get_sitefee_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_sitefee_by_limit($rowno, $row_per_page, 'id', 'desc', '', $search)->result();	

		}
		else
		{

			$allcount = $this->General_Model->get_sitefee_by_limit('', '', '', '', '', $search)->num_rows();
			$records = $this->General_Model->get_sitefee_by_limit($rowno, $row_per_page, 'id', 'desc', '', $search)->result();
		}

		foreach($records as $record ){
			
			$edit_url= base_url()."settings/sitefee_settings/add_sitefee_settings/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												<a href="javascript:void(0)" class="dropdown-item" id="branch_'.$record->id.'" data-href="'.base_url().'settings/sitefee_settings/delete_sitefee_markup/'.$record->id.'" onclick="delete_data(\''.$record->id.'\');">Delete </a>
											</div>
										</div>';
				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}

					if (UPLOAD_PATH. '/uploads/ticket_image/' . $record->ticket_image) {
						$image = UPLOAD_PATH. '/uploads/ticket_image/' . $record->ticket_image;
					} else {
						$image = base_url('assets/img/placeholders/placeholder.png');
					}

					$encode_id = base64_encode(json_encode($record->match_id));

					//settings/tournaments/edit/47

			$data[] = array( 
                "team_name"					=> '<a href="'.base_url().'settings/tournaments/edit/'.$record->t_id.'" >'.$record->team_name.'</a>', 
				"match_name"				=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$record->match_name.'</a>',
				"company_name"				=> $this->session->userdata('storefront')->company_name,
				"markup"					=> $record->markup." %",
				"status"					=> $status,
				"action"					=> $action
			
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

	public function get_email_list()
	{
		$search=[];
		$row_per_page = 50;
        $rowno = $_POST['start'];$where_array=[];$draw = $_POST['draw'];$data = [];
             
		if (  (isset($_POST['status']) && $_POST['status']!="") || !empty($_POST['ticket_type'])   ) 
		{
			$search['name']=$_POST['ticket_type'];
			$search['status']=$_POST['status'];
			$allcount = $this->General_Model->get_table_row_count('email_access', '','', 'id','DESC',$search);
			$records = $this->General_Model->get_limit_based_data('email_access', $rowno, $row_per_page, 'id','DESC',$search)->result();

		}
		else
		{	
			$allcount = $this->General_Model->get_table_row_count('email_access', '','', 'id','DESC','');
			// Get records
			$records = $this->General_Model->get_limit_based_data('email_access', $rowno, $row_per_page, 'id','DESC','')->result();
		}

			// echo $this->db->last_query();
			// echo '<pre/>';
		// 	print_r($_POST['status']);
		// 	exit;
		// exit;
		// echo '<pre/>';
		// print_r($records);
		// exit;

		foreach($records as $record ){


			$edit_url= base_url()."settings/email_settings/edit_email_access/".$record->id;

			 $action					=	'<div class="dropdown">
											<a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												<i class="mdi mdi-dots-vertical fs-sm"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												
											</div>
										</div>';

				if ($record->status == 0) {
						$status= '<div class="bttns"><span class="badge badge-danger">InActive</span></div>';
					}
					if ($record->status == 1) {
						$status= '<div class="bttns"><span class="badge badge-success">Active</span></div>';
					}

				

			$data[] = array( 
                "smtp"						=> $record->smtp,
				"host"						=> $record->host,
				"port"						=> $record->port,
				"username"					=> $record->username,
				"password"					=> $record->password,
				"status"					=> $status,
				"action"					=> $action
			
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

			$response = array('status' => 1, 'uploaded_file' => $uploaded_file);
			echo json_encode($response);
			exit;
		}
	}

	public function seo_country_list()
	{
		$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
		$this->data['teams'] = $this->General_Model->get_teams()->result();
		$this->data['tournments'] = $this->General_Model->get_tournments()->result();
		$this->data['country'] = $this->General_Model->get_country_name()->result();
		$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
		$this->data['currencies'] = $this->General_Model->getAllItemTable('currency_types', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
		$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
		$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();

		$url_segment  = $segment = $this->uri->segment(3);
		$country_id       = $this->uri->segment(4);
		if ($url_segment == "add") {
			
			$this->load->view(THEME.'/event/add_seo_country_list', $this->data);
		}	
		else if ($url_segment == "delete") {
			$c_id   = $this->uri->segment(4);
			$updateData_data['status'] = 2;
			//$delete = $this->General_Model->delete_data('tournament', 't_id', $t_id);
			$delete = $this->General_Model->update('seo_country_list', array('c_id' => $c_id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('tournament_lang', 'tournament_id', $t_id);
				$response = array('status' => 1, 'msg' => 'Data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting data.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($url_segment == "save") {		
			$seocountryId = $this->input->post('seocountryId');
			//Insert into table
			if ($seocountryId == '') {
			
				if ($this->input->post()) {
					$msg = '';
					//$this->form_validation->set_rules('name', 'Country Name', 'required');
					if (!empty($_FILES['tournament_image']['name'])) {
						$this->form_validation->set_rules('tournament_image', 'Image file', 'callback_timage_file_check');
					}

					if (!empty($_FILES['country_icon']['name'])) {
						$this->form_validation->set_rules('country_icon', 'Image file', 'callback_timage_file_check');
					}

					$insertData = array();
					if ($this->form_validation->run() !== false) {

						if (!empty($_FILES['tournament_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX .'uploads/seo_country';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
						
							if ($this->upload->do_upload('tournament_image')) {
								$outputData['tournament_image'] = $this->upload->data();
								$insertData['country_image'] = $outputData['tournament_image']['file_name'];
								
							} else {
								
								$msg .= 'Failed to add tournament image';
								$error = array('error' => $this->upload->display_errors());
								
							}
							}
						
							if (!empty($_FILES['country_icon']['name'])) {
								$config['upload_path'] = UPLOAD_PATH_PREFIX .'uploads/seo_country_icon';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								//$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->upload->initialize($config); // Re-initialize the upload library
								$this->load->library('upload', $config);							
									if ($this->upload->do_upload('country_icon')) {
										
										$outputData['country_icon'] = $this->upload->data();
										$insertData['country_icon'] = $outputData['country_icon']['file_name'];
										
									} else {
										
										$msg .= 'Failed to add Country Icon';
										$error = array('error' => $this->upload->display_errors());
																		
									}
								}

						$insertData['country_name'] = trim($this->input->post('name'));
						$insertData['url_key'] = trim($this->input->post('url_key'));
						//$insertData['status'] = $this->input->post('is_active') ? 1 : 0;
						$insertData['create_date'] 	= date('Y-m-d H:i:s');	
						$insertData['top_country'] 	= trim($this->input->post('top_country'));	

						$top_cityIds = $this->input->post('top_city');						
						$insertData['top_city'] = !empty($top_cityIds) ? implode(',', $top_cityIds) : '';
					//	$insertData['top_venue'] 	= trim($this->input->post('top_venue'));	
					
					    $top_venueIds = $this->input->post('top_venue');						
						$insertData['top_venue'] = !empty($top_venueIds) ? implode(',', $top_venueIds) : '';

						$insertData['status'] = $this->input->post('status') ? 1 : 0;
						$insertData['top_country_status'] = $this->input->post('top_country_status') ? 1 : 0;
					
						$t_id = $this->General_Model->insert_data('seo_country_list', $insertData);						

						//Add to language table
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
						$insertData['tournament_image']="";
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['country_id'] = $t_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['country_name'] = trim($this->input->post('name'));
							$insertData_lang['country_image'] = $insertData['country_image'];
							$insertData_lang['country_url_key'] = strip_tags($this->input->post('url_key'));
							$insertData_lang['meta_description'] = $this->input->post('metadescription');
							$insertData_lang['page_content'] = $this->input->post('tournament_content');
							
							$this->General_Model->insert_data('seo_country_list_lang', $insertData_lang);
						}					

						$response = array('status' => 1, 'msg' => 'SEO Country Details Added Successfully. ' . $msg, 'redirect_url' => base_url() . 'settings/seo_country_list/edit/'.$t_id.'?tab=content');
						echo json_encode($response);
						exit;
					} else {
						$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_country_list/add', 'status' => 0);
						echo json_encode($response);
						exit;
					}
				}
			} else {
				$seocountry_id =    $seocountryId;
				//echo "<pre>";print_r($_POST);exit;
				//if its an update request
			
				if ($this->input->post()) {

					if($_POST['flag'] != 'content' && $_POST['flag'] != 'page_content'){
						
						$this->form_validation->set_rules('name', 'Tournament Name', 'required');
						if (!empty($_FILES['tournament_image']['name'])) {
							$this->form_validation->set_rules('tournament_image', 'Image file', 'callback_timage_file_check');
						}
						}
						else if($_POST['flag'] == 'content'){
						
						$this->form_validation->set_rules('title', 'Title', 'required');

						}
						else if($_POST['flag'] == 'page_content'){								
							$this->form_validation->set_rules('country_content_1','Country Content 1', 'required');
							$this->form_validation->set_rules('country_content_2','Country Content 2', 'required');
						}


					$updateData = array();
					$updateData_lang = array();
					
					$msg = '';
					if ($this->form_validation->run() !== false) {

						if($_POST['flag'] != 'content'){	
								
							$teamdata = $this->General_Model->getAllItemTable_array('seo_country_list', array('c_id' => $seocountry_id))->row();			
						if (!empty($_FILES['tournament_image']['name'])) {					
						
							if (@UPLOAD_PATH_PREFIX .'uploads/seo_country/' . $teamdata->country_image) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/seo_country/' . $teamdata->country_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/seo_country';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '1000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('tournament_image')) {
								$msg .= 'Failed to add country image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['country_image'] = $imagename;
								$updateData['country_image'] = $imagename;
							}
							
						} 
						else {
							
							$exs_file = $this->input->post('exs_file');
							if (!empty($exs_file)) {
								$updateData['country_image'] = trim($exs_file);
								$updateData_lang['country_image'] = trim($exs_file);
							}
							else
							{
								$updateData['country_image']=$teamdata->country_image;
								$updateData_lang['country_image']=$teamdata->country_image;							
							}
						}

						// country Icon 
						if (!empty($_FILES['country_icon']['name'])) {					
						
							if (@UPLOAD_PATH_PREFIX .'uploads/seo_country_icon/' . $teamdata->country_icon) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/seo_country_icon/' . $teamdata->country_icon);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/seo_country_icon';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '1000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('country_icon')) {
								$msg .= 'Failed to add country Icon';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];								
								$updateData['country_icon'] = $imagename;
							}
							
						} 
						else {
							
							$exs_file = $this->input->post('exs_file_icon');
							if (!empty($exs_file)) {
								$updateData['country_icon'] = trim($exs_file);
								
							}
							else
							{
								$updateData['country_icon']=$teamdata->country_icon;
													
							}
						}
						// End of country Icon

						$url_key = $this->input->post('url_key');
						if (!empty($url_key)) {
							$updateData['url_key'] = trim($url_key);
						}

						$country_name = $this->input->post('name');
						if (!empty($country_name)) {
							$updateData['country_name'] = trim($country_name);
							$updateData_lang['country_name'] = trim($country_name);
						}
					
						
						$top_country = $this->input->post('top_country');
						if (!empty($top_country)) {
							$updateData['top_country'] = trim($top_country);
						}
						//$updateData['top_country'] 	= trim($this->input->post('top_country'));

						if (!empty($this->input->post('top_city'))) {
												$top_cityIds = $this->input->post('top_city');						
												$updateData['top_city'] = !empty($top_cityIds) ? implode(',', $top_cityIds) : '';			
						}		
						if (!empty($this->input->post('top_venue'))) {
					    $top_venueIds = $this->input->post('top_venue');						
						$updateData['top_venue'] = !empty($top_venueIds) ? implode(',', $top_venueIds) : '';
						}

						
						// $country_name = $this->input->post('name');
						// if (!empty($country_name)) {
						// 	$updateData['country_name'] = trim($country_name);
						// //	$updateData_lang['country_name'] = trim($country_name);
						// }
												
						// echo '<pre/>';
						// print_r($_POST);
						// exit;
						if($_POST['flag'] = 'page_content' && $_POST['status_flag'] ==""){	
							$updateData['status'] = $this->input->post('status') ? 1 : 0;	
							$updateData['top_country_status'] = $this->input->post('top_country_status') ? 1 : 0;
						}
						
						
						if($this->input->post('country_content_1')!=""){
							$updateData_lang['country_content_1'] = $this->input->post('country_content_1');
						}

						if($this->input->post('country_content_2')!=""){
							$updateData_lang['country_content_2'] = $this->input->post('country_content_2');
						}
					}
					else{

						$country_name = $this->input->post('name');
						if (!empty($country_name)) {							
							$updateData_lang['country_name'] = trim($country_name);
						}
						//$updateData['page_title'] = strip_tags($this->input->post('title'));
						$updateData['meta_description'] = $this->input->post('metadescription');
						$updateData_lang['page_title'] = strip_tags($this->input->post('title'));
						$updateData_lang['meta_description'] = $this->input->post('metadescription');
						$updateData_lang['seo_keywords'] = $this->input->post('seo_keywords');
						$updateData_lang['search_keywords'] = $this->input->post('seo_keywords');
						$updateData['seo_keywords'] = $this->input->post('seo_keywords');
						$updateData['search_keywords'] = $this->input->post('seo_keywords');
						$updateData['search_keywords'] = $this->input->post('seo_keywords');
						$updateData_lang['country_url_key'] = $this->input->post('url_key');
						$updateData['url_key'] = $this->input->post('url_key');						
					}
// echo '<pre/>';
// print_r($updateData);
// print_r($updateData_lang);
// exit;
						
						$this->General_Model->update('seo_country_list', array('c_id' => $seocountry_id), $updateData);					
					
						$this->General_Model->update('seo_country_list_lang', array('country_id' => $seocountry_id, 'language' => $this->session->userdata('language_code')), $updateData_lang);
											
						$response = array('status' => 1, 'msg' => 'Changes updated Successfully.', 'redirect_url' => base_url() . 'settings/seo_country_list');
						echo json_encode($response);
						exit;
					}
					else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_country_list/add', 'status' => 0);
					echo json_encode($response);
					exit;
				}
				}
			}
		}	
		else if ($url_segment == "edit") {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			if ($country_id != '') {

				//$search['c_id'] =$country_id;	
				$this->data['tournaments']      = $this->General_Model->get_seo_country_data($country_id)->row();		
						
			}	
			$this->load->view(THEME.'event/add_seo_country_list', $this->data);
		}
		else
		{			
			$this->load->view(THEME.'/event/seo_country_list', $this->data);
		}
		
	}

	public function get_seo_country_list()
	{
			// ini_set('display_errors', 1);
			// ini_set('display_startup_errors', 1);
			// error_reporting(E_ALL);
	   $search=[];
	   $order_column="";
	   $order_by='';
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

	   $seg = $this->uri->segment(3);//echo $seg;exit;
	   if($this->uri->segment(3) == ''){
	   $seg = 'untrashed';
	   }
	   if (isset($_POST['country'])  || isset($_POST['status']) || isset($_POST['top_country']))
		{		
				
			$search['status']=$_POST['status'];
			$search['top_country']=$_POST['top_country'];

	  // if( !empty($_POST['country']) )
	   
		//$country = isset($_POST['country']) ?  implode("','", $_POST['country']) : '';
		$search['country'] =$_POST['country'];	
		   $allcount = $this->General_Model->get_seo_country_list($search)->num_rows();
		   $records = $this->General_Model->get_seo_country_list($search)->result();
	   }
	   else
	   {
		
			$allcount = $this->General_Model->get_seo_country_list()->num_rows();
			$records = $this->General_Model->get_seo_country_list()->result();
	   }
	   
   //echo $this->db->last_query();exit;
	   $data = [];
	   foreach($records as $record ){				   

							   $edit_content  = '<div class="dropdown">
							   <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
								   data-toggle="dropdown">
								   <i class="mdi mdi-dots-vertical fs-sm"></i>
							   </a>
							   <div class="dropdown-menu dropdown-menu-right">';

				   
						   if ($this->session->userdata('role') != 9) {
							   $edit_content .= '
										   <a href="'.base_url().'settings/seo_country_list/edit/'.$record->c_id.'" class="dropdown-item ">
											   
											   <i class="fas fa-pencil-alt mr-1"></i>													
											   &nbsp;Edit SEO Country Details
										   </a>';
						   }
						 
						   $edit_content .= '
										   <a href="'.base_url().'settings/seo_country_list/edit/'.$record->c_id.'?tab=content" class="dropdown-item ">
											   
												   <i class="fas fa-pencil-alt mr-1"></i>
												   &nbsp;Edit Content Details
											   
										   </a>';

						$edit_content .= '
						<a href="'.base_url().'settings/seo_country_list/edit/'.$record->c_id.'?tab=page_content" class="dropdown-item ">
							
								<i class="fas fa-pencil-alt mr-1"></i>
								&nbsp;Edit Page Content Details
							
						</a>';
						   if ($this->session->userdata('role') != 9) {
							   if ($record->s_no == '') {
								   $edit_content .= '
										   <hr class="dropdown-divider">';
								   if ($record->status != 2) {
									   $edit_content .= '
										   <a id="branch_'.$record->c_id.'" href="javascript:void(0);" data-href="'.base_url().'settings/seo_country_list/delete/'.$record->c_id.'" class="dropdown-item  delete_action" onClick="delete_data('.$record->c_id.');">
										   
												   <i class=" fas fa-trash mr-1"></i>
												   &nbsp;Remove from list
										   
										   </a>';
								   }
							   }
							
						   }
					
						   $country= $this->General_Model->get_country_name_id($record->top_country)->row();

						   $ip_status=($record->status == '1') ? "Active" : "InActive";
							$badge=($record->status == '1') ? "success" : "danger";	

						$status						=		'<div class="bttns">
						<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
						</div>';


						$ip_country_status=($record->top_country_status == '1') ? "Yes" : "No";
							$top_country_badge=($record->top_country_status == '1') ? "success" : "danger";

						$top_country_status						=		'<div class="bttns">
						<span class="badge badge-'.$top_country_badge.'">'.$ip_country_status.'</span>
						</div>';
						
							   $edit_content  .= '</div> </div>';
								$data[] = array( 
									"country"				=> 	 $country->name,
									"country_name"			=> 	$record->country_name,
									"edit_content"			=> 	$edit_content,
									"status"				=> $status,
									"top_country_status"	=> $top_country_status
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

	public function seo_city_list()
	{
		$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
		$this->data['teams'] = $this->General_Model->get_teams()->result();
		$this->data['tournments'] = $this->General_Model->get_tournments()->result();
		$this->data['country'] = $this->General_Model->get_country_name()->result();
		//$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
		$this->data['countries'] = $this->General_Model->get_top_country('countries')->result();		
		$this->data['currencies'] = $this->General_Model->getAllItemTable('currency_types', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
		$this->data['ticket_types'] = $this->General_Model->get_ticket_type_data('', 'ACTIVE')->result();
		$this->data['split_types'] = $this->General_Model->get_split_type_data('', 'ACTIVE')->result();

		$url_segment  = $segment = $this->uri->segment(3);
		 $city_id       = $this->uri->segment(4);
		if ($url_segment == "add") {
			
			$this->load->view(THEME.'/event/add_seo_city_list', $this->data);
		}	
		else if ($url_segment == "delete") {
			$c_id   = $this->uri->segment(4);
			$updateData_data['status'] = 2;
			//$delete = $this->General_Model->delete_data('tournament', 't_id', $t_id);
			$delete = $this->General_Model->update('seo_city_list', array('c_id' => $c_id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('tournament_lang', 'tournament_id', $t_id);
				$response = array('status' => 1, 'msg' => 'Data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting data.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($url_segment == "save") {		

// 					ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

			$seocountryId = $this->input->post('seocountryId');
			//Insert into table
			if ($seocountryId == '') {
			
				if ($this->input->post()) {
					$msg = '';
					//$this->form_validation->set_rules('name', 'Country Name', 'required');
					if (!empty($_FILES['tournament_image']['name'])) {
						$this->form_validation->set_rules('tournament_image', 'Image file', 'callback_timage_file_check');
					}

					if (!empty($_FILES['city_icon']['name'])) {
						$this->form_validation->set_rules('city_icon', 'Image file', 'callback_timage_file_check');
					}
					$insertData = array();
					if ($this->form_validation->run() !== false) {

						if (!empty($_FILES['tournament_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX .'uploads/seo_city';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
						
							if ($this->upload->do_upload('tournament_image')) {
								$outputData['tournament_image'] = $this->upload->data();
								$insertData['country_image'] = $outputData['tournament_image']['file_name'];
								
							} else {
								
								$msg .= 'Failed to add tournament image';
								$error = array('error' => $this->upload->display_errors());
								
							}
							}


							if (!empty($_FILES['city_icon']['name'])) {
								$config['upload_path'] = UPLOAD_PATH_PREFIX .'uploads/seo_city_icon';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								//$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->upload->initialize($config); // Re-initialize the upload library
								$this->load->library('upload', $config);							
									if ($this->upload->do_upload('city_icon')) {
										
										$outputData['city_icon'] = $this->upload->data();
										$insertData['city_icon'] = $outputData['city_icon']['file_name'];
										
									} else {
										
										$msg .= 'Failed to add City Icon';
										$error = array('error' => $this->upload->display_errors());
																		
									}
								}
					
					$country= $this->General_Model->get_country_name_id(trim($this->input->post('top_country')))->row();
						$insertData['country_name'] = $country->name;

						$top_cityIds = $this->input->post('top_city');		
						$city_ip=!empty($top_cityIds) ? implode(',', $top_cityIds) : '';
						$city_name = $this->General_Model->get_city_name($city_ip); 					
						$city = !empty($city_name[0]->name) ? $city_name[0]->name : "";			

						$insertData['city_name'] = $city;


						$insertData['url_key'] = trim($this->input->post('url_key'));	
						//$insertData['status'] = $this->input->post('is_active') ? 1 : 0;
						$insertData['create_date'] 	= date('Y-m-d H:i:s');	
						$insertData['top_country'] 	= trim($this->input->post('top_country'));	

					//	$top_cityIds = $this->input->post('top_city');						
						$insertData['top_city'] = !empty($top_cityIds) ? implode(',', $top_cityIds) : '';
					//	$insertData['top_venue'] 	= trim($this->input->post('top_venue'));	
					
					    $top_venueIds = $this->input->post('top_venue');						
						$insertData['top_venue'] = !empty($top_venueIds) ? implode(',', $top_venueIds) : '';

						$insertData['status'] = $this->input->post('status') ? 1 : 0;
						$insertData['top_city_status'] = $this->input->post('top_city_status') ? 1 : 0;
						
					
						$t_id = $this->General_Model->insert_data('seo_city_list', $insertData);						

						//Add to language table
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
						$insertData['tournament_image']="";
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['country_id'] = $t_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['city_name'] = trim($this->input->post('name'));
							$insertData_lang['country_image'] = $insertData['country_image'];
							$insertData_lang['country_url_key'] = strip_tags($this->input->post('url_key'));
							$insertData_lang['meta_description'] = $this->input->post('metadescription');
							$insertData_lang['page_content'] = $this->input->post('tournament_content');
							
							$this->General_Model->insert_data('seo_city_list_lang', $insertData_lang);
						}					

						$response = array('status' => 1, 'msg' => 'SEO City Details Added Successfully. ' . $msg, 'redirect_url' => base_url() . 'settings/seo_city_list/edit/'.$t_id.'?tab=content');
						echo json_encode($response);
						exit;
					} else {
						$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_city_list/add', 'status' => 0);
						echo json_encode($response);
						exit;
					}
				}
			} else {
				$seocountry_id =    $seocountryId;
				//echo "<pre>";print_r($_POST);exit;
				//if its an update request
			
				if ($this->input->post()) {

					if($_POST['flag'] != 'content' && $_POST['flag'] != 'page_content'){
						
						$this->form_validation->set_rules('name', 'Tournament Name', 'required');
						if (!empty($_FILES['tournament_image']['name'])) {
							$this->form_validation->set_rules('tournament_image', 'Image file', 'callback_timage_file_check');
						}
						}
						else if($_POST['flag'] == 'content'){
						
						$this->form_validation->set_rules('title', 'Title', 'required');

						}
						else if($_POST['flag'] == 'page_content'){								
							$this->form_validation->set_rules('country_content_1','Country Content 1', 'required');
							$this->form_validation->set_rules('country_content_2','Country Content 2', 'required');
						}


					$updateData = array();
					$updateData_lang = array();
					
					$msg = '';
					if ($this->form_validation->run() !== false) {

						if($_POST['flag'] != 'content'){							
							$teamdata = $this->General_Model->getAllItemTable_array('seo_city_list', array('c_id' => $seocountry_id))->row();
						if (!empty($_FILES['tournament_image']['name'])) {
							
							if (@UPLOAD_PATH_PREFIX .'uploads/seo_city/' . $teamdata->country_image) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/seo_city/' . $teamdata->country_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/seo_city';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('tournament_image')) {
								$msg .= 'Failed to add country image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['country_image'] = $imagename;
								$updateData['country_image'] = $imagename;
							}
						} 
						else {
							$exs_file = $this->input->post('exs_file');
							if (!empty($exs_file)) {
								$updateData['country_image'] = trim($exs_file);
								$updateData_lang['country_image'] = trim($exs_file);
							}
							else
							{
								$updateData['country_image']=$teamdata->country_image;
								$updateData_lang['country_image']=$teamdata->country_image;							
							}
						}


						// country Icon 
						if (!empty($_FILES['city_icon']['name'])) {					
						
							if (@UPLOAD_PATH_PREFIX .'uploads/seo_city_icon/' . $teamdata->city_icon) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/seo_city_icon/' . $teamdata->city_icon);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/seo_city_icon';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '1000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('city_icon')) {
								$msg .= 'Failed to add country Icon';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];								
								$updateData['city_icon'] = $imagename;
							}
							
						} 
						else {
							
							$exs_file = $this->input->post('exs_file_icon');
							if (!empty($exs_file)) {
								$updateData['city_icon'] = trim($exs_file);
								
							}
							else
							{
								$updateData['city_icon']=$teamdata->city_icon;
													
							}
						}
						// End of city Icon

						$url_key = $this->input->post('url_key');
						if (!empty($url_key)) {
							$updateData['url_key'] = trim($url_key);
						}

						$city_name = $this->input->post('city_name');
						if (!empty($country_name)) {
							$updateData['city_name'] = trim($city_name);
						}
						
						$top_country = $this->input->post('top_country');
						if (!empty($top_country)) {
							$updateData['top_country'] = trim($top_country);
						}

						if (!empty($this->input->post('top_city'))) {
							$top_cityIds = $this->input->post('top_city');						
							$updateData['top_city'] = !empty($top_cityIds) ? implode(',', $top_cityIds) : '';			
						}		
						if (!empty($this->input->post('top_venue'))) {
							$top_venueIds = $this->input->post('top_venue');						
							$updateData['top_venue'] = !empty($top_venueIds) ? implode(',', $top_venueIds) : '';
						}				

						if($_POST['flag'] = 'page_content' && $_POST['status_flag'] ==""){	
							$updateData['status'] = $this->input->post('status') ? 1 : 0;	
							$updateData['top_city_status'] = $this->input->post('top_city_status') ? 1 : 0;
						}

						$country_name = $this->input->post('name');
						if (!empty($country_name)) {
							$updateData['country_name'] = trim($country_name);
						}


						if($this->input->post('country_content_1')!=""){
							$updateData_lang['country_content_1'] = $this->input->post('country_content_1');
						}

						if($this->input->post('country_content_2')!=""){
							$updateData_lang['country_content_2'] = $this->input->post('country_content_2');
						}
						if (!empty($this->input->post('top_city'))) {
						$top_cityIds = $this->input->post('top_city');		
						$city_ip=!empty($top_cityIds) ? implode(',', $top_cityIds) : '';
						$city_name = $this->General_Model->get_city_name($city_ip); 					
						$city = !empty($city_name[0]->name) ? $city_name[0]->name : "";	

						$updateData_lang['city_name'] = $city;
						}

						
					}
					else{

						
						if (!empty($this->input->post('top_city'))) {
							$top_cityIds = $this->input->post('top_city');		
							$city_ip=!empty($top_cityIds) ? implode(',', $top_cityIds) : '';
							$city_name = $this->General_Model->get_city_name($city_ip); 					
							$city = !empty($city_name[0]->name) ? $city_name[0]->name : "";	
							$updateData_lang['city_name'] = $city;
						}

						//$updateData_lang['country_name'] = strip_tags($this->input->post('name'));

						//$updateData['page_title'] = strip_tags($this->input->post('title'));
						$updateData['meta_description'] = $this->input->post('metadescription');
						$updateData_lang['page_title'] = strip_tags($this->input->post('title'));
						$updateData_lang['meta_description'] = $this->input->post('metadescription');
						$updateData_lang['seo_keywords'] = $this->input->post('seo_keywords');
						$updateData_lang['search_keywords'] = $this->input->post('seo_keywords');
						$updateData_lang['city_name'] = $this->input->post('city_name');
						$updateData['seo_keywords'] = $this->input->post('seo_keywords');
						$updateData['search_keywords'] = $this->input->post('seo_keywords');
						$updateData['search_keywords'] = $this->input->post('seo_keywords');
						$updateData_lang['country_url_key'] = $this->input->post('url_key');
						$updateData['url_key'] = $this->input->post('url_key');
						
					}						
					if($this->input->post('country_information')!=""){
						$updateData['country_information'] = $this->input->post('country_information');
					}	

					if($this->input->post('faq')!=""){
						$updateData['faq'] = $this->input->post('faq');
					}	
						$this->General_Model->update('seo_city_list', array('c_id' => $seocountry_id), $updateData);					

						$this->General_Model->update('seo_city_list_lang', array('country_id' => $seocountry_id, 'language' =>$this->session->userdata('language_code') ), $updateData_lang);
											
						$response = array('status' => 1, 'msg' => 'Changes updated Successfully.', 'redirect_url' => base_url() . 'settings/seo_city_list');
						echo json_encode($response);
						exit;
					}
					else {
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_city_list/add', 'status' => 0);
					echo json_encode($response);
					exit;
				}
				}
			}
		}	
		else if ($url_segment == "edit") {
			$this->data['countries'] = $this->General_Model->get_top_country('countries')->result();
			if ($city_id != '') {
				$search['c_id'] =$city_id;	
				$this->data['tournaments']      = $this->General_Model->get_seo_city_list($search)->row();				
			}	
			$this->load->view(THEME.'event/add_seo_city_list', $this->data);
		}
		else
		{			
			$this->load->view(THEME.'/event/seo_city_list', $this->data);
		}
		
	}
	public function get_seo_city_list()
	{
			// ini_set('display_errors', 1);
			// ini_set('display_startup_errors', 1);
			// error_reporting(E_ALL);
	   $search=[];
	   $order_column="";
	   $order_by='';
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

	   $seg = $this->uri->segment(3);//echo $seg;exit;
	   if($this->uri->segment(3) == ''){
	   $seg = 'untrashed';
	   }
	   if (isset($_POST['country'])  || isset($_POST['status']) || isset($_POST['top_city']))
		{		
				
			$search['status']=$_POST['status'];
			$search['top_city']=$_POST['top_city'];

	  // if( !empty($_POST['country']) )
	   
		//$country = isset($_POST['country']) ?  implode("','", $_POST['country']) : '';
		$search['country'] =$_POST['country'];	
		   $allcount = $this->General_Model->get_seo_city_list($search)->num_rows();
		   $records = $this->General_Model->get_seo_city_list($search)->result();
	   }
	   else
	   {
		
			$allcount = $this->General_Model->get_seo_city_list()->num_rows();
			$records = $this->General_Model->get_seo_city_list()->result();
	   }
	//    echo '<pre/>';
	//    print_r($records);
	//    exit;
   //echo $this->db->last_query();exit;
	   $data = [];
	   foreach($records as $record ){				   

							   $edit_content  = '<div class="dropdown">
							   <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
								   data-toggle="dropdown">
								   <i class="mdi mdi-dots-vertical fs-sm"></i>
							   </a>
							   <div class="dropdown-menu dropdown-menu-right">';

				   
						   if ($this->session->userdata('role') != 9) {
							   $edit_content .= '
										   <a href="'.base_url().'settings/seo_city_list/edit/'.$record->c_id.'" class="dropdown-item ">
											   
											   <i class="fas fa-pencil-alt mr-1"></i>													
											   &nbsp;Edit SEO City Details
										   </a>';
						   }
						 
						   $edit_content .= '
										   <a href="'.base_url().'settings/seo_city_list/edit/'.$record->c_id.'?tab=content" class="dropdown-item ">
											   
												   <i class="fas fa-pencil-alt mr-1"></i>
												   &nbsp;Edit Content Details
											   
										   </a>';

						$edit_content .= '
						<a href="'.base_url().'settings/seo_city_list/edit/'.$record->c_id.'?tab=page_content" class="dropdown-item ">
							
								<i class="fas fa-pencil-alt mr-1"></i>
								&nbsp;Edit Page Content Details
							
						</a>';
						   if ($this->session->userdata('role') != 9) {
							   if ($record->s_no == '') {
								   $edit_content .= '
										   <hr class="dropdown-divider">';
								   if ($record->status != 2) {
									   $edit_content .= '
										   <a id="branch_'.$record->c_id.'" href="javascript:void(0);" data-href="'.base_url().'settings/seo_city_list/delete/'.$record->c_id.'" class="dropdown-item  delete_action" onClick="delete_data('.$record->c_id.');">
										   
												   <i class=" fas fa-trash mr-1"></i>
												   &nbsp;Remove from list
										   
										   </a>';
								   }
							   }
							
						   }
					
						   $country= $this->General_Model->get_country_name_id($record->top_country)->row();
						   $city_name = $this->General_Model->get_city_name($record->top_city); 
						   $city = !empty($city_name[0]->name) ? $city_name[0]->name : "";

						   $ip_status=($record->status == '1') ? "Active" : "InActive";
							$badge=($record->status == '1') ? "success" : "danger";	

							$ip_city_status=($record->top_city_status == '1') ? "Yes" : "No";
							$top_city_badge=($record->top_city_status == '1') ? "success" : "danger";

						$top_city_status						=		'<div class="bttns">
						<span class="badge badge-'.$top_city_badge.'">'.$ip_city_status.'</span>
						</div>';

						$status						=		'<div class="bttns">
						<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
						</div>';
						
							   $edit_content  .= '</div> </div>';
								$data[] = array( 
									"top_city"				=> 	 $city,
									"country_name"			=> 	$record->country_name,
									"edit_content"			=> 	$edit_content,
									"status"				=> $status,
									"top_city_status"		=>$top_city_status
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

	public function seo_venue_list()
	{
		$this->data['stadiums'] = $this->General_Model->get_stadium()->result();
		$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();

		$url_segment  = $segment = $this->uri->segment(3);
		 $city_id       = $this->uri->segment(4);
		if ($url_segment == "add") {
			
			$this->load->view(THEME.'/event/add_seo_venue_list', $this->data);
		}	
		else if ($url_segment == "delete") {
			$c_id   = $this->uri->segment(4);
			$updateData_data['status'] = 2;
			//$delete = $this->General_Model->delete_data('tournament', 't_id', $t_id);
			$delete = $this->General_Model->update('seo_city_list', array('c_id' => $c_id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('tournament_lang', 'tournament_id', $t_id);
				$response = array('status' => 1, 'msg' => 'Data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting data.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($url_segment == "save") {		
			 $seocountryId = $this->input->post('seocountryId');
		
			// echo '<pre/>';
			// print_r($_POST);
			// exit;
			//Insert into table
			if ($seocountryId == '') {
			
				if ($this->input->post()) {
					$msg = '';
					//$this->form_validation->set_rules('name', 'Country Name', 'required');
					if (!empty($_FILES['tournament_image']['name'])) {
						$this->form_validation->set_rules('venue_image', 'Image file', 'callback_timage_file_check');
					}

					if (!empty($_FILES['venue_icon']['name'])) {
						$this->form_validation->set_rules('venue_icon', 'Image file', 'callback_timage_file_check');
					}

					$insertData = array();
					if ($this->form_validation->run() !== false) {

						if (!empty($_FILES['tournament_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX .'uploads/seo_venue';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '10000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
						
								if ($this->upload->do_upload('tournament_image')) {
									$outputData['tournament_image'] = $this->upload->data();
									$insertData['venue_image'] = $outputData['tournament_image']['file_name'];
									
								} else {
									
									$msg .= 'Failed to add Venue image';
									$error = array('error' => $this->upload->display_errors());
									
								}
							}

							if (!empty($_FILES['venue_icon']['name'])) {
								$config['upload_path'] = UPLOAD_PATH_PREFIX .'uploads/seo_venue_icon';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								//$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->upload->initialize($config); // Re-initialize the upload library
								$this->load->library('upload', $config);							
									if ($this->upload->do_upload('venue_icon')) {
										
										$outputData['venue_icon'] = $this->upload->data();
										$insertData['venue_icon'] = $outputData['venue_icon']['file_name'];
										
									} else {
										
										$msg .= 'Failed to add Venue Icon';
										$error = array('error' => $this->upload->display_errors());
																		
									}
								}

						$insertData['venue_country'] 	= trim($this->input->post('venue_country'));				
						$insertData['venue_city'] = trim($this->input->post('venue_city'));	
						$insertData['venue_name'] = trim($this->input->post('name'));
						$insertData['url_key'] = trim($this->input->post('url_key'));	
						$insertData['create_date'] 	= date('Y-m-d H:i:s');			
						//if (!empty($this->input->post('top_venue'))) {
							$top_venueIds = $this->input->post('top_venue');						
							$insertData['top_venue'] = !empty($top_venueIds) ? implode(',', $top_venueIds) : '';			
					//	}	
						$insertData['status'] = $this->input->post('status') ? 1 : 0;
						$insertData['top_venue_status'] = $this->input->post('top_venue_status') ? 1 : 0;					
					
						$t_id = $this->General_Model->insert_data('seo_venue_list', $insertData);						

						//Add to language table
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
						$insertData['tournament_image']="";
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['venue_id'] = $t_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['venue_name'] = trim($this->input->post('name'));
							$insertData_lang['venue_image'] = $insertData['venue_image'];
							$insertData_lang['venue_url_key'] = strip_tags($this->input->post('url_key'));
							$insertData_lang['meta_description'] = $this->input->post('metadescription');
							$insertData_lang['venue_details'] = $this->input->post('venue_details');
							$insertData_lang['page_content'] = $this->input->post('tournament_content');
							
							$this->General_Model->insert_data('seo_venue_list_lang', $insertData_lang);
						}					

						$response = array('status' => 1, 'msg' => 'SEO Venue Details Added Successfully. ' . $msg, 'redirect_url' => base_url() . 'settings/seo_venue_list/edit/'.$t_id.'?tab=content');
						echo json_encode($response);
						exit;
					} else {
						$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_venue_list/add', 'status' => 0);
						echo json_encode($response);
						exit;
					}
				}
			} else {
				$seocountry_id =    $seocountryId;
				//echo "<pre>";print_r($_POST);exit;
				//if its an update request
			
				if ($this->input->post()) {

					if($_POST['flag'] != 'content' && $_POST['flag'] != 'page_content'){
						
						$this->form_validation->set_rules('url_key', 'Tournament Name', 'required');
						if (!empty($_FILES['tournament_image']['name'])) {
							$this->form_validation->set_rules('venue_image', 'Image file', 'callback_timage_file_check');
						}
						}
						else if($_POST['flag'] == 'content'){
							
						$this->form_validation->set_rules('title', 'Title', 'required');

						}
						else if($_POST['flag'] == 'page_content'){	
												
							$this->form_validation->set_rules('country_content_1','Country Content 1', 'required');
							$this->form_validation->set_rules('country_content_2','Country Content 2', 'required');
						}


					$updateData = array();
					$updateData_lang = array();
					
					$msg = '';
					if ($this->form_validation->run() !== false) {

						if($_POST['flag'] != 'content'){							
							$teamdata = $this->General_Model->getAllItemTable_array('seo_venue_list', array('v_id' => $seocountry_id))->row();
						if (!empty($_FILES['tournament_image']['name'])) {
							
							if (@UPLOAD_PATH_PREFIX .'uploads/seo_venue/' . $teamdata->venue_image) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/seo_venue/' . $teamdata->venue_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/seo_city';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('tournament_image')) {
								$msg .= 'Failed to add country image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['venue_image'] = $imagename;
								$updateData['venue_image'] = $imagename;
							}
						} 
						else {
							$exs_file = $this->input->post('exs_file');
							if (!empty($exs_file)) {
								$updateData['venue_image'] = trim($exs_file);
								$updateData_lang['venue_image'] = trim($exs_file);
							}
							else
							{
								$updateData['venue_image']=$teamdata->venue_image;
								$updateData_lang['venue_image']=$teamdata->venue_image;							
							}
						}


						// Venue Icon 
						if (!empty($_FILES['venue_icon']['name'])) {					
						
							if (@UPLOAD_PATH_PREFIX .'uploads/seo_venue_icon/' . $teamdata->venue_icon) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/seo_venue_icon/' . $teamdata->venue_icon);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/seo_venue_icon';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							//$config['max_size'] = '1000';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('venue_icon')) {
								$msg .= 'Failed to add Venue Icon';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];								
								$updateData['venue_icon'] = $imagename;
							}
							
						} 
						else {
							
							$exs_file = $this->input->post('exs_file_icon');
							if (!empty($exs_file)) {
								$updateData['venue_icon'] = trim($exs_file);
								
							}
							else
							{
								$updateData['venue_icon']=$teamdata->venue_icon;
													
							}
						}
						// End of Venue Icon

						$top_country = $this->input->post('venue_country');
						if (!empty($top_country)) {
							$updateData['venue_country'] = trim($top_country);
						}

						if (!empty($this->input->post('venue_city'))) {				
							$updateData['venue_city'] = trim($this->input->post('venue_city'));			
						}	

						$url_key = $this->input->post('url_key');
						if (!empty($url_key)) {
							$updateData['url_key'] = trim($url_key);
						}
	
						if (!empty($this->input->post('top_venue'))) {
							$top_venueIds = $this->input->post('top_venue');						
							$updateData['top_venue'] = !empty($top_venueIds) ? implode(',', $top_venueIds) : '';
						}			
						
						$venue_name = $this->input->post('name');
						if (!empty($venue_name)) {
							$updateData['venue_name'] = trim($venue_name);
						}
						
						if($_POST['flag'] = 'page_content' && $_POST['status_flag'] ==""){	
							$updateData['status'] = $this->input->post('status') ? 1 : 0;				
							$updateData['top_venue_status'] = $this->input->post('top_venue_status') ? 1 : 0;
						}

						if($this->input->post('country_content_1')!=""){
							$updateData_lang['country_content_1'] = $this->input->post('country_content_1');
						}

						if($this->input->post('country_content_2')!=""){
							$updateData_lang['country_content_2'] = $this->input->post('country_content_2');
						}						
						
					}
					else{

						$venue_name = $this->input->post('name');
						if (!empty($venue_name)) {
							$updateData_lang['venue_name'] = trim($venue_name);
						}

						//$updateData['page_title'] = strip_tags($this->input->post('title'));
						$updateData['meta_description'] = $this->input->post('metadescription');
						$updateData_lang['page_title'] = strip_tags($this->input->post('title'));
					//	$updateData_lang['venue_name'] = strip_tags($this->input->post('name'));
						$updateData_lang['meta_description'] = $this->input->post('metadescription');
						$updateData_lang['seo_keywords'] = $this->input->post('seo_keywords');
						$updateData_lang['search_keywords'] = $this->input->post('search_keywords');
						$updateData['seo_keywords'] = $this->input->post('seo_keywords');						
						$updateData['search_keywords'] = $this->input->post('search_keywords');
						$updateData_lang['venue_url_key'] = $this->input->post('url_key');
						$updateData['url_key'] = $this->input->post('url_key');
						
					}						
					if($this->input->post('country_information')!=""){
						$updateData['country_information'] = $this->input->post('country_information');
					}	

					if($this->input->post('faq')!=""){
						$updateData['faq'] = $this->input->post('faq');

					}	

					if($this->input->post('venue_details')!=""){
						$updateData_lang['venue_details'] = $this->input->post('venue_details');

					}	
					
					// echo '<pre/>';
					// print_r($updateData);
					// print_r($updateData_lang);
					// exit;
						$this->General_Model->update('seo_venue_list', array('v_id' => $seocountry_id), $updateData);					

						$this->General_Model->update('seo_venue_list_lang', array('venue_id' => $seocountry_id, 'language' =>$this->session->userdata('language_code') ), $updateData_lang);
											
						$response = array('status' => 1, 'msg' => 'Changes updated Successfully.', 'redirect_url' => base_url() . 'settings/seo_venue_list');
						echo json_encode($response);
						exit;
					}
					else {
						$errors = validation_errors();
						
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_venue_list/add', 'status' => 0);
					echo json_encode($response);
					exit;
				}
				}
			}
		}	
		else if ($url_segment == "edit") {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			if ($city_id != '') {
				$search['v_id'] =$city_id;	
				$this->data['tournaments']      = $this->General_Model->get_seo_venue_list($search)->row();				
			}	
			// echo '<pre/>';
			// print_r($this->data['tournaments'] );
			// exit;

			$this->load->view(THEME.'event/add_seo_venue_list', $this->data);
		}
		else
		{			
			$this->load->view(THEME.'/event/seo_venue_list', $this->data);
		}
		
	}
	public function get_seo_venue_list()
	{
			// ini_set('display_errors', 1);
			// ini_set('display_startup_errors', 1);
			// error_reporting(E_ALL);
	   $search=[];
	   $order_column="";
	   $order_by='';
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

	   $seg = $this->uri->segment(3);//echo $seg;exit;
	   if($this->uri->segment(3) == ''){
	   $seg = 'untrashed';
	   }
	   if (isset($_POST['venue_name'])  || isset($_POST['status']) || isset($_POST['top_venue_status']))
		{		
				
			$search['status']=$_POST['status'];
			$search['top_venue_status']=$_POST['top_venue_status'];

	  // if( !empty($_POST['country']) )
	   
		//$country = isset($_POST['country']) ?  implode("','", $_POST['country']) : '';
		$search['venue_name'] =$_POST['venue_name'];	
		   $allcount = $this->General_Model->get_seo_venue_list($search)->num_rows();
		   $records = $this->General_Model->get_seo_venue_list($search)->result();
	   }
	   else
	   {
		
			$allcount = $this->General_Model->get_seo_venue_list()->num_rows();
			$records = $this->General_Model->get_seo_venue_list()->result();
	   }
	//    echo '<pre/>';
	//    print_r($records);
	//    exit;
   //echo $this->db->last_query();exit;
	   $data = [];
	   foreach($records as $record ){				   

							   $edit_content  = '<div class="dropdown">
							   <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
								   data-toggle="dropdown">
								   <i class="mdi mdi-dots-vertical fs-sm"></i>
							   </a>
							   <div class="dropdown-menu dropdown-menu-right">';

				   
						   if ($this->session->userdata('role') != 9) {
							   $edit_content .= '
										   <a href="'.base_url().'settings/seo_venue_list/edit/'.$record->v_id.'" class="dropdown-item ">
											   
											   <i class="fas fa-pencil-alt mr-1"></i>													
											   &nbsp;Edit SEO Stadium Details
										   </a>';
						   }
						 
						   $edit_content .= '
										   <a href="'.base_url().'settings/seo_venue_list/edit/'.$record->v_id.'?tab=content" class="dropdown-item ">
											   
												   <i class="fas fa-pencil-alt mr-1"></i>
												   &nbsp;Edit Content Details
											   
										   </a>';

						$edit_content .= '
						<a href="'.base_url().'settings/seo_venue_list/edit/'.$record->v_id.'?tab=page_content" class="dropdown-item ">
							
								<i class="fas fa-pencil-alt mr-1"></i>
								&nbsp;Edit Page Content Details
							
						</a>';
						   if ($this->session->userdata('role') != 9) {
							   if ($record->s_no == '') {
								   $edit_content .= '
										   <hr class="dropdown-divider">';
								   if ($record->status != 2) {
									   $edit_content .= '
										   <a id="branch_'.$record->v_id.'" href="javascript:void(0);" data-href="'.base_url().'settings/seo_venue_list/delete/'.$record->v_id.'" class="dropdown-item  delete_action" onClick="delete_data('.$record->v_id.');">
										   
												   <i class=" fas fa-trash mr-1"></i>
												   &nbsp;Remove from list
										   
										   </a>';
								   }
							   }
							
						   }

						   $ip_status=($record->status == '1') ? "Active" : "InActive";
							$badge=($record->status == '1') ? "success" : "danger";	

						$status						=		'<div class="bttns">
						<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
						</div>';

						$ip_venue_status=($record->top_venue_status == '1') ? "Yes" : "No";
							$top_venue_badge=($record->top_venue_status == '1') ? "success" : "danger";

						$top_venue_status						=		'<div class="bttns">
						<span class="badge badge-'.$top_venue_badge.'">'.$ip_venue_status.'</span>
						</div>';
						
							   $edit_content  .= '</div> </div>';
								$data[] = array( 
									"venue_name"			=> 	 $record->venue_name,
									"edit_content"		=> 	$edit_content,
									"status"			=> $status,
									"top_venue_status"  => $top_venue_status
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

	public function promotion_banner()
	{
		$url_segment  = $segment = $this->uri->segment(3);
		 $promotion_id       = $this->uri->segment(4);
		if ($url_segment == "add") {
			
			$this->load->view(THEME.'/event/add_promotion_banner', $this->data);
		}	
		else if ($url_segment == "delete") {
			$p_id   = $this->uri->segment(4);
			$updateData_data['status'] = 2;
			//$delete = $this->General_Model->delete_data('tournament', 't_id', $t_id);
			$delete = $this->General_Model->update('promotion_banner', array('p_id' => $p_id), $updateData_data);
			if ($delete == 1) {
				//$this->General_Model->delete_data('tournament_lang', 'tournament_id', $t_id);
				$response = array('status' => 1, 'msg' => 'Data deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				$response = array('status' => 1, 'msg' => 'Error While Deleting data.');
				echo json_encode($response);
				exit;
			}
		}
		else if ($url_segment == "save") {		
			
			 $promotionId = $this->input->post('promotionId');
			if ($promotionId == '') {
			
				if ($this->input->post()) {
					$msg = '';
					if (!empty($_FILES['tournament_image']['name'])) {
						$this->form_validation->set_rules('venue_image', 'Image file', 'callback_timage_file_check');
					}

					$insertData = array();
					if ($this->form_validation->run() !== false) {

						if (!empty($_FILES['tournament_image']['name'])) {
							$config['upload_path'] = UPLOAD_PATH_PREFIX .'uploads/banner_image';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
						
								if ($this->upload->do_upload('tournament_image')) {
									$outputData['tournament_image'] = $this->upload->data();
									$insertData['banner_image'] = $outputData['tournament_image']['file_name'];
									
								} else {
									
									$msg .= 'Failed to add banner image';
									$error = array('error' => $this->upload->display_errors());
									
								}
							}
						$insertData['banner_name'] = trim($this->input->post('banner_name'));
						$insertData['banner_url'] = trim($this->input->post('banner_url'));	
						$insertData['create_date'] 	= date('Y-m-d H:i:s');	
						$insertData['status'] = $this->input->post('status') ? 1 : 0;	
						$insertData['store_id'] = $this->session->userdata('storefront')->admin_id	;	
						$insertData['added_by'] = $this->session->userdata('admin_id');
						//$insertData['banner_description'] = $this->input->post('banner_description');					
						// $insertData['long_descrption_title'] = $this->input->post('long_descrption_title');					
						// $insertData['long_descrption'] = $this->input->post('long_descrption');					
						$p_id = $this->General_Model->insert_data('promotion_banner', $insertData);	
						
						$lang = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
						foreach ($lang as $key => $l_code) {
							$insertData_lang = array();
							$insertData_lang['promotion_id'] = $p_id;
							$insertData_lang['language'] = $l_code->language_code;
							$insertData_lang['long_descrption_title'] = "";
							$insertData_lang['long_descrption_title'] = "";
							$insertData_lang['banner_description'] = "";							
							$this->General_Model->insert_data('promotion_banner_lang', $insertData_lang);
						}	

									
						$response = array('status' => 1, 'msg' => 'Promotion Banner Details Added Successfully. ' . $msg, 'redirect_url' => base_url() . 'settings/promotion_banner/edit/'.$p_id);
						echo json_encode($response);
						exit;
					} else {
						$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/promotion_banner/add', 'status' => 0);
						echo json_encode($response);
						exit;
					}
				}
			} else {
				$seocountry_id =    $promotionId;
			
				if ($this->input->post()) {

					//if($_POST['flag'] == 'content'){
						
						$this->form_validation->set_rules('banner_name', 'Banner Name', 'required');
						if (!empty($_FILES['tournament_image']['name'])) {
							$this->form_validation->set_rules('banner_image', 'Image file', 'callback_timage_file_check');
						}
						//}
						
					$updateData = array();
					$updateData_lang = array();
					
					$msg = '';
					if ($this->form_validation->run() !== false) {

													
					$teamdata = $this->General_Model->getAllItemTable_array('promotion_banner', array('p_id' => $seocountry_id))->row();
						if (!empty($_FILES['tournament_image']['name'])) {
							
							if (@UPLOAD_PATH_PREFIX .'uploads/banner_image/' . $teamdata->banner_image) {
								unlink(@UPLOAD_PATH_PREFIX .'uploads/banner_image/' . $teamdata->banner_image);
							}
							$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/banner_image';
							$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('tournament_image')) {
								$msg .= 'Failed to add banner image';
							} else {
								$data = $this->upload->data();
								$imagename = $data['file_name'];
								$updateData_lang['banner_image'] = $imagename;
								$updateData['banner_image'] = $imagename;
							}
						} 
						else {
							$exs_file = $this->input->post('exs_file');
							if (!empty($exs_file)) {
								$updateData['banner_image'] = trim($exs_file);
								$updateData_lang['banner_image'] = trim($exs_file);
							}
							else
							{
								$updateData['banner_image']=$teamdata->banner_image;
								$updateData_lang['banner_image']=$teamdata->banner_image;							
							}
						}
			

						$banner_name = $this->input->post('banner_name');
						if (!empty($banner_name)) {
							$updateData['banner_name'] = trim($banner_name);
						}

						$banner_url = $this->input->post('banner_url');
						if (!empty($banner_url)) {
							$updateData['banner_url'] = trim($banner_url);
						}

						$status = $this->input->post('status');
						$updateData['status'] = !empty($status) ? trim($status) : 0;


						// $banner_description = $this->input->post('banner_description');
						// if (!empty($banner_description)) {
						// 	$updateData['banner_description'] = trim($banner_description);
						// }

						// $long_descrption_title = $this->input->post('long_descrption_title');
						// if (!empty($long_descrption_title)) {
						// 	$updateData['long_descrption_title'] = trim($long_descrption_title);
						// }
						// $long_descrption = $this->input->post('long_descrption');
						// if (!empty($long_descrption)) {
						// 	$updateData['long_descrption'] = trim($long_descrption);
						// }
						
						$updateData['store_id'] = $this->session->userdata('storefront')->admin_id	;	
						$updateData['added_by'] = $this->session->userdata('admin_id');

						// echo '<pre/>';
						// print_r($updateData);
						// exit;
						$this->General_Model->update('promotion_banner', array('p_id' => $seocountry_id), $updateData);		

						$response = array('status' => 1, 'msg' => 'Changes updated Successfully.', 'redirect_url' => base_url() . 'settings/promotion_banner');
						echo json_encode($response);
						exit;
					}
					else {
						$errors = validation_errors();
						
					$response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_venue_list/add', 'status' => 0);
					echo json_encode($response);
					exit;
				}
				}
			}
		}	
		else if ($url_segment == "save_section") {		
			
			$promotionId = $this->input->post('promotionId');
		   if ($promotionId != '') {

			$promotion_id =    $promotionId;
		   
			   if ($this->input->post()) {
					   
					$this->form_validation->set_rules('long_descrption_title', 'Section Title', 'required');

				   $updateData = array();
				   $updateData_lang = array();
				   
				   $msg = '';
				   if ($this->form_validation->run() !== false) {

												   
				   $teamdata = $this->General_Model->getAllItemTable_array('promotion_banner', array('p_id' => $promotion_id))->row();
					  
					   $long_descrption_title = $this->input->post('long_descrption_title');
					   if (!empty($long_descrption_title)) {
						   $updateData_lang['long_descrption_title'] = trim($long_descrption_title);
					   }
					  
					   $long_descrption = $this->input->post('long_descrption');
					   if (!empty($long_descrption)) {
						   $updateData_lang['long_descrption'] = trim($long_descrption);
					   }

					   $banner_description = $this->input->post('banner_description');
					   if (!empty($banner_description)) {
						   $updateData_lang['banner_description'] = trim($banner_description);
					   }

					   //$this->General_Model->update('promotion_banner_lang', array('p_id' => $promotion_id), $updateData);	
					   $this->General_Model->update('promotion_banner_lang', array('promotion_id' => $promotion_id, 'language' =>$this->session->userdata('language_code') ), $updateData_lang);	

					   $response = array('status' => 1, 'msg' => 'Changes updated Successfully.', 'redirect_url' => base_url() . 'settings/promotion_banner');
					   echo json_encode($response);
					   exit;
				   }
				   else {
					   $errors = validation_errors();
					   
				   $response = array('msg' => validation_errors(), 'redirect_url' => base_url() . 'settings/seo_venue_list/add', 'status' => 0);
				   echo json_encode($response);
				   exit;
			   }
			   }
		   } 
	   }	
		else if ($url_segment == "edit") {
				$search['p_id'] =$promotion_id;	
				$this->data['tournaments']      = $this->General_Model->get_promotion_banner_list($search)->row();			
			
			$this->load->view(THEME.'event/add_promotion_banner', $this->data);
		}
		else
		{			
			$this->load->view(THEME.'/event/promotion_banner_list', $this->data);
		}
		
	}
	public function get_promotion_banner_list()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	   $search=[];
	   $order_column="";
	   $order_by='';
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

	   $seg = $this->uri->segment(3);//echo $seg;exit;
	   if($this->uri->segment(3) == ''){
	   $seg = 'untrashed';
	   }
	   //(isset($_POST['status']) && $_POST['status']!="")
	   if (!empty($_POST['banner_name'])  || (isset($_POST['status']) && $_POST['status']!="") )
		{	
			$search['status']=$_POST['status'];
			$search['banner_name'] =$_POST['banner_name'];	
			
		   $allcount = $this->General_Model->get_promotion_banner_list($search)->num_rows();
		   $records = $this->General_Model->get_promotion_banner_list($search)->result();
	   }
	   else
	   {
	
			$allcount = $this->General_Model->get_promotion_banner_list()->num_rows();
			$records = $this->General_Model->get_promotion_banner_list()->result();
	   }
	
	   $data = [];
	   foreach($records as $record ){				   

							   $edit_content  = '<div class="dropdown">
							   <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
								   data-toggle="dropdown">
								   <i class="mdi mdi-dots-vertical fs-sm"></i>
							   </a>
							   <div class="dropdown-menu dropdown-menu-right">';

				   
						   if ($this->session->userdata('role') != 9) {
							   $edit_content .= '
										   <a href="'.base_url().'settings/promotion_banner/edit/'.$record->p_id.'" class="dropdown-item ">
											   
											   <i class="fas fa-pencil-alt mr-1"></i>													
											   &nbsp;Edit Promotion Banner
										   </a>';
						   }						  

					
						   if ($this->session->userdata('role') != 9) {
							
								   $edit_content .= '
										   <hr class="dropdown-divider">';
								   if ($record->status != 2) {
									   $edit_content .= '
										   <a id="branch_'.$record->p_id.'" href="javascript:void(0);" data-href="'.base_url().'settings/promotion_banner/delete/'.$record->p_id.'" class="dropdown-item  delete_action" onClick="delete_data('.$record->p_id.');">
										   
												   <i class=" fas fa-trash mr-1"></i>
												   &nbsp;Remove from list
										   
										   </a>';
								   }
							   
							
						   }

						   $ip_status=($record->status == '1') ? "Active" : "InActive";
							$badge=($record->status == '1') ? "success" : "danger";	

						$status						=		'<div class="bttns">
						<span class="badge badge-'.$badge.'">'.$ip_status.'</span>
						</div>';
						
							   $edit_content  .= '</div> </div>';
								$data[] = array( 
									"banner_name"			=> 	 $record->banner_name,
									"edit_content"		=> 	$edit_content,
									"status"			=> $status
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

	public function stadium_map_list()
	{
		$this->load->view(THEME.'/event/stadium_map_list', $this->data);
	}
	
	public function get_stadium_map()
	{
	   $search=[];
	   $order_column="";
	   $order_by='';
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

	   $seg = $this->uri->segment(3);//echo $seg;exit;
	   if($this->uri->segment(3) == ''){
	   $seg = 'untrashed';
	   }


	   if (isset($_POST['stadium_name']) || isset($_POST['source']))
		{		

			// echo '<pre/>';
			// print_r($_POST['source']);
			// exit;
				//$_POST['source']
			$search['stadium_name']=$_POST['stadium_name'];
			$search['source_type']=$_POST['source'];

		   $allcount = $this->General_Model->get_stadium_map_list($search)->num_rows();
		   $records = $this->General_Model->get_stadium_map_list($search,$row_per_page, $rowno)->result();
		  // echo $this->db->last_query();exit;
	   }
	   else
	   {
		
			$allcount = $this->General_Model->get_stadium_map_list()->num_rows();
			$records = $this->General_Model->get_stadium_map_list("",$row_per_page, $rowno)->result();
			//echo $this->db->last_query();exit;
	   }
	   
   //echo $this->db->last_query();exit;
	   $data = [];
				foreach($records as $record ){				 
					$map_url="";
					if($record->map_url!="")
						$map_url='<a class="downloadLink" href="'.$record->map_url.'" download="Emirates - Stadium.svg" target="_blank">Download '.$record->stadium_name.' </a>';
//$map_url='<a class="downloadLink" href="javascript:void(0);">Download '.$record->stadium_name.' </a>';
						$data[] = array( 
							"stadium_name"				=> 	 $record->stadium_name,
							"map_url"					=> 	 $map_url,
							"source_type"				=> 	 $record->source_type,
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
