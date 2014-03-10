
<section>
	<h2>Portfolio</h2>
	<?php echo anchor('admin/locations', '<i class="icon-plus"></i> Add a Location'); ?>&nbsp; &nbsp;  &nbsp; &nbsp; 
	<?php echo anchor('admin/types', '<i class="icon-plus"></i> Add a Type'); ?>&nbsp; &nbsp;  &nbsp; &nbsp; 
    <?php echo anchor('admin/scopes', '<i class="icon-plus"></i> Add a Scope'); ?><br/><br/>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	<?php echo anchor('admin/portfolios/edit', '<i class="icon-plus"></i> Add a portfolio'); ?><br/>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>portfolio name</th>
				<th>Location</th>
				<th>Type</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php if(count($portfolios)): foreach($portfolios as $portfolio): ?>	
		<tr>
			<td><?php echo anchor('admin/portfolios/edit/' . $portfolio->id , stripslashes($portfolio->name)); ?></td>
			<td><?php $this->portfolio_m->getLocationName($portfolio->location); ?></td>
			<td><?php $this->portfolio_m->getTypeName($portfolio->type); ?></td>
			<td><?php echo btn_edit('admin/portfolios/edit/' . $portfolio->id); ?></td>
			<td><?php echo btn_delete('admin/portfolios/delete/' . $portfolio->id, $portfolio->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','portfolios'); ?></td>
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">No portfolio added yet.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>
