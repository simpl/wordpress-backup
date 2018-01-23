<?php

	$wp_customize->add_panel( 'theme_option_panel', 
		array(
			'title'			=> __( 'Samurai Options', 'samurai' ),
			'description'	=> __( 'Customize Samurai Theme', 'samurai' ),
			'priority'		=> 10	
		) 
	);

	// Load Options
	require_once trailingslashit( get_template_directory() ) . '/samuraithemes/customizer/customizer-options/option-others.php';