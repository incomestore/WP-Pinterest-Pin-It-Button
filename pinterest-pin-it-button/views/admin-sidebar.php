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
	<h3 class="sidebar-title-large"><?php _e( 'Need More Options?', 'pib' ); ?></h3>

	<div class="sidebar-content">
		<ul>
			<li><i class="fui-check"></i> <?php _e( 'Add "Pin It" buttons on image hover', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Add "Pin It" buttons under images', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( '30 custom "Pin It" button designs', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Upload your own button designs', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Twitter, Facebook & G+ buttons', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Use with featured images', 'pib' ); ?></li>
			<li><i class="fui-check"></i> <?php _e( 'Use with custom post types', 'pib' ); ?></li>

			<?php if ( pib_is_woo_commerce_active() ): ?>
			<li><i class="fui-check"></i> <?php _e( 'WooCommerce support', 'pib' ); ?></li>
			<?php endif; ?>

			<li><i class="fui-check"></i> <?php _e( 'Customer support & auto updates', 'pib' ); ?></li>
		</ul>

		<p class="last-blurb">
			<?php _e( 'Get all of these and more with Pinterest "Pin It" Button Pro!', 'pib' ); ?>
		</p>

		<a href="<?php echo pib_ga_campaign_url( 'http://pinterestplugin.com/pin-it-button-pro/', 'pib_lite_2', 'sidebar_link', 'pro_upgrade' ); ?>"
		   class="btn btn-large btn-block btn-danger" target="_blank">
			<?php _e( 'Upgrade to Pro Now', 'pib' ); ?></a>
		<br/>
	</div>
</div>

<?php 
	// check if WooCommerce is active to show WC Rich Pins promotion
	if ( pib_is_woo_commerce_active() ): 
		// If WC Rich Pins is already activated then we don't need to show this
		if ( ! pib_is_wc_rich_pins_active() ) : ?>

			<div class="sidebar-container">
				<h4 class="sidebar-title-medium"><?php _e( 'WooCommerce Rich Pins', 'pib' ); ?></h4>

				<div class="sidebar-content">
					<p>
						<?php _e( 'Running a WooCommerce store and want to give your pins a boost? There\'s a plugin for that.', 'pib' ); ?>
					</p>

					<a href="<?php echo pib_ga_campaign_url( 'http://pinterestplugin.com/woocommerce-rich-pins/', 'pib_lite_2', 'sidebar_link', 'wc_rich_pins' ); ?>"
					   class="btn btn-small btn-block btn-inverse" target="_blank">
						<?php _e( 'Check out Rich Pins for WooCommerce', 'pib' ); ?></a>
				</div>
			</div>

<?php 
		endif; // End WC Rich Pins check
	endif; // End WooCommerce check
?>

<div class="sidebar-container">
	<div class="sidebar-content">
		<p>
			<?php _e( 'Help us get noticed (and boost our egos) with a rating and short review.', 'pib' ); ?>
		</p>

		<a href="http://wordpress.org/support/view/plugin-reviews/pinterest-pin-it-button" class="btn btn-small btn-block btn-inverse" target="_blank">
			<?php _e( 'Rate this plugin on WordPress.org', 'pib' ); ?></a>
	</div>
</div>

<div class="sidebar-container">
	<div class="sidebar-content">
		<ul>
			<li>
				<i class="fui-arrow-right"></i>
				<a href="http://wordpress.org/support/plugin/pinterest-pin-it-button" target="_blank">
					<?php _e( 'Community Support Forums', 'pib' ); ?></a>
			</li>
			<li>
				<i class="fui-arrow-right"></i>
				<a href="<?php echo pib_ga_campaign_url( 'http://pinterestplugin.com/support', 'pib_lite_2', 'sidebar_link', 'support' ); ?>" target="_blank">
					<?php _e( 'Knowledgebase', 'pib' ); ?></a>
			</li>
		</ul>
	</div>
</div>

<div class="sidebar-container">
	<h4 class="sidebar-title-small"><?php _e( 'Recent News from PinterestPlugin.com', 'pib' ); ?></h4>

	<div class="sidebar-content pib-rss-news">
		<?php pib_rss_news(); ?>
	</div>
</div>
