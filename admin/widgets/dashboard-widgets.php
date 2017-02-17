<?php

function sp_add_dashboard_widgets() {

	add_meta_box(
		'weather_dashboard_widget',
		__( 'Weather', 'simple-plugin' ),
		'sp_weather_dashboard_widget_callback',
		'dashboard',
		'side',
		'high'
	);

}

add_action( 'wp_dashboard_setup', 'sp_add_dashboard_widgets' );

function sp_weather_dashboard_widget_callback() {

	$custom_functions = new Custom_Functions();
	$city = 'Pune';
	if ( false === ( $weather_data = $custom_functions->get_weather_data( $city ) ) ) {
		?>

		<p>Sorry! Something went wrong, try again later...</p>

		<?php
	} else {

		$weather_main = $weather_data->main;
		?>

		<p>
			<label for="sp_weather_city"><?php _e( 'City', 'simple-plugin' ); ?>:</label>
			<span id="sp_weather_city"><?php echo $city; ?></span>
		</p>

		<p>
			<label for="sp_weather_temp"><?php _e( 'Temp', 'simple-plugin' ); ?>:</label>
			<span id="sp_weather_temp"><?php echo $weather_main->temp; ?> &deg;C</span>
		</p>

		<p>
			<label for="sp_weather_pressure"><?php _e( 'Pressure', 'simple-plugin' ); ?>:</label>
			<span id="sp_weather_pressure"><?php echo $weather_main->pressure; ?> hPa</span>
		</p>

		<p>
			<label for="sp_weather_humidity"><?php _e( 'Humidity', 'simple-plugin' ); ?>:</label>
			<span id="sp_weather_humidity"><?php echo $weather_main->humidity; ?> %</span>
		</p>

		<p>
			<label for="sp_weather_temp_min"><?php _e( 'Min. Temp', 'simple-plugin' ); ?>:</label>
			<span id="sp_weather_temp_min"><?php echo $weather_main->temp_min; ?> &deg;C</span>
		</p>

		<p>
			<label for="sp_weather_temp_max"><?php _e( 'Max. Temp', 'simple-plugin' ); ?>:</label>
			<span id="sp_weather_temp_max"><?php echo $weather_main->temp_max; ?> &deg;C</span>
		</p>

		<?php
	}

}
