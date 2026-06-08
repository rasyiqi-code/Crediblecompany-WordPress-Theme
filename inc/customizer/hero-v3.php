<?php
/**
 * Customizer: Hero Section - Varian 3 (Jasper)
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Tambahkan pengaturan khusus Hero V3 ke Customizer

// Callback aktif untuk V3
$v3_active_callback = function() {
    return get_theme_mod( 'cc_hero_variant', 'default' ) === 'v3';
};

// --- PENGATURAN GEOMETRI & SPASI V3 ---
$wp_customize->add_setting( 'cc_hero_v3_padding_top_px', array(
    'default'           => 96,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_padding_top_px', array(
    'label'           => __( 'V3: Padding Atas Hero (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 20, 'max' => 200, 'step' => 2 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_padding_bottom_px', array(
    'default'           => 144, // Ditingkatkan untuk ruang udara yang seimbang di desain minimalis
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_padding_bottom_px', array(
    'label'           => __( 'V3: Padding Bawah Hero (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 0, 'max' => 200, 'step' => 2 ),
    'active_callback' => $v3_active_callback,
) );

// --- PENGATURAN KONTEN TITEL RAKSASA V3 ---
$wp_customize->add_setting( 'cc_hero_v3_title_line_1', array(
    'default'           => 'DESIGN',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_title_line_1', array(
    'label'           => __( 'V3: Judul Baris 1', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_title_line_2', array(
    'default'           => 'CULTURE',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_title_line_2', array(
    'label'           => __( 'V3: Judul Baris 2', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

// --- PENGATURAN GAMBAR MODEL V3 ---
$wp_customize->add_setting( 'cc_hero_v3_image', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'cc_hero_v3_image', array(
    'label'           => __( 'V3: Gambar Model Mosaic (4x4)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

// --- PENGATURAN TOMBOL & TAUTAN V3 ---

// Tombol 1: Link Read More (Utama)
$wp_customize->add_setting( 'cc_hero_v3_btn1_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v3_btn1_enable', array(
    'label'           => __( 'V3: Tampilkan Link Read More', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'checkbox',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn1_text', array( 'default' => 'Read More', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v3_btn1_text', array(
    'label'           => __( 'V3: Teks Link Read More', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn1_url', array( 'default' => '#about', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v3_btn1_url', array(
    'label'           => __( 'V3: URL Link Read More', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'url',
    'active_callback' => $v3_active_callback,
) );

// Tombol 2: Tombol Explore (Sekunder)
$wp_customize->add_setting( 'cc_hero_v3_btn2_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v3_btn2_enable', array(
    'label'           => __( 'V3: Tampilkan Tombol Explore', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'checkbox',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn2_text', array( 'default' => 'EXPLORE COLLECTION', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v3_btn2_text', array(
    'label'           => __( 'V3: Teks Tombol Explore', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn2_url', array( 'default' => '#explore', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v3_btn2_url', array(
    'label'           => __( 'V3: URL Tombol Explore', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'url',
    'active_callback' => $v3_active_callback,
) );

// --- PENGATURAN WARNA AKSEN V3 ---
$wp_customize->add_setting( 'cc_hero_v3_accent_color', array( 'default' => '#f37021', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_accent_color', array(
    'label'           => 'V3: Warna Aksen Kotak (Oranye/Kuning)',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );
