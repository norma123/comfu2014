<?php
class Videos extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('videos_m');
		
	}

	public function index ()
	{
		// Fetch all videos
		$this->data['videos'] = $this->videos_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/videos/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a videos or set a new one
		if ($id) {
			$this->data['video'] = $this->videos_m->get($id);
			count($this->data['video']) || $this->data['errors'][] = 'Videos could not be found';
		}
		else {
			$this->data['video'] = $this->videos_m->get_new();
		}
		
		// Set up the form
		$rules = $this->videos_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'category'=>$this->input->post('category'),
				'title'=>$this->input->post('title'), 
				'link'=>$this->input->post('link')
			);
			$this->videos_m->save($data, $id);
			$this->session->set_flashdata('success', 'video inserted.');
			redirect('admin/videos');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/videos/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	
	
	public function _validate_category($str)
	{
		if ($str == '')
		{
			$this->form_validation->set_message('_validate_category', 'Category is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function delete($id)
	{
		$this->db->delete('videos', array('id' => $id));
		redirect('admin/videos');
	}
	
	
	public function _unique_itemid ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current itemid
		
		$id = $this->uri->segment(4);
		$this->db->where('itemid', $this->input->post('itemid'));
		!$id || $this->db->where('id !=', $id);
		$itemid = $this->videos_m->get();
		
		if (count($itemid)) {
			$this->form_validation->set_message('_unique_itemid', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}