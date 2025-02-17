<?php
if ( ! function_exists( 'avata_avadanta_portfolio_customize_register' ) ) :
function avata_avadanta_portfolio_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
//Portfolio Section
			$wp_customize->add_section('avadanta_portfolio_section',array(
					'title' => __('Portfolio Section','avadanta'),
					'panel' => 'home_section_settings',
					'priority'  => '',
					));
		
			$wp_customize->add_setting( 'portfolio_section_enable' , array( 'default' => 'on') );
			$wp_customize->add_control(	'portfolio_section_enable' , array(
					'label'    => __( 'Enable Home Portfolio Section', 'avadanta' ),
					'section'  => 'avadanta_portfolio_section',
					'type'     => 'radio',
					'choices' => array(
						'on'=>__('ON', 'avadanta'),
						'off'=>__('OFF', 'avadanta')
					)
			));
			
			// Portfolio section title
			$wp_customize->add_setting( 'home_portfolio_section_title',array(
			'default' => __('Our Company Portfolio','avadanta'),
			'sanitize_callback' => 'sanitize_text_field',
			));	
			$wp_customize->add_control( 'home_portfolio_section_title',array(
			'label'   => __('Title','avadanta'),
			'section' => 'avadanta_portfolio_section',
			'type' => 'text',
			));	
			

			// Portfolio section Sub
			$wp_customize->add_setting( 'home_portfolio_section_subtitle',array(
			'default' => __('Our Company Portfolio','avadanta'),
			'sanitize_callback' => 'sanitize_text_field',
			));	
			$wp_customize->add_control( 'home_portfolio_section_subtitle',array(
			'label'   => __('Sub Title','avadanta'),
			'section' => 'avadanta_portfolio_section',
			'type' => 'text',
			));	

		// column layout
		$wp_customize->add_setting(
		'avadanta_portfolio_col_layout',
			array(
				'default' => '4',
				'sanitize_callback' => 'avadanta_comapanion_sanitize_select',
			)
		);
		$avadanta_port_col_layout_option = avadanta_port_col_layout_option();
		
		$wp_customize->add_control(
		'avadanta_portfolio_col_layout',
			array(
				'type' => 'radio',
				'label' => esc_html__('Column Layout Option ', 'avadanta'),
				'description' => '',
				'section' => 'avadanta_portfolio_section',
				'choices' => $avadanta_port_col_layout_option,
				'priority' => 10,
			)
		);


			if ( class_exists( 'Avadanta_Repeater' ) ) {
			$wp_customize->add_setting(
				'avadanta_portfolio_content', array(
				)
			);

			$wp_customize->add_control(
				new Avadanta_Repeater(
					$wp_customize, 'avadanta_portfolio_content', array(
						'label'                            => esc_html__( 'Portfolio Content', 'avadanta' ),
						'section'                          => 'avadanta_portfolio_section',
						'priority'                         => 15,
						'add_field_label'                  => esc_html__( 'Add new Portfolio', 'avadanta' ),
						'item_name'                        => esc_html__( 'Portfolio', 'avadanta' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_link_control'  => true,
					)
				)
			);
		} 



}
add_action( 'customize_register', 'avata_avadanta_portfolio_customize_register' );
endif;
    /**
	* Add selective refresh for Front page portfolio section controls.
	*/
	
function avata_avadanta_register_home_portfolio_section_partials( $wp_customize ){
	
	$wp_customize->selective_refresh->add_partial( 'home_portfolio_section_title', array(
		'selector'            => '.section-project .section-head',
		'settings'            => 'home_portfolio_section_title',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_portfolio_section_discription', array(
		'selector'            => '.section-project .section-head h2',
		'settings'            => 'home_portfolio_section_discription',
	
	) );

		$wp_customize->selective_refresh->add_partial( 'avadanta_portfolio_content', array(
		'selector'            => '.section-project .project-area .project-v5',
		'settings'            => 'avadanta_portfolio_content',
	
	) );

}
add_action( 'customize_register', 'avata_avadanta_register_home_portfolio_section_partials' );


if (!function_exists('avadanta_port_col_layout_option')) :
    function avadanta_port_col_layout_option()
    {
        $avadanta_port_col_layout_option = array(
			'4' => esc_html__('3 Column Layout', 'avadanta'),
			'3' => esc_html__('4 Column Layout', 'avadanta'), 
        );
        return apply_filters('avadanta_port_col_layout_option', $avadanta_port_col_layout_option);
    }
endif;

?>