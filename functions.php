<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Sample Child Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/genesis' );

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'add_viewport_meta_tag' );
function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

//Responsive Nav
add_filter( 'genesis_do_nav', 'override_do_nav', 10, 3 );
function override_do_nav($nav_output, $nav, $args) {
$pullmenu = '<a href="#" id="pull">Menu </a>';
	
    //$args['menu_class'] .= ' nav-responsive'; 

    // check which function should be used to build the nav
    // rebuild the nav using the updated arguments
    
        $nav = wp_nav_menu( $args );
    
    // return the modified result
    return sprintf( '%2$s<div id="nav" class="nav-responsive">%1$s%3$s</div>%4$s', $nav, genesis_structural_wrap( 'nav', 'open', 0 ), $pullmenu, genesis_structural_wrap( 'nav', 'close', 0 ) );

}
//Add Script for Responsive Nav
function my_responsive_nav() {
	wp_enqueue_script(
		'responsive-nav',
		get_stylesheet_directory_uri() . '/lib/js/responsive-nav.js',
		array('jquery')
	);
	  wp_enqueue_style( 'responsive', CHILD_URL . '/responsive.css');
}
add_action('wp_enqueue_scripts', 'my_responsive_nav');




/** Add new image sizes **/
add_image_size('post-thumb', 225, 160, TRUE);

/** Support Wrapper for Header */
add_theme_support( 'genesis-structural-wraps', array( 'header','nav','subnav', 'inner', 'footer-widgets', 'footer') );

//Twitter Bootstrap
//require_once(get_stylesheet_directory() .  '/twitter-bootstrap.php');

/** Add support for custom background */
add_theme_support( 'custom-background' );

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

/** Edit read more link */
						
/*add_filter( 'excerpt_more', 'remove_excerpt_more' );
	function remove_excerpt_more() {
		return "...";
	}
	add_filter( 'get_the_content_more_link', 'sf_read_more_link' );
	add_filter( 'the_content_more_link', 'sf_read_more_link' );
	function sf_read_more_link() {
	  return '<a class="more-link" href="' .  get_permalink() .  '" rel="nofollow">Read More</a>';
	}*/

/** DUPLICATE IMAGE FIX **/
add_filter('the_content','wpi_image_content_filter',11);
function wpi_image_content_filter($content){
    if (is_home() || is_front_page() || is_archive()){
      $content = preg_replace("/<img[^>]+>/i", "", $content);
    }
    return $content;
}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );