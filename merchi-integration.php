<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://graspcorn.com
 * @since             1.0.0
 * @package           Merchi_Integration
 *
 * @wordpress-plugin
 * Plugin Name:       Merchi integration
 * Plugin URI:        https://https://graspcorn.com
 * Description:       This plugin integrates Merchi Product to WordPress or Woocommerce 

 * Version:           1.0.0
 * Author:            Graspcorn
 * Author URI:        https://https://graspcorn.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       merchi-integration
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
define( 'MERCHI_INTEGRATION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-merchi-integration-activator.php
 */
function activate_merchi_integration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-merchi-integration-activator.php';
	Merchi_Integration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-merchi-integration-deactivator.php
 */
function deactivate_merchi_integration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-merchi-integration-deactivator.php';
	Merchi_Integration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_merchi_integration' );
register_deactivation_hook( __FILE__, 'deactivate_merchi_integration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-merchi-integration.php';

/**
 * The core plugin class that is used to define Merchi Plugin Settings,
 * admin-specific hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-merchi-integration-settings.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_merchi_integration() {

	$plugin = new Merchi_Integration();
	$plugin->run();

}
run_merchi_integration();
