<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Samurai
 */

get_header(); ?>

	<div class="row">
	    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	        	<?php
		    		/**
					* Hook - samurai_breadcrumb.
					*
					* @hooked samurai_breadcrumb_action - 10
					*/
					do_action( 'samurai_breadcrumb' );
		    	?>
		        <section class="single_post">
		    		<div class="single_post_inner">
		                <?php
							
								get_template_part( 'template-parts/content', 'woo' );
							
						?>
		            </div>
		            <!-- // single_post_inner -->
		        </section>
	    </div>
	    <!-- // col 8 and 12 ( main left col for content area)-->
	    <?php 
	    	get_sidebar('shop');
	    ?>
	</div>
<?php
	get_footer();
