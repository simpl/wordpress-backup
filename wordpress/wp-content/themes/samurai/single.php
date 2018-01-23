<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

				if( is_active_sidebar( 'sidebar-7' ) ) :
					dynamic_sidebar( 'sidebar-7' );
				endif;
	    	?>
	        <section class="single_post">
	    		<div class="single_post_inner">
	                <?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'single' );

							the_post_navigation( array(
									'prev_text'	=> esc_html__( '&larr; %title', 'samurai' ),
				            		'next_text'	=> esc_html__( '%title &rarr;', 'samurai' ),
								)
							);
					?>
							<div class="author_credits wow animated fadeInUp">
			                    <div class="row">
			                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			                            <div class="postauthor_featured_image">
			                            	<?php echo get_avatar( get_the_author_meta( 'ID' ), 512 ); ?>
			                            </div>
			                        </div>
			                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			                            <div class="postauthor_desc_inner">
			                                <div class="post_author_name">
			                                    <strong><?php the_author(); ?></strong>
			                                </div>
			                                <div class="post_author_bio">
			                                    <p><?php the_author_meta( 'description' ); ?></p>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                    <!-- // row -->
			                </div>
			                <!-- // author_credits -->
			        <?php
			               	/**
							* Hook - samurai_related_posts.
							*
							* @hooked samurai_related_posts_action - 10
							*/
							do_action( 'samurai_related_posts' );
			                

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
					?>
	            </div>
	            <!-- // single_post_inner -->
	        </section>
	        <?php
	        	if( is_active_sidebar( 'sidebar-8' ) ) :
					dynamic_sidebar( 'sidebar-8' );
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

