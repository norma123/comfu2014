<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Uploader extends Admin_Controller {
	
    protected $path_img_upload_folder;
    protected $path_img_thumb_upload_folder;
    protected $path_url_img_upload_folder;
    protected $path_url_img_thumb_upload_folder;
	protected $delete_img_url;

	//folder directory path and url
	public $upload_folder="";
	public $upload_thumb_folder="";
	public $delete_url="";
	public $filename="";
	public $rename=TRUE;
	public $width="228";
	public $height="228";
	public $show_all=FALSE;
	
	//database info 
	public $table_name = '';
	public $table_id = '';
	public $table_data = '';
	public $table_field = '';
	public $table_update = FALSE;

   function __construct($params){
        parent::__construct($params);
        $this->load->helper(array('form', 'url'));
		// Set parameters
        foreach ($params as $key => $value)
        {
            $this->$key = $value;
        }
//Set relative Path with CI Constant
        $this->setPath_img_upload_folder($this->upload_folder);
        $this->setPath_img_thumb_upload_folder($this->upload_thumb_folder);

        
//Delete img url
        $this->setDelete_img_url($this->delete_url);
 

//Set url img with Base_url()
        $this->setPath_url_img_upload_folder(base_url() . $this->upload_folder);
        $this->setPath_url_img_thumb_upload_folder(base_url() . $this->upload_thumb_folder);
		
  }

    public function upload_img() {
        $name = $_FILES['userfile']['name'];
        $name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

// remplacer les caracteres autres que lettres, chiffres et point par _

         $name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);

        //Your upload directory, see CI user guide
        $config['upload_path'] = $this->getPath_img_upload_folder();
  
        $config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG';
        $config['max_size'] = '10000';
        $config['file_name'] = $this->filename;
       //Load the upload library
        $this->load->library('upload', $config);

       if ($this->do_upload()) {
            $data = $this->upload->data();
			$newname =($this->rename == FALSE)?$this->filename:$this->filename.$data['file_ext'];
            //If you want to resize 
            $config['new_image'] = $this->getPath_img_thumb_upload_folder();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->getPath_img_upload_folder() .$newname;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = ($this->width=="")? $data['image_width']: $this->width;
            $config['height'] = ($this->height=="")? $data['image_height']: $this->height;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

           
            //Get info 
            $info = new stdClass();
            
            $info->name = $newname;
            $info->size = $data['file_size'];
            $info->type = $data['file_type'];
			$info->extension = $data['file_ext'];
            $info->url = base_url() .$this->getPath_img_upload_folder() . $newname;
            $info->thumbnail_url = base_url() .$this->getPath_img_thumb_upload_folder() . $newname; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
            $info->delete_url = $this->getDelete_img_url() . $name;
            $info->delete_type = 'DELETE';
			$e['files'] = array($info);
			
			$ext = $data['file_ext'];
			// insert into database 
			if($this->table_name)
			{
				if($this->table_update)
				{
					$data = array('photo'=> $newname);
					$this->db->where('id', $this->table_id);
					$this->db->update($this->table_name,$data);
					
				}else{
					$data = array(
						'title' => $newname,
						$this->table_field => $this->table_data
					);
					$this->db->insert($this->table_name,$data);
				} 
			}
			
           //Return JSON data
           if (IS_AJAX) {   //this is why we put this in the constants to pass only json data
                echo json_encode($e);
                //this has to be the only the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
            } else {   // so that this will still work if javascript is not enabled
                $file_data['upload_data'] = $this->upload->data();
                echo json_encode($e);
            }
        } else {

           // the display_errors() function wraps error messages in <p> by default and these html chars don't parse in
           // default view on the forum so either set them to blank, or decide how you want them to display.  null is passed.
            $error = array('error' => $this->upload->display_errors('',''));

            echo json_encode(array($error));
        }
       }
	   
	   public function upload_pdf() {
        $name = $_FILES['userfile']['name'];
        $name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

// remplacer les caracteres autres que lettres, chiffres et point par _

         $name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);

        //Your upload directory, see CI user guide
        $config['upload_path'] = $this->getPath_img_upload_folder();
  
        $config['allowed_types'] = 'pdf|PDF';
        $config['max_size'] = '10000';
        $config['file_name'] = $name;
       //Load the upload library
        $this->load->library('upload', $config);

       if ($this->do_upload()) {
            $data = $this->upload->data();
           
            //Get info 
            $info = new stdClass();
            
            $info->name = $name;
            $info->size = $data['file_size'];
            $info->type = $data['file_type'];
			$info->extension = $data['file_ext'];
            $info->url = base_url() .$this->getPath_img_upload_folder() . $name;
            $info->thumbnail_url = base_url() .$this->getPath_img_thumb_upload_folder() . $name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
            $info->delete_url = $this->getDelete_img_url() . $name;
			$info->delete_type = 'DELETE';
			$e['files'] = array($info);

			$ext = $data['file_ext'];
			// insert into database 
			if($this->table_name)
			{
				if($this->table_update)
				{
					$data = array('photo'=> $name);
					$this->db->where('id', $this->table_id);
					$this->db->update($this->table_name,$data);
					
				}else{
					$data = array(
						'title' => $name,
						$this->table_field => $this->table_data
					);
					$this->db->insert($this->table_name,$data);
				} 
			}
			
           //Return JSON data
           if (IS_AJAX) {   //this is why we put this in the constants to pass only json data
                echo json_encode($e);
                //this has to be the only the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
            } else {   // so that this will still work if javascript is not enabled
                $file_data['upload_data'] = $this->upload->data();
                echo json_encode($e);
            }
        } else {

           // the display_errors() function wraps error messages in <p> by default and these html chars don't parse in
           // default view on the forum so either set them to blank, or decide how you want them to display.  null is passed.
            $error = array('error' => $this->upload->display_errors('',''));

            echo json_encode(array($error));
        }
       }

