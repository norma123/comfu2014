// JavaScript Document

jQuery(document).ready(function() {
	
	
	
	 
	
$('.lightbox').lightbox();
$('.sky-carousel').carousel({
					itemWidth: 72,
					itemHeight: 100,
					distance: -10,
					selectedItemDistance: 35,
					selectedItemZoomFactor: 1.2,
					unselectedItemZoomFactor: 1,
					unselectedItemAlpha: 0.6,
					motionStartDistance: 140,
					topMargin: 30,
					gradientStartPoint: 0.36,
					gradientOverlayColor: "#f5f5f5",
					gradientOverlaySize: 100,
					selectByClick: true
				});
	

$('nav ul ul').wrapInner('<span />');
	


function onAfter() {
	
	$currentslide = this.id;
		$("#homeSlider").removeClass();
		$("#homeSlider").addClass($currentslide);
		

}


$('#slides').cycle({
fx: 'fade',
speed: 'fast',
timeout: 4000,
after:   onAfter,
pause:  true,
fit:1,
slideResize: 0,

pauseOnPagerHover: true,
pagerAnchorBuilder:true,
pager:  '.product-icons ul',
	pagerAnchorBuilder: function(idx, slide) { 
        // return selector string for existing anchor 
        return '.product-icons ul li:eq(' + idx + ') a'; 
    } 

	});
	
$(window).resize(function() {
	$newwidth = $(window).width();
	$("#slides").css( "width", $newwidth  );
	$(".slide").css( "width", $newwidth  );

});
	

});