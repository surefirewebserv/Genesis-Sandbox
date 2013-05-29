<?php

/**
 * Home Page.
 *
 * @category   Genesis_Sandbox
 * @package    Templates
 * @subpackage Home
 * @author     Travis Smith and Jonathan Perez, for Surefire Themes
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

add_action( 'get_header', 'gs_home_helper' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function gs_home_helper() {

        if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-right' ) || is_active_sidebar( 'home-bottom' ) ) {

                remove_action( 'genesis_loop', 'genesis_do_loop' );
                add_action( 'genesis_loop', 'gs_home_widgets' );
                
                /** Force Full Width */
                add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
                add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
                
        }
}



/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function gs_home_widgets() {

        genesis_widget_area(
                'home-top', 
                array( 'before' => '<div id="home-top" class="home-widget widget-area">', ) 
        );
        
        echo '<div id="home-middle">';
        genesis_widget_area( 
                'home-left', 
                array(
                        'before' => '<div id="home-left" class="first one-half"><div class="home-widget widget-area">', 
                        'after' => '</div></div><!-- end #home-left -->',
                ) 
        );
        
        genesis_widget_area( 
                'home-right', 
                array(
                        'before' => '<div id="home-right" class="one-half"><div class="home-widget widget-area">', 
                        'after' => '</div></div><!-- end #home-right -->',
                ) 
        );
        echo '</div>';
        

        genesis_widget_area( 
                'home-bottom', 
                array(
                        'before' => '<div id="home-bottom"><div class="home-widget widget-area">', 
                        'after' => '</div></div><!-- end #home-left -->',
                ) 
        );                              
}

genesis();