<?php
class Types extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('types_m');
		
	}

	public function index ()
	{
		// Fetch all types
		$this->data['types'] = $this->types_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/types/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a types or set a new one
		if ($id) {
			$this->data['type'] = $this->types_m->get($id);
			count($this->data['type']) || $this->data['errors'][] = 'types could not be found';
		}
		else {
			$this->data['type'] = $this->types_m->get_new();
		}
		
		// Set up the form
		$rules = $this->types_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'name'=>mysql_real_escape_string($this->input->post('name'))
			);
			$this->types_m->save($data, $id);
			$this->session->set_flashdata('success', 'type inserted.');
			redirect('admin/types');
		}
		
		// Load the view
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/types/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function delete ($id)
	{
		$this->types_m->delete($id);
		redirect('admin/types');
	}
}