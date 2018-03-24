<?php

add_action( 'after_setup_theme','company_setup');

function company_setup(){

    load_theme_textdomain( 'company' );

    /*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/company
	 */

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
	$GLOBALS['content_width'] = apply_filters( 'company_content_width', 1024 );
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support( 'title-tag' );

    /*
	 * Enable support for custom logo.
	 *
	 */
    add_theme_support( 'custom-logo', array(
        'height'      => 50,
        'width'       => 50,
    ) );

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 9999 );

    /* navigation menus */
    register_nav_menus( array(
        'primary'   =>  __( 'Navigation Menu', 'company' ),
    ) );

    add_theme_support( 'custom-background',	array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'default-attachment'     => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	));
	add_theme_support( 'custom-header',array(
		'default-image'          => get_theme_mod("header_image"),
		'random-default'         => false,
		'width'                  => 1500,
		'height'                 => 200,
	));
	add_theme_support( 'html5',array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'widgets'
	));

    //install plugins library
	require_once trailingslashit( get_template_directory() ) .'extras/class-tgm-plugin-activation.php';
}

function company_custom_site_icon_size( $sizes ) {
   $sizes[] = 64;
 
   return $sizes;
}
add_filter( 'site_icon_image_sizes', 'company_custom_site_icon_size' );
 
function company_custom_site_icon_tag( $meta_tags ) {
   $meta_tags[] = sprintf( '<link rel="icon" href="%s" sizes="64x64" />', esc_url( get_site_icon_url( null, 64 ) ) );
 
   return $meta_tags;
}
add_filter( 'site_icon_meta_tags', 'company_custom_site_icon_tag' );

//Let Pages have Excerpts
add_action('init', 'company_custom_init');
function company_custom_init(){
	add_post_type_support( 'page', 'excerpt' );
}

require_once trailingslashit( get_template_directory() ) . 'extras/install_plugins.php';
require_once trailingslashit( get_template_directory() ) . 'extras/ajax_callback.php';
require_once trailingslashit( get_template_directory() ) . 'extras/default_content.php';
require_once trailingslashit( get_template_directory() ) . 'extras/front_end_options.php';
require_once trailingslashit( get_template_directory() ) . 'extras/customizer/customizer.php';
require_once trailingslashit( get_template_directory() ) . 'extras/front_end_blocks.php';
require_once trailingslashit( get_template_directory() ) . 'extras/editor.php';
require_once trailingslashit( get_template_directory() ) . 'extras/editor.php';

add_action("wp_enqueue_scripts", "company_wordpress_styles");

function company_wordpress_styles (){
	//paths
	$suffix = SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style('company_style', get_stylesheet_uri());

	$js = get_template_directory_uri()."/assets/js/javascript.js";
	$responsive_js =get_template_directory_uri()."/assets/js/responsive-layout.js";
	$lb_custom_js = get_template_directory_uri()."/assets/lightbox/custom.js";
	$lb_js = get_template_directory_uri()."/assets/lightbox/jquery.colorbox.js";
	$lb_css = get_template_directory_uri()."/assets/lightbox/colorbox-3.css";
	$lb_min_js =  get_template_directory_uri()."/assets/lightbox/jquery.colorbox-min.js";
	$responsive_slder_js = get_template_directory_uri()."/assets/js/responsiveslides.js";
	$post_slder_js = get_template_directory_uri()."/assets/js/post-slider.js";
	$fa= get_template_directory_uri()."/assets/font-awesome/css/font-awesome". $suffix .".css" ;
	$attractive_css= get_template_directory_uri()."/assets/css/attractive.css";
	$animate_css= get_template_directory_uri()."/assets/css/animate.css";

	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	wp_enqueue_script('responsive-slder-js',$responsive_slder_js, array ( 'jquery' ) );
	wp_enqueue_script('company-custom-js', $js, array( 'jquery' ));
	wp_localize_script( 'company-custom-js', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
	//some js for responsive layout that doesn't require php options(others are in front_end_options.php)
	wp_enqueue_script('company-responsive-js', $responsive_js, array( 'jquery' ));
    $theme_mods = company_get_theme_mods();
    if( $theme_mods['enable_lightbox'] == true ){
        wp_enqueue_script('jquery-colorbox', $lb_min_js, array( 'jquery' ));
        wp_enqueue_script('lightbox-custom-js', $lb_custom_js, array( 'jquery' ));
        wp_enqueue_style('colorbox-3',$lb_css);
    }

	wp_enqueue_style('fontawesome',$fa);
	wp_enqueue_style('company-attractive-css',$attractive_css);
	wp_enqueue_style('animate-css',$animate_css);


	$fonts = $theme_mods["company_google_fonts_list"];
	if(is_array($fonts) && !empty($fonts)){
		company_enqueue_google_fonts($fonts);
	}
}

function company_enqueue_google_fonts($fonts = array()){
	$theme_mods = company_get_theme_mods();
	if(is_array($fonts) && empty($fonts)) $fonts = $theme_mods["company_google_fonts_list"];
	elseif(!is_array($fonts)) return;
	foreach($fonts as $font){
		$font_name = str_replace(" ","+",$font["family"]);
		$font_variants = "";
		$font_subset = "";
		if($font["variants"]){
				$font_variants = implode($font["variants"],",");
				$font_variants = ":".$font_variants;
		}
		if($font["subsets"]){
				$font_subset = implode($font["subsets"],",");
				$font_subset = "&subset=".$font_subset;
		}
		$font_url = "https://fonts.googleapis.com/css?family={$font_name}{$font_variants}{$font_subset}";
		wp_enqueue_style("company-google-font-".$font['family'],$font_url);
	}
}

//Add Widget Areas
add_action( 'widgets_init', 'company_widgets_init' );

function company_widgets_init() {
	register_sidebar(array(
		'name'          => __('Default Sidebar(Displays if others are inactive)','company'),
		'id'            => 'main_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Left Sidebar','company'),
		'id'            => 'left_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Right Sidebar','company'),
		'id'            => 'right_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Footer Widget Area 1','company'),
		'id'            => 'footer_widget_area_1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Footer Widget Area 2','company'),
		'id'            => 'footer_widget_area_2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Footer Widget Area 3','company'),
		'id'            => 'footer_widget_area_3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Footer Widget Area 4','company'),
		'id'            => 'footer_widget_area_4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	));
}

function company_is_product_active(){
	$theme_mods = company_get_theme_mods();
	if($theme_mods["huge_it_is_product_active"]=="1"){
		return true;
	}else{
		return false;
	}
}