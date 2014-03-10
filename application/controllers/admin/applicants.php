<?php
class Applicants extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('applicants_m');
		
	}

	public function index ()
	{
		$id=null;
		$this->db->select('id');
		$query = $this->db->get('applicants')->row_array();
		if($query)
		$id = $query['id'];
		
		if ($id) {
			$this->data['contact'] = $this->applicants_m->get($id);
		}else{
			$this->data['contact'] = $this->applicants_m->get_contact_info();
		}
		
		// Set up the form
		$rules = $this->applicants_m->inforules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->applicants_m->array_from_post(array(
				'to', 
				'cc', 
				'bcc'
			));
			$this->applicants_m->save($data, $id);
			$this->session->set_flashdata('success', 'Contact details Inserted.');
			redirect('admin/applicants');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/contactus/applicants';
		$this->load->view('admin/_layout_main', $this->data);
	}
}