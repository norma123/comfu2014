<?php
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_join_table_name = '';
	protected $_join_key = '';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = array();
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
	}
	
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}
	
	public function get($id = NULL, $single = FALSE,$join=FALSE,$resulttype=FALSE){
		if($join == TRUE)
		{
				$this->db->join("{$this->_join_table_name}","{$this->_table_name}.{$this->_primary_key} = {$this->_join_table_name}.{$this->_join_key}");
		}
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where("{$this->_table_name}.{$this->_primary_key}", $id);
			if($resulttype==TRUE)
				$method = 'row_array';
			else
				$method = 'row';
		}
		elseif($single == TRUE) {
			if($resulttype==TRUE)
				$method = 'row_array';
			else
				$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		
		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();
	}
	
	public function get_by($where, $single = FALSE, $join =FALSE, $resulttype=FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single,$join,$resulttype);
	}
	
	public function save($data, $id = NULL){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		
		return $id;
	}
	
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
}