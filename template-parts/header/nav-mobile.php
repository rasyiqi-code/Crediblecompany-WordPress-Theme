<?php
/**
 * Template Part: Mobile Navigation Menu.
 * Navigasi khusus untuk mobile (horizontal scroll / dropdown).
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Menerima parameter $args['header_style'] secara aman
$header_style = isset( $args['header_style'] ) ? $args['header_style'] : 'classic';
?>
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
        // Fallback menu jika menu admin belum terpasang
        echo '<ul>';
        echo '<li><a href="#">Blog</a></li>';
        echo '<li><a href="#">Lorem</a></li>';
        echo '<li><a href="#">Ipsum</a></li>';
        echo '</ul>';
    }
    ?>
</nav>
