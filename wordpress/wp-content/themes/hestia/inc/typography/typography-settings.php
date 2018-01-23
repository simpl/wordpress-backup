<?php
/**
 * Typography settings for both Hestia and Hestia PRO
 *
 * @package Hestia
 * @since 1.1.38
 */

/**
 * Include functions file for Font Family controls.
 */
$font_selector_functions = HESTIA_PHP_INCLUDE . 'customizer-font-selector/functions.php';
if ( file_exists( $font_selector_functions ) ) {
	require_once( $font_selector_functions );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.1.38
 */
function hestia_customize_preview() {
	wp_enqueue_script( 'hestia_customizer', get_template_directory_uri() . '/inc/typography/js/customizer.js', array( 'customize-preview' ), HESTIA_VERSION, true );
}

add_action( 'customize_preview_init', 'hestia_customize_preview' );

/**
 * Customizer controls for typography settings.
 *
 * @param WP_Customize_Manager $wp_customize Customize manager.
 *
 * @since 1.1.38
 */
function hestia_typography_settings( $wp_customize ) {

	/**
	 * Main typography panel
	 */

	$wp_customize->add_section(
		'hestia_typography', array(
			'title'    => esc_html__( 'Typography', 'hestia' ),
			'panel'    => 'hestia_appearance_settings',
			'priority' => 25,
		)
	);

	/**
	 * ------------------
	 * 1. Font Family tab
	 * ------------------
	 */

	if ( class_exists( 'Hestia_Font_Selector' ) ) {

		/**
		 * ---------------------------------
		 * 1.a. Headings font family control
		 * This control allows the user to choose a font family for all Headings used in the theme ( h1 - h6 )
		 * --------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_headings_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Hestia_Font_Selector(
				$wp_customize, 'hestia_headings_font', array(
					'label'    => esc_html__( 'Headings', 'hestia' ) . ' ' . esc_html__( 'font family', 'hestia' ),
					'section'  => 'hestia_typography',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);

		/**
		 * ---------------------------------
		 * 1.b. Body font family control
		 * This control allows the user to choose a font family for all elements in the body tag
		 * --------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_body_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Hestia_Font_Selector(
				$wp_customize, 'hestia_body_font', array(
					'label'    => esc_html__( 'Body', 'hestia' ) . ' ' . esc_html__( 'font family', 'hestia' ),
					'section'  => 'hestia_typography',
					'priority' => 10,
					'type'     => 'select',
				)
			)
		);
	} // End if().

	if ( class_exists( 'Hestia_Select_Multiple' ) ) {

		/**
		 * --------------------
		 * 1.c. Font Subsets control
		 * This control allows the user to choose a subset for the font family ( for e.g. lating, cyrillic etc )
		 * --------------------
		 */

		$wp_customize->add_setting(
			'hestia_font_subsets', array(
				'sanitize_callback' => 'hestia_sanitize_array',
				'default'           => array( 'latin' ),
			)
		);

		$wp_customize->add_control(
			new Hestia_Select_Multiple(
				$wp_customize, 'hestia_font_subsets', array(
					'section'  => 'hestia_typography',
					'label'    => esc_html__( 'Font Subsets', 'hestia' ),
					'choices'  => array(
						'latin'        => 'latin',
						'latin-ext'    => 'latin-ext',
						'cyrillic'     => 'cyrillic',
						'cyrillic-ext' => 'cyrillic-ext',
						'greek'        => 'greek',
						'greek-ext'    => 'greek-ext',
						'vietnamese'   => 'vietnamese',
					),
					'priority' => 45,
				)
			)
		);
	} // End if().

	/**
	 * ------------------
	 * 2. Font Size tab
	 * ------------------
	 */

	if ( class_exists( 'Hestia_Customizer_Range_Value_Control' ) ) {

		/**
		 * --------------
		 * Posts & Pages
		 * --------------
		 */

		if ( class_exists( 'Hestia_Customizer_Heading' ) ) {

			$wp_customize->add_setting(
				'hestia_posts_and_pages_title', array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new Hestia_Customizer_Heading(
					$wp_customize, 'hestia_posts_and_pages_title', array(
						'label'    => esc_html__( 'Posts & Pages', 'hestia' ),
						'section'  => 'hestia_typography',
						'priority' => 50,
					)
				)
			);
		}

		/**
		 * ---------------------------------
		 * 2.a. Title control [Posts & Pages]
		 * This control allows the user to choose a font size for the main titles that appear in the header for pages and posts.
		 * The values area between -25 and +25 px.
		 * --------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_header_titles_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => '0',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_header_titles_fs', array(
					'label'       => esc_html__( 'Title', 'hestia' ),
					'section'     => 'hestia_typography',
					'type'        => 'range-value',
					'input_attr'  => array(
						'min'  => - 25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'    => 60,
					'media_query' => true,
					'sum_type'    => true,
				)
			)
		);

		/**
		 * ---------------------------------
		 * 2.b. Headings control [Posts & Pages]
		 * This control allows the user to choose a font size for all headings ( h1 - h6 ) from pages and posts.
		 * The values area between -25 and +25 px.
		 * --------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_post_page_headings_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => 0,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_post_page_headings_fs', array(
					'label'      => esc_html__( 'Headings', 'hestia' ),
					'section'    => 'hestia_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => - 25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'   => 70,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * ---------------------------------
		 * 2.c. Content control [Posts & Pages]
		 * This control allows the user to choose a font size for the main content area in pages and posts.
		 * The values area between -25 and +25 px.
		 * --------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_post_page_content_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => 0,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_post_page_content_fs', array(
					'label'      => esc_html__( 'Content', 'hestia' ),
					'section'    => 'hestia_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => - 25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'   => 80,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * -----------------------------
		 * Blog, Frontpage & WooCommerce
		 * TODO: This section is hidden at this moment (1.1.58) and we need to fix all the problems until have it back in both lite and pro
		 * For now, it's been used only for migration purposes for users that had the option to change more fonts in ver 1.1.56 and got removed in 1.1.57
		 * -----------------------------
		 */

		if ( class_exists( 'Hestia_Customizer_Heading' ) ) {

			$wp_customize->add_setting(
				'hestia_frontpage_title', array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new Hestia_Customizer_Heading(
					$wp_customize, 'hestia_frontpage_title', array(
						'label'    => esc_html__( 'Blog, Frontpage & WooCommerce', 'hestia' ),
						'section'  => 'hestia_typography',
						'priority' => 10,
					)
				)
			);
		}

		/**
		 * --------------------------------------------------
		 * 2.d. Titles control [Blog, Frontpage & WooCommerce]
		 * This control allows the user to choose a font size for all Titles for Frontpage Sections ( for Slider check Posts & Pages Title ), Box Headings for Frontpage Sections, Blog and WooCommerce pages ( Single product page, Cart and Checkout.
		 * The values area between -25 and +25 px.
		 * --------------------------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_section_primary_headings_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => '0',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_section_primary_headings_fs', array(
					'label'       => esc_html__( 'Titles', 'hestia' ),
					'description' => esc_html__( 'Titles for Frontpage Sections ( for Slider check Posts & Pages Title ), Box Headings for Frontpage Sections, Blog and WooCommerce pages ( Single product page, Cart and Checkout ).', 'hestia' ),
					'section'     => 'hestia_typography',
					'type'        => 'range-value',
					'input_attr'  => array(
						'min'  => - 25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'    => 20,
					'media_query' => true,
					'sum_type'    => true,
				)
			)
		);

		/**
		 * -----------------------------------------------------
		 * 2.e. Subtitles control [Blog, Frontpage & WooCommerce]
		 * This control allows the user to choose a font size for all Subtitles on Blog and Frontpage sections and WooCommerce price on product page.
		 * The values area between -25 and +25 px.
		 * -----------------------------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_section_secondary_headings_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => 0,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_section_secondary_headings_fs', array(
					'label'       => esc_html__( 'Subtitles', 'hestia' ),
					'description' => esc_html__( 'Subtitles on Blog and Frontpage sections and WooCommerce price on product page.', 'hestia' ),
					'section'     => 'hestia_typography',
					'type'        => 'range-value',
					'input_attr'  => array(
						'min'  => - 25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'    => 30,
					'media_query' => true,
					'sum_type'    => true,
				)
			)
		);

		/**
		 * -----------------------------------------------------
		 * 2.e. Content control [Blog, Frontpage & WooCommerce]
		 * This control allows the user to choose a font size for the Main content for Frontpage Sections, Blog and WooCommerce pages ( Single product page and Shop page ).
		 * The values area between -25 and +25 px.
		 * -----------------------------------------------------
		 */

		$wp_customize->add_setting(
			'hestia_section_content_fs', array(
				'sanitize_callback' => 'hestia_sanitize_range_value',
				'default'           => 0,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_section_content_fs', array(
					'label'       => esc_html__( 'Content', 'hestia' ),
					'description' => esc_html__( 'Main content for Frontpage Sections, Blog and WooCommerce pages ( Single product page and Shop page ).', 'hestia' ),
					'section'     => 'hestia_typography',
					'type'        => 'range-value',
					'input_attr'  => array(
						'min'  => - 25,
						'max'  => 25,
						'step' => 1,
					),
					'priority'    => 40,
					'media_query' => true,
					'sum_type'    => true,
				)
			)
		);
	} // End if().
}

