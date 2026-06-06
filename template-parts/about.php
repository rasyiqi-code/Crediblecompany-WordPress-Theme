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

$about_desc  = cc_get( 'about_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi, eget elementum ligula tempor sit amet.' );
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
