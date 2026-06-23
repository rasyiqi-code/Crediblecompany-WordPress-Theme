<?php
/**
 * Template Part: Desktop Navigation Menu.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */
?>
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
        // Fallback menu bawaan jika menu primary_navigation belum dibuat di admin
        echo '<ul>';
        echo '<li><a href="#">Blog Penerbit</a></li>';
        echo '<li><a href="#">Testimoni</a></li>';
        echo '<li><a href="#">Toko Buku</a></li>';
        echo '</ul>';
    }
    ?>
</nav>
