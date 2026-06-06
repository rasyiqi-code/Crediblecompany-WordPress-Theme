<?php
/**
 * Customizer: Books Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_books_section', array(
        'title'    => __( 'Pengaturan Katalog Buku', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 46,
    ) );

    // Judul Buku Terbitan
    $wp_customize->add_setting( 'cc_books_title', array(
        'default'           => 'Buku Terbitan Terbaru',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_books_title', array(
        'label'   => __( 'Judul Section', 'crediblecompany' ),
        'section' => 'cc_books_section',
        'type'    => 'text',
    ) );

    // Tampilkan / Sembunyikan Seksi Buku
    $wp_customize->add_setting( 'cc_books_enable', array(
        'default'           => true,
        'sanitize_callback' => 'cc_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'cc_books_enable', array(
        'label'   => __( 'Tampilkan Seksi Buku', 'crediblecompany' ),
        'section' => 'cc_books_section',
        'type'    => 'checkbox',
    ) );

    // Batasi Jumlah Buku
    $wp_customize->add_setting( 'cc_books_limit', array(
        'default'           => 5,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_books_limit', array(
        'label'       => __( 'Jumlah Buku yang Ditampilkan', 'crediblecompany' ),
        'description' => __( 'Tentukan jumlah item buku terbitan yang dimuat di beranda.', 'crediblecompany' ),
        'section'     => 'cc_books_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 20,
            'step' => 1,
        ),
    ) );

} );
