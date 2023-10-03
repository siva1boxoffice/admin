<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Partner_Model extends CI_Model
{


	public function getrow($table, $colum = '', $id = '',$groupby= '')
	{ 
		if ($colum != "") {
			$this->db->where($colum, $id);
		}

		if ($groupby != "") {
			$this->db->group_by($groupby);
		}
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function getAllItemTable($table,$row_no,$row_per_page, $colum = '', $id = '', $orderColumn = '', $orderby = '',$groupby= '')
	{ 
		if ($colum != "") {
			$this->db->where($colum, $id);
		}
		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		if ($groupby != "") {
			$this->db->group_by($groupby);
		}
		$this->db->limit($row_per_page, $row_no);
		$this->db->select('api_partner_logs.*,admin_details.admin_name,admin_details.admin_last_name');
			$this->db->join('admin_details','admin_details.admin_id = api_partner_logs.partner_id','LEFT');
		$query = $this->db->get($table);
		return $query;
	}

}