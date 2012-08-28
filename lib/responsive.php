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