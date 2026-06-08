<?php
/**
 * Customizer: Header - Varian Terpusat (Centered Logo & Stacked Menu)
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Callback aktif untuk Header Centered
$centered_active_callback = function() {
    return get_theme_mod( 'cc_header_style', 'classic' ) === 'centered';
};

// Daftarkan seluruh setting & control secara DRY
cc_register_header_settings( $wp_customize, 'centered', 'Centered', $centered_active_callback );
