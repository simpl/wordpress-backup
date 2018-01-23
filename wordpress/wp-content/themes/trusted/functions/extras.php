<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Trusted
 */

/**
 * Adds custom classes to the array of body classes
 *
 * @param array $classes Classes for the body element
 * @return array
 */
function trusted_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_theme_mod( 'header_textcolor' ) == 'blank' ) {
		$classes[] = 'title-tagline-hidden';
	}

	return $classes;
}
add_filter( 'body_class', 'trusted_body_classes' );


function trusted_primary_menu_fallback() {
	if ( is_user_logged_in() && current_user_can( 'administrator' ) ) {
		echo '<div><ul id="primary-menu" class="clearfix"><li class="menu-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Create your Primary Menu here', 'trusted' ) . '</a></li></ul></div>';
	} else {
		return;
	}

}


/**
 * Adds post class(es) for posts in blog index, archives and search results
 */
function trusted_post_classes( $classes ) {
	if ( get_theme_mod( 'animate_on' ) ) {
		if ( is_home() || is_archive() || is_search() ) {
			$classes[] = 'fadeInUp';
		}
	}
	return $classes;
}
add_filter( 'post_class', 'trusted_post_classes' );


function trusted_custom_excerpt_length( $length ) {
	return 110;
}
add_filter( 'excerpt_length', 'trusted_custom_excerpt_length', 999 );


function trusted_excerpt_more( $more ) {
    return sprintf( '&hellip; <a class="read-more" href="%1$s">%2$s</a>',
        esc_url( get_permalink( get_the_ID() ) ),
        esc_html__( 'Read More', 'trusted' )
    );
}
add_filter( 'excerpt_more', 'trusted_excerpt_more' );


if( !function_exists( 'trusted_change_wp_page_menu_args' ) ){
	function trusted_change_wp_page_menu_args( $args ){
		$args['menu_class'] = 'menu clearfix';	
		return $args;
	}
}
add_filter( 'wp_page_menu_args' , 'trusted_change_wp_page_menu_args' );


function trusted_css_font_family($font_family) {
	$font_family = substr($font_family, 0, strpos($font_family, ':' ));
	return esc_attr($font_family);
}


