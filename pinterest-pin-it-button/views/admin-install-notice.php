<?php

/**
 * Show notice after plugin install/activate in admin dashboard until user acknowledges.
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<style>
	#pib-install-notice .button-primary,
	#pib-install-notice .button-secondary {
		margin-left: 15px;
	}
</style>

<div id="pib-install-notice" class="updated">
	<p>
		<?php echo $this->get_plugin_title() . __( ' is now installed.', 'pib' ); ?>
		<a href="<?php echo esc_url( add_query_arg( 'page', $this->plugin_slug, admin_url( 'admin.php' ) ) ); ?>" class="button-primary"><?php _e( 'Setup your Pin It button now', 'pib' ); ?></a>
		<a href="<?php echo esc_url( add_query_arg( 'pib-dismiss-install-nag', 1 ) ); ?>" class="button-secondary"><?php _e( 'Hide this', 'pib' ); ?></a>
	</p>
</div>
