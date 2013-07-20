<?php

/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

global $pib_options;
$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';

// Additional div containers and CSS classes to keep fluid layout with right sidebar.
?>

<div class="wrap">

	<div id="pib-settings">
		<div id="pib-settings-content">

			<?php screen_icon( 'pib-icon32' ); ?>
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<h2 class="nav-tab-wrapper">
				<a href="<?php echo add_query_arg( 'tab', 'general', remove_query_arg( 'settings-updated' )); ?>" class="nav-tab
					<?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e( 'General', 'pib' ); ?></a>
				<a href="<?php echo add_query_arg( 'tab', 'post_visibility', remove_query_arg( 'settings-updated' )); ?>" class="nav-tab
					<?php echo $active_tab == 'post_visibility' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Post Visibility', 'pib' ); ?></a>
				<a href="<?php echo add_query_arg( 'tab', 'styles', remove_query_arg( 'settings-updated' )); ?>" class="nav-tab
					<?php echo $active_tab == 'styles' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Styles', 'pib' ); ?></a>
			</h2>

			<div id="tab_container">

				<form method="post" action="options.php">
					<?php
					if ( $active_tab == 'general' ) {
						settings_fields( 'pib_settings_general' );
						do_settings_sections( 'pib_settings_general' );
					} elseif ( $active_tab == 'post_visibility' ) {
						settings_fields( 'pib_settings_post_visibility' );
						do_settings_sections( 'pib_settings_post_visibility' );
					} elseif ( $active_tab == 'styles' ) {
						settings_fields( 'pib_settings_styles' );
						do_settings_sections( 'pib_settings_styles' );
					} else {
						// Do nothing
					}

					submit_button();
					?>
				</form>
			</div><!-- #tab_container-->

		</div><!-- #pib-settings-content -->

		<div id="pib-settings-sidebar">
			<?php include( 'admin-sidebar.php' ); ?>
		</div>
	</div>

</div><!-- .wrap -->
