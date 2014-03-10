
<section>
	<h2>News & Events</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/events/edit', '<i class="icon-plus"></i> Add news/events'); ?><br/>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($events)): foreach($events as $event): ?>	
		<tr>
			<td><?php echo anchor('admin/events/edit/' . $event->id , $event->name); ?></td>
			<td><?php echo $event->category; ?></td>
			<td><?php echo $event->created; ?></td>
			<td><?php echo btn_edit('admin/events/edit/' . $event->id); ?></td>
			<td><?php echo btn_delete('admin/events/delete/' . $event->id, $event->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','events'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">We could not find any events.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
