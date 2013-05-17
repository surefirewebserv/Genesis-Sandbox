<?php 

/**
 * Snippets file.
 *
 * Contains the most popular Genesis snippets used.
 *
 * @category   Genesis_Sandbox
 * @package    Functions
 * @subpackage Snippets
 * @author     Travis Smith and Jonathan Perez
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */


/* Table of Contents

   01 Layout
   02 Favicon
   03 Remove Genesis in-post metaboxes
   04 Remove Genesis Admin Menus
   05 Genesis Style Selector
   06 Body & Post Classes
   07 Author Boxes
   08 Post Info & Post Meta
   09 Customize Links
      -Next/Previous Links
      -Newer/Older Links
   10 Search Customizations
   11 Google Fonts
   12 Remove Genesis Site Title, Site Description, & Header Right
   13 Reposition Items: Breadcrumbs, Footer, Primary & Secondary Navs
   14 Remove Genesis/WordPress widgets
   15 Remove Superfish
   16 Enqueue jQuery from Google CDN with Fallback
   17 CSS Cache Buster
   18 Genesis Theme Settings
   19 Alternative Doctype
   20 Intermediate Image Sizes
   21 Genesis Slider
   22 Avatars
*/

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'Cheatin&#8217; uh?' );

/*
01 Layout
---------------------------------------------------------------------------------------------------- */
/** Force layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**** Truly Force Layout without allowing the User to Override the preferred/recommended layout ****/
// Force Full Width Layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
 
// Force Content-Sidebar Layout
add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar' );
 
// Force Sidebar-Content Layout
add_filter( 'genesis_site_layout', '__genesis_return_sidebar_content' );
 
// Force Content-Sidebar-Sidebar Layout
add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar_sidebar' );
 
// Force Sidebar-Sidebar-Content Layout
add_filter( 'genesis_site_layout', '__genesis_return_sidebar_sidebar_content' );
 
// Force Sidebar-Content-Sidebar Layout
add_filter( 'genesis_site_layout', '__genesis_return_sidebar_content_sidebar' );
 
/**** Force Layout but allow the User to Override the preferred/recommended layout ****/
// Force Full Width Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
 
// Force Content-Sidebar Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
 
// Force Sidebar-Content Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );
 
// Force Content-Sidebar-Sidebar Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar_sidebar' );
 
// Force Sidebar-Sidebar-Content Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_sidebar_content' );
 
// Force Sidebar-Content-Sidebar Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content_sidebar' );

/*
02 Favicon
---------------------------------------------------------------------------------------------------- */

/** Remove favicon */
remove_action('genesis_meta', 'genesis_load_favicon');

add_filter( 'genesis_pre_load_favicon', 'gs_pre_load_favicon' );
/**
 * Change favicon
 *
 * @param  string $url Default Favicon URL
 * @return string New Favicon URL
 */
function gs_pre_load_favicon( $url ) {
	return 'http://domain.com/path/to/favicon.png';
}

//add_action( 'admin_head', 'gs_admin_favicon' );
/**
 * Adds Admin Favicon
 *
 */
function gs_admin_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . INCIPIO_IMAGES . '/admin-favicon.png" />';
}

/*
03 Remove Genesis in-post metaboxes
---------------------------------------------------------------------------------------------------- */

/** Remove Genesis in-post SEO Settings */
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );
 
/** Remove Genesis Layout Settings */
remove_theme_support( 'genesis-inpost-layouts' );

/*
04 Remove Genesis admin menus
---------------------------------------------------------------------------------------------------- */

/** Remove Genesis menu link */
remove_theme_support( 'genesis-admin-menu' );
 
/** Remove Genesis SEO Settings menu link */
remove_theme_support( 'genesis-seo-settings-menu' );

/** Remove README theme support */
remove_theme_support( 'genesis-readme-menu' );

/*
05 Genesis Style Selector
---------------------------------------------------------------------------------------------------- */

/** Create color style options */
add_theme_support(
	'genesis-style-selector',
	array(
		'theme-blue'   => __( 'Blue', CHILD_DOMAIN ),
		'theme-green'  => __( 'Green', CHILD_DOMAIN ),
		'theme-orange' => __( 'Orange', CHILD_DOMAIN ),
		'theme-red'    => __( 'Red', CHILD_DOMAIN )
	)
);

