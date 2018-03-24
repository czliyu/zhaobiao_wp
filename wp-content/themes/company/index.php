<?php get_header(); ?>
<div id="main">
<?php if(is_front_page() && 'posts' == get_option( 'show_on_front' )){
	company_home_layout();
}else{
	?>
	<div id="primary" class="static_homepage_primary container">
		<?php company_print_layout("static_homepage"); ?>
	</div>
	<?php
} ?>
</div>
<?php get_footer(); ?>
