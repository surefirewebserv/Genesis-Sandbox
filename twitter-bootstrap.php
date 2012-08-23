<?php

/* Twitter Bootstrap
   Add or include to WordPress functions file
--------------------------------------------------------------------------------------- */

add_action('wp_enqueue_scripts', 'link_twitter_bootstrap');

function link_twitter_bootstrap() {
  wp_enqueue_style( 'bootstrap', CHILD_URL . '/lib/css/bootstrap.css');
  wp_enqueue_style( 'responsive', CHILD_URL . '/lib/css/bootstrap-responsive.css');
  wp_enqueue_style( 'docs', CHILD_URL . '/lib/css/docs.css');
  wp_enqueue_style( 'prettify', CHILD_URL . '/lib/js/google-code-prettify/prettify.css');
}

/** Add IE conditional html5 shim to header */
add_action( 'wp_enqueue_scripts', 'wps_enqueue_lt_ie9' );
function wps_enqueue_lt_ie9() {
    global $is_IE;

    // Return early, if not IE
    if ( ! $is_IE ) return;

    // Include the file, if needed
    if ( ! function_exists( 'wp_check_browser_version' ) )
        include_once( ABSPATH . 'wp-admin/includes/dashboard.php' );

    // IE version conditional enqueue
    $response = wp_check_browser_version();
    if ( 0 > version_compare( intval( $response['version'] ) , 9 ) )
        wp_enqueue_script( 'wps-html5shiv', 'http://html5shim.googlecode.com/svn/trunk/html5.js', array(), 'pre3.6', false );
}

remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_after_header', 'do_bootstrap_nav');

function do_bootstrap_nav() {
	?>
	<div id="nav" class="navbar container">
    	<div class="wrap navbar-inner">
    		<div class="container">
				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
	 
				<!-- Be sure to leave the brand out there if you want it shown -->
				<!-- <a class="brand" href="#">Pleiades Web Center</a> -->
				<div class="hidden-desktop"><a href="http://cabforward.com" class="brand"><img src="images/cabforward_logo_sm.png" alt="" height="28" width="169">PleiadesWebCenter</a></div>
				 
				<!-- Everything you want hidden at 940px or less, place within here -->
				<div class="nav-collapse">
					<?php wp_nav_menu(); ?>
					<form class="navbar-search pull-right">
						<input type="text" class="search-query" placeholder="Search">
						<input class="adminbar-button" type="submit" value="Search">
					</form>
					<!--
					<div class="ab-item ab-empty-item" tabindex="-1">
						<form id="adminbarsearch" method="get" action="http://dev.pleiadesservices.com/">
						<input id="adminbar-search" class="adminbar-input" type="text" maxlength="150" value="" tabindex="10" name="s">
						<input class="adminbar-button" type="submit" value="Search">
						</form>
					</div>
					-->
				</div>
    		</div>
		</div>
	</div>
	<?php 
}

/* ----- Add Container Class to #inner ----- */

// Add div.wrap inside of div#inner
function child_before_content_sidebar_wrap() {
    echo '<div class="container">';
}
add_action('genesis_before_content_sidebar_wrap', 'child_before_content_sidebar_wrap');

function child_after_content_sidebar_wrap() {
    echo '</div><!-- end .container -->';
}
add_action('genesis_after_content_sidebar_wrap', 'child_after_content_sidebar_wrap');

/* ----- Enqueue BootStrap JavaScript ----- */

add_action('wp_enqueue_scripts', 'bootstrap_js_loader');
function bootstrap_js_loader() {
	wp_enqueue_script('prettify', get_template_directory_uri().'/js/prettify.js', array('jquery'),'1.0', true );
	wp_enqueue_script('transition', get_template_directory_uri().'/js/bootstrap-transition.js', array('jquery'),'1.0', true );
	wp_enqueue_script('alert', get_template_directory_uri().'/js/bootstrap-alert.js', array('jquery'),'1.0', true );
	wp_enqueue_script('modal', get_template_directory_uri().'/js/bootstrap-modal.js', array('jquery'),'1.0', true );
	wp_enqueue_script('dropdown', get_template_directory_uri().'/js/bootstrap-dropdown.js', array('jquery'),'1.0', true );
	wp_enqueue_script('scrollspy', get_template_directory_uri().'/js/bootstrap-scrollspy.js', array('jquery'),'1.0', true );
	wp_enqueue_script('tab', get_template_directory_uri().'/js/bootstrap-tab.js', array('jquery'),'1.0', true );
	wp_enqueue_script('tooltip', get_template_directory_uri().'/js/bootstrap-tooltip.js', array('jquery'),'1.0', true );
	wp_enqueue_script('popover', get_template_directory_uri().'/js/bootstrap-popover.js', array('tooltip'),'1.0', true );
	wp_enqueue_script('button', get_template_directory_uri().'/js/bootstrap-button.js', array('jquery'),'1.0', true );
	wp_enqueue_script('collapse', get_template_directory_uri().'/js/bootstrap-collapse.js', array('jquery'),'1.0', true );
	wp_enqueue_script('carousel', get_template_directory_uri().'/js/bootstrap-carousel.js', array('jquery'),'1.0', true );
	wp_enqueue_script('typeahead', get_template_directory_uri().'/js/bootstrap-typeahead.js', array('jquery'),'1.0', true );
	wp_enqueue_script('application', get_template_directory_uri().'/js/application.js', array('tooltip'),'1.0', true );
}