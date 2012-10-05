<?php 
/* 
 * Loads the Options Panel
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/lib/options/' );
	require_once dirname( __FILE__ ) . '/options/options-framework.php';
}


/**
 * Moves navigation above the header.
 *
 * If the checkbox is selected, the primary navigation will move
 * above the header. 
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 *
 */

$nav_gs_functions = of_get_option( 'gs_basic_functions', 'none' );
if ( $nav_gs_functions['one'] ) {
    remove_action( 'genesis_after_header', 'genesis_do_nav' );
    add_action( 'genesis_before_header', 'genesis_do_nav' );
}


/**
 * Moves subnavigation above the header.
 *
 * If the checkbox is selected, the secondary navigation will move
 * above the header. 
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 *
 */ 

if ( $nav_gs_functions['two'] ) {
    remove_action( 'genesis_after_header', 'genesis_do_subnav' );
    add_action( 'genesis_before_header', 'genesis_do_subnav' );
} 


add_shortcode( 'gs-year', 'gs_creds_year' );
/**
 * Add the current year.
 *
 * Creates a shortcode that adds the current year.
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 *
 * @return Returns the current year.
 */
 
function gs_creds_year() {
     return date( 'Y' );
}


/**
 * Edits the footer credits.
 *
 * If selected, the footer credits can be edited to 
 * whatever you want.
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
*  @uses The [gs_year] shortcode can be used to return the current year.
 *
 */

if ( of_get_option( 'gs_footer_creds_check' ) ) {
	add_filter( 'genesis_footer_creds_text', 'gs_custom_footer_creds_text' );
	function gs_custom_footer_creds_text() {
		$gs_footer_cred_text = of_get_option( 'gs_footer_creds_editor' );
		echo do_shortcode( $gs_footer_cred_text );
	}
	
} else {
	add_filter( 'genesis_footer_creds_text', 'gs_default_footer_creds_text' );
	function gs_default_footer_creds_text() {
		$gs_footer_creds_default = '<div class="creds"><p> Copyright &copy; [gs-year] &middot; <a href="http://genesissandbox.com">Genesis Sandbox Starter Theme</a> &middot; Built on the <a href="http://surefirewebservices.com/go/genesis" title="Genesis Framework">Genesis Framework</a> </p></div>';
		echo do_shortcode( $gs_footer_creds_default );
	}
}


/**
 * Adds Custom Header
 *
 * Add theme support for a custom header.
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 *
 */

$gs_theme_support_functions = of_get_option( 'gs_theme_support_functions', 'none' );
if ( $gs_theme_support_functions['one'] ) {
   $gs_head_width = of_get_option( 'gs_header_width' );
   $gs_head_height = of_get_option( 'gs_header_height' );
    
   add_theme_support( 'genesis-custom-header', array( 'width' => $gs_head_width, 'height' => $gs_head_height ) );
} 


/**
 * Adds Custom Background
 *
 * Add theme support for a custom background.
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 *
 */

if ( $gs_theme_support_functions['two'] ) {
    add_theme_support( 'custom-background' );
} 


/**
 * Adds Genesis Structural Wraps
 *
 * Adds structural wraps to the standards areas in the Genesis Framework
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 *
 */

if ( $gs_theme_support_functions['three'] ) {
$gs_structural_wraps_defaults = array( 'header' => '1', 'nav' => '1', 'subnav' => '1', 'inner' => '1', 'footer-widgets' => '1', 'footer' => '1' );
	$gs_structural_wrap = of_get_option( 'gs_structural_wraps', $gs_structural_wraps_defaults );
	add_theme_support( 'genesis-structural-wraps', array_keys($gs_structural_wrap, 1 ) ); 
}


/**
 * Adds footer widgets.
 *
 * Adds any amount of user specified footer widgets.
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 *
 */

if ( $gs_theme_support_functions['four'] ) {
	$gs_footer_widgets = of_get_option( 'gs_footer_widgets', 'none' );
	add_theme_support( 'genesis-footer-widgets', $gs_footer_widgets );
}


/**
 * Loads Google Fonts
 *
 * Correctly loads Google Fonts in the Genesis Framework
 * according to Brian Gardners Post
 *
 * @since 1.0.0
 * @author Sure Fire Web Services
 * @link http://www.briangardner.com/load-google-fonts/
 *
 */

if ( of_get_option( 'gs_google_fonts_check' ) ) {
	
	add_action( 'wp_enqueue_scripts', 'gs_load_google_fonts' );
	function gs_load_google_fonts() {
	$gs_google_fonts_font = of_get_option( 'gs_google_fonts_font', 'none' );
	    wp_enqueue_style( 
	        'google-fonts', 
	        'http://fonts.googleapis.com/css?family='. $gs_google_fonts_font, 
	        array(), 
	        PARENT_THEME_VERSION 
	     );
	}    
}