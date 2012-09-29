<?php
/**
 * Genesis Sandbox Theme Settings
 *
 * @package      Genesis Sandbox Settings
 * @author       Jonathan Perz <http://surefirewebservices.com/>
 * @copyright    Copyright (c) 2012, Jonathan Perez
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
 
 /* Define our constants
 ------------------------------------------------------------ */
  
 define( 'GSSETTINGS_SETTINGS_FIELD', 'gs-settings' );
 genesis_get_option( 'genesissandbox_custom_option', GSSETTINGS_SETTINGS_FIELD );
 
 
 
 /* Setup default options
 ------------------------------------------------------------ */
  
 /**
  * gssettings_default_theme_options function.
  *
  * This function stores the default CT Settings theme options. It can be filtered using gssettings_default_theme_options.
  *
  * @return $options, filtered by gssettings_default_theme_options
  *
  * @since 1.0.0
  *
  */
 function gssettings_default_theme_options() {
     $options = array(
         'gssettings_move_primary_nav'  => 0,
         'gssettings_move_subnav'   => 0
     );
     return apply_filters( 'gssettings_default_theme_options', $options );
 }
 
 
 
 /* Sanitize any inputs
 ------------------------------------------------------------ */
  
 add_action( 'genesis_settings_sanitizer_init', 'gssettings_sanitize_inputs' );
 /**
  * gssettings_sanitize_inputs function.
  *
  * This function accesses Genesis' sanitization class to sanitize all users inputs and options in the CT Settings settings area.
  *
  * @since 1.0.0
  *
  */
 function gssettings_sanitize_inputs() {
     genesis_add_option_filter( 'one_zero', GSSETTINGS_SETTINGS_FIELD, array( 'gssettings_move_primary_nav', 'gssettings_move_subnav' ) );
 }
 
 
 
 /* Register our settings and add the options to the database
 ------------------------------------------------------------ */
  
 add_action( 'admin_init', 'gssettings_register_settings' );
 /**
  * gssettings_register_settings function.
  *
  * This function registers the settings for use in the CT Settings theme settings area. It also restores default options when
  * the Reset button is selected.
  *
  * @since 1.0.0
  *
  */
 function gssettings_register_settings() {
     register_setting( GSSETTINGS_SETTINGS_FIELD, GSSETTINGS_SETTINGS_FIELD );
     add_option( GSSETTINGS_SETTINGS_FIELD, gssettings_default_theme_options() );
  
     if ( genesis_get_option( 'reset', GSSETTINGS_SETTINGS_FIELD ) ) {
         update_option( GSSETTINGS_SETTINGS_FIELD, gssettings_default_theme_options() );
         genesis_admin_redirect( GSSETTINGS_SETTINGS_FIELD, array( 'reset' => 'true' ) );
         exit;
     }
 }
 
 
 /* Admin notices for when options are saved/reset
 ------------------------------------------------------------ */
  
 add_action( 'admin_notices', 'gssettings_theme_settings_notice' );
 /**
  * gssettings_theme_settings_notice function.
  *
  * This function displays admin notices when the user updates CT Settings' theme settings area.
  *
  * @since 1.0.0
  *
  */
 function gssettings_theme_settings_notice() {
     if ( ! isset( $_REQUEST['page'] ) || $_REQUEST['page'] != GSSETTINGS_SETTINGS_FIELD )
         return;
  
     if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] )
         echo '<div id="message" class="updated"><p><strong>' . __( 'Settings reset.', 'genesis' ) . '</strong></p></div>';
     elseif ( isset( $_REQUEST['settings-updated'] ) && 'true' == $_REQUEST['settings-updated'] )
         echo '<div id="message" class="updated"><p><strong>' . __( 'Settings saved.', 'genesis' ) . '</strong></p></div>';
 }
 
 
 
 
 /* Register our theme options page
 ------------------------------------------------------------ */
  
 add_action( 'admin_menu', 'gssettings_theme_options' );
 /**
  * gssettings_theme_options function.
  *
  * This function registers the CT Settings settings page and prepares the styles, scripts and metaboxes to be loaded.
  *
  * @global $_gssettings_settings_pagehook
  *
  * @since 1.0.0
  *
  */
 function gssettings_theme_options() {
     global $_gssettings_settings_pagehook;
     $_gssettings_settings_pagehook = add_submenu_page( 'genesis', 'Sandbox Settings', 'Sandbox Settings', 'edit_theme_options', GSSETTINGS_SETTINGS_FIELD, 'gssettings_theme_options_page' );
  
     //add_action( 'load-'.$_gssettings_settings_pagehook, 'gssettings_settings_styles' );
     add_action( 'load-'.$_gssettings_settings_pagehook, 'gssettings_settings_scripts' );
     add_action( 'load-'.$_gssettings_settings_pagehook, 'gssettings_settings_boxes' );
 }
 
 
 
 /* Setup our scripts
 ------------------------------------------------------------ */
  
 /**
  * gssettings_settings_scripts function.
  *
  * This function enqueues the scripts needed for the CT Settings settings page.
  *
  * @global $_gssettings_settings_pagehook
  *
  * @since 1.0.0
  *
  */
 function gssettings_settings_scripts() {
     global $_gssettings_settings_pagehook;
     wp_enqueue_script( 'common' );
     wp_enqueue_script( 'wp-lists' );
     wp_enqueue_script( 'postbox' );
 }
 
 
 
 /* Setup our metaboxes
 ------------------------------------------------------------ */
  
 /**
  * gssettings_settings_boxes function.
  *
  * This function sets up the metaboxes to be populated by their respective callback functions.
  *
  * @global $_gssettings_settings_pagehook
  *
  * @since 1.0.0
  *
  */
 function gssettings_settings_boxes() {
     global $_gssettings_settings_pagehook;
     add_meta_box( 'gssettings-function-box', __( 'Genesis Sandbox Functions Settings', 'genesis' ), 'gssettings_function_box', $_gssettings_settings_pagehook, 'main' );
     
     add_meta_box( 'gssettings-homepage-widgets-box', __( 'Genesis Sandbox Homepage Widgets', 'genesis' ), 'gssettings_homepage_widgets_box', $_gssettings_settings_pagehook, 'main' );
     
 }
 
 /* Add our custom post metabox for social sharing
 ------------------------------------------------------------ */
  
 /**
  * gssettings_social_metabox function.
  *
  * Callback function for the CT Settings Social Sharing metabox.
  *
  * @since 1.0.0
  *
  */
 function gssettings_function_box() { ?>
  
     <p><?php _e( 'Check any of the following functions you want to apply to your theme.', 'genesis' ); ?></p>
     <table class="form-table gssettings-social">
         <tbody>
             <tr valign="top">
                 <th scope="row">
                     <input type="checkbox" name="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_primary_nav]" id="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_primary_nav]" value="1" <?php checked( 1, genesis_get_option( 'gssettings_move_primary_nav', GSSETTINGS_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_primary_nav]"><?php _e( 'Move the Primary Navigation above the header?', 'genesis' ); ?></label>
                 </th>
             </tr>
             <tr valign="top">
                 <th scope="row">
                     <input type="checkbox" name="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_subnav]" id="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_subnav]" value="1" <?php checked( 1, genesis_get_option( 'gssettings_move_subnav', GSSETTINGS_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_subnav]"><?php _e( 'Move the sub navigation above the header?', 'genesis' ); ?></label>
                 </th>
             </tr>             
         </tbody>
     </table>
  
 <?php }
 
 
 function gssettings_homepage_widgets_box() { ?>
  
     <p><?php _e( 'Check any of the following functions you want to apply to your theme.', 'genesis' ); ?></p>
     <table class="form-table gssettings-social">
         <tbody>
             <tr valign="top">
                 <th scope="row">
                     <input type="checkbox" name="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_primary_nav]" id="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_primary_nav]" value="1" <?php checked( 1, genesis_get_option( 'gssettings_move_primary_nav', GSSETTINGS_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_primary_nav]"><?php _e( 'Move the Primary Navigation above the header?', 'genesis' ); ?></label>
                 </th>
             </tr>
             <tr valign="top">
                 <th scope="row">
                     <input type="checkbox" name="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_subnav]" id="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_subnav]" value="1" <?php checked( 1, genesis_get_option( 'gssettings_move_subnav', GSSETTINGS_SETTINGS_FIELD ) ); ?> /> <label for="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[gssettings_move_subnav]"><?php _e( 'Move the sub navigation above the header?', 'genesis' ); ?></label>
                 </th>
             </tr>             
         </tbody>
     </table>
  
 <?php }
 
 
 
 /* Set the screen layout to one column
 ------------------------------------------------------------ */
  
 add_filter( 'screen_layout_columns', 'gssettings_settings_layout_columns', 10, 2 );
 /**
  * gssettings_settings_layout_columns function.
  *
  * This function sets the column layout to one for the CT Settings settings page.
  *
  * @param mixed $columns
  * @param mixed $screen
  * @return $columns
  *
  * @since 1.0.0
  *
  */
 function gssettings_settings_layout_columns( $columns, $screen ) {
     global $_gssettings_settings_pagehook;
     if ( $screen == $_gssettings_settings_pagehook ) {
         $columns[$_gssettings_settings_pagehook] = 1;
     }
     return $columns;
 }
 
 
 
 /* Build our theme options page
 ------------------------------------------------------------ */
  
 /**
  * gssettings_theme_options_page function.
  *
  * This function displays the content for the CT Settings settings page, builds the forms and outputs the metaboxes.
  *
  * @global $_gssettings_settings_pagehook
  * @global $screen_layout_columns
  *
  * @since 1.0.0
  *
  */
 function gssettings_theme_options_page() {
  
     global $_gssettings_settings_pagehook, $screen_layout_columns;
     $width = "width: 99%;";
     $hide2 = $hide3 = " display: none;";
     ?>
  
     <div id="gssettings" class="wrap genesis-metaboxes">
         <form method="post" action="options.php">
  
             <?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
             <?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
             <?php settings_fields( GSSETTINGS_SETTINGS_FIELD ); ?>
  
             <?php screen_icon( 'options-general' ); ?>
  
             <h2>
                 <?php _e( 'Sandbox Theme Settings', 'genesis' ); ?>
                 <input type="submit" class="button-primary genesis-h2-button" value="<?php _e( 'Save Settings', 'genesis' ) ?>" />
                 <input type="submit" class="button-highlighted genesis-h2-button" name="<?php echo GSSETTINGS_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'genesis' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Are you sure you want to reset?', 'genesis' ) ); ?>');" />
             </h2>
  
             <div class="metabox-holder">
                 <div class="postbox-container" style="<?php echo $width; ?>">
                     <?php do_meta_boxes( $_gssettings_settings_pagehook, 'main', null ); ?>
                 </div>
             </div>
  
         </form>
     </div>
     <script type="text/javascript">
         //<![CDATA[ 
         jQuery(document).ready( function($) {
             // close postboxes that should be closed
             $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
             // postboxes setup
             postboxes.add_postbox_toggles('<?php echo $_gssettings_settings_pagehook; ?>');
         });
         //]]>
     </script>
  
 <?php }
 
 
 
 /*** FUNCTIONS TO INCLUDE FILE */
 
 $primary_nav = genesis_get_option( 'gssettings_move_primary_nav', GSSETTINGS_SETTINGS_FIELD);
 $secondary_nav = genesis_get_option( 'gssettings_move_subnav', GSSETTINGS_SETTINGS_FIELD);
 
 if ($primary_nav == 1) {
       /** Move primary nav menu */
       remove_action( 'genesis_after_header', 'genesis_do_nav' );
       add_action( 'genesis_before_header', 'genesis_do_nav' );
    }
    
 if ($secondary_nav == 1) {
          /** Move primary nav menu */
          remove_action( 'genesis_after_header', 'genesis_do_subnav' );
          add_action( 'genesis_before_header', 'genesis_do_subnav' );
 }
 
 
 
 