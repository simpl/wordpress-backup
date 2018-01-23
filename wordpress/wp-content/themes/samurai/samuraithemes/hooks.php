<?php
/**
 * Load hooks.
 *
 * @package Samurai
 */

/*======================================================
			Breadcrumb hook of the theme
======================================================*/
if( !function_exists( 'samurai_breadcrumb_action' ) ) :
	/**
     * Breadcrumb of the theme.
     *
     * @since 1.0.0
     */
	function samurai_breadcrumb_action() {
	?>
		<section class="breadcrumb">
            <div class="breadcrumb_inner">
                <?php
	                $breadcrumb_args = array(
	                    'show_browse' => false,
	                    'separator' => '&nbsp;',
	                    'post_taxonomy' => array(
	                        'post' => 'category'
	                    )                        
	                );
	                samurai_breadcrumb_trail( $breadcrumb_args );
	            ?>
            </div>
            <!-- // breadcrumb_inner -->
        </section>
	<?php
	}
endif;
add_action( 'samurai_breadcrumb', 'samurai_breadcrumb_action', 10 );

/*======================================================
			Pagination hook of the theme
======================================================*/
if( !function_exists( 'samurai_pagination_action' ) ) :
	/**
     * Pagination of the theme.
     *
     * @since 1.0.0
     */
	function samurai_pagination_action() {
	?>
		<div class="pagination_wrapper">
	        <div class="row">
	            <div class="col-xs-12">
	            	<?php
						the_posts_pagination( 
							array(
								'mid_size' 	=> 2,
								'prev_text' => esc_html__( '&lt;', 'samurai' ),
								'next_text' => esc_html__( '&gt;', 'samurai' ),
							) 
						);
					?>
	            </div>
	        </div>
	    </div>
	<?php
	}
endif;
add_action( 'samurai_pagination', 'samurai_pagination_action', 10 );

if( !function_exists( 'samurai_related_posts_action' ) ) :

	/**
	 * Related posts.
	 *
	 * @package Magazine_Point
	 */
	function samurai_related_posts_action() {

		$qargs = array(
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
			'posts_per_page'	  => 3,
		);

		$current_object = get_queried_object();

		if ( $current_object instanceof WP_Post ) {
			$current_id = $current_object->ID;

			if ( absint( $current_id ) > 0 ) {
				// Exclude current post.
				$qargs['post__not_in'] = array( absint( $current_id ) );

				// Include current posts categories.
				$categories = wp_get_post_categories( $current_id );
				if ( ! empty( $categories ) ) {
					$qargs['tax_query'] = array(
						array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $categories,
							'operator' => 'IN',
							)
						);
				}
			}
		}

		$related_posts = new WP_Query( $qargs );?>
		<?php
			if( $related_posts->have_posts() ):
		?>
				<div class="related_posts_inner">
	                <div class="related_post_heading">
	                    <strong><?php echo esc_html__( 'You might also like', 'samurai' ); ?></strong>
	                </div>
	                <div class="row">
						<?php
							while( $related_posts->have_posts() ) :
								$related_posts->the_post();
						?>
	                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                            <div class="related_post_items wow animated fadeInUp">
	                            	<?php
	                            		if( has_post_thumbnail() ) :
	                            	?>
			                                <div class="related_post_fimage">
			                                	<?php the_post_thumbnail( 'samurai-thumbnail-1' ); ?>
			                                    <div class="content_featured_image_mask">
			                                    </div>
			                                </div>
			                        <?php
			                        	endif;
			                        ?>
	                                <!-- // related_post_fimage -->
	                                <div class="related_post_title">
	                                    <h3>
	                                    	<a href="<?php the_permalink(); ?>">
	                                    		<?php the_title(); ?>
	                                    	</a>
	                                    </h3>
	                                </div>
	                            </div>
	                            <!-- // related_post_items -->
	                        </div>
	                        <!-- // col 4 and 12 for xs -->
	                    <?php
	                    	endwhile;
	                    	wp_reset_postdata();
	                    ?>
	                    </div>
	                </div>
		<?php
			endif;
	}
endif;
add_action( 'samurai_related_posts', 'samurai_related_posts_action', 10 );

