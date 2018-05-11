<?php
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Business_Field
 */

if ( ! function_exists( 'business_field_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function business_field_setup() {

		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'business-field' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'business-field-thumb', 380, 360, true );

		// This theme uses wp_nav_menu() in four location.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'business-field' ),
			'footer'   => esc_html__( 'Footer Menu', 'business-field' ),
			'social'   => esc_html__( 'Social Menu', 'business-field' ),
			'notfound' => esc_html__( '404 Menu', 'business-field' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'business_field_custom_background_args', array(
			'default-color' => 'FFFFFF',
			'default-image' => '',
		) ) );

		/*
		 * Enable support for selective refresh of widgets in Customizer.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Supports.
		require get_template_directory() . '/inc/support.php';

	}
endif;

add_action( 'after_setup_theme', 'business_field_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_field_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_field_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_field_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_field_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'business-field' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'business-field' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'business-field' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your Secondary Sidebar.', 'business-field' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area', 'business-field' ),
		'id'            => 'sidebar-front-page-widget-area',
		'description'   => esc_html__( 'Add widgets here to appear in your Front Page.', 'business-field' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="container">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2><div class="title-divider">
				<div class="title-divider-before"></div>
				<div class="title-divider-after"></div>
			</div>',
	) );
}
add_action( 'widgets_init', 'business_field_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function business_field_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/third-party/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	$fonts_url = business_field_fonts_url();

	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'business-field-google-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_style( 'jquery-sidr', get_template_directory_uri() .'/third-party/sidr/css/jquery.sidr.dark' . $min . '.css', '', '2.2.1' );

	wp_enqueue_style( 'business-field-style', get_stylesheet_uri(), array(), '1.0.2' );
	// wp_enqueue_style( 'myown-style', get_stylesheet_uri().'/css/mycss.css',);

	wp_enqueue_script( 'business-field-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.6', true );

	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/third-party/sidr/js/jquery.sidr' . $min . '.js', array( 'jquery' ), '2.2.1', true );

	wp_enqueue_script( 'business-field-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'business_field_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function business_field_admin_scripts( $hook ) {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_style( 'business-field-metabox', get_template_directory_uri() . '/css/metabox' . $min . '.css', '', '1.0.0' );
		wp_enqueue_script( 'business-field-custom-admin', get_template_directory_uri() . '/js/admin' . $min . '.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ), '1.0.0', true );
	}

	if ( 'widgets.php' === $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_media();
		wp_enqueue_style( 'business-field-custom-widgets-style', get_template_directory_uri() . '/css/widgets' . $min . '.css', array(), '1.0.0' );
		wp_enqueue_script( 'business-field-custom-widgets', get_template_directory_uri() . '/js/widgets' . $min . '.js', array( 'jquery' ), '1.0.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'business_field_admin_scripts' );



/****** kuozha *****/
/* Define the custom box，适用WP 3.0以后的版本 */
add_action( 'add_meta_boxes', 'ludou_add_custom_box' );

// 如果是WP 3.0之前的版本，使用以下一行代码
// add_action( 'admin_init', 'ludou_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'ludou_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function ludou_add_custom_box() {
  add_meta_box(
    'ludou_sectionid',
    '文章扩展', // 可自行修改标题文字
    'ludou_inner_custom_box',
    'post'
  );
}

/* Prints the box content */
function ludou_inner_custom_box( $post ) {
  global $wpdb;
   
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'ludou_noncename' );
   
  // 获取固定字段keywords和description的值，用于显示之前保存的值
  // 此处wp_posts新添加的字段为keywords和description，多个用半角逗号隔开
  $date = $wpdb->get_row( $wpdb->prepare( "SELECT projectno FROM $wpdb->posts WHERE ID = %d", $post->ID) );


  // description 字段输入框的HTML代码，即复制以上两行代码，并将keywords该成description
  echo '<label for="projectno_new_field">项目编号</label> ';
  echo '<input type="text" id="projectno_new_field" name="projectno_new_field" value="'.$date->projectno.'" size="18" />';
  // 多个字段依此类推
}

/* 文章提交更新后，保存固定字段的值 */
function ludou_save_postdata( $post_id ) {
  // verify if this is an auto save routine.
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( !wp_verify_nonce( $_POST['ludou_noncename'], plugin_basename( __FILE__ ) ) )
      return;
 
  // 权限验证
  if ( 'post' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // 获取编写文章时填写的固定字段的值，多个字段依此类推
  $project = $_POST['projectno_new_field'];
   
  // 更新数据库，此处wp_posts新添加的字段为keywords和description，多个根据你的情况修改
  global $wpdb;
  $wpdb->update( "$wpdb->posts",
          // 以下一行代码，多个字段的话参照下面的写法，单引号中是字段名，右边是变量值。半角逗号隔开
          array( 'projectno' => $project ),
          array( 'ID' => $post_id ),
          // 添加了多少个新字段就写多少个%s，半角逗号隔开
          array( '%s' ),
          array( '%d' )  
  );
}
function add_stylesheet_to_head() {
    wp_enqueue_style('myown-css', get_template_directory_uri() . '/css/mycss.css', array(), '1.0.0');
}
add_action( 'wp_head', 'add_stylesheet_to_head' );



/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';
