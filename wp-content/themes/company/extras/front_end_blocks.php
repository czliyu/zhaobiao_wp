<?php

function company_thumbnail_placeholder($width="",$height="", $name="thumb_ph" ){
	$result="<img class='thumbnail_placeholder' src='".get_template_directory_uri()."/images/". $name .".png"."' ";
	$result=$result."alt='". __( 'No image available', 'company' ) ."' />";
	return $result;
}

function company_print_layout($type){
	$theme_mods = company_get_theme_mods();
	if(is_single() || is_page()){
		global $post;
		$id=$post->ID;
		if(isset($theme_mods["company_custom_layout".$id]) && $theme_mods["company_custom_layout".$id]!=""){
			$layout=$theme_mods["company_custom_layout".$id];
		}else{
			if($type!="author" && $type!="date" && $type!="tag" && $type!="search" && $type!="template-contact" && $type!="template-blog"){
				$layout = isset( $theme_mods["company_".$type."_sidebar_layout"] ) ? $theme_mods["company_".$type."_sidebar_layout"] :  $theme_mods['company_single_post_sidebar_layout'];
			}else{
				if($type!="author" && $type!="date" && $type!="tag" && $type!="search"){
					$layout=$theme_mods["company_pages_sidebar_layout"];
				}else{
					$layout=$theme_mods["company_category_sidebar_layout"];
				}
			}
		}
	}else{
		if($type!="author" && $type!="date" && $type!="tag" && $type!="search" && $type!="template-contact" && $type!="template-blog"){
			$layout = isset( $theme_mods["company_".$type."_sidebar_layout"] ) ? $theme_mods["company_".$type."_sidebar_layout"] :  $theme_mods['company_single_post_sidebar_layout'];
		}else{
			if($type!="author" && $type!="date" && $type!="tag" && $type!="search"){
				$layout=$theme_mods["company_pages_sidebar_layout"];
			}else{
				$layout=$theme_mods["company_category_sidebar_layout"];
			}

		}
	}

	if($type == "static_homepage"){
		$layout=$theme_mods["company_homepage_sidebar_layout"];
	}

	switch($type){
		case "homepage":
			$content_func="company_home_posts_list";
			break;
		case "static_homepage":
			$content_func="company_home_posts_list_static";
			break;
		case "category":
			$content_func="company_category_content";
			break;
		case "pages":
			$content_func="company_page_content";
			break;
		case "single_post":
			$content_func="company_post_content";
			break;
		case "search":
			$content_func="company_search_content";
			break;
		case "tag":
			$content_func="company_tag_content";
			break;
		case "author":
			$content_func="company_author_content";
			break;
		case "date":
			$content_func="company_date_content";
			break;
		case "template-contact":
			$content_func="company_contact_page_content";
			break;
		case "template-blog":
			$content_func="company_blog_page_content";
			break;
	}

	switch($layout){
		case "no":
			?>
			<div class="content-container">
				<?php $content_func(); ?>
			</div>
			<?php
			break;
		case "left":
			if(is_active_sidebar("left_sidebar")){
				?>
				<div id="left_sidebar" class="left-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("left");
					?>
				</div>
				<?php
			}else{
				?>
				<div id="main_sidebar" class="left-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar();
					?>
				</div>
				<?php
			}
			?>
			<div class="content-container">
				<?php $content_func(); ?>
			</div>
			<?php
			break;
		case "right":
			?>
			<div class="content-container">
				<?php $content_func(); ?>
			</div>
			<?php
			if(is_active_sidebar("right_sidebar")){
				?>
				<div id="right_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("right");
					?>
				</div>
				<?php
			}else{
				?>
				<div id="main_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar();
					?>
				</div>
				<?php
			}
			break;
		case "both-left":
			if(is_active_sidebar("left_sidebar") || is_active_sidebar("right_sidebar")){
				?>
				<div id="left_sidebar" class="left-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("left");
					?>
				</div>
				<div id="right_sidebar" class="left-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("right");
					?>
				</div>
				<?php
			}else{
				?>
				<div id="main_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar();
					?>
				</div>
				<?php
			}
			?>
			<div class="content-container">
				<?php $content_func(); ?>
			</div>
			<?php
			break;
		case "both-right":
			?>
			<div class="content-container">
				<?php $content_func(); ?>
			</div>
			<?php
			if(is_active_sidebar("left_sidebar") || is_active_sidebar("right_sidebar")){
				?>
				<div id="left_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("left");
					?>
				</div>
				<div id="right_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("right");
					?>
				</div>
				<?php
			}else{
				?>
				<div id="main_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar();
					?>
				</div>
				<?php
			}
			break;
		case "both":
			if(is_active_sidebar("left_sidebar")){
				?>
				<div id="left_sidebar" class="left-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("left");
					?>
				</div>
				<?php
			}else{
				?>
				<div id="main_sidebar" class="left-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar();
					?>
				</div>
				<?php
			}
			?>
			<div class="content-container">
				<?php $content_func(); ?>
			</div>
			<?php
			if(is_active_sidebar("right_sidebar")){
				?>
				<div id="right_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar("right");
					?>
				</div>
				<?php
			}else{
				?>
				<div id="main_sidebar" class="right-sidebar sidebar-container" role="complementary">
					<?php
					get_sidebar();
					?>
				</div>
				<?php
			}
			break;
	}
}

