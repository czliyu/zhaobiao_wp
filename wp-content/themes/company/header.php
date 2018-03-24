<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<!-- site-header -->
		<header class="site-header full-width">
			<div id="header">
					<div id="main-logo">
						<?php
						if ( function_exists( 'the_custom_logo' ) ) {
							the_custom_logo();
						}
						if(display_header_text()): ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" ><h1 class="site-title" ><?php bloginfo( 'name' ); ?></h1><p class="site-tagline"><?php bloginfo( 'description' ); ?></p></a>
						<?php endif; ?>
					</div>
					<?php echo company_header_navigation_menu(); ?><!-- #site-navigation -->
			</div>
		</header><!-- /site-header -->
