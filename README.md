# Widgetized Page Template

Automatically widgetize any page when using the Genesis Framework.

**Contributors**: [ajvillegas](http://profiles.wordpress.org/ajvillegas)  
**Tags**: [admin](http://wordpress.org/plugins/tags/admin), [page-template](http://wordpress.org/plugins/tags/page-template)  
**Requires at least**: 4.5  
**Tested up to**: 4.7.2  
**Stable tag**: 1.0.1  
**License**: [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

# Description

This plugin will automatically generate a page-specific widget area that replaces the content of the page when selecting the 'Widgetized Page' template. **Requires the Genesis Framework**.

You can add support for [Genesis structural wraps](http://my.studiopress.com/documentation/snippets/structural-wraps/add-structural-wraps/) when using the 'Widgetized Page' template along with the full-width Genesis page layout option. The following example shows how you can implement this on your theme:

```php
// Add structural wrap to page widget area section
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer', 'site-inner', 'page-widget-area' ) );
```

# Installation

### Using The WordPress Dashboard

1. Navigate to the 'Add New' Plugin Dashboard
2. Click on 'Upload Plugin' and select `widgetized-page-template.zip` from your computer
3. Click on 'Install Now'
4. Activate the plugin on the WordPress Plugins Dashboard

### Using FTP

1. Extract `widgetized-page-template.zip` to your computer
2. Upload the `widgetized-page-template` directory to your `wp-content/plugins` directory
3. Activate the plugin on the WordPress Plugins Dashboard

# Changelog

**1.0.1**
* Added support for WordPress v4.7 and above.

**1.0.0**
* Initial release.
