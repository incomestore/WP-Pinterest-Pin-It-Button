<?php

/**
 * Run the upgrade process from version 1.x of the plugin to current.
 *
 * @package    PIB
 * @subpackage Includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! get_option( 'pib_version' ) ) {
	add_option( 'pib_version', $this->version );
} else {
	add_option( 'pib_old_version', get_option( 'pib_version' ) );
}

// If this option exists then the plugin is before version 2.0.0
if ( get_option( 'pib_options' ) ) {
	add_option( 'pib_old_version', '1.4.3' );
	update_option( 'pib_upgrade_has_run', 1 );
}

// Only if the old version is less than the new version do we run our upgrade code.
if ( version_compare( get_option( 'pib_old_version' ), $this->version, '<' ) ) {
	// need to update pib_upgrade_has_run so that we don;t load the defaults in too
	update_option( 'pib_upgrade_has_run', 1 );
	pib_do_all_upgrades();
} else {
	// Delete our holder for the old version of PIB.
	delete_option( 'pib_old_version' );
}

function pib_do_all_upgrades() {
	
	$current_version = get_option( 'pib_old_version' );
	
	// if less than version 2 then upgrade
	if ( version_compare( $current_version, '2.0.0', '<' ))
		   pib_v2_upgrade();
	
	delete_option( 'pib_old_version' );
	
}

function pib_v2_upgrade() {
	// Add code here to transfer all the options to new tab layout

	// Need to decipher which Post Visibility settings to update so we will use an array
	$page_placement = array( 'display_above_content', 'display_below_content', 'display_on_post_excerpts' );
	
	if ( get_option('pib_options' ) ) {
		$old_options = get_option( 'pib_options' );
		
		// get the new options so we can update them accordingly
		$general_options = get_option( 'pib_settings_general' );
		$post_visibility_options = get_option( 'pib_settings_post_visibility' );
		$style_options = get_option( 'pib_settings_styles' );
		
		// Do I need to add the new options here if they don't exist?
		
		foreach ($old_options as $key => $value) {
			
			if ( 'custom_css' == $key || 'remove_div' == $key ) {
				// Add to styles settings
				$style_options[$key] = $value;
				
			} else if ( ! ( false === strrpos( $key, 'display' ) ) ) {
				// Add to Post Visibility settings
				
				// With the new options we have these setup as nested arrays so we need to check which one we are adding to
				if ( in_array( $key, $page_placement ) ) {
					$post_visibility_options['post_page_placement'][$key] = $value;
				} else {
					$post_visibility_options['post_page_types'][$key] = $value;
				}
				
			} else {
				// Add to General Settings
				$general_options[$key] = $value;
			}
			
			// add update options here
			update_option( 'pib_settings_general', $general_options );
			update_option( 'pib_settings_post_visibility', $post_visibility_options );
			update_option( 'pib_settings_styles', $style_options );
			
			// Delete old options
			delete_option( 'pib_options' );
			delete_option( 'pib_hide_pointer' );
		}
	}
}

pib_do_all_upgrades();
