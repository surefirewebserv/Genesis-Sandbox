<?php

/**
 * Init File
 *
 * This file defines the Child Theme's constants & tells WP not to update.
 *
 * @category   Genesis_Sandbox
 * @package    Admin
 * @subpackage Init
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

/* Table of Contents

   01 Customize Genesis Sidebar Defaults
   02 Theme Setup
   03 Register Extra Sidebars
   04 Constants
   05 Init
   06 Prevent Update
*/

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'Cheatin&#8217; uh?' );


//add_action( 'genesis_register_sidebar_defaults', 'gs_register_sidebar_defaults' );
/**
 * 01 Customize Genesis Sidebar Defaults
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


add_action( 'genesis_setup', 'gs_theme_setup', 15 );
/**
 * 03 Theme Setup
 * @since 1.1.0
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 */
function gs_theme_setup() {
	/* Table of Contents

	   01 Content Width
	   02 Structural Wraps
	   03 Post Info/Meta
	   04 Post Formats
	   05 Images
	   06 Custom Background
	   07 Genesis Custom Header
	   08 Footer Widgets
	   09 Genesis Menus
	   10 Top Navigation
	   11 Custom Footer
	   12 Responsiveness
	   13 Scripts
	   14 Editor Style
	   15 Remove Sidebars
	   16 Set Default Layout
	   17 Remove Unused Page Layouts
	   18 Excerpt/Content Limit/Content Read More
	   19 Genesis Readme Support
	   20 Genesis Edit Link
	   21 Unused Contact Methods
	*/

	/** 
	 * 01 Set content width 
	 * genesis_content_width() will be applied; Filters the content width based on the user selected layout.
	 *
	 * @see genesis_content_width()
	 * @param integer $default Default width
	 * @param integer $small Small width
	 * @param integer $large Large width
	 */
	$content_width = apply_filters( 'content_width', 600, 430, 920 );
	
	/** 
	 * 02 Structural Wraps 
	 * Adds a .wrap div tag within the div elements in the array. Remove as desired.
	 * By default, this is not needed and will be added automatically for array( 'header', 'nav', 'subnav', 'footer-widgets', 'footer' ).
	 */
	add_theme_support(
		'genesis-structural-wraps', 
		array(
			'header', 
			'nav', 
			'subnav', 
			'mobile-menu', 
			'inner', 
			'sidebar', 
			'sidebar-alt', 
			'footer-widgets', 
			'footer', 
		)
	);
	
	/** 
	 * 03 Post Info/Meta
	 * Remove posts post type support
	 */
	/** Remove the post info function */
	//remove_action( 'genesis_before_post_content', 'genesis_post_info' );
	
	/** Remove the post meta function */
	//remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
	
	/** 
	 * 03 Post Formats
	 * Add support for post format images 
	 * Genesis will then look for images located in images/post-formats/
	 */
	//add_theme_support( 'genesis-post-format-images' );
	/*
	add_theme_support(
		'post-formats', 
		array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
		)
	);
	*/

	/**
	 * 04 Images
	 * Add new image sizes
	 * Image ID should be ID like with no spaces and all lower cases with add_image_size().
	 */
	add_image_size( 'featured-image', 225, 160, TRUE );
	
	/** Add post thumbnails to page post type */
	//add_theme_support( 'post-thumbnails', array( 'page', ) );
	
	/** Set specific size for post thumbnails */
	//set_post_thumbnail_size( 300, 165, TRUE );

	/**
	 * 05 Custom Background
	 * Add suport for custom background
	 */
	add_theme_support( 'custom-background' );

	/**
	 * 06 Custom Header
	 * Add support for custom header
	 */
	add_theme_support(
		'genesis-custom-header',
		array(
			'header_image'          => CHILD_URL . '/images/header.png',
			'width'                 => 1152, 
			'height'                => 60, 
			'textcolor'             => 'blank', // replace with Hex colors
			// Optional as Genesis has its own header_callback & admin_header_callback but samples provided in gs-functions.php for customizations
			//'header_callback'       => 'gs_header_style',
			//'admin_header_callback' => 'gs_admin_style', 
		)
	);

	/**
	 * 07 Footer Widgets
	 * Add support for 3-column footer widgets
	 * Change 3 for support of up to 6 footer widgets
	 */
	add_theme_support( 'genesis-footer-widgets', 3 );

	/**
	 * 08 Genesis Menus
	 * Genesis Sandbox comes with 4 navigation systems built-in ready.
	 * Delete any menu systems that you do not wish to use.
	 */
	add_theme_support(
		'genesis-menus', 
		array(
			'primary'   => __( 'Primary Navigation Menu', CHILD_DOMAIN ), 
			'secondary' => __( 'Secondary Navigation Menu', CHILD_DOMAIN ),
			'footer'    => __( 'Footer Navigation Menu', CHILD_DOMAIN ),
			'mobile'    => __( 'Mobile Navigation Menu', CHILD_DOMAIN ),
		)
	);
	
	/** Simple Menu Registration */
	//add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu' ) );
	
	/** Remove Genesis Menus */
	//remove_theme_support( 'genesis-menus' );
	
	/**
	 * 09 Top Navigation
	 * Add Top Navigation
	 * Below are two functions (add_action()) that will add a top
	 * navigation menu either before #wrap or inside the #wrap.
	 */
	
	
	/** Add Mobile Navigation Inside #wrap */
	add_action( 'genesis_before_header', 'gs_mobile_navigation', 5 );
	
	/**
	 * 10 Custom Footer
	 */
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	add_action( 'genesis_footer', 'gs_do_footer' );
	
	/**
	 * 11 Genesis Sandbox Responsive
	 * Roll own responsive functions
	 * @uses gs_script_suffix() Adds proper CSS/JS suffix based on WP_DEBUG or WP_SCRIPT_DEBUG.
	 */
	add_theme_support(
		'gs-responsive', 
		array(
			'css'      => array(
				'src' => CHILD_CSS . '/' . gs_script_suffix( 'responsive', 'css' ), 
				'dir' => CHILD_CSS_DIR . '/' . gs_script_suffix( 'responsive', 'css' ), 
			),
			/** 
			 * Default: <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
			 * To over-ride just enter your meta tag instead of true.
			 */
			'viewport' => true,
		)
	);
	
	/**
	 * 12 Scripts
	 * Properly add/register and enqueue scripts.
	 */
	add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );
	
	/**
	 * 13 Editor Styles
	 * Takes a stylesheet string or an array of stylesheets.
	 * Default: editor-style.css 
	 */
	add_editor_style();
	
	/**
	 * 14 Sidebars
	 */
	/** Remove Sidebars */
	//unregister_sidebar( 'header-right' );
	//unregister_sidebar( 'sidebar' );
	//unregister_sidebar( 'sidebar-alt' );
	
	/** Register Sidebars */
	gs_register_sidebars();
	
	/**
	 * 15 Default Layout Setting
	 * Register default layout setting
	 */
	genesis_set_default_layout( 'content-sidebar' );
	//genesis_set_default_layout( 'sidebar-content' );
	//genesis_set_default_layout( 'content-sidebar-sdebar' );
	//genesis_set_default_layout( 'sidebar-sidebar-content' );
	//genesis_set_default_layout( 'sidebar-content-sidebar' );
	//genesis_set_default_layout( 'full-width-content' );

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
}

