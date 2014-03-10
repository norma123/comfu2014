<?php
class Terms extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
		// Load view
		$this->data['privacy'] = $this->db->get_where('privacyterms',array('id'=>2))->row();
		$this->data['subview'] = 'admin/terms/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function edit($id = NULL)
	{
		$data = array(
					'title'=>$this->input->post('title'), 
					'description'=>$this->input->post('description')
				);
				$this->db->where('id',2);
				$this->db->update('privacyterms',$data);
				$this->session->set_flashdata('success', 'Successfully edited.');
				redirect('admin/terms/index/2');
	}
}