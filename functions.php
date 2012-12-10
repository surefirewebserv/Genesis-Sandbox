<?php
<<<<<<< HEAD
<<<<<<< HEAD

/**
 * Custom amendments for the theme.
 *
 * @category    Genesis_Sandbox
 * @author     Travis Smith, for Surefire Themes
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.0.0
 */

/********************************************************************************/
//DO NOT EDIT! EDITING THIS SECTION CAN HAVE SERIOUS RAMIFICATIONS!.

/**
 * Initialize Sandbox
 * @since 1.1.0
 *
 * Builds various Genesis constants off style.css.
 */
require_once( get_stylesheet_directory() . '/lib/init.php');

add_action( 'genesis_setup', 'gs_theme_setup', 15 );
/**
 * Theme Setup
 * @since 1.0.0
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */
function gs_theme_setup() {
	
	/** Set content width */
	$content_width = apply_filters( 'content_width', 600, 430, 920 );
	
	/** Add new image sizes */
	add_image_size( 'featured', 225, 160, TRUE );

	/** Add suport for custom background */
	add_theme_support( 'custom-background' );

	/** Add support for custom header */
	add_theme_support(
		'genesis-custom-header',
		array(
			'width' => 1152, 
			'height' => 60, 
			'textcolor' => 'ffffff', 
			'admin_header_callback' => 'wps_admin_style' 
		)
	);

	/** Add support for 3-column footer widgets */
	add_theme_support( 'genesis-footer-widgets', 3 );

	/** Genesis Menus */
	add_theme_support(
		'genesis-menus', 
		array(
			'primary'   => __( 'Primary Navigation Menu', 'gs' ), 
			'secondary' => __( 'Secondary Navigation Menu', 'gs' ),
			'top'       => __( 'Top Navigation Menu', 'gs' ),
		)
	);
	
	/** Viewport */
	add_action( 'genesis_meta', 'gs_add_viewport_meta_tag' );
	
	/** Sidebars */
	//unregister_sidebar( 'header-right' );
	gs_register_sidebars();
	
	/** Completely remove excerpt more. **/			
	//add_filter( 'excerpt_more', '__return__null' );
	
	/** Edit excerpt more link. **/			
	//add_filter( 'excerpt_more', 'gs_remove_excerpt_more' );
	//add_filter( 'get_the_content_more_link', 'gs_read_more_link' );
	//add_filter( 'the_content_more_link', 'gs_read_more_link' );
	
	/** Scripts */
	add_action( 'wp_enqueue_scripts', 'gs_scripts' );
}

/**
 * Register widget areas.
 */
function gs_register_sidebars() {
	$sidebars = array(
		array(
			'id'			=> 'sidebar-top-left',
			'name'			=> __( 'Sidebar Top Left', 'gs' ),
			'description'	=> __( 'This is the top left sidebar.', 'gs' ),
		),
		array(
			'id'			=> 'sidebar-rop-right',
			'name'			=> __( 'Sidebar Top Right', 'gs' ),
			'description'	=> __( 'This is the top right sidebar.', 'gs' ),
		),
		array(
			'id'			=> 'home',
			'name'			=> __( 'Home Top', 'lifestyle' ),
			'description'	=> __( 'This is the top homepage section.', 'tl' ),
		),
		array(
			'id'			=> 'home-left',
			'name'			=> __( 'Home Left', 'lifestyle' ),
			'description'	=> __( 'This is the homepage left section.', 'lifestyle' ),
		),
		array(
			'id'			=> 'home-right',
			'name'			=> __( 'Home Right', 'lifestyle' ),
			'description'	=> __( 'This is the homepage right section.', 'lifestyle' ),
		),
		array(
			'id'			=> 'home-middle-left',
			'name'			=> __( 'Home Middle Left', 'gs' ),
			'description'	=> __( 'This is the bottom left homepage section.', 'gs' ),
		),
		array(
			'id'			=> 'home-middle-right',
			'name'			=> __( 'Home Middle Right', 'gs' ),
			'description'	=> __( 'This is the bottom right homepage section.', 'gs' ),
		),
		array(
			'id'			=> 'home-bottom',
			'name'			=> __( 'Home Bottom', 'gs' ),
			'description'	=> __( 'This is the bottom homepage section.', 'gs' ),
		),
		array(
			'id'			=> 'portfolio',
			'name'			=> __( 'Portfolio', 'lifestyle' ),
			'description'	=> __( 'This is the portfolio page template', 'lifestyle' ),
		),
	);
	
	foreach ( $sidebars as $sidebar )
		genesis_register_sidebar( $sidebar );
}

