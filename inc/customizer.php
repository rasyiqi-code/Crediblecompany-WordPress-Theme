<?php
/**
 * Customizer Loader
 *
 * @package CredibleCompany
 */

// 1. Daftarkan Panel Utama (Homepage)
add_action( 'customize_register', function ( $wp_customize ) {
    $wp_customize->add_panel( 'cc_homepage_panel', array(
        'title'    => __( 'Pengaturan Homepage', 'crediblecompany' ),
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
require_once get_template_directory() . '/inc/customizer/mobile-layout.php';