/*
06 Body & Post Classes
---------------------------------------------------------------------------------------------------- */

add_filter( 'body_class', 'gs_add_body_class' );
/**
 * Add custom body class to the head.
 *
 * @param  array $classes Array of existing body classes.
 * @return array $classes Modified Array of body classes.
 */
function gs_add_body_class( $classes ) {
	$classes[] = 'custom-class';
	return $classes;
}

add_filter( 'post_class', 'gs_post_class' );
/**
 * Add custom post classes.
 *
 * @param  array $classes Array of existing post classes.
 * @return array $classes Modified Array of body classes.
 */
function gs_post_class( $classes ) {
	$classes[] = 'custom-class';
	return $classes;
}

/*
07 Author Boxes
---------------------------------------------------------------------------------------------------- */
/** Remove author box on single posts */
remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );
 
/** Display author box on single posts */
add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );
 
/** Display author box on archive pages */
add_filter( 'get_the_author_genesis_author_box_archive', '__return_true' );
 
add_filter( 'genesis_author_box_title', 'gs_author_box_title' );
/**
 * Modify author box title 
 *
 * @param  string $title Default title (default: About {the author's name}).
 * @return string New author box title.
 */
function gs_author_box_title( $title ) {
	return '<strong>About the Author</strong>';
}
 
add_filter( 'genesis_author_box_gravatar_size', 'gs_author_box_gravatar_size', 10, 2 );
/**
 * Modify the size of the Gravatar in author box
 *
 * @param  int $size Size in pixels of gravatar (default: 70).
 * @param string $context Optional. Allows different author box markup for
 * different contexts, specifically 'single'. Default is empty string.
 * @return int New size in pixels of gravatar.
 */
function gs_author_box_gravatar_size( $size, $context ) {
	return 80;
}

add_filter( 'genesis_author_box', 'gs_author_box', 10, 6 );
/**
 * Customize Author Box
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/customize-author-box
 *
 * @param string $output
 * @param string $context
 * @param string $pattern
 * @param string $gravatar
 * @param string $title
 * @param string $description
 * @return string $output
 */
function gs_author_box( $output, $context, $pattern, $gravatar, $title, $description ) {
	$output = '';
	
	// Author box on single post
	if( 'single' == $context ) {
		$output .= '<div class="author-box">';
		$output .= '<div class="left">';
		$output .= get_avatar( get_the_author_meta( 'email' ), 200 );
		$output .= '</div><!-- .left -->';
		$output .= '<div class="right">';
		$name = get_the_author();
		$title = get_the_author_meta( 'title' );
		if( !empty( $title ) )
			$name .= ', ' . $title;
		$output .= '<h4 class="title">' . $name . '</h4>';
		$output .= '<p class="desc">' . get_the_author_meta( 'description' ) . '</p>';
		$output .= '</div><!-- .right -->';
		$output .= '<div class="cl"></div>';
		$output .= '<div class="left"><p class="social">';
		if( get_the_author_meta( 'twitter' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'twitter' ) ) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icon-twitter-author.png" /></a> ';
		if( get_the_author_meta( 'gplus' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'gplus' ) ) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icon-gplus-author.png" /></a> ';
		if( get_the_author_meta( 'linkedin' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'linkedin' ) ) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icon-linkedin-author.png" /></a> ';
		$output .= '<a href="' . trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . 'feed"><img src="' . get_stylesheet_directory_uri() . '/images/icon-feed-author.png" /></a>';
		$output .= '</div><!-- .left -->';
		$output .= '<div class="right">';
		$output .= '<p class="email"><a href="mailto:' . get_the_author_meta( 'email' ) . '">Email ' . get_the_author_meta( 'email' ) . '</a></p>';
		$output .= '</div><!-- .right -->';
		$output .= '</div><!-- .author-box -->';
	
	} else {
		$output .= '<div class="author-box">';
		$output .= '<div class="left">';
		$output .= get_avatar( get_the_author_meta( 'email' ), 200 );
		$output .= '</div><!-- .left -->';
		$output .= '<div class="right">';
		$name = get_the_author();
		$title = get_the_author_meta( 'title' );
		if( !empty( $title ) )
			$name .= ', ' . $title;
		$output .= '<h4 class="title"><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . $name . '</a>';
		$output .= '<span class="social">';
		if( get_the_author_meta( 'twitter' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'twitter' ) ) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icon-twitter-author.png" /></a> ';
		if( get_the_author_meta( 'gplus' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'gplus' ) ) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icon-gplus-author.png" /></a> ';
		if( get_the_author_meta( 'linkedin' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'linkedin' ) ) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icon-linkedin-author.png" /></a> ';
		$output .= '<a href="' . trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . 'feed"><img src="' . get_stylesheet_directory_uri() . '/images/icon-feed-author.png" /></a>';
		$output .= '</span>';
		$output .= '<a class="email" href="mailto:' . get_the_author_meta( 'email' ) . '">Email ' . get_the_author_meta( 'email' ) . '</a>';
		$output .= '</h4>';
		$output .= '<p class="desc">' . get_the_author_meta( 'description' ) . '</p>';
		$output .= '</div><!-- .right -->';
		$output .= '</div><!-- .author-box -->';
	}
	return $output;
}

