<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Samurai
 */

get_header(); ?>

	<div class="row">
		<?php
            $sidebar_position 	= get_theme_mod( 'samurai_sidebar_position', 'right' );
            $class 				= '';
            if( $sidebar_position == 'none' || !is_active_sidebar( 'sidebar-1' ) ) :
            	$class = 'col-md-12';
            else :
            	$class = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
            endif;
            if( $sidebar_position == 'left' ) :
            	get_sidebar();
            endif;
        ?>
	    <div class="<?php echo esc_attr( $class ); ?>">
	    	<?php
	    		/**
				* Hook - samurai_breadcrumb.
				*
				* @hooked samurai_breadcrumb_action - 10
				*/
				do_action( 'samurai_breadcrumb' );

				if( is_active_sidebar( 'sidebar-5' ) ) :
					dynamic_sidbar( 'sidebar-5' );
				endif;
	    	?>
	        <section id="recent_posts">
	            <div class="recent_posts_wrapper">
	                <div class="recent_post_section_heading">
	                	<?php the_archive_title( '<h3>', '</h3>' ); ?>
	                </div>
	                <?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'archive' );

							endwhile;

							/**
						   	* Hook - samurai_pagination.
						   	*
						   	* @hooked samurai_pagination_action - 10
						   	*/
						   	do_action( 'samurai_pagination' );

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; 
					?>
	                
	            </div>
	            <!-- // recent posts wrapper -->
	        </section>
	        <!-- // recent posts -->
	        <?php
	        	if( is_active_sidebar( 'sidebar-6' ) ) :
					dynamic_sidebar( 'sidebar-6' );
				endif;
	        ?>
	    </div>
	    <!-- // col 8 and 12 ( main left col for content area)-->
	    <?php 
	    	if( $sidebar_position == 'right' ) :
	    		get_sidebar();
	    	endif;
	  	?>
	</div>

<?php
get_footer();
