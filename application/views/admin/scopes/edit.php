<ul class="nav nav-tabs" id="myTab">
  <li class="active">
    <a href="#home">scope</a>
  </li>
 
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="home">
	

	<h3><?php echo empty($scope->id) ? 'Add a new scope' : 'Edit scope - ' . $scope->name; ?></h3>
	<p class="alert alert-info"><?php echo empty($scope->id) ? 'Add a new scope' : 'Edit scope - ' . $scope->name; ?> then click 'Save'</p>
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<table class="table">
		<tr>
			<td>scope name</td>
			<td>
				<?php echo form_input('name', set_value('name', stripslashes($scope->name)),"id='name' "); ?>
				<input type="hidden" name="timestamp" value="<? echo $scope->timestamp; ?>"/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo  btn_goback('admin/scopes');?>
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
            <h4 class="alert-heading">scope name is empty</h4>
		</div>
	</div>