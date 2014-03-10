<?php
class Carousel extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('carousel_m');
		
	}

	public function index ()
	{
		// Fetch all products inside the carousel
		$this->data['carous'] = $this->carousel_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/carousel/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a product inside carousel or set a new one
		if ($id) {
			$this->data['carousel'] = $this->carousel_m->get($id);
			count($this->data['carousel']) || $this->data['errors'][] = 'products inside the carousel could not be found';
		}
		else {
			$this->data['carousel'] = $this->carousel_m->get_new();
		}
		
		// Set up the form
		$rules = $this->carousel_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'name'=>$this->input->post('name'), 
				'description'=>$this->input->post('description'),
				'timestamp'=>$this->input->post('timestamp')
			);
			$this->carousel_m->save($data, $id);
			$this->session->set_flashdata('success', 'product inserted inside the carousel.');
			redirect('admin/carousel');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/carousel/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function upload_img($imagename,$carouselid)
	{
		$timestamp = now();
		$newname = $imagename.'-'.$timestamp;
		$params = array(
					"upload_folder"=>"assets/carousel/",
					"upload_thumb_folder"=>"assets/carousel/thumbnails/",
					"delete_url"=>base_url() . "admin/carousel/deleteImage/",
					"filename"=> $newname,
					"table_name" =>"carousel",
					"table_id"=> $carouselid,
					"table_update"=> TRUE
				);
		$this->load->library("uploader",$params);
		
		$file_data = $this->uploader->upload_img();
	}
	
	public function get_files($id = NULL)
	{
		
		$file_name = $this->carousel_m->get($id);
			$filename = $file_name->photo;
		$params = array(
					"upload_folder"=>"assets/carousel/",
					"upload_thumb_folder"=>"assets/carousel/thumbnails/",
					"delete_url"=>base_url() . "admin/carousel/deleteImage/",
					"filename"=>$filename,
					
				);
		$this->load->library("uploader",$params);
		$this->uploader->get_files();
	}
	
	
	public function deleteImage ($photo)
	{
		$carousel =  $this->db->get_where('carousel',array('photo'=>$photo))->row();
		$id = $carousel->id;

		$params = array(
					"upload_folder"=>"assets/carousel/".$carousel->photo."/",
					"upload_thumb_folder"=>"assets/carousel/thumbnails/".$carousel->photo."/",
					"delete_url"=>base_url() . "admin/carousel/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$data = array(
               'photo' => ''
            );
		$this->db->where('id', $id);
		$this->db->update('carousel', $data); 
	}
	
	public function delete ($id)
	{
		$this->carousel_m->delete($id);
		redirect('admin/carousel');
	}
}