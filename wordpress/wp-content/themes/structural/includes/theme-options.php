<?php
require_once get_template_directory() . '/includes/options-config.php';
require_once get_template_directory() . '/admin/control-icon-picker.php';
	if( ! class_exists('Structural_Customizer_API_Wrapper') ) {
		require_once get_template_directory() . '/admin/class.structural-customizer-api-wrapper.php';
	}


Structural_Customizer_API_Wrapper::getInstance($options);
