<?php
/**
 * Core theme functions
 *
 * @package Anima
 */


 /**
  * Calculates the correct content_width value depending on site with and configured layout
  */
if ( ! function_exists( 'anima_content_width' ) ) :
function anima_content_width() {
   global $content_width;
   $deviation = 0.80;

   $options = cryout_get_option( array(
       'anima_sitelayout', 'anima_landingpage', 'anima_magazinelayout', 'anima_sitewidth', 'anima_primarysidebar', 'anima_secondarysidebar',
   ) );

   $content_width = 0.98 * (int)$options['anima_sitewidth'];

   switch( $options['anima_sitelayout'] ) {
       case '2cSl': case '3cSl': case '3cSr': case '3cSs': $content_width -= (int)$options['anima_primarysidebar']; // primary sidebar
       case '2cSr': case '3cSl': case '3cSr': case '3cSs': $content_width -= (int)$options['anima_secondarysidebar']; break; // secondary sidebar
   }

   if ( is_front_page() && $options['anima_landingpage'] ) {
       // landing page could be a special case;
   }

   if ( ! is_singular() ) {
       switch ( $options['anima_magazinelayout'] ):
           case 2: $content_width = floor($content_width*0.98/2); break; // magazine-two
           case 3: $content_width = floor($content_width*0.96/3); break; // magazine-three
       endswitch;
   };

   $content_width = floor($content_width*$deviation);

} // anima_content_width()
endif;

 /**
  * Calculates the correct featured image width depending on site with and configured layout
  * Used by anima_setup()
  */
if ( ! function_exists( 'anima_featured_width' ) ) :
function anima_featured_width() {

   $options = cryout_get_option( array(
       'anima_sitelayout', 'anima_landingpage', 'anima_magazinelayout', 'anima_sitewidth', 'anima_primarysidebar', 'anima_secondarysidebar',
       'anima_lplayout',
   ) );

   $width = (int)$options['anima_sitewidth'];

   $deviation = 0.02 * $width; // content to sidebar(s) margin

   switch( $options['anima_sitelayout'] ) {
       case '2cSl': case '3cSl': case '3cSr': case '3cSs': $width -= (int)$options['anima_primarysidebar'] + $deviation; // primary sidebar
       case '2cSr': case '3cSl': case '3cSr': case '3cSs': $width -= (int)$options['anima_secondarysidebar'] + $deviation; break; // secondary sidebar
   }

   if ( is_front_page() && $options['anima_landingpage'] ) {
       // landing page is a special case
       $width = ceil( (int)$options['anima_sitewidth'] / (int)$options['anima_magazinelayout'] );
   }

   if ( ! is_singular() ) {
       switch ( $options['anima_magazinelayout'] ):
           case 2: $width = ceil($width*0.94/2); break; // magazine-two
           case 3: $width = ceil($width*0.88/3); break; // magazine-three
       endswitch;
   };

   return ceil($width);

} // anima_featured_width()
endif;


 /**
  * Check if a header image is being used
  * Returns the URL of the image or FALSE
  */
if ( ! function_exists( 'anima_header_image_url' ) ) :
function anima_header_image_url() {
	$limit = 0.75;
	$anima_fheader = cryout_get_option( 'anima_fheader' );
	$anima_headerh = floor( cryout_get_option( 'anima_headerheight' ) * $limit );
	$anima_headerw = floor( cryout_get_option( 'anima_sitewidth' ) * $limit );

	// Check if this is a post or page, if it has a thumbnail, and if it's a big one
	global $post;
	$header_image = FALSE;
	if ( get_header_image() != '' ) { $header_image = get_header_image(); }
	if ( is_singular() && has_post_thumbnail( $post->ID ) && $anima_fheader &&
		( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'anima-header' ) )
		 ) :
			if ( ( absint($image[1]) >= $anima_headerw ) && ( absint($image[2]) >= $anima_headerh ) ) {
				// 'header' image is large enough
				$header_image = $image[0];
			} else {
				// 'header' image too small, try 'full' image instead
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				if ( ( absint($image[1]) >= $anima_headerw ) && ( absint($image[2]) >= $anima_headerh ) ) {
					// 'full' image is large enough
					$header_image = $image[0];
				} else {
					// even 'full' image is too small, don't return an image
					//$header_image = false;
				}
			}
	endif;

	return $header_image;
} //anima_header_image_url()
endif;

