<?php
/**
 * Template Part: Statistics Section.
 * Menampilkan angka statistik dan paragraf about dari Customizer.
 *
 * @package CredibleCompany
 */

$about_desc  = cc_get( 'about_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi, eget elementum ligula tempor sit amet.' );
$about_image = cc_img( 'about_image', 'https://via.placeholder.com/600x400.png/e2e8f0/64748b?text=Kantor+Penerbit' );
?>

<section class="statistics">
    <div class="container">
        <!-- About Block (Angka Statistik pindah ke Hero) -->

        <!-- About Block -->
        <div class="about-block">
            <img src="<?php echo esc_url( $about_image ); ?>" alt="<?php esc_attr_e( 'Kantor Penerbit', 'crediblecompany' ); ?>">
            <p><?php echo esc_html( $about_desc ); ?></p>
        </div>
    </div>
</section>
