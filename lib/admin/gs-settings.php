<?php
/**
 * Theme Settings.
 * Requires Genesis 1.8 or later
 *
 * This file registers all of this child theme's 
 * specific Theme Settings, accessible from
 * Genesis > Sandbox Settings.
 *
 * @category   Genesis_Sandbox
 * @package    Admin
 * @subpackage Settings
 * @author     Travis Smith
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'Cheatin&#8217; uh?' );
 
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
		$page_id = CHILD_SETTINGS_FIELD;
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis Sandbox Settings', CHILD_DOMAIN ),
				'menu_title'  => __( 'Genesis Sandbox Settings', CHILD_DOMAIN ),
				'capability'  => 'manage_options',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array( 'screen_icon' => 'options-general', );		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', CHILD_SETTINGS_FIELD );
		$settings_field = CHILD_SETTINGS_FIELD;
		
		// Set the default values
		$default_settings = array(
			'footer_left'  => 'Copyright &copy; ' . date( 'Y' ) . ' All Rights Reserved',
			'footer_right' => 'Site by <a href="http://www.surefirethemes.com/">SureFire Themes</a>',
		);
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
		
		// Add admin script
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
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
			array( // Enter options here as an array
				
			)
		);
		
		genesis_add_option_filter(
			'one_zero',
			$this->settings_field,
			array( // Enter options here as an array
				'move_nav',
				'move_subnav'
			)
		);
		
		genesis_add_option_filter(
			'requires_unfiltered_html',
			$this->settings_field,
			array(
			) // Enter options here as an array
		);
		
	}
	
	/** 
	 * Add admin script
	 *
	 * @since 1.1.0
	 */	
	function admin_scripts() {
		if ( genesis_is_menu_page( $this->page_id ) ) {
			wp_enqueue_script( 'sandbox-admin', CHILD_LIB . '/js/' . gs_script_suffix( 'admin' ), array( 'jquery' ) , CHILD_THEME_VERSION );
			//wp_enqueue_script( 'sandbox-admin', CHILD_LIB . '/js/admin.js', array( 'jquery' ) , CHILD_THEME_VERSION );
		}
	}
	
	/**
	 * Register metaboxes on Child Theme Settings page
	 *
	 * @since 1.1.0
	 *
	 * @see gs_general_settings() Callback for child theme settings
	 * @see gs_footer_settings() Callback for footer settings
	 */
	function metaboxes() {
		
		add_meta_box( 'gs-footer-settings', __( 'Genesis Sandbox Footer Settings', CHILD_DOMAIN ) , array( $this, 'gs_footer_settings' ), $this->pagehook, 'main', 'high' );
				
	}
	
	/**
	 * Register contextual help on Child Theme Settings page
	 *
	 * @since 1.1.0
	 *
	 */
	
	/*
	function help() {	
		global $my_admin_page;
		$screen = get_current_screen();
		
		if ( $screen->id != $this->pagehook )
			return;
		
		$tab1_help =
			'<h3>' . __( 'Home Settings', CHILD_DOMAIN ) . '</h3>' .
			'<p>' . __( 'The home page features the Genesis Grid loop that can be set in this section. To set the number of full content posts, enter the number under Number of Full Posts. To set the number of grid or other posts, enter a numer by Number of Other Posts.', CHILD_DOMAIN ) . '</p>';
		$tab2_help =
			'<h3>' . __( 'Post Formats', CHILD_DOMAIN ) . '</h3>' .
			'<p>' . __( 'Sandbox features the ability to turn on post formats for the entire site. Simply, check the checkbox by Enable post formats globally. However, this will not affect the portfolio theme.', CHILD_DOMAIN ) . '</p>';
		$tab3_help =
			'<h3>' . __( 'Footer Widgets', CHILD_DOMAIN ) . '</h3>' .
			'<p>' . __( 'Sandbox features the ability to set the number of footer widgets that you would like to have. First, you must enable footer widgets by checking the Add footer widgets checkbox. Then enter the number of footer widgets you would like to have. Finally, you can optionally remove footer widgets from the home page by checking the checkbox by Hide Footer Widgets on Home Page.', CHILD_DOMAIN ) . '</p>';
		$tab4_help =
			'<h3>' . __( 'Portfolio Templates', CHILD_DOMAIN ) . '</h3>' .
			'<p>' . __( 'Sandbox\'s features two portfolio templates: the category archive for portfolio and page template for portfolio. Since some people may want to have pages called Portfolio and not use the Portfolio template, I have decided to name the template page_portfolio.php instead of the page-portfolio.php which would force users to use the template based on the WordPress hierarchy. If you prefer to use another category name other than portfolio, please rename the file category-portfolio.php to category-{your-category-slug}.php. For more information see the WordPress ', CHILD_DOMAIN ) .
			'<a href="http://codex.wordpress.org/Category_Templates" target="_blank">' . __( 'Category Templates', CHILD_DOMAIN ) . '.</a>' .
			__( 'Sandbox\'s portfolio options apply to both templates as appropriate.', CHILD_DOMAIN ) . '</p>' .
			'<h3>' . __( 'Portfolio Options', CHILD_DOMAIN ) . '</h3>' .
			'<p>' . __( 'Sandbox\'s portfolio options contain the typical content archive settings including category designation, category exclusion, post exclusion, number of posts, content type, content limit, formatting tags and the read more text.', CHILD_DOMAIN ) .
			
			'<a href="http://codex.wordpress.org/Category_Templates" target="_blank">' . __( 'Category Templates', CHILD_DOMAIN ) . '.</a>' .
			__( 'Portfolio Settings', CHILD_DOMAIN ) . '</p>';
		
		
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab1',
				'title'	=> __( 'Home Settings', CHILD_DOMAIN ),
				'content'	=> $tab1_help,
			)
		);
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab2',
				'title'	=> __( 'Post Formats', CHILD_DOMAIN ),
				'content'	=> $tab2_help,
			)
		);
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab3',
				'title'	=> __( 'Footer Widgets', CHILD_DOMAIN ),
				'content'	=> $tab3_help,
			)
		);
		$screen->add_help_tab(
			array(
				'id'	=> $this->pagehook . '-tab4',
				'title'	=> __( 'Portfolio Settings', CHILD_DOMAIN ),
				'content'	=> $tab4_help,
			)
		);
		
		// Add Genesis Sidebar
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:', CHILD_DOMAIN ) . '</strong></p>'.
			'<p><a href="' . __( 'http://www.studiopress.com/support', CHILD_DOMAIN ) . '" target="_blank" title="' . __( 'Support Forums', CHILD_DOMAIN ) . '">' . __( 'Support Forums', CHILD_DOMAIN ) . '</a></p>'.
			'<p><a href="' . __( 'http://wpsmith.net/genesis-plugins', CHILD_DOMAIN ) . '" target="_blank" title="' . __( 'Genesis Plugins', CHILD_DOMAIN ) . '">' . __( 'Genesis Plugins', CHILD_DOMAIN ) . '</a></p>'.
			'<p><a href="' . __( 'http://wpsmith.net/category/genesis/', CHILD_DOMAIN ) . '" target="_blank" title="' . __( 'Genesis Tutorials by WPSmith', CHILD_DOMAIN ) . '">' . __( 'Genesis Tutorials by WPSmith', CHILD_DOMAIN ) . '</a></p>'
        );
	}*/
		
	
	/**
	 * Callback for Sandbox General Settings metabox
	 *
	 * @since 1.1.0
	 *
	 * @see Genesis_Sandbox_Settings::metaboxes()
	 */
	/*function gs_footer_settings() { 
		
		 * Add HTML
		 * For name, use echo $this->get_field_name( 'option' );
		 * For id, use echo $this->get_field_id( 'option' );
		 * For value, use echo $this->get_field_value( 'option' );
		 
		 
		
		<p><input type="checkbox" name="<?php echo $this->get_field_name( 'footer_center' ); ?>" id="one_footer" value="1" <?php checked( 1, $this->get_field_value( 'footer_center' ) ); ?> /> <label for="one_footer"><?php _e( 'Use only 1 centered footer box?', CHILD_DOMAIN ); ?> <br /><small><em>(when selected, "Footer Left" will be used as main footer box.)</em></small></label></p>
		<?php
		echo '<h4>Footer Left:</h4>';
		?>
		<p><input type="checkbox" name="<?php echo $this->get_field_name( 'footer_left_nav' ); ?>" id="footer_left_nav" value="1" <?php checked( 1, $this->get_field_value( 'footer_left_nav' ) ); ?> /> <label for="footer_left_nav"><?php _e( 'Use footer navigation here?', CHILD_DOMAIN ); ?></label></p>
		<?php
		wp_editor( $this->get_field_value( 'footer_left' ), $this->get_field_id( 'footer_left' ), array( 'textarea_rows' => 5 ) );	

		echo '<div id="footer-right-box"><h4>Footer Right:</h4>';
		?>
		<p><input type="checkbox" name="<?php echo $this->get_field_name( 'footer_right_nav' ); ?>" id="footer_right_nav" value="1" <?php checked( 1, $this->get_field_value( 'footer_right_nav' ) ); ?> /> <label for="footer_right_nav"><?php _e( 'Use footer navigation here?', CHILD_DOMAIN ); ?></label></p>
		<?php
		wp_editor( $this->get_field_value( 'footer_right' ), $this->get_field_id( 'footer_right' ), array( 'textarea_rows' => 5 ) ); 
		echo '</div>';
		 
	}*/
	
}