function trusted_dynamic_style( $css = array() ){

	$sidebar_position = get_theme_mod( 'sidebar_position' );

	if ( get_theme_mod( 'animate_on' ) ) {
		$css[] = '.main-title,.main-excerpt,.taxonomy-description,.featured-post-wrap,.term-description,.page-description,.blog article,.archive article,.search article,.archive li.product{visibility:hidden;}.featured-post-wrap.reveal{visibility:visible;}.post-type-archive-product li.product-category,.term-description,.page-description{visibility:hidden;-webkit-animation-name:fadeInUp;animation-name:fadeInUp;}';
		if ($sidebar_position == "left") {
			$css[] = '#primary{float:right;}#secondary{float:left;}#secondary aside{visibility:hidden;-webkit-animation-name:fadeInLeft;animation-name:fadeInLeft;}';
		} else {
			$css[] = '#secondary aside{visibility:hidden;-webkit-animation-name:fadeInRight;animation-name:fadeInRight;}';
		}
	} else {
		if ($sidebar_position == "left") {
			$css[] = '#primary{float:right;}#secondary{float:left;}';
		}
	}

	$headings_underline = get_theme_mod( 'headings_underline' );
	if ($headings_underline) {
		$css[] = '.entry-content h1:before,.entry-content h2:before,.entry-content h3:before,.entry-content h4:before,.entry-content h5:before,.entry-content h6:before,.entry-content h1:after,.entry-content h2:after,.entry-content h3:after,.entry-content h4:after,.entry-content h5:after,.entry-content h6:after{display:none;}';
	}

	$font_header = get_theme_mod( 'font_header', 'Ubuntu:300,300italic,regular,italic,500,500italic,700,700italic' );
	if ($font_header && $font_header != 'Ubuntu:300,300italic,regular,italic,500,500italic,700,700italic' ) {
		$css[] = '#masthead,.site-title{font-family:\''.trusted_css_font_family($font_header).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_nav = get_theme_mod( 'font_nav', 'Hind:300,regular,500,600,700' );
	if ($font_nav && $font_nav != 'Hind:300,regular,500,600,700' ) {
		$css[] = '.site-navigation{font-family:\''.trusted_css_font_family($font_nav).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_page_title = get_theme_mod( 'font_page_title', 'Ubuntu:300,300italic,regular,italic,500,500italic,700,700italic' );
	if ($font_page_title && $font_page_title != 'Ubuntu:300,300italic,regular,italic,500,500italic,700,700italic' ) {
		$css[] = '.main-title{font-family:\''.trusted_css_font_family($font_page_title).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_content = get_theme_mod( 'font_content', 'Open Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic' );
	if ($font_content && $font_content != 'Open Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic' ) {
		$css[] = 'body,button,input,select,textarea{font-family:\''.trusted_css_font_family($font_content).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_headings = get_theme_mod( 'font_headings', 'Montserrat:regular,700' );
	if ($font_headings && $font_headings != 'Montserrat:regular,700' ) {
		$css[] = 'h1,h2,h3,h4,h5,h6,.page .woocommerce-tabs ul.tabs li a,.woocommerce div.product .woocommerce-tabs ul.tabs li a{font-family:\''.trusted_css_font_family($font_headings).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_footer = get_theme_mod( 'font_footer', 'Hind:300,regular,500,600,700' );
	if ($font_footer && $font_footer != 'Hind:300,regular,500,600,700' ) {
		$css[] = '#colophon{font-family:\''.trusted_css_font_family($font_footer).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$head_bg_color = get_theme_mod( 'head_bg_color', '#ced2d7' );
	if ( $head_bg_color && $head_bg_color != "#ced2d7" ) {
		$css[] = '.main-header{background-color:'.esc_attr($head_bg_color).';}';
	}

	$page_header_bg = get_header_image();
	if ($page_header_bg) {
		$css[] = '.main-header{background-image: '.'url( '.$page_header_bg.' )}';
	}

	$header_image_x_pos = get_theme_mod( 'header_image_x_pos' );
	if ( $header_image_x_pos && $header_image_x_pos != "65" ) {
		$css[] = '.main-header{background-position:'.esc_attr($header_image_x_pos).'% 0;}';
	}

	$head_transparent = get_theme_mod( 'head_transparent' );
	if ( $head_transparent && !$page_header_bg ) {
		$css[] = '.main-header{background-color:transparent;}';
	}

	$header_textcolor = get_theme_mod( 'header_textcolor', 'ffffff' );
	if ( $header_textcolor && $header_textcolor != 'ffffff' && $header_textcolor != 'fff' && $header_textcolor != 'blank' ) {
		$css[] = '.site-title a{color:#'.esc_attr($header_textcolor).';}';
	}

	$background_color = get_background_color();
	if ($background_color == 'ffffff' ) {
		$css[] = 'article,.single article,.single article:hover,.woocommerce div.product{padding: 0;margin-bottom: 0;}.woocommerce .woocommerce-result-count,.woocommerce .woocommerce-ordering{padding: 0;}';
	}

	$body_text_color = get_theme_mod( 'body_text_color', '#323b44' );
	if ($body_text_color && $body_text_color != "#323b44") {
		$css[] = 'body,button,input,select,textarea,.featured-readmore,.featured-readmore:hover,.pagination span,.pagination .dots,.pagination a,.woocommerce nav.woocommerce-pagination ul li a,.woocommerce nav.woocommerce-pagination ul li span,#masthead.light #top-bar,#masthead.light .top-tel,#masthead.light .top-tel .mobile-clear a,#masthead.light .top-tel .mobile-clear a:hover,#masthead.light #primary-menu li a,.main-header.light .main-excerpt p,.main-header.light .term-description p,.main-header.light .page-description p,.main-header.light .taxonomy-description p{color: '.esc_attr($body_text_color).';}@media screen and (max-width: 1024px){#masthead.light #primary-menu li a{color:#fff}}';
	}

	$heading_color = get_theme_mod( 'heading_color', '#323b45' );
	if ($heading_color && $heading_color != "#323b45") {
		$css[] = 'h1,h2,h3,h4,h5,h6,.entry-header .entry-title a,#secondary .widget .widget-title,.featured-post h4,.featured-post h4 a,.page .woocommerce-tabs ul.tabs li a,.page .woocommerce-tabs ul.tabs li:hover a,.page .woocommerce-tabs ul.tabs li.active a,.woocommerce div.product .woocommerce-tabs ul.tabs li a,.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{color: '.esc_attr($heading_color).';}';
	}

	$hi_color = get_theme_mod( 'hi_color' );
	if ($hi_color && $hi_color != "#00bc96") {
		$css[] = '.entry-content h1:before,.entry-content h2:before,.entry-content h3:before,.entry-content h4:before,.entry-content h5:before,.entry-content h6:before,.entry-header .entry-title:before,#secondary .widget .widget-title:before,h3#reply-title:before,h3.comments-title:before,.woocommerce h2:before,.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after{background-color:'.esc_attr($hi_color).'}';

		$css[] = 'button,input[type="button"],input[type="reset"],input[type="submit"],.entry-meta span .fa,.entry-footer span .fa,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,#top-bar a.button,#top-bar button, #top-bar input[type="button"], #top-bar input[type="reset"], #top-bar input[type="submit"],.top-cart:hover .item-count,.top-login-dropdown #respond input#submit, .top-login-dropdown a.button, .top-login-dropdown button.button, .top-login-dropdown input.button,.top-login-mini-cart #respond input#submit, .top-login-mini-cart a.button, .top-login-mini-cart button.button, .top-login-mini-cart input.button,.featured-post:hover .featured-icon,#cta-section a:hover .cta-icon .fa,#cta-section a.button,#footer-menu a[href*="codepen.io"]:hover:before,#footer-menu a[href*="digg.com"]:hover:before,#footer-menu a[href*="dribbble.com"]:hover:before,#footer-menu a[href*="dropbox.com"]:hover:before,#footer-menu a[href*="facebook.com"]:hover:before,#footer-menu a[href*="flickr.com"]:hover:before,#footer-menu a[href*="foursquare.com"]:hover:before,#footer-menu a[href*="plus.google.com"]:hover:before,#footer-menu a[href*="github.com"]:hover:before,#footer-menu a[href*="instagram.com"]:hover:before,#footer-menu a[href*="linkedin.com"]:hover:before,#footer-menu a[href*="pinterest.com"]:hover:before,#footer-menu a[href*="getpocket.com"]:hover:before,#footer-menu a[href*="reddit.com"]:hover:before,#footer-menu a[href*="skype.com"]:hover:before,#footer-menu a[href*="stumbleupon.com"]:hover:before,#footer-menu a[href*="tumblr.com"]:hover:before,#footer-menu a[href*="twitter.com"]:hover:before,#footer-menu a[href*="vimeo.com"]:hover:before,#footer-menu a[href*="wordpress.com"]:hover:before,#footer-menu a[href*="wordpress.org"]:hover:before,#footer-menu a[href*="youtube.com"]:hover:before,#footer-menu a[href^="mailto:"]:hover:before,#footer-menu a[href*="spotify.com"]:hover:before,#footer-menu a[href*="twitch.tv"]:hover:before,#footer-menu a[href$="/feed/"]:hover:before,.woocommerce ul.products li.product .button.add_to_cart_button,.woocommerce ul.products li.product .button,.woocommerce a.added_to_cart,.woocommerce div.product div.images .woocommerce-product-gallery__trigger,.woocommerce ul.products li.product .price,.woocommerce ul.products li.product .price:before,.woocommerce div.product p.price,.woocommerce div.product p.price:before,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.page .woocommerce-tabs ul.tabs li:before,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{background:'.esc_attr($hi_color).'}';

		$css[] = 'a,a:hover,a:focus,a:active,.single-entry-content a,.widget-area a:hover,.comment-list a:hover,#top-bar a:hover,#top-bar .fa,#site-description,.top-tel .fa,.top-login-dropdown .top-login-register:before,#primary-menu li a:hover,#primary-menu li.current-menu-item a,#primary-menu ul li a:hover,#cta-section .cta-icon .fa,.pagination a:hover,.pagination .current,article.post.sticky .entry-header .entry-title:after,.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce .woocommerce-message:before,.woocommerce .woocommerce-info:before,#masthead.light #top-bar a,#masthead.light #top-bar .fa:hover,#masthead.light #primary-menu li a:hover{color:'.esc_attr($hi_color).'}';

		$css[] = '#cta-section a:hover .cta-tel-before,#cta-section a:hover .cta-tel-after,.comment-navigation .nav-next a:after,.comment-navigation .nav-previous a:after,.featured-post,.pagination a:hover,.pagination .current,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce div.product div.images .flex-control-thumbs li img.flex-active, .woocommerce div.product div.images .flex-control-thumbs li img:hover{border-color: '.esc_attr($hi_color).'}';

		$css[] = '#footer-menu a[href*="codepen.io"]:before,#footer-menu a[href*="digg.com"]:before,#footer-menu a[href*="dribbble.com"]:before,#footer-menu a[href*="dropbox.com"]:before,#footer-menu a[href*="facebook.com"]:before,#footer-menu a[href*="flickr.com"]:before,#footer-menu a[href*="foursquare.com"]:before,#footer-menu a[href*="plus.google.com"]:before,#footer-menu a[href*="github.com"]:before,#footer-menu a[href*="instagram.com"]:before,#footer-menu a[href*="linkedin.com"]:before,#footer-menu a[href*="pinterest.com"]:before,#footer-menu a[href*="getpocket.com"]:before,#footer-menu a[href*="reddit.com"]:before,#footer-menu a[href*="skype.com"]:before,#footer-menu a[href*="stumbleupon.com"]:before,#footer-menu a[href*="tumblr.com"]:before,#footer-menu a[href*="twitter.com"]:before,#footer-menu a[href*="vimeo.com"]:before,#footer-menu a[href*="wordpress.com"]:before,#footer-menu a[href*="wordpress.org"]:before,#footer-menu a[href*="youtube.com"]:before,#footer-menu a[href^="mailto:"]:before,#footer-menu a[href*="spotify.com"]:before,#footer-menu a[href*="twitch.tv"]:before,#footer-menu a[href$="/feed/"]:before{box-shadow: inset 0 0 0 '.esc_attr($hi_color).';}#footer-menu a[href*="codepen.io"]:hover:before,#footer-menu a[href*="digg.com"]:hover:before,#footer-menu a[href*="dribbble.com"]:hover:before,#footer-menu a[href*="dropbox.com"]:hover:before,#footer-menu a[href*="facebook.com"]:hover:before,#footer-menu a[href*="flickr.com"]:hover:before,#footer-menu a[href*="foursquare.com"]:hover:before,#footer-menu a[href*="plus.google.com"]:hover:before,#footer-menu a[href*="github.com"]:hover:before,#footer-menu a[href*="instagram.com"]:hover:before,#footer-menu a[href*="linkedin.com"]:hover:before,#footer-menu a[href*="pinterest.com"]:hover:before,#footer-menu a[href*="getpocket.com"]:hover:before,#footer-menu a[href*="reddit.com"]:hover:before,#footer-menu a[href*="skype.com"]:hover:before,#footer-menu a[href*="stumbleupon.com"]:hover:before,#footer-menu a[href*="tumblr.com"]:hover:before,#footer-menu a[href*="twitter.com"]:hover:before,#footer-menu a[href*="vimeo.com"]:hover:before,#footer-menu a[href*="wordpress.com"]:hover:before,#footer-menu a[href*="wordpress.org"]:hover:before,#footer-menu a[href*="youtube.com"]:hover:before,#footer-menu a[href^="mailto:"]:hover:before,#footer-menu a[href*="spotify.com"]:hover:before,#footer-menu a[href*="twitch.tv"]:hover:before,#footer-menu a[href$="/feed/"]:hover:before{box-shadow: inset 0 -40px 0 '.esc_attr($hi_color).';}';

		$hi_color_rgb = trusted_hex2RGB($hi_color);
		$css[] = '.main-title{background:rgba( '.$hi_color_rgb['r'].', '.$hi_color_rgb['g'].', '.$hi_color_rgb['b'].',0.8);}.featured-post:hover .featured-icon,#cta-section a:hover .cta-icon .fa{box-shadow: 0px 0px 0px 4px rgba( '.$hi_color_rgb['r'].', '.$hi_color_rgb['g'].', '.$hi_color_rgb['b'].',0.45);}.breadcrumbs .trail-items{background:rgba( '.$hi_color_rgb['r'].', '.$hi_color_rgb['g'].', '.$hi_color_rgb['b'].',0.7);}';
	}

	$sec_color = get_theme_mod( 'sec_color' );
	if ($sec_color && $sec_color != "#4f5e70") {
		$css[] = '.trusted-modal,.top-login-dropdown,.top-login-mini-cart{background-color: '.esc_attr($sec_color).'}';

		$css[] = '#masthead,#top-bar ul > li > ul,#primary-menu ul,.featured-post .featured-icon,#colophon,.woocommerce div.product form.variations_form.cart,.woocommerce div.product p.variations_form.cart,#masthead.light .top-tel .mobile-clear:hover .fa,#masthead.light .top-login:hover .fa,#masthead.light .top-cart:hover .fa{background:'.esc_attr($sec_color).';}@media screen and (max-width: 1024px){#primary-menu,.site-navigation.centered #primary-menu{background:'.esc_attr($sec_color).';}}';

		$css[] = '.header-title .fa,.top-cart .item-count,#footer-menu a:before,#footer-menu a[href*="codepen.io"]:hover:before,#footer-menu a[href*="digg.com"]:hover:before,#footer-menu a[href*="dribbble.com"]:hover:before,#footer-menu a[href*="dropbox.com"]:hover:before,#footer-menu a[href*="facebook.com"]:hover:before,#footer-menu a[href*="flickr.com"]:hover:before,#footer-menu a[href*="foursquare.com"]:hover:before,#footer-menu a[href*="plus.google.com"]:hover:before,#footer-menu a[href*="github.com"]:hover:before,#footer-menu a[href*="instagram.com"]:hover:before,#footer-menu a[href*="linkedin.com"]:hover:before,#footer-menu a[href*="pinterest.com"]:hover:before,#footer-menu a[href*="getpocket.com"]:hover:before,#footer-menu a[href*="reddit.com"]:hover:before,#footer-menu a[href*="skype.com"]:hover:before,#footer-menu a[href*="stumbleupon.com"]:hover:before,#footer-menu a[href*="tumblr.com"]:hover:before,#footer-menu a[href*="twitter.com"]:hover:before,#footer-menu a[href*="vimeo.com"]:hover:before,#footer-menu a[href*="wordpress.com"]:hover:before,#footer-menu a[href*="wordpress.org"]:hover:before,#footer-menu a[href*="youtube.com"]:hover:before,#footer-menu a[href^="mailto:"]:hover:before,#footer-menu a[href*="spotify.com"]:hover:before,#footer-menu a[href*="twitch.tv"]:hover:before,#footer-menu a[href$="/feed/"]:hover:before{color:'.esc_attr($sec_color).'}';

		$css[] = '.main-excerpt p,.taxonomy-description p,.term-description p,.page-description p{text-shadow: 0 1px 0 '.esc_attr($sec_color).';}';

		$sec_color_rgb = trusted_hex2RGB($sec_color);
		$css[] = '.main-excerpt p,.taxonomy-description p,.term-description p,.page-description p{background:rgba( '.$sec_color_rgb['r'].', '.$sec_color_rgb['g'].', '.$sec_color_rgb['b'].',0.8);}#cta-section{background-color:rgba( '.$sec_color_rgb['r'].', '.$sec_color_rgb['g'].', '.$sec_color_rgb['b'].',0.8);}.featured-post .featured-icon{box-shadow: 0px 0px 0px 4px rgba( '.$sec_color_rgb['r'].', '.$sec_color_rgb['g'].', '.$sec_color_rgb['b'].',0.45);}';
	}

	$site_title_uppercase = get_theme_mod( 'site_title_uppercase' );
	if ($site_title_uppercase) {
		$css[] = '.site-title a{text-transform: uppercase;}';
	}

	$menu_uppercase = get_theme_mod( 'menu_uppercase' );
	if ($menu_uppercase) {
		$css[] = '#primary-menu a{text-transform: uppercase;}';
	}

	$cta_img = get_theme_mod( 'cta_img', '' );
	if ($cta_img && $cta_img != "") {
		$css[] = '#cta-section{background-image: url( '.esc_url($cta_img).' )}';
	}

	return implode( '', $css );

}


function trusted_editor_dynamic_style( $mceInit, $css = array() ) {

	$font_content = get_theme_mod( 'font_content', 'Source+Sans+Pro:300,400,600,700' );
	if ($font_content && $font_content != 'Source+Sans+Pro:300,400,600,700' ) {
		$css[] = 'body.mce-content-body{font-family:\''.trusted_css_font_family($font_content).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$font_headings = get_theme_mod( 'font_headings', 'Montserrat:400,700' );
	if ($font_headings && $font_headings != 'Montserrat:400,700' ) {
		$css[] = '.mce-content-body h1,.mce-content-body h2,.mce-content-body h3,.mce-content-body h4,.mce-content-body h5,.mce-content-body h6{font-family:\''.trusted_css_font_family($font_headings).'\', Helvetica, Arial, Verdana, sans-serif;}';
	}

	$heading_color = get_theme_mod( 'heading_color', '#323b45' );
	if ($heading_color && $heading_color != "#323b45") {
		$css[] = '.mce-content-body h1,.mce-content-body h2,.mce-content-body h3,.mce-content-body h4,.mce-content-body h5,.mce-content-body h6{color: '.esc_attr($heading_color).';}';
	}

	$body_text_color = get_theme_mod( 'body_text_color', '#323b44' );
	if ($body_text_color && $body_text_color != "#323b44") {
		$css[] = 'body.mce-content-body{color: '.esc_attr($body_text_color).';}';
	}

	$hi_color = get_theme_mod( 'hi_color' );
	if ($hi_color && $hi_color != "#00bc96") {
		$css[] = '.mce-content-body h1:before,.mce-content-body h2:before,.mce-content-body h3:before,.mce-content-body h4:before,.mce-content-body h5:before,.mce-content-body h6:before{background-color:'.esc_attr($hi_color).'}';
		$css[] = '.mce-content-body a,.mce-content-body a:hover,.mce-content-body a:focus,.mce-content-body a:active{color:'.esc_attr($hi_color).'}';
	}

	$headings_underline = get_theme_mod( 'headings_underline' );
	if ($headings_underline) {
		$css[] = '.mce-content-body h1:before,.mce-content-body h2:before,.mce-content-body h3:before,.mce-content-body h4:before,.mce-content-body h5:before,.mce-content-body h6:before,.mce-content-body h1:after,.mce-content-body h2:after,.mce-content-body h3:after,.mce-content-body h4:after,.mce-content-body h5:after,.mce-content-body h6:after{display:none;}';
	}

	$styles = implode( '', $css );

    if ( isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] .= ' ' . $styles . ' ';
    } else {
        $mceInit['content_style'] = $styles . ' ';
    }
    return $mceInit;

}
add_filter( 'tiny_mce_before_init', 'trusted_editor_dynamic_style' );


function trusted_hex2RGB($hex) 
{
	$hex = str_replace("#", "", $hex);

        preg_match("/^#{0,1}([0-9a-f]{1,6})$/i",$hex,$match);
        if(!isset($match[1]))
        {
            return false;
        }

        if(strlen($match[1]) == 6)
        {
            list($r, $g, $b) = array($hex[0].$hex[1],$hex[2].$hex[3],$hex[4].$hex[5]);
        }
        elseif(strlen($match[1]) == 3)
        {
            list($r, $g, $b) = array($hex[0].$hex[0],$hex[1].$hex[1],$hex[2].$hex[2]);
        }
        else if(strlen($match[1]) == 2)
        {
            list($r, $g, $b) = array($hex[0].$hex[1],$hex[0].$hex[1],$hex[0].$hex[1]);
        }
        else if(strlen($match[1]) == 1)
        {
            list($r, $g, $b) = array($hex.$hex,$hex.$hex,$hex.$hex);
        }
        else
        {
            return false;
        }

        $color = array();
        $color['r'] = hexdec($r);
        $color['g'] = hexdec($g);
        $color['b'] = hexdec($b);

        return $color;
}


function trusted_customize_nav( $items, $args ) {
    if ( $args->theme_location == 'primary' &&  get_theme_mod( 'menu_search' ) ) {   
    	$items .= '<li class="menu-item trusted-search"><a class="trusted-search" href="#search" role="button"><span class="fa fa-search"></span></a></li>';
    } else {
    	$items .= '';
    }
		return $items;
}
add_filter( 'wp_nav_menu_items', 'trusted_customize_nav', 10, 2);


/**
 * WooCommerce search form
 */
if(!function_exists( 'trusted_woocommerce_search_form' )){
	function trusted_woocommerce_search_form() {
	?>
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="search-label">
			<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'trusted' ); ?></span>
			<div>				
				<?php 
					$swp_cat_dropdown_args = array(
						'taxonomy' 		   => 'product_cat',
						'show_option_all'  => esc_html__( 'All', 'trusted' ),
						'name'             => 'product_cat',
						'value_field'      => 'slug',
						'hierarchical'     => 1,
						'depth'            => 2,
					);
					wp_dropdown_categories( $swp_cat_dropdown_args );
				 ?>
				<input type="search" class="input-search" placeholder="<?php esc_attr_e( 'Search ', 'trusted' ); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'trusted' ); ?>">
				<input type="hidden" name="post_type" value="product">
				<button type="submit" ><i class="fa fa-search"></i></button>
			</div>
		</label>
	</form>
	<?php
	}
}


/**
 * Output the header tel, login & mini-cart
 */
if(!function_exists( 'trusted_tel_login_cart' )){
	function trusted_tel_login_cart() {

	$tel_no = get_theme_mod( 'tel_no', '' );

					if ( class_exists( 'WooCommerce' ) ) {
						$woo_exists = true;
						$woo_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
							if ( $woo_account_page_id ) {
  								$woo_account_page_url = get_permalink( $woo_account_page_id );
							} else {
								if ( is_user_logged_in() ) {
									$woo_logged_in = true;
									$woo_account_page_url = esc_url( home_url( '/' ) );
								} else {
									$woo_logged_in = false;
									$woo_account_page_url = wp_login_url( get_permalink() );
								}
							}

							if ( is_user_logged_in() ) {
								$woo_logged_in = true;
								$woo_account_icon = 'user';
								$woo_account_login_title = '';
								$woo_account_reg_title = '';
							} else {
								$woo_logged_in = false;
								$woo_account_icon = 'sign-in';
								$woo_account_login_title = esc_html__( 'Login', 'trusted' );
								$woo_account_reg_title = esc_html__( 'Register', 'trusted' );
								$woo_login_args = array(
									'message'  => '',
									'redirect' => trusted_current_page_url(),
									'hidden'   => false,
								);
							}

							$woo_top_cart_link = wc_get_cart_url();

							if ( WC()->cart->display_cart_ex_tax ) {
								$cart_contents_total = wc_price( WC()->cart->cart_contents_total );
							} else {
								$cart_contents_total = wc_price( WC()->cart->cart_contents_total + WC()->cart->tax_total );
							}
							$cart_contents_total = strip_tags( apply_filters( 'woocommerce_cart_contents_total', $cart_contents_total ) );


					} else {
						$woo_exists = false;
					}

					if ($tel_no && !$woo_exists) { ?>
					<div id="site-description" class="site-description"><?php bloginfo( 'description' ); ?></div>

					<div id="top-info">
						<div class="top-tel">
							<div class="mobile-clear">
								<a href="tel:<?php echo esc_html($tel_no);?>"><i class="fa fa-phone"></i><?php echo esc_html($tel_no);?></a>
							</div>
						</div>
					</div>
					<?php } elseif ($tel_no && $woo_exists) { ?>
					<div id="site-description" class="site-description"><?php bloginfo( 'description' ); ?></div>

					<div id="top-info">
						<div class="top-tel">

							<div class="mobile-clear">
								<a href="tel:<?php echo esc_html($tel_no);?>"><i class="fa fa-phone"></i><?php echo esc_html($tel_no);?></a>
							</div>

							<div class="top-login">
								<a href="<?php echo $woo_account_page_url;?>"><i class="fa fa-<?php echo $woo_account_icon;?>"></i></a>
								<div class="top-login-dropdown">
									<?php if ( $woo_logged_in ) { ?><p><?php
										/* translators: %1$s: user display name, %2$s: logout url */
										printf( esc_html__( 'Hello %1$s (not %1$s? ', 'trusted' ) . '<a href="%2$s">' . esc_html__( 'Log out', 'trusted' ) . '</a>' . esc_html__( ' )', 'trusted' ),
											'<strong>' . esc_html( wp_get_current_user()->display_name ) . '</strong>',
											esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
										);
										?></p><?php woocommerce_account_navigation(); } else { ?><p class="top-login-header"><span class="top-login-login"><?php echo $woo_account_login_title;?></span></p><?php woocommerce_login_form($woo_login_args);?><p class="top-login-footer"><span class="top-login-register"><a href="<?php echo $woo_account_page_url;?>"><?php echo $woo_account_reg_title;?></a></span></p><?php } ?>
								</div>
							</div>

							<div class="top-cart">
								<a class="cart-contents" href="<?php echo esc_url($woo_top_cart_link); ?>"><i class="fa cart-icon"><?php echo sprintf ( '<span class="item-count">%d</span>', esc_html( WC()->cart->get_cart_contents_count() ) ); ?></i><?php echo esc_html( $cart_contents_total ); ?></a>
								<div class="top-login-mini-cart">
									<?php woocommerce_mini_cart();?>		
								</div>
							</div>

						</div>
					</div>
					<?php } elseif (!$tel_no && $woo_exists) { ?>
					<div id="site-description" class="site-description"><?php bloginfo( 'description' ); ?></div>

					<div id="top-info">
						<div class="top-tel">
						<?php if ( is_customize_preview() ) { ?>
							<div class="mobile-clear">
								<a href="#"></a>
							</div>
						<?php } ?>
							<div class="top-login no-background">
								<a href="<?php echo $woo_account_page_url;?>"><i class="fa fa-<?php echo $woo_account_icon;?>"></i></a>
								<div class="top-login-dropdown">
									<?php if ( $woo_logged_in ) { ?><p><?php
										/* translators: %1$s: user display name, %2$s: logout url */
										printf( esc_html__( 'Hello %1$s (not %1$s? ', 'trusted' ) . '<a href="%2$s">' . esc_html__( 'Log out', 'trusted' ) . '</a>' . esc_html__( ' )', 'trusted' ),
											'<strong>' . esc_html( wp_get_current_user()->display_name ) . '</strong>',
											esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
										);
										?></p><?php woocommerce_account_navigation(); } else { ?><p class="top-login-header"><span class="top-login-login"><?php echo $woo_account_login_title;?></span></p><?php woocommerce_login_form($woo_login_args);?><p class="top-login-footer"><span class="top-login-register"><a href="<?php echo $woo_account_page_url;?>"><?php echo $woo_account_reg_title;?></a></span></p><?php } ?>
								</div>
							</div>

							<div class="top-cart no-background">
								<a class="cart-contents" href="<?php echo esc_url($woo_top_cart_link); ?>"><i class="fa cart-icon"><?php echo sprintf ( '<span class="item-count">%d</span>', esc_html( WC()->cart->get_cart_contents_count() ) ); ?></i><?php echo esc_html( $cart_contents_total ); ?></a>
								<div class="top-login-mini-cart">
									<?php woocommerce_mini_cart();?>		
								</div>
							</div>

						</div>
					</div>
					<?php } else { 
						if ( is_customize_preview() ) { ?>
						<div id="site-description" class="no-woo site-description eighty"><?php bloginfo( 'description' ); ?></div>
						<div id="top-info" class="no-woo">
							<div class="top-tel">
								<div class="mobile-clear">
									<a href="#"></a>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div id="site-description" class="site-description eighty"><?php bloginfo( 'description' ); ?></div>
						<?php }
					}

	}
}


/**
 * Update header mini-cart contents when products are added to the cart via AJAX
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'trusted_woo_header_add_to_cart_fragments' );
function trusted_woo_header_add_to_cart_fragments( $fragments ) {

				$tel_no = get_theme_mod( 'tel_no', '' );
				if ( !$tel_no ) {
					$cart_background = ' no-background';
				} else {
					$cart_background = '';
				}

				$woo_top_cart_link = wc_get_cart_url();

				if ( WC()->cart->display_cart_ex_tax ) {
					$cart_contents_total = wc_price( WC()->cart->cart_contents_total );
				} else {
					$cart_contents_total = wc_price( WC()->cart->cart_contents_total + WC()->cart->tax_total );
				}
				$cart_contents_total = strip_tags( apply_filters( 'woocommerce_cart_contents_total', $cart_contents_total ) );

	ob_start();
	?>

							<div class="top-cart">
								<a class="cart-contents<?php echo $cart_background;?>" href="<?php echo esc_url($woo_top_cart_link); ?>"><i class="fa cart-icon"><?php echo sprintf ( '<span class="item-count">%d</span>', WC()->cart->get_cart_contents_count() ); ?></i><?php echo esc_html( $cart_contents_total ); ?></a>
								<div class="top-login-mini-cart">
									<?php woocommerce_mini_cart();?>		
								</div>
							</div>
						
	<?php
	
	$fragments['.top-cart'] = ob_get_clean();
	
	return $fragments;
}


/**
 * Page/post/archive title with header image background
 */
if(!function_exists( 'trusted_header_title' )){
	function trusted_header_title() { 
		$header_light = get_theme_mod( 'header_light', 'dark' );
		if ( $header_light == 'light' ) {
			$main_header_class = ' light';
		} else {
			$main_header_class = '';
		}
		?>
	<header class="main-header<?php echo $main_header_class; ?>">
		<div class="container">
			<div class="header-title">
		<?php
		if ( class_exists( 'WooCommerce' ) && in_array( 'woocommerce' , get_body_class() ) ) {
			$shop_title_icon = get_theme_mod( 'shop_title_icon', 'fa fa-shopping-cart' );
			if ( is_product() ) {
				if ( has_post_thumbnail() ) {
					$product_thumbnail = get_the_post_thumbnail_url( '', 'shop_thumbnail' );
					the_title( '<h1 class="main-title fadeInDown"><span class="main-title-img"><img src="' . $product_thumbnail . '"></span>', '</h1>' );
				} else {
					the_title( '<h1 class="main-title fadeInDown"><i class="' . $shop_title_icon . '"></i>', '</h1>' );
				}				
			} else {
				echo '<h1 class="main-title fadeInDown"><i class="' . esc_html($shop_title_icon) . '"></i>';
				woocommerce_page_title();
				echo '</h1>';
				do_action( 'trusted_woocommerce_archive_description' );
			}
		} else {
			if ( is_home() && 'page' == get_option( 'show_on_front' ) ) {
				$blog_page_id = get_option( 'page_for_posts' );
				$blog_title_icon = get_theme_mod( 'blog_title_icon', 'fa fa-newspaper-o' );
				echo '<h1 class="main-title fadeInDown"><i class="' . esc_html( $blog_title_icon ) . '"></i>' . get_the_title( $blog_page_id ) . '</h1>';
				$trusted_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $blog_page_id ) );
				if ( $trusted_excerpt ) {
					echo '<div class="main-excerpt fadeInUp">';
					echo $trusted_excerpt;
					echo '</div>';
				}
			} elseif ( is_singular() ) {
				if ( is_page() ) {
					if ( in_array( 'woocommerce-page' , get_body_class() ) ) {
    					$page_title_icon = get_theme_mod( 'shop_title_icon', 'fa fa-shopping-cart' );
					} else {
    					$page_title_icon = get_theme_mod( 'page_title_icon', 'fa fa-check' );
					}
					if ( is_front_page() && !get_theme_mod( 'custom_logo' ) ) {
						the_title( '<h2 class="main-title fadeInDown"><i class="' . $page_title_icon . '"></i>', '</h2>' );
					} else {
						the_title( '<h1 class="main-title fadeInDown"><i class="' . $page_title_icon . '"></i>', '</h1>' );
					}
					$trusted_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt') );
					if ( $trusted_excerpt ) {
						echo '<div class="main-excerpt fadeInUp">';
						echo $trusted_excerpt;
						echo '</div>';
					}
				} else {
					$format = get_post_format();
					if ( $format == 'aside' ) {
						$blog_title_icon = 'fa fa-file';
					} elseif ( $format == 'image' ) {
						$blog_title_icon = 'fa fa-image';
					} elseif ( $format == 'video' ) {
						$blog_title_icon = 'fa fa-video-camera';
					} elseif ( $format == 'quote' ) {
						$blog_title_icon = 'fa fa-quote-right';
					} elseif ( $format == 'link' ) {
						$blog_title_icon = 'fa fa-link';
					} elseif ( $format == 'gallery' ) {
						$blog_title_icon = 'fa fa-image';
					} elseif ( $format == 'audio' ) {
						$blog_title_icon = 'fa fa-music';
					} elseif ( $format == 'status' ) {
						$blog_title_icon = 'fa fa-comment';
					} elseif ( $format == 'chat' ) {
						$blog_title_icon = 'fa fa-comments';
					} else {
						$blog_title_icon = get_theme_mod( 'blog_title_icon', 'fa fa-newspaper-o' );
					}
					the_title( '<h1 class="main-title fadeInDown"><i class="' . $blog_title_icon . '"></i>', '</h1>' );
					$trusted_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt') );
					if ( $trusted_excerpt ) {
						echo '<div class="main-excerpt fadeInUp">';
						echo $trusted_excerpt;
						echo '</div>';
					}
				}
			} elseif ( is_archive() ) {
				$blog_title_icon = get_theme_mod( 'blog_title_icon', 'fa fa-newspaper-o' );
				the_archive_title( '<h1 class="main-title fadeInDown"><i class="' . $blog_title_icon . '"></i>', '</h1>' );
				the_archive_description( '<div class="taxonomy-description fadeInUp">', '</div>' );
			} elseif ( is_search() ) {
				echo '<h1 class="main-title fadeInDown"><i class="fa fa-search"></i>';
				printf( esc_html__( 'Search Results for: %s', 'trusted' ), '<span>' . get_search_query() . '</span>' );
				echo'</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="main-title fadeInDown"><i class="fa fa-exclamation-triangle"></i>' . esc_html__( '404 Error', 'trusted' ) . '</h1>';
			}
		}
		?>
			</div>
		</div><!-- .container -->
	</header><!-- .entry-header -->
	<div class="container clearfix">
	<?php }
}


/**
 * Homepage featured services
 */
if(!function_exists( 'trusted_featured_services' )){
	function trusted_featured_services() {

	$enable_featured_link = get_theme_mod( 'enable_featured_link', true);
?>
	<section id="featured-post-section" class="section">
		<?php
		if ( get_theme_mod( 'animate_on' ) ) { ?>
		<div class="featured-post-wrap animated fadeInDown clearfix">
		<?php } else { ?>
		<div class="featured-post-wrap clearfix">
		<?php }
			$featured_page_link1 = get_theme_mod( 'featured_page_link1' );
			if (!$featured_page_link1) {
			 	# display latest posts
				$trusted_recent_args = array(
					'numberposts' => '3',
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => false
					);
				$recent_posts = wp_get_recent_posts( $trusted_recent_args );
				$featured_post_number = 1;
				foreach( $recent_posts as $recent ){
					$featured_page_icon = get_theme_mod( 'featured_page_icon'.$featured_post_number, trusted_featured_icon_defaults($featured_post_number) );
					?>
					<div class="featured-post featured-post<?php echo $featured_post_number; ?>">
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo get_the_title($recent["ID"]); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $recent["ID"] ) );
						if ( $featured_page_excerpt == '' ) {
							$featured_page_excerpt = '<p>' . wp_trim_words( strip_shortcodes( get_post_field( 'post_content', $recent["ID"] ) ), 15 ) . '</p>';
						}
						if ( $featured_page_excerpt != '' && $featured_page_excerpt != '<p></p>' ) {
							echo $featured_page_excerpt;
						}
						if ( $enable_featured_link ) {
						?>
						<a href="<?php echo esc_url( get_permalink( $recent["ID"] ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'trusted' );?></a>
						<?php
						}
						?>
						</div>
					</div>
					<?php
					$featured_post_number++;
				}
				wp_reset_postdata();
			} else {
				# display selected pages
				for( $i = 1; $i < 4; $i++ ){
					$featured_page_icon = get_theme_mod( 'featured_page_icon'.$i, trusted_featured_icon_defaults($i) );
					$featured_page_link = trusted_wpml_page_id( get_theme_mod( 'featured_page_link'.$i) );					
					if($featured_page_link){
					?>
					<div class="featured-post featured-post<?php echo $i ;?>">
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>"><span class="featured-icon"><i class="<?php echo esc_attr( $featured_page_icon ); ?>"></i></span>
						<h4><?php echo get_the_title($featured_page_link); ?></h4></a>
						<div class="featured-excerpt">
						<?php
						$featured_page_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $featured_page_link ) );
						if ( $featured_page_excerpt == '' ) {
							$featured_page_excerpt = '<p>' . wp_trim_words( strip_shortcodes( get_post_field( 'post_content', $featured_page_link ) ), 15 ) . '</p>';
						}
						if ( $featured_page_excerpt != '' && $featured_page_excerpt != '<p></p>' ) {
							echo $featured_page_excerpt;
						}
						if ( $enable_featured_link ) {
						?>
						<a href="<?php echo esc_url( get_page_link( $featured_page_link ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'trusted' );?></a>
						<?php
						}
						?>
						</div>
					</div>
				<?php
					}
				}
			}
			?>
		</div>
	</section>
<?php
	}
}


