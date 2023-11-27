<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
// 		ini_set('display_errors', 0);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class Ajax extends CI_Controller
{
	public function __construct()
	{
		/*
         *  Developed by: PANDIYAN G
         *  Date    : 18 APIRL, 2023
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

	public function matches(){

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
		if($postData['match_ids']) 
			$search_data['match_ids'] = explode(",", $postData['match_ids']) ;

		if($postData['event_name']) 
		$search_data['event_name']  = $postData['event_name'] ;

		if($postData['stadium_ids']) 
			$search_data['stadium_ids'] = explode(",", $postData['stadium_ids']) ;
		if($postData['tournament_ids']) 
			$search_data['tournament_ids'] = explode(",", $postData['tournament_ids']) ;

		if($postData['statuss']!="") 
			$search_data['statuss'] = explode(",", $postData['statuss']) ;

		if($postData['category']!="") 
			$search_data['category'] = explode(",", $postData['category']) ;

		if($postData['ticket_sold']!="") 
			$search_data['ticket_sold'] = $postData['ticket_sold'] ;

		if($postData['from_date']) 
			$search_data['from_date']  = $postData['from_date'] ;
		if($postData['to_date']) 
			$search_data['to_date'] = $postData['to_date'];

		if($postData['only']) 
			$search_data['only'] = $postData['only'];

		if(!empty($postData['event_start_date'])) 
			$search_data['event_start_date'] = $postData['event_start_date'];

		if(!empty($postData['event_end_date'])) 
			$search_data['event_end_date'] = $postData['event_end_date'];
			 
		$tixstock_url = @$postData['only'];

		if($postData['statuss']!="") 
		{
			if (in_array(2, $search_data['statuss']) && count($search_data['statuss']) == 1) {
				$flag = 'expired';
			}

			if (in_array(0, $search_data['statuss']) && count($search_data['statuss']) == 1) {
				$flag = 'inactive';
			}
			if (in_array(4, $search_data['statuss']) && count($search_data['statuss']) == 1) {
				$flag = 'tbc';
			}

		}
		
		// All records count
		$allcount = $this->General_Model->get_matches('', $flag,'','','','','',$search_data,$tournment_id)->num_rows();

		// Get records
		$matches = $this->General_Model->get_matches('', $flag, $rowno, $row_per_page, $order_column, $order_by,'',$search_data,$tournment_id)->result();

		//echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($matches as $match ){

			if($match->match_date < date('Y-m-d H:i:s')){
				$status = '<div class="bttns"> <span class="badge badge-danger">Expired</span> </div> ';
			}
	      else	if($match->match_status == '1'){ 
                $status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
            }else if($match->match_status == '0'){
                $status = '<div class="bttns"> <span class="badge badge-danger">InActive</span> </div>';
            } else if($match->match_status == '2'){
                $status = '<div class="bttns"><span class="badge badge-danger">Trashed</span> </div>';
            }
                                           
            if($match->top_games == 1){
                $top_status ='<div class="bttns"> <span class="badge badge-success">Yes</span> </div>';
            }else if($match->s_no == ''){
                $top_status ='<div class="bttns"> <span class="badge badge-danger">No</span> </div>';
            }

          	if ($match->seo_status == 1) { 
                $seo_status = '<span class="badge badge-success"><i class="fas fa-check"></i></span>';
            }
            else if ($match->seo_status != 1) { 
                $seo_status = '<span class="badge badge-warning"><i class="fas fa-times "></i></span>';
            }

           $link =   FRONT_END_URL."/".$language_code."/".$match->slug;

            $seo_preview = '<a target="_blank" href="'.$link.'" > <span class="badge"><i aria-hidden="true" class="far fa-eye"></i></span></a>';
           
			$tixstock_tickets = $this->db->select('(SUM(sell_tickets.quantity 
			)  + SUM(sell_tickets.sold) ) as quantity,sell_tickets.sold')
		  ->from('sell_tickets')
		  ->where('sell_tickets.match_id',$match->m_id)
		  ->where('sell_tickets.source_type !=','1boxoffice')
		  ->get()->row();


		  $total_sold = $this->db->select('SUM(sell_tickets.sold) as total_sold')
			  ->from('sell_tickets')
			  ->where('sell_tickets.match_id',$match->m_id)
			  ->get()
			  ->row();

           
           $encode_id = base64_encode(json_encode($match->m_id)).$tixstock_url;

           $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';

        	if($this->session->userdata('role') != 9){
            	$edit_content  .= '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Match Details</a>';
            }

            $edit_content  .= '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'?tab=content" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Content Details</a>';

            if($this->session->userdata('role') != 9){
             	  $edit_content  .= '<a href="'.base_url().'settings/match_settings/set_match_settings/'.$encode_id.'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Match Settings</a>';

             	  $edit_content  .= '<a href="'.base_url().'event/matches/tickets/'.$encode_id.'" class="dropdown-item"><i class=" fas fa-eye mr-1"></i>&nbsp;View Ticket Details</a>';
             	  $edit_content  .= '<a href="'.base_url().'event/matches/purchase_info/'.$encode_id.'" class="dropdown-item"><i class=" fas fa-eye mr-1"></i>&nbsp;View Purchase Details</a>';

				  
             	   if($match->status != 2){

             	  		//if($match->s_no == ''){ 
             	  			$edit_content  .= '<a id="branch_'.$match->m_id.'" href="javascript:void(0);" data-href="'.base_url().'event/matches/delete_match/'.$match->m_id.'" class="dropdown-item delete_action"  onClick="delete_data('.$match->m_id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Remove from list</a>';
             	  		//}
             	  	}
             	  	else{
             	  		$edit_content  .= '<a id="branch_'.$match->m_id.'" href="javascript:void(0);" data-href="'.base_url().'event/matches/undo_match/'.$match->m_id.'" class="dropdown-item delete_action" onClick="delete_data('.$match->m_id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Undo from trash</a>';
             	  	}
             }
                $edit_content  .= '</div>
                         </div>';
            $tbc ="";            
            if($match->tbc_status  == 1)
             $tbc = '<a href="" class="badge badge-warning">TBC</a>';

			 $event_date=date('d F Y',strtotime($match->match_date))."<br/> <center>".date('H:i',strtotime($match->match_date))."<br/>".$tbc.'</center> ';
			// date('d F Y H:i',strtotime($match->match_date)),
			
			if (strlen($match->event_name) > 35) {
				$match_name = substr($match->event_name, 0, 35) . '...';
			  }
			  else{
				$match_name=$match->event_name;
			  }


	        $data[] = array( 
				"checkbox"			=>  '<div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" data-order-id="'.md5($match->m_id).'" data-org-order-id="'.$match->m_id.'"><label class="form-check-label">&nbsp;</label></div>',
	           "match_name"			=> '<a href="'.base_url().'event/matches/add_match/'.$encode_id.'" >'.$match_name.'</a>',
	           "venue"				=> $match->stadium_name,
	           "event_date"			=> $event_date,
			   "event_category"		=> $match->category_name,
	           "tournament"			=> $match->tournament_name,
	           "status"				=> $status,
	           "top_game"			=> $top_status,
			   "no_of_ticket"		=> $match->box_quantity ?$match->box_quantity : 0,
	           "no_of_api"			=> $tixstock_tickets->quantity ? $tixstock_tickets->quantity : 0,
	           "ticket_sold"		=> $total_sold->total_sold ?$total_sold->total_sold : 0,
	           "seo_status"			=> $seo_status,
	           "seo_preview"		=> $seo_preview,
	           "source_type"		=> $match->source_type == '1boxoffice' ?  "1boxoffice, tixStock " : $match->source_type,
	           "action"			    => $edit_content,

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


	public function other_events(){

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
		if($postData['match_ids']) 
			$search_data['match_ids'] = explode(",", $postData['match_ids']) ;

		if($postData['event_name']) 
		$search_data['event_name']  = $postData['event_name'] ;

		if($postData['stadium_ids']) 
			$search_data['stadium_ids'] = explode(",", $postData['stadium_ids']) ;
		if($postData['tournament_ids']) 
			$search_data['tournament_ids'] = explode(",", $postData['tournament_ids']) ;

		if($postData['statuss']!="") 
			$search_data['statuss'] = explode(",", $postData['statuss']) ;

		if($postData['ticket_sold']!="") 
		$search_data['ticket_sold'] = $postData['ticket_sold'] ;

		if($postData['from_date']) 
			$search_data['from_date']  = $postData['from_date'] ;
		if($postData['to_date']) 
			$search_data['to_date'] = $postData['to_date'];

		if($postData['only']) 
			$search_data['only'] = $postData['only'];

		if(!empty($postData['event_start_date'])) 
			$search_data['event_start_date'] = $postData['event_start_date'];

		if(!empty($postData['event_end_date'])) 
			$search_data['event_end_date'] = $postData['event_end_date'];
			 
		$tixstock_url = @$postData['only'];

		if($postData['statuss']!="") 
		{

			if (stripos($postData['statuss'], 2) !== false) {
				$flag = 'expired';
				$search_data['statuss'] = str_replace("2", "", $postData['statuss']);
			}
		}
		
		
		// All records count
		$allcount = $this->General_Model->getOtherEvents('', $flag,'','','','','',$search_data,$tournment_id)->num_rows();

		// Get records
		$matches = $this->General_Model->getOtherEvents('', $flag, $rowno, $row_per_page, $order_column, $order_by,'',$search_data,$tournment_id)->result();

		//echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($matches as $match ){

			if($match->match_date < date('Y-m-d H:i:s')){
				$status = '<div class="bttns"> <span class="badge badge-danger">Expired</span> </div> ';
			}
	      else	if($match->match_status == '1'){ 
                $status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
            }else if($match->match_status == '0'){
                $status = '<div class="bttns"> <span class="badge badge-danger">InActive</span> </div>';
            } else if($match->match_status == '2'){
                $status = '<div class="bttns"><span class="badge badge-danger">Trashed</span> </div>';
            }
                                           
            if($match->top_games == 1){
                $top_status ='<div class="bttns"> <span class="badge badge-success">Yes</span> </div>';
            }else if($match->s_no == ''){
                $top_status ='<div class="bttns"> <span class="badge badge-danger">No</span> </div>';
            }

          	if ($match->seo_status == 1) { 
                $seo_status = '<span class="badge badge-success"><i class="fas fa-check"></i></span>';
            }
            else if ($match->seo_status != 1) { 
                $seo_status = '<span class="badge badge-warning"><i class="fas fa-times "></i></span>';
            }

           $link =   FRONT_END_URL."/".$language_code."/other-events-".$match->slug;

            $seo_preview = '<a target="_blank" href="'.$link.'" > <span class="badge"><i aria-hidden="true" class="far fa-eye"></i></span></a>';
         


		  $total_sold = $this->db->select('SUM(sell_tickets.sold) as total_sold')
			  ->from('sell_tickets')
			  ->where('sell_tickets.match_id',$match->m_id)
			  ->get()
			  ->row();

           
           $encode_id = base64_encode(json_encode($match->m_id)).$tixstock_url;
           $page_name = "other_events/add_event";
           if($match->category == 3){

           		$page_name = "matches/add_match";
           }
           $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';

        	if($this->session->userdata('role') != 9){
            	$edit_content  .= '<a href="'.base_url().'event/'.$page_name.'/'.$encode_id.'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Match Details</a>';
            }

            $edit_content  .= '<a href="'.base_url().'event/'.$page_name.'/'.$encode_id.'?tab=content" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Content Details</a>';

            if($this->session->userdata('role') != 9){
             	  $edit_content  .= '<a href="'.base_url().'settings/match_settings/set_match_settings/'.$encode_id.'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Match Settings</a>';

             	  $edit_content  .= '<a href="'.base_url().'event/other_events/add_event/'.$encode_id.'?tab=tickets" class="dropdown-item"><i class=" fas fa-eye mr-1"></i>&nbsp;View Ticket Details</a>';
             	 

				  
             	   if($match->status != 2){

             	  		//if($match->s_no == ''){ 
             	  			$edit_content  .= '<a id="branch_'.$match->m_id.'" href="javascript:void(0);" data-href="'.base_url().'event/other_events/delete_event/'.$match->m_id.'" class="dropdown-item delete_action"  onClick="delete_data('.$match->m_id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Remove from list</a>';
             	  		//}
             	  	}
             	  	else{
             	  		$edit_content  .= '<a id="branch_'.$match->m_id.'" href="javascript:void(0);" data-href="'.base_url().'event/other_events/undo_match/'.$match->m_id.'" class="dropdown-item delete_action" onClick="delete_data('.$match->m_id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Undo from trash</a>';
             	  	}
             }
                $edit_content  .= '</div>
                         </div>';


			 $event_date=date('d F Y',strtotime($match->match_date))."<br/> <center>".date('H:i',strtotime($match->match_date)).'</center>';
			// date('d F Y H:i',strtotime($match->match_date)),
			
			if (strlen($match->match_name) > 35) {
				$match_name = substr($match->match_name, 0, 35) . '...';
			  }
			  else{
				$match_name=$match->match_name;
			  }


	        $data[] = array( 
				"checkbox"			=>  '<div class="form-check custom-checkbox"><input type="checkbox" class="form-check-input dt-checkboxes" data-order-id="'.md5($match->m_id).'" data-org-order-id="'.$match->m_id.'"><label class="form-check-label">&nbsp;</label></div>',
	           "match_name"			=> '<a href="'.base_url().'event/'.$page_name.'/'.$encode_id.'" >'.$match_name.'</a>',
	           "venue"				=> $match->stadium_name,
	           "event_date"			=> $event_date,
	           // "tournament"			=> $match->tournament_name,
	           "category"			=> $match->category_name,
	           "status"				=> $status,
	           "top_game"			=> $top_status,
			   "no_of_ticket"		=> $match->box_quantity ?$match->box_quantity : 0,
	          
	           "ticket_sold"		=> $total_sold->total_sold ?$total_sold->total_sold : 0,
	           "seo_status"			=> $seo_status,
	           "seo_preview"		=> $seo_preview,
	        
	           "action"			    => $edit_content,

	        ); 
	     }

	     ## Response
	     $response = array(
	        "draw" => intval($draw),
	        "iTotalRecords" => $allcount,
	        "iTotalDisplayRecords" => $allcount,
	        "aaData" => $data
	     );

		if (mb_check_encoding($response, 'UTF-8')) {
			$json = json_encode($response);
		} else {
			$response = mb_convert_encoding($response, 'UTF-8');
			$json = json_encode($response);
		}
		echo $json;
	  //   echo json_encode($response); 
	     die;
	}

	public function stadium(){

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
		

		$allcount = $this->General_Model->get_stadium_by_limit('', '', '', '', $where_array, $search_data)->num_rows();
		$results = $this->General_Model->get_stadium_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search_data)->result();


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


            $stadium_url = base_url("game/stadium/get_stadium/".$row->s_id); 


            $edit_content  .= '<a href="'.$stadium_url.'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Stadium Details</a>';

 	  		$edit_content  .= '<a id="branch_'.$row->s_id.'" href="javascript:void(0);" data-href="'.base_url().'game/stadium/delete_stadium/'.$row->s_id.'" class="dropdown-item delete_action"  onClick="delete_data('.$row->s_id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Remove from list</a>';

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

	public function stadium_category(){

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
		


		if($postData['stadium_category_ids'] !="") 
			$search_data['stadium_category_ids'] = explode(",", $postData['stadium_category_ids']) ;
	
		if(($postData['status'] !="")) 
			$search_data['status'] = explode(",", $postData['status']) ;
		
		$allcount = $this->General_Model->get_seat_category_by_limit('', '1000000', '', '', '',$search_data)->num_rows();
		$results = $this->General_Model->get_seat_category_by_limit($rowno, $row_per_page, $order_column, $order_by, '',$search_data)->result();


		//echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($results as $row ){

	     	//echo "<pre>";print_r($category);
			$stadium_seat_id = $row->id;

			$stadium_arabic = $this->General_Model->getAllItemTable_array('stadium_seats_lang', array('stadium_seat_id' => $stadium_seat_id,'language' => 'ar'))->row();


	       

             $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';


            $stadium_url = "game/stadium_category/edit/".$row->id; 


            $edit_content  .= '<a href="'.base_url($stadium_url).'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Stadium Category</a>';

 	  		$edit_content  .= '<a id="branch_'.$row->id.'" href="javascript:void(0);" data-href="'.base_url().'game/stadium_category/delete/'.$row->id.'" class="dropdown-item delete_action"  onClick="delete_data('.$row->id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Remove from list</a>';

 	  		$edit_content .= "</div></div>";
 	  		

 	  		if ($row->status == '1') {  
				$status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
			}
			else if ($row->status != '1') { 
				$status ='<div class="bttns"><span class="badge badge-danger">Inactive</span></div>';
			} 

	        $data[] = array( 
			   
	            "seat_position"				=> $row->seat,
	            "seat_position_ar"			=> $stadium_arabic->seat_category,
	            "event_for"					=> $row->event_type,
	            "status"					=> $status,
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

	public function ticket_types(){

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
		


		$allcount = $this->General_Model->get_ticket_type_by_limit('', '', '', '', '', $search)->num_rows();
		$results = $this->General_Model->get_ticket_type_by_limit($rowno, $row_per_page, $order_column, $order_by, '', $search)->result();;


		//echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($results as $row ){

	     	//echo "<pre>";print_r($category);
			$stadium_seat_id = $row->id;

	
			if ($row->ticket_image != '') {
				$image = UPLOAD_PATH . 'uploads/ticket_image/' . $row->ticket_image;
			} else {
				$image = base_url('assets/img/placeholders/placeholder.png');
			}
		
			$img = '<img width="50px" class="imgTbl" src="'.$image.'">';
	       

             $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';


            $stadium_url = "settings/ticket_types/edit/".$row->id; 


            $edit_content  .= '<a href="'.base_url($stadium_url).'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit Ticket Type</a>';

 	  		$edit_content  .= '<a id="branch_'.$row->id.'" href="javascript:void(0);" data-href="'.base_url().'game/stadium_category/delete/'.$row->id.'" class="dropdown-item delete_action"  onClick="delete_data('.$row->id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp;Remove from list</a>';

 	  		$edit_content .= "</div></div>";
 	  		

 	  		if ($row->status == '1') {  
				$status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
			}
			else if ($row->status != '1') { 
				$status ='<div class="bttns"><span class="badge badge-danger">Inactive</span></div>';
			} 

	        $data[] = array( 
			   
	            "image"						=> $img,
	            "tickettype"			    => $row->tickettype,
	            "status"					=> $status,
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

	public function affiliate_mathes_settings(){

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
		
		if($postData['afiliates_ids'] !="") 
			$search_data['afiliates_ids'] = explode(",", $postData['afiliates_ids']) ;

		if($postData['tournament_ids'] !="") 
			$search_data['tournament_ids'] = explode(",", $postData['tournament_ids']) ;

		if($postData['statuss']!="") 
			$search_data['statuss'] = explode(",", $postData['statuss']) ;

		if(!empty($postData['event_start_date'])) 
			$search_data['event_start_date'] = $postData['event_start_date'];

		if(!empty($postData['event_end_date'])) 
			$search_data['event_end_date'] = $postData['event_end_date'];
		
		if($postData['match_ids']) 
			$search_data['match_ids'] = explode(",", $postData['match_ids']) ;


		$allcount = $this->General_Model->get_affiliate_list('', '1000000', '', '', '',$search_data)->num_rows();
		$results = $this->General_Model->get_affiliate_list($rowno, $row_per_page, $order_column, $order_by, '',$search_data)->result();

		// print_r($results);
		// echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($results as $row ){

	     	//echo "<pre>";print_r($category);
			$stadium_seat_id = $row->id;

			$stadium_arabic = $this->General_Model->getAllItemTable_array('stadium_seats_lang', array('stadium_seat_id' => $stadium_seat_id,'language' => 'ar'))->row();


	       

             $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';


            $edit_url = "settings/match_settings/set_affiliate_settings/".base64_encode(json_encode($row->id)); 

            // Edit
            $edit_content  .= '<a href="'.base_url($edit_url).'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit </a>';

            //Delete 
 	  		$edit_content  .= '<a id="branch_'.$row->id.'" href="javascript:void(0);" data-href="'.base_url().'settings/match_settings/delete_affiliate_settings/'.base64_encode(json_encode($row->id)).'" class="dropdown-item delete_action"  onClick="delete_data('.$row->id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp; Delete</a>';

 	  		$edit_content .= "</div></div>";
 	  		

 	  		if ($row->links_status == '1') {  
				$status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
			}
			else if ($row->links_status != '1') { 
				$status ='<div class="bttns"><span class="badge badge-danger">Inactive</span></div>';
			} 

			if ($row->match_status == '1') {  
				$match_status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
			}
			else if ($row->match_status != '1') { 
				$match_status ='<div class="bttns"><span class="badge badge-danger">Inactive</span></div>';
			} 

			$link = 'copyToClipboard("https://www.1boxoffice.com/'.
			$row->affiliate_language.'/'.
			$row->slug.'?token='.
			$row->token.'&reference='.
			$row->reference_no.'")';

			$copy_link ='<div class="bttns" onClick='.$link.' ><span class="badge badge-danger"><i class="fa fa-copy"></i></span></div>';


	        $data[] = array( 
			   
	            "affilate"			=>  $row->admin_name." ".$row->admin_last_name,
	            "reference"			=> $row->reference_no,
	            "language"			=> $row->affiliate_language =="en" ?  "English": "Arabic",
	            "match_name"		=> $row->match_name,
	            "match_date"		=> date('d M Y,  H:i',strtotime($row->match_date)),
	            "tournament"		=> $row->tournament_name,
	            "link_status"		=> $status,
	            "match_status"		=> $match_status,
	            "link"			    => $copy_link,
	            "action"			=> $edit_content,

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
}
