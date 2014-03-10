<?php
class Careers_m extends MY_Model
{
	public $_table_name = 'careers';
	public $_order_by = 'careers.id desc';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|xss_clean|required'
		), 
		
		'description' => array(
			'field' => 'description', 
			'label' => 'career Description', 
			'rules' => 'trim'
		)
	);
	
	public function get_new()
	{
		$career = new stdClass();
		$career->name = '';
		$career->description = '';
		$career->timestamp = now();
		return $career;
	}
	
}