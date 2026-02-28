<?php
/**
 * Template Part: Blog Section.
 * Mengambil 4 post terbaru secara dinamis dari WordPress.
 *
 * @package CredibleCompany
 */

$blog_query = new WP_Query( array(
    'posts_per_page' => 4, // Diubah ke 4 sesuai request (lebih compact)
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section class="blog-section section-divider-top section-divider-bottom" id="blog" style="background-color: var(--brand-light);">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: 3rem;">Blog Penerbit KBM</h2>

        <?php if ( $blog_query->have_posts() ) : ?>
            <?php $scroll_class = cc_get( 'mobile_scroll_blog', true ) ? 'has-horizontal-scroll' : ''; ?>
            <div class="blog-grid grid grid-4 <?php echo esc_attr( $scroll_class ); ?>">
                <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                    get_template_part( 'template-parts/card-post', null, array( 'style' => 'grid' ) );
                endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-center">Belum ada artikel blog.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>
