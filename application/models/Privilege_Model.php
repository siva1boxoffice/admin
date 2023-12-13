<?php
class Privilege_Model extends CI_Model {

	
	public function __construct(){
	    parent::__construct();
    }
	public function get_privileges_list(){
   		return $this->db->get('privileges');
	}
	public function add_privilege($priv_post){
		$this->db->insert('subadmin_privileges',$priv_post);
	}

	public function get_allowed_pages($sub_admin_id,$controller_name,$function_name){ 
		
		$allowed_pages = array('game_save_billing_information','game_update_nominee','game_resend_email','game_update_qr_link_orders','game_update_tracking_data_orders','game_booking_ticket_items','game_call_modal','tickets_get_items','game_get_pending_items','game_get_seller_status','game_upload_single_ticket_temp','game_save_upload_single_ticket','game_upload_single_ticket_temp','game_multiple_upload_tickets','game_delete_uploaded_instructions','game_delete_upload_single_ticket','game_save_delivery_information','game_saveNominee','game_update_tracking_data','game_update_tixstock_nominee','game_save_ticket_instruction','game_orders','game_send_email','game_delete_attendee','game_updateNominee','game_update_qr_link','game_get_encrpty_id','tickets_get_ticket_request_list','tickets_get_enquiry_list','tickets_get_partner_enquiry_list','settings_get_city_list','settings_get_state_list','settings_get_country_list','game_get_review_request','game_get_abondanned_items','game_get_ticket_delivery_list','game_booking_get_items','game_get_items','game_get_payment_history','settings_get_seo_venue_list','settings_get_seo_country_list','settings_get_seo_city_list','event_get_venue_basic','blog_category_ajax','blog_ajax','settings_get_ticket_list','event_get_other_category_list','settings_get_split_type_list','game_get_match_category_list','settings_get_ticket_type_list','ajax_other_events','ajax_matches','settings_get_tournaments','settings_get_teams','game_update_statdium_block','ajax_stadium','ajax_stadium_category','home_save_my_accounts','game_getStadiumByid','game_uploadEticket','game_deleteEticket','game_uploadNominee','game_download_tickets','game_saveNominee','game_saveEticket','home_index','home_master','game_category','tickets_get_tktcat_by_stadium_id','tickets_getCurrency_event','tickets_getMatchDetails','tickets_get_block_by_stadium_id','tickets_create_ticket','event_get_selected_teams_edit','stadium_ajax','event_get_selected_teams','stadium_add_stadium','stadium_edit_stadium','stadium_delete_stadium','stadium_upload_stadium','stadium_save_stadium','stadium_stadium_color_category','stadium_update_multiple_category','stadium_update_statdium_block','stadium_reset_stadium','stadium_clone_stadium','stadium_update_stadium_status');
		
		if(in_array($controller_name.'_'.$function_name,$allowed_pages)){
		
			return true;	
		}
		else
		{
			return false;	
		}
	}
	

	public function get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name){ 
		$this->db->where('admin_role_details.admin_id',$sub_admin_id);
		$this->db->where('privilege_functions.controller_name',$controller_name);
		$this->db->where('privilege_functions.function_name',$function_name);
		$this->db->join('privilege_admin_roles', 'privilege_admin_roles.admin_role_id = admin_role_details.admin_roles_id','right');
		$this->db->join('privilege_actions', 'privilege_actions.privilege_id = privilege_admin_roles.privilege_id','right');
			$this->db->join('privilege_functions', 'privilege_functions.privilege_functions_id = privilege_actions.privilege_functions_id','left');
	 
		
		$query = $this->db->get('admin_role_details');
		
	//echo $this->db->last_query();exit;
		if ( $query->num_rows() > 0 ) 
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	public function get_modules_by_sub_admin_id($sub_admin){
		$this->db->select('privileges.controller');
		$this->db->where('subadmin_id',$sub_admin);
		$this->db->join('privileges', 'privileges.id = subadmin_privileges.privilege_id');
		return $this->db->get('subadmin_privileges');
	}
	public function get_modules_by_sub_admin($sub_admin){
		$this->db->select('privileges.id');
		$this->db->where('subadmin_id',$sub_admin);
		$this->db->join('privileges', 'privileges.id = subadmin_privileges.privilege_id');
		return $this->db->get('subadmin_privileges');
	}
	public function delete_privileges($sub_admin){
		$this->db->where('subadmin_id',$sub_admin);
		$this->db->delete('subadmin_privileges');
	}

	public function get_module_privileges_list(){
   		return $this->db->get('product');
	}
	public function get_modules_by_agent($agent){
		$this->db->select('product.product_id');
		$this->db->where('b2b_id',$agent);
		$this->db->join('product', 'product.product_id = b2b_privileges.product_id');
		return $this->db->get('b2b_privileges');
	}
	public function delete($agent){
		$this->db->where('b2b_id',$agent);
		$this->db->delete('b2b_privileges');
	}
	public function add($priv_post){
		$this->db->insert('b2b_privileges',$priv_post);
	}
	public function get_modules_by_b2b_id($agent){
		$this->db->select('product.controller');
		$this->db->where('b2b_id',$agent);
		$this->db->join('product', 'product.product_id = b2b_privileges.product_id');
		return $this->db->get('b2b_privileges');
	}
  				
}
