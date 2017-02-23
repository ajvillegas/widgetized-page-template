<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Widgetized_Page_Template_Deactivator {

	/**
	 * Deactivate the plugin.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate( $network_wide ) {
		
		foreach( $this as $value ) {
			
			widgetized-page-template::delete_cache( $value );
			
		}

	}
	
	/**
	 * Delete the old cache.
	 *
	 * @since    1.0.0
	 */
	public function delete_cache() {
		
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		wp_cache_delete( $cache_key, 'themes' );
		
	}

}
