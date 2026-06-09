<?php
/**
 * Auto-installer MU Plugin saat tema diaktifkan.
 *
 * Menyalin file cc-force-ssl.php dari folder tema ke wp-content/mu-plugins/
 * secara otomatis saat tema diaktifkan, dan memverifikasi keberadaannya
 * setiap kali admin dashboard dimuat.
 *
 * @package CredibleCompany
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Salin MU Plugin dari folder tema ke wp-content/mu-plugins/.
 * Membuat folder mu-plugins jika belum ada.
 *
 * @return bool True jika berhasil atau file sudah ada, false jika gagal.
 */
function cc_install_mu_plugin() {
    $source = get_template_directory() . '/mu-plugins/cc-force-ssl.php';
    $target_dir = WP_CONTENT_DIR . '/mu-plugins';
    $target = $target_dir . '/cc-force-ssl.php';

    // Jika file sumber tidak ada di dalam tema, lewati
    if ( ! file_exists( $source ) ) {
        return false;
    }

    // Buat folder mu-plugins jika belum ada
    if ( ! is_dir( $target_dir ) ) {
        wp_mkdir_p( $target_dir );
    }

    // Salin hanya jika file belum ada atau versi tema lebih baru
    if ( ! file_exists( $target ) || filemtime( $source ) > filemtime( $target ) ) {
        return copy( $source, $target );
    }

    return true;
}

/**
 * Hapus MU Plugin saat tema dinonaktifkan (beralih ke tema lain).
 */
function cc_uninstall_mu_plugin() {
    $target = WP_CONTENT_DIR . '/mu-plugins/cc-force-ssl.php';
    if ( file_exists( $target ) ) {
        unlink( $target );
    }
}

// Jalankan installer saat tema diaktifkan
add_action( 'after_switch_theme', 'cc_install_mu_plugin' );

// Verifikasi keberadaan MU Plugin setiap kali admin dimuat (jaga-jaga jika terhapus manual)
add_action( 'admin_init', 'cc_install_mu_plugin' );

// Bersihkan MU Plugin saat tema dinonaktifkan (beralih ke tema lain)
add_action( 'switch_theme', 'cc_uninstall_mu_plugin' );
