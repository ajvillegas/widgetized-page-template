<?php

/**
 * The page template functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/admin
 */

/**
 * The page template functionality of the plugin.
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Widgetized_Page_Templater {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * The array of templates that this plugin tracks.
	 *
	 * @since    1.0.0
	 * @var      array
	 */
	protected $templates;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name		The name of this plugin.
	 * @param    string    $version			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		$this->templates = array();
		
		// Add page templates to this array
		$this->templates = array(
			'page_widgetized.php' => __( 'Widgetized Page', 'widgetized-page-template' ),
		);

		// Add support for theme templates to be merged and shown in dropdown
		$templates = wp_get_theme()->get_page_templates();
		$templates = array_merge( $templates, $this->templates );

	}
	
	/**
 	 * Add our template to the page dropdown in the
 	 * attributes metabox in v4.7 and above.
 	 *
 	 * @param	 array    $page_templates    Page templates.
 	 * @return	 array    $page_templates    Modified page templates array.
 	 *
 	 * @since    1.0.1
 	 *
 	 */
	public function add_plugin_templates( $page_templates ) {
		
    	$page_templates = array_merge( $page_templates, $this->templates );
    	
    	return $page_templates;
    	
	}
	
	/**
	 * Add our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 * @param	 array    $atts    The attributes for the page attributes dropdown.
	 * @return	 array    $atts    The attributes for the page attributes dropdown.
	 *
	 * @author	 Tom McFarlin <tom@tommcfarlin.com>
	 * @since    1.0.0
	 */
	public function register_plugin_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list. If it doesn't exist, or it's empty prepare an array
		$templates = wp_cache_get( $cache_key, 'themes' );
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// Since we've updated the cache, we need to delete the old cache
		wp_cache_delete( $cache_key , 'themes' );

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}
	
	/**
	 * Checks if the template is assigned to the page.
	 *
	 * @author	Tom McFarlin <tom@tommcfarlin.com>
	 * @since	1.0.0
	 */
	public function view_plugin_template( $template ) {

		global $post;

		// If no posts found, return to
		// avoid "Trying to get property of non-object" error
		if ( !isset( $post ) ) {
			return $template;
		}

		if ( !isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
			return $template;
		}

		$file = plugin_dir_path( __DIR__ ) . 'templates/' . get_post_meta( $post->ID, '_wp_page_template', true );

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		}

		return $template;

	}

}
