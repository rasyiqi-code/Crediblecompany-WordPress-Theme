<?php
/**
 * Customizer: Header - Varian Terpusat (Centered Logo & Stacked Menu)
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Callback aktif untuk Header Centered
$centered_active_callback = function() {
    return get_theme_mod( 'cc_header_style', 'classic' ) === 'centered';
};

// Warna Latar Belakang Header Centered
$wp_customize->add_setting( 'cc_header_centered_bg_color', array(
    'default'           => '#c01314', // Brand Red default
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_centered_bg_color', array(
    'label'           => __( 'Centered: Warna Latar Belakang Header', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $centered_active_callback,
) ) );

// Warna Teks / Ikon Header Centered
$wp_customize->add_setting( 'cc_header_centered_text_color', array(
    'default'           => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_centered_text_color', array(
    'label'           => __( 'Centered: Warna Teks & Ikon Header', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $centered_active_callback,
) ) );

// Warna Teks Hover Header Centered
$wp_customize->add_setting( 'cc_header_centered_text_hover_color', array(
    'default'           => '#ffcccc',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_centered_text_hover_color', array(
    'label'           => __( 'Centered: Warna Teks & Ikon saat Hover', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $centered_active_callback,
) ) );

// Warna Latar Belakang Header Mobile Centered (Opsional)
$wp_customize->add_setting( 'cc_header_centered_mobile_bg_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_centered_mobile_bg_color', array(
    'label'           => __( 'Centered: Warna Latar Belakang Header Mobile (Opsional)', 'crediblecompany' ),
    'description'     => __( 'Kosongkan untuk mengikuti warna header utama.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $centered_active_callback,
) ) );

// Warna Teks / Ikon Header Mobile Centered (Opsional)
$wp_customize->add_setting( 'cc_header_centered_mobile_text_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_centered_mobile_text_color', array(
    'label'           => __( 'Centered: Warna Teks & Ikon Header Mobile (Opsional)', 'crediblecompany' ),
    'description'     => __( 'Kosongkan untuk mengikuti warna header utama.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $centered_active_callback,
) ) );

// Warna Teks Hover Header Mobile Centered (Opsional)
$wp_customize->add_setting( 'cc_header_centered_mobile_text_hover_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_centered_mobile_text_hover_color', array(
    'label'           => __( 'Centered: Warna Teks Hover Header Mobile (Opsional)', 'crediblecompany' ),
    'description'     => __( 'Kosongkan untuk mengikuti warna header utama.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $centered_active_callback,
) ) );

// Padding Vertikal Header Centered (Tinggi Navbar)
$wp_customize->add_setting( 'cc_header_centered_padding', array(
    'default'           => 12,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_header_centered_padding', array(
    'label'           => __( 'Centered: Padding Vertikal Header (px)', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'range',
    'input_attrs'     => array(
        'min'  => 5,
        'max'  => 50,
        'step' => 1,
    ),
    'active_callback' => $centered_active_callback,
) );

// Ukuran Font Menu Navigasi Centered
$wp_customize->add_setting( 'cc_header_centered_menu_font_size', array(
    'default'           => 14,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_header_centered_menu_font_size', array(
    'label'           => __( 'Centered: Ukuran Font Menu Navigasi (px)', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'range',
    'input_attrs'     => array(
        'min'  => 12,
        'max'  => 24,
        'step' => 1,
    ),
    'active_callback' => $centered_active_callback,
) );

// Toggle Border Bawah Centered
$wp_customize->add_setting( 'cc_header_centered_border_enable', array(
    'default'           => false,
    'sanitize_callback' => 'cc_sanitize_checkbox',
) );
$wp_customize->add_control( 'cc_header_centered_border_enable', array(
    'label'           => __( 'Centered: Aktifkan Border Bawah Header', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'checkbox',
    'active_callback' => $centered_active_callback,
) );

// Warna Border Bawah Centered
$wp_customize->add_setting( 'cc_header_centered_border_color', array(
    'default'           => 'rgba(255, 255, 255, 0.15)',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_header_centered_border_color', array(
    'label'           => __( 'Centered: Warna Border Bawah', 'crediblecompany' ),
    'description'     => __( 'Mendukung Hex atau RGBA.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'text',
    'active_callback' => $centered_active_callback,
) );
