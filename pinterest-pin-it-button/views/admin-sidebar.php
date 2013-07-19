<?php

/**
 * Sidebar portion of the administration dashboard view (and subpages).
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

?>

<div class="sidebar-container">
	<h3>Need More Options?</h3>

	<ul>
		<li><i class="fui-check"></i> Hover "Pin It" button option</li>
		<li><i class="fui-check"></i> 30 custom "Pin It" button designs</li>
		<li><i class="fui-check"></i> Twitter, Facebook & G+ buttons</li>
		<li><i class="fui-check"></i> Use with featured images</li>
		<li><i class="fui-check"></i> Use with custom post types</li>
		<li><i class="fui-check"></i> Upload your own button designs</li>
		<li><i class="fui-check"></i> Priority support & auto updates</li>
	</ul>

	<p class="last-blurb">
		Get all of these and more with Pinterest "Pin It" Button Pro!
	</p>

	<a href="<?php echo pib_pro_upgrade_url( 'sidebar_link' ); ?>" class="btn btn-large btn-block btn-primary" target="_blank">Upgrade to Pro Now</a>
</div>
