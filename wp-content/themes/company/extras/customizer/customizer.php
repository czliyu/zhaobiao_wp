<?php
add_action( 'customize_register', 'company_customize_register' );
function company_customize_register( $wp_customize ){
	require_once trailingslashit( get_template_directory() ) .'extras/customizer/register-customizer-custom-controls.php';
	require_once trailingslashit( get_template_directory() ) .'extras/customizer/customizer-custom-controls.php';
	company_register_custom_controls($wp_customize);

	$defaults = company_get_option_defaults();

/*---------------------------------------------

          //  Backgrounds Panel

-----------------------------------------------*/

	$wp_customize->add_panel( 'backgrounds', array(
	  'title' => __( 'Backgrounds','company' ),
	  'description' => __( 'Set Background colors and images','company' ),
	  'capability' => 'edit_theme_options',
	  'priority' => 40,
	));
/*---------------------------------------------

           // Sidebar Backgrounds

-----------------------------------------------*/


	$wp_customize->add_section( 'sidebar_backgrounds', array(
	  'title' => __( 'Sidebar background' ,'company'),
	  'panel' => 'backgrounds',
	  'priority' => 40,
	  'capability' => 'edit_theme_options',
	));

	$wp_customize->add_setting('company_sidebar_bg_color', array( 'default' => $defaults["company_sidebar_bg_color"],'sanitize_callback'=>'sanitize_hex_color' ) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'company_sidebar_bg_color',
			array(
				'label'      => __( 'Sidebar background Color', 'company' ),
				'section'    => 'sidebar_backgrounds',
				'settings'   => 'company_sidebar_bg_color',
			)
		)
	);

	$wp_customize->add_setting('company_sidebar_bg_image', array( 'default' => $defaults["company_sidebar_bg_image"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(
		new WP_Customize_Media_Control($wp_customize,'company_sidebar_bg_image',
			array(
				'label'      => __( 'Sidebar background Image', 'company' ),
				'section'    => 'sidebar_backgrounds',
				'settings'   => 'company_sidebar_bg_image',
				'type' => 'image',
				'mime_type' => 'image'
			)
		)
	);

	function company_sidebar_media_active_callback( $control ) {
		if ( $control->manager->get_setting('company_sidebar_bg_image')->value() != '' ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting( 'company_sidebar_bg_repeat' , array( 'default' => $defaults["company_sidebar_bg_repeat"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'company_sidebar_bg_repeat',
			array(
				'label'          => __( 'Sidebar Background Repeat', 'company' ),
				'section'        => 'sidebar_backgrounds',
				'settings'       => 'company_sidebar_bg_repeat',
				'type'           => 'radio',
				'active_callback'=> 'company_sidebar_media_active_callback',
				'choices'        => array(
					'no-repeat'  => __('No Repeat','company'),
					'repeat'     => __('Tile','company'),
					'repeat-x'   => __('Tile Horizontally','company'),
					'repeat-y'   => __('Tile Vertically','company')
				)
			)
		)
	);

	$wp_customize->add_setting( 'company_sidebar_bg_position', array( 'default' => $defaults["company_sidebar_bg_position"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'company_sidebar_bg_position',
			array(
				'label'          => __( 'Sidebar Background Position', 'company' ),
				'section'        => 'sidebar_backgrounds',
				'settings'       => 'company_sidebar_bg_position',
				'active_callback'=> 'company_sidebar_media_active_callback',
				'type'           => 'radio',
				'choices'        => array(
					'left'          => __('Left','company'),
					'center'        => __('Center','company'),
					'right'         => __('Right','company')
				)
			)
		)
	);

/*---------------------------------------------

           // Footer Backgrounds

-----------------------------------------------*/

	$wp_customize->add_section( 'footer_backgrounds', array(
	  'title' => __( 'Footer background','company' ),
	  'panel' => 'backgrounds',
	  'priority' => 50,
	  'capability' => 'edit_theme_options',
	));

	$wp_customize->add_setting('company_footer_bg_color', array( 'default' => $defaults["company_footer_bg_color"],'sanitize_callback'=>'sanitize_hex_color' ) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'company_footer_bg_color',
			array(
				'label'      => __( 'Footer background Color', 'company' ),
				'section'    => 'footer_backgrounds',
				'settings'   => 'company_footer_bg_color',
			)
		)
	);

	$wp_customize->add_setting('company_footer_bg_image', array( 'default' => $defaults["company_footer_bg_image"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(
		new WP_Customize_Media_Control($wp_customize,'company_footer_bg_image',
			array(
				'label'      => __( 'Footer background Image', 'company' ),
				'section'    => 'footer_backgrounds',
				'settings'   => 'company_footer_bg_image',
				'type' => 'image',
				'mime_type' => 'image'
			)
		)
	);

	function company_footer_media_active_callback( $control ) {
		if ( $control->manager->get_setting('company_footer_bg_image')->value() != '' ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting( 'company_footer_bg_repeat' , array( 'default' => $defaults["company_footer_bg_repeat"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'company_footer_bg_repeat',
			array(
				'label'          => __( 'Footer Background Repeat', 'company' ),
				'section'        => 'footer_backgrounds',
				'settings'       => 'company_footer_bg_repeat',
				'type'           => 'radio',
				'active_callback'=> 'company_footer_media_active_callback',
				'choices'        => array(
					'no-repeat'  => __('No Repeat','company'),
					'repeat'     => __('Tile','company'),
					'repeat-x'   => __('Tile Horizontally','company'),
					'repeat-y'   => __('Tile Vertically','company')
				)
			)
		)
	);

	$wp_customize->add_setting( 'company_footer_bg_position', array( 'default' => $defaults["company_footer_bg_position"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'company_footer_bg_position',
			array(
				'label'          => __( 'Footer Background Position', 'company' ),
				'section'        => 'footer_backgrounds',
				'settings'       => 'company_footer_bg_position',
				'active_callback'=> 'company_footer_media_active_callback',
				'type'           => 'radio',
				'choices'        => array(
					'left'          => __('Left','company'),
					'center'        => __('Center','company'),
					'right'         => __('Right','company')
				)
			)
		)
	);


/*---------------------------------------------

           // 404 Backgrounds

-----------------------------------------------*/

	$wp_customize->add_section( 'bg404_backgrounds', array(
	  'title' => __( '404 background','company' ),
	  'panel' => 'backgrounds',
	  'priority' => 60,
	  'capability' => 'edit_theme_options',
	));


	$wp_customize->add_setting('company_bg404_color', array( 'default' => $defaults["company_bg404_color"],'sanitize_callback'=>'sanitize_hex_color' ) );
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'company_bg404_color',
			array(
				'label'      => __( '404 page background Color', 'company' ),
				'section'    => 'bg404_backgrounds',
				'settings'   => 'company_bg404_color',
			)
		)
	);

	$wp_customize->add_setting('company_bg404_image', array( 'default' => $defaults["company_bg404_image"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(
		new WP_Customize_Media_Control($wp_customize,'company_bg404_image',
			array(
				'label'      => __( '404 page background image', 'company' ),
				'section'    => 'bg404_backgrounds',
				'settings'   => 'company_bg404_image',
				'type' => 'image',
				'mime_type' => 'image'
			)
		)
	);

/*---------------------------------------------

			//Colors

-----------------------------------------------*/

	$wp_customize->add_setting( 'company_body_text_color', array( 'default'     => $defaults["company_body_text_color"],'sanitize_callback'=>'sanitize_hex_color' ) );
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'text_color',array(
				'label'      => __( 'Text Color', 'company' ),
				'section'    => 'colors',
				'settings'   => 'company_body_text_color',
			)
		)
	);

/*---------------------------------------------

		   //Fonts Section

-----------------------------------------------*/

	$wp_customize->add_section( 'fonts', array(
		'title' => __( 'Fonts' ,'company'),
		'priority' => 40,
		'capability' => 'edit_theme_options',
	) );

	$font_sizes_array = array();
		
	for($i=8;$i<61;$i=$i+2){
			$font_sizes_array[$i."px"]=  $i."px";
	}

	/* Title Fonts */
	$wp_customize->add_setting( 'company_header_title_font_size',array( 'default'     => $defaults["company_header_title_font_size"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_header_title_font_size', array(
				'label'      => __( 'Header Title Font Size', 'company' ),
				'section'    => 'fonts',
				'settings'   => 'company_header_title_font_size',
				'type' => 'select',
				'choices' =>$font_sizes_array,
			)
		)
	);

	$wp_customize->add_setting( 'company_header_title_font_family',array( 'default'     => $defaults["company_header_title_font_family"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Google_Fonts_Control( $wp_customize, 'company_header_title_font_family', array(
				'label'      => __( 'Header Title Font Family', 'company' ),
				'section'    => 'fonts',
				'settings'   => 'company_header_title_font_family',
				'type' => 'google_fonts_select',
				'fonts'=>$defaults["company_google_fonts_list"],
			)
		)
	);

	/* Tagline Fonts */
	$wp_customize->add_setting( 'company_header_tagline_font_size',array( 'default'     => $defaults["company_header_tagline_font_size"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_header_tagline_font_size', array(
				'label'      => __( 'Header Tagline Font Size', 'company' ),
				'section'    => 'fonts',
				'settings'   => 'company_header_tagline_font_size',
				'type' => 'select',
				'choices' =>$font_sizes_array,
			)
		)
	);

	$wp_customize->add_setting( 'company_header_tagline_font_family',array( 'default'     => $defaults["company_header_tagline_font_family"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Google_Fonts_Control( $wp_customize, 'company_header_tagline_font_family', array(
				'label'      => __( 'Header Tagline Font Family', 'company' ),
				'section'    => 'fonts',
				'settings'   => 'company_header_tagline_font_family',
				'fonts'=>$defaults["company_google_fonts_list"],
				'type' => 'google_fonts_select',
			)
		)
	);

/*---------------------------------------------

           //Layouts

-----------------------------------------------*/

	$wp_customize->add_section( 'layouts', array(
	  'title' => __( 'Layout','company' ),
	  'priority' => 60,
	  'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'company_content_full_width',array( 'default'     => $defaults["company_content_full_width"],'sanitize_callback'=>'sanitize_text_field') );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_content_full_width', array(
				'label'      => __( 'Allow Full Width Sections', 'company' ),
				'section'    => 'layouts',
				'settings'   => 'company_content_full_width',
				'type' => 'checkbox'
			)
		)
	);

	$wp_customize->add_setting( 'company_content_max_width',array( 'default'     => $defaults["company_content_max_width"],'sanitize_callback'=>'absint') );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_content_max_width', array(
				'label'      => __( 'Content Max Width(px)', 'company' ),
				'section'    => 'layouts',
				'settings'   => 'company_content_max_width',
				'type' => 'number'
			)
		)
	);

	$wp_customize->add_setting( 'company_sidebar_width',array( 'default'     => $defaults["company_sidebar_width"],'sanitize_callback'=>'absint') );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_sidebar_width', array(
				'label'      => __( 'Sidebar Width(%)', 'company' ),
				'section'    => 'layouts',
				'settings'   => 'company_sidebar_width',
				'type' => 'number'
			)
		)
	);

	$wp_customize->add_setting( 'company_homepage_sidebar_layout',array( 'default'     => $defaults["company_homepage_sidebar_layout"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Layout_Select_Control( $wp_customize, 'company_homepage_sidebar_layout', array(
				'label'      => __( 'Homepage Layout', 'company' ),
				'section'    => 'layouts',
				'settings'   => 'company_homepage_sidebar_layout',
				'type' => 'layout_selection'
			)
		)
	);

	$wp_customize->add_setting( 'company_pages_sidebar_layout',array( 'default'     => $defaults["company_pages_sidebar_layout"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Layout_Select_Control( $wp_customize, 'company_pages_sidebar_layout', array(
				'label'      => __( 'Pages Layout', 'company' ),
				'section'    => 'layouts',
				'settings'   => 'company_pages_sidebar_layout',
				'type' => 'layout_selection'
			)
		)
	);

	$wp_customize->add_setting( 'company_category_sidebar_layout',array( 'default'     => $defaults["company_category_sidebar_layout"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Layout_Select_Control( $wp_customize, 'company_category_sidebar_layout', array(
				'label'      => __( 'Category Layout', 'company' ),
				'section'    => 'layouts',
				'settings'   => 'company_category_sidebar_layout',
				'type' => 'layout_selection'
			)
		)
	);

	$wp_customize->add_setting( 'company_single_post_sidebar_layout',array( 'default'     => $defaults["company_single_post_sidebar_layout"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Layout_Select_Control( $wp_customize, 'company_single_post_sidebar_layout', array(
				'label'      => __( 'Single Post Layout', 'company' ),
				'section'    => 'layouts',
				'settings'   => 'company_single_post_sidebar_layout',
				'type' => 'layout_selection'
			)
		)
	);

/*---------------------------------------------

					 // Navigation

-----------------------------------------------*/


	$wp_customize->add_section( 'navigation', array(
		'title' => __( 'Navigation','company' ),
		'priority' => 96,
		'capability' => 'edit_theme_options',
	) );
	
	$wp_customize->add_setting('company_navigation_type', array( 'default' => $defaults['company_navigation_type'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_navigation_type',
			array(
				'label'           => __( 'Navigation Type', 'company' ),
				'section'         => 'navigation',
				'settings'        => 'company_navigation_type',
				'type'            => 'select',
				'choices'         => array(
					'fixed' => 'Fixed',
					'floating' => 'Floating',
					'absolute' => 'Absolute'
				)
			)
		)
	);
	
	$wp_customize->add_setting('company_searchbox_display', array( 'default' => $defaults['company_searchbox_display'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_searchbox_display',
			array(
				'label'           => __( 'Display Searchbox in navigation menu', 'company' ),
				'section'         => 'navigation',
				'settings'        => 'company_searchbox_display',
				'type'            => 'checkbox',
			)
		)
	);
	
	$wp_customize->add_setting('company_scroll_to_top', array( 'default' => $defaults['company_scroll_to_top'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_scroll_to_top',
			array(
				'label'           => __( 'Display Scroll To Top', 'company' ),
				'section'         => 'navigation',
				'settings'        => 'company_scroll_to_top',
				'type'            => 'checkbox',
			)
		)
	);
	
/*---------------------------------------------

					 // Social

-----------------------------------------------*/


	$wp_customize->add_section( 'social', array(
		'title' => __( 'Social','company' ),
		'priority' => 100,
		'capability' => 'edit_theme_options',
	) );

	/* Facebook */
	$wp_customize->add_setting('company_facebook_icon', array( 'default' => $defaults['company_facebook_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_facebook_icon',
			array(
				'label'           => __( 'Display Facebook Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_facebook_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_facebook($control){
		if ( $control->manager->get_setting('company_facebook_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_facebook_url', array( 'default' => $defaults['company_facebook_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_facebook_url',
			array(
				'label'           => __( 'Your Facebook Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_facebook',
				'settings'        => 'company_facebook_url',
				'type'            => 'text',
			)
		)
	);	
	
	/* Twitter */
	
	$wp_customize->add_setting('company_twitter_icon', array( 'default' => $defaults['company_twitter_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_twitter_icon',
			array(
				'label'           => __( 'Display Twitter Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_twitter_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_twitter($control){
		if ( $control->manager->get_setting('company_twitter_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_twitter_url', array( 'default' => $defaults['company_twitter_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_twitter_url',
			array(
				'label'           => __( 'Your Twitter Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_twitter',
				'settings'        => 'company_twitter_url',
				'type'            => 'text',
			)
		)
	);
	
	/* Google+ */
	
	$wp_customize->add_setting('company_google_plus_icon', array( 'default' => $defaults['company_google_plus_icon']==true,'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_google_plus_icon',
			array(
				'label'           => __( 'Display Google+ Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_google_plus_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_google_plus($control){
		if ( $control->manager->get_setting('company_google_plus_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_google_plus_url', array( 'default' => $defaults['company_google_plus_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_google_plus_url',
			array(
				'label'           => __( 'Your Google+ Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_google_plus',
				'settings'        => 'company_google_plus_url',
				'type'            => 'text',
			)
		)
	);
	
	/* LinkedIn */
	
	$wp_customize->add_setting('company_linkedin_icon', array( 'default' => $defaults['company_linkedin_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_linkedin_icon',
			array(
				'label'           => __( 'Display LinkedIn Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_linkedin_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_linkedin($control){
		if ( $control->manager->get_setting('company_linkedin_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_linkedin_url', array( 'default' => $defaults['company_linkedin_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_linkedin_url',
			array(
				'label'           => __( 'Your LinkedIn Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_linkedin',
				'settings'        => 'company_linkedin_url',
				'type'            => 'text',
			)
		)
	);
	
	/* Instagram */
	
	$wp_customize->add_setting('company_instagram_icon', array( 'default' => $defaults['company_instagram_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_instagram_icon',
			array(
				'label'           => __( 'Display Instagram Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_instagram_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_instagram($control){
		if ( $control->manager->get_setting('company_instagram_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_instagram_url', array( 'default' => $defaults['company_instagram_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_instagram_url',
			array(
				'label'           => __( 'Your Instagram Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_instagram',
				'settings'        => 'company_instagram_url',
				'type'            => 'text',
			)
		)
	);
	
	/* Pinterest */
	
	$wp_customize->add_setting('company_pinterest_icon', array( 'default' => $defaults['company_pinterest_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_pinterest_icon',
			array(
				'label'           => __( 'Display Pinterest Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_pinterest_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_pinterest($control){
		if ( $control->manager->get_setting('company_pinterest_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_pinterest_url', array( 'default' => $defaults['company_pinterest_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_pinterest_url',
			array(
				'label'           => __( 'Your Pinterest Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_pinterest',
				'settings'        => 'company_pinterest_url',
				'type'            => 'text',
			)
		)
	);

	/* Vimeo */
	
	$wp_customize->add_setting('company_vimeo_icon', array( 'default' => $defaults['company_vimeo_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_vimeo_icon',
			array(
				'label'           => __( 'Display Vimeo Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_vimeo_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_vimeo($control){
		if ( $control->manager->get_setting('company_vimeo_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_vimeo_url', array( 'default' => $defaults['company_vimeo_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_vimeo_url',
			array(
				'label'           => __( 'Your Vimeo Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_vimeo',
				'settings'        => 'company_vimeo_url',
				'type'            => 'text',
			)
		)
	);
	
	/* Digg */
	
	$wp_customize->add_setting('company_digg_icon', array( 'default' => $defaults['company_digg_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_digg_icon',
			array(
				'label'           => __( 'Display Digg Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_digg_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_digg($control){
		if ( $control->manager->get_setting('company_digg_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_digg_url', array( 'default' => $defaults['company_digg_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_digg_url',
			array(
				'label'           => __( 'Your Digg Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_digg',
				'settings'        => 'company_digg_url',
				'type'            => 'text',
			)
		)
	);
	
	/* StumbleUpon */
	
	$wp_customize->add_setting('company_stumbleupon_icon', array( 'default' => $defaults['company_stumbleupon_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_stumbleupon_icon',
			array(
				'label'           => __( 'Display StumbleUpon Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_stumbleupon_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_stumbleupon($control){
		if ( $control->manager->get_setting('company_stumbleupon_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_stumbleupon_url', array( 'default' => $defaults['company_stumbleupon_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_stumbleupon_url',
			array(
				'label'           => __( 'Your StumbleUpon Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_stumbleupon',
				'settings'        => 'company_stumbleupon_url',
				'type'            => 'text',
			)
		)
	);
	
	
	/* Myspace */
	$wp_customize->add_setting('company_myspace_icon', array( 'default' => $defaults['company_myspace_icon'],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_myspace_icon',
			array(
				'label'           => __( 'Display Myspace Button', 'company' ),
				'section'         => 'social',
				'settings'        => 'company_myspace_icon',
				'type'            => 'checkbox',
			)
		)
	);
	
	function company_show_myspace($control){
		if ( $control->manager->get_setting('company_myspace_icon')->value() == true ) {
			return true;
		} else {
			return false;
		}
	}

	$wp_customize->add_setting('company_myspace_url', array( 'default' => $defaults['company_myspace_url'],'sanitize_callback'=>'esc_url_raw' ) );
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'company_myspace_url',
			array(
				'label'           => __( 'Your Myspace Page Url', 'company' ),
				'section'         => 'social',
				'active_callback' => 'company_show_myspace',
				'settings'        => 'company_myspace_url',
				'type'            => 'text',
			)
		)
	);
	
/*---------------------------------------------

					 // Footer

-----------------------------------------------*/
	$wp_customize->add_section( 'footer', array(
		'title' => __( 'Footer','company' ),
		'priority' => 97,
		'capability' => 'edit_theme_options',
	) );
	
	
	$wp_customize->add_setting( 'company_footer_layout',array( 'default'     => $defaults["company_footer_layout"],'sanitize_callback'=>'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Footer_Layout_Select_Control( $wp_customize, 'company_footer_layout', array(
				'label'      => __( 'Footer Layout', 'company' ),
				'section'    => 'footer',
				'settings'   => 'company_footer_layout',
				'type' => 'footer_layout_selection'
			)
		)
	);

/*---------------------------------------------

					 // Lightbox

-----------------------------------------------*/
    $wp_customize->add_section( 'lightbox', array(
        'title' => __( 'Lightbox','company' ),
        'priority' => 105,
        'capability' => 'edit_theme_options',
    ) );


    $wp_customize->add_setting( 'enable_lightbox',array( 'default'     => $defaults["enable_lightbox"],'sanitize_callback'=>'sanitize_text_field' ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_lightbox', array(
                'label'      => __( 'Enable lightbox', 'company' ),
                'description' => __( 'By enabling this option you may add a media in post/pages under &lt;a&gt; tag and showcase the media in lightbox', 'company' ),
                'section'    => 'lightbox',
                'settings'   => 'enable_lightbox',
                'type' => 'checkbox'
            )
        )
    );

/*---------------------------------------------

					 // Upgrade To PRO

-----------------------------------------------*/

	if(!company_is_product_active()){
		$wp_customize->add_section( 'upgrade_to_pro', array(
			'title' => __( 'UPGRADE TO PRO','company' ),
			'priority' => 200,
			'capability' => 'edit_theme_options',
		) );


		$wp_customize->add_setting( 'pro_upgrade',array( 'default'     => '', 'type' => 'option' , 'sanitize_callback' => 'esc_attr' ) );
		$wp_customize->add_control( new WP_Customize_Company_Upgrade_To_Pro( $wp_customize, 'pro_upgrade', array(
					'section'    => 'upgrade_to_pro',
					'settings'   => 'pro_upgrade',
					'priority' => 1
				)
			)
		);
	}
}

add_action( 'customize_controls_enqueue_scripts', 'company_customizer_live_preview' );
function company_customizer_live_preview(){
	wp_enqueue_script('company_customize_js',get_template_directory_uri()."/assets/js/customize.js", array('customize-controls','underscore' ),'',true);

	$js_vars = array(
		'is_active' => company_is_product_active() ? "yes" : "no",
		'upgrade_to_pro' => __( 'Upgrade to Company Pro', 'company' ),
		'purchase_link' => esc_url( 'http://huge-it.com/wordpress-theme-company/' )
	);

	wp_localize_script( 'company_customize_js', 'companyCustomizeL10n',$js_vars);
}