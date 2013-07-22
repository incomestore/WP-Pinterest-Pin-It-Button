<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @package PIB
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit;

$general = get_option( 'pib_settings_general' );

// If the the option to save settings is checked then do nothing, otherwise delete all options and post meta
if ( $general['uninstall_save_settings'] ) {
	// Do nothing
} else {
	// Delete options
	delete_option( 'pib_settings_general' );
	delete_option( 'pib_settings_post_visibility' );
	delete_option( 'pib_settings_styles' );
	delete_option( 'pib_settings_misc' );
	delete_option( 'pib_upgrade_has_run' );
	delete_option( 'pib_version' );
	delete_option( 'pib_show_admin_install_notice' );
	
	// delete widget options
	delete_option( 'widget_pib_button' );
	
	// Delete post meta
	delete_post_meta_by_key( 'pib_sharing_disabled' );
	delete_post_meta_by_key( 'pib_url_of_webpage' );
	delete_post_meta_by_key( 'pib_url_of_img' );
	delete_post_meta_by_key( 'pib_description' );
}
