<?php
class Contactus_m extends MY_Model
{
	public $_table_name = 'contactus';
	public $_order_by = 'contactus.id desc';
	public $rules = array(
		'title' => array(
			'field' => 'title', 
			'label' => 'Title', 
			'rules' => 'trim|xss_clean|required'
		), 
		
		'address' => array(
			'field' => 'address', 
			'label' => 'Address', 
			'rules' =>  'trim|required|max_length[20000]|xss_clean'
		), 
		
		'block' => array(
			'field' => 'block', 
			'label' => 'Block', 
			'rules' => 'trim|xss_clean'
		),
		'myfloor' => array(
			'field' => 'myfloor', 
			'label' => 'myfloor', 
			'rules' => 'trim|xss_clean'
		),
		'telephone' => array(
			'field' => 'telephone', 
			'label' => 'Telephone', 
			'rules' => 'trim|xss_clean'
		),
		'fax' => array(
			'field' => 'fax', 
			'label' => 'Fax', 
			'rules' => 'trim|xss_clean'
		),
		'mobile' => array(
			'field' => 'mobile', 
			'label' => 'Mobile', 
			'rules' => 'trim|xss_clean'
		),
		'mobile2' => array(
			'field' => 'mobile2', 
			'label' => 'Mobile2', 
			'rules' => 'trim|xss_clean'
		),
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|max_length[100]|valid_email|xss_clean'
		)
	);
	
	public function get_new()
	{
		$contact = new stdClass();
		$contact->title = '';
		$contact->address = '';
		$contact->block = '';
		$contact->myfloor = '';
		$contact->telephone = '';
		$contact->fax = '';
		$contact->mobile = '';
		$contact->mobile2 = '';
		$contact->email = '';
		$event->timestamp = now();
		return $event;
	}
}