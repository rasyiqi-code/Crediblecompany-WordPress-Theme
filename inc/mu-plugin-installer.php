<?php
/**
 * Auto-installer MU Plugin saat tema dimuat.
 *
 * Menyalin file cc-force-ssl.php dari folder tema ke wp-content/mu-plugins/
 * secara otomatis. Pengecekan dilakukan setiap kali tema dimuat (frontend maupun admin),
 * namun operasi copy hanya terjadi jika file belum ada atau versi tema lebih baru.
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
    $source     = get_template_directory() . '/mu-plugins/cc-force-ssl.php';
    $target_dir = WP_CONTENT_DIR . '/mu-plugins';
    $target     = $target_dir . '/cc-force-ssl.php';

    // Jika file sumber tidak ada di dalam tema, lewati
    if ( ! file_exists( $source ) ) {
        return false;
    }

    // Salin hanya jika file belum ada atau versi tema lebih baru (hemat I/O)
    if ( file_exists( $target ) && filemtime( $source ) <= filemtime( $target ) ) {
        return true;
    }

    // Buat folder mu-plugins jika belum ada
    if ( ! is_dir( $target_dir ) ) {
        wp_mkdir_p( $target_dir );
    }

    return @copy( $source, $target );
}

/**
 * Hapus MU Plugin saat tema dinonaktifkan (beralih ke tema lain).
 */
function cc_uninstall_mu_plugin() {
    $target = WP_CONTENT_DIR . '/mu-plugins/cc-force-ssl.php';
    if ( file_exists( $target ) ) {
        @unlink( $target );
    }
}

// Langsung coba install saat file ini dimuat (tidak menunggu hook)
// file_exists() sangat cepat sehingga tidak berdampak pada performa
cc_install_mu_plugin();

// Bersihkan MU Plugin saat tema dinonaktifkan (beralih ke tema lain)
add_action( 'switch_theme', 'cc_uninstall_mu_plugin' );
