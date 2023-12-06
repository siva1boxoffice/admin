<?php 
error_reporting(0);
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stadium_Model extends CI_Model
{
	private $store_id ;
	public function __construct()
	{
		/*
         *  Developed by: PANDIYAN
         *  Date    : 17 January, 2023
         *  1BoxOffice Hub
         *  https://www.1boxoffice.com/
        */
		parent::__construct();
		$this->store_id = @$this->session->userdata("storefront")->user_id ? $this->session->userdata("storefront")->user_id: 13;
		//$this->store_id = "";
	}
	

	public function get_stadium_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(),$search = array())
	{
		$this->db->select('*,game_category_lang.category_name')->join('game_category_lang', 'game_category_lang.game_cat_id = stadium.category', 'left');
		$this->db->where('game_category_lang.language', $this->session->userdata('language_code'));
		$this->db->from('stadium');
		
		$this->db->where('stadium.stadium_type', '2');

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		else{
			$this->db->order_by('stadium.stadium_name', 'asc');
		}
		if (@$_GET['only'] == 'tixstock') {
			//$this->db->where('stadium.source_type', 'tixstock');
		}
		else{
			//$this->db->where('stadium.source_type', '1boxoffice');
		}
		$this->db->where_in('stadium.source_type', ['1boxoffice','tixstock']);
		if($search['stadium_ids']){
				$this->db->where_in('stadium.s_id', $search['stadium_ids']);
			}
		if(@$search['status']){
			// print_r($search['status']);
				//if ($match_held !== 'expired') {	
				$this->db->where_in('stadium.status', $search['status']);
				//}
			}
		if (@$search['category']) {
			$this->db->where_in('stadium.category', $search['category']);
			//}
		}		
		
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_seat_stadium_category($stadium_id)
	{
		$this->db->select('stadium_color_category.*,stadium_seats_lang.seat_category,stadium_seats_lang.stadium_seat_id')
					->from('stadium_color_category')
					->where('stadium_id',$stadium_id);

		$this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_color_category.category_id AND language ="en"', 'left');
		$this->db->order_by('stadium_seats_lang.seat_category', 'ASC');
		$query = $this->db->get();
		return $query;
	}


	public function get_categoryby($s_id)
	{
		$this->db->where('stadium_details.stadium_id',$s_id);
		$this->db->select('stadium_details.*,stadium_seats_lang.seat_category')
		->from('stadium_details');
		$this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_details.category AND language ="en"', 'left');
		$this->db->order_by('stadium_details.block_id', 'ASC');
		$this->db->where('stadium_details.source_type','1boxoffice');
		$query = $this->db->get();
		return $query;
	}

	public function get_stadium_color_id_category($stadium_id)
	{
		$this->db->select('stadium_color_category.*,stadium_seats_lang.seat_category,stadium_seats_lang.stadium_seat_id')
					->from('stadium_color_category')
					->where('stadium_id',$stadium_id);

		$this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_color_category.category_id AND language ="en"', 'left');
		
		$this->db->order_by('stadium_seats_lang.seat_category', 'ASC');
		$query = $this->db->get();
		return $query;
	}


	public function get_stadium_color_list($stadium_id)
	{

		$this->db->select('stadium_details.*')->from('stadium_details');
		$this->db->where('stadium_details.stadium_id', $stadium_id);
		$this->db->where('stadium_details.source_type','1boxoffice');
		$this->db->group_by('stadium_details.block_color');
		$query = $this->db->get();
		return $query;
	}

	public function get_stadium_details($stadium_id,$category)
	{

		$this->db->select('stadium_details.*')->from('stadium_details');
		$this->db->where('stadium_details.stadium_id', $stadium_id);
		$this->db->where('stadium_details.category', $category);
		$query = $this->db->get();//echo $this->db->last_query();exit;
		return $query;
	}


	public function get_seat_category_main()
	{
		$this->db->select('stadium_seats_lang.*')
					->from('stadium_seats')
					->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_seats.id', 'left');
		$this->db->where('stadium_seats_lang.language', $this->session->userdata('language_code'));
		$this->db->where('stadium_seats.source_type', '1boxoffice');
		$this->db->order_by('stadium_seats_lang.seat_category','ASC');
		$query = $this->db->get();
		return $query;
	}
	
	
}
