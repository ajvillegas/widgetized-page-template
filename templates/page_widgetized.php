<?php
/**
 * Template Name: Widgetized Page
 *
 * This file displays the page-specific widget area.
 *
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 * @since      1.0.0
 *
 * @package    Widgetized_Page_Template
 * @subpackage Widgetized_Page_Template/templates
 */

/**
 * Check for Genesis to avoid any errors if deactivated.
 *
 * @since 1.0.0
 **/
if ( ! class_exists( 'Genesis_Admin_Boxes' ) ) {

	get_header();

	get_footer();

} else {

	add_filter( 'body_class', 'wpt_plugin_add_body_class' );
	/**
	 * Adds a unique class to the body element.
	 *
	 * @since  1.0.0
	 * @param  array $classes An array representing the classes currently applied to the body class attribute.
	 * @return array $classes The updated array signifying the classes we wish to add to the body class attribute.
	 */
	function wpt_plugin_add_body_class( $classes ) {

		$classes[] = 'widgetized-page';

		return $classes;

	}

	/**
	 * Display the widget area content.
	 *
	 * @since 1.0.0
	 **/
	function wpt_plugin_page_widget_area() {

		global $post;

		$sidebar_id = 'page-widget-area-' . $post->ID;

		if ( is_active_sidebar( $sidebar_id ) ) {
			dynamic_sidebar( $sidebar_id );
		}

	}

	// Get the Genesis page layout.
	$site_layout = genesis_site_layout();

	if ( is_singular() && 'full-width-content' === $site_layout ) {

		/**
		 * Custom Genesis header markup.
		 *
		 * @since 1.0.0
		 **/
		function wpt_plugin_genesis_header() {

			do_action( 'genesis_doctype' );
			do_action( 'genesis_title' );
			do_action( 'genesis_meta' );

			wp_head(); // We need this for plugins.

			?>
			</head>
			<?php
			genesis_markup(
				array(
					'html5'   => '<body %s>',
					'xhtml'   => sprintf( '<body class="%s">', implode( ' ', get_body_class() ) ),
					'context' => 'body',
				)
			);

			do_action( 'genesis_before' );

			genesis_markup(
				array(
					'html5'   => '<div %s>',
					'xhtml'   => '<div id="wrap">',
					'context' => 'site-container',
				)
			);

			do_action( 'genesis_before_header' );
			do_action( 'genesis_header' );
			do_action( 'genesis_after_header' );

			genesis_markup(
				array(
					'html5'   => '<div %s>',
					'xhtml'   => '<div id="page-widget-area" class="page-widget-area">',
					'context' => 'page-widget-area',
				)
			);

			genesis_structural_wrap( 'page-widget-area' );
		}

		/**
		 * Custom Genesis footer markup.
		 *
		 * @since 1.0.0
		 **/
		function wpt_plugin_genesis_footer() {

			genesis_structural_wrap( 'page-widget-area', 'close' );
			echo '</div>'; // End .page-widget-area or #page-widget-area.

			do_action( 'genesis_before_footer' );
			do_action( 'genesis_footer' );
			do_action( 'genesis_after_footer' );

			echo '</div>'; // End .site-container or #wrap.

			do_action( 'genesis_after' );
			wp_footer(); // We need this for plugins.

			?>
			</body>
			</html>
			<?php

		}

		add_filter( 'genesis_attr_page-widget-area', 'wpt_plugin_page_widget_area_attributes' );
		/**
		 * Add attributes to .page-widget-area.
		 *
		 * @since  1.0.0
		 * @author Alexis J. Villegas <alexis@ajvillegas.com>
		 * @author Bill Erickson <bill.erickson@gmail.com>
		 * @param  array $attributes Existing attributes.
		 * @return array $attributes Amended attributes.
		 */
		function wpt_plugin_page_widget_area_attributes( $attributes ) {

			// Add .page-widget-area class.
			$attributes['class'] = 'page-widget-area';

			// Add inline styles to .page-widget-area.
			$attributes['style'] = 'max-width: 100%;';

			// Add the attributes from .entry, since this replaces the main entry.
			$attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

			return $attributes;

		}

		wpt_plugin_genesis_header();

			wpt_plugin_page_widget_area();

		wpt_plugin_genesis_footer();

	} elseif ( is_singular() ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'wpt_plugin_page_widget_area' );

		add_filter( 'genesis_attr_content', 'wpt_plugin_content_attributes' );
		/**
		 * Add attributes to .content.
		 *
		 * @since  1.0.0
		 * @author Alexis J. Villegas <alexis@ajvillegas.com>
		 * @author Bill Erickson <bill.erickson@gmail.com>
		 * @param  array $attributes Existing attributes.
		 * @return array $attributes Amended attributes.
		 */
		function wpt_plugin_content_attributes( $attributes ) {

			// Add .page-widget-area class to .content.
			$attributes['class'] .= ' page-widget-area';

			// Add the attributes from .entry, since this replaces the main entry.
			$attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

			return $attributes;

		}

		genesis();

	} elseif ( is_search() ) {

		require_once get_template_directory() . '/search.php';

	}
}
