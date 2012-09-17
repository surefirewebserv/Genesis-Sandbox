<?php 
/** Add Twitter Bootstrap Styles, Buttons, Code, Labels, Badges **/
add_action( 'wp_enqueue_scripts', 'gsb_tb_script' );
function gsb_tb_script() {
	$css_suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '.min.css' : '.css';
	wp_enqueue_style('tb_styles', get_stylesheet_directory_uri() . '/lib/css/tb_styles' . $css_suffix);
}
