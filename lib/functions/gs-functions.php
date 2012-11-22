<?php 

/**
 * Add footer scripts when another SEO plugin is active.
 *
 * @category   Genesis_Sandbox
 * @package    Functions
 * @subpackage Functions
 * @author     Travis Smith, for Surefire Themes
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.0.0
 */

add_action( 'wp_footer', 'gs_footer_scripts' );
/**
 * Echo header scripts in to wp_head().
 *
 * Allows shortcodes.
 *
 * Applies genesis_header_scripts on value stored in header_scripts setting.
 *
 * Also echoes scripts from the post's custom field.
 *
 * @since 0.2.3
 *
 * @uses genesis_get_option() Get theme setting value
 * @uses genesis_get_custom_field() Echo custom field value
 */
function gs_footer_scripts() {

	/** If singular, echo scripts from custom field */
	if ( is_singular() )
		genesis_custom_field( '_genesis_footer_scripts' );

}

/**
 * Moves a function to a new hook
 *
 * @author Travis Smith
 * @since 1.1.0
 * @global array $wp_filter
 * @param string Function name.
 * @param string Hook to place function.
 * @param string Priority (defaults to 10).
 * @param string Number of accepted arguments (defaults to 2).
 */
function gs_move_function( $function, $hook, $priority = 10, $args = 2 ) {
	gs_remove_function( $function );
	add_action( $newhook, $function, $priority, $args );
}

/**
 * Removes a function hooked into somewhere
 *
 * @author Travis Smith
 * @since 1.1.0
 * @param string function name
 * @global array $wp_filter
 */
function gs_remove_function( $function ) {
    global $wp_filter;
 
    // Loop through all hooks (yes, stored under the $wp_filter global)
    foreach ( $wp_filter as $hook => $priority)  {
 
		// has_action returns int for the priority
		if ( $priority = has_action( $hook, $function ) ) {

			// If there's a function hooked in, remove the genesis_* function
			// from whichever hook we're looping through at the time.
			remove_action( $hook, $function, $priority );
		}
    }
}
