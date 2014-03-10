<ul class="nav nav-tabs" id="myTab">
  <li class="active">
    <a href="#home">Services</a>
  </li>
 
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="home">
	

	<h3><?php echo empty($service->id) ? 'Add a new service' : 'Edit service - ' . $service->title; ?></h3>
	<p class="alert alert-info"><?php echo empty($service->id) ? 'Add a new service' : 'Edit service - ' . $service->title; ?> then click 'Save'</p>
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<table class="table">
		<tr>
			<td>service title</td>
			<td>
				<?php echo form_input('title', set_value('title', $service->title),"id='title' "); ?>
				<input type="hidden" name="timestamp" value="<? echo $service->timestamp; ?>"/>
			</td>
		</tr>
		<tr>
			<td> description - estimation</td>
			<td><?php echo form_textarea('description1', set_value('description1', $service->description1), 'class="tinymce"'); ?></td>
		</tr>
		<tr>
			<td> description - planning</td>
			<td><?php echo form_textarea('description2', set_value('description2', $service->description2), 'class="tinymce"'); ?></td>
		</tr>
		<tr>
			<td> description - quantity surveying</td>
			<td><?php echo form_textarea('description3', set_value('description3', $service->description3), 'class="tinymce"'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo  btn_goback('admin/services');?>
				<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
			</td>
		</tr>
	</table>
	<input type="hidden" name="imago-dropzone" id="imago-dropzone" value=""/>
	<?php echo form_close();?>
   </div>
 </div>
