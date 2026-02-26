<?php
/**
 * Template Part: Statistics Section.
 * Menampilkan angka statistik dan paragraf about dari Customizer.
 *
 * @package CredibleCompany
 */

$about_desc  = cc_get( 'about_desc', 'KBM Indonesia Group telah terbukti menjadi mitra penerbitan terpercaya. Dengan dedikasi melayani para penulis di seluruh Indonesia, ribuan karya telah berhasil kami cetak dan dipasarkan.' );
$about_image = cc_img( 'about_image', 'https://via.placeholder.com/600x400.png/e2e8f0/64748b?text=Kantor+KBM' );
?>

<section class="statistics">
    <div class="container">
        <!-- About Block (Angka Statistik pindah ke Hero) -->

        <!-- About Block -->
        <div class="about-block">
            <img src="<?php echo esc_url( $about_image ); ?>" alt="Kantor KBM Indonesia Group">
            <p><?php echo esc_html( $about_desc ); ?></p>
        </div>
    </div>
</section>
