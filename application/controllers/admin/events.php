<?php
class Events extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('events_m');
		
	}

	public function index ()
	{
		// Fetch all events
		$this->data['events'] = $this->events_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/events/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a events or set a new one
		if ($id) {
			$this->data['event'] = $this->events_m->get($id);
			count($this->data['event']) || $this->data['errors'][] = 'Events could not be found';
		}
		else {
			$this->data['event'] = $this->events_m->get_new();
		}
		
		// Set up the form
		$rules = $this->events_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'category'=>mysql_real_escape_string($this->input->post('category')), 
				'created'=>mysql_real_escape_string($this->input->post('created')), 
				'name'=>mysql_real_escape_string($this->input->post('name')), 
				'description'=>$this->input->post('description'),
				//'photo'=>$this->input->post('imago-dropzone'),
				'timestamp'=>$this->input->post('timestamp')
			);
			$this->events_m->save($data, $id);
			$this->session->set_flashdata('success', 'event inserted.');
			redirect('admin/events');
		}
		
		// Load the view
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		$this->data['subview'] = 'admin/events/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function upload_img($imagename,$eventid)
	{
		$timestamp = now();
		$newname = $imagename.'-'.$timestamp;
		$params = array(
					"upload_folder"=>"assets/events/",
					"upload_thumb_folder"=>"assets/events/thumbnails/",
					"delete_url"=>base_url() . "admin/events/deleteImage/",
					"filename"=> $newname,
					"table_name" =>"events",
					"table_id"=> $eventid,
					"table_update"=> TRUE
				);
		$this->load->library("uploader",$params);
		
		$file_data = $this->uploader->upload_img();
	}
	
	public function get_files($id = NULL)
	{
		
		$file_name = $this->events_m->get($id);
			$filename = $file_name->photo;
		$params = array(
					"upload_folder"=>"assets/events/",
					"upload_thumb_folder"=>"assets/events/thumbnails/",
					"delete_url"=>base_url() . "admin/events/deleteImage/",
					"filename"=>$filename,
					
				);
		$this->load->library("uploader",$params);
		$this->uploader->get_files();
	}
	
	
	public function deleteImage ($photo)
	{
		$event =  $this->db->get_where('events',array('photo'=>$photo))->row();
		$id = $event->id;

		$params = array(
					"upload_folder"=>"assets/events/".$event->photo."/",
					"upload_thumb_folder"=>"assets/events/thumbnails/".$event->photo."/",
					"delete_url"=>base_url() . "admin/events/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$data = array(
               'photo' => ''
            );
		$this->db->where('id', $id);
		$this->db->update('events', $data); 
	}
	
	public function delete ($id)
	{
		$this->events_m->delete($id);
		redirect('admin/events');
	}
	
	public function _validate_event($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_event', 'event is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function _validate_section($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_section', 'Section is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function _validate_category($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_category', 'Category is required');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function _unique_itemid ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current itemid
		
		$id = $this->uri->segment(4);
		$this->db->where('itemid', $this->input->post('itemid'));
		!$id || $this->db->where('id !=', $id);
		$itemid = $this->events_m->get();
		
		if (count($itemid)) {
			$this->form_validation->set_message('_unique_itemid', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}