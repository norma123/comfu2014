<?php
class Scopes_m extends MY_Model
{
	public $_table_name = 'scopes';
	public $_order_by = 'scopes.name ASC';
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|xss_clean'
		)
	);
	
	public function get_new()
	{
		$scope = new stdClass();
		$scope->name = '';
		$scope->timestamp = now();
		return $scope;
	}
	
}