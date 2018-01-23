<?php 

/**
 * Enqueue scripts and styles.  
 */
function structural_scripts() {    
	wp_enqueue_style( 'structural-montserrat', structural_theme_font_url('Montserrat:400,500,600,700'), array(), 20141212 );
	wp_enqueue_style( 'structural-open-sans-pro', structural_theme_font_url('Open Sans:300,400,600,700,800'), array(), 20141212 );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), 20150224 );
	wp_enqueue_style( 'jquery-flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), 20150224 );
	wp_enqueue_style( 'structural-style', get_template_directory_uri() . '/style.css');

	wp_enqueue_script( 'structural-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'structural-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );   
	}

	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.4.0', true );
	wp_enqueue_script( 'structural-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'structural_scripts' );       

/**
 * Register Google fonts.
 *
 * @return string
 */
function structural_theme_font_url($font) {       
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Font, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Font: on or off', 'structural' ) ) {   
		$font_url = esc_url( add_query_arg( 'family', urlencode($font), "//fonts.googleapis.com/css" ) );
	}

	return $font_url;
}

function structural_admin_enqueue_scripts( $hook ) {  
	//if( strpos($hook, 'structural_upgrade') ) {
		wp_enqueue_style( 
			'font-awesome', 
			get_template_directory_uri() . '/css/font-awesome.min.css', 
			array(), 
			'4.3.0', 
			'all' 
		);
		wp_enqueue_style( 
			'structural-admin', 
			get_template_directory_uri() . '/admin/css/admin.css', 
			array(), 
			'1.0.0', 
			'all' 
		);
	//}   
	wp_enqueue_script( 
		'structural-customizer-script', 
		get_template_directory_uri() . '/js/admin-custom.js',
		array('jquery'),
		'1.0.0',
		true
	);

}
add_action( 'admin_enqueue_scripts', 'structural_admin_enqueue_scripts' );