<?php

/**
 * Show notice after plugin install/activate in admin dashboard until user acknowledges.
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

?>

<div id="pib-install-notice">
	<div class="alert alert-error">
		<?php echo $this->get_plugin_title() . __( ' is now installed.', 'pib' ); ?>
		<a href="<?php echo add_query_arg( 'page', $this->plugin_slug, admin_url( 'admin.php' ) ); ?>" class="btn btn-small btn-danger btn-wide"><?php _e( 'Go to Button Setup', 'pib' ); ?></a>
		<a href="#" class="btn btn-small"><?php _e( 'Hide this', 'pib' ); ?></a>
	</div>
</div>
