<?php
/**
 * Template Part: Statistics Section.
 * Menampilkan angka statistik dan paragraf about dari Customizer.
 *
 * @package CredibleCompany
 */

$about_desc  = cc_get( 'about_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi, eget elementum ligula tempor sit amet.' );
$about_image = cc_img( 'about_image', cc_placeholder_svg( 600, 400, 'e2e8f0', '64748b', 'About Image' ) );
?>

<section class="statistics">
    <div class="container">
        <!-- About Block (Angka Statistik pindah ke Hero) -->

        <!-- About Block -->
        <div class="about-block">
            <img src="<?php echo $about_image; ?>" alt="<?php esc_attr_e( 'Lorem Ipsum', 'crediblecompany' ); ?>">
            <p><?php echo esc_html( $about_desc ); ?></p>
        </div>
    </div>
</section>
