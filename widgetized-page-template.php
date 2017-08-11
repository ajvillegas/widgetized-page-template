<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.alexisvillegas.com
 * @since             1.0.0
 * @package           Widgetized_Page_Template
 *
 * @wordpress-plugin
 * Plugin Name:       Widgetized Page Template
 * Plugin URI:        http://www.alexisvillegas.com/plugins/widgetized-page-template
 * Description:       Automatically generate a page-specific widget area that replaces the content of the page when selecting the Widgetized Page template.
 * Version:           1.0.5
 * Author:            Alexis J. Villegas
 * Author URI:        http://www.alexisvillegas.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       widgetized-page-template
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-widgetized-page-template-activator.php
 */
function activate_widgetized_page_template() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-widgetized-page-template-activator.php';
	
	Widgetized_Page_Template_Activator::activate();
	
}

register_activation_hook( __FILE__, 'activate_widgetized_page_template' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-widgetized-page-template.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_widgetized_page_template() {

	$plugin = new Widgetized_Page_Template();
	$plugin->run();

}
run_widgetized_page_template();
