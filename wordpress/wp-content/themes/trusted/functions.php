<?php
/**
 * Trusted functions and definitions
 *
 * @package Trusted
 */

if ( ! function_exists( 'trusted_setup' ) ) :

//Sets up theme defaults and registers support for various WordPress features

function trusted_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'trusted', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Support for woocommerce
	add_theme_support( 'woocommerce' );

	//Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	//WooCommerce image sizes
	add_image_size( 'trusted-shop-thumbnail', 120, 120, true );
	add_image_size( 'trusted-shop-single', 600, 600, true );
	add_image_size( 'trusted-shop-archive', 325, 380, true );

	// This theme uses wp_nav_menu() in two locations
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'trusted' ),
		'footer' => esc_html__( 'Footer Menu', 'trusted' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for post formats
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat',
	) );

	// Set up the WordPress core custom background feature
	add_theme_support( 'custom-background', apply_filters( 'trusted_custom_background_args', array(
		'default-color' => 'f7f7f7',
		'default-image' => '',
	) ) );

	// Enable support for Custom Logo
	add_theme_support( 'custom-logo', array(
		'width'		=> '220',
		'height'	=> '70',
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Style the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css', trusted_editor_fonts_url() ) );

	// Support for WooCommerce product gallery features
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
endif; // trusted_setup
add_action( 'after_setup_theme', 'trusted_setup' );

function trusted_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'trusted_content_width', 1160 );
}
add_action( 'after_setup_theme', 'trusted_content_width', 0 );

// Set up the WordPress core custom header feature
function trusted_custom_header_setup() {
	register_default_headers( array(
		'desk' => array(
			'url'           => '%s/images/trusted-header.jpg',
			'thumbnail_url' => '%s/images/trusted-header-thumbnail.jpg',
			'description'   => esc_html__( 'Person Working on Laptop', 'trusted' )
		)
	) );

	add_theme_support( 'custom-header', apply_filters( 'trusted_custom_header_args', array(
		'default-image'			=> get_template_directory_uri().'/images/trusted-header.jpg',
		'default-text-color'	=> 'ffffff',
		'header_text'			=> true,
		'width'					=> 1920,
		'height'				=> 640,
		'flex-height'			=> false,
		'flex-width'			=> false,
		'wp-head-callback'		=> '',
	) ) );
}
add_action( 'after_setup_theme', 'trusted_custom_header_setup' );

// Enables the Excerpt meta box in Page edit screen
function trusted_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'trusted_add_excerpt_support_for_pages' );

// Register widget area
function trusted_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'trusted' ),
		'id'            => 'trusted-sidebar',
		'description'   => esc_html__( 'Sidebar for posts, blog index and archives.', 'trusted' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Sidebar', 'trusted' ),
		'id'            => 'trusted-homepage-sidebar',
		'description'   => esc_html__( 'Sidebar for the home page template.', 'trusted' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'trusted' ),
		'id'            => 'trusted-page-sidebar',
		'description'   => esc_html__( 'Sidebar for standard pages.', 'trusted' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'trusted' ),
		'id'            => 'trusted-shop-sidebar',
		'description'   => esc_html__( 'Sidebar for WooCommerce pages.', 'trusted' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Bar', 'trusted' ),
		'id'            => 'trusted-top-bar',
		'description'   => esc_html__( 'Add your own content above the header.', 'trusted' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<b>',
		'after_title'   => '</b>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'trusted' ),
		'id'            => 'trusted-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'trusted' ),
		'id'            => 'trusted-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'trusted' ),
		'id'            => 'trusted-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Middle Footer', 'trusted' ),
		'id'            => 'trusted-about-footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

}
add_action( 'widgets_init', 'trusted_widgets_init' );

if ( ! function_exists( 'trusted_fonts_url' ) ) :
/**
 * Register Google fonts for Trusted
 * @return string Google fonts URL for the theme
 */
function trusted_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'trusted' ) ) {

		$fonts[] = get_theme_mod( 'font_header', 'Ubuntu:300,400,500,700' );
		$fonts[] = get_theme_mod( 'font_nav', 'Hind:300,400,500,600,700' );
		$fonts[] = get_theme_mod( 'font_page_title', 'Ubuntu:300,400,500,700' );
		$fonts[] = get_theme_mod( 'font_content', 'Open Sans:300,400,600,700,800' );
		$fonts[] = get_theme_mod( 'font_headings', 'Montserrat:400,700' );
		$fonts[] = get_theme_mod( 'font_footer', 'Hind:300,400,500,600,700' );

	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'trusted' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' =>  urlencode( implode( '|', array_unique($fonts) ) ),
			'subset' =>  urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return esc_url_raw($fonts_url);
}
endif;

if ( ! function_exists( 'trusted_editor_fonts_url' ) ) :
/**
 * Register Google fonts for Trusted
 * @return string Google fonts URL for the tinyMCE editor
 */
function trusted_editor_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google fonts: on or off', 'trusted' ) ) {

		$fonts[] = get_theme_mod( 'font_content', 'Open Sans:300,400,600,700,800' );
		$fonts[] = get_theme_mod( 'font_headings', 'Montserrat:400,700' );

	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'trusted' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' =>  urlencode( implode( '|', array_unique($fonts) ) ),
			'subset' =>  urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return esc_url_raw($fonts_url);
}
endif;

/**
 * Enqueue scripts and styles.
 */
function trusted_scripts() {
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.3', true );
	wp_enqueue_script( 'trusted-custom', get_template_directory_uri() . '/js/trusted-custom.js', array( 'jquery' ), '1.1', true );
	wp_enqueue_style( 'trusted-fonts', trusted_fonts_url(), array(), null );
	if ( get_theme_mod( 'animate_on' ) ) {
		wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.js', array( 'jquery' ), '20170103', true);
	}
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.7.0' );
	wp_enqueue_style( 'trusted-style', get_stylesheet_uri() );
	wp_add_inline_style( 'trusted-style', trusted_dynamic_style() );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'trusted_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/functions/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/functions/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/functions/customizer.php';

/**
 * Load Woocommerce additions.
 */
require get_template_directory() . '/functions/woocommerce-functions.php';

/**
 * Theme help page.
 */
if ( is_admin() ) {
	require get_template_directory() . '/functions/theme-help.php';
}