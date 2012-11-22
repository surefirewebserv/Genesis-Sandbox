<?php

/**
 * Init File
 *
 * This file defines the Child Theme's constants & tells WP not to update.
 *
 * @package      Incipio\Custom
 * @author       Travis Smith, for Gamajo Tech
 * @copyright    Copyright (c) 2012, Travis Smith
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0.0
 */
 
add_action( 'genesis_init', 'gs_constants', 15 );
/**
 * This function defines the Genesis Child theme constants
 *
 * @since 1.0.0
 */
function gs_constants() {
	$theme = wp_get_theme();
	// Child theme (Change but do not remove)
		/** @type constant Child Theme Options/Settings. */
		define( 'CHILD_SETTINGS_FIELD', $theme->TextDomain . '-settings' );
		
		/** @type constant Child Theme Version. */
		define( 'CHILD_THEME_VERSION', $theme->Version );
	
		/** @type constant Child Theme Name, used in footer. */
		define( 'CHILD_THEME_NAME', $theme->Name );
		
		/** @type constant Child Theme URL, used in footer. */
		define( 'CHILD_THEME_URL', $theme->ThemeURI );
	
	// Developer Information, see lib/admin/admin-functions.php
		/** @type constant Child Theme Developer, used in footer. */
		define( 'CHILD_DEVELOPER', $theme->Author );
		
		/** @type constant Child Theme Developer URL, used in footer. */
		define( 'CHILD_DEVELOPER_URL', $theme->AuthorURI  );
		
}

add_action( 'genesis_init', 'incipio_init', 15 );
/**
 * This function calls necessary child theme files
 *
 * @since 1.0.0
 */
function incipio_init() {
		
	/** Theme Specific Functions */
	include_once( CHILD_DIR . '/lib/functions/gs-functions.php' );	
	
	// Load admin files when necessary
	if ( is_admin() ) {
	
		/** New Admin Page */
		include_once( CHILD_DIR . '/lib/admin/gs-settings.php');
		
		/** Inpost Metaboxes */
		include_once( CHILD_DIR . '/lib/admin/gs-inpost-functions.php');
		
	}
	
}

add_filter( 'http_request_args', 'gs_prevent_theme_update', 5, 2 );
/**
 * Don't update theme from .org repo.
 *
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @since 1.0.0
 *
 * @author Mark Jaquith
 * @link   http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 */
function gs_prevent_theme_update( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[get_option( 'template' )] );
	unset( $themes[get_option( 'stylesheet' )] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}
