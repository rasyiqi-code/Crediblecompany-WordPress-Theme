<?php
/**
 * Seed Data — Paket Jasa Default
 * Data initial yang dimasukkan saat tema pertama kali diaktifkan.
 * Dipisahkan dari cpt-paket-jasa.php untuk menjaga file utama tetap ringkas.
 *
 * @package CredibleCompany
 */

add_action( 'after_switch_theme', 'cc_seed_paket_jasa' );

/**
 * Seed paket jasa default saat tema diaktifkan.
 * Hanya berjalan sekali (dicek via option 'cc_paket_jasa_seeded').
 */
function cc_seed_paket_jasa() {
    if ( get_option( 'cc_paket_jasa_seeded' ) ) {
        return;
    }

    $seed_packages = array(
        array(
            'title'     => 'Majapahit',
            'badge'     => 'Best Promo',
            'price'     => 'Rp. 2.250.000',
            'eksemplar' => '50 Eksemplar',
            'ukuran'    => 'A5/Unesco',
            'catatan'   => 'Layanan ini berlaku untuk 150 Halaman. Jika lebih, dikenai tarif tambahan.',
            'btn_text'  => 'Ambil Promo',
            'btn_url'   => 'https://wa.me/6281234567890',
            'features'  => "Layout\n2 Pilihan Cover\nMock Up Promosi\nWrapping/Pembungkus Buku\nLem Buku Sangat Kuat\nLaminasi Doff & Glossy\nISBN/QRSBN Perpusnas/QRCBN\nSerah Simpan Ke Perpusnas RI\nBebas Revisi 3 Kali\nLembar Pemisah Halaman\nKeanggotaan IKAPI\nDi Upload di Repository OMP\nTerindeks di Google Scholar\nTerindeks di Google Playbook\nSertifikat Penulis\nPasang Logo\nRoyalty 25% Penjualan\nFile Ebook\nGratis 100% Ongkir ke Seluruh Indonesia\nTambahan 2 Eksemplar\n1 MUG Logo KBM",
        ),
        array(
            'title'     => 'Nusantara',
            'badge'     => 'Populer',
            'price'     => 'Rp. 3.500.000',
            'eksemplar' => '100 Eksemplar',
            'ukuran'    => 'A5/Unesco',
            'catatan'   => 'Layanan ini berlaku untuk 200 Halaman. Jika lebih, dikenai tarif tambahan.',
            'btn_text'  => 'Ambil Promo',
            'btn_url'   => 'https://wa.me/6281234567890',
            'features'  => "Layout\n3 Pilihan Cover\nMock Up Promosi\nWrapping/Pembungkus Buku\nLem Buku Sangat Kuat\nLaminasi Doff & Glossy\nISBN/QRSBN Perpusnas/QRCBN\nSerah Simpan Ke Perpusnas RI\nBebas Revisi 5 Kali\nLembar Pemisah Halaman\nKeanggotaan IKAPI\nDi Upload di Repository OMP\nTerindeks di Google Scholar\nTerindeks di Google Playbook\nSertifikat Penulis\nPasang Logo\nRoyalty 25% Penjualan\nFile Ebook\nGratis 100% Ongkir ke Seluruh Indonesia\nTambahan 5 Eksemplar\n1 MUG Logo KBM",
        ),
        array(
            'title'     => 'Sriwijaya',
            'badge'     => 'Premium',
            'price'     => 'Rp. 5.000.000',
            'eksemplar' => '150 Eksemplar',
            'ukuran'    => 'A5/Unesco',
            'catatan'   => 'Layanan ini berlaku untuk 250 Halaman. Jika lebih, dikenai tarif tambahan.',
            'btn_text'  => 'Ambil Promo',
            'btn_url'   => 'https://wa.me/6281234567890',
            'features'  => "Layout\n4 Pilihan Cover\nMock Up Promosi\nWrapping/Pembungkus Buku\nLem Buku Sangat Kuat\nLaminasi Doff & Glossy\nISBN/QRSBN Perpusnas/QRCBN\nSerah Simpan Ke Perpusnas RI\nBebas Revisi Unlimited\nLembar Pemisah Halaman\nKeanggotaan IKAPI\nDi Upload di Repository OMP\nTerindeks di Google Scholar\nTerindeks di Google Playbook\nSertifikat Penulis\nPasang Logo\nRoyalty 25% Penjualan\nFile Ebook\nGratis 100% Ongkir ke Seluruh Indonesia\nTambahan 10 Eksemplar\n2 MUG Logo KBM\nVideo Promo 30 Detik",
        ),
        array(
            'title'     => 'Mataram',
            'badge'     => 'Eksklusif',
            'price'     => 'Rp. 8.000.000',
            'eksemplar' => '250 Eksemplar',
            'ukuran'    => 'A5/Unesco',
            'catatan'   => 'Layanan ini berlaku untuk 300 Halaman. Jika lebih, dikenai tarif tambahan.',
            'btn_text'  => 'Ambil Promo',
            'btn_url'   => 'https://wa.me/6281234567890',
            'features'  => "Layout\n5 Pilihan Cover\nMock Up Promosi\nWrapping/Pembungkus Buku\nLem Buku Sangat Kuat\nLaminasi Doff & Glossy\nISBN/QRSBN Perpusnas/QRCBN\nSerah Simpan Ke Perpusnas RI\nBebas Revisi Unlimited\nLembar Pemisah Halaman\nKeanggotaan IKAPI\nDi Upload di Repository OMP\nTerindeks di Google Scholar\nTerindeks di Google Playbook\nSertifikat Penulis\nPasang Logo\nRoyalty 25% Penjualan\nFile Ebook\nGratis 100% Ongkir ke Seluruh Indonesia\nTambahan 20 Eksemplar\n3 MUG Logo KBM\nVideo Promo 60 Detik\nBanner Promosi Digital",
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

    update_option( 'cc_paket_jasa_seeded', true );
}
