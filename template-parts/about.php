<?php
/**
 * Template Part: About Section.
 * Menampilkan gambar representasi kantor/tim dan deskripsi Tentang Kami secara mandiri.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$about_desc  = cc_get( 'about_desc', 'Penerbit Buku KBM Indonesia telah terbukti menjadi mitra penerbitan buku ber ISBN yang terbaik di Indonesia. Dengan modal pelayanan dedikasi secara ramah, fast respon dalam melayani para penulis di seluruh Indonesia. Di sini, anda akan mendapatkan gratis ongkos kirim buku ke seluruh Indonesia, terindeks di google schoolar, buku diupload di google playbook dan royalti penjualan buku sebanyak 25% yang mana laporan penjualan disampaikan melalui email setiap bulannya dan bahkan ada fasilitas khusus yang mampu mengeluarkan ISBN dalam 1-2 hari.' );
$about_image = cc_img( 'about_image', cc_placeholder_svg( 600, 400, 'e2e8f0', '64748b', 'About Image' ) );
?>

<section class="about-section" id="about">
    <div class="container">
        <div class="about-block">
            <?php if ( ! empty( $about_image ) ) : ?>
                <img src="<?php echo $about_image; ?>" alt="<?php esc_attr_e( 'Tentang Kami', 'crediblecompany' ); ?>">
            <?php endif; ?>
            <p><?php echo esc_html( $about_desc ); ?></p>
        </div>
    </div>
</section>
