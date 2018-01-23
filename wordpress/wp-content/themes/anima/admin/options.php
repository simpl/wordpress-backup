<?php
/**
 * Customizer settings and other theme related settings (fonts arrays, widget areas)
 *
 * @package Anima
 */

/* active_callback for controls that depend on other controls' values */
function anima_conditionals( $control ) {

	$conditionals = array(
		array(
			'id'	=> 'anima_lpsliderimage',
			'parent'=> 'anima_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'anima_lpslidershortcode',
			'parent'=> 'anima_lpslider',
			'value'	=> 2,
		),
		array(
			'id'	=> 'anima_lpsliderserious',
			'parent'=> 'anima_lpslider',
			'value' => 4,
		),
		array(
			'id'    => 'anima_lpposts',
			'parent'=> 'anima_landingpage',
			'value' => 1,
		),
		array(
			'id'    => 'anima_lpposts_more',
			'parent'=> 'anima_lpposts',
			'value' => 1,
		),
	);

	foreach ($conditionals as $elem) {
		if ( $control->id == 'anima_settings['.$elem['id'].']' && $control->manager->get_setting('anima_settings['.$elem['parent'].']')->value() == $elem['value'] ) return true;
	};

	if ( ($control->id == "anima_settings[anima_landingpage_notice]") && ('posts' == get_option('show_on_front')) ) return true;

    return false;

} // anima_conditionals()