function company_post_content(){
	// Start the Loop.
	while ( have_posts() ) : the_post();

		/*
		 * Include the post format-specific template for the content. If you want to
		 * use this in a child theme, then include a file called called content-___.php
		 * (where ___ is the post format) and that will be used instead.
		 */
		?>
		<article <?php post_class(); ?> >
			<div class="post_heading">
				<?php
				if(has_post_thumbnail()){
					the_post_thumbnail(array(158,127));
				}else{
					echo company_thumbnail_placeholder(158,127);
				}
				?>
				<h2><?php the_title(); ?></h2>
				<p>
					<time class="post_date"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo get_the_date(); ?></a></time>
					<span class="post_author"><?php echo the_author_posts_link(); ?></span>
					<?php
					$tags_list = get_the_tag_list('', _x( ', ', 'Used between list items, there is a space after the comma.', 'company' ) );
					if ( $tags_list ) {
						?>
						<span class="post_tags">
							<?php printf( '<span class="post_tag">%1$s </span>',$tags_list); ?>
						</span>
						<?php
					}

					?>
					<?php edit_post_link( __( 'Edit', 'company' ),'<span class="edit">','</span>' ); ?> 
				</p>
				<div class="clear"></div>
			</div>
			<div class="post_content">
				<?php the_content( sprintf(
				__( 'Continue reading %s', 'company' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			)); ?>
			</div>
			<div class="clear"></div>
		</article>
		<div class="link-pages">
			<?php
			$defaults = array(
				'before'           => '<span class="before">' . __( 'Pages:','company' ).'</span>',
				'separator'        => ' ',
				'pagelink'         => '<span class="item">%</span>',
			);

			wp_link_pages( $defaults );
			?>
		</div>
		<?php
		// Previous/next post navigation.
		the_post_navigation(array(
				'next_text' => __( '<span title="%title">Next Post</span>', 'company' ),
				'prev_text' => __( '<span title="%title">Previous Post</span>', 'company' ),
			));
		// If comments are open or we have at least one comment, load up the comment template.
		 if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

	endwhile;
}

function company_search_content(){
	 if(have_posts()): ?>
		<header class="archive-header">
			<h1 class="archive-title"><?php echo  __( 'Search Results for: ','company') ;?><span class="archive-name"><?php echo get_search_query(); ?></span></h1>
		</header><!-- .archive-header -->
		<?php $i=1; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="archive-post <?php if($i%2){ echo "even"; } ?>">
				<div class="cover-image-container">
					<a href="<?php the_permalink(); ?>">
						<?php
						if(has_post_thumbnail()){
								the_post_thumbnail(array(364,276));
						}else{
							echo company_thumbnail_placeholder();
						}
						?>
					</a>
				</div>
				<a class="archive-post-title" href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				<span class="archive-post-content">
					<a href="<?php the_permalink(); ?>">
						<?php the_excerpt(); ?>
					</a>
				</span>
				<div class="post-date-info">
					<a href="<?php the_permalink(); ?>">
						<time class="post-date">
							<?php echo __('Posted on ','company');?><span class="date"><?php echo get_the_date(); ?></span>
						</time>
					</a>
				</div>
			</article>
			<?php $i++; ?>
		<?php endwhile;
		// Previous/next page navigation.
		the_posts_pagination(array(
			'prev_text' => '',
			'next_text' => '',
		));

		else : ?>
		<div class="nothing-found">
			<p>
				<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'company' ); ?>
			</p>
			<?php get_search_form(); ?>
		 </div>
	<?php endif;
}

