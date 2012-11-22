<?php 

/**
 * Scripts Metabox for when another SEO plugin is active.
 *
 * @category   Genesis_Sandbox
 * @package    Admin
 * @subpackage Inpost-Metaboxes
 * @author     Travis Smith, for Surefire Themes
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.0.0
 */

add_action( 'admin_menu', 'gs_add_inpost_scripts_box' );
/**
 * Register a new meta box to the post / page edit screen, so that the user can
 * set SEO options on a per-post or per-page basis.
 *
 * @category Genesis
 * @package Admin
 * @subpackage Inpost-Metaboxes
 *
 * @since 1.0.0
 *
 * @see genesis_inpost_seo_box() Generates the content in the meta box
 */
function gs_add_inpost_scripts_box() {

	foreach ( (array) get_post_types( array( 'public' => true ) ) as $type ) {
		if ( defined( 'GENESIS_SEO_DISABLED' ) && GENESIS_SEO_DISABLED ) 
			add_meta_box( 'gs_inpost_scripts_box', __( 'Scripts Settings', 'gs' ), 'gs_inpost_scripts_box', $type, 'normal', 'high' );
	}

}

/**
 * Callback for in-post scripts meta box.
 *
 * Echoes out HTML.
 *
 * @category Genesis
 * @package Admin
 * @subpackage Inpost-Metaboxes
 *
 */
function gs_inpost_scripts_box() {
	wp_nonce_field( 'gs_inpost_scripts_save', 'gs_inpost_scripts_nonce' );
	?>
	<p><label for="genesis_header_scripts"><b><?php _e( 'Scripts', 'genesis' ); ?></b></label></p>
	<p><textarea class="large-text" rows="4" cols="6" name="genesis_scripts[_genesis_scripts]" id="genesis_header_scripts"><?php echo esc_textarea( genesis_get_custom_field( '_genesis_scripts' ) ); ?></textarea></p>
	
	<p><label for="genesis_footer_scripts"><b><?php _e( 'Footer Scripts', 'genesis' ); ?></b></label></p>
	<p><textarea class="large-text" rows="4" cols="6" name="genesis_scripts[_genesis_footer_scripts]" id="genesis_footer_scripts"><?php echo esc_textarea( genesis_get_custom_field( '_genesis_footer_scripts' ) ); ?></textarea></p>
	<?php

}

add_action( 'save_post', 'gs_inpost_scripts_save', 1, 2 );
/**
 * Saves the layout options when we save a post / page.
 *
 * It does so by grabbing the array passed in $_POST, looping through it, and
 * saving each key / value pair as a custom field.
 *
 * @category Genesis
 * @package Admin
 * @subpackage Inpost-Metaboxes
 *
 * @since 0.2.2
 *
 * @param integer $post_id Post ID
 * @param stdClass $post Post object
 * @return integer|null Returns post ID if the nonce was not correct or user was not
 * allowed to edit content. Returns null if doing autosave, ajax or cron
 */
function gs_inpost_scripts_save( $post_id, $post ) {

	/**	Verify the nonce and capability */
	if ( ! isset( $_POST['genesis_scripts'] ) )
		return;

	/** Merge user submitted options with fallback defaults */
	$data = wp_parse_args( $_POST['genesis_scripts'], array(
		'_genesis_scripts'        => '',
		'_genesis_footer_scripts' => '',
	) );

	/** No sanitization necessary for scripts */

	/** Save custom field data */
	genesis_save_custom_fields( $data, 'gs_inpost_scripts_save', 'gs_inpost_scripts_nonce', $post, $post_id );

}