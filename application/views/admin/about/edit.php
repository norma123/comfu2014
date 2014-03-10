<div class="tab-content">
	<h3><?php echo empty($aboutus->id) ? 'Add the description of About us' : 'Edit about ' . $aboutus->title; ?></h3>
	<?php echo validation_errors(); ?>
	<?php echo form_open('admin/about/edit'); ?>
	
	<table class="table">
		<!--<tr>
			<td>Title</td>
			<td>
				<?php// echo form_input('title', set_value('title', $about->title)); ?>
			</td>
		</tr>-->
		<tr>
			<td>Description</td>
			<td><?php echo form_textarea('description', set_value('description', $aboutus->description), 'class="tinymce"'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo  btn_goback('admin/about')?>
				<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
			</td>
		</tr>
	</table>
	<?php echo form_close();?>
</div>
 