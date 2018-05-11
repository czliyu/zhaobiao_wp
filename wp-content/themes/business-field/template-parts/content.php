<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Field
 */

?>

<li id="post-<?php the_ID(); ?>" class="list-group-item">
	<ul class="nav nav-pills">
	<li><?php echo $post->projectno; ?></li>	
	<li><?php the_title( sprintf( '<span><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span>' ); ?></li>
	
	</ul>

	
</li><!-- #post-## -->
