<?php
/**
 * Adds random images to the demo preview
 *
 * @package anima
 */

// pseudo randomness array
$anima_demo_randomness = array( 6, 8, 1, 5, 2, 9, 7, 3, 4, 10 );
// current element index
$anima_demo_index = 0;

// Return URL of a random demo image
function anima_demo_image_src(){
	global $anima_demo_randomness;
	global $anima_demo_index;

	if ( $anima_demo_index >= count( $anima_demo_randomness ) ) $anima_demo_index=0; // reset when randomness array used up

	$filename = "{$anima_demo_randomness[$anima_demo_index]}.jpg";

	$anima_demo_index++;

	return get_template_directory_uri() . '/resources/images/demo/' . $filename;
} // anima_demo_image_src()

// Filter thumbnail image and return sample image if no thumbnail exists
function anima_demo_thumbnail( $input ) {
	if ( empty( $input ) ) {
		return anima_demo_image_src();
	}
	return $input;
} // anima_demo_thumbnail()

// Check if running on the demo
function anima_is_demo() {
	$current_theme = wp_get_theme();
	$theme_name = $current_theme->get( 'TextDomain' );
	$active_theme = anima_get_wp_option( 'template' );
	return apply_filters( 'anima_is_demo', ( $active_theme != strtolower( $theme_name ) && ! is_child_theme() ) );
} // anima_is_demo()

// Read WordPress options
function anima_get_wp_option( $opt_name ) {
	$alloptions = wp_cache_get( 'alloptions', 'options' );
	$alloptions = maybe_unserialize( $alloptions );
	return isset( $alloptions[ $opt_name ] ) ? maybe_unserialize( $alloptions[ $opt_name ] ) : false;
} // anima_get_wp_option()

// Apply the filter
if ( anima_is_demo() ) { add_filter( 'anima_preview_img_src', 'anima_demo_thumbnail' ); }

// FIN
