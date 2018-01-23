<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Samurai
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <aside class="right_sidebar">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </aside>
        <!-- // aside right_sidebar -->
    </div>