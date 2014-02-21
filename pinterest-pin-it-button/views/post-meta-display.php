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

global $pib_options, $post, $pib_vars;

$button_type_display = ( $pib_options['button_type'] == 'user_selects_image' ) ? __( 'User selects image', 'pib' ) : __( 'Image pre-selected', 'pib' );

$pib_sharing_checked = get_post_meta( $post->ID, 'pib_sharing_disabled', true );
$pib_url_of_webpage  = get_post_meta( $post->ID, 'pib_url_of_webpage', true);
$pib_url_of_img      = get_post_meta( $post->ID, 'pib_url_of_img', true);
$pib_description     = get_post_meta( $post->ID, 'pib_description', true);
?>

<p>
	<?php _e( 'Individual post or page-level button settings will only take affect if the "Pin It" button type set in the main settings is <strong>"image pre-selected"</strong>.', 'pib' ); ?>
</p>
<p>
	<?php _e( 'Current button type:', 'pib' ) ?> <strong><?php echo $button_type_display; ?></strong>
</p>
<?php if ( $pib_options['button_type'] == 'user_selects_image' ): ?>
	<p>
		<strong style="color: red;"><?php _e( 'The below settings will not take affects unless the button type is changed. ', 'pib' ); ?></strong>
		<?php echo sprintf( '<a href="%s">%s</a>', add_query_arg( 'page', PIB_PLUGIN_SLUG, admin_url( 'admin.php' ) ), __( 'Go to "Pin It" Button Settings', 'pib' ) ); ?>
	</p>
<?php endif; ?>
<p>
	<label for="pib_url_of_webpage"><?php _e( 'URL of the web page to be pinned', 'pib' ); ?>:</label><br />
	<input type="text" class="widefat" name="pib_url_of_webpage" id="pib_url_of_webpage" value="<?php echo esc_attr( $pib_url_of_webpage ); ?>" /><br/>
	<span class="description"><?php _e( 'Defaults to current post/page URL if left blank.', 'pib' ); ?></span>
</p>
<p>
	<label for="pib_url_of_img"><?php _e( 'URL of the image to be pinned', 'pib' ); ?>:</label><br />
	<input type="text" class="widefat" name="pib_url_of_img" id="pib_url_of_img" value="<?php echo esc_attr( $pib_url_of_img ); ?>" /><br/>
	<span class="description"><?php _e( 'Defaults to first image in post if left blank.', 'pib' ); ?></span>
</p>
<p>
	<label for="pib_description"><?php _e( 'Description of the pin', 'pib' ); ?>:</label><br />
	<input type="text" class="widefat" name="pib_description" id="pib_description" value="<?php echo esc_attr( $pib_description ); ?>" /><br/>
	<span class="description"><?php _e( 'Defaults to post title if left blank.', 'pib' ); ?></span>
</p>
<p>
	<input type="checkbox" name="pib_enable_post_sharing" id="pib_enable_post_sharing" <?php checked( empty( $pib_sharing_checked ) || ($pib_sharing_checked === false) ); ?> />
	<label for="pib_enable_post_sharing"><?php _e( 'Show "Pin It" button ' . $pib_vars['post_meta_message'] . ' on this post/page', 'pib' ); ?></label>
</p>
<p class="description">
	<?php _e( 'If checked displays the button ' . $pib_vars['post_meta_message'] . ' for this post (if Individual Posts selected) or this page (if Individual Pages selected) in the main "Pin It" button settings.', 'pib' ); ?>
</p>
<p class="description">
	<?php _e( 'If unchecked the button ' . $pib_vars['post_meta_message'] . ' will always be hidden for this post/page.', 'pib' ); ?>
</p>

<input type="hidden" name="pib_sharing_status_hidden" value="1" />