function company_tag_content(){
	 if(have_posts()): ?>
		<header class="archive-header">
			<h1 class="archive-title"><?php echo  __( 'Tag: ','company') ;?><span class="archive-name"><?php echo single_tag_title(); ?></span></h1>
		</header><!-- .archive-header -->
		<?php $i=1; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="archive-post <?php if($i%2){ echo "even"; } ?>">
				<div class="cover-image-container">
					<a href="<?php the_permalink(); ?>">
						<?php
						if(has_post_thumbnail()){
								the_post_thumbnail(array(364,276));
						}else{
							echo company_thumbnail_placeholder();
						}
						?>
					</a>
				</div>
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				<span class="archive-post-content">
					<?php the_excerpt(); ?>
				</span>
				<time class="post-date">
					<?php echo __('Posted on ','company');?><span class="date"><?php echo get_the_date(); ?></span>
				</time>
			</article>
			<?php $i++; ?>
		<?php endwhile;
		// Previous/next page navigation.
		the_posts_pagination(array(
			'prev_text' => '',
			'next_text' => '',
		));

		else : ?>
		<div class="nothing-found">
			<p>
				<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'company' ); ?>
			</p>
			<?php get_search_form(); ?>
		 </div>
	<?php endif;
}

function company_author_content(){
	 if(have_posts()): ?>
		<header class="archive-header">
			<?php
				global $wp_query;
				$curauth = $wp_query->get_queried_object();
			?>
			<h1 class="archive-title"><?php echo  __( 'Author: ','company') ;?><span class="archive-name"><?php echo $curauth->nickname; ?></span></h1>
		</header><!-- .archive-header -->
		<?php $i=1; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="archive-post <?php if($i%2){ echo "even"; } ?>">
				<div class="cover-image-container">
					<a href="<?php the_permalink(); ?>">
						<?php
						if(has_post_thumbnail()){
								the_post_thumbnail(array(364,276));
						}else{
							echo company_thumbnail_placeholder();
						}
						?>
					</a>
				</div>
				<a class="archive-post-title" href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				<span class="archive-post-content">
					<a href="<?php the_permalink(); ?>">
						<?php the_excerpt(); ?>
					</a>
				</span>
				<div class="post-date-info">
					<a href="<?php the_permalink(); ?>">
						<time class="post-date">
							<?php echo __('Posted on ','company');?><span class="date"><?php echo get_the_date(); ?></span>
						</time>
					</a>
				</div>
			</article>
			<?php $i++; ?>
		<?php endwhile;
		// Previous/next page navigation.
		the_posts_pagination(array(
			'prev_text' => '',
			'next_text' => '',
		));

		else : ?>
		<div class="nothing-found">
			<p>
				<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'company' ); ?>
			</p>
			<?php get_search_form(); ?>
		 </div>
	<?php endif;
}


function company_date_content(){
	if(have_posts()): ?>
		<header class="archive-header">
			<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>
		</header><!-- .archive-header -->
		<?php $i=1; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="archive-post <?php if($i%2){ echo "even"; } ?>">
				<div class="cover-image-container">
					<a href="<?php the_permalink(); ?>">
						<?php
						if(has_post_thumbnail()){
								the_post_thumbnail(array(364,276));
						}else{
							echo company_thumbnail_placeholder();
						}
						?>
					</a>
				</div>
				<a class="archive-post-title" href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				<span class="archive-post-content">
					<a href="<?php the_permalink(); ?>">
						<?php the_excerpt(); ?>
					</a>
				</span>
				<div class="post-date-info">
					<a href="<?php the_permalink(); ?>">
						<time class="post-date">
							<?php echo __('Posted on ','company');?><span class="date"><?php echo get_the_date(); ?></span>
						</time>
					</a>
				</div>
			</article>
			<?php $i++; ?>
		<?php endwhile;
		// Previous/next page navigation.
		the_posts_pagination(array(
			'prev_text' => '',
			'next_text' => '',
		));

		else : ?>
		<div class="nothing-found">
			<p>
				<?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'company' ); ?>
			</p>
			<?php get_search_form(); ?>
		 </div>
	<?php endif;
}

