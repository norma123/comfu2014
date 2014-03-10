<?php $this->load->view('admin/components/page_head'); ?>

<body style="background: #cc081c;">

	<div class="modal show" role="dialog">
		
<?php $this->load->view($subview); // Subview is set in controller ?>

		<div class="modal-footer">
			&copy; <?php echo date('Y'); ?> <?php echo $meta_title; ?> powered by <? echo anchor("http://www.comfu.com","COMFU","target='blank'")?>
		</div>
	</div>

<?php $this->load->view('admin/components/page_tail'); ?>