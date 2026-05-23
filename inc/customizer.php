<?php
/**
 * Customizer Loader
 *
 * @package CredibleCompany
 */

// 1. Daftarkan Panel Utama
add_action( 'customize_register', function ( $wp_customize ) {
    // Panel 1: Konfigurasi Global
    $wp_customize->add_panel( 'cc_global_panel', array(
        'title'    => __( 'Konfigurasi Dasar & SEO', 'crediblecompany' ),
        'priority' => 25,
    ) );

    // Panel 2: Tata Letak Homepage
    $wp_customize->add_panel( 'cc_homepage_panel', array(
        'title'    => __( 'Tata Letak Beranda (Sections)', 'crediblecompany' ),
        'priority' => 30,
    ) );
} );

// 2. Load Modular Sections (Setiap file memiliki add_action mandiri)
// Note: Pastikan file-file ini didaftarkan di luar block action panel utama
require_once get_template_directory() . '/inc/customizer/header.php';
require_once get_template_directory() . '/inc/customizer/hero.php';
require_once get_template_directory() . '/inc/customizer/statistics.php';
require_once get_template_directory() . '/inc/customizer/features.php';
require_once get_template_directory() . '/inc/customizer/cta.php';
require_once get_template_directory() . '/inc/customizer/social.php';
require_once get_template_directory() . '/inc/customizer/pricing.php';
require_once get_template_directory() . '/inc/customizer/mitra.php';
require_once get_template_directory() . '/inc/customizer/faq.php';
require_once get_template_directory() . '/inc/customizer/blog.php';
require_once get_template_directory() . '/inc/customizer/marketing.php';
require_once get_template_directory() . '/inc/customizer/footer.php';
require_once get_template_directory() . '/inc/customizer/seo.php';
require_once get_template_directory() . '/inc/customizer/mobile-layout.php';
