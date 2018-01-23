<?php
/**
 * Template Name: Blank Canvas
 *
 * A page template with no page title or sidebar, containing only the masthead and footer, ideal for use with page builder plugins
 * @package Trusted
 */

get_header();
?>
	<header class="blank-canvas-header">
	</header><!-- .entry-header -->
	<div class="container clearfix">

	<div id="primary" class="content-area full-width">
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

<?php get_footer(); ?>
