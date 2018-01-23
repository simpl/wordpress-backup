<?php

/**
 * Sanitize Sidebar custom dropdown.
 * @param $input
 * @return string
 */
function samurai_sanitize_sidebar( $input ) {
	$valid = array(
		'left'   => 'Left',
		'right'  => 'Right',
		'none'	 => 'None',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}