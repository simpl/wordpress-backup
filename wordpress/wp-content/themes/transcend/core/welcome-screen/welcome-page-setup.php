<?php

add_action( 'customize_controls_enqueue_scripts', 'transcend_welcome_scripts_for_customizer', 0 );
function transcend_welcome_scripts_for_customizer(){
	wp_enqueue_style( 'cpotheme-welcome-screen-customizer-css', get_template_directory_uri() . '/core/welcome-screen/css/welcome_customizer.css' );
}

// Load the system checks ( used for notifications )
require get_template_directory() . '/core/welcome-screen/notify-system-checks.php';

// Welcome screen
if ( is_admin() ) {
	global $transcend_required_actions, $transcend_recommended_plugins;
	$transcend_recommended_plugins = array(
		'kiwi-social-share' 		=> array( 'recommended' => true ),
		'modula-best-grid-gallery' 	=> array( 'recommended' => true ),
		'uber-nocaptcha-recaptcha'	=> array( 'recommended' => false ),
		'cpo-shortcodes' 			=> array( 'recommended' => false ),
		'wp-product-review'       	=> array( 'recommended' => false ),
		'pirate-forms'           	=> array( 'recommended' => true ),
		'visualizer'             	=> array( 'recommended' => false )
	);
	/*
	 * id - unique id; required
	 * title
	 * description
	 * check - check for plugins (if installed)
	 * plugin_slug - the plugin's slug (used for installing the plugin)
	 *
	 */


	$transcend_required_actions = array(
		array(
			"id"          => 'transcend-req-ac-install-cpo-content-types',
			"title"       => Transcend_Notify_System::create_plugin_requirement_title( __( 'Install: CPO Content Types', 'transcend' ), __( 'Activate: CPO Content Types', 'transcend' ), 'cpo-content-types' ),
			"description" => __( 'It is highly recommended that you install the CPO Content Types plugin. It will help you manage all the special content types that this theme supports.', 'transcend' ),
			"check"       => Transcend_Notify_System::has_import_plugin( 'cpo-content-types' ),
			"plugin_slug" => 'cpo-content-types'
		),
		array(
			"id"          => 'transcend-req-ac-install-cpo-widgets',
			"title"       => Transcend_Notify_System::create_plugin_requirement_title( __( 'Install: CPO Widgets', 'transcend' ), __( 'Activate: CPO Widgets', 'transcend' ), 'cpo-widgets' ),
			"description" => __( 'It is highly recommended that you install the CPO Widgets plugin. It will help you manage all the special widgets that this theme supports.', 'transcend' ),
			"check"       => Transcend_Notify_System::has_import_plugin( 'cpo-widgets' ),
			"plugin_slug" => 'cpo-widgets'
		),
		array(
			"id"          => 'transcend-req-ac-install-wp-import-plugin',
			"title"       => Transcend_Notify_System::wordpress_importer_title(),
			"description" => Transcend_Notify_System::wordpress_importer_description(),
			"check"       => Transcend_Notify_System::has_import_plugin( 'wordpress-importer' ),
			"plugin_slug" => 'wordpress-importer'
		),
		array(
			"id"          => 'transcend-req-ac-install-wp-import-widget-plugin',
			"title"       => Transcend_Notify_System::widget_importer_exporter_title(),
			'description' => Transcend_Notify_System::widget_importer_exporter_description(),
			"check"       => Transcend_Notify_System::has_import_plugin( 'widget-importer-exporter' ),
			"plugin_slug" => 'widget-importer-exporter'
		),
		array(
			"id"          => 'transcend-req-ac-download-data',
			"title"       => esc_html__( 'Download theme sample data', 'transcend' ),
			"description" => esc_html__( 'Head over to our website and download the sample content data.', 'transcend' ),
			"help"        => '<a target="_blank"  href="https://www.cpothemes.com/sample-data/transcend-pro-posts.xml">' . __( 'Posts', 'transcend' ) . '</a>, 
							   <a target="_blank"  href="https://www.cpothemes.com/sample-data/transcend-pro-widgets.wie">' . __( 'Widgets', 'transcend' ) . '</a>',
			"check"       => Transcend_Notify_System::has_content(),
		),
		array(
			"id"    => 'transcend-req-ac-install-data',
			"title" => esc_html__( 'Import Sample Data', 'transcend' ),
			"help"  => '<a class="button button-primary" target="_blank"  href="' . self_admin_url( 'admin.php?import=wordpress' ) . '">' . __( 'Import Posts', 'transcend' ) . '</a> 
									   <a class="button button-primary" target="_blank"  href="' . self_admin_url( 'tools.php?page=widget-importer-exporter' ) . '">' . __( 'Import Widgets', 'transcend' ) . '</a>',
			"check" => Transcend_Notify_System::has_import_content(),
		),
	);
	require get_template_directory() . '/core/welcome-screen/welcome-screen.php';
}

add_action( 'customize_register', 'transcend_customize_register' );
function transcend_customize_register( $wp_customize ){
	global $transcend_required_actions, $transcend_recommended_plugins;
	$theme_slug = 'transcend';
	$customizer_recommended_plugins = array();
	if ( is_array( $transcend_recommended_plugins ) ) {
		foreach ( $transcend_recommended_plugins as $k => $s ) {
			if( $s['recommended'] ) {
				$customizer_recommended_plugins[$k] = $s;
			}
		}
	}
	
	$wp_customize->add_section(
	  new Epsilon_Section_Recommended_Actions(
	    $wp_customize,
	    'epsilon_recomended_section',
	    array(
	      'title'                        => esc_html__( 'Recomended Actions', 'transcend' ),
	      'social_text'                  => esc_html__( 'We are social', 'transcend' ),
	      'plugin_text'                  => esc_html__( 'Recomended Plugins', 'transcend' ),
	      'actions'                      => $transcend_required_actions,
	      'plugins'                      => $customizer_recommended_plugins,
	      'theme_specific_option'        => $theme_slug . '_show_required_actions',
	      'theme_specific_plugin_option' => $theme_slug . '_show_recommended_plugins',
	      'facebook'                     => 'https://www.facebook.com/cpothemes',
	      'twitter'                      => 'https://twitter.com/cpothemes',
	      'wp_review'                    => false,
	      'priority'                     => 0
	    )
	  )
	);
}