<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.github.com/rahul3883
 * @since      1.0.0
 *
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/admin
 * @author     Rahul Soni <rahul.soni@rtcamp.com>
 */
class Simple_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function sp_custom_post_type() {

		register_post_type( 'sp_slider', [
			'labels'        => [
				'name'			=> __( 'Slider', 'blank-theme' ),
				'singular_name'	=> __( 'Slider', 'blank-theme' ),
			],
			'supports'      => [ 'title', 'editor', 'thumbnail' ],
			'public'        => true,
			'has_archive'   => true,
		] );

		register_post_type( 'sp_portfolio', [
			'labels'		=> [
				'name'			=> __( 'Portfolio', 'blank-theme' ),
				'singular_name'	=> __( 'Portfolio', 'blank-theme' ),
				'add_new'		=> __( 'Add New Portfolio', 'blank-theme' ),
			],
			'supports'		=> [ 'title', 'editor', 'thumbnail' ],
			'public'		=> true,
			'has_archive'	=> true,
		] );

		register_post_type( 'sp_team', [
			'labels'		=> [
				'name'			=> __( 'The Team', 'blank-theme' ),
				'singular_name'	=> __( 'Member', 'blank-theme' ),
				'add_new'		=> __( 'Add New Member', 'blank-theme' ),
			],
			'supports'		=> [ 'title', 'excerpt', 'thumbnail' ],
			'public'		=> true,
			'has_archive'	=> true,
		] );

		register_post_type( 'sp_testimonials', [
			'labels'        => [
				'name'			=> __( 'Testimonials', 'blank-theme' ),
				'singular_name'	=> __( 'Testimonial', 'blank-theme' ),
			],
			'supports'	    => [ 'excerpt' ],
			'public'	    => true,
			'has_archive'   => true,
		] );

	}

	function simple_plugin_settings() {

		add_settings_section(
			'slick_slider',
			__( 'Slick Slider', 'simple-plugin' ),
			array( $this, 'slick_slider_callback' ),
			'simple_plugin_options'
		);

		add_settings_field(
			'enable_slider',
			__( 'Toggle', 'simple-plugin' ),
			array( $this, 'enable_slick_slider_callback' ),
			'simple_plugin_options',
			'slick_slider',
			array(
				'Enable slider',
			)
		);

		register_setting(
			'simple_plugin_options',
			'simple_plugin_options'
		);

	}

	function slick_slider_callback() {
		?>

		<p>Manage Slick Slider setting from below options</p>

		<?php
	}

	function enable_slick_slider_callback( $args ) {

		$options = get_option( 'simple_plugin_options' );
		?>

		<input type="checkbox" id="enable_slider" name="simple_plugin_options[enable_slider]" value="1" <?php checked( 1, isset( $options['enable_slider'] ) ? $options['enable_slider'] : false, true ); ?>>
		<label for="enable_slider"><?php echo $args[0]; ?></label>

		<?php
	}

	/*
	public function sp_hello() {
		?>

		<p id="sp_hello">Hey!</p>

		<?php
	}
	public function sp_hello_css() {
		?>

		<style type="text/css">
			#sp_hello{
				font-size: 10px;
			}
		</style>

		<?php
	}
	*/

	function simple_plugin_menu() {

		add_menu_page(
			__( 'Simple Plugin Options', 'simple-plugin' ),
			__( 'Simple Plugin', 'simple-plugin' ),
			'administrator',
			'simple_plugin_menu',
			array( $this, 'simple_plugin_menu_display' )
		);

		/*
		add_submenu_page(
			'simple_plugin_menu',
			__( 'Simple Plugin Options', 'simple-plugin' ),
			__( 'Options', 'simple-plugin' ),
			'administrator',
			'simple-plugin-submenu-options',
			array( $this, 'simple_plugin_submenu_options' )
		);
		add_plugins_page(
			__( 'Simple Plugin', 'simple-plugin' ),
			__( 'Simple Plugin', 'simple-plugin' ),
			'administrator',
			'simple-plugin-menu',
			array( $this, 'simple_plugin_menu_display' )
		);
		*/

	}

	function simple_plugin_menu_display() {
		?>

		<div class="wrap">

			<h2>Simple Plugin</h2>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">

				<?php settings_fields( 'simple_plugin_options' ); ?>
				<?php do_settings_sections( 'simple_plugin_options' ); ?>
				<?php submit_button() ?>

			</form>

		</div>

		<?php
	}

	/*
	function simple_plugin_submenu_options() {
		?>

		<div class="wrap">
			<h2>Simple Plugin Options</h2>
		</div>

		<?php
	}
	*/

	public function register_slidermeta_table() {

		global $wpdb;
		$wpdb->slidermeta = $wpdb->prefix . 'slidermeta';

	}
}
