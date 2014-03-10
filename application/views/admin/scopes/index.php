
<section>
	<h2>Scopes</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button scope="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/scopes/edit', '<i class="icon-plus"></i> Add a scope'); ?><br/>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>scope name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($scopes)): foreach($scopes as $scope): ?>	
		<tr>
			<td><?php echo anchor('admin/scopes/edit/' . $scope->id , stripslashes($scope->name)); ?></td>
			<td><?php echo btn_edit('admin/scopes/edit/' . $scope->id); ?></td>
			<td><?php echo btn_delete('admin/scopes/delete/' . $scope->id, $scope->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','scopes'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">No scopes added yet.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
