<?php
/**
 * Header Part: Gaya Klasik (Classic)
 * Logo di kiri, menu di kanan, search/account di kanan.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */
?>
<header class="site-header header-style-classic">
    <div class="container flex-between">
        <!-- Logo Situs -->
        <?php get_template_part( 'template-parts/header/logo' ); ?>

        <!-- Navigasi Desktop -->
        <?php get_template_part( 'template-parts/header/nav-desktop' ); ?>

        <!-- Tombol Aksi Kanan (Cari & Profil Akun) -->
        <?php get_template_part( 'template-parts/header/actions' ); ?>



        <!-- Hamburger menu toggle -->
        <button class="menu-toggle" aria-expanded="false" aria-label="Menu">&#9776;</button>
    </div>
</header>
