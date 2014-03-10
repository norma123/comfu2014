
<section>
	<h2>Contact Us</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/contactus/edit', '<i class="icon-plus"></i> Add a contact address'); ?><br/>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Contact title</th>
				<th>Telephone</th>
				<th>Email</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($contacts)): foreach($contacts as $contact): ?>	
		<tr>
			<td><?php echo anchor('admin/contactus/edit/' . $contact->id, $contact->title); ?></td>
			<td><?php echo $contact->telephone; ?></td>
			<td><?php echo $contact->email; ?></td>
			<td><?php echo btn_edit('admin/contactus/edit/' . $contact->id); ?></td>
			<td><?php echo btn_delete('admin/contactus/delete/' . $contact->id, $contact->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','contactus'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">No contact addresses added yet.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
