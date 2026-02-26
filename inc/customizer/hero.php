<?php
/**
 * Customizer: Hero Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_hero_section', array(
        'title' => __( 'Hero Section', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    // Judul Hero
    $wp_customize->add_setting( 'cc_hero_title', array(
        'default'           => 'Bukumu Segera Terbit!',
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
        'default'           => 'Penerbit KBM mempersembahkan lebih dari 3000 judul buku. Yuk, wujudkan mimpimu menjadi penulis — jadikan nyata naskah ceritamu.',
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
    $wp_customize->add_control( 'cc_hero_btn1_url', array( 'label' => __( 'URL Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'url' ) );

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
    $wp_customize->add_control( 'cc_hero_btn2_url', array( 'label' => __( 'URL Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'url' ) );
    
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

    // Ornamen Melayang 1
    $wp_customize->add_setting( 'cc_hero_ornament_1', array(
        'default'           => '📚', // Default buku
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_1', array(
        'label'       => __( 'Ornamen Melayang 1 (Emoji/Teks)', 'crediblecompany' ),
        'description' => __( 'Tampil di kiri atas gambar hero. Gunakan emoji (misal: 📚, 🚀, 💡).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    // Ornamen Melayang 2
    $wp_customize->add_setting( 'cc_hero_ornament_2', array(
        'default'           => '🎓', // Default Toga
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_2', array(
        'label'       => __( 'Ornamen Melayang 2 (Emoji/Teks)', 'crediblecompany' ),
        'description' => __( 'Tampil di kanan bawah gambar hero.', 'crediblecompany' ),
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

} );
