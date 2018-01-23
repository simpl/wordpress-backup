/**
 * Theme Customizer enhancements for a better user experience
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously
 */

( function( $ ) {

	wp.customize('header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {
				$( 'body' ).removeClass( 'title-tagline-hidden' );
				$('.site-title a').css('color', to );
			}			
		} );
	} );

	wp.customize('background_color', function( value ) {
		value.bind( function( to ) {
			if ( to === '#ffffff') {
				var style = '<style>article,.single article,.single article:hover,.woocommerce .woocommerce-result-count,.woocommerce .woocommerce-ordering,.woocommerce div.product{padding: 0;margin-bottom: 0;}</style>';
				$('head').append( style );
			} else {
				var style = '<style>article,.single article,.single article:hover,.woocommerce div.product{padding: 20px;margin-bottom: 20px;}.woocommerce .woocommerce-result-count{padding: 5px 10px;}</style>';
				$('head').append( style );
			}
		} );
	} );

	wp.customize('header_light', function( value ) {
		value.bind( function( to ) {
			if ( 'light' === to ) {
				$( '#masthead' ).addClass( 'light' );
				$( '.main-header' ).addClass( 'light' );
			} else if ( 'dark' === to ) {
				$( '#masthead' ).removeClass( 'light' );
				$( '.main-header' ).removeClass( 'light' );
			}			
		} );
	} );

	wp.customize('hi_color', function( value ) {
		value.bind( function( to ) {
			var titlebg = hex2rgba(to, '0.8');
			var breadbg = hex2rgba(to, '0.7');
			var featicon = hex2rgba(to, '0.45');
			var style_bgcolor = '.entry-content h1:before,.entry-content h2:before,.entry-content h3:before,.entry-content h4:before,.entry-content h5:before,.entry-content h6:before,.entry-header .entry-title:before,#secondary .widget .widget-title:before,h3#reply-title:before,h3.comments-title:before,.woocommerce h2:before,.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after{background-color:' + to + ';}';
			var style_bg = 'button,input[type="button"],input[type="reset"],input[type="submit"],.entry-meta span .fa,.entry-footer span .fa,.comment-navigation .nav-previous a,.comment-navigation .nav-next a,#top-bar a.button,#top-bar button, #top-bar input[type="button"], #top-bar input[type="reset"], #top-bar input[type="submit"],.top-cart:hover .item-count,.top-login-dropdown #respond input#submit, .top-login-dropdown a.button, .top-login-dropdown button.button, .top-login-dropdown input.button,.top-login-mini-cart #respond input#submit, .top-login-mini-cart a.button, .top-login-mini-cart button.button, .top-login-mini-cart input.button,.featured-post:hover .featured-icon,#cta-section a:hover .cta-icon .fa,#cta-section a.button,#footer-menu a[href*="codepen.io"]:hover:before,#footer-menu a[href*="digg.com"]:hover:before,#footer-menu a[href*="dribbble.com"]:hover:before,#footer-menu a[href*="dropbox.com"]:hover:before,#footer-menu a[href*="facebook.com"]:hover:before,#footer-menu a[href*="flickr.com"]:hover:before,#footer-menu a[href*="foursquare.com"]:hover:before,#footer-menu a[href*="plus.google.com"]:hover:before,#footer-menu a[href*="github.com"]:hover:before,#footer-menu a[href*="instagram.com"]:hover:before,#footer-menu a[href*="linkedin.com"]:hover:before,#footer-menu a[href*="pinterest.com"]:hover:before,#footer-menu a[href*="getpocket.com"]:hover:before,#footer-menu a[href*="reddit.com"]:hover:before,#footer-menu a[href*="skype.com"]:hover:before,#footer-menu a[href*="stumbleupon.com"]:hover:before,#footer-menu a[href*="tumblr.com"]:hover:before,#footer-menu a[href*="twitter.com"]:hover:before,#footer-menu a[href*="vimeo.com"]:hover:before,#footer-menu a[href*="wordpress.com"]:hover:before,#footer-menu a[href*="wordpress.org"]:hover:before,#footer-menu a[href*="youtube.com"]:hover:before,#footer-menu a[href^="mailto:"]:hover:before,#footer-menu a[href*="spotify.com"]:hover:before,#footer-menu a[href*="twitch.tv"]:hover:before,#footer-menu a[href$="/feed/"]:hover:before,.woocommerce ul.products li.product .button.add_to_cart_button,.woocommerce ul.products li.product .button,.woocommerce a.added_to_cart,.woocommerce div.product div.images .woocommerce-product-gallery__trigger,.woocommerce ul.products li.product .price,.woocommerce ul.products li.product .price:before,.woocommerce div.product p.price,.woocommerce div.product p.price:before,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.page .woocommerce-tabs ul.tabs li:before,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{background:' + to + ';}';
			var style_color = 'a,a:hover,a:focus,a:active,.single-entry-content a,.widget-area a:hover,.comment-list a:hover,#top-bar a:hover,#top-bar .fa,#site-description,.top-tel .fa,.top-login-dropdown .top-login-register:before,#primary-menu li a:hover,#primary-menu li.current-menu-item a,#primary-menu ul li a:hover,#cta-section .cta-icon .fa,.pagination a:hover,.pagination .current,article.post.sticky .entry-header .entry-title:after,.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce .woocommerce-message:before,.woocommerce .woocommerce-info:before,#masthead.light #top-bar a,#masthead.light #top-bar .fa:hover,#masthead.light #primary-menu li a:hover{color:' + to + ';}';
			var style_border = '#cta-section a:hover .cta-tel-before,#cta-section a:hover .cta-tel-after,.comment-navigation .nav-next a:after,.comment-navigation .nav-previous a:after,.featured-post,.pagination a:hover,.pagination .current,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce div.product div.images .flex-control-thumbs li img.flex-active, .woocommerce div.product div.images .flex-control-thumbs li img:hover{border-color:' + to + ';}';
			var style_boxshadow = '#footer-menu a[href*="codepen.io"]:before,#footer-menu a[href*="digg.com"]:before,#footer-menu a[href*="dribbble.com"]:before,#footer-menu a[href*="dropbox.com"]:before,#footer-menu a[href*="facebook.com"]:before,#footer-menu a[href*="flickr.com"]:before,#footer-menu a[href*="foursquare.com"]:before,#footer-menu a[href*="plus.google.com"]:before,#footer-menu a[href*="github.com"]:before,#footer-menu a[href*="instagram.com"]:before,#footer-menu a[href*="linkedin.com"]:before,#footer-menu a[href*="pinterest.com"]:before,#footer-menu a[href*="getpocket.com"]:before,#footer-menu a[href*="reddit.com"]:before,#footer-menu a[href*="skype.com"]:before,#footer-menu a[href*="stumbleupon.com"]:before,#footer-menu a[href*="tumblr.com"]:before,#footer-menu a[href*="twitter.com"]:before,#footer-menu a[href*="vimeo.com"]:before,#footer-menu a[href*="wordpress.com"]:before,#footer-menu a[href*="wordpress.org"]:before,#footer-menu a[href*="youtube.com"]:before,#footer-menu a[href^="mailto:"]:before,#footer-menu a[href*="spotify.com"]:before,#footer-menu a[href*="twitch.tv"]:before,#footer-menu a[href$="/feed/"]:before{box-shadow: inset 0 0 0 ' + to + ';}#footer-menu a[href*="codepen.io"]:hover:before,#footer-menu a[href*="digg.com"]:hover:before,#footer-menu a[href*="dribbble.com"]:hover:before,#footer-menu a[href*="dropbox.com"]:hover:before,#footer-menu a[href*="facebook.com"]:hover:before,#footer-menu a[href*="flickr.com"]:hover:before,#footer-menu a[href*="foursquare.com"]:hover:before,#footer-menu a[href*="plus.google.com"]:hover:before,#footer-menu a[href*="github.com"]:hover:before,#footer-menu a[href*="instagram.com"]:hover:before,#footer-menu a[href*="linkedin.com"]:hover:before,#footer-menu a[href*="pinterest.com"]:hover:before,#footer-menu a[href*="getpocket.com"]:hover:before,#footer-menu a[href*="reddit.com"]:hover:before,#footer-menu a[href*="skype.com"]:hover:before,#footer-menu a[href*="stumbleupon.com"]:hover:before,#footer-menu a[href*="tumblr.com"]:hover:before,#footer-menu a[href*="twitter.com"]:hover:before,#footer-menu a[href*="vimeo.com"]:hover:before,#footer-menu a[href*="wordpress.com"]:hover:before,#footer-menu a[href*="wordpress.org"]:hover:before,#footer-menu a[href*="youtube.com"]:hover:before,#footer-menu a[href^="mailto:"]:hover:before,#footer-menu a[href*="spotify.com"]:hover:before,#footer-menu a[href*="twitch.tv"]:hover:before,#footer-menu a[href$="/feed/"]:hover:before{box-shadow: inset 0 -40px 0 ' + to + ';}';
			var style_bg_rgba = '.main-title{background:' + titlebg + ';}.featured-post:hover .featured-icon,#cta-section a:hover .cta-icon .fa{box-shadow: 0px 0px 0px 4px ' + featicon + ';}.breadcrumbs .trail-items{background:' + breadbg + ';}';
			$('head').append('<style>' + style_bgcolor + style_bg + style_color + style_border + style_boxshadow + style_bg_rgba + '</style>');
		} );
	} );

	wp.customize('sec_color', function( value ) {
		value.bind( function( to ) {
			var titlebg = hex2rgba(to, '0.8');
			var featicon = hex2rgba(to, '0.45');
			var style_bgcolor = '.trusted-modal,.top-login-dropdown,.top-login-mini-cart{background-color:' + to + ';}';
			var style_bg = '#masthead,#top-bar ul > li > ul,#primary-menu ul,.featured-post .featured-icon,#colophon,.woocommerce div.product form.variations_form.cart,.woocommerce div.product p.variations_form.cart,#masthead.light .top-tel .mobile-clear:hover .fa,#masthead.light .top-login:hover .fa,#masthead.light .top-cart:hover .fa{background:' + to + ';}@media screen and (max-width: 1024px){#primary-menu,.site-navigation.centered #primary-menu{background:' + to + ';}}';
			var style_color = '.header-title .fa,.top-cart .item-count,#footer-menu a:before,#footer-menu a[href*="codepen.io"]:hover:before,#footer-menu a[href*="digg.com"]:hover:before,#footer-menu a[href*="dribbble.com"]:hover:before,#footer-menu a[href*="dropbox.com"]:hover:before,#footer-menu a[href*="facebook.com"]:hover:before,#footer-menu a[href*="flickr.com"]:hover:before,#footer-menu a[href*="foursquare.com"]:hover:before,#footer-menu a[href*="plus.google.com"]:hover:before,#footer-menu a[href*="github.com"]:hover:before,#footer-menu a[href*="instagram.com"]:hover:before,#footer-menu a[href*="linkedin.com"]:hover:before,#footer-menu a[href*="pinterest.com"]:hover:before,#footer-menu a[href*="getpocket.com"]:hover:before,#footer-menu a[href*="reddit.com"]:hover:before,#footer-menu a[href*="skype.com"]:hover:before,#footer-menu a[href*="stumbleupon.com"]:hover:before,#footer-menu a[href*="tumblr.com"]:hover:before,#footer-menu a[href*="twitter.com"]:hover:before,#footer-menu a[href*="vimeo.com"]:hover:before,#footer-menu a[href*="wordpress.com"]:hover:before,#footer-menu a[href*="wordpress.org"]:hover:before,#footer-menu a[href*="youtube.com"]:hover:before,#footer-menu a[href^="mailto:"]:hover:before,#footer-menu a[href*="spotify.com"]:hover:before,#footer-menu a[href*="twitch.tv"]:hover:before,#footer-menu a[href$="/feed/"]:hover:before{color:' + to + ';}';
			var style_textshadow = '.main-excerpt p,.taxonomy-description p,.term-description p,.page-description p{text-shadow: 0 1px 0 ' + to + ';}';
			var style_bg_rgba = '.main-excerpt p,.taxonomy-description p,.term-description p,.page-description p{background:' + titlebg + ';}#cta-section{background-color:' + titlebg + ';}.featured-post .featured-icon{box-shadow: 0px 0px 0px 4px ' + featicon + ';}';			
			$('head').append('<style>' + style_bgcolor + style_bg + style_color + style_textshadow + style_bg_rgba + '</style>');
		} );
	} );

	// Site title and description.
	wp.customize('blogname', function( value ) {
		value.bind( function( to ) {
			$('.site-title a').text( to );
		} );
	} );
	wp.customize('blogdescription', function( value ) {
		value.bind( function( to ) {
			$('.site-description').text( to );
		} );
	} );

	wp.customize('tel_no', function( value ) {
		value.bind( function( to ) {
			if ( to == '' ) {
				if ( ! $('.top-login').length ) {
					$('#site-description').addClass('no-woo');
					$('#top-info').addClass('no-woo');
				}
				$('#site-description.no-woo').addClass('eighty');
				$('#top-info.no-woo').css( {'display': 'none'} );
				$('.mobile-clear a').html( '' );
				$('.top-login').addClass('no-background');
				$('.top-cart').addClass('no-background');

				$('.cta-icon').css( {'display': 'none'} );
				$('.cta-tel').html( '' );
			} else {
				$('#site-description.no-woo').removeClass('eighty');
				$('#top-info.no-woo').css( {'display': 'block'} );
				$('.mobile-clear a').html( '<i class="fa fa-phone"></i>' + to );
				$('.top-login').removeClass('no-background');
				$('.top-cart').removeClass('no-background');

				$('.cta-icon').css( {'display': 'block'} );
				$('.cta-tel').html( '<span class="cta-tel-before"></span>' + to + '<span class="cta-tel-after"></span>' );
			}			
		} );
	} );

	wp.customize('site_title_uppercase', function( value ) {
		value.bind( function( to ) {
			if (to) {
				$('.site-title a').css( {'text-transform': 'uppercase'} );
			} else {
				$('.site-title a').css( {'text-transform': 'none'} );
			}
		} );
	} );

	wp.customize('menu_uppercase', function( value ) {
		value.bind( function( to ) {
			if (to) {
				$('#primary-menu a').css( {'text-transform': 'uppercase'} );
			} else {
				$('#primary-menu a').css( {'text-transform': 'none'} );
			}
		} );
	} );	

	wp.customize('headings_underline', function( value ) {
		value.bind( function( to ) {
			if (to) {
				var style = '.entry-content h1:before, .entry-content h2:before, .entry-content h3:before, .entry-content h4:before, .entry-content h5:before, .entry-content h6:before,.entry-content h1:after, .entry-content h2:after, .entry-content h3:after, .entry-content h4:after, .entry-content h5:after, .entry-content h6:after {display: none;}';
			} else {
				var style = '.entry-content h1:before, .entry-content h2:before, .entry-content h3:before, .entry-content h4:before, .entry-content h5:before, .entry-content h6:before,.entry-content h1:after, .entry-content h2:after, .entry-content h3:after, .entry-content h4:after, .entry-content h5:after, .entry-content h6:after {display: block;}';
			}
			$('head').append('<style>' + style + '</style>');
		} );
	} );

	wp.customize('sidebar_position', function( value ) {
		value.bind( function( to ) {
			if (to === 'left') {
				$('#primary').css( {'float': 'right'} );
				$('#secondary').css( {'float': 'left'} );
			} else {
				$('#primary').css( {'float': 'left'} );
				$('#secondary').css( {'float': 'right'} );
			}
		} );
	} );

	// Extra colors
	wp.customize('body_text_color', function( value ) {
		value.bind( function( to ) {
			$('body').css('color', to );
			$('.featured-readmore').css('color', to );
			$('.pagination span,.pagination .dots,.pagination a').css('color', to );
			$('.woocommerce nav.woocommerce-pagination ul li a,.woocommerce nav.woocommerce-pagination ul li span').css('color', to );
			var style = '#masthead.light #top-bar,#masthead.light .top-tel,#masthead.light .top-tel .mobile-clear a,#masthead.light #primary-menu li a,.main-header.light .main-excerpt p,.main-header.light .term-description p,.main-header.light .page-description p,.main-header.light .taxonomy-description p{color:' + to + ';}';
			$('head').append('<style>' + style + '</style>');
		} );
	} );

	wp.customize('heading_color', function( value ) {
		value.bind( function( to ) {
			$('h1').css('color', to );
			$('h2').css('color', to );
			$('h3').css('color', to );
			$('h4').css('color', to );
			$('h5').css('color', to );
			$('h6').css('color', to );
			$('.entry-header .entry-title a').css('color', to );
			$('#secondary .widget .widget-title').css('color', to );
			$('.featured-post h4').css('color', to );
			$('.featured-post h4 a').css('color', to );
			$('.page .woocommerce-tabs ul.tabs li a').css('color', to );
			$('.woocommerce div.product .woocommerce-tabs ul.tabs li a').css('color', to );
			$('.main-title').css( {'color': '#ffffff'} );
			$('#colophon h5.widget-title').css( {'color': '#fafafa'} );
		} );
	} );

	wp.customize('about_layout', function( value ) {
		value.bind( function( to ) {
			if ( to == 'style2' ) {
				$('#about-section').removeClass('style3').removeClass('style4').addClass('style2');
			} else if ( to == 'style3' ) {
				$('#about-section').removeClass('style2').removeClass('style4').addClass('style3');
			} else if ( to == 'style4' ) {
				$('#about-section').removeClass('style2').removeClass('style3').addClass('style4');
			} else {
				$('#about-section').removeClass('style2').removeClass('style3').removeClass('style4');
			}
		} );
	} );

	wp.customize('cta_img', function( value ) {
		value.bind( function( to ) {
			var style = '<style>#cta-section {background-image: url(' + to + ')}</style>';
			$('head').append( style );
		} );
	} );

	// Google fonts
	wp.customize('font_header', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to.replace(" ", "+"));
			$('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$('#masthead,.site-title').css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_nav', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to);
			$('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$('.site-navigation').css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_page_title', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to.replace(" ", "+"));
			$('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$('.main-title').css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_content', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to);
			$('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$('body,button,input,select,textarea').css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_headings', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to.replace(" ", "+"));
			var to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
			$('#primary h1,#secondary h1,#colophon h1,#primary h2,#secondary h2,#colophon h2,#primary h3,#secondary h3,#colophon h3,.featured-post h4,#primary h4,#secondary h4,#colophon h4,#primary h5,#secondary h5,#colophon h5,#primary h6,#secondary h6,#colophon h6,.page .woocommerce-tabs ul.tabs li a,.woocommerce div.product .woocommerce-tabs ul.tabs li a').css({
				fontFamily: to
			});
		} );
	} );
	wp.customize('font_footer', function( value ) {
		value.bind( function( to ) {
			var googlefont = encodeURI(to);
			$('head').append('<link href="//fonts.googleapis.com/css?family=' + googlefont + '" type="text/css" media="all" rel="stylesheet">');
			to = to.substr(0, to.indexOf(':'));
			to = "'" + to + "'";
			$('#colophon').css({
				fontFamily: to
			});
		} );
	} );

	// Featured Page icons
	wp.customize('featured_page_icon1', function( value ) {
		value.bind( function( to ) {
			$('.featured-post1 i').removeClass().addClass(''+to);
		} );
	} );
	wp.customize('featured_page_icon2', function( value ) {
		value.bind( function( to ) {
			$('.featured-post2 i').removeClass().addClass(''+to);
		} );
	} );
	wp.customize('featured_page_icon3', function( value ) {
		value.bind( function( to ) {
			$('.featured-post3 i').removeClass().addClass(''+to);
		} );
	} );

	wp.customize( 'head_bg_color', function( value ) {
    	value.bind( function( to ) {
    		$('.main-header').css( 'background-color', to );
		} );
	} );

	wp.customize( 'header_image_x_pos', function( value ) {
    	value.bind( function( to ) {
    		$('.main-header').css( {'background-position-x': to + '%'} );
		} );
	} );

} )( jQuery );


function hex2rgb( colour ) {
	var r,g,b;
	if ( colour.charAt(0) == '#') {
		colour = colour.substr(1);
	}

	r = colour.charAt(0) + '' + colour.charAt(1);
	g = colour.charAt(2) + '' + colour.charAt(3);
	b = colour.charAt(4) + '' + colour.charAt(5);

	r = parseInt( r,16 );
	g = parseInt( g,16 );
	b = parseInt( b,16);
	return 'rgb(' + r + ',' + g + ',' + b + ')';
}

function hex2rgba( colour, opacity ) {
	var r,g,b;
	if ( colour.charAt(0) == '#') {
	colour = colour.substr(1);
	}

	r = colour.charAt(0) + '' + colour.charAt(1);
	g = colour.charAt(2) + '' + colour.charAt(3);
	b = colour.charAt(4) + '' + colour.charAt(5);

	r = parseInt( r,16 );
	g = parseInt( g,16 );
	b = parseInt( b,16);
	return 'rgba(' + r + ',' + g + ',' + b + ',' + opacity + ')';
}