<?php

/**
 *  Admin Notices
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

function pib_register_admin_notices() {
	
	// The first check will show message if general tab is updated. The addiitional check is if the plugin page is first clicked on and the 'tab' has not been set yet
	
	if ( ( isset( $_GET['tab'] ) && 'general' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] )
			|| ( !isset( $_GET['tab'] ) && 'true' == isset( $_GET['settings-updated'] ) ) ) {
		add_settings_error( 'pib-notices', 'pib-general-updated', __( 'General settings updated.', 'pib' ), 'updated' );
	}
	
	if ( ( isset( $_GET['tab'] ) && 'post_visibility' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pib-notices', 'pib-post_visibility-updated', __( 'Post Visibility settings updated.', 'pib' ), 'updated' );
	}
	
	if ( ( isset( $_GET['tab'] ) && 'styles' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pib-notices', 'pib-styles-updated', __( 'Styles settings updated.', 'pib' ), 'updated' );
	}
	
	if ( ( isset( $_GET['tab'] ) && 'misc' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pib-notices', 'pib-misc-updated', __( 'Misc settings updated.', 'pib' ), 'updated' );
	}
	
	settings_errors( 'pib-notices' );
	
}
add_action( 'admin_notices', 'pib_register_admin_notices' );