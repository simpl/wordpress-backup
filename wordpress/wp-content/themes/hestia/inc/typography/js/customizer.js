/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package hestia
 * @since 1.1.38
 */

/* global wp*/
/* global hestiaGetCss */


/**
 * Live refresh for font size for:
 * pages/posts titles
 * Slider/Big title title/subtitle
 */
wp.customize(
	'hestia_header_titles_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'hestia-header-titles-fs'
				};

				var arraySizes = {
					size3: { selectors: '.page-header.header-small .hestia-title, .page-header.header-small .title', values: [42,42,42] }
				};
                hestiaGetCss( arraySizes, settings, to );
			}
		);
	}
);

/**
 * Live refresh for font size for:
 * all frontpage sections titles and small headings ( Feature box title, Shop box title, Team box title, Testimonial box title, Blog box title )
 * WooCommerce pages titles ( Single product page < + Related Products string and Leave a review string >, Cart and Checkout pages )
 * Posts titles on the blog page
 */
wp.customize(
	'hestia_section_primary_headings_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'hestia-section-primary-headings-fs'
				};

				var arraySizes = {
					size1: { selectors: 'h2.hestia-title,h2.title', values: [37,37,37] },
					size2: { selectors: '.woocommerce div.product .product_title, .woocommerce .related.products h2', values: [32,32,32] },
					size3: { selectors: '.subscribe-line h3.hestia-title, #comments .hestia-title, .woocommerce .comment-reply-title, .woocommerce-cart .blog-post h1.hestia-title, .woocommerce-checkout .blog-post h1.hestia-title', values: [27,27,27] },
					size4: { selectors: 'h4.card-title,.hestia-info h4.info-title,.card-blog .card-title,.footer .widget h5, section.contactus h4.hestia-title,.blog-sidebar .widget h5', values: [18,18,18] },
				};

                hestiaGetCss( arraySizes, settings, to );
			}
		);
	}
);

/**
 * Live refresh for font size for:
 * all frontpage sections subtitles
 * WooCommerce pages subtitles ( Single product page price, Cart and Checkout pages subtitles )
 */
wp.customize(
	'hestia_section_secondary_headings_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'hestia-section-secondary-headings-fs'
				};

				var arraySizes = {
					size1: { selectors: '.hestia-work .card-title, .woocommerce .cart-collaterals h2, .woocommerce .cross-sells h2, .woocommerce.single-product .summary .price, .woocommerce-checkout .blog-post .section form.woocommerce-checkout h3:not(#ship-to-different-address)', values: [23,23,23] },
					size2: { selectors: ' h5.description, h5.subscribe-description', values: [18,18,18] },
					size3: { selectors: '.subscribe-line .description', values: [14,14,14] }
				};

                hestiaGetCss( arraySizes, settings, to );
			}
		);
	}
);

/**
 * Live refresh for font size for:
 * all frontpage sections box content
 * WooCommerce pages content ( Single product page description, Shop page product box content )
 * Posts content on the blog page
 */
wp.customize(
	'hestia_section_content_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'hestia-section-content-fs'
				};

				var arraySizes = {
					size1: { selectors: 'h6.category', values: [12,12,12] },
					size2: { selectors: '.woocommerce .product .card-product .card-description p, .card-description, section.pricing p.text-gray, .woocommerce.single-product .woocommerce-product-details__short-description', values: [14,14,14] },
                    size3: { selectors: '.hestia-features .hestia-info p', values: [16,16,16] }
				};

                hestiaGetCss( arraySizes, settings, to );
			}
		);
	}
);

/**
 * Live refresh for font size for:
 * Primary menu
 * Footer menu
 */
wp.customize(
	'hestia_menu_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'hestia-menu-fs'
				};

				var arraySizes = {
					size1: { selectors: '.navbar #main-navigation a, .footer .footer-menu li a', values: [12,12,12] }
				};

                hestiaGetCss( arraySizes, settings, to );
			}
		);
	}
);

/**
 * Live refresh for font size for:
 * headings ( h1 - h6 ) on pages and single post pages
 */
wp.customize(
	'hestia_post_page_headings_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'hestia-post-page-headings-fs'
				};

				var arraySizes = {
					size1: { selectors: '.single-post-wrap article h1, .page-content-wrap h1, .page-template-template-fullwidth article h1', values: [42,36,36] },
					size2: { selectors: '.single-post-wrap article h2, .page-content-wrap h2, .page-template-template-fullwidth article h2', values: [37,32,32] },
					size3: { selectors: '.single-post-wrap article h3, .page-content-wrap h3, .page-template-template-fullwidth article h3', values: [32,28,28] },
					size4: { selectors: '.single-post-wrap article h4, .page-content-wrap h4, .page-template-template-fullwidth article h4', values: [27,24,24] },
					size5: { selectors: '.single-post-wrap article h5, .page-content-wrap h5, .page-template-template-fullwidth article h5', values: [23,21,21] },
					size6: { selectors: '.single-post-wrap article h6, .page-content-wrap h6, .page-template-template-fullwidth article h6', values: [18,18,18] }
				};

                hestiaGetCss( arraySizes, settings, to );
			}
		);
	}
);

/**
 * Live refresh for font size for:
 * content ( p ) on pages
 * single post pages
 */
wp.customize(
	'hestia_post_page_content_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'hestia-post-page-content-fs'
				};

				var arraySizes = {
					size1: { selectors: '.single-post-wrap article p, .page-content-wrap p, .single-post-wrap article ul, .page-content-wrap ul, .single-post-wrap article ol, .page-content-wrap ol, .single-post-wrap article dl, .page-content-wrap dl, .single-post-wrap article table, .page-content-wrap table, .page-template-template-fullwidth article p, .page-template-template-fullwidth article ol, .page-template-template-fullwidth article ul, .page-template-template-fullwidth article dl, .page-template-template-fullwidth article table', values: [18,18,18] },
				};

                hestiaGetCss( arraySizes, settings, to );
			}
		);
	}
);
