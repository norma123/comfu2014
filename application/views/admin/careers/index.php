
<section>
	<h2>Careers</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/careers/edit', '<i class="icon-plus"></i> Add a career'); ?><br/>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>career name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($careers)): foreach($careers as $career): ?>	
		<tr>
			<td><?php echo anchor('admin/careers/edit/' . $career->id , $career->name); ?></td>
			<td><?php echo btn_edit('admin/careers/edit/' . $career->id); ?></td>
			<td><?php echo btn_delete('admin/careers/delete/' . $career->id, $career->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','career'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">No careers added yet.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
