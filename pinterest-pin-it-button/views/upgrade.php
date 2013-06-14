<?php
	
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function pib_v2_upgrade() {
	// Add code here to transfer all the options to new tab layout
	
	// set which old values we don't need
	$discard = array( 'share_btn_1', 'share_btn_2', 'share_btn_3', 'share_btn_4', 'uninstall_save_settings' );
	
	if(get_option('pib_options')) {
		$old_options = get_option('pib_options');
		
		// get the new options so we can update them accordingly
		$general_options = get_option( 'pib_settings_general' );
		$post_visibility_options = get_option( 'pib_settings_post_visibility' );
		$style_options = get_option( 'pib_settings_styles' );
		
		// Do I need to add the new options here if they don't exist?
		
		foreach($old_options as $key => $value) {
			
			if( in_array( $key, $discard ) ) {
				continue;
			} else if( 'custom_css' == $key || 'remove_div' == $key ) {
				// Add to styles settings
				echo "Styles Setting [$key]<br />";
			} else if( !(false === strrpos( $key, 'display' )) ) {
				echo "Post Visibilty Setting [$key]<br />";
				// Add to Post Visibility settings
			} else {
				// Add to General Settings
				echo "General Setting [$key]<br />";
			}

		}
	}
}