add_action( 'customize_register', 'hestia_typography_settings', 20 );

if ( ! file_exists( 'hestia_fonts_inline_style' ) ) {
	/**
	 * Add inline style for custom fonts.
	 *
	 * @since 1.1.59
	 */
	function hestia_fonts_inline_style() {

		/**
		 * Headings font family.
		 */
		$custom_css           = '';
		$default              = apply_filters( 'hestia_headings_default', false );
		$hestia_headings_font = get_theme_mod( 'hestia_headings_font', $default );

		if ( ! empty( $hestia_headings_font ) ) {
			hestia_enqueue_google_font( $hestia_headings_font );
			$custom_css .=
				'h1, h2, h3, h4, h5, h6, .hestia-title , .info-title, .card-title,
		.page-header.header-small .hestia-title, .page-header.header-small .title, .widget h5, .hestia-title, 
		.title, .card-title, .info-title, .footer-brand, .footer-big h4, .footer-big h5, .media .media-heading, 
		.carousel h1.hestia-title, .carousel h2.title, 
		.carousel span.sub-title, .woocommerce.single-product h1.product_title, .woocommerce section.related.products h2, .hestia-about h1, .hestia-about h2, .hestia-about h3, .hestia-about h4, .hestia-about h5 {
			font-family: ' . $hestia_headings_font . ';
		}';
			if ( class_exists( 'WooCommerce' ) ) {
				$custom_css .=
					'.woocommerce.single-product .product_title, .woocommerce .related.products h2, .woocommerce span.comment-reply-title {
				font-family: ' . $hestia_headings_font . ';
			}';
			}
		}

		/**
		 * Body font family.
		 */
		$default          = apply_filters( 'hestia_body_font_default', false );
		$hestia_body_font = get_theme_mod( 'hestia_body_font', $default );
		if ( ! empty( $hestia_body_font ) ) {
			hestia_enqueue_google_font( $hestia_body_font );
			$custom_css .= '
		body, ul, .tooltip-inner {
			font-family: ' . $hestia_body_font . ';
		}';

			if ( class_exists( 'WooCommerce' ) ) {
				$custom_css .= '
		.products .shop-item .added_to_cart,
		.woocommerce-checkout #payment input[type=submit], .woocommerce-checkout input[type=submit],
		.woocommerce-cart table.shop_table td.actions input[type=submit],
		.woocommerce .cart-collaterals .cart_totals .checkout-button, .woocommerce button.button,
		.woocommerce div[id^=woocommerce_widget_cart].widget .buttons .button, .woocommerce div.product form.cart .button,
		.woocommerce #review_form #respond .form-submit , .added_to_cart.wc-forward, .woocommerce div#respond input#submit,
		.woocommerce a.button {
			font-family: ' . $hestia_body_font . ';
		}';
			}
		}

		wp_add_inline_style( 'hestia_style', $custom_css );
	}

	add_action( 'wp_enqueue_scripts', 'hestia_fonts_inline_style' );
}

