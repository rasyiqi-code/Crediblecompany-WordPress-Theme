<?php
/**
 * Template Header — Credible Company.
 * Berisi doctype, head, navbar, dan awal body.
 * Desktop nav (inline header) + Mobile nav (horizontal scroll, sticky).
 *
 * @package CredibleCompany
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php
    $hero_variant        = cc_get( 'hero_variant', 'default' );
    $header_bg           = cc_get( 'header_bg_color', '#c01314' );
    $header_text         = cc_get( 'header_text_color', '#ffffff' );
    $header_sticky       = cc_get( 'header_sticky', true );
    $header_style        = cc_get( 'header_style', 'classic' );
    
    // Jika menggunakan varian Hero V3 (Split Glass), paksa header ke gaya glassmorphism
    if ( 'v3' === $hero_variant ) {
        $header_style = 'glass';
    }
    
    $logo_width          = cc_get( 'header_logo_width', 150 );
    $header_padding      = cc_get( 'header_padding', 12 );
    $menu_font_size      = cc_get( 'header_menu_font_size', 14 );
    $text_hover          = cc_get( 'header_text_hover_color', '#ffcccc' );
    $glass_opacity       = cc_get( 'header_glass_opacity', 85 ) / 100;
    $glass_blur          = cc_get( 'header_glass_blur', 12 );
    $border_enable       = cc_get( 'header_border_enable', false );
    $border_color        = cc_get( 'header_border_color', 'rgba(255, 255, 255, 0.15)' );
    ?>
    <style id="cc-header-customizer-inline-css">
        .site-header {
            <?php if ( $header_style === 'glass' ) : ?>
            background-color: <?php echo esc_attr( cc_hex_to_rgba( $header_bg, $glass_opacity ) ); ?> !important;
            <?php else : ?>
            background-color: <?php echo esc_attr( $header_bg ); ?> !important;
            <?php endif; ?>
        }
        @media (max-width: 768px) {
            .desktop-nav {
                <?php if ( $header_style === 'glass' ) : ?>
                background-color: <?php echo esc_attr( cc_hex_to_rgba( $header_bg, $glass_opacity ) ); ?> !important;
                <?php else : ?>
                background-color: <?php echo esc_attr( $header_bg ); ?> !important;
                <?php endif; ?>
            }
        }
        .site-header {
            <?php if ( $border_enable ) : ?>
            border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?> !important;
            <?php else : ?>
            border-bottom: none !important;
            <?php endif; ?>
        }
        <?php if ( $header_style === 'glass' ) : ?>
        .header-style-glass {
            backdrop-filter: blur(<?php echo esc_attr( $glass_blur ); ?>px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(<?php echo esc_attr( $glass_blur ); ?>px) saturate(180%) !important;
            <?php if ( $border_enable ) : ?>
            border: 1px solid <?php echo esc_attr( $border_color ); ?> !important;
            <?php endif; ?>
        }
        /* Penyelarasan Warna Dinamis Kapsul Kaca Compact */
        .header-style-glass .site-logo a {
            color: <?php echo esc_attr( $text_hover ); ?> !important; /* Logo menggunakan warna hover/accent (kuning/emas) */
        }
        .header-style-glass .desktop-nav a {
            color: <?php echo esc_attr( $header_text ); ?> !important; /* Teks menu mengikuti warna teks header utama */
        }
        .header-style-glass .desktop-nav a:hover {
            color: <?php echo esc_attr( $text_hover ); ?> !important;
        }
        .header-style-glass .header-icons a,
        .header-style-glass .header-icons button {
            background-color: <?php echo esc_attr( $text_hover ); ?> !important; /* Tombol bulat menggunakan warna hover (kuning/emas) */
            color: <?php echo esc_attr( $header_bg ); ?> !important; /* Ikon di dalam tombol bulat menggunakan warna bg header (gelap) */
            box-shadow: 0 4px 12px <?php echo esc_attr( cc_hex_to_rgba( $text_hover, 0.25 ) ); ?> !important;
        }
        .header-style-glass .header-icons svg {
            stroke: <?php echo esc_attr( $header_bg ); ?> !important;
        }
        .header-style-glass .header-icons a:hover,
        .header-style-glass .header-icons button:hover {
            background-color: <?php echo esc_attr( $header_text ); ?> !important;
            color: <?php echo esc_attr( $header_bg ); ?> !important;
            box-shadow: 0 6px 16px <?php echo esc_attr( cc_hex_to_rgba( $header_text, 0.35 ) ); ?> !important;
        }
        .header-style-glass .header-icons a:hover svg,
        .header-style-glass .header-icons button:hover svg {
            stroke: <?php echo esc_attr( $header_bg ); ?> !important;
        }
        <?php endif; ?>

        .site-header .container {
            padding-top: <?php echo esc_attr( $header_padding ); ?>px !important;
            padding-bottom: <?php echo esc_attr( $header_padding ); ?>px !important;
            height: auto !important;
        }
        .site-logo img {
            max-width: <?php echo esc_attr( $logo_width ); ?>px !important;
            width: 100% !important;
            height: auto !important;
        }
        .desktop-nav a {
            font-size: <?php echo esc_attr( $menu_font_size ); ?>px !important;
        }
        .site-header,
        .site-logo a,
        .desktop-nav a,
        .header-icons a,
        .header-icons button,
        .menu-toggle {
            color: <?php echo esc_attr( $header_text ); ?> !important;
        }
        .header-icons svg {
            stroke: <?php echo esc_attr( $header_text ); ?> !important;
        }
        .desktop-nav a::after {
            background: <?php echo esc_attr( $header_text ); ?> !important;
        }

        /* Hover Styles */
        .desktop-nav a:hover,
        .header-icons a:hover,
        .header-icons button:hover,
        .menu-toggle:hover {
            color: <?php echo esc_attr( $text_hover ); ?> !important;
        }
        .header-icons a:hover svg,
        .header-icons button:hover svg {
            stroke: <?php echo esc_attr( $text_hover ); ?> !important;
        }
        .desktop-nav a:hover::after {
            background: <?php echo esc_attr( $text_hover ); ?> !important;
        }

        <?php if ( $header_sticky ) : ?>
        .site-header {
            position: sticky !important;
            z-index: 2000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            <?php if ( $header_style === 'glass' ) : ?>
            top: 1.25rem;
            <?php else : ?>
            top: 0;
            <?php endif; ?>
        }
        /* Kompensasi Admin Bar WordPress untuk Sticky Header */
        .admin-bar .site-header {
            <?php if ( $header_style === 'glass' ) : ?>
            top: calc(32px + 1.25rem) !important;
            <?php else : ?>
            top: 32px !important;
            <?php endif; ?>
        }
        @media screen and (max-width: 782px) {
            .site-header {
                <?php if ( $header_style === 'glass' ) : ?>
                top: 0.75rem;
                <?php endif; ?>
            }
            .admin-bar .site-header {
                <?php if ( $header_style === 'glass' ) : ?>
                top: calc(46px + 0.75rem) !important;
                <?php else : ?>
                top: 46px !important;
                <?php endif; ?>
            }
        }

        /* Aturan Khusus Mobile: Jika tipe menu Klasik / Terpusat dan sticky aktif */
        <?php if ( $header_style !== 'glass' ) : ?>
        @media (max-width: 1024px) {
            .site-header {
                position: sticky !important;
                top: 0 !important;
                z-index: 2000 !important;
            }
            .admin-bar .site-header {
                top: 32px !important;
            }
            @media screen and (max-width: 782px) {
                .admin-bar .site-header {
                    top: 46px !important;
                }
            }
            /* Navigasi horizontal mobile (.primary-nav) di bawahnya tidak sticky */
            .primary-nav {
                position: relative !important;
                top: auto !important;
                z-index: 1000 !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05) !important;
            }
        }
        <?php endif; ?>
        <?php endif; ?>
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <header class="site-header header-style-<?php echo esc_attr( $header_style ); ?>">
        <div class="container flex-between">
            <!-- Logo Situs -->
            <?php get_template_part( 'template-parts/header/logo' ); ?>

            <!-- Navigasi Desktop (Tersembunyi di mobile lewat CSS) -->
            <?php get_template_part( 'template-parts/header/nav-desktop' ); ?>

            <!-- Tombol Aksi Kanan (Cari & Profil Akun) -->
            <?php get_template_part( 'template-parts/header/actions' ); ?>

            <!-- Overlay Dropdown Form Pencarian -->
            <?php get_template_part( 'template-parts/header/search-overlay' ); ?>

            <!-- Hamburger menu toggle (khusus mobile non-homepage) -->
            <button class="menu-toggle" aria-expanded="false" aria-label="Menu">&#9776;</button>
        </div>
    </header>

    <!-- Navigasi Mobile (horizontal scroll / dropdown vertikal) -->
    <?php 
    get_template_part( 
        'template-parts/header/nav-mobile', 
        null, 
        array( 'header_style' => $header_style ) 
    ); 
    ?>

    <main id="main" class="main-content">
