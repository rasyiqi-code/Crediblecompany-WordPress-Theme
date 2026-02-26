<?php
/**
 * Laman Arsip Testimoni
 * Berdesain App-Mobile First
 *
 * @package CredibleCompany
 */

get_header(); ?>

<section class="app-main-content">
    <div class="app-header-bar">
        <a href="javascript:history.back()" class="app-back-btn">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="app-page-title"><?php post_type_archive_title(); ?></h1>
    </div>

    <div class="app-feed-container">
        <!-- Tombol Tulis Ulasan -->
        <div class="app-action-row">
            <a href="<?php echo esc_url( site_url( '/submit-testimoni' ) ); ?>" class="btn-primary-app">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-right:8px;vertical-align:middle;display:inline-block;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tulis Ulasan Anda
            </a>
        </div>

        <?php if ( have_posts() ) : ?>
            <div class="testimonials-grid archive-grid-override" id="ajax-feed-container">
                <?php while ( have_posts() ) : the_post(); 
                    get_template_part( 'template-parts/card-testimoni', null, array( 'is_link' => true ) );
                endwhile; ?>
            </div>

            <!-- AJAX Load More Button -->
            <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                <div class="load-more-container">
                    <button id="load-more-btn" 
                            class="btn-load-more" 
                            data-page="1" 
                            data-max-pages="<?php echo $wp_query->max_num_pages; ?>" 
                            data-post-type="testimoni"
                            data-orderby="date">
                        Muat Lebih Banyak
                    </button>
                </div>
            <?php endif; ?>

        <?php else : ?>
            <div class="app-no-results">
                <h3>Belum ada testimoni.</h3>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
