<?php
class Varieties_m extends MY_Model
{
	public $_table_name = 'varieties';
	public $_order_by = 'varieties.id desc';
	public $rules = array(
		'category' => array(
			'field' => 'category', 
			'label' => 'Category', 
			'rules' => 'callback__validate_category|required'
		), 
		
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|xss_clean|required'
		)
		
		//'description' => array(
			//'field' => 'description', 
			//'label' => 'Variety Description', 
			//'rules' => 'trim'
		//)
	);
	
	public function get_new()
	{
		$variety = new stdClass();
		$variety->category = '';
		$variety->name = '';
		//$variety->description = '';
		$variety->timestamp = now();
		return $variety;
	}
	
}