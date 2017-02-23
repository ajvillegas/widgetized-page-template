<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class Widgetized_Page_Template_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name		The name of this plugin.
	 * @param    string    $version			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Conditionally register widget areas.
	 *
	 * This function selects pages that are using the 'Widgetized Page' template
	 * before generating a page-specific widget area using the post ID.
	 *
	 * @since	1.0.0
	 */
	public function register_page_widget_area() {
		
		global $wp_query;
		
		// Select pages using the 'Widgetized Page' template
		$args = array(
		    'post_type' => 'page',
		    'meta_key' => '_wp_page_template',
			'meta_value' => 'page_widgetized.php',
			'post_status' => 'any',
			'orderby' => 'name',
			'order' => 'ASC',
			'posts_per_page' => -1, // unlimited, so it doesn't limit the number of widget areas that can be generated
			'no_found_rows' => true, // no need for pagination, so skip it altogether
			'cache_results' => false, // bypass the extra caching queries to speed up the query process
		);
		
		$the_query = new WP_Query( $args );
		
		foreach ( $the_query->posts as $query ) {
			
			$page_id = 'page-widget-area-' . $query->ID;
			$page_title = $query->post_title;
			
			// Limit widget title length without breaking a word
			if ( mb_strlen( $page_title, 'utf8' ) > 22 ) {
			   $last_space = strrpos( substr( $page_title, 0, 22 ), ' ' ); // find the last space within 22 characters
			   $widget_title = substr( $page_title, 0, $last_space ) . '...';
			} else {
				$widget_title = $page_title;
			}
			
			// Register widget area
			if ( $page_title && function_exists( 'genesis_register_sidebar' ) ) {
				genesis_register_sidebar( array(
					'id'            => $page_id,
					'name'          => __( 'Page', 'widgetized-page-template' ) . ' - ' . $widget_title,
					'description'   => sprintf( __( 'This is the "%s" page widget area.', 'widgetized-page-template' ), $page_title ),
				) );
			}
			
		}
		
		// Reset post data
		wp_reset_postdata();
	
	}
	
	/**
	 * Conditionally remove the editor.
	 *
	 * This function removes the page editor from the edit post screen when
	 * the 'Widgetized Page' template is being used.
	 *
	 * @since	1.0.0
	 */
	public function remove_page_editor() {
		
		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : isset( $_POST['post_ID'] ); // get the post ID
		$page_template = get_post_meta( $post_id, '_wp_page_template', true );
		
		if( !isset( $post_id ) || !class_exists( 'Genesis_Admin_Boxes' ) )
			return;
	
		if ( 'page_widgetized.php' == $page_template ) {
			
			// Remove the editor
			remove_post_type_support( 'page', 'editor' );
			
			// Add admin notice
			add_action( 'edit_form_after_title', array( $this, 'add_admin_notice' ) );
			
		}
			
	}
	
	/**
	 * Add admin notice to page edit screen.
	 *
	 * @since	1.0.0
	 */
	public function add_admin_notice() {
		
		$url_text = __('Widgets', 'widgetized-page-template');
		
		echo '<div class="notice notice-warning inline"><p>' . sprintf( __('You are currently editing a Widgetized Page template. To edit the contents of this page, go to the %s page and edit its corresponding widget area.', 'widgetized-page-template'), '<a href="' . admin_url( 'widgets.php' ) . '">' . $url_text . '</a>' ) . '</p></div>';

	}

}
