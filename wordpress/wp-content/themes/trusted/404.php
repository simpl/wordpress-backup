<?php
/**
 * The template for displaying 404 page
 *
 * @package Trusted
 */

get_header();
?>

	<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'trusted' ); ?></p>

	<p><?php esc_html_e( 'Maybe try a search?', 'trusted' ); ?> <?php get_search_form(); ?></p>

	<p><?php esc_html_e( 'Browse our pages.', 'trusted' ); ?></p>
	<ul>
	<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
	</ul>

<?php get_footer(); ?>
