<?php
class About_m extends MY_Model
{
	public $_table_name = 'about';
	public $_order_by = 'about.id desc';
	public $rules = array(
		'description' => array(
			'field' => 'description', 
			'label' => 'about Description', 
			'rules' => 'trim|required|xss_clean'
		)
	);
	
	public function get_new()
	{
		$about = new stdClass();
		$about->description = '';
		$about->timestamp = now();
		return $about;
	}
}