<?php

/**
 * Post Meta Display
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

global $pib_options;

$button_style = ( $pib_options['button_style'] == 'user_selects_image' ) ? __( 'User selects image', 'pib' ) : __( 'Image pre-selected', 'pib' );

$pib_sharing_checked = get_post_meta( $post->ID, 'pib_sharing_disabled', 1 );
$pib_url_of_webpage = get_post_meta( $post->ID, 'pib_url_of_webpage', true);
$pib_url_of_img = get_post_meta( $post->ID, 'pib_url_of_img', true);
$pib_description = get_post_meta( $post->ID, 'pib_description', true);
?>

<p>
	<?php _e( 'Button style is inherited from setting saved in', 'pib' ); ?>
	<?php echo sprintf( '<a href="%s">%s</a>', add_query_arg( 'page', PLUGIN_SLUG, admin_url( 'admin.php' ) ), __( '"Pin It" Button Settings', 'pib' ) ); ?>.
</p>
<p>
	<?php _e( 'These 3 text fields will be used only if the button style is "image pre-selected".', 'pib' ); ?>
</p>
<p>
	<?php _e( 'Current style', 'pib' ) ?>: <strong><?php echo $button_style; ?></strong>
</p>
<p>
	<label for="pib_url_of_webpage"><?php _e( 'URL of the web page to be pinned', 'pib' ); ?>:</label><br />
	<input type="text" class="widefat" name="pib_url_of_webpage" id="pib_url_of_webpage" value="<?php echo $pib_url_of_webpage; ?>" />
	<span class="description"><?php _e( 'Defaults to current post/page URL if left blank.', 'pib' ); ?></span>
</p>
<p>
	<label for="pib_url_of_img"><?php _e( 'URL of the image to be pinned', 'pib' ); ?>:</label><br />
	<input type="text" class="widefat" name="pib_url_of_img" id="pib_url_of_img" value="<?php echo $pib_url_of_img; ?>" />
	<span class="description"><?php _e( 'Defaults to first image in post if left blank.', 'pib' ); ?></span>
</p>
<p>
	<label for="pib_description"><?php _e( 'Description of the pin', 'pib' ); ?>:</label><br />
	<input type="text" class="widefat" name="pib_description" id="pib_description" value="<?php echo $pib_description; ?>" />
	<span class="description"><?php _e( 'Defaults to post title if left blank.', 'pib' ); ?></span>
</p>
<p>
	<input type="checkbox" name="pib_enable_post_sharing" id="pib_enable_post_sharing" <?php checked( empty( $pib_sharing_checked ) || ($pib_sharing_checked === false) ); ?> />
	<label for="pib_enable_post_sharing"><?php _e( 'Show "Pin It" button on this post/page', 'pib' ); ?></label>
</p>
<p>
	<span class="description"><?php _e( 'If checked displays the button for this post (if Individual Posts selected) or this page (if Individual Pages selected) in the main "Pin It" button settings.', 'pib' ); ?></span>
</p>
<p>
	<span class="description"><?php _e( 'If unchecked the button will always be hidden for this post/page.', 'pib' ); ?></span>
</p>
<input type="hidden" name="pib_sharing_status_hidden" value="1" />
