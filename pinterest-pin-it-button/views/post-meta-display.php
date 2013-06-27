<?php
	/**
	* Post Meta Display
	*
	* @package PIB     
	* @subpackage views
	* @copyright   Copyright (c) 2013, Phil Derksen, Nick Young
	* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
	* @since       2.0.0
    */

// If this file is called directly, abort.
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	global $pib_options;
	
	$button_style = ( $pib_options['button_style'] == 'user_selects_image' ) ? 'User selects image' : 'Image pre-selected';
?>

<p>Button style is inherited from setting saved in "Pin It" Button Settings. Current style: <?php echo $button_style; ?></p>
<p>These 3 text fields will be used only if the button style is: Image pre-selected</p>
<p>URL of the web page to be pinned (defaults to current post/page URL if left blank):</p>
<p><input type="text" class="widefat" name="" /></p>
<p>URL of the image to be pinned (defaults to first image in post if left blank):</p>
<p><input type="text" class="widefat" name="" /></p>
<p>Description of the pin (defaults to post title if left blank):</p>
<p><input type="text" class="widefat" name="" /></p>
<p><input type="checkbox" name="" /> Show "Pin It" button on this post/page.</p>
<p>If checked displays the button for this post/page (if Individual Posts (for posts) or WordPress Static "Pages" (for pages) is also checked in "Pin It" Button Settings). If unchecked the button will always be hidden for this post/page.</p>