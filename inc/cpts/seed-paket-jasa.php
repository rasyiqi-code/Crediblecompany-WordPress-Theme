<?php
/**
 * Seed Data — Paket Jasa Default
 * Data initial yang dimasukkan saat tema pertama kali diaktifkan.
 * Dipisahkan dari cpt-paket-jasa.php untuk menjaga file utama tetap ringkas.
 *
 * @package CredibleCompany
 */

add_action( 'after_switch_theme', 'cc_seed_paket_jasa' );

// Jalankan otomatis sekali jika data Lorem Ipsum belum di-seed di database aktif
if ( ! get_option( 'cc_paket_jasa_lorem_seeded' ) ) {
    add_action( 'init', 'cc_seed_paket_jasa' );
}

/**
 * Seed paket jasa default dengan data Lorem Ipsum yang general.
 * Menghapus data lama bertema KBM agar tidak terjadi duplikasi.
 */
function cc_seed_paket_jasa() {
    if ( get_option( 'cc_paket_jasa_lorem_seeded' ) ) {
        return;
    }

    // Hapus postingan CPT paket_jasa lama agar bersih
    $old_packages = get_posts( array(
        'post_type'   => 'paket_jasa',
        'numberposts' => -1,
        'post_status' => 'any',
    ) );
    foreach ( $old_packages as $post ) {
        wp_delete_post( $post->ID, true );
    }

    $seed_packages = array(
        array(
            'title'     => 'Basic',
            'badge'     => 'Promo',
            'price'     => '$19 / bln',
            'eksemplar' => 'Lorem Ipsum',
            'ukuran'    => 'Dolor Sit',
            'catatan'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'btn_text'  => 'Start Now',
            'btn_url'   => '#',
            'features'  => "Lorem Ipsum\nDolor Sit Amet\nConsectetur\nAdipiscing Elit\nProin Sodales\nImperdiet Diam\nMauris Egestas",
        ),
        array(
            'title'     => 'Standard',
            'badge'     => 'Popular',
            'price'     => '$49 / bln',
            'eksemplar' => 'Lorem Ipsum',
            'ukuran'    => 'Dolor Sit',
            'catatan'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'btn_text'  => 'Start Now',
            'btn_url'   => '#',
            'features'  => "Lorem Ipsum\nDolor Sit Amet\nConsectetur\nAdipiscing Elit\nProin Sodales\nImperdiet Diam\nMauris Egestas\nElementum Nibh\nVolutpat Neque",
        ),
        array(
            'title'     => 'Premium',
            'badge'     => 'Best Value',
            'price'     => '$99 / bln',
            'eksemplar' => 'Lorem Ipsum',
            'ukuran'    => 'Dolor Sit',
            'catatan'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'btn_text'  => 'Start Now',
            'btn_url'   => '#',
            'features'  => "Lorem Ipsum\nDolor Sit Amet\nConsectetur\nAdipiscing Elit\nProin Sodales\nImperdiet Diam\nMauris Egestas\nElementum Nibh\nVolutpat Neque\nVestibulum Ante\nIpsum Primis",
        ),
    );

    foreach ( $seed_packages as $order => $pkg ) {
        $post_id = wp_insert_post( array(
            'post_title'  => $pkg['title'],
            'post_type'   => 'paket_jasa',
            'post_status' => 'publish',
            'menu_order'  => $order + 1,
        ) );

        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_cc_badge',     $pkg['badge'] );
            update_post_meta( $post_id, '_cc_price',     $pkg['price'] );
            update_post_meta( $post_id, '_cc_eksemplar', $pkg['eksemplar'] );
            update_post_meta( $post_id, '_cc_ukuran',    $pkg['ukuran'] );
            update_post_meta( $post_id, '_cc_catatan',   $pkg['catatan'] );
            update_post_meta( $post_id, '_cc_btn_text',  $pkg['btn_text'] );
            update_post_meta( $post_id, '_cc_btn_url',   $pkg['btn_url'] );
            update_post_meta( $post_id, '_cc_features',  $pkg['features'] );
        }
    }

    update_option( 'cc_paket_jasa_lorem_seeded', true );
}
