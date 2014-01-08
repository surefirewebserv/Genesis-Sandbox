<?php 

/**
 * Script Register and Enqueue
 *
 * @package      Genesis Sandbox Clean
 * @author       Jonathan Perez
 * @copyright    Copyright (c) 2013, SureFireWebServices
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.1.0
 */

/*
Scripts
---------------------------------------------------------------------------------------------------- */
add_action( 'init', 'gs_register_scripts' );
/**
 * Registers Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.min.js/*.min.css is the minified version & *.js is beautified version.
 * To make the styles appear AFTER your base style, in the array(), place sanitize_title_with_dashes( CHILD_THEME_NAME )
 * so that: array( sanitize_title_with_dashes( CHILD_THEME_NAME ) )
 * e.g., wp_register_style( 'gs-twitter-bootstrap', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array( sanitize_title_with_dashes( CHILD_THEME_NAME ) ), '1.0.0' );
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 * @uses gs_script_suffix() Adds proper CSS/JS suffix based on WP_DEBUG or SCRIPT_DEBUG
 */
function gs_register_scripts() {
	
	/**
	 * Twitter Bootstrap CSS
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://twitter.github.com/bootstrap/
	 */
	wp_register_style( 'gs-twitter-bootstrap', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array(), '3.0.3' );
	//wp_register_style( 'gs-twitter-bootstrap-cdn', '//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css', array(), '3.0.3' );
	
	// Twitter Bootstrap CSS (Font Awesome version)
	//wp_register_style( 'gs-twitter-bootstrap-font-awesome', '//netdna.bootstrapcdn.com/twitter-bootstrap/4.0.3/css/bootstrap-combined.no-icons.min.css', array(), '4.0.3' );
	
	/**
	 * Twitter Bootstrap JS
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://twitter.github.com/bootstrap/
	 */
	//wp_register_script( 'gs-twitter-bootstrap', CHILD_JS . '/' . gs_script_suffix( 'bootstrap', 'js' ), array( 'jquery' ), '3.0.3' );
	wp_register_script( 'gs-twitter-bootstrap-cdn', '//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js', array( 'jquery' ), '3.0.3' );
	
	/**
	 * Font Awesome
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://fortawesome.github.com/Font-Awesome/
	 */
	//wp_register_style( 'gs-font-awesome', CHILD_CSS . '/' . gs_script_suffix( 'font-awesome', 'css' ), array(), '4.0.3' );
	wp_register_style( 'gs-font-awesome-cdn', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '1.0.0' );
	

	/**
	 * Animate.css
	 * @link https://daneden.me/animate/
	 * @link https://github.com/daneden/animate.css
	 */
	//wp_register_style( 'gs-animate', CHILD_CSS . '/' . gs_script_suffix( 'animate', 'css' ), array(), '4.0.3' );
	
	
	
	/**
	 * Pretty Photo
	 * @link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
	 * @link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/documentation
	 */
	wp_register_style( 'gs-pretty-photo', CHILD_CSS . '/' . gs_script_suffix( 'prettyPhoto', 'css' ), array(), '3.1.4' );
	wp_register_script( 'gs-pretty-photo', CHILD_JS . '/' . gs_script_suffix( 'jquery.prettyPhoto', 'js' ), array( 'jquery' ), '3.1.4' );
	
	/** Common, site specific */
	wp_register_script( 'gs-common', CHILD_JS . '/' . gs_script_suffix( 'common' ), array( 'jquery' ) , CHILD_THEME_VERSION );
	
}

/**
 * Enqueues Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.min.js/*.min.css is the minified version & *.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 */
function gs_enqueue_scripts() {
	// You can Also register scripts right before enqueing OR simply enqueue the script without registering.
	// See gs_register_scripts() for examples.
	
	// Styles
	wp_enqueue_style( 'gs-twitter-bootstrap' );
	
	/**  gs-twitter-bootstrap-font-awesome will overwrite most of the styles in the style sheet.
	 *   Only activate it if you wish to purely use all of the Bootstrap Styles and Font Awesome Together */
	//wp_enqueue_style( 'gs-twitter-bootstrap-font-awesome' );
	
	wp_enqueue_style( 'gs-font-awesome-cdn' );
	//wp_enqueue_style( 'gs-pretty-photo' );
	
	// Scripts
	//wp_enqueue_script( 'gs-twitter-bootstrap' );
	//wp_enqueue_script( 'gs-pretty-photo' );
	//add_action( 'wp_footer', 'gs_init_pretty_photo' );
	//wp_enqueue_script( 'gs-animate' );
	wp_enqueue_script( 'gs-common' );
	
	// Localize Script
	/*
	// This enables you to create variable variables in JS that will be referred to as gs.greeting
	$l10n_args = array(
		//REFERENCE => VALUE, example in next line, CHILD_DOMAIN is the text domain for internationalization.
		'greeting'  => __( 'Hello World!', CHILD_DOMAIN ),
	);
	
	// @link http://codex.wordpress.org/Function_Reference/wp_localize_script
	// wp_localize_script( REGISTERED-HANDLE, OBJECT_NAME, OBJECT_DATA );
	wp_localize_script( 'gs-common-scripts', 'gs', $l10n_args );
	*/
}