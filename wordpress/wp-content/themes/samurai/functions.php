<?php
/**
 * Samurai functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Samurai
 */

if ( ! function_exists( 'samurai_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function samurai_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Samurai, use a find and replace
		 * to change 'samurai' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'samurai', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'samurai-featured-main', 750, 409, true );
		add_image_size( 'samurai-thumbnail-1', 295, 202, true ); // Archive Posts, Blog Posts, Search Posts
		add_image_size( 'samurai-thumbnail-2', 200, 200, true ); // Author Image

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'samurai' ),
			'top_menu' => esc_html__( 'Top Menu', 'samurai' ),
			'social_menu' => esc_html__( 'Social Menu', 'samurai' )  
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'samurai_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'samurai_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function samurai_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'samurai_content_width', 640 );
}
add_action( 'after_setup_theme', 'samurai_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function samurai_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'samurai' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'samurai' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget_title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'samurai' ),
		'id'            => 'sidebar-shop',
		'description'   => esc_html__( 'Add Woocommerce widgets here.', 'samurai' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget_title"><h3>',
		'after_title'   => '</h3></div>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'samurai' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'samurai' ),
		'before_widget' => '<div id="%1$s" class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><div class="footer_widget_grids widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="footer_widget_title"><h2>',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Home Widget Area Top', 'samurai' ),
		'id'			=> 'sidebar-3',
		'description'	=> esc_html__( 'Add Slider Widget and Advertisement', 'samurai' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '',
		'after_title'	=> ''
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Home Widget Area Bottom', 'samurai' ),
		'id'			=> 'sidebar-4',
		'description'	=> esc_html__( 'Add Advertisement Here.', 'samurai' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '',
		'after_title'	=> ''
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Archive Widget Area Top', 'samurai' ),
		'id'			=> 'sidebar-5',
		'description'	=> esc_html__( 'Add Advertisement Here.', 'samurai' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '',
		'after_title'	=> ''
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Archive Widget Area Bottom', 'samurai' ),
		'id'			=> 'sidebar-6',
		'description'	=> esc_html__( 'Add Advertisement Here.', 'samurai' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '',
		'after_title'	=> ''
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Single Post Widget Area Top', 'samurai' ),
		'id'			=> 'sidebar-7',
		'description'	=> esc_html__( 'Add Advertisement Here.', 'samurai' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '',
		'after_title'	=> ''
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Single Post Widget Area Bottom', 'samurai' ),
		'id'			=> 'sidebar-8',
		'description'	=> esc_html__( 'Add Advertisement Here.', 'samurai' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '',
		'after_title'	=> ''
	) );

}
add_action( 'widgets_init', 'samurai_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function samurai_scripts() {
	wp_enqueue_style( 'samurai-style', get_stylesheet_uri() );

	wp_enqueue_style( 'samurai-font', samurai_fonts_url() );

	wp_enqueue_style( 'samurai-custom-css', get_template_directory_uri() . '/samuraithemes/assets/dist/css/custom.min.css' );

	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/samuraithemes/assets/dist//css/meanmenu.css' );

	wp_enqueue_style( 'samurai-main-css', get_template_directory_uri() . '/samuraithemes/assets/dist/css/main.css' );

	wp_enqueue_script( 'samurai-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'samurai-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20171226', true );

	wp_enqueue_script( 'samurai-bundle', get_template_directory_uri() . '/samuraithemes/assets/dist/js/bundle.min.js', array( 'jquery' ), '20171226', true  );

	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/samuraithemes/assets/dist/js/jquery.meanmenu.js', array( 'jquery' ), '20171226', true  );

	wp_enqueue_script( 'samurai-main-js', get_template_directory_uri() . '/samuraithemes/assets/dist/js/main.js', array( 'jquery' ), '20171226', true  );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'samurai_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Breadcrumbs.
 */
require get_template_directory() . '/samuraithemes/third-party/breadcrumbs.php';

/**
 * Load Helper Functions.
 */
require get_template_directory() . '/samuraithemes/helpers.php';

/**
 * Load Filter Functions.
 */
require get_template_directory() . '/samuraithemes/filters.php';

/**
 * Load Hooks Functions.
 */
require get_template_directory() . '/samuraithemes/hooks.php';

/**
 * Load Widget Helpers Functions.
 */
require get_template_directory() . '/samuraithemes/widgets/widget-init.php';

/**
 * Load Widgets.
 */
require get_template_directory() . '/samuraithemes/widgets/homepage-widgets.php';
require get_template_directory() . '/samuraithemes/widgets/sidebar-widgets.php';
