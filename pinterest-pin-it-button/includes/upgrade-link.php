<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function pib_upgrade_link()
{
    $page_hook = add_submenu_page( 
				PIB_PLUGIN_SLUG, 
				__( 'Upgrade to Pro', 'pib' ), 
				__( 'Upgrade to Pro', 'pib' ), 
				'manage_options', 
				PIB_PLUGIN_SLUG . '-upgrade', 
				'pib_upgrade_redirect'
			);
	
    add_action( 'load-' . $page_hook , 'pib_upgrade_ob_start' );
}
add_action( 'admin_menu', 'pib_upgrade_link' );

function pib_upgrade_ob_start() {
    ob_start();
}

function pib_upgrade_redirect()
{
    wp_redirect( pib_ga_campaign_url( PINPLUGIN_BASE_URL, 'pib_lite_2', 'plugin_menu', 'pro_upgrade' ), 301 );
    exit();
}

function pib_upgrade_link_js()
{
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function ($) {
            $('a[href="admin.php?page=pinterest-pin-it-button-upgrade"]').on('click', function () {
        		$(this).attr('target', '_blank');
            });
        });
    </script>
    <?php 
}
add_action( 'admin_footer', 'pib_upgrade_link_js' );
