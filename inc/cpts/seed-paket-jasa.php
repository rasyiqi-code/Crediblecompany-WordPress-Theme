<?php
/**
 * Seed Data — Paket Jasa Default
 *
 * File ini hanya dijalankan saat tema pertama kali diaktifkan (after_switch_theme)
 * atau jika data belum pernah di-seed (opsi 'cc_paket_jasa_seeded' belum ada).
 *
 * Untuk reset seed secara manual: hapus opsi 'cc_paket_jasa_seeded' dari tabel wp_options.
 * Atau gunakan WP-CLI: wp option delete cc_paket_jasa_seeded
 *
 * @package CredibleCompany
 */

/**
 * Daftarkan seed hanya satu kali — saat tema diaktifkan.
 * Menggunakan 'after_switch_theme' agar seed tidak berjalan setiap boot.
 */
add_action( 'after_switch_theme', 'cc_seed_paket_jasa' );

/**
 * Jalankan seed via init HANYA jika opsi belum ada sama sekali.
 * Guard ganda: fungsi cc_seed_paket_jasa() sendiri juga cek opsi di dalamnya.
 * Ini memastikan seed tetap berjalan pada instalasi fresh yang melewatkan after_switch_theme
 * (misalnya saat tema diinstall via WP-CLI tanpa activate event).
 */
if ( ! get_option( 'cc_paket_jasa_seeded' ) ) {
    add_action( 'init', 'cc_seed_paket_jasa', 20 );
}

/**
 * Seed paket jasa default dengan data placeholder.
 * Aman untuk dijalankan berkali-kali — fungsi idempoten via opsi flag.
 *
 * @return void
 */
function cc_seed_paket_jasa() {
    // Guard: hanya jalankan sekali seumur hidup instalasi
    if ( get_option( 'cc_paket_jasa_seeded' ) ) {
        return;
    }

    // Hapus paket jasa yang mungkin ada dari instalasi sebelumnya
    $existing = get_posts( array(
        'post_type'      => 'paket_jasa',
        'posts_per_page' => -1,
        'post_status'    => 'any',
        'fields'         => 'ids',
    ) );
    foreach ( $existing as $post_id ) {
        wp_delete_post( $post_id, true ); // true = bypass trash
    }

    // Data placeholder — sesuaikan via dashboard admin setelah tema aktif
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

    // Tandai bahwa seed sudah selesai — tidak akan dijalankan lagi
    update_option( 'cc_paket_jasa_seeded', true, false ); // false = tidak autoload
}
