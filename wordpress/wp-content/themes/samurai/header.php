<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Samurai
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="container">

        <header class="header" style="background-image: url(<?php if( has_header_image() ) { header_image(); } ?>); background-size: cover; background-position: center;"">
            <div class="header_top_wrapper">
                <div class="header_top_inner">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                            <div class="header_top_nav_left_inner">
                            	<?php
                                if( has_nav_menu( 'top_menu' ) ) :
                            		wp_nav_menu( array(
                            			'theme_location'=> 'top_menu',
                            			'menu_class'	=> 'header_top_nav_left clearfix'
                            		) );
                            	else: ?>
                                <ul class="header_top_nav_left clearfix">
                                   <?php wp_list_pages( array( 'title_li' => '' ) ); ?>
                                </ul>

                            <?php endif; ?>
                            </div>
                            <!-- // header_top_nav_left_inner -->
                        </div>


                         
                        <!-- // col 6 & 12 -->
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                            <div class="header_top_right_social_n_search_inner">
                                <div class="header_top_right_socials social-menu-search clearfix">
                                	<?php
                                        get_search_form();
                                        
    	                        		if( has_nav_menu( 'social_menu' ) ) :
    	                        			wp_nav_menu( array(
    	                        				'theme_location'	=> 'social_menu',
    	                        				'menu_class'		=> 'header_top_socail_nav social-nav'
    	                        			) );
                                            endif; ?>
                                </div>
                                <!-- // header_top_right_socials -->
                            </div>
                            <!-- // header_top_right_social_n_search_inner -->
                        </div>
                        <!--  // col 6 & 12 -->
                    </div>
                    <!--  // row -->
                </div>
                <!-- // header_top_inner -->
            </div>
            <!--  // header top wrapper -->
            <div class="site_brand_logo_or_name_wrapper">
                <div class="brand_or_logo_inner">
                	<?php
    					if( has_custom_logo() ) :
    						the_custom_logo();
    				?>
    				<?php
    					else :
    				?>
    					<h1 class="site-title text-center">
    						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
    					        <?php bloginfo( 'name' ); ?>
    					    </a>
    					</h1><!-- .site-title -->
    					<h5 class="site-description text-center">
    						<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
    					</h5><!-- .site-description -->
    				<?php
    					endif;
    				?>
                </div>
                <!-- // brand_or_logo_inner -->
            </div>
            <!-- // site_brand_logo_or_name_wrapper -->
            <div class="menu-container clearfix">
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <?php
                        if( has_nav_menu( 'primary' ) ) :
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'menu_class'        => 'primary-menu',
                                'container'     => 'div',
                                'container_class'   => 'primary-menu-container',
                                'fallback_cb'    => 'samurai_primary_navigation_fallback',
                            )
                        );
                     else: ?>
                         <ul id="primary-menu" class="primary-menu">
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                   <?php endif; ?>
                </nav><!-- #site-navigation -->
            </div><!-- .menu-container -->
        </header><!-- .header -->