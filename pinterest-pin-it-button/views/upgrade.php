<?php
	
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function pib_v2_upgrade() {
	// Add code here to transfer all the options to new tab layout
	
	// set which old values we don't need
	$discard = array( 'share_btn_1', 'share_btn_2', 'share_btn_3', 'share_btn_4', 'uninstall_save_settings' );
	
	// Need to decipher which Post Visibility settings to update so we will use an array
	$page_placement = array( 'display_above_content', 'display_below_content', 'display_on_post_excerpts' );
	
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
				$style_options[$key] = $value;
				
			} else if( !(false === strrpos( $key, 'display' )) ) {
				// Add to Post Visibility settings
				
				// With the new options we have these setup as nested arrays so we need to check which one we are adding to
				if( in_array( $key, $page_placement ) ) {
					$post_visibility_options['post_page_placement'][$key] = $value;
				} else {
					$post_visibility_options['post_page_types'][$key] = $value;
				}
				
			} else {
				// Add to General Settings
				$general_options[$key] = $value;
			}
			
			// add update options here

		}
	}
}