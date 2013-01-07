<h1>Genesis Sandbox (Free Version)</h1>

<h2>Installation</h2>
<ol>
    <li>Upload the theme folder via FTP to your wp-content/themes/ directory.</li>
    <li>Go to your WordPress dashboard and select Appearance.</li>
    <li>Be sure to activate the Genesis child theme, and not the Genesis parent theme.</li>
    <li>Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.</li>
</ol>

<h2>Features</h2>
The Free Version of the Genesis Sandbox provides developers with a base theme for quicker child theme development pushing the focus more on CSS and design.

<h3>Functions File (functions.php)</h3>
<p>This file contains the bulk of the heavy lifting for the child theme. In this file, you will find the following:</p>
<ol>
    <li>Content Width</li>
    <li>Structural Wraps</li>
    <li>Featured Image</li>
	<li>Genesis Custom Header</li>
	<li>Footer Widgets</li>
	<li>Top/Footer Navigation</li>
	<li>Customized Footer</li>
	<li>Genesis Responsive</li>
	<li>Scripts</li>
	<li>Editor Style</li>
	<li>Add/Remove Sidebars</li>
	<li>Remove Unused Layouts</li>
	<li>Customize More Links</li>
	<li>Remove Edit Link</li>
	<li>Remove Unused Contact Methods</li>
</ol>

<h3>Initialization File (init.php)</h3>
This file contains the necessary components to dynamically create the necessary constants for the child theme based on changes made in style.css, so that you make the change once, it is made across the site. Constants created are as follows: Data: CHILD_SETTINGS_FIELD (Text Domain with '-settings' added), CHILD_DOMAIN (Text Domain), CHILD_THEME_VERSION (Version), CHILD_THEME_NAME (Theme Name), CHILD_THEME_URL (Theme URI), CHILD_DEVELOPER (Author), and CHILD_DEVELOPER_URL (Author URI).

The directory and URL constants are structural constants made available to the child theme developer. Directories: CHILD_LIB_DIR, CHILD_IMAGES_DIR, CHILD_ADMIN_DIR, CHILD_JS_DIR, CHILD_CSS_DIR; URLs: CHILD_LIB, CHILD_IMAGES, CHILD_ADMIN, CHILD_JS, CHILD_CSS

<h3>Admin Settings File (gs-settings.php)</h3>
This file contains the proper method of adding an Admin page. The footer metabox is a fully working metabox; however, the navigation metabox is simply a sample metabox to be changed by you to add additional options as needed demonstrating how to use the Genesis Admin class.

<h3>Inpost Functions File (gs-inpost-functions.php)</h3>
If you or your client uses WordPresss SEO or All-in-One SEO (or another SEO plugin) plugins, then this file will create a metabox for page specific scripts and page redirection.

<h3>Plugins Folder</h3>
This folder is great for delivering themes to clients, an alternative to mu-plugins, and ensuring clients cannot break themes/sites. So plugins.php is the configuration file that contains some examples for you to use. Please see <a href="http://tgmpluginactivation.com/" target="_blank">TGMPA site</a> for more information. The plugins folder (/lib/plugins/plugins/) is for packaging any private, propriety plugins for the site (e.g., core functionality plugins, etc.).

<h3>Alternative Files (functions-alt.php, init-alt.php, gs-functions-alt.php)</h3>
When I am developing a non-commercialized child theme or a site for a client, I push all functions out of functions.php which enables me to quickly see what the client has done versus what I have done. This makes it easier for me to manage my client, my client's expectations, etc. enabling me to know when something was my fault and when something was their fault. I highly recommend this approach because as we know, our clients never mess anything up and "It just happened."

In essence, the setup function from functions.php is pushed to init.php, and the other functions are pushed to gs-functions.php resulting in the functions-alt.php. This provides a clean slate for the client to do whatever they'd like to their own product. To use this alternative setup, you will need to remove the original functions (e.g., delete functions.php, init.php, and gs-functions.php) and rename the alt functions to the original names (e.g., functions-alt.php -> functions.php, init-alt.php -> init.php, and gs-functions-alt.php -> gs-functions.php). If you do not wish to use these, please delete the *-alt.php files.

<h3>Snippets File</h3>
This file contains the most popular Genesis snippets for copy and paste use. This file includes the following:
<ol>
    <li>Upload the theme folder via FTP to your wp-content/themes/ directory.</li>
    <li>Go to your WordPress dashboard and select Appearance.</li>
    <li>Be sure to activate the Genesis child theme, and not the Genesis parent theme.</li>
    <li>Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.</li>
</ol>

<h2>Support</h2>
Please visit <a href="http://genesissandbox.com/support">Genesis Sandbox</a> for theme support.