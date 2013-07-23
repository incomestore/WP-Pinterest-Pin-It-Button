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

<div id="pib-install-notice" class="updated">
	<p>
		<span class="pib-installed-text"><?php echo $this->get_plugin_title() . __( ' is now installed.', 'pib' ); ?></span>
		<a href="<?php echo add_query_arg( 'page', $this->plugin_slug, admin_url( 'admin.php' ) ); ?>" class="button-primary"><?php _e( 'Go to Button Setup', 'pib' ); ?></a>
		<a href="#" class="button-secondary"><?php _e( 'Hide this', 'pib' ); ?></a>
	</p>
</div>
