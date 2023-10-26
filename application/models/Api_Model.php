<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Api_Model extends CI_Model
{

	function api_matches($row_per_page="", $row_no="", $search ="")
	{
		$this->db->select('match_info.m_id,match_info_lang.match_name,match_info.match_date,match_info.status,api_partner_events.id  as  events_count,match_info.status,api_partner_events.api_status,admin_details.admin_name,admin_details.admin_last_name,COUNT(sell_tickets.s_no) as ticket_status')
			->from('match_info')
			->join('match_info_lang', 'match_info.m_id = match_info_lang.match_id','LEFT')
			//->join('tournament', 'tournament.t_id = match_info.tournament','left')
			->join('api_partner_events', 'api_partner_events.event_id = match_info.m_id AND api_partner_events.partner_id = "'.$search['partner_id'].'" AND api_partner_events.tournament_id = "'.$search['tournament_id'].'"','LEFT')
			->join('admin_details', 'admin_details.admin_id = api_partner_events.partner_id','LEFT')
			->join('sell_tickets', 'sell_tickets.match_id = match_info.m_id','LEFT');

		$this->db->where("match_info.match_date >= NOW()");
		$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));

		if ($row_per_page != '' && $row_no >= 0) {
			$this->db->limit($row_per_page, $row_no);
		}
		if ($search['text'] != '') {
			$this->db->where('match_info_lang.match_name', $search['text']);
		}
		if ($search['tournament_id'] != '') {
			$this->db->where('match_info.tournament', $search['tournament_id']);
		}
		$this->db->order_by('match_info.match_date', 'ASC');
		$this->db->order_by('match_info.m_id', 'ASC');
		
		$this->db->group_by('match_info.m_id');
		//$this->db->limit(10);
		$qry = $this->db->get();
		//echo $this->db->last_query();die;


		
		return $qry;
		// if ($qry->num_rows() > 0) {
		// 	return $qry->result();
		// } else {
		// 	return array();
		// }
	}

	function get_api_partner_events_tpm($tournament_id,$partner_id,$event_id)
	{
		$this->db->where('tournament_id',$tournament_id);
		$this->db->where('partner_id',$partner_id);
		$this->db->where('event_id',$event_id);
	
		$qry = $this->db->get('api_partner_events');
		//echo $this->db->last_query();
		return $qry;
	}

	function get_api_details($status="", $row_per_page="", $row_no="", $search="")
	{
		$this->db->select('api_partner_events.*, api_partner_events.id as partner_id, match_info.match_name as event_name, match_info.match_date as event_date,admin_details.admin_name,admin_details.admin_last_name');
		$this->db->from('api_partner_events');
		$this->db->where('api_status',$status);
		
		$this->db->join('admin_details', 'admin_details.admin_id = api_partner_events.partner_id');
		$this->db->join('tournament', 'tournament.t_id = api_partner_events.tournament_id');
		$this->db->join('match_info', 'match_info.m_id = api_partner_events.event_id');

		$this->db->join('game_category', 'game_category.id = api_partner_events.category_id');
		
		$this->db->order_by('api_partner_events.id', 'DESC');
		if ($row_per_page != '' && $row_no >= 0) {
			$this->db->limit($row_per_page, $row_no);
		}
		if ($search != '') {
			$this->db->like('match_info.match_name', $search);
		}
		$qry = $this->db->get();
		return $qry;
		// if ($qry->num_rows() > 0) {
		// 	return $qry->result();
		// } else {
		// 	return array();
		// }
	}

	// function api_key_settings($row_per_page="", $row_no="")
	// {
	// 	$this->db->select('api_key_settings.*,admin_details.admin_name, admin_details.admin_email, admin_details.company_name, admin_details.admin_last_name');
	// 	$this->db->from('api_key_settings');
	// 	$this->db->join('admin_details', 'admin_details.admin_id = api_key_settings.partner_id','LEFT');
	// 	$this->db->order_by('api_key_settings.id', 'DESC');
	// 	if ($row_per_page != '' && $row_no >= 0) {
	// 		$this->db->limit($row_per_page, $row_no);
	// 	}
	// 	$qry = $this->db->get();
	// 	echo $this->db->last_query();exit;

	// 	return $qry;
	// }
	public function api_key_settings($row_per_page="", $row_no="",$search="")
	{
			$this->db->select('api_key_settings.*');
			$this->db->select('admin_details.admin_name,admin_details.admin_last_name, admin_details.admin_email, admin_details.company_name');
			$this->db->select('seller_details.admin_name AS seller_name, seller_details.admin_last_name AS seller_last_name');
			$this->db->from('api_key_settings');
			$this->db->join('admin_details as seller_details', 'seller_details.admin_id = api_key_settings.seller_id', 'left');
			$this->db->join('admin_details', 'admin_details.admin_id = api_key_settings.partner_id', 'left');
			$this->db->order_by('api_key_settings.id', 'desc');

			if (isset($search['status']) &&  $search['status'] != '') {
				$this->db->where_in('api_key_settings.status', $search['status']);
			}
			if (isset($search['name']) && $search['name'] != '') {
				$this->db->group_start();
				$this->db->like('admin_details.admin_name', $search['name']);
				$this->db->or_like('admin_details.admin_last_name', $search['name']);
				$this->db->group_end();
			}
			if (isset($search['seller_name']) && $search['seller_name'] != '') {
				$this->db->group_start();
				$this->db->like('seller_details.admin_name', $search['name']);
				$this->db->or_like('seller_details.admin_last_name', $search['name']);
				$this->db->group_end();
			}

			if ($row_per_page != '' && $row_no >= 0) {
				$this->db->limit($row_per_page, $row_no);
			}

			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			return $query;

	}

	function api_ip_patching($row_per_page="", $row_no="")
	{
		$this->db->select('api_ip_patching.*,admin_details.admin_name, admin_details.admin_email, admin_details.company_name, admin_details.admin_last_name');
		$this->db->from('api_ip_patching');
		$this->db->join('admin_details', 'admin_details.admin_id = api_ip_patching.partner_id','LEFT');
		$this->db->order_by('api_ip_patching.id', 'DESC');
		if ($row_per_page != '' && $row_no >= 0) {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();
		return $qry;
	}

	public function get_event_by_id($id="")
	{

		$this->db->select('match_info.*,match_info.status as match_status,match_info_lang.*, DATE_FORMAT(match_info.match_date, "%d %M %Y") as match_date_formated')->from('match_info')->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
		$this->db->where('match_info.event_type', 'match');
		if(!empty($id)){
			$this->db->where('match_info.tournament', $id);
		}
		$this->db->where("match_date >= NOW()");
		$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
		$this->db->order_by('match_info.match_date', 'ASC');

		$query = $this->db->get();
		return $query;
	}

	public function isRecordExists($table, $criteria,$id="") {
        $this->db->where($criteria);
		if(isset($id))
				$this->db->where_not_in('id', $id);
		
        $query = $this->db->get($table);
		//echo $this->db->last_query();exit;
        return $query->num_rows() > 0;
    }


}
?>

