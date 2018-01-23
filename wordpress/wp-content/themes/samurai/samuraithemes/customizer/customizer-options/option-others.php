<?php
	// Section - Others Section
	$wp_customize->add_section( 'samurai_other_section',
		array(
			'title'      => esc_html__( 'Other Options', 'samurai' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
		)
	);

	$wp_customize->add_setting('samurai_sidebar_position', 
		array(
			'sanitize_callback'	=> 'samurai_sanitize_sidebar',
			'default'			=> 'right'
		)
	);

	$wp_customize->add_control('samurai_sidebar_position', 
		array(
			'label'      		=> esc_html__('Theme Sidebar Position', 'samurai'),
			'description'		=> esc_html__( 'Select Sidebar Postion. Select none to hide sidebar.', 'samurai' ),
			'section'    		=> 'samurai_other_section',
			'type'       		=> 'radio',
			'choices'    		=> array(
				'left'   		=> esc_html__('Left','samurai'),
				'right'  		=> esc_html__('Right','samurai'),
				'none'	 		=> esc_html__('None','samurai'),
			),
		) 
	);

	// Setting - Copyright Text
	$wp_customize->add_setting( 'samurai_copyright_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( 'samurai_copyright_text',
		array(
			'label'    			=> esc_html__( 'Copyright Text', 'samurai' ),
			'section'  			=> 'samurai_other_section',
			'type'     			=> 'text',
			'priority' 			=> 100,
		)
	);