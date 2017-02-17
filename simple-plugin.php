<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.github.com/rahul3883
 * @since             1.0.0
 * @package           Simple_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Plugin
 * Plugin URI:        https://www.github.com/rahul3883/simpleplugin
 * Description:       Support for Simple Theme.
 * Version:           1.0.0
 * Author:            Rahul Soni
 * Author URI:        https://www.github.com/rahul3883
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-plugin-activator.php
 */
function activate_simple_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-plugin-activator.php';
	Simple_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-plugin-deactivator.php
 */
function deactivate_simple_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-plugin-deactivator.php';
	Simple_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_simple_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_plugin() {

	$plugin = new Simple_Plugin();
	$plugin->run();

}
run_simple_plugin();
