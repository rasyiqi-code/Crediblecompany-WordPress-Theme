<?php
/**
 * Halaman Detail Laporan Testimoni Individual
 * Berdesain App-Mobile First
 *
 * @package CredibleCompany
 */

get_header(); ?>

<section class="app-single-content">
    <?php while ( have_posts() ) : the_post(); 
        $rating       = get_post_meta( get_the_ID(), 'cc_testimonial_rating', true ) ?: 5;
        $client_title = get_post_meta( get_the_ID(), 'cc_testimonial_title', true );
    ?>
    
        <div class="app-header-bar single-header">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'testimoni' ) ); ?>" class="app-back-btn">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <h1 class="app-page-title">Detail Ulasan</h1>
            <div class="header-actions-app">
                <button class="app-share-btn" onclick="if(navigator.share) navigator.share({title:'Ulasan dari <?php the_title_attribute(); ?>', url:'<?php echo esc_url( get_permalink() ); ?>'});">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                </button>
                <button class="sidebar-toggle-btn" id="sidebarToggle">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>

        <div class="single-page-layout layout-3-cols">

            <!-- Sidebar Kiri: Artikel Blog Terbaru -->
            <aside class="single-sidebar sidebar-left app-drawer" id="mobileDrawer">
                <div class="drawer-header-mobile">
                    <h3 style="visibility: hidden;">Menu</h3>
                    <button class="close-drawer" id="closeDrawer">&times;</button>
                </div>
                <div class="sidebar-widget widget-recent-posts">
                    <h3 class="section-title-premium">Artikel Terbaru</h3>
                    <div class="recent-posts-list">
                        <?php
                        $recent_posts_query = new WP_Query( array(
                            'post_type'      => 'post',
                            'posts_per_page' => 4,
                            'post_status'    => 'publish',
                            'ignore_sticky_posts' => 1
                        ) );

                        if ( $recent_posts_query->have_posts() ) :
                            while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
                                ?>
                                <div class="recent-post-item">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-info">
                                        <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 7, '...' ); ?></a></h4>
                                        <span class="post-date"><?php echo get_the_date( 'd M Y' ); ?></span>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>Belum ada artikel.</p>';
                        endif;
                        ?>
                    </div>
                </div>

                <?php if ( is_active_sidebar( 'sidebar-iklan-kiri' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-iklan-kiri' ); ?>
                <?php else : ?>
                    <div class="sidebar-widget widget-ad desktop-only">
                        <div class="ad-placeholder" style="background: #f1f5f9; border: 2px dashed #cbd5e1; border-radius: 12px; height: 300px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #94a3b8; text-align: center; padding: 20px;">
                            <span style="font-weight: 600; font-size: 14px;">Ruang Iklan</span>
                        </div>
                    </div>
                <?php endif; ?>
            </aside>

            <!-- Kolom Tengah: Highlight Testimoni Utama & Lainnya -->
            <div class="single-main-column">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'app-article-reader testi-single-reader' ); ?>>
                    
                    <div class="testi-hero-profile">
                        <div class="profile-avatar-large">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium' );
                            } else {
                                echo '<div class="avatar-placeholder-large">' . esc_html( substr( get_the_title(), 0, 1 ) ) . '</div>';
                            }
                            ?>
                        </div>
                        <h2 class="profile-name"><?php the_title(); ?></h2>
                        <?php if ( $client_title ) : ?>
                            <p class="profile-role"><?php echo esc_html( $client_title ); ?></p>
                        <?php endif; ?>
                        
                        <div class="profile-rating-stars">
                            <?php if ( function_exists( 'cc_render_stars' ) ) {
                                echo cc_render_stars( $rating );
                            } else {
                                for ( $i = 1; $i <= 5; $i++ ) {
                                    echo $i <= $rating ? '<span>★</span>' : '<span class="star-empty">☆</span>';
                                }
                            } ?>
                        </div>
                        <span class="profile-date"><?php echo get_the_date(); ?></span>
                    </div>

                    <div class="app-article-body testi-full-content">
                        <div class="quote-marks">“</div>
                        <?php the_content(); ?>
                        <div class="quote-marks-end">”</div>
                    </div>

                </article>

                <!-- Seksi Testimoni Lainnya (Grid with Load More) -->
                <div class="related-testimonials-section premium-carousel-section" style="margin: 60px 0;">
                    <h3 class="section-title-premium">Testimoni Lainnya</h3>
                    <div class="testi-feed-container">
                        <div class="testi-related-grid" id="ajax-related-container">
                            <?php
                            $current_id = get_the_ID();
                            $related_testi_query = new WP_Query( array(
                                'post_type'      => 'testimoni',
                                'posts_per_page' => 4,
                                'post__not_in'   => array( $current_id ),
                                'orderby'        => 'date',
                                'order'          => 'DESC'
                            ) );

                            if ( $related_testi_query->have_posts() ) :
                                while ( $related_testi_query->have_posts() ) : $related_testi_query->the_post();
                                    get_template_part( 'template-parts/card-testimoni', null, array( 'is_link' => true ) );
                                endwhile;
                            ?>
                        </div>

                        <?php if ( $related_testi_query->max_num_pages > 1 ) : ?>
                            <div class="load-more-container" style="margin-top: 30px; text-align: center; width: 100%;">
                                <button id="load-more-related-btn" 
                                        class="btn-load-more" 
                                        data-page="1" 
                                        data-max-pages="<?php echo $related_testi_query->max_num_pages; ?>" 
                                        data-post-type="testimoni"
                                        data-exclude="<?php echo $current_id; ?>">
                                    Muat Lebih Banyak
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php 
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>
            </div><!-- /.single-main-column -->

            <!-- Sidebar Ranan: Banner Iklan (Tetap Sidebar di Desktop) -->
            <aside class="single-sidebar sidebar-right desktop-only">
                <?php if ( is_active_sidebar( 'sidebar-iklan' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-iklan' ); ?>
                <?php else : ?>
                    <div class="sidebar-widget widget-ad">
                        <div class="ad-placeholder" style="background: #f1f5f9; border: 2px dashed #cbd5e1; border-radius: 12px; height: 600px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #94a3b8; text-align: center; padding: 20px;">
                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-bottom: 12px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            <span style="font-weight: 600; font-size: 14px;">Banner Iklan</span>
                        </div>
                    </div>
                <?php endif; ?>
            </aside>

        </div><!-- /.single-page-layout -->

        <!-- Backdrop untuk Drawer Mobile -->
        <div class="drawer-backdrop" id="drawerBackdrop"></div>

    <?php endwhile; ?>
</section>

<?php get_footer(); ?>
