<?php
/**
 * Header Customizer.
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_header_section', array(
        'title'    => __( 'Pengaturan Header (Navbar)', 'crediblecompany' ),
        'panel'    => 'cc_global_panel',
        'priority' => 10,
    ) );

    // Pilihan Gaya Header
    $wp_customize->add_setting( 'cc_header_style', array(
        'default'           => 'classic',
        'sanitize_callback' => 'sanitize_key',
    ) );
    $wp_customize->add_control( 'cc_header_style', array(
        'label'    => __( 'Gaya Tampilan Header', 'crediblecompany' ),
        'section'  => 'cc_header_section',
        'type'     => 'radio',
        'choices'  => array(
            'classic'  => __( 'Klasik (Default)', 'crediblecompany' ),
            'centered' => __( 'Logo Terpusat & Stacked Menu', 'crediblecompany' ),
            'glass'    => __( 'Glassmorphism Floating', 'crediblecompany' ),
        ),
    ) );

    // Sticky Header Toggle
    $wp_customize->add_setting( 'cc_header_sticky', array(
        'default'           => true,
        'sanitize_callback' => 'cc_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'cc_header_sticky', array(
        'label'   => __( 'Aktifkan Sticky Header (Melayang saat di-scroll)', 'crediblecompany' ),
        'section' => 'cc_header_section',
        'type'    => 'checkbox',
    ) );

    // Warna Latar Belakang Header
    $wp_customize->add_setting( 'cc_header_bg_color', array(
        'default'           => '#c01314', // Brand Red default
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Header', 'crediblecompany' ),
        'section' => 'cc_header_section',
    ) ) );

    // Warna Teks / Ikon Header
    $wp_customize->add_setting( 'cc_header_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_text_color', array(
        'label'   => __( 'Warna Teks & Ikon Header', 'crediblecompany' ),
        'section' => 'cc_header_section',
    ) ) );

    // Header Search URL
    $wp_customize->add_setting( 'header_search_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'header_search_url', array(
        'label'       => __( 'URL Ikon Pencarian', 'crediblecompany' ),
        'description' => __( 'Biarkan kosong untuk menggunakan fitur pencarian bawaan (overlay/popup default dari tema). Isi URL untuk mengarahkan ikon search menyeberang ke halaman/link lain.', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'url',
    ) );

    // Header Account URL
    $wp_customize->add_setting( 'header_account_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'header_account_url', array(
        'label'       => __( 'URL Akun/Profil Pengguna', 'crediblecompany' ),
        'description' => __( 'Tautan untuk halaman login/register atau laman dashboard pengguna/client.', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'url',
    ) );

} );
