<?php

/* Show this notice on any admin page until any of the following:
 * 1) The link in the notice is clicked.
 * 2) The close link ("x") is clicked.
 * 3) The main pin it button admin page is viewed.
 */

?>

<div id="pib-install-notice" class="alert alert-error">
	<?php echo PIB_PLUGIN_TITLE . __( ' is now installed.', 'pib' ); ?>
	<a href="#" class="btn btn-small btn-danger btn-wide"><?php _e( 'Go to Button Setup', 'pib' ); ?></a>
	<button type="button" class="close fui-cross" data-dismiss="alert"></button>
</div>
