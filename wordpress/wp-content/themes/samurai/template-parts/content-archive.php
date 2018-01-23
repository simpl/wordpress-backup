<?php
/**
 * Template part for displaying results in archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Samurai
 */
	$class = "col-sm-7";
?>
	<div class="recent_post_inner wow animated fadeInUp">
	    <div class="row">
	    	<?php
	    		if( has_post_thumbnail() ) :
	    	?>
	        <div class="col-sm-5 col-xs-12">
	            <div class="recent_post_featured_image">
	               	<?php
	               		the_post_thumbnail( 'samurai-thumbnail-1', array( 'class' => 'img-responsive' ) );
	               	?>
	                <div class="content_featured_image_mask"></div>
	            </div>
	            <!-- // recent_post_featured_image -->
	        </div>
	        <?php
	        	endif;
	        ?>
	        <div class="<?php if( has_post_thumbnail() ) { echo esc_attr( $class ); } ?> col-xs-12">
	        	<?php
	        		if( 'post' === get_post_type() ) :
	        	?>
		            <div class="recent_post_meta">
		                <div class="entry-meta">
							<?php samurai_posted_on(); ?>
						</div><!-- .entry-meta -->
						<footer class="entry-footer">
							<?php samurai_entry_footer(); ?>
						</footer><!-- .entry-footer -->
		            </div>
	            <!-- // revent post meta -->
	            <?php
	            	endif;
	            ?>
	            <div class="recent_post_title">
	                <h3>
	                	<a href="<?php the_permalink(); ?>">
	                		<?php the_title(); ?>
	                	</a>
	                </h3>
	            </div>
	            <div class="recent_post_content">
	                <?php
	                	the_excerpt();
	                ?>
	            </div>
	        </div>
	    </div>
	</div>