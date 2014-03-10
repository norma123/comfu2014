<?php
class Applicants_m extends MY_Model
{
	protected $_table_name = 'applicants';
	protected $_order_by = 'applicants.id';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'First Name', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		), 
		'position' => array(
			'field' => 'position', 
			'label' => 'Position', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		), 
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|max_length[100]|valid_email|xss_clean'
		),
		'telephone' => array(
			'field' => 'telephone', 
			'label' => 'Telephone', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		), 
		
		'comment' => array(
			'field' => 'comment', 
			'label' => 'Comment', 
			'rules' => 'trim|required|max_length[20000]|xss_clean'
		)
	);
	
	public $inforules = array(
		'to' => array(
			'field' => 'to', 
			'label' => 'Email receiver', 
			'rules' => 'trim|required|max_length[100]|xss_clean|email_formatto'
		),
		'cc' => array(
			'field' => 'cc', 
			'label' => 'Email cc receiver', 
			'rules' => 'email_formatcc'
		), 
		'bcc' => array(
			'field' => 'bcc', 
			'label' => 'Email bcc receiver', 
			'rules' => 'email_formatbcc'
		)
	);

	public function get_contact_form()
	{
		$contactform = new stdClass();
		$contactform->name = '';
		$contactform->position = '';
		$contactform->email = '';
		$contactform->telephone = '';
		$contactform->cv = '';
		$contactform->comment = '';
		return $contactform;
	}
	
	public function get_contact_info()
	{
		$contactinfo = new stdClass();
		$contactinfo->to = '';
		$contactinfo->cc = '';
		$contactinfo->bcc = '';
		return $contactinfo;
	}
	
	

}