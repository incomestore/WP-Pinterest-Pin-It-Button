=== Pinterest "Pin It" Button ===
Contributors: pderksen, nickyoung87
Tags: pinterest, pinterest, pin it button, social, social media, image, images, photo, photos, pinterest pin it button, pin it, social button
Requires at least: 3.5.2
Tested up to: 3.6.1
Stable tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a Pinterest "Pin It" Button to your site and get your visitors to start pinning your awesome content!

== Description ==

Add a simple Pinterest "Pin It" Button to your posts in 2 minutes!

###"Pin It" Button Lite Features###

* Let the reader select an image when pinning or...
* Pre-select an image for them to pin.
* Default to the first image in the post or...
* Specify a specific image to pin per post.
* Hide the button on specific posts and pages.
* Add a "Pin It" button to your sidebar or footer as a widget.
* Place "Pin It" buttons anywhere using a shortcode.

###Pro Version Features###

    * Add "Pin It" buttons on image hover (in any corner).
    * Add a "Pin It" button under each image.
    * Pick from 30 custom "Pin It" button designs.
    * Upload your own custom "Pin It" buttons.
    * Twitter, Facebook, Google+ & LinkedIn sharing buttons included.
    * Option to pin featured images.
    * Show or hide on custom post types.
    * WooCommerce compatibility
    * Customer support and automatic updates