/**
 * 04 Register Extra Sidebars (widget areas)
 * Edit the $sidebars array to create the initial desired sidebars.
 * This is to be used with genesis_widget_area() on the front end.
 *
 * @uses genesis_register_sidebar() Genesis helper function to register WP sidebars.
 */
function gs_register_sidebars() {
	$sidebars = array(
		array(
			'id'			=> 'home-top',
			'name'			=> __( 'Home Top', CHILD_DOMAIN ),
			'description'	=> __( 'This is the top homepage section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'home-left',
			'name'			=> __( 'Home Left', CHILD_DOMAIN ),
			'description'	=> __( 'This is the homepage left section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'home-right',
			'name'			=> __( 'Home Right', CHILD_DOMAIN ),
			'description'	=> __( 'This is the homepage right section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'home-bottom',
			'name'			=> __( 'Home Bottom', CHILD_DOMAIN ),
			'description'	=> __( 'This is the homepage right section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'portfolio',
			'name'			=> __( 'Portfolio', CHILD_DOMAIN ),
			'description'	=> __( 'This is the portfolio page template', CHILD_DOMAIN ),
		),
	);
	
	foreach ( $sidebars as $sidebar )
		genesis_register_sidebar( $sidebar );
}

add_action( 'genesis_init', 'gs_constants', 15 );
/**
 * 04 Constants
 * This function defines the Genesis Child theme constants
 *
 * Data Constants: CHILD_SETTINGS_FIELD, CHILD_DOMAIN, CHILD_THEME_VERSION
 * CHILD_THEME_NAME, CHILD_THEME_URL, CHILD_DEVELOPER, CHILD_DEVELOPER_URL
 * Directories: CHILD_LIB_DIR, CHILD_IMAGES_DIR, CHILD_ADMIN_DIR, CHILD_JS_DIR, CHILD_CSS_DIR
 * URLs: CHILD_LIB, CHILD_IMAGES, CHILD_ADMIN, CHILD_JS, CHILD_CSS
 *
 * @since 1.1.0
 */
function gs_constants() {
	$theme = wp_get_theme();
	
	// Child theme (Change but do not remove)
		/** @type constant Child Theme Options/Settings. */
		define( 'CHILD_SETTINGS_FIELD', $theme->get('TextDomain') . '-settings' );
		
		/** @type constant Text Domain. */
		define( 'CHILD_DOMAIN', $theme->get('TextDomain') );
		
		/** @type constant Child Theme Version. */
		define( 'CHILD_THEME_VERSION', $theme->Version );
		
		/** @type constant Child Theme Name, used in footer. */
		define( 'CHILD_THEME_NAME', $theme->Name );
		
		/** @type constant Child Theme URL, used in footer. */
		define( 'CHILD_THEME_URL', $theme->get('ThemeURI') );
		
	// Developer Information, see lib/admin/admin-functions.php
		/** @type constant Child Theme Developer, used in footer. */
		define( 'CHILD_DEVELOPER', $theme->Author );
		
		/** @type constant Child Theme Developer URL, used in footer. */
		define( 'CHILD_DEVELOPER_URL', $theme->{'Author URI'}  );
		
	// Define Directory Location Constants
		/** @type constant Child Theme Library/Includes URL Location. */
		define( 'CHILD_LIB_DIR',    CHILD_DIR . '/lib' );
		
		/** @type constant Child Theme Images URL Location. */
		define( 'CHILD_IMAGES_DIR', CHILD_DIR . '/images' );
		
		/** @type constant Child Theme Admin URL Location. */
		define( 'CHILD_ADMIN_DIR',  CHILD_LIB_DIR . '/admin' );
		
		/** @type constant Child Theme JS URL Location. */
		define( 'CHILD_JS_DIR',     CHILD_DIR .'/js' );
		
		/** @type constant Child Theme JS URL Location. */
		define( 'CHILD_CSS_DIR',    CHILD_DIR .'/css' );
	
	// Define URL Location Constants
		/** @type constant Child Theme Library/Includes URL Location. */
		define( 'CHILD_LIB',    CHILD_URL . '/lib' );
		
		/** @type constant Child Theme Images URL Location. */
		define( 'CHILD_IMAGES', CHILD_URL . '/images' );
		
		/** @type constant Child Theme Admin URL Location. */
		define( 'CHILD_ADMIN',  CHILD_LIB . '/admin' );
		
		/** @type constant Child Theme JS URL Location. */
		define( 'CHILD_JS',     CHILD_URL .'/js' );
		
		/** @type constant Child Theme JS URL Location. */
		define( 'CHILD_CSS',    CHILD_URL .'/css' );	
}

add_action( 'genesis_init', 'gs_init', 15 );
/**
 * 05 Sandbox Init
 * This function calls necessary child theme files
 *
 * @since 1.1.0
 */
function gs_init() {
		
	/** Theme Specific Functions */
	include_once( CHILD_LIB_DIR . '/functions/gs-functions.php' );	
	
	// Load admin files when necessary
	if ( is_admin() ) {

		/** Admin Functions */
		include_once( CHILD_LIB_DIR . '/admin/gs-admin-functions.php');
		
		/** New Admin Page */
		include_once( CHILD_LIB_DIR . '/admin/gs-settings.php');
		
		/** Inpost Metaboxes */
		include_once( CHILD_LIB_DIR . '/admin/gs-inpost-functions.php');
		
		/** Get required plugins */
	require_once( CHILD_LIB_DIR . '/plugins/plugins.php' );
		
	}
	
}

add_filter( 'http_request_args', 'gs_prevent_theme_update', 5, 2 );
/**
 * 06 Don't update theme from .org repo.
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update. Future proofs themes.
 *
 * @since 1.1.0
 *
 * @author Mark Jaquith
 * @link   http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 */
function gs_prevent_theme_update( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}
