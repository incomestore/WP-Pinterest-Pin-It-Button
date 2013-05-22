<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package PIB
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license GPL-2.0+
 * @link    http://pinterestplugin.com
 * @copyright 2011-2013 Phil Derksen
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// TODO: Define uninstall functionality here