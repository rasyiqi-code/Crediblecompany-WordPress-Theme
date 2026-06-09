<?php
/**
 * Must-Use Plugin: Force SSL / HTTPS untuk Reverse Proxy.
 *
 * File ini HARUS ditempatkan di wp-content/mu-plugins/cc-force-ssl.php
 * MU Plugin dimuat SEBELUM tema dan plugin biasa, sehingga $_SERVER['HTTPS']
 * sudah diatur sebelum WordPress membaca siteurl/home dari database.
 *
 * Ini adalah best practice resmi WordPress untuk mengatasi Mixed Content
 * di balik reverse proxy (Nginx, Cloudflare, Load Balancer kampus, dsb.).
 *
 * @package CredibleCompany
 * @see https://developer.wordpress.org/advanced-administration/server/administration/#using-a-reverse-proxy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Deteksi apakah koneksi asli dari pengunjung menggunakan HTTPS
 * meskipun reverse proxy meneruskan traffic sebagai HTTP ke server WordPress.
 */
$cc_is_ssl = false;

// 1. Cek header X-Forwarded-Proto (standar industri untuk reverse proxy)
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === strtolower( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) ) {
    $cc_is_ssl = true;
}

// 2. Cek header X-Forwarded-SSL
if ( isset( $_SERVER['HTTP_X_FORWARDED_SSL'] ) && 'on' === strtolower( $_SERVER['HTTP_X_FORWARDED_SSL'] ) ) {
    $cc_is_ssl = true;
}

// 3. Cek header Front-End-Https (digunakan oleh beberapa load balancer Microsoft/IIS)
if ( isset( $_SERVER['HTTP_FRONT_END_HTTPS'] ) && 'on' === strtolower( $_SERVER['HTTP_FRONT_END_HTTPS'] ) ) {
    $cc_is_ssl = true;
}

// 4. Cek forwarded port 443
if ( isset( $_SERVER['HTTP_X_FORWARDED_PORT'] ) && 443 == $_SERVER['HTTP_X_FORWARDED_PORT'] ) {
    $cc_is_ssl = true;
}

// 5. Cek header X-Url-Scheme
if ( isset( $_SERVER['HTTP_X_URL_SCHEME'] ) && 'https' === strtolower( $_SERVER['HTTP_X_URL_SCHEME'] ) ) {
    $cc_is_ssl = true;
}

// 6. Fallback: deteksi berdasarkan domain produksi yang diketahui menggunakan HTTPS
$cc_host = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '';
if ( false !== stripos( $cc_host, 'publisher.ppns.ac.id' ) ) {
    $cc_is_ssl = true;
}

// Atur $_SERVER['HTTPS'] agar WordPress mengenali koneksi sebagai HTTPS
if ( $cc_is_ssl && ( ! isset( $_SERVER['HTTPS'] ) || 'on' !== $_SERVER['HTTPS'] ) ) {
    $_SERVER['HTTPS'] = 'on';
}
