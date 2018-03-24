jQuery(document).ready(function(){
	jQuery(".container, .full-width, #header").append('<div class="clear"></div>');
	if(jQuery("#primary-navigation .search-form").length){
		jQuery("#primary-navigation .search-form .search-field").focus(function(){
			if(!window.matchMedia('(max-width:768px)').matches){
				jQuery("#primary-navigation > div").css({
						"-moz-max-width":"-moz-calc(100% - 314px)",
						"max-width":"calc(100% - 314px)",
						"-webkit-max-wdith":"-webkit-calc(100% - 314px)"
						});
			}
			
		});
		jQuery("#primary-navigation .search-form .search-field").blur(function(){
			if(!window.matchMedia('(max-width:768px)').matches){
				jQuery("#primary-navigation > div").css({
					"-moz-max-width":"-moz-calc(100% - 111px)",
					"max-width":"calc(100% - 111px)",
					"-webkit-max-wdith":"-webkit-calc(100% - 111px)"
					});
			}
		});
	}
	
	if(jQuery("#back-to-top-button").length){
		var offset = 100,
			speed = 250,
			duration = 500;
		if (jQuery(window).scrollTop() < offset) {
			jQuery('#back-to-top-button').removeClass("active");
		}else{
			jQuery('#back-to-top-button').addClass("active");
		}
		jQuery(window).scroll(function(){
			if (jQuery(this).scrollTop() < offset) {
				jQuery('#back-to-top-button').removeClass("active");
			} else {
				jQuery('#back-to-top-button').addClass("active");
			}
		});
		jQuery('#back-to-top-button').on('click', function(){
			jQuery('html, body').animate({scrollTop:0}, speed);
			return false;
		});
	}
});

