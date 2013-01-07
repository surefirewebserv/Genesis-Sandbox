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
 * @since      1.1.0
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
 * @since 1.1.0
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
 * Add navigation menu to the top.
 *
 * @since 1.1.0
 */
function gs_navigation( $location, $args ) {
	if ( ! has_nav_menu( $location ) )
		return;

	$defaults = array(
		'theme_location'  => $location,
		'container_id'    => $location . '-nav',
		'container_class' => 'menu',
	);
	
	$args = wp_parse_args( $args, $defaults );

	return wp_nav_menu( $args );
}

add_action( 'after_setup_theme', 'gs_responsive', 5 );
/**
 * Utilize the dormant Genesis 2.0.0 Responsive Functions.
 */
function gs_responsive() {

	if ( current_theme_supports( 'genesis-responsive' ) ) {
		add_action( 'wp_head', 'genesis_responsive_viewport' );
		add_action( 'wp_enqueue_scripts', 'genesis_enqueue_responsive_stylesheet' );
	}
}

/**
 * Utilize the dormant Genesis 2.0.0 Responsive Functions.
 *
 * @see wp_default_scripts() for min/dev pattern.
 *
 * @param string $script Script filename basename.
 * @param string $suffix Script suffix: 'css' or 'js'
 * @param string $min Minimization abbreviation. Default = '.min'.
 * @param string $dev Development abbreviation. Default = ''.
 */
function gs_script_suffix( $script, $suffix = 'js', $min = '.min', $dev = '' ) {
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
			foreach ( array( 'functions-alt.php', 'lib/init-alt.php', 'lib/init.php' ) as $f )
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

/** 
 * Edit excerpt read more link
 *
 * @param  string $more Read More Text, , default: ' ' . '[...]'
 * @return string Modified Read More Text.
 */
function gs_remove_excerpt_more( $more ) {
	return '...';
}

/** 
 * Edit read more link.
 *
 * @param  string $link HTML Read More Link, default: sprintf( '&#x02026; <a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text = '(more...)' ).
 * @return string Modified HTML Read More Link.
 */
function gs_read_more_link( $link ) {
	return '<a class="more-link" href="' .  get_permalink() .  '" rel="nofollow">Read More</a>';
}

/**
 * Custom header callback.
 *
 * It outputs special CSS to the document head, modifying the look of the header
 * based on user input.
 */
function gs_header_style() {
	/** If no options set, don't waste the output. Do nothing. */
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && HEADER_IMAGE == get_header_image() )
		return;

	/** Header image CSS */
	$output = sprintf( '#title-area { background: url(%s) #0a84c9 no-repeat; }', esc_url( get_header_image() ) );

	/** Header text color CSS, if showing text */
	if ( 'blank' != get_header_textcolor() )
		$output .= sprintf( '#title a, #title a:hover, #description { color: #%s; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%s</style>', $output );

}

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 * @see genesis_custom_header_admin_style() For comparison & the default genesis-custom-background admin callback function.
 */
