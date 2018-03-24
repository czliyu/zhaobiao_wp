<?php
function company_register_custom_controls($wp_customize){
	$wp_customize->register_control_type( 'WP_Customize_Company_Product_Notice_Control' );
	$wp_customize->register_control_type( 'WP_Customize_Layout_Select_Control' );
	$wp_customize->register_control_type( 'WP_Customize_Google_Fonts_Control' );
	$wp_customize->register_control_type( 'WP_Customize_Footer_Layout_Select_Control' );
	$wp_customize->register_control_type( 'WP_Customize_Company_Upgrade_To_Pro' );
}
