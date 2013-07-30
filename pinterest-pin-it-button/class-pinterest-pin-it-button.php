<?php

/**
 * Main Pinterest_Pin_It_Button class
 *
 * @package PIB
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

class Pinterest_Pin_It_Button {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   2.0.0
	 *
	 * @var     string
	 */
	protected $version = '2.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    2.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'pinterest-pin-it-button';

	/**
	 * Instance of this class.
	 *
	 * @since    2.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    2.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     2.0.0
	 */
	private function __construct() {
		// Setup constants.
		$this->setup_constants();

		// Run our upgrade checks first and update our version option.
		add_action( 'init', array( $this, 'upgrade_plugin' ), 0 );
		update_option( 'pib_version', $this->version );

		// Include required files.
		add_action( 'init', array( $this, 'includes' ), 1 );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );
		
		// Enqueue admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Enqueue public style and scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add admin notice after plugin activation. Also check if should be hidden.
		add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );

		// Add Post Meta stuff.
		add_action( 'add_meta_boxes', array( $this, 'display_post_meta') );
		add_action( 'save_post', array( $this, 'save_meta_data') );

		// Add plugin listing "Settings" action link.
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_slug . '.php' ), array( $this, 'settings_link' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     2.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Setup plugin constants.
	 *
	 * @since     2.0.0
	 */
	private function setup_constants() {
		// Plugin slug.
		if ( ! defined( 'PIB_PLUGIN_SLUG' ) )
			define( 'PIB_PLUGIN_SLUG', $this->plugin_slug );

		// Plugin version.
		if ( ! defined( 'PIB_VERSION' ) )
			define( 'PIB_VERSION', $this->version );

		// Plugin title.
		if ( ! defined( 'PIB_PLUGIN_TITLE' ) )
			define( 'PIB_PLUGIN_TITLE', $this->get_plugin_title() );
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    2.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		// Add value to indicate that we should show admin install notice.
		update_option( 'pib_show_admin_install_notice', 1 );
	}

	/**
	 * Run upgrade plugin process.
	 *
	 * @since     2.0.0
	 */
	public function upgrade_plugin() {
		include_once( 'includes/upgrade-plugin.php' );
	}

	/**
	 * Include required files (admin and frontend).
	 *
	 * @since     2.0.0
	 */
	public function includes() {
		// Load global options.
		global $pib_options;

		// Include the file to register all of the plugin settings.
		include_once( 'includes/register-settings.php' );

		// Load global options settings.
		$pib_options = pib_get_settings();

		// Include widgets file if on widgets admin or public.
		include_once( dirname( __FILE__ ) . '/includes/widgets.php' );

		// Other common includes.
		include_once( 'includes/misc-functions.php' );

		// Admin-only includes.
		if ( is_admin() ) {
			include_once( 'includes/admin-notices.php' );
		} else {
			// Frontend-only includes.
			include_once( 'includes/shortcodes.php' );
			include_once( 'views/public.php' );
		}
	}

	/**
	 * Return localized base plugin title.
	 *
	 * @since     2.0.0
	 *
	 * @return    string
	 */
	public static function get_plugin_title() {
		return __( 'Pinterest "Pin It" Button Lite', 'pib' );
	}

	/**
	 * Enqueue admin-specific style sheets for this plugin's admin pages only.
	 *
	 * @since     2.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( $this->viewing_this_plugin() ) {
			// Plugin admin custom Bootstrap CSS. Tack on plugin version.
			wp_enqueue_style( $this->plugin_slug .'-bootstrap', plugins_url( 'css/bootstrap-custom.css', __FILE__ ), array(), $this->version );

			// Plugin admin custom Flat UI CSS. Tack on plugin version.
			wp_enqueue_style( $this->plugin_slug .'-flat-ui', plugins_url( 'css/flat-ui-custom.css', __FILE__ ), array( $this->plugin_slug .'-bootstrap' ), $this->version );

			// Plugin admin CSS. Tack on plugin version.
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array( $this->plugin_slug .'-flat-ui' ), $this->version );
		}
	}

	/**
	 * Enqueue admin-specific JavaScript.
	 *
	 * @since     2.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( $this->viewing_this_plugin() ) {
			// Main plugin admin JS. Tackon plugin version.
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
		}
	}

	/**
	 * Enqueue public-facing style sheets.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {
		global $pib_options;

		// Check to see if setting to disable is true first.
		if ( empty( $pib_options['disable_css'] ) ) {
			wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), $this->version );
		}
	}

	/**
	 * Enqueues public-facing script files.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {
		// Enqueue Pinterest JS plugin boilerplate style. Don't tack on plugin version.
		wp_enqueue_script( $this->plugin_slug . '-pinterest-pinit', '//assets.pinterest.com/js/pinit.js', array(), null, true );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    2.0.0
	 */
	public function add_plugin_admin_menu() {
		// Add main menu item
		$this->plugin_screen_hook_suffix[] = add_menu_page(
			$this->get_plugin_title() . __( ' Settings', 'pib' ),
			__( 'Pin It Button', 'pib' ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' ),
			plugins_url( 'assets/pinterest-icon-16.png', __FILE__ )
		);
		
		// Add Help submenu page
		$this->plugin_screen_hook_suffix[] = add_submenu_page(
			$this->plugin_slug,
			$this->get_plugin_title() . __( ' Help', 'pib' ),
			__( 'Help', 'pib' ),
			'manage_options',
			$this->plugin_slug . '_help',
			array( $this, 'display_admin_help_page' )
		);
	}

	/**
	 * Render the admin pages for this plugin.
	 *
	 * @since    2.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}
	
	public function display_admin_help_page() {
		include_once( 'views/admin-help.php' );
	}

	/**
	 * Render the post meta for this plugin.
	 *
	 * @since    2.0.0
	 */
	public function display_post_meta() {
		// Add the meta boxes for both posts and pages
		add_meta_box('pib-meta', '"Pin It" Button Settings', 'add_meta_form', 'post', 'advanced', 'high');
		add_meta_box('pib-meta', '"Pin It" Button Settings', 'add_meta_form', 'page', 'advanced', 'high');
	
		// function to output the HTML for meta box
		function add_meta_form( $post ) {
			
			wp_nonce_field( basename( __FILE__ ), 'pib_meta_nonce' );
			
			include_once( 'views/post-meta-display.php' );
		}
	}
	
	/**
	 * Save the post meta for this plugin.
	 *
	 * @since    2.0.0
	 *
	 * @param   int  $post_id
	 * @return  int  $post_id
	 */
	public function save_meta_data( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		
		// An array to hold all of our post meta ids so we can run them through a loop
		$post_meta_fields = array(
			'pib_url_of_webpage',
			'pib_url_of_img',
			'pib_description'
		);

		// Record sharing disable
		if ( isset( $_POST['post_type'] ) && ( 'post' == $_POST['post_type'] || 'page' == $_POST['post_type'] ) ) {
			if ( current_user_can( 'edit_post', $post_id ) ) {
				if ( isset( $_POST['pib_sharing_status_hidden'] ) ) {
					if ( !isset( $_POST['pib_enable_post_sharing'] ) ) {
						update_post_meta( $post_id, 'pib_sharing_disabled', 1 );
					}
					else {
						delete_post_meta( $post_id, 'pib_sharing_disabled' );
					}
					
					// Loop through our array and make sure it is posted and not empty in order to update it, otherwise we delete it
					foreach ( $post_meta_fields as $pmf ) {
						if ( isset( $_POST[$pmf] ) && !empty( $_POST[$pmf] ) ) {
							update_post_meta( $post_id, $pmf, $_POST[$pmf] );
						} else {
							delete_post_meta( $post_id, $pmf );
						}
					}
				}
			}
		}

		return $post_id;
	}

	/**
	 * Add Settings action link to left of existing action links on plugin listing page.
	 *
	 * @since   2.0.0
	 *
	 * @param   array  $links  Default plugin action links.
	 * @return  array  $links  Amended plugin action links.
	 */
	public function settings_link( $links ) {
		$setting_link = sprintf( '<a href="%s">%s</a>', add_query_arg( 'page', $this->plugin_slug, admin_url( 'admin.php' ) ), __( 'Settings', 'pib' ) );
		array_unshift( $links, $setting_link );

		return $links;
	}

	/**
	 * Check if viewing one of this plugin's admin pages.
	 *
	 * @since   2.0.0
	 *
	 * @return  bool
	 */
	private function viewing_this_plugin() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) )
			return false;

		$screen = get_current_screen();

		if ( in_array( $screen->id, $this->plugin_screen_hook_suffix ) )
			return true;
		else
			return false;
	}

	/**
	 * Show notice after plugin install/activate in admin dashboard until user acknowledges.
	 * Also check if user chooses to hide it.
	 *
	 * @since   2.0.0
	 */
	public function admin_install_notice() {
		// Exit all of this is stored value is false/0 or not set.
		if ( false == get_option( 'pib_show_admin_install_notice' ) )
			return;

		// Delete stored value if "hide" button click detected (custom querystring value set to 1).
		// or if on a PIB admin page. Then exit.
		if ( ! empty( $_REQUEST['pib-dismiss-install-nag'] ) || $this->viewing_this_plugin() ) {
			delete_option( 'pib_show_admin_install_notice' );
			return;
		}

		// At this point show install notice.
		include_once( 'views/admin-install-notice.php' );
	}
}
