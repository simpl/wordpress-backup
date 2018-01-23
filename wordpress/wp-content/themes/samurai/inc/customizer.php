<?php
/**
 * Samurai Theme Customizer
 *
 * @package Samurai
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function samurai_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Load sanitize.php
	 */
	require_once trailingslashit( get_template_directory() ) . '/samuraithemes/customizer/sanitize.php';

	/**
	 * Load options.php
	 */
	require_once trailingslashit( get_template_directory() ) . '/samuraithemes/customizer/options.php';

}
add_action( 'customize_register', 'samurai_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function samurai_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function samurai_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function samurai_customize_preview_js() {
	wp_enqueue_script( 'samurai-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'samurai_customize_preview_js' );





/**
 * Enqueue scripts for customizer
 */
function samurai_customizer_js() {
    wp_enqueue_script('samurai-customizer', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.js', array('jquery'), '1.3.0', true);

    wp_localize_script( 'samurai-customizer', 'samurai_customizer_js_obj', array(
        'pro' => __('Upgrade To Samurai Plus','samurai')
    ) );
    wp_enqueue_style( 'samurai-customizer', get_template_directory_uri() . '/inc/upgrade-to-pro/customize-controls.css');
}
add_action( 'customize_controls_enqueue_scripts', 'samurai_customizer_js' );