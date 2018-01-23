/**
 * Admin-side JS
 *
 * @package Anima
 */

jQuery(document).ready(function() {

	/* Theme settings save */
	jQuery('#anima-savesettings-button').on('click', function(e) {
		jQuery( "#anima-settings-dialog" ).dialog({
		  modal: true,
		  minWidth: 600,
		  buttons: {
			'Close': function() {
			  jQuery( this ).dialog( "close" );
			}
		  }
		});
		jQuery('#anima-themesettings-textarea').val(jQuery('#anima-export input#anima-themesettings').val());
		jQuery('#anima-settings-dialog strong').hide();
		jQuery('#anima-settings-dialog div.settings-error').remove();
		jQuery('#anima-settings-dialog strong:nth-child(1)').show();
	});

	/* Theme settings load */
	jQuery('#anima-loadsettings-button').on('click', function(e) {
		jQuery( "#anima-settings-dialog" ).dialog({
			modal: true,
			minWidth: 600,
			buttons: {
				'Load Settings': function() {
					theme_settings = encodeURIComponent(jQuery('#anima-themesettings-textarea').val());
					nonce = jQuery('#anima-settings-nonce').val();
					jQuery.post(ajaxurl, {
						action: 'cryout_loadsettings_action',
						anima_settings_nonce: nonce,
						anima_settings: theme_settings,
					}, function(response) {
						if (response=='OK') {
							jQuery('#anima-settings-dialog div.settings-error').remove();
							window.location = '?page=about-anima-theme&settings-loaded=true';
						} else {
							jQuery('#anima-settings-dialog div.settings-error').remove();
							jQuery('#anima-themesettings-textarea').after('<div class="settings-error">' + response + '</div>');
						}
					})
				}
			}
		});
		jQuery('#anima-themesettings-textarea').val('');
		jQuery('#anima-settings-dialog strong').hide();
		jQuery('#anima-settings-dialog strong:nth-child(2)').show();
	});

	/* Latest News Content */
    var data = {
        action: 'cryout_feed_action',
    };
	jQuery.post(ajaxurl, data, function(response) {
		jQuery("#anima-news .inside").html(response);
    });

	/* Confirm modal window on reset to defaults */
	jQuery('#anima_reset_defaults').click (function() {
		if (!confirm(anima_admin_settings.reset_confirmation)) { return false;}
	});

});/* document.ready */

/* FIN */
