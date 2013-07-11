<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @package PIB
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// TODO: Define uninstall functionality here
$general = get_option( 'pib_settings_general' );

// If the the option to save settings is checked then do nothing, otherwise delete all options and post meta
if( $general['uninstall_save_settings'] ) { } 
else {
	
	// Delete options
	delete_option( 'pib_settings_general' );
	delete_option( 'pib_settings_post_visibility' );
	delete_option( 'pib_settings_styles' );
	delete_option( 'pib_settings_misc' );
	delete_option( 'pib_has_run' );
	
	// Delete post meta
	delete_post_meta_by_key( 'pib_sharing_disabled' );
	delete_post_meta_by_key( 'pib_url_of_webpage' );
	delete_post_meta_by_key( 'pib_url_of_img' );
	delete_post_meta_by_key( 'pib_description' );
}
