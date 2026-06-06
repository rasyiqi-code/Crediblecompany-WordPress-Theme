<?php
/**
 * Customizer: Features Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_features_section', array(
        'title'    => __( 'Features (Mengapa Memilih)', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 30,
    ) );

    // Judul Utama (Mengapa Memilih Kami?)
    $wp_customize->add_setting( 'cc_features_main_title', array(
        'default'           => __( 'Lorem Ipsum Dolor', 'crediblecompany' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_features_main_title', array(
        'label'   => __( 'Judul Utama Seksi', 'crediblecompany' ),
        'section' => 'cc_features_section',
        'type'    => 'text',
    ) );

    $feat_defaults = array(
        array( 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
        array( 'Dolor Sit Amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
        array( 'Consectetur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
        array( 'Adipiscing Elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
        array( 'Proin Sodales', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
        array( 'Imperdiet Diam', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
    );

    $icon_defaults = array(
        1 => 'user',
        2 => 'dollar',
        3 => 'lightning',
        4 => 'mail',
        5 => 'shield',
        6 => 'globe',
    );

    $icon_choices = array(
        'user'      => __( 'User / Tim', 'crediblecompany' ),
        'dollar'    => __( 'Dollar / Finansial', 'crediblecompany' ),
        'lightning' => __( 'Lightning / Cepat', 'crediblecompany' ),
        'mail'      => __( 'Mail / Kontak', 'crediblecompany' ),
        'shield'    => __( 'Shield / Keamanan', 'crediblecompany' ),
        'globe'     => __( 'Globe / Internasional', 'crediblecompany' ),
        'award'     => __( 'Award / Kualitas', 'crediblecompany' ),
        'chart'     => __( 'Chart / Statistik', 'crediblecompany' ),
        'gear'      => __( 'Gear / Pengaturan', 'crediblecompany' ),
        'clock'     => __( 'Clock / Waktu', 'crediblecompany' ),
    );

    for ( $i = 1; $i <= 6; $i++ ) {
        $idx = $i - 1;

        $wp_customize->add_setting( "cc_feat_title_{$i}", array(
            'default'           => $feat_defaults[ $idx ][0],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "cc_feat_title_{$i}", array(
            'label'   => sprintf( __( 'Fitur %d — Judul', 'crediblecompany' ), $i ),
            'section' => 'cc_features_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "cc_feat_icon_{$i}", array(
            'default'           => $icon_defaults[ $i ],
            'sanitize_callback' => 'sanitize_key',
        ) );
        $wp_customize->add_control( "cc_feat_icon_{$i}", array(
            'label'   => sprintf( __( 'Fitur %d — Ikon', 'crediblecompany' ), $i ),
            'section' => 'cc_features_section',
            'type'    => 'select',
            'choices' => $icon_choices,
        ) );

        $wp_customize->add_setting( "cc_feat_desc_{$i}", array(
            'default'           => $feat_defaults[ $idx ][1],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "cc_feat_desc_{$i}", array(
            'label'   => sprintf( __( 'Fitur %d — Deskripsi', 'crediblecompany' ), $i ),
            'section' => 'cc_features_section',
            'type'    => 'textarea',
        ) );
    }

    // Pengaturan Warna Section Features
    $wp_customize->add_setting( 'cc_features_bg_color', array(
        'default'           => '#f8fafc',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_features_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Section', 'crediblecompany' ),
        'section' => 'cc_features_section',
    ) ) );

    $wp_customize->add_setting( 'cc_features_title_color', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_features_title_color', array(
        'label'   => __( 'Warna Font Judul', 'crediblecompany' ),
        'section' => 'cc_features_section',
    ) ) );

    $wp_customize->add_setting( 'cc_features_desc_color', array(
        'default'           => '#475569',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_features_desc_color', array(
        'label'   => __( 'Warna Font Deskripsi', 'crediblecompany' ),
        'section' => 'cc_features_section',
    ) ) );

} );

