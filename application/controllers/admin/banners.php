<?php
class Banners extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
	}

	public function index ()
	{
		// Load view
		$this->data['subview'] = 'admin/banners/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	

	public function upload_img()
	{
		$filename = $_FILES['userfile']['name'];
		 $params = array(
					"upload_folder"=>"assets/banners/",
					"upload_thumb_folder"=>"assets/banners/thumbnails/",
					"delete_url"=>base_url() . "admin/banners/deleteImage/",
					"filename"=>$filename,
					"rename"=>FALSE,
					"Width"=>"102",
					"height"=>"36"
				);
		$this->load->library("uploader",$params);
		$file_data = $this->uploader->upload_img();
		$data = array('image'=>$filename);
		$this->db->insert('banners',$data);
	}
	
	public function get_files()
	{
		
		$params = array(
					"upload_folder"=>"assets/banners/",
					"upload_thumb_folder"=>"assets/banners/thumbnails/",
					"delete_url"=>base_url() . "admin/banners/deleteImage/",
					"filename"=>"",
					"show_all"=>TRUE,
				);
		$this->load->library("uploader",$params);
		$this->uploader->get_files();
	}
	
	
	public function deleteImage($image)
	{
		$params = array(
					"upload_folder"=>"assets/banners/",
					"upload_thumb_folder"=>"assets/banners/thumbnails/",
					"delete_url"=>base_url() . "admin/banners/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$data = array('image'=>$image);
		$this->db->delete('banners',$data);
	}
}