/**
 * Header image handler
 * Both as normal img and background image
 */
add_action ( 'cryout_headerimage_hook', 'anima_header_image', 99 );
if ( ! function_exists( 'anima_header_image' ) ) :
function anima_header_image() {
	$header_image = anima_header_image_url();
	if ( is_front_page() && function_exists( 'the_custom_header_markup' ) && has_header_video() ) {
		the_custom_header_markup();
	} elseif ( ! empty( $header_image ) ) { ?>
			<div class="header-image" <?php echo cryout_echo_bgimage( esc_url( $header_image ) ) ?>></div>
			<img class="header-image" alt="<?php if ( is_single() ) the_title_attribute(); elseif ( is_archive() ) echo strip_tags( get_the_archive_title() ); else echo get_bloginfo( 'name' ) ?>" src="<?php echo esc_url( $header_image ) ?>" />
			<?php cryout_header_widget_hook(); ?>
	<?php }
} // anima_header_image()
endif;

if ( ! function_exists( 'anima_header_title_check' ) ) :
function anima_header_title_check() {
    $options = cryout_get_option( array( 'anima_headertitles_posts', 'anima_headertitles_pages', 'anima_headertitles_archives', 'anima_headertitles_home'  ) );
    if ( ( is_single() && $options['anima_headertitles_posts'] ) ||
    ( is_page() && $options['anima_headertitles_pages'] ) ||
    ( ( is_archive() || is_search() || is_404() ) && $options['anima_headertitles_archives'] ) ||
    ( ( is_home() ) && $options['anima_headertitles_home'] ) ) {
        return true;
    }
} //anima_header_title_check
endif;

/**
 * Header Title and meta
 */
add_action ( 'cryout_headerimage_hook', 'anima_header_title', 100 );
if ( ! function_exists( 'anima_header_title' ) ) :
function anima_header_title() {
    if ( anima_header_title_check() ) : ?>
    <div id="header-page-title">
        <div id="header-page-title-inside">
            <?php if ( is_singular() )  {
                the_title( '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>', '</h1>' );
                } elseif ( is_home() ) {
                    echo '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</h1><p class="byline">' . esc_attr( get_bloginfo( 'description', 'display' ) ) . '</p>';
                } else {
                    echo '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>';
                    if ( is_archive() ) {
                        echo get_the_archive_title();
                    }
                    if ( is_search() ) {
                        printf( __( 'Search Results for: %s', 'anima' ), '<strong>' . get_search_query() . '</strong>' );
                    }
                    if ( is_404() ) {
                        _e( 'Not Found', 'anima' );
                    }
                    echo '</h1>';
                    if ( is_search() ) get_search_form();
            } ?>
            <div class="entry-meta aftertitle-meta">
                <?php cryout_post_meta_hook(); ?>
            </div><!-- .entry-meta -->
            <?php cryout_breadcrumbs_hook();?>
        </div>
    </div> <?php endif;
} // anima_header_title()
endif;


/**
 * Adds title and description to header
 * Used in header.php
*/
if ( ! function_exists( 'anima_title_and_description' ) ) :
function anima_title_and_description() {

	$options = cryout_get_option( array( 'anima_logoupload', 'anima_siteheader' ) );

	if ( in_array( $options['anima_siteheader'], array( 'logo', 'both' ) ) ) {
		echo anima_logo_helper( $options['anima_logoupload'] );
	}
	if ( in_array( $options['anima_siteheader'], array( 'title', 'both', 'logo', 'empty' ) ) ) {
		$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
		echo '<div id="site-text">';
		echo '<' . $heading_tag . cryout_schema_microdata( 'site-title', 0 ) . ' id="site-title">';
		echo '<span> <a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> </span>';
		echo '</' . $heading_tag . '>';
		echo '<span id="site-description" ' . cryout_schema_microdata( 'site-description', 0 ) . ' >' . esc_attr( get_bloginfo( 'description' ) ). '</span>';
		echo '</div>';
	}
} // anima_title_and_description()
endif;
add_action ( 'cryout_branding_hook', 'anima_title_and_description' );