if ( ! function_exists( 'hestia_typography_inline_style' ) ) {
	/**
	 * Add inline style for font sizes.
	 *
	 * @since 1.1.48
	 */
	function hestia_typography_inline_style() {

		$custom_css = '';

		/**
		 * Title control [Posts & Pages]
		 */
		$custom_css .= hestia_get_inline_style( 'hestia_header_titles_fs', 'hestia_get_header_titles_style' );

		/**
		 * Headings control [Posts & Pages]
		 */
		$custom_css .= hestia_get_inline_style( 'hestia_post_page_headings_fs', 'hestia_get_post_page_headings_style' );

		/**
		 * Content control [Posts & Pages]
		 */
		$custom_css .= hestia_get_inline_style( 'hestia_post_page_content_fs', 'hestia_get_post_page_content_style' );

		/**
		 * Titles control [Blog, Frontpage & WooCommerce]
		 */
		$custom_css .= hestia_get_inline_style( 'hestia_section_primary_headings_fs', 'hestia_get_fp_and_woo_titles_style' );

		/**
		 * Subitles control [Blog, Frontpage & WooCommerce]
		 */
		$custom_css .= hestia_get_inline_style( 'hestia_section_secondary_headings_fs', 'hestia_get_fp_and_woo_subtitles_style' );

		/**
		 * Content control [Blog, Frontpage & WooCommerce]
		 */
		$custom_css .= hestia_get_inline_style( 'hestia_section_content_fs', 'hestia_get_fp_and_woo_content_style' );

		wp_add_inline_style( 'hestia_style', $custom_css );
	}

	add_action( 'wp_enqueue_scripts', 'hestia_typography_inline_style' );
}



