<?php 
add_action( 'wp_enqueue_scripts', 'wps_child_script' );
/**
 * Enqueues Appropriate Scripts when needed based on Debugging.
 * Assumes that the normal *.js is the minified version & *-dev.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 */
 
 
function wps_child_script() {
	$suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '-min.js' : '.js';
	wp_enqueue_script( 'responsive-nav', get_stylesheet_directory_uri() . '/lib/js/responsive-nav' . $suffix, array( 'jquery' ) , '1.0.0' );
	wp_enqueue_style( 'responsive', CHILD_URL . '/responsive.css');
}