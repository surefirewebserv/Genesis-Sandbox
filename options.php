<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
 
 /** OPTIONS AND DEFAULTS **/

function optionsframework_options() {

	$basic_functions_array = array(
		'one' => __('Do you want to move the Primary Nav above the header?', 'options_framework_theme'),
		'two' => __('Do you want to move the Secondary Nav above the header?', 'options_framework_theme'),		
	);
	
	$basic_functions_defaults = array(
		'one' => '0',
		'two' => '0'
	);
	
	$footer_creds_default = '<div class="creds"><p> Copyright &copy; [gs-year] &middot; <a href="http://genesissandbox.com">Genesis Sandbox Starter Theme</a> &middot; Built on the <a href="http://surefirewebservices.com/go/genesis" title="Genesis Framework">Genesis Framework</a> </p></div>';	
	
	$theme_support_array = array(
		'one' => __('Add custom header.', 'options_framework_theme'),
		'two' => __('Add custom background.', 'options_framework_theme'),
		'three' => __('Add structural wraps.', 'options_framework_theme'),
		'four' => __('Add footer widgets', 'options_framework_theme'),		
	);
	
	$theme_support_defaults = array(
		'one' => '0',
		'two' => '0',
		'three' => '1',
		'four' => '0'
	);
	
	$gs_structural_wraps_array = array(
		'header' => __('header.', 'options_framework_theme'),
		'nav' => __('nav', 'options_framework_theme'),
		'subnav' => __('subnav', 'options_framework_theme'),		
		'inner' => __('inner', 'options_framework_theme'),		
		'footer-widgets' => __('footer-widgets', 'options_framework_theme'),		
		'footer' => __('footer', 'options_framework_theme')
	);
	
	$gs_structural_wraps_defaults = array(
		'header' => '1',
		'nav' => '1',
		'subnav' => '1',		
		'inner' => '1',		
		'footer-widgets' => '1',		
		'footer' => '1'
	);
	
	

	/* Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	*/
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/lib/img/';

	$options = array();
	
	$options[] = array(
		'name' => __('Sandbox Functions', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Navigation Layout', 'options_framework_theme'),
		'desc' => __('Navigation description.', 'options_framework_theme'),
		'id' => 'gs_basic_functions',
		'std' => $basic_functions_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $basic_functions_array);
	
	$options[] = array(
		'name' => __('Want to edit the footer creds?', 'options_framework_theme'),
		'desc' => __('Use html to edit the footer creds.', 'options_framework_theme'),
		'id' => 'gs_footer_creds_check',
		'std' => '0',
		'type' => 'checkbox');
	
	$wp_editor_settings = array(
		'wpautop' => false, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$options[] = array(
		'name' => __('Edit the footer creds.', 'options_framework_theme'),
		'desc' => __('Please add HTML for the new footer creds.', 'options_framework_theme'),
		'id' => 'gs_footer_creds_editor',
		'type' => 'editor',
		'class' => 'hidden',
		'std' => $footer_creds_default,
		'settings' => $wp_editor_settings 
		);
		
	
	$options[] = array(
		'name' => __('Theme Support', 'options_framework_theme'),
		'desc' => __('Theme support functions for the genesis framework.', 'options_framework_theme'),
		'id' => 'gs_theme_support_functions',
		'std' => $theme_support_defaults, // These items get checked by default
		'type' => 'multicheck',
		'options' => $theme_support_array);
		
			$options[] = array(
				'name' => __('Header Width', 'options_framework_theme'),
				'id' => 'gs_header_width',
				'std' => '960',
				'class' => 'mini hidden clear',
				'type' => 'text');
				
			$options[] = array(
				'name' => __('Header Height', 'options_framework_theme'),
				'id' => 'gs_header_height',
				'std' => '100',
				'class' => 'mini hidden',
				'type' => 'text');
				
			$options[] = array(
				'id' => 'gs_structural_wraps',
				'std' => $gs_structural_wraps_defaults, // These items get checked by default
				'type' => 'multicheck',
				'class' => 'hidden',
				'options' => $gs_structural_wraps_array);
				
			$options[] = array(
				'name' => __('How many footer widgets?', 'options_framework_theme'),
				'id' => 'gs_footer_widgets',
				'std' => '3',
				'class' => 'mini hidden clear',
				'type' => 'text');
	
	$options[] = array(
		'name' => __('Add Google Fonts', 'options_framework_theme'),
		'desc' => __('Add the google font function via the themes panel.', 'options_framework_theme'),
		'id' => 'gs_google_fonts_check',
		'std' => '1',
		'type' => 'checkbox');
		
		$options[] = array(
			'desc' => __('Manually add the google fonts you would like to use for the website.  Make sure to use the google fonts format, i.e. Open+Sans:400,700|Merriweather:400,700.', 'options_framework_theme'),
			'id' => 'gs_google_fonts_font',
			'class' => 'hidden',
			'std' => 'Open+Sans:400,700|Merriweather:400,700',
			'type' => 'text');
		
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#section-gs_footer_widgets').insertAfter('#genesis_sandbox-gs_theme_support_functions-four + label');
	$('#section-gs_structural_wraps').insertAfter('#genesis_sandbox-gs_theme_support_functions-three + label');
	$('#section-gs_header_width, #section-gs_header_height').insertAfter('#genesis_sandbox-gs_theme_support_functions-one + label');
	$('#section-gs_google_fonts_font').insertAfter('#gs_google_fonts_check + label');

	$('#gs_footer_creds_check').click(function() {
  		$('#section-gs_footer_creds_editor').fadeToggle(400);
	});
	
	$('#genesis_sandbox-gs_theme_support_functions-one').click(function() {
			$('#section-gs_header_width, #section-gs_header_height').fadeToggle(400);
	});
	
	$('#genesis_sandbox-gs_theme_support_functions-three').click(function() {
			$('#section-gs_structural_wraps').fadeToggle(400);
	});
	
	$('#genesis_sandbox-gs_theme_support_functions-four').click(function() {
			$('#section-gs_footer_widgets').fadeToggle(400);
	});
	
	$('#gs_google_fonts_check').click(function() {
			$('#section-gs_google_fonts_font').fadeToggle(400);
	});

	if ($('#gs_footer_creds_check:checked').val() !== undefined) {
		$('#section-gs_footer_creds_editor').show();
	}
	
	if ($('#genesis_sandbox-gs_theme_support_functions-one:checked').val() !== undefined) {
		$('#section-gs_header_width, #section-gs_header_height').show();
	}
	
	if ($('#genesis_sandbox-gs_theme_support_functions-three:checked').val() !== undefined) {
		$('#section-gs_structural_wraps').show();
	}
	
	if ($('#genesis_sandbox-gs_theme_support_functions-four:checked').val() !== undefined) {
		$('#section-gs_footer_widgets').show();
	}
	
	if ($('#gs_google_fonts_check:checked').val() !== undefined) {
		$('#section-gs_google_fonts_font').show();
	}

});
</script>

<?php
}