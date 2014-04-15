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

// Legacy category option not used anymore. Delete either way.
delete_option( 'pib_category_fields_option' );

$general = get_option( 'pib_settings_general' );

// If the the option to save settings is checked then do nothing, otherwise delete all options and post meta
if ( ! empty( $general['uninstall_save_settings'] ) ) {
	// Do nothing
} else {
	
	// Lite
	// Delete options
	delete_option( 'pib_settings_general' );
	delete_option( 'pib_settings_post_visibility' );
	delete_option( 'pib_settings_styles' );
	delete_option( 'pib_settings_misc' );
	delete_option( 'pib_upgrade_has_run' );
	delete_option( 'pib_version' );
	delete_option( 'pib_show_admin_install_notice' );
	delete_option( 'pib_settings_advanced' );

	// Delete widget options
	delete_option( 'widget_pib_button' );
	
	// Delete post meta	
	delete_post_meta_by_key( 'pib_sharing_disabled' );
	delete_post_meta_by_key( 'pib_url_of_webpage' );
	delete_post_meta_by_key( 'pib_url_of_img' );
	delete_post_meta_by_key( 'pib_description' );
	
	// Pro
	// Delete ALL Pro settings and keys
	delete_option( 'pib_settings_image_hover' );
	delete_option( 'pib_settings_image_misc' );
	delete_option( 'pib_settings_share_bar' );
	delete_option( 'pib_settings_support' );
	delete_option( 'pib_sharebar_buttons' );
	

	// Pro Misc options
	delete_option( 'pib_edd_sl_license_active' );
	delete_option( 'pib_lite_deactivation_notice' );

	// Pro post meta options
	delete_post_meta_by_key( 'pib_utm_meta' );
	delete_post_meta_by_key( 'pib_override_hover_description' );
	delete_post_meta_by_key( 'pib_override_below_description' );
}