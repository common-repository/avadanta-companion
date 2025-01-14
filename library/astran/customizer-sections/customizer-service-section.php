<?php
if ( ! function_exists( 'avata_teczilla_service_customize_register' ) ) :
function avata_teczilla_service_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	
		/* Services section */
		$wp_customize->add_section( 'services_section' , array(
			'title'      => __('Service Section', 'avadanta'),
			'panel'  => 'home_section_settings',
			'priority'  => '',
		) );
		
		// Enable service
		$wp_customize->add_setting( 'home_service_section_enabled' , array( 'default' => 'on') );
		$wp_customize->add_control(	'home_service_section_enabled' , array(
				'label'    => __( 'Enable Services On Homepage', 'avadanta' ),
				'section'  => 'services_section',
				'type'     => 'radio',
				'choices' => array(
					'on'=>__('ON', 'avadanta'),
					'off'=>__('OFF', 'avadanta')
				)
		));
		
		// Service section title
		$wp_customize->add_setting( 'home_service_section_title',array(
		'capability'     => 'edit_theme_options',
		'default' => __('Our World Class Services','avadanta'),
		'sanitize_callback' => 'avata_avadanta_home_page_sanitize_text',
		));	
		$wp_customize->add_control( 'home_service_section_title',array(
		'label'   => __('Title','avadanta'),
		'section' => 'services_section',
		'type' => 'text',
		));	

		// Service section Sub title
		$wp_customize->add_setting( 'home_service_section_subtitle',array(
		'capability'     => 'edit_theme_options',
		'default' => __('What We Do To Serve You Best Our Services','avadanta'),
		'sanitize_callback' => 'avata_avadanta_home_page_sanitize_text',
		));	
		$wp_customize->add_control( 'home_service_section_subtitle',array(
		'label'   => __('Sub Title','avadanta'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		


		if ( class_exists( 'Avadanta_Repeater' ) ) {
			$wp_customize->add_setting( 'avadanta_service_content', array(
			) );

			$wp_customize->add_control( new Avadanta_Repeater( $wp_customize, 'avadanta_service_content', array(
				'label'                             => esc_html__( 'Service Content', 'avadanta' ),
				'section'                           => 'services_section',
				'priority'                          => 10,
				'add_field_label'                   => esc_html__( 'Add new Service', 'avadanta' ),
				'item_name'                         => esc_html__( 'Service', 'avadanta' ),
				'customizer_repeater_text_control'  => true,
				'customizer_repeater_title_control' => true,
				'customizer_repeater_icon_control'  => true,
				'customizer_repeater_link_control'  => true,

				) ) );
		}

		

}
add_action( 'customize_register', 'avata_teczilla_service_customize_register' );
endif;

/**
 * Add selective refresh for Front page section section controls.
 */
function avata_avadanta_register_home_service_section_partials( $wp_customize ){

	//Slider section
	$wp_customize->selective_refresh->add_partial( 'avadanta_service_content', array(
		'selector'            => '.srvc .gutter-vr-40px',
		'settings'            => 'avadanta_service_content',
	
	) );
	
	//Slider section
	$wp_customize->selective_refresh->add_partial( 'home_service_section_title', array(
		'selector'            => '.srvc .section-head',
		'settings'            => 'home_service_section_title',
		'render_callback'  => 'avata_avadanta_service_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_service_section_discription', array(
		'selector'            => '.srvc .section-head h2',
		'settings'            => 'home_service_section_discription',
		'render_callback'  => 'avata_avadanta_service_section_discription_render_callback',
	
	) );
	
}
add_action( 'customize_register', 'avata_avadanta_register_home_service_section_partials' );

function avata_avadanta_service_section_title_render_callback() {
	return get_theme_mod( 'home_service_section_title' );
}

function avata_avadanta_service_section_discription_render_callback() {
	return get_theme_mod( 'home_service_section_discription' );
}

if (!function_exists('avadanta_col_layout_option')) :
    function avadanta_col_layout_option()
    {
        $avadanta_col_layout_option = array(
            '6' => esc_html__('2 Column Layout', 'avadanta'),
			'4' => esc_html__('3 Column Layout', 'avadanta'),
			'3' => esc_html__('4 Column Layout', 'avadanta'), 
        );
        return apply_filters('avadanta_col_layout_option', $avadanta_col_layout_option);
    }
endif;

?>