/*
08 Post Info & Post Meta
---------------------------------------------------------------------------------------------------- */
add_filter( 'genesis_post_info', 'gs_post_info_filter' );
/** 
 * Customize the post info function
 *
 * @link http://my.studiopress.com/docs/shortcode-reference/
 * @param  string $post_info Default post info.
 * (default: '[post_date] ' . __( 'by', 'genesis' ) . ' [post_author_posts_link] [post_comments] [post_edit]')
 * @return string Modified post info.
 */
function gs_post_info_filter( $post_info ) {
	return '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';
}
 
/** Remove the post info function */
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
//add_filter( 'genesis_post_info', '__return_null' );

add_filter( 'genesis_post_meta', 'gs_post_meta_filter' );
/** 
 * Customize the post meta function
 *
 * @link http://my.studiopress.com/docs/shortcode-reference/
 * @param  string $post_meta Default post meta.
 * (default: '[post_categories] [post_tags]')
 * @return string Modified post meta.
 */
function gs_post_meta_filter( $post_meta ) {
	return '[post_categories before="Filed Under: "] [post_tags before="Tagged: "]';
}
 
/** Remove the post meta function */
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
//add_filter( 'genesis_post_meta', '__return_null' );

/*
09 Customize Links
   a. Next/Previous Links
---------------------------------------------------------------------------------------------------- */

add_filter ( 'genesis_next_link_text' , 'gs_next_link_text' );
/** 
 * Customize the next page link
 *
 * @param  string $text Default next page link.
 * (default: __( 'Next Page', 'genesis' ) . '&#x000BB;' )
 * @return string Modified next page link.
 */
function gs_next_link_text ( $text ) {
	return g_ent( '&raquo; ' ) . __( 'Custom Next Page Link', CHILD_DOMAIN );
}

/*
   b. Newer/Older Links
---------------------------------------------------------------------------------------------------- */

add_filter ( 'genesis_prev_link_text' , 'gs_prev_link_text' );
/** 
 * Customize the previous page link
 *
 * @param  string $text Default previous page link.
 * (default: __( 'Previous Page', 'genesis' ) . '&#x000BB;' )
 * @return string Modified previous page link.
 */
function gs_prev_link_text ( $text ) {
	return g_ent( '&laquo; ' ) . __( 'Custom Previous Page Link', CHILD_DOMAIN );
}
 
add_filter ( 'genesis_newer_link_text' , 'gs_newer_link_text' );
/** 
 * Customize the newer posts link
 *
 * @param  string $text Default newer posts link.
 * (default: __( 'Newer Posts', 'genesis' ) . '&#x000BB;' )
 * @return string Modified newer posts link.
 */
function gs_newer_link_text ( $text ) {
	return g_ent( '&raquo; ' ) . __( 'Custom Newer Posts Link', CHILD_DOMAIN );
}
 
add_filter ( 'genesis_older_link_text' , 'gs_older_link_text' );
/** 
 * Customize the older posts link
 *
 * @param  string $text Default older posts link.
 * (default: __( 'Older Posts', 'genesis' ) . '&#x000BB;' )
 * @return string Modified older posts link.
 */
function gs_older_link_text ( $text ) {
	return g_ent( '&laquo; ' ) . __( 'Custom Older Posts Link', CHILD_DOMAIN );
}

/*
10 Search Customizations
---------------------------------------------------------------------------------------------------- */

