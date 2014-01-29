<?php
/**
 * Pinterest "Pin It" Button Lite
 *
 * @package   PIB
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @link      http://pinterestplugin.com
 * @copyright 2011-2014 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Pinterest "Pin It" Button Lite
 * Plugin URI: http://pinterestplugin.com/pin-it-button-pro/
 * Description: Add a Pinterest "Pin It" Button to your site and get your visitors to start pinning your awesome content!
 * Version: 2.0.2
 * Author: Phil Derksen
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

// Run a check for Pro first since these 2 plugins cannot be installed at the same time to avoid issues and crashes
if( ! class_exists( 'Pinterest_Pin_It_Button_Pro' ) ) {
	if( ! class_exists( 'Pinterest_Pin_It_Button' ) )
		require_once( plugin_dir_path( __FILE__ ) . 'class-pinterest-pin-it-button.php' );

	// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
	register_activation_hook( __FILE__, array( 'Pinterest_Pin_It_Button', 'activate' ) );

	Pinterest_Pin_It_Button::get_instance();
} else {
	echo "You already have Pinterest Pin It Button Pro installed. To downgrade please deactivate and delete the Pro plugin first.";
	die();
}
