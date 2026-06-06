<?php
/**
 * Customizer: Pricing Section (Paket Jasa)
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_pricing_section', array(
        'title'    => __( 'Section Paket Jasa', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'cc_pricing_title', array(
        'default'           => 'Lorem Ipsum Dolor',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_pricing_title', array(
        'label'   => __( 'Judul Section', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'cc_pricing_subtitle', array(
        'default'           => 'Anda bisa memilih kami untuk jasa berikut:',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_pricing_subtitle', array(
        'label'   => __( 'Subtitle Section', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'cc_pricing_grid_columns', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_pricing_grid_columns', array(
        'label'   => __( 'Jumlah Kolom Desktop', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'select',
        'choices' => array(
            2 => '2 Kolom',
            3 => '3 Kolom',
            4 => '4 Kolom',
            5 => '5 Kolom',
            6 => '6 Kolom',
        ),
    ) );

    // Jarak antara judul/deskripsi section dengan card (margin-bottom)
    $wp_customize->add_setting( 'cc_pricing_header_margin_bottom', array(
        'default'           => 48,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_pricing_header_margin_bottom', array(
        'label'       => __( 'Jarak Antara Judul & Card (px)', 'crediblecompany' ),
        'description' => __( 'Mengatur jarak (margin-bottom) antara judul/deskripsi dengan kartu paket jasa.', 'crediblecompany' ),
        'section'     => 'cc_pricing_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 8,
            'max'  => 120,
            'step' => 4,
        ),
    ) );

} );

/**
 * Suntikkan Variabel CSS Dinamis untuk Pricing Section ke Header.
 */
add_action( 'wp_head', function() {
    $margin_bottom = cc_get( 'pricing_header_margin_bottom', 48 );
    ?>
    <style type="text/css" id="cc-pricing-dynamic-css">
        :root {
            --cc-pricing-header-margin-bottom: <?php echo esc_attr( $margin_bottom ) . 'px'; ?>;
        }
    </style>
    <?php
}, 100 );

