<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Blog_Model extends CI_Model
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
		if($row_per_page && $row_no){
			$this->db->limit($row_per_page, $row_no);
		}
		
		//if($colum) $this->db->select($colum);

		$query = $this->db->get($table);
		return $query;
	}


	public function getBlogCategory($id)
	{ 

		$this->db->where('blog_category.id', $id);
		$this->db->select('blog_category.*,blog_category_lang.category_name,blog_category_lang.meta_title,blog_category_lang.meta_description,blog_category_lang.seo_keywords');
		$this->db->join('blog_category_lang','blog_category_lang.	blog_category_id  = blog_category.id');
		$this->db->where('language', $this->session->userdata('language_code'));
		$query = $this->db->get('blog_category');
		return $query->row();
	}


	public function getBlog($id)
	{ 

		$this->db->where('blog.id', $id);
		$this->db->select('blog.*,blog_lang.blog_title,blog_lang.blog_description,blog_lang.blog_short_description,blog_lang.meta_title,blog_lang.meta_description,blog_lang.seo_keywords');
		$this->db->join('blog_lang','blog_lang.	blog_id  = blog.id');
		$this->db->where('language', $this->session->userdata('language_code'));
		$query = $this->db->get('blog');
		return $query->row();
	}

	public function getBlogList($row_no="",$row_per_page="",$orderColumn,$orderby,$where_array = array(),$search= array())
	{ 

	
		$this->db->select('blog.*,blog_lang.blog_title,blog_lang.blog_description,blog_lang.blog_short_description,blog_lang.meta_title,blog_lang.meta_description,blog_lang.seo_keywords,blog_category.category_name');
		$this->db->join('blog_lang','blog_lang.	blog_id  = blog.id');
		$this->db->join('blog_category','blog_category.id  = blog.blog_category');
		
		$this->db->where('blog_lang.store_id', $this->session->userdata('storefront')->admin_id);
		$this->db->where('language', $this->session->userdata('language_code'));


		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}

		if ($search != '') {			


			if(@$search['statuss']){
				//if ($match_held !== 'expired') {	
				$this->db->where_in('blog.blog_status', $search['statuss']);
				//}
			}
			
			if(@$search['category_ids']){
				$this->db->where_in('blog.blog_category', $search['category_ids']);
			}
			if(@$search['blog_title']){
				$this->db->group_start();
				$this->db->like('blog.blog_title', $search['blog_title']);
				$this->db->or_like('blog_lang.blog_title', $search['blog_title']);
				$this->db->group_end();
			}


		}

		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		else{
			$this->db->order_by('blog.id', 'desc');
		}
		// if ($search != '') {
		// 	$this->db->like('match_info_lang.match_name', $search);
		// 	//$this->db->or_like('otherevent_category.category_name', $search);
		// }
		$this->db->group_by('blog.id');
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}

		$query = $this->db->get('blog');

		// echo $this->db->last_query();
		// exit;
		return $query;
	}


	public function getBlogCategoryList($row_no="",$row_per_page="",$orderColumn,$orderby,$where_array = array(),$search= array())
	{ 
		$this->db->select('blog_category.*,blog_category_lang.category_name,blog_category_lang.meta_title,blog_category_lang.meta_description,blog_category_lang.seo_keywords');
		$this->db->join('blog_category_lang','blog_category_lang.	blog_category_id  = blog_category.id');
		$this->db->where('language', $this->session->userdata('language_code'));
		if ($search != '') {			
			if(@$search['statuss']){
				//if ($match_held !== 'expired') {	
				$this->db->where_in('blog_category.category_status', $search['statuss']);
				//}
			}

			if(@$search['category_name']){
				$this->db->group_start();
				$this->db->like('blog_category_lang.category_name', $search['category_name']);
				$this->db->or_like('blog_category_lang.category_name', $search['category_name']);
			
				$this->db->group_end();
			}


		}
		$query = $this->db->get('blog_category');
		return $query;
	}

	public function getBlog_lang($id)
	{
		$this->db->select('*');
		$this->db->from('blog_lang');
		$this->db->where('blog_id', $id);
		$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
		$this->db->where('language', $this->session->userdata('language_code'));
		$query = $this->db->get();
		//  echo "<pre>";
		// echo $this->db->last_query();
		// exit;
		
		return $query;


	}


	public function getBlogTagsList($row_no="",$row_per_page="",$orderColumn,$orderby,$where_array = array(),$search= array())
	{ 
		$this->db->select('blog_category.*,blog_category_lang.category_name,blog_category_lang.meta_title,blog_category_lang.meta_description,blog_category_lang.seo_keywords');
		$this->db->join('blog_category_lang','blog_category_lang.	blog_category_id  = blog_category.id');
		$this->db->where('language', $this->session->userdata('language_code'));
		if ($search != '') {			
			if(@$search['statuss']){
				//if ($match_held !== 'expired') {	
				$this->db->where_in('blog_category.category_status', $search['statuss']);
				//}
			}

			if(@$search['category_name']){
				$this->db->group_start();
				$this->db->like('blog_category_lang.category_name', $search['category_name']);
				$this->db->or_like('blog_category_lang.category_name', $search['category_name']);
			
				$this->db->group_end();
			}


		}
		$query = $this->db->get('blog_category');
		return $query;
	}

	public function getBlogTagList($row_no="",$row_per_page="",$orderColumn,$orderby,$where_array = array(),$search= array())
	{ 

	
		$this->db->select('blog_tags.*');
		
		if (!empty($where_array)) {
			foreach ($where_array as $columnkey => $value) {
				$this->db->where($columnkey, $value);
			}
		}

		if ($search != '') {			

			if(@$search['statuss']){
				$this->db->where_in('blog_tags.status', $search['statuss']);
			}
			
			// if(@$search['category_ids']){
			// 	$this->db->where_in('blog.blog_category', $search['category_ids']);
			// }
			if(@$search['blog_tag_en']){
				$this->db->group_start();
				$this->db->like('blog_tags.blog_tag_name_en', $search['blog_tag_en']);
				$this->db->or_like('blog_tags.blog_tag_name_en', $search['blog_tag_en']);
				$this->db->group_end();
			}

			if(@$search['blog_tag_ar']){
				$this->db->group_start();
				$this->db->like('blog_tags.blog_tag_name_ar', $search['blog_tag_ar']);
				$this->db->or_like('blog_tags.blog_tag_name_ar', $search['blog_tag_ar']);
				$this->db->group_end();
			}


		}

		if ($orderColumn != "" && $orderby != "") {
			$this->db->order_by($orderColumn, $orderby);
		}
		else{
			$this->db->order_by('blog_tag_id', 'desc');
		}
		// if ($search != '') {
		// 	$this->db->like('match_info_lang.match_name', $search);
		// 	//$this->db->or_like('otherevent_category.category_name', $search);
		// }
	//	$this->db->group_by('blog.id');
		if ($row_per_page != '') {
			$this->db->limit($row_per_page, $row_no);
		}

		$query = $this->db->get('blog_tags');

		//  echo $this->db->last_query();
		//  exit;
		return $query;
	}

	public function getTagBlog($id)
	{ 
		$this->db->where('blog_tag_id', $id);
		$this->db->select('blog_tags.*');
		$query = $this->db->get('blog_tags');
		return $query->row();
	}

}