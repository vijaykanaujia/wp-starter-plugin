<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bytescrum.com/
 * @since             1.0.0
 * @package           Fordtodealers
 *
 * @wordpress-plugin
 * Plugin Name:       fordtodealers modal manager
 * Plugin URI:        https://bytescrum.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            sanjay singh
 * Author URI:        https://bytescrum.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fordtodealers
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FORDTODEALERS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fordtodealers-activator.php
 */
function activate_fordtodealers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fordtodealers-activator.php';
	Fordtodealers_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fordtodealers-deactivator.php
 */
function deactivate_fordtodealers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fordtodealers-deactivator.php';
	Fordtodealers_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fordtodealers' );
register_deactivation_hook( __FILE__, 'deactivate_fordtodealers' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fordtodealers.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_fordtodealers() {

	$plugin = new Fordtodealers();
	$plugin->run();

}
run_fordtodealers();

function ao_check_cookie() {
	if ( is_admin() ) {
        return;
    }
	global $wpdb;
	$table = $wpdb->prefix.'fortodealers_modal_list';
	$rows = $wpdb->get_results( "SELECT * FROM {$table}");
	
	echo "<script>";
	foreach ( $rows as $row ) 
	{
		echo 'changeModalPrice("'.$row->modal_class.'","'.$row->price.'");';
	}
	echo "</script>";
	
}
add_action( 'get_footer', 'ao_check_cookie' );
