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

    // Warna Teks Hover
    $wp_customize->add_setting( 'cc_header_text_hover_color', array(
        'default'           => '#ffcccc',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_text_hover_color', array(
        'label'   => __( 'Warna Teks & Ikon saat Hover', 'crediblecompany' ),
        'section' => 'cc_header_section',
    ) ) );

    // Lebar Maksimal Logo
    $wp_customize->add_setting( 'cc_header_logo_width', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_header_logo_width', array(
        'label'       => __( 'Lebar Maksimal Logo (px)', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 350,
            'step' => 5,
        ),
    ) );

    // Padding Vertikal Header (Tinggi Navbar)
    $wp_customize->add_setting( 'cc_header_padding', array(
        'default'           => 12,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_header_padding', array(
        'label'       => __( 'Padding Vertikal Header (px)', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 5,
            'max'  => 50,
            'step' => 1,
        ),
    ) );

    // Ukuran Font Menu Navigasi
    $wp_customize->add_setting( 'cc_header_menu_font_size', array(
        'default'           => 14,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_header_menu_font_size', array(
        'label'       => __( 'Ukuran Font Menu Navigasi (px)', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ) );

    // Opacity Latar Belakang Glassmorphism
    $wp_customize->add_setting( 'cc_header_glass_opacity', array(
        'default'           => 85,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_header_glass_opacity', array(
        'label'       => __( 'Opasitas Latar Belakang Glassmorphism (%)', 'crediblecompany' ),
        'description' => __( 'Hanya berlaku jika Gaya Glassmorphism aktif.', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 5,
        ),
    ) );

    // Radius Blur Glassmorphism
    $wp_customize->add_setting( 'cc_header_glass_blur', array(
        'default'           => 12,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_header_glass_blur', array(
        'label'       => __( 'Tingkat Blur Glassmorphism (px)', 'crediblecompany' ),
        'description' => __( 'Hanya berlaku jika Gaya Glassmorphism aktif.', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 30,
            'step' => 1,
        ),
    ) );

    // Toggle Border Bawah
    $wp_customize->add_setting( 'cc_header_border_enable', array(
        'default'           => false,
        'sanitize_callback' => 'cc_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'cc_header_border_enable', array(
        'label'   => __( 'Aktifkan Border Bawah Header', 'crediblecompany' ),
        'section' => 'cc_header_section',
        'type'    => 'checkbox',
    ) );

    // Warna Border Bawah
    $wp_customize->add_setting( 'cc_header_border_color', array(
        'default'           => 'rgba(255, 255, 255, 0.15)',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_header_border_color', array(
        'label'       => __( 'Warna Border Bawah', 'crediblecompany' ),
        'description' => __( 'Mendukung Hex (misal: #ffffff) atau RGBA (misal: rgba(255,255,255,0.15)).', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'text',
    ) );

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
