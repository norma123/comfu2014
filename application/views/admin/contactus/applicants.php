<h3><?php echo empty($contact->id) ? 'Add Contact Us Details' : 'Edit Contact Us Details '?></h3>
<div class="alert alert-info">
  Add multiple email addresses.<br/>
  NB: Separate email addresses by a comma.
</div>
<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
<?endif?>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
	
	<tr>
		<td>To</td>
		<td>
			<div class="control-group <?=(strpos(form_error('to'),'required'))?"error" : ""?>">
			  <div class="controls">
				<?php echo form_input('to', set_value('to',$contact->to),'class="input-block-level"'); ?>
				<?php echo form_error('to', '<span class="help-inline">', '</span>'); ?>
			  </div>
			</div>
		</td>
	</tr>
	<tr>
		<td>Cc</td>
		<td>
			<div class="control-group">
			  <div class="controls">
				<?php echo form_input('cc', set_value('cc',$contact->cc),'class="input-block-level"'); ?>
			  </div>
			</div>
		</td>
	</tr>
	<tr>
		<td>Bcc</td>
		<td>
			<div class="control-group">
			  <div class="controls">
				<?php echo form_input('bcc', set_value('bcc',$contact->bcc),'class="input-block-level"'); ?>
			  </div>
			</div>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
