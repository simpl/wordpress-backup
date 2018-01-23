<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Structural
 */
 
/**
 * Setup the WordPress core custom header feature.
 *
 * @uses structural_header_style()  
 * @uses structural_admin_header_style() 
 * @uses structural_admin_header_image()   
 *
 * @package Structural
 */
function structural_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'structural_custom_header_args', array(
		'default-image'          => '',
		'header_text'            => true,
		'width'                  => 1920,
		'height'                 => 400,
		'flex-height'            => true, 
		'wp-head-callback'       => 'structural_header_style',
		'video'                  => true
	) ) );
}

add_action( 'after_setup_theme', 'structural_custom_header_setup' );



if ( ! function_exists( 'structural_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see structural_custom_header_setup().  
 */
function structural_header_style() {
	if ( get_header_image() ) {
	?>
	<style type="text/css">    
        .custom-header-media img {
		    display: block;
		}  
      
	</style>
	<?php 
	}
   /* Header Video Settings */
    if(function_exists('is_header_video_active') ) {
		if ( is_header_video_active() ) { ?>
			<style type="text/css">    
				#wp-custom-header-video-button {
				    position: absolute;
				    z-index:1;
				    top:20px;
				    right: 20px;
				    background:rgba(34, 34, 34, 0.5);
				    border: 1px solid rgba(255,255,255,0.5);
				}
				.wp-custom-header iframe,
				.wp-custom-header video {
				      display: block;
				      //height: auto;
				      max-width: 100%;
				      height: 100vh;
				      width: 100vw;
				      overflow: hidden;
				      object-fit: cover;
				}

		    </style><?php
		}
    }
}
endif; // structural_header_style


/**
 * Customize video play/pause button in the custom header.
 */
if(!function_exists('structural_video_controls') ) {
	function structural_video_controls( $settings ) {
		$settings['l10n']['play'] = '<span class="screen-reader-text">' . __( 'Play background video', 'structural' ) . '</span><i class="fa fa-play"></i>';
		$settings['l10n']['pause'] = '<span class="screen-reader-text">' . __( 'Pause background video', 'structural' ) . '</span><i class="fa fa-pause"></i>';
		return $settings;
	}
}
add_filter( 'header_video_settings', 'structural_video_controls' );
