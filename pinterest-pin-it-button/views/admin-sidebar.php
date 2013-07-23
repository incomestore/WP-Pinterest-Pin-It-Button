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
	<h3 class="sidebar-title"><?php _e( 'Need More Options?', 'pib' ); ?></h3>

	<div class="sidebar-content">
		<ul>
			<li><i class="fui-check"></i> <?php _e( 'Image Hover "Pin It" button', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( '30 custom "Pin It" button designs', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Twitter, Facebook & G+ buttons', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Featured image support', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Custom post type support', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Upload your own button designs', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Priority support & auto updates', 'pib' ); ?></li>
		</ul>

		<p class="last-blurb">
			<?php _e( 'Get all of these and more with Pinterest "Pin It" Button Pro!', 'pib' ); ?>
		</p>

		<a href="<?php echo pib_pro_upgrade_url( 'sidebar_link' ); ?>" class="btn btn-large btn-block btn-danger" target="_blank">
			<?php _e( 'Upgrade to Pro Now', 'pib' ); ?></a>
	</div>
</div>
