<?php

/**
 * Template Name: Landing Page Template (Alt)
 *
 * This file adds the Landing template. This file uses gs_remove_function() to remove
 * the function regardless of the hook its placed on.
 *
 * @category   Genesis_Sandbox
 * @package    Templates
 * @subpackage Page
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'Cheatin&#8217; uh?' );

add_filter( 'body_class', 'gs_add_portfolio_body_class' );
/**
 * Add page specific body class
 *
 * @param $classes array Body Classes
 * @return $classes array Modified Body Classes
 */
function gs_add_portfolio_body_class( $classes ) {
   $classes[] = 'landing';
   return $classes;
}

/** Force Layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

/** Remove Header, Nav, Subnav, Breadcrumbs, Footer Widgets, Footer */
foreach ( array( 'genesis_header_markup_open', 'genesis_do_header', 'genesis_header_markup_close', 'genesis_do_nav', 'genesis_do_subnav', 'genesis_do_breadcrumbs', 'genesis_footer_widget_areas', 'genesis_footer_markup_open', 'genesis_do_footer', 'genesis_footer_markup_close', ) as $function )
	gs_remove_function( $function );

genesis();