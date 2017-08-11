<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Widgetized_Page_Template {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Widgetized_Page_Template_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'widgetized-page-template';
		$this->version = '1.0.5';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_page_templater_hooks();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Widgetized_Page_Template_Loader. Orchestrates the hooks of the plugin.
	 * - Widgetized_Page_Template_i18n. Defines internationalization functionality.
	 * - Widgetized_Page_Templater. Defines all hooks related to the page template functionality.
	 * - Widgetized_Page_Template_Admin. Defines all hooks for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-widgetized-page-template-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-widgetized-page-template-i18n.php';
		
		/**
		 * The class responsible for defining all actions related to the page template functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-widgetized-page-templater.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-widgetized-page-template-admin.php';

		$this->loader = new Widgetized_Page_Template_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Widgetized_Page_Template_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Widgetized_Page_Template_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}
	
	/**
	 * Register all of the hooks related to the page template functionality
	 * of the plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 */
	private function define_page_templater_hooks() {
		
		$plugin_templater = new Widgetized_Page_Templater( $this->get_plugin_name(), $this->get_version() );
		
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) { // v4.6 and older
			
			// Add a filter to the page attributes metabox to inject our template into the page template cache
			$this->loader->add_filter( 'page_attributes_dropdown_pages_args', $plugin_templater, 'register_plugin_templates' );
			
			// Add a filter to the quick edit menu to inject our template into the page template cache
			$this->loader->add_filter( 'quick_edit_dropdown_pages_args', $plugin_templater, 'register_plugin_templates' );
			
		} else { // v4.7 and above
			
			// Add a filter to the page attributes metabox to inject our template into the page template dropdown
			$this->loader->add_filter( 'theme_page_templates', $plugin_templater, 'add_plugin_templates' );
			
		}

		// Add a filter to the save post in order to inject our template into the page cache
		$this->loader->add_filter( 'wp_insert_post_data', $plugin_templater, 'register_plugin_templates' );

		// Add a filter to the template include in order to determine if the page has our template assigned and return it's path
		$this->loader->add_filter( 'template_include', $plugin_templater, 'view_plugin_template' );
		
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Widgetized_Page_Template_Admin( $this->get_plugin_name(), $this->get_version() );

		// Add a hook to conditionally register widget areas.
		$this->loader->add_action( 'widgets_init', $plugin_admin, 'register_page_widget_area' );
		
		// Add a hook to conditionally remove the page editor.
		$this->loader->add_action( 'init', $plugin_admin, 'remove_page_editor' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Widgetized_Page_Template_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
