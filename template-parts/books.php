<?php
/**
 * Template Part: Buku Terbitan Section.
 *
 * TODO: Section ini masih menggunakan data placeholder.
 * Rencana implementasi (pilih salah satu):
 *   1. Buat CPT 'buku' built-in di tema (mirip paket_jasa/testimoni)
 *   2. Integrasikan dengan WooCommerce Product
 *   3. Ambil dari kategori post tertentu
 *
 * TODO: Ganti gambar placeholder dengan cover buku asli
 * TODO: Tambahkan link ke halaman detail / toko buku
 * TODO: Pertimbangkan slider/carousel jika jumlah buku banyak
 *
 * @package CredibleCompany
 */

// Placeholder gambar buku — nanti diganti gambar asli
$books = array(
    array( 'title' => 'Ilmu Tajwid',           'img' => 'https://via.placeholder.com/300x450' ),
    array( 'title' => 'Komunikasi Korporat',    'img' => 'https://via.placeholder.com/300x450' ),
    array( 'title' => 'Free Line',              'img' => 'https://via.placeholder.com/300x450' ),
    array( 'title' => 'From Zero to Hero',      'img' => 'https://via.placeholder.com/300x450' ),
    array( 'title' => 'Islamic Early Childhood', 'img' => 'https://via.placeholder.com/300x450' ),
);
?>

<section class="books section-divider-top section-divider-bottom">
    <div class="container text-center">
        <h2>Buku Terbitan KBM</h2>
        <?php $scroll_class = cc_get( 'mobile_scroll_books', true ) ? 'has-horizontal-scroll' : ''; ?>
        <div class="books-grid <?php echo esc_attr( $scroll_class ); ?>">
            <?php foreach ( $books as $book ) : ?>
                <div class="book-item">
                    <img src="<?php echo esc_url( $book['img'] ); ?>" alt="<?php echo esc_attr( $book['title'] ); ?>">
                </div>
            <?php endforeach; ?>
        </div>
        <button class="btn btn-outline">Lihat Lainnya</button>
    </div>
</section>
