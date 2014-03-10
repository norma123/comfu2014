<?php
class Services_m extends MY_Model
{
	public $_table_name = 'services';
	public $_order_by = 'services.id desc';
	public $rules = array(
		'title' => array(
			'field' => 'title', 
			'label' => 'title', 
			'rules' => 'trim|required|xss_clean'
		), 
		
		'description1' => array(
			'field' => 'description1', 
			'label' => 'Description1', 
			'rules' => 'trim|required'
		),
		'description2' => array(
			'field' => 'description2', 
			'label' => 'Description2', 
			'rules' => 'trim'
		),
		'description3' => array(
			'field' => 'description3', 
			'label' => 'Description3', 
			'rules' => 'trim'
		)
	);
	
	public function get_new()
	{
		$service = new stdClass();
		$service->title = '';
		$service->description1 = '';
		$service->description2 = '';
		$service->description3 = '';
		$service->timestamp = now();
		return $service;
	}
	
	public function getVarietyName($id){
        $brand->varietyname = $this->db->get_where('varieties',array('id'=>$id))->result();
        //print_r( $product->brandname );
		if ($brand->varietyname[0]->name==''){$brand->varietyname[0]->name='-';}
        echo $brand->varietyname[0]->name;
    }
}