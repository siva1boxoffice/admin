<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tssa_Model extends CI_Model
{


    function get_match_info_list(){      
        $this->db->select('m_id,venue,match_name,tixstock_id');
        $this->db->where('source_type', 'tixstock');
        $this->db->limit(1);
        $result = $this->db->get('match_info');
        return $result->result();   
    }


    function get_seat_category($seat_category){      
        $this->db->select('stadium_seat_id,seat_category');
        $this->db->where('seat_category', $seat_category );
        $this->db->where('language', 'en');
        $result = $this->db->get('stadium_seats_lang');
        return $result->row();   
    }

    function save_seat_category($data){
        $this->db->insert("stadium_seats", $data);
        $last_insert_id = $this->db->insert_id();
        return $last_insert_id;
    }

    function get_stadium_seats_lang($category_id,$seat_category){      
        $this->db->select('stadium_seat_id,seat_category');
        $this->db->where('stadium_seat_id', $category_id );
        $this->db->where('seat_category', $seat_category );
        $this->db->where('language', 'en');
        $result = $this->db->get('stadium_seats_lang');
        return $result->row();   
    }

    function save_stadium_seats_lang($data){
        $this->db->insert("stadium_seats_lang", $data);
        $last_insert_id = $this->db->insert_id();
        return $last_insert_id;
    }


    function get_stadium_details($stadium_id,$match_id,$block_id ){  
        $this->db->where('stadium_id', $stadium_id );
        $this->db->where('match_id', $match_id );
        $this->db->where('block_id', $block_id );
        $this->db->where('source_type', 'tixstock');
        $result = $this->db->get('stadium_details');
        return $result->row();   
    }


    function save_stadium_details($data){
        $this->db->insert("stadium_details", $data);
        $last_insert_id = $this->db->insert_id();
        return $last_insert_id;
    }


}
?>