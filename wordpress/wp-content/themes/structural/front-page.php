<?php
/**
 * The front page template file.
 *
 *
 * @package Structural
 */
 
if ( 'posts' == get_option( 'show_on_front' ) ) { 
	get_template_part('index');
} else {

	 
    get_header(); 

	$slider_cat = get_theme_mod( 'slider_cat' );
	$slider_count = get_theme_mod( 'slider_count', 5 );   
	$slider_posts = array(   
		'cat' => absint($slider_cat),
		'posts_per_page' => intval($slider_count)              
	);

	$home_slider = get_theme_mod('slider_field',true); 
	if( $home_slider ):
		if ( $slider_cat ) {
			$query = new WP_Query($slider_posts);        
			if( $query->have_posts()) : ?> 
				<div class="flexslider free-flex">  
					<ul class="slides">
						<?php while($query->have_posts()) :
								$query->the_post();
								if( has_post_thumbnail() ) : ?>
								    <li>
								    	<div class="flex-image">
								    		<?php the_post_thumbnail('full'); ?>
								    	</div>
								    	<div class="flex-caption">
								    		<?php the_content( __('Read More','structural') ); 
									    	wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages: ', 'structural' ),
												'after'  => '</div>',
											) ); ?>
								    	</div>
								    </li>
							    <?php endif;?>			   
						<?php endwhile; ?>
					</ul>
				</div>
		
			<?php endif; ?>
		   <?php  
			$query = null;
			wp_reset_postdata();
			
		}
    endif; ?>
   	<?php do_action( 'structural_after_slider_part' );?>

   	<?php

	if( get_theme_mod('enable_recent_post_service',true) ) :
	   	do_action('structural_recent_post_before');
		structural_recent_posts(); 
	    do_action('structural_recent_post_after');
    endif;

    if( get_theme_mod('page_content_status',false ) ) {   ?>
		<div id="content" class="site-content">
			<div class="container">
				<main id="main" class="site-main" role="main"><?php
					while ( have_posts() ) : the_post();       
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages: ', 'structural' ),
							'after'  => '</div>',
						) );
					endwhile; ?>
			    </main><!-- #main -->
		    </div><!-- #primary -->
		</div>
    <?php }
    get_footer();

}
