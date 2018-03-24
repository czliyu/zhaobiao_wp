/* Responsive layout adjuster by Huge-IT */
jQuery(window).ready(function(){
	var phone_layout=0;
	function phoneLayout(){
		if(jQuery(".homepage_slides").length && jQuery(".homepage_slides li").length){
			if(jQuery(".homepage_slides").outerHeight()>jQuery(window).height()){
				var winh=jQuery(window).height();
				jQuery("#homepage_slideshow").css({maxHeight:winh+"px"});
				jQuery(".homepage_slides").css({maxHeight:winh+"px"});
				jQuery(".homepage_slides li").css({maxHeight:winh+"px"});
			}
			if(jQuery(".homepage_slides li").eq(0).find("img").outerHeight()<jQuery(window).height()){
				var winh=jQuery(window).height();
				jQuery("#homepage_slideshow").removeAttr("style");
				jQuery(".homepage_slides").removeAttr("style");
			}
			jQuery(window).on("resize",function(){
				if(jQuery(".homepage_slides li").eq(0).find("img").outerHeight()<jQuery(window).height()){
					var winh=jQuery(window).height();
					jQuery("#homepage_slideshow").removeAttr("style");
					jQuery(".homepage_slides").removeAttr("style");
				}
			});
		}
		var html1="<div id='main-logo'>"+jQuery("#main-logo").html()+"</div>";
		var html2="<div class='main-logo'>"+jQuery("#main-logo").html()+"</div>";
		if(window.matchMedia('(max-width:768px)').matches && phone_layout==0){
			if(jQuery("#homepage_slideshow").length){
				if(jQuery("#main-logo").length){
					jQuery("#main-logo").remove();
					jQuery("#homepage_slideshow .homepage_slides li").each(function(){
						var sl=jQuery(this);
						var desc=sl.find(".description_block");

						jQuery(html2).insertBefore(desc.find(".heading"));
					});
				}
			}
			if(jQuery("#header").length && jQuery("#homepage_slideshow")){
				jQuery("#header").insertAfter(jQuery("#homepage_slideshow"));
				jQuery("#header").removeAttr("style");
			}
			if(jQuery(".homepage_slides").length){
				if(jQuery(".homepage_slides li").eq(0).find(".main-logo").offset().top<0){
					jQuery(".homepage_slides li").each(function(){
						jQuery(this).find(".main-logo a").css({maxWidth:"100%"});
						jQuery(this).find(".description_block .heading").css({display:"none"});
					});
				}
			}
			widget_slideshow();
			phone_layout=1;
		}else{
			if(phone_layout==1 && !window.matchMedia('(max-width: 768px)').matches){
				jQuery("#header").insertBefore(jQuery("#homepage_slideshow"));
				jQuery(".container .sidebar-container").each(function(){
					if(typeof jQuery(this).find(".widget_list > li.active").html()==="undefined"){
						jQuery(this).find(".widget_list > li.active").removeClass("active");
						jQuery(this).find(".sidebar_arrows").remove();
					}
				});
				if(jQuery(".homepage_slides").length){
					jQuery(".homepage_slides li").each(function(){
						jQuery(this).find(".description_block .heading").css({display:"block"});
					});
				}
				jQuery(".container .sidebar-container").each(function(){
					if(typeof jQuery(this).find(".widget_list > li.active").html()==="undefined"){
						jQuery(this).find(".widget_list > li.active").removeClass("active");
						jQuery(this).find(".sidebar_arrows").remove();
					}
				});
				phone_layout=0;
			}
		}

		jQuery("body").find("#header").on("click tap",function(){
			if(window.matchMedia('(max-width:768px)').matches){
				jQuery("body").find("#primary-navigation").toggleClass("active");
			}
		});

		//responsive logo layout
		jQuery(window).on("resize",function(){
			//tablet layout
			if(typeof jQuery("#main-logo").html() !== "undefined"){
				var html1="<div id='main-logo'>"+jQuery("#main-logo").html()+"</div>";
				var html2="<div class='main-logo'>"+jQuery("#main-logo").html()+"</div>";
			}else{
				var html1="<div id='main-logo'>"+jQuery(".main-logo").html()+"</div>";
				var html2="<div class='main-logo'>"+jQuery(".main-logo").html()+"</div>";
			}

			if(window.matchMedia('(max-width:768px)').matches && phone_layout==0){

				if(jQuery("#header").length && jQuery("#homepage_slideshow")){
					jQuery("#header").insertAfter(jQuery("#homepage_slideshow"));
					jQuery("#header").removeAttr("style");
				}
				if(jQuery("#homepage_slideshow").length){
					if(jQuery("#main-logo").length || jQuery(".main-logo").length){
						jQuery("#main-logo").remove();
						jQuery("#homepage_slideshow .homepage_slides > li").each(function(i){
							var sl=jQuery("#homepage_slideshow .homepage_slides li").eq(i);
							var desc=sl.find(".description_block");
							if(!desc.find(".main-logo").length){
								jQuery(html2).insertBefore(desc.find(".heading"));
							}

						});
					}
				}

				if(jQuery(".homepage_slides").length){
					if(jQuery(".homepage_slides li").eq(0).find(".main-logo").offset().top<0){
						jQuery(".homepage_slides li").each(function(){
							jQuery(this).find(".main-logo a").css({maxWidth:"100%"});
							jQuery(this).find(".description_block .heading").css({display:"none"});
						});
					}
				}

				widget_slideshow();
				phone_layout=1;
			}else{
				if(phone_layout==1 && !window.matchMedia('(max-width: 768px)').matches){
					if(jQuery("#homepage_slideshow").length){
						jQuery("#header").insertBefore(jQuery("#homepage_slideshow"));
						if(!jQuery("#main-logo").length){
							jQuery(html1).insertBefore(jQuery("#primary-navigation"));
						}
						jQuery("#homepage_slideshow .homepage_slides li").each(function(){
							var sl=jQuery(this);
							var desc=sl.find(".description_block");
							desc.find(".main-logo").remove();
						});
					}

					jQuery(".container .sidebar-container").each(function(){
						if(typeof jQuery(this).find(".widget_list > li.active").html()!=="undefined"){
							jQuery(this).find(".widget_list > li.active").removeClass("active");
							jQuery(this).find(".sidebar_arrows").remove();
						}
					});
					jQuery(".homepage_slides li").each(function(){
						jQuery(this).find(".description_block .heading").css({display:"block"});
					});
					phone_layout=0;
				}
			}
		});
	}

	phoneLayout();


	function widget_slideshow(){
		var arrow=[];
		if(window.matchMedia('(max-width:768px)').matches && phone_layout==0){
			jQuery(".container .sidebar-container").each(function(){
				if(typeof jQuery(this).find(".widget_list > li.active").html()==="undefined"){
					var i=jQuery(this).index();
					jQuery(this).find(".widget_list > li").eq(0).addClass("active");
					if(jQuery(this).find(".widget_list > li").length > 1){
						jQuery(this).append('<ul class="sidebar_arrows"><li class="left"></li><li class="right"></li></ul>');
						arrow["left"+i]=jQuery(this).find(".sidebar_arrows > li").eq(0);
						arrow["right"+i]=jQuery(this).find(".sidebar_arrows > li").eq(1);

						arrow["left"+i].on("click",function(){
							var list=jQuery(this).parent().parent().find(".widget_list");
							var items=jQuery(this).parent().parent().find(".widget_list > li");
							var active=jQuery(this).parent().parent().find(".widget_list > li.active");
							var index=active.index();
							var previous;
							if(index!=0){
								previous=index-1;
							}else{
								previous=items.length-1;
							}
							active.removeClass("active");
							items.eq(previous).addClass("active");
						});

						arrow["right"+i].on("click",function(){
							var list=jQuery(this).parent().parent().find(".widget_list");
							var items=jQuery(this).parent().parent().find(".widget_list > li");
							var active=jQuery(this).parent().parent().find(".widget_list > li.active");
							var index=active.index();
							var next;
							if(index!=items.length-1){
								next=index+1;
							}else{
								next=0;
							}
							active.removeClass("active");
							items.eq(next).addClass("active");
						});

					}

				}
			});
		}
	}

	var adjusted=0;
	var winw=jQuery(window).width();
	function adjustSliderTexts(){
		jQuery("#homepage_slideshow .homepage_slides li").each(function(){
			var windowpos = jQuery(window).scrollTop();
			var header=jQuery("#header");
			var hh=parseInt(header.outerHeight());
			var ht=parseInt(header.offset().top);
			var slide=jQuery(this);
			var tabs=jQuery("#homepage_slideshow .rslides_tabs");
			var desc=slide.find(".description_block");
			var title=desc.find(".heading");
			var tt=parseInt(desc.offset().top);
			var text=slide.find(".description");
			var link=desc.find("a");
				if(tt<hh && adjusted==0){
					desc.css({bottom:"40px"});
					title.css({marginBottom:"12px"});
					tabs.css({bottom:"10px"});
					link.css({marginTop:"15px"});
					adjusted=1;
					winw=jQuery(window).width();
				}
		});
	}

	//slider height adjusting
	function sliderHeights(){
		if(jQuery(".homepage_slides").length){
			if(jQuery(".homepage_slides").outerHeight()>jQuery(window).height()){
				var winh=jQuery(window).height();
				jQuery("#homepage_slideshow").css({height:winh+"px"});
				jQuery(".homepage_slides").css({height:winh+"px"});
				jQuery(".homepage_slides li").css({height:winh+"px"});
			}
			if(jQuery(".homepage_slides li").eq(0).find("img").outerHeight()<jQuery(window).height()){
				jQuery("#homepage_slideshow").css({height:"auto"});
				jQuery(".homepage_slides").css({height:"auto"});
				jQuery(".homepage_slides li").css({height:"auto"});
			}
			jQuery(window).on("resize",function(){
				if(jQuery(".homepage_slides").eq(0).find("img").outerHeight()<jQuery(window).height()){
					jQuery("#homepage_slideshow").css({height:"auto"});
					jQuery(".homepage_slides").css({height:"auto"});
					jQuery(".homepage_slides li").css({height:"auto"});
				}
			});
		}
	}

	sliderHeights();
	jQuery(window).on("resize",function(){
		sliderHeights();
	});

	//blog posts description adjust with image height
	if(jQuery(".home_service_posts_container ul li").length){
		if(!window.matchMedia('(max-width:768px)').matches){
			jQuery(".home_service_posts_container ul li").each(function(){
				if(jQuery(this).find(".description .text").height()+jQuery(this).find(".description .title").height()+120>jQuery(this).find(".description").height()){
					jQuery(this).find(".title").css({marginTop:"45px"});
					jQuery(this).find(".text").css({display:"none"});
					jQuery(this).find("a").css({position:"absolute",bottom:"30px"});
				}else{
					jQuery(this).find(".title").removeAttr("style");
					jQuery(this).find(".text").removeAttr("style");
					jQuery(this).find("a").removeAttr("style");
				}
			});
		}else{
			jQuery(".home_service_posts_container ul li").each(function(){
				if(jQuery(this).find(".description .text").height()+jQuery(this).find(".description .title").height()+120>jQuery(this).find(".description").height()){
					jQuery(this).find(".text").css({display:"none"});
				}else{
					jQuery(this).find(".text").removeAttr("style");
				}
			});
		}
		jQuery(window).on("resize",function(){
			if(!window.matchMedia('(max-width:768px)').matches){
				jQuery(".home_service_posts_container ul li").each(function(){
					if(jQuery(this).find(".description .text").height()+jQuery(this).find(".description .title").height()+120>jQuery(this).find(".description").height()){
						jQuery(this).find(".title").css({marginTop:"45px"});
						jQuery(this).find(".text").css({display:"none"});
						jQuery(this).find("a").css({position:"absolute",bottom:"30px"});
					}else{
						jQuery(this).find(".title").removeAttr("style");
						jQuery(this).find(".text").removeAttr("style");
						jQuery(this).find("a").removeAttr("style");
					}
				});
			}else{
				jQuery(".home_service_posts_container ul li").each(function(){
					if(jQuery(this).find(".description .text").height()+jQuery(this).find(".description .title").height()+120>jQuery(this).find(".description").height()){
						jQuery(this).find(".text").css({display:"none"});
					}else{
						jQuery(this).find(".text").removeAttr("style");
					}
				});
			}

		});
	}
});