/**
 * About Section
 * Output the home page about us section
 */
if(!function_exists('trusted_about_section')){
	function trusted_about_section() {

		$about_page_link = trusted_wpml_page_id( get_theme_mod('about_page_link') );
		$enable_about_link = get_theme_mod( 'enable_about_link', true );
		$about_layout = get_theme_mod( 'about_layout', '' );
		if ( $about_page_link ) { 
			if ( $about_layout && $about_layout != '' ) {
				$about_layout_class = $about_layout . ' ';
			} else {
				$about_layout_class = '';
			}
			if ( has_post_thumbnail( $about_page_link ) ) {
				$no_image = '';
				$display_image = '<div class="about-right"><a href="' . esc_url( get_page_link( $about_page_link ) ) . '" title="' . get_the_title( $about_page_link ) . '">' . get_the_post_thumbnail( $about_page_link, 'large' ) . '</a></div>';
			} else {
				$no_image = ' no-image';
				$display_image = '';
			}
			?>
			<section id="about-section" class="section <?php echo $about_layout_class; ?>clearfix<?php echo $no_image; ?>">
				<div class="about-left">
					<h2><?php echo get_the_title( $about_page_link ); ?></h2>
					<?php
					// reviewer note: get_the_excerpt( $about_page_link ) does not work as intended because if manual excerpt is empty it defaults to current page content, which we do not want.
					$about_page_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $about_page_link));
					if ( $about_page_excerpt == '' ) {
						$about_page_excerpt = '<p>' . wp_trim_words( strip_shortcodes( get_post_field( 'post_content', $about_page_link ) ), 110 ) . '</p>';
					}
					if ( $about_page_excerpt != '' && $about_page_excerpt != '<p></p>' ) {
					echo $about_page_excerpt;
					}
					if ( $enable_about_link ) {
					?>
					<p><a href="<?php echo esc_url( get_page_link( $about_page_link ) ); ?>" class="button featured-readmore"><?php echo esc_html__( 'Read More', 'trusted' );?></a></p>
					<?php
					}
					?>
				</div>				
				<?php echo $display_image ;?>				
			</section>
		<?php }

	}
}


