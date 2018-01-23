<?php
/**
 * Functions used in the main loop
 *
 * @package Anima
 */

/**
 * Sets the post excerpt length to the number of words set in the theme settings
 */
function anima_excerpt_length_words( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return absint( cryout_get_option( 'anima_excerptlength' ) );
}
add_filter( 'excerpt_length', 'anima_excerpt_length_words' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function anima_custom_excerpt_more() {
	if ( ! is_attachment() ) {
		 echo wp_kses_post( anima_continue_reading_link() );
	}
}
add_action( 'cryout_post_excerpt_hook', 'anima_custom_excerpt_more', 10 );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function anima_continue_reading_link() {
	$anima_excerptcont = cryout_get_option( 'anima_excerptcont' );
	return '<a class="continue-reading-link" href="'. esc_url( get_permalink() ) . '"><span>' . wp_kses_post( $anima_excerptcont ). '</span><i class="icon-continue-reading"></i></a>';
}
add_filter( 'the_content_more_link', 'anima_continue_reading_link' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and anima_continue_reading_link().
 */
function anima_auto_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return wp_kses_post( cryout_get_option( 'anima_excerptdots' ) );
}
add_filter( 'excerpt_more', 'anima_auto_excerpt_more' );

/**
 * Adds a "Continue Reading" link to post excerpts created using the <!--more--> tag.
 */
function anima_more_link( $more_link, $more_link_text ) {
	$anima_excerptcont = cryout_get_option( 'anima_excerptcont' );
	$new_link_text = $anima_excerptcont;
	if ( preg_match( "/custom=(.*)/", $more_link_text, $m ) ) {
		$new_link_text = $m[1];
	}
	$more_link = str_replace( $more_link_text, $new_link_text, $more_link );
	$more_link = str_replace( 'more-link', 'continue-reading-link', $more_link );
	return $more_link;
}
add_filter( 'the_content_more_link', 'anima_more_link', 10, 2 );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 * Galleries are styled by the theme in style.css.
 */
function anima_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'anima_remove_gallery_css' );

/**
 * Posted in category
 */
if ( ! function_exists( 'anima_posted_category' ) ) :
function anima_posted_category() {
	if ( 'post' !== get_post_type() ) return;
	$anima_meta_category = cryout_get_option( 'anima_meta_category' );

	if ( $anima_meta_category && get_the_category_list() ) {
		echo '<span class="bl_categ"' . cryout_schema_microdata( 'category', 0 ) . '>
					<i class="icon-category icon-metas" title="' . esc_attr__( "Categories", "anima" ) . '"></i> '
					 . get_the_category_list( ' <span class="sep">/</span> ' ) .
				'</span>';
	}
} // anima_posted_category()
endif;

/**
 * Posted by author
 */
if ( ! function_exists( 'anima_posted_author' )) :
function anima_posted_author() {
	if ( 'post' !== get_post_type() ) return;
	$anima_meta_author = cryout_get_option( 'anima_meta_author' );

	if ( $anima_meta_author ) {
		echo sprintf(
			'<span class="author vcard"' . cryout_schema_microdata( 'author', 0 ) . '>
				<i class="icon-author icon-metas" title="' . esc_attr__( "Author", "anima" ) . '"></i>
				<a class="url fn n" rel="author" href="%1$s" title="%2$s"' . cryout_schema_microdata( 'author-url', 0 ) . '>
					<em' .  cryout_schema_microdata( 'author-name', 0 ) . '>%3$s</em>
				</a>
			</span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'anima' ), get_the_author() ),
			get_the_author()
		);
	}
} // anima_posted_author
endif;

/**
 * Posted by author for single posts
 */
if ( ! function_exists( 'anima_posted_author_single' )) :
function anima_posted_author_single() {
	$anima_meta_author = cryout_get_option( 'anima_meta_author' );
	$anima_meta_date = cryout_get_option( 'anima_meta_date' );
	$anima_meta_date = (( $anima_meta_date && !is_attachment() )?'<em>' . __("on", "anima").'</em>':""); // Hide 'on' if meta date is hidden or if attachment page
	global $post;
	$author_id = $post->post_author;

	if ( $anima_meta_author ) {
		echo sprintf(
			'<span class="author vcard"' . cryout_schema_microdata( 'author', 0 ) . '>' .
				get_avatar( $author_id ) . '<em>'. __("Posted by ", "anima") . '</em>' .
				'<a class="url fn n" rel="author" href="%1$s" title="%2$s"' . cryout_schema_microdata( 'author-url', 0 ) . '>
					<em' .  cryout_schema_microdata( 'author-name', 0 ) . '>%3$s</em>
				</a> ' . $anima_meta_date .
			'</span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID', 	$author_id ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'anima' ), get_the_author_meta( 'display_name', $author_id) ),
			get_the_author_meta( 'display_name', $author_id)
		);
	}
} // anima_posted_author_single
endif;

