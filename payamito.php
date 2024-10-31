<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://payamito.com/
 * @since             1.0.0
 * @package           Payamito
 * @wordpress-plugin
 * Plugin Name:       Payamito core
 * Description:       Payamito core plugin
 * Version:           1.0.0
 * Author:            payamito
 * Author URI:        https://payamito.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       payamito
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PAYAMITO_VERSION', '1.1.0' );

define( 'PAYAMITO_DIR', plugin_dir_path( __FILE__ ) );
define( 'PAYAMITO_ADMIN', PAYAMITO_DIR . 'admin/' );
define( 'PAYAMITO_INCLUDES', PAYAMITO_DIR . 'includes/' );
define( 'PAYAMITO_URL', plugins_url( '', __FILE__ ) );
define( 'PAYAMITO_BASENAME', plugin_basename( __FILE__ ) );

$GLOBALS['payamito_prefix_option'] = 'payamito';


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-payamito-activator.php
 */
function activate_payamito() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-payamito-activator.php';
	Payamito_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-payamito-deactivator.php
 */
function deactivate_payamito() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-payamito-deactivator.php';
	Payamito_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_payamito' );
register_deactivation_hook( __FILE__, 'deactivate_payamito' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-payamito.php';

/**
 * getting path from out of plugin
 */
function get_path_payamito() {
	return plugin_dir_path( __FILE__ );
}

/*
 * return  prefix  payamito
 */
function get_option_prefix_payamito() {
	$payamito_prefix = 'payamito';

	return $payamito_prefix;
}


/**
 * Begins execution of the plugin.
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_payamito() {

	$plugin = new Payamito();
	$plugin->run();

}

run_payamito();
do_action( 'payamito_loaded' );
