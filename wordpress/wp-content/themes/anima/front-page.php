<?php
/**
 * The template for displaying the landing page/blog posts
 * The functions used here can be found in includes/landing-page.php
 *
 * @package Anima
 */

$anima_landingpage = cryout_get_option( 'anima_landingpage' );

if ( is_page() && ! $anima_landingpage ) { 
	include( get_page_template() );
	return true;
}

if ( 'posts' == get_option( 'show_on_front' ) ) {
	include( get_home_template() );
} else {

	get_header(); ?>

	<div id="container" class="anima-landing-page one-column">
		<main id="main" role="main" class="main">
		<?php

		if ( $anima_landingpage ) {
			anima_lpslider();
			anima_lpblocks();
			anima_lptext('one');
			anima_lpboxes(1);
			anima_lptext('two');
			anima_lpboxes(2);
			anima_lptext('three');
			anima_lpindex();
			anima_lptext('four');
		} else {
			anima_lpindex();
		}

		?>
		</main><!-- #main -->
		<?php if ( ! $anima_landingpage ) { anima_get_sidebar(); } ?>
	</div><!-- #container -->

	<?php get_footer();
} //else !posts
