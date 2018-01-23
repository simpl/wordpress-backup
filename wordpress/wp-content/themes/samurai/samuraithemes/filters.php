<?php

if( !function_exists( 'samurai_comment_form_fields' ) ) :
	/**
	 * Add custom style of form field
	 */
	function samurai_comment_form_fileds( $fields ) {
		$commenter = wp_get_current_commenter();
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

		$fields   =  array(
			'author'=>  '<div class="form-group">
							<label for="author">'.esc_html__("Full Name *", "samurai").'</label>
							<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
						</div>'. ( $req ? '<span class="required"></span>' : '' ),

			'email'=>   '<div class="form-group">
							<label for="email">'.esc_html__("Email Address *", "samurai").'</label>
							<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) .	'" ' . $aria_req . ' />
						</div>' . ( $req ? '<span class="required"></span>' : '' ),

			'url'=>     '<div class="form-group">
							<label for="url">'.esc_html__('Website', 'samurai').'</label>
							<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" />
						</div>',
		);

		return $fields;
	}
endif;
add_filter( 'comment_form_default_fields', 'samurai_comment_form_fileds' );



if( !function_exists( 'samurai_comment_form' ) ) :
	/**
	 * Add custom default values of form.
	 */
	function samurai_comment_form( $args ) {
		$args['class_form'] = esc_attr__('comment_news comment-form', 'samurai');
		$args['title_reply'] = esc_html__('Leave comment','samurai');
		$args['title_reply_before'] = '<h4 class="reply-title">';
		$args['title_reply_after'] = '</h4>';
		$args['comment_notes_before'] = '<p>'. esc_html__( 'Your email address will not be published. Required fields are marked with *.','samurai' ).'</p>';
		$args['comment_field'] = '<div class="form-group">
									<label for="comment">'.esc_html__('Comment','samurai').'</label>
								  	<textarea id="comment" class="form-control" name="comment" rows="5" placeholder="'.''.'" aria-required="true"></textarea>
								  	</div>';
		$args['class_submit'] = esc_attr__('btn btn-default submit-comment', 'samurai'); 
		$args['label_submit'] = esc_attr__('Post Comment', 'samurai');

		return $args;
	}
endif;
add_filter( 'comment_form_defaults', 'samurai_comment_form' );