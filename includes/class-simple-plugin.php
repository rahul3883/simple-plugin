<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.github.com/rahul3883
 * @since      1.0.0
 *
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/includes
 * @author     Rahul Soni <rahul.soni@rtcamp.com>
 */
class Simple_Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Simple_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'simple-plugin';
		$this->version = '1.0.0';

		$this->set_constants();
		$this->load_dependencies();
		$this->set_locale();

		$this->define_custom_functions();

		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Set constants for the plugin.
	 *
	 * Uses the php core function define() to set constants.
	 *
	 * @since	1.0.0
	 * @access	protected
	 */
	private function set_constants() {

		if ( ! defined( 'SIMPLE_PLUGIN_DIRECTORY' ) ) {
			define( 'SIMPLE_PLUGIN_DIRECTORY', plugin_dir_url( dirname( __FILE__ ) ) );
		}

		if ( ! defined( 'SIMPLE_PLUGIN_PATH' ) ) {
			define( 'SIMPLE_PLUGIN_PATH', plugin_dir_path( dirname( __FILE__ ) ) );
		}

		if ( ! defined( 'SIMPLE_PLUGIN_IMAGE_DIRECTORY' ) ) {
			define( 'SIMPLE_PLUGIN_IMAGE_DIRECTORY', SIMPLE_PLUGIN_DIRECTORY . 'public/images/' );
		}

		if ( ! defined( 'SIMPLE_PLUGIN_SLIDER_LEFT_ARROW' ) ) {
			define( 'SIMPLE_PLUGIN_SLIDER_LEFT_ARROW', SIMPLE_PLUGIN_IMAGE_DIRECTORY . 'arrow-left.png' );
		}

		if ( ! defined( 'SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW' ) ) {
			define( 'SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW', SIMPLE_PLUGIN_IMAGE_DIRECTORY . 'arrow-right.png' );
		}

		if ( ! defined( 'SIMPLE_PLUGIN_SLIDER_LEFT_HOVER_ARROW' ) ) {
			define( 'SIMPLE_PLUGIN_SLIDER_LEFT_HOVER_ARROW', SIMPLE_PLUGIN_IMAGE_DIRECTORY . 'arrow-left-hover.png' );
		}

		if ( ! defined( 'SIMPLE_PLUGIN_SLIDER_RIGHT_HOVER_ARROW' ) ) {
			define( 'SIMPLE_PLUGIN_SLIDER_RIGHT_HOVER_ARROW', SIMPLE_PLUGIN_IMAGE_DIRECTORY . 'arrow-right-hover.png' );
		}

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Simple_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - Simple_Plugin_i18n. Defines internationalization functionality.
	 * - Simple_Plugin_Admin. Defines all hooks for the admin area.
	 * - Simple_Plugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-simple-plugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-plugin-public.php';

		$this->loader = new Simple_Plugin_Loader();

		//add custom widgets
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/widgets/widgets.php' );

		//add custom meta-boxes
		include( plugin_dir_path( dirname( __FILE__ ) ) . '/admin/meta-boxes/meta-boxes.php' );

		//custom functions
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-custom-functions.php' );

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Simple_Plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Simple_Plugin_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	public function define_custom_functions() {

		$custom_functions = new Custom_Functions();

		//add actions for getting slider markup
		$custom_functions->add_action_slider();
		$custom_functions->set_global_variables();

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Simple_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		//sp_get_theme_options must be called before sp_custom_post_type
		$this->loader->add_action( 'init', $plugin_admin, 'sp_custom_post_type' );

		//simple-plugin-menu
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'simple_plugin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'simple_plugin_settings' );
		$this->loader->add_action( 'plugins_loaded', $plugin_admin, 'register_slidermeta_table' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Simple_Plugin_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_slider_scripts_styles' );
		add_shortcode( 'sp_slider', array( $plugin_public, 'sp_slider' ) );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Simple_Plugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
