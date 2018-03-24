<?php get_header(); ?>
	<div id="primary" class="content-area page-404 full-width">
		<div class="wrap404">
			<h1><?php _e( '404 Error !','company'); ?></h1>
			<p><?php _e( 'Sorry, we no longer have that!','company'); ?></p>
			<a class="border-out-animation" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('HOME','company'); ?></a>
		</div>
	</div><!-- #primary -->
<?php get_footer(); ?>