/** Load Genesis */
=======
/** Start the engine */
>>>>>>> parent of df465ef... Refactor functions.php
=======
/** Start the engine */
>>>>>>> parent of df465ef... Refactor functions.php
require_once( get_template_directory() . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/gs-register-scripts.php');//Loads Required Scripts
require_once( CHILD_DIR . '/lib/gs-function-options.php');//Loads Theme Options




/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

<<<<<<< HEAD
<<<<<<< HEAD
/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function gs_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Georgia, Times, serif; min-height: %spx; text-align: center; text-shadow: #666 1px 1px; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1      = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 48px; font-variant: small-caps; font-weight: normal; line-height: 48px; margin: 35px 0 0; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc    = sprintf( '#headimg #desc { color: #%s; font-size: 20px; font-style: italic; line-height: 1; margin: 0; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/**
 * Enqueues Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.js/*.css is the minified version & *.dev.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 */
function gs_scripts() {
	$js_suffix  = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.js' : '.min.js';
	$css_suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.css' : '.min.css';
	
	// Styles
	wp_register_style( 'responsive-main-css', get_stylesheet_directory_uri() . '/lib/css/responsive-main' . $css_suffix, array(), '1.0.0' );
	wp_enqueue_style( 'responsive-css', get_stylesheet_directory_uri() . '/responsive.css', array( 'responsive-main-css' ), array(), '1.0.0' );
	wp_enqueue_style( 'tb-styles', get_stylesheet_directory_uri() . '/lib/css/tb-styles' . $css_suffix, array(), '1.0.0' );
	
	// Scripts
	wp_enqueue_script( 'common-scripts', get_stylesheet_directory_uri() . '/lib/js/common-scripts' . $js_suffix, array( 'jquery' ) , '1.0.0' );
	wp_enqueue_script( 'collapse', get_stylesheet_directory_uri() . '/lib/js/collapse' . $js_suffix, array( 'jquery' ) , '1.0.0' );
	
	// Localize Script
	/*
	$l10n = array(
		'greeting' => __( 'Hello World!', 'gs' ),
	);
	wp_localize_script( 'gs-script', 'gs', $l10n );
	*/
}
=======
=======
>>>>>>> parent of df465ef... Refactor functions.php
/** Add new image sizes **/
add_image_size('post-thumb', 225, 160, TRUE);


/** Edit read more link */
						
/*add_filter( 'excerpt_more', 'remove_excerpt_more' );
	function remove_excerpt_more() {
		return "...";
	}
	add_filter( 'get_the_content_more_link', 'sf_read_more_link' );
	add_filter( 'the_content_more_link', 'sf_read_more_link' );
	function sf_read_more_link() {
	  return '<a class="more-link" href="' .  get_permalink() .  '" rel="nofollow">Read More</a>';
	}*/

/** DUPLICATE IMAGE FIX **/
add_filter('the_content','wpi_image_content_filter',11);
function wpi_image_content_filter($content){
    if (is_home() || is_front_page() || is_archive()){
      $content = preg_replace("/<img[^>]+>/i", "", $content);
    }
    return $content;
<<<<<<< HEAD
}
>>>>>>> parent of df465ef... Refactor functions.php
=======
}
>>>>>>> parent of df465ef... Refactor functions.php
