<?php
class Page extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this->load->model('page_m');
	}

	public function index ()
	{
		// Fetch all pages
		$this->data['pages'] = $this->page_m->get_with_parent();
		
		//$this->data['userpages'] = $this->page_m->user_display();
		
		// Load view
		$this->data['subview'] = 'admin/dashboard/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function order ()
	{
		$this->data['sortable'] = TRUE;
		$this->data['subview'] = 'admin/page/order';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function order_ajax ()
	{
		// Save order from ajax call
		if (isset($_POST['sortable'])) {
			$this->page_m->save_order($_POST['sortable']);
		}
		
		// Fetch all pages
		$this->data['pages'] = $this->page_m->get_nested();
		$this->session->set_flashdata('success', 'Pages successfully ordered.');
		// Load view
		$this->load->view('admin/page/order_ajax', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_m->get($id);
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
			$dir = $this->data['page']->dir;
			//echo $dir;
		}
		else {
			$this->data['page'] = $this->page_m->get_new();
			$dir = $this->input->post('slug').'-'.now();
			//echo $dir;
		}
		
		// Pages for dropdown
		$this->data['pages_no_parents'] = $this->page_m->get_no_parents();
		
		// Set up the form
		$rules = $this->page_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'title'=>$this->input->post('title'), 
				'slug'=>$this->input->post('slug'),
				'body'=>$this->input->post('body'),
				'photo'=>$this->input->post('imago-dropzone'),
				'template'=>$this->input->post('template'), 
				'parent_id'=>$this->input->post('parent_id'),
				'timestamp'=>$this->input->post('timestamp'),
				'dir'=>$dir
			);
			$this->page_m->save($data, $id);
			$this->session->set_flashdata('success', 'Page inserted.');
			if(!$id)
				{
					mkdir('assets/page/'.$dir.'/',0777);
					mkdir('assets/page/'.$dir.'/thumbnails/',0777);
				}
			redirect('admin/page');
		}
		
		
		// Load the view
		$this->data['subview'] = 'admin/page/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function upload_img($pagetitle,$pageid)
	{
		
		$timestamp = now();
		$page = $this->page_m->get($pageid);
		$params = array(
					"upload_folder"=>"assets/page/".$page->dir."/",
					"upload_thumb_folder"=>"assets/page/".$page->dir."/thumbnails/",
					"delete_url"=>base_url() . "admin/page/deleteImage/",
					"filename"=> $pagetitle.'-'.$timestamp,
					"width"=> "160",
					"height"=> "160",
					"table_name"=>"pagephotos",
					"table_field"=>"pageid",
					"table_data"=> $pageid,
				);
		$this->load->library("uploader",$params);
		$file_data = $this->uploader->upload_img();
	}
	
	public function get_files($id = NULL)
	{
		$page = $this->page_m->get($id);
		$params = array(
					"upload_folder"=>"assets/page/".$page->dir."/",
					"upload_thumb_folder"=>"assets/page/".$page->dir."/thumbnails/",
					"delete_url"=>base_url() . "admin/page/deleteImage/",
					"filename"=>"",
					"show_all"=>TRUE,
				);
		$this->load->library("uploader",$params);
		$this->uploader->get_files();
	}
	
	public function delete ($id)
	{
		$params = array(
					"upload_folder"=>"assets/page/",
					"upload_thumb_folder"=>"assets/page/thumbnails/",
					"delete_url"=>base_url() . "admin/page/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$this->page_m->delete($id);
		redirect('admin/page');
	}

	public function deleteImage ($photo)
	{
		$pageid =  $this->db->get_where('pagephotos',array('title'=>$photo))->row();
		$id = $pageid->pageid;
		$page = $this->page_m->get($id);
		$params = array(
					"upload_folder"=>"assets/page/".$page->dir."/",
					"upload_thumb_folder"=>"assets/page/".$page->dir."/thumbnails/",
					"delete_url"=>base_url() . "admin/page/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$this->db->where('title',$photo);
		$this->db->delete('pagephotos');
	}
	
	public function _unique_slug ($str)
	{
		// Do NOT validate if slug already exists
		// UNLESS it's the slug for the current page
		

		$id = $this->uri->segment(4);
		$this->db->where('slug', $this->input->post('slug'));
		! $id || $this->db->where('id !=', $id);
		$page = $this->page_m->get();
		
		if (count($page)) {
			$this->form_validation->set_message('_unique_slug', '%s already exists, choose a unique slug');
			return FALSE;
		}
		
		return TRUE;
	}
	
	
	
	
}