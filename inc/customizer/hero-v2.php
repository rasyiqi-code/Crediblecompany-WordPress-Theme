<?php
/**
 * Customizer: Hero Section - Varian 2 (Centered)
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Tambahkan pengaturan khusus Hero V2 ke Customizer
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

// --- PENGATURAN GEOMETRI & SPASI V2 ---
$wp_customize->add_setting( 'cc_hero_v2_padding_top_px', array(
    'default'           => 128,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v2_padding_top_px', array(
    'label'       => __( 'V2: Padding Atas Hero (Pixel)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'range',
    'input_attrs' => array( 'min' => 40, 'max' => 250, 'step' => 2 ),
) );

$wp_customize->add_setting( 'cc_hero_v2_padding_bottom_px', array(
    'default'           => 96,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v2_padding_bottom_px', array(
    'label'       => __( 'V2: Padding Bawah Hero (Pixel)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'range',
    'input_attrs' => array( 'min' => 40, 'max' => 250, 'step' => 2 ),
) );

$wp_customize->add_setting( 'cc_hero_v2_title_size_px', array(
    'default'           => 64,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v2_title_size_px', array(
    'label'       => __( 'V2: Ukuran Font Judul (Pixel)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'range',
    'input_attrs' => array( 'min' => 28, 'max' => 90, 'step' => 1 ),
) );

$wp_customize->add_setting( 'cc_hero_v2_title_margin_bottom_px', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v2_title_margin_bottom_px', array(
    'label'       => __( 'V2: Jarak Bawah Judul (Pixel)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'range',
    'input_attrs' => array( 'min' => 5, 'max' => 80, 'step' => 1 ),
) );

$wp_customize->add_setting( 'cc_hero_v2_desc_size_px', array(
    'default'           => 20,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v2_desc_size_px', array(
    'label'       => __( 'V2: Ukuran Font Deskripsi (Pixel)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'range',
    'input_attrs' => array( 'min' => 12, 'max' => 26, 'step' => 1 ),
) );

$wp_customize->add_setting( 'cc_hero_v2_desc_margin_bottom_px', array(
    'default'           => 48,
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'cc_hero_v2_desc_margin_bottom_px', array(
    'label'       => __( 'V2: Jarak Bawah Deskripsi (Pixel)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'range',
    'input_attrs' => array( 'min' => 10, 'max' => 100, 'step' => 2 ),
) );

// --- ORNAMEN & LENCANA V2 ---
$wp_customize->add_setting( 'cc_hero_v2_badge_text', array(
    'default'           => 'Solusi Terpercaya & Modern',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v2_badge_text', array(
    'label'       => __( 'V2: Teks Lencana (Badge)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'text',
) );

$wp_customize->add_setting( 'cc_hero_v2_ornament_1', array(
    'default'           => '🚀',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v2_ornament_1', array(
    'label'       => __( 'V2: Ikon Lencana (Badge Emoji)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'select',
    'choices'     => $emoji_choices,
) );

$wp_customize->add_setting( 'cc_hero_v2_ornament_2', array(
    'default'           => '✨',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v2_ornament_2', array(
    'label'       => __( 'V2: Ornamen Melayang Kiri (Ikon)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'select',
    'choices'     => $emoji_choices,
) );

$wp_customize->add_setting( 'cc_hero_v2_ornament_3', array(
    'default'           => '🎓',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'cc_hero_v2_ornament_3', array(
    'label'       => __( 'V2: Ornamen Melayang Kanan (Ikon)', 'crediblecompany' ),
    'section'     => 'cc_hero_section',
    'type'        => 'select',
    'choices'     => $emoji_choices,
) );

// --- TOMBOL CTA KUSTOM UNIK V2 ---
$wp_customize->add_setting( 'cc_hero_v2_btn1_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v2_btn1_enable', array( 'label' => __( 'V2: Tampilkan Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'checkbox' ) );

$wp_customize->add_setting( 'cc_hero_v2_btn1_text', array( 'default' => 'Start Trial', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v2_btn1_text', array( 'label' => __( 'V2: Teks Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'text' ) );

$wp_customize->add_setting( 'cc_hero_v2_btn1_url', array( 'default' => '#daftar', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v2_btn1_url', array( 'label' => __( 'V2: URL Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'url' ) );

$wp_customize->add_setting( 'cc_hero_v2_btn1_bg_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_btn1_bg_color', array( 'label' => 'V2: Warna Latar Tombol Utama', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_btn1_text_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_btn1_text_color', array( 'label' => 'V2: Warna Teks Tombol Utama', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_btn2_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
$wp_customize->add_control( 'cc_hero_v2_btn2_enable', array( 'label' => __( 'V2: Tampilkan Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'checkbox' ) );

$wp_customize->add_setting( 'cc_hero_v2_btn2_text', array( 'default' => 'How It Works', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v2_btn2_text', array( 'label' => __( 'V2: Teks Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'text' ) );

$wp_customize->add_setting( 'cc_hero_v2_btn2_url', array( 'default' => '#how-it-works', 'sanitize_callback' => 'esc_url_raw' ) );
$wp_customize->add_control( 'cc_hero_v2_btn2_url', array( 'label' => __( 'V2: URL Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'url' ) );

$wp_customize->add_setting( 'cc_hero_v2_btn2_bg_color', array( 'default' => 'transparent', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_btn2_bg_color', array( 'label' => 'V2: Warna Latar Tombol Sekunder', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_btn2_text_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_btn2_text_color', array( 'label' => 'V2: Warna Teks Tombol Sekunder', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_btn_shape', array( 'default' => '50px', 'sanitize_callback' => 'sanitize_text_field' ) );
$wp_customize->add_control( 'cc_hero_v2_btn_shape', array(
    'label'   => __( 'V2: Bentuk Kelengkungan Tombol', 'crediblecompany' ),
    'section' => 'cc_hero_section',
    'type'    => 'select',
    'choices' => array(
        '50px' => 'Bulat Melengkung (Pill)',
        '8px'  => 'Sudut Tumpul (Rounded)',
        '0px'  => 'Kotak Persegi (Square)',
    )
) );

// --- WARNA AMBIENT GLOW & SHAPES V2 ---
$wp_customize->add_setting( 'cc_hero_v2_glow_color_1', array( 'default' => '#3B82F6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_glow_color_1', array( 'label' => 'V2: Warna Ambient Glow 1 (Kiri Atas)', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_glow_color_2', array( 'default' => '#8B5CF6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_glow_color_2', array( 'label' => 'V2: Warna Ambient Glow 2 (Kanan Bawah)', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_shape_red_color', array( 'default' => '#EF4444', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_shape_red_color', array( 'label' => 'V2: Warna Latar Ornamen Kiri 1', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_shape_purple_color', array( 'default' => '#8B5CF6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_shape_purple_color', array( 'label' => 'V2: Warna Latar Ornamen Kanan 1', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_shape_yellow_color', array( 'default' => '#EAB308', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_shape_yellow_color', array( 'label' => 'V2: Warna Bulat Kecil Kuning', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_shape_blue_color', array( 'default' => '#3B82F6', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_shape_blue_color', array( 'label' => 'V2: Warna Bulat Kecil Biru', 'section' => 'cc_hero_section' ) ) );

// --- WARNA STATISTIK V2 ---
$wp_customize->add_setting( 'cc_hero_v2_stat_number_color', array( 'default' => '#F59E0B', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_stat_number_color', array( 'label' => 'V2: Warna Angka Statistik', 'section' => 'cc_hero_section' ) ) );

$wp_customize->add_setting( 'cc_hero_v2_stat_label_color', array( 'default' => '#64748b', 'sanitize_callback' => 'sanitize_hex_color' ) );
$wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_v2_stat_label_color', array( 'label' => 'V2: Warna Label Statistik', 'section' => 'cc_hero_section' ) ) );
