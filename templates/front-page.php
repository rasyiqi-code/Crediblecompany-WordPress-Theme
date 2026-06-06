<?php
/**
 * Template: Halaman Depan (Landing Page).
 * Memanggil semua section secara modular dari template-parts/.
 *
 * @package CredibleCompany
 */

get_header(); ?>

<!-- TEMPLATE: templates/front-page.php -->
<!-- HERO VARIANT: <?php echo esc_html( cc_get( 'hero_variant', 'default' ) ); ?> -->

<div class="app-landing-wrapper">
    <?php
    // Panggil setiap section secara berurutan dan modular
    $hero_variant = cc_get( 'hero_variant', 'default' );
    if ( 'v2' === $hero_variant ) {
        get_template_part( 'template-parts/hero-v2' );
    } elseif ( 'v3' === $hero_variant ) {
        get_template_part( 'template-parts/hero-v3' );
    } else {
        get_template_part( 'template-parts/hero' );
    }
    get_template_part( 'template-parts/statistics' );
    get_template_part( 'template-parts/about' );
    get_template_part( 'template-parts/features' );
    get_template_part( 'template-parts/pricing' );
    get_template_part( 'template-parts/testimonials' );
    get_template_part( 'template-parts/partners' );
    get_template_part( 'template-parts/books' );
    if ( cc_get( 'show_blog', true ) ) {
        get_template_part( 'template-parts/blog' );
    }
    get_template_part( 'template-parts/faq' );
    get_template_part( 'template-parts/cta' );
    ?>
</div>

<?php get_footer();
