<?php
/**
 * Customizer: Hero Section - Varian 1 (Default)
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Tambahkan pengaturan khusus Hero V1 ke Customizer
$emoji_choices = array(
    '📚' => '📚 Buku (Edukasi)',
    '🚀' => '🚀 Roket (Startup / Launch)',
    '💡' => '💡 Ide (Kreatif / Inspirasi)',
    '📈' => '📈 Grafik Naik (Growth / Bisnis)',
    '✨' => '✨ Kilauan (Modern / Premium)',
    '🎓' => '🎓 Toga (Akademik)',
    '🎯' => '🎯 Target (Goal / Fokus)',
    '⚡' => '⚡ Petir (Kecepatan / Energi)',
    '💻' => '💻 Laptop (Teknologi / Coding)',
    '🔥' => '🔥 Api (Populer / Trending)',
    '💬' => '💬 Chat (Komunikasi)',
    '🔴' => '🔴 Bulatan Merah (Status / Live)',
    '🟢' => '🟢 Bulatan Hijau (Aktif / Sukses)',
    '🔵' => '🔵 Bulatan Biru (Informasi)',
);

// Callback aktif untuk V1
$v1_active_callback = function() {
    return get_theme_mod( 'cc_hero_variant', 'default' ) === 'default';
};

// --- PENGATURAN GEOMETRI & SPASI V1 ---
$wp_customize->add_setting( 'cc_hero_v1_padding_top_px', array(
    'default'           => 96,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v1_padding_top_px', array(
    'label'           => __( 'V1: Padding Atas Hero (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 20, 'max' => 200, 'step' => 2 ),
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_padding_bottom_px', array(
    'default'           => 64,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v1_padding_bottom_px', array(
    'label'           => __( 'V1: Padding Bawah Hero (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 20, 'max' => 200, 'step' => 2 ),
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_title_size_px', array(
    'default'           => 56,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v1_title_size_px', array(
    'label'           => __( 'V1: Ukuran Font Judul (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 24, 'max' => 80, 'step' => 1 ),
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_title_margin_bottom_px', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v1_title_margin_bottom_px', array(
    'label'           => __( 'V1: Jarak Bawah Judul (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 5, 'max' => 80, 'step' => 1 ),
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_desc_size_px', array(
    'default'           => 18,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v1_desc_size_px', array(
    'label'           => __( 'V1: Ukuran Font Deskripsi (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 12, 'max' => 24, 'step' => 1 ),
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_desc_margin_bottom_px', array(
    'default'           => 40,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v1_desc_margin_bottom_px', array(
    'label'           => __( 'V1: Jarak Bawah Deskripsi (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 10, 'max' => 100, 'step' => 2 ),
    'active_callback' => $v1_active_callback,
) );

// --- VISUAL & GAMBAR V1 ---
$wp_customize->add_setting( 'cc_hero_v1_image', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'cc_hero_v1_image', array(
    'label'           => __( 'V1: Gambar Utama Hero', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_ornament_1', array(
    'default'           => '📚',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v1_ornament_1', array(
    'label'           => __( 'V1: Ornamen Melayang 1 (Ikon)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'select',
    'choices'         => $emoji_choices,
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_ornament_2', array(
    'default'           => '🎓',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v1_ornament_2', array(
    'label'           => __( 'V1: Ornamen Melayang 2 (Ikon)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'select',
    'choices'         => $emoji_choices,
    'active_callback' => $v1_active_callback,
) );

// --- TOMBOL CTA KUSTOM UNIK V1 ---
$wp_customize->add_setting( 'cc_hero_v1_btn1_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v1_btn1_enable', array(
    'label'           => __( 'V1: Tampilkan Tombol Utama', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'checkbox',
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_btn1_text', array( 'default' => 'Start Trial', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v1_btn1_text', array(
    'label'           => __( 'V1: Teks Tombol Utama', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_btn1_url', array( 'default' => '#daftar', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v1_btn1_url', array(
    'label'           => __( 'V1: URL Tombol Utama', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'url',
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_btn1_bg_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_btn1_bg_color', array(
    'label'           => 'V1: Warna Latar Tombol Utama',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_btn1_text_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_btn1_text_color', array(
    'label'           => 'V1: Warna Teks Tombol Utama',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_btn2_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v1_btn2_enable', array(
    'label'           => __( 'V1: Tampilkan Tombol Sekunder', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'checkbox',
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_btn2_text', array( 'default' => 'How It Works', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v1_btn2_text', array(
    'label'           => __( 'V1: Teks Tombol Sekunder', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_btn2_url', array( 'default' => '#how-it-works', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v1_btn2_url', array(
    'label'           => __( 'V1: URL Tombol Sekunder', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'url',
    'active_callback' => $v1_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v1_btn2_bg_color', array( 'default' => 'transparent', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_btn2_bg_color', array(
    'label'           => 'V1: Warna Latar Tombol Sekunder',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_btn2_text_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_btn2_text_color', array(
    'label'           => 'V1: Warna Teks Tombol Sekunder',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_btn_shape', array( 'default' => '50px', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v1_btn_shape', array(
    'label'           => __( 'V1: Bentuk Kelengkungan Tombol', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'select',
    'choices'         => array(
        '50px' => 'Bulat Melengkung (Pill)',
        '8px'  => 'Sudut Tumpul (Rounded)',
        '0px'  => 'Kotak Persegi (Square)',
    ),
    'active_callback' => $v1_active_callback,
) );

// --- WARNA SHAPES LATAR V1 ---
$wp_customize->add_setting( 'cc_hero_v1_shape_bg_image', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'cc_hero_v1_shape_bg_image', array(
    'label'           => __( 'V1: Gambar Latar Shape Utama', 'crediblecompany' ),
    'description'     => __( 'Upload gambar latar abstrak. Kosongkan untuk pakai warna solid.', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_shape_main_color', array( 'default' => '#ea580c', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_shape_main_color', array(
    'label'           => 'V1: Warna Latar Lingkaran Utama',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_shape_yellow_color', array( 'default' => '#EAB308', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_shape_yellow_color', array(
    'label'           => 'V1: Warna Shape Blob Kuning',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_shape_blue_color', array( 'default' => '#3B82F6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_shape_blue_color', array(
    'label'           => 'V1: Warna Shape Lingkaran Biru',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_shape_red_color', array( 'default' => '#EF4444', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_shape_red_color', array(
    'label'           => 'V1: Warna Shape Lingkaran Merah',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_shape_purple_color', array( 'default' => '#8B5CF6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_shape_purple_color', array(
    'label'           => 'V1: Warna Shape Lingkaran Ungu',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

// --- WARNA STATISTIK INLINE V1 ---
$wp_customize->add_setting( 'cc_hero_v1_stat_number_color', array( 'default' => '#F59E0B', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_stat_number_color', array(
    'label'           => 'V1: Warna Angka Statistik',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v1_stat_label_color', array( 'default' => '#1e293b', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v1_stat_label_color', array(
    'label'           => 'V1: Warna Label Statistik',
    'section'         => 'cc_hero_section',
    'active_callback' => $v1_active_callback,
) ) );