function anima_logo_helper( $anima_logo ) {
	if ( function_exists( 'the_custom_logo' ) ) {
		// WP 4.5+
		$wp_logo = str_replace( 'class="custom-logo-link"', 'id="logo" class="custom-logo-link" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"', get_custom_logo() );
		if ( ! empty( $wp_logo ) ) return '<div class="identity">' . $wp_logo . '</div>';
	} else {
		// older WP
		if ( ! empty( $anima_logo ) ) :
			$img = wp_get_attachment_image_src( $anima_logo, 'full' );
			return '<div class="identity"><a id="logo" href="' . esc_url( home_url( '/' ) ) . '" ><img title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="' . esc_url( $img[0] ) . '" /></a></div>';
		endif;
	}
	return '';
} // anima_logo_helper()

// cryout_schema_publisher() located in cryout/prototypes.php
add_action( 'cryout_after_inner_hook', 'cryout_schema_publisher' );
add_action( 'cryout_singular_after_inner_hook', 'cryout_schema_publisher' );

// cryout_schema_main() located in cryout/prototypes.php
add_action( 'cryout_after_inner_hook', 'cryout_schema_main' );
add_action( 'cryout_singular_after_inner_hook', 'cryout_schema_main' );
/**
 * Anima back to top button
 * Creates div for js
*/

function anima_back_top() {
	echo '<div id="toTop"><i class="icon-back2top"></i> </div>';
} // anima_back_top()
add_action ( 'cryout_footer_hook', 'anima_back_top' );


/**
 * Creates pagination for blog pages.
 */
if ( ! function_exists( 'anima_pagination' ) ) :
function anima_pagination( $pages = '', $range = 2, $prefix ='' ) {
	$pagination = cryout_get_option( 'anima_pagination' );
	if ( $pagination && function_exists( 'the_posts_pagination' ) ):
		the_posts_pagination( array(
			'prev_text' => '<i class="icon-pagination-left"></i>',
			'next_text' => '<i class="icon-pagination-right"></i>',
			'mid_size' => $range
		) );
	else:
		//posts_nav_link();
		anima_content_nav( 'nav-old-below' );
	endif;

} // anima_pagination()
endif;

/**
 * Prev/Next page links
 */
if ( ! function_exists( 'anima_nextpage_links' ) ) :
function anima_nextpage_links( $defaults ) {
	$args = array(
		'link_before'      => '<em>',
		'link_after'       => '</em>',
	);
	$r = wp_parse_args( $args, $defaults );
	return $r;
} // anima_nextpage_links()
endif;
add_filter( 'wp_link_pages_args', 'anima_nextpage_links' );


/**
 * Footer Hook
 */
add_action( 'cryout_master_footer_hook', 'anima_master_footer' );
function anima_master_footer() {
	$anima_theme = wp_get_theme();
	do_action( 'cryout_footer_hook' );
	echo '<div id="footer-separator"></div>';
	echo '<div id="site-copyright">' . wp_kses_post( cryout_get_option( 'anima_copyright' ) ) . '</div>';
	echo '<div style="display:block;float:right;clear: right;">' . __( "Powered by", "anima" ) .
		'<a target="_blank" href="' . esc_html( $anima_theme->get( 'ThemeURI' ) ) . '" title="';
	echo 'Anima WordPress Theme by ' . 'Cryout Creations"> ' . 'Anima' .'</a> &amp; <a target="_blank" href="' . "http://wordpress.org/";
	echo '" title="' . esc_attr__( "Semantic Personal Publishing Platform", "anima") . '"> ' . sprintf( " %s.", "WordPress" ) . '</a></div>';
}

/*
 * Sidebar handler
*/
if ( ! function_exists( 'anima_get_sidebar' ) ) :
function anima_get_sidebar() {
	global $post;
	if ( get_post() ) { $anima_meta_layout = get_post_meta( $post->ID, '_anima_layout', true ); }

	if ( isset( $anima_meta_layout ) && $anima_meta_layout ) {
		$anima_sitelayout =  $anima_meta_layout;
	}
	else $anima_sitelayout = cryout_get_option( 'anima_sitelayout' );
	switch( $anima_sitelayout ) {
		case '2cSl':
			get_sidebar( 'left' );
		break;

		case '2cSr':
			get_sidebar( 'right' );
		break;

		case '3cSl' : case '3cSr' : case '3cSs' :
			get_sidebar( 'left' );
			get_sidebar( 'right' );
		break;

		default:
		break;
	}
} // anima_get_sidebar()
endif;

