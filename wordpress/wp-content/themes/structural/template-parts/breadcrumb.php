<?php
/**
 * The template used for displaying page breadcrumb
 *
 * @package Structural
 */

 $breadcrumb = get_theme_mod( 'breadcrumb',true ); 
if( !is_front_page() ): ?>
	<div class="breadcrumb"> 
		<div class="container"><?php
		    if( !is_search() && !is_archive() && !is_404() ) : ?>
				<div class="sixteen columns">
					<?php the_title('<h2>','</h2>');?>	
					<?php if( $breadcrumb ) : ?>	
						<div class="breadcrumb-text">	
							<span class="txt-bread"><?php _e('You are here:','structural');?></span>
							<?php structural_breadcrumbs(); ?>
						</div>
					<?php endif; ?>
				</div><?php
			endif; ?>
			
		</div>
	</div><?php  
endif;