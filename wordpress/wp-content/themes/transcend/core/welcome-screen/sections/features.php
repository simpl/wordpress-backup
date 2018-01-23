<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Features
 */

$features = array(
	'slider-options' => array(
		'label'   	=> __( 'Slider options', 'transcend' ),
		'cpo'     	=> '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro'	=> '<span class="dashicons dashicons-yes"></span></i>'
	),
	'woocommerce' => array(
		'label'  	=> __( 'WooCommerce Integration', 'transcend' ),
		'cpo'     	=> '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' 	=> '<span class="dashicons dashicons-yes"></span></i>'
	),
	'reorder-sections' => array(
		'label'       => __( 'Reorder Homepage Sections', 'transcend' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'custom-colors'    => array(
		'label'       => __( 'Custom Colors', 'transcend' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'typography'       => array(
		'label'       => __( 'Custom Typography', 'transcend' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'tagline' => array(
		'label'   	=> __( 'Tagline', 'transcend' ),
		'cpo'    	=> __( 'Minimal', 'transcend' ),
		'cpo-pro' 	=> __( 'Improved', 'transcend' )
	),
	'dedicated-support' => array(
		'label'       => __( 'Dedicated Support Team', 'transcend' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'security-updates' => array(
		'label'       => __( 'Security updates & feature releases', 'transcend' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
);
?>
<div class="featured-section features">
    <table class="free-pro-table">
        <thead>
        <tr>
            <th></th>
            <th><?php _e( 'Lite', 'transcend' ) ?></th>
            <th><?php _e( 'PRO', 'transcend' ) ?></th>
        </tr>
        </thead>
        <tbody>
		<?php foreach ( $features as $feature ): ?>
            <tr>
                <td class="feature">
                    <h3>
						<?php echo $feature['label']; ?>
                    </h3>
                </td>
                <td class="cpo-feature">
					<?php echo $feature['cpo']; ?>
                </td>
                <td class="cpo-pro-feature">
					<?php echo $feature['cpo-pro']; ?>
                </td>
            </tr>
		<?php endforeach; ?>
        <tr>
            <td></td>
            <td colspan="2" class="text-right"><a href="//www.cpothemes.com/theme/transcend?utm_source=upsell&utm_medium=theme&utm_campaign=upsell" target="_blank"
                               class="button button-primary button-hero"><span class="dashicons dashicons-cart"></span><?php _e( 'Get Transcend Pro!', 'transcend' ) ?></a></td>
        </tr>
        </tbody>
    </table>
</div>