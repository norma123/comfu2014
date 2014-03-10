
<section>
	<h2>Branches</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/branches/edit', '<i class="icon-plus"></i> Add a branch'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Address</th>
				<th>Brand</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($branches)): foreach($branches as $branche): ?>	
		<tr>
			<td><?php echo anchor('admin/branches/edit/' . $branche->id, $branche->address); ?></td>
			<td><?php echo $branche->name; ?></td>
			<td><?php echo btn_edit('admin/branches/edit/' . $branche->id); ?></td>
			<td><?php echo btn_delete('admin/branches/delete/' . $branche->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','branch'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">We could not find any branches.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
