<?php
/**
 * Pinterest "Pin It" Button
 *
 * @package		PIB
 * @author		Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license		GPL-2.0+
 * @link		http://pinterestplugin.com
 * @copyright	2011-2013 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Pinterest "Pin It" Button
 * Plugin URI: http://pinterestplugin.com
 * Description: Add a Pinterest "Pin It" Button to your posts and pages allowing your readers easily pin your images. Includes shortcode and widget.
 * Version: 2.0.0
 * Author: Phil Derksen, Nick Young
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-pinterest-pin-it-button.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'Pinterest_Pin_It_Button', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Pinterest_Pin_It_Button', 'deactivate' ) );

Pinterest_Pin_It_Button::get_instance();