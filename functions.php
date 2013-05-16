<?php

/**
 * Custom amendments for the theme.
 *
 * @category   Genesis_Sandbox
 * @package    Functions
 * @subpackage Functions
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

/*******************************************************************************/
//DO NOT EDIT! EDITING THIS SECTION CAN HAVE SERIOUS RAMIFICATIONS!.

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'Cheatin&#8217; uh?' );

/* Table of Contents

   01 Initialize Sandbox
   02 Customize Genesis Sidebar Defaults
   03 Theme Setup
   04 Register Extra Sidebars
   05 Load Genesis
   06 Excerpt/Content Limit/Content Read More
   07 Genesis Custom Header Admin Style
   08 Genesis Custom Header Admin Style
   09 Scripts
   10 Navigation
   11 Contact Methods
   12 Custom Footer
*/

/**
 * 01 Initialize Sandbox
 * @since 1.1.0
 *
 * Builds various Genesis constants off style.css.
 * Includes various necessary files.
 * Future proofs theme by preventing updates.
 */
require_once( get_stylesheet_directory() . '/lib/init.php');

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
	   22 Unregister SuperFish
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
			//'sidebar', 
			//'sidebar-alt', 
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
	 *
	add_theme_support(
		'genesis-custom-header',
		array(
			'header_image'          => '%s/images/logo.png',
			'width'                 => 350, 
			'height'                => 100, 
			'textcolor'             => 'blank', // replace with Hex colors
			// Optional as Genesis has its own header_callback & admin_header_callback but samples provided in gs-functions.php for customizations
			'header_callback'       => 'gs_header_style',
			//'admin_header_callback' => 'gs_admin_style', 
		)
	); */

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

	/**
	 * 21 Unregister SuperFish
	 */
	
	add_action( 'wp_enqueue_scripts', 'gs_unregister_superfish' );
	function gs_unregister_superfish() {
		wp_deregister_script( 'superfish' );
		wp_deregister_script( 'superfish-args' );
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

/** 
 * 05 Load Genesis
 *
 * This is technically not needed. However, to make functions.php snippet useful, it is necessary.
 */
require_once( get_template_directory() . '/lib/init.php' );

/** All Done! Loaded! Happy editing! */
/*******************************************************************************/

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

/*
07 Genesis Custom Header Callbacks
---------------------------------------------------------------------------------------------------- */
/**
 * Custom header callback.
 *
 * It outputs special CSS to the document head, modifying the look of the header
 * based on user input.
 *
function gs_header_style() {

	// Header image CSS 
	$output = sprintf( '#title-area { background: url(%s) #0a84c9 no-repeat; }', esc_url( get_header_image() ) );

	// Header text color CSS, if showing text
	if ( 'blank' != get_header_textcolor() )
		$output .= sprintf( '#title a, #title a:hover, #description { color: #%s; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%s</style>', $output );

} */

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 * @see genesis_custom_header_admin_style() For comparison & the default genesis-custom-background admin callback function.
 *
function gs_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Georgia, Times, serif; min-height: %spx; text-align: center; text-shadow: #666 1px 1px; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1      = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 48px; font-variant: small-caps; font-weight: normal; line-height: 48px; margin: 35px 0 0; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc    = sprintf( '#headimg #desc { color: #%s; font-size: 20px; font-style: italic; line-height: 1; margin: 0; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );
	
}*/

/*
08 Scripts
---------------------------------------------------------------------------------------------------- */
add_action( 'init', 'gs_register_scripts' );
/**
 * Registers Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.min.js/*.min.css is the minified version & *.js is beautified version.
 * To make the styles appear AFTER your base style, in the array(), place sanitize_title_with_dashes( CHILD_THEME_NAME )
 * so that: array( sanitize_title_with_dashes( CHILD_THEME_NAME ) )
 * e.g., wp_register_style( 'gs-twitter-bootstrap', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array( sanitize_title_with_dashes( CHILD_THEME_NAME ) ), '1.0.0' );
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 * @uses gs_script_suffix() Adds proper CSS/JS suffix based on WP_DEBUG or SCRIPT_DEBUG
 */