/*
 * General layout class
 */
if ( ! function_exists( 'anima_get_layout_class' ) ) :
function anima_get_layout_class() {
	global $post;
	if ( get_post() ) { $anima_meta_layout = get_post_meta( $post->ID, '_anima_layout', true ); }

	if ( isset( $anima_meta_layout ) && $anima_meta_layout ) {
		$anima_sitelayout =  $anima_meta_layout;
	}
	else $anima_sitelayout = cryout_get_option( 'anima_sitelayout' );

	/*  If not, return the general layout */
	switch( $anima_sitelayout ) {
		case '2cSl': return "two-columns-left"; break;
		case '2cSr': return "two-columns-right"; break;
		case '3cSl': return "three-columns-left"; break;
		case '3cSr' : return "three-columns-right"; break;
		case '3cSs' : return "three-columns-sided"; break;
		case '1c':
		default: return "one-column"; break;
	}
} // anima_get_layout_class()
endif;

/**
* Checks the browser agent string for mobile ids and adds "mobile" class to body if true
* @return array list of classes.
*/
function anima_mobile_body_class( $classes ){
	$browser = ( ! empty( $_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
	$keys = 'mobile|android|mobi|tablet|ipad|opera mini|series 60|s60|blackberry';
	if ( preg_match( "/($keys)/i", $browser ) ) : $classes[] = 'mobile'; endif; // mobile browser detected
	return $classes;
} // anima_mobile_body_class()
add_filter( 'body_class', 'anima_mobile_body_class');


/**
* Creates breadcrumbs with page sublevels and category sublevels.
* Hooked in master hook
*/
if ( ! function_exists( 'anima_breadcrumbs' ) ) :
function anima_breadcrumbs() {
	cryout_breadcrumbs(
		'<i class="icon-bread-arrow"></i>',						// $separator
		'<i class="icon-bread-home"></i>', 						// $home
		1,														// $showCurrent
		'<span class="current">', 								// $before
		'</span>', 												// $after
		'<div id="breadcrumbs-container" class="cryout %1$s"><div id="breadcrumbs-container-inside"><div id="breadcrumbs"> <nav id="breadcrumbs-nav" %2$s>', // $wrapper_pre
		'</nav></div></div></div><!-- breadcrumbs -->', 		// $wrapper_post
		anima_get_layout_class(),								// $layout_class
		__( 'Home', 'anima' ),									// $text_home
		__( 'Archive for category', 'anima' ),					// $text_archive
		__( 'Search results for', 'anima' ), 					// $text_search
		__( 'Posts tagged', 'anima' ), 						// $text_tag
		__( 'Articles posted by', 'anima' ), 					// $text_author
		__( 'Not Found', 'anima' ),							// $text_404
		__( 'Post format', 'anima' ),							// $text_format
		__( 'Page', 'anima' )									// $text_page
	);
} // anima_breadcrumbs()
endif;


/**
 * Adds searchboxes to the appropriate menu location
 * Hooked in master hook
 */
if ( ! function_exists( 'cryout_search_menu' ) ) :
function cryout_search_menu( $items, $args ) {
$options = cryout_get_option( array( 'anima_searchboxmain', 'anima_searchboxfooter' ) );
	if( $args->theme_location == 'primary' && $options['anima_searchboxmain'] ) {
		$container_class = 'menu-main-search';
		$items .= "<li class='" . $container_class . " menu-search-animated'><i class='icon-search'></i>" . get_search_form( false ) . " <i class='icon-cancel'></i></li>";
	}
	if( $args->theme_location == 'footer' && $options['anima_searchboxfooter'] ) {
		$container_class = 'menu-footer-search';
		$items .= "<li class='" . $container_class . "'>" . get_search_form( false ) . "</li>";
	}
	return $items;
} // cryout_search_mainmenu()
endif;

/* cryout_schema_microdata() moved to framework in 0.9.9/0.5.6 */

/**
 * Normalizes tags widget font when needed
 */
function anima_normalizetags( $tags_html ) {
	$anima_normalizetags = cryout_get_option( 'anima_normalizetags' );
	if ( $anima_normalizetags ) return preg_replace( '/font-size:.*?;/i', '', $tags_html ); else return $tags_html;
};
add_filter( 'wp_generate_tag_cloud', 'anima_normalizetags' );


/**
* Master hook to bypass customizer options
*/
if ( ! function_exists( 'anima_master_hook' ) ) :
function anima_master_hook() {
	$anima_interim_options = cryout_get_option( array(
		'anima_breadcrumbs',
		'anima_searchboxmain',
		'anima_searchboxfooter',
		'anima_comlabels')
	);
	if ( $anima_interim_options['anima_breadcrumbs'] )  add_action( 'cryout_breadcrumbs_hook', 'anima_breadcrumbs' );
	if ( $anima_interim_options['anima_searchboxmain'] || $anima_interim_options['anima_searchboxfooter'] ) add_filter( 'wp_nav_menu_items', 'cryout_search_menu', 10, 2);

	if ( $anima_interim_options['anima_comlabels'] == 1 ) {
		add_filter( 'comment_form_default_fields', 'anima_comments_form' );
		add_filter( 'comment_form_field_comment', 'anima_comments_form_textarea' );
	}

	if ( cryout_get_option( 'anima_socials_header' ) ) 		add_action( 'cryout_header_socials_hook', 'anima_socials_menu_header', 30 );
	if ( cryout_get_option( 'anima_socials_footer' ) ) 		add_action( 'cryout_footer_hook', 'anima_socials_menu_footer', 17 );
	if ( cryout_get_option( 'anima_socials_left_sidebar' ) ) 	add_action( 'cryout_before_primary_widgets_hook', 'anima_socials_menu_left', 5 );
	if ( cryout_get_option( 'anima_socials_right_sidebar' ) ) 	add_action( 'cryout_before_secondary_widgets_hook', 'anima_socials_menu_right', 5 );
};
endif;
add_action( 'wp', 'anima_master_hook' );


// Boxes image size
function anima_lpbox_width( $options = array() ) {

	if ( $options['anima_lpboxlayout1'] == 1 ) { $totalwidth = 1920; }
	else { $totalwidth = $options['anima_sitewidth']; }
	$options['anima_lpboxwidth1'] = intval ( $totalwidth / $options['anima_lpboxrow1'] );

	if ( $options['anima_lpboxlayout2'] == 1 ) { $totalwidth = 1920; }
	else { $totalwidth = $options['anima_sitewidth']; }
	$options['anima_lpboxwidth2'] = intval ( $totalwidth / $options['anima_lpboxrow2'] );

	return $options;
} // anima_lpbox_width()

// Used for the landing page blocks auto excerpts
function anima_custom_excerpt( $text = '', $length = 35, $more = '...' ) {
	$raw_excerpt = $text;

	//handle the <!--more--> and <!--nextpage--> tags
	$moretag = false;
	if (strpos( $text, '<!--nextpage-->' )) $explodemore = explode('<!--nextpage-->', $text);
	if (strpos( $text, '<!--more-->' )) $explodemore = explode('<!--more-->', $text);
	if (!empty($explodemore[1])) {
		// tag was found
		$text = $explodemore[0];
		$moretag = true;
	}

	if ( '' != $text ) {
		$text = strip_shortcodes( $text );

		$text = str_replace(']]>', ']]&gt;', $text);

		// Filters the number of words in an excerpt. Default 35.
		$excerpt_length = apply_filters( 'anima_custom_excerpt_length', $length );

		if ($excerpt_length == 0) return '';

		// Filters the string in the "more" link displayed after a trimmed excerpt.
		$excerpt_more = apply_filters( 'anima_custom_excerpt_more', $more );
		if (!$moretag) {
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
		}
	}
	return apply_filters( 'anima_custom_excerpt', $text, $raw_excerpt );
} // anima_custom_excerpt()

// anima ajax load more button alternative hook
add_action( 'template_redirect', 'cryout_ajax_init' );

/* FIN */
