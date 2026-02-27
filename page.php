<?php
/**
 * Template untuk menampilkan halaman statis (Page).
 *
 * Digunakan oleh WordPress saat menampilkan post_type 'page'.
 * Template ini memastikan the_content() dipanggil agar shortcode
 * (termasuk OwwCommerce) diproses dengan benar.
 *
 * @package CredibleCompany
 */

get_header(); ?>

<main id="main" class="main-content">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e( 'Tidak ada konten ditemukan.', 'crediblecompany' ); ?></p>
    <?php endif; ?>
</main>

<?php get_footer();