// Customize search form input box text
add_filter( 'genesis_search_text', 'gs_search_text' );
/** 
 * Customize search form input box text
 *
 * @param  string $text Default search form input box text.
 * (default: esc_attr__( 'Search this website', 'genesis' ) . '&#x02026;' )
 * @return string Modified search form input box text.
 */
function gs_search_text($text) {
	return esc_attr( 'Search my blog...' );
}
 
add_filter( 'genesis_search_button_text', 'gs_search_button_text' );
/** 
 * Customize search form input button text
 *
 * @param  string $text Default search form input button text.
 * (default: Search )
 * @return string Modified search form input button text.
 */
function gs_search_button_text($text) {
	return esc_attr( 'Go' );
}

/*
11 Google Fonts
---------------------------------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'gs_load_google_fonts' );
/**
 * Enqueue Google fonts
 */
function gs_load_google_fonts() {
	wp_enqueue_style( 
		'child-google-fonts', 
		'http://fonts.googleapis.com/css?family=Merriweather|Open+Sans', 
		array(), 
		CHILD_THEME_VERSION 
	);
}

/*
12 Remove Genesis Site Title, Site Description, & Header Right
---------------------------------------------------------------------------------------------------- */
/** Remove the site title */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
 
/** Remove the site description */
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
 
/** Remove the header right widget area */
unregister_sidebar( 'header-right' );

/*
13 Reposition Items: Breadcrumbs, Footer, Primary & Secondary Navs
---------------------------------------------------------------------------------------------------- */

/** Reposition the breadcrumbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/** Reposition the footer */
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
add_action( 'genesis_after', 'genesis_footer_markup_open', 11 );
add_action( 'genesis_after', 'genesis_do_footer', 12 );
add_action( 'genesis_after', 'genesis_footer_markup_close', 13 );

/** Reposition the primary navigation menu */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );
 
/** Reposition the secondary navigation menu */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

/*
14 Remove Genesis/WordPress widgets
---------------------------------------------------------------------------------------------------- */

add_action( 'widgets_init', 'gs_remove_enews_updates_widget', 20 );
/**
 * Remove Genesis/WordPress widgets
 */
function gs_remove_enews_updates_widget() {
	// Remove eNews and Updates widget (softly deprecated in Genesis 1.9)
	unregister_widget( 'Genesis_eNews_Updates' );
	
	// Remove Latest Tweets widget (softly deprecated in Genesis 1.9)
	unregister_widget( 'Genesis_Latest_Tweets_Widget' );
	
	// Remove Featured Page widget
	unregister_widget( 'Genesis_Featured_Page' );
	
	// Remove Featured Post widget
	// Don't do if using Genesis Featured Widget Amplified
	unregister_widget( 'Genesis_Featured_Post' );
	
	// Remove User Profile widget
	unregister_widget( 'Genesis_User_Profile_Widget' );
	
	// Remove these WordPress widgets:
	//unregister_widget( 'WP_Widget_Pages' );
	//unregister_widget( 'WP_Widget_Calendar' );
	//unregister_widget( 'WP_Widget_Archives' );
	//unregister_widget( 'WP_Widget_Links' );
	//unregister_widget( 'WP_Widget_Meta' );
	//unregister_widget( 'WP_Widget_Search' );
	//unregister_widget( 'WP_Widget_Text' );
	//unregister_widget( 'WP_Widget_Categories' );
	//unregister_widget( 'WP_Widget_Recent_Posts' );
	//unregister_widget( 'WP_Widget_Recent_Comments' );
	//unregister_widget( 'WP_Widget_RSS' );
	//unregister_widget( 'WP_Widget_Tag_Cloud' );
	//unregister_widget( 'WP_Nav_Menu_Widget' );
}

/*
15 Remove Superfish
---------------------------------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'unregister_superfish' );
/**
 * Unregister the superfish scripts
 */
function unregister_superfish() {
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
}