$anima_big = array(

/************* general info ***************/

'info_sections' => array(
	'cryoutspecial-about-theme' => array(
		'title' => __( 'About', 'cryout' ) . ' ' . ucwords(_CRYOUT_THEME_NAME),
		'desc' => '<img src=" ' . get_template_directory_uri() . '/admin/images/logo-about-header.png" >',
	),
), // info_sections

'info_settings' => array(
	'support_link_faqs' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/wordpress-themes/' . _CRYOUT_THEME_NAME . '" target="_blank">%s</a>', __( 'Read the Docs', 'cryout' ) ),
		'desc' =>  '',
		'section' => 'cryoutspecial-about-theme',
	),
	'support_link_forum' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/forums/f/wordpress/' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '" target="_blank">%s</a>', __( 'Browse the Forum', 'cryout' ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
	'premium_support_link' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/priority-support" target="_blank">%s</a>', __( 'Priority Support', 'cryout' ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
	'rating_url' => array(
		'label' => '&nbsp;',
		'default' => sprintf( '<a href="https://wordpress.org/support/view/theme-reviews/'. cryout_sanitize_tn( _CRYOUT_THEME_NAME ).'#postform" target="_blank">%s</a>', sprintf( __( 'Rate %s on WordPress.org', 'cryout' ) , ucwords(_CRYOUT_THEME_NAME) ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
	'management' => array(
		'label' => '&nbsp;',
		'default' => sprintf( '<a href="themes.php?page=about-' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '-theme">%s</a>', __('Manage Theme Settings', 'cryout') ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
), // info_settings

'panel_overrides' => array(
	'background' => array(
        'title' => __( 'Background', 'cryout' ),
		'desc' => __( 'Background Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-anima_siteidentity',
		'replaces' => 'background_image',
		'type' => 'section',
	),
	'anima_header_section' => array(
		'title' => __( 'Header Image', 'cryout' ),
		'desc' => __( 'Header Image Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-anima_siteidentity',
		'replaces' => 'header_image',
		'type' => 'section',
	),
	'identity' => array(
		'title' => __( 'Site Identity', 'cryout' ),
		'desc' => '',
		'priority' => 50,
		'section' => 'cryoutoverride-anima_siteidentity',
		'replaces' => 'title_tagline',
		'type' => 'section',
	),
	'colors' => array(
		'section' => 'section',
		'replaces' => 'colors',
		'type' => 'remove',
	),

), // panel_overrides

/************* panels *************/

'panels' => array(

	array('id'=>'anima_siteidentity', 'title'=>__('Site Identity','anima'), 'callback'=>'', 'identifier'=>'cryoutoverride-' ),
	array('id'=>'anima_landingpage', 'title'=>__('Landing Page','anima'), 'callback'=>'' ),
	array('id'=>'anima_general_section', 'title'=>__('General','anima') , 'callback'=>'' ),
	array('id'=>'anima_colors_section', 'title'=>__('Colors','anima'), 'callback'=>'' ),
	array('id'=>'anima_text_section', 'title'=>__('Typography','anima'), 'callback'=>'' ),
	array('id'=>'anima_post_section', 'title'=>__('Post Information','anima') , 'callback'=>'' ),

), // panels

/************* sections *************/

'sections' => array(

	// layout
	array('id'=>'anima_layout', 'title'=>__('Layout', 'anima'), 'callback'=>'', 'sid'=>'', 'priority'=>51 ),
	// header
	array('id'=>'anima_siteheader', 'title'=>__('Header','anima'), 'callback'=>'', 'sid'=> '', 'priority'=>52 ),
	// landing page
	array('id'=>'anima_lpgeneral', 'title'=>__('Settings','anima'), 'callback'=>'', 'sid'=>'anima_landingpage', ),
	array('id'=>'anima_lpslider', 'title'=>__('Slider','anima'), 'callback'=>'', 'sid'=>'anima_landingpage', ),
	array('id'=>'anima_lpblocks', 'title'=>__('Featured Icon Blocks','anima'), 'callback'=>'', 'sid'=>'anima_landingpage', ),
	array('id'=>'anima_lpboxes1', 'title'=>__('Featured Boxes Top','anima'), 'callback'=>'', 'sid'=>'anima_landingpage', ),
	array('id'=>'anima_lpboxes2', 'title'=>__('Featured Boxes Bottom','anima'), 'callback'=>'', 'sid'=>'anima_landingpage', ),
	array('id'=>'anima_lptexts', 'title'=>__('Text Areas','anima'), 'callback'=>'', 'sid'=>'anima_landingpage', ),
	// text
	array('id'=>'anima_fontfamily', 'title'=>__('General Font','anima'), 'callback'=>'', 'sid'=> 'anima_text_section'),
	array('id'=>'anima_fontheader', 'title'=>__('Header Fonts','anima'), 'callback'=>'', 'sid'=> 'anima_text_section'),
	array('id'=>'anima_fontwidget', 'title'=>__('Widget Fonts','anima'), 'callback'=>'', 'sid'=> 'anima_text_section'),
	array('id'=>'anima_fontcontent', 'title'=>__('Content Fonts','anima'), 'callback'=>'', 'sid'=> 'anima_text_section'),
	array('id'=>'anima_textformatting', 'title'=>__('Formatting','anima'), 'callback'=>'', 'sid'=> 'anima_text_section'),
	// general
	array('id'=>'anima_contentstructure', 'title'=>__('Structure','anima'), 'callback'=>'', 'sid'=> 'anima_general_section'),
	array('id'=>'anima_contentgraphics', 'title'=>__('Decorations','anima'), 'callback'=>'', 'sid'=> 'anima_general_section'),
	array('id'=>'anima_postimage', 'title'=>__('Content Images','anima'), 'callback'=>'', 'sid'=> 'anima_general_section'),
	array('id'=>'anima_searchbox', 'title'=>__('Search Box Locations','anima'), 'callback'=>'', 'sid'=> 'anima_general_section'),
	array('id'=>'anima_socials', 'title'=>__('Social Icons','anima'), 'callback'=>'', 'sid'=>'anima_general_section'),
	// colors
	array('id'=>'anima_colors', 'title'=>__('Content','anima'), 'callback'=>'', 'sid'=> 'anima_colors_section'),
	array('id'=>'anima_colors_header', 'title'=>__('Header','anima'), 'callback'=>'', 'sid'=> 'anima_colors_section'),
	array('id'=>'anima_colors_footer', 'title'=>__('Footer','anima'), 'callback'=>'', 'sid'=> 'anima_colors_section'),
	array('id'=>'anima_colors_lp', 'title'=>__('Landing Page','anima'), 'callback'=>'', 'sid'=> 'anima_colors_section'),
	// post info
	array('id'=>'anima_featured', 'title'=>__('Featured Image', 'anima'), 'callback'=>'', 'sid'=>'anima_post_section'),
	array('id'=>'anima_metas', 'title'=>__('Meta Information','anima'), 'callback'=>'', 'sid'=> 'anima_post_section'),
	array('id'=>'anima_headertitles', 'title'=>__('Header Titles','anima'), 'callback'=>'', 'sid'=> 'anima_post_section'),
	array('id'=>'anima_excerpts', 'title'=>__('Excerpts','anima'), 'callback'=>'', 'sid'=> 'anima_post_section'),
	array('id'=>'anima_comments', 'title'=>__('Comments','anima'), 'callback'=>'', 'sid'=> 'anima_post_section'),
	// post excerpt
	array('id'=>'anima_excerpthome', 'title'=>__('Home Page','anima'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'anima_excerptsticky', 'title'=>__('Sticky Posts','anima'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'anima_excerptarchive', 'title'=>__('Archive and Category Pages','anima'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'anima_excerptlength', 'title'=>__('Post Excerpt Length ','anima'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'anima_excerptdots', 'title'=>__('Excerpt suffix','anima'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'anima_excerptcont', 'title'=>__('Continue reading link text ','anima'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	// misc
	array('id'=>'anima_misc', 'title'=>__('Miscellaneous','anima'), 'callback'=>'', 'sid'=>'', 'priority'=>82 ),

	/*** developer options ***/
	//array('id'=>'anima_developer', 'title'=>__('[ Developer Options ]','anima'), 'callback'=>'', 'sid'=>'', 'priority'=>101 ),

), // sections

/************ clone options *********/
'clones' => array (
	'anima_lpboxes' => 2,
),

/************* settings *************/

'options' => array (
	//////////////////////////////////////////////////// Layout ////////////////////////////////////////////////////
	array(
	'id' => 'anima_sitelayout',
		'type' => 'radioimage',
		'label' => __('Main Layout','anima'),
		'choices' => array(
			'1c' => array(
				'label' => __("One column (no sidebars)","anima"),
				'url'   => '%s/admin/images/1c.png'
			),
			'2cSr' => array(
				'label' => __("Two columns, sidebar on the right","anima"),
				'url'   => '%s/admin/images/2cSr.png'
			),
			'2cSl' => array(
				'label' => __("Two columns, sidebar on the left","anima"),
				'url'   => '%s/admin/images/2cSl.png'
			),
			'3cSr' => array(
				'label' => __("Three columns, sidebars on the right","anima"),
				'url'   => '%s/admin/images/3cSr.png'
			),
			'3cSl' => array(
				'label' => __("Three columns, sidebars on the left","anima"),
				'url'   => '%s/admin/images/3cSl.png'
			),
			'3cSs' => array(
				'label' => __("Three columns, one sidebar on each side","anima"),
				'url'   => '%s/admin/images/3cSs.png'
			),
		),
		'desc' => '',
	'section' => 'anima_layout' ),
	array(
	'id' => 'anima_layoutalign',
		'type' => 'select',
		'label' => __('Theme alignment','anima'),
		'values' => array( 0, 1 ),
		'labels' => array( __('Wide','anima'), __('Boxed','anima') ),
		'desc' => "",
	'section' => 'anima_layout' ),
	array(
	'id' => 'anima_sitewidth',
		'type' => 'slider',
		'label' => __('Site Width','anima'),
		'min' => 960, 'max' => 1920, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'anima_layout' ),
	array(
	'id' => 'anima_primarysidebar',
		'type' => 'slider',
		'label' => __('Left Sidebar Width','anima'),
		'min' => 200, 'max' => 600, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'anima_layout' ),
	array(
	'id' => 'anima_secondarysidebar',
		'type' => 'slider',
		'label' => __('Right Sidebar Width','anima'),
		'min' => 200, 'max' => 600, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'anima_layout' ),

	array(
	'id' => 'anima_magazinelayout',
		'type' => 'radioimage',
		'label' => __('Posts Layout','anima'),
		'choices' => array(
			1 => array(
				'label' => __("One column","anima"),
				'url'   => '%s/admin/images/magazine-1col.png'
			),
			2 => array(
				'label' => __("Two columns","anima"),
				'url'   => '%s/admin/images/magazine-2col.png'
			),
			3 => array(
				'label' => __("Three columns","anima"),
				'url'   => '%s/admin/images/magazine-3col.png'
			),
		),
		'desc' => '',
	'section' => 'anima_layout' ),
	array(
	'id' => 'anima_elementpadding',
		'type' => 'select',
		'label' => __('Post/page padding','anima'),
		'values' => cryout_gen_values( 0, 10, 1, array('um'=>'') ),
		'labels' => cryout_gen_values( 0, 10, 1, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_layout' ),

	array(
	'id' => 'anima_footercols',
		'type' => 'select',
		'label' => __("Footer Widgets Columns","anima"),
		'values' => array(0, 1, 2, 3, 4),
		'labels' => array( __('All in a row','anima') , __('1 Column','anima'), __('2 Columns','anima') , __('3 Columns','anima') , __('4 Columns','anima') ),
		'desc' => '',
	'section' => 'anima_layout' ),
	array(
	'id' => 'anima_footeralign',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Default","anima"), __("Center","anima") ),
		'label' => __('Footer Widgets Alignment','anima'),
		'desc' => "",
	'section' => 'anima_layout' ),

	// Header
	array(
	'id' => 'anima_menuheight',
		'type' => 'number',
		'min' => 45,
		'max' => 200,
		'label' => __('Header/Menu Height','anima'),
		'desc' => "",
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_menustyle',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Disabled","anima"), __("Enabled","anima") ),
		'label' => __('Fixed Menu','anima'),
		'desc' => "",
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_menuposition',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Normal","anima"), __("Over header image","anima") ),
		'label' => __('Menu Position','anima'),
		'desc' => "",
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_menulayout',
		'type' => 'select',
		'values' => array( 0, 1, 2 ),
		'labels' => array( __("Left", "anima"), __("Right","anima"), __("Center","anima") ),
		'label' => __('Menu Layout','anima'),
		'desc' => "",
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_headerheight',
		'type' => 'number',
		'min' => 0,
		'max' => 800,
		'label' => __('Header Image Height (in pixels)','anima'),
		'desc' => '',
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_headerheight_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","anima"),
		//'active_callback' => 'anima_conditionals',
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_headerresponsive',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Cropped","anima"), __("Contained","anima") ),
		'label' => __('Header Image Behaviour','anima'),
		'desc' => "",
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_siteheader',
		'type' => 'select',
		'label' => __('Site Header Content','anima'),
		'values' => array( 'title' , 'logo' , 'both' , 'empty' ),
		'labels' => array( __("Site Title","anima"), __("Logo","anima"), __("Logo & Site Title","anima"), __("Empty","anima") ),
		'desc' => '',
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_sitetagline',
		'type' => 'checkbox',
		'label' => __('Show Tagline','anima'),
		'desc' => '',
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_logoupload',
		'type' => 'media-image',
		'label' => __('Logo Image','anima'),
		'desc' => '',
		'disable_if' => 'the_custom_logo',
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_headerwidgetwidth',
		'type' => 'select',
		'label' => __("Header Widget Width","anima"),
		'values' => array( "100%" , "60%" , "50%" , "33%" , "25%" ),
		'desc' => '',
	'section' => 'anima_siteheader' ),
	array(
	'id' => 'anima_headerwidgetalign',
		'type' => 'select',
		'label' => __("Header Widget Alignment","anima"),
		'values' => array( 'left' , 'center' , 'right' ),
		'labels' => array( __("Left","anima"), __("Center","anima"), __("Right","anima") ),
		'desc' => '',
	'section' => 'anima_siteheader' ),

	//////////////////////////////////////////////////// Landing Page ////////////////////////////////////////////////////
	array(
	'id' => 'anima_landingpage',
		'type' => 'select',
		'label' => __('Landing Page','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","anima"), __("Disabled (use WordPress homepage)","anima") ),
		'desc' => '',
	'section' => 'anima_lpgeneral' ),
	array(
	'id' => 'anima_landingpage_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => sprintf( __( "To activate the Landing Page, make sure to set the WordPress <strong>Front Page displays</strong> option to %s","anima" ), "<a data-type='section' data-id='static_front_page' class='cryout-customizer-focus'><strong>" . __("use a static page", "anima") . " &raquo;</strong></a>" ),
		'active_callback' => 'anima_conditionals',
	'section' => 'anima_lpgeneral' ),
	array(
	'id' => 'anima_lpposts',
		'type' => 'select',
		'label' => __('Featured Content','anima'),
		'values' => array( 2, 1, 0 ),
		'labels' => array( __("Static Page", "anima"), __("Posts", "anima"), __("Disabled", "anima") ),
		'desc' => '',
		'active_callback' => 'anima_conditionals',
	'section' => 'anima_lpgeneral' ),
	array(
	'id' => 'anima_lpposts_more',
		'type' => 'text',
		'label' => __( 'More Posts Label', 'anima' ),
		'desc' => '',
		'active_callback' => 'anima_conditionals',
	'section' => 'anima_lpgeneral' ),

	// slider
	array(
	'id' => 'anima_lpslider',
		'type' => 'select',
		'label' => __('Slider','anima'),
		'values' => array( 4, 2, 1, 3, 0 ),
		'labels' => array( __("Serious Slider", "anima"), __("Use Shortcode","anima"), __("Static Image","anima"), __("Header Image","anima"), __("Disabled","anima") ),
		'desc' => sprintf( __("To create an advanced slider, use our <a href='%s' target='_blank'>Serious Slider</a> plugin or any other slider plugin.","anima"), 'https://wordpress.org/plugins/cryout-serious-slider/' ),
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpsliderimage',
		'type' => 'media-image',
		'label' => __('Slider Image','anima'),
		'desc' => __('The default image can be replaced by setting a new static image.', 'anima'),
		'active_callback' => 'anima_conditionals',
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpsliderlink',
		'type' => 'url',
		'label' => __('Slider Link','anima'),
		'desc' => '',
		'active_callback' => 'anima_conditionals',
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpslidershortcode',
		'type' => 'text',
		'label' => __('Shortcode','anima'),
		'desc' => __('Enter shortcode provided by slider plugin. The plugin will be responsible for the slider\'s appearance.','anima'),
		'active_callback' => 'anima_conditionals',
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpsliderserious',
		'type' => 'select',
		'label' => __('Serious Slider','anima'),
		'values' => cryout_serious_slides_for_customizer(1, 0),
		'labels' => cryout_serious_slides_for_customizer(2, __(' - Please install, activate or update Serious Slider plugin - ', 'anima'), __(' - No sliders defined - ', 'anima') ),
		'desc' => __('Select the desired slider from the list. Sliders can be administered in the dashboard.','anima'),
		'active_callback' => 'anima_conditionals',
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpslidertitle',
		'type' => 'text',
		'label' => __('Slider Caption','anima'),
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Title', 'anima') ),
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpslidertext',
		'type' => 'textarea',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'anima') ),
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpslidercta1text',
		'type' => 'text',
		'label' => __('CTA Button','anima') . ' #1',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'anima') ),
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpslidercta1link',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Link', 'anima') ),
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpslidercta2text',
		'type' => 'text',
		'label' => __('CTA Button','anima') . ' #2',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'anima') ),
	'section' => 'anima_lpslider' ),
	array(
	'id' => 'anima_lpslidercta2link',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Link', 'anima') ),
	'section' => 'anima_lpslider' ),

	// blocks
	array(
	'id' => 'anima_lpblockmaintitle',
		'type' => 'text',
		'label' => __('Section Title','anima'),
		'desc' => '',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblockmaindesc',
		'type' => 'textarea',
		'label' => __( 'Section Description', 'anima' ),
		'desc' => '',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblockoneicon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','anima'), 1),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblockone',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'desc' => '&nbsp;',
	'section' => 'anima_lpblocks' ),

	array(
	'id' => 'anima_lpblocktwoicon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','anima'), 2),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblocktwo',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'desc' => '&nbsp;',
	'section' => 'anima_lpblocks' ),

	array(
	'id' => 'anima_lpblockthreeicon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','anima'), 3),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblockthree',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'desc' => '&nbsp;',
	'section' => 'anima_lpblocks' ),

	array(
	'id' => 'anima_lpblockfouricon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','anima'), 4),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblockfour',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'desc' => '&nbsp;',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblockscontent',
		'type' => 'select',
		'label' => __('Blocks Content','anima'),
		'values' => array( 0, 1, 2 ),
		'labels' => array( __("Disabled","anima"), __("Excerpt","anima"), __("Full Content","anima") ),
		'desc' => '',
	'section' => 'anima_lpblocks' ),
	array(
	'id' => 'anima_lpblocksclick',
		'type' => 'checkbox',
		'label' => __('Make icons clickable (linking to their respective pages).','anima'),
		'desc' => '',
	'section' => 'anima_lpblocks' ),


	// boxes #cloned#
	array(
	'id' => 'anima_lpboxmaintitle#',
		'type' => 'text',
		'label' => __('Section Title','anima'),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxmaindesc#',
		'type' => 'textarea',
		'label' => __( 'Section Description', 'anima' ),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxcat#',
		'type' => 'select',
		'label' => __('Boxes Content','anima'),
		'values' => cryout_categories_for_customizer(1, __('All Categories', 'anima'), sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'labels' => cryout_categories_for_customizer(2, __('All Categories', 'anima'), sprintf( '- %s -', __('Disabled', 'anima') ) ),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxcount#',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 1,
			'max' => 100,
		),
		'label' => __('Number of Boxes','anima'),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxrow#',
		'type' => 'select',
		'label' => __('Boxes Per Row','anima'),
		'values' => array( 1, 2, 3, 4 ),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxheight#',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 1,
			'max' => 2000,
		),
		'label' => __('Box Height','anima'),
		'desc' => __("In pixels. The width is a percentage dependent on total site width and number of columns per row.","anima"),
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxlayout#',
		'type' => 'select',
		'label' => __('Box Layout','anima'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Full width","anima"), __("Boxed","anima") ),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxmargins#',
		'type' => 'select',
		'label' => __('Box Stacking','anima'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Joined","anima"), __("Apart","anima") ),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxanimation#',
		'type' => 'select',
		'label' => __('Box Appearance','anima'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Animated","anima"), __("Static","anima") ),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxreadmore#',
		'type' => 'text',
		'label' => __('Read More Button','anima'),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),
	array(
	'id' => 'anima_lpboxlength#',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 1,
			'max' => 100,
		),
		'label' => __('Content Length (words)','anima'),
		'desc' => '',
	'section' => 'anima_lpboxes#' ),

	// texts
	array(
	'id' => 'anima_lptextone',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','anima'), 1),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'anima') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'anima') ),
		'desc' => '',
	'section' => 'anima_lptexts' ),
	array(
	'id' => 'anima_lptexttwo',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','anima'), 2),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'anima') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'anima') ),
		'desc' => '',
	'section' => 'anima_lptexts' ),
	array(
	'id' => 'anima_lptextthree',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','anima'), 3),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'anima') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'anima') ),
		'desc' => '',
	'section' => 'anima_lptexts' ),
	array(
	'id' => 'anima_lptextfour',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','anima'), 4),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'anima') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'anima') ),
		'desc' => __("<br><br>Page properties that will be used:<br>- page title as text title<br>- page content as text content<br>- page featured image as text area background image","anima"),
	'section' => 'anima_lptexts' ),


	//////////////////////////////////////////////////// Colors ////////////////////////////////////////////////////

	array(
	'id' => 'anima_sitebackground',
		'type' => 'color',
		'label' => __('Site Background','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_sitetext',
		'type' => 'color',
		'label' => __('Site Text','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_headingstext',
		'type' => 'color',
		'label' => __('Content Headings','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_contentbackground',
		'type' => 'color',
		'label' => __('Content Background','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_primarybackground',
		'type' => 'color',
		'label' => __('Left Sidebar Background','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_secondarybackground',
		'type' => 'color',
		'label' => __('Right Sidebar Background','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_overlaybackground',
		'type' => 'color',
		'label' => __('Overlay Color','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_overlayopacity',
		'type' => 'slider',
		'label' => __('Overlay Opacity','anima'),
		'min' => 0, 'max' => 100, 'step' => 5, 'um' => '%',
		'desc' => "",
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_menubackground',
		'type' => 'color',
		'label' => __('Header Background','anima'),
		'desc' => '',
	'section' => 'anima_colors_header' ),
	array(
	'id' => 'anima_menutext',
		'type' => 'color',
		'label' => __('Menu Text','anima'),
		'desc' => '',
	'section' => 'anima_colors_header' ),
	array(
	'id' => 'anima_submenutext',
		'type' => 'color',
		'label' => __('Submenu Text','anima'),
		'desc' => '',
	'section' => 'anima_colors_header' ),
	array(
	'id' => 'anima_submenubackground',
		'type' => 'color',
		'label' => __('Submenu Background','anima'),
		'desc' => '',
	'section' => 'anima_colors_header' ),
	array(
	'id' => 'anima_footerbackground',
		'type' => 'color',
		'label' => __('Footer Background','anima'),
		'desc' => '',
	'section' => 'anima_colors_footer' ),
	array(
	'id' => 'anima_footertext',
		'type' => 'color',
		'label' => __('Footer Text','anima'),
		'desc' => '',
	'section' => 'anima_colors_footer' ),
	array(
	'id' => 'anima_lpsliderbg',
		'type' => 'color',
		'label' => __('Slider Background','anima'),
		'desc' => '',
	'section' => 'anima_colors_lp' ),
	array(
	'id' => 'anima_lpblocksbg',
		'type' => 'color',
		'label' => __('Blocks Background','anima'),
		'desc' => '',
	'section' => 'anima_colors_lp' ),
	array(
	'id' => 'anima_lpboxesbg',
		'type' => 'color',
		'label' => __('Boxes Background','anima'),
		'desc' => '',
	'section' => 'anima_colors_lp' ),
	array(
	'id' => 'anima_lptextsbg',
		'type' => 'color',
		'label' => __('Text Areas Background','anima'),
		'desc' => '',
	'section' => 'anima_colors_lp' ),
	array(
	'id' => 'anima_accent1',
		'type' => 'color',
		'label' => __('Primary Accent','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),
	array(
	'id' => 'anima_accent2',
		'type' => 'color',
		'label' => __('Secondary Accent','anima'),
		'desc' => '',
	'section' => 'anima_colors' ),

	//////////////////////////////////////////////////// Fonts ////////////////////////////////////////////////////
	array( // general font
	'id' => 'anima_fgeneralsize',
		'type' => 'select',
		'label' => __('General Font','anima'),
		'values' => cryout_gen_values( 12, 20, 1, array('um'=>'px') ),
		'desc' => '',
	'section' => 'anima_fontfamily' ),
	array(
	'id' => 'anima_fgeneralweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontfamily' ),
	array(
	'id' => 'anima_fgeneral',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontfamily' ),
	array(
	'id' => 'anima_fgeneralgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("The fonts under the <em>Preferred Theme Fonts</em> list are recommended because they have all the font weights used throughout the theme.","anima"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontfamily' ),

	array( // site title font
	'id' => 'anima_fsitetitlesize',
		'type' => 'select',
		'label' => __('Site Title','anima'),
		'values' => cryout_gen_values( 90, 250, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_fontheader' ),
	array(
	'id' => 'anima_fsitetitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontheader' ),
	array(
	'id' => 'anima_fsitetitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontheader' ),
	array(
	'id' => 'anima_fsitetitlegoogle',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontheader' ),

	array( // menu font
	'id' => 'anima_fmenusize',
		'type' => 'select',
		'label' => __('Main Menu','anima'),
		'values' => cryout_gen_values( 80, 140, 5, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_fontheader' ),
	array(
	'id' => 'anima_fmenuweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontheader' ),
	array(
	'id' => 'anima_fmenu',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontheader' ),
	array(
	'id' => 'anima_fmenugoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontheader' ),

	array( // widget fonts
	'id' => 'anima_fwtitlesize',
		'type' => 'select',
		'label' => __('Widget Title','anima'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_fontwidget' ),
	array(
	'id' => 'anima_fwtitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontwidget' ),
	array(
	'id' => 'anima_fwtitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontwidget' ),
	array(
	'id' => 'anima_fwtitlegoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontwidget' ),

	array(
	'id' => 'anima_fwcontentsize',
		'type' => 'select',
		'label' => __('Widget Content','anima'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_fontwidget' ),
	array(
	'id' => 'anima_fwcontentweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontwidget' ),
	array(
	'id' => 'anima_fwcontent',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontwidget' ),
	array(
	'id' => 'anima_fwcontentgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontwidget' ),

	array( // content fonts
	'id' => 'anima_ftitlessize',
		'type' => 'select',
		'label' => __('Post/Page Titles','anima'),
		'values' => cryout_gen_values( 130, 300, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_ftitlesweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_ftitles',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_ftitlesgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontcontent' ),

	array( // meta fonts
	'id' => 'anima_metatitlessize',
		'type' => 'select',
		'label' => __('Post metas','anima'),
		'values' => cryout_gen_values( 70, 160, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_metatitlesweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_metatitles',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_metatitlesgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontcontent' ),


	array(
	'id' => 'anima_fheadingssize',
		'type' => 'select',
		'label' => __('Headings','anima'),
		'values' => cryout_gen_values( 100, 150, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_fheadingsweight',
		'type' => 'select',
		'label' => '',
		'values' => array('300','400','700','800'),
		'labels' => array( __('300 (ligher)','anima'), __('400 (normal)','anima'), __('700 (bold)','anima'), __('800 (bolder)','anima') ),
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_fheadings',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'anima_fontcontent' ),
	array(
	'id' => 'anima_fheadingsgoogle',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','anima') ),
	'section' => 'anima_fontcontent' ),

	array( // formatting
	'id' => 'anima_lineheight',
		'type' => 'select',
		'label' => __('Line Height','anima'),
		'values' => cryout_gen_values( 1.0, 2.4, 0.2, array('um'=>'em') ),
		'desc' => '',
	'section' => 'anima_textformatting' ),
	array(
	'id' => 'anima_textalign',
		'type' => 'select',
		'label' => __('Text Alignment','anima'),
		'values' => array( "Default" , "Left" , "Right" , "Justify" , "Center" ),
		'labels' => array( __("Default","anima"), __("Left","anima"), __("Right","anima"), __("Justify","anima"), __("Center","anima") ),
		'desc' => '',
	'section' => 'anima_textformatting' ),
	array(
	'id' => 'anima_paragraphspace',
		'type' => 'select',
		'label' => __('Paragraph Spacing','anima'),
		'values' => cryout_gen_values( 0.5, 1.6, 0.1, array('um'=>'em', 'pre'=>array('0.0em') ) ),
		'desc' => '',
	'section' => 'anima_textformatting' ),
	array(
	'id' => 'anima_parindent',
		'type' => 'select',
		'label' => __('Paragraph Indentation','anima'),
		'values' => cryout_gen_values( 0, 2, 0.5, array('um'=>'em') ),
		'desc' => '',
	'section' => 'anima_textformatting' ),

	//////////////////////////////////////////////////// Structure ////////////////////////////////////////////////////

	array(
	'id' => 'anima_breadcrumbs',
		'type' => 'select',
		'label' => __('Breadcrumbs','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_contentstructure' ),
	array(
	'id' => 'anima_pagination',
		'type' => 'select',
		'label' => __('Numbered Pagination','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_contentstructure' ),
	array(
	'id' => 'anima_singlenav',
		'type' => 'select',
		'label' => __('Single Post Prev/Next Navigation','anima'),
		'values' => array( 2, 1, 0 ),
		'labels' => array( __("Absolute","anima"), __("Static", "anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_contentstructure' ),
	array(
	'id' => 'anima_contenttitles',
		'type' => 'select',
		'label' => __('Page/Category Titles','anima'),
		'values' => array( 1, 2, 3, 0 ),
		'labels' => array( __('Always Visible','anima'), __('Hide on Pages','anima'), __('Hide on Categories','anima'), __('Always Hidden','anima') ),
		'desc' => '',
	'section' => 'anima_contentstructure' ),
	array(
	'id' => 'anima_totop',
		'type' => 'select',
		'label' => __('Back to Top Button','anima'),
		'values' => array( 'anima-totop-normal', 'anima-totop-fixed', 'anima-totop-disabled' ),
		'labels' => array( __("Bottom of page","anima"), __("In footer","anima"), __("Disabled","anima") ),
		'desc' => '',
	'section' => 'anima_contentstructure' ),
	array(
	'id' => 'anima_tables',
		'type' => 'select',
		'label' => __('Tables Style','anima'),
		'values' => array( 'anima-no-table', 'anima-clean-table', 'anima-stripped-table', 'anima-bordered-table' ),
		'labels' => array( __("No border","anima"), __("Clean","anima"), __("Stripped","anima"), __("Bordered","anima") ),
		'desc' => '',
	'section' => 'anima_contentstructure' ),
	array(
	'id' => 'anima_normalizetags',
		'type' => 'select',
		'label' => __('Tags Cloud Appearance','anima'),
		'values' => array( 0, 1 ),
		'labels' => array( __("Size Emphasis","anima"), __("Uniform Boxes","anima") ),
		'desc' => '',
	'section' => 'anima_contentstructure' ),
array(
		'id' => 'anima_copyright',
		'type' => 'textarea',
		'label' => __( 'Custom Footer Text', 'anima' ),
		'desc' => __("Insert custom text or basic HTML code that will appear in your footer. <br /> You can use HTML to insert links, images and special characters.","anima"),
		'section' => 'anima_contentstructure' ),

	//////////////////////////////////////////////////// Graphics ////////////////////////////////////////////////////

	array(
	'id' => 'anima_elementborder',
		'type' => 'checkbox',
		'label' => __('Border','anima'),
		'desc' => '',
	'section' => 'anima_contentgraphics' ),
	array(
	'id' => 'anima_elementshadow',
		'type' => 'checkbox',
		'label' => __('Shadow','anima'),
		'desc' => '',
	'section' => 'anima_contentgraphics' ),
	array(
	'id' => 'anima_elementborderradius',
		'type' => 'checkbox',
		'label' => __('Rounded Corners','anima'),
		'desc' => __('These decorations apply to certain theme elements.','anima'),
	'section' => 'anima_contentgraphics' ),
	array(
	'id' => 'anima_articleanimation',
		'type' => 'select',
		'label' => __('Article Animation on Scroll','anima'),
		'values' => array( 0, 1, 2, 3, 4),
		'labels' => array( __("None","anima"), __("Fade","anima"), __("Slide","anima"), __("Slide Left","anima"), __("Slide Right","anima") ),
		'desc' => '',
	'section' => 'anima_contentgraphics' ),

	//////////////////////////////////////////////////// Search Box ////////////////////////////////////////////////////

	array(
	'id' => 'anima_searchboxmain',
		'type' => 'checkbox',
		'label' => __('Add Search to Main Menu','anima'),
		'desc' => '',
	'section' => 'anima_searchbox' ),
	array(
	'id' => 'anima_searchboxfooter',
		'type' => 'checkbox',
		'label' => __('Add Search to Footer Menu','anima'),
		'desc' => '',
	'section' => 'anima_searchbox' ),

	//////////////////////////////////////////////////// Content Image ////////////////////////////////////////////////////

	array(
	'id' => 'anima_image_style',
		'type' => 'radioimage',
		'label' => __('Post Images','anima'),
		'choices' => array(
			'anima-image-none' => array(
				'label' => __("No Styling","anima"),
				'url'   => '%s/admin/images/image-style-0.png'
			),
			'anima-image-one' => array(
				'label' => sprintf( __("Style %d","anima"), 1),
				'url'   => '%s/admin/images/image-style-1.png'
			),
			'anima-image-two' => array(
				'label' => sprintf( __("Style %d","anima"), 2),
				'url'   => '%s/admin/images/image-style-2.png'
			),
			'anima-image-three' => array(
				'label' => sprintf( __("Style %d","anima"), 3),
				'url'   => '%s/admin/images/image-style-3.png'
			),
			'anima-image-four' => array(
				'label' => sprintf( __("Style %d","anima"), 4),
				'url'   => '%s/admin/images/image-style-4.png'
			),
			'anima-image-five' => array(
				'label' => sprintf( __("Style %d","anima"), 5),
				'url'   => '%s/admin/images/image-style-5.png'
			),
		),
		'desc' => '',
	'section' => 'anima_postimage' ),
	array(
	'id' => 'anima_caption_style',
		'type' => 'select',
		'label' => __('Post Captions','anima'),
		'values' => array( 'anima-caption-zero', 'anima-caption-one', 'anima-caption-two' ),
		'labels' => array( __('Plain','anima'), __('With Border','anima'), __('With Background','anima') ),
		'desc' => '',
	'section' => 'anima_postimage' ),


	//////////////////////////////////////////////////// Post Information ////////////////////////////////////////////////////

	array( // meta
	'id' => 'anima_meta_author',
		'type' => 'checkbox',
		'label' => __("Display Author","anima"),
		'desc' => '',
	'section' => 'anima_metas' ),
	array(
	'id' => 'anima_meta_date',
		'type' => 'checkbox',
		'label' => __("Display Date","anima"),
		'desc' => '',
	'section' => 'anima_metas' ),
	array(
	'id' => 'anima_meta_time',
		'type' => 'checkbox',
		'label' => __("Display Time","anima"),
		'desc' => '',
	'section' => 'anima_metas' ),
	array(
	'id' => 'anima_meta_category',
		'type' => 'checkbox',
		'label' => __("Display Category","anima"),
		'desc' => '',
	'section' => 'anima_metas' ),
	array(
	'id' => 'anima_meta_tag',
		'type' => 'checkbox',
		'label' => __("Display Tags","anima"),
		'desc' => '',
	'section' => 'anima_metas' ),
	array(
	'id' => 'anima_meta_comment',
		'type' => 'checkbox',
		'label' => __("Display Comments","anima"),
		'desc' => __("Choose meta information to show on posts.","anima"),
	'section' => 'anima_metas' ),


	array( // meta
	'id' => 'anima_headertitles_posts',
		'type' => 'checkbox',
		'label' => __("Posts","anima"),
		'desc' => '',
	'section' => 'anima_headertitles' ),
	array(
	'id' => 'anima_headertitles_pages',
		'type' => 'checkbox',
		'label' => __("Pages","anima"),
		'desc' => '',
	'section' => 'anima_headertitles' ),
	array(
	'id' => 'anima_headertitles_archives',
		'type' => 'checkbox',
		'label' => __("Archive pages","anima"),
		'desc' => '',
	'section' => 'anima_headertitles' ),
	array(
	'id' => 'anima_headertitles_home',
		'type' => 'checkbox',
		'label' => __("Home page","anima"),
		'desc' => '',
	'section' => 'anima_headertitles' ),


	array( // comments
	'id' => 'anima_comclosed',
		'type' => 'select',
		'label' => __("'Comments Are Closed' Text",'anima'),
		'values' => array( 1, 2, 3, 0 ), // "Show" , "Hide in posts", "Hide in pages", "Hide everywhere"
		'labels' => array( __("Show","anima"), __("Hide in posts","anima"), __("Hide in pages","anima"), __("Hide everywhere","anima") ),
		'desc' => '',
	'section' => 'anima_comments' ),
	array(
	'id' => 'anima_comdate',
		'type' => 'select',
		'label' => __('Comment Date Format','anima'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Specific","anima"), __("Relative","anima") ),
		'desc' => '',
	'section' => 'anima_comments' ),
	array(
	'id' => 'anima_comlabels',
		'type' => 'select',
		'label' => __('Comment Field Label','anima'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Placeholders","anima"), __("Labels","anima") ),
		'desc' => __("Change to labels for better compatibility with comment-related plugins.","anima"),
	'section' => 'anima_comments' ),
	array(
	'id' => 'anima_comformwidth',
		'type' => 'number',
		'label' => __('Comment Form Width (pixels)','anima'),
		'desc' => '',
	'section' => 'anima_comments' ),

	array( // excerpts
	'id' => 'anima_excerpthome',
		'type' => 'select',
		'label' => __( 'Standard Posts On Homepage', 'anima' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","anima"), __("Full Post","anima") ),
		'desc' => __("Post formats always display full posts.","anima"),
	'section' => 'anima_excerpts' ),
	array(
	'id' => 'anima_excerptsticky',
		'type' => 'select',
		'label' => __( 'Sticky Posts on Homepage', 'anima' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Inherit","anima"), __("Full Post","anima") ),
		'desc' => '',
	'section' => 'anima_excerpts' ),
	array(
	'id' => 'anima_excerptarchive',
		'type' => 'select',
		'label' => __( 'Standard Posts in Categories/Archives', 'anima' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","anima"), __("Full Post","anima") ),
		'desc' => '',
	'section' => 'anima_excerpts' ),
	array(
	'id' => 'anima_excerptlength',
		'type' => 'number',
		'label' => __( 'Excerpt Length (words)' , 'anima' ),
		'desc' => '',
	'section' => 'anima_excerpts' ),
	array(
	'id' => 'anima_excerptdots',
		'type' => 'text',
		'label' => __( 'Excerpt Suffix', 'anima' ),
		'desc' => '',
	'section' => 'anima_excerpts' ),
	array(
	'id' => 'anima_excerptcont',
		'type' => 'text',
		'label' => __( 'Continue Reading Label', 'anima' ),
		'desc' => '',
	'section' => 'anima_excerpts' ),

	//////////////////////////////////////////////////// Featured Images ////////////////////////////////////////////////////
	array(
	'id' => 'anima_fpost',
		'type' => 'select',
		'label' => __( 'Featured Images', 'anima' ),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","anima"), __("Disabled","anima") ),
		'desc' => '',
	'section' => 'anima_featured' ),
	array(
	'id' => 'anima_fauto',
		'type' => 'select',
		'label' => __( 'Auto Select Image From Content', 'anima' ),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","anima"), __("Disabled","anima") ),
		'desc' => '',
	'section' => 'anima_featured' ),
	array(
	'id' => 'anima_fheight',
		'type' => 'number',
		'label' => __( 'Featured Image Height (in pixels)', 'anima' ),
		'desc' => '',
	'section' => 'anima_featured' ),
	array(
	'id' => 'anima_fheight_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","anima"),
		//'active_callback' => 'anima_conditionals',
	'section' => 'anima_featured' ),
	array(
	'id' => 'anima_fresponsive',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Cropped","anima"), __("Contained","anima") ),
		'label' => __('Featured Image Behaviour','anima'),
		'desc' => __("<strong>Contained</strong> will scale depending on the viewed resolution<br><strong>Cropped</strong> will always have the configured height.","anima"),
	'section' => 'anima_featured' ),
	array(
	'id' => 'anima_falign',
		'type' => 'select',
		'label' => __( 'Featured Image Crop Position', 'anima' ),
		'values' => array( "left top" , "left center", "left bottom", "right top", "right center", "right bottom", "center top", "center center", "center bottom" ),
		'labels' => array( __("Left Top","anima"), __("Left Center","anima"), __("Left Bottom","anima"), __("Right Top","anima"), __("Right Center","anima"), __("Right Bottom","anima"), __("Center Top","anima"), __("Center Center","anima"), __("Center Bottom","anima") ),
		'desc' => '',
	'section' => 'anima_featured' ),
	array(
	'id' => 'anima_falign_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","anima"),
		//'active_callback' => 'anima_conditionals',
	'section' => 'anima_featured' ),

	array(
	'id' => 'anima_fheader',
		'type' => 'select',
		'label' => __('Use Featured Images in Header','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_featured' ),

	//////////////////////////////////////////////////// Social Positions ////////////////////////////////////////////////////

	array(
	'id' => 'anima_socials_header',
		'type' => 'checkbox',
		'label' => __( 'Display in Header', 'anima' ),
		'desc' => '',
	'section' => 'anima_socials' ),
	array(
	'id' => 'anima_socials_footer',
		'type' => 'checkbox',
		'label' => __( 'Display in Footer', 'anima' ),
		'desc' => '',
	'section' => 'anima_socials' ),
	array(
	'id' => 'anima_socials_left_sidebar',
		'type' => 'checkbox',
		'label' => __( 'Display in Left Sidebar', 'anima' ),
		'desc' => '',
	'section' => 'anima_socials' ),
	array(
	'id' => 'anima_socials_right_sidebar',
		'type' => 'checkbox',
		'label' => __( 'Display in Right Sidebar', 'anima' ),
		'desc' => sprintf( __( 'Select where social icons should be visible in.<br><br><strong>Social Icons are defined using the <a href="%1$s" target="_blank">social icons menu</a></strong>. Read the <a href="%2$s" target="_blank">theme documentation</a> on how to create a social menu.', 'anima' ), 'nav-menus.php?action=locations', 'http://www.cryoutcreations.eu/wordpress-tutorials/use-new-social-menu' ),
	'section' => 'anima_socials' ),

	//////////////////////////////////////////////////// Miscellaneous ////////////////////////////////////////////////////

	array(
	'id' => 'anima_masonry',
		'type' => 'select',
		'label' => __('Masonry','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_misc' ),
	array(
	'id' => 'anima_defer',
		'type' => 'select',
		'label' => __('JS Defer loading','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_misc' ),
	array(
	'id' => 'anima_fitvids',
		'type' => 'select',
		'label' => __('FitVids','anima'),
		'values' => array( 1, 2, 0 ),
		'labels' => array( __("Enable","anima"), __("Enable on mobiles","anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_misc' ),
	array(
	'id' => 'anima_autoscroll',
		'type' => 'select',
		'label' => __('Autoscroll','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","anima"), __("Disable","anima") ),
		'desc' => '',
	'section' => 'anima_misc' ),
	array(
	'id' => 'anima_editorstyles',
		'type' => 'select',
		'label' => __('Editor Styles','anima'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","anima"), __("Disable","anima") ),
		'desc' => __("<br>Only use these options to troubleshoot issues.","anima"),
	'section' => 'anima_misc' ),
	//////////////////////////////////////////////////// !!! DEVELOPER !!! ////////////////////////////////////////////////////
	// nothing for now

), // options

/* option=array(
	type: checkbox, select, textarea, input, function
	id: field_name or custom_function_name
	values: value_0, value_1, value_2 | true/false | number
	labels: __('Label 0','context'), ... | __('Enabled','context')/... |  number/__('Once','context')/...
	desc: html to be displayed at the question mark
	section: section_id

	array(
	'id' => '',
		'type' => '',
		'label' => '',
		'values' => array(  ),
		'labels' => array(  ),
		'desc' => '',
		'input_attrs' => array(  ),
		// conditionals
		'disable_if' => 'function_name',
		'require_fn' => 'function_name',
		'display_width' => '?????',
	'section' => '' ),

*/

/*** fonts ***/
'fonts' => array(

	'Preferred Theme Fonts'=> array(
					"Raleway/gfont",
					"Roboto/gfont",
					"Source Sans Pro/gfont",
					"Ubuntu/gfont",
					"Ubuntu Condensed/gfont",
					"Open Sans/gfont",
					"Open Sans Condensed:300/gfont",
					"Lato/gfont",
					"Droid Sans/gfont",
					"Oswald/gfont",
					"Yanone Kaffeesatz/gfont",
					),
	'Sans-Serif' => array(
					"Segoe UI, Arial, sans-serif",
					"Verdana, Geneva, sans-serif" ,
					"Geneva, sans-serif",
					"Helvetica Neue, Arial, Helvetica, sans-serif",
					"Helvetica, sans-serif" ,
					"Century Gothic, AppleGothic, sans-serif",
				    "Futura, Century Gothic, AppleGothic, sans-serif",
					"Calibri, Arian, sans-serif",
				    "Myriad Pro, Myriad,Arial, sans-serif",
					"Trebuchet MS, Arial, Helvetica, sans-serif" ,
					"Gill Sans, Calibri, Trebuchet MS, sans-serif",
					"Impact, Haettenschweiler, Arial Narrow Bold, sans-serif",
					"Tahoma, Geneva, sans-serif" ,
					"Arial, Helvetica, sans-serif" ,
					"Arial Black, Gadget, sans-serif",
					"Lucida Sans Unicode, Lucida Grande, sans-serif"
					),
	'Serif' => array(
					"Georgia, Times New Roman, Times, serif",
					"Times New Roman, Times, serif",
					"Cambria, Georgia, Times, Times New Roman, serif",
					"Palatino Linotype, Book Antiqua, Palatino, serif",
					"Book Antiqua, Palatino, serif",
					"Palatino, serif",
				    "Baskerville, Times New Roman, Times, serif",
 					"Bodoni MT, serif",
					"Copperplate Light, Copperplate Gothic Light, serif",
					"Garamond, Times New Roman, Times, serif"
					),
	'MonoSpace' => array(
					"Courier New, Courier, monospace" ,
					"Lucida Console, Monaco, monospace",
					"Consolas, Lucida Console, Monaco, monospace",
					"Monaco, monospace"
					),
	'Cursive' => array(
					"Lucida Casual, Comic Sans MS, cursive",
				    "Brush Script MT, Phyllis, Lucida Handwriting, cursive",
					"Phyllis, Lucida Handwriting, cursive",
					"Lucida Handwriting, cursive",
					"Comic Sans MS, cursive"
					)
	), // fonts

/*** google font option fields ***/
'google-font-enabled-fields' => array(
	'anima_fgeneral',
	'anima_fsitetitle',
	'anima_fmenu',
	'anima_fwtitle',
	'anima_fwcontent',
	'anima_ftitles',
	'anima_metatitles',
	'anima_fheadings',
	),

	/*** landing page blocks icons ***/
	'block-icons' => array(
		'no-icon' => '&nbsp;',
		'toggle' => 'e003',
		'layout' => 'e004',
		'lock' => 'e007',
		'unlock' => 'e008',
		'target' => 'e012',
		'disc' => 'e019',
		'microphone' => 'e048',
		'play' => 'e052',
		'cloud2' => 'e065',
		'cloud-upload' => 'e066',
		'cloud-download' => 'e067',
		'plus2' => 'e114',
		'minus2' => 'e115',
		'check2' => 'e116',
		'cross2' => 'e117',
		'users2' => 'e00a',
		'user' => 'e00b',
		'trophy' => 'e00c',
		'speedometer' => 'e00d',
		'screen-tablet' => 'e00f',
		'screen-smartphone' => 'e01a',
		'screen-desktop' => 'e01b',
		'plane' => 'e01c',
		'notebook' => 'e01d',
		'magic-wand' => 'e01e',
		'hourglass2' => 'e01f',
		'graduation' => 'e02a',
		'fire' => 'e02b',
		'eyeglass' => 'e02c',
		'energy' => 'e02d',
		'chemistry' => 'e02e',
		'bell' => 'e02f',
		'badge' => 'e03a',
		'speech' => 'e03b',
		'puzzle' => 'e03c',
		'printer' => 'e03d',
		'present' => 'e03e',
		'pin' => 'e03f',
		'picture2' => 'e04a',
		'map' => 'e04b',
		'layers' => 'e04c',
		'globe' => 'e04d',
		'globe2' => 'e04e',
		'folder' => 'e04f',
		'feed' => 'e05a',
		'drop' => 'e05b',
		'drawar' => 'e05c',
		'docs' => 'e05d',
		'directions' => 'e05e',
		'direction' => 'e05f',
		'cup2' => 'e06b',
		'compass' => 'e06c',
		'calculator' => 'e06d',
		'bubbles' => 'e06e',
		'briefcase' => 'e06f',
		'book-open' => 'e07a',
		'basket' => 'e07b',
		'bag' => 'e07c',
		'wrench' => 'e07f',
		'umbrella' => 'e08a',
		'tag' => 'e08c',
		'support' => 'e08d',
		'share' => 'e08e',
		'share2' => 'e08f',
		'rocket' => 'e09a',
		'question' => 'e09b',
		'pie-chart2' => 'e09c',
		'pencil2' => 'e09d',
		'note' => 'e09e',
		'music-tone-alt' => 'e09f',
		'list2' => 'e0a0',
		'like' => 'e0a1',
		'home2' => 'e0a2',
		'grid' => 'e0a3',
		'graph' => 'e0a4',
		'equalizer' => 'e0a5',
		'dislike' => 'e0a6',
		'calender' => 'e0a7',
		'bulb' => 'e0a8',
		'chart' => 'e0a9',
		'clock' => 'e0af',
		'envolope' => 'e0b1',
		'flag' => 'e0b3',
		'folder2' => 'e0b4',
		'heart2' => 'e0b5',
		'info' => 'e0b6',
		'link' => 'e0b7',
		'refresh' => 'e0bc',
		'reload' => 'e0bd',
		'settings' => 'e0be',
		'arrow-down' => 'e604',
		'arrow-left' => 'e605',
		'arrow-right' => 'e606',
		'arrow-up' => 'e607',
		'paypal' => 'e608',
		'home' => 'e800',
		'apartment' => 'e801',
		'data' => 'e80e',
		'cog' => 'e810',
		'star' => 'e814',
		'star-half' => 'e815',
		'star-empty' => 'e816',
		'paperclip' => 'e819',
		'eye2' => 'e81b',
		'license' => 'e822',
		'picture' => 'e827',
		'book' => 'e828',
		'bookmark' => 'e829',
		'users' => 'e82b',
		'store' => 'e82d',
		'calendar' => 'e836',
		'keyboard' => 'e837',
		'spell-check' => 'e838',
		'screen' => 'e839',
		'smartphone' => 'e83a',
		'tablet' => 'e83b',
		'laptop' => 'e83c',
		'laptop-phone' => 'e83d',
		'construction' => 'e841',
		'pie-chart' => 'e842',
		'gift' => 'e844',
		'diamond' => 'e845',
		'cup3' => 'e848',
		'leaf' => 'e849',
		'earth' => 'e853',
		'bullhorn' => 'e859',
		'hourglass' => 'e85f',
		'undo' => 'e860',
		'redo' => 'e861',
		'sync' => 'e862',
		'history' => 'e863',
		'download' => 'e865',
		'upload' => 'e866',
		'bug' => 'e869',
		'code' => 'e86a',
		'link2' => 'e86b',
		'unlink' => 'e86c',
		'thumbs-up' => 'e86d',
		'thumbs-down' => 'e86e',
		'magnifier' => 'e86f',
		'cross3' => 'e870',
		'menu' => 'e871',
		'list' => 'e872',
		'warning' => 'e87c',
		'question-circle' => 'e87d',
		'check' => 'e87f',
		'cross' => 'e880',
		'plus' => 'e881',
		'minus' => 'e882',
		'layers2' => 'e88e',
		'text-format' => 'e890',
		'text-size' => 'e892',
		'hand' => 'e8a5',
		'pointer-up' => 'e8a6',
		'pointer-right' => 'e8a7',
		'pointer-down' => 'e8a8',
		'pointer-left' => 'e8a9',
		'heart' => 'e930',
		'cloud' => 'e931',
		'trash' => 'e933',
		'user2' => 'e934',
		'key' => 'e935',
		'search' => 'e936',
		'settings2' => 'e937',
		'camera' => 'e938',
		'tag2' => 'e939',
		'bulb2' => 'e93a',
		'pencil' => 'e93b',
		'diamond2' => 'e93c',
		'location' => 'e93e',
		'eye' => 'e93f',
		'bubble' => 'e940',
		'stack' => 'e941',
		'cup' => 'e942',
		'phone' => 'e943',
		'news' => 'e944',
		'mail' => 'e945',
		'news2' => 'e948',
		'paperplane' => 'e949',
		'params2' => 'e94a',
		'data2' => 'e94b',
		'megaphone' => 'e94c',
		'study' => 'e94d',
		'chemistry2' => 'e94e',
		'fire2' => 'e94f',
		'paperclip2' => 'e950',
		'calendar2' => 'e951',
		'wallet' => 'e952',
		),

/*** ajax load more identifiers ***/
'theme_identifiers' => array(
	'load_more_optid' 			=> 'anima_lpposts_more',
	'content_css_selector' 		=> '#lp-posts .lp-posts-inside',
	'pagination_css_selector' 	=> '#lp-posts nav.navigation',
),

/************* widget areas *************/

'widget-areas' => array(
	'sidebar-2' => array(
		'name' => __( 'Sidebar Left', 'anima' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'sidebar-1' => array(
		'name' => __( 'Sidebar Right', 'anima' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'footer-widget-area' => array(
		'name' => __( 'Footer', 'anima' ),
		'description' 	=> __('You can configure how many columns the footer displays from the theme options', 'anima'),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="footer-widget-inside">',
		'after_widget' => '</div></section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'content-widget-area-before' => array(
		'name' => __( 'Content Before', 'anima' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'content-widget-area-after' => array(
		'name' => __( 'Content After', 'anima' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'widget-area-header' => array(
		'name' => __( 'Header', 'anima' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
), // widget-areas


); // $anima_big

// FIN
