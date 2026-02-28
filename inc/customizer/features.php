<?php
/**
 * Customizer: Features Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_features_section', array(
        'title' => __( 'Features (Mengapa Memilih)', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    // Judul Utama (Mengapa Memilih Kami?)
    $wp_customize->add_setting( 'cc_features_main_title', array(
        'default'           => __( 'Mengapa Memilih Kami?', 'crediblecompany' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_features_main_title', array(
        'label'   => __( 'Judul Utama Seksi', 'crediblecompany' ),
        'section' => 'cc_features_section',
        'type'    => 'text',
    ) );

    $feat_defaults = array(
        array( 'Profesional', 'Ditangani langsung oleh tim ahli yang berkompeten di bidang penerbitan.' ),
        array( 'Harga Murah', 'Biaya terjangkau dengan kualitas maksimal. Ada berbagai diskon menarik.' ),
        array( 'Cepat', 'Proses cetak dan pengerjaan tepat waktu sesuai dengan target.' ),
        array( 'Free Ongkir', 'Gratis ongkir untuk pengiriman ke beberapa wilayah tertentu.' ),
        array( 'Proses Bergaransi', 'Garansi cetak ulang tanpa tambahan biaya bila terjadi cacat produk.' ),
        array( 'Distribusi Luas', 'Buku kamu akan disebarkan ke berbagai channel marketplace nasional.' ),
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

} );
