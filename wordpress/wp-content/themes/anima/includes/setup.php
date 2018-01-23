<?php
/*
 * Theme setup functions. Theme initialization, add_theme_support(), widgets, navigation
 *
 * @package Anima
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
add_action( 'template_redirect', 'anima_content_width' );

/** Tell WordPress to run anima_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'anima_setup' );


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function anima_setup() {

	add_filter( 'anima_theme_options_array', 'anima_lpbox_width' );

	$options = cryout_get_option();

	// This theme styles the visual editor with editor-style.css to match the theme style.
	if ($options['anima_editorstyles']) add_editor_style( 'resources/styles/editor-style.css' );

	// Support title tag since WP 4.1
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add HTML5 support
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Add post formats
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'audio', 'video' ) );

	// Make theme available for translation
	load_theme_textdomain( 'anima', get_template_directory() . '/languages' );
	load_textdomain( 'cryout', '' );

	// This theme allows users to set a custom backgrounssd
	add_theme_support( 'custom-background' );

	// This theme supports WordPress 4.5 logos
	add_theme_support( 'custom-logo', array( 'height' => (int) $options['anima_headerheight'], 'width' => 240, 'flex-height' => true, 'flex-width'  => true ) );
	add_filter( 'get_custom_logo', 'anima_filter_wp_logo_img' );

	// This theme uses wp_nav_menu() in 3 locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'anima' ),
		'sidebar' => __( 'Left Sidebar', 'anima' ),
		'footer'  => __( 'Footer Navigation', 'anima' ),
		'socials' => __( 'Social Icons', 'anima' ),
	) );

	$falign = explode( ' ', $options['anima_falign'] );
	if (!is_array($falign)) $falign = array( 'center', 'center' ); //failsafe

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(
		// default Post Thumbnail dimensions
		apply_filters( 'anima_thumbnail_image_width', anima_featured_width() ),
		apply_filters( 'anima_thumbnail_image_height', $options['anima_fheight'] )
	);
	// Custom image size for use with post thumbnails
	add_image_size( 'anima-featured',
		ceil($options['anima_sitewidth']), //apply_filters( 'anima_featured_image_width', anima_featured_width() ),
		apply_filters( 'anima_featured_image_height', $options['anima_fheight'] ),
		false
	);

	// Additional responsive image sizes
	add_image_size( 'anima-featured-full',
		apply_filters( 'anima_featured_image_full_width', ceil($options['anima_sitewidth']) ),
		apply_filters( 'anima_featured_image_full_height', $options['anima_fheight'] ),
		$falign
	);
	add_image_size( 'anima-featured-half',
		apply_filters( 'anima_featured_image_half_width', 800 ),
		apply_filters( 'anima_featured_image_falf_height', $options['anima_fheight'] ),
		$falign
	);
	add_image_size( 'anima-featured-third',
		apply_filters( 'anima_featured_image_third_width', 512 ),
		apply_filters( 'anima_featured_image_third_height', $options['anima_fheight'] ),
		$falign
	);

	// Boxes image sizes
	add_image_size( 'anima-lpbox-1', $options['anima_lpboxwidth1'], $options['anima_lpboxheight1'], true );
	add_image_size( 'anima-lpbox-2', $options['anima_lpboxwidth2'], $options['anima_lpboxheight2'], true );

	// Add support for flexible headers
	add_theme_support( 'custom-header', array(
		'flex-height' 	=> true,
		'height'		=> (int) $options['anima_headerheight'],
		'flex-width'	=> true,
		'width'			=> 1920,
		'default-image'	=> get_template_directory_uri() . '/resources/images/headers/glasses.jpg',
		'video'         => true,
	));

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'glasses' => array(
			'url' => '%s/resources/images/headers/glasses.jpg',
			'thumbnail_url' => '%s/resources/images/headers/glasses.jpg',
			'description' => __( 'glasses', 'anima' )
		),
		'laptop' => array(
			'url' => '%s/resources/images/headers/laptop.jpg',
			'thumbnail_url' => '%s/resources/images/headers/laptop.jpg',
			'description' => __( 'laptop', 'anima' )
		),
	) );

	// WooCommerce compatibility
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

} // anima_setup()

/*
 * Have two textdomains work with translation systems.
 * https://gist.github.com/justintadlock/7ac29ae26c78d0
 */
function anima_override_load_textdomain( $override, $domain ) {
	// Check if the domain is our framework domain.
	if ( 'cryout' === $domain ) {
		global $l10n;
		// If the theme's textdomain is loaded, assign the theme's translations
		// to the framework's textdomain.
		if ( isset( $l10n[ 'anima' ] ) )
			$l10n[ $domain ] = $l10n[ 'anima' ];
		// Always override.  We only want the theme to handle translations.
		$override = true;
	}
	return $override;
}
add_filter( 'override_load_textdomain', 'anima_override_load_textdomain', 10, 2 );

/*
 * Remove inline logo styling
 */
function anima_filter_wp_logo_img ( $input ) {
	return preg_replace( '/(height=".*?"|width=".*?")/i', '', $input );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function anima_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'anima_page_menu_args' );

/** Main menu */
function anima_main_menu() { ?>
	<div class="skip-link screen-reader-text">
		<a href="#main" title="<?php esc_attr_e( 'Skip to content', 'anima' ); ?>"> <?php _e( 'Skip to content', 'anima' ); ?> </a>
	</div>
	<?php
	wp_nav_menu( array(
		'container'		=> '',
		'menu_id'		=> 'prime_nav',
		'menu_class'	=> '',
		'theme_location'=> 'primary',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>',
		'items_wrap'	=> '<div><ul id="%s" class="%s">%s</ul></div>'

	) );
} // anima_main_menu()
add_action ( 'cryout_access_hook', 'anima_main_menu' );

