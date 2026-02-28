<?php
/**
 * Customizer: Social Media Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_social_section', array(
        'title' => __( 'Social Media', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    $socials = array( 'facebook', 'twitter', 'instagram', 'youtube', 'tiktok' );
    foreach ( $socials as $social ) {
        $wp_customize->add_setting( "cc_social_{$social}", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "cc_social_{$social}", array(
            'label'   => sprintf( __( 'URL %s', 'crediblecompany' ), ucfirst( $social ) ),
            'section' => 'cc_social_section',
            'type'    => 'url',
        ) );
    }

    /* --- Nomor WhatsApp untuk Floating Chat --- */
    $wp_customize->add_setting( 'cc_whatsapp_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_whatsapp_number', array(
        'label'       => __( 'Nomor WhatsApp', 'crediblecompany' ),
        'description' => __( 'Format internasional tanpa + (cth: 6281234567890). Kosongkan untuk menonaktifkan floating chat.', 'crediblecompany' ),
        'section'     => 'cc_social_section',
        'type'        => 'text',
    ) );

    /* --- Pesan Default WhatsApp --- */
    $wp_customize->add_setting( 'cc_whatsapp_message', array(
        'default'           => 'Halo, saya tertarik dengan layanan Anda.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_whatsapp_message', array(
        'label'   => __( 'Pesan Default WhatsApp', 'crediblecompany' ),
        'section' => 'cc_social_section',
        'type'    => 'text',
    ) );

} );
