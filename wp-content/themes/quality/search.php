<?php
 get_header(); ?>
<div class="page-seperator"></div>
<div class="container">
 <div class="row">
   <div class="qua_page_heading">
     <h1><?php the_title(); ?></h1>
     <div class="qua-separator"></div>
   </div>
 </div>
</div>
<div class="page-seperator"></div>
<div class="container">    
    <div class="row qua_blog_wrapper">        

        <!--Blog Content-->
        <div class="col-md-<?php echo ( is_active_sidebar( 'sidebar-primary' ) ? '8' : '12' ); ?>">
        <?php if ( have_posts() ) : ?>
            <h1 >
                <?php printf( __( "Search results for: %s", 'quality' ), '<span>' . get_search_query() . '</span>' ); ?>
            </h2>
            <?php while ( have_posts() ) : the_post();  ?>
                <div class="qua_blog_section"  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <div class="qua_blog_post_img">
                  <?php $post_thumbnail_url = get_the_post_thumbnail( get_the_ID(), 'img-responsive' );
                    if ( !empty( $post_thumbnail_url ) ) {
                   ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php echo $post_thumbnail_url; ?>
                    </a>
                    <?php
                    }
                    ?>
                    </div>
                    <div class="qua_post_date">
                      <span class="date"><?php echo get_the_date('j'); ?></span>
                      <h6><?php echo the_time('M'); ?></h6>
                    </div>
                    <div class="qua_post_title_wrapper">
                      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                      <div class="qua_post_detail">
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="fa fa-user"></i><?php echo get_the_author(); ?></a>
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-comments"></i><?php comments_number( 'No Comments', 'One comment', '% comments' ); ?></a>
                        <?php if(get_the_tag_list() != '') { ?>
                        <div class="qua_tags">
                          <i class="fa fa-tags"></i><?php the_tags('',' , ', '<br />'); ?>                            
                        </div>
                        <?php }?>
                        <?php if(get_the_category_list() != '') { ?>
                        <div class="qua_post_cats">
                          <i class="fa fa-group"></i>&nbsp;&nbsp;<?php the_category(' ', ' '); ?>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="clear"></div>
                        <?php if ( get_the_content()!="" ) {?>
                        <div class="qua_blog_post_content">
                          <?php the_content( __( 'Read More' , 'quality' ) ); ?>
                        <?php wp_link_pages( ); ?>
                       </div>
                        <?php }?>    
                    </div>
                <?php endwhile; ?>
                    
                <?php else : ?>
                        <h2><?php _e( "Nothing Found", 'quality' ); ?></h2>
                        <div class="qua_searching">
                            <p>
                            <?php _e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'quality' ); ?></p>
                            <?php get_search_form(); ?>
                        </div>    
            <?php endif; ?>
        </div>    
        <!--/Blog Content-->
        
        <?php get_sidebar(); ?>    
        
    </div>
</div>
<?php get_footer(); ?>