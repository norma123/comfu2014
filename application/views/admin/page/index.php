<section>
	<h2>Pages</h2>
	<?if($this->session->flashdata('success')):?>
	<div class="alert alert-success">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <?php echo $this->session->flashdata('success'); ?>
	</div>
	<?endif?>
	 <?php //echo anchor('admin/page/edit', '<i class="icon-plus"></i> Add a page'); ?> 
	 <?// echo anchor('admin/page/order', '<i class="icon-circle-arrow-up"></i> Order pages'); ?> 
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Parent</th>
				<th>Edit</th>
				<!--<th>Delete</th>-->
			</tr>
		</thead>
		<tbody>
<?php if(count($pages)): foreach($pages as $page): ?>	
		<tr>
			<td><?php echo ($page->edit)? anchor('admin/page/edit/' . $page->id, $page->title) : $page->title; ?></td>
			<td><?php echo $page->parent_slug; ?></td>
			<td>
				<?php //if($page->edit):?>
					<?php if($page->parent_id!='0'){echo btn_edit('admin/page/edit/' . $page->id);} //if($page->parent_id!='0') for user as admin?>
				<?php //endif?>
			</td>
			<td>
				<?php //if($page->edit):?>
					<?php// echo btn_delete('admin/page/delete/' . $page->id,$page->id,'<i class="icon-remove"></i>','class=" tool-tip" title="Delete"','Product'); ?>
				<?php //endif?>
			</td>
			
		</tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="3">We could not find any pages.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
</section>