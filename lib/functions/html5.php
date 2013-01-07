<?php
/**
 * HTML5 Functions
 *
 * @category   Genesis_Sandbox
 * @package    Functions
 * @subpackage HTML5
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

add_theme_support( 'genesis-html5' );

remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'gs_do_doctype' );
/**
 * HTML5 DOCTYPE
*/
function gs_do_doctype() {
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<?php
}
 
add_action( 'init', 'gs_register_html5_scripts' );
/**
 * Registers Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.min.js/*.min.css is the minified version & *.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 * @uses gs_script_suffix() Adds proper CSS/JS suffix based on WP_DEBUG or SCRIPT_DEBUG
 */
function gs_register_html5_scripts() {
	
	/**
	 * HTML5 Shiv
	 * @link https://github.com/aFarkas/html5shiv
	 * @link http://core.trac.wordpress.org/ticket/16024
	 * We can register but we cannot add conditional tags to scripts at the moment.
	 */
	//wp_register_script( 'gs-html5-shiv', CHILD_JS . '/' . gs_script_suffix( 'html5shiv', 'js' ), array(), '3.6.2pre' );
	//wp_register_script( 'gs-html5-shiv', 'http://html5shiv.googlecode.com/svn/trunk/html5.js', array(), 'pre3.6', false );
	
	/**
	 * Modernizer
	 * @link http://modernizr.com/download/
	 * @link https://github.com/Modernizr/Modernizr
	 */
	wp_register_script( 'gs-modernizr', CHILD_JS . '/' . gs_script_suffix( 'modernizr', 'js' ), array(), '2.6.3pre' );
	//wp_register_script( 'gs-modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2', false );
	
}

add_action( 'wp_head', 'gs_load_html5shiv', 99 );
/** 
 * Add HTML5Shiv
 * Add js to help old browsers with html5.
 * Add HTML5Shiv for IE only.
 * Alternative location/src: http://html5shiv.googlecode.com/svn/trunk/html5.js
 *
 * @link http://core.trac.wordpress.org/ticket/16024
 * @link https://github.com/aFarkas/html5shiv
 *
 * @global $is_IE Determines whether user agent is IE.
 */
function gs_load_html5shiv() {
	global $is_IE;
	
	if ( $is_IE ) {
	?>
<!--[if lt IE 9]>
<script src="<?php echo CHILD_JS . '/' . gs_script_suffix( 'html5shiv', 'js' ); ?>"></script>
<![endif]-->
	<?php
	}
}

add_action( 'wp_enqueue_scripts', 'gs_load_html5_scripts', 99 );
/** 
 * Add Modernizer
 */
function gs_load_html5_scripts() {
	wp_enqueue_script( 'gs-modernizr' );
}