function gs_register_scripts() {
	
	/**
	 * Twitter Bootstrap CSS
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://twitter.github.com/bootstrap/
	 */
	wp_register_style( 'gs-twitter-bootstrap', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array(), '1.0.0' );
	wp_register_style( 'gs-twitter-bootstrap-cdn', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css', array(), '2.2.2' );
	
	// Twitter Bootstrap CSS (Font Awesome version)
	wp_register_style( 'gs-twitter-bootstrap-font-awesome', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap.no-icons.min.css', array(), '2.1.1' );
	
	/**
	 * Twitter Bootstrap JS
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://twitter.github.com/bootstrap/
	 */
	wp_register_script( 'gs-twitter-bootstrap', CHILD_JS . '/' . gs_script_suffix( 'bootstrap', 'js' ), array( 'jquery' ), '2.2.2' );
	wp_register_script( 'gs-twitter-bootstrap-cdn', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js', array( 'jquery' ), '2.2.2' );
	
	/**
	 * Font Awesome
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://fortawesome.github.com/Font-Awesome/
	 */
	wp_register_style( 'gs-font-awesome', CHILD_CSS . '/' . gs_script_suffix( 'font-awesome', 'css' ), array(), '1.0.0' );
	wp_register_style( 'gs-font-awesome-cdn', '//netdna.bootstrapcdn.com/font-awesome/2.0/css/font-awesome.css', array(), '2.2.2' );
	wp_register_style( 'gs-font-awesome-ie7', CHILD_CSS . '/' . gs_script_suffix( 'font-awesome-ie7', 'css' ), array(), '1.0.0' );
	wp_register_style( 'gs-font-awesome-ie7-cdn', '//netdna.bootstrapcdn.com/font-awesome/2.0/css/font-awesome-ie7.css', array(), '2.2.2' );
	
	/**
	 * Pretty Photo
	 * @link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
	 * @link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/documentation
	 */
	wp_register_style( 'gs-pretty-photo', CHILD_CSS . '/' . gs_script_suffix( 'prettyPhoto', 'css' ), array(), '3.1.4' );
	wp_register_script( 'gs-pretty-photo', CHILD_JS . '/' . gs_script_suffix( 'jquery.prettyPhoto', 'js' ), array( 'jquery' ), '3.1.4' );
	
	/** Common, site specific */
	wp_register_script( 'gs-common', CHILD_JS . '/' . gs_script_suffix( 'common' ), array( 'jquery' ) , CHILD_THEME_VERSION );
	
}

/**
 * Enqueues Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.min.js/*.min.css is the minified version & *.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 */
function gs_enqueue_scripts() {
	// You can Also register scripts right before enqueing OR simply enqueue the script without registering.
	// See gs_register_scripts() for examples.
	
	// Styles
	wp_enqueue_style( 'gs-twitter-bootstrap' );
	
	/**  gs-twitter-bootstrap-font-awesome will overwrite most of the styles in the style sheet.
	 *   Only activate it if you wish to purely use all of the Bootstrap Styles and Font Awesome Together */
	//wp_enqueue_style( 'gs-twitter-bootstrap-font-awesome' );
	
	//wp_enqueue_style( 'gs-font-awesome' );
	//wp_enqueue_style( 'gs-pretty-photo' );
	
	// Scripts
	//wp_enqueue_script( 'gs-twitter-bootstrap' );
	//wp_enqueue_script( 'gs-pretty-photo' );
	//add_action( 'wp_footer', 'gs_init_pretty_photo' );
	wp_enqueue_script( 'gs-common' );
	
	// Localize Script
	/*
	// This enables you to create variable variables in JS that will be referred to as gs.greeting
	$l10n_args = array(
		//REFERENCE => VALUE, example in next line, CHILD_DOMAIN is the text domain for internationalization.
		'greeting'  => __( 'Hello World!', CHILD_DOMAIN ),
	);
	
	// @link http://codex.wordpress.org/Function_Reference/wp_localize_script
	// wp_localize_script( REGISTERED-HANDLE, OBJECT_NAME, OBJECT_DATA );
	wp_localize_script( 'gs-common-scripts', 'gs', $l10n_args );
	*/
}

/*
09 Navigation
---------------------------------------------------------------------------------------------------- */
/**
 * Add navigation menu to mobile.
 *
 * @since 1.1.0
 * @uses gs_navigation() Sandbox Navigation Helper Function.
 */
function gs_mobile_navigation() {
	
	$mobile_menu_args = array(
		'echo' => true,
	);
	
	gs_navigation( 'mobile', $mobile_menu_args );
}

/**
 * Add navigation menu to the top.
 *
 * @since 1.1.0
 * @uses gs_navigation() Sandbox Navigation Helper Function.
 */
function gs_footer_navigation() {
	
	$footer_menu_args = array(
		'depth' => 1,
	);
	
	return gs_navigation( 'footer', $footer_menu_args );
}

/*
10 Contact Methods
---------------------------------------------------------------------------------------------------- */
/**
 * Customize Contact Methods
 * This removes jabber, yim, & aim default contact methods.
 * @since 1.1.0
 *
 * @param  array $contactmethods Array of contact methods and their labels.
 * @return array $contactmethods Modified Contact Methods.
 */
function gs_contactmethods( $contactmethods ) {
	$contactmethods = array ( 'twitter' => __( 'Twitter Name (no @)', CHILD_DOMAIN ) );
	
	return $contactmethods;
}

/*
11 Custom Footer
---------------------------------------------------------------------------------------------------- */
/**
 * Custom Footer based on options
 *
 * @uses CHILD_SETTINGS_FIELD
 * @uses genesis_get_option()
 * @uses wpautop()
 * @uses gs_footer_navigation()
 */
function gs_do_footer() {
	$pattern = '<div class="one-half%1$s" id="footer-%2$s">%3$s</div>';
	if ( ! genesis_get_option( 'footer_left_nav', CHILD_SETTINGS_FIELD ) )
		printf( $pattern, ' first', 'left', wpautop( genesis_get_option( 'footer_left', CHILD_SETTINGS_FIELD ) ) );
	else
		printf( $pattern, ' first', 'left', gs_footer_navigation() );
	
	if ( ! genesis_get_option( 'footer_right_nav', CHILD_SETTINGS_FIELD) )
		printf( $pattern, '', 'right', wpautop( genesis_get_option( 'footer_right', CHILD_SETTINGS_FIELD ) ) );
	else
		printf( $pattern, '', 'right', gs_footer_navigation() );
}

/*
12 Theme Settings Page
---------------------------------------------------------------------------------------------------- */
add_action( 'genesis_admin_menu', 'gs_add_settings', 5 );
/**
 * Add the Theme Settings Page
 *
 * @since 1.1.0
 */
function gs_add_settings() {
	global $_gs_settings;
	
	$_gs_settings = new Genesis_Sandbox_Settings;	 	
}
