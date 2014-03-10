
<section>
	<h2>varieties</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/varieties/edit', '<i class="icon-plus"></i> Add a variety'); ?><br/>
	<?php //echo anchor('admin/products/edit', '<i class="icon-plus"></i> Add a product'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Category</th>
				<th>variety name</th>
				<!--<th>description</th>-->
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($varieties)): foreach($varieties as $variety): ?>	
		<tr>
			<td><?php echo $variety->category; ?></td>
			<td><?php echo anchor('admin/varieties/edit/' . $variety->id, $variety->name); ?></td>
			<!--<td><?php //echo $variety->description; ?></td>-->
			<td><?php echo btn_edit('admin/varieties/edit/' . $variety->id); ?></td>
			<td><?php echo btn_delete('admin/varieties/delete/' . $variety->id, $variety->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','variety'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">We could not find any varieties.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
