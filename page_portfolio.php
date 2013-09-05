<?php

/**
 * Template Name: Portfolio Template
 *
 * This file is responsible for generating a widgetized
 * portfolio page template forcing a full-width
 * layout, removes post info & post meta and adds portfolio class.
 *
 * @category   Genesis_Sandbox
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'Cheatin&#8217; uh?' );

/** Remove Post Info / Meta */
remove_action( 'genesis_entry_header', 'genesis_post_info' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );  

// Force Layout (allows user over-ride)
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Force Layout (does not allow user over-ride)
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

add_filter( 'body_class', 'gs_add_portfolio_body_class' );
/**
 * Add page specific body class
 *
 * @param $classes array Body Classes
 * @return $classes array Modified Body Classes
 */
function gs_add_portfolio_body_class( $classes ) {
   $classes[] = 'portfolio-widgetized';
   return $classes;
}

add_filter('post_class', 'sf_post_class');
/**
 * Add post class filter
 *
 * Uses the column classes to make a grid.
 *
 * @category   Grid Loop
 * @author     Jonathan Perez, SureFireWebServices <jperez@surefirewebservices.com>
 * @version    1.0
 * @link       http://surefirewebservices.com
 */
function sf_post_class($classes) {    
	global $wp_query;
	$loop_counter = $wp_query->current_post;// Post Counter
     
    if ($loop_counter >= 0) { // Everything after the first 2 posts.
    $classes[] = 'one-third';
    }
    if ($loop_counter % 3 == 0) {
       
    $classes[] .= 'first '; //Add Last class to every 3rd post.
    }
    return $classes;
}

// Remove default content / loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'gs_portfolio_widget_page' );
/**
 * Add the Portfolio widget area
 *
 * @uses genesis_widget_area() Conditionally displays a sidebar, wrapped in a div by default.
 */
function gs_portfolio_widget_page() {
	genesis_widget_area(
		'portfolio', 
		array( 'before' => '<div class="portfolio widget-area">', ) 
	);
}


genesis();