<?php $this->load->view('admin/components/page_head'); ?>
<body>
	<div class="container">
		<div class="span" style="float:right;margin-top:17px">
					<section>
						<div class="btn-group">
						  <a class="btn btn-info" href="#"><i class="icon-user icon-white"></i> <?echo $this->session->userdata("name")?></a>
						  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<!--<li><?php echo anchor('admin/user', "<i class='icon-plus'></i> Manage Users"); ?></li>
							<li><?php echo anchor('admin/user/edit/' . $this->session->userdata("id"), "<i class='icon-pencil'></i> Edit"); ?></li>
							<li class="divider"></li>-->
							<li><?php echo anchor('admin/user/logout', '<i class="icon-off"></i> logout'); ?></li>
						  </ul>
						</div>
					</section>
				</div>
		<section>
			<h2>
				<a class="brand" href="<?php echo site_url('admin/dashboard'); ?>"><?php echo $meta_title; ?></a>
			</h2>
			
		</section>
		<div class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					
					<li  <?=($this->uri->segment(2) == "dashboard")? "class='active'":""?>><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
					<!--<li <?//=($this->uri->segment(2) == "Home" && $this->uri->segment(3) == "")? "class='active'":""?>><?php// echo anchor('admin/banners', 'Home'); ?></li>-->
					<li <?=($this->uri->segment(2) == "events" && $this->uri->segment(3) == "")? "class='active'":""?>><?php echo anchor('admin/events', 'News&Events'); ?></li>
					<li <?=($this->uri->segment(2) == "careers" && $this->uri->segment(3) == "")? "class='active'":""?>><?php echo anchor('admin/careers', 'Careers'); ?></li>
					<li <?=($this->uri->segment(2) == "portfolio" && $this->uri->segment(3) == "")? "class='active'":""?>><?php echo anchor('admin/portfolios', 'Portfolios'); ?></li>
					<li <?=($this->uri->segment(2) == "services" && $this->uri->segment(3) == "")? "class='active'":""?>><?php echo anchor('admin/services', 'Services'); ?></li>
					<li <?=($this->uri->segment(2) == "contact" && $this->uri->segment(3) == "")? "class='active'":""?>><?php echo anchor('admin/contactus', 'Contact us'); ?></li>
					<li <?=($this->uri->segment(2) == "applicants" && $this->uri->segment(3) == "")? "class='active'":""?>><?php echo anchor('admin/applicants', 'Careers contact'); ?></li>
					<li <?=($this->uri->segment(2) == "About us" && $this->uri->segment(3) == "")? "class='active'":""?>><?php echo anchor('admin/about', 'About us'); ?></li>
					<!--<li <?//=($this->uri->segment(2) == "terms" && $this->uri->segment(3) == "")? "class='active'":""?>><?php //echo anchor('admin/terms/index/2', 'Terms'); ?></li>-->
					<!--<li <?//=($this->uri->segment(2) == "privacy" && $this->uri->segment(3) == "")? "class='active'":""?>><?php //echo anchor('admin/privacy/index/1', 'Privacy'); ?></li>-->
					
				</ul>	
			</div>
			
		</div>
	</div>
	<div class="container">
		<div class="row">
			<!-- Main column -->
			<div class="span12">
				<?php $this->load->view($subview); ?>
			</div>
		</div>
	</div>

<?php $this->load->view('admin/components/page_tail'); ?>