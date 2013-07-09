<?php
/**
 * Main Pinterest_Pin_It_Button class
 *
 * @package		PIB
 * @author		Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */
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
		// TODO Load plugin text domain -- Translation not implemented for initial release.
		// TODO add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		// TODO Add file /lang/pinterest-pin-it-button.pot, uncomment load_plugin_textdomain below.
		
		// Do upgrade if we need to
		if ( !get_option( 'pib_version' ) ) {
			add_option( 'pib_version', $this->version );
		} else {
			// Create an option to use while we go through the upgrade process, this is deleted immediately after we are finished upgrading
			add_option( 'pib_old_version', get_option( 'pib_version' ) );
			
			// Only if the old version is less than the new version do we run our upgrade code
			if( version_compare( get_option( 'pib_old_version' ), $this->version, '<' ) ) {
				add_action( 'init', array( $this, 'upgrade' ), 1 );
			}
			// update the current plugin version
			update_option( 'pib_version', $this->version );
		}
		
		// Initialize the settings. This needs to have priority over adding the admin page or the admin page will come up blank.
		add_action( 'init', array( $this, 'initialize_settings' ), 1 );
		
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );
		
		// Load the admin notices
		add_action( 'init', array( $this, 'add_notices' ) );

		// Enqueue admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Enqueue public style and scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
		// Add Post Meta stuff
		add_action( 'add_meta_boxes', array( $this, 'display_post_meta') );
		add_action( 'save_post', array( $this, 'save_meta_data') );
		
		// Load public facing code
		add_action( 'init', array( $this, 'public_display' ) );
		
		// Load the shortcode code
		add_action( 'init', array( $this, 'pib_shortcode' ) );
		
		// Load widget
		add_action( 'widgets_init', array( $this, 'pib_widget' ) );

		// Add plugin listing "Settings" and other action links
		add_filter( 'plugin_action_links', array( $this, 'add_action_link' ), 10, 2 );

		// Define custom functionality. Read more about actions and filters: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		// TODO add_action( 'TODO', array( $this, 'action_method_name' ) );
		// TODO add_filter( 'TODO', array( $this, 'filter_method_name' ) );
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
	 * Fired when the plugin is activated.
	 *
	 * @since    2.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		// TODO: Define activation functionality here
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    2.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		// TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 * // TODO Translation not implemented for initial release
	 *
	 * @since    2.0.0
	 */
	/*
	public function load_plugin_textdomain() {
		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}
	*/

	/**
	 * Enqueue admin-specific style sheets.
	 *
	 * @since     2.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $screen->id == $this->plugin_screen_hook_suffix ) {
			//TODO Not using admin.css yet
			//wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), $this->version );
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

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $screen->id == $this->plugin_screen_hook_suffix ) {
			//TODO Not using admin.js yet
			//wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
		}

	}

	/**
	 * Enqueue public-facing style sheets.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), $this->version );
	}

	/**
	 * Enqueues public-facing script files.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {
		//TODO Not using public.js yet
		//wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array( 'jquery' ), $this->version );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    2.0.0
	 */
	public function add_plugin_admin_menu() {

		// Add as main menu item
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Pinterest "Pin It" Button Lite Settings', $this->plugin_slug ),
			__( 'Pin It Button', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);
		
		// Add help menu page
		add_submenu_page( $this->plugin_slug, __( 'Help', 'pib' ), __( 'Help', 'pib' ), 'manage_options', $this->plugin_slug . '_help', array( $this, 'display_help_page' ) );
		
		// Add Upgrade to Pro page
		add_submenu_page( $this->plugin_slug, __( 'Upgrade to Pro', 'pib' ), __( 'Upgrade to Pro', 'pib' ), 'manage_options', $this->plugin_slug . '_upgrade_to_pro', array( $this, 'display_upgrade_to_pro' ) );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    2.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}
	
	public function display_help_page() {
		include_once( 'views/help.php' );
	}
	
	public function display_upgrade_to_pro() {
		include_once( 'views/upgrade-to-pro.php' );
	}
	
	/**
	 * Render the post meta for this plugin.
	 *
	 * @since    2.0.0
	 */
	function display_post_meta() {
		
		// Add the meta boxes for both posts and pages
		add_meta_box('pib-meta', '"Pin It" Button Settings', 'add_meta_form', 'post', 'advanced', 'high');
		add_meta_box('pib-meta', '"Pin It" Button Settings', 'add_meta_form', 'page', 'advanced', 'high');
	
		// function to output the HTML for meta box
		function add_meta_form( $post ) {
			
			wp_nonce_field( basename( __FILE__ ), 'pib_meta_nonce' );
			
			include( 'views/post-meta-display.php' );
		}
	}
	
	/**
	 * Save the post meta for this plugin.
	 *
	 * @since    2.0.0
	 */
	function save_meta_data( $post_id ) {
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
			return $post_id;

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

					if ( isset( $_POST['pib_url_of_webpage'] ) && isset( $_POST['pib_url_of_img'] ) && isset( $_POST['pib_description'] )) {
						update_post_meta( $post_id, 'pib_url_of_webpage', $_POST['pib_url_of_webpage'] );
						update_post_meta( $post_id, 'pib_url_of_img', $_POST['pib_url_of_img'] );
						update_post_meta( $post_id, 'pib_description', $_POST['pib_description'] );
					}					
					else {
						delete_post_meta( $post_id, 'pib_url_of_webpage' );
						delete_post_meta( $post_id, 'pib_url_of_img' );
						delete_post_meta( $post_id, 'pib_description' );
					}
				}
			}
		}

		return $post_id;
	}
	
	/**
	 * Load public facing code
	 *
	 * @since    2.0.0
	 */
	function public_display() {
		include( 'views/public.php' );
	}
	
	/**
	 * Load shortcode
	 *
	 * @since    2.0.0
	 */
	function pib_shortcode() {
		include( 'views/shortcode.php' );
	}
	
	
	/**
	 * Add widget
	 *
	 * @since    2.0.0
	 */
	function pib_widget() {
		include( 'views/widget.php' );
		
		register_widget( 'PIB_Widget' );
	}

	/**
	 * Initialize settings.
	 *
	 * @since    2.0.0
	 */
	public function initialize_settings() {
		// Load global PIB options
		global $pib_options;
		
		// Include the file to register all of the plugin settings
		include_once( 'views/register-settings.php' );
		
		// Load global options settings
		$pib_options = pib_get_settings();
		
	}

	public function upgrade() {
		include( 'views/upgrade.php' );
	}

	/**
	 * Add plugin listing "Settings" and other action links
	 *
	 * @since    1.0.0
	 */
	function add_action_link( $links, $file ) {
		static $this_plugin;
		if ( empty( $this_plugin ) ) $this_plugin = $this->plugin_slug . '/' . $this->plugin_slug . '.php';
		if ( $file == $this_plugin ) {
			$settings_link = '<a href="' . admin_url( 'options-general.php?page='  . $this->plugin_slug ) . '">' . __( 'Settings', 'pib' ) . '</a>';
			array_unshift( $links, $settings_link );
		}
		return $links;
	}
	
	function add_notices() {
		include_once( 'views/notices.php' );
	}
}
