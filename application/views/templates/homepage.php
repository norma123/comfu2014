<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Manoukian</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="COMFU" />
                <link rel="stylesheet" type="text/css" href="<?php echo site_url('css/style.css')?>" />
				<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/blueberry.css')?>" /> 
                <script src="<?php echo site_url('js/jquery-1.8.3.min.js')?>"></script>
				<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
                <script src="<?php echo site_url('js/animatescroll.js')?>"></script>
				<!-- slider -->
				<script src="<?php echo site_url('js/jquery.blueberry.js')?>"></script>

				<script>
				$(window).load(function() {
					$('.blueberry').blueberry({
						keynav:true,
						pager:false
					});
				});
				</script>
				<!-- slider -->
				<script>
				  $(function() {
				    $("._country_").click(function(){
						var country_id=$(this).attr("rel");
						$("#projectbox").html("<img src='<?php echo site_url('css/images/loading.gif')?>' />");
						$.get("<?php echo site_url('ajax/location')?>"+"/"+country_id,function(data){
							$("#projectbox").slideUp("fast",function(){
								$("#projectbox").html(data);
								$("#projectbox").fadeIn("fast");
								$(".portimages").slideUp();
							});
						});
						return false;
					});
					$("._search_button").click(function(){
							var s=$("#searchproject").val();
							$("#projectbox").html("<img src='<?php echo site_url('css/images/loading.gif')?>' />");
							$('#projectbox').animatescroll();
							$(".servicesarrow").hide();
							$.get("<?php echo site_url('ajax/search')?>"+"/"+s,function(data){
								$("#projectbox").slideUp("fast",function(){
								$("#projectbox").html(data);
								$("#projectbox").fadeIn("fast");
								//$(".portimages").slideUp();	
								$('#projectbox').attr('style','min-height:530px;');
								});
							});
							return false;
					});
					 $("#searchproject").keypress(function(e){
						if(e.which == 13){ 
							$("._search_button").trigger("click");
						}
					});
					$("._type_").click(function(){
						var type_id=$(this).attr("rel");
						$("#projectbox").html("<img src='<?php echo site_url('css/images/loading.gif')?>' />");
						$.get("<?php echo site_url('ajax/type')?>"+"/"+type_id,function(data){
							$("#projectbox").slideUp("fast",function(){
								$("#projectbox").html(data);
								$("#projectbox").fadeIn("fast");
								$(".portimages").slideUp();		
								$(this).siblings('li').find('ul').slideUp();
							});
						});
						return false;
					});
					$("._scope_").click(function(){
						var scope_id=$(this).attr("rel");
						$("#projectbox").html("<img src='<?php echo site_url('css/images/loading.gif')?>' />");
						$.get("<?php echo site_url('ajax/scope')?>"+"/"+scope_id,function(data){
							$("#projectbox").slideUp("fast",function(){
								$("#projectbox").html(data);
								$("#projectbox").fadeIn("fast");
								$(".portimages").slideUp();
							});
						});
						return false;
					});
					$("._all_").click(function(){
						$("#projectbox").html("<img src='<?php echo site_url('css/images/loading.gif')?>' />");
						$.get("<?php echo site_url('ajax/all')?>",function(data){
							$("#projectbox").slideUp("fast",function(){
								$("#projectbox").html(data);
								$("#projectbox").fadeIn("fast");
								$(".portimages").slideUp();
							});
						});
						return false;
					});
					$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
					$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
				
					$( "#stabs" ).tabs();
					
					$( "#accordion" ).accordion();
					
					$( "#menu" ).menu();
					
					$("#mainMenu1").mouseenter(function(){
						$("#subMenu1").show(); 
					});
					$("#subMenu1, #mainMenu1").mouseleave(function(){
						$("#subMenu1").hide(); 
					});
					$("#mainMenu2").mouseenter(function(){
						$("#subMenu2").show(); 
					});
					$("#subMenu2, #mainMenu2").mouseleave(function(){
						$("#subMenu2").hide(); 
					});
					$("#mainMenu3").mouseenter(function(){
						$("#subMenu3").show(); 
					});
					$("#subMenu3, #mainMenu3").mouseleave(function(){
						$("#subMenu3").hide(); 
					});
					<? if(trim(stripslashes($this->uri->segment(1)))=='submit'){?>
						$('#careers').animatescroll();
					<? }?>
				  });
			  </script>
	</head>
	<body>
		<!-- Container : includes the website -->
		<div id="container">
			<!-- Left Panel : includes the Navigation Bar-->
			<div id="leftpanel">
				<!-- Manoukian Logo -->
				<div id="logo">
					<a href="#" target="_blank">
						<img src="<?php echo site_url('css/images/logo.png')?>" alt="Manoukian Logo"/>
					</a>
				</div>
				<!-- End of Logo -->
				
				<!-- Navigation Panel -->
				<div id="navigationpanel">
				<ul class="navigation">
						<!-- Navigation to the Homepage section -->
						<li>
							<a href="#" onclick="$('#homepage').animatescroll();">
								<img src="<?php echo site_url('css/images/homenav.gif')?>"/>
							</a>
						</li>
						<!-- End of Navigation to the Homepage section -->
						
						<!-- Navigation to the About Us section -->
						<li>
							<a href="#" onclick="$('#aboutus').animatescroll();">
								About Us
							</a>
						</li>
						<!-- End of Navigation to the About us section -->
						
						<!-- Navigation to the Portfolio section -->
						<li>
							<a href="#" onclick="$('#portfolio').animatescroll();">
								Portfolio
							</a>
						</li>
						<!-- End of Navigation to the Portfolio section -->
						
						<!-- Navigation to the Services section -->
						<li>
							<a href="#" onclick="$('#services').animatescroll(); $('.servicesarrow').show();">
								Services
							</a>
						</li>
						<!-- End of Navigation to the Services section -->
						
						<!-- Navigation to the Careers section -->
						<li>
							<a href="#" onclick="$('#careers').animatescroll();">
								Careers
							</a>
						</li>
						<!-- End of Navigation to the Careers section -->
						
						<!-- Navigation to the Construction Materials Prices section -->
						<li>
							<a href="#" onclick="$('#construction').animatescroll();">
								Construction Material Prices
							</a>
						</li>
						<!-- End of Navigation to the Construction Materials Prices section -->
						
						<!-- Navigation to the Construction Materials Prices section -->
						<li>
							<a href="#" onclick="$('#contactus').animatescroll();">
								Contact Us
							</a>
						</li>
						<!-- End of Navigation to the Construction Materials Prices section -->
						
						
					</ul>
				</div>
				<!-- End of Navigation Panel -->
				<? //print_r($ev)?>
				<div id="newshome">
					<div><a href="#" onclick="$('#news').animatescroll();"><img src="<?= site_url('css/images/ne.png')?>"/></a></div>
					<div id="hnewsbox">
						<a href="#" onclick="$('#news').animatescroll();"><img width="182px" height="102px" src="<?= site_url('assets/events/'.$ev[0]->photo);?>"/></a>
						<div id="hnewsshadow">
							<?= $ev[0]->created;?><br/>
							<a href="#" onclick="$('#news').animatescroll();"><?= $ev[0]->name;?></a>
							
						</div>
						<span style="padding-left:150px"><a href="#" onclick="$('#news').animatescroll();">see all</a></span>
						<div style="padding-top:20px;position:relative">
							<input type="text" name="searchprojet" placeholder="Search for a project..." id='searchproject'/>
							<a href="#" class="_search_button" style="display:block;position:absolute;right:5px;top:20px;text-indent:-99999px;overflow:hidden;width:20px;height:20px;">srch</a>
						</div>
						<div style="padding-top:15px;">
							<a target="_blank" href="https://twitter.com/Manoukianepqs"><img src="<?= site_url('css/images/twitter.jpg')?>"/></a>
							<a href="#"><img src="<?= site_url('css/images/linkedin.gif')?>"/></a>
							<a target="_blank" href="https://www.facebook.com/pages/Manoukian-EPQS-Construction-Management/645639245474964"><img src="<?= site_url('css/images/facebook.gif')?>"/></a>
						</div>
					</div>
				</div>
				<!-- end of menu new -->
				
			</div>
			<!-- End Of the Left Panel-->
		
			<!-- Right Panel : includes the scrolling pages-->
			<div id="rightpanel">
			
					<!-- Homepage Section -->
					<div id="homepage">
						<img src="css/images/homebnr.png" style="position:absolute;top:0;z-index:99"/>
						
						<!-- blueberry -->

						<div class="blueberry" style="width:710px;height:639px;">
						  <ul class="slides" style="padding:0">
							<li><img src="<?echo site_url('css/images/banners/HOME-1.jpg')?>" style="width:710px;height:639px"/></li>
							<li><img src="<?echo site_url('css/images/banners/HOME2.jpg')?>" style="width:710px;height:639px"/></li>
							
						  </ul>
						</div>

					<!-- blueberry -->
						
					</div>
					<!-- End of homepage Section -->
					
					<!-- About us Section -->
					<div id="aboutus">
						<!-- left arrow of the navigation -->
						<img src="<?php echo site_url('css/images/arrow.gif')?>" class="aboutusarrow"/>
						<!-- End left arrow of the navigation -->
						
						<div id="top">
							<div class="aboutustext">
								<div class="aboutusscrollingtext">
									<? echo $aboutus->description; ?>
									<img src="<?php echo site_url('css/images/arrowup.gif')?>" class="aboutarrowup"/>
									<img src="<?php echo site_url('css/images/arrowdown.gif')?>" class="aboutarrowdown"/>
								</div>
								
							</div>
							
							
						</div>
						
					</div>
					<!-- End of About us Section -->
					
					<!-- Portfolio Section -->
					<div id="portfolio">
							<img src="<?php echo site_url('css/images/arrow.gif')?>" class="portfolioarrow"/>
							
						<div id="portfoliotop"></div>
						<div id="portfoliobox">
							<!-- the menu in portfolio -->
							<div id="menunavcon">
								<ul id="menu">
								  <li>
									<a class="_all_" href="<?= site_url('all')?>">All</a>
								  </li>
								  <li id="mainMenu1">
									<a>BY COUNTRY </a>
									<ul id="subMenu1" style="width:450px;height:300px;">
										<? foreach($locations as $location){?>
											<li style="float:left" class="ui-state-disabled">
												<a class="_country_" rel="<?=$location->id?>" href="<?= site_url('location/'.$location->id);?>">
													<?= $location->name;?>
												</a>
											</li>
										<? }?>
									</ul>
									<div style="clear:both"></div>
								  </li>
								  <li id="mainMenu2" style="position:absolute;">
									<a>BY TYPE </a>
									<ul id="subMenu2" style="width:450px;height:250px;">
									 <? foreach($types as $type){?>
									  <li style="float:left"  class="ui-state-disabled"><a class="_type_" rel="<?=$type->id?>" href="<?= site_url('type/'.$type->id);?>"><?= $type->name;?></a></li>
									<? }?>
									</ul>
									<div style="clear:both"></div>
								  </li>
								  <li id="mainMenu3" style="position:absolute;top:68px; ">
									<a>BY SERVICE </a>
									<ul id="subMenu3" style="width:450px;height:230px;">
									<? foreach($scopes as $scope){?>
									  <li style="float:left" class="ui-state-disabled"><a class="_scope_" rel="<?=$scope->id?>" href="<?= site_url('scope/'.$scope->id);?>"><?= $scope->name;?></a></li>
									<? }?>
									</ul>
									<div style="clear:both"></div>
								  </li>
								</ul>
							</div>
							<!-- end of menu in portfolio -->
							<div class="portimages">
								<img src="<?php echo site_url('css/images/p1.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p2.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p3.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p4.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p5.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p6.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p7.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p8.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p9.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p7.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p11.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p12.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p13.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p14.jpg')?>"/>
								<img src="<?php echo site_url('css/images/p15.jpg')?>"/>
							</div>
							
							<!-- table portfolio projects -->		
								<div id="projectbox">
								<? if($this->uri->segment(1)=='all' || $this->uri->segment(1)=='location' || $this->uri->segment(1)=='type' || $this->uri->segment(1)=='scope'){ ?>
									<div id="breadcrumb">
										<h3>PORTFOLIO</h3><h3>></h3><h3><?= strtoupper($this->uri->segment(1))?></h3>
										<? if($this->uri->segment(1)=='location'){?>
											<h3>></h3>
											<h3>
												<?= strtoupper($this->portfolio_m->getLocationName($this->uri->segment(2)))?>
											</h3> 
										<? }?>
										<? if($this->uri->segment(1)=='type'){?>
											<h3>></h3>
											<h3>
												<?= strtoupper($this->portfolio_m->getTypeName($this->uri->segment(2)))?>
											</h3> 
										<? }?>
										<? if($this->uri->segment(1)=='scope'){?>
											<h3>></h3>
											<h3>
												<?= strtoupper($this->portfolio_m->getScopeName($this->uri->segment(2)))?>
											</h3> 
										<? }?>
										<div style="clear:both"></div>
									</div>
									<div>
										<table border="0" cellspacing="3" cellpadding="0"  id="projecttable">
											<tr>
												<th align="center" valign="center">JOB</th>
												<th align="center" valign="center">PROJECT NAME</th>
												<th align="center" valign="center">COUNTRY</th>
												<th align="center" valign="center">DATE</th>
												<th align="center" valign="center">TYPE</th>
												<th align="center" valign="center">SCOPE</th>
												<th align="center" valign="center">CONSULTANT</th>
											</tr>
											<? if($this->uri->segment(1)=='all'){ ?>
												<? foreach($portfolios as $portfolio){?>
												<tr>
													<td align="center" valign="center"><?= $portfolio->id;?></td>
													<td align="center" valign="center"><?= $portfolio->name;?></td>
													<td align="center" valign="center"><?= $this->portfolio_m->getLocationName($portfolio->location);?></td>
													<td align="center" valign="center"><?= $portfolio->projdate;?></td>
													<td align="center" valign="center"><?= $this->portfolio_m->getTypeName($portfolio->type);?></td>
													<td align="center" valign="center"><?= $this->portfolio_m->getScopeName($portfolio->scope);?></td>
													<td align="center" valign="center"><?= $portfolio->consultant;?></td>
												</tr>
												<? }?>
											<? }?>
											<? if($this->uri->segment(1)=='location'){ ?>
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
											<? if($this->uri->segment(1)=='type'){ ?>
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
											<? if($this->uri->segment(1)=='scope'){ ?>
												<? foreach($portfoliosScope as $portfolioScope){?>
												<tr>
													<td align="center" valign="center"><?= $portfolioScope->id;?></td>
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
								<? }?>
								</div>
							
							
							<!-- end of table portfolio projects-->
						</div>
					</div>
					<!-- End of portfolio Section -->
					
					<!-- Services Section -->
					<div id="services">
						<img src="<?php echo site_url('css/images/arrow.gif')?>" class="servicesarrow"/>
						
						<!-- services tabs -->
						<div id="stabs">
							<div style="padding:120px 0 30px 0;position:relative">
							  <ul>
								<? foreach($services as $service){?>
								<li><a href="#stabs-<?= $service->id;?>"><?= $service->title;?></a></li>
								<?}?>
							  </ul>
							  <div style="clear:both"></div>
						  </div>
						  <? foreach($services as $service){?>
						  <div id="stabs-<?= $service->id;?>">
							<p>
							<? if($service->id=='1'){ echo "<span style='margin-bottom:3px;color:#b30138; font-weight:bold;'>Estimation</span><br/>";}?>
							<?= $service->description1;?>
							<br/>
							<?
							if($service->id=='1'){ 
								echo "<span style='margin-bottom:3px;color:#b30138; font-weight:bold;'>Planning</span><br/>";
								echo $service->description2;
							}
							echo'<br/>';
							if($service->id=='1'){ 
								echo "<span style='margin-bottom:3px;color:#b30138; font-weight:bold;'>Qunatity Surveying</span><br/>";
								echo $service->description3;
							}
							?>
							</p>
							
						 </div>
						 <? }?>
						</div>
						<!-- end of services tabs -->	
					</div>
					<!-- End of Services Section -->
					
					<!-- Careers Section -->
					<div id="careers">
						<!-- left arrow of the navigation -->
						<img src="<?php echo site_url('css/images/arrow.gif')?>" class="careersarrow"/>
						<!-- end of left arrow of the navigation -->
						<div id="top">
							<div id="leftposition">
								<div>
									<h2>Available Positions</h2>
								</div>
								<? foreach ($careers as $career){?>
								<div class="job">
									<h4><u><?= $career->name;?></u></h4>
									<?= $career->description;?>
								</div>
								<? }?>
							</div>
							
							<div id="rightposition">
							<h2>WE ARE RECRUITING.<br/>FILL IN THE FORM AND BE PART OF OUR TEAM.</h2>
							<style>
								#careertable{}
							</style>
							 <form id="fileupload" action="<? echo site_url().'submit'; ?>" method="POST" enctype="multipart/form-data">
								<?php echo $this->session->flashdata('success'); ?>
								<?php echo validation_errors(); ?>
								<table border="0" cellspacing="10" cellpadding="0" id="careertable" valign="top">
									<tr>
										<td>
											<input type="text" name="name" placeholder="Full Name" value="<?= set_value('name', $contactform->name);?>"/>
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" name="position" placeholder="Position" value="<?= set_value('position', $contactform->position);?>"/>
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" name="email" placeholder="Email" value="<?= set_value('email', $contactform->email);?>"/>
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" name="telephone" placeholder="Telephone Number" value="<?= set_value('telephone', $contactform->telephone);?>"/>
										</td>
									</tr>
									<tr>
										<td>
											<input type="file" name="userfile" placeholder="Upload CV"/>
										</td>
									</tr>
									<tr>
										<td valign="top">
											<textarea name="comment" id="comment" cols="280" rows="100"><?= set_value('comment', 'Comment');?></textarea>
										</td>
									</tr>
									<tr>
									<td>
										<u><input type="submit" value="SUBMIT" style="background-color:#fff;border:none;color:#878786;cursor:pointer;text-decoration:underline;"/></u>
									</td>
									</tr>
								</table>
							</form>
							</div>
						</div>
					</div>
					<!-- End of Careers Section -->
					<!-- NEWS Section -->
					<div id="news" >
						<!-- left arrow of the navigation -->
						<img src="<?php echo site_url('css/images/arrow.gif')?>" class="newsarrow"/>
						<!-- end of left arrow of the navigation -->
						<div id="accordion">
						<? foreach ($newsS as $news){?>
						  <h3><img src="<?php echo site_url('css/images/newsarr.gif')?>"/><?= $news->created;?> : <?= $news->name;?></h3>
						  <div>
							<img width="120px" height="120px" src="<?php echo site_url('assets/events/thumbnails/'.$news->photo);?>"/>
							<p>
								<?= $news->description;?>
							</p>
							<div style="clear:both"></div>
						  </div>
						<? }?> 
						</div>
					</div>
					<!-- End of NEWS Section -->
					<!-- Construction Section -->
					<div id="construction">
						<!-- left arrow of the navigation -->
						<img src="<?php echo site_url('css/images/arrow.gif')?>" class="constructionarrow"/>
						<!-- end of left arrow of the navigation -->
						<div id="accordion">
						<? foreach ($events as $event){?>
						  <h3><img src="<?php echo site_url('css/images/newsarr.gif')?>"/><?= $event->created;?> : <?= $event->name;?></h3>
						  <div>
							<img width="120px" height="120px" src="<?php echo site_url('assets/events/thumbnails/'.$event->photo);?>"/>
							<p>
								<?= $event->description;?>
							</p>
							<div style="clear:both"></div>
						  </div>
						<? }?> 
						</div>
					</div>
					<!-- End of Construction Section -->
					
					<!-- Contact us  Section -->
					<div id="contactus">
						<!-- left arrow of the navigation -->
						<img src="<?php echo site_url('css/images/arrow.gif')?>" class="contactusarrow"/>
						<!-- end of left arrow navigation -->
						
						<!-- Contact us box -->
						<div id="top">
						</div>
						<div id="bottom">
							<div id="tabs">
								<div style="float:left;width:245px;padding-left:125px;position:relative">
									<img src="<?php echo site_url('css/images/triplearrow.gif')?>" class="triplearrowcontact"/>
									<img src="<?php echo site_url('css/images/triplearrow.gif')?>" class="triplearrowcontact2"/>
									<ul>
										<? foreach ($contacts as $contact){?>
										<li><a href="#tabs-<?= $contact->id;?>"><b><?= $contact->title; ?></b></a></li>
										<? }?>
									</ul>
								</div>
								<div style="float:left;width:280px;position:relative">
								<? foreach ($contacts as $contact){?>
									<div id="tabs-<?= $contact->id;?>">
										<?= $contact->address; ?><br/>
										<? if($contact->block!=''){echo $contact->block.", ";} if($contact->myfloor!=''){echo $contact->myfloor;} ?> <br/><br/>
										<? if($contact->telephone!=''){ ?>T.&nbsp;&nbsp;<?= $contact->telephone;?><br/><? }?>
										<? if($contact->fax!=''){?>F.&nbsp;&nbsp;<?= $contact->fax;?><br/><? }?>
										<? if($contact->mobile!=''){?>M.&nbsp;&nbsp;<?= $contact->mobile;?><br/><? }?>
										<? if($contact->mobile2!=''){?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $contact->mobile2;?><br/><?}?>
										<br/>
										<a href="mailto:<?= $contact->email;?>"><?= $contact->email;?></a>	
									</div>
								<?}?>
								</div>
							</div>
						</div>
						<!-- end of contact us box -->
						
						
					</div>
					<!-- End of Contact us Section -->
					
			</div>
			<!-- End Of the Right Panel-->
		</div>
		
		<!-- Footer -->
			<div id="footer">
				<div id="footcontent">
					<img src="<?echo site_url('css/images/triplearrow2.gif')?>" style="position:absolute;left:0;top:-17px"/>
					Copyright &copy; 2013 Manoukian E.P.Q.S Construction Management. All Right reserved. Development by <a href="http://www.comfu.com" target="_blank">ComFu</a>
				</div>
			</div>
			<!-- end of footer -->
		<!-- End Of the Website-->

		<script>
			$(document).ready(function() {
				
				if ($('.aboutusscrollingtext').height() > $('.aboutustext').height()) {
					$(".aboutarrowdown").hover(function () {
						animateContent("down");
					}, function() { $('.aboutusscrollingtext').stop(); });
				
					$(".aboutarrowup").hover(function () {
						animateContent("up");
					}, function() { $('.aboutusscrollingtext').stop(); });
				}

				function animateContent(direction) {  
					var animationOffset = $('.aboutustext').height() - $('.aboutusscrollingtext').height();
					if (direction == 'up') {
						animationOffset = 0;
					}
					
					$('.aboutusscrollingtext').animate({ "marginTop": animationOffset + "px" }, 1000);
				}
			});
		</script>
	</body>
</html>