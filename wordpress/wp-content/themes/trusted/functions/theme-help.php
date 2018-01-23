<?php
/**
 * Theme help
 *
 * Adds a simple Theme help page to the Appearance section of the WordPress Dashboard.
 *
 * @package Trusted
 */

// Add Theme help page to admin menu.
add_action( 'admin_menu', 'trusted_add_theme_help_page' );

function trusted_add_theme_help_page() {

	// Get Theme Details from style.css
	$theme = wp_get_theme();

	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'trusted' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), esc_html__( 'Theme Help', 'trusted' ), 'edit_theme_options', 'trusted', 'trusted_display_theme_help_page'
	);
}

// Display Theme help page.
function trusted_display_theme_help_page() {

	// Get Theme Details from style.css.
	$theme = wp_get_theme();
	?>

	<div class="wrap theme-help-wrap">

		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'trusted' ), esc_html( $theme->get( 'Name' ) ), esc_html( $theme->get( 'Version' ) ) ); ?></h1>

		<div class="theme-description"><?php echo esc_html( $theme->get( 'Description' ) ); ?></div>

		<hr>
		<div class="important-links clearfix">
			<p><strong><?php esc_html_e( 'Theme Links', 'trusted' ); ?>:</strong>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/theme/trusted/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'trusted' ); ?></a>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/demo/?demo=trusted' ); ?>" target="_blank"><?php esc_html_e( 'Theme Demo', 'trusted' ); ?></a>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/docs/trusted-theme/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'trusted' ); ?></a>
				<a href="<?php echo esc_url( 'http://uxlthemes.com/forums/forum/trusted/' ); ?>" target="_blank"><?php esc_html_e( 'Theme Support', 'trusted' ); ?></a>
				<a href="<?php echo esc_url( 'http://wordpress.org/support/theme/trusted/reviews/?filter=5' ); ?>" target="_blank"><?php esc_html_e( 'Rate this theme', 'trusted' ); ?></a>
			</p>
		</div>
		<hr>

		<div id="getting-started">

			<h3><?php printf( esc_html__( 'Getting Started with %s', 'trusted' ), esc_html( $theme->get( 'Name' ) ) ); ?></h3>

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Theme Documentation', 'trusted' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Do you need help to setup, configure and configure this theme? Check out the extensive theme documentation on our website.', 'trusted' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'http://uxlthemes.com/docs/trusted-theme/' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'View %s Documentation', 'trusted' ), 'Trusted' ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Theme Options', 'trusted' ); ?></h4>

						<p class="about">
							<?php printf( esc_html__( '%s makes use of the Customizer for the theme settings.', 'trusted' ), esc_html( $theme->get( 'Name' ) ) ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( wp_customize_url() ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Theme', 'trusted' ); ?>
							</a>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Upgrade', 'trusted' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Upgrade to Trusted Pro for even more cool features and customization options.', 'trusted' ) ; ?>
						</p>
						<p>
							<a href="<?php echo esc_url( 'https://uxlthemes.com/theme/trusted-pro/' ); ?>" target="_blank" class="button button-pro">
								<?php esc_html_e( 'GO PRO', 'trusted' ); ?>
							</a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" />

				</div>

			</div>

		</div>

		<hr>

		<div id="theme-author">

			<p>
				<?php printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'trusted' ), esc_html( $theme->get( 'Name' ) ), '<a target="_blank" href="http://uxlthemes.com/" title="uXL Themes">uXL Themes</a>', '<a target="_blank" href="http://wordpress.org/support/theme/trusted/reviews/?filter=5" title="' . esc_html__( 'Trusted Review', 'trusted' ) . '">' . esc_html__( 'rate it', 'trusted' ) . '</a>' ); ?>
			</p>

		</div>

	</div>

	<?php
}

// Add CSS for Theme help Panel.
add_action( 'admin_enqueue_scripts', 'trusted_theme_help_page_css' );

function trusted_theme_help_page_css( $hook ) {

	// Load styles and scripts only on theme help page.
	if ( 'appearance_page_trusted' != $hook ) {
		return;
	}

	// Embed theme help css style.
	wp_enqueue_style( 'trusted-theme-help-css', get_template_directory_uri() . '/css/theme-help.css' );
}