/**
 * WooCommerce Tabs
 * Output the home page shop tabs & products
 */
if(!function_exists('trusted_woo_tabs')){
	function trusted_woo_tabs() {

		$woo_home_tabs = get_theme_mod( 'woo_home' );

		if ( class_exists( 'WooCommerce' ) && $woo_home_tabs ) {

		$woo_home = get_theme_mod('woo_home', true);

		$woo_tabs = trusted_woo_home_tabs();

		$woo_tabs_amount = trusted_woo_home_tabs_amount();
	
			?>
		<section id="home-shop-section" class="section">
			<div class="woocommerce-tabs wc-tabs-wrapper">
			<ul class="tabs wc-tabs">

			<?php
			$tabs = explode( ',', $woo_home['tabs'] );

			foreach ($tabs as $tab) {
				$tab = explode(":", $tab);
				$tab_id = $tab[0];
				$tab_active = $tab[1];
				$tab_name = $woo_tabs[$tab_id]['label'];

				if ($tab_active == 1) {
					echo '<li id="tab-title-'.$tab_id.'" class="'.$tab_id.'_tab"><a href="#tab-'.$tab_id.'">'.$tab_name.'</a></li>
					';
				}

			}
			?>
			</ul>
			<?php
			foreach ($tabs as $tab) {
				$tab = explode(":", $tab);
				$tab_id = $tab[0];
				$tab_active = $tab[1];
				$tab_shortcode = $woo_tabs[$tab_id]['shortcode'];
				$per_page = $woo_tabs_amount['per_page'];
				$columns = $woo_tabs_amount['columns'];

				if ($tab_active == 1) {
					echo '<div id="tab-'.$tab_id.'" class="woocommerce-Tabs-panel woocommerce-Tabs-panel--'.$tab_id.' panel entry-content wc-tab">'.do_shortcode('['.$tab_shortcode.' per_page="'.$per_page.'" columns="'.$columns.'"]').'</div>
					';
				}

			}
			?>
			</div>
		</section>
		<?php
		}
	}
}


