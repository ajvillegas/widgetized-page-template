=== Widgetized Page Template ===
Contributors: ajvillegas
Donate link:
Tags: admin, page-template, genesis
Requires at least: 4.5
Tested up to: 4.8
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically widgetize any page when using the Genesis Framework.

== Description ==

This plugin will automatically generate a page-specific widget area that replaces the content of the page when selecting the 'Widgetized Page' template. **Requires the Genesis Framework**.

You can add support for [Genesis structural wraps](http://my.studiopress.com/documentation/snippets/structural-wraps/add-structural-wraps/) when using the 'Widgetized Page' template along with the full-width Genesis page layout option. The following example shows how you can implement this on your theme:

`// Add structural wrap to page widget area section
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer', 'site-inner', 'page-widget-area' ) );`

== Installation ==

### Using The WordPress Dashboard

1. Navigate to the 'Add New' Plugin Dashboard
2. Click on 'Upload Plugin' and select `widgetized-page-template.zip` from your computer
3. Click on 'Install Now'
4. Activate the plugin on the WordPress Plugins Dashboard

### Using FTP

1. Extract `widgetized-page-template.zip` to your computer
2. Upload the `widgetized-page-template` directory to your `wp-content/plugins` directory
3. Activate the plugin on the WordPress Plugins Dashboard

== Screenshots ==

1. Page editor screen

== Changelog ==

= 1.0.5 =
* Fixed bug where page template was breaking search results and prevented them from displaying correctly.

= 1.0.4 =
* Added a live edit button to the page editor screen that automatically redirects to the page widget area section in the Customizer.

= 1.0.3 =
* Removed previous version's compatibility issue fix (no longer needed with Genesis v2.5.2).

= 1.0.2 =
* Fixed compatibility issue with Genesis v2.5.1.

= 1.0.1 =
* Added support for WordPress v4.7 and above.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.3 =
The previous compatibility issue fix is no longer needed with Genesis v2.5.2 and it was removed from the plugin to ensure full compatibility once again. Make sure to update Genesis to the latest version.
