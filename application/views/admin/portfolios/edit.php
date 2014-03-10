<ul class="nav nav-tabs" id="myTab">
  <li class="active">
    <a href="#home">Portfolio</a>
  </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="home">
	

	<h3><?php echo empty($portfolio->id) ? 'Add a new portfolio' : 'Edit portfolio - ' . $portfolio->name; ?></h3>
	<p class="alert alert-info"><?php echo empty($portfolio->id) ? 'Add a new portfolio' : 'Edit portfolio - ' . $portfolio->name; ?> then click 'Save'</p>
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<table class="table">
		<tr>
			<td>portfolio name</td>
			<td>
				<?php echo form_input('name', set_value('name', stripslashes($portfolio->name)),"id='name' "); ?>
				<input type="hidden" name="timestamp" value="<? echo $portfolio->timestamp; ?>"/>
			</td>
		</tr>
		<tr>
			<td>portfolio location</td>
			<td>
				<select name="location" id="locations">
					<? if($this->uri->segment(4)){ ?>
					<? foreach ($locationsname as $ln):?>
					<option value="<?= $ln->id;?>"><?= $ln->name;?></option>
					<? endforeach;?>
					<? } //else {?>
					<option value="">----- Select location -----</option>
					<? //}?>
					<?
					$locations = $this->locations_m->get();
					$opt="";
						foreach($locations as $location)
						{
							$opt.="<option value='".$location->id."' set_select('location','".$location->id."',('".$location->id."'=='selected')?true:false);>".$location->name."</option>";
						}
					echo $opt;	
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>date</td>
			<style type="text/css">
			.ui-datepicker-calendar {
				display: none;
			}
		​	</style>
			<td>
				<!--<input name="cc_expiryDate" id="expiryDate" class="date-picker" /> (mm/yyyy)-->
				<?// $("#datepicker").datepicker({dateFormat: "mm/yy" });?>
				<?php echo form_input('projdate', set_value('projdate', stripslashes($portfolio->projdate)),"class='monthPicker'"); ?>
				<input type="hidden" name="timestamp" value="<? echo $portfolio->timestamp; ?>"/>
			</td>
		</tr>
		<tr>
			<td>Type</td>
			<td>
				<select name="type" id="types">
					<? if($this->uri->segment(4)){ ?>
					<? foreach ($typesname as $tn):?>
					<option value="<?= $tn->id;?>"><?= $tn->name;?></option>
					<? endforeach;?>
					<? } //else {?>
					<option value="">----- Select Type -----</option>
					<? //}?>
					<?
					$types = $this->types_m->get();
					$opt="";
						foreach($types as $type)
						{
							$opt.="<option value='".$type->id."' set_select('type','".$type->id."',('".$type->id."'=='selected')?true:false);>".$type->name."</option>";
						}
					echo $opt;	
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Scope</td>
			<td>
				<select name="scope" id="scopes">
					<? if($this->uri->segment(4)){ ?>
					<? foreach ($scopesname as $sn):?>
					<option value="<?= $sn->id;?>"><?= $sn->name;?></option>
					<? endforeach;?>
					<? } //else {?>
					<option value="">----- Select Scope -----</option>
					<? //}?>
					<?
					$scopes = $this->scopes_m->get();
					$opt="";
						foreach($scopes as $scope)
						{
							$opt.="<option value='".$scope->id."' set_select('scope','".$scope->id."',('".$scope->id."'=='selected')?true:false);>".$scope->name."</option>";
						}
					echo $opt;	
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Consultant</td>
			<td>
				<?php echo form_input('consultant', set_value('consultant', stripslashes($portfolio->consultant)),"id='consultant' "); ?>
				<input type="hidden" name="timestamp" value="<? echo $portfolio->timestamp; ?>"/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo  btn_goback('admin/portfolios');?>
				<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
			</td>
		</tr>
	</table>
	<!--<script>
		  $(function () {
			$("#locations").click(function(){
				d = $(this).val();
				$.post("<?php //echo site_url('admin/portfolios/get_locations')?>/"+d,function(data,status){
					$("#locations").html(data);
				});
			});
			$("#types").click(function(){
				d = $(this).val();
				$.post("<?php //echo site_url('admin/portfolios/get_types')?>/"+d,function(data,status){
					$("#types").html(data);
				});
			});
			$("#scopes").click(function(){
				d = $(this).val();
				$.post("<?php //echo site_url('admin/portfolios/get_scopes')?>/"+d,function(data,status){
					$("#scopes").html(data);
				});
			});
		  });
	</script>-->
	<?php echo form_close();?>
 </div>
