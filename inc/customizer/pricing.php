<?php
/**
 * Customizer: Pricing Section (Paket Jasa)
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_pricing_section', array(
        'title' => __( 'Section Paket Jasa', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    $wp_customize->add_setting( 'cc_pricing_title', array(
        'default'           => 'Jasa KBM Indonesia Group',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_pricing_title', array(
        'label'   => __( 'Judul Section', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'cc_pricing_subtitle', array(
        'default'           => 'Anda bisa memilih kami untuk jasa berikut:',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_pricing_subtitle', array(
        'label'   => __( 'Subtitle Section', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'text',
    ) );

} );
