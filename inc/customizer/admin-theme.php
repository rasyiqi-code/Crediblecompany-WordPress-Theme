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

    // 3. Setting: Aktifkan Fitur Komentar Situs
    $wp_customize->add_setting( 'cc_enable_comments', array(
        'default'           => true,
        'sanitize_callback' => 'cc_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'cc_enable_comments', array(
        'label'       => __( 'Aktifkan Fitur Komentar Global', 'crediblecompany' ),
        'description' => __( 'Jika dinonaktifkan, seluruh fitur komentar di website (sidebar menu, kolom daftar pos, dan form komentar) akan disembunyikan secara otomatis.', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'checkbox',
    ) );

    // 4. Setting & Control: WhatsApp KBM Support
    $wp_customize->add_setting( 'cc_kbm_support_wa', array(
        'default'           => '6281357517526',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'cc_kbm_support_wa', array(
        'label'       => __( 'WhatsApp KBM Support', 'crediblecompany' ),
        'description' => __( 'Format angka saja tanpa spasi/karakter spesial (contoh: 6281357517526)', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'text',
    ) );

    // 5. Setting & Control: Website KBM Support
    $wp_customize->add_setting( 'cc_kbm_support_web', array(
        'default'           => 'https://penerbitkbm.com/',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'cc_kbm_support_web', array(
        'label'       => __( 'Website KBM Support', 'crediblecompany' ),
        'description' => __( 'Masukkan URL website resmi KBM Support', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'url',
    ) );

    // 5b. Setting & Control: Deskripsi KBM Support
    $wp_customize->add_setting( 'cc_kbm_support_desc', array(
        'default'           => 'Dapatkan layanan bantuan penuh untuk penerbitan buku Anda mulai dari proses penyuntingan naskah, desain cover, pengurusan ISBN, pencetakan, hingga strategi pemasaran dan distribusi buku secara luas. Tim KBM Support kami siap mendampingi perjalanan kepenulisan Anda melalui {link}.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'cc_kbm_support_desc', array(
        'label'       => __( 'Deskripsi KBM Support', 'crediblecompany' ),
        'description' => __( 'Tuliskan deskripsi lengkap. Gunakan penanda {link} di dalam teks untuk meletakkan hyperlink website.', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'textarea',
    ) );

    // 6. Setting & Control: WhatsApp Developer Support
    $wp_customize->add_setting( 'cc_developer_support_wa', array(
        'default'           => '6285183131249',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'cc_developer_support_wa', array(
        'label'       => __( 'WhatsApp Developer Support', 'crediblecompany' ),
        'description' => __( 'Format angka saja tanpa spasi/karakter spesial (contoh: 6285183131249)', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'text',
    ) );

    // 7. Setting & Control: Website Developer Support
    $wp_customize->add_setting( 'cc_developer_support_web', array(
        'default'           => 'https://crediblemark.com/',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'cc_developer_support_web', array(
        'label'       => __( 'Website Developer Support', 'crediblecompany' ),
        'description' => __( 'Masukkan URL website resmi Developer Support', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'url',
    ) );

    // 7b. Setting & Control: Deskripsi Developer Support
    $wp_customize->add_setting( 'cc_developer_support_desc', array(
        'default'           => 'Tim developer kami siap membantu menangani kendal teknis pada website Anda, seperti optimalisasi performa, perbaikan bug/error, pembaruan keamanan sistem, pemeliharaan server, hingga pengembangan fitur kustom baru sesuai kebutuhan bisnis Anda. Hubungi kami melalui {link}.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'cc_developer_support_desc', array(
        'label'       => __( 'Deskripsi Developer Support', 'crediblecompany' ),
        'description' => __( 'Tuliskan deskripsi lengkap. Gunakan penanda {link} di dalam teks untuk meletakkan hyperlink website.', 'crediblecompany' ),
        'section'     => 'cc_admin_theme_section',
        'type'        => 'textarea',
    ) );

} );
