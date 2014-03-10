<?php
class careers extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('careers_m');
		
	}

	public function index ()
	{
		// Fetch all careers
		$this->data['careers'] = $this->careers_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/careers/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a careers or set a new one
		if ($id) {
			$this->data['career'] = $this->careers_m->get($id);
			count($this->data['career']) || $this->data['errors'][] = 'careers could not be found';
		}
		else {
			$this->data['career'] = $this->careers_m->get_new();
		}
		
		// Set up the form
		$rules = $this->careers_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'name'=>mysql_real_escape_string($this->input->post('name')), 
				'description'=>$this->input->post('description'),
				'timestamp'=>$this->input->post('timestamp')
			);
			$this->careers_m->save($data, $id);
			$this->session->set_flashdata('success', 'career inserted.');
			redirect('admin/careers');
		}
		
		// Load the view
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/careers/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	
	
	public function delete ($id)
	{
		$this->careers_m->delete($id);
		redirect('admin/careers');
	}
	
	
	public function _unique_itemid ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current itemid
		
		$id = $this->uri->segment(4);
		$this->db->where('itemid', $this->input->post('itemid'));
		!$id || $this->db->where('id !=', $id);
		$itemid = $this->careers_m->get();
		
		if (count($itemid)) {
			$this->form_validation->set_message('_unique_itemid', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}