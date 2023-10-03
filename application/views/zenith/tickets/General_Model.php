<?php 
error_reporting(0);
if (!defined('BASEPATH')) exit('No direct script access allowed');
class General_Model extends CI_Model
{
	private $store_id ;
	public function __construct()
	{
		/*
         *  Developed by: Sivakumar G
         *  Date    : 22 January, 2022
         *  1BoxOffice Hub
         *  https://www.1boxoffice.com/
        */
		parent::__construct();
		$this->store_id = @$this->session->userdata("storefront")->user_id ? $this->session->userdata("storefront")->user_id: 13;
		//$this->store_id = "";
	}
	


	function get_type_name_by_id($type, $type_id = '', $field = 'settings_name')
	{
		if ($type_id != '') {
			$l = $this->db->get_where($type, array($type . '_id' => $type_id));
			$n = $l->num_rows();
			if ($n > 0) {
				return $l->row()->$field;
			}
		}
	}


	function get_seller_name($searchText='')
	{
		$this->db->select('admin_name as seller_first_name,admin_last_name as seller_last_name,admin_id as seller_id');
		$this->db->from('admin_details');
		$this->db->where('admin_status', "ACTIVE");
		$this->db->like('admin_name', $searchText);
		$this->db->or_like('admin_last_name', $searchText);
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		return $qry;
	}


	function get_ticket_category($searchText='')
	{
		$this->db->select('sl.stadium_seat_id,sl.seat_category');
		$this->db->from('stadium_seats as s');
		$this->db->join('stadium_seats_lang as sl', 's.id=sl.stadium_seat_id and sl.language="en"','left');
		$this->db->where('sl.seat_category is not Null');
		$this->db->like('sl.seat_category', $searchText);
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		//echo $this->db->last_query();exit;
		return $qry;
	}

	function get_country_name($searchText='')
	{
		$this->db->select('countries.id,countries.name');
		$this->db->from('countries');
		$this->db->like('countries.name', $searchText);
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		//echo $this->db->last_query();exit;
		return $qry;
	}


