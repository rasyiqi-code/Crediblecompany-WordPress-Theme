<?php
/**
 * Customizer: Footer Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_footer_section', array(
        'title'    => __( 'Footer Settings', 'crediblecompany' ),
        'panel'    => 'cc_global_panel',
        'priority' => 50,
    ) );

    /* --- Alamat Kantor --- */
    $wp_customize->add_setting( 'cc_footer_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'cc_footer_address', array(
        'label'       => __( 'Alamat Kantor', 'crediblecompany' ),
        'description' => __( 'Masukkan alamat lengkap kantor (mendukung baris baru).', 'crediblecompany' ),
        'section'     => 'cc_footer_section',
        'type'        => 'textarea',
    ) );

    /* --- Teks Hak Cipta --- */
    $wp_customize->add_setting( 'cc_footer_copyright', array(
        'default'           => 'Credible Company.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_footer_copyright', array(
        'label'   => __( 'Teks Hak Cipta', 'crediblecompany' ),
        'section' => 'cc_footer_section',
        'type'    => 'text',
    ) );

    // Pengaturan Warna Section Footer
    $wp_customize->add_setting( 'cc_footer_bg_color', array(
        'default'           => '#0b1c3f',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_footer_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Footer', 'crediblecompany' ),
        'section' => 'cc_footer_section',
    ) ) );

    $wp_customize->add_setting( 'cc_footer_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_footer_text_color', array(
        'label'   => __( 'Warna Font Teks Footer', 'crediblecompany' ),
        'section' => 'cc_footer_section',
    ) ) );

} );