//Function for the upload : return true/false
  public function do_upload() {

        if (!$this->upload->do_upload()) {

            return false;
        } else {
            $data = array('upload_data' => $this->upload->data());
				
            return $data;
        }
     }

public function deleteImage() {

        //Get the name in the url
        $file = $this->uri->segment(4);
        
        $success = unlink($this->getPath_img_upload_folder() . $file);
        $success_th = unlink($this->getPath_img_thumb_upload_folder() . $file);

        //info to see if it is doing what it is supposed to 
        $info = new stdClass();
        $info->sucess = $success;
        $info->path = $this->getPath_url_img_upload_folder() . $file;
        $info->file = is_file($this->getPath_img_upload_folder() . $file);
        if (IS_AJAX) {//I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {     //here you will need to decide what you want to show for a successful delete
            var_dump($file);
        }
    }

    public function get_files() {

        $this->get_scan_files();
    }

    public function get_scan_files() {
        
		 $file_name = $this->filename;
		if($file_name=="" && $this->show_all==TRUE)
			$file_name = isset($_REQUEST['file']) ? basename(stripslashes($_REQUEST['file'])) : null;
		elseif($file_name!="" && $this->show_all==FALSE)
			$file_name = $this->filename;
			else
				exit;
		
        if ($file_name) {
            $info['files'] = $this->get_file_object($file_name);
        } else {
            $info['files'] = $this->get_file_objects();
        }
        header('Content-type: application/json');
		 
        echo json_encode($info);
    }

    protected function get_file_object($file_name) {
        $file_path = $this->getPath_img_upload_folder() . $file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {

            $file = new stdClass();
			$file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->getPath_url_img_upload_folder() . rawurlencode($file->name);
            $file->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . rawurlencode($file->name);
            //File name in the url to delete 
            $file->delete_url = $this->getDelete_img_url() . rawurlencode($file->name);
            $file->delete_type = 'DELETE';
            
			if($this->filename!="")
			return array($file);
			else
            return $file;
			
        }
        return null;
    }

      protected function get_file_objects() {
        return array_values(array_filter(array_map(
             array($this, 'get_file_object'), scandir($this->getPath_img_upload_folder())
                   )));
    }  
	
	protected function count_file_objects() {
        return count($this->get_file_objects('is_valid_file_object'));
    }
	
    public function getPath_img_upload_folder() {
        return $this->path_img_upload_folder;
    }

    public function setPath_img_upload_folder($path_img_upload_folder) {
        $this->path_img_upload_folder = $path_img_upload_folder;
    }

    public function getPath_img_thumb_upload_folder() {
        return $this->path_img_thumb_upload_folder;
    }

    public function setPath_img_thumb_upload_folder($path_img_thumb_upload_folder) {
        $this->path_img_thumb_upload_folder = $path_img_thumb_upload_folder;
    }

    public function getPath_url_img_upload_folder() {
        return $this->path_url_img_upload_folder;
    }

    public function setPath_url_img_upload_folder($path_url_img_upload_folder) {
        $this->path_url_img_upload_folder = $path_url_img_upload_folder;
    }

    public function getPath_url_img_thumb_upload_folder() {
        return $this->path_url_img_thumb_upload_folder;
    }

    public function setPath_url_img_thumb_upload_folder($path_url_img_thumb_upload_folder) {
        $this->path_url_img_thumb_upload_folder = $path_url_img_thumb_upload_folder;
    }

    public function getDelete_img_url() {
        return $this->delete_img_url;
    }

    public function setDelete_img_url($delete_img_url) {
        $this->delete_img_url = $delete_img_url;
    }


}