/**
 * Home page phone panel
 */
if(!function_exists( 'trusted_cta_section' )){
	function trusted_cta_section(){

		$tel_no = get_theme_mod( 'tel_no', '' );
		$cta_button_link = trusted_wpml_page_id( get_theme_mod( 'cta_button_link' ) );	
	?>
	<section id="cta-section" class="section">
		<div class="container clearfix">			
		<?php if ($tel_no) { ?>
		<a href="tel:<?php echo esc_html($tel_no);?>">
			<div class="cta-icon<?php trusted_sidebar_reveal( 'fadeInDown' ); ?>">
				<i class="fa fa-phone"></i>
			</div>
			<div class="cta-tel<?php trusted_sidebar_reveal( 'fadeInUp' ); ?>">
				<span class="cta-tel-before"></span><?php echo esc_html($tel_no);?><span class="cta-tel-after"></span>
			</div>
		</a>
		<?php } else {
			if ( is_customize_preview() ) { ?>
		<a href="#">
			<div class="no-tel cta-icon<?php trusted_sidebar_reveal( 'fadeInDown' ); ?>">
				<i class="fa fa-phone"></i>
			</div>
			<div class="cta-tel<?php trusted_sidebar_reveal( 'fadeInUp' ); ?>">
				
			</div>
		</a>
			<?php }
		}
		if ($cta_button_link) { ?>
			<div class="cta-button<?php trusted_sidebar_reveal( 'fadeInUp' ); ?>">
			<?php $cta_page_excerpt = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $cta_button_link));
				if ( '' != $cta_page_excerpt) {
					echo $cta_page_excerpt;
				} ?>
				<a href="<?php echo esc_url( get_page_link( $cta_button_link ) ); ?>" class="button"><?php echo get_the_title($cta_button_link); ?></a>
			</div>
		<?php } ?>
		</div>
	</section>
	<?php

	}
}


