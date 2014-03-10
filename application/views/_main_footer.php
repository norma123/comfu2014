<!--footer-->
<?php
	$uri =  $this->uri->segment(1);
	switch($uri)
	{
		case 'wines':
			$color='-white';
			break;
		case 'almaza':
			$color='-white';
			break;
		default:
			$color='';
	}
?>
<div class="footer relative">
<div class="sitewidth relative">
	Enjoy Responsibly. &copy;<?echo date('Y')?> Essence Of Lebanon &copy; Products. Design by <a href="http://www.comfu.com" target="_blank">COM FU</a> &nbsp;&nbsp;<a href="<?php echo site_url('terms')?>">Terms & Conditions</a> &nbsp;&nbsp;<a href="<?php echo site_url('privacy')?>">Privacy Policy</a>&nbsp;&nbsp; <a href="<?php echo site_url('contactus')?>">Contact Us</a> 
	
	<ul class="socialfooter">
		<li><a href="#"><img src="<?php echo site_url('css/images/facebookfooter'.$color.'.png')?>" width="22" height="22" /></a></li>
		<li><a href="#"><img src="<?php echo site_url('css/images/twitterfooter'.$color.'.png')?>" width="22" height="22" /></a></li>
		<li><a href="#"><img src="<?php echo site_url('css/images/youtubefooter'.$color.'.png')?>" width="22" height="22" /></a></li>
	</ul>
	</div>
</div>
<!--footer-->