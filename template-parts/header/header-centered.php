<?php
/**
 * Header Part: Gaya Terpusat (Centered Logo & Stacked Menu)
 * Logo di tengah atas, menu stacked di bawah logo di desktop.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */
?>
<header class="site-header header-style-centered">
    <div class="container flex-between">
        <!-- Hamburger menu toggle (khusus mobile, diatur posisinya absolute kiri via CSS) -->
        <button class="menu-toggle" aria-expanded="false" aria-label="Menu">&#9776;</button>

        <!-- Logo Situs (Terpusat) -->
        <?php get_template_part( 'template-parts/header/logo' ); ?>

        <!-- Navigasi Desktop (Stacked di bawah logo di desktop) -->
        <?php get_template_part( 'template-parts/header/nav-desktop' ); ?>

        <!-- Tombol Aksi Kanan (Cari & Profil Akun, absolute kanan via CSS) -->
        <?php get_template_part( 'template-parts/header/actions' ); ?>


    </div>
</header>
