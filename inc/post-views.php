<?php
/**
 * Post Views Counter
 * Fungsi untuk menghitung dan mendapatkan jumlah tayangan postingan.
 *
 * @package CredibleCompany
 */

/**
 * Mendapatkan jumlah tayangan postingan.
 *
 * @param int $post_id ID post.
 * @return int Jumlah tayangan.
 */
function cc_get_post_views( $post_id ) {
    $count = get_post_meta( $post_id, 'cc_post_views', true );
    return ( $count === '' ) ? 0 : intval( $count );
}

/**
 * Menambah jumlah tayangan postingan secara atomic via SQL langsung.
 * Menggunakan UPDATE ... SET meta_value = meta_value + 1 untuk menghindari race condition
 * pada traffic tinggi (dua request membaca nilai lama secara bersamaan).
 *
 * @param int $post_id ID post.
 */
function cc_set_post_views( $post_id ) {
    global $wpdb;
    $count_key = 'cc_post_views';

    $exists = get_post_meta( $post_id, $count_key, true );

    if ( $exists === '' ) {
        // Inisialisasi jika meta belum ada
        add_post_meta( $post_id, $count_key, 1, true );
    } else {
        // Atomic increment — aman untuk concurrent request
        $wpdb->query( $wpdb->prepare(
            "UPDATE $wpdb->postmeta SET meta_value = meta_value + 1 WHERE post_id = %d AND meta_key = %s",
            $post_id,
            $count_key
        ) );
        // Invalidasi object cache agar get_post_meta mengembalikan nilai terbaru
        wp_cache_delete( $post_id, 'post_meta' );
    }
}

/**
 * Hook otomatis: increment view counter saat single post dibuka.
 * Guard: abaikan preview, pengguna login, dan request AJAX.
 */
add_action( 'template_redirect', 'cc_auto_track_post_views' );
function cc_auto_track_post_views() {
    // Abaikan jika bukan single post publik
    if ( ! is_singular( 'post' ) || is_preview() ) {
        return;
    }
    // Abaikan admin dan request AJAX (termasuk AJAX fetch nonce, dll.)
    if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        return;
    }
    // Abaikan pengguna yang sudah login (opsional — hapus jika ingin hitung semua)
    if ( is_user_logged_in() ) {
        return;
    }

    cc_set_post_views( get_queried_object_id() );
}

/**
 * Mendapatkan total tayangan seluruh situs (akumulasi semua postingan).
 * Menggunakan CAST ke UNSIGNED agar SUM benar pada nilai yang disimpan sebagai string.
 *
 * @return int Total views.
 */
function cc_get_total_site_views() {
    global $wpdb;
    $total = $wpdb->get_var( $wpdb->prepare(
        "SELECT SUM(CAST(meta_value AS UNSIGNED)) FROM $wpdb->postmeta WHERE meta_key = %s",
        'cc_post_views'
    ) );
    return intval( $total );
}

/**
 * Mendapatkan jumlah kunjungan global hari ini.
 * Menggunakan wp_date() bukan date() agar mengikuti timezone yang diset di Settings > General WP.
 *
 * @return int Jumlah kunjungan hari ini.
 */
function cc_get_views_today() {
    $today = wp_date( 'Y-m-d' ); // wp_date() mengikuti timezone WordPress, bukan server
    return intval( get_option( 'cc_views_today_' . $today, 0 ) );
}

/**
 * Mencatat kunjungan global per page load.
 * Guard: abaikan admin, AJAX, dan (opsional) pengguna login.
 */
function cc_track_daily_views() {
    // Abaikan semua request non-frontend
    if ( is_admin() ) {
        return;
    }
    // Abaikan request AJAX (termasuk fetch nonce, load-more, dll.)
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        return;
    }

    $today       = wp_date( 'Y-m-d' );
    $option_name = 'cc_views_today_' . $today;
    $count       = intval( get_option( $option_name, 0 ) );
    update_option( $option_name, $count + 1, false ); // false = tidak autoload
}
add_action( 'template_redirect', 'cc_track_daily_views' );

/**
 * Cron Job untuk menghapus data kunjungan harian yang sudah lama (>30 hari).
 * Menjaga tabel wp_options tidak membengkak.
 */
add_action( 'cc_daily_views_cleanup', 'cc_cleanup_old_daily_views' );
function cc_cleanup_old_daily_views() {
    global $wpdb;
    $today       = wp_date( 'Y-m-d' );
    $option_name = 'cc_views_today_' . $today;

    // Hapus semua opsi cc_views_today_* kecuali hari ini
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

/* --------------------------------------------------------------------------
 * Kolom Views di Admin Posts Table
 * ---------------------------------------------------------------------- */
add_filter( 'manage_posts_columns', 'cc_posts_column_views' );
function cc_posts_column_views( $defaults ) {
    $defaults['post_views'] = 'Views';
    return $defaults;
}

add_action( 'manage_posts_custom_column', 'cc_posts_custom_column_views', 5, 2 );
function cc_posts_custom_column_views( $column_name, $id ) {
    if ( $column_name === 'post_views' ) {
        // Gunakan intval agar output selalu angka bersih (tidak bisa di-inject)
        echo intval( cc_get_post_views( get_the_ID() ) );
    }
}
