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
    $header_style = cc_get( 'header_style', 'classic' );
    ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <?php
    // Panggil template part header yang sesuai berdasarkan gaya kustomisasi
    get_template_part( 'template-parts/header/header', $header_style );
    ?>

    <!-- Navigasi Mobile (horizontal scroll / dropdown vertikal) -->
    <?php 
    get_template_part( 
        'template-parts/header/nav-mobile', 
        null, 
        array( 'header_style' => $header_style ) 
    ); 
    ?>

    <!-- Overlay Pencarian Layar Penuh (Ditempatkan di luar elemen header agar tidak terpengaruh CSS backdrop-filter parent) -->
    <?php get_template_part( 'template-parts/header/search-overlay' ); ?>

    <main id="main" class="main-content">
