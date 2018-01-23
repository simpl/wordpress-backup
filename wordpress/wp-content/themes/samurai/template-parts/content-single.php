<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Samurai
 */
?>	
	
	                <div class="singlepost_title wow animated fadeInUp">
	                    <h2><?php the_title(); ?></h2>
	                </div>
	                <!-- // post title -->
	                <div class="singlepost_meta">
	                    <div class="entry-meta">
							<?php samurai_posted_on(); ?>
						</div><!-- .entry-meta -->
	                </div>
	                <!-- // meta -->
	                <?php
	                	if( has_post_thumbnail() ) : 
	                ?>
		                <div class="singlepost_featured_image wow animated fadeInUp">
		                    <?php the_post_thumbnail( 'full', array( 'class' => 'img-reponsive' ) ); ?>
		                    <div class="content_featured_image_mask">
		                    </div>
		                </div>
	                <?php
	                	endif;
	                ?>
	                <!-- // singlepost_featured_image -->
	                <div class="singlepost_the_content wow animated fadeInUp">
	                    <?php
	                    	the_content();

	                    	wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'samurai' ),
								'after'  => '</div>',
							) );
	                    ?>
	                </div>
	                <div class="post_tags wow animated fadeInUp">
	                    <span class="post_tags_title">
							<?php samurai_entry_footer(); ?>
	                    </span> 
	                </div>