<?php
class Types_m extends MY_Model
{
	public $_table_name = 'types';
	public $_order_by = 'types.name ASC';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|xss_clean'
		)
	);
	
	public function get_new()
	{
		$type = new stdClass();
		$type->name = '';
		$type->timestamp = now();
		return $type;
	}
	
}