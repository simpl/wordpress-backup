<?php
if ( is_page_template( 'template-blank-canvas.php' ) ) {
	get_template_part( 'template-blank-canvas' );
	return;
}

get_header();
if ( 'page' == get_option( 'show_on_front' ) ) {

$featured_enable = get_theme_mod( 'featured_enable' );
if($featured_enable){
	trusted_featured_services();
}

$about_enable = get_theme_mod( 'about_enable' );
if($about_enable){
	trusted_about_section();
}

$woo_home_enable = get_theme_mod( 'woo_home_enable' );
if($woo_home_enable){
	trusted_woo_tabs();
}

$front_page_content_off = get_theme_mod( 'front_page_content_off' );
if(!$front_page_content_off){
	if ( ! is_active_sidebar( 'trusted-homepage-sidebar' ) ) {
		$page_full_width = ' full-width';
	} else {
		$page_full_width = '';
	}
?>

	<div id="primary" class="content-area<?php echo $page_full_width;?>">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar( 'homepage' );
}

} else {

if ( ! is_active_sidebar( 'trusted-sidebar' ) ) {
	$page_full_width = ' full-width';
} else {
	$page_full_width = '';
}
?>

	<div id="primary" class="content-area<?php echo $page_full_width;?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content' ); ?>

			<?php endwhile; ?>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php
}
get_footer(); ?>