/**
 * This function checks if the value stored in the customizer control named '$control_name' is a json object.
 * If the value is json it means that the customizer range control stores a value for every device ( mobile, tablet,
 * desktop). In this case, for each of those devices it calls '$function_name' that with the following parameters:
 * the device and the value for the control on that device.
 * '$function_name' returns css code that will be added to inline style.
 * If the value is not json then it's int and the '$function_name' function will be called just once for all three
 * devices.
 *
 * @param string $control_name Control name.
 * @param string $function_name Function to be called.
 *
 * @since 1.1.38
 * @return string
 */
function hestia_get_inline_style( $control_name, $function_name ) {
	$control_value = get_theme_mod( $control_name );
	if ( empty( $control_value ) ) {
		return '';
	}
	$custom_css = '';
	if ( hestia_is_json( $control_value ) ) {
		$control_value = json_decode( $control_value, true );
		if ( ! empty( $control_value ) ) {

			foreach ( $control_value as $key => $value ) {
				$custom_css .= call_user_func( $function_name, $value, $key );
			}
		}
	} else {
		$custom_css .= call_user_func( $function_name, $control_value );
	}

	return $custom_css;
}

/**
 * [Posts & Pages] Headings.
 * This function is called by hestia_get_inline_style to change the font size for:
 * headings ( h1 - h6 ) on pages and single post pages
 *
 * @param string $value Font value.
 */
