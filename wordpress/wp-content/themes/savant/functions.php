<?php
/**
 * Savant Child functions and definitions
 */
define( 'SAVANT_THEME_VERSION' , '1.0.2' );

/**
 * Enqueue parent theme style
 */
function savant_child_enqueue_styles() {
    wp_enqueue_style( 'avant-default-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Rokkitt:300,400,600,700', array(), SAVANT_THEME_VERSION );
    wp_enqueue_style( 'avant-style', get_template_directory_uri() . '/style.css', array(), SAVANT_THEME_VERSION );
    
    if ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-seven' ) :
        wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-seven.css", array(), SAVANT_THEME_VERSION );
    elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-six' ) :
        wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-six.css", array(), SAVANT_THEME_VERSION );
    elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-five' ) :
        wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-five.css", array(), SAVANT_THEME_VERSION );
    elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-four' ) :
        wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-four.css", array(), SAVANT_THEME_VERSION );
    elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-one' ) :
        wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-one.css", array(), SAVANT_THEME_VERSION );
    elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-two' ) :
        wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-two.css", array(), SAVANT_THEME_VERSION );
    else :
        wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-three.css", array(), SAVANT_THEME_VERSION );
    endif;
    
    wp_enqueue_style( 'avant-child-style-savant', get_stylesheet_uri(), array( 'avant-style' ), SAVANT_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'savant_child_enqueue_styles' );

/**
 * Enqueue Savant custom customizer styling.
 */
function savant_load_customizer_script() {
    wp_enqueue_script( 'savant-customizer-custom-js', get_stylesheet_directory_uri() . "/customizer-js/custom-customizer.js", array('jquery', 'avant-customizer-js'), SAVANT_THEME_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'savant_load_customizer_script' );
