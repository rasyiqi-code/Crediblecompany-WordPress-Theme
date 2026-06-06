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
    $header_bg     = cc_get( 'header_bg_color', '#c01314' );
    $header_text   = cc_get( 'header_text_color', '#ffffff' );
    $header_sticky = cc_get( 'header_sticky', true );
    ?>
    <style id="cc-header-customizer-inline-css">
        .site-header, 
        .site-header .container,
        .site-header .site-logo,
        .site-header .header-icons {
            background-color: <?php echo esc_attr( $header_bg ); ?> !important;
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
        <?php if ( $header_sticky ) : ?>
        .site-header {
            position: sticky !important;
            top: 0;
            z-index: 2000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        /* Kompensasi Admin Bar WordPress untuk Sticky Header */
        .admin-bar .site-header {
            top: 32px !important;
        }
        @media screen and (max-width: 782px) {
            .admin-bar .site-header {
                top: 46px !important;
            }
        }
        <?php endif; ?>
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <header class="site-header">
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
    <nav class="primary-nav" aria-label="<?php esc_attr_e( 'Navigasi Utama', 'crediblecompany' ); ?>">
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
