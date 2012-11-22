<?php
/**
 * Theme Settings.
 * Requires Genesis 1.8 or later
 *
 * This file registers all of this child theme's 
 * specific Theme Settings, accessible from
 * Genesis > Incipio Settings.
 *
 * @category   Genesis_Sandbox
 * @package    Admin
 * @subpackage Settings
 * @author     Travis Smith, for Surefire Themes
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.0.0
 */
 
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @category    Genesis_Sandbox
 * @since       1.0.0
 */
class Genesis_Sandbox_Settings extends Genesis_Admin_Boxes {
	
	/**
	 * Create an admin menu item and settings page.
	 * 
	 * @since 1.1.0
	 */
	function __construct() {
		
		// Specify a unique page ID. 
		$page_id = 'gs-settings';
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis Sandbox Settings', 'gs' ),
				'menu_title'  => __( 'Genesis Sandbox Settings', 'gs' ),
				'capability'  => 'manage_options',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array( 'screen_icon' => 'options-general', );		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', gs_SETTINGS_FIELD );
		$settings_field = 'gs-settings';
		
		// Set the default values
		$default_settings = array();
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
		
		// Add admin script
		//add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/** 
	 * Set up Sanitization Filters
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 *
	 * @since 1.1.0
	 */	
	function sanitization_filters() {
		
		genesis_add_option_filter(
			'no_html', 
			$this->settings_field,
			array() // Enter options here as an array
		);
		
		genesis_add_option_filter(
			'safe_html', 
			$this->settings_field,
			array() // Enter options here as an array
		);
		
		genesis_add_option_filter(
			'one_zero',
			$this->settings_field,
			array() // Enter options here as an array
		);
		
		genesis_add_option_filter(
			'requires_unfiltered_html',
			$this->settings_field,
			array() // Enter options here as an array
		);
		
	}
	
	/** 
	 * Add admin script
	 *
	 *
	 * @since 1.1.0
	 */	
	function gs_scripts() {
		if ( genesis_is_menu_page( $this->page_id ) ) {
			//add script
		}
	}
	
	/**
	 * Register metaboxes on Child Theme Settings page
	 *
	 * @since 1.1.0
	 *
	 * @see gs_gs_settings() Callback for child theme settings
	 */
	function metaboxes() {
		
		add_meta_box( 'gs-general-settings', __( 'Genesis Sandbox General Settings', 'gs' ) , array( $this, 'gs_general_settings' ), $this->pagehook, 'main', 'high' );
				
	}
	
	/**
	 * Register contextual help on Child Theme Settings page
	 *
	 * @since 1.1.0
	 *
	 */
	function help() {	
		global $my_admin_page;
		$screen = get_current_screen();
		
		if ( $screen->id != $this->pagehook )
			return;
		
		$tab1_help =
			'<h3>' . __( 'Home Settings', 'gs' ) . '</h3>' .
			'<p>' . __( 'The home page features the Genesis Grid loop that can be set in this section. To set the number of full content posts, enter the number under Number of Full Posts. To set the number of grid or other posts, enter a numer by Number of Other Posts.', 'gs' ) . '</p>';
		$tab2_help =
			'<h3>' . __( 'Post Formats', 'gs' ) . '</h3>' .
			'<p>' . __( 'Incipio features the ability to turn on post formats for the entire site. Simply, check the checkbox by Enable post formats globally. However, this will not affect the portfolio theme.', 'gs' ) . '</p>';
		$tab3_help =
			'<h3>' . __( 'Footer Widgets', 'gs' ) . '</h3>' .
			'<p>' . __( 'Incipio features the ability to set the number of footer widgets that you would like to have. First, you must enable footer widgets by checking the Add footer widgets checkbox. Then enter the number of footer widgets you would like to have. Finally, you can optionally remove footer widgets from the home page by checking the checkbox by Hide Footer Widgets on Home Page.', 'gs' ) . '</p>';
		$tab4_help =
			'<h3>' . __( 'Portfolio Templates', 'gs' ) . '</h3>' .
			'<p>' . __( 'Incipio\'s features two portfolio templates: the category archive for portfolio and page template for portfolio. Since some people may want to have pages called Portfolio and not use the Portfolio template, I have decided to name the template page_portfolio.php instead of the page-portfolio.php which would force users to use the template based on the WordPress hierarchy. If you prefer to use another category name other than portfolio, please rename the file category-portfolio.php to category-{your-category-slug}.php. For more information see the WordPress ', 'gs' ) .
			'<a href="http://codex.wordpress.org/Category_Templates" target="_blank">' . __( 'Category Templates', 'gs' ) . '.</a>' .
			__( 'Incipio\'s portfolio options apply to both templates as appropriate.', 'gs' ) . '</p>' .
			'<h3>' . __( 'Portfolio Options', 'gs' ) . '</h3>' .
			'<p>' . __( 'Incipio\'s portfolio options contain the typical content archive settings including category designation, category exclusion, post exclusion, number of posts, content type, content limit, formatting tags and the read more text.', 'gs' ) .
			
			'<a href="http://codex.wordpress.org/Category_Templates" target="_blank">' . __( 'Category Templates', 'gs' ) . '.</a>' .
			__( 'Portfolio Settings', 'gs' ) . '</p>';
		
		
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab1',
				'title'	=> __( 'Home Settings', 'gs' ),
				'content'	=> $tab1_help,
			)
		);
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab2',
				'title'	=> __( 'Post Formats', 'gs' ),
				'content'	=> $tab2_help,
			)
		);
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab3',
				'title'	=> __( 'Footer Widgets', 'gs' ),
				'content'	=> $tab3_help,
			)
		);
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab4',
				'title'	=> __( 'Portfolio Settings', 'gs' ),
				'content'	=> $tab4_help,
			)
		);
		
		// Add Genesis Sidebar
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', 'gs' ) . '</strong></p>'.
			'<p><a href="' . __( 'http://www.studiopress.com/support', 'gs' ) . '" target="_blank" title="' . __( 'Support Forums', 'gs' ) . '">' . __( 'Support Forums', 'gs' ) . '</a></p>'.
			'<p><a href="' . __( 'http://wpsmith.net/genesis-plugins', 'gs' ) . '" target="_blank" title="' . __( 'Genesis Plugins', 'gs' ) . '">' . __( 'Genesis Plugins', 'gs' ) . '</a></p>'.
			'<p><a href="' . __( 'http://wpsmith.net/category/genesis/', 'gs' ) . '" target="_blank" title="' . __( 'Genesis Tutorials by WPSmith', 'gs' ) . '">' . __( 'Genesis Tutorials by WPSmith', 'gs' ) . '</a></p>'
        );
	}
		
	/**
	 * Callback for Incipio General Settings metabox
	 *
	 * @since 1.1.0
	 *
	 * @see gs_Settings::metaboxes()
	 */
	function gs_general_settings() { 
		/**
		 * Add HTML
		 * For name, use echo $this->get_field_name( 'option' );
		 * For id, use echo $this->get_field_id( 'option' );
		 * For value, use echo $this->get_field_value( 'option' );
		 */
	}
	
}

add_action( 'admin_menu', 'gs_add_settings', 5 );
/**
 * Add the Theme Settings Page
 *
 * @since 1.1.0
 */
function gs_add_settings() {
	global $_gs_settings;
	$_gs_settings = new Genesis_Sandbox_Settings;	 	
}