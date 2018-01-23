<?php
/**
 * Custom Post metadata functions
 *
 * @package Anima
 */

// Add Layout Meta Box
function anima_add_meta_boxes( $post ) {
    global $wp_meta_boxes;

	$layout_context = apply_filters( 'anima_layout_meta_box_context', 'side' ); // 'normal', 'side', 'advanced'
	$layout_priority = apply_filters( 'anima_layout_meta_box_priority', 'default' ); // 'high', 'core', 'low', 'default'

    // Add page layouts
    add_meta_box(
		'anima_layout',
		__( 'Static Page Layout', 'anima' ),
		'anima_layout_meta_box',
		'page',
		$layout_context,
		$layout_priority
	);
} // anima_add_meta_boxes()

// Hook meta boxes into 'add_meta_boxes'
add_action( 'add_meta_boxes', 'anima_add_meta_boxes' );

// Define Layout Meta Box
function anima_layout_meta_box() {
	global $post;
    global $anima_big;
	$option_parameters = $anima_big['options'][0];
	$custom = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$layout = ( isset( $custom['_anima_layout'][0] ) ? $custom['_anima_layout'][0] : '0' );
    ?>
	<p>
    	<label id="anima_layout_default">
            <input type="radio" name="_anima_layout" <?php checked( '0' == $layout ); ?> value="0" />
            <span><em><?php _e( 'Default Theme Layout', 'anima' ); ?></em></span>
        </label>
    	<?php foreach ($option_parameters['choices'] as $value => $data ) {
            $data['url'] = esc_url( sprintf( $data['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>

    		<label>
                <input type="radio" name="_anima_layout" <?php checked( $value == $layout ); ?> value="<?php echo esc_attr( $value ); ?>" />
                <span><img src="<?php echo $data['url'] ?>" alt="<?php echo esc_html(  $data['label'] ) ?>" title="<?php echo esc_html(  $data['label'] ) ?>"/></span>
            </label>

    	<?php } ?>
	</p>
	<?php
} //anima_layout_meta_box()

function anima_meta_style( $hook ) {
    if ( 'post.php' != $hook && 'post-new.php' != $hook && 'page.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'anima_meta_style', get_template_directory_uri() . '/admin/css/meta.css', NULL, _CRYOUT_THEME_VERSION );
}

add_action( 'admin_enqueue_scripts', 'anima_meta_style' );

/**
 * Validate, sanitize, and save post metadata.
 *
 */
function anima_save_custom_post_metadata() {
	// Don't break on quick edit
	global $post;
	if ( ! isset( $post ) || ! is_object( $post ) ) {
		return;
	}

    global $anima_big;
    $valid_layouts = $anima_big['options'][0]['choices'];
	$layout = ( isset( $_POST['_anima_layout'] ) && array_key_exists( $_POST['_anima_layout'], $valid_layouts ) ? $_POST['_anima_layout'] : '0' );

	// Layout - Update
	update_post_meta( $post->ID, '_anima_layout', $layout );
} //anima_save_custom_post_metadata()

// Hook the save post custom meta data into
add_action( 'publish_page', 'anima_save_custom_post_metadata' );
add_action( 'draft_page',   'anima_save_custom_post_metadata' );
add_action( 'future_page',  'anima_save_custom_post_metadata' );
