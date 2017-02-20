<?php

class Custom_Functions {

	function __construct() {

	}

	public function add_action_slider() {

		add_action( 'wp_ajax_get_main_slider_content', array( $this, 'get_main_slider_content' ) );
		add_action( 'wp_ajax_nopriv_get_main_slider_content', array( $this, 'get_main_slider_content' ) );

		add_action( 'wp_ajax_get_testimonials_content', array( $this, 'get_testimonials_content' ) );
		add_action( 'wp_ajax_nopriv_get_testimonials_content', array( $this, 'get_testimonials_content' ) );

	}

	public function get_main_slider_content() {
		ob_start();
		include( SIMPLE_PLUGIN_PATH . 'public/partials/sp-main-slider.php' );
		echo ob_get_clean();
		die();
	}

	public function get_testimonials_content() {
		ob_start();
		include( SIMPLE_PLUGIN_PATH . 'public/partials/sp-testimonials.php' );
		echo ob_get_clean();
		die();
	}

	public function get_weather_data( $city = 'London' ) {

		$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid=477d852b98fa6ed45c92423a4f53b9a7&units=metric";

		if ( false === ( $weather_data = wp_cache_get( "weather_data_{$city}", 'weather' ) ) ) {

			$response = wp_remote_get( $url );
			if ( is_wp_error( $response ) ) {
				return false;
			} else {
				$weather_data = $response['body'];
				wp_cache_set( "weather_data_{$city}", $weather_data, 'weather', HOUR_IN_SECONDS );
			}
		}
		return json_decode( $weather_data );

	}

	public static function display_pre( $data, $die = true ) {
		?>
		<pre>
			<?php print_r( $data ); ?>
		</pre>
		<?php
		if ( $die ) {
			die();
		}
	}
}
