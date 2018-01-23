<?php
/**
 * The theme header.
 *
 * @package Trusted
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
		<?php
		$header_light = get_theme_mod( 'header_light', 'dark' );
		if ( $header_light == 'light' ) {
			$main_header_class = ' light';
		} else {
			$main_header_class = '';
		}
		?>
	<header id="masthead" class="site-header<?php echo $main_header_class; ?>">

		<?php if(is_active_sidebar( 'trusted-top-bar' )): ?>
		<div id="top-bar">
			<div class="container">
				<?php 
					dynamic_sidebar( 'trusted-top-bar' );
				?>
			</div>
		</div>
		<?php endif; ?>

		<div class="container clearfix">

			<div id="site-branding">
				<?php if ( get_theme_mod( 'custom_logo' ) ) {
						the_custom_logo();
					} else { ?>
					<?php if ( is_front_page() ) { ?>
						<h1 class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } else { ?>
						<p class="site-title"><a class="<?php echo esc_attr( get_theme_mod( 'site_title_style' ) );?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php } 
					} ?>
			</div><!-- #site-branding -->

			<!--<div id="top-info">-->
				<?php trusted_tel_login_cart(); ?>
			<!--</div>-->

	        <a href="#x" class="trusted-overlay" id="search"></a>
	        <div class="trusted-modal">
	            <div class="close-this"><a class="fa fa-close" href="#close"></a></div>
				<?php if ( class_exists( 'WooCommerce' ) ) {
					trusted_woocommerce_search_form();
				} else {
					get_search_form();
				}
				?>
	        </div>

			<?php if ( get_theme_mod( 'menu_center' ) ) {
				?>
		</div>

			<div class="site-navigation centered" role="navigation">
				<div class="container">
				<a class="toggle-nav" href="javascript:void(0);"><span></span></a>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'clearfix',
						'fallback_cb'    => 'trusted_primary_menu_fallback',
					)
				); ?>
				</div>
			</div>

			<?php } else {
				?>
			<div class="site-navigation" role="navigation">
				<a class="toggle-nav" href="javascript:void(0);"><span></span></a>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'clearfix',
						'fallback_cb'    => 'trusted_primary_menu_fallback',
					)
				); ?>
			</div>
		</div>
			<?php
				} ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content clearfix">

<?php
if ( ! is_page_template( 'template-blank-canvas.php' ) ) {
	trusted_header_title();
}
?>