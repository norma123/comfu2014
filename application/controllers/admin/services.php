<?php
class Services extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('services_m');
		
	}

	public function index ()
	{
		// Fetch all services
		$this->data['services'] = $this->services_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/services/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a services or set a new one
		if ($id) {
			$this->data['service'] = $this->services_m->get($id);
			count($this->data['service']) || $this->data['errors'][] = 'services could not be found';
		}
		else {
			$this->data['service'] = $this->services_m->get_new();
		}
		
		// Set up the form
		$rules = $this->services_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'title'=>mysql_real_escape_string($this->input->post('title')), 
				'description1'=>$this->input->post('description1'),
				'description2'=>$this->input->post('description2'),
				'description3'=>$this->input->post('description3'),
				'timestamp'=>$this->input->post('timestamp')
			);
			$this->services_m->save($data, $id);
			$this->session->set_flashdata('success', 'service inserted.');
			redirect('admin/services');
		}
		
		// Load the view
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/services/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	
	
	public function delete ($id)
	{
		$this->services_m->delete($id);
		redirect('admin/services');
	}
	
	
	public function _unique_itemid ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current itemid
		
		$id = $this->uri->segment(4);
		$this->db->where('itemid', $this->input->post('itemid'));
		!$id || $this->db->where('id !=', $id);
		$itemid = $this->services_m->get();
		
		if (count($itemid)) {
			$this->form_validation->set_message('_unique_itemid', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}