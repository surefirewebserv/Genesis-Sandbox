# Genesis Sandbox (Free Version)

## Installation
1. Upload the theme folder via FTP to your wp-content/themes/ directory.
2. Go to your WordPress dashboard and select Appearance.
3. Be sure to activate the Genesis child theme, and not the Genesis parent theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

## Features
The Free Version of the Genesis Sandbox provides developers with a base theme for quicker child theme development pushing the focus more on CSS and design.

### Functions File (functions.php)
This file contains the bulk of the heavy lifting for the child theme. In this file, you will find the following:

1. Content Width
2. Structural Wraps
3. Featured Image
4. Genesis Custom Header
5. Footer Widgets
6. Top/Footer Navigation
7. Customized Footer
8. Genesis Responsive
9. Scripts
10. Editor Style
11. Add/Remove Sidebars
12. Remove Unused Layouts
13. Customize More Links
14. Remove Edit Link
15. Remove Unused Contact Methods

### Initialization File (init.php)
This file contains the necessary components to dynamically create the necessary constants for the child theme based on changes made in style.css, so that you make the change once, it is made across the site. Constants created are as follows: Data: CHILD_SETTINGS_FIELD (Text Domain with '-settings' added), CHILD_DOMAIN (Text Domain), CHILD_THEME_VERSION (Version), CHILD_THEME_NAME (Theme Name), CHILD_THEME_URL (Theme URI), CHILD_DEVELOPER (Author), and CHILD_DEVELOPER_URL (Author URI).

The directory and URL constants are structural constants made available to the child theme developer. Directories: CHILD_LIB_DIR, CHILD_IMAGES_DIR, CHILD_ADMIN_DIR, CHILD_JS_DIR, CHILD_CSS_DIR; URLs: CHILD_LIB, CHILD_IMAGES, CHILD_ADMIN, CHILD_JS, CHILD_CSS

### Admin Settings File (gs-settings.php)
This file contains the proper method of adding an Admin page. The footer metabox is a fully working metabox; however, the navigation metabox is simply a sample metabox to be changed by you to add additional options as needed demonstrating how to use the Genesis Admin class.

### Inpost Functions File (gs-inpost-functions.php)
If you or your client uses WordPresss SEO or All-in-One SEO (or another SEO plugin) plugins, then this file will create a metabox for page specific scripts and page redirection.

### Plugins Folder
This folder is great for delivering themes to clients, an alternative to mu-plugins, and ensuring clients cannot break themes/sites. So plugins.php is the configuration file that contains some examples for you to use. Please see [TGMPA site](http://tgmpluginactivation.com/) for more information. The plugins folder (/lib/plugins/plugins/) is for packaging any private, propriety plugins for the site (e.g., core functionality plugins, etc.).

### Alternative Files (functions-alt.php, init-alt.php, gs-functions-alt.php)
When I am developing a non-commercialized child theme or a site for a client, I push all functions out of functions.php which enables me to quickly see what the client has done versus what I have done. This makes it easier for me to manage my client, my client's expectations, etc. enabling me to know when something was my fault and when something was their fault. I highly recommend this approach because as we know, our clients never mess anything up and "It just happened."

In essence, the setup function from functions.php is pushed to init.php, and the other functions are pushed to gs-functions.php resulting in the functions-alt.php. This provides a clean slate for the client to do whatever they'd like to their own product. To use this alternative setup, you will need to remove the original functions (e.g., delete functions.php, init.php, and gs-functions.php) and rename the alt functions to the original names (e.g., functions-alt.php -> functions.php, init-alt.php -> init.php, and gs-functions-alt.php -> gs-functions.php). If you do not wish to use these, please delete the *-alt.php files.

### Snippets File
This file contains the most popular Genesis snippets for copy and paste use. 

1. Layout
2. Favicon
3. Remove Genesis in-post metaboxes
4. Remove Genesis Admin Menus
5. Genesis Style Selector
6. Body & Post Classes
7. Author Boxes
8. Post Info & Post Meta
9. Customize Links
   * Next/Previous Links
   * Newer/Older Links
10. Search Customizations
11. Google Fonts
12. Remove Genesis Site Title, Site Description, & Header Right
13. Reposition Items: Breadcrumbs, Footer, Primary & Secondary Navs
14. Remove Genesis/WordPress widgets
15. Remove Superfish
16. Enqueue jQuery from Google CDN with Fallback
17. CSS Cache Buster
18. Genesis Theme Settings
19. Alternative Doctype
20. Intermediate Image Sizes
21. Genesis Slider
22. Avatars

## Support
Please visit [Genesis Sandbox](http://genesissandbox.com/support) for theme support.