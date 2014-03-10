<?php
class portfolio_m extends MY_Model
{
	public $_table_name = 'portfolios';
	public $_order_by = 'portfolios.name ASC';      
	public $rules = array(
		'name' => array(
			'field' => 'name', 
			'label' => 'Name', 
			'rules' => 'trim|required|xss_clean'
		), 
		'location' => array(
			'field' => 'location', 
			'label' => 'Location', 
			'rules' => 'trim|required|xss_clean'
		), 
		'projdate' => array(
			'field' => 'projdate', 
			'label' => 'Projdate', 
			'rules' => 'trim|required|xss_clean'
		), 
		'type' => array(
			'field' => 'type', 
			'label' => 'Type', 
			'rules' => 'trim|required|xss_clean'
		),
		'scope' => array(
			'field' => 'scope', 
			'label' => 'Scope', 
			'rules' => 'trim|required|xss_clean'
		),
		'consultant' => array(
			'field' => 'consultant', 
			'label' => 'Consultant', 
			'rules' => 'trim|required|xss_clean'
		)
	);
	
	public function get_new()
	{
		$portfolio = new stdClass();
		$portfolio->name = '';
		$portfolio->location = '';
		$portfolio->projdate = '';
		$portfolio->type = '';
		$portfolio->scope = '';
		$portfolio->consultant = '';
		$portfolio->timestamp = now();
		return $portfolio;
	}
	
	public function getTypeName($id){
        $portfolio->typename = $this->db->get_where('types',array('id'=>$id))->result();
        //print_r( $product->brandname );
        echo $portfolio->typename[0]->name;
    }
	
	public function getLocationName($id){
        $portfolio->locationname = $this->db->get_where('locations',array('id'=>$id))->result();
        //print_r( $product->brandname );
        echo $portfolio->locationname[0]->name;
    }
	
	public function getScopeName($id){
        $portfolio->scopename = $this->db->get_where('scopes',array('id'=>$id))->result();
        echo $portfolio->scopename[0]->name;
    }
	
	public function getLocationId($name){
        $portfolio->locationid = $this->db->get_where('locations',array('name'=>$name))->result();
       // print_r( $portfolio->locationid );
        return $portfolio->locationid[0]->id;
    }
	
	public function getScopeId($name){
        $portfolio->scopeid = $this->db->get_where('scopes',array('name'=>$name))->result();
        return $portfolio->scopeid[0]->id;
    }
	
	public function geTypeId($name){
        $portfolio->typeid = $this->db->get_where('types',array('name'=>$name))->result();
        return $portfolio->typeid[0]->id;
    }
	
}