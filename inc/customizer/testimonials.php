<?php
/**
 * Customizer: Testimonials Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_testimonials_section', array(
        'title'    => __( 'Pengaturan Testimoni', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 45,
    ) );

    // Judul Testimoni
    $wp_customize->add_setting( 'cc_testimonials_title', array(
        'default'           => 'Testimoni Mitra Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_testimonials_title', array(
        'label'   => __( 'Judul Section', 'crediblecompany' ),
        'section' => 'cc_testimonials_section',
        'type'    => 'text',
    ) );

} );
