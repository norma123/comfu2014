<?php
class Varieties extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('varieties_m');
		
	}

	public function index ()
	{
		// Fetch all varieties
		$this->data['varieties'] = $this->varieties_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/varieties/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a Varieties or set a new one
		if ($id) {
			$this->data['variety'] = $this->varieties_m->get($id);
			count($this->data['variety']) || $this->data['errors'][] = 'Varieties could not be found';
		}
		else {
			$this->data['variety'] = $this->varieties_m->get_new();
		}
		
		// Set up the form
		$rules = $this->varieties_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'category'=>$this->input->post('category'),
				'name'=>$this->input->post('name'), 
				//'description'=>$this->input->post('description'),
				//'photo'=>$this->input->post('imago-dropzone'),
				'timestamp'=>$this->input->post('timestamp')
			);
			$this->varieties_m->save($data, $id);
			$this->session->set_flashdata('success', 'variety inserted.');
			redirect('admin/varieties');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/varieties/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function upload_img($imagename,$varietyid)
	{
		$timestamp = now();
		$newname = $imagename.'-'.$timestamp;
		$params = array(
					"upload_folder"=>"assets/varieties/",
					"upload_thumb_folder"=>"assets/varieties/thumbnails/",
					"delete_url"=>base_url() . "admin/varieties/deleteImage/",
					"filename"=> $newname,
					"table_name" =>"varieties",
					"table_id"=> $varietyid,
					"table_update"=> TRUE
				);
		$this->load->library("uploader",$params);
		
		$file_data = $this->uploader->upload_img();
	}
	
	public function get_files($id = NULL)
	{
		
		$file_name = $this->varieties_m->get($id);
			$filename = $file_name->photo;
		$params = array(
					"upload_folder"=>"assets/varieties/",
					"upload_thumb_folder"=>"assets/varieties/thumbnails/",
					"delete_url"=>base_url() . "admin/varieties/deleteImage/",
					"filename"=>$filename,
					
				);
		$this->load->library("uploader",$params);
		$this->uploader->get_files();
	}
	
	
	public function deleteImage ($photo)
	{
		$variety =  $this->db->get_where('varieties',array('photo'=>$photo))->row();
		$id = $variety->id;

		$params = array(
					"upload_folder"=>"assets/varieties/".$variety->photo."/",
					"upload_thumb_folder"=>"assets/varieties/thumbnails/".$variety->photo."/",
					"delete_url"=>base_url() . "admin/varieties/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$data = array(
               'photo' => ''
            );
		$this->db->where('id', $id);
		$this->db->update('varieties', $data); 
	}
	
	public function delete ($id)
	{
		$this->varieties_m->delete($id);
		redirect('admin/varieties');
	}
	
	public function _validate_variety($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_variety', 'variety is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function _validate_section($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_section', 'Section is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function _validate_category($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_category', 'Category is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function _unique_itemid ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current itemid
		
		$id = $this->uri->segment(4);
		$this->db->where('itemid', $this->input->post('itemid'));
		!$id || $this->db->where('id !=', $id);
		$itemid = $this->varieties_m->get();
		
		if (count($itemid)) {
			$this->form_validation->set_message('_unique_itemid', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}