function gs_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Georgia, Times, serif; min-height: %spx; text-align: center; text-shadow: #666 1px 1px; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1      = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 48px; font-variant: small-caps; font-weight: normal; line-height: 48px; margin: 35px 0 0; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc    = sprintf( '#headimg #desc { color: #%s; font-size: 20px; font-style: italic; line-height: 1; margin: 0; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );
	
}

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
	wp_register_style( 'gs-twitter-bootstrap', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array(), '1.0.0' );
	// Twitter Bootstrap Responsive may conflict with your child theme
	//wp_register_style( 'gs-twitter-bootstrap-responsive', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap-responsive', 'css' ), array( 'gs-twitter-bootstrap' ), '1.0.0' );
	wp_register_style( 'gs-twitter-bootstrap-cdn', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css', array(), '2.2.2' );
	
	// Twitter Bootstrap CSS (Font Awesome version)
	wp_register_style( 'gs-twitter-bootstrap-font-awesome', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap.no-icons.min.css', array(), '2.1.1' );
	
	/**
	 * Twitter Bootstrap JS
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://twitter.github.com/bootstrap/
	 */
	wp_register_script( 'gs-twitter-bootstrap', CHILD_JS . '/' . gs_script_suffix( 'bootstrap', 'js' ), array( 'jquery' ), '2.2.2' );
	wp_register_script( 'gs-twitter-bootstrap-cdn', '//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js', array( 'jquery' ), '2.2.2' );
	
	/**
	 * Font Awesome
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://fortawesome.github.com/Font-Awesome/
	 */
	wp_register_style( 'gs-font-awesome', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array(), '1.0.0' );
	wp_register_style( 'gs-font-awesome-cdn', '//netdna.bootstrapcdn.com/font-awesome/2.0/css/font-awesome.css', array(), '2.2.2' );
	wp_register_style( 'gs-font-awesome-ie7', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array(), '1.0.0' );
	wp_register_style( 'gs-font-awesome-ie7-cdn', '//netdna.bootstrapcdn.com/font-awesome/2.0/css/font-awesome-ie7.css', array(), '2.2.2' );
	
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
	//wp_enqueue_style( 'gs-twitter-bootstrap' );
	//wp_enqueue_style( 'gs-twitter-bootstrap-font-awesome' );
	//wp_enqueue_style( 'gs-font-awesome' );
	//wp_enqueue_style( 'gs-pretty-photo' );
	
	// Scripts
	//wp_enqueue_script( 'gs-twitter-bootstrap' );
	//wp_enqueue_script( 'gs-pretty-photo' );
	//add_action( 'wp_footer', 'gs_init_pretty_photo' );
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

/**
 * Add navigation menu to the top.
 *
 * @since 1.1.0
 * @uses gs_navigation() Sandbox Navigation Helper Function.
 */
function gs_top_navigation() {
	
	$top_menu_args = array(
		'echo' => true,
	);
	
	gs_navigation( 'top', $top_menu_args );
}

/**
 * Add navigation menu to mobile.
 *
 * @since 1.1.0
 * @uses gs_navigation() Sandbox Navigation Helper Function.
 */
function gs_mobile_navigation() {
	
	$mobile_menu_args = array(
		'echo' => true,
	);
	
	gs_navigation( 'mobile', $mobile_menu_args );
}

/**
 * Add navigation menu to the top.
 *
 * @since 1.1.0
 * @uses gs_navigation() Sandbox Navigation Helper Function.
 */
function gs_footer_navigation() {
	
	$footer_menu_args = array(
		'depth' => 1,
	);
	
	return gs_navigation( 'footer', $footer_menu_args );
}

/**
 * Customize Contact Methods
 * This removes jabber, yim, & aim default contact methods.
 * @since 1.1.0
 *
 * @param  array $contactmethods Array of contact methods and their labels.
 * @return array $contactmethods Modified Contact Methods.
 */
function gs_contactmethods( $contactmethods ) {
	$contactmethods = array ( 'twitter' => __( 'Twitter Name (no @)', CHILD_DOMAIN ) );
	
	return $contactmethods;
}

/**
 * Custom Footer based on options
 *
 * @uses CHILD_SETTINGS_FIELD
 * @uses genesis_get_option()
 * @uses wpautop()
 * @uses gs_footer_navigation()
 */
function gs_do_footer() {
	$pattern = '<div class="one-half%1$s" id="footer-%2$s">%3$s</div>';
	if ( ! genesis_get_option( 'footer_left_nav', CHILD_SETTINGS_FIELD ) )
		printf( $pattern, ' first', 'left', wpautop( genesis_get_option( 'footer_left', CHILD_SETTINGS_FIELD ) ) );
	else
		printf( $pattern, ' first', 'left', gs_footer_navigation() );
	
	if ( ! genesis_get_option( 'footer_right_nav', 'gs-settings' ) )
		printf( $pattern, '', 'right', wpautop( genesis_get_option( 'footer_right', CHILD_SETTINGS_FIELD ) ) );
	else
		printf( $pattern, '', 'right', gs_footer_navigation() );
}

add_action( 'genesis_admin_menu', 'gs_add_settings', 5 );
/**
 * Add the Theme Settings Page
 *
 * @since 1.1.0
 */
function gs_add_settings() {
	global $_gs_settings;
	
	$_gs_settings = new Genesis_Sandbox_Settings;	 	
}

add_action( 'genesis_after_sidebar_widget_area', 'gs_bottom_sidebars' );
/** 
 * Add two sidebars underneath the primary sidebar
 */
function gs_bottom_sidebars() {
	foreach ( array( 'sidebar-bottom-left', 'sidebar-bottom-right', ) as $area ) {
		genesis_widget_area(
			'home', 
			array( 
				'before' => '<div id="' . $area . '" class="sidebar-widget widget-area">', 
				'after'  => '</div><!-- end #' . $area . '-->',
			) 
		);
		
	}
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
		array(
			'id'			=> 'home-top',
			'name'			=> __( 'Home Top', CHILD_DOMAIN ),
			'description'	=> __( 'This is the top homepage section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'home-left',
			'name'			=> __( 'Home Left', CHILD_DOMAIN ),
			'description'	=> __( 'This is the homepage left section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'home-right',
			'name'			=> __( 'Home Right', CHILD_DOMAIN ),
			'description'	=> __( 'This is the homepage right section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'home-bottom',
			'name'			=> __( 'Home Bottom', CHILD_DOMAIN ),
			'description'	=> __( 'This is the homepage right section.', CHILD_DOMAIN ),
		),
		array(
			'id'			=> 'portfolio',
			'name'			=> __( 'Portfolio', CHILD_DOMAIN ),
			'description'	=> __( 'This is the portfolio page template', CHILD_DOMAIN ),
		),
	);
	
	foreach ( $sidebars as $sidebar )
		genesis_register_sidebar( $sidebar );
}