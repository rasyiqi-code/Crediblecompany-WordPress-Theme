<?php
/**
 * Customizer: Admin Theme Section
 * Pengaturan kustomisasi halaman login dan dashboard admin (WP Admin) secara otomatis.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', function( $wp_customize ) {

    // 1. Tambahkan Section Kustomisasi Admin di dalam Panel Global
    $wp_customize->add_section( 'cc_admin_theme_section', array(
        'title'       => __( 'Kustomisasi Admin & Login', 'crediblecompany' ),
        'description' => __( 'Otomatiskan tampilan halaman login dan dashboard admin (WP Admin) menggunakan warna general template dan logo kustom situs Anda.', 'crediblecompany' ),
        'panel'       => 'cc_global_panel',
        'priority'    => 40,
    ) );

    // 2. Setting: Aktifkan Kustomisasi Tema Admin & Login
    $wp_customize->add_setting( 'cc_enable_admin_theme', array(
        'default'           => false,
        'sanitize_callback' => 'cc_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'cc_enable_admin_theme', array(
        'label'       => __( 'Aktifkan Tema Admin & Login Kustom', 'crediblecompany' ),
        'description' => __( 'Jika diaktifkan, halaman login dan dashboard admin akan disesuaikan secara otomatis menggunakan skema warna tema utama (warna header/footer) dan logo situs Anda.', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'checkbox',
    ) );

} );