function company_category_content(){
		 if(have_posts()): ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php echo  __( 'Category Archives: ','company') ;?><span class="archive-name"><?php echo single_cat_title( '', false );  ?></span></h1>
				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article class="category-post">
						<?php if(has_post_thumbnail()){
							the_post_thumbnail(array(364,276));
						}else{
							echo company_thumbnail_placeholder();
						}
						?>

						<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
						<span class="post-date">
							<?php echo __('Posted on ','company');?><span class="date"><?php echo get_the_date(); ?></span>
						</span>
						<span class="category-post-content">
							<?php the_excerpt(); ?>
						</span>
				</article>
			<?php endwhile;
			// Previous/next page navigation.
			the_posts_pagination(array(
				'prev_text' => '',
				'next_text' => '',
			));

			else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif;
}


function company_page_content(){
	while ( have_posts() ) : the_post();
		?>
		<article class="page">
			<div class="page_heading">
				<a href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
				</a>
			</div>
			<div class="page_content">
				<?php the_content(); ?>
			</div>
		</article>
		<div class="link-pages">
			<?php
			$defaults = array(
				'before'           => '<span class="before">' . __( 'Pages:','company' ).'</span>',
				'separator'        => ' ',
				'pagelink'         => '<span class="item">%</span>',
			);

			wp_link_pages( $defaults );
			?>
		</div>
		<?php
		if(comments_open() || get_comments_number()){
			comments_template();
		}
	endwhile;
}

function company_home_posts_list_static(){
	while ( have_posts() ) : the_post(); ?>
		<article class="category-post">
			<?php if(has_post_thumbnail()){
					the_post_thumbnail(array(364,276));
				}else{
					echo company_thumbnail_placeholder();
				}
				?>
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
				<span class="category-post-content">
					<?php the_excerpt(); ?>
				</span>
				<span class="post-date">
					<?php echo __('Posted on ','company');?><span class="date"><?php echo get_the_date(); ?></span>
				</span>
		</article>
	<?php endwhile;
	// Previous/next page navigation.
	the_posts_pagination(array(
		'prev_text' => '',
		'next_text' => '',
	));
}

if( !function_exists( 'company_home_layout' ) ){
	function company_home_layout(){
		?>
		<div id="primary" class="static_homepage_primary container">
			<?php company_print_layout( 'static_homepage' ); ?>
		</div>
		<?php
	}
}

