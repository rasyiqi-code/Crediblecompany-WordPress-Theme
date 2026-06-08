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
    $hero_variant = cc_get( 'hero_variant', 'default' );
    $header_style = cc_get( 'header_style', 'classic' );
    if ( 'v3' === $hero_variant ) {
        $header_style = 'glass';
    }
    ?>
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
