<?php
/**
 * Pinterest "Pin It" Button Lite
 *
 * @package		PIB
 * @author		Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license		GPL-2.0+
 * @link		http://pinterestplugin.com
 * @copyright	2011-2013 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Pinterest "Pin It" Button Lite
 * Plugin URI: http://pinterestplugin.com
 * Description: Add a Pinterest "Pin It" Button to your site and get your visitors to start pinning your awesome content!
 * Version: 2.0.0
 * Author: Phil Derksen
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PIB_BASE_NAME', plugin_basename( __FILE__ ) );	    // pinterest-pin-it-button/pinterest-pin-it-button.php
define( 'PIB_BASE_DIR_SHORT', dirname( PIB_BASE_NAME ) );	// pinterest-pin-it-button
define( 'PIB_BASE_DIR_LONG', dirname( __FILE__ ) );			// ../wp-content/plugins/pinterest-pin-it-button (physical file path)
define( 'PIB_BASE_URL', plugin_dir_url( __FILE__ ) );		// http://mysite.com/wp-content/plugins/pinterest-pin-it-button/
define( 'PIB_CSS_URL', PIB_BASE_URL . 'css/' );
define( 'PIB_JS_URL', PIB_BASE_URL . 'js/' );

require_once( plugin_dir_path( __FILE__ ) . 'class-pinterest-pin-it-button.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'Pinterest_Pin_It_Button', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Pinterest_Pin_It_Button', 'deactivate' ) );

Pinterest_Pin_It_Button::get_instance();
