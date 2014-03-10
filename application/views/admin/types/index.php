
<section>
	<h2>Types</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/types/edit', '<i class="icon-plus"></i> Add a type'); ?><br/>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>type name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($types)): foreach($types as $type): ?>	
		<tr>
			<td><?php echo anchor('admin/types/edit/' . $type->id , stripslashes($type->name)); ?></td>
			<td><?php echo btn_edit('admin/types/edit/' . $type->id); ?></td>
			<td><?php echo btn_delete('admin/types/delete/' . $type->id, $type->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','types'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">No types added yet.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
