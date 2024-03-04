<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https:///github.com/EsubalewAmenu
 * @since             1.0.0
 * @package           Cscg
 *
 * @wordpress-plugin
 * Plugin Name:       CSCG - Cardano Smart Contract Generator 
 * Plugin URI:        https://datascienceplc.com/cscg
 * Description:       Smart contract generator for Cardano
 * Version:           1.0.0
 * Author:            Esubalew A
 * Author URI:        https:///github.com/EsubalewAmenu/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cscg
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
define( 'CSCG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cscg-activator.php
 */
function activate_cscg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cscg-activator.php';
	Cscg_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cscg-deactivator.php
 */
function deactivate_cscg() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cscg-deactivator.php';
	Cscg_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cscg' );
register_deactivation_hook( __FILE__, 'deactivate_cscg' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cscg.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cscg() {

	$plugin = new Cscg();
	$plugin->run();

}
run_cscg();
