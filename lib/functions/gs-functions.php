<?php 

/**
 * Add footer scripts when another SEO plugin is active.
 *
 * @category   Genesis_Sandbox
 * @package    Functions
 * @subpackage Functions
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.0.0
 */

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'Cheatin&#8217; uh?' );

add_action( 'wp_footer', 'gs_footer_scripts' );
/**
 * Echo footer scripts in to wp_footer().
 *
 * Allows shortcodes.
 *
 * Applies genesis_header_scripts on value stored in header_scripts setting.
 *
 * Also echoes scripts from the post's custom field.
 *
 * @since 1.0.0
 *
 * @uses genesis_get_option() Get theme setting value
 * @uses genesis_get_custom_field() Echo custom field value
 */
function gs_footer_scripts() {

	/** If singular, echo scripts from custom field */
	if ( is_singular() && genesis_get_custom_field( '_genesis_footer_scripts' ) )
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
function gs_move_function( $function, $newhook, $priority = 10, $args = 2 ) {
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

/**
 * Replace genesis_* functions hooked into somewhere for gs_* functions
 * of the same suffix, at the same hook and priority
 *
 * Run at get_header to catch all customisations in functions.php
 * 
 * @author Gary Jones
 *
 * @global array $wp_filter 
 * @param  array $functions Array of function names without genesis_ prefix. 
 */
function gs_replace_functions( $functions ) {
	
	global $wp_filter;

	// Loop through all hooks (yes, stored under the $wp_filter global)
	foreach ( $wp_filter as $hook => $priority)  {
		
		// Loop through our array of functions for each hook
		foreach( $functions as $function) {
			
			// has_action returns int for the priority
			if ( $priority = has_action( $hook, 'genesis_' . $function ) ) {
				
				// If there's a function hooked in, remove the genesis_* function 
				// from whichever hook we're looping through at the time.
				remove_action( $hook, 'genesis_' . $function, $priority );
				
				// Add a replacement function in at the same time.
				add_action( $hook, 'gs_' . $function, $priority );
			}
		}
	}
	
}

/**
 * Add navigation menu to the top.
 *
 * @since 1.0.0
 */
function gs_navigation( $location, $args ) {
	if ( ! has_nav_menu( $location ) )
		return;

	$defaults = array(
		'theme_location' => $location,
		'container'       => 'nav',
		'container_id'   => $location . '-nav',
		'container_class' => $location . '-nav',
		'menu_class'     => 'genesis-nav-menu menu menu-' . $location,
		'echo'           => false,
	);
	
	$args = wp_parse_args( $args, $defaults );
	$nav = wp_nav_menu( $args );
	
	$nav_output = sprintf(
		'<nav id="%1$s" class="%2$s">%4$s%3$s%5$s</nav>', 
		$location . '-nav', 
		'genesis-nav-menu menu menu-' . $location,
		$nav, 
		genesis_structural_wrap( 'nav', 'open', 0 ), 
		genesis_structural_wrap( 'nav', 'close', 0 ) 
	);
		
	return $nav_output;
}

add_action( 'after_setup_theme', 'gs_responsive', 5 );
/**
 * Create Responsive Functions.
 * Genesis 2.0 will have something different yet similiar.
 */
function gs_responsive() {

	if ( current_theme_supports( 'gs-responsive' ) ) {
		//add_action( 'wp_head', 'genesis_responsive_viewport' );
		
		/** Roll our own due to genesis_responsive_viewport() possible changes */
		add_action( 'wp_head', 'gs_responsive_viewport' );
		add_action( 'wp_enqueue_scripts', 'gs_enqueue_responsive_stylesheet' );
	}
}

/**
 * If child theme supports responsive, look for and enqueue responsive.css.
 *
 * File (responsive.css) can be located either in the root theme directory, or in a /css subdirectory.
 *
 * @since 1.9.0
 */
function gs_enqueue_responsive_stylesheet() {

	$stylesheet = genesis_get_theme_support_arg( 'gs-responsive', 'css' );

	if ( ! $stylesheet )
		return;

	$handle = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title( CHILD_THEME_NAME, 'child-theme' ) . '-responsive' : 'child-theme-responsive';

	if ( file_exists( $stylesheet['dir'] ) ) {
		$version = defined( 'CHILD_THEME_VERSION' ) && CHILD_THEME_VERSION ? CHILD_THEME_VERSION : PARENT_THEME_VERSION;
		$deps    = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';
		wp_enqueue_style( $handle, $stylesheet['src'], array( $deps ), $version );
		return;
	}

}

add_action( 'wp_head', 'gs_responsive_viewport' );
/**
 * Checks to see if the child theme supports Genesis responsive CSS viewport tag. If so, it echos it.
 *
 * @since 1.9.0
 */
function gs_responsive_viewport() {

	if ( true === $viewport = genesis_get_theme_support_arg( 'gs-responsive', 'viewport' ) )
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
	elseif ( $viewport = genesis_get_theme_support_arg( 'gs-responsive', 'viewport' ) )
		echo $viewport;

}

/**
 * Creates proper script/style suffix based on WP_DEBUG or SCRIPT_DEBUG.
 *
 * @see wp_default_scripts() for min/dev pattern.
 *
 * @param string $script Script filename basename.
 * @param string $suffix Script suffix: 'css' or 'js'
 * @param string $min Minimization abbreviation. Default = '.min'.
 * @param string $dev Development abbreviation. Default = ''.
 */
function gs_script_suffix( $script, $suffix = 'js', $min = '.min', $dev = '' ) {
	// Suffix Sanitization
	if ( 'js' != $suffix && 'css' != $suffix )
		$suffix = 'js';

	$script  = ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) ? $script . "$dev.$suffix" : $script . "$min.$suffix";

	return $script;
}

add_action( 'admin_notices', 'gs_theme_files_to_edit' );
/**
 * Remove the specific theme files from the Theme Editor
 *
 * @since 1.1.0
 *
 * @global array $allowed_files Array of allowed files.
 * @global WP_Theme Object $theme Current Theme WP_Theme Object.
 * @global string $current_screen Reference to current screen.
 */
function gs_theme_files_to_edit() {

	global $allowed_files, $theme, $current_screen;

	/** Check to see if we are on the editor page */
	if ( 'theme-editor' == $current_screen->id ) {
		/** Do not change anything if we are in the Genesis theme */
		if ( $theme->Name == CHILD_THEME_NAME ) {
			/** Remove files */
			foreach ( array( 'lib/init.php', 'alt/functions-alt.php', 'alt/gs-functions-alt.php', 'alt/init-alt.php', 'alt/init.php', 'languages/index.php', ) as $f )
				unset( $allowed_files[ $f ] );
		}
	}

}

/*
 * Usage for a custom post type named 'movies':
 * unregister_post_type( 'movies' );
 *
 * Usage for the built in 'post' post type:
 * unregister_post_type( 'post', 'edit.php' );
 *
 * To be used on admin_menu hook.
*/
function gs_unregister_post_type( $post_type, $slug = '' ){
	
	global $wp_post_types;
	
	if ( isset( $wp_post_types[ $post_type ] ) ) {
            unset( $wp_post_types[ $post_type ] );
        	
            $slug = ( !$slug ) ? 'edit.php?post_type=' . $post_type : $slug;
            remove_menu_page( $slug );
	}
}

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_before_footer', 'gs_footer_widget_areas' );
/**
 * Echos the markup necessary to facilitate the footer widget areas.
 *
 * Checks for a numerical parameter given when adding theme support - if none is
 * found, then the function returns early.
 *
 * Adds column classes based on number of footer widgets registered.
 *
 * @uses gs_column_class() Gets column class name for footer widgets 2-6.
 *
 * @since 1.1.0
 *
 * @return null Returns early if number of widget areas could not be determined,
 * or nothing is added to the first widget area
 */
function gs_footer_widget_areas() {

	$footer_widgets = get_theme_support( 'genesis-footer-widgets' );

	if ( ! $footer_widgets || ! isset( $footer_widgets[0] ) || ! is_numeric( $footer_widgets[0] ) )
		return;

	$footer_widgets = (int) $footer_widgets[0];

	/**
	 * Check to see if first widget area has widgets. If not,
	 * do nothing. No need to check all footer widget areas.
	 */
	if ( ! is_active_sidebar( 'footer-1' ) )
		return;

	$output  = '';
	$counter = 1;

	while ( $counter <= $footer_widgets ) {
		/** Darn you, WordPress! Gotta output buffer. */
		ob_start();
		dynamic_sidebar( 'footer-' . $counter );
		$widgets = ob_get_clean();
		
		/** Dynamically create column classes. */
		$class = 1 == (int) $counter ? 'first ' : '';
		$class .= gs_column_class( $footer_widgets );
		
		$output .= sprintf( '<div class="footer-widgets-%1$d widget-area %2$s">%3$s</div>', $counter, $class, $widgets );

		$counter++;
	}

	echo apply_filters( 'genesis_footer_widget_areas', sprintf( '<div id="footer-widgets" class="footer-widgets gs-footer-widgets-%4$s">%2$s%1$s%3$s</div>', $output, genesis_structural_wrap( 'footer-widgets', 'open', 0 ), genesis_structural_wrap( 'footer-widgets', 'close', 0 ), $footer_widgets ) );

}

/**
 * Gets the column class for 2-6 footer widgets.
 *
 * @since 1.1.0
 *
 * @return string Column class name.
 */
function gs_column_class( $i ) {
	switch ( $i ) {
		case 1:
			return '';
		case 2:
			return 'one-half';
		case 3:
			return 'one-third';
		case 4:
			return 'one-fourth';
		case 5:
			return 'one-fifth';
		case 6:
			return 'one-sixth';
		default:
			return '';
	}
}

/**
 * Instantiate Pretty Photo
 *
 * @param array $args Future Development
 */
function gs_init_pretty_photo( $args = array() ) { ?>
<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function($){
    $("a[href$='.jpg'], a[href$='.gif'], a[href$='.png'], .prettyPhoto").prettyPhoto();
  });
</script>
<?php
}

/**
 * Add Genesis Sandbox Responsive Styles
 * Roll own responsive functions
 * @uses gs_script_suffix() Adds proper CSS/JS suffix based on WP_DEBUG or WP_SCRIPT_DEBUG.
 */
add_theme_support(
	'gs-responsive', 
	array(
		'css'      => array(
			'src' => CHILD_CSS . '/' . gs_script_suffix( 'responsive', 'css' ), 
			'dir' => CHILD_CSS_DIR . '/' . gs_script_suffix( 'responsive', 'css' ), 
		),
		/** 
		 * Default: <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
		 * To over-ride just enter your meta tag instead of true.
		 */
		'viewport' => true,
	)
);