function hestia_get_post_page_headings_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	if ( empty( $value ) ) {
		return $custom_css;
	}
	switch ( $dimension ) {
		case 'desktop':
			$v1 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			$v2 = ( 37 + (int) $value ) > 0 ? ( 37 + (int) $value ) : 0;
			$v3 = ( 32 + (int) $value ) > 0 ? ( 32 + (int) $value ) : 0;
			$v4 = ( 27 + (int) $value ) > 0 ? ( 27 + (int) $value ) : 0;
			$v5 = ( 23 + (int) $value ) > 0 ? ( 23 + (int) $value ) : 0;
			$v6 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			break;
		case 'tablet':
		case 'mobile':
			$v1 = ( 36 + (int) $value ) > 0 ? ( 36 + (int) $value ) : 0;
			$v2 = ( 32 + (int) $value ) > 0 ? ( 32 + (int) $value ) : 0;
			$v3 = ( 28 + (int) $value ) > 0 ? ( 28 + (int) $value ) : 0;
			$v4 = ( 24 + (int) $value ) > 0 ? ( 24 + (int) $value ) : 0;
			$v5 = ( 21 + (int) $value ) > 0 ? ( 21 + (int) $value ) : 0;
			$v6 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			break;
	}

	$custom_css .= '
	.single-post-wrap article h1,
	.page-content-wrap h1,
	.page-template-template-fullwidth article h1 {
		font-size: ' . $v1 . 'px;
	}
	.single-post-wrap article h2,
	.page-content-wrap h2,
	.page-template-template-fullwidth article h2 {
		font-size: ' . $v2 . 'px;
	}
	.single-post-wrap article h3,
	.page-content-wrap h3,
	.page-template-template-fullwidth article h3 {
		font-size: ' . $v3 . 'px;
	}
	.single-post-wrap article h4,
	.page-content-wrap h4,
	.page-template-template-fullwidth article h4 {
		font-size: ' . $v4 . 'px;
	}
	.single-post-wrap article h5,
	.page-content-wrap h5,
	.page-template-template-fullwidth article h5 {
		font-size: ' . $v5 . 'px;
	}
	.single-post-wrap article h6,
	.page-content-wrap h6,
	.page-template-template-fullwidth article h6 {
		font-size: ' . $v6 . 'px;
	}';

	if ( function_exists( 'hestia_add_media_query' ) ) {
		$custom_css = hestia_add_media_query( $dimension, $custom_css );
	}

	return $custom_css;
}


/**
 * [Posts & Pages] Content.
 * This function is called by hestia_get_inline_style to change the font size for:
 * content ( p ) on pages
 * single post pages
 *
 * @param string $value Font value.
 */
function hestia_get_post_page_content_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	if ( empty( $value ) ) {
		return $custom_css;
	}
	switch ( $dimension ) {
		case 'desktop':
			$v1 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			break;
		case 'tablet':
		case 'mobile':
			$v1 = ( 16 + (int) $value ) > 0 ? ( 16 + (int) $value ) : 0;
			break;
	}
	$custom_css .= '.single-post-wrap article p, .page-content-wrap p, .single-post-wrap article ul, .page-content-wrap ul, .single-post-wrap article ol, .page-content-wrap ol, .single-post-wrap article dl, .page-content-wrap dl, .single-post-wrap article table, .page-content-wrap table, .page-template-template-fullwidth article p {
		font-size: ' . $v1 . 'px;
	}';

	if ( function_exists( 'hestia_add_media_query' ) ) {
		$custom_css = hestia_add_media_query( $dimension, $custom_css );
	}

	return $custom_css;
}


/**
 * [Blog, Frontpage & WooCommerce] Titles font size.
 *
 * This function is called by hestia_get_inline_style to change the font size for:
 * all frontpage sections titles and small headings ( Feature box title, Shop box title, Team box title, Testimonial box title, Blog box title )
 * WooCommerce pages titles ( Single product page < + Related Products string and Leave a review string >, Cart and Checkout pages )
 * Posts titles on the blog page
 *
 * @param string $value Font value.
 */
function hestia_get_fp_and_woo_titles_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	switch ( $dimension ) {
		case 'desktop':
		case 'tablet':
		case 'mobile':
			$v1 = ( 37 + (int) $value ) > 0 ? ( 37 + (int) $value ) : 0;
			$v2 = ( 32 + (int) $value ) > 0 ? ( 32 + (int) $value ) : 0;
			$v3 = ( 27 + (int) $value ) > 0 ? ( 27 + (int) $value ) : 0;
			$v4 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			break;
	}
	$custom_css .= 'h2.hestia-title, h2.title {
		font-size: ' . $v1 . 'px;
	}
	.woocommerce div.product .product_title,
	.woocommerce .related.products h2 {
		font-size: ' . $v2 . 'px;
	}
	.subscribe-line h3.hestia-title,
	 #comments .hestia-title,
	.woocommerce .comment-reply-title,
	.woocommerce-cart .blog-post h1.hestia-title,
	.woocommerce-checkout .blog-post h1.hestia-title {
		font-size: ' . $v3 . 'px;
	}
	h4.card-title,
	.hestia-info h4.info-title,
	.card-blog .card-title,
	.footer .widget h5,
	section.contactus h4.hestia-title,
	 .blog-sidebar .widget h5{
		font-size: ' . $v4 . 'px;
	}';

	$custom_css = hestia_add_media_query( $dimension, $custom_css );

	return $custom_css;
}

