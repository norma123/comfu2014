
<section>
	<h2>Services</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php// echo anchor('admin/services/edit', '<i class="icon-plus"></i> Add a service'); ?><!--<br/>-->
	<table class="table table-striped">
		<thead>
			<tr>
				<th>service title</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($services)): foreach($services as $service): ?>	
		<tr>
			<td><?php echo anchor('admin/services/edit/' . $service->id , $service->title); ?></td>
			<td><?php echo btn_edit('admin/services/edit/' . $service->id); ?></td>
			<td><?php echo btn_delete('admin/services/delete/' . $service->id, $service->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','services'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">No service added yet.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
