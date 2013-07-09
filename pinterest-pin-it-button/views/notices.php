<?php

/**
 *  Admin Notices
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

function pib_register_admin_notices() {
	
	global $pib_options;
	
	if( ( isset( $_GET['tab'] ) && 'general' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pib-notices', 'pib-styles', __( 'General settings updated.', 'pib' ), 'updated' );
	}
	
	if( ( isset( $_GET['tab'] ) && 'post_visibility' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pib-notices', 'pib-styles', __( 'Post Visibility settings updated.', 'pib' ), 'updated' );
	}
	
	if( ( isset( $_GET['tab'] ) && 'styles' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pib-notices', 'pib-styles', __( 'Styles settings updated.', 'pib' ), 'updated' );
	}
	
	if( ( isset( $_GET['tab'] ) && 'misc' == $_GET['tab'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pib-notices', 'pib-styles', __( 'Misc settings updated.', 'pib' ), 'updated' );
	}
	
	settings_errors( 'pib-notices' );
}
add_action( 'admin_notices', 'pib_register_admin_notices' );