<?php
/**
 * Customizer: Hero Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_hero_section', array(
        'title'    => __( 'Hero Section', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 10,
    ) );

    // --- PILIHAN LAYOUT / VARIANT HERO ---
    $wp_customize->add_setting( 'cc_hero_variant', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_key',
    ) );
    $wp_customize->add_control( 'cc_hero_variant', array(
        'label'       => __( 'Layout Hero', 'crediblecompany' ),
        'description' => __( 'Pilih tampilan hero yang digunakan di halaman depan.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'select',
        'choices'     => array(
            'default' => 'Default — Teks kiri, gambar kanan dengan shapes',
            'v2'      => 'Centered — Teks tengah, gradient latar, tanpa gambar',
            'v3'      => 'Jasper — Centered, promo badge, & grid grafis melayang',
        ),
        'priority'    => 1, // Paling atas
    ) );

    // --- PROMO BADGE HERO (KHUSUS LAYOUT JASPER V3) ---
    $wp_customize->add_setting( 'cc_hero_promo_text', array(
        'default'           => 'New! Introducing the new Jasper: Canvas, Agents, and a bold rebrand.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_promo_text', array(
        'label'       => __( 'Teks Promo Badge Hero', 'crediblecompany' ),
        'description' => __( 'Teks pengumuman di atas judul hero (hanya aktif pada layout Jasper).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
        'priority'    => 2,
    ) );

    $wp_customize->add_setting( 'cc_hero_promo_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'cc_hero_promo_url', array(
        'label'       => __( 'URL Promo Badge Hero', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'url',
        'priority'    => 3,
    ) );

    // Judul Hero
    $wp_customize->add_setting( 'cc_hero_title', array(
        'default'           => 'Lorem Ipsum Dolor Sit Amet',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'cc_hero_title', array(
        'label'   => __( 'Judul Hero', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'text',
    ) );

    // Deskripsi Hero
    $wp_customize->add_setting( 'cc_hero_desc', array(
        'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'cc_hero_desc', array(
        'label'   => __( 'Deskripsi Hero', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'textarea',
    ) );

    // --- TOMBOL 1 (KIRI / UTAMA) ---
    $wp_customize->add_setting( 'cc_hero_btn1_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'cc_hero_btn1_enable', array( 'label' => __( 'Tampilkan Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'cc_hero_btn1_text', array( 'default' => 'Start Trial', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_btn1_text', array( 'label' => __( 'Teks Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cc_hero_btn1_url', array( 'default' => '#daftar', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'cc_hero_btn1_url', array(
        'label'       => __( 'URL Tombol Utama', 'crediblecompany' ),
        'description' => __( 'Gunakan ID section untuk smooth scroll: #hero, #how-it-works, #daftar-paket, #books, #testimonials, #blog, #faq, #mitra', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'url',
    ) );

    // Warna Latar & Teks Tombol Utama
    $wp_customize->add_setting( 'cc_hero_btn1_bg_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn1_bg_color', array( 'label' => 'Warna Latar Tombol Utama', 'section' => 'cc_hero_section' ) ) );
    
    $wp_customize->add_setting( 'cc_hero_btn1_text_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn1_text_color', array( 'label' => 'Warna Teks Tombol Utama', 'section' => 'cc_hero_section' ) ) );

    // --- TOMBOL 2 (KANAN / OUTLINE) ---
    $wp_customize->add_setting( 'cc_hero_btn2_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'cc_hero_btn2_enable', array( 'label' => __( 'Tampilkan Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'cc_hero_btn2_text', array( 'default' => 'How It Works', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_btn2_text', array( 'label' => __( 'Teks Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cc_hero_btn2_url', array( 'default' => '#how-it-works', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'cc_hero_btn2_url', array(
        'label'       => __( 'URL Tombol Sekunder', 'crediblecompany' ),
        'description' => __( 'Gunakan ID section untuk smooth scroll (lihat daftar ID di tombol utama).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'url',
    ) );
    
    // Warna Latar & Teks Tombol Sekunder
    $wp_customize->add_setting( 'cc_hero_btn2_bg_color', array( 'default' => 'transparent', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn2_bg_color', array( 'label' => 'Warna Latar Tombol Sekunder', 'section' => 'cc_hero_section' ) ) );
    
    $wp_customize->add_setting( 'cc_hero_btn2_text_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn2_text_color', array( 'label' => 'Warna Teks Tombol Sekunder', 'section' => 'cc_hero_section' ) ) );

    // --- STYLE TOMBOL GLOBAL (BENTUK / SHAPE) ---
    $wp_customize->add_setting( 'cc_hero_btn_shape', array(
        'default'           => '50px', // pill shape default
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_btn_shape', array(
        'label'   => __( 'Bentuk Pola Border Tombol', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'select',
        'choices' => array(
            '50px'    => 'Bulat Melengkung (Pill)',
            '8px'     => 'Sudut Tumpul (Rounded)',
            '0px'     => 'Kotak Persegi (Square)',
        )
    ) );

    // Gambar Hero
    $wp_customize->add_setting( 'cc_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cc_hero_image', array(
        'label'   => __( 'Gambar Hero', 'crediblecompany' ),
        'section' => 'cc_hero_section',
    ) ) );

    // --- DAFTAR PILIHAN EMOJI / IKON MELAYANG (CURATED LIST) ---
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

    // Ornamen Melayang 1
    $wp_customize->add_setting( 'cc_hero_ornament_1', array(
        'default'           => '📚',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_1', array(
        'label'       => __( 'Ornamen Melayang 1 (Ikon)', 'crediblecompany' ),
        'description' => __( 'Pilih ikon yang melayang di area visual Hero.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'select',
        'choices'     => $emoji_choices,
    ) );
 
    // Ornamen Melayang 2
    $wp_customize->add_setting( 'cc_hero_ornament_2', array(
        'default'           => '🎓',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_2', array(
        'label'       => __( 'Ornamen Melayang 2 (Ikon)', 'crediblecompany' ),
        'description' => __( 'Pilih ikon melayang kedua untuk variasi visual.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'select',
        'choices'     => $emoji_choices,
    ) );
 
    // Ornamen Melayang 3 (Aksen Tambahan V2)
    $wp_customize->add_setting( 'cc_hero_ornament_3', array(
        'default'           => '✨',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_3', array(
        'label'       => __( 'Ornamen Melayang 3 (Ikon V2)', 'crediblecompany' ),
        'description' => __( 'Pilih ikon melayang tambahan khusus layout Centered (V2).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'select',
        'choices'     => $emoji_choices,
    ) );

    // --- PENGATURAN SPESIFIK LAYOUT CENTRED (V2) ---
    $wp_customize->add_setting( 'cc_hero_v2_badge_text', array(
        'default'           => 'Solusi Terpercaya & Modern',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v2_badge_text', array(
        'label'       => __( 'Teks Badge Hero V2', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    // --- PENGATURAN SPESIFIK LAYOUT JASPER (V3) ---
    $wp_customize->add_setting( 'cc_hero_promo_tag', array(
        'default'           => 'New!',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_promo_tag', array(
        'label'       => __( 'Label Promo Badge Hero V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_left_icon', array(
        'default'           => '🔴',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_left_icon', array(
        'label'       => __( 'Emoji Kartu Melayang Kiri V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'select',
        'choices'     => $emoji_choices,
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_left_text', array(
        'default'           => 'Buat 6.000 email super-personal dalam hitungan menit',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_left_text', array(
        'label'       => __( 'Teks Kartu Melayang Kiri V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_right_num', array(
        'default'           => '11x',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_right_num', array(
        'label'       => __( 'Angka Kartu Melayang Kanan V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_right_text', array(
        'default'           => 'rasio klik-tayang',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_right_text', array(
        'label'       => __( 'Label Kartu Melayang Kanan V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_partners_title', array(
        'default'           => 'Dipercaya oleh tim pemasaran kelas dunia',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_partners_title', array(
        'label'       => __( 'Judul Logo Kredibilitas Mitra V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    /* ---- WARNA SHAPES HERO ---- */
    // Gambar Background Shape (Lingkaran Utama)
    $wp_customize->add_setting( 'cc_hero_shape_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cc_hero_shape_bg_image', array(
        'label'       => __( 'Gambar Latar Shape Utama (SVG/PNG/WEBP)', 'crediblecompany' ),
        'description' => __( 'Upload gambar latar abstrak jika tidak ingin lingkaran polos. Kosongkan untuk pakai warna solid.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
    ) ) );

    // Warna Background Utama
    $wp_customize->add_setting( 'cc_hero_shape_main_color', array( 'default' => '#ea580c', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_main_color', array( 'label' => 'Warna Latar Lingkaran Utama', 'section' => 'cc_hero_section' ) ) );

    // Warna Blob Kuning
    $wp_customize->add_setting( 'cc_hero_shape_yellow_color', array( 'default' => '#EAB308', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_yellow_color', array( 'label' => 'Warna Background Shape 1', 'section' => 'cc_hero_section' ) ) );

    // Warna Lingkaran Biru
    $wp_customize->add_setting( 'cc_hero_shape_blue_color', array( 'default' => '#3B82F6', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_blue_color', array( 'label' => 'Warna Background Shape 2', 'section' => 'cc_hero_section' ) ) );

    // Warna Lingkaran Merah
    $wp_customize->add_setting( 'cc_hero_shape_red_color', array( 'default' => '#EF4444', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_red_color', array( 'label' => 'Warna Background Shape 3', 'section' => 'cc_hero_section' ) ) );

    // Warna Lingkaran Ungu
    $wp_customize->add_setting( 'cc_hero_shape_purple_color', array( 'default' => '#8B5CF6', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_purple_color', array( 'label' => 'Warna Background Shape 4', 'section' => 'cc_hero_section' ) ) );

    // ==========================================
    // --- PENGATURAN SPESIFIK HERO V1 (DEFAULT) ---
    // ==========================================
    $wp_customize->add_setting( 'cc_hero_v1_padding_top_px', array( 'default' => 96, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v1_padding_top_px', array(
        'label'       => __( 'V1: Padding Atas Hero (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 20, 'max' => 200, 'step' => 2 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v1_padding_bottom_px', array( 'default' => 64, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v1_padding_bottom_px', array(
        'label'       => __( 'V1: Padding Bawah Hero (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 20, 'max' => 200, 'step' => 2 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v1_title_size_px', array( 'default' => 56, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v1_title_size_px', array(
        'label'       => __( 'V1: Ukuran Font Judul (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 24, 'max' => 80, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v1_title_margin_bottom_px', array( 'default' => 24, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v1_title_margin_bottom_px', array(
        'label'       => __( 'V1: Jarak Bawah Judul (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 5, 'max' => 80, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v1_desc_size_px', array( 'default' => 18, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v1_desc_size_px', array(
        'label'       => __( 'V1: Ukuran Font Deskripsi (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 12, 'max' => 24, 'step' => 1 ),
    ) );

    // ==========================================
    // --- PENGATURAN SPESIFIK HERO V2 (CENTERED) ---
    // ==========================================
    $wp_customize->add_setting( 'cc_hero_v2_padding_top_px', array( 'default' => 128, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v2_padding_top_px', array(
        'label'       => __( 'V2: Padding Atas Hero (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 40, 'max' => 250, 'step' => 2 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v2_padding_bottom_px', array( 'default' => 96, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v2_padding_bottom_px', array(
        'label'       => __( 'V2: Padding Bawah Hero (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 40, 'max' => 250, 'step' => 2 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v2_title_size_px', array( 'default' => 64, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v2_title_size_px', array(
        'label'       => __( 'V2: Ukuran Font Judul (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 28, 'max' => 90, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v2_title_margin_bottom_px', array( 'default' => 24, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v2_title_margin_bottom_px', array(
        'label'       => __( 'V2: Jarak Bawah Judul (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 5, 'max' => 80, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v2_desc_size_px', array( 'default' => 20, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v2_desc_size_px', array(
        'label'       => __( 'V2: Ukuran Font Deskripsi (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 12, 'max' => 26, 'step' => 1 ),
    ) );

    // ==========================================
    // --- PENGATURAN SPESIFIK HERO V3 (JASPER) ---
    // ==========================================
    $wp_customize->add_setting( 'cc_hero_v3_padding_top_px', array( 'default' => 96, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v3_padding_top_px', array(
        'label'       => __( 'V3: Padding Atas Hero (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 20, 'max' => 200, 'step' => 2 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_padding_bottom_px', array( 'default' => 0, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v3_padding_bottom_px', array(
        'label'       => __( 'V3: Padding Bawah Hero (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 150, 'step' => 2 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_title_size_px', array( 'default' => 72, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v3_title_size_px', array(
        'label'       => __( 'V3: Ukuran Font Judul (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 32, 'max' => 100, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_title_margin_bottom_px', array( 'default' => 32, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v3_title_margin_bottom_px', array(
        'label'       => __( 'V3: Jarak Bawah Judul (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 5, 'max' => 100, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_desc_size_px', array( 'default' => 20, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_v3_desc_size_px', array(
        'label'       => __( 'V3: Ukuran Font Deskripsi (Pixel)', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 12, 'max' => 26, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_title_weight', array( 'default' => '900', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_title_weight', array(
        'label'   => __( 'Ketebalan Font Judul Hero (Global)', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'select',
        'choices' => array(
            '400' => 'Normal (400)',
            '600' => 'Semi-Bold (600)',
            '700' => 'Bold (700)',
            '800' => 'Extra-Bold (800)',
            '900' => 'Black (900)',
        )
    ) );

    // --- PENGATURAN KELENGKUNGAN SUDUT (USER FRIENDLY SLIDERS) ---
    $wp_customize->add_setting( 'cc_hero_card_radius_px', array( 'default' => 16, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_card_radius_px', array(
        'label'       => __( 'Kelengkungan Kartu Melayang (Pixel)', 'crediblecompany' ),
        'description' => __( 'Radius kebulatan sudut untuk kartu melayang V3 (0px = tajam).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 40, 'step' => 1 ),
    ) );

    $wp_customize->add_setting( 'cc_hero_canvas_radius_px', array( 'default' => 24, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'cc_hero_canvas_radius_px', array(
        'label'       => __( 'Kelengkungan Canvas Grafis V3 (Pixel)', 'crediblecompany' ),
        'description' => __( 'Radius sudut atas untuk canvas visual grid Jasper.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'range',
        'input_attrs' => array( 'min' => 0, 'max' => 60, 'step' => 1 ),
    ) );

} );

/**
 * Suntikkan Variabel CSS Dinamis ke Header berdasarkan pengaturan Customizer.
 */
add_action( 'wp_head', 'cc_hero_dynamic_css_variables', 100 );
function cc_hero_dynamic_css_variables() {
    // Varian 1
    $v1_pad_top    = cc_get( 'hero_v1_padding_top_px', 96 );
    $v1_pad_bottom = cc_get( 'hero_v1_padding_bottom_px', 64 );
    $v1_title_size = cc_get( 'hero_v1_title_size_px', 56 );
    $v1_title_marg = cc_get( 'hero_v1_title_margin_bottom_px', 24 );
    $v1_desc_size  = cc_get( 'hero_v1_desc_size_px', 18 );

    // Varian 2
    $v2_pad_top    = cc_get( 'hero_v2_padding_top_px', 128 );
    $v2_pad_bottom = cc_get( 'hero_v2_padding_bottom_px', 96 );
    $v2_title_size = cc_get( 'hero_v2_title_size_px', 64 );
    $v2_title_marg = cc_get( 'hero_v2_title_margin_bottom_px', 24 );
    $v2_desc_size  = cc_get( 'hero_v2_desc_size_px', 20 );

    // Varian 3
    $v3_pad_top    = cc_get( 'hero_v3_padding_top_px', 96 );
    $v3_pad_bottom = cc_get( 'hero_v3_padding_bottom_px', 0 );
    $v3_title_size = cc_get( 'hero_v3_title_size_px', 72 );
    $v3_title_marg = cc_get( 'hero_v3_title_margin_bottom_px', 32 );
    $v3_desc_size  = cc_get( 'hero_v3_desc_size_px', 20 );

    // Global
    $title_weight  = cc_get( 'hero_title_weight', '900' );
    $card_radius   = cc_get( 'hero_card_radius_px', 16 );
    $canvas_radius = cc_get( 'hero_canvas_radius_px', 24 );
    ?>
    <style type="text/css" id="cc-hero-dynamic-variables">
        :root {
            /* Varian 1 (Default) */
            --cc-hero-v1-padding-top: <?php echo esc_attr( $v1_pad_top ) . 'px'; ?>;
            --cc-hero-v1-padding-bottom: <?php echo esc_attr( $v1_pad_bottom ) . 'px'; ?>;
            --cc-hero-v1-title-size: <?php echo esc_attr( $v1_title_size ) . 'px'; ?>;
            --cc-hero-v1-title-margin-bottom: <?php echo esc_attr( $v1_title_marg ) . 'px'; ?>;
            --cc-hero-v1-desc-size: <?php echo esc_attr( $v1_desc_size ) . 'px'; ?>;

            /* Varian 2 (Centered) */
            --cc-hero-v2-padding-top: <?php echo esc_attr( $v2_pad_top ) . 'px'; ?>;
            --cc-hero-v2-padding-bottom: <?php echo esc_attr( $v2_pad_bottom ) . 'px'; ?>;
            --cc-hero-v2-title-size: <?php echo esc_attr( $v2_title_size ) . 'px'; ?>;
            --cc-hero-v2-title-margin-bottom: <?php echo esc_attr( $v2_title_marg ) . 'px'; ?>;
            --cc-hero-v2-desc-size: <?php echo esc_attr( $v2_desc_size ) . 'px'; ?>;

            /* Varian 3 (Jasper) */
            --cc-hero-v3-padding-top: <?php echo esc_attr( $v3_pad_top ) . 'px'; ?>;
            --cc-hero-v3-padding-bottom: <?php echo esc_attr( $v3_pad_bottom ) . 'px'; ?>;
            --cc-hero-v3-title-size: <?php echo esc_attr( $v3_title_size ) . 'px'; ?>;
            --cc-hero-v3-title-margin-bottom: <?php echo esc_attr( $v3_title_marg ) . 'px'; ?>;
            --cc-hero-v3-desc-size: <?php echo esc_attr( $v3_desc_size ) . 'px'; ?>;

            /* Global & Shapes */
            --cc-hero-title-weight: <?php echo esc_attr( $title_weight ); ?>;
            --cc-hero-card-radius: <?php echo esc_attr( $card_radius ) . 'px'; ?>;
            --cc-hero-canvas-radius: <?php echo esc_attr( $canvas_radius ) . 'px'; ?>;
        }
    </style>
    <?php
}
