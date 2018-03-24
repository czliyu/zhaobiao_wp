<?php
add_action('wp_head','company_head_styles');
function company_head_styles() {
	$theme_mods = company_get_theme_mods();
	/* front end styles go here */
	 ?>
		<style type="text/css" media="screen">
			<?php
			if(is_single() || is_page()){
				global $post;
				$id=$post->ID;
				if(isset($theme_mods["company_custom_layout".$id]) && !empty($theme_mods["company_custom_layout".$id])){
					$layout=$theme_mods["company_custom_layout".$id];
				}else{
					if(is_home() || is_front_page() || is_single() || is_page() || is_page_template() || is_category() || is_archive() || is_search()){
						if(is_home() || is_front_page()){
							$layout=$theme_mods["company_homepage_sidebar_layout"];
						}
						if(is_single()){
							$layout=$theme_mods["company_single_post_sidebar_layout"];
						}
						if(is_page() || is_page_template()){
							$layout=$theme_mods["company_pages_sidebar_layout"];
						}
						if(is_category() || is_archive() || is_search()){
							$layout=$theme_mods["company_category_sidebar_layout"];
						}
					}else{
						$layout=$theme_mods["company_homepage_sidebar_layout"];
					}
				}
			}else{
				if(is_home() || is_front_page() || is_single() || is_page() || is_page_template() || is_category() || is_archive() || is_search()){
					if(is_home() || is_front_page()){
						$layout=$theme_mods["company_homepage_sidebar_layout"];
					}
					if(is_single()){
						$layout=$theme_mods["company_single_post_sidebar_layout"];
					}
					if(is_page() || is_page_template()){
						$layout=$theme_mods["company_pages_sidebar_layout"];
					}
					if(is_category() || is_archive() || is_search()){
						$layout=$theme_mods["company_category_sidebar_layout"];
					}
				}else{
					$layout=$theme_mods["company_homepage_sidebar_layout"];
				}
			}

			switch($layout){
				case "no":
					?>
					.content-container { width:100%; float:left; }
					.posts { width:99.45%; }
					<?php
					break;
				case "left":
					?>
					.content-container { width:<?php echo 100-2.7-abs($theme_mods["company_sidebar_width"]); ?>%; float:left; }
					.posts { width:99.45%; }
					.sidebar-container { float:left; width:<?php echo abs($theme_mods["company_sidebar_width"]); ?>%; margin:6px 2.7% 0px 0px; }
					<?php
					break;
				case "right":
					?>
					.content-container { width:<?php echo 100-2.7-abs($theme_mods["company_sidebar_width"]); ?>%; float:left; }
					.posts { width:99.45%; }
					.sidebar-container { float:left; width:<?php echo abs($theme_mods["company_sidebar_width"]); ?>%; margin:6px 0px 0px 2.7%; }
					<?php
					break;
				case "both-left":
					?>
					.content-container { width:<?php echo 100-2*2.7-2*abs($theme_mods["company_sidebar_width"]); ?>%; float:right; }
					.posts { width:99.45%; }
					.sidebar-container { float:left; width:<?php echo abs($theme_mods["company_sidebar_width"]); ?>%; margin:6px 2.7% 0px 0px; }
					<?php
					break;
				case "both-right":
					?>
					.content-container { width:<?php echo 100-2*2.7-2*abs($theme_mods["company_sidebar_width"]); ?>%; float:left; }
					.posts { width:99.45%; }
					.sidebar-container { float:left; width:<?php echo abs($theme_mods["company_sidebar_width"]); ?>%; margin:6px 0px 0px 2.7%; }
					<?php
					break;
				case "both":
					?>
					.content-container { width:<?php echo 100-2*2.7-2*abs($theme_mods["company_sidebar_width"]); ?>%; float:left; }
					.posts { width:99.45%; }
					.sidebar-container { float:left; width:<?php echo abs($theme_mods["company_sidebar_width"]); ?>%; }
					#left_sidebar, #main_sidebar.left-sidebar { margin:6px 2.7% 0px 0px; }
					#right_sidebar, #main_sidebar.right-sidebar { margin:6px 0px 0px 2.7%; }
					<?php
					break;
			}
			if(is_category() || is_single() || is_page()){
				?>
				.sidebar-container{ margin-top:36px !important; }
				<?php
			}
			switch($theme_mods["company_navigation_type"]){
				case "fixed":
					?>
					#header {
						position:relative;
						float:left;
						background-color:<?php echo esc_html($theme_mods["company_header_bg_color"]); ?>;
						background-image:url(<?php echo get_header_image(); ?>);
						background-repeat:<?php echo esc_html($theme_mods["company_header_bg_repeat"]); ?>;
						background-position:top <?php echo esc_html($theme_mods["company_header_bg_position"]); ?>;
					}
					<?php
					break;
				case "floating":
					?>
					#header {
						position:relative;
						float:left;
						background-color:<?php echo esc_html($theme_mods["company_header_bg_color"]); ?>;
						background-image:url(<?php echo esc_url($theme_mods["header_image"]); ?>);
						background-repeat:<?php echo esc_html($theme_mods["company_header_bg_repeat"]); ?>;
						background-position:top <?php echo esc_html($theme_mods["company_header_bg_position"]); ?>;
					}
					#main-logo { margin-top:0; }
					<?php
					break;
				case "absolute":
					?>
					#header { position:absolute; top:0; }
					<?php
					break;
			}
			?>
			.container { width:<?php echo absint($theme_mods["company_content_max_width"]); ?>px; }
			.container .sidebar-container > ul > li {
				background-color:<?php echo esc_html($theme_mods["company_sidebar_bg_color"]); ?>;
				background-image:url(<?php echo esc_url($theme_mods["company_sidebar_bg_image"]); ?>);
				background-repeat:<?php echo esc_html($theme_mods["company_sidebar_bg_repeat"]); ?>;
				background-position:top <?php echo esc_html($theme_mods["company_sidebar_bg_position"]); ?>;
			}
			.footer-public {
				background-color:<?php echo esc_html($theme_mods["company_footer_bg_color"]); ?>;
				background-image:url(<?php echo esc_url($theme_mods["company_footer_bg_image"]); ?>);
				background-repeat:<?php echo esc_html($theme_mods["company_footer_bg_repeat"]); ?>;
				background-position:top <?php echo esc_html($theme_mods["company_footer_bg_position"]); ?>;
			}

			<?php
			$textcolor = esc_html(get_header_textcolor());
			 printf( "
			    .site-title,
				.site-title:link,
				.site-title:visited,
				.site-title:hover,
				.site-title:focus,
				.site-title:active,
				.site-tagline,
				.site-tagline:link,
				.site-tagline:visited,
				.site-tagline:hover,
				.site-tagline:focus,
				.site-tagline:active {
					color: %s;
				}
			 ", (!empty( $textcolor ) ? "#".$textcolor : "#fff" ) );
			 ?>

			.site-title,
			.site-title:link,
			.site-title:visited,
			.site-title:hover,
			.site-title:focus,
			.site-title:active {
				font-size:<?php echo esc_html($theme_mods["company_header_title_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_header_title_font_family"]); ?> !important;
			}
			.site-tagline,
			.site-tagline:link,
			.site-tagline:visited,
			.site-tagline:hover,
			.site-tagline:focus,
			.site-tagline:active {
				font-size:<?php echo esc_html($theme_mods["company_header_tagline_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_header_tagline_font_family"]); ?> !important;
			}
			<?php
				if($theme_mods["company_searchbox_display"]==true){
					?>
					#primary-navigation > div {
						width:-moz-calc(100% - 111px);
						width:-webkit-calc(100% - 111px);
						width:calc(100% - 111px);
					}
					<?php
				}
			?>
			#primary-navigation .nav-menu > li > a,
			#primary-navigation .nav-menu > li > a:link,
			#primary-navigation .nav-menu > li > a:visited {
				color:<?php echo esc_html($theme_mods["company_header_nav_menu_color"]); ?>;
			}

			#primary-navigation .nav-menu > li > a:hover,
			#primary-navigation .nav-menu > li > a:focus,
			#primary-navigation .nav-menu > li > a:active {
				border:1px solid <?php echo esc_html($theme_mods["company_header_nav_menu_hover_color"]); ?>;
			}
			#primary-navigation .nav-menu > li.current-menu-item > a,
			#primary-navigation .nav-menu > li.current-menu-item > a:link,
			#primary-navigation .nav-menu > li.current-menu-item > a:visited {
				border:1px solid <?php echo esc_html($theme_mods["company_header_nav_menu_active_color"]); ?>;
			}
			#primary-navigation .nav-menu > li.current-menu-item > a:hover,
			#primary-navigation .nav-menu > li.current-menu-item > a:focus,
			#primary-navigation .nav-menu > li.current-menu-item > a:active {
				border:1px solid <?php echo esc_html($theme_mods["company_header_nav_menu_active_color"]); ?>;
			}
			.sub-menu li a,.sub-menu li a:link,.sub-menu li a:visited { color:<?php echo esc_html($theme_mods["company_header_nav_menu_color"]); ?>; }
			.sub-menu li a:hover, .sub-menu li a:focus, .sub-menu li a:active { color:<?php echo esc_html($theme_mods["company_header_nav_menu_hover_color"]); ?>; }
			#primary-navigation .search-form .search-field { border:1px solid <?php echo esc_html($theme_mods["company_header_nav_menu_color"]); ?>; color:<?php echo esc_html($theme_mods["company_header_nav_menu_color"]); ?>; }
			.post_content, .page_content { color:<?php echo esc_html($theme_mods["company_body_text_color"]); ?>; font-size:<?php echo esc_html($theme_mods["company_text_font_size"]); ?>; font-family:<?php echo esc_html($theme_mods["company_text_font_family"]); ?>; }

			.post_content a,.post_content a:link,.post_content a:visited,
			.page_content a,.page_content a:link,.page_content a:visited {
				color:<?php echo esc_html($theme_mods["company_body_links_color"]); ?>;
				font-size:<?php echo esc_html($theme_mods["company_link_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_link_font_family"]) ; ?>;
			}
			.post_content a:hover,.post_content a:focus,.post_content a:active,
			.page_content a:hover,.page_content a:focus,.page_content a:active	{
				color:<?php echo esc_html($theme_mods["company_body_links_hover_color"]); ?>;
			}
			.post_content h1,
			.page_content h1 {
				color:<?php echo esc_html($theme_mods["company_h1_heading_color"]); ?>;
				font-size:<?php echo esc_html($theme_mods["company_h1_heading_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_h1_heading_font_family"]); ?>;
			}
			.post_content h2,
			.page_content h2 {
				color:<?php echo esc_html($theme_mods["company_h2_heading_color"]); ?>;
				font-size:<?php echo esc_html($theme_mods["company_h2_heading_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_h2_heading_font_family"]); ?>;
			}
			.post_content h3,
			.page_content h3 {
				color:<?php echo esc_html($theme_mods["company_h3_heading_color"]); ?>;
				font-size:<?php echo esc_html($theme_mods["company_h3_heading_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_h3_heading_font_family"]); ?>;
			}
			.post_content h4,
			.page_content h4 {
				color:<?php echo esc_html($theme_mods["company_h4_heading_color"]); ?>;
				font-size:<?php echo esc_html($theme_mods["company_h4_heading_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_h4_heading_font_family"]); ?>;
			}
			.post_content h5,
			.page_content h5 {
				color:<?php echo esc_html($theme_mods["company_h5_heading_color"]); ?>;
				font-size:<?php echo esc_html($theme_mods["company_h5_heading_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_h5_heading_font_family"]); ?>;
			}
			.post_content h6,
			.page_content h6 {
				color:<?php echo esc_html($theme_mods["company_h6_heading_color"]); ?>;
				font-size:<?php echo esc_html($theme_mods["company_h6_heading_font_size"]); ?>;
				font-family:<?php echo esc_html($theme_mods["company_h6_heading_font_family"]); ?>;
			}
			.page-404 {
				background-image: url( <?php echo esc_url($theme_mods["company_bg404_image"]); ?> ) !important;
				background-color:<?php echo esc_html($theme_mods["company_bg404_color"]); ?> !important;
			}
			<?php
			if($theme_mods["company_content_full_width"]==true){
				?>
				.full-width, #home_page_top_posts { width:100%; }
				<?php
			}else{
				?>
				.full-width,
				#header,
				#home_page_top_posts {
					display:block;
					width:<?php echo abs($theme_mods["company_content_max_width"]); ?>px;
					margin:0 auto;
				}
				#header {
					left:50%;
					margin-left:-<?php echo abs($theme_mods["company_content_max_width"])/2; ?>px;
				}
				<?php
			}

			if($theme_mods["company_content_full_width"]==true){
				?>
				.site-header {
					width:100%;
				}
				<?php
			}
			$count=0;
			if (have_posts()) :
			while (have_posts()) : the_post();
				$count++;
			endwhile;
			endif;
			if($count > get_option("posts_per_page")){
				$count = get_option("posts_per_page");
			}
			$lates_posts_width = $count*183-5;
			?>
			.posts ul { width:<?php echo $lates_posts_width; ?>px; }
			<?php

			switch($theme_mods["company_footer_layout"]){
					case "1":
						?>
						.footer-sidebar-container {width: -moz-calc(25% - 40px); width: -webkit-calc(25% - 40px); width: calc(25% - 40px); }
						<?php
						break;
					case "2":
						?>
						#footer_sidebar_1 {width: -moz-calc(50% - 20px); width: -webkit-calc(50% - 20px); width: calc(50% - 20px); }
						#footer_sidebar_2, #footer_sidebar_3 { width: -moz-calc(25% - 20px); width: -webkit-calc(25% - 20px); width: calc(25% - 20px); }
						<?php
						break;
					case "3":
						?>
						#footer_sidebar_3 { width: -moz-calc(50% - 20px); width: -webkit-calc(50% - 20px); width: calc(50% - 20px); }
						#footer_sidebar_1, #footer_sidebar_2 { width: -moz-calc(25% - 20px); width: -webkit-calc(25% - 20px); width: calc(25% - 20px); }
						<?php
						break;
					case "4":
						?>
						#footer_sidebar_1, #footer_sidebar_2, #footer_sidebar_3 { width: -moz-calc(33.3% - 20px); width: -webkit-calc(33.3% - 20px); width: calc(33.3% - 20px); }
						<?php
						break;
					case "5":
						?>
						#footer_sidebar_1 { width: -moz-calc(75% - 20px); width: -webkit-calc(75% - 20px); width: calc(75% - 20px); }
						#footer_sidebar_2 { width: -moz-calc(25% - 20px); width: -webkit-calc(25% - 20px); width: calc(25% - 20px); }
						<?php
						break;
					case "6":
						?>
						#footer_sidebar_1 { width: -moz-calc(25% - 20px); width: -webkit-calc(25% - 20px); width: calc(25% - 20px); }
						#footer_sidebar_2 { width: -moz-calc(75% - 20px); width: -webkit-calc(75% - 20px); width: calc(75% - 20px); }
						<?php
						break;
				}
			?>
			@media only screen and (max-width: <?php echo abs($theme_mods["company_content_max_width"]); ?>px){
				.full-width, #home_page_top_posts, .container, .content-container { width:100%; float:none; }
				.content-container { margin-bottom:47px; }
				#header { width:100%; float:left; left:0px; margin-left:0; }
				#main-logo { margin:15px 0 0 1.82%; max-width:28.18%; }
				#main-logo span { height:40px; font-size:30px; line-height:40px; }
				#main-logo span { font-size:40px !important; }
				.main-logo span { height:40px !important; font-size:30px !important; line-height:40px !important; }
				.main-logo i { font-size:40px; }
				#primary-navigation { margin-top:19px; font-size:12px; }
				#primary-navigation .nav-menu > li { margin-right:10px; }
				#primary-navigation .nav-menu > .menu-item-has-children > a:after { top:10px; }
				#primary-navigation .nav-menu > li.current-menu-item a, #primary-navigation .nav-menu > li.current-menu-item a:link, #primary-navigation .nav-menu > li.current-menu-item a:visited { padding:2px 9px 3px 8px; }
				#primary-navigation .nav-menu >  li > a, #primary-navigation .nav-menu > li > a:link, #primary-navigation .nav-menu > li > a:visited { padding:3px 10px 4px 9px; }
				#primary-navigation .nav-menu > li:hover > a, #primary-navigation .nav-menu > li:visited > a, #primary-navigation .nav-menu > li:active > a { padding:2px 9px 3px 8px !important; }
				#primary-navigation .nav-menu > li > a:hover, #primary-navigation .nav-menu > li > a:focus, #primary-navigation .nav-menu > li > a:active { padding:2px 9px 3px 8px !important; }
				#primary-navigation .search-form { margin:0 15px 0 10px; }
				.posts { margin-top:89px; width:98.95%; }
				.posts ul { height:403px; }
				.posts ul li { width:168px; height:353px; padding:8px 9px 50px 10px; }
				.posts ul li .description { bottom:50px; max-height:93px; }
				.sidebar-container { width:100%; margin:10px 0 0 0; text-align:center; }
				.container .sidebar-container > ul {  }
				.container .sidebar-container > ul > li {
					display:inline-block;
					width:29.3%;
					margin-right:1%;
					vertical-align: top;
					list-style-type:none;
					overflow:hidden;
				}
				.container .sidebar-container > ul > li:nth-child(3n), .container .sidebar-container > ul > li:last-child { margin-right:0; }
				.footer-sidebar-container { width:-moz-calc(50% - 40px); width:-webkit-calc(50% - 40px); width:calc(50% - 40px); }
				.wrap404 h1 { font-size:70px; }
				.wrap404 p { font-size:20px; }
			}
			@media only screen and (max-width:768px){
				body #main-logo { background:<?php echo esc_html($theme_mods["company_header_bg_color"]); ?>; }
			}
		</style>
		<script>
		jQuery(document).ready(function(){
			if(jQuery(".container .left-sidebar").length){
				if(window.matchMedia('(max-width: <?php echo absint($theme_mods["company_content_max_width"]); ?>px)').matches){
					jQuery(".container .left-sidebar").each(function(){
						jQuery(this).insertAfter(jQuery(".container .content-container"));
					});
				}else{
					jQuery(".container .left-sidebar").each(function(){
						jQuery(this).insertBefore(jQuery(".container .content-container"));
					});
				}
			}

			jQuery(window).on("resize",function(){
				if(jQuery(".container .left-sidebar").length){
					if(window.matchMedia('(max-width: <?php echo absint($theme_mods["company_content_max_width"]); ?>px)').matches){
						jQuery(".container .left-sidebar").each(function(){
							jQuery(this).insertAfter(jQuery(".container .content-container"));
						});
					}else{
						jQuery(".container .left-sidebar").each(function(){
							jQuery(this).insertBefore(jQuery(".container .content-container"));
						});
					}
				}
			});


			var el = jQuery('#header');
			var elpos_original = <?php if (is_admin_bar_showing()){ echo "32"; }else{ echo "0"; } ?>;
			var elpos = el.offset().top;
			var windowpos = jQuery(window).scrollTop();
			var finaldestination = windowpos;

			function navigation_scroll(){
				<?php
				switch($theme_mods["company_navigation_type"]){
					case "fixed":
					?>
					if(!window.matchMedia('(max-width: 768px)').matches){

						if(windowpos<elpos_original+50) {
							finaldestination = elpos_original;
							el.removeAttr("style");
						} else {
							el.find("#main-logo").css({marginTop:"0px"});
							el.css({position:"fixed",top:elpos_original+"px"});
						}
					}else{
						el.removeAttr("style");
						el.find("#main-logo").removeAttr("style")
					}
					jQuery(window).scroll(function(){
						if(!window.matchMedia('(max-width: 768px)').matches){
							elpos = el.offset().top;
							windowpos = jQuery(window).scrollTop();
							finaldestination = windowpos;
							if(windowpos<elpos_original+50) {
								finaldestination = elpos_original;
								el.removeAttr("style");
								el.find("#main-logo").css({marginTop:"22px"});
							} else {
								el.find("#main-logo").css({marginTop:"0px"});
								el.css({position:"fixed",top:elpos_original+"px"});
							}
						}else{
							el.removeAttr("style");
							el.find("#main-logo").removeAttr("style")
						}
					});
					<?php
						break;
					case "floating":
						//nothing to do in js(only css)
						break;
					case "absolute":
						//nothing to do in js(only css)
						break;
				}
				?>

			}
			navigation_scroll();
			jQuery(window).on("resize",function(){
				navigation_scroll();
			});
		});
		</script>
	 <?php
}