/*
16 Enqueue jQuery from Google CDN with Fallback
---------------------------------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'wps_enqueue_jquery' );
/**
 * Enqueue jQuery from Google CDN with fallback to local WordPress
 *
 * @link https://gist.github.com/4083811
 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link http://codex.wordpress.org/Function_Reference/wp_deregister_script
 * @link http://codex.wordpress.org/Function_Reference/get_bloginfo
 * @link http://codex.wordpress.org/Function_Reference/is_wp_error
 * @link http://codex.wordpress.org/Function_Reference/set_transient
 * @link http://codex.wordpress.org/Function_Reference/get_transient
 *
 * @uses get_transient()        Get the value of a transient.
 * @uses set_transient()        Set/update the value of a transient.
 * @uses is_wp_error()          Check whether the passed variable is a WordPress Error.
 * @uses get_bloginfo()         returns information about your site.
 * @uses wp_deregister_script() Deregisters javascripts for use with wp_enqueue_script() later.
 * @uses wp_register_script()   Registers javascripts for use with wp_enqueue_script() later.
 * @uses wp_enqueue_script()    Enqueues javascript.
 */
function gs_enqueue_jquery() {
	// Setup Google URI, default
	$protocol = ( isset( $_SERVER['HTTPS'] ) && 'on' == $_SERVER['HTTPS'] ) ? 'https' : 'http';
	$url      = $protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js';
	
	// Setup WordPress URI
	$wpurl = get_bloginfo( 'wpurl') . '/wp-includes/js/jquery/jquery.js';
	
	// Setup version
	$ver = null;
	
	// Deregister WordPress default jQuery
	wp_deregister_script( 'jquery' );
	
	// Check transient, if false, set URI to WordPress URI
	delete_transient( 'google_jquery' );
	
	if ( 'false' == ( $google = get_transient( 'google_jquery' ) ) ) {
		$url = $wpurl;
	}
	// Transient failed
	elseif ( false === $google ) {
		// Ping Google
		$resp = wp_remote_head( $url );
		
		// Use Google jQuery
		if ( ! is_wp_error( $resp ) && 200 == $resp['response']['code'] ) {
			// Set transient for 5 minutes
			set_transient( 'google_jquery', 'true', 60 * 5 );
		} 
		
		// Use WordPress jQuery
		else {
			// Set transient for 5 minutes
			set_transient( 'google_jquery', 'false', 60 * 5 );
			
			// Use WordPress URI
			$url = $wpurl;
			
			// Set jQuery Version, WP stanards
			$ver = '1.8.2';
		}
	}
	
	// Register surefire jQuery
	wp_register_script( 'jquery', $url, array(), $ver, true );
	
	// Enqueue jQuery
	wp_enqueue_script( 'jquery' );
}

/*
17 CSS Cache Buster
---------------------------------------------------------------------------------------------------- */

add_filter( 'stylesheet_uri', 'gs_stylesheet_uri' );
/** 
 * CSS Cache Buster
 * Always load CSS regardless of cache.
 */
function gs_stylesheet_uri( $stylesheet_uri ) {
    return add_query_arg( 'v', filemtime( get_stylesheet_directory() . '/style.css' ), $stylesheet_uri );
}

/*
18 Genesis Theme Settings
---------------------------------------------------------------------------------------------------- */

add_filter( 'genesis_options', 'gs_define_genesis_settings', 10, 2 );
/**
 * Define Genesis Options
 *
 * @param array $options Array of Setting Options.
 * @param string $setting Specific Setting.
 */
