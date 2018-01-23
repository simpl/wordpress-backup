<?php
/**
 * Ajax read more homepage functionality
 *
 * @package Cryout Framework
 * @since Cryout Framework 0.5.1
*/

if (! function_exists( 'cryout_ajax_init' ) ):
function cryout_ajax_init() {
	// loading theme structure identifiers
	$identifiers = cryout_get_theme_structure( 'theme_identifiers' );
	// loading theme settings
	$options = cryout_get_option( array(
		_CRYOUT_THEME_NAME . '_landingpage',
		_CRYOUT_THEME_NAME . '_frontpostscount'
	) );

	if( is_front_page() && cryout_is_true( $options[_CRYOUT_THEME_NAME . '_landingpage'] ) ) {
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$the_query = new WP_Query(
				array( 'posts_per_page' => $options[_CRYOUT_THEME_NAME . '_frontpostscount'], 'paged' => $paged )
				);
	} else {
		return;
	}

	// enqueue js
	wp_enqueue_script(
		'cryout_ajax_more',
		get_template_directory_uri(). '/resources/js/ajax.js',
		array('jquery'),
		_CRYOUT_THEME_VERSION,
		true
	);

	// Max number of pages
	$page_number_max = $the_query->max_num_pages;

	// Next page to load
	$page_number_next = (get_query_var('paged') > 1) ? get_query_var('paged') + 1 : 2;

	// Add some parameters for the JS.
	wp_localize_script(
		'cryout_ajax_more',
		'cryout_ajax_more',
		array(
			'page_number_next' => $page_number_next,
			'page_number_max' => $page_number_max,
			'page_link_model' => get_pagenum_link(9999999),
			'load_more_str' => cryout_get_option( $identifiers['load_more_optid'] ),
			'content_css_selector' => $identifiers['content_css_selector'],
			'pagination_css_selector' =>  $identifiers['pagination_css_selector'],
		)
	);
} // cryout_ajax_init()
endif;

if ( ! function_exists( 'cryout_query_offset' ) ):
function cryout_query_offset(&$query) {

	$options = cryout_get_option( array(
		_CRYOUT_THEME_NAME . '_frontpage',
		_CRYOUT_THEME_NAME . '_frontpostscount'
	) );

	if ( !is_front_page() || !cryout_is_true($options[_CRYOUT_THEME_NAME . '_frontpage']) )  {
		return;
	}

    //Determine how many posts per page you want (we'll use WordPress's settings)
    $ppp = $options[_CRYOUT_THEME_NAME . '_frontpostscount'];

    //Detect and handle pagination...
    if ( $query->is_paged ) {

        //Manually determine page query offset (offset + current page (minus one) x posts per page)
        $page_offset =  ($query->query_vars['paged']-1) * $ppp ;

        //Apply adjust page offset
        $query->set('offset', $page_offset );

    }
    else {

        //This is the first page. No offset
        $query->set('offset',0);

    }
} // cryout_query_offset()
endif;

//if ( 'posts' == get_option( 'show_on_front' )) add_action( 'pre_get_posts', 'cryout_query_offset', 1 );
if ( 'posts' == get_option( 'show_on_front' )) add_action( 'template_redirect', 'cryout_ajax_init' );

// FIN
