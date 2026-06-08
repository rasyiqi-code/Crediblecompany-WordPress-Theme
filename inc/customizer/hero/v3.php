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

// --- PENGATURAN WARNA DETAIL HERO V3 ---
$wp_customize->add_setting( 'cc_hero_v3_bg_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_bg_color', array(
    'label'           => 'V3: Warna Latar Belakang Hero',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_title_color', array( 'default' => '#000000', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_title_color', array(
    'label'           => 'V3: Warna Teks Judul Utama',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_headline_color', array( 'default' => '#000000', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_headline_color', array(
    'label'           => 'V3: Warna Teks Headline',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_desc_color', array( 'default' => '#475569', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_desc_color', array(
    'label'           => 'V3: Warna Teks Deskripsi',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

// --- PENGATURAN WARNA TOMBOL EXPLORE V3 ---
$wp_customize->add_setting( 'cc_hero_v3_btn_bg_color', array( 'default' => '#000000', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn_bg_color', array(
    'label'           => 'V3: Warna Latar Tombol Explore',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_btn_text_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn_text_color', array(
    'label'           => 'V3: Warna Teks Tombol Explore',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_btn_hover_bg_color', array( 'default' => 'transparent', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn_hover_bg_color', array(
    'label'           => 'V3: Warna Hover Latar Tombol Explore',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_btn_hover_text_color', array( 'default' => '#000000', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn_hover_text_color', array(
    'label'           => 'V3: Warna Hover Teks Tombol Explore',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

// --- PENGATURAN WARNA LINK READ MORE V3 ---
$wp_customize->add_setting( 'cc_hero_v3_link_color', array( 'default' => '#000000', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_link_color', array(
    'label'           => 'V3: Warna Link Read More',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_link_hover_color', array( 'default' => '#f37021', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_link_hover_color', array(
    'label'           => 'V3: Warna Hover Link Read More',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

// --- PENGATURAN DETAIL SPASI/JARAK V3 ---
$wp_customize->add_setting( 'cc_hero_v3_grid_gap_px', array(
    'default'           => 56,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_grid_gap_px', array(
    'label'           => __( 'V3: Jarak Antar Kolom (Grid Gap px)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 16, 'max' => 100, 'step' => 2 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_title_margin_bottom_px', array(
    'default'           => 32,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_title_margin_bottom_px', array(
    'label'           => __( 'V3: Jarak Bawah Judul Raksasa (px)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 8, 'max' => 80, 'step' => 2 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_headline_margin_bottom_px', array(
    'default'           => 16,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_headline_margin_bottom_px', array(
    'label'           => __( 'V3: Jarak Bawah Headline (px)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 4, 'max' => 48, 'step' => 2 ),
    'active_callback' => $v3_active_callback,
) );

