<?php
function btn_edit ($uri)
{
	return anchor($uri, '<i class="icon-edit"></i>');
}

function btn_delete ($uri,$id,$icon,$atributes,$data)
{
	$btn_delete='
		<a href="#Delete'.$id.'"  '.$atributes.' data-toggle="modal">'.$icon.'</a>
 
		<!-- Modal -->
		<div id="Delete'.$id.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Delete</h3>
		  </div>
		  <div class="modal-body">
			<p>Are you sure do you want to delete this '.$data.' ? </p>
		  </div>
		  <div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			'.anchor($uri, '<button class="btn btn-primary">Delete</button>').'
		  </div>
		</div>';
	
	
	return $btn_delete;
}
function btn_goback($uri)
{
	$btn_goback='
		<a href="#goBack" class="btn btn-small btn-primary" data-toggle="modal">Go Back</a>
 
		<!-- Modal -->
		<div id="goBack" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Go Back</h3>
		  </div>
		  <div class="modal-body">
			<p>Are you sure that you want to go back? your data will not be saved </p>
		  </div>
		  <div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			'.anchor($uri, '<span class="btn btn-primary">Go Back</span>').'
		  </div>
		</div>';
	
	
	return $btn_goback;
}

function article_link($article){
	return 'article/' . intval($article->id) . '/' . e($article->slug);
}
function article_links($articles){
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '</li>';
	}
	$string .= '</ul>';
	return $string;
}

function get_excerpt($article, $numwords = 50){
	$string = '';
	$url = article_link($article);
	$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
	$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
	return $string;
}

function limit_to_numwords($string, $numwords){
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function e($string){
	return htmlentities($string);
}

function get_menu ($array, $child = FALSE)
{
	$CI =& get_instance();
	$str = '';
	
	if (count($array)) {
		$str .= $child == FALSE ? '<ul class="nav margin-top30">' . PHP_EOL : '<ul>' . PHP_EOL;
		foreach ($array as $item) {
			$active = ($CI->uri->segment(1) == $item['slug']) ? TRUE : FALSE;
			/* if (isset($item['children']) && count($item['children'])) {
				
				$str .= $active ? '<li>' : '<li >';
				$str .= $active? '<a href="' . site_url($item['slug']) . '" class="active" style="color:#245f6d;">' . e($item['title']) . '</a>':'<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
				
				$str .= get_menu($item['children'], TRUE);
			} */
			//else {
				$str .= $active ? '<li>' : '<li>';
				if($item['slug'] == 'aboutus')
				$item['slug'] = 'thevillage';
				if($item['slug'] == 'restaurants-bars')
				$item['slug'] = 'restaurants';
				$str .= $active? '<a href="' . site_url($item['slug']) . '" >' . e($item['title']) . '</a>':'<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
			//}
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ul>' . PHP_EOL;
	}
	
	return $str;
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}


function btn_create_album ($uri)
{
	$CI =&get_instance();
	$data['uri'] = $uri;
	$CI->load->view('admin/gallery/_layout_model',$data);
}

function btn_edit_album ($uri,$id,$icon,$attributes,$values)
{
	$CI =&get_instance();
	$data['uri'] = $uri;
	$data['icon'] = $icon;
	$data['attributes'] = $attributes;
	$data['values'] = $values;
	$data['id'] = $id;
	$CI->load->view('admin/gallery/_layout_edit_album_name',$data);
}

function btn_edit_albumphoto ($uri,$id,$icon,$attributes,$values)
{
	$CI =&get_instance();
	$data['uri'] = $uri;
	$data['icon'] = $icon;
	$data['attributes'] = $attributes;
	$data['values'] = $values;
	$data['id'] = $id;
	$CI->load->view('admin/gallery/_layout_edit_album_photo_name',$data);
}
function btn_edit_career ($uri,$icon,$attributes,$values)
{
	$CI =&get_instance();
	$data['uri'] = $uri;
	$data['icon'] = $icon;
	$data['attributes'] = $attributes;
	$data['career'] = $values;
	$CI->load->view('admin/careers/_layout_edit',$data);
}

function email_formatto($str)
{
	$CI = &get_instance();
	$exp = array(" ",";");
	$email_format = str_replace($exp,",",$CI->input->post('to')); 
	return $email_format;
}
function email_formatcc($str)
{
	$CI = &get_instance();
	$exp = array(" ",";");
	$email_format = str_replace($exp,",",$CI->input->post('cc')); 
	return $email_format;
}
function email_formatbcc($str)
{
	$CI = &get_instance();
	$exp = array(" ",";");
	$email_format = str_replace($exp,",",$CI->input->post('bcc')); 
	return $email_format;
}

function youtube_id($url)
{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		return 	$my_array_of_vars['v'];    
}