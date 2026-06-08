<?php
/**
 * Customizer: Header - Varian Klasik (Classic)
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Callback aktif untuk Header Classic
$classic_active_callback = function() {
    return get_theme_mod( 'cc_header_style', 'classic' ) === 'classic';
};

// Daftarkan seluruh setting & control secara DRY
cc_register_header_settings( $wp_customize, 'classic', 'Classic', $classic_active_callback );
