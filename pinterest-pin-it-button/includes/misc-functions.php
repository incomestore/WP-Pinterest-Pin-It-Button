<?php

/**
 * Misc functions to use throughout the plugin.
 *
 * @package    PIB
 * @subpackage Includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Return URL for Pro plugin upgrade with Google Analytics campaign URL.
 *
 * @since     2.0.0
 *
 * @param   string  $medium  Google Analytics "medium" tracking value
 * @return  string  $url     Full Google Analytics campaign URL
 */
function pib_pro_upgrade_url( $medium ) {
	$base_url = 'http://pinterestplugin.com/pin-it-button-pro/';

	// $medium examples: 'sidebar_link', 'banner_image'

	$url = add_query_arg( array(
		'utm_source'   => 'pib_lite',
		'utm_medium'   => $medium,
		'utm_campaign' => 'pro_upgrade'
	), $base_url );

	return $url;
}
