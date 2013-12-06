<?php

/**
 * Represents the view for the administration page "Help".
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

?>

<div class="wrap">

	<div id="pib-settings">
		<div id="pib-settings-content">

			<?php screen_icon( 'pinterest-32' ); ?>
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<p>
				<?php _e( 'Plugin version', 'pib' ); ?>: <strong><?php echo PIB_VERSION; ?></strong>
			</p>

			<h3 class="title"><?php _e( 'Individual Post/Page Overrides', 'pib' ); ?></h3>

			<p>
				<?php _e( 'You may individually override what website address (URL), image and description will be pinned for each post or page.', 'pib' ); ?>
				<?php _e( 'These fields are located towards the bottom of the post/page edit screen.', 'pib' ); ?>
			</p>

			<h3 class="title"><?php _e( 'Shortcode', 'pib' ); ?></h3>

			<p>
				<?php _e( 'Use the shortcode', 'pib' ); ?> <code>[pinit]</code> <?php _e( 'to display the button within your content.', 'pib' ); ?>
			</p>
			<p>
				<?php _e( 'Use the function', 'pib' ); ?> <code><?php echo htmlentities( '<?php echo do_shortcode(\'[pinit]\'); ?>' ); ?></code>
				<?php _e( 'to display within template or theme files.', 'pib' ); ?>
			</p>

			<h4><?php _e( 'Available Attributes (Lite & Pro)', 'pib' ); ?></h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th><?php _e( 'Attribute', 'pib' ); ?></th>
					<th><?php _e( 'Description', 'pib' ); ?></th>
					<th><?php _e( 'Choices', 'pib' ); ?></th>
					<th><?php _e( 'Default', 'pib' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>button_type</td>
					<td><?php _e( '"Pin It" button behavior type', 'pib' ); ?></td>
					<td>any (user selects images), one (image is pre-selected)</td>
					<td>any</td>
				</tr>
				<tr>
					<td>count</td>
					<td><?php _e( 'Where to show the pin count bubble', 'pib' ); ?></td>
					<td>none, horizontal (beside), vertical (above)</td>
					<td>none</td>
				</tr>
				<tr>
					<td>url</td>
					<td><?php _e( 'URL of the web page to be pinned. Must be specified if used on home or index page.', 'pib' ); ?></td>
					<td><?php _e( 'Any valid web page URL', 'pib' ); ?></td>
					<td><?php _e( 'Current post/page URL', 'pib' ); ?></td>
				</tr>
				<tr>
					<td>image_url</td>
					<td><?php _e( 'URL of the image to be pinned', 'pib' ); ?></td>
					<td><?php _e( 'Any valid image URL', 'pib' ); ?></td>
					<td><?php _e( 'First image in post/page', 'pib' ); ?></td>
				</tr>
				<tr>
					<td>description</td>
					<td><?php _e( 'Description of the pin. Ignored if button_type="any"', 'pib' ); ?></td>
					<td><?php _e( 'Any string of text', 'pib' ); ?></td>
					<td>Post/page title</td>
				</tr>
				<tr>
					<td>size</td>
					<td><?php _e( '"Pin It" button size', 'pib' ); ?></td>
					<td>small, large</td>
					<td>small</td>
				</tr>
				<tr>
					<td>shape</td>
					<td><?php _e( '"Pin It" button shape', 'pib' ); ?></td>
					<td>rectangular, circular</td>
					<td>rectangular</td>
				</tr>
				<tr>
					<td>color</td>
					<td><?php _e( '"Pin It" button color', 'pib' ); ?></td>
					<td>gray, red, white</td>
					<td>gray</td>
				</tr>
				<tr>
					<td>align</td>
					<td><?php _e( 'Adds CSS to align button', 'pib' ); ?></td>
					<td>none, left, right, center</td>
					<td>none</td>
				</tr>
				<tr>
					<td>remove_div</td>
					<td><?php _e( 'If true removes surrounding div tag', 'pib' ); ?></td>
					<td>true, false</td>
					<td>false</td>
				</tr>
				<tr>
					<td>always_show_count</td>
					<td><?php _e( 'Will always show the count bubble, even for pages with zero pins', 'pib' ); ?></td>
					<td>true, false</td>
					<td>false</td>
				</tr>
				</tbody>
			</table>

			<h4><?php _e( 'Available Attributes (Pro Only)', 'pib' ); ?></h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th><?php _e( 'Attribute', 'pib' ); ?></th>
					<th><?php _e( 'Description', 'pib' ); ?></th>
					<th><?php _e( 'Choices', 'pib' ); ?></th>
					<th><?php _e( 'Default', 'pib' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>social_buttons</td>
					<td><?php _e( 'If true will show other social sharing buttons (the share bar). Must be enabled in main settings. Inherits alignment and other styles from main settings.', 'pib' ); ?></td>
					<td>true, false</td>
					<td>false</td>
				</tr>
				<tr>
					<td>use_featured_image</td>
					<td><?php _e( 'If true and "image is pre-selected" is enabled, will default to post\'s featured image.', 'pib' ); ?></td>
					<td>true, false</td>
					<td>false</td>
				</tr>
				</tbody>
			</table>

			<h4><?php _e( 'Shortcode Examples', 'pib' ); ?></h4>

			<ul class="ul-disc">
				<li><code>[pinit count="horizontal" button_type="one"]</code></li>
				<li><code>[pinit count="vertical" url="http://www.mysite.com" image_url="http://www.mysite.com/myimage.jpg" description="This is a description of my image." align="right"]</code></li>
				<li><strong><?php _e( 'Pro only' ); ?>:</strong> <code>[pinit social_buttons="true" use_featured_image="true" count="horizontal"]</code></li>
			</ul>

			<h3 class="title"><?php _e( 'CSS Style Overrides', 'pib' ); ?></h3>

			<p>
				<?php _e( 'This plugin outputs a CSS file in an attempt to keep basic "Pin It" button styling intact.', 'pib' ); ?>
				<?php _e( 'To override the CSS styles you may add your own CSS to the plugin\'s "Custom CSS" box or in your theme files.', 'pib' ); ?>
				<?php _e( 'No !important tags are used in this plugin\'s CSS, but note that the embed code from Pinterest also renders some CSS (which may include !important tags).', 'pib' ); ?>
			</p>

			<h4><?php _e( 'Available CSS classes (Lite & Pro)', 'pib' ); ?></h4>

			<ul class="ul-disc">
				<li><code>div.pin-it-btn-wrapper</code> - <?php _e( 'Regular button container', 'pib' ); ?></li>
				<li><code>div.pin-it-btn-wrapper a</code> - <?php _e( 'Regular button link tag', 'pib' ); ?></li>
				<li><code>div.pin-it-btn-wrapper-shortcode</code> - <?php _e( 'Shortcode button container', 'pib' ); ?></li>
				<li><code>div.pin-it-btn-wrapper-shortcode a</code> - <?php _e( 'Shortcode button link tag', 'pib' ); ?></li>
				<li><code>div.pin-it-btn-wrapper-widget</code> - <?php _e( 'Widget button container', 'pib' ); ?></li>
				<li><code>div.pin-it-btn-wrapper-widget a</code> - <?php _e( 'Widget button link tag', 'pib' ); ?></li>
			</ul>

			<p>
				<?php _e( 'There is also a <code>span</code> element nested inside the "Pin It" button <code>a</code> tag which contains the count bubble.', 'pib' ); ?>
			</p>

			<h4><?php _e( 'Available CSS classes (Pro Only)', 'pib' ); ?></h4>

			<ul class="ul-disc">
				<li><code>a.pib-hover-btn-link</code> - <?php _e( 'Hover button link tag', 'pib' ); ?></li>
				<li><code>div.pib-img-under-wrapper</code> - <?php _e( 'Below image button container', 'pib' ); ?></li>
				<li><code>div.pib-img-under-wrapper a</code> - <?php _e( 'Below image button link tag', 'pib' ); ?></li>

				<li><code>div.pib-sharebar</code> - <?php _e( 'Share bar container', 'pib' ); ?></li>
				<li><code>li.pib-sharebar-pinterest</code> - <?php _e( 'Share bar: Pin It button container', 'pib' ); ?></li>
				<li><code>li.pib-sharebar-facebook-share</code> - <?php _e( 'Share bar: Facebook Share button container', 'pib' ); ?></li>
				<li><code>li.pib-sharebar-facebook</code> - <?php _e( 'Share bar: Facebook Like button container', 'pib' ); ?></li>
				<li><code>li.pib-sharebar-twitter</code> - <?php _e( 'Share bar: Tweet button container', 'pib' ); ?></li>
				<li><code>li.pib-sharebar-gplus-share</code> - <?php _e( 'Share bar: Google+ Share button container', 'pib' ); ?></li>
				<li><code>li.pib-sharebar-gplus</code> - <?php _e( 'Share bar: Google +1 button container', 'pib' ); ?></li>
				<li><code>li.pib-sharebar-linkedin</code> - <?php _e( 'Share bar: LinkedIn Share button container', 'pib' ); ?></li>
			</ul>

			<h4><?php _e( 'CSS Style Override Examples', 'pib' ); ?></h4>

			<ul class="ul-disc">
				<li><code>div.pin-it-btn-wrapper { padding-bottom: 50px; }</code> - <?php _e( 'Increase space under button', 'pib' ); ?></li>
				<li><code>div.pin-it-btn-wrapper a { border: 1px solid red; }</code> - <?php _e( 'Add red border around button', 'pib' ); ?></li>
				<li><code>div.pin-it-btn-wrapper-widget a { border: 1px solid red; }</code> - <?php _e( 'Add red border around widget button', 'pib' ); ?></li>
			</ul>

			<p>
				<?php printf( __( 'Visit the <a href="%s" target="_blank">Knowledgebase</a> for additional help.', 'pib' ), 'http://pinterestplugin.com/support' ); ?>
			</p>

		</div><!-- #pib-settings-content -->

		<?php // Always show sidebar on help page. Different for Lite & Pro. ?>

		<div id="pib-settings-sidebar">
			<?php if ( class_exists( 'Pinterest_Pin_It_Button_Pro' ) ): ?>
				<?php include( 'admin-sidebar-pro.php' ); ?>
			<?php else: ?>
				<?php include( 'admin-sidebar.php' ); ?>
			<?php endif; ?>
		</div>
	</div>

</div><!-- .wrap -->
