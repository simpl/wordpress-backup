<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Samurai
 */

?>
	</div>
	<footer class="footer">
	    <div class="container">
	        <div class="footer_inner">
	            <div class="row">
	            	<?php
	            		if( is_active_sidebar( 'sidebar-2' ) ) :
	            			dynamic_sidebar( 'sidebar-2' );
	            		endif;
	            	?>
	            </div>
	            <!-- // footer main row -->
	        </div>
	        <!-- // footer inner -->
	        <div class="footer_buttom">
	            <div class="row">
	            	<?php
	            		$copyright_text		= get_theme_mod( 'samurai_copyright_text', '' );
						if( !empty( $copyright_text ) ) :
	            	?>
			                <div class="col-xs-6">
			                    <div class="copyright_info">
			                        <p><?php echo esc_html( $copyright_text ); ?></p>
			                    </div>
			                </div>
	                <?php
	                	endif;
	                	if( has_nav_menu( 'social_menu' ) ) :
	                ?>
	                <div class="col-xs-6">
	                    <div class="footer_social">
	                    	<?php
	                    		wp_nav_menu( array(
	                    			'theme_location'	=> 'social_menu',
	                    			'menu_class'		=> 'footer_social_icons'
	                    		) );
	                    	?>
	                    </div>
	                </div>
	                <?php
	                	endif;
	                ?>
	            </div>
	        </div>
	        <!-- // footer_butttom -->
	    </div>
	    <!-- // container -->
	</footer>

<?php wp_footer(); ?>

</body>
</html>
