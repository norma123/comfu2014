<?php
class Events_m extends MY_Model
{
	public $_table_name = 'events';
	public $_order_by = 'events.id desc';
	public $rules = array(
		'category' => array(
			'field' => 'category', 
			'label' => 'Category', 
			'rules' => 'trim|required|xss_clean'
		), 
		
		'created' => array(
			'field' => 'created', 
			'label' => 'Created', 
			'rules' => 'trim|xss_clean'
		), 
		
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|xss_clean'
		),
		
		'description' => array(
			'field' => 'description', 
			'label' => 'Event Description', 
			'rules' => 'trim'
		)
	);
	
	public function get_new()
	{
		$event = new stdClass();
		$event->category= '';
		$event->created = '';
		$event->name = '';
		$event->description = '';
		$event->timestamp = now();
		return $event;
	}
	
	public function getVarietyName($id){
        $brand->varietyname = $this->db->get_where('varieties',array('id'=>$id))->result();
        //print_r( $product->brandname );
		if ($brand->varietyname[0]->name==''){$brand->varietyname[0]->name='-';}
        echo $brand->varietyname[0]->name;
    }
}