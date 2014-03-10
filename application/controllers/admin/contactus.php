<?php
class Contactus extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('contactus_m');
		
	}

	public function index ()
	{
		// Fetch all contacts
		$this->data['contacts'] = $this->contactus_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/contactus/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a contacts or set a new one
		if ($id) {
			$this->data['contact'] = $this->contactus_m->get($id);
			count($this->data['contact']) || $this->data['errors'][] = 'contacts could not be found';
		}
		else {
			$this->data['contact'] = $this->contactus_m->get_new();
		}
		
		// Set up the form
		$rules = $this->contactus_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'title'=>mysql_real_escape_string($this->input->post('title')), 
				'address'=>mysql_real_escape_string($this->input->post('address')), 
				'block'=>mysql_real_escape_string($this->input->post('block')), 
				'myfloor'=>mysql_real_escape_string($this->input->post('myfloor')), 
				'telephone'=>mysql_real_escape_string($this->input->post('telephone')), 
				'fax'=>mysql_real_escape_string($this->input->post('fax')), 
				'mobile'=>mysql_real_escape_string($this->input->post('mobile')), 
				'mobile2'=>mysql_real_escape_string($this->input->post('mobile2')),
				'email'=>mysql_real_escape_string($this->input->post('email')),
				'timestamp'=>$this->input->post('timestamp')
			);
			$this->contactus_m->save($data, $id);
			$this->session->set_flashdata('success', 'contact inserted.');
			redirect('admin/contactus');
		}
		
		// Load the view
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/contactus/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function delete ($id)
	{
		$this->contactus_m->delete($id);
		redirect('admin/contactus');
	}
	
	public function _validate_contact($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_contact', 'contact is required');
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
}