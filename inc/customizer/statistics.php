<?php
/**
 * Customizer: Statistics Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_stats_section', array(
        'title'    => __( 'Statistik Section', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 20,
    ) );

    // Angka & label (3 pasang)
    $stats_defaults = array(
        array( '1,200+', 'Lorem Ipsum' ),
        array( '85,000+', 'Dolor Sit' ),
        array( '4,500+', 'Consectetur' ),
    );

    for ( $i = 1; $i <= 3; $i++ ) {
        $idx = $i - 1;

        $wp_customize->add_setting( "cc_stat_number_{$i}", array(
            'default'           => $stats_defaults[ $idx ][0],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "cc_stat_number_{$i}", array(
            'label'   => sprintf( __( 'Statistik %d — Angka', 'crediblecompany' ), $i ),
            'section' => 'cc_stats_section',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "cc_stat_label_{$i}", array(
            'default'           => $stats_defaults[ $idx ][1],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "cc_stat_label_{$i}", array(
            'label'   => sprintf( __( 'Statistik %d — Label', 'crediblecompany' ), $i ),
            'section' => 'cc_stats_section',
            'type'    => 'text',
        ) );
    }

    // Warna Statistik
    $wp_customize->add_setting( 'cc_stat_number_color', array(
        'default'           => '#F59E0B',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_stat_number_color', array(
        'label'   => __( 'Warna Angka Statistik', 'crediblecompany' ),
        'section' => 'cc_stats_section',
    ) ) );

    $wp_customize->add_setting( 'cc_stat_label_color', array(
        'default'           => '#1e293b',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_stat_label_color', array(
        'label'   => __( 'Warna Label Statistik', 'crediblecompany' ),
        'section' => 'cc_stats_section',
    ) ) );

    $wp_customize->add_setting( 'cc_stat_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_stat_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Section', 'crediblecompany' ),
        'section' => 'cc_stats_section',
    ) ) );


} );

