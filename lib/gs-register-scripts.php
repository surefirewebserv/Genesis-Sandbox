<?php 

add_action( 'wp_enqueue_scripts', 'gs_child_script' );

/**
 * Enqueues Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.js/*.css is the minified version & *.min.js/*.min.css is beautified version.
 *
 * @uses wp_enqueue_script() and wp_enqueue_style() WP adds JS and CSS to page safely.
 */
function gs_child_script() {
	$js_suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.min.js' : '.js';
	$css_suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.min.css' : '.css';
	
	//Styles
	wp_register_style('responsive-main-css', get_stylesheet_directory_uri() . '/lib/css/responsive-main' . $css_suffix);
	wp_enqueue_style( 'responsive-css', CHILD_URL . '/responsive.css', array('responsive-main-css') );
	wp_enqueue_style('tb_styles', get_stylesheet_directory_uri() . '/lib/css/tb-styles' . $css_suffix);
	
	//Scripts
	wp_enqueue_script( 'common_scripts', get_stylesheet_directory_uri() . '/lib/js/common-scripts' . $js_suffix, array( 'jquery' ) , '1.0.0' );
	
}