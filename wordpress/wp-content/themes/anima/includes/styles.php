<?php
/**
 * Styles and scripts registration and enqueuing
 *
 * @package Anima
 */

/**
 * Loading main styles and scripts
 */
function anima_enqueue_styles() {
	// HTML5 Shiv
	wp_enqueue_script( 'anima-html5shiv', get_template_directory_uri() . '/resources/js/html5shiv.min.js', null, _CRYOUT_THEME_VERSION );
	if ( function_exists( 'wp_script_add_data' ) ) wp_script_add_data( 'anima-html5shiv', 'conditional', 'lt IE 9' );

	$cryout_theme_structure = cryout_get_theme_structure();
	$options = cryout_get_option();

	wp_enqueue_style( 'anima-themefonts', get_template_directory_uri() . '/resources/fonts/fontfaces.css', null, _CRYOUT_THEME_VERSION ); // fontfaces.css

	// Google fonts
	$gfonts = array();
	$roots = array();
	foreach ( $cryout_theme_structure['google-font-enabled-fields'] as $item ) {
		$itemg = $item . 'google';
		$itemw = $item . 'weight';
		// custom font names
		if ( ! empty( $options[$itemg] ) ) {
				$gfonts[] = cryout_gfontclean( $options[$itemg], ":".$options[$itemw] );
				$roots[] = cryout_gfontclean( $options[$itemg] );
		}
		// preset google fonts
		if ( preg_match('/^(.*)\/gfont$/i', $options[$item], $bits ) ) {
				$gfonts[] = cryout_gfontclean( $bits[1], ":".$options[$itemw] );
				$roots[] = cryout_gfontclean( $bits[1] );
		}
	};

	// Enqueue google fonts with subsets separately
	foreach( $gfonts as $i => $gfont ):
		if ( strpos( $gfont, "&" ) === false):
		   // do nothing
		else:
			wp_enqueue_style( 'anima-googlefont' . $i, '//fonts.googleapis.com/css?family=' . $gfont, null, _CRYOUT_THEME_VERSION );
			unset( $gfonts[$i] );
		endif;
	endforeach;

	// Merged google fonts
	if ( count( $gfonts ) > 0 ):
		wp_enqueue_style( 'anima-googlefonts', '//fonts.googleapis.com/css?family=' . implode( "|" , array_unique( array_merge( $roots, $gfonts ) ) ), null, _CRYOUT_THEME_VERSION );
	endif;
	// Main theme style
	wp_enqueue_style( 'anima-main', get_stylesheet_uri(), null, _CRYOUT_THEME_VERSION );
	// RTL style
	if ( is_RTL() ) wp_enqueue_style( 'anima-rtl', get_template_directory_uri() . '/resources/styles/rtl.css', null, _CRYOUT_THEME_VERSION );
	// Theme generated style
	wp_add_inline_style( 'anima-main', preg_replace( "/[\n\r\t\s]+/", " ", anima_custom_styles() ) ); // includes/custom-styles.php

} // anima_enqueue_styles
add_action( 'wp_enqueue_scripts', 'anima_enqueue_styles' );

/* Outputs the author meta link in header */
function anima_author_link() {
	global $post;
	if ( is_single() && get_the_author_meta( 'user_url', $post->post_author ) ) {
		echo '<link rel="author" href="' . get_the_author_meta( 'user_url', $post->post_author ) . '">';
	}
} //anima_author_link()
add_action ( 'wp_head', 'anima_author_link' );

// Adds HTML5 tags for IEs
function anima_header_scripts() {
?>
<!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
</script>
<![endif]-->
<?php
} // anima_header_scripts()
//add_action('wp_head','anima_header_scripts',100);

/**
 * Main theme scripts
 */
function anima_scripts_method() {
	// Boxes aspect ratio
	list( $sitewidth,
		$primarysidebar,
		$secondarysidebar,
		$lpboxrow1,
		$lpboxlayout1,
		$lpboxheight1,
		$lpboxwidth1,
		$lpboxrow2,
		$lpboxlayout2,
		$lpboxheight2,
		$lpboxwidth2,
	) = array_values( cryout_get_option( array(
		'anima_sitewidth',
		'anima_primarysidebar',
		'anima_secondarysidebar',
		'anima_lpboxrow1',
		'anima_lpboxlayout1',
		'anima_lpboxheight1',
		'anima_lpboxwidth1',
		'anima_lpboxrow2',
		'anima_lpboxlayout2',
		'anima_lpboxheight2',
		'anima_lpboxwidth2',
	) ) );

	// Failsafes
	if ( empty( $lpboxheight1 ) ) $lpboxheight1 = 1;
	if ( empty( $lpboxheight2 ) ) $lpboxheight2 = 1;

	$js_options = array(
		'masonry' => cryout_get_option('anima_masonry'),
		'rtl' => ( is_rtl() ? true : false ),
		'magazine' => cryout_get_option('anima_magazinelayout'),
		'fitvids' => cryout_get_option('anima_fitvids'),
		'autoscroll' => cryout_get_option('anima_autoscroll'),
		'articleanimation' => cryout_get_option('anima_articleanimation'),
		'lpboxratio1' => round ( $lpboxwidth1/$lpboxheight1, 3 ),
		'lpboxratio2' => round ( $lpboxwidth2/$lpboxheight2, 3 ),
		'is_mobile' => ( wp_is_mobile() ? true : false ),
	);

	wp_enqueue_script( 'anima-frontend', get_template_directory_uri() . '/resources/js/frontend.js', array( 'jquery' ), _CRYOUT_THEME_VERSION );
	wp_localize_script( 'anima-frontend', 'anima_settings', $js_options );
	if ($js_options['masonry']) wp_enqueue_script( 'jquery-masonry' );

	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
} //anima_scripts_method()
add_action( 'wp_footer', 'anima_scripts_method' );

/**
 * Add defer/sync to scripts
 */
function anima_scripts_filter($tag) {
	$defer = cryout_get_option('anima_defer');
    $scripts_to_defer = array( 'comment-reply.min.js', 'frontend.js', 'masonry.min.js' );
    foreach( $scripts_to_defer as $defer_script ) {
        if( (true == strpos( $tag, $defer_script )) && $defer )
            return str_replace( ' src', ' defer src', $tag ); // ' async defer src' causes issues with masonry
    }
    return $tag;
} //anima_scripts_filter()
add_filter( 'script_loader_tag', 'anima_scripts_filter', 10, 2 );

/**
 * Add responsive meta
 */
function anima_responsive_meta() {
	echo '<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">' . PHP_EOL;
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
} //anima_responsive_meta()
add_action( 'cryout_meta_hook', 'anima_responsive_meta' );

/*
 * anima_editor_styles() is located in custom-styles.php
 */
function anima_add_editor_styles() {
	$editorstyles = cryout_get_option('anima_editorstyles');
	if ( ! $editorstyles ) return;

	add_editor_style( 'resources/styles/editor-style.css' );
	add_editor_style( add_query_arg( 'action', 'anima_editor_styles', admin_url( 'admin-ajax.php' ) ) );
	add_action( 'wp_ajax_anima_editor_styles', 'anima_editor_styles' );
	add_action( 'wp_ajax_no_priv_anima_editor_styles', 'anima_editor_styles' );
}//anima_add_editor_styles
anima_add_editor_styles();
/* FIN */
