<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo config_item('charset');?>" />
	<title><?php echo $meta_title; ?></title>
	<!-- Bootstrap -->
	<link href="<?php echo site_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('css/admin.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('css/datepicker.css'); ?>" rel="stylesheet">
		
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?php echo site_url('js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('js/bootstrap-datepicker.js'); ?>"></script>
	<?php if(isset($sortable) && $sortable === TRUE): ?>
	<script src="<?php echo site_url('js/jquery-ui-1.9.1.custom.min.js'); ?>"></script>
	<script src="<?php echo site_url('js/jquery.mjs.nestedSortable.js'); ?>"></script>
	<?php endif; ?>
	<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="<?php echo site_url('assets/css/jquery.fileupload-ui.css')?>">
	<!-- CSS adjustments for browsers with JavaScript disabled -->
	<noscript><link rel="stylesheet" href="<?php echo site_url('assets/css/jquery.fileupload-ui-noscript.css')?>"></noscript>
	<!-- TinyMCE -->
	<script type="text/javascript" src="<?php echo site_url('js/tiny_mce/tiny_mce.js'); ?>"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
	
			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
		});
	</script>
	<!-- /TinyMCE -->
	<!-- Date picker -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	 
	<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
	
	<script type="text/javascript">
	$(function() {
		 $(".datepicker").datepicker({ dateFormat: 'MM dd, yy' }); //month day,year calendar
		 $('.monthPicker').datepicker({ //month(abrv). year calendar
		  changeMonth: true,
		  changeYear: true,
		  showButtonPanel: true,
		  dateFormat: 'M. yy'
		 }).focus(function() {
		  var thisCalendar = $(this);
		  $('.ui-datepicker-calendar').detach();
		  $('.ui-datepicker-close').click(function() {
		   var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
		   var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
		   thisCalendar.datepicker('setDate', new Date(year, month, 1));
		  });
		 });
		});
	</script>
	<!-- Date picker -->
</head>