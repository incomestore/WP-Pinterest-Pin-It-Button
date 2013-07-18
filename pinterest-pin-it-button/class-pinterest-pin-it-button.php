<?php

/**
 * Main Pinterest_Pin_It_Button class
 *
 * @package PIB
 * @author  Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
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

		
		// Run our upgrade checks first and update our version option
		add_action( 'init', array( $this, 'upgrade' ), 1 );
		update_option( 'pib_version', $this->version );
		
		// Initialize the settings. This needs to have priority over adding the admin page or the admin page will come up blank.
		add_action( 'init', array( $this, 'initialize_settings' ), 2 );
		
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );
		
		// Load the admin notices.
		add_action( 'init', array( $this, 'add_notices' ) );

		// Enqueue admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Enqueue public style and scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add Post Meta stuff.
		add_action( 'add_meta_boxes', array( $this, 'display_post_meta') );
		add_action( 'save_post', array( $this, 'save_meta_data') );
		
		// Load public facing code.
		add_action( 'init', array( $this, 'public_display' ) );
		
		// Load the shortcode code.
		add_action( 'init', array( $this, 'pib_shortcode' ) );
		
		// Load widget.
		add_action( 'widgets_init', array( $this, 'pib_widget' ) );

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
		if ( in_array( $screen->id, $this->plugin_screen_hook_suffix ) ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), $this->version );
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
		if ( in_array( $screen->id, $this->plugin_screen_hook_suffix ) ) {
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
		if( empty( $pib_options['disable_css'] ) ) {
			wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), $this->version );
		}
	}

	/**
	 * Enqueues public-facing script files.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {
		// Enqueue Pinterest JS plugin boilerplate style. Don't set a version.
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
			plugins_url( 'assets/pinterest-button-icon-small.png', __FILE__ )
		);
		
		// Add Help submenu page
		$this->plugin_screen_hook_suffix[] = add_submenu_page(
			$this->plugin_slug,
			$this->get_plugin_title() . __( ' Help', 'pib' ),
			__( 'Help', 'pib' ),
			'manage_options',
			$this->plugin_slug . '_help',
			array( $this, 'display_help_page' )
		);
		
		// Add Upgrade to Pro submenu page
		$this->plugin_screen_hook_suffix[] = add_submenu_page(
			$this->plugin_slug,
			__( 'Upgrade to Pinterest "Pin It" Button Pro', 'pib' ),
			__( 'Upgrade to Pro', 'pib' ),
			'manage_options',
			$this->plugin_slug . '_upgrade_to_pro',
			array( $this, 'display_upgrade_to_pro' )
		);
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
					foreach( $post_meta_fields as $pmf ) {
						if( isset( $_POST[$pmf] ) && !empty( $_POST[$pmf] ) ) {
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
	 * Add Settings action link to left of existing action links on plugin listing page.
	 *
	 * @since   2.0.0
	 *
	 * @param   array  $links  Default plugin action links
	 * @return  array  $links  Amended plugin action links
	 */
	public function settings_link( $links ) {

		$setting_link = sprintf( '<a href="%s">%s</a>', add_query_arg( array( 'page' => $this->plugin_slug ), admin_url( 'admin.php' ) ), __( 'Settings', 'pib' ) );
		array_unshift( $links, $setting_link );

		return $links;
	}

	
	function add_notices() {
		include_once( 'views/notices.php' );
	}
}
