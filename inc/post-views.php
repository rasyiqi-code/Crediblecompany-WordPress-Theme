<?php
/**
 * Post Views Counter
 * Fungsi untuk menghitung dan mendapatkan jumlah tayangan postingan.
 *
 * @package CredibleCompany
 */

/**
 * Mendapatkan jumlah tayangan postingan.
 */
function cc_get_post_views( $post_id ) {
    $count_key = 'cc_post_views';
    $count     = get_post_meta( $post_id, $count_key, true );
    if ( $count == '' ) {
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
        return "0";
    }
    return $count;
}

/**
 * Menambah jumlah tayangan postingan setiap kali halaman dimuat.
 */
function cc_set_post_views( $post_id ) {
    $count_key = 'cc_post_views';
    $count     = get_post_meta( $post_id, $count_key, true );
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }
}

/**
 * Mendapatkan total tayangan seluruh situs (akumulasi semua postingan).
 */
function cc_get_total_site_views() {
    global $wpdb;
    $total = $wpdb->get_var( "SELECT SUM(meta_value) FROM $wpdb->postmeta WHERE meta_key = 'cc_post_views'" );
    return $total ?: 0;
}

/**
 * Mendapatkan jumlah kunjungan hari ini.
 */
function cc_get_views_today() {
    $today = date( 'Y-m-d' );
    $views = get_option( 'cc_views_today_' . $today, 0 );
    return $views;
}

/**
 * Mencatat kunjungan global (per page load).
 */
function cc_track_daily_views() {
    if ( is_admin() ) return;
    
    $today = date( 'Y-m-d' );
    $option_name = 'cc_views_today_' . $today;
    $count = get_option( $option_name, 0 );
    $count++;
    update_option( $option_name, $count );
}
add_action( 'template_redirect', 'cc_track_daily_views' );

/**
 * Cron Job untuk menghapus data kunjungan lama.
 */
add_action( 'cc_daily_views_cleanup', 'cc_cleanup_old_daily_views' );
function cc_cleanup_old_daily_views() {
    global $wpdb;
    $today = date( 'Y-m-d' );
    $option_name = 'cc_views_today_' . $today;
    
    $wpdb->query( $wpdb->prepare( 
        "DELETE FROM $wpdb->options WHERE option_name LIKE %s AND option_name != %s", 
        'cc_views_today_%', 
        $option_name 
    ) );
}

// Jadwalkan cron job jika belum ada
if ( ! wp_next_scheduled( 'cc_daily_views_cleanup' ) ) {
    wp_schedule_event( time(), 'daily', 'cc_daily_views_cleanup' );
}

// Tambahkan kolom di dashboard admin
function cc_posts_column_views( $defaults ) {
    $defaults['post_views'] = 'Views';
    return $defaults;
}
add_filter( 'manage_posts_columns', 'cc_posts_column_views' );

function cc_posts_custom_column_views( $column_name, $id ) {
    if ( $column_name === 'post_views' ) {
        echo cc_get_post_views( get_the_ID() );
    }
}
add_action( 'manage_posts_custom_column', 'cc_posts_custom_column_views', 5, 2 );
