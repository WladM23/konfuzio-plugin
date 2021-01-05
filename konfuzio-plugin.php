<?php

/**

 * @since             1.0.0
 * @package           Konfuzio_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Konfuzio Plugin
 * Plugin URI:        http://example.com/konfuzio-plugin-uri/
 * Version:           0.1.2
 * Author:            Wladislav Miretski
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       konfuzio-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

function activate_konfuzio_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-konfuzio-plugin-activator.php';
	Konfuzio_Plugin_Activator::activate();
}

function deactivate_konfuzio_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-konfuzio-plugin-deactivator.php';
	Konfuzio_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_konfuzio_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_konfuzio_plugin' );

require plugin_dir_path( __FILE__ ) . 'includes/class-konfuzio-plugin.php';

function run_konfuzio_plugin() {

	$plugin = new Konfuzio_Plugin();
	$plugin->run();

}

run_konfuzio_plugin();
