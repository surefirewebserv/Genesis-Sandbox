<?php

/**
 * Admin Functions
 *
 * This file controls the various front general functions,
 * adds custom header functionality with a default header,
 * adds styles to Tiny MCE, filters favicon, adds a custom 
 * Avatar, ability to change Avatar size, removes version
 * generator (security).
 *
 * @category   Genesis_Sandbox
 * @package    Admin
 * @subpackage Functions
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

/** Table of Contents
 * Editor Style
 * Admin Footer
 */

/* Editor Style
------------------------------------------------------------ */

add_filter( 'mce_buttons_3', 'gs_mce_buttons_3' );
/**
 * Show the style dropdown on the THIRD row of the editor toolbar.
 *
 * This code also adds the font family and font size dropdowns too, along with a horizontal rule button, and backcolor.
 *
 * @link http://www.tinymce.com/wiki.php/Buttons/controls
 * @param array $buttons Exising buttons
 * @return array $buttons Amended buttons
 */
function gs_mce_buttons_3( array $buttons ) {

	$additional_buttons = array( 'styleselect', 'fontselect', 'fontsizeselect', 'hr', 'backcolor' );

	return array_unique( array_merge( $buttons, $additional_buttons ) );

}

add_filter( 'tiny_mce_before_init', 'gs_mce_before_init' );
/**
 * Add column entries to the style dropdown.
 *
 * @param array $settings Existing settings for all toolbar items
 * @return array $settings Amended settings
 */
function gs_mce_before_init( array $settings ) {

	$style_formats = array(
		array( 'title' => __( 'Columns', CHILD_DOMAIN ), ),
		array(
			'title' => __( 'First Half', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-half first',
		),
		array(
			'title' => __( 'Half', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-half',
		),
		array(
			'title' => __( 'First Third', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-third first',
		),
		array(
			'title' => __( 'Third', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-third',
		),
		array(
			'title' => __( 'First Quarter', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-fourth first',
		),
		array(
			'title' => __( 'Quarter', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-fourth',
		),
		array(
			'title' => __( 'First Fifth', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-fifth first',
		),
		array(
			'title' => __( 'Fifth', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-fifth',
		),
		array(
			'title' => __( 'First Sixth', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-sixth first',
		),
		array(
			'title' => __( 'Sixth', CHILD_DOMAIN ),
			'block' => 'div',
			'classes' => 'one-sixth',
		),
	);

	// Check if there are some styles already
	if ( isset( $settings['style_formats'] ) ) {
		// Decode any existing style formats
		$existing_style_formats = json_decode( $settings['style_formats'] );

		// Merge our new formats with any existing formats and re-encode
		$settings['style_formats'] = json_encode( array_merge( (array) $existing_style_formats, $style_formats ) );
	} else {
		$settings['style_formats'] = json_encode( $style_formats );
	}

	return $settings;

}

add_filter( 'admin_footer_text', 'gs_admin_footer' );
/**
 * Modify Admin Footer Text and Logo
 *
 */
function gs_admin_footer() {
	echo '<span id="footer-thankyou">Thank you for creating with <a href="http://wordpress.org/">WordPress</a> &amp; <a href="' . CHILD_THEME_URL . '">' . CHILD_THEME_NAME . '</a> designed by <a href="' . CHILD_THEME_URL . '">' . CHILD_DEVELOPER . '</a></span>';
} 

