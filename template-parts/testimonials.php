<?php
/**
 * Template Part: Testimonials Section.
 * Mengambil data dari plugin Customer Says (CPT 'testimoni').
 *
 * Meta keys plugin:
 * - _customer_name       → Nama pelanggan
 * - _customer_city       → Kota asal
 * - _customer_profession → Profesi / jabatan
 * - _customer_rating     → Rating bintang (1-5)
 * - Featured Image       → Foto profil
 * - Post Content (editor) → Kutipan testimoni
 *
 * @package CredibleCompany
 */

$testi_query = new WP_Query( array(
    'post_type'      => 'testimoni',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>

<section class="testimonials">
    <div class="container">
        <h2>Testimoni Mitra<br>KBM Indonesia Group</h2>

        <?php if ( $testi_query->have_posts() ) : ?>
            <?php $scroll_class = cc_get( 'mobile_scroll_testimonials', true ) ? 'has-horizontal-scroll' : ''; ?>
            <div class="testimonials-grid <?php echo esc_attr( $scroll_class ); ?>">
                <?php while ( $testi_query->have_posts() ) : $testi_query->the_post();
                    get_template_part( 'template-parts/card-testimoni', null, array( 'is_link' => true ) );
                endwhile; ?>
            </div>

            <!-- Tombol Lihat Lagi -->
            <?php if ( get_post_type_archive_link( 'testimoni' ) ) : ?>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'testimoni' ) ); ?>" class="btn btn-outline">
                    Lihat Lagi
                </a>
            <?php endif; ?>
        <?php else : ?>
            <p class="testimonials-empty">Belum ada testimoni.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>
