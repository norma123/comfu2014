<?php
class Page extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('about_m');
		$this->load->model('careers_m');
		$this->load->model('contactus_m');
		$this->load->model('events_m');
		$this->load->model('locations_m');
		$this->load->model('portfolio_m');
		$this->load->model('scopes_m');
		$this->load->model('types_m');
		$this->load->model('services_m');
		//tttt
    }

    public function index() {
		$this->db->order_by("name", "ASC");
		$this->data['types'] = $this->types_m->get();
		
		$this->db->order_by("name", "ASC");
		$this->data['scopes'] = $this->scopes_m->get();
		
		$this->db->order_by("name", "ASC");
		$this->data['events'] = $this->events_m->get();
		//PORTFOLIOS
		//get all portfolios
		$u=$this->uri->segment(2);
		$v=$this->uri->segment(3);
		
		if($u=='all'){
			$this->db->order_by("id", "ASC");
			$this->data['portfolios'] = $this->portfolio_m->get();
		}
		//sort portfolios by type
		if($u=='type'){
			$this->db->order_by("type", "ASC");
			$this->db->where('type',$v);
			$this->data['portfoliosType'] = $this->portfolio_m->get();
		}
		//sort portfolios by location
		if($u=='location'){
			$this->db->order_by("location", "ASC");
			$this->db->where('location',$v);
			$this->data['portfoliosLocation'] = $this->portfolio_m->get();
			//var_dump($this->data['portfoliosLocation']);
		}
		
		//sort portfolios by services
		if($u=='scope'){
			$this->db->order_by("scope", "ASC");
			$this->db->where('scope',$v);
			$this->data['portfoliosScope'] = $this->portfolio_m->get();
		}
		
		$this->data['template'] = 'ajax';
    	$this->load->view('_main_layout', $this->data);
	}
}
		
?>