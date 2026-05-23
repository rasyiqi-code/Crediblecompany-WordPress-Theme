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

<main id="main" class="main-content main-content-page">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Header: Page Hero -->
                <header class="page-hero">
                    <div class="container">
                        <?php if ( function_exists( 'cc_breadcrumbs' ) ) cc_breadcrumbs(); ?>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </div>
                </header>

                <!-- Body: Page Content -->
                <div class="page-content-wrapper">
                    <div class="page-card">
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="container">
            <p><?php esc_html_e( 'Tidak ada konten ditemukan.', 'crediblecompany' ); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer();
