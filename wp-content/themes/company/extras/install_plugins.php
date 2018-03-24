<?php
add_action('tgmpa_register','company_register_required_plugins');


function company_register_required_plugins(){
	$plugins = array(
		array(
			'name' => __('Forms','company'),
			'slug' => 'forms-contact',
			'required' => false ,
		),
		array(
			'name'      => __('Portfolio Gallery','company'),
			'slug'      => 'portfolio-gallery',
			'required'  => false,
		),
		array(
			'name'      => __('Slider','company'),
			'slug'      => 'slider-image',
			'required'  => false,
		),
		array(
			'name'      => __('Video Gallery','company'),
			'slug'      => 'gallery-video',
			'required'  => false,
		),
		array(
			'name'      => __('Image Gallery','company'),
			'slug'      => 'gallery-images',
			'required'  => false,
		),
		array(
			'name'      => __('Product Catalog','company'),
			'slug'      => 'product-catalog',
			'required'  => false,
		),
		array(
			'name'      => __('Google Maps','company'),
			'slug'      => 'google-maps',
			'required'  => false,
		),
		array(
			'name'      => __('Lightbox','company'),
			'slug'      => 'lightbox',
			'required'  => false,
		),
		array(
			'name'      => __('Popup Colorbox','company'),
			'slug'      => 'colorbox',
			'required'  => false,
		),
		
		array(
			'name'      => __('Share Buttons','company'),
			'slug'      => 'wp-share-buttons',
			'required'  => false,
		),
		
		array(
			'name'      => __('Video Player','company'),
			'slug'      => 'video-player',
			'required'  => false,
		),
	);
	$config = array(

		'id'           => 'company',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Recommended Plugins', 'company' ),
			'menu_title'                      => __( 'Install Plugins', 'company' ),
			'installing'                      => __( 'Installing Plugin: %s', 'company' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'company' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'company'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'company'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'company'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'company'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'company'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'company'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'company'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'company'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'company'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'company'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'company'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'company'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'company' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'company' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'company' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'company' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'company' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'company' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'company' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
	);


	tgmpa($plugins, $config);


}
?>