//footer social buttons Huge-IT
function company_footer_social(){
	$theme_mods = company_get_theme_mods();
	?>
	<div id="footer_social">
		<div class="site-info">
			<?php
			$footer_attribution = $theme_mods["company_footer_attribution"];
			if(!empty($footer_attribution)){
				echo $footer_attribution;
			}else{

				printf(
				__( 'Copyright %s %s <a href="%s">%s</a> Designed by %s Huge-IT %s | Powered by  %s WordPress %s', 'company' ),
					'&#169;',
					date('Y'),
					esc_url( home_url( '/' ) ),
					get_bloginfo( 'name' ),
					'<a href="'.esc_url('http://huge-it.com').'">',
					'</a>',
					'<a href="'.esc_url('http://wordpress.org').'">',
					'</a>'
				);
			}
			?>
		</div>
		<div id="footer-social-share-buttons">
			<?php
			if($theme_mods["company_facebook_icon"] == true && $theme_mods["company_facebook_url"] != ""){
				?>
				<a id="footer-fb-share-button" href="<?php echo esc_url($theme_mods["company_facebook_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_twitter_icon"] == true && $theme_mods["company_twitter_url"] != ""){
				?>
				<a id="footer-twitter-share-button" href="<?php echo esc_url($theme_mods["company_twitter_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_google_plus_icon"] == true && $theme_mods["company_google_plus_url"] != ""){
				?>
				<a id="footer-googleplus-share-button" href="<?php echo esc_url($theme_mods["company_google_plus_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_linkedin_icon"] == true && $theme_mods["company_linkedin_url"] != ""){
				?>
				<a id="footer-linkedin-share-button" href="<?php echo esc_url($theme_mods["company_linkedin_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_instagram_icon"]==true && $theme_mods["company_instagram_url"] != ""){
				?>
				<a id="footer-instagram-share-button" href="<?php echo esc_url($theme_mods["company_instagram_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_pinterest_icon"]==true && $theme_mods["company_pinterest_url"]!=""){
				?>
				<a id="footer-pinterest-share-button" href="<?php echo esc_url($theme_mods["company_pinterest_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_vimeo_icon"] == true && $theme_mods["company_vimeo_url"]!=""){
				?>
				<a id="footer-vimeo-share-button" href="<?php echo esc_url($theme_mods["company_vimeo_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_digg_icon"] == true && $theme_mods["company_digg_url"]!=""){
				?>
				<a id="footer-digg-share-button" href="<?php echo esc_url($theme_mods["company_digg_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_stumbleupon_icon"] == true && $theme_mods["company_stumbleupon_url"]!=""){
				?>
				<a id="footer-stumbleupon-share-button" href="<?php echo esc_url($theme_mods["company_stumbleupon_url"]); ?>" target="_blank"></a>
				<?php
			}
			if($theme_mods["company_myspace_icon"] == true && $theme_mods["company_myspace_url"]!=""){
				?>
				<a id="footer-myspace-share-button" href="<?php echo esc_url($theme_mods["company_myspace_url"]); ?>" target="_blank"></a>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

function company_footer_widgets(){
	$theme_mods = company_get_theme_mods();
	?>
	<div class="footer-widget-area">
		<?php
		switch($theme_mods["company_footer_layout"]){
			case "1":
				if(is_active_sidebar("footer_widget_area_1")){
					get_sidebar("footer_1");
				}
				if(is_active_sidebar("footer_widget_area_2")){
					get_sidebar("footer_2");
				}
				if(is_active_sidebar("footer_widget_area_3")){
					get_sidebar("footer_3");
				}
				if(is_active_sidebar("footer_widget_area_4")){
					get_sidebar("footer_4");
				}
				break;
			case "2":
				if(is_active_sidebar("footer_widget_area_1")){
					get_sidebar("footer_1");
				}
				if(is_active_sidebar("footer_widget_area_2")){
					get_sidebar("footer_2");
				}
				if(is_active_sidebar("footer_widget_area_3")){
					get_sidebar("footer_3");
				}
				break;
			case "3":
				if(is_active_sidebar("footer_widget_area_1")){
					get_sidebar("footer_1");
				}
				if(is_active_sidebar("footer_widget_area_2")){
					get_sidebar("footer_2");
				}
				if(is_active_sidebar("footer_widget_area_3")){
					get_sidebar("footer_3");
				}
				break;
			case "4":
				if(is_active_sidebar("footer_widget_area_1")){
					get_sidebar("footer_1");
				}
				if(is_active_sidebar("footer_widget_area_2")){
					get_sidebar("footer_2");
				}
				if(is_active_sidebar("footer_widget_area_3")){
					get_sidebar("footer_3");
				}
				break;
			case "5":
				if(is_active_sidebar("footer_widget_area_1")){
					get_sidebar("footer_1");
				}
				if(is_active_sidebar("footer_widget_area_2")){
					get_sidebar("footer_2");
				}
				break;
			case "6":
				if(is_active_sidebar("footer_widget_area_1")){
					get_sidebar("footer_1");
				}
				if(is_active_sidebar("footer_widget_area_2")){
					get_sidebar("footer_2");
				}
				break;
		}
		?>
	</div>
	<?php
}

function company_header_navigation_menu(){
	$theme_mods = company_get_theme_mods();
	?>
	<nav id="primary-navigation" class="primary-navigation" role="navigation">
		<?php
		$args = array(
			'theme_location'  => 'primary',
			'menu'            => '',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'nav-menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => '',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);

		wp_nav_menu($args); ?>
		<?php
		if( $theme_mods["company_searchbox_display"] == true ){
			get_search_form();
		}
		?>
	</nav>
	<?php
}