/** Mobile menu */
function anima_mobile_menu() {
	wp_nav_menu( array(
		'container'		=> '',
		'menu_id'		=> 'mobile-nav',
		'menu_class'	=> '',
		'theme_location'=> 'primary',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>',
		'items_wrap'	=> '<div><ul id="%s" class="%s">%s</ul></div>'
	) );
} // anima_mobile_menu()
add_action ( 'cryout_mobilemenu_hook', 'anima_mobile_menu' );

/** Left sidebar menu */
function anima_sidebar_menu() {
	if ( has_nav_menu( 'sidebar' ) )
		wp_nav_menu( array(
			'container'			=> 'nav',
			'container_class'	=> 'sidebarmenu',
			'theme_location'	=> 'sidebar',
			'depth'				=> 1
		) );
} // anima_sidebar_menu()
add_action ( 'cryout_before_primary_widgets_hook', 'anima_sidebar_menu' , 10 );

/** Footer menu */
function anima_footer_menu() {
	if ( has_nav_menu( 'footer' ) )
		wp_nav_menu( array(
			'container' 		=> 'nav',
			'container_class'	=> 'footermenu',
			'theme_location'	=> 'footer',
			'after'				=> '<span class="sep">-</span>',
			'depth'				=> 1
		) );
} // anima_footer_menu()
add_action ( 'cryout_footer_hook', 'anima_footer_menu' , 10 );

/** SOCIALS MENU */
function anima_socials_menu( $location ) {
	if ( has_nav_menu( 'socials' ) )
		echo strip_tags(
			wp_nav_menu( array(
				'container' => 'nav',
				'container_class' => 'socials',
				'container_id' => $location,
				'theme_location' => 'socials',
				'link_before' => '<span>',
				'link_after' => '</span>',
				'depth' => 0,
				'items_wrap' => '%3$s',
				'walker' => new Cryout_Social_Menu_Walker(),
				'echo' => false,
			) ),
		'<a><div><span><nav>'
		);
} //anima_socials_menu()
function anima_socials_menu_header() { anima_socials_menu( 'sheader' ); }
function anima_socials_menu_footer() { anima_socials_menu( 'sfooter' ); }
function anima_socials_menu_left()   { anima_socials_menu( 'sleft' );   }
function anima_socials_menu_right()  { anima_socials_menu( 'sright' );  }

/* Socials hooks moved to master hook in core.php */

/**
 * Register widgetized areas defined by theme options.
 * Uses cryout_widgets_init() from cryout/widget-areas.php
 */
function cryout_widgets_init() {
	$areas = cryout_get_theme_structure( 'widget-areas' );
	if ( ! empty( $areas ) ):
		foreach ( $areas as $aid => $area ):
			register_sidebar( array(
				'name' 			=> $area['name'],
				'id' 			=> $aid,
				'description' 	=> ( isset( $area['description'] ) ? $area['description'] : '' ),
				'before_widget' => $area['before_widget'],
				'after_widget' 	=> $area['after_widget'],
				'before_title' 	=> $area['before_title'],
				'after_title' 	=> $area['after_title'],
			) );
		endforeach;
	endif;
} // cryout_widgets_init()
add_action( 'widgets_init', 'cryout_widgets_init' );

/**
 * Creates different class names for footer widgets depending on their number.
 * This way they can fit the footer area.
 */
function anima_footer_colophon_class() {
	$opts = cryout_get_option( array( 'anima_footercols', 'anima_footeralign' ) );
	$class = '';
	switch ( $opts['anima_footercols'] ) {
		case '0': 	$class = 'all';		break;
		case '1':	$class = 'one';		break;
		case '2':	$class = 'two';		break;
		case '3':	$class = 'three';	break;
		case '4':	$class = 'four';	break;
	}
	if ( !empty($class) ) echo 'class="footer-' . $class . ' ' . ( $opts['anima_footeralign'] ? 'footer-center' : '' ) . '"';
} // anima_footer_colophon_class()

/**
 * Set up widget areas
 */
function anima_widget_header() {
	if ( is_active_sidebar( 'widget-area-header' ) ) { ?>
		<aside id="header-widget-area" <?php cryout_schema_microdata( 'sidebar' );?>>
			<?php dynamic_sidebar( 'widget-area-header' ); ?>
		</aside><?php
	}
} // anima_widget_header()

function anima_widget_before() {
	if ( is_active_sidebar( 'content-widget-area-before' ) ) { ?>
		<aside class="content-widget content-widget-before" <?php cryout_schema_microdata( 'sidebar' );?>>
			<?php dynamic_sidebar( 'content-widget-area-before' ); ?>
		</aside><!--content-widget--><?php
	}
} //anima_widget_before()

function anima_widget_after() {
	if ( is_active_sidebar( 'content-widget-area-after' ) ) { ?>
		<aside class="content-widget content-widget-after" <?php cryout_schema_microdata( 'sidebar' );?>>
			<?php dynamic_sidebar( 'content-widget-area-after' ); ?>
		</aside><!--content-widget--><?php
	}
} //anima_widget_after()
add_action ('cryout_header_widget_hook',  'anima_widget_header');
add_action ('cryout_before_content_hook', 'anima_widget_before');
add_action ('cryout_after_content_hook',  'anima_widget_after');

/* ajax frontpage read more button hooks */
/* if (  'posts' == get_option( 'show_on_front' )) add_action('pre_get_posts', 'cryout_query_offset', 1 );
if (  'posts' == get_option( 'show_on_front' )) add_action('template_redirect', 'cryout_ajax_init'); */

/* FIN */
