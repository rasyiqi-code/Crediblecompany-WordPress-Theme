<?php
/**
 * Customizer: Footer Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_footer_section', array(
        'title'    => __( 'Footer Settings', 'crediblecompany' ),
        'priority' => 100,
    ) );

    /* --- Alamat Kantor --- */
    $wp_customize->add_setting( 'cc_footer_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'cc_footer_address', array(
        'label'       => __( 'Alamat Kantor', 'crediblecompany' ),
        'description' => __( 'Masukkan alamat lengkap kantor (mendukung baris baru).', 'crediblecompany' ),
        'section'     => 'cc_footer_section',
        'type'        => 'textarea',
    ) );

    /* --- Teks Hak Cipta --- */
    $wp_customize->add_setting( 'cc_footer_copyright', array(
        'default'           => 'KBM Group Indonesia.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_footer_copyright', array(
        'label'   => __( 'Teks Hak Cipta', 'crediblecompany' ),
        'section' => 'cc_footer_section',
        'type'    => 'text',
    ) );

} );
