<?php
/**
 * Halaman Arsip Kategori, Tanggal, Tag (Blog)
 * Berdesain App-Mobile First
 *
 * @package CredibleCompany
 */

get_header(); ?>

<main class="app-main-content">
    <div class="app-header-bar">
        <!-- Tombol kembali gaya App -->
        <a href="javascript:history.back()" class="app-back-btn">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="app-page-title">
            <?php 
            if ( is_category() ) {
                single_cat_title();
            } elseif ( is_tag() ) {
                single_tag_title();
            } elseif ( is_author() ) {
                echo '<span class="vcard">' . get_the_author() . '</span>';
            } elseif ( is_day() ) {
                echo get_the_date();
            } elseif ( is_month() ) {
                echo get_the_date( _x( 'F Y', 'monthly archives date format', 'cc' ) );
            } elseif ( is_year() ) {
                echo get_the_date( _x( 'Y', 'yearly archives date format', 'cc' ) );
            } else {
                echo __( 'Arsip', 'cc' );
            }
            ?>
        </h1>
    </div>

    <div class="app-feed-container">
        <?php if ( have_posts() ) : ?>
            
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="app-post-card">
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="card-link-overlay"></a>
                    <div class="card-image-wrap">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium', ['class' => 'card-img'] ); ?>
                        <?php else : ?>
                            <div class="card-img-placeholder">📝</div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="meta-date"><?php echo get_the_date( 'd M Y' ); ?></span>
                            <span class="meta-separator">•</span>
                            <span class="meta-views">👁 <?php echo cc_get_post_views( get_the_ID() ); ?> Views</span>
                        </div>
                        <h2 class="card-title"><?php the_title(); ?></h2>
                        <p class="card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php
            // Pagination App Style
            echo '<div class="app-pagination">';
            echo paginate_links( array(
                'prev_text' => '&laquo; Prev',
                'next_text' => 'Next &raquo;',
            ) );
            echo '</div>';
            ?>

        <?php else : ?>
            <div class="app-no-results">
                <h3>Belum ada artikel.</h3>
                <p>Tidak ada post yang ditemukan pada arsip ini.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
