<?php 
add_action( 'wp_enqueue_scripts', 'wps_child_script' );
/**
 * Enqueues Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.js/*.css is the minified version & *.dev.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 */
 
 
function wps_child_script() {
	$suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.min.js' : '.js';
	$css_suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.min.css' : '.css';
	wp_register_style('responsive-main-css', get_stylesheet_directory_uri() . '/lib/css/responsive-main' . $css_suffix);
	wp_enqueue_script( 'responsive-nav', get_stylesheet_directory_uri() . '/lib/js/responsive-nav' . $suffix, array( 'jquery' ) , '1.0.0' );
	wp_enqueue_style( 'responsive-css', CHILD_URL . '/responsive.css', array('responsive-main-css') );
}