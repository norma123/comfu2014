<ul class="nav nav-tabs" id="myTab">
  <li class="active">
    <a href="#home">career</a>
  </li>
 
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="home">
	

	<h3><?php echo empty($career->id) ? 'Add a new career' : 'Edit career - ' . $career->name; ?></h3>
	<p class="alert alert-info"><?php echo empty($career->id) ? 'Add a new career' : 'Edit career - ' . $career->name; ?> then click 'Save'</p>
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<table class="table">
		<tr>
			<td>career name</td>
			<td>
				<?php echo form_input('name', set_value('name', $career->name),"id='name' "); ?>
				<input type="hidden" name="timestamp" value="<? echo $career->timestamp; ?>"/>
			</td>
		</tr>
		<tr>
			<td>Small description</td>
			<td><?php echo form_textarea('description', set_value('description', $career->description), 'class="tinymce"'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo  btn_goback('admin/careers');?>
				<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
			</td>
		</tr>
	</table>
	<input type="hidden" name="imago-dropzone" id="imago-dropzone" value=""/>
	<?php echo form_close();?>
  </div>
  <div class="tab-pane" id="images">
		<br>
	  	<div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">career name is empty</h4>
            <p>Add career name then upload image</p>
		</div>
	</div>