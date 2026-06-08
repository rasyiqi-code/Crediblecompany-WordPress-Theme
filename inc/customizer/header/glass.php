<?php
/**
 * Customizer: Header - Varian Glassmorphism (Glass)
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Callback aktif untuk Header Glassmorphism
$glass_active_callback = function() {
    return get_theme_mod( 'cc_header_style', 'classic' ) === 'glass';
};

// Warna Latar Belakang Dasar Glassmorphism
$wp_customize->add_setting( 'cc_header_glass_bg_color', array(
    'default'           => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_glass_bg_color', array(
    'label'           => __( 'Glass: Warna Latar Belakang Dasar', 'crediblecompany' ),
    'description'     => __( 'Warna ini akan dicampur dengan opasitas di bawah.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $glass_active_callback,
) ) );

// Warna Teks / Ikon Header Glass
$wp_customize->add_setting( 'cc_header_glass_text_color', array(
    'default'           => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_glass_text_color', array(
    'label'           => __( 'Glass: Warna Teks & Ikon', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $glass_active_callback,
) ) );

// Warna Teks Hover Header Glass
$wp_customize->add_setting( 'cc_header_glass_text_hover_color', array(
    'default'           => '#ffcccc',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_glass_text_hover_color', array(
    'label'           => __( 'Glass: Warna Teks & Ikon saat Hover', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $glass_active_callback,
) ) );

// Opacity Latar Belakang Glassmorphism
$wp_customize->add_setting( 'cc_header_glass_opacity', array(
    'default'           => 85,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_header_glass_opacity', array(
    'label'           => __( 'Glass: Opasitas Latar Belakang (%)', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'range',
    'input_attrs'     => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 5,
    ),
    'active_callback' => $glass_active_callback,
) );

// Radius Blur Glassmorphism
$wp_customize->add_setting( 'cc_header_glass_blur', array(
    'default'           => 12,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_header_glass_blur', array(
    'label'           => __( 'Glass: Tingkat Blur Latar Belakang (px)', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'range',
    'input_attrs'     => array(
        'min'  => 0,
        'max'  => 30,
        'step' => 1,
    ),
    'active_callback' => $glass_active_callback,
) );

// Toggle Border Glassmorphism
$wp_customize->add_setting( 'cc_header_glass_border_enable', array(
    'default'           => true,
    'sanitize_callback' => 'cc_sanitize_checkbox',
) );
$wp_customize->add_control( 'cc_header_glass_border_enable', array(
    'label'           => __( 'Glass: Aktifkan Border Tipis Kapsul', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'checkbox',
    'active_callback' => $glass_active_callback,
) );

// Warna Border Glassmorphism
$wp_customize->add_setting( 'cc_header_glass_border_color', array(
    'default'           => 'rgba(255, 255, 255, 0.08)',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_header_glass_border_color', array(
    'label'           => __( 'Glass: Warna Border Kapsul', 'crediblecompany' ),
    'description'     => __( 'Mendukung Hex atau RGBA.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'type'            => 'text',
    'active_callback' => $glass_active_callback,
) );

// Warna Latar Belakang Mobile Glass (Opsional)
$wp_customize->add_setting( 'cc_header_glass_mobile_bg_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_glass_mobile_bg_color', array(
    'label'           => __( 'Glass: Warna Latar Mobile (Opsional)', 'crediblecompany' ),
    'description'     => __( 'Kosongkan untuk mengikuti warna dasar glass.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $glass_active_callback,
) ) );

// Warna Teks Mobile Glass (Opsional)
$wp_customize->add_setting( 'cc_header_glass_mobile_text_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_glass_mobile_text_color', array(
    'label'           => __( 'Glass: Warna Teks Mobile (Opsional)', 'crediblecompany' ),
    'description'     => __( 'Kosongkan untuk mengikuti warna teks utama.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $glass_active_callback,
) ) );

// Warna Teks Hover Mobile Glass (Opsional)
$wp_customize->add_setting( 'cc_header_glass_mobile_text_hover_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_header_glass_mobile_text_hover_color', array(
    'label'           => __( 'Glass: Warna Teks Hover Mobile (Opsional)', 'crediblecompany' ),
    'description'     => __( 'Kosongkan untuk mengikuti warna teks hover utama.', 'crediblecompany' ),
    'section'         => 'cc_header_section',
    'active_callback' => $glass_active_callback,
) ) );
