<?php
/**
 * The template for displaying the footer
 *
 * @package Trusted
 */

?>
	</div><!-- .container -->
<?php
if ( is_front_page() ) {
	$cta_enable = get_theme_mod( 'cta_enable' );
	if($cta_enable){
		trusted_cta_section();
	}
}
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if(is_active_sidebar( 'trusted-footer1' ) || is_active_sidebar( 'trusted-footer2' ) || is_active_sidebar( 'trusted-footer3' ) ): ?>
		<div id="top-footer">
			<div class="container">
				<div class="top-footer clearfix">
					<div class="footer footer1<?php trusted_sidebar_reveal( 'fadeInRight' ); ?>">
						<?php if(is_active_sidebar( 'trusted-footer1' )): 
							dynamic_sidebar( 'trusted-footer1' );
						endif;
						?>	
					</div>

					<div class="footer footer2<?php trusted_sidebar_reveal( 'fadeInDown' ); ?>">
						<?php if(is_active_sidebar( 'trusted-footer2' )): 
							dynamic_sidebar( 'trusted-footer2' );
						endif;
						?>	
					</div>

					<div class="footer footer3<?php trusted_sidebar_reveal( 'fadeInLeft' ); ?>">
						<?php if(is_active_sidebar( 'trusted-footer3' )): 
							dynamic_sidebar( 'trusted-footer3' );
						endif;
						?>	
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if(is_active_sidebar( 'trusted-about-footer' )): ?>
		<div id="middle-footer">
			<div class="container<?php trusted_sidebar_reveal( 'fadeInUp' ); ?>">
				<?php 
					dynamic_sidebar( 'trusted-about-footer' );
				?>
			</div>
		</div>
		<?php endif; ?>

		<div id="bottom-footer">
			<div class="container clearfix">
				<?php trusted_powered_by(); ?>

				<?php wp_nav_menu( array( 
                	'theme_location' => 'footer',
                	'container_id' => 'footer-menu',
                	'menu_id' => 'footer-menu', 
                	'menu_class' => 'trusted-footer-nav',
                	'depth' => 1,
                	'fallback_cb' => '',
				) ); ?>

			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
