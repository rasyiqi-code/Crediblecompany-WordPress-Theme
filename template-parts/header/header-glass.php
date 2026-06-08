<?php
/**
 * Header Part: Gaya Glassmorphism Floating Compact
 * Latar belakang transparan dengan kapsul melengkung.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */
?>
<header class="site-header header-style-glass">
    <div class="container flex-between">
        <!-- Logo Situs -->
        <?php get_template_part( 'template-parts/header/logo' ); ?>

        <!-- Navigasi Desktop (Dipaksa horizontal di mobile) -->
        <?php get_template_part( 'template-parts/header/nav-desktop' ); ?>

        <!-- Tombol Aksi Kanan (Cari & Profil Akun) -->
        <?php get_template_part( 'template-parts/header/actions' ); ?>

        <!-- Overlay Dropdown Form Pencarian -->
        <?php get_template_part( 'template-parts/header/search-overlay' ); ?>
    </div>
</header>
