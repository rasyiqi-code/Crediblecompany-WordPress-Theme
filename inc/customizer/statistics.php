<?php
/**
 * Customizer: Statistics Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_stats_section', array(
        'title' => __( 'Statistik Section', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    // Angka & label (3 pasang)
    $stats_defaults = array(
        array( '3,000+', 'Judul Buku' ),
        array( '200,000+', 'Eksemplar Cetak' ),
        array( '2,500+', 'Penulis Puas' ),
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

    // About Deskripsi
    $wp_customize->add_setting( 'cc_about_desc', array(
        'default'           => 'KBM Indonesia Group telah terbukti menjadi mitra penerbitan terpercaya. Dengan dedikasi melayani para penulis di seluruh Indonesia, ribuan karya telah berhasil kami cetak dan dipasarkan.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'cc_about_desc', array(
        'label'   => __( 'Paragraf Tentang Kami', 'crediblecompany' ),
        'section' => 'cc_stats_section',
        'type'    => 'textarea',
    ) );

    // Gambar About / Kantor
    $wp_customize->add_setting( 'cc_about_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cc_about_image', array(
        'label'   => __( 'Gambar Kantor / About', 'crediblecompany' ),
        'section' => 'cc_stats_section',
    ) ) );

} );
