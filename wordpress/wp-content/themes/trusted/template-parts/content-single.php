<?php
/**
 * Template part for displaying single posts
 *
 * @package Trusted
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-meta">
		<?php trusted_posted_on(); ?>
	</div><!-- .entry-meta -->

	<div class="entry-content single-entry-content">
		<?php the_post_thumbnail( 'large' ); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'trusted' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php trusted_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

