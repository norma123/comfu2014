<?php
class Locations_m extends MY_Model
{
	public $_table_name = 'locations';
	public $_order_by = 'locations.name ASC';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|xss_clean'
		)
	);
	
	public function get_new()
	{
		$location = new stdClass();
		$location->name = '';
		$location->timestamp = now();
		return $location;
	}
	
	
}