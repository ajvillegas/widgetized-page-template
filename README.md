# Widgetized Page Template

Automatically widgetize any page when using the Genesis Framework.

**Contributors**: [ajvillegas](http://profiles.wordpress.org/ajvillegas)  
**Tags**: [widgetize page](http://wordpress.org/plugins/tags/widgetize-page), [widgets in page](http://wordpress.org/plugins/tags/widgets-in-page), [widgets](http://wordpress.org/plugins/tags/widgets), [admin](http://wordpress.org/plugins/tags/admin), [page-template](http://wordpress.org/plugins/tags/page-template), [genesis](http://wordpress.org/plugins/tags/genesis)  
**Requires at least**: 4.5  
**Tested up to**: 5.5  
**Stable tag**: 1.1.0  
**License**: [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

## Description

This plugin will automatically generate a page-specific widget area that replaces the content of the page when selecting the 'Widgetized Page' template. **Requires the Genesis Framework**.

You can add support for [Genesis structural wraps](http://my.studiopress.com/documentation/snippets/structural-wraps/add-structural-wraps/) when using the 'Widgetized Page' template along with the full-width Genesis page layout option. The following example shows how you can implement this on your theme:

```php
<?php
// Add structural wrap to page widget area section
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer', 'site-inner', 'page-widget-area' ) );
```

## Installation

### Using The WordPress Dashboard

1. Navigate to the 'Add New' Plugin Dashboard
2. Click on 'Upload Plugin' and select `widgetized-page-template.zip` from your computer
3. Click on 'Install Now'
4. Activate the plugin on the WordPress Plugins Dashboard

### Using FTP

1. Extract `widgetized-page-template.zip` to your computer
2. Upload the `widgetized-page-template` directory to your `wp-content/plugins` directory
3. Activate the plugin on the WordPress Plugins Dashboard

## Screenshots

*Page editor screen*
![Page editor screen](wp-assets/screenshot-1.png?raw=true)

## Changelog

### 1.1.0

* The page widget area output is now automatically saved to `post_content` in the database for improved indexing and site search.
* Code and syntax fixes to ensure compatibility with latest WordPress version.
* Added Spanish translations.

### 1.0.5

* Fixed bug where page template was breaking search results and prevented them from displaying correctly.

### 1.0.4

* Added a live edit button to the page editor screen that automatically redirects to the page widget area section in the Customizer.

### 1.0.3

* Removed previous version's compatibility issue fix (no longer needed with Genesis v2.5.2).

### 1.0.2

* Fixed compatibility issue with Genesis v2.5.1.

### 1.0.1

* Added support for WordPress v4.7 and above.

### 1.0.0

* Initial release.

## Upgrade Notice

**1.0.3**  
The previous compatibility issue fix is no longer needed with Genesis v2.5.2 and it was removed from the plugin to ensure full compatibility once again. Make sure to update Genesis to the latest version.
