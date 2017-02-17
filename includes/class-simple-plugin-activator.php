<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.github.com/rahul3883
 * @since      1.0.0
 *
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Simple_Plugin
 * @subpackage Simple_Plugin/includes
 * @author     Rahul Soni <rahul.soni@rtcamp.com>
 */
class Simple_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;

		$query = "CREATE TABLE IF NOT EXISTS `wp_slidermeta` ( `meta_id` bigint(20) NOT NULL AUTO_INCREMENT, `slider_id` bigint(20) NOT NULL DEFAULT '0', `meta_key` varchar(255) DEFAULT NULL, `meta_value` longtext,PRIMARY KEY (`meta_id`), KEY `slider_id` (`slider_id`), KEY `meta_key` (`meta_key`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
		$wpdb->query(
			$wpdb->prepare( $query )
		);

		if ( false == get_option( 'simple_plugin_options' ) ) {
			add_option( 'simple_plugin_options' );
		}

		$defaults = array(
			'enable_slider'	=> true,
		);

		$options = wp_parse_args( get_option( 'simple_plugin_options' ), $defaults );

		update_option( 'simple_plugin_options', $options );

	}
}
