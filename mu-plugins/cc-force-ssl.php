<?php
/**
 * Must-Use Plugin: Force SSL / HTTPS untuk Reverse Proxy.
 *
 * File ini HARUS ditempatkan di wp-content/mu-plugins/cc-force-ssl.php
 * MU Plugin dimuat SEBELUM tema dan plugin biasa, sehingga $_SERVER['HTTPS']
 * dan konstanta WP_HOME/WP_SITEURL sudah diatur sebelum WordPress Core
 * mendefinisikan WP_CONTENT_URL dan membaca option dari database.
 *
 * @package CredibleCompany
 * @see https://developer.wordpress.org/advanced-administration/server/administration/#using-a-reverse-proxy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* --------------------------------------------------------------------------
 * 1. Deteksi domain produksi dan header reverse proxy
 * ---------------------------------------------------------------------- */
$cc_host   = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( $_SERVER['HTTP_HOST'] ) : '';
$cc_is_ssl = false;

// Deteksi domain produksi (diketahui menggunakan HTTPS)
if ( false !== strpos( $cc_host, 'publisher.ppns.ac.id' ) ) {
    $cc_is_ssl = true;
}

// Deteksi header reverse proxy standar
if (
    ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === strtolower( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) ) ||
    ( isset( $_SERVER['HTTP_X_FORWARDED_SSL'] ) && 'on' === strtolower( $_SERVER['HTTP_X_FORWARDED_SSL'] ) ) ||
    ( isset( $_SERVER['HTTP_FRONT_END_HTTPS'] ) && 'on' === strtolower( $_SERVER['HTTP_FRONT_END_HTTPS'] ) ) ||
    ( isset( $_SERVER['HTTP_X_FORWARDED_PORT'] ) && 443 == $_SERVER['HTTP_X_FORWARDED_PORT'] ) ||
    ( isset( $_SERVER['HTTP_X_URL_SCHEME'] ) && 'https' === strtolower( $_SERVER['HTTP_X_URL_SCHEME'] ) )
) {
    $cc_is_ssl = true;
}

/* --------------------------------------------------------------------------
 * 2. Paksa HTTPS jika terdeteksi SSL
 * ---------------------------------------------------------------------- */
if ( $cc_is_ssl ) {
    // Beritahu WordPress bahwa koneksi menggunakan HTTPS
    $_SERVER['HTTPS'] = 'on';

    // Override URL dasar WordPress agar selalu menggunakan https://
    // Ini meng-override nilai siteurl & home di database wp_options
    if ( ! defined( 'WP_HOME' ) ) {
        define( 'WP_HOME', 'https://' . $cc_host );
    }
    if ( ! defined( 'WP_SITEURL' ) ) {
        define( 'WP_SITEURL', 'https://' . $cc_host );
    }

    // Paksa SSL di halaman admin juga
    if ( ! defined( 'FORCE_SSL_ADMIN' ) ) {
        define( 'FORCE_SSL_ADMIN', true );
    }
}
