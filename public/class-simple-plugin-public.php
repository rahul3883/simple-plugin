<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.github.com/rahul3883
 * @since      1.0.0
 *
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/public
 * @author     Rahul Soni <rahul.soni@rtcamp.com>
 */
class Simple_Plugin_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-plugin-public.js', array( 'jquery' ), $this->version, false );

	}

	public function enqueue_slider_scripts_styles() {

		if ( $this->is_slider_enabled() ) {
			wp_enqueue_style( 'simple-plugin-slick-style', plugin_dir_url( __FILE__ ) . 'css/vendor/_slick.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'simple-plugin-fancybox-style', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'simple-plugin-slider-style', plugin_dir_url( __FILE__ ) . 'css/sp-slider.css', array(), $this->version, 'all' );

			wp_enqueue_script( 'simple-plugin-slick-script', plugin_dir_url( __FILE__ ) . 'js/vendor/slick.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( 'simple-plugin-fancybox-script', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js', array( 'jquery' ), $this->version, true );

			wp_register_script( 'simple-plugin-slider-script', plugin_dir_url( __FILE__ ) . 'js/simple-plugin-slider.js', array( 'jquery' ), $this->version, true );

			$ajax_testimonials_url = add_query_arg(
				array(
					'action' => 'get_testimonials_content',
				),
				admin_url( 'admin-ajax.php' )
			);

			$ajax_sliders_count_url = add_query_arg(
				array(
					'action' => 'get_sliders_count',
				),
				admin_url( 'admin-ajax.php' )
			);

			wp_localize_script( 'simple-plugin-slider-script', 'main_slider', array( 'ajax_url' => esc_url( $ajax_main_slider_url ) ) );
			wp_localize_script( 'simple-plugin-slider-script', 'testimonials_slider', array( 'ajax_url' => esc_url( $ajax_testimonials_url ) ) );
			wp_enqueue_script( 'simple-plugin-slider-script' );

		}

	}

	public function sp_slider( $atts, $content, $tag ) {

		$id		= isset( $atts['id'] ) ? $atts['id'] : '';
		$slug	= isset( $atts['slug'] ) ? $atts['slug'] : '';

		if ( empty( $id ) && empty( $slug ) ) {
			$this->sp_sliders_all();
			return;
		}

		switch ( $id ) {
			case 1:
				$this->sp_main_slider();
				return;
			case 2:
				$this->sp_testimonials_slider();
				return;
		}

		switch ( $slug ) {
			case 'main':
				$this->sp_main_slider();
				return;
			case 'testimonials':
				$this->sp_testimonials_slider();
				return;
			default:
				$this->sp_sliders_all();
				return;
		}

	}

	public function sp_sliders_all() {

		if ( post_type_exists( 'sp_slider' ) && $this->is_slider_enabled() ) {
			ob_start();
			include( SIMPLE_PLUGIN_PATH . 'public/partials/sp-slider-all.php' );
			$ob_contents = ob_get_contents();
			return $ob_contents;
		}

	}

	public function sp_main_slider() {

		if ( post_type_exists( 'sp_slider' ) && $this->is_slider_enabled() ) {
			ob_start();
			include( SIMPLE_PLUGIN_PATH . 'public/partials/sp-main-slider.php' );
			$ob_contents = ob_get_contents();
			return $ob_contents;
		}

	}

	public function sp_testimonials_slider() {

		if ( post_type_exists( 'sp_testimonials' ) && $this->is_slider_enabled() ) {
			ob_start();
			include( SIMPLE_PLUGIN_PATH . 'public/partials/sp-testimonials.php' );
			$ob_contents = ob_get_contents();
			return $ob_contents;
		}

	}

	public function is_slider_enabled() {

		$options = get_option( 'simple_plugin_options' );
		return isset( $options['enable_slider'] ) && true == $options['enable_slider'];

	}
}
