<?php
/**
 * Header Customizer.
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_header_section', array(
        'title'    => __( 'Ikon Header (Search & Akun)', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 10,
    ) );

    // Header Search URL
    $wp_customize->add_setting( 'header_search_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'header_search_url', array(
        'label'       => __( 'URL Ikon Pencarian', 'crediblecompany' ),
        'description' => __( 'Biarkan kosong untuk menggunakan fitur pencarian bawaan (overlay/popup default dari tema). Isi URL untuk mengarahkan ikon search menyeberang ke halaman/link lain.', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'url',
    ) );

    // Header Account URL
    $wp_customize->add_setting( 'header_account_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'header_account_url', array(
        'label'       => __( 'URL Akun/Profil Pengguna', 'crediblecompany' ),
        'description' => __( 'Tautan untuk halaman login/register atau laman dashboard pengguna/client.', 'crediblecompany' ),
        'section'     => 'cc_header_section',
        'type'        => 'url',
    ) );

} );
