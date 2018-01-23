<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Trusted
 */

if ( ! function_exists( 'trusted_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, author and comments
 */
function trusted_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<span class="posted-on"><i class="fa fa-calendar-o"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';

		$byline = '<span class="byline"><i class="fa fa-user"></i><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';

	$comment_count = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $comment_count == 0 ) {
			$comments = esc_html__( 'No Comments', 'trusted' );
		} elseif ( $comment_count > 1 ) {
			$comments = $comment_count . esc_html__( ' Comments', 'trusted' );
		} else {
			$comments = esc_html__( '1 Comment', 'trusted' );
		}
		$comment_link = '<span class="comment-count"><i class="fa fa-comments"></i><a href="' . get_comments_link() .'">'. $comments.'</a></span>';
	} else {
		$comment_link = '';
	}

	echo $posted_on . $byline . $comment_link ; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'trusted_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories and tags.
 */
function trusted_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = esc_html__( ', ', 'trusted' );

		$categories_list = get_the_category_list( $separate_meta );
		if ( $categories_list && trusted_categorized_blog() ) {
			echo '<span class="cat-links"><i class="fa fa-folder"></i>' . $categories_list . '</span>' ;
		}

		$tags_list = get_the_tag_list( '', $separate_meta );
		if ( $tags_list ) {
			echo '<span class="tags-links"><i class="fa fa-tags"></i>' . $tags_list . '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'trusted' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link"><i class="fa fa-pencil"></i>',
			'</span>'
		);

	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function trusted_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'trusted_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'trusted_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so trusted_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so trusted_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in trusted_categorized_blog.
 */
function trusted_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'trusted_categories' );
}
add_action( 'edit_category', 'trusted_category_transient_flusher' );
add_action( 'save_post',     'trusted_category_transient_flusher' );