/**
 * [Blog, Frontpage & WooCommerce] Subtitles font size.
 *
 * This function is called by hestia_get_inline_style to change the font size for:
 * all frontpage sections subtitles
 * WooCommerce pages subtitles ( Single product page price, Cart and Checkout pages subtitles )
 *
 * @param string $value Font value.
 */
function hestia_get_fp_and_woo_subtitles_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	switch ( $dimension ) {
		case 'desktop':
		case 'tablet':
		case 'mobile':
			$v1 = ( 23 + (int) $value ) > 0 ? ( 23 + (int) $value ) : 0;
			$v2 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			$v3 = ( 14 + (int) $value ) > 0 ? ( 14 + (int) $value ) : 0;
			break;
	}

	$custom_css .= '.hestia-work .card-title,
	.woocommerce .cart-collaterals h2,
	.woocommerce .cross-sells h2,
	.woocommerce.single-product .summary .price,
	.woocommerce-checkout .blog-post .section form.woocommerce-checkout h3:not(#ship-to-different-address) {
		font-size: ' . $v1 . 'px;
	}
	
	h5.description,
	h5.subscribe-description {
		font-size: ' . $v2 . 'px;
	}
	.subscribe-line .description {
		font-size: ' . $v3 . 'px;
	}';

	$custom_css = hestia_add_media_query( $dimension, $custom_css );

	return $custom_css;
}

/**
 * [Blog, Frontpage & WooCommerce] Content font size.
 *
 * This function is called by hestia_get_inline_style to change the font size for:
 * all frontpage sections box content
 * WooCommerce pages content ( Single product page description, Shop page product box content )
 * Posts content on the blog page
 *
 * @param string $value Font value.
 */
function hestia_get_fp_and_woo_content_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	switch ( $dimension ) {
		case 'desktop':
		case 'tablet':
		case 'mobile':
			$v1 = ( 16 + (int) $value ) > 0 ? ( 16 + (int) $value ) : 0;
			$v2 = ( 14 + (int) $value ) > 0 ? ( 14 + (int) $value ) : 0;
			$v3 = ( 12 + (int) $value ) > 0 ? ( 12 + (int) $value ) : 0;
			break;
	}

	$custom_css .= '.hestia-features .hestia-info p {
		font-size: ' . $v1 . 'px;
	}
	.woocommerce .product .card-product .card-description p, .card-description, section.pricing p.text-gray, .woocommerce.single-product .woocommerce-product-details__short-description, address {
		font-size: ' . $v2 . 'px;
	}
	h6.category {
		font-size: ' . $v3 . 'px;
	}';

	/**
	 * Note: The following style is added just that the migration from old controls to new ones doesn't break things badly
	 * TODO: Verify those again when the controls will be added back
	 */
	$custom_css .= '.widget ul li {
		font-size: ' . $v2 . 'px;
	}';

	$custom_css = hestia_add_media_query( $dimension, $custom_css );

	return $custom_css;
}

/**
 * [Posts and Pages] Title font size.
 *
 * This function is called by hestia_get_inline_style to change the font size for:
 * pages/posts titles
 * Slider/Big title title/subtitle
 *
 * @param string $value Font value.
 */
function hestia_get_header_titles_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	switch ( $dimension ) {
		case 'desktop':
			$v1 = ( 67 + (int) $value ) > 0 ? ( 67 + (int) $value ) : 0;
			$v2 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			$v3 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			break;
		case 'tablet':
		case 'mobile':
			$v1 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			$v2 = ( 18 + (int) $value ) > 0 ? ( 18 + (int) $value ) : 0;
			$v3 = ( 42 + (int) $value ) > 0 ? ( 42 + (int) $value ) : 0;
			break;
	}
	$custom_css .= '
	.page-header.header-small .hestia-title,
	.page-header.header-small .title {
		font-size: ' . $v3 . 'px;
	}';

	$custom_css = hestia_add_media_query( $dimension, $custom_css );

	return $custom_css;
}

/**
 * Check if a string is in json format
 *
 * @param  string $string Input.
 *
 * @since 1.1.38
 * @return bool
 */
