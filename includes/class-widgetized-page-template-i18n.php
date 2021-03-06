<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Widgetized_Page_Template_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'widgetized-page-template',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
