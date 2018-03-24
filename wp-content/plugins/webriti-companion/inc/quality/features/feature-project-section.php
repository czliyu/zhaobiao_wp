<?php
function webriti_companion_quality_project_customizer( $wp_customize ) {

//Home project Section
	$wp_customize->add_panel( 'quality_project_setting', array(
		'priority'       => 700,
		'capability'     => 'edit_theme_options',
		'title'      => __('Project settings', 'webriti-companion'),
	) );
	
	$wp_customize->add_section(
        'project_section_settings',
        array(
            'title' => __('Project settings','webriti-companion'),
			'panel'  => 'quality_project_setting',)
    );
	
	
	//Show and hide Project section
	$wp_customize->add_setting(
	'quality_pro_options[home_projects_enabled]'
    ,
    array(
        'default' => true,
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'quality_pro_options[home_projects_enabled]',
    array(
        'label' => __('Enable Home Project section','webriti-companion'),
        'section' => 'project_section_settings',
        'type' => 'checkbox',
    )
	);
	
	// //Project Title
	$wp_customize->add_setting(
    'quality_pro_options[project_heading_one]',
    array(
        'default' => __('Featured portfolio project','webriti-companion'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control('quality_pro_options[project_heading_one]',array(
    'label'   => __('Title','webriti-companion'),
    'section' => 'project_section_settings',
	 'type' => 'text',)  );	
	 
	//Project Description 
	 $wp_customize->add_setting(
    'quality_pro_options[project_tagline]',
    array(
        'default' => 'aecenas sit amet tincidunt elit. Pellentesque habitant morbi tristique senectus et netus et Nulla facilisi.',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'quality_pro_options[project_tagline]',array(
    'label'   => __('Description','webriti-companion'),
    'section' => 'project_section_settings',
	 'type' => 'text',)  );
	 
	 //Project Two
	$wp_customize->add_section(
        'project_one_section_settings',
        array(
            'title' => __('Project one','quality'),
			'panel'  => 'quality_project_setting',)
    );
	 
	 //Project one Title
	$wp_customize->add_setting(
	'quality_pro_options[project_one_title]', array(
        'default'        => 'Lorem Ipsum',
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('quality_pro_options[project_one_title]', array(
        'label'   => __('Title', 'quality'),
        'section' => 'project_one_section_settings',
		'priority'   => 150,
		'type' => 'text',
    ));
	
	//Project one image
	$wp_customize->add_setting( 'quality_pro_options[project_one_thumb]',array('default' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port1.jpg',
	'type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'quality_pro_options[project_one_thumb]',
			array(
				'label' => __('Image','quality'),
				'section' => 'example_section_one',
				'settings' =>'quality_pro_options[project_one_thumb]',
				'section' => 'project_one_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	//Project Two
	$wp_customize->add_section(
        'project_two_section_settings',
        array(
            'title' => __('Project two','quality'),
			'panel'  => 'quality_project_setting',)
    );
	
	//Project Two Title
	$wp_customize->add_setting(
	'quality_pro_options[project_two_title]', array(
        'default'        => 'Postao je popularan',
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('quality_pro_options[project_two_title]', array(
        'label'   => __('Title', 'quality'),
        'section' => 'project_two_section_settings',
		'priority'   => 150,
		'type' => 'text',
    ));
	
	//Project two image
	$wp_customize->add_setting( 'quality_pro_options[project_two_thumb]',array('default' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port2.jpg','type' => 'option','sanitize_callback' => 'esc_url_raw',));	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'quality_pro_options[project_two_thumb]',
			array(
				'label' => __('Image','quality'),
				'section' => 'example_section_one',
				'settings' =>'quality_pro_options[project_two_thumb]',
				'section' => 'project_two_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	//Project Three section
	$wp_customize->add_section(
        'project_three_section_settings',
        array(
            'title' => __('Project three','quality'),
			'panel'  => 'quality_project_setting',)
    );
	
	//Project Three Title
	$wp_customize->add_setting(
	'quality_pro_options[project_three_title]', array(
        'default'        => 'kojekakve promjene s',
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('quality_pro_options[project_three_title]', array(
        'label'   => __('Title','quality'),
        'section' => 'project_three_section_settings',
		'priority'   => 150,
		'type' => 'text',
    ));
	
	//Project three image
	$wp_customize->add_setting( 'quality_pro_options[project_three_thumb]',array('default' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port3.jpg','type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'quality_pro_options[project_three_thumb]',
			array(
				'label' => __('Image','quality'),
				'section' => 'example_section_one',
				'settings' =>'quality_pro_options[project_three_thumb]',
				'section' => 'project_three_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	
	//Project Four section
	$wp_customize->add_section(
        'project_four_section_settings',
        array(
            'title' => __('Project four','quality'),
			'panel'  => 'quality_project_setting',)
    );
	
	//Project Four Title
	$wp_customize->add_setting(
	'quality_pro_options[project_four_title]', array(
        'default'        => 'kojekakve promjene s',
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('quality_pro_options[project_four_title]', array(
        'label'   => __('Title', 'quality'),
        'section' => 'project_four_section_settings',
		'priority'   => 150,
		'type' => 'text',
    ));
	
	//Project Four image
	$wp_customize->add_setting( 'quality_pro_options[project_four_thumb]',array('default' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port4.jpg','type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'quality_pro_options[project_four_thumb]',
			array(
				'label' => __('Image','quality'),
				'section' => 'example_section_one',
				'settings' =>'quality_pro_options[project_four_thumb]',
				'section' => 'project_four_section_settings',
				'type' => 'upload',
			)
		)
	);
	 
	 
	 // Project button text
	$wp_customize->add_setting(
	'quality_pro_options[project_button_text]', array(
	'default'	=> __('View All Projects','quality'),
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type'	=> 'option',
	));
	
	$wp_customize->add_control('quality_pro_options[project_button_text]', array(
	'label' => __('Button Text', 'quality'),
	'section' => 'project_section_settings',
	'type' => 'text',
	));
	
	// Project button link
	$wp_customize->add_setting(
	'quality_pro_options[project_button_text_link]', array(
	'default'	=> 'http://webriti.com/demo/wp/quality/',
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type'	=> 'option',
	));
	
	$wp_customize->add_control('quality_pro_options[project_button_text_link]', array(
	'label' => __('Button Link', 'quality'),
	'section' => 'project_section_settings',

	'type' => 'text',
	));
	

}		
	add_action( 'customize_register', 'webriti_companion_quality_project_customizer' );
	
	/**
 * Add selective refresh for Front page project section controls.
 */
function quality_register_project_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_heading_one]', array(
		'selector'            => '.qua_portfolio_carusel .qua_port_title h1',
		'settings'            => 'quality_pro_options[project_heading_one]',
	
	) );
$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_tagline]', array(
		'selector'            => '.qua_portfolio_carusel .qua_port_title p',
		'settings'            => 'quality_pro_options[project_tagline]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_button_text]', array(
		'selector'            => '.qua_proejct_button',
		'settings'            => 'quality_pro_options[project_button_text]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_one_thumb]', array(
		'selector'            => '.home_portfolio_row #quality_project_one .qua_portfolio_image',
		'settings'            => 'quality_pro_options[project_one_thumb]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_one_title]', array(
		'selector'            => '.home_portfolio_row #quality_project_one .qua_home_portfolio_caption a',
		'settings'            => 'quality_pro_options[project_one_title]',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_two_thumb]', array(
		'selector'            => '.home_portfolio_row #quality_project_two .qua_portfolio_image',
		'settings'            => 'quality_pro_options[project_two_thumb]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_two_title]', array(
		'selector'            => '.home_portfolio_row #quality_project_two .qua_home_portfolio_caption a',
		'settings'            => 'quality_pro_options[project_two_title]',
	
	) );
	
	
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_three_thumb]', array(
		'selector'            => '.home_portfolio_row #quality_project_three .qua_portfolio_image',
		'settings'            => 'quality_pro_options[project_three_thumb]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_three_title]', array(
		'selector'            => '.home_portfolio_row #quality_project_three .qua_home_portfolio_caption a',
		'settings'            => 'quality_pro_options[project_three_title]',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_four_thumb]', array(
		'selector'            => '.home_portfolio_row #quality_project_four .qua_portfolio_image',
		'settings'            => 'quality_pro_options[project_four_thumb]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'quality_pro_options[project_four_title]', array(
		'selector'            => '.home_portfolio_row #quality_project_four .qua_home_portfolio_caption a',
		'settings'            => 'quality_pro_options[project_four_title]',
	
	) );
	

	
}

add_action( 'customize_register', 'quality_register_project_section_partials' );
	?>