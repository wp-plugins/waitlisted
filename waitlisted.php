<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://waitlisted.co
 * @since             1.0.0
 * @package           waitlisted.co
 *
 * @wordpress-plugin
 * Plugin Name:       waitlisted.co
 * Plugin URI:        http://waitlisted.co
 * Description:       Easily use waitlisted with wordpress.
 * Version:           1.0.0
 * Author:            waitlisted.co
 * Author URI:        http://waitlisted.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       waitlisted
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-waitlisted-activator.php
 */
function activate_waitlisted() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-waitlisted-activator.php';
	Waitlisted_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-waitlisted-deactivator.php
 */
function deactivate_waitlisted() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-waitlisted-deactivator.php';
	Waitlisted_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_waitlisted' );
register_deactivation_hook( __FILE__, 'deactivate_waitlisted' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-waitlisted.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_waitlisted() {

	$plugin = new Waitlisted();
	$plugin->run();

}
run_waitlisted();
