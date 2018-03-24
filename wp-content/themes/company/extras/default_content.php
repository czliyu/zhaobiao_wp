<?php
add_action('init', 'company_init_callback');
function company_init_callback(){
	$defaults = company_get_option_defaults();
	if(get_theme_mod("huge_it_is_product_active")!=$defaults["huge_it_is_product_active"]){
		set_theme_mod( "huge_it_is_product_active", $defaults["huge_it_is_product_active"] );
		set_theme_mod("company_activation_settings","true");
	}
}

function company_get_theme_mods(){
	$mods = get_theme_mods();
	$defaults = company_get_option_defaults();
	/* get_theme_mods() returns wrong value if in customizer so we loop through theme mods and asign correct values 
	 * @see https://core.trac.wordpress.org/ticket/24844
	 */
	$theme_mods = array();
	foreach($defaults as $name=>$val){
		if ( isset( $mods[$name] ) )
			$theme_mods[$name] = apply_filters( "theme_mod_{$name}", $mods[$name] );
		else
			$theme_mods[$name] = apply_filters( "theme_mod_{$name}", $val );
	}

	if( is_array( $mods ) && !empty( $mods ) ){
		foreach($mods as $name => $mod){
			if( !isset( $theme_mods[ $name ] ) ){
				$theme_mods[$name] = apply_filters( "theme_mod_{$name}", $mod );
			}
		}
	}

	return wp_parse_args(
        $theme_mods,
        company_get_option_defaults() 
    );
}

function company_get_option_defaults() {
	$google_fonts = company_google_fonts();
	$defaults = array(
		'huge_it_is_product_active'						=> '0',
		'company_activation_settings' 				    => 'false',
		'company_body_bg_color' 						=> '#fff',
		'body_background_image' 						=> '',
		'body_background_repeat' 						=> 'repeat',
		'body_background_position' 						=> 'center',
		'company_header_bg_color' 						=> '#201e1e',
		'header_image'									=> '',
		'company_header_bg_repeat' 						=> 'repeat',
		'company_header_bg_position' 					=> 'center',
		'company_sidebar_bg_color' 						=> '#fff',
		'company_sidebar_bg_image' 						=> '',
		'company_sidebar_bg_repeat' 					=> 'repeat',
		'company_sidebar_bg_position' 					=> 'center',
		'company_footer_bg_color' 						=> '#323332',
		'company_footer_bg_image' 						=> '',
		'company_footer_bg_repeat' 						=> 'repeat',
		'company_footer_bg_position' 					=> 'center',
		'company_bg404_color' 							=> '',
		'company_bg404_image' 							=> get_template_directory_uri()."/images/bg404.jpg",
		'company_color_product_notice'					=> '',
		'header_textcolor'                              => "#fff",
		'company_body_text_color' 						=> "#7a7979",
		'company_body_links_color' 						=> '#0073aa',
		'company_body_links_hover_color' 				=> "#00a0d2",
		'company_header_nav_menu_color' 				=> "#fff",
		'company_header_nav_menu_hover_color' 			=> "#fff",
		'company_header_nav_menu_active_color' 			=> "#fff",
		'company_h1_heading_color' 						=> "#7a7979",
		'company_h2_heading_color' 						=> "#7a7979",
		'company_h3_heading_color' 						=> "#7a7979",
		'company_h4_heading_color' 						=> "#7a7979",
		'company_h5_heading_color' 						=> "#7a7979",
		'company_h6_heading_color' 						=> "#7a7979",
		'company_fonts_product_notice'					=> '',
		'company_header_title_font_size' 				=> "26px",
		'company_header_title_font_family' 				=> "Open Sans",
		'company_header_tagline_font_size' 				=> "20px",
		'company_header_tagline_font_family' 			=> "Open Sans",
		'company_text_font_size' 						=> "14px",
		'company_text_font_family'						=> "Open Sans",
		'company_link_font_size' 						=> "14px",
		'company_link_font_family' 						=> "Open Sans",
		'company_h1_heading_font_size' 					=> "40px",
		'company_h1_heading_font_family' 				=> "Roboto",
		'company_h2_heading_font_size' 					=> "36px",
		'company_h2_heading_font_family' 				=> "Roboto",
		'company_h3_heading_font_size' 					=> "32px",
		'company_h3_heading_font_family' 				=> "Roboto",
		'company_h4_heading_font_size' 					=> "28px",
		'company_h4_heading_font_family'				=> "Roboto",
		'company_h5_heading_font_size' 					=> "24px",
		'company_h5_heading_font_family' 				=> "Roboto",
		'company_h6_heading_font_size' 					=> "20px",
		'company_h6_heading_font_family'				=> "Roboto",
		'company_homepage_sidebar_layout' 				=> "right",
		'company_pages_sidebar_layout' 					=> "right",
		'company_category_sidebar_layout' 				=> "right",
		'company_single_post_sidebar_layout' 			=> "right",
		'company_content_full_width' 					=> '1',
		'company_content_max_width' 					=> "1024",
		'company_header_display' 						=> "logo",
		'company_sidebar_width' 						=> "26.3",
		'company_searchbox_display' 					=> "1",
		'company_navigation_type' 						=> "fixed",
		'company_scroll_to_top' 						=> '1',
		'company_facebook_icon' 						=> '',
		'company_facebook_url' 							=> esc_url("https://www.facebook.com"),
		'company_twitter_icon' 							=> '',
		'company_twitter_url' 							=> esc_url("https://twitter.com"),
		'company_google_plus_icon' 						=> '',
		'company_google_plus_url' 						=> esc_url("https://plus.google.com"),
		'company_linkedin_icon' 						=> '',
		'company_linkedin_url' 							=> esc_url("https://www.linkedin.com"),
		'company_instagram_icon' 						=> '',
		'company_instagram_url' 						=> esc_url("https://instagram.com"),
		'company_pinterest_icon' 						=> '',
		'company_pinterest_url' 						=> esc_url("https://www.pinterest.com"),
		'company_vimeo_icon' 							=> '',
		'company_vimeo_url' 							=> esc_url("https://www.vimeo.com"),
		'company_digg_icon' 							=> '',
		'company_digg_url' 								=> esc_url("https://www.digg.com"),
		'company_stumbleupon_icon' 						=> '',
		'company_stumbleupon_url' 						=> esc_url("https://www.stumbleupon.com"),
		'company_myspace_icon' 							=> '',
		'company_myspace_url' 							=> esc_url("https://www.myspace.com"),
		'company_footer_layout' 						=> '1',
		'company_footer_attribution' 					=> 'Copyright &#169; <a href="'.esc_url( home_url( '/' ) ).'">'. get_bloginfo( 'name' ) .'</a> '.date('Y').' Designed by <a href="http://huge-it.com">Huge-IT</a>  | Powered by <a href="http://wordpress.org/">WordPress</a>',
		'company_google_fonts_list' 					=> $google_fonts,
		'company_footer_notice'							=> '',
		'enable_lightbox' 								=> '1',

	);
	return apply_filters( 'company_option_defaults', $defaults );
}