/**
 * Posted date/time, tags
 */
if ( ! function_exists( 'anima_posted_date' ) ) :
function anima_posted_date() {
	if ( 'post' !== get_post_type() ) return;
	$anima_meta_date = cryout_get_option( 'anima_meta_date' );
	$anima_meta_time = cryout_get_option( 'anima_meta_time' );

	// Post date/time
	if ( $anima_meta_date || $anima_meta_time ) {
		$date = ''; $time = '';
		if ( $anima_meta_date ) { $date = get_the_date(); }
		if ( $anima_meta_time ) { $time = esc_attr( get_the_time() ); }
		?>

		<span class="onDate date" >
				<i class="icon-date icon-metas" title="<?php esc_attr_e( "Date", "anima" ) ?>"></i>
				<time class="published" datetime="<?php echo get_the_time( 'c' ) ?>" <?php cryout_schema_microdata( 'time' ) ?>>
					<?php echo $date . ( ( $anima_meta_date && $anima_meta_time ) ? ', ' : '' ) . $time ?>
				</time>
				<time class="updated" datetime="<?php echo get_the_modified_time( 'c' )  ?>" <?php cryout_schema_microdata( 'time-modified' ) ?>><?php echo get_the_modified_date();?></time>
		</span>
		<?php
	}

}; // anima_posted_date()
endif;

if ( ! function_exists( 'anima_posted_tags' ) ) :
function anima_posted_tags() {
	if ( 'post' !== get_post_type() ) return;
	$anima_meta_tag  = cryout_get_option( 'anima_meta_tag' );
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ' / ' );
	if ( $anima_meta_tag && $tag_list ) { ?>
		<span class="tags" <?php cryout_schema_microdata( 'tags' ) ?>>
				<i class="icon-tag icon-metas" title="<?php esc_attr_e( 'Tagged', 'anima' ) ?>"></i>&nbsp;<?php echo $tag_list ?>
		</span>
		<?php
	}
}//anima_posted_tags()
endif;

/**
 * Post edit link for editors
 */
if ( ! function_exists( 'anima_posted_edit' ) ) :
function anima_posted_edit() {
	edit_post_link( __( 'Edit', 'anima' ), '<span class="edit-link icon-metas"><i class="icon-edit icon-metas"></i> ', '</span>' );
}; // anima_posted_edit()
endif;

/**
 * Post format meta
 */
if ( ! function_exists( 'anima_meta_format' ) ) :
function anima_meta_format() {
	if ( 'post' !== get_post_type() ) return;
	$format = get_post_format();
	if ( is_sticky() ) echo '<span class="entry-sticky">' . __('Featured', 'anima') . '</span>';
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format"><a href="%1$s"><i class="icon-%2$s" title="%3$s"></i></a></span>',
			esc_url( get_post_format_link( $format ) ),
			$format,
			get_post_format_string( $format )
		);
	}
} //anima_meta_format()
endif;

/**
 * Post format info
 */
function anima_meta_infos() {

	add_action( 'cryout_featured_hook', 'anima_posted_edit', 50 ); // Edit button
	add_action( 'cryout_post_excerpt_hook', 'anima_comments_on', 50 ); // Comments

	if ( is_single() ) { // If single, metas are shown after the title

		add_action( 'cryout_post_meta_hook',	'anima_posted_author_single', 10 );
		add_action( 'cryout_post_meta_hook',	'anima_posted_date', 20 );
		add_action( 'cryout_post_meta_hook',	'anima_posted_category', 30 );

	} else { // if blog page, metas are shown at the top of the article

		add_action( 'cryout_featured_meta_hook',	'anima_posted_author', 15 );
		add_action( 'cryout_featured_meta_hook',	'anima_posted_date', 20 );
		add_action( 'cryout_featured_meta_hook',	'anima_posted_category', 30 );

	}

	add_action( 'cryout_post_utility_hook',	'anima_posted_tags', 40 ); // Tags always at the bottom of the article
	add_action( 'cryout_featured_meta_hook', 'anima_meta_format', 10 ); // Post format
} //anima_meta_infos()
add_action( 'wp_head', 'anima_meta_infos' );


