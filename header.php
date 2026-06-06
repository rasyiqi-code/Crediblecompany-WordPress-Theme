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
        <?php endif; ?>
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <header class="site-header header-style-<?php echo esc_attr( $header_style ); ?>">
        <div class="container flex-between">
            <!-- Logo -->
            <div class="site-logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Navigasi Desktop (hidden di mobile via CSS) -->
            <nav class="desktop-nav" aria-label="<?php esc_attr_e( 'Navigasi Desktop', 'crediblecompany' ); ?>">
                <?php
                if ( has_nav_menu( 'primary_navigation' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary_navigation',
                        'container'      => false,
                        'menu_class'     => '',
                        'fallback_cb'    => false,
                    ) );
                } else {
                    echo '<ul>';
                    echo '<li><a href="#">Blog</a></li>';
                    echo '<li><a href="#">Lorem</a></li>';
                    echo '<li><a href="#">Ipsum</a></li>';
                    echo '</ul>';
                }
                ?>
            </nav>

            <!-- Action Icons & Mobile Toggle -->
            <div class="header-icons">
                <?php
                $search_url  = cc_get( 'header_search_url', '' );
                $account_url = cc_get( 'header_account_url', '' );
                ?>
                <?php if ( ! empty( $search_url ) ) : ?>
                    <a href="<?php echo esc_url( $search_url ); ?>" aria-label="Cari" class="header-icon-link" style="color: inherit; text-decoration: none; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </a>
                <?php else : ?>
                    <button type="button" aria-label="Cari" id="header-search-toggle">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                <?php endif; ?>

                <?php if ( ! empty( $account_url ) ) : ?>
                    <a href="<?php echo esc_url( $account_url ); ?>" aria-label="Akun" class="header-icon-link" style="color: inherit; text-decoration: none; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Search Overlay Form -->
            <div id="header-search-overlay" class="header-search-overlay" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: var(--bg-body, #ffffff); padding: 10px 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); z-index: 1000; border-top: 1px solid var(--border-color, #eee);">
                <?php get_search_form(); ?>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var searchToggle = document.getElementById('header-search-toggle');
                    var searchOverlay = document.getElementById('header-search-overlay');
                    var searchInput = searchOverlay ? searchOverlay.querySelector('input[type="search"]') : null;

                    if (searchToggle && searchOverlay) {
                        searchToggle.addEventListener('click', function(e) {
                            e.preventDefault();
                            if (searchOverlay.style.display === 'none') {
                                searchOverlay.style.display = 'block';
                                if (searchInput) searchInput.focus();
                            } else {
                                searchOverlay.style.display = 'none';
                            }
                        });

                        document.addEventListener('click', function(event) {
                            var isClickInside = searchToggle.contains(event.target) || searchOverlay.contains(event.target);
                            if (!isClickInside && searchOverlay.style.display === 'block') {
                                searchOverlay.style.display = 'none';
                            }
                        });
                    }
                });
            </script>

            <button class="menu-toggle" aria-expanded="false" aria-label="Menu">&#9776;</button>
        </div>
    </header>

    <!-- Navigasi Mobile (horizontal scroll, sticky, hidden di desktop via CSS) -->
    <nav class="primary-nav <?php echo ( 'glass' === $header_style ) ? 'header-style-glass' : ''; ?>" aria-label="<?php esc_attr_e( 'Navigasi Utama', 'crediblecompany' ); ?>">
        <?php
        if ( has_nav_menu( 'primary_navigation' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'primary_navigation',
                'container'      => false,
                'menu_class'     => '',
                'fallback_cb'    => false,
            ) );
        } else {
            echo '<ul>';
            echo '<li><a href="#">Blog</a></li>';
            echo '<li><a href="#">Lorem</a></li>';
            echo '<li><a href="#">Ipsum</a></li>';
            echo '</ul>';
        }
        ?>
    </nav>

    <main id="main" class="main-content">
