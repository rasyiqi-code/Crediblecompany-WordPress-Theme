<?php
/**
 * Enqueue stylesheet dan script untuk front-end.
 * File CSS menggunakan @import pattern — cukup enqueue file hub utama.
 * File JS dipecah ke modules/ dan di-enqueue terpisah.
 *
 * @package CredibleCompany
 */

add_action( 'wp_enqueue_scripts', function () {
    $theme_version = wp_get_theme()->get( 'Version' );
    $theme_uri     = get_template_directory_uri();

    /* === CSS === */

    // Google Fonts (Inter)
    wp_enqueue_style(
        'cc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap',
        array(),
        null
    );

    // Main stylesheet (hub @import → base/, components/, sections/)
    wp_enqueue_style(
        'cc-main',
        $theme_uri . '/assets/css/main.css',
        array( 'cc-google-fonts' ),
        $theme_version
    );

    // Cards component (hub @import → cards/testimonial, blog, featured)
    wp_enqueue_style(
        'cc-cards',
        $theme_uri . '/assets/css/components/cards.css',
        array( 'cc-main' ),
        $theme_version
    );

    // Responsive stylesheet (hub @import → responsive/)
    wp_enqueue_style(
        'cc-responsive',
        $theme_uri . '/assets/css/responsive.css',
        array( 'cc-cards' ),
        $theme_version
    );

    // Khusus Landing Page Mobile App Stylings (hub @import → landing/)
    if ( is_front_page() || is_home() ) {
        wp_enqueue_style(
            'cc-landing-mobile',
            $theme_uri . '/assets/css/landing-mobile.css',
            array( 'cc-responsive' ),
            $theme_version
        );
    }

    /* === JS Modules === */

    // Menu Toggle (global — semua halaman)
    wp_enqueue_script(
        'cc-menu-toggle',
        $theme_uri . '/assets/js/modules/menu-toggle.js',
        array(),
        $theme_version,
        true
    );

    // FAQ Accordion (landing page)
    if ( is_front_page() || is_home() ) {
        wp_enqueue_script(
            'cc-faq-accordion',
            $theme_uri . '/assets/js/modules/faq-accordion.js',
            array(),
            $theme_version,
            true
        );
    }

    // TOC Drawer (single post saja)
    if ( is_singular( 'post' ) ) {
        wp_enqueue_script(
            'cc-toc-drawer',
            $theme_uri . '/assets/js/modules/toc-drawer.js',
            array(),
            $theme_version,
            true
        );
    }

    // Sidebar Drawer (single post & single testimoni)
    if ( is_singular( 'post' ) || is_singular( 'testimoni' ) ) {
        wp_enqueue_script(
            'cc-sidebar-drawer',
            $theme_uri . '/assets/js/modules/sidebar-drawer.js',
            array(),
            $theme_version,
            true
        );
    }

    // Share Button (single post & single testimoni)
    if ( is_singular( 'post' ) || is_singular( 'testimoni' ) ) {
        wp_enqueue_script(
            'cc-share-btn',
            $theme_uri . '/assets/js/modules/share-btn.js',
            array(),
            $theme_version,
            true
        );
    }

    // Load More (arsip blog & testimoni)
    if ( is_home() || is_archive() || is_singular( 'testimoni' ) ) {
        wp_enqueue_script(
            'cc-load-more',
            $theme_uri . '/assets/js/modules/load-more.js',
            array(),
            $theme_version,
            true
        );
    }

    // Threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
} );