[Start Getting Pinned Like Crazy with "Pin It" Button Pro!](http://pinterestplugin.com/pin-it-button-pro/?utm_source=wordpress_org&utm_medium=link&utm_campaign=pin_it_button_lite)

Best of all, you don't need to copy and paste any code to get a "Pin It" button on your WordPress site.

We do the code insertions for you, and in full compliance with the [official "Pin It" button widget builder](http://business.pinterest.com/widget-builder/#do_pin_it_button).

###Raves###

* "The Pinterest 'Pin It' Button is a painless solution for bloggers just getting started with this social network." -- [WP Jedi](http://www.wpjedi.com/pinterest-pin-it-button-for-wordpress/)
* Top 10 Plugins for February 2012 (the only Pinterest one) -- [ManageWP](http://managewp.com/top-10-wordpress-plugins-of-the-month-february)
* "If you want to make it easy for Pinterest users to pin your articles, consider using this 'Pin It' button plugin." -- [WP Tavern](http://www.wptavern.com/pin-it-is-the-new-bookmark)
* "If you're looking for something simple and obtrusive, the Pinterest 'Pin It' Button will suit you." -- [WPMU.org](http://wpmu.org/pinterest-plugins-wordpress/)

[See a "Pin It" Button Pro Demo](http://bruisesandbandaids.com/2011/newborn-photography-props/) (shows off the share bar and image hover features)

[Setup an Eye-Catching Button in Minutes with "Pin It" Button Pro!](http://pinterestplugin.com/pin-it-button-pro/?utm_source=wordpress_org&utm_medium=link&utm_campaign=pin_it_button_lite)

This plugin (and the Pro version) are in full compliance with current "Pin It" button developer guidelines at <http://developers.pinterest.com/pin_it/>.

We will do our best to keep both plugins up to date with the official developer guidelines.

== Installation ==

You can install this plugin one of three ways:

= 1. Admin Search =
1. In your Admin, go to menu Plugins > Add.
1. Search for `pin it button`.
1. Find the plugin that's labeled `Pinterest "Pin It" Button` with "Pin It" in quotes.
1. Look for the author names **Phil Derksen & Nick Young** on the plugin.
1. Click to install.
1. Activate the plugin.
1. A new menu item `Pin It Button` will appear in your Admin.

= 2. Download & Upload =
1. Download the plugin (.zip file) on the right column of this page.
1. In your Admin, go to menu Plugins > Add.
1. Select the tab "Upload".
1. Upload the .zip file you just downloaded.
1. Activate the plugin.
1. A new menu item `Pin It Button` will appear in your Admin.

= 3. FTP Upload =
1. Download the plugin (.zip file) on the right column of this page.
1. Unzip the zip file contents.
1. Upload the `pinterest-pin-it-button` folder to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. A new menu item `Pin It Button` will appear in your Admin.

== Frequently Asked Questions ==

= General Troubleshooting =

If the "Pin It" button doesn't get triggered on click (and your browser is redirected to a pinterest.com URL), please make sure that there is not extra code that is hijacking the click event (for example, a Google Analytics onclick event).

A popular known plugin that does this is **Google Analytics for WordPress**. Try unchecking one or both of these options: 1) Track outbound clicks & downloads, 2) Check Advanced Settings, then make sure "Track outbound clicks as pageviews" is un-checked.

Your theme must implement **wp_footer()** in the footer.php file, otherwise JavaScript will not load correctly. You can test if this is the issue by switching to a WordPress stock theme such as twenty-twelve temporarily.

[Visit the complete knowledgebase](http://pinterestplugin.com/pin-it-button-faq?utm_source=wordpress_org&utm_medium=link&utm_campaign=pin_it_button_lite) for additional help and troubleshooting tips.

CSS styling and shortcode help available within the plugin admin.

== Screenshots ==

1. Button display with count bubble beside
2. Button display with count bubble above
3. General button settings
4. Post visibility and placement settings
5. Style/CSS settings
6. Widget settings
7. Individual post (post meta) settings

== Changelog ==

= 2.0.0 =

* Tested up to WordPress 3.6.1.
* Now in full compliance with current "Pin It" button developer guidelines at http://developers.pinterest.com/pin_it/.
* More extensive Help section, which was moved to a separate submenu item.
* Updated CSS & JS output so they're much more "light weight" which should improve performance.
* Removed all references to "!important" in public CSS to allow for more control of styles.
* Implemented more standards from the WordPress Settings API. Settings pages should be more maintainable going forward.
* Settings pages now using tabs to break up functionality.
* Can now specify button type for shortcode and widget. No longer inherits from main settings.
* Fixed so button now shows up on category pages.
* Added is_main_query() check for "the_content" filter.
* Removed show/hide button options on category edit screen (conflicted with post/page visibility changes).
* Optional Presstrends anonymous usage tracking.

= 1.4.3 =
* Fixed bug where Create Pin popup wasn't working in some cases.

= 1.4.2 =
* Tested with WordPress 3.5.
* Added: Option to save settings upon plugin uninstall.
* Changed: Removed "Always show pin count" option as it's no longer supported by Pinterest.
* Changed: Iframe option removed as it's no longer supported by Pinterest.
* Changed: Moved some JavaScript files to load in the footer rather than the header to improve page speed load and compatibility with Pinterest code. Theme must implement wp_footer() to function properly.
* Fixed: Count="vertical" shortcode fixed.
* Fixed: Updated button CSS/styles to improve compatibility with more themes.
* Fixed: Checks theme support for post thumbnails and adds if needed.
* Fixed: Various minor bug fixes.

= 1.4.1 =
* Fixed: Various shortcode fixes.
* Fixed: Moved some JavaScript files that were loaded in the footer to now load in the header to improve compatibility with themes not implementing wp_footer().
* Fixed: Updated button CSS/styles to improve compatibility with more themes.

= 1.4.0 =
* Changed/Fixed: Iframe removed when button set to "User selects image". Fixes security issues and display errors on some web hosts.
* Added: Displays new features available if upgrading "Pin It" Button Pro

= 1.3.1 =
* Changed: Modified button JavaScript to be in line with Pinterest's current button embed JavaScript
* Changed: Split up internal code files for easier maintenance and updates
* Fixed: Shortcode -- If the attributes "url", "image_url" and/or "description" aren't specified, it will try and use the post's custom page url, image url and/or description if found. If not found it will default to the post's url, first image in post and post title.
* Fixed: Changed the way defaults are set upon install so it shouldn't override previous settings
* Fixed: Uninstall now removes custom post meta fields

= 1.3.0 =
* Added: Added a Pin Count option (horizontal or vertical)
* Added: Added new button style where image is pre-selected (like official Pinterest button)
* Added: Added fields for specifying URL, image URL and description for new button style **image pre-selected**
* Added: Added float option for alignment (none, left or right) to widget and shortcode
* Added: Shortcode -- Can now remove div tag wrapper
* Added: Widget -- Can now remove div tag wrapper
* Changed: Moved "Follow" button widget to separate plugin: [Pinterest "Follow" Button](http://wordpress.org/extend/plugins/pinterest-follow-button/)
* Changed: Both button styles now embed iframe (like official Pinterest button)
* Changed: External JavaScript now loads in footer for better performance
* Fixed: Fixed bug where front page was still showing button even when Front Page was unchecked
* Fixed: Fixed bug where some settings weren't saved when upgrading the plugin
* Fixed: Fixed bug where tag, author, date and search archive pages were not displaying the button

= 1.2.1 =
* Fixed: Fixed bug with hiding posts/pages/categories when upgrading from a previous version

= 1.2.0 =
* Added: Added option to hide button per page/post
* Added: Added option to hide button per category
* Added: Added widget to display "Pin It" button
* Added: Added widget to display "Follow" on Pinterest button
* Fixed: Fixed CSS where some blogs weren't displaying the button properly

= 1.1.3 =
* Added: Added option to hide button on individual posts and pages (on post/page editing screen)

= 1.1.2 =
* Fixed: Removed use of session state storing for now as it caused errors for some

= 1.1.1 =
* Fixed: Updated jQuery coding method to avoid JavaScript conflicts with other plugins and themes some were getting

= 1.1.0 =
* Added: Added custom CSS area for advanced layout and styling
* Added: Added checkbox option to remove the button's surrounding `<div>` tag
* Added: Button image and style updated to match Pinterest's current embed code
* Fixed: Changed the way the button click is called to solve pinning issues in Internet Explorer

= 1.0.2 =
* Added: Added checkbox option to display/hide button on post excerpts
* Fixed: "Pin It" links generated by the shortcode should not show up when viewing the post in RSS readers

= 1.0.1 =
* Added: Added checkbox option to display/hide button on "front page" (sometimes different than home page)

= 1.0.0 =
* Added: Added checkbox options to select what types of pages the button should appear on
* Added: Display options above and below content are now checkboxes (one or both can be selected)
* Added: Added shortcode [pinit] to display button within content

= 0.1.2 =
* Changed: Moved javascript that fires on button click to a separate file

= 0.1.1 =
* Fixed style sheet reference

= 0.1.0 =
* Initial release
