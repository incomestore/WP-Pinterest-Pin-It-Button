<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package PIB
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license GPL-2.0+
 * @link    http://pinterestplugin.com
 * @copyright 2011-2013 Phil Derksen
 */
?>
<div class="wrap">
	<?php
		global $pib_options;
		
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
	?>
	<?php screen_icon( 'edit' ); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<h2 class="nav-tab-wrapper">
		<a href="<?php echo add_query_arg( 'tab', 'general', remove_query_arg( 'settings-updated' )); ?>" class="nav-tab
			<?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e( 'General', 'pib' ); ?></a>
		<a href="<?php echo add_query_arg( 'tab', 'post_visibility', remove_query_arg( 'settings-updated' )); ?>" class="nav-tab
			<?php echo $active_tab == 'post_visibility' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Post Visibility', 'pib' ); ?></a>
		<a href="<?php echo add_query_arg( 'tab', 'styles', remove_query_arg( 'settings-updated' )); ?>" class="nav-tab
			<?php echo $active_tab == 'styles' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Styles', 'pib' ); ?></a>
		<a href="<?php echo add_query_arg( 'tab', 'misc', remove_query_arg( 'settings-updated' )); ?>" class="nav-tab
			<?php echo $active_tab == 'misc' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Misc', 'pib' ); ?></a>
	</h2>

	<div id="tab_container">
		<?php // TODO settings_errors(); ? ?>

		<form method="post" action="options.php">
			<?php
			if ( $active_tab == 'general' ) {
				settings_fields( 'pib_settings_general' );
				do_settings_sections( 'pib_settings_general' );
			} elseif ( $active_tab == 'post_visibility' ) {
				settings_fields( 'pib_settings_post_visibility' );
				do_settings_sections( 'pib_settings_post_visibility' );
			} elseif ( $active_tab == 'styles' ) {
				settings_fields('pib_settings_styles' );
				do_settings_sections('pib_settings_styles' );
			} else {
				settings_fields( 'pib_settings_misc' );
				do_settings_sections( 'pib_settings_misc' );
			}

			submit_button();
			?>
		</form>
	</div><!-- #tab_container-->
</div><!-- .wrap -->
