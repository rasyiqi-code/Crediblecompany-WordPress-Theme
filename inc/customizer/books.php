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

} );
