<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Structural
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11"><?php
if ( is_singular() && pings_open() ) { ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php
} ?>
<?php wp_head(); ?>
</head>
  
<body <?php body_class(); ?>>  
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'structural' ); ?></a>
	<header id="masthead" class="site-header" role="banner">   
			<?php if( is_active_sidebar( 'top-left' )  || is_active_sidebar( 'top-right' ) ): ?>
				<div class="top-nav">
					<div class="container">		
						<div class="ten columns">
							<div class="cart-left">
								<?php dynamic_sidebar('top-left' ); ?>
							</div>
						</div>
		
						<div class="six columns">
							<div class="cart-right">
								<?php dynamic_sidebar('top-right' ); ?>  
							</div>
						</div>
					</div>
				</div> <!-- .top-nav -->
			<?php endif;?>
			
	<?php do_action('structural_before_header'); ?>
			<div class="branding header-image">
				<div class="container">
				<?php if( is_active_sidebar( 'header-right' ) ){ ?>
					<div class="seven columns">
						<div class="site-branding">
							<?php 
								$logo_title = get_theme_mod( 'logo_title' );   
								$tagline = get_theme_mod( 'tagline',true);
								if( $logo_title ) :
	                                the_custom_logo();     
	                            else : ?>
									<h3 class="site-title"><a style="color: #<?php header_textcolor(); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
							<?php endif; ?>
							<?php if( $tagline ) : ?>
									<p class="site-description" style="color: #<?php header_textcolor(); ?>"><?php bloginfo( 'description' ); ?></p>
							<?php endif; ?>
						</div><!-- .site-branding -->
					</div>
					<div class="nine columns">
						<div class="header-right clearfix">
							<?php dynamic_sidebar('header-right' ); ?>  
						</div>
					</div>
				<?php }
				else {?>
					<div class="sixteen columns">
						<div class="site-branding center">
							<?php 
								$logo_title = get_theme_mod( 'logo_title' );   
								$tagline = get_theme_mod( 'tagline',true);
								if( $logo_title ) :
	                                the_custom_logo();     
	                            else : ?>
									<h3 class="site-title"><a style="color: #<?php header_textcolor(); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
							<?php endif; ?>
							<?php if( $tagline ) : ?>
									<p class="site-description" style="color: #<?php header_textcolor(); ?>"><?php bloginfo( 'description' ); ?></p>
							<?php endif; ?>
						</div><!-- .site-branding -->
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="nav-wrap">
				<div class="container">
					<nav id="site-navigation" class="main-navigation sixteen columns" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-align-justify fa-2x" aria-hidden="true"></i></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>
			</div>

			


	</header><!-- #masthead --> 

	<?php if ( function_exists( 'is_woocommerce' ) || function_exists( 'is_cart' ) || function_exists( 'is_checkout' ) ) :
	 if ( is_woocommerce() || is_cart() || is_checkout() ) { ?>
	   <?php $breadcrumb = get_theme_mod( 'breadcrumb',true ); ?>    
		   <div class="breadcrumb">
				<div class="container"><?php
				   if( !is_search() && !is_archive() && !is_404() ) : ?>
						<div class="breadcrumb-left eight columns">
							<h4><?php woocommerce_page_title(); ?></h4>   			
						</div><?php
					endif; ?>
					<?php if( $breadcrumb ) : ?>
						<div class="breadcrumb-right eight columns">
							<?php woocommerce_breadcrumb(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
	<?php } 
	endif; ?>

	


