<?php
/**
 * Actions required
 */
wp_enqueue_style( 'plugin-install' );
wp_enqueue_script( 'plugin-install' );
wp_enqueue_script( 'updates' );
?>

<div class="feature-section action-required demo-import-boxed" id="plugin-filter">

	<?php
	global $transcend_required_actions, $transcend_recommended_plugins;
	if ( ! empty( $transcend_required_actions ) ):
		/* transcend_show_required_actions is an array of true/false for each required action that was dismissed */
		$nr_actions_required = 0;
		$nr_action_dismissed = 0;
		$transcend_show_required_actions = get_option( "transcend_show_required_actions" );
		foreach ( $transcend_required_actions as $transcend_required_action_key => $transcend_required_action_value ):
			$hidden = false;
			if ( @$transcend_show_required_actions[ $transcend_required_action_value['id'] ] === false ) {
				$hidden = true;
			}
			if ( @$transcend_required_action_value['check'] ) {
				continue;
			}
			$nr_actions_required ++;
			if ( $hidden ) {
				$nr_action_dismissed ++;
			}
			
			?>
			<div class="transcend-action-required-box">
				<?php if ( ! $hidden ): ?>
					<span data-action="dismiss" class="dashicons dashicons-visibility transcend-required-action-button"
					      id="<?php echo esc_attr( $transcend_required_action_value['id'] ); ?>"></span>
				<?php else: ?>
					<span data-action="add" class="dashicons dashicons-hidden transcend-required-action-button"
					      id="<?php echo esc_attr( $transcend_required_action_value['id'] ); ?>"></span>
				<?php endif; ?>
				<h3><?php if ( ! empty( $transcend_required_action_value['title'] ) ): echo $transcend_required_action_value['title']; endif; ?></h3>
				<p>
					<?php if ( ! empty( $transcend_required_action_value['description'] ) ): echo $transcend_required_action_value['description']; endif; ?>
					<?php if ( ! empty( $transcend_required_action_value['help'] ) ): echo '<br/>' . $transcend_required_action_value['help']; endif; ?>
				</p>
				<?php
				if ( ! empty( $transcend_required_action_value['plugin_slug'] ) ) {
					$active = $this->check_active( $transcend_required_action_value['plugin_slug'] );
					$url    = $this->create_action_link( $active['needs'], $transcend_required_action_value['plugin_slug'] );
					$label  = '';
					switch ( $active['needs'] ) {
						case 'install':
							$class = 'install-now button';
							$label = __( 'Install', 'transcend' );
							break;
						case 'activate':
							$class = 'activate-now button button-primary';
							$label = __( 'Activate', 'transcend' );
							break;
						case 'deactivate':
							$class = 'deactivate-now button';
							$label = __( 'Deactivate', 'transcend' );
							break;
					}
					?>
					<p class="plugin-card-<?php echo esc_attr( $transcend_required_action_value['plugin_slug'] ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
						<a data-slug="<?php echo esc_attr( $transcend_required_action_value['plugin_slug'] ) ?>"
						   class="<?php echo $class; ?>"
						   href="<?php echo esc_url( $url ) ?>"> <?php echo $label ?> </a>
					</p>
					<?php
				};
				?>
			</div>
			<?php
		endforeach;
	endif;
	$nr_recommended_plugins = 0;
	if ( $nr_actions_required == 0 || $nr_actions_required == $nr_action_dismissed ):

		$transcend_show_recommended_plugins = get_option( "transcend_show_recommended_plugins" );
		foreach ( $transcend_recommended_plugins as $slug => $plugin_opt ) {
			
			if ( !$plugin_opt['recommended'] ) {
				continue;
			}

			if ( Transcend_Notify_System::has_plugin( $slug ) ) {
				continue;
			}
			if ( $nr_recommended_plugins == 0 ) {
				echo '<h3 class="hooray">' . __( 'Hooray! There are no required actions for you right now. But you can make your theme more powerful with next actions: ', 'transcend' ) . '</h3>';
			}

			$nr_recommended_plugins ++;
			echo '<div class="transcend-action-required-box">';

			if ( isset($transcend_show_recommended_plugins[$slug]) && $transcend_show_recommended_plugins[$slug] ): ?>
				<span data-action="add" class="dashicons dashicons-hidden transcend-recommended-plugin-button"
				      id="<?php echo esc_attr( $slug ); ?>"></span>
			<?php else: ?>
				<span data-action="dismiss" class="dashicons dashicons-visibility transcend-recommended-plugin-button"
				      id="<?php echo esc_attr( $slug ); ?>"></span>
			<?php endif;

			$active = $this->check_active( $slug );
			$url    = $this->create_action_link( $active['needs'], $slug );
			$info   = $this->call_plugin_api( $slug );
			$label  = '';
			$class = '';
			switch ( $active['needs'] ) {
				case 'install':
					$class = 'install-now button';
					$label = __( 'Install', 'transcend' );
					break;
				case 'activate':
					$class = 'activate-now button button-primary';
					$label = __( 'Activate', 'transcend' );
					break;
				case 'deactivate':
					$class = 'deactivate-now button';
					$label = __( 'Deactivate', 'transcend' );
					break;
			}
			?>
			<h3><?php echo $label .': '.$info->name ?></h3>
			<p>
				<?php echo $info->short_description ?>
			</p>
			<p class="plugin-card-<?php echo esc_attr( $slug ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
				<a data-slug="<?php echo esc_attr( $slug ) ?>"
				   class="<?php echo $class; ?>"
				   href="<?php echo esc_url( $url ) ?>"> <?php echo $label ?> </a>
			</p>
			<?php

			echo '</div>';

		}

	endif;

	if ( $nr_recommended_plugins == 0 && $nr_actions_required == 0 ) {
		echo '<span class="hooray">' . __( 'Hooray! There are no required actions for you right now.', 'transcend' ) . '</span>';
	}

	?>

</div>