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
    'default'           => 0,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_padding_bottom_px', array(
    'label'           => __( 'V3: Padding Bawah Hero (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 0, 'max' => 150, 'step' => 2 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_title_size_px', array(
    'default'           => 72,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_title_size_px', array(
    'label'           => __( 'V3: Ukuran Font Judul (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 32, 'max' => 100, 'step' => 1 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_title_margin_bottom_px', array(
    'default'           => 32,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_title_margin_bottom_px', array(
    'label'           => __( 'V3: Jarak Bawah Judul (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 5, 'max' => 100, 'step' => 1 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_desc_size_px', array(
    'default'           => 20,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_desc_size_px', array(
    'label'           => __( 'V3: Ukuran Font Deskripsi (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 12, 'max' => 26, 'step' => 1 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_desc_margin_bottom_px', array(
    'default'           => 56,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_desc_margin_bottom_px', array(
    'label'           => __( 'V3: Jarak Bawah Deskripsi (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 10, 'max' => 100, 'step' => 2 ),
    'active_callback' => $v3_active_callback,
) );

// --- PENGATURAN KELENGKUNGAN SUDUT V3 ---
$wp_customize->add_setting( 'cc_hero_v3_card_radius_px', array(
    'default'           => 16,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_card_radius_px', array(
    'label'           => __( 'V3: Kelengkungan Kartu Melayang (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 0, 'max' => 40, 'step' => 1 ),
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_canvas_radius_px', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v3_canvas_radius_px', array(
    'label'           => __( 'V3: Kelengkungan Canvas Grafis (Pixel)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'range',
    'input_attrs'     => array( 'min' => 0, 'max' => 60, 'step' => 1 ),
    'active_callback' => $v3_active_callback,
) );

// --- PROMO BADGE & GAMBAR V3 ---
$wp_customize->add_setting( 'cc_hero_v3_promo_tag', array(
    'default'           => 'New!',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_promo_tag', array(
    'label'           => __( 'V3: Label Promo Badge', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_promo_text', array(
    'default'           => 'New! Introducing the new Jasper: Canvas, Agents, and a bold rebrand.',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_promo_text', array(
    'label'           => __( 'V3: Teks Promo Badge', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_promo_url', array(
    'default'           => '#',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'cc_hero_v3_promo_url', array(
    'label'           => __( 'V3: URL Promo Badge', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'url',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_image', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'cc_hero_v3_image', array(
    'label'           => __( 'V3: Gambar Model Utama Canvas', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

// --- KARTU MELAYANG & PARTNERS V3 ---
$wp_customize->add_setting( 'cc_hero_v3_card_left_icon', array(
    'default'           => '🔴',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_card_left_icon', array(
    'label'           => __( 'V3: Emoji Kartu Melayang Kiri', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'select',
    'choices'         => $emoji_choices,
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_card_left_text', array(
    'default'           => 'Buat 6.000 email super-personal dalam hitungan menit',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_card_left_text', array(
    'label'           => __( 'V3: Teks Kartu Melayang Kiri', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_card_right_num', array(
    'default'           => '11x',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_card_right_num', array(
    'label'           => __( 'V3: Angka Kartu Melayang Kanan', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_card_right_text', array(
    'default'           => 'rasio klik-tayang',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_card_right_text', array(
    'label'           => __( 'V3: Label Kartu Melayang Kanan', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_partners_title', array(
    'default'           => 'Dipercaya oleh tim pemasaran kelas dunia',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v3_partners_title', array(
    'label'           => __( 'V3: Judul Logo Kredibilitas Mitra', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

// --- TOMBOL CTA KUSTOM UNIK V3 ---
$wp_customize->add_setting( 'cc_hero_v3_btn1_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v3_btn1_enable', array(
    'label'           => __( 'V3: Tampilkan Tombol Utama (Outline)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'checkbox',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn1_text', array( 'default' => 'Start Trial', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v3_btn1_text', array(
    'label'           => __( 'V3: Teks Tombol Utama', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn1_url', array( 'default' => '#daftar', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v3_btn1_url', array(
    'label'           => __( 'V3: URL Tombol Utama', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'url',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn1_bg_color', array( 'default' => 'transparent', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn1_bg_color', array(
    'label'           => 'V3: Warna Latar Tombol Utama',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_btn1_text_color', array( 'default' => '#0f172a', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn1_text_color', array(
    'label'           => 'V3: Warna Teks/Border Tombol Utama',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_btn2_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v3_btn2_enable', array(
    'label'           => __( 'V3: Tampilkan Tombol Sekunder (Solid)', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'checkbox',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn2_text', array( 'default' => 'How It Works', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v3_btn2_text', array(
    'label'           => __( 'V3: Teks Tombol Sekunder', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'text',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn2_url', array( 'default' => '#how-it-works', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v3_btn2_url', array(
    'label'           => __( 'V3: URL Tombol Sekunder', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'url',
    'active_callback' => $v3_active_callback,
) );

$wp_customize->add_setting( 'cc_hero_v3_btn2_bg_color', array( 'default' => '#ff4f38', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn2_bg_color', array(
    'label'           => 'V3: Warna Latar Tombol Sekunder',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_btn2_text_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_btn2_text_color', array(
    'label'           => 'V3: Warna Teks Tombol Sekunder',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_btn_shape', array( 'default' => '50px', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v3_btn_shape', array(
    'label'           => __( 'V3: Bentuk Kelengkungan Tombol', 'crediblecompany' ),
    'section'         => 'cc_hero_section',
    'type'            => 'select',
    'choices'         => array(
        '50px' => 'Bulat Melengkung (Pill)',
        '8px'  => 'Sudut Tumpul (Rounded)',
        '0px'  => 'Kotak Persegi (Square)',
    ),
    'active_callback' => $v3_active_callback,
) );

// --- WARNA VISUAL CANVAS & ORNAMEN V3 ---
$wp_customize->add_setting( 'cc_hero_v3_canvas_bg', array( 'default' => '#00df89', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_canvas_bg', array(
    'label'           => 'V3: Warna Canvas Grid Utama',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_triangle_color', array( 'default' => '#f472b6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_triangle_color', array(
    'label'           => 'V3: Warna Segitiga Melayang',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_card_right_bg', array( 'default' => '#0b1c3f', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_card_right_bg', array(
    'label'           => 'V3: Warna Latar Kartu Kanan',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_circle_color', array( 'default' => '#047857', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_circle_color', array(
    'label'           => 'V3: Warna Aksen Lingkaran',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );

$wp_customize->add_setting( 'cc_hero_v3_blue_bars_color', array( 'default' => '#3b82f6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v3_blue_bars_color', array(
    'label'           => 'V3: Warna Garis Biru Miring',
    'section'         => 'cc_hero_section',
    'active_callback' => $v3_active_callback,
) ) );