function hestia_is_json( $string ) {
	return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}

/**
 * Function to import font sizes from old controls to new ones.
 *
 * @since 1.1.58
 */
function hestia_sync_new_fs() {
	$execute = get_option( 'hestia_sync_font_sizes' );
	if ( $execute !== false ) {
		return;
	}
	$headings_fs_old = get_theme_mod( 'hestia_headings_font_size' );
	$body_fs_old     = get_theme_mod( 'hestia_body_font_size' );
	if ( empty( $body_fs_old ) && empty( $headings_fs_old ) ) {
		return;
	}

	if ( ! empty( $headings_fs_old ) ) {
		$decoded = json_decode( $headings_fs_old );
		if ( ! hestia_is_json( $headings_fs_old ) ) {
			$tmp_array = array(
				'desktop' => floor( $decoded - 37 ) > 25 ? 25 : ( floor( $decoded - 37 ) < - 25 ? - 25 : floor( $decoded - 37 ) ),
				'mobile'  => 0,
				'tablet'  => 0,
			);
			$decoded   = json_encode( $tmp_array );
		} else {
			$decoded->desktop = floor( $decoded->desktop - 37 ) > 25 ? 25 : ( floor( $decoded->desktop - 37 ) < - 25 ? - 25 : floor( $decoded->desktop - 37 ) );
			$decoded->tablet  = floor( $decoded->tablet - 37 ) > 25 ? 25 : ( floor( $decoded->tablet - 37 ) < - 25 ? - 25 : floor( $decoded->tablet - 37 ) );
			$decoded->mobile  = floor( $decoded->mobile - 37 ) > 25 ? 25 : ( floor( $decoded->mobile - 37 ) < - 25 ? - 25 : floor( $decoded->mobile - 37 ) );
			$decoded          = json_encode( $decoded );
		}

		set_theme_mod( 'hestia_section_primary_headings_fs', $decoded );
		set_theme_mod( 'hestia_section_secondary_headings_fs', $decoded );
		set_theme_mod( 'hestia_header_titles_fs', $decoded );
		set_theme_mod( 'hestia_post_page_headings_fs', $decoded );
	}

	if ( ! empty( $body_fs_old ) ) {
		$decoded = json_decode( $body_fs_old );
		if ( ! hestia_is_json( $body_fs_old ) ) {
			$tmp_array = array(
				'desktop' => floor( $decoded - 12 ) > 25 ? 25 : ( floor( $decoded - 12 ) < - 25 ? - 25 : floor( $decoded - 12 ) ),
				'mobile'  => 0,
				'tablet'  => 0,
			);
			$decoded   = json_encode( $tmp_array );
		} else {
			$decoded->desktop = floor( $decoded->desktop - 12 ) > 25 ? 25 : ( floor( $decoded->desktop - 12 ) < - 25 ? - 25 : floor( $decoded->desktop - 12 ) );
			$decoded->tablet  = floor( $decoded->tablet - 12 ) > 25 ? 25 : ( floor( $decoded->tablet - 12 ) < - 25 ? - 25 : floor( $decoded->tablet - 12 ) );
			$decoded->mobile  = floor( $decoded->mobile - 12 ) > 25 ? 25 : ( floor( $decoded->mobile - 12 ) < - 25 ? - 25 : floor( $decoded->mobile - 12 ) );
			$decoded          = json_encode( $decoded );
		}
		set_theme_mod( 'hestia_section_content_fs', $decoded );
		set_theme_mod( 'hestia_post_page_content_fs', $decoded );
	}
	update_option( 'hestia_sync_font_sizes', true );

}

add_action( 'after_setup_theme', 'hestia_sync_new_fs' );


/**
 * This function is called by each function that adds css if the control have media queries enabled.
 *
 * @param string $dimension Query dimension.
 * @param string $custom_css Css.
 *
 * @return string
 */
function hestia_add_media_query( $dimension, $custom_css ) {
	switch ( $dimension ) {
		case 'tablet':
			$custom_css = '@media (max-width: 768px){' . $custom_css . '}';
			break;
		case 'mobile':
			$custom_css = '@media (max-width: 480px){' . $custom_css . '}';
			break;
	}

	return $custom_css;
}