/* Remove category from rel in category tags */
function anima_remove_category_tag( $text ) {
	$text = str_replace( 'rel="category tag"', 'rel="tag"', $text );
	return $text;
} //anima_remove_category_tag()
//add_filter( 'the_category', 'anima_remove_category_tag' );
//add_filter( 'get_the_category_list', 'anima_remove_category_tag' );

/**
 * Backup navigation
 */
if ( ! function_exists( 'anima_content_nav' ) ) :
function anima_content_nav( $nav_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav id="<?php echo $nav_id; ?>" class="navigation">

			<span class="nav-previous">
				 <?php next_posts_link( '<i class="icon-angle-left"></i>' . __( 'Older posts', 'anima' ) ); ?>
			</span>

			<span class="nav-next">
				<?php previous_posts_link( __( 'Newer posts', 'anima' ) . '<i class="icon-angle-right"></i>' ); ?>
			</span>

		</nav><!-- #<?php echo $nav_id; ?> -->

	<?php endif;
}; // anima_content_nav()
endif;

/**
 * Adds a post thumbnail and if one doesn't exist the first post image is returned
 * @uses cryout_get_first_image( $postID )
 */
if ( ! function_exists( 'anima_set_featured_thumb' ) ) :
function anima_set_featured_thumb() {

	global $post;
	$options = cryout_get_option( array( 'anima_fpost', 'anima_fauto', 'anima_falign', 'anima_magazinelayout', 'anima_landingpage' ) );

	switch ($options['anima_magazinelayout']) {
		case 3: $featured = 'anima-featured-third'; break;
		case 2: $featured = 'anima-featured-half'; break;
		case 1: default: $featured = 'anima-featured'; break;
	}

	// filter to disable srcset if so desired
	$use_srcset = apply_filters( 'anima_featured_srcset', true );

	if ( function_exists('has_post_thumbnail') && has_post_thumbnail() && $options['anima_fpost']) {
		// has featured image
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $featured );
	} elseif ( $options['anima_fpost'] && $options['anima_fauto'] && empty($featured_image) ) {
		// get the first image from post
		$featured_image = cryout_post_first_image( $post->ID, $featured );
	} else {
		// featured image not enabled or not obtainable
		$featured_image[0] = apply_filters('anima_preview_img_src', '');
		$featured_image[1] = apply_filters('anima_preview_img_w', '');
		$featured_image[2] = apply_filters('anima_preview_img_h', '');
	};

	if ( ! empty( $featured_image[0] ) ) {
		$featured_image_url = esc_url( $featured_image[0] );
		$featured_image_w = $featured_image[1];
		$featured_image_h = $featured_image[2]; ?>
		<div class="post-thumbnail-container"  <?php cryout_schema_microdata( 'image' ); ?>>

			<a href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>" title="<?php echo esc_attr( get_post_field( 'post_title', $post->ID ) ) ?>"
				<?php cryout_echo_bgimage( $featured_image_url, 'post-featured-image' ) ?>>

			</a>
			<a class="responsive-featured-image" href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>" title="<?php echo esc_attr( get_post_field( 'post_title', $post->ID ) ) ?>">
				<img class="post-featured-image" alt="<?php the_title_attribute();?>" <?php cryout_schema_microdata( 'url' ); ?>
				src="<?php echo $featured_image_url; ?>" srcset="<?php if ($use_srcset) echo cryout_get_featured_srcset(
						get_post_thumbnail_id( $post->ID ),
						array(  'anima-featured',
								'anima-featured-full',
								'anima-featured-half',
								'anima-featured-third' )
						) ?>" sizes="<?php if ($use_srcset) echo cryout_gen_featured_sizes( anima_featured_width(), $options['anima_magazinelayout'], $options['anima_landingpage'] ) ?>"/>
			</a>
			<meta itemprop="width" content="<?php echo absint( $featured_image_w ); ?>">
			<meta itemprop="height" content="<?php echo absint( $featured_image_h ); ?>">
			<div class="entry-meta featured-image-meta"><?php cryout_featured_meta_hook(); ?></div>
		</div>
	<?php
		} else { ?>
		<div class="entry-meta featured-image-meta"><?php cryout_featured_meta_hook(); ?></div>
		<?php }
} // anima_set_featured_thumb()
endif;
if ( cryout_get_option( 'anima_fpost' ) ) add_action( 'cryout_featured_hook', 'anima_set_featured_thumb' );

/* FIN */
