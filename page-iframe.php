<?php

/**
 * Template Name: iFrame Template
 *
 * This file creates a basic iFrame template for
 * the page to be embeded on/in another page/site.
 *
 * @category   Genesis_Sandbox
 * @package    Templates
 * @subpackage Page
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

/** Remove Header */
remove_all_actions( 'genesis_header' );
//remove_action( 'genesis_header', 'genesis_header_markup_open', 5);
//remove_action( 'genesis_header', 'genesis_do_header' );
//remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

/** Remove Navs */
remove_all_actions( 'genesis_after_header' );
//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//remove_action( 'genesis_after_header', 'genesis_do_subnav' );

/** Remove Footer */
remove_all_actions( 'genesis_footer' );
//remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
//remove_action( 'genesis_footer', 'genesis_do_footer' );
//remove_action( 'genesis_footer', 'gs_do_footer' );
//remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

/** Remove Footer Widgets */
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

/** Remove Breadcrumbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

/** Remove Post Title */
remove_action( 'genesis_post_title', 'genesis_do_post_title' );

add_filter( 'body_class', 'gs_add_iframe_body_class' );
/**
 * Add page specific body class
 *
 * @param $classes array Body Classes
 * @return $classes array Modified Body Classes
 */
function gs_add_iframe_body_class( $classes ) {
   $classes[] = 'iframe';
   return $classes;
}

genesis();
