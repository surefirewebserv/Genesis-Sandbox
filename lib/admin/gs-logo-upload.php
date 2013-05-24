<?php 

function gs_logo_uploader( $wp_customize ) {
    
    // Add the section to the theme customizer in WP
    $wp_customize->add_section( 'gs_logo_section' , array(
	    'title'       => __( 'Upload Logo', CHILD_DOMAIN ),
	    'priority'    => 30,
	    'description' => __( 'Upload your logo to the header of the site.', CHILD_DOMAIN ),
	) );

	// Register the new setting
	$wp_customize->add_setting( 'gs_logo' );

	// Tell WP to use an image uploader using WP_Customize_Image_Control
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'gs_logo', array(
	    'label'    => __( 'Logo', CHILD_DOMAIN ),
	    'section'  => 'gs_logo_section',
	    'settings' => 'gs_logo',
	) ) );

}
add_action('customize_register', 'gs_logo_uploader');

