<?php
class Products extends Admin_Controller
{

	public function __construct ()
	{
		parent::__construct();
		
		$this->load->model('products_m');
		$this->load->model("brands_m");
		$this->load->model("varieties_m");
	}

	public function index ()
	{
		// Fetch all productss
		$this->data['products'] = $this->products_m->get();
		
		// Load view
		$this->data['subview'] = 'admin/products/index';
		$this->load->view('admin/_layout_main', $this->data);
		
		/* $this->data['products'] = $this->products_m->get();
		$this->db->where('id',$this->data['products']->brand);
		$this->data['brnames'] = $this->brands_m->get();	 */
	}
	

	public function edit ($id = NULL)
	{
		// Fetch a products or set a new one
		if ($id) {
			//$this->db->join('products', 'brands.id = products.brand', 'left');
			//$this->db->where('products.id', $id);
			//$this->data['brandname'] = $this->brands_m->get();
			//$this->db->where('id',$id);
			$this->data['product'] = $this->products_m->get($id);
			$this->db->where('id',$this->data['product']->brand);
			$this->data['brandsname'] = $this->brands_m->get();	
			
			$this->data['product'] = $this->products_m->get($id);
			count($this->data['product']) || $this->data['errors'][] = 'products could not be found';
		}
		else {
			$this->data['product'] = $this->products_m->get_new();
		}
		
		//$categ='wine';
		//$this->db->where('category',$categ);
		//$this->data['brands'] = $this->brands_m->get();
		
		
		// Set up the form
		$rules = $this->products_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				//'category'=>$this->products_m->get_new(),
				'category'=>$this->input->post('category'),
				'brand'=>$this->input->post('brand'),
				'name'=>$this->input->post('name'), 
				'variety'=>$this->input->post('variety'), 
				'description'=>$this->input->post('description'),
				'details'=>$this->input->post('details'),
			);
			$this->products_m->save($data, $id);
			$this->session->set_flashdata('success', 'Product inserted.');
			redirect('admin/products');
		}
		
		//$c=$this->uri->segment(4);
		
		// Load the view
		$this->data['subview'] = 'admin/products/edit';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function upload_img($imagename,$productid)
	{
		$timestamp = now();
		$newname = $imagename.'-'.$timestamp;
		$params = array(
					"upload_folder"=>"assets/products/",
					"upload_thumb_folder"=>"assets/products/thumbnails/",
					"delete_url"=>base_url() . "admin/products/deleteImage/",
					"filename"=> $newname,
					"table_name" =>"products",
					"table_id"=> $productid,
					"table_update"=> TRUE
				);
		$this->load->library("uploader",$params);
		
		$file_data = $this->uploader->upload_img();
	}
	

	public function get_brand($cat)
	{
		
		$brands = $this->db->get_where('brands',array('category'=>$cat))->result();
		$opt="";
			foreach($brands as $brand)
			{
				$opt.="<option value='".$brand->id."' set_select('brand','".$brand->id."',('".$brand->id."'=='selected')?true:false);>".$brand->name."</option>";
			}
		echo $opt;	
	}
	
	public function get_files($id = NULL)
	{
		
		$file_name = $this->products_m->get($id);
			$filename = $file_name->photo;
		$params = array(
					"upload_folder"=>"assets/products/",
					"upload_thumb_folder"=>"assets/products/thumbnails/",
					"delete_url"=>base_url() . "admin/products/deleteImage/",
					"filename"=>$filename,
					
				);
		$this->load->library("uploader",$params);
		$this->uploader->get_files();
	}
	
	
	public function delete ($id)
	{
		$products = $this->products_m->get($id);
		delete_files('assets/products/'.$products->photo, TRUE);
		rmdir('assets/products/'.$products->photo);
		$data = array(
               'photo' => ''
            );
		$this->db->where('id', $id);
		$this->db->update('products', $data); 
		
		$this->products_m->delete($id);
		redirect('admin/products');
	}
	
	public function deleteImage ($photo)
	{
		$productid =  $this->db->get_where('products',array('photo'=>$photo))->row();
		$id = $productid->id;

		$params = array(
					"upload_folder"=>"assets/products/".$product->photo."/",
					"upload_thumb_folder"=>"assets/products/thumbnails/".$product->photo."/",
					"delete_url"=>base_url() . "admin/products/deleteImage/",
				);
		$this->load->library("uploader",$params);
		$this->uploader->deleteImage();
		$data = array(
               'photo' => ''
            );
		$this->db->where('id', $id);
		$this->db->update('products', $data); 
	}
	
	public function _validate_brand($str)
	{
		if ($str == '0')
		{
			$this->form_validation->set_message('_validate_brand', 'Brand is required');
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
		$itemid = $this->products_m->get();
		
		if (count($itemid)) {
			$this->form_validation->set_message('_unique_itemid', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}