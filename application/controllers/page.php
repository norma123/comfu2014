<?php

class Page extends Frontend_Controller {

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
		$this->load->library('form_validation');
		$this->load->model('applicants_m');
		$this->load->helper('form');
    }

    public function index($u,$v) {
    	// Fetch the page template
    	
    	add_meta_title('manoukian');
		//add_meta_description($this->data['page']->body);
		add_meta_url('manoukian');
    	
		$this->data['aboutus'] = $this->about_m->get(1);
		
		$this->db->order_by("id", "ASC"); 
	    $this->data['contacts'] = $this->contactus_m->get();
		
		$this->db->order_by("id", "DESC");
		$this->data['careers'] = $this->careers_m->get();
		
		$this->db->order_by("id", "ASC");
		$this->data['services'] = $this->services_m->get();
		
		$this->db->order_by("name", "ASC");
		$this->data['locations'] = $this->locations_m->get();
		
		$this->db->order_by("name", "ASC");
		$this->data['types'] = $this->types_m->get();
		
		$this->db->order_by("name", "ASC");
		$this->data['scopes'] = $this->scopes_m->get();
		
		$this->db->where('category','news');
		$this->db->order_by("id", "DESC");
		$this->db->limit(1);
		$this->data['ev'] = $this->events_m->get();
		//print_r($this->data['ev']);
		//$ev=$this->data['ev'];
		
		$this->db->where('category','event');
		$this->db->order_by("id", "DESC");
		$this->data['events'] = $this->events_m->get();
		
		$this->db->where('category','news');
		$this->db->order_by("id", "DESC");
		$this->data['newsS'] = $this->events_m->get();
		
		//PORTFOLIOS
		//get all portfolios
		$u=$this->uri->segment(1);
		$v=$this->uri->segment(2);
		if($u=='viewall'){
			$this->db->where('category','news');
			$this->db->order_by("name", "DESC");
			$this->data['events'] = $this->events_m->get();
		}
		
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
		}
		
		//sort portfolios by services
		if($u=='scope'){
			$this->db->order_by("scope", "ASC");
			$this->db->where('scope',$v);
			$this->data['portfoliosScope'] = $this->portfolio_m->get();
			//var_dump($this->data['portfoliosScope']);
		}
		
		//contact us form
		$rules = $this->applicants_m->rules;
		$this->form_validation->set_rules($rules);
		$config = array(
			'upload_path' 	=> 'assets/cv/',
			'allowed_types' => '*'
			
		);
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if ($this->form_validation->run() == TRUE) {
			$senderinfo = $this->applicants_m->array_from_post(array(
				'name',  
				'position',  
				'email', 
				'telephone',
				'comment'
			));
			
		if ($_FILES["userfile"]["name"]) {

			// Do the cv upload
			$this->upload->do_upload();
		
			// Get upload errors
			 $errors=$this->upload->display_errors();

			// There was an error uploading the files. Since this is
			// just an example, die.
			if ($errors) {
				die($errors);
			}

			// Get upload data assuming no errors
			$upload_data = $this->upload->data();

		}
			$this->load->library('email');	
			
			$this->data['contactinfo'] = $this->db->get('applicants')->row();
			
			$subject = 'Career Form';
			$message = 'Dear Administrator,'.PHP_EOL;
			$message.= 'You have received a new Contact Form!'.PHP_EOL;
			$message.= '-------------------------------------------'.PHP_EOL;
			$message.= 'Date: '.date("d-m-Y h:m:s A").PHP_EOL;
			$message.= '-------------------------------------------'.PHP_EOL;
			$message.= 'From: '. $senderinfo['name'].PHP_EOL;
			$message.= '-------------------------------------------'.PHP_EOL;
			$message.= 'Email: '.$senderinfo['email'] .PHP_EOL;
			$message.= '-------------------------------------------'.PHP_EOL;
			$message.= 'Position: '.$senderinfo['position'] .PHP_EOL;
			$message.= '-------------------------------------------'.PHP_EOL;
			$message.= 'Telephone: '.$senderinfo['telephone'] .PHP_EOL;
			$message.= '-------------------------------------------'.PHP_EOL;
			$message.= 'Message: '. $senderinfo['comment'] .PHP_EOL;
			$message.= '-------------------------------------------'.PHP_EOL;
			$message.='Thank you!'.PHP_EOL;
			$this->email->from($senderinfo['email'], $senderinfo['name']);					
			$this->email->to( $this->data['contactinfo']->to);
			$this->email->cc($this->data['contactinfo']->cc);					
			$this->email->bcc($this->data['contactinfo']->bcc);					
			$this->email->subject($subject);
			$this->email->message($message);
			// Attach the uploaded file if it is set
			if (isset($upload_data)) {
				$this->email->attach($upload_data["full_path"]);
			}			
			$this->email->send();		
			$this->session->set_flashdata('success', 'Email Sent.');
			redirect(); 
    	}
		
		
		// Load the view
		$this->data['template'] = 'homepage';
    	$this->load->view('_main_layout', $this->data);
    }
}