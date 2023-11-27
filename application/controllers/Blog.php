<?php

error_reporting(0);
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller
{
	public function __construct()
	{
		
		/*
         *  Developed by: Sivakumar G
         *  Date    : 22 January, 2022
         *  1BoxOffice Hub
         *  https://www.1boxoffice.com/
        */
		parent::__construct();
		$this->load->model('Blog_Model');
		$this->check_isvalidated();
		$this->app_name = $this->General_Model->get_type_name_by_id('general_settings', '1', 'settings_value');
		$this->app_login_image = $this->General_Model->get_type_name_by_id('general_settings', '13', 'settings_value');
		$this->app_title = $this->General_Model->get_type_name_by_id('general_settings', '2', 'settings_value');
		$this->general_path = $this->General_Model->get_type_name_by_id('general_settings', '16', 'settings_value');
		$this->app_favicon = $this->General_Model->get_type_name_by_id('general_settings', '15', 'settings_value');
		$this->login_image = $this->General_Model->get_type_name_by_id('general_settings', '13', 'settings_value');
		$this->logo = $this->General_Model->get_type_name_by_id('general_settings', '17', 'settings_value');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->data = array();
		$this->data['app'] = $this->app_data();
	}	
	private function check_isvalidated()
	{ 	
		if(!$this->session->userdata('admin_logged_in')){
			redirect(base_url(), 'refresh');
		}
		if ($this->session->userdata('role') != 1 &&  $this->session->userdata('role') != 2 &&  $this->session->userdata('role') != 3) {
			if ($this->session->userdata('admin_logged_in') && $this->session->userdata('role') != 6) {
				$controller_name = $this->router->fetch_class();
				$function_name = $this->router->fetch_method();
				$this->load->model('Privilege_Model');
				$sub_admin_id = $this->session->userdata('admin_id');
				//echo $sub_admin_id;exit;
				if (!$this->Privilege_Model->get_allowed_pages($sub_admin_id, $controller_name, $function_name) && !$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id, $controller_name, $function_name)) {
					redirect(base_url() . 'access/error_denied', 'refresh');
				}
			} /*else {
				redirect(base_url(), 'refresh');
			}*/
		}
		else{
			redirect(base_url() . 'access/error_denied', 'refresh');
		}
	}

	public function app_data()
	{

		$this->data['app_name'] = $this->app_name;
		$this->data['app_login_image'] = $this->app_login_image;
		$this->data['app_title'] = $this->app_title;
		$this->data['general_path'] = $this->general_path;
		$this->data['app_favicon'] = $this->app_favicon;
		$this->data['login_image'] = $this->login_image;
		$this->data['logo'] = $this->logo;
		$this->data['languages'] = $this->General_Model->getAllItemTable('language','store_id',$this->session->userdata('storefront')->admin_id)->result();
		$this->data['branches'] = $this->General_Model->get_admin_details_by_role(4,'ACTIVE');
		/*if ($this->session->userdata('storefront')->company_name == '') {
				$branches = $this->General_Model->get_admin_details(13);
				$sessionUserInfo = array('storefront' => $branches);
				$this->session->set_userdata($sessionUserInfo);
		}*/
		return $this->data;
	}


	public function category()
	{
		
		$idiom = $this->session->get_userdata('language');
		// print_r($idiom); exit;
		$this->lang->load('message', 'english');
		$segment = $this->uri->segment(3);
		$table = "blog_category";
		if ($segment == 'lists') {
			$this->load->view(THEME.'blog/lists_category', $this->data);
			// $row_count =   $this->uri->segment(5);
			// $flag = $this->uri->segment(4);
			// $this->loadRecord($row_count, 'blog_category', 'blog/category/'.$flag, 'id', 'DESC', 'blog/lists_category', 'results', 'logs',$_POST);
		}
		else if ($segment == 'add') {
			$this->data['result'] = $this->Blog_Model->getrow($table,'id','');
			$this->load->view(THEME.'blog/add_category', $this->data);
		}
		else if ($segment == 'edit') {
			//$segment4 = $this->uri->segment(4);
			$segment4 = json_decode(base64_decode($this->uri->segment(4)));
			if ($segment4 != "") {
				$edit_cat_id = $segment4;
				$this->data['result'] = $this->Blog_Model->getBlogCategory($edit_cat_id);
			}
			$this->load->view(THEME.'blog/add_category', $this->data);
		}
		else if ($segment == 'save') {
			if ($this->input->post()) {
				$this->form_validation->set_rules('category_name', 'Category Name', 'required');
				if ($this->form_validation->run() !== false) {

					$id = $this->input->post('id');
					if ($id == '') {

						$category_slug = $this->input->post('category_name');

						$insert_data = array(
							'category_name' 	=> $this->input->post('category_name'),
							'category_slug' 	=> $this->slugify($category_slug),
							'meta_title' 		=> $this->input->post('meta_title'),
							'meta_description'  => $this->input->post('meta_description'),
							'seo_keywords' 		=> $this->input->post('seo_keywords'),
							'created_at' 		=> (date('Y-m-d H:i:s'))
							);
						//print_r($insert_data);die;
						$inserted_id = $this->General_Model->insert_data($table, $insert_data);
						if ($inserted_id) {
							$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
								foreach ($lang as $key => $l_code) {
									$language_data = array(
										'language' 				=>  $l_code->language_code,
										'blog_category_id' 		=> $inserted_id,
										'category_name' 	=> $this->input->post('category_name'),
										'meta_title' 		=> $this->input->post('meta_title'),
										'meta_description' => $this->input->post('meta_description'),
										'seo_keywords' 		=> $this->input->post('seo_keywords'),
									);
									$this->General_Model->insert_data('blog_category_lang', $language_data);
								}
								$response = array('msg' => 'Blog Category Created Successfully.', 'redirect_url' => base_url() . 'blog/category/lists', 'status' => 1);
							}
							else {
								$response = array('msg' => 'Failed to create Blog Category.', 'redirect_url' => base_url() . 'blog/category/add', 'status' => 0);
							}
						}
						else{
							$updateData = array();
							$updateData_lang = array();


							if($this->session->userdata('language_code')  == 'en'){
								$updateData['category_name'] = $this->input->post('category_name');
							}


							$updateData['category_status'] = $this->input->post('status') ? 1 : 0;
							$this->General_Model->update('blog_category', array('id' => $id), $updateData);
							//echo $this->db->last_query();
							//Update language table			
							$updateData_lang = array(
								
								'category_name' 	=> $this->input->post('category_name'),
								'meta_title' 		=> $this->input->post('meta_title'),
								'meta_description'  => $this->input->post('meta_description'),
								'seo_keywords' 		=> $this->input->post('seo_keywords'),
							);
						
							$this->General_Model->update('blog_category_lang', array(
									'blog_category_id' => $id, 
									'language' => $this->session->userdata('language_code')
								), $updateData_lang);
							//echo $this->db->last_query();
							$response = array('msg' => 'Blog Category Updated Successfully.', 'redirect_url' => base_url() . 'blog/category/lists', 'status' => 1);
						}

						echo json_encode($response);
						exit;
						redirect('blog/category/lists');


				}
			}
		}
		else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
		
			$delete_id = json_decode(base64_decode($segment4));
			$this->General_Model->delete_data('blog_category_lang', 'blog_category_id', $delete_id);

			$delete = $this->General_Model->delete_data('blog_category', 'id', $delete_id);
			if ($delete == 1) {
				redirect('blog/category/lists');die;
				$response = array('status' => 1, 'msg' => 'Blog category deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				redirect('blog/category/lists');die;
				$response = array('status' => 1, 'msg' => 'Error while deleting game category.');
				echo json_encode($response);
				exit;
			}
		}

	}

	function alpha_dash_space($str)
	{
		return TRUE;
		// if($this->session->userdata('language_code') == "en"){
		// 	if($str){
		// 		if (! preg_match('/^[A-Za-z0-9_~\-!?@#\$%\^&*\(\)]+$/', strip_tags($str))) {
		//         $this->form_validation->set_message('alpha_dash_space', ' %s Please add only english value.');
		// 	        return FALSE;
		// 	    } else {
		// 	        return TRUE;
		// 	    }
		// 	}
		// 	else {
		//         return TRUE;
		//     }
		// }
		// else{
		// 	return TRUE;
		// }
	    
	}

	public function index()
	{
		//error_reporting(E_ALL);
		$idiom = $this->session->get_userdata('language');
		// print_r($idiom); exit;
		$this->lang->load('message', 'english');
		$segment = $this->uri->segment(3);
		$table = "blog";
		if ($segment == 'lists') {
			$this->data['blog_category'] = $this->Blog_Model->getBlogCategoryList('', '1000000', '', '', '',array())->result();
			$this->load->view(THEME.'blog/lists_blog', $this->data);
			// $row_count =   $this->uri->segment(5);
			// $flag = $this->uri->segment(4);
			// $this->loadRecord($row_count, 'blog', 'blog/lists/'.$flag, 'id', 'DESC', 'blog/lists_blog', 'results', 'blog',$_POST);
		}
		else if ($segment == 'add') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['result'] = $this->Blog_Model->getrow($table,'id','');
			$table2 = "blog_category";
			$this->data['category'] = $this->Blog_Model->getAllItemTable($table2,$rowno,10000,'','')->result();
			$this->data['blog_tags'] = $results = $this->Blog_Model->getBlogTagList("", "", "", "", '',"")->result();
			$this->load->view(THEME.'blog/add_blog', $this->data);
		}
		else if ($segment == 'edit') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				
				$edit_cat_id = json_decode(base64_decode($segment4));
				$table2 = "blog_category";
				$this->data['category'] = $this->Blog_Model->getAllItemTable($table2,$rowno,10000,'','')->result();
				$this->data['result'] = $this->Blog_Model->getBlog($edit_cat_id);
				$this->data['blog_lang'] = $this->Blog_Model->getBlog_lang($edit_cat_id)->row();
				
				$this->data['blog_tags'] = $results = $this->Blog_Model->getBlogTagList("", "", "", "", '',"")->result();
			}
			//echo $segment4;
			//echo $this->db->last_query();die;
			$this->load->view(THEME.'blog/add_blog', $this->data);
		}
		else if ($segment == 'save') {
			if ($this->input->post()) {

				if(!empty($_POST['blog_tags']))
					$_POST['blog_tags']=implode(",",$_POST['blog_tags']);

					$id = $this->input->post('id');
					if ($id == '') {

						$this->form_validation->set_rules('blog_category', 'Category Name', 'required');
						$this->form_validation->set_rules('blog_slug', 'Blog Slug English', 'required|callback_alpha_dash_space');
						$this->form_validation->set_rules('blog_name', 'Blog Name ', 'required|callback_alpha_dash_space');	
						$this->form_validation->set_rules('blog_description', 'Blog Description', 'required|callback_alpha_dash_space');
						$this->form_validation->set_rules('blogdate', 'Blog Publish date', 'required');
						if($this->form_validation->run() == false)
						{
							$response = array('status' => 0, 'msg' => validation_errors());
								echo json_encode($response);
								exit;
						}
						else{

							$blog_title = $this->input->post('blog_name');
							$blogdate = $this->input->post('blogdate');

							$blog_slug = $this->input->post('blog_slug');

							 $insert_data = array(
								'blog_category' 	=> $this->input->post('blog_category'),
								'blog_type' 		=> $this->input->post('blog_type'),
								'country' 			=> $this->input->post('country'),
								'blog_description' 	=> $this->input->post('blog_description'),
								'blog_title' 		=> $blog_title,
								'blog_slug' 		=> $this->slugify($blog_slug),
								'blog_status' 	    => $this->input->post('blog_status') ? $this->input->post('blog_status') : 0 , 
								'meta_title' 		=> $this->input->post('meta_title'),
								'meta_description'  => $this->input->post('meta_description'),
								'blog_tag_id'  		=> $this->input->post('blog_tags'),
								'seo_keywords' 		=> $this->input->post('seo_keywords'),
								'created_at' 		=> date('Y-m-d h:i:s',strtotime($blogdate))
								);

							//print_r($insert_data);
							if (!empty($_FILES['blog_small']['name'])) {
								
								 $config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/blog';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if ($this->upload->do_upload('blog_small')) {
									$outputData['blog_small'] = $this->upload->data();
									 $insert_data['blog_small'] = $outputData['blog_small']['file_name'];
								} else {
									 print_r($this->upload->display_errors());							
									$msg = 'Failed to add blog small image';
											$response = array('status' => 0, 'msg' => $msg);
										echo json_encode($response);
										exit;
								}
								//echo $error;
							}


							if (!empty($_FILES['blog_medium']['name'])) {
								$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/blog';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if ($this->upload->do_upload('blog_medium')) {
									$outputData['blog_medium'] = $this->upload->data();
									$insert_data['blog_medium'] = $outputData['blog_medium']['file_name'];
								} else {
									$msg = 'Failed to add blog medium image';
									$response = array('status' => 0, 'msg' => $msg);
									echo json_encode($response);
									exit;
								}
							}

							if (!empty($_FILES['blog_large']['name'])) {
								$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/blog';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if ($this->upload->do_upload('blog_large')) {
									$outputData['blog_large'] = $this->upload->data();
									$insert_data['blog_large'] = $outputData['blog_large']['file_name'];
								} else {
									$msg = 'Failed to add blog large image';
									$response = array('status' => 0, 'msg' => $msg);
									echo json_encode($response);
									exit;
								}
							}
							// die;
							// pr($insert_data);
							// die;

						
							//print_r($insert_data);die;
							$inserted_id = $this->General_Model->insert_data($table, $insert_data);
							//echo $this->db->last_query();
							if ($inserted_id) {
								$lang = $this->General_Model->getAllItemTable('language', 'store_id', $this->session->userdata('storefront')->admin_id)->result();
									foreach ($lang as $key => $l_code) {
										$language_data = array(
											'language' 				=>  $l_code->language_code,
											'blog_id' 				=> $inserted_id,
											'blog_title' 			=> $blog_title,
											'blog_description' 		=> $this->input->post('blog_description'),
											'blog_short_description' 		=> $this->input->post('blog_short_description'),
											'meta_title' 			=> $this->input->post('meta_title'),
											'meta_description' 		=> $this->input->post('meta_description'),
											'seo_keywords' 			=> $this->input->post('seo_keywords'),
											'blog_tag_id' 			=> $this->input->post('blog_tags'),
											'store_id' 			=> $this->session->userdata('storefront')->admin_id
										);
										$this->General_Model->insert_data('blog_lang', $language_data);
									}
									$response = array('msg' => 'Blog Category Created Successfully.', 'redirect_url' => base_url() . 'blog/index/lists', 'status' => 1);
								}
								else {
									$response = array('msg' => 'Failed to create Blog Category.', 'redirect_url' => base_url() . 'blog/index/add', 'status' => 0);
								}
							}

							echo json_encode($response);
							exit;
							redirect('blog/lists');
					}
					else{
							$updateData = array();
							$updateData_lang = array();

							$blog_title = $this->input->post('blog_name');
							$blogdate = $this->input->post('blogdate');

							if($this->session->userdata('language_code')  == 'en'){
								$updateData['blog_title'] = $this->input->post('blog_name');
							}
							$updateData['created_at'] = date('Y-m-d h:i:s',strtotime($blogdate));
							$updateData['blog_status'] = $this->input->post('blog_status') ? 1 : 0;
							$updateData['blog_category'] = $this->input->post('blog_category');
							$updateData['blog_type'] = $this->input->post('blog_type');
							$updateData['country'] = $this->input->post('country');
							$updateData['blog_tag_id'] = $this->input->post('blog_tags');

							//print_r($insert_data);
							if (!empty($_FILES['blog_small']['name'])) {
								
								$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/blog';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if ($this->upload->do_upload('blog_small')) {
									$outputData['blog_small'] = $this->upload->data();
									 $updateData['blog_small'] = $outputData['blog_small']['file_name'];
								} else {
									 print_r($this->upload->display_errors());							
									$msg .= 'Failed to add event image';
								}
								//echo $error;
							}


							if (!empty($_FILES['blog_medium']['name'])) {
								$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/blog';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if ($this->upload->do_upload('blog_medium')) {
									$outputData['blog_medium'] = $this->upload->data();
									$updateData['blog_medium'] = $outputData['blog_medium']['file_name'];
								} else {
									$msg .= 'Failed to add event image';
								}
							}

							if (!empty($_FILES['blog_large']['name'])) {
								$config['upload_path'] = UPLOAD_PATH_PREFIX.'uploads/blog';
								$config['allowed_types'] = 'jpeg|jpg|png|gif|JPEG|JPG|PNG|GIF|';
								$config['max_size'] = '10000';
								$config['encrypt_name'] = TRUE;
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								if ($this->upload->do_upload('blog_large')) {
									$outputData['blog_large'] = $this->upload->data();
									$updateData['blog_large'] = $outputData['blog_large']['file_name'];
								} else {
									$msg .= 'Failed to add event image';
								}
							}
							//print_r($updateData);die;
							$this->General_Model->update('blog', array('id' => $id), $updateData);
							//echo $this->db->last_query();
							//Update language table			
							$updateData_lang = array(
								'blog_title' 			=> $blog_title,
								'blog_description' 		=> $this->input->post('blog_description'),
								'blog_short_description' 		=> $this->input->post('blog_short_description'),
								'meta_title' 			=> $this->input->post('meta_title'),
								'meta_description' 		=> $this->input->post('meta_description'),
								'seo_keywords' 			=> $this->input->post('seo_keywords'),
								'blog_tag_id' 			=> $this->input->post('blog_tags'),
							);


							$this->db->select('*');
							$this->db->from('blog_lang');
							$this->db->where('blog_id', $id);
							$this->db->where('store_id', $this->session->userdata('storefront')->admin_id);
							$this->db->where('language', $this->session->userdata('language_code'));
							$query = $this->db->get();

							if ($query->num_rows() == 0) {							
								$updateData_lang['blog_id'] = $id;
								$updateData_lang['language'] = $this->session->userdata('language_code');	
								$updateData_lang['store_id'] = $this->session->userdata('storefront')->admin_id;						
								$this->db->insert('blog_lang', $updateData_lang);
							
							} else {
								$this->General_Model->update('blog_lang', array(
									'blog_id' => $id, 
									'language' => $this->session->userdata('language_code')
								), $updateData_lang);
							}
						
							
							//echo $this->db->last_query();
							$response = array('msg' => 'Blog Category Updated Successfully.', 'redirect_url' => base_url() . 'blog/index/lists', 'status' => 1);
						}

						echo json_encode($response);
						exit;
						redirect('blog/lists');

			}
		}
		else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = json_decode(base64_decode($segment4));

			$this->General_Model->delete_data('blog_lang', 'blog_id', $delete_id);

			$delete = $this->General_Model->delete_data('blog', 'id', $delete_id);
			if ($delete == 1) {
				redirect('blog/index/lists');die;
				$response = array('status' => 1, 'msg' => 'Blog category deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				redirect('blog/index/lists');die;
				$response = array('status' => 1, 'msg' => 'Error while deleting game category.');
				echo json_encode($response);
				exit;
			}
		}

	}
	public function blog_tags()
	{
		$idiom = $this->session->get_userdata('language');
		$this->lang->load('message', 'english');
		$segment = $this->uri->segment(3);
		$table = "blog";
		
		if ($segment == 'add') {
			$this->data['countries'] = $this->General_Model->getAllItemTable('countries')->result();
			$this->data['result'] = $this->Blog_Model->getrow($table,'id','');
			$table2 = "blog_category";
			$this->data['category'] = $this->Blog_Model->getAllItemTable($table2,$rowno,10000,'','')->result();
			$this->load->view(THEME.'blog/add_blog_tags', $this->data);
		}
		else if ($segment == 'edit') {
			
			$segment4 = $this->uri->segment(4);
			if ($segment4 != "") {
				
				$edit_id = json_decode(base64_decode($segment4));
				$table2 = "blog_tags";
				 $this->data['result'] = $this->Blog_Model->getTagBlog($edit_id);
				 
			}
			//echo $segment4;
			//echo $this->db->last_query();die;
			

			$this->load->view(THEME.'blog/add_blog_tags', $this->data);
		}
		else if ($segment == 'save') {
			if ($this->input->post()) {
					$id = $this->input->post('id');
					if ($id == '') {

						$this->form_validation->set_rules('blog_tag_name_en', 'Blog Tag Name ENglish', 'required');
						$this->form_validation->set_rules('blog_tag_name_ar', 'Blog Tag Name Arabic', 'required');	
						if($this->form_validation->run() == false)
						{
							$response = array('status' => 0, 'msg' => validation_errors());
								echo json_encode($response);
								exit;
						}
						else{

							$blog_tag_url = $this->input->post('blog_tag_url');

							 $insert_data = array(
								'blog_tag_name_en' 	=> $this->input->post('blog_tag_name_en'),
								'blog_tag_name_ar' 		=> $this->input->post('blog_tag_name_ar'),
								'blog_tag_url' 			=> $this->slugify($blog_tag_url),
								'status' 	    => $this->input->post('status') ? $this->input->post('status') : 0 
								);
							$inserted_id = $this->General_Model->insert_data('blog_tags', $insert_data);
							//echo $this->db->last_query();
							$response = array('msg' => 'Blog Tags Created Successfully.', 'redirect_url' => base_url() . 'blog/blog_tags/', 'status' => 1);

							}

							echo json_encode($response);
							exit;
							redirect('blog_tags/');
					}
					else{
							$updateData = array();
							$blog_tag_url = $this->input->post('blog_tag_url');
							$updateData['status'] = $this->input->post('status') ? 1 : 0;
							$updateData['blog_tag_name_en'] = $this->input->post('blog_tag_name_en');
							$updateData['blog_tag_name_ar'] = $this->input->post('blog_tag_name_ar');
							$updateData['blog_tag_url'] = $this->slugify($blog_tag_url);
						
							//print_r($updateData);die;
							$this->General_Model->update('blog_tags', array('blog_tag_id' => $id), $updateData);
							//echo $this->db->last_query();
							$response = array('msg' => 'Blog Tags Updated Successfully.', 'redirect_url' => base_url() . 'blog/blog_tags/', 'status' => 1);
						}

						echo json_encode($response);
						exit;
						redirect('blog_tags/');

			}
		}
		else if ($segment == 'delete') {
			$segment4 = $this->uri->segment(4);
			$delete_id = json_decode(base64_decode($segment4));

			$delete = $this->General_Model->delete_data('blog_tags', 'blog_tag_id', $delete_id);
			if ($delete == 1) {
				$response = array('status' => 1, 'msg' => 'Blog Tags deleted Successfully.');
				echo json_encode($response);
				exit;
			} else {
				redirect('blog/blog_tags/');die;
				$response = array('status' => 1, 'msg' => 'Error while deleting game category.');
				echo json_encode($response);
				exit;
			}
		}
		else {
			$this->data['blog_category'] = $this->Blog_Model->getBlogTagsList('', '1000000', '', '', '',array())->result();
			$this->load->view(THEME.'blog/blog_tags_list', $this->data);
		}

	}
	/**
	 * Fetch data and display based on the pagination request
	 */
	public function loadRecord($rowno = 0, $table, $url, $order_column, $order_by, $view, $variable_name, $type, $search = '')
	{ 

		// Load Pagination library
		$this->load->library('pagination');

		// Row per page
		$row_per_page = 10;

		// Row position
		if ($rowno != 0) {
			$rowno = ($rowno - 1) * $row_per_page;
		}
		// All records count
		$allcount = $this->Blog_Model->getrow($table);
			// Get records
		$record = $this->Blog_Model->getAllItemTable($table,$rowno,$row_per_page,'','', $order_column, $order_by)->result();
		//echo $this->db->last_query();
		// Pagination Configuration
		$config['base_url'] = base_url() . $url;
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $row_per_page;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = ' ';
		$config['next_tag_open'] = '<li><a data-page="next"><i class=" fas fa-angle-right"></a></i>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = ' ';
		$config['prev_tag_open'] = '<li><a data-page="prev"><i class="fas fa-angle-left"></a></i>';
		$config['prev_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['first_link'] = '<<';

		// Initialize
		$this->pagination->initialize($config);

		$this->data['pagination'] = $this->pagination->create_links();
		$this->data[$variable_name] = $record;
		$this->data['row'] = $rowno;
		$this->data['search'] = $search;
		// Load view
		$this->load->view($view, $this->data);
	}


	function slugify($text)
	{
	    // Strip html tags
	    $text=strip_tags($text);
	    // Replace non letter or digits by -
	    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
	    // Transliterate
	    setlocale(LC_ALL, 'en_US.utf8');
	    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	    // Remove unwanted characters
	    $text = preg_replace('~[^-\w]+~', '', $text);
	    // Trim
	    $text = trim($text, '-');
	    // Remove duplicate -
	    $text = preg_replace('~-+~', '-', $text);
	    // Lowercase
	    $text = strtolower($text);
	    // Check if it is empty
	    if (empty($text)) { return 'n-a'; }
	    // Return result
	    return $text;
	}

	public function ajax(){

		$postData  = $_POST;
		## Read value
		$draw = $postData['draw'];
		$rowno = $postData['start'];
		$row_per_page = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column'] ; // Column index
		//$order_column = $postData['columns'][$columnIndex]['data'] ; // Column name
		$order_column = "";
		$order_by = $postData['order'][0]['dir']; // asc or desc
		$search = $postData['search']['value']; // Search value
		$flag = $postData['flag'];
		$search_data[] = array();
		
		if($postData['category_ids'] !="") 
			$search_data['category_ids'] = explode(",", $postData['category_ids']) ;

		if($postData['blog_title'] !="") 
			$search_data['blog_title'] = $postData['blog_title'] ;

		if($postData['statuss']!="") 
			$search_data['statuss'] = explode(",", $postData['statuss']) ;

		$table = "blog";

		$allcount = $this->Blog_Model->getBlogList('', '1000000', '', '', '',$search_data)->num_rows();
		$results = $this->Blog_Model->getBlogList($rowno, $row_per_page, $order_column, $order_by, '',$search_data)->result();
	
		// print_r($results);
		//echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($results as $row ){

             $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';


            $edit_url = "blog/index/edit/".base64_encode(json_encode($row->id)); 

            // Edit
            $edit_content  .= '<a href="'.base_url($edit_url).'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit </a>';

            //Delete 
 	  		$edit_content  .= '<a id="branch_'.$row->id.'" href="javascript:void(0);" data-href="'.base_url().'blog/index/delete/'.base64_encode(json_encode($row->id)).'" class="dropdown-item delete_action"  onClick="delete_data('.$row->id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp; Delete</a>';

 	  		$edit_content .= "</div></div>";
 	  		

 	  		if ($row->blog_status == '1') {  
				$status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
			}
			else if ($row->blog_status != '1') { 
				$status ='<div class="bttns"><span class="badge badge-danger">Inactive</span></div>';
			} 

		


			if($row->blog_type == 1){
				$blog_type = "Blog";
			}
			else if($row->blog_type == 2){
				$blog_type = "News";
			}
			if($row->blog_type == 3){
				$blog_type = "Articles";
			}
	        $data[] = array( 
			   
	            "blog_type"			=> $blog_type,
	            "category"			=> $row->category_name,
	            "blog_title"		=> '<a href="'.base_url($edit_url).'" > '.$row->blog_title.' </a>' ,
	            
	            "status"			=> $status,
	            "date"				=> date('d M Y,  H:i',strtotime($row->created_at)),
	            "action"			=> $edit_content,

	        ); 
	     }

	     ## Response
	     $response = array(
	        "draw" => intval($draw),
	        "iTotalRecords" => $allcount,
	        "iTotalDisplayRecords" => $allcount,
	        "aaData" => $data
	     );

	     echo json_encode($response); 
	     die;
	}

	public function category_ajax(){

		$postData  = $_POST;
		## Read value
		$draw = $postData['draw'];
		$rowno = $postData['start'];
		$row_per_page = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column'] ; // Column index
		//$order_column = $postData['columns'][$columnIndex]['data'] ; // Column name
		$order_column = "";
		$order_by = $postData['order'][0]['dir']; // asc or desc
		$search = $postData['search']['value']; // Search value
		$flag = $postData['flag'];
		$search_data[] = array();
		
	
		if($postData['category_name'] !="") 
			$search_data['category_name'] = $postData['category_name'] ;

		if($postData['statuss']!="") 
			$search_data['statuss'] = explode(",", $postData['statuss']) ;

		$table = "blog";

		$allcount = $this->Blog_Model->getBlogCategoryList('', '1000000', '', '', '',$search_data)->num_rows();
		$results = $this->Blog_Model->getBlogCategoryList($rowno, $row_per_page, $order_column, $order_by, '',$search_data)->result();
	
		// print_r($results);
		//echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($results as $row ){

             $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';


          /*  $edit_url = "blog/category/edit/".base64_encode(json_encode($row->id)); 

            // Edit
            $edit_content  .= '<a href="'.base_url($edit_url).'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit </a>';

            //Delete 
 	  		$edit_content  .= '<a id="branch_'.$row->id.'" href="javascript:void(0);" data-href="'.base_url().'blog/category/delete/'.base64_encode(json_encode($row->id)).'" class="dropdown-item delete_action"  onClick="delete_data('.$row->id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp; Delete</a>';

 	  		$edit_content .= "</div></div>";*/


			   $edit_url= base_url()."blog/category/edit/".base64_encode(json_encode($row->id));

			   $edit_content					=	'<div class="dropdown">
											  <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary" data-toggle="dropdown">
												  <i class="mdi mdi-dots-vertical fs-sm"></i>
											  </a>
											  <div class="dropdown-menu dropdown-menu-right">
												  <a href="'.$edit_url.'" class="dropdown-item">Edit </a>
												  <a href="javascript:void(0)" class="dropdown-item" id="branch_'.$row->id.'" data-href="'.base_url().'blog/category/delete/'.$row->id.'" onclick="delete_data(\''.$row->id.'\');">Delete </a>
											  </div>
										  </div>';
 	  		

 	  		if ($row->category_status == '1') {  
				$status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
			}
			else if ($row->category_status != '1') { 
				$status ='<div class="bttns"><span class="badge badge-danger">Inactive</span></div>';
			} 

		


	        $data[] = array( 
			   
	            "category_name"		=> $row->category_name,
	            "slug"				=> $row->category_slug,
	            "status"			=> $status,
	            "date"				=> date('d M Y,  H:i',strtotime($row->created_at)),
	            "action"			=> $edit_content,

	        ); 
	     }

	     ## Response
	     $response = array(
	        "draw" => intval($draw),
	        "iTotalRecords" => $allcount,
	        "iTotalDisplayRecords" => $allcount,
	        "aaData" => $data
	     );

	     echo json_encode($response); 
	     die;
	}
	public function blog_tags_ajax(){

		$postData  = $_POST;
		## Read value
		$draw = $postData['draw'];
		$rowno = $postData['start'];
		$row_per_page = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column'] ; // Column index
		//$order_column = $postData['columns'][$columnIndex]['data'] ; // Column name
		$order_column = "";
		$order_by = $postData['order'][0]['dir']; // asc or desc
		$search = $postData['search']['value']; // Search value
		$flag = $postData['flag'];
		$search_data[] = array();
		
		// if($postData['category_ids'] !="") 
		// 	$search_data['category_ids'] = explode(",", $postData['category_ids']) ;

		if($postData['blog_tag_en'] !="") 
			$search_data['blog_tag_en'] = $postData['blog_tag_en'] ;

		if($postData['blog_tag_ar'] !="") 
			$search_data['blog_tag_ar'] = $postData['blog_tag_ar'] ;

		if($postData['statuss']!="") 
			$search_data['statuss'] = explode(",", $postData['statuss']) ;

		$table = "blog_tags";


		$allcount = $this->Blog_Model->getBlogTagList('', '1000000', '', '', '',$search_data)->num_rows();
		$results = $this->Blog_Model->getBlogTagList($rowno, $row_per_page, $order_column, $order_by, '',$search_data)->result();
	
		//  print_r($results);
		// echo $this->db->last_query();exit;

		//echo $this->db->last_query();die;
		$data = array();
		$language_code = $this->session->userdata('language_code');
	     foreach($results as $row ){

             $edit_content  = '<div class="dropdown">
                              <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                 data-toggle="dropdown">
                                 <i class="mdi mdi-dots-vertical fs-sm"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">';


            $edit_url = "blog/blog_tags/edit/".base64_encode(json_encode($row->blog_tag_id)); 

            // Edit
            $edit_content  .= '<a href="'.base_url($edit_url).'" class="dropdown-item"><i class=" fas fa-pencil-alt mr-1"></i>&nbsp; Edit </a>';

            //Delete 
 	  		$edit_content  .= '<a id="branch_'.$row->blog_tag_id.'" href="javascript:void(0);" data-href="'.base_url().'blog/blog_tags/delete/'.base64_encode(json_encode($row->blog_tag_id)).'" class="dropdown-item delete_action"  onClick="delete_data('.$row->blog_tag_id.')" ><i class=" fas fa-trash mr-1"></i>&nbsp; Delete</a>';

 	  		$edit_content .= "</div></div>";
 	  		

 	  		if ($row->status == '1') {  
				$status = '<div class="bttns"> <span class="badge badge-success">Active</span> </div>';
			}
			else if ($row->status != '1') { 
				$status ='<div class="bttns"><span class="badge badge-danger">Inactive</span></div>';
			} 
	        $data[] = array( 			   
	            "blog_tag_name_en"			=> $row->blog_tag_name_en,
	            "blog_tag_name_ar"		=>$row->blog_tag_name_ar,	            
	            "status"			=> $status,
	            "action"			=> $edit_content,

	        ); 
	     }

	     ## Response
	     $response = array(
	        "draw" => intval($draw),
	        "iTotalRecords" => $allcount,
	        "iTotalDisplayRecords" => $allcount,
	        "aaData" => $data
	     );

	     echo json_encode($response); 
	     die;
	}
}