<?php
/**
 * Template: Halaman Depan (Landing Page).
 * Memanggil semua section secara modular dari template-parts/.
 *
 * @package CredibleCompany
 */

get_header(); ?>

<div class="app-landing-wrapper">
    <?php
    // Panggil setiap section secara berurutan dan modular
    get_template_part( 'template-parts/hero' );
    get_template_part( 'template-parts/statistics' );
    get_template_part( 'template-parts/features' );
    get_template_part( 'template-parts/pricing' );
    get_template_part( 'template-parts/testimonials' );
    get_template_part( 'template-parts/partners' );
    get_template_part( 'template-parts/books' );
    get_template_part( 'template-parts/blog' );
    get_template_part( 'template-parts/faq' );
    get_template_part( 'template-parts/cta' );
    ?>
</div>

<?php get_footer();
