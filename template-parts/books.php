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

// Ambil produk asli dari OwwCommerce
$product_repo = new \OwwCommerce\Repositories\ProductRepository();
$books = $product_repo->get_all( 5, 0, ['orderby' => 'newest'] );
?>

<section class="books section-divider-top section-divider-bottom" id="books">
    <div class="container text-center">
        <h2>Buku Terbitan KBM</h2>
        <?php $scroll_class = cc_get( 'mobile_scroll_books', true ) ? 'has-horizontal-scroll' : ''; ?>
        <div class="books-grid <?php echo esc_attr( $scroll_class ); ?>">
            <?php foreach ( $books as $book ) : ?>
                <a href="<?php echo esc_url( \OwwCommerce\Frontend\Router::get_product_link( $book->slug ) ); ?>" class="book-item">
                    <?php if ( $book->image_url ) : ?>
                        <img src="<?php echo esc_url( $book->image_url ); ?>" alt="<?php echo esc_attr( $book->title ); ?>">
                    <?php else : ?>
                        <div class="book-placeholder"><?php echo esc_html( $book->title ); ?></div>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php 
            $shop_page_id = get_option('owwc_page_shop_id');
            $shop_url = $shop_page_id ? get_permalink($shop_page_id) : home_url('/shop/');
        ?>
        <a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn-outline">Lihat Lainnya</a>
    </div>
</section>
