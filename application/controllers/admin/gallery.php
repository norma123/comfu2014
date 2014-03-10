<?php
class Gallery extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('gallery_m');
		
	}

	public function index ()
	{
		// Fetch all gallerys
		$this->data['albums'] = $this->gallery_m->get();
		$count = $this->db->count_all_results('albums');
		
		// Set up pagination
		$perpage = 8;
		if ($count > $perpage) {
			$this->load->library('pagination');
			$config['base_url'] = site_url('admin/gallery/index/');
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$offset = $this->uri->segment(4);
		}
		else {
			$this->data['pagination'] = '';
			$offset = 0;
		}
		
		// Fetch articles
		$this->db->limit($perpage, $offset);
		$this->data['albums'] = $this->gallery_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/gallery/index';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function edit ($id = NULL)
	{
		// Fetch a gallery or set a new one
		if ($id) {
			$this->data['gallery'] = $this->gallery_m->get($id);
			count($this->data['gallery']) || $this->data['errors'][] = 'gallery could not be found';
		}
		else {
			$this->data['gallery'] = $this->gallery_m->get_new();
		}
		
		// Set up the form
		$rules = $this->gallery_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->gallery_m->array_from_post(array(
				'title', 
				'slug', 
				'body', 
				'pubdate'
			));
			$this->gallery_m->save($data, $id);
			$this->session->set_flashdata('success', 'gallery inserted.');
			redirect('admin/gallery');
		}
		
		// Load the view
		$this->data['subview'] = 'admin/gallery/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function album($id = null,$name = null)
	{
		
		$this->db->join('albums','albums.id = albumphotos.albumid');
		$this->db->where('albumid',$id);
		$count = $this->db->count_all_results('albumphotos');
		
		// Set up pagination
		$perpage = 8;
		if ($count > $perpage) {
			$this->load->library('pagination');
			$config['base_url'] = site_url('admin/gallery/album/');
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$offset = $this->uri->segment(4);
		}
		else {
			$this->data['pagination'] = '';
			$offset = 0;
		}
		
		// Fetch photos	
		$this->data['albumphotos'] = $this->gallery_m->get_album_photos($id,$perpage, $offset);		
		$this->data['subview'] = 'admin/gallery/albums';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function create_album()
	{
		$this->input->post('title');
		$timestamp=now();
		$album_name = 'assets/galleries/'.url_title($this->input->post('title')).'-'.$timestamp;
		$album_thumbnail = $album_name.'/thumbnails/';
		
		mkdir($album_name,777);
		mkdir($album_thumbnail,777);
		$data = array(
				'title'=>$this->input->post('title'), 
				'dir'=>url_title($this->input->post('title')).'-'.$timestamp,
			);
			$this->gallery_m->save($data);
			$this->session->set_flashdata('success', 'Album inserted.');
		redirect('admin/gallery/');
	}
	
	public function order ()
	{
		$this->data['sortable'] = TRUE;
		$this->data['subview'] = 'admin/gallery/order';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function orderphotos ()
	{
		$this->data['sortable'] = TRUE;
		$this->data['subview'] = 'admin/gallery/orderphotos';
		$this->load->view('admin/_layout_main', $this->data);
	}
	
	public function photos ($albumid)
	{
		$this->data['album'] = $this->gallery_m->get($albumid);
		$this->data['subview'] = 'admin/gallery/add_photos';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function order_ajax ()
	{
		
		// Save order from ajax call
		if (isset($_POST['sortable'])) {
			$this->gallery_m->save_order($_POST['sortable']);
		}
		$this->data['albums'] = $this->gallery_m->get();
		
		// Load view
		$this->load->view('admin/gallery/order_ajax', $this->data);
	}
	public function orderphotos_ajax ($albumid)
	{
		
		// Save order from ajax call
		if (isset($_POST['sortable'])) {
			$this->gallery_m->save_order_photos($_POST['sortable'],$albumid);
		}
		$this->data['albumphotos'] = $this->gallery_m->get_album_photos($albumid);		
		
		// Load view
		$this->load->view('admin/gallery/orderphotos_ajax', $this->data);
	}
	
	public function make_cover ($id,$albumid)
	{
		$albumphoto = $this->db->get_where('albumphotos',array('id'=>$id))->row();	
		$data = array('photo'=>$albumphoto->title);
		$this->db->where('id',$albumid);
		$this->db->update('albums',$data);
		redirect('admin/gallery/orderphotos/'.$albumid);
	}
	
	public function edit_caption($id,$albumid)
	{
		$data = array('caption' => $this->input->post('caption'));
		$this->db->where('id',$id);
		$this->db->update('albumphotos',$data);
		
		$this->session->set_flashdata('success', 'Photo caption updated.');
		redirect('admin/gallery/orderphotos/'.$albumid);
	}
	
	public function edit_name($id)
	{
		$data = array('title' => $this->input->post('title'));
		$this->gallery_m->save($data,$id);
		
		$this->session->set_flashdata('success', 'Album title updated.');
		redirect('admin/gallery/order/');
	}
	
	public function upload_img($albumid,$albumtitle)
	{
		$timestamp = now();
		$album = $this->gallery_m->get($albumid);
		$params = array(
					"upload_folder"=>"assets/galleries/".$album->dir."/",
					"upload_thumb_folder"=>"assets/galleries/".$album->dir."/thumbnails/",
					"delete_url"=>base_url() . "admin/gallery/deleteImage/",
					"filename"=> $albumtitle.'-'.$timestamp,
					"table_name"=>"albumphotos",
					"table_field"=>"albumid",
					"table_data"=> $albumid,
				);
		$this->load->library("uploader",$params);
		$file_data = $this->uploader->upload_img();
	}
	
	public function get_files($id = NULL)
	{
		
		$album = $this->gallery_m->get($id);
		$params = array(
					"upload_folder"=>"assets/galleries/".$album->dir."/",
					"upload_thumb_folder"=>"assets/galleries/".$album->dir."/thumbnails/",
					"delete_url"=>base_url() . "admin/gallery/deleteImage/",
					"filename"=>"",
					"show_all"=>TRUE,
				);
		$this->load->library("uploader",$params);
		$this->uploader->get_files();
	}
	
	
	public function deleteImage($photo)
	{
		$albumid =  $this->db->get_where('albumphotos',array('title'=>$photo))->row();
		$id = $albumid->albumid;
		$album = $this->gallery_m->get($id);
		$params = array(
					"upload_folder"=>"assets/galleries/".$album->dir."/",
					"upload_thumb_folder"=>"assets/galleries/".$album->dir."/thumbnails/",
					"delete_url"=>base_url() . "admin/galleries/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$this->db->where('title',$photo);
		$this->db->delete('albumphotos');
	}
	
	public function delete ($id)
	{
		$dir = $this->gallery_m->get($id);
		delete_files('assets/galleries/'.$dir->dir,TRUE);
		rmdir('assets/galleries/'.$dir->dir);
		$this->db->where('albumid',$id);
		$this->db->delete('albumphotos');
		
		$this->gallery_m->delete($id);
		redirect('admin/gallery');
	}
	
	public function deletesinglephoto ($id,$albumid)
	{
		
		$dir = $this->gallery_m->get($albumid);
		$albumphoto = $this->db->get_where('albumphotos',array('id'=>$id))->row();
		unlink('assets/galleries/'.$dir->dir.'/thumbnails/'.$albumphoto->title);
		unlink('assets/galleries/'.$dir->dir.'/'.$albumphoto->title);
		$this->db->where('id',$id);
		$this->db->delete('albumphotos');
		redirect('admin/gallery/orderphotos/'.$albumid);
	}

}