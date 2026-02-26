<?php
/**
 * Halaman Hasil Pencarian
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
            /* translators: %s: query pencarian */
            printf( esc_html__( 'Hasil Pencarian: %s', 'cc' ), '<span>' . get_search_query() . '</span>' ); 
            ?>
        </h1>
    </div>

    <!-- Menambahkan form pencarian di atas hasil, in case user want to search again -->
    <div class="search-page-header" style="padding: 1rem 1.25rem 0.5rem; display: flex; flex-direction: column; align-items: center;">
        <?php get_search_form(); ?>
        
        <?php if ( have_posts() ) : ?>
            <p class="search-results-count" style="margin-top: 1.5rem; margin-bottom: 0; font-size: 0.95rem; font-weight: 500; color: var(--text-dark); text-align: center; width: 100%;">
                <?php 
                global $wp_query;
                printf( esc_html__( 'Ditemukan %d hasil.', 'cc' ), $wp_query->found_posts );
                ?>
            </p>
        <?php endif; ?>
    </div>

    <div class="app-feed-container" style="padding-top: 1rem;">
        <?php if ( have_posts() ) : ?>
            
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="app-post-card">
                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="card-link-overlay"></a>
                    
                    <?php if ( get_post_type() === 'post' ) : ?>
                        <!-- Tampilan untuk Blog Post -->
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

                    <?php elseif ( get_post_type() === 'testimoni' ) : ?>
                        <!-- Tampilan untuk Testimoni -->
                        <?php 
                        $client_name = get_post_meta( get_the_ID(), '_cc_testimoni_client_name', true );
                        $rating = get_post_meta( get_the_ID(), '_cc_testimoni_rating', true );
                        
                        // Set fallback agar variable tidak kosong jika meta belum ada
                        if ( empty( $client_name ) ) $client_name = 'Klien Anonim';
                        if ( empty( $rating ) ) $rating = '5';
                        ?>
                        <div class="card-content" style="padding-left: 1rem;">
                           <div class="testimonial-header" style="align-items: center;">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="testimonial-avatar" style="width: 48px; height: 48px; min-width: 48px; border-radius: 50%; overflow: hidden; margin-right: 12px; border: 2px solid var(--border-color); flex-shrink: 0; display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                                        <?php the_post_thumbnail( 'thumbnail', ['style' => 'width: 100%; height: 100%; object-fit: cover;', 'alt' => esc_attr( $client_name )] ); ?>
                                    </div>
                                <?php else : ?>
                                    <!-- Fallback inisial nama -->
                                    <div class="testimonial-avatar fallback-avatar" style="width: 48px; height: 48px; min-width: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: var(--primary-color); color: white; font-weight: bold; font-size: 1.25rem; margin-right: 12px; flex-shrink: 0;">
                                        <?php 
                                        $initials = '';
                                        $words = explode(' ', $client_name);
                                        if (count($words) >= 2) {
                                            $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                                        } else {
                                            $initials = strtoupper(substr($client_name, 0, 2));
                                        }
                                        echo esc_html($initials);
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="testimonial-client-info" style="flex: 1; min-width: 0;">
                                    <h3 class="client-name" style="margin: 0; font-size: 1rem; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo esc_html( $client_name ); ?></h3>
                                </div>
                            </div>
                            
                            <h2 class="card-title" style="margin-top: 0.75rem; font-size: 1.125rem; color: var(--text-dark); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; flex-shrink: 0;"><?php the_title(); ?></h2>
                            <div class="card-excerpt" style="font-size: 0.95rem; color: var(--text-muted); line-height: 1.5; flex-grow: 1; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"><?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?></div>
                        </div>

                    <?php else : ?>
                        <!-- Tampilan Default halaman lainnya -->
                        <div class="card-content">
                            <h2 class="card-title"><?php the_title(); ?></h2>
                            <p class="card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                        </div>
                    <?php endif; ?>
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
            <div class="app-no-results" style="text-align: center; padding: 3rem 1rem;">
                <div style="font-size: 4rem; margin-bottom: 1rem;">🔍</div>
                <h3 style="font-size: 1.25rem; color: var(--text-dark); margin-bottom: 0.5rem;"><?php esc_html_e( 'Tidak ada hasil yang ditemukan', 'cc' ); ?></h3>
                <p style="color: var(--text-muted);"><?php esc_html_e( 'Maaf, tetapi tidak ada yang cocok dengan istilah pencarian Anda. Silakan coba lagi dengan beberapa kata kunci yang berbeda.', 'cc' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