	//function get_confirmed_orders($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(),$search= '')
	function get_confirmed_orders($row_no, $row_per_page,$currecny="",$search= '')
	{ //echo "<pre>";print_r($search);exit;
		
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,register.email as customer_email,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no,countries.name as customer_country_name,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name');
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

		if($this->store_id){
			//$this->db->where('booking_global.store_id', $this->store_id);
		}
		$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		if($currecny == "GBP"){
		$this->db->where('booking_global.currency_type', "GBP");
		}
		else if($currecny == "EUR"){
		$this->db->where('booking_global.currency_type',"EUR");
		}
		else if($currecny == "USD"){
		$this->db->where('booking_global.currency_type',"USD");
		}
		if (!empty($search)) {
			if($search['sale_start_date'] != ""){

				 $this->db->where('DATE_FORMAT(booking_global.updated_at,"%Y-%m-%d") >= ',$search['sale_start_date']);

			}
		}
		if (!empty($search)) {
			if($search['sale_end_date'] != ""){

				$this->db->where('DATE_FORMAT(booking_global.updated_at,"%Y-%m-%d") <= ',$search['sale_end_date']);
			}
		}

		if (!empty($search)) {
			if($search['sellers'][0] != ""){

				$this->db->where_in('booking_global.seller_id',$search['sellers']);
			}
		}

		if (!empty($search)) {
			if($search['partner_id'] != ""){

				$this->db->where_in('booking_global.partner_id',$search['partner_id']);
			}
		}

		if (!empty($search)) {
			if($search['users'] != ""){

				$this->db->where_in('booking_global.user_id',$search['users']);
			}
		}

		if (!empty($search)) {
			if($search['tournaments'] != ""){

				$this->db->where_in('booking_tickets.tournament_id',$search['tournaments']);
			}
		}

		if (!empty($search)) {
			if($search['match_id'] != ""){

				$this->db->where_in('booking_tickets.match_id',$search['match_id']);
			}
		}

		if (!empty($search)) {
			if($search['partner'] != ""){

				$this->db->where('booking_global.partner_id > ', 0);
				// $this->db->where('booking_global.partner_id  is NOT NULL', NULL, FALSE);
			}
		}
		if (!empty($search)) {
			if($search['nominee'] == 1){

				$this->db->where_in('booking_tickets.nominee_status',1);
			}
			else if($search['nominee'] == 2){

				$this->db->where_in('booking_tickets.nominee_status',0);
			}
		}

		   $this->db->order_by('booking_global.bg_id', 'DESC');
		  // $this->db->limit(50);
		/*if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}*/
		  
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		} //echo "<pre>";print_r($search);exit;
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		return $qry;
	}

	function get_confirmed_orders_search($row_no, $row_per_page,$currecny="",$booking_no= '',$fromDate="",$toDate="",$seller_name='',$event_name='',$seat)
	{ 
		

		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,register.email as customer_email,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no,countries.name as customer_country_name,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name');
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

		if($this->store_id){
			//$this->db->where('booking_global.store_id', $this->store_id);
		}
		$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		if($currecny == "GBP"){
		$this->db->where('booking_global.currency_type', "GBP");
		}
		else if($currecny == "EUR"){
		$this->db->where('booking_global.currency_type',"EUR");
		}
		else if($currecny == "USD"){
		$this->db->where('booking_global.currency_type',"USD");
		}

		if ($booking_no != "") {
			$this->db->like('booking_global.booking_no', $booking_no);
		}

		if ($fromDate != "") {
			$this->db->where('DATE_FORMAT(booking_tickets.match_date,"%Y-%m-%d") >= ',$fromDate);

			//$this->db->where('booking_global.updated_at >=', $fromDate);
			
		}

		if ($toDate != "") {
			$this->db->where('DATE_FORMAT(booking_tickets.match_date,"%Y-%m-%d") <= ',$toDate);
			//$this->db->where('booking_global.updated_at <=', $toDate);
		}

		if($event_name != ""){

			$this->db->like('booking_tickets.match_name',$event_name);
		}

		if(!empty($seller_name)){

			$comma_separated = implode("', '", $seller_name);
			//$comma_separated = implode("', '", $array);
			$this->db->where_in('admin_details.admin_id',$comma_separated);
		}

		if(!empty($seat)){

			$comma_separated = implode("', '", $seat);
			//$comma_separated = implode("', '", $array);
			$this->db->where_in('booking_tickets.ticket_category',$seat);
		}
		// if($seat!=""){

		// 	//$comma_separated = implode("', '", $seat);
		// 	//$comma_separated = implode("', '", $array);
		// 	$this->db->like('stadium_seats_lang.seat_category',$event_name);
		// }

		

		/*if (!empty($search)) {
			if($search['sale_start_date'] != ""){

				 $this->db->where('DATE_FORMAT(booking_global.updated_at,"%Y-%m-%d") >= ',$search['sale_start_date']);

			}
		}
		if (!empty($search)) {
			if($search['sale_end_date'] != ""){

				$this->db->where('DATE_FORMAT(booking_global.updated_at,"%Y-%m-%d") <= ',$search['sale_end_date']);
			}
		}

		if (!empty($search)) {
			if($search['sellers'][0] != ""){

				$this->db->where_in('booking_global.seller_id',$search['sellers']);
			}
		}

		if (!empty($search)) {
			if($search['partner_id'] != ""){

				$this->db->where_in('booking_global.partner_id',$search['partner_id']);
			}
		}

		if (!empty($search)) {
			if($search['users'] != ""){

				$this->db->where_in('booking_global.user_id',$search['users']);
			}
		}

		if (!empty($search)) {
			if($search['tournaments'] != ""){

				$this->db->where_in('booking_tickets.tournament_id',$search['tournaments']);
			}
		}

		if (!empty($search)) {
			if($search['match_id'] != ""){

				$this->db->where_in('booking_tickets.match_id',$search['match_id']);
			}
		}

		if (!empty($search)) {
			if($search['partner'] != ""){

				$this->db->where('booking_global.partner_id > ', 0);
				// $this->db->where('booking_global.partner_id  is NOT NULL', NULL, FALSE);
			}
		}
		if (!empty($search)) {
			if($search['nominee'] == 1){

				$this->db->where_in('booking_tickets.nominee_status',1);
			}
			else if($search['nominee'] == 2){

				$this->db->where_in('booking_tickets.nominee_status',0);
			}
		}*/

		   $this->db->order_by('booking_global.bg_id', 'DESC');
		  // $this->db->limit(50);
		/*if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}*/
		  
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		} //echo "<pre>";print_r($search);exit;
		$qry = $this->db->get();
		//echo $this->db->last_query();exit;
		return $qry;
	}

	function get_confirmed_orders_dec($currecny="",$search= '',$date)
	{ //echo "<pre>";print_r($search);exit;
		
		$this->db->select('booking_global.bg_id');
		$this->db->from('booking_global');
		$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		$this->db->where('booking_global.seller_status !=', 1);
		$this->db->where('booking_global.updated_at <= ', $date);
		$this->db->order_by('booking_global.bg_id', 'DESC');
		//$this->db->limit(500);
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		return $qry;
	}



	public function get_tournament_seller($seller_ids = array()) {
        

        $this->db->select("booking_tickets.tournament_name as label,booking_tickets.tournament_id as value");
        $this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id', 'left');
        $this->db->where_in('booking_global.seller_id', $seller_ids);
        $this->db->where_in('booking_global.booking_status', [1,4,5,6]);
        $this->db->order_by('booking_tickets.tournament_name', 'ASC');
        $this->db->group_by('booking_tickets.tournament_id');
        $result = $this->db->get('booking_tickets');

        return $result->result();
    }




	function get_tournaments_orders($currecny,$search= '')
	{ //echo "<pre>";print_r($search);exit;
		
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no,countries.name as customer_country_name,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name,SUM(booking_global.total_amount) as summary_amount,SUM(booking_tickets.quantity) as total_quantity,sell_tickets.quantity as ticket_total_quality,sell_tickets.seat,sell_tickets.sold,booking_tickets.match_id,COUNT(booking_tickets.match_id) as total_bookings');
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
		
		$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		
		$this->db->where('booking_global.currency_type',"USD");
		
		if($this->store_id){
			//$this->db->where('booking_global.store_id', $this->store_id);
		}
		if (!empty($search)) {
			if($search['sale_start_date'] != ""){

				 $this->db->where('booking_global.updated_at >= ', $search['sale_start_date']);

			}
		}
		if (!empty($search)) {
			if($search['sale_end_date'] != ""){

				$this->db->where('booking_global.updated_at <= ',$search['sale_end_date']);
			}
		}

		if (!empty($search)) {
			if($search['sellers'] != ""){

				$this->db->where_in('booking_global.seller_id',$search['sellers']);
			}
		}

		if (!empty($search)) {
			if($search['users'] != ""){

				$this->db->where_in('booking_global.user_id',$search['users']);
			}
		}

		if (!empty($search)) {
			if($search['tournaments'] != ""){

				$this->db->where_in('booking_tickets.tournament_id',$search['tournaments']);
			}
		}

		if (!empty($search)) {
			if($search['match_id'] != ""){

				$this->db->where_in('booking_tickets.match_id',$search['match_id']);
			}
		}

		if (!empty($search)) {
			if($search['partner'] != ""){

				//$this->db->where('booking_global.partner_id > ', 0);
				$this->db->where('booking_global.partner_id  is NOT NULL', NULL, FALSE);
			}
		}
		   $this->db->where('booking_tickets.tournament_id',19);
		   $this->db->order_by('booking_tickets.match_name', 'ASC');

		   if($currecny){
		   		$this->db->group_by('booking_global.bg_id');
		   		
			}
			else{
				$this->db->group_by(array('booking_tickets.match_id','booking_global.currency_type'));
			}
	/*	if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		  
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}*/
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		return $qry;
	}
	public function get_ticket_status($booking_id,$ticket_status)
	{	
		
		$this->db->select('booking_etickets.*')->from('booking_etickets');
		$this->db->where('booking_etickets.booking_id', $booking_id);
		$this->db->group_start();
		if($ticket_status != ""){
			if($ticket_status == "pending"){
				$this->db->where('booking_etickets.ticket_status',NULL);
				$this->db->or_where('booking_etickets.ticket_status',1);
			}
			else if($ticket_status == "uploaded"){
				$this->db->where('booking_etickets.ticket_status', 2);
			}
		
		}
		$this->db->group_end();
		$query = $this->db->get();//echo $this->db->last_query();exit;
		return $query;
	}


	public function get_ticket_type_category($ticket_cat_id="")
	{

		$this->db->select('ticket_type_categories.*')->from('ticket_type_categories');
		$this->db->where('ticket_type_categories.status != ', 2);
		if($ticket_cat_id != ""){
		$this->db->where('ticket_type_categories.ticket_cat_id', $ticket_cat_id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_customers()
    {

        $this->db->select('register.*')
		        ->from('booking_global')
		        ->join('register', 'register.id = booking_global.user_id');
		$this->db->where_in('booking_global.booking_status', [0,1,2,3,4,5,6]);
		        ;
        $this->db->order_by('register.id', 'ASC');
        $this->db->group_by('booking_global.user_id');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        // print_r($this->db->last_query());exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }


     public function get_all_active_users($keyword,$user_id ="")
    {

	

    	$this->db->where('status', 1);
    	if($keyword){
    		$this->db->group_start();
    		$this->db->like('register.first_name', $keyword);
    		$this->db->or_like('register.last_name', $keyword);
    		$this->db->or_like('register.email', $keyword);
    		$this->db->group_end();
    	}
    	if($user_id){
    		$this->db->where_in("register.id",explode(",",$user_id));	
    	}
    	$this->db->where("register.store_id","13");
    	$this->db->limit(10);
        $this->db->select('register.id as id,CONCAT(register.first_name," ",register.last_name," " ,register.email )as text')
		        ->from('register');

        //$this->db->order_by('register.id', 'DESC');
        //$this->db->limit(100);
        $query = $this->db->get(); 
        //echo $this->db->last_query();die;
        return $query;
    }


    public function get_customer_data($search ="",$where_array = array(),$row_per_page="",$row_no="")
    {
    	

    	if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}	

		if (!empty($search)) {
			if($search['from_date'] != ""){
				 $this->db->where('DATE(register.created_date) >= ', $search['from_date']);
			}
		}
		if (!empty($search)) {
			if($search['to_date'] != ""){

				$this->db->where('DATE(register.created_date) <= ',$search['to_date']);
			}
		}

		if (!empty($search)) {
			if($search['customer_name'] != ""){
				 $this->db->like('register.first_name', $search['customer_name']);
				 $this->db->or_like('register.last_name', $search['customer_name']);
			}
		}


		if (!empty($search)) {
			if($search['status_type'] != ""){
				$this->db->where_in('register.status',$search['status_type']);
			}
		}


		if (!empty($search)) {
			if($search['country'] != ""){
				$this->db->where_in('countries.id',$search['country']);
			}
		}

        $this->db->select('register.*,countries.sortname,states.name as state_name,countries.name as country_name')
		        ->from('register')
		        ->join('countries', 'countries.id = register.country')
				->join('states', 'states.id = register.state');

        $this->db->order_by('register.id', 'DESC');

		if($row_per_page)
			$this->db->limit($row_per_page, $row_no);


        //$this->db->limit(100);
        $query = $this->db->get(); 

		// if($row_per_page)
       	// 	echo $this->db->last_query();die;
        return $query;
    }
    
    public function get_tournaments()
    {

        $this->db->select('tournament.t_id as id,tl.tournament_name')
		        ->from('tournament')
		        ->join('tournament_lang as  tl', 'tl.tournament_id = tournament.t_id', 'left')
		        ->where('tl.tournament_name is NOT NULL', NULL, FALSE)
        		->order_by('tl.tournament_name', 'ASC')
       			->group_by('tournament.t_id');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        // print_r($this->db->last_query());exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

      public function get_matches_seller($tournament,$seller_ids = array()) {
        

        $this->db->select("booking_tickets.match_name,booking_tickets.match_id as id");
        $this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id', 'left');
        $this->db->where('booking_tickets.tournament_id', $tournament);
        $this->db->where_in('booking_global.seller_id', $seller_ids);
        $this->db->where_in('booking_global.booking_status', [1,4,5,6]);
        $this->db->order_by('booking_tickets.match_name', 'ASC');
        $this->db->group_by('booking_tickets.match_id');
        $result = $this->db->get('booking_tickets');

        return $result->result();
    }

    public function get_matches_ajax($tournament)
    {
    	if($tournament){
    		$this->db->where('match_info.tournament',$tournament);
    	}
        $this->db->select('match_info.m_id as id,ml.match_name')
		        ->from('match_info')
		        ->join('match_info_lang as  ml', 'ml.match_id = match_info.m_id', 'left')
	
        		->order_by('ml.match_name', 'ASC')
       			->group_by('match_info.m_id');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
       // print_r($this->db->last_query());exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }

	public function get_sellers()
    {

        $this->db->select('admin_details.*,admin_details.admin_id as user_id,address_details.*, countries.name as country_name,cities.name as city_name,admin_role.admin_role_id,admin_role.admin_role_name,admin_bank_details.*')->from('admin_details')->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('countries', 'countries.id = address_details.country', 'left')->join('cities', 'cities.id = address_details.city', 'left')->join('admin_role_details', 'admin_role_details.admin_id = admin_details.admin_id', 'left')->join('admin_role', 'admin_role.admin_role_id = admin_role_details.admin_roles_id', 'left')->join('admin_bank_details', 'admin_bank_details.admin_id = admin_details.admin_id', 'left')->where_in('admin_role_details.admin_roles_id', [1,6]);
        $this->db->order_by('admin_details.admin_id', 'DESC');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        // print_r($this->db->last_query());exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return '';
        }
    }


	function get_settings_value($type, $type_name = '', $field = 'settings_value')
	{
		if ($type_name != '') {
			return $this->db->get_where($type, array('settings_name' => $type_name))->row()->$field;
		}
	}


	public function getAllItemTable($table, $colum = '', $id = '', $orderColumn = '', $orderby = '')
	{ 
		if ($colum != "") {
			$this->db->where($colum, $id);
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$query = $this->db->get($table);
		return $query;
	}
	public function getAllItemTable_array($table, $column_array = array(), $statusColum = '', $orderColumn = '', $orderby = '')
	{
		foreach ($column_array as $columnkey => $column) {
			$this->db->where($columnkey, $column);
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$query = $this->db->get($table);
		return $query;
	}
	function update_table($table, $colid, $idval, $uvalue)
	{
		$this->db->where($colid, $idval);
		$dbquery = $this->db->update($table, $uvalue);
		//echo $this->db->last_query();exit;
		if ($this->db->affected_rows() > 0) return true;
		else return false;
	}

	function update_table_v1($table, $wheres, $uvalue)
	{
		foreach($wheres as $whkey => $where){
		 $this->db->where($whkey, $where);
		}
		if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where($table.'.add_by',$this->session->userdata('admin_id'));
        }
		$dbquery = $this->db->update($table, $uvalue);
		//echo $this->db->last_query();exit;
		if ($this->db->affected_rows() > 0) return true;
		else return false;
	}

	function insert_data($table, $insert_data)
	{
		$this->db->insert($table, $insert_data);
		$last_insert_id = $this->db->insert_id();
		return $last_insert_id;
	}
	function delete_multiple_data($id)
	{
		$this->db->delete('admin_login_details', array('admin_id' => $id));
		$this->db->delete('admin_bank_details', array('admin_id' => $id));
		$this->db->delete('admin_role_details', array('admin_id' => $id));
		$this->db->delete('admin_details', array('admin_id' => $id));
		if ($this->db->affected_rows() >= '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function delete_match_data($match_id)
	{

		$this->db->delete('match_info', array('m_id' => $match_id));
		$this->db->delete('match_info_lang', array('match_id' => $match_id));
		if ($this->db->affected_rows() >= '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function delete_data($table, $col, $val)
	{
		$this->db->where($col, $val);
		$this->db->delete($table);
		if ($this->db->affected_rows() == '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function delete($table, $where = array())
	{
		foreach ($where as $wherekey => $where_data) {
			$this->db->where($wherekey, $where_data);
		}
		$this->db->delete($table);
		if ($this->db->affected_rows() == '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_side_bar_menu_v1($group = '', $where = '', $module = '')
	{
		
		if ($this->session->userdata('admin_id') != ADMIN_ID && $this->session->userdata('admin_id') != ACCOUNT_ID) {
			$sub_admin_id = $this->session->userdata('admin_id');
			$this->db->where('admin_role_details.admin_id', $sub_admin_id);
			if ($where != '') {
				$this->db->where('privilege_title', $where);
			}
			if ($module != '') {
				$this->db->where('privilege_module', $module);
			}
			$this->db->where('privilege_functions.menu_status', 'ACTIVE');
			$this->db->where('privilege_functions.menu_visible', '1');
			$this->db->join('privilege_admin_roles', 'privilege_admin_roles.admin_role_id = admin_role_details.admin_roles_id', 'right');
			$this->db->join('privilege_actions', 'privilege_actions.privilege_id = privilege_admin_roles.privilege_id', 'right');
			$this->db->join('privilege_functions', 'privilege_functions.privilege_functions_id = privilege_actions.privilege_functions_id', 'left');
			if ($group != '') {
				$this->db->group_by($group);
			}
			if ($group == 'privilege_module') {
				$this->db->order_by('sorting_by_2', 'ASC');
			} else if ($group == 'privilege_title') {
				$this->db->order_by('sorting_by', 'ASC');
			} else {
				$this->db->order_by('sorting_by_3', 'ASC');
			}
			$query = $this->db->get('admin_role_details');
				

			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return '';
			}
		} else {
			if ($where != '') {
				$this->db->where('privilege_title', $where);
			}
			if ($module != '') {
				$this->db->where('privilege_module', $module);
			}
			$this->db->where('privilege_functions.menu_status', 'ACTIVE');
			$this->db->where('privilege_functions.menu_visible', '1');
			if ($group != '') {
				$this->db->group_by($group);
			}
			if ($group == 'privilege_module') {
				$this->db->order_by('sorting_by_2', 'ASC');
			} else if ($group == 'privilege_title') {
				$this->db->order_by('sorting_by', 'ASC');
			} else {
				$this->db->order_by('sorting_by_3', 'ASC');
			}
			$query = $this->db->get('privilege_functions');

			//echo "</pre>"; print_r($this->db->last_query());exit;
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return '';
			}
		}
	}
	function fetch_country_list()
	{
		$select = "SELECT * FROM countries";
		$query = $this->db->query($select);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_user_roles()
	{
		$select = "SELECT * FROM admin_role WHERE status = 'ACTIVE'";
		$query = $this->db->query($select);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_admin_details($admin_id)
	{
		// print_r($_SESS);
		/* $this->db->select('admin_details.*,address_details.*,admin_login_details.admin_type_id, countries.name,admin_bank_details.*')->from('admin_details')->where('admin_details.admin_id', $admin_id)->where('admin_status', 'ACTIVE')
        ->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('countries', 'countries.id = address_details.country', 'left')->join('admin_bank_details', 'admin_bank_details.admin_id = admin_details.admin_id', 'left');
        $query = $this->db->get();*/
		$this->db->select('admin_details.*,admin_details.admin_id as user_id,address_details.*, countries.name as country_name,cities.name as city_name,admin_role.admin_role_id,admin_role.admin_role_name,admin_bank_details.*,admin_details.currency as seller_currency')->from('admin_details')->where('admin_details.admin_id', $admin_id)->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('countries', 'countries.id = address_details.country', 'left')->join('cities', 'cities.id = address_details.city', 'left')->join('admin_role_details', 'admin_role_details.admin_id = admin_details.admin_id', 'left')->join('admin_role', 'admin_role.admin_role_id = admin_role_details.admin_roles_id', 'left')->join('admin_bank_details', 'admin_bank_details.admin_id = admin_details.admin_id', 'left');
		$this->db->order_by('admin_details.admin_id', 'DESC');
		$query = $this->db->get();
		// print_r($this->db->last_query());exit;
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return '';
		}
	}
	public function get_admin_details_by_role($role_id, $status = '')
	{

		$this->db->select('admin_details.*,admin_details.admin_id as user_id,address_details.*, countries.name as country_name,cities.name as city_name,admin_role.admin_role_id,admin_role.admin_role_name,admin_bank_details.*')->from('admin_details')->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('countries', 'countries.id = address_details.country', 'left')->join('cities', 'cities.id = address_details.city', 'left')->join('admin_role_details', 'admin_role_details.admin_id = admin_details.admin_id', 'left')->join('admin_role', 'admin_role.admin_role_id = admin_role_details.admin_roles_id', 'left')->join('admin_bank_details', 'admin_bank_details.admin_id = admin_details.admin_id', 'left');
		$this->db->group_start();
		$this->db->where('admin_role_details.admin_roles_id', $role_id)->or_where('admin_role_details.admin_roles_id', 6);
		$this->db->group_end();
		if ($status != '') {
			$this->db->group_start();
			$this->db->where('admin_details.admin_status', 'ACTIVE');
			$this->db->group_end();
		}
		$this->db->order_by('admin_details.admin_id', 'DESC');
		$query = $this->db->get();
		// if($_SERVER['HTTP_TRUE_CLIENT_IP'] == "106.206.8.185"){
		// 	//print_r($this->db->last_query());exit;
		// }
		// 
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}

	public function get_cart_data($cart_id)
	{
		$this->db->select('cart_session.*,
                                    match_info.*,
                                    match_info_lang.match_name,
                                    sell_tickets.*,            
                                    tl.tournament_name,
                                    stadium.stadium_name,
                                    stadium.stadium_image,
                                    states.name as state_name,
                                    countries.name as country_name,
                                    stadium_seats_lang.seat_category,
                                    team_a.team_image as team_image_a,
                                    team_b.team_image as team_image_b')
			->from('cart_session')
			->join('sell_tickets', 'sell_tickets.s_no = cart_session.sell_id', 'left')
			->join('match_info', 'match_info.m_id = cart_session.match_id', 'left')
			->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')
			->join('teams as team_a', 'team_a.id = match_info.team_1', 'left')
			->join('teams as team_b', 'team_b.id = match_info.team_2', 'left')
			->join('tournament', 'tournament.t_id = match_info.tournament', 'left')
			->join('tournament_lang as  tl', 'tl.tournament_id = tournament.t_id', 'left')
			->join('stadium', 'stadium.s_id = match_info.venue', 'left')
			->join('states', 'states.id = match_info.state', 'left')
			->join('countries', 'countries.id = match_info.country', 'left')
			->join('stadium_seats', 'stadium_seats.id = sell_tickets.ticket_category', 'left')
			->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_seats.id', 'left')
			->where('stadium_seats_lang.language', 'en')
			->where('tl.language', 'en')
			->where('match_info_lang.language', 'en')
			->where('cart_session.id', $cart_id);
		$query = $this->db->get();
		return $query;
	}
	public function get_user_details($role="")
	{
		$this->db->select('admin_details.*,address_details.*, countries.name as country_name,cities.name as city_name,admin_role.admin_role_id,admin_role.admin_role_name')->from('admin_details')->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('countries', 'countries.id = address_details.country', 'left')->join('cities', 'cities.id = address_details.city', 'left')->join('admin_role_details', 'admin_role_details.admin_id = admin_details.admin_id', 'left')->join('admin_role', 'admin_role.admin_role_id = admin_role_details.admin_roles_id', 'left');
		if(!empty($role)){
			$this->db->where('admin_role.admin_role_id', $role);
		}
		$this->db->order_by('admin_details.admin_id', 'DESC');
		$query = $this->db->get();
		return $query;
	}
	public function check_admin_password($password)
	{
		$password = (md5($password));
		$aa = "SELECT admin_id FROM admin_login_details WHERE admin_password='$password' AND admin_id='" . $this->session->userdata('admin_id') . "'";
		$query = $this->db->query($aa); //echo $this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}
	function update_admin_password($password = '', $admin_id)
	{
		if (!empty($password)) {
			$data['admin_password'] = md5($password);
			$where = "admin_id = " . $admin_id;
			if ($this->db->update('admin_login_details', $data, $where)) {
				//echo $this-> db->last_query();exit;
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	function update_admin_address($update_data_address, $address_details_id)
	{
		// echo "<pre>";print_r($update_data_address);exit;
		$this->db->where('address_details_id', $address_details_id);
		$this->db->update('address_details', $update_data_address);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_admin_details($update, $admin_id)
	{
		$this->db->where('admin_id', $admin_id);
		$this->db->update('admin_details', $update);
		//echo $this->db->last_query();exit;
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function activate_functions($data)
	{
		$status = false;
		$this->db->where("privilege_id != ", 0);
		$this->db->delete('privilege_actions');
		//echo "<pre>"; var_dump($privilege_details); exit;
		if (count($data) > 0) {
			if ($this->db->insert_batch("privilege_actions", $data)) {
				$status = true;
			}
		}
		return $status;
	}

	

	function get_seller_notes($ticket_details_id)
	{ 
		$this->db->select('id,ticket_name,ticket_image');
		$this->db->where('language', $this->session->userdata('language_code'));
		$this->db->where_in('ticket_details_id',explode(',',$ticket_details_id));
		$query = $this->db->get('ticket_details_lang');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}

	function get_privilege_functions()
	{
		$this->db->select('*');
		$query = $this->db->get('privilege_functions');
		// echo $this->db->last_query(); die();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}
	function get_privilege_active_functions()
	{
		//$this->db->where("privilege_id",$privilege_id);
		$this->db->select('privilege_actions.privilege_id,privilege_actions.privilege_functions_id');
		$query = $this->db->get('privilege_actions');
		// echo $this->db->last_query(); die();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function get_currency_types($column, $currency_code)
	{
		$this->db->select('*');
		$this->db->where($column, $currency_code);
		$this->db->where("store_id", $this->session->userdata('storefront')->admin_id);
		$query = $this->db->get('currency_types');
		return $query;
	}


	public function get_match_tournments() {
        

        $this->db->select("match_info.*,tournament_lang.tournament_name,DATE_FORMAT(match_date,'%d %M %Y') as match_date_format,match_info_lang.match_id,match_info_lang.match_name,sell_tickets.s_no");
        $this->db->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
        $this->db->join('tournament_lang', 'tournament_lang.tournament_id = match_info.tournament', 'left');
		$this->db->join('sell_tickets', 'sell_tickets.match_id = match_info.m_id', 'left');
        $this->db->where('match_info.match_date >= ', date("Y-m-d H:i:s"));
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
        $this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
         $this->db->where('match_info.status', '1');
         $this->db->where('sell_tickets.status', 1);
        $this->db->order_by('match_info.match_date', 'ASC');
        $this->db->group_by('match_info.m_id');

        // echo $this->db->last_query();die;
        $result = $this->db->get('match_info');

        return $result->result();
    }

    public function get_match_by_tournments() {
        

        $this->db->select("match_info.*,tournament_lang.tournament_name,DATE_FORMAT(match_date,'%d %M %Y') as match_date_format,match_info_lang.match_id,match_info_lang.match_name,sell_tickets.s_no");
        $this->db->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
        $this->db->join('tournament_lang', 'tournament_lang.tournament_id = match_info.tournament', 'left');
		$this->db->join('sell_tickets', 'sell_tickets.match_id = match_info.m_id', 'left');
        $this->db->where('match_info.match_date >= ', date("Y-m-d H:i:s"));
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
        $this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
         $this->db->where('match_info.status', '1');
         $this->db->where('sell_tickets.status', 1);
        $this->db->order_by('tournament_lang.tournament_name', 'ASC');
        $this->db->order_by('match_info_lang.match_name', 'ASC');
        $this->db->group_by('match_info.m_id');

        // echo $this->db->last_query();die;
        $result = $this->db->get('match_info');

        return $result->result();
    }


	public function get_matches($match_id = '', $match_held = '', $row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', $where_array = array(), $search = '',$tournament_id="")
	{ 

		$select = 'match_info.*,s1.s_no,match_info.status as match_status,tournament_lang.*,match_info_lang.*,teams_lang.*,admin_details.*,tournament.url_key,match_info_lang.meta_title as meta_title,match_info_lang.meta_description as meta_description,st.stadium_name,(SUM(s1.quantity 
			 )  + SUM(s1.sold) ) as box_quantity,s1.sold';
	
		$this->db->select($select)
				->from('match_info')
				->join('tournament_lang', 'tournament_lang.tournament_id = match_info.tournament', 'left')
				->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')
				->join('teams_lang', 'teams_lang.team_id = match_info.hometown AND teams_lang.language = "'.$this->session->userdata('language_code').'"', 'left')
				->join('admin_details', 'admin_details.admin_id = match_info.add_by', 'left');
		$this->db->join('sell_tickets s1', 's1.match_id = match_info.m_id AND s1.source_type = "1boxoffice" ', 'left');
	
		$this->db->join('tournament', 'tournament.t_id = match_info.tournament', 'left');
		$this->db->join('stadium st', 'st.s_id = match_info.venue', 'left');
		$this->db->where('match_info.event_type', 'match');
		$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
		$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
		//$this->db->where('teams_lang.language', $this->session->userdata('language_code'));
		if ($tournament_id != '') {
			$this->db->where('tournament.t_id', $tournament_id);
		}
		//$match_held = "upcoming";
		if ($match_held == 'upcoming') {
			$this->db->where('match_info.match_date > ', date("Y-m-d H:i"));
			$this->db->order_by('match_info.match_date', 'ASC');
			$this->db->where('match_info.status != ', '2');
			$this->db->where('match_info.status != ', '3');
		}
		if ($match_held == 'expired') {
			$this->db->where('match_info.match_date < ', date("Y-m-d H:i"));
			$this->db->order_by('match_info.match_date', 'DESC');
			$this->db->where('match_info.status != ', '2');
			$this->db->where('match_info.status != ', '3');
		}
		if ($match_held == 'trashed') {
			$this->db->where('match_info.status', '2');
			$this->db->where('match_info.status', '3');
		}
		if(@$search['only']  == 'tixstock'){
			$this->db->where('match_info.tixstock_id is NOT NULL', NULL, FALSE);
			//$this->db->where('match_info.source_type', 'tixstock');
		}
		else{
			//$this->db->where('match_info.source_type', '1boxoffice');
		}

		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}

		if ($match_id != '') {
			$this->db->where('match_info.m_id', $match_id);
		}

		if ($row_per_page != '' && $row_no >= 0) {
			$this->db->limit($row_per_page, $row_no);
		}
		if ($search != '') {

			if(@$search['match_ids']){
				$this->db->where_in('match_info.m_id', $search['match_ids']);
			}
			if(@$search['stadium_ids']){
				$this->db->where_in('match_info.venue', $search['stadium_ids']);
			}
			if(@$search['tournament_ids']){
				$this->db->where_in('match_info.tournament', $search['tournament_ids']);
			}
			if(@$search['statuss']){
				$this->db->where_in('match_info.status', $search['statuss']);
			}
			if(@$search['from_date'] && @$search['to_date']){
				//$this->db->where('match_info.match_date', $search['from_date']);


				$this->db->where('DATE(match_info.match_date) >=', $search['from_date']);
				$this->db->where('DATE(match_info.match_date) <=', $search['to_date']);

			}
			
			
			// $this->db->like('match_info_lang.match_name', $search);
			// //$this->db->or_like('teams_lang.team_name', $search);
			// $this->db->or_like('tournament_lang.tournament_name', $search);
		}
		$this->db->group_by('match_info.m_id');
		//$this->db->limit(10);
		$query = $this->db->get();
		// echo "<prE>";
		// print_r($query->result());die;
		//echo $this->db->last_query();exit;
		return $query;
	}


	public function get_stadium_matches($match_id = '', $match_held = '', $row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', $where_array = array(), $search = '',$stadium_id="")
	{ 

		$this->db->select('match_info.*,sell_tickets.s_no,match_info.status as match_status,tournament_lang.*,match_info_lang.*,teams_lang.*,admin_details.*,tournament.url_key,match_info_lang.meta_title as meta_title,match_info_lang.meta_description as meta_description,st.stadium_name')->from('match_info')->join('tournament_lang', 'tournament_lang.tournament_id = match_info.tournament', 'left')->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')->join('teams_lang', 'teams_lang.team_id = match_info.hometown', 'left')->join('admin_details', 'admin_details.admin_id = match_info.add_by', 'left');
		$this->db->join('sell_tickets', 'sell_tickets.match_id = match_info.m_id', 'left');
		$this->db->join('tournament', 'tournament.t_id = match_info.tournament', 'left');
		$this->db->join('stadium st', 'st.s_id = match_info.venue', 'left');
		$this->db->where('match_info.event_type', 'match');
		$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
		$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
		$this->db->where('teams_lang.language', $this->session->userdata('language_code'));
		if ($stadium_id != '') {
			$this->db->where('match_info.venue', $stadium_id);
		}
			$this->db->order_by('match_info.match_date', 'ASC');
			$this->db->where('match_info.status != ', '2');
			//$this->db->where('match_info.status != ', '3');
		

		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}

		if ($match_id != '') {
			$this->db->where('match_info.m_id', $match_id);
		}
		$this->db->where('match_info.match_date >= ', date("Y-m-d H:i:s"));
		if ($row_per_page != '' && $row_no >= 0) {
			$this->db->limit($row_per_page, $row_no);
		}
		if ($search != '') {
			$this->db->like('match_info_lang.match_name', $search);
			$this->db->or_like('st.stadium_name', $search);
			$this->db->or_like('tournament_lang.tournament_name', $search);
		}
		$this->db->group_by('match_info.m_id');

		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query;
	}

	public function get_matches_lang($match_id)
	{

		$this->db->select('match_info.*,match_info_lang.meta_title as meta_title,match_info_lang.meta_description as meta_description')->from('match_info')->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
		$this->db->where('match_info_lang.match_id', $match_id);
		$query = $this->db->get();
		return $query;
	}

	public function get_event()
	{

		$this->db->select('match_info.*,match_info.status as match_status,match_info_lang.*')->from('match_info')->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
		$this->db->where('match_info.event_type', 'match');
		$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
		$this->db->order_by('match_info.match_date', 'ASC');

		$query = $this->db->get();
		return $query;
	}

	public function get_match_list() {
        

        $this->db->select("match_info.*,tournament_lang.tournament_name,DATE_FORMAT(match_date,'%d %M %Y') as match_date_format,match_info_lang.match_id,match_info_lang.match_name");
        $this->db->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
        $this->db->join('tournament_lang', 'tournament_lang.tournament_id = match_info.tournament', 'left');
        $this->db->where('match_info.match_date >= ', date("Y-m-d H:i:s"));
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
        $this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
        $this->db->order_by('match_info.match_date', 'ASC');
        $this->db->group_by('match_info.m_id');

        // echo $this->db->last_query();die;
        $result = $this->db->get('match_info');

        return $result->result();
    }



	public function get_stadium()
	{

		$this->db->select('stadium.*')->from('stadium');
		$this->db->where('stadium.status', '1');
		$this->db->order_by('stadium.s_id', 'DESC');
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


	public function get_stadium_id($s_id)
	{
		$this->db->where('stadium.s_id',$s_id);
		$this->db->where('stadium.source_type','1boxoffice');
		$this->db->select('stadium.*')->from('stadium');

		$query = $this->db->get();
		return $query;
	}

	public function get_block_stadium($s_id)
	{
		$this->db->where('stadium_details.stadium_id',$s_id);
		$this->db->select('stadium_details.*,SUBSTRING_INDEX(stadium_details.block_id, "-", -1) as block_id2 ,stadium_seats_lang.seat_category')->from('stadium_details');
		$this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_details.category AND language ="en"', 'left');;
		$this->db->order_by('stadium_details.block_id', 'ASC');
		$query = $this->db->get();
		return $query;
	}


	// public function get_sell_tickets($s_id)
	// {
		
	// 	$this->db->select('sell_tickets.*')->from('sell_tickets');
		
	// 	$this->db->join('match_info', 'match_info.m_id = sell_tickets.match_id', 'left');
	// 	$this->db->join('stadium_details', 'stadium_details.id = sell_tickets.ticket_block', 'LEFT');
	// 	$this->db->where('match_info.venue',$s_id);
	// 	$query = $this->db->get();
	// 	return $query;
	// }


	public function get_category_stadium($s_id,$category_id="",$all="")
	{
		if($all == ""){
			if($category_id){
				$this->db->where('stadium_details.category',$category_id);
			}
			else{
				$this->db->group_by('stadium_details.category');
			}
		}
		$this->db->where('stadium_details.stadium_id',$s_id);
		$this->db->select('stadium_details.*,SUBSTRING_INDEX(stadium_details.block_id, "-", -1) as block_id2 ,stadium_seats_lang.seat_category')->from('stadium_details');
		$this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_details.category AND language ="en"', 'left');
		$this->db->order_by('stadium_details.block_id', 'ASC');
		$this->db->where('stadium_details.source_type','1boxoffice');
		$query = $this->db->get();
		return $query;
	}



	public function get_teams()
	{

		$this->db->select('teams.*,teams_lang.*')->from('teams')->join('teams_lang', 'teams_lang.team_id = teams.id', 'left');
		$this->db->where('teams.status',1);
		$this->db->where('teams_lang.language', $this->session->userdata('language_code'));
		$this->db->order_by('teams.id', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	public function get_tournments()
	{

		$this->db->select('tournament.*,tournament_lang.*')->from('tournament')->join('tournament_lang', 'tournament_lang.tournament_id = tournament.t_id', 'left');
		$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
		$this->db->order_by('tournament.t_id', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	public function get_tournments_v1($tournament_id)
	{

		$this->db->select('tournament.*,tournament_lang.*,tournament_settings.*,tournament.status as tournament_status')->from('tournament')->join('tournament_lang', 'tournament_lang.tournament_id = tournament.t_id', 'left')->join('tournament_settings', 'tournament_settings.tournaments = tournament.t_id', 'left');
		$this->db->where('tournament.t_id', $tournament_id);
		$this->db->order_by('tournament.t_id', 'DESC');
		$query = $this->db->get();
		return $query;
	}


	public function get_tournments_matches($tournament_id)
	{

		$this->db->select('match_info.*,match_info_lang.*,match_settings.*,match_info.status as match_status,match_info_lang.description as description,match_info_lang.meta_title as meta_title,match_info_lang.meta_description as meta_description')->from('match_info')
		->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')
		->join('match_settings', 'match_settings.matches = match_info.m_id', 'left');
		$this->db->where('match_info.tournament', $tournament_id);
		$query = $this->db->get();
		return $query;
	}

	public function seller_list($match_id)
	{

		$this->db->select('admin_details.*')
				->from('sell_tickets')
				->join('admin_details', 'admin_details.admin_id = sell_tickets.user_id', 'left');
		$this->db->where('sell_tickets.match_id', $match_id);
		$this->db->where('sell_tickets.status', 1);
		$this->db->where('sell_tickets.quantity > ', 0);
		$this->db->order_by('admin_details.admin_name', 'ASC');
		$this->db->group_by('admin_details.admin_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		return $query->result();
	}

	function update($table, $where = array(), $uvalue)
	{
		foreach ($where as $wherekey => $where_data) {
			$this->db->where($wherekey, $where_data);
		}
		$dbquery = $this->db->update($table, $uvalue);
		if ($this->db->affected_rows() > 0) return true;
		else return false;
	}

	public function getid($table, $where = array())
	{

		if ($table == 'booking_tickets') {

			$this->db->select('booking_tickets.bt_id')->from('booking_tickets')->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id', 'left');
			foreach ($where as $wherekey => $where_data) {
				$this->db->where($wherekey, $where_data);
			}
			$this->db->order_by('booking_tickets.bt_id', 'DESC');
		}
		else if ($table == 'tournament') {

			$this->db->select('tournament.*,tournament_lang.*')->from('tournament')->join('tournament_lang', 'tournament_lang.tournament_id = tournament.t_id', 'left');
			foreach ($where as $wherekey => $where_data) {
				$this->db->where($wherekey, $where_data);
			}
			$this->db->order_by('tournament.t_id', 'DESC');
		} else if ($table == 'match_settings') {

			$this->db->select('match_settings.*')->from('match_settings');
			foreach ($where as $wherekey => $where_data) {
				$this->db->where($wherekey, $where_data);
			}
			$this->db->order_by('match_settings.mid', 'DESC');
		}
		else if ($table == 'tournament_settings') {

			$this->db->select('tournament_settings.*')->from('tournament_settings');
			foreach ($where as $wherekey => $where_data) {
				$this->db->where($wherekey, $where_data);
			}
			$this->db->order_by('tournament_settings.tid', 'DESC');
		} else if ($table == 'teams') {

			$this->db->select('teams.*,teams_lang.*')->from('teams')->join('teams_lang', 'teams_lang.team_id = teams.id', 'left');
			foreach ($where as $wherekey => $where_data) {
				$this->db->where($wherekey, $where_data);
			}
			$this->db->order_by('teams.id', 'DESC');
		} else if ($table == 'match_info') {

			$this->db->select('match_info.*')->from('match_info');
			foreach ($where as $wherekey => $where_data) {

				if ($wherekey == 'matchid_not') {
					$this->db->where('m_id != ', $where_data);
				} else {
					$this->db->where($wherekey, $where_data);
				}
			}
			$this->db->order_by('match_info.m_id', 'DESC');
		} else if ($table == 'stadium') {

			$this->db->select('stadium.*')->from('stadium');
			foreach ($where as $wherekey => $where_data) {
				$this->db->where($wherekey, $where_data);
			}
			$this->db->order_by('stadium.s_id', 'DESC');
		} else if ($table == 'states') {

			$this->db->select('states.*')->from('states');
			foreach ($where as $wherekey => $where_data) {
				$this->db->where($wherekey, $where_data);
			}
			$this->db->order_by('states.id', 'DESC');
		}

		$query = $this->db->get();
		return $query;
	}

	public function get_state_cities($country_id)
	{

		$this->db->select('states.id')->from('states');
		$this->db->where('states.country_id', $country_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$state_data =  $query->result();
			$city_array = array();
			foreach ($state_data as $state) {

				$this->db->select('cities.*')->from('cities');
				$this->db->where('cities.state_id', $state->id);
				$query1 = $this->db->get();
				$city_datas = $query1->result();
				foreach ($city_datas as $city_data) {
					$city_array[] = $city_data;
				}
			}
			return $city_array;
		} else {
			return false;
		}
		return $query;
	}
	/**
	 * @desc Return record count from a table
	 */
	function get_table_row_count($table, $where_array = array())
	{
		$count = 0;
		if ($table == "currency_types") {
			$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
		}
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
			$query = $this->db->get($table);
			$count = $query->num_rows();
		} else {
			$count = $this->db->count_all($table);
		}
		return $count;
	}

	/**
	 * @desc Return record count from a table
	 */
	function get_table_row_count_markup($role)
	{


		$this->db->select('tickets_markup.*,admin_details.*,admin_role_details.*')->from('tickets_markup')->join('admin_details', 'admin_details.admin_id = tickets_markup.user_id', 'left')->join('admin_role_details', 'admin_role_details.admin_id = tickets_markup.user_id', 'left');
		if ($role != '') {
			$this->db->where('admin_role_details.admin_roles_id', $role);
		}
		$this->db->where('tickets_markup.store_id', $this->session->userdata('storefront')->admin_id);
		$this->db->order_by('tickets_markup.id', 'DESC');
		return $query = $this->db->get();
	}

	/**
	 * @desc Get data based on the count, limit
	 */

	public function get_limit_based_data_markup($table, $row_no, $row_per_page, $orderColumn = '', $orderby = '', $role)
	{


		$this->db->select('tickets_markup.*,tickets_markup.status as tickets_markup_status,admin_details.*,admin_role_details.*')->from('tickets_markup')->join('admin_details', 'admin_details.admin_id = tickets_markup.user_id', 'left')->join('admin_role_details', 'admin_role_details.admin_id = tickets_markup.user_id', 'left');
		$this->db->where('tickets_markup.store_id', $this->session->userdata('storefront')->admin_id);
		if ($role != '') {
			$this->db->where('admin_role_details.admin_roles_id', $role);
		}
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$this->db->limit($row_per_page, $row_no);
		return $query = $this->db->get();
	}

	public function get_limit_based_data($table, $row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array())
	{
		$this->db->select('*');
		$this->db->from($table);
		if ($table == "currency_types") {
			$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
		}
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$this->db->limit($row_per_page, $row_no);
		$query = $this->db->get();
		return $query;
	}

	public function get_limit_based_data_search($table, $row_no, $row_per_page, $orderColumn = '', $orderby = '',$fromDate='',$toDate='',$coupon_type,$status_type)
	{
		$this->db->select('*');
		$this->db->from($table);
		if ($table == "currency_types") {
			$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
		}
		// if (!empty($where_array)) {
		// 	foreach ($where_array as $columnkey => $value) {
		// 		$this->db->where($columnkey, $value);
		// 	}
		// }
		
		if ($fromDate != "") {
			$this->db->where('DATE_FORMAT(coupon_code.expiry_date,"%Y-%m-%d") >= ',$fromDate);
		}

		if ($toDate != "") {
			$this->db->where('DATE_FORMAT(coupon_code.expiry_date,"%Y-%m-%d") <= ',$toDate);
		}

		if(!empty($coupon_type)){

			 $comma_separated = implode("', '", $coupon_type);
			 
			//$comma_separated = implode("', '", $array);
			$this->db->where_in('coupon_code.coupon_type',$comma_separated);
		}


		if(!empty($status_type)){

			$comma_separated = implode("', '", $status_type);
			
		   //$comma_separated = implode("', '", $array);
		   $this->db->where_in('coupon_code.status',$comma_separated);
	   }

		//$this->db->where($columnkey, $value);

		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$this->db->limit($row_per_page, $row_no);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;
	}
	public function get_user_details_by_limit($row_no="", $row_per_page="",$role="",$search="")
	{
		$this->db->select('admin_details.*,address_details.*, countries.name as country_name,cities.name as city_name,admin_role.admin_role_id,admin_role.admin_role_name,admin_bank_details.*')->from('admin_details')->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('countries', 'countries.id = address_details.country', 'left')->join('cities', 'cities.id = address_details.city', 'left')->join('admin_role_details', 'admin_role_details.admin_id = admin_details.admin_id', 'left')->join('admin_role', 'admin_role.admin_role_id = admin_role_details.admin_roles_id', 'left');
		$this->db->join('admin_bank_details', 'admin_bank_details.admin_id = admin_details.admin_id', 'left');
		if(!empty($role)){
			$this->db->where('admin_role.admin_role_id', $role);
		}
		$this->db->order_by('admin_details.admin_id', 'DESC');

		if($row_no!="")
		{
			$this->db->limit($row_per_page, $row_no);
		}
		
		if (!empty($search)) {
			if($search['customer_name'] != ""){
				 $this->db->like('admin_details.admin_name', $search['customer_name']);
				 $this->db->or_like('admin_details.admin_last_name', $search['customer_name']);
			}
		}

		if (!empty($search)) {
			if($search['status_type'] != ""){
				//$this->db->where_in('admin_details.admin_status',$search['status_type']);
				isset($search['status_type'][0]) ?  $this->db->like('admin_details.admin_status', str_replace("status","",$search['status_type'][0])) : '';
				isset($search['status_type'][1]) ?  $this->db->or_like('admin_details.admin_status', str_replace("status","",$search['status_type'][1])) : '';
				//$this->db->like('admin_details.admin_status', $search['status_type'][0]);
				//$this->db->or_like('admin_details.admin_status', $search['status_type'][1]);

			}
		}

		if (!empty($search)) {
			if($search['country'] != ""){
				$this->db->where_in('countries.id',$search['country']);
			}
		}

		$query = $this->db->get();

		//echo $this->db->last_query();
		return $query;
	}


	function get_general_settings($store_id, $field = '', $site_code = '')
	{
		$this->db->select('site_settings.*');
		if ($field != '') {
			$this->db->where('site_name', $field);
		}
		if ($site_code != '') {
			$this->db->where('site_code', $site_code);
		}
		$this->db->where('store_id', $store_id);
		$query = $this->db->get('site_settings');
		return $query;
	}

	function update_site_settings($insert_data, $site_code, $store_id)
	{

		$this->db->delete('site_settings', array('store_id' => $store_id, 'site_code' => $site_code));
		$this->db->insert_batch('site_settings', $insert_data);
		return true;
	}

	function update_coupon_status($insert_data, $site_name, $store_id)
	{

		$this->db->where('store_id',$store_id);
		$this->db->where('site_name',$site_name);
		$this->db->update('site_settings', $insert_data);
		return true;
	}


	function getSiteSettings($data = array())
	{
		//echo "<pre>";print_r();exit;
		$this->db->select('id, code, name, setting_type,value_type,int_value,string_value,text_value,created');
		$this->db->where('setting_type', 'S');
		$query = $this->db->get('settings');
		foreach ($query->result() as $row) {
			//Conditions based on value type field
			if ($row->value_type == 'I') {
				$data[$row->code] = $row->int_value;
			} //if End
			if ($row->value_type == 'T') {
				$data[$row->code] = $row->text_value;
			} //if End
			if ($row->value_type == 'S') {
				$data[$row->code] = $row->string_value;
			} //if End 
			if ($row->value_type == 'A') {
				$data[$row->code] = $row->string_value;
			} //if End 
			if ($row->value_type == 'P') {
				$data[$row->code] = $row->string_value;
			} //if End 
			if ($row->value_type == 'N') {
				$data[$row->code] = $row->string_value;
			} //if End 

		} // Foreach End
		return $data;
	}

public function getOrderData_v2()
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as customer_country_name,cities.name as customer_city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,sell_tickets.s_no,booking_tickets.quantity as quantity,booking_tickets.price,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name');
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium', 'stadium.s_id = booking_tickets.stadium_id', 'LEFT');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		$this->db->join('register', 'register.id=booking_global.user_id', 'LEFT');
		$this->db->join('countries', 'countries.id=booking_billing_address.country_id', 'LEFT');
		$this->db->join('cities', 'cities.id=booking_billing_address.state_id', 'LEFT');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->where_in('booking_global.booking_status', [0,1,2,3]);
		//$this->db->or_where('booking_global.booking_status', 2);
		$this->db->order_by('booking_global.bg_id', 'DESC');
		$qry = $this->db->get();
		return $qry;
	}

	public function getOrderData_v2_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search = '')
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as customer_country_name,cities.name as customer_city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,sell_tickets.s_no,booking_tickets.quantity as quantity,booking_tickets.price,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name');
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium', 'stadium.s_id = booking_tickets.stadium_id', 'LEFT');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		$this->db->join('register', 'register.id=booking_global.user_id', 'LEFT');
		$this->db->join('countries', 'countries.id=booking_billing_address.country_id', 'LEFT');
		$this->db->join('cities', 'cities.id=booking_billing_address.state_id', 'LEFT');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->where_in('booking_global.booking_status', [0,1,2,3]);
		//$this->db->or_where('booking_global.booking_status', 2);
		$this->db->order_by('booking_global.bg_id', 'DESC');
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();
		return $qry;
	}

	function updatePaymentSettings($updateData = array())
	{
		//Update
		$data = array('string_value' => $updateData['PAYPAL_GATEWAY']);
		$this->db->where('code', 'PAYPAL_GATEWAY');
		$this->db->update('settings', $data);

		$data = array('string_value' => $updateData['PAYPAL_ID']);
		$this->db->where('code', 'PAYPAL_ID');
		$this->db->update('settings', $data);

		$data = array('string_value' => $updateData['NETWORK_MERCHANT_KEY']);
		$this->db->where('code', 'NETWORK_MERCHANT_KEY');
		$this->db->update('settings', $data);

		$data = array('string_value' => $updateData['NETWORK_MERCHANT_ID']);
		$this->db->where('code', 'NETWORK_MERCHANT_ID');
		$this->db->update('settings', $data);
		return true;
	}

	function updateApiSettings($updateData = array())
	{
		//Update
		$data = array('string_value' => $updateData['FACEBOOK_APP_ID']);
		$this->db->where('code', 'FACEBOOK_APP_ID');
		$this->db->update('settings', $data);

		$data = array('string_value' => $updateData['FACEBOOK_APP_SECRET']);
		$this->db->where('code', 'FACEBOOK_APP_SECRET');
		$this->db->update('settings', $data);

		$data = array('string_value' => $updateData['GOOGLE_CLIENT_ID']);
		$this->db->where('code', 'GOOGLE_CLIENT_ID');
		$this->db->update('settings', $data);

		$data = array('string_value' => $updateData['GOOGLE_CLIENT_SECRET']);
		$this->db->where('code', 'GOOGLE_CLIENT_SECRET');
		$this->db->update('settings', $data);
		return true;
	}

	public function email_logs($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search = '')
	{ 
		$this->db->select('email_logs.*')->from('email_logs');
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$this->db->order_by('email_logs.id', 'DESC');
		if ($search == 'abondaned') {
			$this->db->where('email_logs.email_type', 'Cart Abandoned');
		}
		if ($search == 'tickets') {
			$this->db->where('email_logs.email_type', 'Ticket Available');
		}
		if ($search == 'orders') {
			$this->db->like('email_logs.email_type', 'order');
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_game_category_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search = '')
	{
		$this->db->select('game_category.*,game_category_lang.language,game_category_lang.game_cat_id,game_category_lang.category_name')->from('game_category')->join('game_category_lang', 'game_category_lang.game_cat_id = game_category.id', 'left');
		$this->db->where('game_category_lang.language', $this->session->userdata('language_code'));
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$this->db->order_by('game_category.id', 'DESC');
		if ($search != '') {
			$this->db->like('game_category_lang.category_name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_game_category()
	{
		$this->db->select('game_category.*,game_category_lang.language,game_category_lang.game_cat_id,game_category_lang.category_name')->from('game_category')->join('game_category_lang', 'game_category_lang.game_cat_id = game_category.id', 'left');
		$this->db->where('game_category_lang.language', $this->session->userdata('language_code'));
		$this->db->order_by('game_category_lang.category_name', 'ASC');
		$query = $this->db->get();
		return $query;
	}

	public function top_teams_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{

		$this->db->select('top_league_cups.*,teams_lang.team_name')->from('top_league_cups')->join('teams_lang', 'teams_lang.team_id = top_league_cups.tournament_id', 'left');
		// $this->db->where('top_league_cups.match_type', 'league');
		$this->db->where('teams_lang.language', $this->session->userdata('language_code'));
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('teams_lang.team_name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$this->db->where('top_league_cups.add_by', $this->session->userdata('storefront')->admin_id);
		$query = $this->db->get();
		return $query;
	}

	public function get_teams_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search = '',$seg='')
	{

		$this->db->select('teams.*,sell_tickets.s_no,teams_lang.team_name as team,game_category_lang.category_name')->from('teams')->join('teams_lang', 'teams_lang.team_id = teams.id', 'left')->join('game_category_lang', 'game_category_lang.game_cat_id = teams.category', 'left')
		/*->join('match_info', 'match_info.team_1 = teams.id', 'left')
		->join('match_info mt', 'mt.team_2 = teams.id', 'left')*/
		->join('match_info', 'match_info.team_1 = teams.id OR match_info.team_2 = teams.id', 'left')
		->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')
		->join('sell_tickets', 'sell_tickets.match_id = match_info.m_id', 'left');
		//$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
		$this->db->where('teams_lang.language', $this->session->userdata('language_code'));
		$this->db->where('game_category_lang.language', $this->session->userdata('language_code'));
		$this->db->group_by('teams.id');
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('teams_lang.team_name', $search);
		}
		if ($seg == 'top') {
			$this->db->where('teams.popular_team', 1);
		}
		if ($seg == 'trashed') {
			$this->db->where('teams.status', 2);
		}
		if ($seg == 'untrashed') {
			$this->db->where('teams.status != ', 2);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('teams.tixstock_id is NOT NULL', NULL, FALSE);
		}
		else{
			$this->db->where('teams.source_type', '1boxoffice');
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_team_data($team_id = '')
	{
		$this->db->select('teams.*,teams_lang.team_name as team,teams_lang.page_content,teams_lang.page_title title,teams_lang.meta_description as metdes,teams_lang.team_image as teamImg,teams_lang.team_bg as teambgImg')->from('teams')->join('teams_lang', 'teams_lang.team_id = teams.id', 'left');

		$this->db->where('teams_lang.language', $this->session->userdata('language_code'));


		if ($team_id != '') {
			$this->db->where('teams.id', $team_id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_tournament_data($tournament_id = '')
	{
		$this->db->select('tournament.*,tournament_lang.tournament_name as tournament,tournament_lang.page_title title,tournament_lang.meta_description as metdes,  tournament_lang.page_content as pcontent,tournament_lang.tournament_content_left,   tournament_lang.tournament_content_right')->from('tournament')->join('tournament_lang', 'tournament_lang.tournament_id = tournament.t_id', 'left');
		$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));


		if ($tournament_id != '') {
			$this->db->where('tournament.t_id', $tournament_id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_tournament_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search = '',$seg='')
	{

		$this->db->select('sell_tickets.s_no,tournament.*,tournament_lang.tournament_name as tournament,sell_tickets.*,tournament.status as status')->from('tournament')->join('tournament_lang', 'tournament_lang.tournament_id = tournament.t_id', 'left')->join('match_info', 'match_info.tournament = tournament.t_id', 'left')
		->join('sell_tickets', 'sell_tickets.match_id = match_info.m_id', 'left');
		$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
		$this->db->group_by('tournament_lang.id');
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($search != '') {
			$this->db->like('tournament_lang.tournament_name', $search);
		}
		if ($seg == 'untrashed') {
			$this->db->where('tournament.status != ', 2);
			$this->db->where('tournament.status != ', 3);
		}
		if ($seg == 'trashed') {
			$this->db->where('tournament.status', 2);
			$this->db->where('tournament.status', 3);
		}
		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('tournament.tixstock_id is NOT NULL', NULL, FALSE);
		}
		else{
			$this->db->where('tournament.source_type', '1boxoffice');
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_seat_category_data($cat_id = '')
	{
		$this->db->select('stadium_seats.*,stadium_seats_lang.seat_category as seat')->from('stadium_seats')->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_seats.id', 'left');
		$this->db->where('stadium_seats_lang.language', $this->session->userdata('language_code'));
		if ($cat_id != '') {
			$this->db->where('stadium_seats.id', $cat_id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_stadium_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(),$search)
	{
		$this->db->select('*');
		$this->db->from('stadium');

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('stadium.source_type', 'tixstock');
		}
		else{
			$this->db->where('stadium.source_type', '1boxoffice');
		}
		if ($search != '') {
			$this->db->like('stadium.stadium_name', $search);
			$this->db->or_like('stadium.stadium_name_ar', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_seat_category_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array())
	{
		$this->db->select('stadium_seats.*,stadium_seats_lang.seat_category as seat')->from('stadium_seats')->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_seats.id', 'left');
		$this->db->where('stadium_seats_lang.language', $this->session->userdata('language_code'));
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			//$this->db->order_by($orderColumn, $orderby);
		}
		$this->db->order_by('stadium_seats_lang.seat_category', 'ASC');
		$this->db->limit($row_per_page, $row_no);
		$query = $this->db->get();
		return $query;
	}
	public function get_game_category_data($cat_id = '')
	{
		$this->db->select('game_category.*,game_category_lang.category_name as category')->from('game_category')->join('game_category_lang', 'game_category_lang.game_cat_id = game_category.id', 'left');
		$this->db->where('game_category_lang.language', $this->session->userdata('language_code'));
		if ($cat_id != '') {
			$this->db->where('game_category.id', $cat_id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_state_data($id)
	{
		$this->db->select('states.*,countries.name as country')->from('states')->join('countries', 'countries.id = states.country_id', 'left');
		$this->db->where('states.id', $id);
		$query = $this->db->get();
		return $query;
	}
	public function get_states_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array())
	{
		$this->db->select('states.*,countries.name as country')->from('states')->join('countries', 'countries.id = states.country_id', 'left');
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		$this->db->order_by('states.id', 'DESC');
		$this->db->limit($row_per_page, $row_no);
		$query = $this->db->get();
		return $query;
	}
	public function get_city_data($id)
	{
		$this->db->select('cities.*,countries.name as country, states.name as state')->from('cities')->join('states', 'states.id = cities.state_id', 'left')->join('countries', 'countries.id = states.country_id', 'left');
		$this->db->where('cities.id', $id);
		$query = $this->db->get();
		return $query;
	}

	public function get_city_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		$this->db->select('cities.*,countries.name as country, states.name as state')->from('cities')->join('states', 'states.id = cities.state_id', 'left')->join('countries', 'countries.id = states.country_id', 'left');
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('cities.name', $search);
			$this->db->or_like('countries.name', $search);
			$this->db->or_like('states.name', $search);
		}
		//$this->db->order_by('cities.id', 'DESC');
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_states($country_id)
	{
		$this->db->select('states.id,states.name')->from('states');
		$this->db->where('states.country_id', $country_id);
		$query = $this->db->get();
		return $query;
	}
	public function get_ticket_type_data($ticket_id = '')
	{
		$this->db->select('ticket_types.*,ticket_types_lang.name as tickettype,ticket_types_lang.ticket_description as t_description,ticket_types_lang.ticket_image')->from('ticket_types')->join('ticket_types_lang', 'ticket_types_lang.ticket_type_id = ticket_types.id', 'left');
		$this->db->where('ticket_types_lang.language', $this->session->userdata('language_code'));
		if ($ticket_id != '') {
			$this->db->where('ticket_types.id', $ticket_id);
		}
		$this->db->order_by('ticket_types.id', 'DESC');
		$query = $this->db->get();
		return $query;
	}
	public function get_ticket_type_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		$this->db->select('ticket_types.*,ticket_types_lang.name as tickettype,ticket_types_lang.ticket_description as ticket_description,ticket_types_lang.ticket_image as ticket_image')->from('ticket_types')->join('ticket_types_lang', 'ticket_types_lang.ticket_type_id = ticket_types.id', 'left');
		$this->db->where('ticket_types_lang.language', $this->session->userdata('language_code'));

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('ticket_types_lang.name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_split_type_data($id = '')
	{
		$this->db->select('split_types.*,split_types_lang.name as splittype,split_types_lang.split_description as s_description')->from('split_types')->join('split_types_lang', 'split_types_lang.split_type_id = split_types.id', 'left');
		$this->db->where('split_types_lang.language', $this->session->userdata('language_code'));
		if ($id != '') {
			$this->db->where('split_types.id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_split_type_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		$this->db->select('split_types.*,split_types_lang.name as splittype')->from('split_types')->join('split_types_lang', 'split_types_lang.split_type_id = split_types.id', 'left');
		$this->db->where('split_types_lang.language', $this->session->userdata('language_code'));

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('split_types_lang.name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_ticket_details_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		$this->db->select('ticket_details.*,ticket_details_lang.ticket_name as ticket_det_name, ticket_details_lang.ticket_image as timage')->from('ticket_details')->join('ticket_details_lang', 'ticket_details.id = ticket_details_lang.ticket_details_id', 'left');
		$this->db->where('ticket_details_lang.language', $this->session->userdata('language_code'));

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('ticket_details.source_type', 'tixstock');
		}
		else{
			$this->db->where('ticket_details.source_type', '1boxoffice');
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('ticket_details_lang.ticket_name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_ticket_details_data($id = "", $status = '')
	{
		$this->db->select('ticket_details.*,ticket_details_lang.ticket_name as ticket_det_name, ticket_details_lang.ticket_image as timage')->from('ticket_details')->join('ticket_details_lang', 'ticket_details.id = ticket_details_lang.ticket_details_id', 'left');
		$this->db->where('ticket_details_lang.language', $this->session->userdata('language_code'));
		if ($id != '') {
			$this->db->where('ticket_details.id', $id);
		}
		if ($status == 'ACTIVE') {
			$this->db->where('ticket_details.status', 1);
		}
		$query = $this->db->get();
		return $query;
	}


	public function get_email_template_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		$this->db->select('email_template.*')
				->from('email_template')
				;
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('email.subject', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_admin_details_by_role_v1($role_id, $status = '')
	{

		$this->db->select('admin_details.*,admin_details.admin_id as user_id,address_details.*, countries.name as country_name,cities.name as city_name,admin_role.admin_role_id,admin_role.admin_role_name,admin_bank_details.*')->from('admin_details')->join('admin_login_details', 'admin_login_details.admin_id = admin_details.admin_id', 'left')->join('address_details', 'address_details.address_details_id = admin_details.address_details_id', 'left')->join('countries', 'countries.id = address_details.country', 'left')->join('cities', 'cities.id = address_details.city', 'left')->join('admin_role_details', 'admin_role_details.admin_id = admin_details.admin_id', 'left')->join('admin_role', 'admin_role.admin_role_id = admin_role_details.admin_roles_id', 'left')->join('admin_bank_details', 'admin_bank_details.admin_id = admin_details.admin_id', 'left')->where('admin_role_details.admin_roles_id', $role_id);
		if($role_id == 4){
			$this->db->or_where('admin_role_details.admin_roles_id', 6);
			}
		if ($status != '') {
			$this->db->order_by('admin_details.admin_status', 'ACTIVE');
		}
		$this->db->order_by('admin_details.admin_id', 'DESC');
		$query = $this->db->get(); //echo $this->db->last_query();exit;
		// print_r($this->db->last_query());exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return '';
		}
	}

	public function get_other_events_categories($row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', $where_array = array(), $search = '')
	{

		$this->db->select('A.*, (CASE WHEN A.parent_id!=0 THEN B.category_name ELSE "" END )AS PARENT')
			->from('otherevent_category A')
			->join('otherevent_category B', 'A.parent_id = B.id', 'left');
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('A.category_name', $search);
			$this->db->or_like('B.category_name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}
	function get_email_permissions()
	{
		$this->db->select('email_privileges.*');
		$query = $this->db->get('email_privileges');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function update_email_permission($data)
	{
		$status = false;
		$this->db->where("privilege_id != ", 0);
		$this->db->delete('email_privileges');
		if (count($data) > 0) {
			if ($this->db->insert_batch("email_privileges", $data)) {
				$status = true;
			}
		}
		return $status;
	}

	function insert_batch_data($table, $data)
	{

		if (count($data) > 0) {
			if ($this->db->insert_batch($table, $data)) {
				$status = true;
			}
		}
		return $status;
	}





	function delete_other_events_category($category_id)
	{

		$this->db->delete('otherevent_category', array('id' => $category_id));
		$this->db->delete('otherevent_category_lang', array('other_event_cat_id' => $category_id));
		if ($this->db->affected_rows() >= '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function getOtherEvents($event_id = '', $event_held = '', $row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '', $where_array = array(), $search = '')
	{
		$this->db->select('match_info.*,match_info.status as match_status,otherevent_category.*,match_info_lang.match_name,match_info_lang.description,match_info_lang.meta_title,match_info_lang.meta_description')->from('match_info')->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')->join('otherevent_category', 'otherevent_category.id = match_info.other_event_category', 'left');
		$this->db->where('match_info.event_type', 'other');
		$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
		if ($event_held == 'upcoming') {
			$this->db->where('match_info.match_date > ', date("Y-m-d H:i"));
		}
		if ($event_held == 'expired') {
			$this->db->where('match_info.match_date < ', date("Y-m-d H:i"));
		}

		if ($event_id != '') {
			$this->db->where('match_info.m_id', $event_id);
		}

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}

		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('match_info_lang.match_name', $search);
			$this->db->or_like('otherevent_category.category_name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}

		$query = $this->db->get();
		//echo "LS:".$this->db->last_query();exit;
		return $query;
	}

	function delete_other_events($event_id)
	{

		$this->db->delete('match_info', array('m_id' => $event_id));
		$this->db->delete('match_info_lang', array('match_id' => $event_id));
		if ($this->db->affected_rows() >= '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_static_page_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		$this->db->select('static_page.*,page_types.page_type_name,static_page_lang.title ')->from('static_page')->join('page_types', 'page_types.page_type_id = static_page.page_type', 'left')->join('static_page_lang', 'static_page_lang.static_page_id = static_page.id', 'left');
		$this->db->where('static_page_lang.language', $this->session->userdata('language_code'));

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('static_page_lang.title', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$this->db->where('static_page.add_by', $this->session->userdata('storefront')->admin_id);

		$query = $this->db->get();
		return $query;
	}
	public function get_static_page_data($id = '')
	{
		$this->db->select('static_page.*,static_page_lang.title,static_page_lang.description')->from('static_page')->join('static_page_lang', 'static_page_lang.static_page_id = static_page.id', 'left');
		$this->db->where('static_page_lang.language', $this->session->userdata('language_code'));


		if ($id != '') {
			$this->db->where('static_page.id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function top_leagues_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{

		$this->db->select('top_league_cups.*,tournament_lang.tournament_name')->from('top_league_cups')->join('tournament_lang', 'tournament_lang.tournament_id = top_league_cups.tournament_id', 'left');
		// $this->db->where('top_league_cups.match_type', 'league');
		$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('tournament_lang.tournament_name', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$this->db->where('top_league_cups.add_by', $this->session->userdata('storefront')->admin_id);
		$query = $this->db->get();
		return $query;
	}


	public function get_upcoming_event_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{

		$this->db->select('upcoming_event.*,match_info_lang.match_name')->from('upcoming_event')->join('match_info_lang', 'match_info_lang.match_id = upcoming_event.match_id', 'left')->join('match_info', 'match_info.m_id = upcoming_event.match_id', 'left');
		$this->db->where('match_info_lang.language', $this->session->userdata('language_code'));

		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('static_page_lang.title', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$this->db->where('upcoming_event.add_by', $this->session->userdata('storefront')->admin_id);
		$this->db->where('match_info.match_date > ', date("Y-m-d H:i"));
		$query = $this->db->get();
		return $query;
	}

	public function get_caurosel_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		if($this->session->userdata('caurosel_type')==1){
			$this->db->select('caurosel.*,teams_lang.team_name,teams_lang.team_image')->from('caurosel')->join('teams', 'caurosel.cro_sid = teams.id', 'left')->join('teams_lang', 'teams_lang.team_id = teams.id', 'left');
			$this->db->where('teams_lang.language', $this->session->userdata('language_code'));
		}else{
			$this->db->select('caurosel.*,tournament_lang.tournament_name as team_name,tournament_lang.tournament_image as team_image')->from('caurosel')->join('tournament', 'caurosel.cro_sid = tournament.t_id', 'left')->join('tournament_lang', 'tournament_lang.tournament_id = tournament.t_id', 'left');
			$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
		}
		$this->db->where('caurosel.cro_type', $this->session->userdata('caurosel_type'));
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		//$this->db->where('upcoming_event.add_by', $this->session->userdata('storefront')->admin_id);
		//$this->db->where('match_info.match_date > ', date("Y-m-d H:i"));
		$query = $this->db->get();
		return $query;
	}

	public function get_sitefee_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		
		$this->db->select('sitefee_markup.*,tournament_lang.tournament_name as team_name,tournament_lang.tournament_image as team_image')->from('sitefee_markup')->join('tournament', 'sitefee_markup.t_id = tournament.t_id', 'left')->join('tournament_lang', 'tournament_lang.tournament_id = tournament.t_id', 'left');
		$this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}


	public function get_team_settings_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		
		$this->db->select('favorite_team_subscription.*,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name')->from('favorite_team_subscription')->join('admin_details', 'admin_details.admin_id = favorite_team_subscription.seller_id', 'left');
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($search != '') {
			$this->db->like('admin_details.admin_name', $search);
			$this->db->or_like('admin_details.admin_last_name', $search);
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}

	public function currencyConverterMap($currency, $currency_from, $currency_to)
	{
		$exchange_price = $this->getAllItemTable_array('exchange_rates', array('currencyto' => strtoupper($currency_from) . '_' . strtoupper($currency_to)))->result();

		if ($exchange_price) {
			$exchange_price = $exchange_price[0]->price;
		} else {
			$exchange_price = 1.00;
		}
		$conversion_rate = (float) $exchange_price;
		$currency = $this->getAllItemTable_array('currency_types', array('currency_code' => strtoupper($currency_to)))->result();
		if ($currency) {
			$currency_symbol = $currency[0]->symbol;
		}
		return number_format($convert_amount * $conversion_rate, 2);
	}

	public function color_name_to_hex($color_name)
	{
		// standard 147 HTML color names
		$colors = array(
			'aliceblue' => 'F0F8FF',
			'antiquewhite' => 'FAEBD7',
			'aqua' => '00FFFF',
			'aquamarine' => '7FFFD4',
			'azure' => 'F0FFFF',
			'beige' => 'F5F5DC',
			'bisque' => 'FFE4C4',
			'black' => '000000',
			'blanchedalmond ' => 'FFEBCD',
			'blue' => '0000FF',
			'blueviolet' => '8A2BE2',
			'brown' => 'A52A2A',
			'burlywood' => 'DEB887',
			'cadetblue' => '5F9EA0',
			'chartreuse' => '7FFF00',
			'chocolate' => 'D2691E',
			'coral' => 'FF7F50',
			'cornflowerblue' => '6495ED',
			'cornsilk' => 'FFF8DC',
			'crimson' => 'DC143C',
			'cyan' => '00FFFF',
			'darkblue' => '00008B',
			'darkcyan' => '008B8B',
			'darkgoldenrod' => 'B8860B',
			'darkgray' => 'A9A9A9',
			'darkgreen' => '006400',
			'darkgrey' => 'A9A9A9',
			'darkkhaki' => 'BDB76B',
			'darkmagenta' => '8B008B',
			'darkolivegreen' => '556B2F',
			'darkorange' => 'FF8C00',
			'darkorchid' => '9932CC',
			'darkred' => '8B0000',
			'darksalmon' => 'E9967A',
			'darkseagreen' => '8FBC8F',
			'darkslateblue' => '483D8B',
			'darkslategray' => '2F4F4F',
			'darkslategrey' => '2F4F4F',
			'darkturquoise' => '00CED1',
			'darkviolet' => '9400D3',
			'deeppink' => 'FF1493',
			'deepskyblue' => '00BFFF',
			'dimgray' => '696969',
			'dimgrey' => '696969',
			'dodgerblue' => '1E90FF',
			'firebrick' => 'B22222',
			'floralwhite' => 'FFFAF0',
			'forestgreen' => '228B22',
			'fuchsia' => 'FF00FF',
			'gainsboro' => 'DCDCDC',
			'ghostwhite' => 'F8F8FF',
			'gold' => 'FFD700',
			'goldenrod' => 'DAA520',
			'gray' => '808080',
			'green' => '008000',
			'greenyellow' => 'ADFF2F',
			'grey' => '808080',
			'honeydew' => 'F0FFF0',
			'hotpink' => 'FF69B4',
			'indianred' => 'CD5C5C',
			'indigo' => '4B0082',
			'ivory' => 'FFFFF0',
			'khaki' => 'F0E68C',
			'lavender' => 'E6E6FA',
			'lavenderblush' => 'FFF0F5',
			'lawngreen' => '7CFC00',
			'lemonchiffon' => 'FFFACD',
			'lightblue' => 'ADD8E6',
			'lightcoral' => 'F08080',
			'lightcyan' => 'E0FFFF',
			'lightgoldenrodyellow' => 'FAFAD2',
			'lightgray' => 'D3D3D3',
			'lightgreen' => '90EE90',
			'lightgrey' => 'D3D3D3',
			'lightpink' => 'FFB6C1',
			'lightsalmon' => 'FFA07A',
			'lightseagreen' => '20B2AA',
			'lightskyblue' => '87CEFA',
			'lightslategray' => '778899',
			'lightslategrey' => '778899',
			'lightsteelblue' => 'B0C4DE',
			'lightyellow' => 'FFFFE0',
			'lime' => '00FF00',
			'limegreen' => '32CD32',
			'linen' => 'FAF0E6',
			'magenta' => 'FF00FF',
			'maroon' => '800000',
			'mediumaquamarine' => '66CDAA',
			'mediumblue' => '0000CD',
			'mediumorchid' => 'BA55D3',
			'mediumpurple' => '9370D0',
			'mediumseagreen' => '3CB371',
			'mediumslateblue' => '7B68EE',
			'mediumspringgreen' => '00FA9A',
			'mediumturquoise' => '48D1CC',
			'mediumvioletred' => 'C71585',
			'midnightblue' => '191970',
			'mintcream' => 'F5FFFA',
			'mistyrose' => 'FFE4E1',
			'moccasin' => 'FFE4B5',
			'navajowhite' => 'FFDEAD',
			'navy' => '000080',
			'oldlace' => 'FDF5E6',
			'olive' => '808000',
			'olivedrab' => '6B8E23',
			'orange' => 'FFA500',
			'orangered' => 'FF4500',
			'orchid' => 'DA70D6',
			'palegoldenrod' => 'EEE8AA',
			'palegreen' => '98FB98',
			'paleturquoise' => 'AFEEEE',
			'palevioletred' => 'DB7093',
			'papayawhip' => 'FFEFD5',
			'peachpuff' => 'FFDAB9',
			'peru' => 'CD853F',
			'pink' => 'FFC0CB',
			'plum' => 'DDA0DD',
			'powderblue' => 'B0E0E6',
			'purple' => '800080',
			'red' => 'FF0000',
			'rosybrown' => 'BC8F8F',
			'royalblue' => '4169E1',
			'saddlebrown' => '8B4513',
			'salmon' => 'FA8072',
			'sandybrown' => 'F4A460',
			'seagreen' => '2E8B57',
			'seashell' => 'FFF5EE',
			'sienna' => 'A0522D',
			'silver' => 'C0C0C0',
			'skyblue' => '87CEEB',
			'slateblue' => '6A5ACD',
			'slategray' => '708090',
			'slategrey' => '708090',
			'snow' => 'FFFAFA',
			'springgreen' => '00FF7F',
			'steelblue' => '4682B4',
			'tan' => 'D2B48C',
			'teal' => '008080',
			'thistle' => 'D8BFD8',
			'tomato' => 'FF6347',
			'turquoise' => '40E0D0',
			'violet' => 'EE82EE',
			'wheat' => 'F5DEB3',
			'white' => 'FFFFFF',
			'whitesmoke' => 'F5F5F5',
			'yellow' => 'FFFF00',
			'yellowgreen' => '9ACD32'
		);

		$color_name = strtolower($color_name);
		if (isset($colors[$color_name])) {
			return ('#' . $colors[$color_name]);
		} else {
			return ($color_name);
		}
	}

	function currencyConverter($convert_amount, $currency_from, $currency_to)
	{
		$exchange_price = $this->getAllItemTable_Array('exchange_rates', array('currencyto' => strtoupper($currency_from) . '_' . strtoupper($currency_to)))->result();
		if ($exchange_price) {
			$exchange_price = $exchange_price[0]->price;
		} else {
			$exchange_price = 1.00;
		}
		$conversion_rate = (float) $exchange_price;
		$currency = $this->getAllItemTable_Array('currency_types', array('currency_code' => strtoupper($currency_to)))->result();
		if ($currency) {
			$currency_symbol = $currency[0]->symbol;
		}
		echo $currency_symbol . ' ' . number_format($convert_amount * $conversion_rate, 2);
	}

	function currencyConverterMap2($convert_amount, $currency_from, $currency_to)
	{
		$exchange_price = $this->getAllItemTable_Array('exchange_rates', array('currencyto' => strtoupper($currency_from) . '_' . strtoupper($currency_to)))->result();
		if ($exchange_price) {
			$exchange_price = $exchange_price[0]->price;
		} else {
			$exchange_price = 1.00;
		}
		$conversion_rate = (float) $exchange_price;
		$currency = $this->getAllItemTable_Array('currency_types', array('currency_code' => strtoupper($currency_to)))->result();
		if ($currency) {
			$currency_symbol = $currency[0]->symbol;
		}
		return str_replace(',', '', number_format($convert_amount * $conversion_rate, 2));
	}
	function getMatchAdditionalInfo($match_id)
	{
		$this->db->select('m.*, t.tournament_name, c.name as city_name, s.name as state_name, cn.name as country_name, st.stadium_image');
		$this->db->join('tournament t', 't.t_id = m.tournament', 'left');
		$this->db->join('cities c', 'c.id = m.city', 'left');
		$this->db->join('states s', 's.id = m.state', 'left');
		$this->db->join('countries cn', 'cn.id = m.country', 'left');
		$this->db->join('stadium st', 'st.s_id = m.venue', 'left');
		$this->db->where('m.m_id', $match_id);
		$result = $this->db->get('match_info m');
		return $result->row();
	}
	public function get_banner_data($id = '')
	{
		$this->db->select('banners.*,banners_lang.title,banners_lang.description')->from('banners')->join('banners_lang', 'banners_lang.banner_id = banners.id', 'left');
		$this->db->where('banners_lang.language', $this->session->userdata('language_code'));
		if ($id != '') {
			$this->db->where('banners.id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_banners_by_limit($row_no, $row_per_page, $orderColumn = '', $orderby = '', $where_array = array(), $search)
	{
		$this->db->select('banners.*,banners_lang.title,banners_lang.description')->from('banners')->join('banners_lang', 'banners_lang.banner_id = banners.id', 'left');
		$this->db->where('banners_lang.language', $this->session->userdata('language_code'));
		$this->db->where('banners.add_by', $this->session->userdata('storefront')->admin_id);
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($search != '') {
			$this->db->like('banners_lang.title', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$query = $this->db->get();
		return $query;
	}


	function payment_history()
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_tickets.*,booking_payments.*,booking_billing_address.*');

		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}
		$this->db->order_by('booking_payments.id', 'DESC');
		$this->db->limit(1000);
		$qry = $this->db->get();
		if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}
	}

	function ticket_delivery($flag = '',$row_no='', $row_per_page='')
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,match_info.*');

		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('match_info', 'match_info.m_id = booking_tickets.match_id', 'LEFT');
		/*if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}*/
		if ($flag == 1) {
			$this->db->where('match_info.match_date >= ', date("Y-m-d H:i"));
		}
		if ($flag == 2) {
			$this->db->where('match_info.match_date < ', date("Y-m-d H:i"));
		}
		$this->db->where_in('booking_global.booking_status', [1,2,4,5,6]);
		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}
		$this->db->order_by('booking_global.bg_id', 'DESC');
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();
		return $qry;
		/*if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}*/
	}

	function confirmed_sales()
	{
		if ($this->session->userdata('role') == 1) {
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,sell_tickets.s_no,SUM(booking_global.ticket_amount) as total_sales');
		}
		else{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,sell_tickets.s_no,SUM(booking_global.total_base_amount) as total_sales');
		}
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		if ($match_id != "") {
			$this->db->where('booking_tickets.match_id', $match_id);
		}

		if($this->store_id){
		//	$this->db->where('booking_global.store_id', $this->store_id);
		}

		//$this->db->where('booking_global.booking_status', 1);
		$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		$this->db->order_by('booking_global.bg_id', 'DESC');
		
		$qry = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}
	}

	function getListing_count($event_search = "", $ticket_category_search = "", $stadium_search = "", $event_status = "", $start_date = "", $end_date = "",$row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '') {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('tournament td', 'td.t_id = m.tournament');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');

        if($event_search) {
            $this->db->where('ml.match_name LIKE ', '%'.$event_search.'%');
        }

        if($ticket_category_search) {
            $this->db->where('st.ticket_type', $ticket_category_search);
        }

        if($stadium_search) {
            $this->db->where('sd.stadium_name LIKE ', '%'.$stadium_search.'%');
        }

        if($event_status == "upcoming") {
            $this->db->where('m.match_date >= ', date("Y-m-d H:i"));
        } else if($event_status == "expired") {
            $this->db->where('m.match_date < ', date("Y-m-d H:i"));
        }
        else if($event_status != "") {
           // $this->db->where('m.match_date < ', date("Y-m-d H:i"));
        }

        if($start_date) {
            $this->db->where('m.match_date >= ', date("Y-m-d 00:00", strtotime($start_date)));
        }
        
        if($end_date) {
            $this->db->where('m.match_date < ', date("Y-m-d 23:59", strtotime($end_date)));
        }

        $this->db->group_by('st.match_id');
        //$this->db->where('m.match_date >= ', date("Y-m-d H:i"));
        $this->db->order_by('m.match_date', 'asc');
         $this->db->order_by('st.price', 'asc');
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        }

		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}

		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->num_rows();
    }

    function getOrdersSearch($match_id = "",$event='',$ticket_category='',$stadium ='',$event_start_date='',$event_end_date='',$ignore_end_date='',$status='',$seller='',$order_id='',$customer_id='',$protect,$seller_name="",$order_status="",$shipping_status="",$row_no='', $row_per_page='')
	{ 
		
		/*$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,sell_tickets.s_no');

		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');

		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}

		if ($match_id != "") {
			$this->db->where('booking_tickets.match_id', $match_id);
		}
		if ($event != "") {
			$this->db->like('booking_tickets.match_name', $event);
		}
		if ($ticket_category != "") {
			$this->db->like('booking_tickets.seat_category', $ticket_category);
		}
		if ($stadium != "") {
			$this->db->like('booking_tickets.stadium_name', $stadium);
		}
		if ($event_start_date != "") {
			$this->db->where('booking_tickets.match_date >= ', date("Y-m-d", strtotime($event_start_date)));
		}
		if ($event_end_date != "") {
			$this->db->where('booking_tickets.match_date < ', date("Y-m-d", strtotime($event_end_date)));
		}
		$this->db->order_by('booking_global.bg_id', 'DESC');

		$qry = $this->db->get();
		if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}*/
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no');
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
		//$this->db->where('md5(booking_global.booking_no)', $booking_no);
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}

		if ($match_id != "") {
			$this->db->where('booking_tickets.match_id', $match_id);
		}
		if ($event != "") {
			$this->db->like('booking_tickets.match_name', $event);
		}

		

		if ($seller_name != "") {
			$this->db->where_in('admin_details.admin_id', $seller_name);
		}

		// if ($seller_name != "") {
		// 	$this->db->or_like('admin_details.admin_last_name', $seller_name);
		// }

		if ($ticket_category != "") {
			$this->db->like('booking_tickets.seat_category', $ticket_category);
		}
		if ($stadium != "") {
			$this->db->like('booking_tickets.stadium_name', $stadium);
		}
		if ($event_start_date != "") {
			$this->db->where('booking_tickets.match_date >= ', date("Y-m-d", strtotime($event_start_date)));
		}
		if ($event_end_date != "") {
			$this->db->where('booking_tickets.match_date < ', date("Y-m-d", strtotime($event_end_date)));
		}
		if ($seller != "") {
			$this->db->where('booking_global.seller_id', $seller);
		}
		if ($order_id != "") {
			$this->db->like('booking_global.booking_no', $order_id);
		}
		if ($customer_id != "") {
			$this->db->where('booking_global.user_id', $customer_id);
		}
		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('booking_global.source_type', 'tixstock');
		}
		else{
			$this->db->where('booking_global.source_type', '1boxoffice');
		}
		if ($protect != "") {
			$this->db->where('booking_global.premium_subscription', 1);
			$this->db->where_in('booking_global.booking_status', [1,2,3,4,5,6]);
		}else{

			if ($order_status != "") {
				$this->db->like('booking_global.booking_status', $order_status);
			}
			else
				$this->db->where_in('booking_global.booking_status', [0,1,2,3,4,5,6,7]);
		}


		if ($shipping_status != "") {
			$this->db->like('booking_global.delivery_status ', $shipping_status);
		}
		else
			$this->db->where_in('booking_global.delivery_status ', [0,1,2,3,4,5,6]);

		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}

		$this->db->order_by('booking_global.bg_id', 'DESC');
		
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();
		//echo $this->db->last_query();exit;
		return $qry;
		/*if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}*/
	}

	function getOrdersSearch_protect($match_id = "",$event='',$ticket_category='',$stadium ='',$event_start_date='',$event_end_date='',$ignore_end_date='',$status='',$seller='',$order_id='',$row_no='', $row_per_page='')
	{ 
		
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no');
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
		//$this->db->where('md5(booking_global.booking_no)', $booking_no);
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}

		if ($match_id != "") {
			$this->db->where('booking_tickets.match_id', $match_id);
		}
		if ($event != "") {
			$this->db->like('booking_tickets.match_name', $event);
		}
		if ($ticket_category != "") {
			$this->db->like('booking_tickets.seat_category', $ticket_category);
		}
		if ($stadium != "") {
			$this->db->like('booking_tickets.stadium_name', $stadium);
		}
		if ($event_start_date != "") {
			$this->db->where('booking_tickets.match_date >= ', date("Y-m-d", strtotime($event_start_date)));
		}
		if ($event_end_date != "") {
			$this->db->where('booking_tickets.match_date < ', date("Y-m-d", strtotime($event_end_date)));
		}
		if ($seller != "") {
			$this->db->where('booking_global.seller_id', $seller);
		}
		if ($order_id != "") {
			$this->db->like('booking_global.booking_no', $order_id);
		}
		$this->db->order_by('booking_global.bg_id', 'DESC');
		$this->db->where_in('booking_global.booking_status', [0,1,2,3]);
		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		return $qry;
		/*if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}*/
	}

	function getReviewOrders($match_id = "",$flag='',$seller_id='',$row_no='', $row_per_page='',$search='')
	{ 
		
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no,countries.name as customer_country_name,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name,');
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

		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}

		// if (@$_GET['partner'] == "all") {
		// 	$this->db->where('booking_global.partner_id is NOT NULL', NULL, FALSE);
		// }

		//$this->db->where('md5(booking_global.booking_no)', $booking_no);
		// // if ($this->session->userdata('role') == 1) {
		// // 	$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		// // }
		// if ($match_id != "") {
		// 	$this->db->where('booking_tickets.match_id', $match_id);
		// }
		// if ($seller_id != "") {
		// 	$this->db->where('booking_global.seller_id', $seller_id);
		// }
		$this->db->order_by('booking_global.bg_id', 'DESC');
		//if($flag == 'confirmed'){
	//		$this->db->where('booking_global.booking_status', 1);
		//}
		// if($flag == 'confirmed_all'){
			//$this->db->where_in('booking_global.booking_status', [1,2,4,5,6]);
		// }
		//if($flag == 'pending'){
		//	$this->db->where('booking_global.booking_status', 2);
		//}
	//	if($flag == 'shipped'){
			//$this->db->where('booking_global.booking_status', 4);
			//$this->db->or_where('booking_global.delivery_status', 2,4,5,6);
			
	//	}
		// if($flag == 'delivered'){
		// 	$this->db->where_in('booking_global.booking_status', [4,5,6]);
		// }
		// if($flag == 'downloaded'){
		// 	$this->db->where('booking_global.booking_status', 6);
		// }
		// if($flag == 'all'){
		// 	$this->db->where_in('booking_global.booking_status', [0,1,2,3,4,5,6]);
		// }

		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('booking_global.source_type', 'tixstock');
		}
		else{
			$this->db->where('booking_global.source_type', '1boxoffice');
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}

		//|| !empty($search['event_name'])

		if(!empty($search['booking_no']) )
		{
			$this->db->where('booking_global.booking_no', $search['booking_no']);
		}

		if(!empty($search['event_name']) )
		{
			$this->db->like('booking_tickets.match_name', $search['event_name']);
		}

		if(!empty($search['status_type']) )
		{
			// $this->db->where_in('booking_global.delivery_status', $search['status_type']);
			// $values = array(1, 2, 3, 4, 5);
		//$status_type = array_map('intval', $search['status_type']);
			$status_type = str_replace("'", "", $search['status_type']);
			$this->db->where_in('booking_global.delivery_status', $status_type);
			
		}
		else
		{
			$this->db->where_in('booking_global.delivery_status', [2,4,5,6]);
		}


		if(!empty($search['event_start_date']) ) {
			$this->db->where('booking_tickets.match_date >= ', date("Y-m-d", strtotime($search['event_start_date'])));
		}
		if(!empty($search['event_end_date']) ) {
			$this->db->where('booking_tickets.match_date <= ', date("Y-m-d", strtotime($search['event_end_date'])));
		}
	

		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();
		//echo $this->db->last_query();exit;
		return $qry;
		
	}

	function getOrders($match_id = "",$flag='',$seller_id='',$row_no='', $row_per_page='')
	{ 
		/*$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,sell_tickets.s_no');

		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');

		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		if ($match_id != "") {
			$this->db->where('booking_tickets.match_id', $match_id);
		}
		if ($seller_id != "") {
			$this->db->where('booking_global.seller_id', $seller_id);
		}
		$this->db->order_by('booking_global.bg_id', 'DESC');
		if($flag == 'confirmed'){
			$this->db->where('booking_global.booking_status', 1);
		}
		if($flag == 'pending'){
			$this->db->where('booking_global.booking_status', 2);
		}
		if($flag == 'all'){
			$this->db->where_in('booking_global.booking_status', [1,2]);
		}
		$qry = $this->db->get();
		//echo $this->db->last_query();exit;
		if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}*/
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no,countries.name as customer_country_name,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name,');
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

		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}

		if (@$_GET['partner'] == "all") {
			$this->db->where('booking_global.partner_id is NOT NULL', NULL, FALSE);
		}

		//$this->db->where('md5(booking_global.booking_no)', $booking_no);
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		if ($match_id != "") {
			$this->db->where('booking_tickets.match_id', $match_id);
		}
		if ($seller_id != "") {
			$this->db->where('booking_global.seller_id', $seller_id);
		}
		$this->db->order_by('booking_global.bg_id', 'DESC');
		if($flag == 'confirmed'){
			$this->db->where('booking_global.booking_status', 1);
		}
		if($flag == 'confirmed_all'){
			$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		}
		if($flag == 'pending'){
			$this->db->where('booking_global.booking_status', 2);
		}
		if($flag == 'shipped'){
			//$this->db->where('booking_global.booking_status', 4);
			//$this->db->or_where('booking_global.delivery_status', 2,4,5,6);
			$this->db->where_in('booking_global.delivery_status', [2,4,5]);
		}
		if($flag == 'delivered'){
			$this->db->where_in('booking_global.booking_status', [4,5,6]);
		}
		if($flag == 'downloaded'){
			$this->db->where('booking_global.booking_status', 6);
		}
		if($flag == 'all'){
			$this->db->where_in('booking_global.booking_status', [0,1,2,3,4,5,6]);
		}
		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('booking_global.source_type', 'tixstock');
		}
		else{
			$this->db->where('booking_global.source_type', '1boxoffice');
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}

		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();
	//	echo $this->db->last_query();exit;
		return $qry;
		/*if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}*/
	}

	function getOrders_protect($match_id = "",$flag='',$seller_id='',$row_no='', $row_per_page='')
	{ 
		
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.s_no,countries.name as customer_country_name,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name,');
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

		if (@$_GET['partner'] == "all") {
			$this->db->where('booking_global.partner_id is NOT NULL', NULL, FALSE);
		}

		//$this->db->where('md5(booking_global.booking_no)', $booking_no);
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		if ($match_id != "") {
			$this->db->where('booking_tickets.match_id', $match_id);
		}
		if ($seller_id != "") {
			$this->db->where('booking_global.seller_id', $seller_id);
		}
		$this->db->order_by('booking_global.bg_id', 'DESC');
		if($flag == 'confirmed'){
			$this->db->where('booking_global.booking_status', 1);
		}
		if($flag == 'confirmed_all'){
			$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		}
		if($flag == 'pending'){
			$this->db->where('booking_global.booking_status', 2);
		}
		if($flag == 'shipped'){
			//$this->db->where('booking_global.booking_status', 4);
			//$this->db->or_where('booking_global.delivery_status', 2,4,5,6);
			$this->db->where_in('booking_global.delivery_status', [2,4,5]);
		}
		if($flag == 'delivered'){
			$this->db->where_in('booking_global.booking_status', [4,5,6]);
		}
		if($flag == 'downloaded'){
			$this->db->where('booking_global.booking_status', 6);
		}
		if($flag == 'all'){
			$this->db->where_in('booking_global.booking_status', [0,1,2,3,4,5,6]);
		}

		if (@$_GET['only'] == 'tixstock') {
			$this->db->where('booking_global.source_type', 'tixstock');
		}
		else{
			$this->db->where('booking_global.source_type', '1boxoffice');
		}

		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$qry = $this->db->get();//echo $this->db->last_query();exit;
		return $qry;
		/*if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}*/
	}


	function my_sales_details($match_id)
	{

		$this->db->select('*,c.name as country_name,cit.name as city_name');
		$this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
		$this->db->join('sell_tickets st', 'st.match_id = m.m_id');
		$this->db->join('stadium sd', 'sd.s_id = m.venue');
		$this->db->join('tournament td', 'td.t_id = m.tournament');
		$this->db->join('countries c', 'c.id = m.country');
		$this->db->join('cities cit', 'cit.id = m.city','LEFT');
		$this->db->group_by('st.match_id');
		if ($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10) {
			$this->db->where('st.add_by', $this->session->userdata('admin_id'));
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$this->db->where('st.match_id', $match_id);
		$result = $this->db->get('match_info m');
		return $result->row();
	}


	function my_sales_V1($match_held = "")
	{

		$this->db->select('*,c.name as country_name,cit.name as city_name');
		$this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
		//$this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
		$this->db->join('sell_tickets st', 'st.match_id = m.m_id');
		$this->db->join('stadium sd', 'sd.s_id = m.venue');
		$this->db->join('tournament td', 'td.t_id = m.tournament');
		$this->db->join('countries c', 'c.id = m.country');
		$this->db->join('cities cit', 'cit.id = m.city','LEFT');
		$this->db->group_by('st.match_id');
		if ($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10) {
			$this->db->where('st.add_by', $this->session->userdata('admin_id'));
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($match_held == 'upcoming') {
			$this->db->where('m.match_date > ', date("Y-m-d H:i"));
			$this->db->order_by('m.match_date', 'ASC');
		}
		if ($match_held == 'expired') {
			$this->db->where('m.match_date < ', date("Y-m-d H:i"));
			$this->db->order_by('m.match_date', 'DESC');
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		$result = $this->db->get('match_info m');
		//echo $this->db->last_query();exit;
		return $result->result();
	}

	function listed_tickets()
	{

		$this->db->select('sell_tickets.*');
		$this->db->from('sell_tickets');
		if ($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10) {
			$this->db->where('add_by', $this->session->userdata('admin_id'));
		}
		$result = $this->db->get();
		return $result->result();
	}

	function get_tickets_v1($s_no,$match_id,$ticket_category='')
	{

		$this->db->select('sell_tickets.quantity,stadium_seats_lang.seat_category,sell_tickets.ticket_category,sell_tickets.price_type,sell_tickets.price');
		$this->db->from('sell_tickets');
		$this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = sell_tickets.ticket_category');
		$this->db->where('stadium_seats_lang.language',$this->session->userdata('language_code'));
		$this->db->where('sell_tickets.ticket_category', $ticket_category);
		$this->db->where('sell_tickets.add_by != ', $this->session->userdata('admin_id'));
		$this->db->where('sell_tickets.match_id', $match_id);
		$this->db->where('sell_tickets.s_no != ', $s_no);
		$result = $this->db->get();
		return $result;
	}


	function my_ticket_quantity($match_id)
	{
		$this->db->select('SUM(sell_tickets.quantity) as total_quantity');
		$this->db->from('sell_tickets');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->where('sell_tickets.match_id', $match_id);
		$qry = $this->db->get();
		return $qry;
	}

	function get_nominees($data)
	{
		$this->db->select('booking_etickets.*');
		$this->db->from('booking_etickets');
		$this->db->where('booking_etickets.booking_id', $data['booking_id']);
		$this->db->where('booking_etickets.ticket_id', $data['ticket_id']);
		$this->db->order_by('booking_etickets.serial', 'ASC');
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}
	
	function get_download_tickets($data)
	{
		$this->db->select('booking_etickets.*');
		$this->db->from('booking_etickets');
		$this->db->where('booking_etickets.booking_id', $data['booking_id']);
		$this->db->where('booking_etickets.ticket_id', $data['ticket_id']);
		$this->db->where_in('booking_etickets.ticket_status', [2]);
		$this->db->order_by('booking_etickets.serial', 'ASC');
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}

	function get_order_tickets($data)
	{
		$this->db->select('booking_etickets.*');
		$this->db->from('booking_etickets');
		$this->db->where('booking_etickets.booking_id', $data['booking_id']);
		$this->db->where('booking_etickets.ticket_id', $data['ticket_id']);
		$this->db->order_by('booking_etickets.serial', 'ASC');
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}


	function ticket_approve_request($status_flag,$search_booking_no="")
	{
		$this->db->select('booking_etickets.*,booking_etickets.id as eticket_id,booking_tickets.*,booking_global.*,admin_details.admin_name,admin_details.admin_last_name');
		$this->db->from('booking_etickets');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_etickets.booking_id');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		if ($this->session->userdata('role') == 1) { 
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		} 
		/*$this->db->group_start();
		$this->db->where('booking_tickets.ticket_type', 2);
		$this->db->group_end();*/
		$this->db->group_start();
		$this->db->where('sell_tickets.add_by !=', 11);
		if ($status_flag == 'pending') {
			$this->db->where('booking_tickets.match_date > ', date("2023-02-01"));
			//$this->db->where('booking_etickets.ticket_status', 1);

				if($search_booking_no!=""){

				}
		} 
		else if ($status_flag == 'approved') {
			$this->db->where('booking_etickets.ticket_status', 2);
		} 
		else if ($status_flag == 'rejected') {
			$this->db->where('booking_etickets.ticket_status', 6);
		} 
		else if ($status_flag == 'downloaded') {
			$this->db->where('booking_etickets.ticket_status', 3);
		} 
		$this->db->group_end();
		$this->db->where('booking_global.booking_status != ', '3');
		/*if ($status_flag == 'approve_reject') {
			$this->db->where('booking_etickets.ticket_status', 2);
			$this->db->or_where('booking_etickets.ticket_status', 6);
		} else {
			$this->db->where('booking_etickets.ticket_status', 1);
		}*/
		//$this->db->where_in('booking_global.booking_status', [1,4,5,6]);
		$this->db->order_by('booking_etickets.ticket_upload_date', 'DESC');
		$this->db->group_by('booking_etickets.booking_id');
		$this->db->limit(5);
		$qry = $this->db->get();
		// echo $this->db->last_query();exit;
		return $qry;
	}

	function ticket_approve_request_pod($status_flag)
	{
		$this->db->select('booking_ticket_tracking.*,booking_tickets.*,booking_global.*,admin_details.admin_name,admin_details.admin_last_name,booking_ticket_tracking.*,booking_ticket_tracking.pod_status as ticket_status');
		$this->db->from('booking_ticket_tracking');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_ticket_tracking.booking_id');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		if ($this->session->userdata('role') == 1) { 
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		} 
		//$this->db->where('sell_tickets.add_by !=', 11);
		if ($status_flag == 'pending') {
			//$this->db->where('booking_tickets.match_date > ', date("Y-m-d H:i"));
			$this->db->where('booking_ticket_tracking.pod_status', 1);
		} 
		else if ($status_flag == 'approved') {
			$this->db->where('booking_ticket_tracking.pod_status', 2);
		} 
		else if ($status_flag == 'rejected') {
			$this->db->where('booking_ticket_tracking.pod_status', 6);
		} 
		else if ($status_flag == 'downloaded') {
			$this->db->where('booking_ticket_tracking.pod_status', 3);
		} 
		$this->db->where('booking_global.booking_status != ', '3');
		$this->db->limit(1);
		$this->db->order_by('booking_ticket_tracking.tracking_date_time', 'DESC');
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}


	function etickets($status_flag,$booking_id)
	{
		$this->db->select('booking_etickets.ticket_file,booking_etickets.serial,booking_etickets.qr_link');
		$this->db->from('booking_etickets');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_etickets.booking_id');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		} 
		$this->db->where('booking_etickets.booking_id', $booking_id);
		if ($status_flag == 'pending') {
			$this->db->where('booking_etickets.ticket_status', 1);
		} 
		else if ($status_flag == 'approved') {
			$this->db->where('booking_etickets.ticket_status', 2);
		} 
		else if ($status_flag == 'rejected') {
			$this->db->where('booking_etickets.ticket_status', 6);
		} 
		else if ($status_flag == 'downloaded') {
			$this->db->where('booking_etickets.ticket_status', 3);
		} 
		$this->db->order_by('booking_etickets.ticket_upload_date', 'DESC');
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}

	
	function my_orders_details($match_id)
	{
		$this->db->select('booking_etickets.*,booking_tickets.*,count(booking_tickets.quantity) as order_quantity,booking_global.booking_no');
		$this->db->from('booking_etickets');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_etickets.booking_id');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->group_by('booking_tickets.ticket_category');
		//$this->db->group_by('booking_etickets.ticket_id');
		//$this->db->group_by('sell_tickets.ticket_category');
		//$this->db->group_by('booking_tickets.booking_id');
		//$this->db->group_by('sell_tickets.ticket_category');
		$this->db->where('booking_tickets.match_id', $match_id);
		$this->db->where('booking_global.booking_status', 1);
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}

	function my_orders_pending_tickets_v1($match_id, $upload_type, $ticket_category)
	{
		$this->db->select('booking_etickets.*');
		$this->db->from('booking_etickets');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_etickets.booking_id');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		//$this->db->group_by('booking_tickets.ticket_category');
		$this->db->where('booking_tickets.ticket_category', $ticket_category);
		$this->db->where('booking_tickets.match_id', $match_id);
		if ($upload_type == "notuploaded") {
			$array = array(1, 0);
			/*$this->db->where('booking_etickets.ticket_status',1);
		$this->db->where('booking_etickets.ticket_status',0);*/
			$this->db->where_in('booking_etickets.ticket_status', $array);
		} else if ($upload_type == "available") {
			$array = array(2, 3);
			/*$this->db->where('booking_etickets.ticket_status',1);
		$this->db->where('booking_etickets.ticket_status',0);*/
			$this->db->where_in('booking_etickets.ticket_status', $array);
		} else if ($upload_type == "download") {
			$this->db->where('booking_etickets.ticket_status', 3);
		}

		$this->db->where('booking_global.booking_status', 1);
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}

	function my_orders_pending_tickets($match_id, $upload_type)
	{
		$this->db->select('booking_etickets.*');
		$this->db->from('booking_etickets');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_etickets.booking_id');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->where('booking_tickets.match_id', $match_id);
		if ($upload_type == "notuploaded") {
			$array = array(1, 0);
			/*$this->db->where('booking_etickets.ticket_status',1);
		$this->db->where('booking_etickets.ticket_status',0);*/
			$this->db->where_in('booking_etickets.ticket_status', $array);
		} else if ($upload_type == "available") {
			$array = array(2, 3);
			/*$this->db->where('booking_etickets.ticket_status',1);
		$this->db->where('booking_etickets.ticket_status',0);*/
			$this->db->where_in('booking_etickets.ticket_status', $array);
		} else if ($upload_type == "download") {
			$this->db->where('booking_etickets.ticket_status', 3);
		}

		$this->db->where('booking_global.booking_status', 1);
		$this->db->or_where('booking_global.booking_status', 4);
		$this->db->or_where('booking_global.booking_status', 5);
		$this->db->or_where('booking_global.booking_status', 6);
		$qry = $this->db->get(); //echo $this->db->last_query();exit;
		return $qry;
	}


	function my_orders_quantity($match_id)
	{
		$this->db->select('SUM(booking_tickets.quantity) as sold_quantity');
		$this->db->from('booking_tickets');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->where('sell_tickets.match_id', $match_id);
		$this->db->where('booking_global.booking_status', 1);
		$this->db->or_where('booking_global.booking_status', 4);
		$this->db->or_where('booking_global.booking_status', 5);
		$this->db->or_where('booking_global.booking_status', 6);
		$qry = $this->db->get();
		return $qry;
	}

	function my_sales()
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,sell_tickets.s_no');

		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');

		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->where('booking_global.booking_status', 1);
		$this->db->order_by('booking_global.bg_id', 'DESC');
		$qry = $this->db->get();
		if ($qry->num_rows() > 0) {
			return $qry->result();
		} else {
			return array();
		}
	}


	/*public function getOrderData($booking_no)
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_tickets.country_name as stadium_country_name,booking_tickets.city_name as stadium_city_name,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.*,booking_tickets.quantity as quantity,booking_tickets.price');
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
		$this->db->where('md5(booking_global.booking_no)', $booking_no);
		$qry = $this->db->get();
		if ($qry->num_rows() > 0) {
			return $qry->row();
		} else {
			return array();
		}
	}*/

	public function getOrderData($booking_no)
	{
		$this->db->select('booking_global.*,ticket_types_lang.name as ticket_type_name,booking_tickets.*,booking_tickets.country_name as stadium_country_name,booking_tickets.city_name as stadium_city_name,booking_billing_address.*,booking_payments.*,stadium.*,countries.name as country_name,states.name as city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,sell_tickets.*,booking_tickets.quantity as quantity,booking_tickets.price,booking_tickets.listing_note as listing_note,partner.admin_name as partner_first_name,partner.admin_last_name as partner_last_name,partner.company_name  as partner_company_name,partner.admin_email  as partner_email,partner.admin_cell_phone  as partner_mobile,booking_global.user_id as customer_id,booking_tickets.ticket_block as ticket_block,site_settings.site_value as store_name,booking_etickets.ticket_status,booking_etickets.ticket_email_status,booking_etickets.ticket_upload_date,booking_etickets.ticket_approve_date');
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('booking_etickets', 'booking_etickets.booking_id = booking_global.bg_id');
		$this->db->join('ticket_types_lang', 'ticket_types_lang.ticket_type_id = booking_tickets.ticket_type', 'LEFT');
		$this->db->join('stadium', 'stadium.s_id = booking_tickets.stadium_id', 'LEFT');
		//$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('register', 'register.id=booking_global.user_id', 'LEFT');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');

		$this->db->join('admin_details as partner', 'partner.admin_id=booking_global.partner_id', 'LEFT');

		$this->db->join('site_settings', 'site_settings.store_id=booking_global.store_id AND site_settings.site_name="SITE_SHORT_DOMAIN"', 'LEFT');
		
		$this->db->join('countries', 'countries.id=booking_billing_address.country_id', 'LEFT');
		$this->db->join('states', 'states.id=booking_billing_address.state_id', 'LEFT');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		$this->db->where('md5(booking_global.booking_no)', $booking_no);
		$this->db->where('ticket_types_lang.language', 'en');
		$qry = $this->db->get();
		if ($qry->num_rows() > 0) {
			return $qry->row();
		} else {
			return array();
		}
	}

	public function getOrderData_v1($notify='')
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,booking_payments.*,stadium_details.*,stadium.*,countries.name as customer_country_name,cities.name as customer_city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,sell_tickets.s_no,booking_tickets.quantity as quantity,booking_tickets.price,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name');
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('booking_payments', 'booking_payments.booking_id = booking_global.bg_id');
		$this->db->join('stadium', 'stadium.s_id = booking_tickets.stadium_id', 'LEFT');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		$this->db->join('register', 'register.id=booking_global.user_id', 'LEFT');
		$this->db->join('countries', 'countries.id=booking_billing_address.country_id', 'LEFT');
		$this->db->join('cities', 'cities.id=booking_billing_address.state_id', 'LEFT');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		$this->db->where_in('booking_global.booking_status', [0,1,2,3]);

		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}


		//$this->db->or_where('booking_global.booking_status', 2);
		$this->db->order_by('booking_global.bg_id', 'DESC');
		
		if($notify != ''){
			$this->db->limit(5);
		}
		else{
			$this->db->limit(10);
		}
		$qry = $this->db->get();
		return $qry;
	}

	public function abondaned($booking_no = '', $row_no='', $row_per_page='', $type='')
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,stadium_details.*,stadium.*,countries.name as customer_country_name,states.name as customer_city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,sell_tickets.s_no,sell_tickets.ticketid,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,admin_details.admin_id as seller_id,register.email as customer_email');
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('stadium', 'stadium.s_id = booking_tickets.stadium_id', 'LEFT');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('register', 'register.id=booking_global.user_id', 'LEFT');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		$this->db->join('countries', 'countries.id=booking_billing_address.country_id', 'LEFT');
		$this->db->join('states', 'states.id=booking_billing_address.state_id', 'LEFT');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		if ($booking_no != '') {
			$this->db->where('md5(booking_global.booking_no)', $booking_no);
		}
		if ($type == 'upcoming') {
			$this->db->where('booking_tickets.match_date > ', date("Y-m-d H:i"));
			$this->db->order_by('booking_global.bg_id', 'DESC');
		}
		if ($type == 'past') {
			$this->db->where('booking_tickets.match_date < ', date("Y-m-d H:i"));
			$this->db->order_by('booking_tickets.match_date', 'DESC');
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}
		$this->db->where('booking_global.booking_status', 7);
		//$this->db->order_by('booking_global.bg_id', 'DESC');
		//$this->db->limit(10);
		$qry = $this->db->get();
		return $qry;
	}


	public function abondanedSearch($booking_no = '', $row_no='', $row_per_page='', $type='',$start_date='',$end_date='',$event_name='',$seller_name='',$country='')
	{
		$this->db->select('booking_global.*,booking_tickets.*,booking_billing_address.*,stadium_details.*,stadium.*,countries.name as customer_country_name,states.name as customer_city_name,register.first_name as customer_first_name,register.last_name as customer_last_name,sell_tickets.s_no,sell_tickets.ticketid,admin_details.admin_id,admin_details.admin_name as seller_first_name,admin_details.admin_last_name as seller_last_name,admin_details.admin_id as seller_id,register.email as customer_email');
		$this->db->from('booking_global');
		$this->db->join('booking_tickets', 'booking_tickets.booking_id = booking_global.bg_id');
		$this->db->join('booking_billing_address', 'booking_billing_address.booking_id = booking_global.bg_id');
		$this->db->join('stadium', 'stadium.s_id = booking_tickets.stadium_id', 'LEFT');
		$this->db->join('stadium_details', 'stadium_details.id = booking_tickets.ticket_block', 'LEFT');
		$this->db->join('register', 'register.id=booking_global.user_id', 'LEFT');
		$this->db->join('admin_details', 'admin_details.admin_id=booking_global.seller_id', 'LEFT');
		$this->db->join('countries', 'countries.id=booking_billing_address.country_id', 'LEFT');
		$this->db->join('states', 'states.id=booking_billing_address.state_id', 'LEFT');
		$this->db->join('sell_tickets', 'sell_tickets.s_no = booking_tickets.ticket_id', 'LEFT');
		if ($this->session->userdata('role') == 1) {
			$this->db->where('sell_tickets.add_by', $this->session->userdata('admin_id'));
		}
		if ($booking_no != '') {
			$this->db->where('md5(booking_global.booking_no)', $booking_no);
		}
		if ($type == 'upcoming') {
			$this->db->where('booking_tickets.match_date > ', date("Y-m-d H:i"));
			$this->db->order_by('booking_global.bg_id', 'DESC');
		}		

		if ($start_date != '') {
			$this->db->where('booking_tickets.match_date >= ', date("Y-m-d 00:00", strtotime($start_date)));
		}

		if ($end_date != '') {
			$this->db->where('booking_tickets.match_date < ', date("Y-m-d 23:59", strtotime($end_date)));
		}

		if ($event_name != '') {
			$this->db->like('booking_tickets.match_name', $event_name);
		}

		if ($seller_name != "") {
			$this->db->like('register.first_name', $seller_name);
		}

		if ($seller_name != "") {
			$this->db->or_like('register.last_name', $seller_name);
		}

		if ( !empty($country)) {
			$this->db->where_in('countries.id',$country);
		}
		
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}
		if($this->store_id){
			$this->db->where('booking_global.store_id', $this->store_id);
		}
		$this->db->where('booking_global.booking_status', 7);
		//$this->db->order_by('booking_global.bg_id', 'DESC');
		//$this->db->limit(10);
		$qry = $this->db->get();

		//echo $this->db->last_query();exit;
		return $qry;
	}

	function my_sales_V1_filter($match_held = "", $row_no, $row_per_page, $orderColumn, $orderby, $search, $where = array(),$seller_id='')
	{

		$this->db->select('*,c.name as country_name,cit.name as city_name');
		$this->db->from('match_info m');
		$this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
		$this->db->join('sell_tickets st', 'st.match_id = m.m_id');
		$this->db->join('booking_tickets', 'booking_tickets.ticket_id = st.s_no');
		$this->db->join('booking_global', 'booking_global.bg_id = booking_tickets.booking_id');
		$this->db->join('stadium sd', 'sd.s_id = m.venue');
		$this->db->join('tournament td', 'td.t_id = m.tournament');
		$this->db->join('countries c', 'c.id = m.country');
		$this->db->join('cities cit', 'cit.id = m.city');
		$this->db->group_by('st.match_id');
		if ($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10) {
			$this->db->where('st.add_by', $this->session->userdata('admin_id'));
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if (!empty($where)) {



			if ($where['event_search'] != '') {
				$this->db->where('ml.match_name LIKE ', '%' . $where['event_search'] . '%');
			}

			if ($where['ticket_category_search'] != '') {
				$this->db->where('st.ticket_type', $where['ticket_category_search']);
			}

			if ($where['stadium_search'] != '') {
				$this->db->where('sd.stadium_name LIKE ', '%' . $where['stadium_search'] . '%');
			}



			if ($where['start_date']) {
				$this->db->where('m.match_date >= ', date("Y-m-d 00:00", strtotime($where['start_date'])));
			}

			if ($where['end_date']) {
				$this->db->where('m.match_date < ', date("Y-m-d 23:59", strtotime($where['end_date'])));
			}
			if ($where['seller_id']) {
				$this->db->where('booking_global.seller_id', $where['seller_id']);
			}
		}
		if ($match_held == 'upcoming') {
			$this->db->where('m.match_date > ', date("Y-m-d H:i"));
			$this->db->order_by('m.match_date', 'ASC');
		}
		if ($match_held == 'expired') {
			$this->db->where('m.match_date < ', date("Y-m-d H:i"));
			$this->db->order_by('m.match_date', 'DESC');
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}

		if ($search != '') {
			$this->db->like('banners_lang.title', $search);
		}
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}

		return  $this->db->get();
		//	$result = $this->db->get();
		// $query = $this->db->get();
		//echo $this->db->last_query();exit;
		//	return $result;
	}


 	public function get_total_ticket($match_id,$tournament_id="") {
	
        $this->db->select('SUM(quantity) as  total');	
        $this->db->where('sell_tickets.status',1);

        if($tournament_id !=""){
        	 $this->db->where('match_info.status',1);
        	$this->db->where('match_info.tournament',$tournament_id);

        	$this->db->join('match_info', 'match_info.m_id = sell_tickets.match_id', 'left'); 
        	$this->db->group_by('match_info.tournament'); 	
        }	
        else{
        	$this->db->where('match_id',$match_id);
        	$this->db->group_by('match_id');
        }

		$query= $this->db->get('sell_tickets');
		//echo $this->db->last_query(); print_r($query->row()); die;
		return $query->row();
	}
}