function gs_define_genesis_settings( $options, $setting ) {
    if ( GENESIS_SETTINGS_FIELD === $setting ) {
        $options['show_info']                 = 0; // Display theme info in document source
        $options['update']                    = 1; // Enable Automatic Updates
        $options['update_email']              = 0; // Notify when updates are available
        $options['update_email_address']      = ''; // Update email address
        $options['feed_uri']                  = ''; // Custom reed URI
        $options['redirect_feed']             = 0; // Redirect reed
        $options['comments_feed_uri']         = ''; // Custom comments feed URI
        $options['redirect_comments_feed']    = 0; // Redirect feed
        $options['site_layout']               = 'content-sidebar'; // Default layout
        $options['blog_title']                = 'text'; // Blog title/logo - 'text' or 'image'
        $options['nav']                       = 1; // Include primary navigation (DEPRECATED)
        $options['nav_superfish']             = 1; // Enable fancy dropdowns
        $options['nav_extras_enable']         = 0; // Enable extras
        $options['nav_extras']                = 'date'; // Extras - 'date', 'rss', 'search', 'twitter'
        $options['nav_extras_twitter_id']     = ''; // Twitter ID
        $options['nav_extras_twitter_text']   = 'Follow me on Twitter'; // Twitter link text
        $options['subnav']                    = 0; // Include secondary navigation (DEPRECATED)
        $options['subnav_superfish']          = 1; // Enable fancy dropdowns
        $options['breadcrumb_home']           = 1; // Enable breadcrumbs on Front Page
        $options['breadcrumb_single']         = 1; // Enable breadcrumbs on Posts
        $options['breadcrumb_page']           = 1; // Enable breadcrumbs on Pages
        $options['breadcrumb_archive']        = 1; // Enable breadcrumbs on Archives
        $options['breadcrumb_404']            = 1; // Enable breadcrumbs on 404 Page
        $options['breadcrumb_attachment']     = 1; // Enable breadcrumbs on Attachment Pages
        $options['comments_posts']            = 1; // Enable comments on Posts
        $options['comments_pages']            = 0; // Enable comments on Pages
        $options['trackbacks_posts']          = 1; // Enable trackbacks on Posts
        $options['trackbacks_pages']          = 0; // Enable trackbacks on Pages
        $options['content_archive']           = 'full'; // Content archives display - 'full', 'excerpts'
        $options['content_archive_limit']     = ''; // Limit content to n characters
        $options['content_archive_thumbnail'] = 0; // Include featured image
        $options['posts_nav']                 = 'older-newer'; // Post navigation - 'older-newer', 'prev-next', 'numeric'
        $options['blog_cat']                  = '0'; // Blog page displays which category
        $options['blog_cat_exclude']          = ''; // Blog page excludes which category 
        $options['blog_cat_num']              = 10; // Number of posts to show
        $options['header_scripts']            = ''; // Header scripts, unfiltered, must include <script></script> tags
        $options['footer_scripts']            = ''; // Footer scripts, unfiltered, must include <script></script> tags
	}
	
    return $options;
}

add_action( 'genesis_theme_settings_metaboxes', 'child_remove_metaboxes' );
/** 
 * Remove unused theme settings
 *
 * @param string $_genesis_theme_settings_pagehook Genesis Admin Pagehook.
 */
function child_remove_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-version', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-feeds', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-header', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-layout', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-breadcrumb', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-comments', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-posts', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-blogpage', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-scripts', $_genesis_theme_settings_pagehook, 'main' );
}

/** Force Superfish */
add_filter( 'genesis_pre_get_option_nav_superfish', '__return_true' );

/*
19 Alternative Doctype
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'gs_do_doctype' );
/**
 * Conditional html element classes
 */
function child_do_doctype() {
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html class="ie6" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <?php
}

/*
20 Intermediate Image Sizes
---------------------------------------------------------------------------------------------------- */

add_filter( 'intermediate_image_sizes_advanced', 'gs_remove_image_sizes' );
/**
 * Remove WordPress Image Sizes.
 *
 * @param  array $sizes Array of Intermediate Image Sizes.
 * @return array $sizes Modified Array of Intermediate Image Sizes.
 */
function gs_remove_image_sizes( $sizes ) {
        unset( $sizes['thumbnail'] );
        unset( $sizes['medium'] );
        unset( $sizes['large'] );

        return $sizes;
}

/*
21 Genesis Slider
---------------------------------------------------------------------------------------------------- */

//add_filter( 'genesis_slider_settings_defaults', 'gs_genesis_slider_defaults' );
/**
 * Set Genesis Slider Defaults
 *
 * @param array $defaults Original Genesis Slider defaults
 * @return array $defaults Modified Genesis Slider defaults
 */
function gs_genesis_slider_defaults( $defaults ) {
	$defaults['slideshow_arrows']        = 0;
	$defaults['slideshow_height']        = 380;
	$defaults['slideshow_width']         = 960;
	$defaults['slideshow_more_text']     = __( 'Read', CHILD_DOMAIN );
	$defaults['slideshow_title_show']    = 1;
	$defaults['slideshow_excerpt_width'] = 360;
	$defaults['location_vertical']       = 'top';
	
	return $defaults;

}

/*
22 Avatars
---------------------------------------------------------------------------------------------------- */

//add_filter( 'avatar_defaults', 'gs_new_avatar' );
/**
 * Add Custom Avatar (Discussion Settings)
 *
 * @param array $avatar_defaults WordPress default avatars
 * @return array $avatar_defaults Amended defaults
 */