/**
 * Powered by WordPress
 */
if(!function_exists( 'trusted_powered_by' )){
	function trusted_powered_by(){
		?>
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'trusted' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'trusted' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %2$s by %1$s', 'trusted' ), 'uXL Themes', '<a href="https://uxlthemes.com/theme/trusted/" rel="designer">Trusted</a>' ); ?>
				</div>
		<?php
	}
}

function trusted_featured_icon_defaults( $input ){
	if ( $input == 1 ) {
		$output = 'fa fa-camera';
	} elseif ( $input == 2 ) {
		$output = 'fa fa-laptop';
	} elseif ( $input == 3 ) {
		$output = 'fa fa-rocket';
	} else {
		$output = 'fa fa-check';
	}
	return $output;
}

/**
 * WooCommerce Tabs
 * list of available home page shop tabs
 */
if(!function_exists( 'trusted_woo_home_tabs' )){
	function trusted_woo_home_tabs(){
		$tabs = array();
		$tabs['recent'] = array(
			'id'       => 'recent',
			'label'    => esc_html__( 'Recent', 'trusted' ),
			'callback' => 'trusted_recent',
			'shortcode'=> 'recent_products',
		);
		$tabs['featured'] = array(
			'id'       => 'featured',
			'label'    => esc_html__( 'Featured', 'trusted' ),
			'callback' => 'trusted_featured',
			'shortcode'=> 'featured_products',
		);
		$tabs['sale'] = array(
			'id'       => 'sale',
			'label'    => esc_html__( 'Sale', 'trusted' ),
			'callback' => 'trusted_sale',
			'shortcode'=> 'sale_products',
		);
		$tabs['best'] = array(
			'id'       => 'best',
			'label'    => esc_html__( 'Top Selling', 'trusted' ),
			'callback' => 'trusted_best',
			'shortcode'=> 'best_selling_products',
		);
		$tabs['rated'] = array(
			'id'       => 'rated',
			'label'    => esc_html__( 'Top Rated', 'trusted' ),
			'callback' => 'trusted_rated',
			'shortcode'=> 'top_rated_products',
		);
		return apply_filters( 'trusted_woo_home_tabs', $tabs );
	}
}


/**
 * Products per page & number of columns for home page shop tabs
 */
if(!function_exists( 'trusted_woo_home_tabs_amount' )){
	function trusted_woo_home_tabs_amount(){
		$tabs_amount = array(
			'per_page' => 8,
			'columns'  => 4,
		);
		return apply_filters( 'trusted_woo_home_tabs_amount', $tabs_amount );
	}
}


/**
 * Default home page shop tabs to use in customizer default value
 */
function trusted_woo_home_tabs_default(){
	$default = array();
	$tabs = trusted_woo_home_tabs();
	foreach( $tabs as $tab ){
		$default[] = $tab['id'] . ':0'; /* deactivate all as default. */
	}
	return apply_filters( 'trusted_woo_home_tabs_default', implode( ', ', $default ) );
}


/**
 * Add reveal/animation class to sidebar
 */
if(!function_exists( 'trusted_sidebar_reveal' )){
	function trusted_sidebar_reveal($fadein){
		if ( get_theme_mod( 'animate_on' ) ) {
			echo ' reveal animated '.esc_html($fadein);
		}
	}
}


/**
 * Return translated post ID
 */
if(!function_exists( 'trusted_wpml_page_id' )){
	function trusted_wpml_page_id($id){
		if ( function_exists( 'wpml_object_id' ) ) {
			return apply_filters( 'wpml_object_id', $id, 'page' );
		} elseif ( function_exists( 'icl_object_id' ) ) {
			return icl_object_id( $id, 'page', true );
		} else {
			return $id;
		}
	}
}


