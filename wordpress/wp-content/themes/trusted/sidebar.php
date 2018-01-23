<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Trusted
 */

if ( ! is_active_sidebar( 'trusted-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'trusted-sidebar' ); ?>
</div><!-- #secondary -->
