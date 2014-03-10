<?php
class Scopes extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('scopes_m');
		
	}

	public function index ()
	{
		// Fetch all scopes
		$this->data['scopes'] = $this->scopes_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/scopes/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a scopes or set a new one
		if ($id) {
			$this->data['scope'] = $this->scopes_m->get($id);
			count($this->data['scope']) || $this->data['errors'][] = 'scopes could not be found';
		}
		else {
			$this->data['scope'] = $this->scopes_m->get_new();
		}
		
		// Set up the form
		$rules = $this->scopes_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'name'=>mysql_real_escape_string($this->input->post('name'))
			);
			$this->scopes_m->save($data, $id);
			$this->session->set_flashdata('success', 'scope inserted.');
			redirect('admin/scopes');
		}
		
		// Load the view
		$this->output->set_header('Content-scope: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/scopes/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function delete ($id)
	{
		$this->scopes_m->delete($id);
		redirect('admin/scopes');
	}
}