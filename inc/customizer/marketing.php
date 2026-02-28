<?php
/**
 * Customizer: Marketing Options
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_marketing_section', array(
        'title'    => __( 'Marketing Options', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 160,
    ) );

    // Fallback Nama Marketing
    $wp_customize->add_setting( 'cc_marketing_fallback_name', array(
        'default'           => 'Admin',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'cc_marketing_fallback_name', array(
        'label'       => __( 'Fallback Nama Marketing', 'crediblecompany' ),
        'description' => __( 'Nama yang akan muncul jika pengunjung tidak melalui link referral marketing (misal: Admin, Customer Service, dll).', 'crediblecompany' ),
        'section'     => 'cc_marketing_section',
        'type'        => 'text',
    ) );

} );
