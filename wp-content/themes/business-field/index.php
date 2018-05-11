<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Field
 */

get_header(); ?>

<?php if ( true === apply_filters( 'business_field_filter_home_page_content', true ) ) : ?>

	<div id="primary" class="content-area">
		<div class="row">

			<p class="title">
				<span class="title-block">公告信息</span>
				<span class="more"><a href="?cat=2">more</a></span>
			</p>
			<!--公告信息-->

			<ul id="main" class="list-group" role="main">
				<li class="list-group-item">
				<ul class="nav nav-pills">
				  <li>项目编号</li>
				  <li>项目名称</li>
				  
				</ul>
				</li>
			
			<?php query_posts(['cat' => 2, 'limit' => 10]) ?>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content' ); ?>

				<?php endwhile; ?>

				<?php
				/**
				 * Hook - business_field_action_posts_navigation.
				 *
				 * @hooked: business_field_custom_posts_navigation - 10
				 */
				do_action( 'business_field_action_posts_navigation' ); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
			<?php wp_reset_query(); ?>
			
			</ul><!-- #main -->
		</div>
		<div class="blank10"></div>
		<!-- 信息公告 -->
		<div class="row">
			<p class="title"><span class="title-block">补充公告</span><span class="more"><a href="?cat=10">more</a></span></p>
			<!--公告信息-->
			<ul class="list-group">
				<li class="list-group-item">
				<ul class="nav nav-pills">
				  <li>项目编号</li>
				  <li>项目名称</li>
				  
				</ul>
				</li>
			
			<?php query_posts('cat=10') ?>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content' ); ?>

				<?php endwhile; ?>

				<?php
				/**
				 * Hook - business_field_action_posts_navigation.
				 *
				 * @hooked: business_field_custom_posts_navigation - 10
				 */
				do_action( 'business_field_action_posts_navigation' ); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
			<?php wp_reset_query(); ?>
			
			</ul><!-- #main -->
		</div>
		<div class="blank10"></div>
		<div class="row">
			<p class="title"><span class="title-block">中标公告</span><span class="more"><a href="?cat=11">more</a></span></p>
			<!--公告信息-->
			<ul class="list-group">
				<li class="list-group-item">
				<ul class="nav nav-pills">
				  <li>项目编号</li>
				  <li>项目名称</li>
				  
				</ul>
				</li>
			<?php query_posts('cat=11') ?>
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content' ); ?>

				<?php endwhile; ?>

				<?php
				/**
				 * Hook - business_field_action_posts_navigation.
				 *
				 * @hooked: business_field_custom_posts_navigation - 10
				 */
				do_action( 'business_field_action_posts_navigation' ); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
			<?php wp_reset_query(); ?>
			
			</ul><!-- #main -->
		</div>
		
	</div><!-- #primary -->

<?php
	/**
	 * Hook - business_field_action_sidebar.
	 *
	 * @hooked: business_field_add_sidebar - 10
	 */
	do_action( 'business_field_action_sidebar' );
?>

<?php endif; // End if show home content. ?>

<?php get_footer(); ?>
