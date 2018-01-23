<?php
/**
 * Admin theme page
 *
 * @package Anima
 */

// Framework
require_once( get_template_directory() . "/cryout/framework.php" );

// Theme particulars
require_once( get_template_directory() . "/admin/defaults.php" );
require_once( get_template_directory() . "/admin/options.php" );
require_once( get_template_directory() . "/admin/demo.php" );
require_once( get_template_directory() . "/includes/tgmpa.php" );

// Custom CSS Styles for customizer
require_once( get_template_directory() . "/includes/custom-styles.php" );

// Get the theme options and make sure defaults are used if no values are set
if ( ! function_exists( 'anima_get_theme_options' ) ):
function anima_get_theme_options() {
	$optionsAnima = wp_parse_args(
		get_option( 'anima_settings', array() ),
		anima_get_option_defaults()
	);
	return apply_filters( 'anima_theme_options_array', $optionsAnima );
} // anima_get_theme_options()
endif;

if ( ! function_exists( 'anima_get_theme_structure' ) ):
function anima_get_theme_structure() {
	global $anima_big;
	return apply_filters( 'anima_theme_structure_array', $anima_big );
} // anima_get_theme_structure()
endif;

// load up theme options
$cryout_theme_settings = apply_filters( 'anima_theme_structure_array', $anima_big );
$cryout_theme_options = anima_get_theme_options();
$cryout_theme_defaults = anima_get_option_defaults();

// Hooks/Filters
add_action( 'admin_menu', 'anima_add_page_fn' );

// Add admin scripts
function anima_admin_scripts( $hook ) {
	global $anima_page;
	if( $anima_page != $hook ) {
        return;
    }

	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	wp_enqueue_style( 'anima-admin-style', get_template_directory_uri() . '/admin/css/admin.css', NULL, _CRYOUT_THEME_VERSION );
	wp_enqueue_script( 'anima-admin-js',get_template_directory_uri() . '/admin/js/admin.js', array('jquery-ui-dialog'), _CRYOUT_THEME_VERSION );
	$js_admin_options = array(
		'reset_confirmation' => esc_html( __( 'Reset Anima Settings to Defaults?', 'anima' ) ),
	);
	wp_localize_script( 'anima-admin-js', 'anima_admin_settings', $js_admin_options );
	}

// Create admin subpages
function anima_add_page_fn() {
	global $anima_page;
	$anima_page = add_theme_page( __( 'Anima Theme', 'anima' ), __( 'Anima Theme', 'anima' ), 'edit_theme_options', 'about-anima-theme', 'anima_page_fn' );
	add_action( 'admin_enqueue_scripts', 'anima_admin_scripts' );
} // anima_add_page_fn()

// Display the admin options page

function anima_page_fn() {

	$options = cryout_get_option();

	if (!current_user_can('edit_theme_options'))  {
		wp_die( __( 'Sorry, but you do not have sufficient permissions to access this page.', 'anima') );
	}

?>

<div class="wrap" id="main-page"><!-- Admin wrap page -->
	<div id="lefty">
	<?php if( isset($_GET['settings-loaded']) ) { ?>
		<div class="updated fade">
			<p><?php _e('Anima settings loaded successfully.', 'anima') ?></p>
		</div> <?php
	} ?>
	<?php
	// Reset settings to defaults if the reset button has been pressed
	if ( isset( $_POST['anima_reset_defaults'] ) ) {
		delete_option( 'anima_settings' ); ?>
		<div class="updated fade">
			<p><?php _e('Anima settings have been reset successfully.', 'anima') ?></p>
		</div> <?php
	} ?>

		<div id="admin_header">
			<img src="<?php echo get_template_directory_uri() . '/admin/images/logo-about-top.png' ?>" />
			<span class="version">
				<?php _e( 'Anima Theme', 'anima' ) ?> v<?php echo _CRYOUT_THEME_VERSION; ?> by
				<a href="https://www.cryoutcreations.eu" target="_blank">Cryout Creations</a><br>
				<?php do_action( 'cryout_admin_version' ); ?>
			</span>
		</div>

		<div id="admin_links">
			<a href="https://www.cryoutcreations.eu/wordpress-themes/anima" target="_blank"><?php _e( 'Read the Docs', 'anima' ) ?></a>
			<a href="https://www.cryoutcreations.eu/forums/f/wordpress/anima" target="_blank"><?php _e( 'Browse the Forum', 'anima' ) ?></a>
			<a href="https://www.cryoutcreations.eu/priority-support" target="_blank"><?php _e( 'Priority Support', 'anima' ) ?></a>
		</div>


		<br>
		<div id="description">
			<?php
				$theme = wp_get_theme();
			 	echo esc_html( $theme->get( 'Description' ) );
			?>
		</div>
		<br><br>

		<a class="button" href="customize.php" id="customizer"> <?php printf( __( 'Customize %s', 'anima' ), ucwords(_CRYOUT_THEME_NAME) ); ?> </a>

		<div id="anima-export" >
			<div>

			<h3 class="hndle"><?php _e( 'Manage Theme Settings', 'anima' ); ?></h3>

				<form action="" method="post" class="third">
					<input type="hidden" name="anima_reset_defaults" value="true" />
					<input type="submit" class="button" id="anima_reset_defaults" value="<?php _e( 'Reset to Defaults', 'anima' ); ?>" />
				</form>
			</div>
		</div><!-- export -->

	</div><!--lefty -->


	<div id="righty" >
		<div id="anima-donate" class="postbox donate">

			<div class="inside">
				<p>Anima wouldn't normally be available to a mere mortal's WordPress installation. But we risked everything and climbed that freakishly long beanstalk and managed to steal the theme from under the noses of the godlike giants above the clouds.</p>
				<p>The giants were using it for themselves and, being completely aware of the theme's quality, didn't want to share. We spent some time hiding from them and at a certain point we were even imprisoned but easily managed to escape since their huge prisons weren't equipped for such small creatures like us.</p>
				<p>However, time passed a lot faster in their world, and upon returning to ours we realized we were quite old. We're now constantly trembling, we forget even the simplest of tasks and take naps every 3 hours. But we'd really like to tell our grandchildren of the great adventures we had above the clouds, if only we could stay awake long enough to do so.</p>
				<p>So, do you want the new generations to hear our stories?</p>


				<div style="display:block;float:none;margin:0 auto;text-align:center;">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_donations">
						<input type="hidden" name="business" value="KYL26KAN4PJC8">
						<input type="hidden" name="item_name" value="Cryout Creations - Anima Theme">
						<input type="hidden" name="currency_code" value="EUR">
						<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHosted">
						<input type="image" src="<?php echo get_template_directory_uri() . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>

			</div><!-- inside -->

		</div><!-- donate -->

		<div id="anima-news" class="postbox news" >
			<h3 class="hndle"><?php _e( 'Theme Updates', 'anima' ); ?></h3>
			<div class="panel-wrap inside">
			</div><!-- inside -->
		</div><!-- news -->

	</div><!--  righty -->
</div><!--  wrap -->

<?php
} // anima_page_fn()
