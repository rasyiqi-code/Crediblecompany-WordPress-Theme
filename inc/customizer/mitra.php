<?php
/**
 * Customizer: Mitra & Proses
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_mitra_section', array(
        'title' => __( 'Mitra & Proses', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    $wp_customize->add_setting( 'cc_mitra_proses_tagline', array(
        'default'           => 'Kirim Naskah → DP → Proses → Revisi → Naik Cetak → Dikirim ke Penulis (Hanya 21 Hari Kerja)',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_mitra_proses_tagline', array(
        'label'   => __( 'Tagline Proses Kerja', 'crediblecompany' ),
        'section' => 'cc_mitra_section',
        'type'    => 'text',
    ) );

    // Daftar 6 slot logo Mitra Resmi
    for ( $i = 1; $i <= 6; $i++ ) {
        $wp_customize->add_setting( "cc_mitra_logo_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "cc_mitra_logo_{$i}", array(
            'label'       => sprintf( __( 'Logo Mitra Resmi %d', 'crediblecompany' ), $i ),
            'description' => __( 'Upload gambar logo (PNG dengan background transparan disarankan).', 'crediblecompany' ),
            'section'     => 'cc_mitra_section',
        ) ) );
    }

    // Daftar Mitra Pembayaran / Pengiriman (dipisahkan koma)
    $wp_customize->add_setting( 'cc_mitra_payment', array(
        'default'           => 'BCA, MANDIRI, SHOPEEPAY, JNE, J&T, SICEPAT',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_mitra_payment', array(
        'label'       => __( 'Mitra Pembayaran/Pengiriman (pisahkan koma)', 'crediblecompany' ),
        'section'     => 'cc_mitra_section',
        'type'    => 'text',
    ) );

} );
