<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tickets_Model extends CI_Model
{

    function get_sell_tickets_by_match($match_id){ 
      
        $this->db->select('s_no,status');
        $this->db->where('match_id', $match_id);
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('sell_tickets.add_by',$this->session->userdata('admin_id'));
        }
        $result = $this->db->get('sell_tickets');
        return $result->result();
        
    }

    
    function get_sell_tickets_by_id($ticket_id){ 
      
        $this->db->select('s_no,status');
        $this->db->where('ticketid', $ticket_id);
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('sell_tickets.add_by',$this->session->userdata('admin_id'));
        }
        $result = $this->db->get('sell_tickets');
        return $result->result();
        
    }

     function getallMatch() {
        
        /*$get_mtch = $this->db->query("SELECT match_info.*,tournament.tournament_name,DATE_FORMAT(match_date,'%d %M %Y') as match_date_format,match_info_lang.match_id,match_info_lang.match_name,match_info_lang.language,match_info_lang.extra_title,match_info_lang.description,match_info_lang.meta_title,match_info_lang.meta_description,match_info_lang.event_image FROM match_info,match_info_lang
            INNER JOIN tournament ON tournament.t_id=match_info.tournament
         where match_info.m_id = match_info_lang.match_id and match_date > '".date("Y-m-d H:i")."' and language = '".$this->session->userdata('language_code')."' order by match_date asc")->result();
        return $get_mtch;*/

        $this->db->select("match_info.*,tournament_lang.tournament_name,DATE_FORMAT(match_date,'%d %M %Y') as match_date_format,match_info_lang.match_id,match_info_lang.match_name,match_info_lang.language,match_info_lang.extra_title,match_info_lang.description,match_info_lang.meta_title,match_info_lang.meta_description,match_info_lang.event_image");
        $this->db->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
        $this->db->join('tournament_lang', 'tournament_lang.tournament_id = match_info.tournament', 'left');
        $this->db->where('match_info.match_date >= ', date("Y-m-d H:i"));
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
        $this->db->where('tournament_lang.language', $this->session->userdata('language_code'));
        $this->db->order_by('match_info.match_date', 'ASC');
        $result = $this->db->get('match_info');
        return $result->result();
    }

    function getOtherEvents($event_id = '')
    {
        $this->db->select('match_info.*,DATE_FORMAT(match_date,"%d %M %Y") as match_date_format,match_info.status as match_status,otherevent_category.*,match_info_lang.match_name,match_info_lang.description,match_info_lang.meta_title,match_info_lang.meta_description')->from('match_info')->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left')->join('otherevent_category', 'otherevent_category.id = match_info.other_event_category', 'left');
        $this->db->where('match_info.event_type', 'other');
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
            $this->db->where('match_info.match_date > ', date("Y-m-d H:i"));

        if ($event_id != '') {
            $this->db->where('match_info.m_id', $event_id);
        }
        $query = $this->db->get();
        return $query;
    }

    function getallMatch_ById($match_id="") {  
        
       
        $get_mtch = $this->db->query("SELECT match_info.*,DATE_FORMAT(match_date,'%d %M %Y') as match_date_format,match_info_lang.match_id,match_info_lang.match_name,match_info_lang.language,match_info_lang.extra_title,match_info_lang.description,match_info_lang.meta_title,match_info_lang.meta_description,match_info_lang.event_image FROM match_info,match_info_lang where match_info.m_id = match_info_lang.match_id and language = '".$this->session->userdata('language_code')."' and match_info.m_id = '".$match_id."' order by match_info.m_id asc")->result();
        return $get_mtch;
    }

    function tkt_category_old($venue="") {  
        
       
        $tkt_category = $this->db->query("SELECT stadium_details.category,stadium_seats_lang.seat_category FROM `stadium_details`,`stadium_seats_lang` WHERE stadium_details.category = stadium_seats_lang.stadium_seat_id and stadium_id = '".$venue."' and language = '".$this->session->userdata('language_code')."' group by stadium_details.category")->result();
      //  echo $this->db->last_query();exit;
        return $tkt_category;
    }

    function tkt_category($venue="") {
        $this->db->select('stadium_details.category,stadium_seats_lang.seat_category,stadium_details.block_color');
        $this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_details.category', 'left');
        $this->db->join('stadium_seats', 'stadium_seats.id = stadium_seats_lang.stadium_seat_id', 'left');
        $this->db->where('stadium_details.stadium_id', $venue);
        $this->db->where('stadium_seats_lang.language', $this->session->userdata('language_code'));
         $this->db->where('stadium_seats.source_type', '1boxoffice');
        $this->db->group_by('stadium_details.category');
        $this->db->order_by('stadium_seats_lang.seat_category','ASC');
        $result = $this->db->get('stadium_details');
        return $result->result();
    }

    function getMatchAdditionalInfo($match_id) {
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

     function partner_enquiry_details($row_no='', $row_per_page='', $orderColumn = '', $orderby = '', $where_array = array(), $search = ''){ 
        $this->db->select('*');
        $this->db->order_by('partner_enquiry.id', 'DESC');
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
        $result = $this->db->get('partner_enquiry');
      //  echo $this->db->last_query();exit;
        return $result;
    }


     function contact_details($row_no='', $row_per_page='', $orderColumn = '', $orderby = '', $where_array = array(), $search = ''){ 
        $this->db->select('contact_details.*,contact_details.status as contact_status,contact_details.id as contact_id,countries.name as country_name');
        $this->db->join('countries', 'countries.id = contact_details.country', 'left');
        $this->db->order_by('contact_details.id', 'DESC');
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
        $result = $this->db->get('contact_details');
      //  echo $this->db->last_query();exit;
        return $result;
    }

    function getAllTickets() {
        $this->db->select('*');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id', 'left');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id', 'left');
        $this->db->join('stadium sd', 'sd.s_id = m.venue', 'left');
        $this->db->group_by('st.match_id');
        $this->db->where('m.match_date >= ', date("Y-m-d H:i"));
        $this->db->order_by('m.match_date', 'asc');
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        }
        $result = $this->db->get('match_info m');
        //echo $this->db->last_query();exit;
        return $result->result();
    }

    public function get_expired_tickets()
    {

        $this->db->select('sell_tickets.s_no')->from('sell_tickets')
        ->join('match_info', 'match_info.m_id = sell_tickets.match_id', 'left');
        $this->db->where('match_info.match_date < ', date("Y-m-d H:i"));
        $this->db->where('sell_tickets.status', 1);
        $query = $this->db->get();
        return $query;
    }

    public function get_empty_tickets()
    {

        $this->db->select('sell_tickets.s_no,sell_tickets.ticket_group_id')->from('sell_tickets');
        $this->db->where('sell_tickets.ticket_group_id', '');
        $query = $this->db->get();
        return $query;
    }



