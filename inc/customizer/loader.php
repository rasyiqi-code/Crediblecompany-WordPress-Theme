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
$_cc_customizer_dir = get_template_directory() . '/inc/customizer/';
require_once $_cc_customizer_dir . 'header.php';
require_once $_cc_customizer_dir . 'hero.php';
require_once $_cc_customizer_dir . 'statistics.php';
require_once $_cc_customizer_dir . 'about.php';
require_once $_cc_customizer_dir . 'features.php';
require_once $_cc_customizer_dir . 'cta.php';
require_once $_cc_customizer_dir . 'social.php';
require_once $_cc_customizer_dir . 'pricing.php';
require_once $_cc_customizer_dir . 'mitra.php';
require_once $_cc_customizer_dir . 'testimonials.php';
require_once $_cc_customizer_dir . 'books.php';
require_once $_cc_customizer_dir . 'faq.php';
require_once $_cc_customizer_dir . 'blog.php';
require_once $_cc_customizer_dir . 'marketing.php';
require_once $_cc_customizer_dir . 'footer.php';
require_once $_cc_customizer_dir . 'seo.php';
require_once $_cc_customizer_dir . 'mobile-layout.php';
require_once $_cc_customizer_dir . 'sections-dynamic-css.php';
unset( $_cc_customizer_dir );

/**
 * Sanitasi checkbox (Global)
 */
if ( ! function_exists( 'cc_sanitize_checkbox' ) ) {
    function cc_sanitize_checkbox( $checked ) {
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
}

/**
 * Sanitasi data JSON FAQ secara aman (Global)
 */
if ( ! function_exists( 'cc_sanitize_faq_json' ) ) {
    function cc_sanitize_faq_json( $value ) {
        if ( empty( $value ) ) {
            return '';
        }

        // Dekode string JSON
        $data = json_decode( $value, true );
        if ( ! is_array( $data ) ) {
            return '';
        }

        $clean_data = array();
        foreach ( $data as $item ) {
            $q = isset( $item['q'] ) ? sanitize_text_field( $item['q'] ) : '';
            $a = isset( $item['a'] ) ? wp_kses_post( $item['a'] ) : '';
            if ( $q !== '' || $a !== '' ) {
                $clean_data[] = array( 'q' => $q, 'a' => $a );
            }
        }

        return json_encode( $clean_data );
    }
}