function gs_new_avatar( $avatar_defaults ){
	$avatar_defaults[INCIPIO_ADMIN . '/images/genesis-48x48.png'] = __( 'New Avatar Name', 'incipio' );
	
	return $avatar_defaults;
}

//add_action( 'admin_init', 'gs_avatar_default' );
/**
 * Set new avatar to be default. This also assumes that
 * user will never want mystery man to be the default.
 *
 */
function gs_avatar_default() {
	$default = get_option( 'avatar_default' );
	if ( ( empty( $default ) ) || ( 'mystery' == $default ) )
		$default = INCIPIO_ADMIN . '/images/genesis-48x48.png';
	update_option( 'avatar_default', $default );
}

//add_action( 'genesis_register_sidebar_defaults', 'gs_register_sidebar_defaults' );
/**
 * 02 Customize Genesis Sidebar Defaults
 *
 * This function customizes the sidebar defaults. This function must be
 * placed before the initialization of Genesis since genesis_register_sidebar_defaults
 * is fired in the genesis_setup hook. Feel free to completely remove this function.
 *
 * @since 1.1.0
 *
 * @param  array $defaults Genesis sidebar defaults
 * @return array Modified Genesis sidebar defaults
 */
function gs_register_sidebar_defaults( $defaults ) {
	return array(
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => "</div></div>\n",
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => "</h4>\n",
	);
}

/** Add post thumbnails to page post type */
//add_theme_support( 'post-thumbnails', array( 'page', ) );

/** Simple Menu Registration */
//add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu' ) );

/** Remove Genesis Menus */
//remove_theme_support( 'genesis-menus' );

/**
 * 16 Remove Unused Page Layouts
 */
/*
foreach ( array( 'content-sidebar-sidebar', 'sidebar-sidebar-content', 'sidebar-content-sidebar', 'sidebar-content', 'content-sidebar', 'full-width-content', ) as $layout )
	genesis_unregister_layout( $layout );
*/

	/**
	 * 17 Excerpt/Content Limit/Content Read More
	 */
	/** Add excerpts to page post type. */
	add_post_type_support( 'page', 'excerpt' );
	
	/** Completely remove excerpt more. */
	//add_filter( 'excerpt_more', '__return__null' );
	
	/** Edit excerpt more link. */		
	//add_filter( 'excerpt_more', 'gs_remove_excerpt_more' );
	//add_filter( 'get_the_content_more_link', 'gs_read_more_link' );
	//add_filter( 'the_content_more_link', 'gs_read_more_link' );
	
	/**
	 * 18 Genesis Admin Menus
	 */
	/** Remove Genesis menu link */
	//remove_theme_support( 'genesis-admin-menu' );
	 
	/** Remove Genesis SEO Settings menu link */
	//remove_theme_support( 'genesis-seo-settings-menu' );

	/** Remove README theme support */
	//remove_theme_support( 'genesis-readme-menu' );
	
	/**
	 * 19 Remove Edit link
	 */
	add_filter( 'genesis_edit_post_link', '__return_false' );
	
	/** 
	 * 20 Remove Unused User Settings 
	 * Run with high priority to keep any contact methods added via plugins.
	 */
	add_filter( 'user_contactmethods', 'gs_contactmethods', 1 );
	foreach ( array( 'genesis_user_options_fields', 'genesis_user_archive_fields', 'genesis_user_seo_fields', 'genesis_user_layout_fields', ) as $field ) {
		remove_action( 'show_user_profile', $field );
		remove_action( 'edit_user_profile', $field );
	}

	/*
06 Excerpt/Content Limit/Content Read More
---------------------------------------------------------------------------------------------------- */
/** 
 * Edit excerpt read more link
 *
 * @param  string $more Read More Text, , default: ' ' . '[...]'
 * @return string Modified Read More Text.
 */
function gs_remove_excerpt_more( $more ) {
	return '...';
}

/** 
 * Edit read more link.
 *
 * @param  string $link HTML Read More Link, default: sprintf( '&#x02026; <a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text = '(more...)' ).
 * @return string Modified HTML Read More Link.
 */
function gs_read_more_link( $link ) {
	return '<a class="more-link" href="' .  get_permalink() .  '" rel="nofollow">Read More</a>';
}
