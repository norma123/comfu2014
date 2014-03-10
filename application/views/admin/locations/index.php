
<section>
	<h2>Locations</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/locations/edit', '<i class="icon-plus"></i> Add a location'); ?><br/>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>location name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($locations)): foreach($locations as $location): ?>	
		<tr>
			<td><?php echo anchor('admin/locations/edit/' . $location->id , stripslashes($location->name)); ?></td>
			<td><?php echo btn_edit('admin/locations/edit/' . $location->id); ?></td>
			<td><?php echo btn_delete('admin/locations/delete/' . $location->id, $location->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','locations'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">No locations added yet.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
