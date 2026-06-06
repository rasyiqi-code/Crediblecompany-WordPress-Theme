<?php
/**
 * Customizer: Blog Settings
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function ( $wp_customize ) {
    
    // Panel untuk Blog (Jika belum ada)
    $wp_customize->add_section( 'cc_blog_section', array(
        'title'    => __( 'Pengaturan Blog', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 70,
    ) );

    // 0. Tampilkan / Sembunyikan Blog di Homepage
    $wp_customize->add_setting( 'cc_show_blog', array(
        'default'           => true,
        'sanitize_callback' => 'cc_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'cc_show_blog', array(
        'label'    => __( 'Tampilkan Blog di Halaman Depan', 'crediblecompany' ),
        'section'  => 'cc_blog_section',
        'type'     => 'checkbox',
    ) );

    // 1. Warna Banner Hero (Gradient Start)
    $wp_customize->add_setting( 'cc_blog_hero_bg_start', array(
        'default'           => '#6366f1',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_blog_hero_bg_start', array(
        'label'    => __( 'Warna Banner (Awal)', 'crediblecompany' ),
        'section'  => 'cc_blog_section',
    ) ) );

    // Warna Banner Hero (Gradient End)
    $wp_customize->add_setting( 'cc_blog_hero_bg_end', array(
        'default'           => '#a855f7',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_blog_hero_bg_end', array(
        'label'    => __( 'Warna Banner (Akhir)', 'crediblecompany' ),
        'section'  => 'cc_blog_section',
    ) ) );

    // 2. Judul Blog
    $wp_customize->add_setting( 'cc_blog_title', array(
        'default'           => __( 'Blog & Berita', 'crediblecompany' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_blog_title', array(
        'label'    => __( 'Judul Blog', 'crediblecompany' ),
        'section'  => 'cc_blog_section',
        'type'     => 'text',
    ) );

    // 3. Sub Judul Blog
    $wp_customize->add_setting( 'cc_blog_subtitle', array(
        'default'           => __( 'Temukan wawasan dan cerita menarik terbaru dari kami.', 'crediblecompany' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_blog_subtitle', array(
        'label'    => __( 'Sub Judul Blog', 'crediblecompany' ),
        'section'  => 'cc_blog_section',
        'type'     => 'textarea',
    ) );

    // Pengaturan Warna Section Blog Homepage
    $wp_customize->add_setting( 'cc_blog_section_bg_color', array(
        'default'           => '#f8fafc',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_blog_section_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Section (Homepage)', 'crediblecompany' ),
        'section' => 'cc_blog_section',
    ) ) );

    $wp_customize->add_setting( 'cc_blog_section_title_color', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_blog_section_title_color', array(
        'label'   => __( 'Warna Font Judul Section (Homepage)', 'crediblecompany' ),
        'section' => 'cc_blog_section',
    ) ) );

} );

