<? if($this->uri->segment(2)=='search'){
$s=trim($this->uri->segment(3));
?>
	<!-- left arrow of the navigation -->
	<!--<img width="35px" height="72px" src="<?php //echo site_url('css/images/arrow.gif')?>" class="portfolioarrow"/>-->
	<!-- end of left arrow of the navigation -->
	<? 
	$loc = $this->portfolio_m->getLocationId($s);
	$sc =  $this->portfolio_m->getScopeId($s);
	$t =  $this->portfolio_m->geTypeId($s);
	$this->db->like('name',$s,'both');
	$this->db->or_like('consultant',$s,'both');
	$this->db->or_like('projdate',$s,'both');
	$this->db->or_like('location',$loc, 'none');
	$this->db->or_like('scope',$sc, 'none');
	$this->db->or_like('type',$t, 'none');
	$this->data['eventsSearch'] = $this->portfolio_m->get();
	$eventsSearch=$this->data['eventsSearch'];
	?>
	<div>
	<table border="0" cellspacing="3" cellpadding="0"  id="projecttable">
		<tr>
			<!--<th align="center" valign="center">JOB</th>-->
			<th align="center" valign="center">PROJECT NAME</th>
			<th align="center" valign="center">COUNTRY</th>
			<th align="center" valign="center">DATE</th>
			<th align="center" valign="center">TYPE</th>
			<th align="center" valign="center">SCOPE</th>
			<th align="center" valign="center">CONSULTANT</th>
		</tr>
		<? if ($eventsSearch==NULL){ echo "<tr><td>No results found</td><td></td><td></td><td></td><td></td><td></td></tr>";}?>
		<? foreach($eventsSearch as $portfolio){?>
			<tr>
				<!--<td align="center" valign="center"><?//= $portfolio->id;?></td>-->
				<td align="center" valign="center"><?= $portfolio->name;?></td>
				<td align="center" valign="center"><?= $this->portfolio_m->getLocationName($portfolio->location);?></td>
				<td align="center" valign="center"><?= $portfolio->projdate;?></td>
				<td align="center" valign="center"><?= $this->portfolio_m->getTypeName($portfolio->type);?></td>
				<td align="center" valign="center"><?= $this->portfolio_m->getScopeName($portfolio->scope);?></td>
				<td align="center" valign="center"><?= $portfolio->consultant;?></td>
			</tr>
		<? }?>
</div>
<? }else{ ?>
	<div id="breadcrumb">
		<h3>PORTFOLIO</h3><h3>></h3><h3><?= strtoupper($this->uri->segment(2))?></h3>
		<? if($this->uri->segment(2)=='location'){?>
			<h3>></h3>
			<h3 style="text-transform:uppercase;">
				<?= strtoupper($this->portfolio_m->getLocationName($this->uri->segment(3)))?>
			</h3> 
		<? }?>
		<? if($this->uri->segment(2)=='type'){?>
			<h3>></h3>
			<h3 style="text-transform:uppercase;">
				<?= strtoupper($this->portfolio_m->getTypeName($this->uri->segment(3)))?>
			</h3> 
		<? }?>
		<? if($this->uri->segment(2)=='scope'){?>
			<h3>></h3>
			<h3 style="text-transform:uppercase;">
				<?= strtoupper($this->portfolio_m->getScopeName($this->uri->segment(3)))?>
			</h3> 
		<? }?>
		<div style="clear:both"></div>
	</div>
	<div>
		<table border="0" cellspacing="3" cellpadding="0"  id="projecttable">
			<tr>
				<!--<th align="center" valign="center">JOB</th>-->
				<th align="center" valign="center">PROJECT NAME</th>
				<th align="center" valign="center">COUNTRY</th>
				<th align="center" valign="center">DATE</th>
				<th align="center" valign="center">TYPE</th>
				<th align="center" valign="center">SCOPE</th>
				<th align="center" valign="center">CONSULTANT</th>
			</tr>
			<? if($this->uri->segment(2)=='all'){ ?>
				<? foreach($portfolios as $portfolio){?>
				<tr>
					<!--<td align="center" valign="center"><?//= $portfolio->id;?></td>-->
					<td align="center" valign="center"><?= $portfolio->name;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getLocationName($portfolio->location);?></td>
					<td align="center" valign="center"><?= $portfolio->projdate;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getTypeName($portfolio->type);?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getScopeName($portfolio->scope);?></td>
					<td align="center" valign="center"><?= $portfolio->consultant;?></td>
				</tr>
				<? }?>
			<? }?>
			<? if($this->uri->segment(2)=='location'){ ?>
				<? foreach($portfoliosLocation as $portfolioLocation){?>
				<tr>
					<!--<td align="center" valign="center"><?//= $portfolioLocation->id;?></td>-->
					<td align="center" valign="center"><?= $portfolioLocation->name;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getLocationName($portfolioLocation->location);?></td>
					<td align="center" valign="center"><?= $portfolioLocation->projdate;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getTypeName($portfolioLocation->type);?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getScopeName($portfolioLocation->scope);?></td>
					<td align="center" valign="center"><?= $portfolioLocation->consultant;?></td>
				</tr>
				<? }?>
			<? }?>
			<? if($this->uri->segment(2)=='type'){ ?>
				<? foreach($portfoliosType as $portfolioType){?>
				<tr>
					<!--<td align="center" valign="center"><?//= $portfolioType->id;?></td>-->
					<td align="center" valign="center"><?= $portfolioType->name;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getLocationName($portfolioType->location);?></td>
					<td align="center" valign="center"><?= $portfolioType->projdate;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getTypeName($portfolioType->type);?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getScopeName($portfolioType->scope);?></td>
					<td align="center" valign="center"><?= $portfolioType->consultant;?></td>
				</tr>
				<? }?>
			<? }?>
			<? if($this->uri->segment(2)=='scope'){ ?>
				<? foreach($portfoliosScope as $portfolioScope){?>
				<tr>
					<!--<td align="center" valign="center"><?//= $portfolioScope->id;?></td>-->
					<td align="center" valign="center"><?= $portfolioScope->name;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getLocationName($portfolioScope->location);?></td>
					<td align="center" valign="center"><?= $portfolioScope->projdate;?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getTypeName($portfolioScope->type);?></td>
					<td align="center" valign="center"><?= $this->portfolio_m->getScopeName($portfolioScope->scope);?></td>
					<td align="center" valign="center"><?= $portfolioScope->consultant;?></td>
				</tr>
				<? }?>
			<? }?>
		</table>
	</div>
<? } ?>