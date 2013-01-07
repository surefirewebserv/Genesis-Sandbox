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

/**
 * 01 Initialize Sandbox
 * @since 1.1.0
 *
 * Builds various Genesis constants off style.css.
 * Includes various necessary files.
 * Future proofs theme by preventing updates.
 */
require_once( get_stylesheet_directory() . '/lib/init.php');

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
	// Add stuff here.
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
		// Add more here...
		array(
			'id'			=> 'home-top',
			'name'			=> __( 'Home Top', CHILD_DOMAIN ),
			'description'	=> __( 'This is the top homepage section.', CHILD_DOMAIN ),
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

