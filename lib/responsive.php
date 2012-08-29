<?php 
//Responsive Nav
add_filter( 'genesis_do_nav', 'override_do_nav', 10, 3 );
function override_do_nav($nav_output, $nav, $args) {
$pullmenu = '<a href="#" id="pull" class="closed">Menu</a>';
	
    //$args['menu_class'] .= ' nav-responsive'; 

    // check which function should be used to build the nav
    // rebuild the nav using the updated arguments
    
        $nav = wp_nav_menu( $args );
    
    // return the modified result
    return sprintf( '%2$s<div id="nav" class="nav-responsive">%1$s%3$s</div>%4$s', $nav, genesis_structural_wrap( 'nav', 'open', 0 ), $pullmenu, genesis_structural_wrap( 'nav', 'close', 0 ) );

}

//Responsive Nav
add_filter( 'genesis_do_subnav', 'override_do_subnav', 10, 3 );
function override_do_subnav($nav_output, $nav, $args) {
$pullmenu = '<a href="#" id="subpull" class="closed">Sub Menu</a>';
	
    //$args['menu_class'] .= ' nav-responsive'; 

    // check which function should be used to build the nav
    // rebuild the nav using the updated arguments
    
        $nav = wp_nav_menu( $args );
    
    // return the modified result
    return sprintf( '%2$s<div id="menu-secondary-navigation" class="subnav-responsive">%1$s%3$s</div>%4$s', $nav, genesis_structural_wrap( 'nav', 'open', 0 ), $pullmenu, genesis_structural_wrap( 'nav', 'close', 0 ) );

}

add_action( 'wp_enqueue_scripts', 'wps_child_script' );
/**
 * Enqueues Appropriate Scripts when needed based on Debugging.
 * Assumes that the normal *.js is the minified version & *-dev.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 */
function wps_child_script() {
	$suffix = ( WP_DEBUG || WP_SCRIPT_DEBUG ) ? '-min.js' : '.js';
	wp_enqueue_script( 'responsive-nav', get_stylesheet_directory_uri() . '/lib/js/responsive-nav' . $suffix, array( 'jquery' ) , '1.0.0', true );
	wp_enqueue_style( 'responsive', CHILD_URL . '/responsive.css');
}