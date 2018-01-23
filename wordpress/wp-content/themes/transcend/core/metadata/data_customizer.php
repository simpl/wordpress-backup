<?php 

//Define customizer sections
if(!function_exists('cpotheme_metadata_panels')){
	function cpotheme_metadata_panels(){
		$data = array();
		
		$data['cpotheme_layout'] = array(
		'title' => __('Layout', 'transcend'),
		'description' => __('Here you can find settings that control the structure and positioning of specific elements within your website.', 'transcend'),
		'priority' => 25);
		
		return apply_filters('cpotheme_customizer_panels', $data);
	}
}


//Define customizer sections
if(!function_exists('cpotheme_metadata_sections')){
	function cpotheme_metadata_sections(){
		$data = array();
		
		$data['epsilon-section-pro'] = array(
		'type' => 'epsilon-section-pro',
		'title'       => esc_html__( 'LITE vs PRO comparison', 'transcend' ),
		'button_text' => esc_html__( 'Learn more', 'transcend' ),
		'button_url'  => esc_url_raw( admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
		'priority'    => 0
		);

		$data['cpotheme_management'] = array(
		'title' => __('General Theme Options', 'transcend'),
		'description' => __('Options that help you manage your theme better.', 'transcend'),
		'capability' => 'edit_theme_options',
		'priority' => 15);
		
		$data['cpotheme_layout_general'] = array(
		'title' => __('Site Wide Structure', 'transcend'),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 25);
		
		$data['cpotheme_layout_home'] = array(
		'title' => __('Homepage', 'transcend'),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 50);
		
		if(defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true){
			$data['cpotheme_layout_slider'] = array(
			'title' => __('Slider', 'transcend'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true){
			$data['cpotheme_layout_transcend'] = array(
			'title' => __('Features', 'transcend'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true){
			$data['cpotheme_layout_portfolio'] = array(
			'title' => __('Portfolio', 'transcend'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true){
			$data['cpotheme_layout_services'] = array(
			'title' => __('Services', 'transcend'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
			$data['cpotheme_layout_team'] = array(
			'title' => __('Team Members', 'transcend'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
			$data['cpotheme_layout_testimonials'] = array(
			'title' => __('Testimonials', 'transcend'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true){
			$data['cpotheme_layout_clients'] = array(
			'title' => __('Clients', 'transcend'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		$data['cpotheme_typography'] = array(
		'title' => __('Typography', 'transcend'),
		'description' => __('Custom typefaces for the entire site.', 'transcend'),
		'capability' => 'edit_theme_options',
		'priority' => 45);

		$data['cpotheme_layout_posts'] = array(
		'title' => __('Blog Posts', 'transcend'),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 50);
		
		$data['cpotheme_typography'] = array(
		'title' => __('Typography', 'transcend'),
		'capability' => 'edit_theme_options',
		'priority' => 45);
		
		return apply_filters('cpotheme_customizer_sections', $data);
	}
}


if(!function_exists('cpotheme_metadata_customizer')){
	function cpotheme_metadata_customizer($std = null){
		$data = array();

		$data['general_logo'] = array(
		'label' => __('Custom Logo', 'transcend'),
		'description' => __('Insert the URL of an image to be used as a custom logo.', 'transcend'),
		'section' => 'title_tagline',
		'sanitize' => 'esc_url',
		'type' => 'image');
		
		$data['general_logo_width'] = array(
		'label' => __('Logo Width (px)', 'transcend'),
		'description' => __('Forces the logo to have a specified width.', 'transcend'),
		'section' => 'title_tagline',
		'type' => 'text',
		'placeholder' => '(none)',
		'sanitize' => 'absint',
		'width' => '100px');
		
		$data['general_texttitle'] = array(
		'label' => __('Enable Text Title?', 'transcend'),
		'description' => __('Activate this to display the site title as text.', 'transcend'),
		'section' => 'title_tagline',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'std' => false);
		
		$data['general_editlinks'] = array(
		'label' => __('Show Edit Links', 'transcend'),
		'description' => __('Display edit links on the site layout for logged in users.', 'transcend'),
		'section' => 'cpotheme_management',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'std' => '1');
		
		$data['home_upsell'] = array(
		'section'      => 'cpotheme_layout_home',
		'type'		   => 'epsilon-upsell',
        'options'      => array(
            esc_html__( 'Improved Tagline', 'transcend' ),
            esc_html__( 'Reorder Sections', 'transcend' ),
        ),
        'requirements' => array(
            esc_html__( 'In the PRO version of Allegiant, the tagline transforms in a CTA section with buttons and descriptions.', 'transcend' ),
            esc_html__( 'You can order Homepage sections anyway you want', 'transcend' ),
        ),
        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
        'button_text'  => esc_html__( 'See PRO vs Lite', 'transcend' ),
        'second_button_url'  => cpotheme_upgrade_link(),
        'second_button_text' => esc_html__( 'Get the PRO version!', 'transcend' ),
        'separator' => '- or -'
		);

		$data['home_tagline'] = array(
		'label' => __('Tagline Title', 'transcend'),
		'section' => 'cpotheme_layout_home',
		'empty' => true,
		'multilingual' => true,
		'default' => __('Add your custom tagline here.', 'transcend'),
		'sanitize' => 'wp_kses_post',
		'type' => 'textarea');
		
		//Homepage Slider
		if(defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true){
			$data['slider_settings'] = array(
			'label' => __('Slider Options', 'transcend'),
			'description' => __('Customize the speed, timeout and effects of the homepage slider.', 'transcend'),
			'section' => 'cpotheme_layout_slider',
			'type' => 'label');
		}
		
		//Homepage Features
		if(defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true){
			$data['transcend_upsell'] = array(
			'section'      => 'cpotheme_layout_transcend',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Title', 'transcend' ),
	            esc_html__( 'Features Columns', 'transcend' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from description one you can also add a title for users to better understand your sections content', 'transcend' ),
	            esc_html__( 'You can select on how many Columns you want to show your transcend.', 'transcend' ),
	        ),
	        'button_url'   => cpotheme_upgrade_link(),
	        'button_text'  => esc_html__( 'Get the PRO version!', 'transcend' ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'transcend' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'transcend' ),
	        'separator' => '- or -'
			);

			$data['home_transcend'] = array(
			'label' => __('Features Description', 'transcend'),
			'section' => 'cpotheme_layout_transcend',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Our core transcend', 'transcend'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea');
		}
		
		//Portfolio layout
		if(defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true){
			$data['portfolio_upsell'] = array(
			'section'      => 'cpotheme_layout_portfolio',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Title', 'transcend' ),
	            esc_html__( 'Portfolio Columns', 'transcend' ),
	            esc_html__( 'Related Portfolios', 'transcend' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from description one you can also add a title for users to better understand your sections content', 'transcend' ),
	            esc_html__( 'You can select on how many Columns you want to show your portfolio.', 'transcend' ),
	            esc_html__( 'You can enable related portfolio.', 'transcend' ),
	        ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'transcend' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'transcend' ),
	        'separator' => '- or -'
			);

			$data['home_portfolio'] = array(
			'label' => __('Portfolio Description', 'transcend'),
			'section' => 'cpotheme_layout_portfolio',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Take a look at our work', 'transcend'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea');
		}
		
		//Services layout
		if(defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true){
			$data['services_upsell'] = array(
			'section'      => 'cpotheme_layout_services',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Title', 'transcend' ),
	            esc_html__( 'Services Columns', 'transcend' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from description one you can also add a title for users to better understand your sections content', 'transcend' ),
	            esc_html__( 'You can select on how many Columns you want to show your services.', 'transcend' ),
	        ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'transcend' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'transcend' ),
	        'separator' => '- or -'
			);
			$data['home_services'] = array(
			'label' => __('Services Description', 'transcend'),
			'section' => 'cpotheme_layout_services',
			'empty' => true,
			'multilingual' => true,
			'default' => __('What we can offer you', 'transcend'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea');
		}
		
		//Services layout
		if(defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
			$data['home_team'] = array(
			'label' => __('Team Members Description', 'transcend'),
			'section' => 'cpotheme_layout_team',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Meet our team', 'transcend'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea');
		}
		
		//Testimonials
		if(defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
			$data['home_testimonials'] = array(
			'label' => __('Testimonials Description', 'transcend'),
			'section' => 'cpotheme_layout_testimonials',
			'empty' => true,
			'multilingual' => true,
			'default' => __('What they say about us', 'transcend'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea');
		}
		
		//Clients
		if(defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true){
			$data['home_clients'] = array(
			'label' => __('Clients Description', 'transcend'),
			'section' => 'cpotheme_layout_clients',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Featured clients', 'transcend'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea');
		}
		
		//Blog Posts
		$data['home_posts'] = array(
		'label' => __('Enable Posts On Homepage', 'transcend'),
		'section' => 'cpotheme_layout_posts',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'default' => true);
		
		//Typography
		$data['type_settings'] = array(
		'label' => __('Typography Options', 'transcend'),
		'description' => __('Select custom fonts for the headings, navigation, and body text of your site.', 'transcend'),
		'section' => 'cpotheme_typography',
		'type' => 'label');
		
		//Colors		
		$data['color_settings'] = array(
		'label' => __('Color Options', 'transcend'),
		'description' => __('Customize the colors of primary and secondary elements, as well as headings, navigation, and text.', 'transcend'),
		'section' => 'colors',
		'type' => 'label');
		
		return apply_filters('cpotheme_customizer_controls', $data);
	}
}