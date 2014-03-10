<?php
class Locations extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('locations_m');
		
	}

	public function index ()
	{
		// Fetch all locations
		$this->data['locations'] = $this->locations_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/locations/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a locations or set a new one
		if ($id) {
			$this->data['location'] = $this->locations_m->get($id);
			count($this->data['location']) || $this->data['errors'][] = 'locations could not be found';
		}
		else {
			$this->data['location'] = $this->locations_m->get_new();
		}
		
		// Set up the form
		$rules = $this->locations_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'name'=>mysql_real_escape_string($this->input->post('name'))
			);
			$this->locations_m->save($data, $id);
			$this->session->set_flashdata('success', 'location inserted.');
			redirect('admin/locations');
		}
		
		// Load the view
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/locations/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function delete ($id)
	{
		$this->locations_m->delete($id);
		redirect('admin/locations');
	}
}