function company_google_fonts(){
	$google_fonts = array(
		  array(
		      "kind" => "webfonts#webfont",
		      "family" => "Abel",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Alfa Slab One",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Amethysta",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Architects Daughter",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Audiowide",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Bonbon",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Carter One",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),
		  array(
		      "kind" => "webfonts#webfont",
		      "family" => "Lato",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "League Script",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Miniver",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "News Cycle",
		      "variants" => array
		      (
		        0 => 'regular',1 => '700',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Nova Oval",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Open Sans Condensed",
		      "variants" => array
		      (
		        0 => '300',1 => '300italic',2 => '700',
		      ),
		      "subsets" => array
		      (
		          0 => 'vietnamese',1 => 'cyrillic',2 => 'greek',3 => 'latin-ext',4 => 'latin',5 => 'cyrillic-ext',6 => 'greek-ext',
		      ),
		  ),
		  array(
		      "kind" => "webfonts#webfont",
		      "family" => "Open Sans",
		      "variants" => array
		      (
		        0 => '300',1 => '300italic',2 => '700',
		      ),
		      "subsets" => array
		      (
		          0 => 'vietnamese',1 => 'cyrillic',2 => 'greek',3 => 'latin-ext',4 => 'latin',5 => 'cyrillic-ext',6 => 'greek-ext',
		      ),
		  )
		  ,array(
		      "kind" => "webfonts#webfont",
		      "family" => "PT Sans",
		      "variants" => array
		      (
		        0 => 'regular',1 => 'italic',2 => '700',3 => '700italic',
		      ),
		      "subsets" => array
		      (
		          0 => 'cyrillic',1 => 'latin-ext',2 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Peralta",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Poiret One",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'cyrillic',1 => 'latin-ext',2 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Purple Purse",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Rammetto One",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),
		  array(
		      "kind" => "webfonts#webfont",
		      "family" => "Roboto",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Rock Salt",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Ruthie",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Seymour One",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'cyrillic',1 => 'latin-ext',2 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Sintony",
		      "variants" => array
		      (
		        0 => 'regular',1 => '700',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Source Code Pro",
		      "variants" => array
		      (
		        0 => '200',1 => '300',2 => 'regular',3 => '500',4 => '600',5 => '700',6 => '900',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin-ext',1 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Sue Ellen Francisco",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),array(
		      "kind" => "webfonts#webfont",
		      "family" => "Yesteryear",
		      "variants" => array
		      (
		        0 => 'regular',
		      ),
		      "subsets" => array
		      (
		          0 => 'latin',
		      ),
		  ),
		);
		return $google_fonts;
}
?>
