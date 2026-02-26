<?php
/**
 * Fungsi helper untuk tema Credible Company.
 * Wrapper untuk get_theme_mod() agar lebih ringkas.
 *
 * @package CredibleCompany
 */

/**
 * Ambil nilai customizer dengan fallback default.
 *
 * @param string $key   ID setting customizer (tanpa prefix 'cc_').
 * @param mixed  $default Nilai default jika belum diatur.
 * @return mixed
 */
function cc_get( $key, $default = '' ) {
    return get_theme_mod( 'cc_' . $key, $default );
}

/**
 * Cetak nilai customizer yang sudah di-escape untuk HTML.
 *
 * @param string $key     ID setting customizer (tanpa prefix 'cc_').
 * @param string $default Nilai default.
 */
function cc_e( $key, $default = '' ) {
    echo esc_html( cc_get( $key, $default ) );
}

/**
 * Ambil URL gambar dari customizer (atau fallback placeholder).
 *
 * @param string $key     ID setting customizer (tanpa prefix 'cc_').
 * @param string $default URL default.
 * @return string
 */
function cc_img( $key, $default = '' ) {
    $value = cc_get( $key, $default );
    return esc_url( $value );
}

/**
 * --------------------------------------------------------------------------
 * Dapatkan jumlah tayangan (views) dari sebuah post
 * ---------------------------------------------------------------------- */
if ( ! function_exists( 'cc_get_post_views' ) ) {
    function cc_get_post_views( $post_id ) {
        $count_key = 'cc_post_views';
        $count = get_post_meta( $post_id, $count_key, true );
        if ( $count == '' ) {
            delete_post_meta( $post_id, $count_key );
            add_post_meta( $post_id, $count_key, '0' );
            return "0";
        }
        return $count;
    }
}

/**
 * --------------------------------------------------------------------------
 * Tambah jumlah tayangan (views) dari sebuah post
 * ---------------------------------------------------------------------- */
if ( ! function_exists( 'cc_set_post_views' ) ) {
    function cc_set_post_views( $post_id ) {
        $count_key = 'cc_post_views';
        $count = get_post_meta( $post_id, $count_key, true );
        if ( $count == '' ) {
            $count = 0;
            delete_post_meta( $post_id, $count_key );
            add_post_meta( $post_id, $count_key, '0' );
        }
    }
}

/**
 * --------------------------------------------------------------------------
 * Render bintang rating (1-5) menggunakan SVG
 * ---------------------------------------------------------------------- */
if ( ! function_exists( 'cc_render_stars' ) ) {
    function cc_render_stars( $rating ) {
        $rating = intval( $rating );
        if ( $rating < 1 ) return '';

        $stars = '';
        for ( $i = 1; $i <= 5; $i++ ) {
            if ( $i <= $rating ) {
                // Bintang penuh
                $stars .= '<svg class="star star--filled" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
            } else {
                // Bintang kosong
                $stars .= '<svg class="star star--empty" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
            }
        }
        return $stars;
    }
}
