/* Post Slider By Huge-IT */
jQuery(document).ready(function(){
	var slides=jQuery(".posts ul");
	if(slides.length && slides.find("li").length >= 4){
		var left=jQuery(".posts .arrow-left"),
			right=jQuery(".posts .arrow-right"),
			width=parseInt(jQuery(".posts").width()),
			iwidth=jQuery(".posts ul li").eq(0).outerWidth(),
			m=jQuery(".posts ul li").eq(1).position().left-iwidth-jQuery(".posts ul li").eq(0).position().left,
			maxwidth=jQuery(".posts ul").outerWidth(),
			margin=0,		
			curwidth;
		//call function
		post_slide();
	}
	function post_slide(){
		var w=parseInt(jQuery(".posts ul li").length)*(iwidth+m)-m;
		jQuery(".posts ul").css({width:w+"px",marginLeft:"0px"});
		maxwidth=jQuery(".posts ul").outerWidth();
		//go right
		right.on("dblclick",slideRightAll);
		right.on("click",slideRight);
		//go left
		left.on("dblclick",slideLeftAll);
		left.on("click",slideLeft);
	}
	function slideLeft(){
		width = parseInt(jQuery(".posts").width());
		maxwidth = jQuery(".posts ul").outerWidth();
		if(width > 4*iwidth + 3*m){
			if( margin >= iwidth*2 + m*2 ){
				margin = margin-iwidth*2 - m*2;
				slides.animate({marginLeft:"-"+margin+"px"},300);
			}else{
				margin=0;
				slides.animate({marginLeft:"0px"},300);
			}
		}else{
			if(margin >= iwidth+m){
				margin = margin-iwidth-m;
				slides.animate({marginLeft:"-"+margin+"px"},300);
			}else{
				margin=0;
				slides.animate({marginLeft:"0px"},300);
			}
		}
	}
	function slideRight(){
		width=parseInt(jQuery(".posts").width());
		maxwidth=jQuery(".posts ul").outerWidth();
		curwidth=margin+width;
		if( width > 4*iwidth+3*m ){
			if( maxwidth-curwidth >= iwidth*2 + m*2){
				margin=m*2 + margin + iwidth*2;
				slides.animate({marginLeft:"-"+margin+"px"},300);
			}else{
				margin=margin+maxwidth-curwidth;
				slides.animate({marginLeft:"-"+margin+"px"},300);
			}
		}else{
			if(maxwidth-curwidth>=iwidth+m){
				margin=m+margin+iwidth;
				slides.animate({marginLeft:"-"+margin+"px"},300);
			}else{
				margin=margin+maxwidth-curwidth;
				slides.animate({marginLeft:"-"+margin+"px"},300);
			}
		}
	}
	function slideRightAll(){
		width=parseInt(jQuery(".posts").width());
		margin=maxwidth-width;
		slides.animate({marginLeft:"-"+margin+"px"},200);
	}
	function slideLeftAll(){
		width=parseInt(jQuery(".posts").width());
		margin=0;
		slides.animate({marginLeft:"-"+margin+"px"},200);
	}
});