function oe_getListing_details($match_id) {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('otherevent_category_lang oc', 'oc.other_event_cat_id = m.other_event_category');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }
        $this->db->group_by('st.match_id');
        $this->db->order_by('m.match_date', 'asc');
         $this->db->order_by('st.price', 'asc');
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        } //echo $this->session->userdata('admin_id');exit;
        if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
            $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        }
         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }
        $this->db->where('oc.language',$this->session->userdata('language_code'));
        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->result();
    }


    function getListing_details($match_id) {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id','LEFT');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id','LEFT');
        $this->db->join('stadium sd', 'sd.s_id = m.venue','LEFT');
        $this->db->join('tournament_lang td', 'td.tournament_id = m.tournament AND td.language = "'.$this->session->userdata('language_code').'"','LEFT');
        $this->db->join('countries c', 'c.id = m.country','LEFT');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
      //  $this->db->join('booking_tickets bok_tik', 'bok_tik.match_id = ml.match_id','LEFT');
        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }
        $this->db->group_by('st.match_id');
        $this->db->order_by('m.match_date', 'asc');
         $this->db->order_by('st.price', 'asc');
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        } //echo $this->session->userdata('admin_id');exit;
        if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
            $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        }
         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }

        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
         $this->db->group_by('m.m_id');
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->result();
    }

    function getListing_details_v1($match_id,$ticketid) {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('tournament_lang td', 'td.tournament_id = m.tournament');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }
        if($ticketid) {
            $this->db->where('st.s_no', $ticketid);
        }
        $this->db->group_by('st.match_id');
        $this->db->order_by('m.match_date', 'asc');
         $this->db->order_by('st.price', 'asc');
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        } //echo $this->session->userdata('admin_id');exit;
        if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
            $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        }
         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }
        $this->db->where('td.language',$this->session->userdata('language_code'));
        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->result();
    }


     function getListing($event_search = "", $ticket_category_search = "", $stadium_search = "", $event_status = "", $start_date = "", $end_date = "",$row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '',$match_id='',$tournament_name="",$seller_name="") {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('tournament_lang td', 'td.tournament_id = m.tournament');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
        $this->db->join('ticket_types_lang ty', 'ty.ticket_type_id = st.ticket_type','LEFT');

        if($event_search) {
            $this->db->where('ml.match_name LIKE ', '%'.$event_search.'%');
        }

        if($tournament_name) {
           
            $this->db->where('td.tournament_name LIKE ', '%'.$tournament_name.'%');
        }

        if (!empty($seller_name)) {
            $comma_separated = implode(",", $seller_name);              
              $this->db->where_in('st.add_by',$comma_separated);
          }

        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }

        if($ticket_category_search) {
            $this->db->where('ty.name LIKE ', '%'.$ticket_category_search.'%');
        }

        if($stadium_search) {
            $this->db->where('sd.stadium_name LIKE ', '%'.$stadium_search.'%');
        }

        if($event_status == "upcoming" && $start_date == '') {
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

        if (@$_GET['only'] == 'tixstock') {
            $this->db->where('m.tixstock_id is NOT NULL', NULL, FALSE);
        }
        else{
            $this->db->where('m.source_type', '1boxoffice');
        }


        $this->db->group_by('st.match_id');
        //$this->db->where('m.match_date >= ', date("Y-m-d H:i"));
        $this->db->order_by('m.match_date', 'asc');
         $this->db->order_by('st.price', 'asc');

         if($seller_name=="")
          {
                if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
                    $this->db->where('st.add_by',$this->session->userdata('admin_id'));
                } 

                if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
                    $this->db->where('st.add_by',$this->session->userdata('seller_id'));
                }
          }
         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }
        $this->db->where('td.language',$this->session->userdata('language_code'));
        $this->db->where('ty.language',$this->session->userdata('language_code'));
        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->result();
    }

    function oe_getListing_details_v1($match_id,$ticketid) {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('otherevent_category_lang oc', 'oc.other_event_cat_id = m.other_event_category');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }
        if($ticketid) {
            $this->db->where('st.s_no', $ticketid);
        }
        $this->db->group_by('st.match_id');
        $this->db->order_by('m.match_date', 'asc');
         $this->db->order_by('st.price', 'asc');
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        } //echo $this->session->userdata('admin_id');exit;
        if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
            $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        }
         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }
        $this->db->where('oc.language',$this->session->userdata('language_code'));
        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->result();
    }

    function oe_getListing($event_search = "", $ticket_category_search = "", $stadium_search = "", $event_status = "", $start_date = "", $end_date = "",$row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '',$match_id='') {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('otherevent_category_lang oc', 'oc.other_event_cat_id = m.other_event_category');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
        $this->db->join('ticket_types_lang ty', 'ty.ticket_type_id = st.ticket_type','LEFT');

        if($event_search) {
            $this->db->where('ml.match_name LIKE ', '%'.$event_search.'%');
        }
        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }

        if($ticket_category_search) {
            $this->db->where('ty.name LIKE ', '%'.$ticket_category_search.'%');
        }

        if($stadium_search) {
            $this->db->where('sd.stadium_name LIKE ', '%'.$stadium_search.'%');
        }

        if($event_status == "upcoming" && $start_date == '') {
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
        } //echo $this->session->userdata('admin_id');exit;
        if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
            $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        }
         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }
        $this->db->where('oc.language',$this->session->userdata('language_code'));
        $this->db->where('ty.language',$this->session->userdata('language_code'));
        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->result();
    }

    function oe_getListing_count($event_search = "", $ticket_category_search = "", $stadium_search = "", $event_status = "", $start_date = "", $end_date = "",$row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '',$match_id='') {
        
       $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('otherevent_category_lang oc', 'oc.other_event_cat_id = m.other_event_category');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
        $this->db->join('ticket_types_lang ty', 'ty.ticket_type_id = st.ticket_type','LEFT');

        if($event_search) {
            $this->db->where('ml.match_name LIKE ', '%'.$event_search.'%');
        }
        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }

        if($ticket_category_search) {
            $this->db->where('ty.name LIKE ', '%'.$ticket_category_search.'%');
        }

        if($stadium_search) {
            $this->db->where('sd.stadium_name LIKE ', '%'.$stadium_search.'%');
        }

        if($event_status == "upcoming" && $start_date == '') {
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
        } //echo $this->session->userdata('admin_id');exit;
        if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
            $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        }
         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }
        $this->db->where('oc.language',$this->session->userdata('language_code'));
        $this->db->where('ty.language',$this->session->userdata('language_code'));
        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $result = $this->db->get('match_info m');

        return $result->num_rows();
    }

    function getListing_count($event_search = "", $ticket_category_search = "", $stadium_search = "", $event_status = "", $start_date = "", $end_date = "",$row_no = '', $row_per_page = '', $orderColumn = '', $orderby = '',$match_id='',$tournament_name="",$seller_name="") {
        
       $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('tournament_lang td', 'td.tournament_id = m.tournament');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city','LEFT');
        $this->db->join('ticket_types_lang ty', 'ty.ticket_type_id = st.ticket_type','LEFT');

        if($event_search) {
            $this->db->where('ml.match_name LIKE ', '%'.$event_search.'%');
        }

        if($tournament_name) {
            $this->db->where('td.tournament_name LIKE ', '%'.$tournament_name.'%');
        }

        if (!empty($seller_name)) {
          $comma_separated = implode(",", $seller_name);                
            $this->db->where_in('st.add_by',$comma_separated);
        }

        // $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        
        if($match_id) {
            $this->db->where('ml.match_id', $match_id);
        }

        if($ticket_category_search) {
            $this->db->where('ty.name LIKE ', '%'.$ticket_category_search.'%');
        }

        if($stadium_search) {
            $this->db->where('sd.stadium_name LIKE ', '%'.$stadium_search.'%');
        }

        if($event_status == "upcoming" && $start_date == '') {
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
        // if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
        //     $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        // } //echo $this->session->userdata('admin_id');exit;
        // if($this->session->userdata('role') == 6 && $this->session->userdata('seller_id') != ''){
        //     $this->db->where('st.add_by',$this->session->userdata('seller_id'));
        // }

         $this->db->where('st.status != ',2);
        if ($orderColumn != "" && $orderby != "") {
            $this->db->order_by($orderColumn, $orderby);
        }
        $this->db->where('td.language',$this->session->userdata('language_code'));
        $this->db->where('ty.language',$this->session->userdata('language_code'));
        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $result = $this->db->get('match_info m');

        return $result->num_rows();
    }

    public function getbooking_tickets($match_id)
    {
        $this->db->select('*');
        $this->db->from('booking_tickets');
        $this->db->where('match_id', $match_id);
        $qry = $this->db->get();
        // echo $this->db->last_query();exit;
        return $qry;
    }
    
    function getListing_v1($m_id="") {

        $this->db->select('admin_details.admin_name,admin_details.admin_last_name,sell_tickets.*,stadium_seats_lang.seat_category as stadium_seat_category,split_types.name as split_name,ty.name as ticket_types_name,stadium_details.block_id as ticket_block_name')
        ->from('sell_tickets')
        //->join('admin_details', 'admin_details.admin_id = sell_tickets.user_id', 'left');
        ->join('admin_details', 'admin_details.admin_id = sell_tickets.add_by', 'left');
        $this->db->join('stadium_seats', 'stadium_seats.id = sell_tickets.ticket_category', 'left');
        $this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = stadium_seats.id', 'left');
        $this->db->join('split_types', 'split_types.id = sell_tickets.split', 'left');
       
        $this->db->join('ticket_types_lang ty', 'ty.ticket_type_id = sell_tickets.ticket_type AND ty.language = "'. $this->session->userdata('language_code').'"','LEFT');
        $this->db->join('stadium_details', 'stadium_details.id = sell_tickets.ticket_block', 'LEFT');

        $this->db->where('sell_tickets.match_id', $m_id);
        $this->db->where('sell_tickets.status != ',2);
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){

        $this->db->where('sell_tickets.add_by',$this->session->userdata('admin_id'));
        }
        if (@$_GET['only'] == 'tixstock') {
             $this->db->where('sell_tickets.source_type', "tixstock");
        }
        else{
             // $this->db->where('sell_tickets.source_type', "1boxoffice");
           $this->db->where_in('sell_tickets.source_type', ['1boxoffice','tixstock','oneclicket','xs2event']);
        }
        $this->db->order_by('sell_tickets.price', 'asc');
        $this->db->order_by('sell_tickets.s_no', 'DESC');
        $this->db->group_by('sell_tickets.s_no');
        $query = $this->db->get();
        //echo $this->db->last_query();
        
        return $query->result();

        /*$this->db->select('*');
        $this->db->order_by('sell_tickets.price', 'asc');
        $this->db->order_by('sell_tickets.s_no', 'DESC');
        $this->db->where('match_id', $m_id);
        $this->db->where('sell_tickets.status != ',2);
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('sell_tickets.add_by',$this->session->userdata('admin_id'));
        }
        $result = $this->db->get('sell_tickets');
        
        return $result->result();
        
*/    }

    function getListing_v3($m_id="",$s_no) {

        $this->db->select('*');
        $this->db->order_by('sell_tickets.price', 'asc');
        $this->db->order_by('sell_tickets.s_no', 'DESC');
        $this->db->where('match_id', $m_id);
        $this->db->where('sell_tickets.s_no', $s_no);
        $this->db->where('sell_tickets.status != ',2);
        $result = $this->db->get('sell_tickets');
        
        return $result->result();
        
    }

    function getListing_v2($ticketid) {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id');
        $this->db->join('stadium sd', 'sd.s_id = m.venue');
        $this->db->join('tournament td', 'td.t_id = m.tournament');
        $this->db->join('countries c', 'c.id = m.country');
        $this->db->join('cities cit', 'cit.id = m.city');
        $this->db->where('st.ticketid',$ticketid);
        $this->db->order_by('m.match_date', 'asc');
        $this->db->order_by('st.price', 'asc');
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        }
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->row();
    }


     function e_ticket_files($ticket_id="",$ticket_type=''){ 

        $this->db->select('*');
        $this->db->where('sell_id', $ticket_id);
        if($ticket_type != ""){
        $this->db->where('ticket_type', $ticket_type);
        }
        $result = $this->db->get('e_ticket_files');
        return $result->result();
        
    }

    function get_sell_tickets($ticket_id=""){ 

        $this->db->select('*');
        $this->db->where('s_no', $ticket_id);
        if($this->session->userdata('role') != 6 && $this->session->userdata('role') != 10){
            $this->db->where('sell_tickets.add_by',$this->session->userdata('admin_id'));
        }
        $result = $this->db->get('sell_tickets');
        return $result->row();
        
    }

    function get_sell_tickets_pending(){ 

        $this->db->select('*');
        $this->db->where('ticketid', '');
        $result = $this->db->get('sell_tickets');
        return $result->result();
        
    }

    

    

    function ticket_request($id='') {
       /* $this->db->select('request_tickets.*,match_info.*, match_info_lang.*');
        $this->db->join('match_info', 'match_info.m_id = request_tickets.event_id', 'left');
        $this->db->join('match_info_lang', 'match_info_lang.match_id = match_info.m_id', 'left');
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
        $result = $this->db->get('request_tickets');
*/
         $this->db->select('req.id as request_id,req.status as request_status,req.*,m.*, t.tournament_name, c.name as city_name, s.name as state_name, cn.name as country_name,match_info_lang.*, st.stadium_image,stadium_seats_lang.*');
         $this->db->join('match_info m', 'm.m_id = req.event_id', 'left');
         $this->db->join('match_info_lang', 'match_info_lang.match_id = m.m_id', 'left');
        $this->db->join('tournament t', 't.t_id = m.tournament', 'left');
        $this->db->join('cities c', 'c.id = m.city', 'left');
        $this->db->join('states s', 's.id = m.state', 'left');
        $this->db->join('countries cn', 'cn.id = m.country', 'left');
        $this->db->join('stadium st', 'st.s_id = m.venue', 'left');
         $this->db->join('stadium_seats_lang', 'stadium_seats_lang.stadium_seat_id = req.block_category', 'left');
         $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
         $this->db->where('stadium_seats_lang.language', $this->session->userdata('language_code'));
          $this->db->order_by('req.id','DESC');
          if($id != ''){
            $this->db->where('req.id', $id);
          }
        $result = $this->db->get('request_tickets req');
        //echo $this->db->last_query();exit;
        return $result;
    }

    public function ticket_request_by_limit($row_no='', $row_per_page='', $orderColumn = '', $orderby = '', $where_array = array(), $search = '')
    { 
        
         $this->db->select('request_tickets.id as request_id,request_tickets.status as request_status,request_tickets.*,m.*, t.tournament_name, c.name as city_name, s.name as state_name, cn.name as country_name,match_info_lang.*, st.stadium_image,stadium_seats.*');
         $this->db->from('request_tickets');
         $this->db->join('match_info m', 'm.m_id = request_tickets.event_id', 'left');
         $this->db->join('match_info_lang', 'match_info_lang.match_id = m.m_id', 'left');
        $this->db->join('tournament_lang t', 't.tournament_id = m.tournament', 'left');
        $this->db->join('cities c', 'c.id = m.city', 'left');
        $this->db->join('states s', 's.id = m.state', 'left');
        $this->db->join('countries cn', 'cn.id = m.country', 'left');
        $this->db->join('stadium st', 'st.s_id = m.venue', 'left');
        $this->db->join('stadium_seats', 'stadium_seats.id = request_tickets.block_category', 'left');
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
        $this->db->where('t.language', $this->session->userdata('language_code'));
        if (!empty($where_array)) {
            foreach ($where_array as $columnkey => $value) {
                $this->db->where($columnkey, $value);
            }
        }
        if ($orderColumn != "" && $orderby != "") {
           // $this->db->order_by($orderColumn, $orderby);
        }
        // $this->db->order_by('request_tickets.id','DESC');
        // if ($search['ticket_statuss'] == 'upcoming') {
        // $this->db->where('m.match_date >= ', date("Y-m-d H:i"));
        // $this->db->order_by('m.match_date','ASC');
        // }
        // if ($search['ticket_statuss'] == 'all') {
        // $this->db->order_by('request_tickets.id','DESC');
        // }
        // else if ($search['ticket_statuss'] == 'past') {
        // $this->db->where('m.match_date < ', date("Y-m-d H:i"));
        // }
        // else if ($search['ticket_statuss'] == 'open') {
        //      $this->db->where('request_tickets.status',0);
        // }
        // else if ($search['ticket_statuss'] == 'closed') {
        //     $this->db->where('request_tickets.status',1);
        // }
        // else{
        //     $this->db->order_by('request_tickets.id','DESC');
        // }

        if ($search['ticket_statuss'] == 'upcoming') {
            $this->db->where('m.match_date >= ', date("Y-m-d H:i"));
            $this->db->order_by('m.match_date', 'ASC');
        } elseif ($search['ticket_statuss'] == 'past') {
            $this->db->where('m.match_date < ', date("Y-m-d H:i"));
        } elseif ($search['ticket_statuss'] == 'open') {
            $this->db->where('request_tickets.status', 0);
        } elseif ($search['ticket_statuss'] == 'closed') {
            $this->db->where('request_tickets.status', 1);
        }
        
        $this->db->order_by('request_tickets.id', 'DESC');
        

        if (!empty($search['event_name'])) {
            $this->db->like('m.match_name', $search['event_name']); 
       }

       if (!empty($search['tournament_ids'])) {
         $this->db->where_in('m.tournament', $search['tournament_ids']);
        }

        if(!empty($search['status'])){         
            $this->db->where_in('request_tickets.status', $search['status']);
        }



        if ($row_per_page != '') {
            $this->db->limit($row_per_page, $row_no);
        }
        $query = $this->db->get();
        return $query;
    }

    function getListing_filter($m_id="",$match_type='') {

        $this->db->select('*');
        $this->db->order_by('sell_tickets.price', 'asc');
        $this->db->order_by('sell_tickets.s_no', 'DESC');
        $this->db->where('match_id', $m_id);
       //echo $match_type;exit;

        if($match_type == "publish") {
             $this->db->where('sell_tickets.status',1);
             //$this->db->or_where('st.status !=', 2);
        }
        else if($match_type == "unpublish") {
             $this->db->where('sell_tickets.status',0);
             // $this->db->or_where('st.status !=', 2);
        }
        else if($match_type == "deleted") {
             $this->db->where('sell_tickets.status',2);
        }
        else{
            $this->db->where('sell_tickets.status != ', 2);
        }

        if($this->session->userdata('role') != 6){
            $this->db->where('sell_tickets.add_by',$this->session->userdata('admin_id'));
        }
        $result = $this->db->get('sell_tickets');
        //echo $this->db->last_query();exit;
        return $result->result();
        
    }

     function getListing_v4($ticketid) {
        
        $this->db->select('*,c.name as country_name,cit.name as city_name,st.status as ticket_status');
        $this->db->join('match_info_lang ml', 'ml.match_id = m.m_id','left');
        $this->db->join('sell_tickets st', 'st.match_id = m.m_id','left');
        $this->db->join('stadium sd', 'sd.s_id = m.venue','left');
        $this->db->join('tournament td', 'td.t_id = m.tournament','left');
        $this->db->join('countries c', 'c.id = m.country','left');
        $this->db->join('cities cit', 'cit.id = m.city','left');
        $this->db->where('st.s_no',$ticketid);
        $this->db->order_by('m.match_date', 'asc');
        $this->db->order_by('st.price', 'asc');
        if($this->session->userdata('role') != 6){
            $this->db->where('st.add_by',$this->session->userdata('admin_id'));
        }
        $this->db->group_by('m.m_id');
        $result = $this->db->get('match_info m');
       //echo $this->db->last_query();exit;
        return $result->row();
    }

 /*   public function ticket_request()
    {
         $this->db->select('request_tickets.id as request_id,request_tickets.*,m.*, t.tournament_name, c.name as city_name, s.name as state_name, cn.name as country_name,match_info_lang.*, st.stadium_image,stadium_seats.*');
         $this->db->from('request_tickets');
         $this->db->join('match_info m', 'm.m_id = request_tickets.event_id', 'left');
         $this->db->join('match_info_lang', 'match_info_lang.match_id = m.m_id', 'left');
        $this->db->join('tournament t', 't.t_id = m.tournament', 'left');
        $this->db->join('cities c', 'c.id = m.city', 'left');
        $this->db->join('states s', 's.id = m.state', 'left');
        $this->db->join('countries cn', 'cn.id = m.country', 'left');
        $this->db->join('stadium st', 'st.s_id = m.venue', 'left');
        $this->db->join('stadium_seats', 'stadium_seats.id = request_tickets.block_category', 'left');
        $this->db->where('match_info_lang.language', $this->session->userdata('language_code'));
         $this->db->order_by('request_tickets.id','DESC');
       
        $query = $this->db->get();
        return $query;

    }
*/

}


?>

