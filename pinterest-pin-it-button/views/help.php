<?php

/**
 * Represents the view for the administration page "Help".
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */
?>

<div class="wrap">
	<?php screen_icon( 'pib-icon32' ); ?>
	<h2><?php _e( 'Help for Pinterest "Pin It" Button Lite', 'pib' ) ?></h2>

	<h3 class="title">Shortcode</h3>

	<p>
		<?php _e( 'Use the shortcode', 'pib' ); ?> <code>[pinit]</code> <?php _e( 'to display the button within your content.', 'pib' ); ?>
	</p>
	<p>
		<?php _e( 'Use the function', 'pib' ); ?> <code><?php echo htmlentities( '<?php echo do_shortcode(\'[pinit]\'); ?>' ); ?></code>
		<?php _e( 'to display within template or theme files.', 'pib' ); ?>
	</p>

	<h4>Available Attributes (Lite & Pro)</h4>

	<table class="widefat importers" cellspacing="0">
		<thead>
			<tr>
				<th>Shortcode</th>
				<th><?php _e( 'Description' ); ?></th>
				<th><?php _e( 'Choices' ); ?></th>
				<th><?php _e( 'Default' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>count</td>
				<td><?php _e( 'Where to show the pin count bubble.' ); ?></td>
				<td>none, horizontal (beside), vertical (above)</td>
				<td>none</td>
			</tr>
			<tr>
				<td>url</td>
				<td><?php _e( 'URL of the web page to be pinned. Must be specified if used on home or index page.' ); ?></td>
				<td><?php _e( 'Any valid web page URL' ); ?></td>
				<td><?php _e( 'Current post/page URL' ); ?></td>
			</tr>
			<tr>
				<td>image_url</td>
				<td><?php _e( 'URL of the image to be pinned.' ); ?></td>
				<td><?php _e( 'Any valid image URL' ); ?></td>
				<td><?php _e( 'First image in post/page' ); ?></td>
			</tr>
			<tr>
				<td>description</td>
				<td><?php _e( 'Description of the pin.' ); ?></td>
				<td><?php _e( 'Any string of text' ); ?></td>
				<td>Post/page title</td>
			</tr>
			<tr>
				<td>align</td>
				<td><?php _e( 'Adds CSS to align button.' ); ?></td>
				<td>none, left, right, center</td>
				<td>none</td>
			</tr>
			<tr>
				<td>remove_div</td>
				<td><?php _e( 'If true removes surrounding div tag.' ); ?></td>
				<td>true, false</td>
				<td>false</td>
			</tr>
		</tbody>
	</table>

	<h4>Available Attributes (Pro Only)</h4>

	<table class="widefat importers" cellspacing="0">
		<thead>
			<tr>
				<th>Shortcode</th>
				<th><?php _e( 'Description' ); ?></th>
				<th><?php _e( 'Choices' ); ?></th>
				<th><?php _e( 'Default' ); ?></th>
			</tr>
			</thead>
		<tbody>
			<tr>
				<td>social_buttons</td>
				<td><?php _e( 'If true will show other social sharing buttons (the share bar). Must be enabled in main settings. Inherits alignment and other styles from main settings.' ); ?></td>
				<td>true, false</td>
				<td>false</td>
			</tr>
			<tr>
				<td>use_featured_image</td>
				<td><?php _e( 'If true and "image is pre-selected" is enabled, will default to post\'s featured image.' ); ?></td>
				<td>true, false</td>
				<td>false</td>
			</tr>
		</tbody>
	</table>

	<h4><?php _e( 'Shortcode Examples', 'pib' ); ?></h4>

	<ul>
		<li><code>[pinit count="horizontal"]</code></li>
		<li><code>[pinit count="vertical" url="http://www.mysite.com" image_url="http://www.mysite.com/myimage.jpg" description="This is a description of my image." align="right"]</code></li>
		<li><?php _e( 'Pro only' ); ?>: <code>[pinit social_buttons="true" use_featured_image="true" count="horizontal"]</code></li>
	</ul>

</div><!-- .wrap -->
