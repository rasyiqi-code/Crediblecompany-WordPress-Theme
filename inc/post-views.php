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

// Tambahkan kolom di dashboard admin (opsional tapi berguna)
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
