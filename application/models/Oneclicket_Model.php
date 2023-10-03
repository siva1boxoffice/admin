<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Oneclicket_Model extends CI_Model
{

public function get_available_matches($tournament)
	{

		$this->db->select('match_info.*')->from('match_info');
		$this->db->where('DATE(match_date) >', date("Y-m-d"));
		$this->db->where('event_type', 'match');
		$this->db->where('tournament', $tournament);
		$this->db->where('tixstock_id != ', '');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query;
	}

public function get_match_tournments($match_id = "") {
        

        $this->db->select("match_info.*,tournament_lang.tournament_name,match_info_lang.match_name");
        $this->db->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
        $this->db->join('tournament_lang', 'tournament_lang.tournament_id = match_info.tournament', 'left');
        $this->db->where('match_info.match_date >= ', date("Y-m-d H:i:s"));
        $this->db->where('match_info_lang.language', 'en');
        $this->db->where('tournament_lang.language', 'en');
         $this->db->where('match_info.status', '1');
         if($match_id != ""){
         $this->db->where('match_info.m_id', $match_id);
         }
        $this->db->order_by('match_info.match_date', 'ASC');
        $this->db->group_by('match_info.m_id');

        // echo $this->db->last_query();die;
        $result = $this->db->get('match_info');

        return $result->row();
    }

public function check_match_exists($match_date,$tournament,$team_1_id,$team_2_id,$event_type,$flag="")
	{

		$this->db->select('match_info.*')->from('match_info');
		if($flag == 1){
			$this->db->where('DATE(match_date)', $match_date);
		}
		else{
			$this->db->where('DATE(match_date) >=', date('Y-m-d'));
		}
		$this->db->where('event_type', $event_type);
		$this->db->where('tournament', $tournament);
		$this->db->where('team_1', $team_1_id);
		$this->db->where('team_2', $team_2_id);
		$query = $this->db->get();
		return $query;
	}


public function check_sellerTickets($tixstock_id)
	{

		$this->db->select('sell_tickets.*')->from('sell_tickets');
		$this->db->where('sell_tickets.tixstock_id', $tixstock_id);
		$query = $this->db->get();
		return $query;
	}

public function get_listing_notes($note)
	{

		$this->db->select('ticket_details_lang.*')->from('ticket_details_lang');
		$this->db->where('ticket_details_lang.ticket_name', $note);
		$this->db->where('ticket_details_lang.language', 'en');
		$query = $this->db->get();
		return $query;
	}

public function get_city($country_code,$name)
	{

		$this->db->select('states.*')->from('states');
		$this->db->where('name', $name);
		$this->db->where('country_id', $country_code);
		$query = $this->db->get();
		return $query;
	}

public function get_country($country_code)
	{

		$this->db->select('countries.*')->from('countries');
		$this->db->where('sortname', $country_code);
		$query = $this->db->get();
		return $query;
	}

public function get_venues($stadium_name)
	{

		$this->db->select('stadium.*')->from('stadium');
		$this->db->where('stadium_name', $stadium_name);
		$query = $this->db->get();
		return $query;
	}

public function get_venues_stadium($stadium_name)
	{

		$this->db->select('tixstock_stadium.*')->from('tixstock_stadium');
		$this->db->where('stadium_name', $stadium_name);
		$query = $this->db->get();
		return $query;
	}

public function get_stadium_category($stadium_id,$stadium_category)
	{

		$this->db->select('tixstock_stadium_category.*')->from('tixstock_stadium_category');
		$this->db->where('category_name', $stadium_category);
		$this->db->where('stadium_id', $stadium_id);
		$query = $this->db->get();
		return $query;
	}

public function get_stadium_blocks($stadium_id,$category_id,$block)
	{

		$this->db->select('tixstock_stadium_blocks.*')->from('tixstock_stadium_blocks');
		$this->db->where('block_name', $block);
		$this->db->where('category_id', $category_id);
		$this->db->where('stadium_id', $stadium_id);
		$query = $this->db->get();
		return $query;
	}


public function get_tournament($category)
	{

		$this->db->select('tournament_lang.*')->from('tournament_lang');
		$this->db->where('tournament_lang.tournament_name', $category);
		$this->db->where('tournament_lang.language', 'en');
		$query = $this->db->get();
		return $query;
	}

public function get_teams($team_name)
	{

		$this->db->select('teams_lang.*')->from('teams_lang');
		$this->db->where('teams_lang.team_name', $team_name);
		$this->db->where('teams_lang.language', 'en');
		$query = $this->db->get();
		return $query;
	}


	public function get_teams_like($team_name)
	{

		$this->db->select('teams_lang.*')->from('teams_lang');
		$this->db->like('teams_lang.team_name', $team_name);
		$this->db->where('teams_lang.language', 'en');
		$query = $this->db->get();
		return $query;
	}


	function insert_data($table, $insert_data)
	{
		$this->db->insert($table, $insert_data);
		$last_insert_id = $this->db->insert_id();
		return $last_insert_id;
	}

	function update_table($table, $wheres, $uvalue)
	{
		foreach($wheres as $whkey => $where){
		 $this->db->where($whkey, $where);
		}
		$dbquery = $this->db->update($table, $uvalue);
		if ($this->db->affected_rows() > 0) return true;
		else return false;
	}

public function get_event_pulling_api($match_id = "") {
        

        $this->db->select("api_events.*,api_tournaments.*,api_stadium.*,api_events.merge_status as event_merge_status,api_events.api_unique_id as api_unique_id,api_events.id as api_data_id");
        $this->db->join('api_tournaments', 'api_tournaments.tournament_id = api_events.tournament', 'left');
        $this->db->join('api_stadium', 'api_stadium.stadium_id = api_events.stadium', 'left');
         if($match_id != ""){
         $this->db->where('api_events.id', $match_id);
         }
        $result = $this->db->get('api_events');

        return $result->row();
    }

public function get_event_pulling_api_items($row_no='', $row_per_page='',$search=array()) {
        

        $this->db->select("api_events.*,api_tournaments.*,api_stadium.*,api_events.merge_status as event_merge_status,api_events.api_unique_id as api_unique_id,api_events.id as api_data_id,api_tournaments.tournament_name as tournament_name,api_stadium.stadium_name as stadium_name");
        $this->db->join('api_tournaments', 'api_tournaments.tournament_id = api_events.tournament', 'left');
        $this->db->join('api_stadium', 'api_stadium.stadium_id = api_events.stadium', 'left');
         $this->db->where('api_events.match_found', 1);

		if($search['parent_category'] != ""){
		$this->db->where_in('api_events.tixstock_parent_category', $search['parent_category']);
		}

		if($search['child_category'] != ""){
		$this->db->where_in('api_events.tixstock_category', $search['child_category']);
		}

		

		if($search['teams'] != ""){
			$this->db->group_start();
		$this->db->where_in('api_events.team_a', $search['teams']);
		$this->db->or_where_in('api_events.team_b', $search['teams']);
		$this->db->group_end();

		}
		if($search['event_start_date'] != "" && $search['event_end_date'] != ""){
				$this->db->where('DATE(api_events.match_date) >=', date('Y-m-d', strtotime($search['event_start_date'])));
				$this->db->where('DATE(api_events.match_date) <=', date('Y-m-d', strtotime($search['event_end_date'])));
				
			}

		if ($row_per_page != '') {
		$this->db->limit($row_per_page, $row_no);
		}
        $result = $this->db->get('api_events');
       //echo $this->db->last_query();exit;
        return $result;
    }


function get_confirmed_orders($bg_id)
	{ //echo "<pre>";print_r($search);exit;
		
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,register.email as customer_email,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no,countries.name as customer_country_name,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name,booking_billing_address.first_name as buyer_first_name,booking_billing_address.last_name as buyer_last_name,booking_billing_address.email as buyer_email,booking_billing_address.address as buyer_address,countries.name as country_name,countries.sortname as country_code,states.name as state_name');
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium', 'stadium.s_id = booking_tickets.stadium_id', 'LEFT');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('register', 'register.id=booking_global.user_id', 'LEFT');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		$this->db->join('countries', 'countries.id=booking_billing_address.country_id', 'LEFT');
		$this->db->join('states', 'states.id=booking_billing_address.state_id', 'LEFT');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');

		$this->db->join('admin_details as partner', 'partner.admin_id=booking_global.partner_id', 'LEFT');
		$this->db->where('booking_global.bg_id', $bg_id);
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		return $qry;
	}

}