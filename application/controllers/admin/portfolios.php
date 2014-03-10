<?php
class Portfolios extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('portfolio_m');
		$this->load->model('locations_m');
		$this->load->model("types_m");
		$this->load->model("scopes_m");
		
	}

	public function index ()
	{
		// Fetch all portfolios
		$this->data['portfolios'] = $this->portfolio_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/portfolios/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a portfolios or set a new one
		if ($id) {
			$this->data['portfolio'] = $this->portfolio_m->get($id);
			$this->db->where('id',$this->data['portfolio']->location);
			$this->data['locationsname'] = $this->locations_m->get();

			$this->data['portfolio'] = $this->portfolio_m->get($id);
			$this->db->where('id',$this->data['portfolio']->type);
			$this->data['typesname'] = $this->types_m->get();
			
			$this->data['portfolio'] = $this->portfolio_m->get($id);
			$this->db->where('id',$this->data['portfolio']->scope);
			$this->data['scopesname'] = $this->scopes_m->get();
		
			$this->data['portfolio'] = $this->portfolio_m->get($id);
			count($this->data['portfolio']) || $this->data['errors'][] = 'portfolios could not be found';
		}
		else {
			$this->data['portfolio'] = $this->portfolio_m->get_new();
		}
		
		// Set up the form
		$rules = $this->portfolio_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'name'=>mysql_real_escape_string($this->input->post('name')), 
				'location'=>mysql_real_escape_string($this->input->post('location')), 
				'projdate'=>mysql_real_escape_string($this->input->post('projdate')), 
				'type'=>mysql_real_escape_string($this->input->post('type')), 
				'scope'=>mysql_real_escape_string($this->input->post('scope')), 
				'consultant'=>mysql_real_escape_string($this->input->post('consultant')), 
				'timestamp'=>$this->input->post('timestamp')
			);
			$this->portfolio_m->save($data, $id);
			$this->session->set_flashdata('success', 'portfolio inserted.');
			redirect('admin/portfolios');
		}
		// Load the view
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/portfolios/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	
	public function delete ($id)
	{
		$this->portfolio_m->delete($id);
		redirect('admin/portfolios');
	}
	
	
	public function _unique_itemid ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current itemid
		
		$id = $this->uri->segment(4);
		$this->db->where('itemid', $this->input->post('itemid'));
		!$id || $this->db->where('id !=', $id);
		$itemid = $this->portfolio_m->get();
		
		if (count($itemid)) {
			$this->form_validation->set_message('_unique_itemid', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}