<?php
/**
 * Customizer: CTA Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_cta_section', array(
        'title' => __( 'CTA & Kontak', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    // Judul CTA
    $wp_customize->add_setting( 'cc_cta_title', array(
        'default'           => 'Hubungi Marketing Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_cta_title', array(
        'label'   => __( 'Judul CTA', 'crediblecompany' ),
        'section' => 'cc_cta_section',
        'type'    => 'text',
    ) );

    // Deskripsi CTA
    $wp_customize->add_setting( 'cc_cta_desc', array(
        'default'           => 'Untuk mendapatkan Harga Promo dan Diskon menarik 50%',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_cta_desc', array(
        'label'   => __( 'Deskripsi CTA', 'crediblecompany' ),
        'section' => 'cc_cta_section',
        'type'    => 'text',
    ) );

    // Teks Tombol CTA
    $wp_customize->add_setting( 'cc_cta_button_text', array(
        'default'           => 'Hubungi Admin',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_cta_button_text', array(
        'label'   => __( 'Teks Tombol', 'crediblecompany' ),
        'section' => 'cc_cta_section',
        'type'    => 'text',
    ) );

    // URL Tombol CTA (WhatsApp / link)
    $wp_customize->add_setting( 'cc_cta_button_url', array(
        'default'           => 'https://wa.me/6281234567890',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'cc_cta_button_url', array(
        'label'   => __( 'URL Tombol (misal WhatsApp)', 'crediblecompany' ),
        'section' => 'cc_cta_section',
        'type'    => 'url',
    ) );

} );