/**
 * Return current page
 */
if(!function_exists( 'trusted_current_page_url' )){
	function trusted_current_page_url(){
		global $wp;
		if ( !$wp->did_permalink ) {
			$trusted_current_page_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
		} else {
			$trusted_current_page_url = home_url( add_query_arg( array(), $wp->request ) );
		}
		if ( is_404( $trusted_current_page_url ) ) {
			$trusted_current_page_url  = home_url( '/' );
		}
		return esc_url( $trusted_current_page_url );
	}
}


/**
 * Array of Google fonts
 */
if(!function_exists( 'trusted_google_fonts_array' )){
	function trusted_google_fonts_array(){
		return array( 'Abel:regular' => 'Abel', 'Alegreya Sans:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,800,800italic,900,900italic' => 'Alegreya Sans', 'Arimo:regular,italic,700,700italic' => 'Arimo', 'Arvo:regular,italic,700,700italic' => 'Arvo', 'Asap:regular,italic,700,700italic' => 'Asap', 'Bitter:regular,italic,700' => 'Bitter', 'Bree Serif:regular' => 'Bree Serif', 'Cabin:regular,italic,500,500italic,600,600italic,700,700italic' => 'Cabin', 'Catamaran:300,regular,600,700,800' => 'Catamaran', 'Crimson Text:regular,italic,600,600italic,700,700italic' => 'Crimson Text', 'Cuprum:regular,italic,700,700italic' => 'Cuprum', 'Dosis:200,300,regular,500,600,700,800' => 'Dosis', 'Droid Sans:regular,700' => 'Droid Sans', 'Droid Serif:regular,italic,700,700italic' => 'Droid Serif', 'Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' => 'Exo', 'Exo 2:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' => 'Exo 2', 'Fjalla One:regular' => 'Fjalla One', 'Hind:300,regular,500,600,700' => 'Hind', 'Inconsolata:regular,700' => 'Inconsolata', 'Josefin Sans:100,100italic,300,300italic,regular,italic,600,600italic,700,700italic' => 'Josefin Sans', 'Karla:regular,italic,700,700italic' => 'Karla', 'Lato:100,100italic,300,300italic,regular,italic,700,700italic,900,900italic' => 'Lato', 'Lora:regular,italic,700,700italic' => 'Lora', 'Maven Pro:regular,500,700,900' => 'Maven Pro', 'Merriweather:300,300italic,regular,italic,700,700italic,900,900italic' => 'Merriweather', 'Merriweather Sans:300,300italic,regular,italic,700,700italic,800,800italic' => 'Merriweather Sans', 'Montserrat:regular,700' => 'Montserrat', 'Muli:300,300italic,regular,italic' => 'Muli', 'Noto Sans:regular,italic,700,700italic' => 'Noto Sans', 'Noto Serif:regular,italic,700,700italic' => 'Noto Serif', 'Nunito:300,regular,700' => 'Nunito', 'Open Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic' => 'Open Sans', 'Orbitron:regular,500,700,900' => 'Orbitron', 'Oswald:300,regular,700' => 'Oswald', 'Oxygen:300,regular,700' => 'Oxygen', 'Passion One:regular,700,900' => 'Passion One', 'Play:regular,700' => 'Play', 'Playfair Display:regular,italic,700,700italic,900,900italic' => 'Playfair Display', 'Poppins:300,regular,500,600,700' => 'Poppins', 'PT Sans:regular,italic,700,700italic' => 'PT Sans', 'PT Serif:regular,italic,700,700italic' => 'PT Serif', 'Raleway:100,200,300,regular,500,600,700,800,900' => 'Raleway', 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic' => 'Roboto', 'Roboto Slab:100,300,regular,700' => 'Roboto Slab', 'Rubik:300,regular,700' => 'Rubik', 'Signika:300,regular,600,700' => 'Signika', 'Source Sans Pro:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900,900italic' => 'Source Sans Pro', 'Titillium Web:200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900' => 'Titillium Web', 'Ubuntu:300,300italic,regular,italic,500,500italic,700,700italic' => 'Ubuntu', 'Vollkorn:regular,italic,700,700italic' => 'Vollkorn', 'Yanone Kaffeesatz:200,300,regular,700' => 'Yanone Kaffeesatz',);
	}
}


/**
 * Array of FontAwesome icons
 */
if(!function_exists( 'trusted_fontawesome_array' )){
	function trusted_fontawesome_array(){
		return array( 'not-a-real-icon', '500px', 'address-book', 'address-book-o', 'address-card', 'address-card-o', 'adjust', 'adn', 'align-center', 'align-justify', 'align-left', 'align-right', 'amazon', 'ambulance', 'american-sign-language-interpreting', 'anchor', 'android', 'angellist', 'angle-double-down', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'apple', 'archive', 'area-chart', 'arrow-circle-down', 'arrow-circle-left', 'arrow-circle-o-down', 'arrow-circle-o-left', 'arrow-circle-o-right', 'arrow-circle-o-up', 'arrow-circle-right', 'arrow-circle-up', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'arrows', 'arrows-alt', 'arrows-h', 'arrows-v', 'asl-interpreting', 'assistive-listening-systems', 'asterisk', 'at', 'audio-description', 'automobile', 'backward', 'balance-scale', 'ban', 'bandcamp', 'bank', 'bar-chart', 'bar-chart-o', 'barcode', 'bars', 'bath', 'battery-0', 'battery-1', 'battery-2', 'battery-3', 'battery-4', 'battery-empty', 'battery-full', 'battery-half', 'battery-quarter', 'battery-three-quarters', 'bed', 'beer', 'behance', 'behance-square', 'bell', 'bell-o', 'bell-slash', 'bell-slash-o', 'bicycle', 'binoculars', 'birthday-cake', 'bitbucket', 'bitbucket-square', 'bitcoin', 'black-tie', 'blind', 'bluetooth', 'bluetooth-b', 'bold', 'bolt', 'bomb', 'book', 'bookmark', 'bookmark-o', 'braille', 'briefcase', 'btc', 'bug', 'building', 'building-o', 'bullhorn', 'bullseye', 'bus', 'buysellads', 'cab', 'calculator', 'calendar', 'calendar-check-o', 'calendar-minus-o', 'calendar-o', 'calendar-plus-o', 'calendar-times-o', 'camera', 'camera-retro', 'car', 'caret-down', 'caret-left', 'caret-right', 'caret-square-o-down', 'caret-square-o-left', 'caret-square-o-right', 'caret-square-o-up', 'caret-up', 'cart-arrow-down', 'cart-plus', 'cc', 'cc-amex', 'cc-diners-club', 'cc-discover', 'cc-jcb', 'cc-mastercard', 'cc-paypal', 'cc-stripe', 'cc-visa', 'certificate', 'chain', 'chain-broken', 'check', 'check-circle', 'check-circle-o', 'check-square', 'check-square-o', 'chevron-circle-down', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-up', 'child', 'chrome', 'circle', 'circle-o', 'circle-o-notch', 'circle-thin', 'clipboard', 'clock-o', 'clone', 'close', 'cloud', 'cloud-download', 'cloud-upload', 'cny', 'code', 'code-fork', 'codepen', 'codiepie', 'coffee', 'cog', 'cogs', 'columns', 'comment', 'comment-o', 'commenting', 'commenting-o', 'comments', 'comments-o', 'compass', 'compress', 'connectdevelop', 'contao', 'copy', 'copyright', 'creative-commons', 'credit-card', 'credit-card-alt', 'crop', 'crosshairs', 'css3', 'cube', 'cubes', 'cut', 'cutlery', 'dashboard', 'dashcube', 'database', 'deaf', 'deafness', 'dedent', 'delicious', 'desktop', 'deviantart', 'diamond', 'digg', 'dollar', 'dot-circle-o', 'download', 'dribbble', 'dropbox', 'drupal', 'edge', 'edit', 'eercast', 'eject', 'ellipsis-h', 'ellipsis-v', 'empire', 'envelope', 'envelope-o', 'envelope-open', 'envelope-open-o', 'envelope-square', 'envira', 'eraser', 'etsy', 'eur', 'euro', 'exchange', 'exclamation', 'exclamation-circle', 'exclamation-triangle', 'expand', 'expeditedssl', 'external-link', 'external-link-square', 'eye', 'eye-slash', 'eyedropper', 'fa', 'facebook', 'facebook-f', 'facebook-official', 'facebook-square', 'fast-backward', 'fast-forward', 'fax', 'feed', 'female', 'fighter-jet', 'file', 'file-archive-o', 'file-audio-o', 'file-code-o', 'file-excel-o', 'file-image-o', 'file-movie-o', 'file-o', 'file-pdf-o', 'file-photo-o', 'file-picture-o', 'file-powerpoint-o', 'file-sound-o', 'file-text', 'file-text-o', 'file-video-o', 'file-word-o', 'file-zip-o', 'files-o', 'film', 'filter', 'fire', 'fire-extinguisher', 'firefox', 'first-order', 'flag', 'flag-checkered', 'flag-o', 'flash', 'flask', 'flickr', 'floppy-o', 'folder', 'folder-o', 'folder-open', 'folder-open-o', 'font', 'font-awesome', 'fonticons', 'fort-awesome', 'forumbee', 'forward', 'foursquare', 'free-code-camp', 'frown-o', 'futbol-o', 'gamepad', 'gavel', 'gbp', 'ge', 'gear', 'gears', 'genderless', 'get-pocket', 'gg', 'gg-circle', 'gift', 'git', 'git-square', 'github', 'github-alt', 'github-square', 'gitlab', 'gittip', 'glass', 'glide', 'glide-g', 'globe', 'google', 'google-plus', 'google-plus-circle', 'google-plus-official', 'google-plus-square', 'google-wallet', 'graduation-cap', 'gratipay', 'grav', 'group', 'h-square', 'hacker-news', 'hand-grab-o', 'hand-lizard-o', 'hand-o-down', 'hand-o-left', 'hand-o-right', 'hand-o-up', 'hand-paper-o', 'hand-peace-o', 'hand-pointer-o', 'hand-rock-o', 'hand-scissors-o', 'hand-spock-o', 'hand-stop-o', 'handshake-o', 'hard-of-hearing', 'hashtag', 'hdd-o', 'header', 'headphones', 'heart', 'heart-o', 'heartbeat', 'history', 'home', 'hospital-o', 'hotel', 'hourglass', 'hourglass-1', 'hourglass-2', 'hourglass-3', 'hourglass-end', 'hourglass-half', 'hourglass-o', 'hourglass-start', 'houzz', 'html5', 'i-cursor', 'id-badge', 'id-card', 'id-card-o', 'ils', 'image', 'imdb', 'inbox', 'indent', 'industry', 'info', 'info-circle', 'inr', 'instagram', 'institution', 'internet-explorer', 'intersex', 'ioxhost', 'italic', 'joomla', 'jpy', 'jsfiddle', 'key', 'keyboard-o', 'krw', 'language', 'laptop', 'lastfm', 'lastfm-square', 'leaf', 'leanpub', 'legal', 'lemon-o', 'level-down', 'level-up', 'life-bouy', 'life-buoy', 'life-ring', 'life-saver', 'lightbulb-o', 'line-chart', 'link', 'linkedin', 'linkedin-square', 'linode', 'linux', 'list', 'list-alt', 'list-ol', 'list-ul', 'location-arrow', 'lock', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'low-vision', 'magic', 'magnet', 'mail-forward', 'mail-reply', 'mail-reply-all', 'male', 'map', 'map-marker', 'map-o', 'map-pin', 'map-signs', 'mars', 'mars-double', 'mars-stroke', 'mars-stroke-h', 'mars-stroke-v', 'maxcdn', 'meanpath', 'medium', 'medkit', 'meetup', 'meh-o', 'mercury', 'microchip', 'microphone', 'microphone-slash', 'minus', 'minus-circle', 'minus-square', 'minus-square-o', 'mixcloud', 'mobile', 'mobile-phone', 'modx', 'money', 'moon-o', 'mortar-board', 'motorcycle', 'mouse-pointer', 'music', 'navicon', 'neuter', 'newspaper-o', 'object-group', 'object-ungroup', 'odnoklassniki', 'odnoklassniki-square', 'opencart', 'openid', 'opera', 'optin-monster', 'outdent', 'pagelines', 'paint-brush', 'paper-plane', 'paper-plane-o', 'paperclip', 'paragraph', 'paste', 'pause', 'pause-circle', 'pause-circle-o', 'paw', 'paypal', 'pencil', 'pencil-square', 'pencil-square-o', 'percent', 'phone', 'phone-square', 'photo', 'picture-o', 'pie-chart', 'pied-piper', 'pied-piper-alt', 'pied-piper-pp', 'pinterest', 'pinterest-p', 'pinterest-square', 'plane', 'play', 'play-circle', 'play-circle-o', 'plug', 'plus', 'plus-circle', 'plus-square', 'plus-square-o', 'podcast', 'power-off', 'print', 'product-hunt', 'puzzle-piece', 'qq', 'qrcode', 'question', 'question-circle', 'question-circle-o', 'quora', 'quote-left', 'quote-right', 'ra', 'random', 'ravelry', 'rebel', 'recycle', 'reddit', 'reddit-alien', 'reddit-square', 'refresh', 'registered', 'remove', 'renren', 'reorder', 'repeat', 'reply', 'reply-all', 'retweet', 'rmb', 'road', 'rocket', 'rotate-left', 'rotate-right', 'rouble', 'rss', 'rss-square', 'rub', 'ruble', 'rupee', 'safari', 'save', 'scissors', 'scribd', 'search', 'search-minus', 'search-plus', 'sellsy', 'send', 'send-o', 'server', 'share', 'share-alt', 'share-alt-square', 'share-square', 'share-square-o', 'shekel', 'sheqel', 'shield', 'ship', 'shirtsinbulk', 'shopping-bag', 'shopping-basket', 'shopping-cart', 'shower', 'sign-in', 'sign-language', 'sign-out', 'signal', 'signing', 'simplybuilt', 'sitemap', 'skyatlas', 'skype', 'slack', 'sliders', 'slideshare', 'smile-o', 'snapchat', 'snapchat-ghost', 'snapchat-square', 'snowflake-o', 'soccer-ball-o', 'sort', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-asc', 'sort-desc', 'sort-down', 'sort-numeric-asc', 'sort-numeric-desc', 'sort-up', 'soundcloud', 'space-shuttle', 'spinner', 'spoon', 'spotify', 'square', 'square-o', 'stack-exchange', 'stack-overflow', 'star', 'star-half', 'star-half-empty', 'star-half-full', 'star-half-o', 'star-o', 'steam', 'steam-square', 'step-backward', 'step-forward', 'stethoscope', 'sticky-note', 'sticky-note-o', 'stop', 'stop-circle', 'stop-circle-o', 'street-view', 'strikethrough', 'stumbleupon', 'stumbleupon-circle', 'subscript', 'subway', 'suitcase', 'sun-o', 'superpowers', 'superscript', 'support', 'table', 'tablet', 'tachometer', 'tag', 'tags', 'tasks', 'taxi', 'telegram', 'television', 'tencent-weibo', 'terminal', 'text-height', 'text-width', 'th', 'th-large', 'th-list', 'themeisle', 'thermometer-empty', 'thermometer-full', 'thermometer-half', 'thermometer-quarter', 'thermometer-three-quarters', 'thumb-tack', 'thumbs-down', 'thumbs-o-down', 'thumbs-o-up', 'thumbs-up', 'ticket', 'times', 'times-circle', 'times-circle-o', 'tint', 'toggle-down', 'toggle-left', 'toggle-off', 'toggle-on', 'toggle-right', 'toggle-up', 'trademark', 'train', 'transgender', 'transgender-alt', 'trash', 'trash-o', 'tree', 'trello', 'tripadvisor', 'trophy', 'truck', 'try', 'tty', 'tumblr', 'tumblr-square', 'turkish-lira', 'tv', 'twitch', 'twitter', 'twitter-square', 'umbrella', 'underline', 'undo', 'universal-access', 'university', 'unlink', 'unlock', 'unlock-alt', 'unsorted', 'upload', 'usb', 'usd', 'user', 'user-circle', 'user-circle-o', 'user-md', 'user-o', 'user-plus', 'user-secret', 'user-times', 'users', 'venus', 'venus-double', 'venus-mars', 'viacoin', 'viadeo', 'viadeo-square', 'video-camera', 'vimeo', 'vimeo-square', 'vine', 'vk', 'volume-control-phone', 'volume-down', 'volume-off', 'volume-up', 'warning', 'wechat', 'weibo', 'weixin', 'whatsapp', 'wheelchair', 'wheelchair-alt', 'wifi', 'wikipedia-w', 'window-close', 'window-close-o', 'window-maximize', 'window-minimize', 'window-restore', 'windows', 'won', 'wordpress', 'wpbeginner', 'wpexplorer', 'wpforms', 'wrench', 'xing', 'xing-square', 'y-combinator', 'y-combinator-square', 'yahoo', 'yc', 'yc-square', 'yelp', 'yen', 'yoast', 'youtube', 'youtube-play', 'youtube-square',);
	}
}
