<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Accounts_Model extends CI_Model {
  
  
  function get_unpaid_orders_v1($where = array())
	{ 
		//echo "<pre>";print_r($where);exit;
		$this->db->select('*');
		if($where){
			$this->db->where_in('bg_id',$where);
		}
		$this->db->where('payout_status','0');
		$this->db->where('booking_status',1);
		$query = $this->db->get('booking_global');
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}

function admin_payout_pending()
	{ 
		
		$this->db->select('*');
		$this->db->join('admin_details', 'admin_details.admin_id = booking_global.seller_id');
		$this->db->where('booking_global.payout_status','0');
		$this->db->where('booking_global.booking_status',1);
		if ($this->session->userdata('role') == 1) {
			$this->db->where('booking_global.seller_id', $this->session->userdata('admin_id'));
		}

		$query = $this->db->get('booking_global');
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}



  function admin_payout_histories($payment_id = '',$seller_id='')
	{ 
		
		$this->db->select('*,admin_bank_details.*,payouts.currency as currency');
		$this->db->join('admin_details', 'admin_details.admin_id = payouts.seller_id');
		$this->db->join('admin_bank_details', 'admin_bank_details.bank_id = payouts.paid_account','LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('payouts.seller_id', $this->session->userdata('admin_id'));
		}
		if($payment_id != ""){
			$this->db->where('payouts.payout_id', $payment_id);
		}

		if($seller_id!="")
		{
			$this->db->where_in('payouts.seller_id',$seller_id);
			$this->db->limit(5,0);
		}

		$this->db->order_by('payouts.payout_id','DESC');
		$query = $this->db->get('payouts');
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			
			return $query->result();
		} else {
			return '';
		}
	}

function get_admin_role($admin_id)
	{ 
		
		$this->db->select('*');
		$this->db->where('admin_login_details.admin_id',$admin_id);
		$query = $this->db->get('admin_login_details');
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return '';
		}
	}

  function get_unpaid_orders($where = array())
	{ //echo "<pre>";print_r($where);exit;
		$this->db->select('*');
		if($where['seller_id'] != ''){
			$this->db->where('seller_id',$where['seller_id']);
		}
		if($where['order_from'] != ''){
			$this->db->where('updated_at >= ', date("Y-m-d H:i",strtotime($where['order_from'])));
		}
		if($where['order_to'] != ''){
			$this->db->where('updated_at <= ', date("Y-m-d H:i",strtotime($where['order_to'])));
		} 
		if($where['bg_id'] != ''){
			$this->db->where('bg_id', $where['bg_id']);
		} 
		$this->db->where('payout_status','0');
		$this->db->where('seller_status',3);
		$this->db->where('booking_status != ',2);
			$this->db->where('booking_status != ',3);
		//$this->db->where('booking_status',1);
		$query = $this->db->get('booking_global');
		//echo $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}


	function get_unpaid_orders_v2($where = array())
	{ 
		$this->db->select('booking_global.bg_id,booking_global.partner_id,booking_global.affiliate_id,booking_global.booking_no,booking_global.booking_status,booking_tickets.match_name,booking_tickets.quantity,booking_tickets.currency_type,booking_global.ticket_amount,booking_global.partner_commission,booking_billing_address.title,booking_billing_address.first_name,booking_billing_address.last_name,ticket_types_lang.name as ticket_type_name');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('ticket_types_lang', 'ticket_types_lang.ticket_type_id = booking_tickets.ticket_type');
		if($where['seller_id'] != '' && $where['role'] == 1){
			$this->db->where('booking_global.seller_id',$where['seller_id']);
		}
		else if($where['seller_id'] != '' && $where['role'] == 2){
			$this->db->where('booking_global.partner_id',$where['seller_id']);
		}
		else if($where['seller_id'] != '' && $where['role'] == 3){
			$this->db->where('booking_global.affiliate_id',$where['seller_id']);
		}
		if($where['event_from'] != ''){
			$this->db->where('booking_tickets.match_date >= ', date("Y-m-d H:i",strtotime($where['event_from'])));
		}
		if($where['event_to'] != ''){
			$this->db->where('booking_tickets.match_date <= ', date("Y-m-d H:i",strtotime($where['event_to'])));
		} 
		if($where['currency'] != ''){
			$this->db->where('booking_global.currency_type', $where['currency']);
		} 
		if($where['bg_id'] != ''){
			$this->db->where('booking_global.bg_id', $where['bg_id']);
		} 
		
		if($where['payout_status'] == 1){
			$this->db->where('booking_global.payout_status','1');
		} 
		else{
			if($where['seller_id'] != '' && $where['role'] == 1){
			$this->db->where('booking_global.payout_status','0');
			$this->db->where('booking_global.seller_status',3);
			}
			else if($where['seller_id'] != '' && ($where['role'] == 2 || $where['role'] == 3)){
			$this->db->where('booking_global.partner_payout_status','0');
			}
			$this->db->where('booking_global.booking_status != ',2);
			$this->db->where('booking_global.booking_status != ',3);
			$this->db->where('booking_global.booking_status != ',0);
			$this->db->where('booking_global.booking_status != ',7);
		}
		

		$this->db->where('ticket_types_lang.language','en');
		$this->db->order_by('booking_tickets.match_name','ASC');
		$query = $this->db->get('booking_global');
		//echo $query->num_rows();exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}

}
?>
