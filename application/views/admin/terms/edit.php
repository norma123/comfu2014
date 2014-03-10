<div class="tab-content">
	<h3><?php echo empty($privacy->id) ? 'Add a new privacy' : 'Edit privacy ' . $privacy->title; ?></h3>
	<?php echo validation_errors(); ?>
	<?php echo form_open('admin/terms/edit'); ?>
	
	<table class="table">
		<tr>
			<td>Title</td>
			<td>
				<?php echo form_input('title', set_value('title', $privacy->title)); ?>
			</td>
		</tr>
		<tr>
			<td>Description</td>
			<td><?php echo form_textarea('description', set_value('description', $privacy->description), 'class="tinymce"'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo  btn_goback('admin/privacy')?>
				<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
			</td>
		</tr>
	</table>
	<?php echo form_close();?>
</div>
 